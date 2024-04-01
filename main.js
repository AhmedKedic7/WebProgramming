const navBar = document.querySelector('.navBar')
const navBarBtn = document.querySelector('.navBarBtn')


navBarBtn.addEventListener('click', function(){
    navBar.classList.toggle('show');
    if(navBar.classList.contains('show')){
        document.querySelector('.navBarBtn').innerHTML = '<i class="uil uil-times icon"></i>'
        

    }else{
        document.querySelector('.navBarBtn').innerHTML = ' <i class="uil uil-bars icon"></i>'
       
    }
  
    
}) 

const navLinks = document.querySelectorAll('.navLink')
navLinks.forEach(navLink =>{
    navLink.addEventListener('click', function(){
        navBar.classList.remove('show');
        document.querySelector('.navBarBtn').innerHTML = ' <i class="uil uil-bars icon"></i>'
    })

})
const navLinksAbout = document.querySelectorAll('.navLinkAbout');
navLinksAbout.forEach(navLinkAbout => {
    navLinkAbout.addEventListener('click', function() {
        navBar.classList.remove('show');
        document.querySelector('.navBarBtn').innerHTML = ' <i class="uil uil-bars icon"></i>';
    });
});



  
/*
    // Show Alert
const calink = document.querySelector(".forgotPass");
console.log(calink)
const card = document.querySelector(".infoCard");
const close = document.getElementById("closeCard");

calink.addEventListener('click', function () {
  card.classList.add('flowIn')
})*/