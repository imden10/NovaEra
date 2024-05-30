'use strict';

document.addEventListener("DOMContentLoaded", () => {
	const upButton = document.querySelector('.up');
	const burgerMenuTrigger = document.querySelector('.burger-menu-trigger');
	const mobileMenu = document.querySelector('.mobile-menu');
	const buttons = document.querySelectorAll('.render-form-btn');

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

	const initializeMask = () => {
		const elements = document.querySelectorAll('.phone');
		const maskOptions = {
			mask: '+{38}0-0000-00-000'
		};
		elements.forEach(el => {
			IMask(el, maskOptions);
		});
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

	const loadForm = (id) => {
		fetch(`/api/form/render?id=${id}`)
			.then(response => {
				if (response.ok) return response.text();
				throw new Error(`Request failed with status ${response.status}`);
			})
			.then(html => {
				const container = document.querySelector(".modal-form-content");
				container.innerHTML = html;

				// Удаляем старые скрипты, которые были добавлены ранее
				const oldScripts = document.querySelectorAll('.dynamic-script');
				oldScripts.forEach(script => script.remove());

				// Добавляем новые скрипты
				const scripts = container.getElementsByTagName('script');
				for (let i = 0; i < scripts.length; i++) {
					const script = document.createElement('script');
					script.classList.add('dynamic-script'); // Добавляем класс для идентификации динамически добавленных скриптов
					if (scripts[i].src) {
						script.src = scripts[i].src;
					} else {
						script.innerHTML = scripts[i].innerHTML;
					}
					document.head.appendChild(script);
				}
				localStorage.setItem('isModalFormOpen', true);
				// getFormData(id);
				modalFormShow();
				initializeMask();
			})
			.catch(error => console.error('Error loading form:', error));
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

	const attachFormButtonClickHandlers = () => {
		buttons.forEach(button => {
			button.addEventListener('click', (e) => {
				e.preventDefault();
				const id = button.getAttribute('data-form_id');
				loadForm(id);
			});
		});
	};

	// Initial setup
	setWindowSizeRange();
	checkCookiesConsent();
	attachFormButtonClickHandlers();
	initializeMask();
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
