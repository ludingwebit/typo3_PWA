importScripts('https://storage.googleapis.com/workbox-cdn/releases/3.6.1/workbox-sw.js');
console.log("[NETWORK CONNECTION] " + navigator.connection.effectiveType);
let CACHE_NAME = 'individually-cache-v1';
let cssCaching = new RegExp('/css/.*\.css');
let imgCaching = new RegExp('/images/');
let staticCaching = new RegExp('/javascript/.*\.js');
let mainCaching = new RegExp('.*reservierung');
let DB_VERSION = "3";
let DB_NAME = "ReservierungController-DB";
let DB_COLLECTION = "ReservierungController-requests"
let googleMapsAPIJS = "https://maps.googleapis.com/maps/api/js?key=" +
    "AIzaSyBvQNb0hkcnBkfpVL1--9Pyd48MwjXAG18&callback=initMap";

workbox.setConfig({debug: true});
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
        cacheName: 'static-v1',
        plugins: [
            new workbox.expiration.Plugin({
                // Cache only 20 images
                maxEntries: 10,
                // Cache for a maximum of a week
                maxAgeSeconds: 7 * 24 * 60 * 60,
            })
        ],
    })
);


workbox.routing.registerRoute(
    mainCaching,
    new workbox.strategies.NetworkFirst({
        cacheName: 'main-v1',
        plugins: [
            new workbox.expiration.Plugin({
                // Cache only 20 images
                maxEntries: 5,
                // Cache for a maximum of a week
                maxAgeSeconds: 7 * 24 * 60 * 60,
            })
        ],
    })
)


workbox.routing.registerRoute(
    // Cache CSS files
    cssCaching,
    workbox.strategies.cacheFirst({
        // Use a custom cache name
        cacheName: 'css-v1',
        plugins: [
            new workbox.expiration.Plugin({
                // Cache only 20 images
                maxEntries: 10,
                // Cache for a maximum of a week
                maxAgeSeconds: 7 * 24 * 60 * 60,
            })
        ],
    })
);


workbox.routing.registerRoute(
    imgCaching,
    workbox.strategies.cacheFirst({
        // Use a custom cache name
        cacheName: 'image-v1',
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
