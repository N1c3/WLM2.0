const CACHE_NAME = 'vtm2-cache-v1';

self.addEventListener('install', (event) => {
  // No caching on install
  self.skipWaiting();
});

self.addEventListener('activate', (event) => {
  // Delete old caches
  event.waitUntil(
    caches.keys().then((cacheNames) => {
      return Promise.all(
        cacheNames.map((name) => caches.delete(name))
      );
    }).then(() => self.clients.claim())
  );
});

self.addEventListener('fetch', (event) => {
  // Forward all requests directly to the network (no caching)
  event.respondWith(fetch(event.request));
});
