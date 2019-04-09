importScripts('https://storage.googleapis.com/workbox-cdn/releases/3.6.1/workbox-sw.js');
console.log("[NETWORK CONNECTION] " + navigator.connection.effectiveType);
let cssCaching = new RegExp('/css/.*\.css');
let imgCaching = new RegExp('/images/');
let staticCaching = new RegExp('/javascript/.*\.js');
let mainCaching = new RegExp('/hauptnavigation/reservierung.html');
let DB_VERSION = "1";
let DB_NAME = "ReservierungTypo3-DB";
let DB_COLLECTION = "ReservierungTypo3-requests"
let googleMapsAPIJS = "https://maps.googleapis.com/maps/api/js?key=" +
    "AIzaSyBvQNb0hkcnBkfpVL1--9Pyd48MwjXAG18&callback=initMap";
workbox.setConfig({
    debug: false
});
workbox.core.setCacheNameDetails({
    prefix: 'typo3-',
});
workbox.precaching.precacheAndRoute([
    {
        "url": "/hauptnavigation/anfahrt.html",
        "revision": "1"
    },
    {
        "url": "/hauptnavigation/homepage.html",
        "revision": "2"
    },
    {
        "url": "/hauptnavigation/kontakt.html",
        "revision": "3"
    },
    {
        "url": "/hauptnavigation/speisekarte.html",
        "revision": "5"
    },
    {
        "url": "/fileadmin/css/app.css",
        "revision": "6"
    },
    {
        "url": "/fileadmin/javascript/app.js",
        "revision": "7"
    },
    {
        "url": "/fileadmin/css/mini-dark.min.css",
        "revision": "8"
    },
    {
        "url": "/fileadmin/javascript/UIKit/progressive-ui-kitt.js",
        "revision": "9"
    },
    {
        "url": "/fileadmin/images/map-offline.jpg",
        "revision": "10"
    },
    {
        "url": "/fileadmin/javascript/offline-map.js",
        "revision": "11"
    },
    {
        "url": "/fileadmin/images/wifi_off.png",
        "revision": "10"
    },
    {
        "url": "/fileadmin/images/wifi_on.png",
        "revision": "10"
    }
]);//Funktioniert Workbox
if (workbox) {
    console.log("Yay! Workbox wurde geladen! 🎉")
} else {
    console.log("Boo! Workbox wurde nicht geladen!")
}


workbox.routing.registerRoute(
    mainCaching,
    new workbox.strategies.NetworkFirst()
);


workbox.routing.registerRoute(
    // Cache JS files
    staticCaching,
    workbox.strategies.cacheFirst({
        cacheName: 'static-cache-v3',
    })
);


workbox.routing.registerRoute(
    // Cache CSS files
    cssCaching,
    workbox.strategies.cacheFirst({
        // Use a custom cache name
        cacheName: 'css-cache-v3',
    })
);


