try {
  var slider = tns({
    container: '#partner-list',
    center: true, 
    nav: false,
    gutter: 32,
    loop: true,
    autoplayTimeout: 5000,
    autoplay: true,
    autoplayButtonOutput: false,
    controls: false,
    responsive: {
      320: {
        items: 2.5,
      },
      576: {
        items: 3,
      },
      768: {
        items: 4,
      },
      1280: {
        items: 4.5,
      },
      1440: {
        items: 6,
      },
    },
  });

} catch (error) {
  console.log(error);
}

try {
  var slider = tns({
    container: '#block-slider',
    center: false,
    nav: false,
    controls: true,
    loop: true,
    controlsContainer: '.controls',
    prevButton: '.button-prev',
    nextButton: '.button-next',
    responsive: {
      320: {
        items: 2,
      },
      568: {
        items: 2.5,
      },
      768: {
        items: 3.5,
      },
      1280: {
        items: 4.5,
      },
      1440: {
        items: 6.5,
      },
    },
  });
} catch (error) {
  console.log(error);
}
