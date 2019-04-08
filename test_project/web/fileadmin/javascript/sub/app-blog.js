let swRegistration = null;
let isSubscribed = false;

if ("serviceWorker" in navigator) {
    navigator.serviceWorker.register("/sw-blog.js").then(function (registration) {
        console.log("Service Worker wurde registriert mit dem Scope:", registration.scope);
        console.log("Service Worker Registriert")
        swRegistration = registration;
        //Init Button für Subscription
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
}

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

function notifyMe(response) {
    // Let's check if the browser supports notifications
    if (!("Notification" in window)) {
        console.log("This browser does not support desktop notification");
    }

    // Let's check whether notification permissions have alredy been granted
    else if (Notification.permission === "granted") {
        // If it's okay let's create a notification
        var notification = new Notification(response);
    }

    // Otherwise, we need to ask the user for permission
    else if (Notification.permission !== 'denied' || Notification.permission === "default") {
        Notification.requestPermission(function (permission) {
            // If the user accepts, let's create a notification
            if (permission === "granted") {
                var notification = new Notification(response);
            }
        });
    }

    // At last, if the user has denied notifications, and you
    // want to be respectful there is no need to bother them any more.
}

function getUserMedia(options, successCallback, failureCallback) {
    var api = navigator.getUserMedia || navigator.webkitGetUserMedia ||
        navigator.mozGetUserMedia || navigator.msGetUserMedia;
    if (api) {
        return api.bind(navigator)(options, successCallback, failureCallback);
    }
}

//Kamera und Audio Aufnahme
function getStream(type) {
    if (!navigator.getUserMedia && !navigator.webkitGetUserMedia &&
        !navigator.mozGetUserMedia && !navigator.msGetUserMedia) {
        alert('User Media API not supported.');
        return;
    }

    var constraints = {};
    constraints[type] = true;
    getUserMedia(constraints, function (stream) {
        var mediaControl = document.querySelector(type);

        if ('srcObject' in mediaControl) {
            mediaControl.srcObject = stream;
            mediaControl.src = (window.URL || window.webkitURL).createObjectURL(stream);
        } else if (navigator.mozGetUserMedia) {
            mediaControl.mozSrcObject = stream;
        }
    }, function (err) {
        alert('Error: ' + err);
    });
}

//Vibration
function vibrateSimple() {
    navigator.vibrate(200);
}

function vibratePattern() {
    navigator.vibrate([100, 200, 200, 200, 500]);
}

if ('getBattery' in navigator || ('battery' in navigator && 'Promise' in window)) {
    var target = document.getElementById('target');

    function handleChange(change) {
        var timeBadge = new Date().toTimeString().split(' ')[0];
        var newState = document.createElement('p');
        newState.innerHTML = '<span class="badge">' + timeBadge + '</span> ' + change + '.';
        target.appendChild(newState);
    }

    function onChargingChange() {
        handleChange('Akku-Status befindet sich im <b>' + (this.charging ? 'lädt' : 'entläd') + '</b>')
    }

    function onChargingTimeChange() {
        handleChange('Akku-Ladezustand <b>' + this.chargingTime + ' h</b>');
    }

    function onDischargingTimeChange() {
        let load = this.dischargingTime;
        handleChange('Akku Ladezeit <b>' + load + ' h</b>');
    }

    function onLevelChange() {
        let level = this.level;

        handleChange('Akku Ladezustand <b>' + level + '</b>');
    }

    var batteryPromise;

    if ('getBattery' in navigator) {
        batteryPromise = navigator.getBattery();
    } else {
        batteryPromise = Promise.resolve(navigator.battery);
    }

    batteryPromise.then(function (battery) {
        document.getElementById('charging').innerHTML = battery.charging ? 'laden' : 'entladen';
        document.getElementById('chargingTime').innerHTML = battery.chargingTime / 60 / 60 / 60 + ' h';
        document.getElementById('dischargingTime').innerHTML = battery.dischargingTime / 60 / 60 / 60 + ' h';
        document.getElementById('level').innerHTML = battery.level * 100 + ' %';

        battery.addEventListener('chargingchange', onChargingChange);
        battery.addEventListener('chargingtimechange', onChargingTimeChange);
        battery.addEventListener('dischargingtimechange', onDischargingTimeChange);
        battery.addEventListener('levelchange', onLevelChange);
    });
}

