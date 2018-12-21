importScripts("/fileadmin/javascript/UIKit/progressive-ui-kitt-sw-helper.js");
importScripts("/fileadmin/javascript/reservation/reservation-store.js");
/*ProgressiveKITT.addMessage('[Service Worker]Verbindungsstatus: ' + navigator.connection.effectiveType,
    {hideAfter: 5000});*/
let CACHE_NAME = 'typo3-pwa-01';
let CACHED_URLS = [
    '/fileadmin/css/app.css',
    '/fileadmin/css/mini-dark.min.css',
    '/fileadmin/javascript/app.js',
    '/fileadmin/javascript/offline-map.js',
    '/hauptnavigation/homepage.html',
    '/hauptnavigation/anfahrt.html',
    '/hauptnavigation/kontakt.html',
    '/hauptnavigation/speisekarte.html',
    '/hauptnavigation/reservierung.html'
]
let googleMapsAPIJS = "https://maps.googleapis.com/maps/api/js?key=" +
    "AIzaSyBvQNb0hkcnBkfpVL1--9Pyd48MwjXAG18&callback=initMap";

self.addEventListener('install', function (event) {
    console.log('[Service Worker] Installation wird gestartet');
    event.waitUntil(
        caches.open(CACHE_NAME).then(function (cache) {
            console.log('[Service Worker] Dateien werden gecacht');
            return cache.addAll(CACHED_URLS);
        })
    )
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
        CACHED_URLS.includes(requestURL.pathname)) {
        event.respondWith(
            caches.open(CACHE_NAME).then(function (cache) {
                return cache.match(event.request).then(function (response) {
                    return response || fetch(event.request);
                });
            })
        );
    } else if (requestURL.href === "https://maps.googleapis.com/maps/api/js/") {
        console.log("We have to handle the Maps now");
        event.respondWith(
            fetch(
                googleMapsAPIJS + "&" + Date.now(),
                {mode: "no-cors", cache: "no-store"}
            ).catch(function () {
                return caches.match("/fileadmin/js/offline-map.js");
            })
        );
    }
    /* else if (requestURL.href("https://maps.googleapis.com/maps/api/js/ViewportInfoService") === 0) {
            return caches.match("/fileadmin/javascript/offline-map.js")

        }*/

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
            )
        })
    );
});

//Erstellt eine Query aus den gegebenen Eintrag
/*let createReservationUrl = function (reservationDetails) {
    let reservationUrl = new URL("http://127.0.0.1/reservation-app/reserve.php");
    Object.keys(reservationDetails).forEach(function (key) {
        reservationUrl.searchParams.append(key, reservationDetails[key]);
    });
    return reservationUrl;
};*/
let createReservationJSON = (reservationDetails => {
    let post_entries = [];
    let object_keys = Object.keys(reservationDetails);

    for (const key of object_keys) {
        post_entries.push(encodeURIComponent(key) + '=' + encodeURIComponent(reservationDetails[key]));
    }
    let post_string = post_entries.join('&');
    return post_string;
});
let syncDB = function () {
    return getReservation("idx", "Senden").then(function (reservations) {
        return Promise.all(
            reservations.map(function (reservation) {
                let reservationUrl = createReservationJSON(reservation);
                return fetch("/reservation-app/reserve.php",
                    {
                        method: 'post',
                        headers: {
                            'Accept': 'application/x-www-form-urlencoded',
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: reservationUrl,
                    })
                    .then(function (response) {
                        console.log(response);
                        //ID der Reservierung wird angenommen und in der IDB der Status geändert, das die Datei im Backend angekommen ist
                        let newRes = updateObjectStore("reservation-store", reservation.valueOf().id, reservation);
                        console.log(newRes);
                        return newRes;
                    }).then(function (response) {
                        //Wenn das Sync Event ausgeführt wurde, wird der Nutzer informiert, dass seine Bestellung beim Restaurant angekommen ist und Bearbeitet wird.
                        return self.registration.showNotification("Reservierung Gesendet", {
                            body: "Reservierung mit der ID " + response.srcElement.result + " wurde an das Restaurant gesendet.",
                            icon: "/images/logo.png",
                            badge: "/images/logo.png",
                            tag: "reservation-confirmation-" + reservation.id,
                            actions: [
                                {action: "details", title: "Zeige Reservierung", icon: "/images/logo.png"},
                                {action: "confirm", title: "OK", icon: "/images/logo.png"},
                            ],
                            vibrate: [500, 110, 500, 110, 450, 110, 200, 110, 170, 40, 450, 110, 200, 110, 170, 40, 500]
                        });
                    }).catch(function (error) {
                        console.error(error);
                    });
            })
        );
    });
};
self.addEventListener('sync', (event => {
    if (event.tag == 'syncDB') {
        event.waitUntil(syncDB(),
            console.log("ALLE DATEN WURDEN AUF DEN SERVER ÜBERTRAGEN")
        );
    }
}));

/**
 * @todo Push Notification --> Rechercher, ob es nötig ist einen Key zu nutzen oder ob es dabei nur um Sicherheit geht.
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


self.addEventListener("notificationclick", function (event) {
    event.notification.close();
    if (event.action === "details") {
        event.waitUntil(
            self.clients.matchAll().then(function (activeClients) {
                if (activeClients.length > 0) {
                    activeClients[0].navigate("/hauptnavigation/reservierung.html");
                } else {
                    self.clients.openWindow("/hauptnavigation/reservierung.html");
                }
            })
        );
    }
});