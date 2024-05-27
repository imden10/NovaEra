// TODO refactor this file
document.addEventListener("DOMContentLoaded", () => {
	'use strict';
	// global variables
	let windowSizeRange;
	let windowSize = window.innerWidth;
	const upButton = document.querySelector('.up');
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

	function handleScroll() {
		if (window.scrollY >= 1000) {
			upButton.classList.add('show');
		} else {
			upButton.classList.remove('show');
		}
	}
	try {
		upButton.addEventListener('click', e => {
			window.scrollTo({
				top: 0,
				behavior: 'smooth'
			});
		})
	} catch (error) {

	}
	window.addEventListener('scroll', handleScroll);
	window.addEventListener('resize', () => {
		checkWindowSize()
	});


	const burgerMenuTrigger = document.querySelector('.burger-menu-trigger')
	const mobileMenu = document.querySelector('.mobile-menu')
	burgerMenuTrigger.addEventListener('click', ({ target }) => {
		target.classList.toggle('active')
		mobileMenu.classList.toggle('show')
	})

	// Функция для установки куки
	function setCookie(name, value, days) {
		const date = new Date();
		date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
		const expires = "expires=" + date.toUTCString();
		document.cookie = name + "=" + value + ";" + expires + ";path=/";
	}

	// Функция для получения значения куки по имени
	function getCookie(name) {
		const nameEQ = name + "=";
		const ca = document.cookie.split(';');
		for (let i = 0; i < ca.length; i++) {
			let c = ca[i];
			while (c.charAt(0) === ' ') c = c.substring(1, c.length);
			if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
		}
		return null;
	}

	// Функция для показа/скрытия модалки
	function toggleCookiePopup(show) {
		const popup = document.querySelector('.cookie-popup');
		if (popup) {
			if (show) {
				popup.classList.add('show');
			} else {
				popup.classList.remove('show');
			}
		}
	}

	try {
		function getFormData(id) {
			var url = '/api/form/get-data?id=' + id;

			var xhr = new XMLHttpRequest();
			xhr.open('GET', url, true);

			xhr.onreadystatechange = function () {
				if (xhr.readyState === 4 && xhr.status === 200) {
					// console.log(xhr.responseText);
				}
			};

			xhr.send();
		}

		function loadForm(id) {
			var url = '/api/form/render?id=' + id;
			var xhr = new XMLHttpRequest();
			xhr.open('GET', url, true);

			xhr.onreadystatechange = function () {
				if (xhr.readyState === 4 && xhr.status === 200) {
					var container = document.querySelector(".modal-form-content");
					container.innerHTML = xhr.responseText;

					var scripts = container.getElementsByTagName('script');
					for (var i = 0; i < scripts.length; i++) {
						var script = document.createElement('script');
						if (scripts[i].src) {
							script.src = scripts[i].src;
						} else {
							script.innerHTML = scripts[i].innerHTML;
						}
						document.head.appendChild(script);
					}

					getFormData(id);
					modalFormShow();
				}
			};

			xhr.send();
		}

		// Отримання всіх елементів з класом render-form-btn
		const buttons = document.querySelectorAll('.render-form-btn');
		// Додавання обробника події для кожної кнопки
		buttons.forEach(function (button) {
			button.addEventListener('click', function () {
				const id = this.getAttribute('data-form_id');
				loadForm(id);
			});
		});
	} catch (error) {

	}

	// Проверяем, установлены ли куки
	if (!getCookie('cookieConsent')) {
		// Если куки не установлены, добавляем HTML модалки
		const cookiePopupHTML = `
				<div class="cookie-popup show">
					<i class="close ic-close"></i>
					<h3>Файли Cookie</h3>
					<p>Файли cookie потрібні для того, щоб персоналізувати ваше користування Порталом та зробити його приємнішим і зручнішим.</p>
					<div class="btn primary lg fill">Дозволити всі Cookie <i class="ic-check-line"></i></div>
				</div>
			`;
		document.body.insertAdjacentHTML('beforeend', cookiePopupHTML);

		// Добавляем обработчики для кнопок сразу после добавления модалки
		document.querySelector('.cookie-popup .btn').addEventListener('click', function () {
			setCookie('cookieConsent', 'true', 365);
			toggleCookiePopup(false);
		});

		document.querySelector('.cookie-popup .close').addEventListener('click', function () {
			toggleCookiePopup(false);
		});
	}
})

