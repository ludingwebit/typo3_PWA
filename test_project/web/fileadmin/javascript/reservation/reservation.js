$(document).ready(function () {
    populateReservations();
    /*
        offerNotification();
    */
    let form = $("#form-reservation");
    form.submit(function (event) {
        event.preventDefault();
        let restDate = $("#form-reservation--date").val();
        let restTime = $("#form-reservation--time").val();
        let restName = $("#form-reservation--name").val();
        let restMail = $("#form-reservation--email").val();
        let restGuest = $("#form-reservation--guests").val();
        let id = Date.now().toString().substring(3, 11);

        if (!restDate || !restTime || !restGuest || !restName || !restMail) {
            ProgressiveKITT.addMessage('Fullfill request', {hideAfter: 7000})
            return false;
        } else {
            let reservationDetails = createResObject(id, restName, restDate, restTime, restGuest, restMail);
            addToObjectStore("reservation-store", reservationDetails);
            console.log("Hinzufügen von ", restName, restDate, restMail, "/", restTime, "/", restGuest);
            showNewReserverationNotification();
            swRegistration.sync.register('syncDB').then(() => {
                console.log("SyncDB ist als Event-Trigger jetzt registriert.")
            });
            ProgressiveKITT.addMessage('Lassen Sie uns benachrichtigen, wenn ihre Bestellung angenommen/abgelehnt wurde.',
                {hideAfter: 7000});
            subscribeUser();
            location.reload();
        }
    });
});

let createResObject = function (id, restName, restDate, restTime, restGuest, restMail) {
    let reservationDetails = {
        id: id,
        name: restName,
        datum: restDate,
        zeit: restTime,
        email: restMail,
        anzahl: restGuest,
        status: "Sending"
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

/*let offerNotification = function () {
    if ("Notification" in window && "serviceWorker" in navigator) {
        /!*
                console.log("Notifications sind eine tolle Sache!")
        *!/
        Notification.requestPermission().then(function (permission) {
            if (permission === "granted") {
                showNewReserverationNotification();
            }
        });
    }
};*/

/*
function uploadToDB(dbSwitch, reservationDetails) {
    if (dbSwitch == true) {
        //write me
        let xhr;
        if (window.XMLHttpRequest) { // Mozilla, Safari, ...
            xhr = new XMLHttpRequest();
        } else if (window.ActiveXObject) { // IE 8 and older
            xhr = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xhr.open("POST", "/reservation-app/reserve.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send(object);
    } else {
        addToObjectStore("reservation-store", reservationDetails);
        console.log("Hinzufügen von ", restName, restDate, restMail, "/", restTime, "/", restGuest);
        showNewReserverationNotification();
        return
    }
    ;
}*/
