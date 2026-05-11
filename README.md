# WLM2.0
 Wiener Linien Monitor 2.0 is a lightweight, client-side PWA for monitoring real-time public transit departures in Vienna.                                                                                    
                                         
  - Architecture: Two HTML pages, a PHP proxy, and a minimal service worker. No build step or framework — just vanilla JS, CSS, and localStorage for state.                                                    
  - WLM2config.html: Search and pick stations from the official Wien CSV dataset, then select which lines and directions you want to monitor. Saves selections to localStorage.                                
  - WLM2display.html: Dashboard that polls the proxy every 30 seconds and renders departure cards per station, showing countdown minutes, scheduled times, and a live/realtime indicator.                      
  - proxy.php: Simple cURL bridge to wienerlinien.at/ogd_realtime/monitor with basic input sanitization and CORS headers.                                                                                      
  - manifest.json / service-worker.js: Registered as a PWA (display: standalone) but the SW deliberately skips caching and forwards everything to the network.                                                 
                                                                                                                                                                                                               
  The whole app is self-contained in about 450 lines of HTML/JS per page.

  <img width="860" height="309" alt="WLM2 0config" src="https://github.com/user-attachments/assets/6a561b27-3f74-4495-a0fd-5d7c83b14e8c" />

<img width="1077" height="553" alt="WLM2 0configPopup" src="https://github.com/user-attachments/assets/09a8e3ee-1d93-42ca-a535-59c492a6fd1e" />

<img width="1464" height="563" alt="WLM2 0display" src="https://github.com/user-attachments/assets/bf7518ba-04ed-4c0a-8079-ecd95917b473" />

You find the Wiener Lienen API Documentation in
https://www.wienerlinien.at/ogd_realtime/doku/ogd/wienerlinien-echtzeitdaten-dokumentation.pdf

