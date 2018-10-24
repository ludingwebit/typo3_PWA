let CACHE_NAME = 'typo3-pwa-01';
let CACHED_URLS = [
    './',
    '/fileadmin/css/app.css',
    '/fileadmin/css/mini-dark.min.css',
    '/fileadmin/javascript/app.js',
    '/hauptnavigation/homepage.html',

]

self.addEventListener('install', function (event) {
    console.log('[Service Worker] Installation wird gestartet');
    event.waitUntil(
        caches.open(CACHE_NAME).then(function (cache) {
            console.log('[Service Worker] Dateien werden gecacht');
            return cache.addAll(CACHED_URLS);
        })
    );
});


//CACHING index.html
self.addEventListener("fetch", function (event) {
    let requestURL = new URL(event.request.url);
    if (requestURL.pathname === "/" || requestURL.pathname === "/hauptnavigation/homepage.html" || requestURL.pathname === "/hauptnavigation") {
        event.respondWith(
            caches.open(CACHE_NAME).then(function (cache) {
                return cache.match("/hauptnavigation/homepage.html").then(function (cachedResponse) {
                    let fetchPromise = fetch("/hauptnavigation/homepage.html").then(function (networkResponse) {
                        cache.put("/hauptnavigation/homepage.html", networkResponse.clone());
                        return networkResponse;
                    });
                    return cachedResponse || fetchPromise;
                });
            })
        );
    } else if (
        CACHED_URLS.includes(requestURL.href) ||
        CACHED_URLS.includes(requestURL.pathname)
    ) {
        event.respondWith(
            caches.open(CACHE_NAME).then(function (cache) {
                return cache.match(event.request).then(function (response) {
                    return response || fetch(event.request);
                });
            })
        );
    }
});


self.addEventListener('activate', function (event) {
    event.waitUntil(
        caches.keys().then(function (cacheNames) {
            return Promise.all(
                cacheNames.map(function (cacheName) {
                    if (CACHE_NAME !== cacheName && cacheName.startsWith('typo3-pwa-')) {
                        return caches.delete(cacheName);
                    }
                })
            );
        })
    );
});