/*const lists = document.querySelectorAll('.season')
const sectionItems = document.querySelectorAll('.singleSeason')

// Add active class(Background to the button) ===============>
for(let l = 0; l<lists.length; l++){
    lists[l].addEventListener('click', function(){
        for(let w = 0; w<lists.length; w++){
            lists[w].classList.remove('activeBtn')
        }
        this.classList.add('activeBtn')

        let dataFilter = this.getAttribute('data-filter')
        for(let y = 0; y<sectionItems.length; y++){
            sectionItems[y].classList.add('hide')
            sectionItems[y].classList.remove('live')
            if(sectionItems[y].getAttribute('data-item') == dataFilter){
                sectionItems[y].classList.remove('hide')
                sectionItems[y].classList.add('live')
            }
        }
    })
}



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

// Comments Swiper ==================================================>
let commSwiper = new Swiper(".comments", {
    cssMode: true,
    loop: true,
    autoplay: true,
    spaceBetween: 10,
  
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    
    mousewheel: true,
    keyboard: true,
    mausehold: true,
   drag: true,

   breakpoints: {
       560: {
       slidesPerView: 2,
       
       },
       1000: {
       slidesPerView: 3,
       
       },
   }
  
   
  });

// Sponsors Swiper ==================================================>
let accSwiper = new Swiper(".sponsorsContainer", {
    cssMode: true,
    loop: true,
    autoplay: true,
    spaceBetween: 20,
  
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    
    mousewheel: true,
    keyboard: true,
    mausehold: true,
   drag: true,

   breakpoints: {
       560:{
         slidesPerView: 2,
       },
       769:{
         slidesPerView: 3,
         autoplay: 'false'
       },
   },
   
});
  

    // Show Alert
const calink = document.querySelector(".forgotPass");
console.log(calink)
const card = document.querySelector(".infoCard");
const close = document.getElementById("closeCard");

calink.addEventListener('click', function () {
  card.classList.add('flowIn')
})

-*/

