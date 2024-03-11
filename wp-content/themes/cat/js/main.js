document.addEventListener("DOMContentLoaded", () => {
	'use strict';
	document.body.setAttribute('data-theme', 'green-violet')
	document.body.setAttribute('data-mode', 'light')
	document.body.setAttribute('data-windowsize', '1440-1280')
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
})