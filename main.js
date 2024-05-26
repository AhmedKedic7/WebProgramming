document.addEventListener('DOMContentLoaded', function () {
    const navBar = document.querySelector('.navBar');
    const navBarBtn = document.querySelector('.navBarBtn');

    if (navBarBtn) {
        navBarBtn.addEventListener('click', function() {
            navBar.classList.toggle('show');
            if (navBar.classList.contains('show')) {
                navBarBtn.innerHTML = '<i class="uil uil-times icon"></i>';
            } else {
                navBarBtn.innerHTML = '<i class="uil uil-bars icon"></i>';
            }
        });
    }

    const navLinks = document.querySelectorAll('.navLink');
    navLinks.forEach(navLink => {
        navLink.addEventListener('click', function() {
            navBar.classList.remove('show');
            if (navBarBtn) {
                navBarBtn.innerHTML = '<i class="uil uil-bars icon"></i>';
            }
        });
    });

    const navLinksAbout = document.querySelectorAll('.navLinkAbout');
    navLinksAbout.forEach(navLinkAbout => {
        navLinkAbout.addEventListener('click', function() {
            navBar.classList.remove('show');
            if (navBarBtn) {
                navBarBtn.innerHTML = '<i class="uil uil-bars icon"></i>';
            }
        });
    });
});
function signOut() {
    console.log("Sign out function triggered"); // Debug statement

    // Clear local storage
    localStorage.clear();
    console.log("Local storage cleared");

    // Hide the admin link
    document.getElementById("adminLink").style.display = 'none';

    // Show the login nav item
    document.getElementById("loginNavItem").style.display = 'block';

    // Redirect to home page
    window.location = "#home";
}



  
/*
    // Show Alert
const calink = document.querySelector(".forgotPass");
console.log(calink)
const card = document.querySelector(".infoCard");
const close = document.getElementById("closeCard");

calink.addEventListener('click', function () {
  card.classList.add('flowIn')
})*/