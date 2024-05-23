document.addEventListener("DOMContentLoaded", () => {
	'use strict';
	// document.body.setAttribute('data-theme', 'nova-era')
	// document.body.setAttribute('data-mode', 'light')
	// document.body.setAttribute('data-windowsize', '1440-1280')
	// global variables
	let windowSizeRange;
	let windowSize = window.innerWidth;
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


	const form = document.querySelector('.form');
	form.addEventListener('submit', function (event) {
		event.preventDefault();
		const formData = new FormData(form);

		// Собрать данные в объект
		const data = {};
		formData.forEach((value, key) => {
			data[key] = value;
		});

		console.log(data);

		// Отправить данные через fetch или другим способом
		fetch('your-server-endpoint', {
			method: 'POST',
			body: JSON.stringify(data),
			headers: {
				'Content-Type': 'application/json'
			}
		})
			.then(response => response.json())
			.then(data => {
				console.log('Success:', data);
			})
			.catch(error => {
				console.error('Error:', error);
			});
	});



	const burgerMenuTrigger = document.querySelector('.burger-menu-trigger')
	const mobileMenu = document.querySelector('.mobile-menu')
	burgerMenuTrigger.addEventListener('click', ({ target }) => {
		target.classList.toggle('active')
		mobileMenu.classList.toggle('show')
	})
})

