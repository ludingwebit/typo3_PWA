// Wenn der Service Worker eine Änderung erfährt, wird ein Button getriggert, der den neuen installiert
'use strict';
let swRegistration = null;
let isSubscribed = false;

if ("serviceWorker" in navigator) {
    navigator.serviceWorker.register("/workbox-sw.js").then(function (registration) {
        console.log("Service Worker wurde registriert mit dem Scope:", registration.scope);
        console.log("Service Worker Registriert")
        swRegistration = registration;
        //Init Button für Subscription
        initializeUI();
        registerAppInstall();
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
                //Antwort "caching: true", sollte der Mode=navigate sein, rendert er die json. Der Modus muss cors sein-->Allow-Cross-origin requests.
                //Da beim Ausführen mittels cors, der Post nicht im HTML angezeigt werden, werden die Elemente gepsiechert.
                ProgressiveKITT.addAlert('Danke für ihre Reservierung. Selbst wenn sie offline sind wird diese an den Server geschickt.', "Okay.")
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
const applicationServerPublicKey = 'BN6lqWVgCzcsA17voiRXUHKXSprhR3MktTvk9d1exjWFY5Vdu6Pr5WN0dMhhsG6C0IxHmhurmUrhTcr7o0hJ_oE';
const pushButton = document.querySelector('.js-push-btn');
const delButton = document.querySelector('.js-del-btn');
let subUrl = pushButton.getAttribute("data-url");
let delUrl = delButton.getAttribute("data-url");
console.log(subUrl);
console.log(delUrl);

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
        delButton.disabled = false;
        subscribeUser();
    });
    delButton.addEventListener('click', function () {
        delButton.disabled = true;
        pushButton.disabled = false;
        unsubscribeUser();
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
        pushButton.textContent = 'Blocked';
        pushButton.disabled = true;
        delButton.disabled = true;
        return;
    }
    if (isSubscribed) {
        pushButton.disabled = true;
        pushButton.textContent = 'Benach. akt.';
        delButton.disabled = false;
        delButton.textContent = 'Benach. deakt.';

    } else {
        pushButton.disabled = false;
        pushButton.textContent = 'Benach. akt.';
        delButton.disabled = true
        delButton.textContent = 'Benach. deakt.';
    }
}

function unsubscribeUser() {
    swRegistration.pushManager.getSubscription()
        .then(function (subscription) {
            if (subscription) {
                console.log(delUrl);
                unregisterSubscription(delUrl, subscription, "POST")
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
        method: method,
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

function unregisterSubscription(delUrl, subscription, method) {
    // TODO: Send subscription to application server
    const endpoint = subscription.endpoint;
    const rawKey = subscription.getKey('p256dh');
    const rawToken = subscription.getKey('auth');
    const key = rawKey ? btoa(String.fromCharCode.apply(null, new Uint8Array(rawKey))) : null;
    const token = rawToken ? btoa(String.fromCharCode.apply(null, new Uint8Array(rawToken))) : null;

    return fetch(delUrl, {
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
    }).then(response => {
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

function registerAppInstall() {
    // from https://developers.google.com/web/fundamentals/engage-and-retain/app-install-banners/
    let deferredPrompt;
    let btnAppInstall = document.getElementById('btnAppInstall');

    window.addEventListener('beforeinstallprompt', function (e) {
        console.log('beforeinstallprompt Event fired');
        e.preventDefault();

        // Stash the event so it can be triggered later.
        deferredPrompt = e;

        btnAppInstall.addEventListener('click', function (e) {
            e.preventDefault();

            deferredPrompt.prompt();

            // Follow what the user has done with the prompt.
            deferredPrompt.userChoice.then(function (choiceResult) {
                console.log(choiceResult.outcome);

                if (choiceResult.outcome == 'dismissed') {
                    console.log('User cancelled home screen install');
                } else {
                    console.log('User added to home screen');
                    btnAppInstall.setAttribute('disabled');

                }

                // We no longer need the prompt.  Clear it up.
                deferredPrompt = null;
                btnAppInstall.setAttribute('disabled');
                btnAppInstall = false;
            });
        });

        return false;
    });
};
