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





