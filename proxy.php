<?php
/**
 * Proxy for the Wiener Linien OGD Realtime API
 * Usage: proxy.php?diva=123&activateTrafficInfo=stoerungkurz
 */

// CORS headers allow requests from your local development environment
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json; charset=utf-8');

// Respond to preflight requests immediately
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

// Validate parameters
$diva = isset($_GET['diva']) ? preg_replace('/[^0-9]/', '', $_GET['diva']) : '';
$trafficInfo = isset($_GET['activateTrafficInfo']) ? $_GET['activateTrafficInfo'] : '';

if (empty($diva)) {
    http_response_code(400);
    echo json_encode(['error' => 'Parameter "diva" is required.']);
    exit;
}

// Build API URL
$url = 'https://www.wienerlinien.at/ogd_realtime/monitor?diva=' . urlencode($diva);
if (!empty($trafficInfo)) {
    $url .= '&activateTrafficInfo=' . urlencode($trafficInfo);
}

// API request via cURL
$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL            => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_TIMEOUT       => 15,
    CURLOPT_SSL_VERIFYPEER => true,
    CURLOPT_HTTPHEADER     => [
        'Accept: application/json',
        'User-Agent: Mozilla/5.0 (ViennaTransitMonitor/2.0)',
    ],
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);

if ($error) {
    http_response_code(502);
    echo json_encode(['error' => 'Proxy error: ' . $error]);
    exit;
}

if ($httpCode !== 200) {
    http_response_code($httpCode);
    echo json_encode(['error' => 'API error: HTTP ' . $httpCode]);
    exit;
}

// Pass response through unchanged
echo $response;
