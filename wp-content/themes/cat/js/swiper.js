// document.addEventListener('DOMContentLoaded', function () {
//     var swiper = new Swiper('.swiper-wrapper', {
//         slidesPerView: 2,
//         spaceBetween: 10, // Adjust this value to change space between slides
//         centeredSlides: true,
//         loop: true,
//         pagination: {
//             el: '.swiper-pagination',
//             clickable: true,
//         },
//         navigation: {
//             nextEl: '.swiper-button-next',
//             prevEl: '.swiper-button-prev',
//         },
//     });
// });
//
const swiper = new Swiper('.swiper', {
    slidesPerView: 6.5,
    spaceBetween: 10,
    loop: true,
    navigation: {
        nextEl: '.button-next',
        prevEl: '.button-prev',
    },
    breakpoints: {
        320: {
          slidesPerView: 2.5,
        },
        768: {
          slidesPerView: 3.5,
        },
        1280: {
          slidesPerView: 4.5,
        },
        1440: {
          slidesPerView: 6.5,
        },
      }

})