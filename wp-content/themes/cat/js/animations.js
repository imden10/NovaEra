
// Подключаем ScrollTrigger
gsap.registerPlugin(ScrollTrigger);

// Анимация
// gsap.fromTo(".fadeDown", { y: 50, opacity: 0, }, {
// 	opacity: 1,
// 	y: 0,
// 	duration: 1,
// 	ease: "power2.inOut",
// 	scrollTrigger: {
// 		trigger: "body",
// 		start: "top top",
// 	}
// });


// const tl = gsap.timeline({
// 	scrollTrigger: {
// 		trigger: '.masked',
// 		// markers: true,
// 		ease: 'linear',
// 		// repeat: 1,
// 	},
// })
gsap.from('.masked', {
	duration: 1.7,
	rotation: 1,
	yPercent: 200,
	ease: 'power3.out',
	perspective: 200,
	repeat: -1
})

gsap.fromTo(".fadeDown-t", { y: 50, opacity: 0, }, {
	opacity: 1,
	y: 0,
	duration: 2,
	ease: "power2.inOut",
	repeat: -1,
});

gsap.fromTo(".fadeDown-t", { y: 50, opacity: 0, }, {
	opacity: 1,
	y: 0,
	duration: 2,
	ease: "power2.inOut",
	repeat: -1,
});
gsap.fromTo(".masked-image", { scale: 1.3 }, {
	scale: 1,
	transition: 1,
	duration: 2,
	ease: "power2.inOut",
	repeat: -1,
});
gsap.to(".paralax-image", {
	scrollTrigger: {
		scrub: 1,
		trigger: ".paralax-image",
		start: "top top",
		end: "bottom center",
	},
	translateY: -150,
});
gsap.set('#banner-action-on-scroll', { width: '90%' }); // Устанавливаем изначальную ширину в 50%

gsap.to("#banner-action-on-scroll", {
	scrollTrigger: {
		scrub: 1,
		trigger: "#banner-action-on-scroll",
		end: "bottom center",
	},
	width: '100%' // Увеличиваем ширину до 100% при прокрутке
});
gsap.set('#banner-action-on-scroll-reverse', { width: '100%' }); // Устанавливаем изначальную ширину в 50%

gsap.to("#banner-action-on-scroll-reverse", {
	scrollTrigger: {
		scrub: 1,
		trigger: "#banner-action-on-scroll-reverse",
		end: "bottom center",
	},
	width: '90%' // Увеличиваем ширину до 100% при прокрутке
});
