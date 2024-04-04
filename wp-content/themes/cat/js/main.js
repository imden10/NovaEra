document.addEventListener("DOMContentLoaded", () => {
	'use strict';
	document.body.setAttribute('data-theme', 'green-violet')
	// document.body.setAttribute('data-mode', 'light')
	document.body.setAttribute('data-windowsize', '1440-1280')
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
	document.querySelector('.startFunc').addEventListener('click', changeTheme)
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

	const modeBtns = document.querySelectorAll('.mode')

	modeBtns.forEach(el => {
		el.addEventListener('click', () => {
			document.body.setAttribute('data-mode', el.getAttribute('data-mode'))
		})
	});

	const colorBtns = document.querySelectorAll('.color')
	const simpleText = document.querySelector('.simple-text')

	colorBtns.forEach(el => {
		el.addEventListener('click', () => {
			const color = el.innerHTML
			simpleText.id = color
		})
	});

})