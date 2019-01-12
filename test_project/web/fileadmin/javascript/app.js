// Wenn der Service Worker eine Änderung erfährt, wird ein Button getriggert, der den neuen installiert
'use strict';
let swRegistration = null;
let isSubscribed = false;

if ("serviceWorker" in navigator) {
    navigator.serviceWorker.register("/sw.js").then(function (registration) {
        console.log("Service Worker wurde registriert mit dem Scope:", registration.scope);
        console.log("Service Worker Registriert")
        swRegistration = registration;
        //Init Button für Subscription
        initializeUI();
        if ('PushManager' in window) {
            console.log("Push Benachrichtigungen werden unterstützt!")

        } else {
            console.warn("Push Benachrichtigungen werden nicht unterstützt!")
            pushButton.textContent = "Benachrichtigungen werden nicht unterstützt."
        }

        if ('SyncManager' in window) {
            console.log("Background Sync wird unterstützt.")
        } else {
            console.warn("Background Sync wird nicht unterstützt!")

        }
    }).catch(function (err) {
        console.log("Service Worker Registrierung fehlgeschlagen:", err);
    });

    let reservForm = document.getElementById('form-reservation');
    //Formular Input
    let restDate = document.getElementById("form_datum");
    let restTime = document.getElementById("form_zeit");
    let restName = document.getElementById("form_name");
    let restMail = document.getElementById("form_email");
    let restGuest = document.getElementById("form_anzahl");
    if (reservForm) {//Formular
        reservForm.addEventListener('submit', function (event) {
            event.preventDefault();
            fetch(reservForm.getAttribute('action'), {
                method: reservForm.getAttribute('method'),
                body: new FormData(reservForm)
            }).then(function (response) {
                return response;
            }).then(function () {
                // removeLoading();
                restDate.value = '';
                restTime.value = '';
                restName.value = '';
                restMail.value = '';
                restGuest.value = '';
            });
        });
    }
}


// Sorgt dafür, dass das Reservierungsdatum immer das tägliche anzeigt
/*Date.prototype.toDateInputValue = function () {
    var local = new Date(this)
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset())
    return local.toJSON().slice(0, 10)
}

function byId(pId) {
    return document.getElementById(pId)
}*/

// SUBSCRIPTION PART
const applicationServerPublicKey = 'BCmti7ScwxxVAlB7WAyxoOXtV7J8vVCXwEDIFXjKvD-ma-yJx_eHJLdADyyzzTKRGb395bSAtxlh4wuDycO3Ih4';
const pushButton = document.querySelector('.js-push-btn');
let subUrl = pushButton.getAttribute("data-url");
console.log(subUrl);
function urlB64ToUint8Array(base64String) {
    const padding = '='.repeat((4 - base64String.length % 4) % 4);
    const base64 = (base64String + padding)
        .replace(/\-/g, '+')
        .replace(/_/g, '/');

    const rawData = window.atob(base64);
    const outputArray = new Uint8Array(rawData.length);

    for (let i = 0; i < rawData.length; ++i) {
        outputArray[i] = rawData.charCodeAt(i);
    }
    return outputArray;
}

function initializeUI() {
    pushButton.addEventListener('click', function () {
        pushButton.disabled = true;
        if (isSubscribed) {
            unsubscribeUser();
        } else {
            subscribeUser();
        }
    });

    // Set the initial subscription value
    swRegistration.pushManager.getSubscription()
        .then(function (subscription) {
            isSubscribed = !(subscription === null);
            if (isSubscribed) {
                console.log('User IS subscribed.', subscription);
/*
                updateSubscriptionOnServer(subscription, post);
*/

            } else {
                console.log('User is NOT subscribed.');
            }

            updateBtn();
        });
}

function updateBtn() {
    if (Notification.permission === 'denied') {
        pushButton.textContent = 'Push Benachrichtigung sind geblockt';
        pushButton.disabled = true;
        return;
    }
    if (isSubscribed) {
        pushButton.textContent = 'Benachrichtigung deaktivierien';
    } else {
        pushButton.textContent = 'Benachrichtigung aktivieren';
    }
    pushButton.disabled = false;
}

function unsubscribeUser() {
    swRegistration.pushManager.getSubscription()
        .then(function (subscription) {
            if (subscription) {
                return subscription.unsubscribe();
            }
        })
        .catch(function (error) {
            console.log('Error unsubscribing', error);
        })
        .then(function () {
            console.log('User is unsubscribed.');
            isSubscribed = false;

            updateBtn();
        });
}

let subscribeUser = function () {
    return new Promise(function (resolve, reject) {
        const applicationServerKey = urlB64ToUint8Array(applicationServerPublicKey);
        swRegistration.pushManager.subscribe({
            userVisibleOnly: true,
            applicationServerKey: applicationServerKey,
        }).then(function (subscription) {
            console.log('User is subscribed.', subscription);
            isSubscribed = true;
            let subUrl = pushButton.getAttribute("data-url");
            console.log(subUrl);
            registerSubscription(subUrl, subscription, "POST")
            updateBtn();
            resolve("Es ist gelungen");
        }).catch(err => {
            reject(err);
        })

    })


}

