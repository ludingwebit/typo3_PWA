// Wenn der Service Worker eine Änderung erfährt, wird ein Button getriggert, der den neuen installiert
'use strict';
let swRegistration = null;
let isSubscribed = false;
const post = "POST";
const put = "PUT";
const del = "DELETE";
if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/service-worker-manual.js')
        .then(registration => navigator.serviceWorker.ready)
        .then(registration => {//register Sync
            swRegistration = registration;
            initializeUI();
            /*            document.getElementById('reservation-submit').addEventListener('click', () => {
                            registration.sync.register('syncDB').then(() => {
                                console.log("SyncDB ist als Event-Trigger registriert.");
                            })
                        })*///initialize Push
        }).catch(error => {
        console.log("Service Worker Error", error);
    })
    if ('PushManager' in window) {
        console.log("Push Benachrichtigungen werden unterstützt!")

    }
    else {
        console.warn("Push Benachrichtigungen werden nicht unterstützt!")
        pushButton.textContent = "Benachrichtigungen werden nicht unterstützt."
    }

    if ('SyncManager' in window) {
        console.log("Background Sync wird unterstützt.")
    } else {
        console.warn("Background Sync wird nicht unterstützt!")

    }
}

// Nutzer wird über Konnektivität informiert
self.addEventListener('online', () => {
    ProgressiveKITT.addMessage('Sie sind Online.', {hideAfter: 5000})
})
self.addEventListener('offline', () => {
    ProgressiveKITT.addAlert('Sie sind Offline.', "Okay.")
})

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
                updateSubscriptionOnServer(subscription, post);

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
            updateSubscriptionOnServer(subscription, post)
            updateBtn();
            resolve("Es ist gelungen");
        }).catch(err => {
            reject(err);
        })

    })


}

/*let subscription = createSubscription + id
    .then(function (subscription) {
        console.log("ID", userres_id);
        console.log('User is subscribed.', subscription);
        updateSubscriptionOnServer(subscription, "POST", id);

        isSubscribed = true;

        updateBtn();
    })
    .catch(function (err) {
        console.log('Failed to subscribe the user: ', err);
        updateBtn();
    });
}*/

function updateSubscriptionOnServer(subscription, method) {
    // TODO: Send subscription to application server
    const key = subscription.getKey('p256dh');
    const token = subscription.getKey('auth');
    const contentEncoding = (PushManager.supportedContentEncodings || ['aesgcm'])[0];

    return fetch('/reservation-app/push_subscription.php', {
        method,
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            endpoint: subscription.endpoint,
            publicKey: key ? btoa(String.fromCharCode.apply(null, new Uint8Array(key))) : null,
            authToken: token ? btoa(String.fromCharCode.apply(null, new Uint8Array(token))) : null,
            contentEncoding
        }),
    })
    /*.then(() => {
            getLastReservationId().then(id => {
                return fetch('/reservation-app/push_subscription.php', {
                    method: "PUT",
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: id
                })
            });
        })*/
};


