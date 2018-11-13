importScripts("https://storage.googleapis.com/workbox-cdn/releases/3.4.1/workbox-sw.js");
console.log("[NETWORK CONNECTION] " + navigator.connection.effectiveType);
let CACHE_NAME = 'individually-cache-v1';
let cssCaching = new RegExp('/css/.*\.css');
let imgCaching = new RegExp('/images/');
let staticCaching = new RegExp('/javascript/.*\.js');
let mainCaching = new RegExp('.*\.html');
/*
let googleMapsAPIembed = "https://www.google.com/maps/embed/v1/place?key=AIzaSyBvQNb0hkcnBkfpVL1--9Pyd48MwjXAG18&q=webit!";
*/
// Force development builds
workbox.setConfig({debug: true});
workbox.precaching.precacheAndRoute([]);
//Funktioniert Workbox
if (workbox) {
    console.log("Yay! Workbox wurde geladen12 🎉")
} else {
    console.log("Boo! Workbox wurde nicht geladen!")
}

workbox.routing.registerRoute(
    // Cache JS files
    staticCaching,
    workbox.strategies.cacheFirst({
        cacheName: 'static-cache-v2',
    })
);


workbox.routing.registerRoute(
    mainCaching,
    workbox.strategies.cacheFirst({
        cacheName: 'main-cache-v1',
    })
)


workbox.routing.registerRoute(
    // Cache CSS files
    cssCaching,
    workbox.strategies.cacheFirst({
        // Use a custom cache name
        cacheName: 'css-cache-v1',
    })
);


workbox.routing.registerRoute(
    imgCaching,
    workbox.strategies.cacheFirst({
        // Use a custom cache name
        cacheName: 'image-cache-v1',
        plugins: [
            new workbox.expiration.Plugin({
                // Cache only 20 images
                maxEntries: 20,
                // Cache for a maximum of a week
                maxAgeSeconds: 7 * 24 * 60 * 60,
            })
        ],
    })
);


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
    return getReservation("idx", "Sending").then(function (reservations) {
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
                        body: reservationUrl
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



