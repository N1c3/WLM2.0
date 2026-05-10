# WLM2.0
 Wiener Linien Monitor 2.0 is a lightweight, client-side PWA for monitoring real-time public transit departures in Vienna.                                                                                    
                                         
  - Architecture: Two HTML pages, a PHP proxy, and a minimal service worker. No build step or framework — just vanilla JS, CSS, and localStorage for state.                                                    
  - WLM2config.html: Search and pick stations from the official Wien CSV dataset, then select which lines and directions you want to monitor. Saves selections to localStorage.                                
  - WLM2display.html: Dashboard that polls the proxy every 30 seconds and renders departure cards per station, showing countdown minutes, scheduled times, and a live/realtime indicator.                      
  - proxy.php: Simple cURL bridge to wienerlinien.at/ogd_realtime/monitor with basic input sanitization and CORS headers.                                                                                      
  - manifest.json / service-worker.js: Registered as a PWA (display: standalone) but the SW deliberately skips caching and forwards everything to the network.                                                 
                                                                                                                                                                                                               
  The whole app is self-contained in about 450 lines of HTML/JS per page.


You find the Wiener Lienen API Documentation in
https://www.wienerlinien.at/ogd_realtime/doku/ogd/wienerlinien-echtzeitdaten-dokumentation.pdf
