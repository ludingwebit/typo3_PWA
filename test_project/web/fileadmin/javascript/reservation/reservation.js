$(document).ready(function () {
    populateReservations();
    getReservationsFromServer()
});
let createResObject = function (id, restName, restDate, restTime, restGuest, restMail) {
    let reservationDetails = {
        id: id,
        name: restName,
        datum: restDate,
        zeit: restTime,
        email: restMail,
        anzahl: restGuest,
        status: "Senden"
    };

    return reservationDetails;
};
let populateReservations = function (indexName, indexValue) {
    return new Promise(function (resolve) {
        openDatabase().then(function (db) {
            let objectStore = openObjectStore(db, "reservation-store");
            let cursor;
            let s = "";

            if (indexName && indexValue) {
                cursor = objectStore.index(indexName).openCursor(indexValue);
            } else {
                cursor = objectStore.openCursor();
            }
            cursor.onsuccess = function (event) {
                /*
                                console.log("Cursor geöffnet");
                */
                let cursor = event.target.result;
                if (cursor) {
                    s += "<h2>ID " + cursor.key + "</h2><p>";
                    for (let field in cursor.value) {
                        s += field + "=" + cursor.value[field] + "<br/>";
                    }
                    s += "</p>";
                    cursor.continue();
                }
                document.querySelector("#status").innerHTML = s;
            };
            resolve(event.target.result);

        });

    });
};
const PERMISSION_ACCESS = Notification.permission;
let showNewReserverationNotification = function () {
    navigator.serviceWorker.ready.then(function (registration) {
        if (Notification.requestPermission() === "granted") {
            registration.showNotification("Reservation erhalten!", {
                body: "Danke für die Reservierung.\n" +
                    "Sobald Änderungen oder Neuigkeiten zu der Reservierung entstehen, werden Sie informiert.\n",
                tag: "Neue Reservierung"
            });
        } else if (PERMISSION_ACCESS !== 'denied' || PERMISSION_ACCESS == 'default') {
            Notification.requestPermission().then(function (permission) {
                if (permission === 'granted') {
                    console.log("DANKE Berechtigung erteilt.");
                }
            })
        }
    });
};
//Daten werden vom Server runtergeladen, wenn die lokale Datenbank leer ist
let getReservationsFromServer = function () {
    return new Promise(function (resolve, reject) {
        return fetch("/reservation-app/confirm.php")
            .then(function (response) {
                let jsonArr = response.json();
                return jsonArr
            }).then(function (reservations) {
                reservations.map(function (reservation) {
                    resolve(syncObjectStore("reservation-store", reservation));
                })
            }).catch(function (err) {
                reject(err);
            })
    })
}
//Versuch Reservierungs-ID mit an die Subscription zu hängen
/*
let getLastReservationId = function () {
    return new Promise(function (resolve) {
        openDatabase().then(function (db) {
            let objectStore = openObjectStore(db, "reservation-store", 'readonly');
            let index = objectStore.index('idx');
            let openCursorRequest = index.openCursor(null, 'prev');
            let lastID = null;
            openCursorRequest.onsuccess = function (event) {
                if (event.target.result) {
                    lastID = event.target.result.value; //the object with max revision
                    console.log(lastID.id);
                }
                resolve(lastID.id);

            };
        });
    });
}*/
