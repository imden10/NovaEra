try {
  var slider = tns({
    container: '#partner-list',
    center: true, 
    nav: false,
    gutter: 10,
    loop: true,
    autoplay: true,
    autoplayButtonOutput: false,
    controls: false,
    responsive: {
      320: {
        items: 2,
      },
      768: {
        items: 2,
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
    items: 6.5,
    center: true,
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
      768: {
        items: 2,
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
