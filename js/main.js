const navTrigger = document.querySelector('#nav_trigger_btn');
const navMenu = document.querySelector('#nav_menu')
const navBtn = document.querySelector('.nav_btn')

navTrigger.addEventListener('click', ()=>{
    navMenu.classList.toggle('nav-is-open')
})

navBtn.addEventListener('click', ()=>{
    navMenu.classList.toggle('nav-is-open')
})

const swiper = new Swiper('.swiper', {
    loop:true,
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    //breakpoints
    slidesPerView: 3,
    spaceBetween: 20,
    breakpoints: {
        320:{
            slidesPerView: 1,
        },
        960:{
            slidesPerView: 2,
        },
        1200:{
            slidesPerView: 3,
        },
    }
})