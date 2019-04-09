let DB_VERSION = "2";
let DB_NAME = "reservation-DB";
/**
 * @desc erstellt und öffnet eine IndexedDB Datenbank | Wird mittels eines Promises auf die einzelnen Callbacks geprüft
 * @param string $msg - the message to be displayed
 * @return bool - success or failure
 */
let openDatabase = function () {
    return new Promise(function (resolve, reject) {
            // Gibt false zurück, wenn IndexedDB nicht unterstützt wird
            //Service WOrker kennt den Befehl window nicht, nur den globalen self
            if (!self.indexedDB) {
                return false;
            }
            let request = self.indexedDB.open(DB_NAME, DB_VERSION);
            request.onerror = function (event) {
                reject("Database error: " + event.target.error);
            };
            //
            request.onupgradeneeded = function (event) {
                let db = event.target.result;
                let reservationsStore;
                if (!db.objectStoreNames.contains("reservation-store")) {
                    reservationsStore = db.createObjectStore("reservation-store", {keyPath: "id"});
                } else {
                    reservationsStore = upgradeTransaction.objectStore("reservations");
                }
                if (!reservationsStore.indexNames.contains("idx")) {
                    reservationsStore.createIndex("idx", "status", {unique: false});
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
//Aktualisiert den Eintrag in der IndexedDB nach erfolgreichem absenden in die Datenbank
let updateObjectStore = function (storeName, id, object) {
    return new Promise(function (resolve, reject) {
        openDatabase().then(function (db) {
            openObjectStore(db, storeName, "readwrite")
                .openCursor().onsuccess = function (event) {
                let cursor = event.target.result;
                if (!cursor) {
                    //Hole die Reservierung aus der Datenbank
                    /*                    let dbObject = getReservationsFromServer()
                                        openObjectStore(db, storeName, "readwrite").add(dbObject);*/
                    reject("Reservierung war nicht im lokalen Speicher, wurde aber hinzugefügt.");
                }
                if (cursor.value.id === id) {
                    object.status = "Angekommen";
                    cursor.update(object).onsuccess = resolve;
                    return object;
                }
                cursor.continue();
            };
        }).catch(function (errorMessage) {
            reject(errorMessage);
        });
    });
};
let getReservation = function (indexName, indexValue) {
    return new Promise(function (resolve) {
        openDatabase().then(function (db) {
            let objectStore = openObjectStore(db, "reservation-store");
            let reservations = [];
            let cursor;
            if (indexName && indexValue) {
                cursor = objectStore.index(indexName).openCursor(indexValue)
            } else {
                cursor = objectStore.openCursor();
            }
            cursor.onsuccess = function (event) {
                let cursor = event.target.result;
                if (cursor) {
                    reservations.push(cursor.value);
                    cursor.continue();
                } else {
                    if (reservations.length > 0) {
                        resolve(reservations);
                    }
                }
            }
        });
    });
}
let syncObjectStore = function (storeName, reservationObj) {
    return new Promise(function (resolve) {
        openDatabase().then(function (db) {
            openObjectStore(db, storeName, "readwrite")
                .openCursor().onsuccess = function (event) {
                let cursor = event.target.result;
                if (!cursor) {
                    resolve(openObjectStore(db, storeName, "readwrite").add(reservationObj));
                }
                else {
                    resolve("Alles Synchron");
                }
            }
        })
    })
}