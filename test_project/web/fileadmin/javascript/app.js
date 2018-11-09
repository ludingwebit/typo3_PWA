// Wenn der Service Worker eine Änderung erfährt, wird ein Button getriggert, der den neuen installiert
'use strict';
let swRegistration = null;
let isSubscribed = false;

if ('serviceWorker' in navigator && 'PushManager' in window && 'SyncManager' in window) {
    navigator.serviceWorker.register('../service-worker-manual.js')
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

function updateSubscriptionOnServer(subscription) {
    // TODO: Send subscription to application server

    const subscriptionJson = document.querySelector('.js-subscription-json');
    const subscriptionDetails =
        document.querySelector('.js-subscription-details');
    console.log(JSON.stringify(subscription));

    /*    if (subscription) {
            subscriptionJson.textContent = JSON.stringify(subscription);
            subscriptionDetails.classList.remove('is-invisible');
        } else {
            subscriptionDetails.classList.add('is-invisible');
        }*/
}

/*
const PERMISSION = Notification.requestPermission();
const PERMISSION_SUCCESS_MSG = "Danke für das aktivieren!";

if (!("Notification" in window)) {
    console.log("This browser does not support desktop notification");
}
// Let's check whether notification permissions have alredy been granted
else if (PERMISSION === "granted") {
    // If it's okay let's create a notification
    PERMISSION_SUCCESS_MSG;
}

// Otherwise, we need to ask the user for permission
else if (Notification.permission !== 'denied' || Notification.permission === "default") {
    Notification.requestPermission(function (permission) {
        // If the user accepts, let's create a notification
        if (permission === "granted") {
            PERMISSION_SUCCESS_MSG;
        }
    });
// At last, if the user has denied notifications, and you
// want to be respectful there is no need to bother them any more.
}*/