function registerSubscription(subUrl, subscription, method) {
    // TODO: Send subscription to application server

    const endpoint = subscription.endpoint;
    const rawKey = subscription.getKey('p256dh');
    const rawToken = subscription.getKey('auth');
    const key = rawKey ? btoa(String.fromCharCode.apply(null, new Uint8Array(rawKey))) : null;
    const token = rawToken ? btoa(String.fromCharCode.apply(null, new Uint8Array(rawToken))) : null;
    console.log(subscription.toJSON());
    console.log(rawKey, token);
    return fetch(subUrl, {
        method,
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            endpoint: endpoint,
            key: key,
            authSecret: token,
        }),
    }).then(function (response) {
        if (response && response.ok) {
            console.log("Subscription wurde erfolgreich in die Datenbank geschrieben")
            new Notification("Thank you for enabling notification", {
                body: "We won't spam you , we promise",
                tag: "success",
                icon: "https://cdn1.iconfinder.com/data/icons/twitter-ui-colored/48/JD-24-128.png"
            })
        } else {
            requestSubSync();
            return Promise.reject(false);
        }
    })

};

function unregisterSubscription(subscription, method) {
    // TODO: Send subscription to application server
    const key = subscription.getKey('p256dh');
    const token = subscription.getKey('auth');
    const contentEncoding = (PushManager.supportedContentEncodings || ['aesgcm'])[0];

    return fetch('/notification/unregister', {
        method,
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            endpoint: subscription.endpoint,
            publicKey: key ? btoa(String.fromCharCode.apply(null, new Uint8Array(key))) : null,
            authToken: token ? btoa(String.fromCharCode.apply(null, new Uint8Array(token))) : null,
        }),
    }).then(response=>{
        if (response && response.ok) {
            //ToDo: Füge eine Notification hinzu, die dem Nutzer signalisiert, dass er nicht mehr Registriert ist
            console.log("Subscription wurde erfolgreich in die DAtenbank geschrieben")
        } else {
            requestUnSubSync();
            return Promise.reject(false);
        }
    })
};

function requestSubSync() {
    if (!self.registration || !self.registration.sync) {
        console.log('Sync wird nicht unterstützt!');
        return;
    } else {
        self.registration.sync.register('syncSubscription').then(function () {
            console.log("SubscribeSync ist als Event-Trigger jetzt registriert.")
        });
    }
};

function requestUnSubSync() {
    if (!self.registration || !self.registration.sync) {
        console.log('Sync wird nicht unterstützt!');
        return;
    } else {
        self.registration.sync.register('syncUnSubscription').then(function () {
            console.log("UnsubscribeSync ist als Event-Trigger jetzt registriert.")
        });
    }
};


// Nutzer wird über Konnektivität informiert
self.addEventListener('online', () => {
    ProgressiveKITT.addMessage('Sie sind Online.', {hideAfter: 5000})
});
self.addEventListener('offline', () => {
    ProgressiveKITT.addAlert('Sie sind Offline.', "Okay.")
});
function isOnline() {
    let connectionStatus = document.getElementById('connectionStatus');

    if (navigator.onLine) {
        /*            connectionStatus.classList.remove("offline");
                    connectionStatus.innerHTML = 'Verbindung zum Internet besteht!';*/
        connectionStatus.innerHTML = '<img src="\/fileadmin\/images\/wifi_on.png" width="32px">';
        return true;
    } else {
        //connectionStatus.innerHTML = 'Derzeit keine Verbindung zum Internet!';
        //connectionStatus.classList.add("offline");
        connectionStatus.innerHTML = '<img src="\/fileadmin\/images\/wifi_off.png" width="32px">';
        return false;
    }
}
window.addEventListener('online', isOnline);
window.addEventListener('offline', isOnline);
isOnline();


//Beispiel des Formulars
/*
$("form.jqControll").submit(function (event) {
    event.preventDefault();
    let form = $(this);
    let action = form.attr("action"),
        method = form.attr("method"),
        data = form.serialize();

    $.ajax({
        url: action,
        type: method,
        data: data
    }).done(function (data) {
        $('form').remove();
        console.log("Geglückt");
        $('.formresult').html('<p>Vielen Dank für Deinen Kommentar. Dieser wird geprüft und in Kürze freigeschaltet.</p>')
    }).fail(function () {
        $('form').remove();
        console.log("FAIL!");
        $('.formresult').html('<p>Upps, es ist ein Fehler aufgetreten. Dein Kommentar konnte nicht gespeichert werden</p>')
    }).always(function () {

    });
});*/