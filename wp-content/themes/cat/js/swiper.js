try {
  new Swiper('#partner-list', {
    centeredSlides: true,
    allowTouchMove : false,
    centerInsufficientSlides: true,
    spaceBetween: 10,
    loop: true,
    navigation: {
      nextEl: '.button-next',
      prevEl: '.button-prev',
    },
    breakpoints: {
      320: {
        slidesPerView: 3,
      },
      768: {
        slidesPerView: 3.5,
        centeredSlides: false,
        allowTouchMove : true,
        centerInsufficientSlides: false,
      },
      1280: {
        slidesPerView: 4.5,
      },
      1440: {
        slidesPerView: 8,
      },
    }

  })
} catch (error) {
  console.log(error);
}

try {
  new Swiper('#block-slider', {
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
} catch (error) {
  console.log(error);
}
