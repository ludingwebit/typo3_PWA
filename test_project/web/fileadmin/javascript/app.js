// Wenn der Service Worker eine Änderung erfährt, wird ein Button getriggert, der den neuen installiert
'use strict';
let swRegistration = null;
let isSubscribed = false;

if ('serviceWorker' in navigator && 'PushManager' in window && 'SyncManager' in window) {
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
} else {
    console.warn("Push Benachrichtigungen werden nicht unterstützt!")
    pushButton.textContent = "Benachrichtigungen werden nicht unterstützt."
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
const applicationServerPublicKey = 'BGk2Dm42FWO-ZznSTDd1mEZN8NBhO1UdSGdyvcD9gi9hA9wKksJpRkVhgmdNyueNXZ3V0WVzeeeXE7smVoUdAI4\n';
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
            updateSubscriptionOnServer(subscription);
            if (isSubscribed) {
                console.log('User IS subscribed.');
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
        updateSubscriptionOnServer(null);
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
            updateSubscriptionOnServer(null);

            console.log('User is unsubscribed.');
            isSubscribed = false;

            updateBtn();
        });
}

function subscribeUser() {
    const applicationServerKey = urlB64ToUint8Array(applicationServerPublicKey);
    swRegistration.pushManager.subscribe({
        userVisibleOnly: true,
        applicationServerKey: applicationServerKey
    })
        .then(function (subscription) {
            console.log('User is subscribed.');

            updateSubscriptionOnServer(subscription);

            isSubscribed = true;

            updateBtn();
        })
        .catch(function (err) {
            console.log('Failed to subscribe the user: ', err);
            updateBtn();
        });
}

function updateSubscriptionOnServer(subscription, method) {
    // TODO: Send subscription to application server

    const key = subscription.getKey('p256dh');
    const token = subscription.getKey('auth');
    const contentEncoding = (PushManager.supportedContentEncodings || ['aesgcm'])[0];

    console.log(key, token)
    console.log(JSON.stringify(subscription));


    return fetch('/reservation-app/push_subscription.php', {
        method,
        body: JSON.stringify({
            endpoint: subscription.endpoint,
            publicKey: key ? btoa(String.fromCharCode.apply(null, new Uint8Array(key))) : null,
            authToken: token ? btoa(String.fromCharCode.apply(null, new Uint8Array(token))) : null,
            contentEncoding,
        }),
    }).then(() => subscription);
    /*
        const contentEncoding = (PushManager.supportedContentEncodings || ['aesgcm'])[0];

        return fetch('push_subscription.php', {
            method,
            body: JSON.stringify({
                endpoint: subscription.endpoint,
                publicKey: key ? btoa(String.fromCharCode.apply(null, new Uint8Array(key))) : null,
                authToken: token ? btoa(String.fromCharCode.apply(null, new Uint8Array(token))) : null,
                contentEncoding,
            }),
        }).then(() => subscription);*/
}