workbox.routing.registerRoute(
    imgCaching,
    workbox.strategies.cacheFirst({
        // Use a custom cache name
        cacheName: 'image-cache-v3',
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

/**
 * @desc erstellt und öffnet eine IndexedDB Datenbank | Wird mittels eines Promises auf die einzelnen Callbacks geprüft
 * @param string $msg - the message to be displayed
 * @return bool - success or failure
 */
//Öffnet IDB Datenbank
let openDatabase = function () {
    return new Promise(function (resolve, reject) {
            // Gibt false zurück, wenn IndexedDB nicht unterstützt wird
            //Service WOrker kennt den Befehl window nicht, nur den globalen self
            if (!self.indexedDB) {
                return false;
            }
            let request = self.indexedDB.open(DB_NAME, DB_VERSION);
            request.onerror = function (event) {
                reject("IDB error: " + event.target.error);
            };

            request.onupgradeneeded = function (event) {
                let db = event.target.result;
                let reservationsStore;
                if (!db.objectStoreNames.contains(DB_COLLECTION)) {
                    reservationsStore = db.createObjectStore(DB_COLLECTION, {autoIncrement: true});
                } else {
                    reservationsStore = upgradeTransaction.objectStore("Reservierung");
                }
            };
            request.onsuccess = function (event) {
                resolve(event.target.result);
            };
        }
    );
};

//Öffnet eine Transaktion zum Objektspeicher der Datenbank
let openObjectStore = function (db, storeName, transactionMode) {
    return db.transaction(storeName, transactionMode).objectStore(storeName);
};

//Füge ein Element in die Datenbank
let addToObjectStore = function (storeName, object) {
    return new Promise(function (resolve, reject) {
        openDatabase().then(function (db) {
            openObjectStore(db, storeName, "readwrite")
                .add(object).onsuccess = resolve;
        }).catch(function (errorMessage) {
            reject(errorMessage);
        });
    });
};

// Request background sync
function requestReserveSync() {
    if (!self.registration || !self.registration.sync) {
        console.log('registaration sync geht los');
        return;
    } else {
        self.registration.sync.register('syncCached').then(function () {
            console.log("SyncDB ist als Event-Trigger jetzt registriert.")
        });
    }

};

// Get number of requests currenlty cached, as a Promise
function getNbCachedRequests() {
    return new Promise(function (resolve) {
        openDatabase().then(function (db) {
            let countRequest = openObjectStore(db, DB_COLLECTION, "readwrite").count()
            countRequest.onsuccess = function () {
                resolve(countRequest.result);
            };
        });
    });
};

// Get first element cached, as a promise.
// Reject if cache is empty or on error
function getFirstCached() {
    return new Promise(function (resolve, reject) {
        openDatabase().then(function (db) {
            openObjectStore(db, DB_COLLECTION, "readwrite")
                .onerror = function (event) {
                console.log('firstCachedError');
                reject(event);
            };

            let store = openObjectStore(db, DB_COLLECTION, "readwrite");
            store.openCursor()
                .onsuccess = function (event) {
                let cursor = event.target.result;
                if (cursor) {
                    let serialized = cursor.value;
                    store.delete(cursor.key);
                    resolve(serialized);
                } else {
                    reject('EMPTY_CACHE');
                }
            };
        });
    });
};

/**
 * @desc Serialisiert die Anfrage und schreibt diese in die IDB.
 * @param serialized
 * @returns {Promise}
 */
function addCached(serialized) {
    return new Promise(function (resolve, reject) {
        openDatabase().then(function (db) {
            openObjectStore(db, DB_COLLECTION, "readwrite")
                .oncomplete = function () {
                resolve(true);
            };
            openObjectStore(db, DB_COLLECTION, "readwrite")
                .onerror = function (event) {
                reject(event);
            };

            addToObjectStore(DB_COLLECTION, serialized);
        });
    });
};

/**
 * @desc Die serialisierte Anfrage wird zurück in die Ausgangsform transformiert
 * @param serialized
 * @returns {*}
 */
function deserialize(serialized) {
    return Promise.resolve(new Request(serialized.url, serialized));
};

/**
 * @desc Sendet die Einträge, welche in der IDB liegen nacheinander an den Server
 * @param isSync
 * @returns {*}
 */
function sendCached(isSync) {
    return getNbCachedRequests()
        .then(function (nb) {
            if (!nb) {
                // Nothing cached, resolve it with 0 still in cache
                return Promise.resolve(0);
            }

            let lastSerialized;
            return getFirstCached()
                .then(function (serialized) {
                    lastSerialized = serialized;
                    if (serialized) {
                        return deserialize(serialized);
                    } else {
                        return Promise.reject("[SW] Bei der Serilization gab es ein problem", false);
                    }
                }).then(function (request) {
                    return fetch(request);
                })
                .then(function (response) {
                    if (response && response.ok) {
                        // Clean last serialized to be sure it's not handled by next catch
                        lastSerialized = false;
                        return sendCached(isSync);
                    } else {
                        requestReserveSync();
                        return Promise.reject("[SW] OFFLINE?? Sync aktiviert", false);
                    }
                })
                .catch(function () {
                    if (lastSerialized) {
                        // Something went wrong, readd the lastSerialized request into cache
                        addCached(lastSerialized);
                    }
                    if (isSync) {
                        // In sync mode, we want to reject the promis in order to sync later
                        return Promise.reject("[SW] Später wird es hochgeladen!", false);
                    } else {
                        requestReserveSync();
                    }
                    return Promise.resolve(nb);
                });
        });
};


/**
 * @desc Anfrage Serialisieren, X-FROM-SW Header hinzufügen, Wandle POST so um, dass er verarbeitet werden kann
 * @param request
 * @returns {*}
 */
function serialize(request) {
    let headers = {};
    for (let entry of request.headers.entries()) {
        headers[entry[0]] = entry[1];
    }
    headers['X-FROM-SW'] = true;

    let serialized = {
        url: request.url,
        headers: headers,
        method: request.method,
        mode: request.mode,
        credentials: request.credentials,
        cache: request.cache,
        redirect: request.redirect,
        referrer: request.referrer
    };

    if (request.method !== 'GET' && request.method !== 'HEAD') {
        return request.clone().text()
            .then(function (body) {
                serialized.body = body;
                return Promise.resolve(serialized);
            });
    }
    return Promise.resolve(serialized);
};
//Fange fetch-Event ab
self.addEventListener('fetch', function (event) {
        let requestURL = new URL(event.request.url);
        //Fange POST Methode ab, um Controller Action manuell auszuführen
        if (event.request.method == 'POST' &&
            requestURL.search.indexOf("controller%5D=Reservierung") > -1) {
            // Formular senden, wird in den Cache geschrieben und asynchron gesendet
            event.respondWith(new Response(
                JSON.stringify({
                    caching: true
                }), {
                    headers: {'Content-Type': 'application/json'}
                }
            ));
            serialize(event.request)
                .then(function (serialized) {
                    addToObjectStore(DB_COLLECTION, serialized)
                        .then(function () {
                            sendCached();
                        });
                });
            //Sollte das initialisieren der Maps API fehlschlagen, wird eine JS-Datei geladen
        } else if (event.request.method == 'POST' && requestURL.search.indexOf("Subscriber&tx_acmereservation_reservaciaplugini") > -1) {
            // Formular senden, wird in den Cache geschrieben und asynchron gesendet
            event.respondWith(new Response(
                JSON.stringify({
                    caching: true
                }), {
                    headers: {'Content-Type': 'application/json'}
                }
            ));
            serialize(event.request)
                .then(function (serialized) {
                    addToObjectStore(DB_COLLECTION, serialized)
                        .then(function () {
                            sendCached();
                        });
                });
            //Sollte das initialisieren der Maps API fehlschlagen, wird eine JS-Datei geladen
        } else if (requestURL.href === googleMapsAPIJS) {
            console.log("We have to handle the Maps now");
            event.respondWith(
                fetch(
                    googleMapsAPIJS + "&" + Date.now(),
                    {mode: "no-cors", cache: "no-store"}
                ).catch(function () {
                    return caches.match("/fileadmin/javascript/offline-map.js");
                })
            );
        } else {
            // Jede andere Anfrage -- Cache First, dann Netzwerk
            event.respondWith(
                caches.match(event.request)
                    .then(function (response) {
                        // Cache hit - return response
                        if (response) {
                            return response;
                        }
                        return fetch(event.request);
                    })
            );
        }
    }
);


//Erwarte Background Sync Events
self.addEventListener('sync', function (event) {
    console.log('sync', event);
    if (event.tag == 'syncCached' || event.tag == 'test-tag-from-devtools') {
        event.waitUntil(sendCached(true));
    }
    if (event.tag == 'syncSubscription') {
        event.waitUntil(registerSubscription(true));
    }
    if (event.tag == 'syncUnSubscription') {
        event.waitUntil(unregisterSubscription(true));
    }
});


//Erwarte Push-Benachrichtigung vom Server und reagiere darauf.
self.addEventListener('push', function (event) {

    let payload = event.data ? event.data.text() : 'no payload';
    console.log('Received a push message', payload);
    payload = JSON.parse(payload);

    let title = payload.title;
    let body = payload.body;
    let icon = payload.icon;
    let tag = payload.tag;

    event.waitUntil(
        self.registration.showNotification(title, {
            body: body,
            icon: icon,
            tag: tag
        })
    );
});


