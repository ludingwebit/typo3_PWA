/*
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
})();*/

//Material Dropdown Menu for Mobile View
let materialdropdown = document.querySelector('.material-dropdown'),
    middle = document.querySelector('.middle'),
    cross = document.querySelector('.cross'),
    dropdownMobile = document.querySelector('.dropdown');

materialdropdown.addEventListener('click', function () {
    middle.classList.toggle('active');
    cross.classList.toggle('active');
    dropdownMobile.classList.toggle('active');
})

$(document).ready(function () {
    $('#dismiss, .overlay').on('click', function () {
        $('#sidebar').removeClass('active');
        $('.overlay').removeClass('active');
    });

    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').addClass('active');
        $('.overlay').addClass('active');
        $('.collapse.in').toggleClass('in');
        $('a[aria-expanded=true]').attr('aria-expanded', 'false');
    });
});

/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
let dropdown = document.getElementsByClassName("dropdown-btn");
let i;

for (i = 0; i < dropdown.length; i++) {
    dropdown[i].addEventListener("click", function () {
        this.classList.toggle("active");
        var dropdownContent = this.nextElementSibling;
        if (dropdownContent.style.display === "block") {
            dropdownContent.style.display = "none";
        } else {
            dropdownContent.style.display = "block";
        }
    });
}
window.onresize = responsiveSidebar;
window.onload = responsiveSidebar;
function reloadSite() {
    location.reload();
}
function responsiveSidebar() {
    let myWidth = window.innerWidth;
    let setMob = document.getElementById('settings-mobile');
    let setDesk = document.getElementById('settings-desktop');
    let diss = document.getElementById('dismiss');
    let sidebar = document.getElementById('sidebar');
    let mobilebottombar = document.getElementById('mobile-bottom-bar');
    if (myWidth >= 751) {
        console.log("Size: ", myWidth);
        $("#sidebar").addClass('active');
        sidebar.style.transition = "unset";
        document.getElementById('content').style.paddingLeft = "250px";
        document.getElementById('brand-name').style.paddingLeft = "250px";
        diss.style.display = 'none';
        Object.assign(setDesk.style, {display: "flex", position: "relative"});
        Object.assign(setMob.style, {display: "none"})
        Object.assign(mobilebottombar.style, {display: "none",})
    } else {
        Object.assign(sidebar.style, {transition: "all 0.3s"});
        $("#sidebar").removeClass('active');
        document.getElementById('content').style.padding = "60px 0 60px 0";
        diss.style.display = '-webkit-inline-box';
        Object.assign(setMob.style, {display: "inline-block", float: "right", margin: "0px 10px 0px 0px"})
        Object.assign(setDesk.style, {display: "none", position: "absolute"});
        document.getElementById('brand-name').style.paddingLeft = "20px";
        Object.assign(mobilebottombar.style, {display: "flex",})
    }

}
