document.addEventListener("DOMContentLoaded", () => {
	'use strict';
	// document.body.setAttribute('data-theme', 'nova-era')
	// document.body.setAttribute('data-mode', 'light')
	// document.body.setAttribute('data-windowsize', '1440-1280')
	// global variables
	let windowSizeRange;
	let windowSize = window.innerWidth;
	let counter = 1
	const changeTheme = () => {
		setInterval(() => {
			counter++

			if (counter >= 5) {
				counter = 1
			}
			console.log(counter);
			document.body.setAttribute('data-theme', `theme${counter}`)
		}, 6000)

	}
	const checkWindowSize = () => {
		windowSize = window.innerWidth
		if (windowSize >= 1280) {
			windowSizeRange = '1440-1280';
		} else if (windowSize >= 1024 && windowSize <= 1279) {
			windowSizeRange = '1279-1024';
		} else if (windowSize >= 577 && windowSize <= 1023) {
			windowSizeRange = '1023-768';
		} else if (windowSize <= 576) {
			windowSizeRange = '567-320';
		} else {
			windowSizeRange = 'Unknown';
		}
		document.body.setAttribute('data-windowsize', windowSizeRange);
	}

	checkWindowSize()

	window.addEventListener('resize', () => {
		checkWindowSize()
	});

	// try {


	// 	// JavaScript код для виклику ajax-запиту
	// 	function loadForm(id) {
	// 		var url = '/api/form/render?id=' + id;

	// 		var xhr = new XMLHttpRequest();
	// 		xhr.open('GET', url, true);

	// 		xhr.onreadystatechange = function () {
	// 			if (xhr.readyState === 4 && xhr.status === 200) {
	// 				document.querySelector(".modal-form-content").innerHTML = xhr.responseText;
	// 				modalFormShow();
	// 			}
	// 		};

	// 		xhr.send();
	// 	}

	// 	// Отримання всіх елементів з класом render-form-btn
	// 	var buttons = document.querySelectorAll('.render-form-btn');

	// 	// Додавання обробника події для кожної кнопки
	// 	buttons.forEach(function (button) {
	// 		button.addEventListener('click', function () {
	// 			var id = this.getAttribute('data-form_id');
	// 			loadForm(id);
	// 		});
	// 	});
	// } catch (error) {

	// }
	const burgerMenuTrigger = document.querySelector('.burger-menu-trigger')
	const mobileMenu = document.querySelector('.mobile-menu')
	burgerMenuTrigger.addEventListener('click', ({target}) => {
		target.classList.toggle('active')
		mobileMenu.classList.toggle('show')
	})
})

