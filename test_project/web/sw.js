importScripts("/fileadmin/javascript/UIKit/progressive-ui-kitt-sw-helper.js");
// importScripts("/fileadmin/javascript/reservation/reservation-store.js");
let DB_VERSION = "1";
let DB_NAME = "ReservierungTypo3-DB";
let DB_COLLECTION = "ReservierungTypo3-requests"
let CACHE_NAME = 'pwa-typo3-v1';
let CACHED_URLS = [
    '/fileadmin/css/app.css',
    '/fileadmin/css/mini-dark.min.css',
    '/fileadmin/javascript/app.js',
    '/fileadmin/javascript/offline-map.js',
    '/fileadmin/images/map-offline.jpg',
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

/*
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
    } else if (event.request.method == 'POST') {
        // This is a form sending, handle it by adding it to cache and then try to send it asynchronously
        event.respondWith(new Response(
            JSON.stringify({
                caching: true
            }), {
                headers: {'Content-Type': 'application/json'}
            }
        ));
    }
    /!* else if (requestURL.href("https://maps.googleapis.com/maps/api/js/ViewportInfoService") === 0) {
            return caches.match("/fileadmin/javascript/offline-map.js")

        }*!/

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
/!*let createReservationUrl = function (reservationDetails) {
    let reservationUrl = new URL("http://127.0.0.1/reservation-app/reserve.php");
    Object.keys(reservationDetails).forEach(function (key) {
        reservationUrl.searchParams.append(key, reservationDetails[key]);
    });
    return reservationUrl;
};*!/
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

/!**
 * @todo Push Notification --> Rechercher, ob es nötig ist einen Key zu nutzen oder ob es dabei nur um Sicherheit geht.
 *!/
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
});*/

self.addEventListener('activate', function (event) {
    // Once SW is activated, claim all clients to be sure they are directly handled by SW to avoid page reload
    event.waitUntil(self.clients.claim());
});

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

// Add serialized request to cache
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

// Deserialize request
function deserialize(serialized) {
    return Promise.resolve(new Request(serialized.url, serialized));
};

// Send cached requests, one by one
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

// Serialize a request, adding a X-FROM-SW header
function serialize(request) {
    var headers = {};
    for (let entry of request.headers.entries()) {
        headers[entry[0]] = entry[1];
    }
    headers['{{ headerSW }}'] = true;

    var serialized = {
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
        if (event.request.method == 'POST' && requestURL.pathname.indexOf("/reservierung.html") !== -1) {
            // This is a form sending, handle it by adding it to cache and then try to send it asynchronously
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
            // Any other request, try cache first then network
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
/// listen to push event , aka push messages and display them
self.addEventListener('push', function (event) {

    var payload = event.data ? event.data.text() : 'no payload';
    console.log('Received a push message', payload);
    payload = JSON.parse(payload);

    var title = payload.title;
    var body = payload.body;
    var icon = payload.icon;
    var tag = payload.tag;

    event.waitUntil(
        self.registration.showNotification(title, {
            body: body,
            icon: icon,
            tag: tag
        })
    );
});