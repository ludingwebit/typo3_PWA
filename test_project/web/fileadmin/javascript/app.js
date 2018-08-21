'use strict';

(function () {
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('../service-worker.js').then(function () {
            console.log('Service Worker wurde registriert');
        });
    } else {
        console.warn('Browser bietet keine Unterstützung für Service Worker');
    }

    document.getElementById('hello-button').addEventListener('click', function () {
        alert('Hallo zurück!');
    });
})();