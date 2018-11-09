importScripts("/fileadmin/javascript/UIKit/progressive-ui-kitt-sw-helper.js");
importScripts("/fileadmin/javascript/reservation/reservation-store.js");
/*ProgressiveKITT.addMessage('[Service Worker]Verbindungsstatus: ' + navigator.connection.effectiveType,
    {hideAfter: 5000});*/
let CACHE_NAME = 'typo3-pwa-01';
let CACHED_URLS = [
    '/fileadmin/css/app.css',
    '/fileadmin/css/mini-dark.min.css',
    '/fileadmin/javascript/app.js',
    '/hauptnavigation/homepage.html',
    '/hauptnavigation/anfahrt.html',
    '/hauptnavigation/kontakt.html',
    '/hauptnavigation/speisekarte.html',
    '/hauptnavigation/reservierung.html'

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
    if (requestURL.pathname === "/" || requestURL.pathname === "/hauptnavigation/homepage.html" || requestURL.pathname === "/hauptnavigation" || requestURL.pathname === "/index.php?id=6") {
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

//Erstellt eine Query aus den gegebenen Eintrag
let createReservationUrl = function (reservationDetails) {
    let reservationUrl = new URL("http://127.0.0.1/reservation-app/reserve.php");
    Object.keys(reservationDetails).forEach(function (key) {
        reservationUrl.searchParams.append(key, reservationDetails[key]);
    });
    return reservationUrl;
    l
};

let syncDB = function () {
    return getReservation("idx", "Sending").then(function (reservations) {
        return Promise.all(
            reservations.map(function (reservation) {
                let reservationUrl = createReservationUrl(reservation);
                return fetch(reservationUrl).then((response => {
                    return response;
                })).then((text => {
                    console.log("Die Anfrage wurde erfolgreich absolviert.", text);
                    console.log(text.status);
                    if (Status == 200) {
                        ProgressiveKITT.addMessage('[Service Worker] Ihre Reservierung wurder vermerkt, sobald sie bestätigt wurde, werden Sie informiert. Vielen Dank!',
                            {hideAfter: 7000});
                    }
                })).catch(function (err) {
                    console.log("Etwas ist schief gelaufen", err);
                });


                /*.then(function (response) {
                    console.log(response.json())
                    return response.json();
                })*/
            })
        );
    });
};

self.addEventListener('sync', (event => {
    if (event.tag == 'syncDB') {
        event.waitUntil(syncDB(),
            console.log("ALLE DATEN WURDEN AUF DEN SERVER ÜBERTRAGEN")
        );

        /**
         * @todo Event einfügen, dass triggert, wenn eine Reservierung ausgeführt wird.
         * @todo Muss Daten von der IndexedDB übernehmen und weiterverarbeiten --> Wenn getätigt Nutzer informieren.*/
    }
}));


/**
 * @todo Push Notification --> Rechercher, ob es nötig ist einen Key zu nutzen oder ob es dabei nur um Sicherheit geht.
 * @todo Nutzer informieren, wenn die REservierung in die Datenbank eingetragen wurden. Eventuell einen Datenbankeintrag immer eine 0 mitgeben und wenn der "Admin" den Wert in der Datenbank zu einer 1 ändert wird mittels Background Sync der Nutzer benachrichtig, dass seine Reservierung angenommen wurde.
 */
self.addEventListener('push', function (event) {
    console.log('[Service Worker] Push Erhalten.');
    console.log(`[Service Worker] Push enthält diese Daten: "${event.data.text()}"`);

    const title = 'Push Reservation';
    const options = {
        body: 'Yay it works.',
        icon: 'fileadmin/images/manifest/icon_128.png',
        badge: 'fileadmin/images/manifest/icon_512.png'
    };
    const notificationPromise = self.registration.showNotification(title, options);
    event.waitUntil(notificationPromise);
});

/*
function showNotification(event) {
    return new Promise(resolve => {
        const {body, title, tag} = JSON.parse(event.data.text());

        self.registration
            .getNotifications({tag})
            .then(existingNotifications => {
            })
            .then(() => {
                const icon = `/path/to/icon`;
                return self.registration
                    .showNotification(title, {body, tag, icon})
            })
            .then(resolve)
    })
}

self.addEventListener("push", event => {
    event.waitUntil(
        showNotification(event)
    );
});*/
