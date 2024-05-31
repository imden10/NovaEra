'use strict';

document.addEventListener("DOMContentLoaded", () => {
	const upButton = document.querySelector('.up');
	const burgerMenuTrigger = document.querySelector('.burger-menu-trigger');
	const mobileMenu = document.querySelector('.mobile-menu');
	// Helper functions
	const setWindowSizeRange = () => {
		const ranges = [
			{ min: 1280, value: '1440-1280' },
			{ min: 1024, max: 1279, value: '1279-1024' },
			{ min: 577, max: 1023, value: '1023-768' },
			{ max: 576, value: '567-320' }
		];
		const foundRange = ranges.find(r => (!r.max || window.innerWidth <= r.max) && (!r.min || window.innerWidth >= r.min)) || { value: 'Unknown' };
		document.body.setAttribute('data-windowsize', foundRange.value);
	};

	const handleScrollUpButton = () => {
		if (window.scrollY >= 1000) {
			upButton.classList.add('show');
		} else {
			upButton.classList.remove('show');
		}
	};

	const handleResize = () => setWindowSizeRange();

	const toggleBurgerMenu = (event) => {
		event.target.classList.toggle('active');
		mobileMenu.classList.toggle('show');
	};

	const setCookie = (name, value, days) => {
		const date = new Date();
		date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
		document.cookie = `${name}=${value};expires=${date.toUTCString()};path=/`;
	};

	const getCookie = (name) => {
		return document.cookie.split(';').map(cookie => cookie.trim()).find(cookie => cookie.startsWith(`${name}=`))?.split('=')[1] || null;
	};

	const toggleCookiePopup = (show) => {
		const popup = document.querySelector('.cookie-popup');
		popup?.classList.toggle('show', show);
	};

	const checkCookiesConsent = () => {
		if (!getCookie('cookieConsent')) {
			// Если cookie не установлены, добавляем HTML модалки
			const cookiePopupHTML = `
      <div class="cookie-popup show">
        <i class="close ic-close"></i>
        <h3>Файли Cookie</h3>
        <p>Файли cookie потрібні для того, щоб персоналізувати ваше користування сайтом та зробити його приємнішим і зручнішим.</p>
        <div class="btn primary lg fill">Дозволити всі Cookie <i class="ic-check-line"></i></div>
      </div>
      `;
			document.body.insertAdjacentHTML('beforeend', cookiePopupHTML);

			// Добавляем обработчики для кнопок сразу после добавления модалки
			const consentBtn = document.querySelector('.cookie-popup .btn');
			const closeBtn = document.querySelector('.cookie-popup .close');

			consentBtn.addEventListener('click', () => {
				setCookie('cookieConsent', 'true', 365);
				toggleCookiePopup(false);
			});

			closeBtn.addEventListener('click', () => {
				toggleCookiePopup(false);
			});
		}
	};


	// Initial setup
	setWindowSizeRange();
	checkCookiesConsent();

	try {
		upButton.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
	} catch (error) {
		console.warn(error);
	}
	burgerMenuTrigger.addEventListener('click', toggleBurgerMenu);

	// Event listeners
	window.addEventListener('scroll', handleScrollUpButton);
	window.addEventListener('resize', handleResize);

});
