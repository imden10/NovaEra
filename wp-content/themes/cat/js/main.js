var lastscrollpos = 0;
var showmenu = false;

$(".partners__container__item__img").hide();
$(document).ready(function(){
	$('.prikol').find('.col-md-12').addClass('col-md-4').removeClass('col-md-12');
	$('.reviewspage_wrap__title').hide();
	$('.categorieswrap__controlswrap__subwrp__allnapr').on('click', function() {
		$('.reviewspage_wrap__title').hide();
	});
	$('.directionitem_wrap').on('click', function(event) {
		$('.reviewspage_wrap__title').show();
	});



	//Пометить контейнер и айтемами соритровки
	$('*[data-sort-key]').closest('.row').addClass('sortcontainer');

	//Запомнить пропорции иконок партнёров
	$('.partners__container__item__img').each(function(index, element){
		var width = $(element).width();
		var height = $(element).height();
		$(element).attr('width', width).attr('height', height);
	});
	//Выставить размеры иконок партнёров
	resizepartner();

	//до после плгин
	$('.befafitem__imgwrap').twentytwenty({
		no_overlay: true
	});

	//Якорь вверх
	$('.upanchor').on('click', function(event){
		event.preventDefault();
		// var id = $(this).attr('href'),
		// 	dest = $(id).offset().top;
		$('body, html').animate({scrollTop: 0}, 1000);
	});

	//Показ меню
	$('.header-right__menutrigger').on('click', function(event){
		event.preventDefault();
		showmenu = !showmenu;
		$('header').addClass('fixedheader');
		$('header').addClass('fixedheader_show');
		$('.fullScrMenu').toggleClass('fullScrMenu_show');
		$(this).children('.lines').toggleClass('linesactive');
		$('.menu, .header-mid').toggleClass('headerMenuopened');
		$('.fullScrMenu__footer').toggleClass('headfotterMenuopened');
	});
	//Показ поиска
	$('.header-right__searchbtn').on('click', function(event){
		event.preventDefault();
		showmenu = !showmenu;
		$('header').addClass('fixedheader');
		$('header').addClass('fixedheader_show');
		$('.searchscreen').toggleClass('searchscreenactive');
		$('.fullScrMenu').removeClass('fullScrMenu_show');
		$('.linesactive').removeClass('linesactive');
		$(this).children('.lines').toggleClass('linesactive');
		$('.menu, .header-mid').toggleClass('headerMenuopened');
		$('.fullScrMenu__footer').toggleClass('headfotterMenuopened');
	});
	$('.searchcross, .mobsearchandlang__searchbtn').on('click', function(event){
		event.preventDefault();
		showmenu = !showmenu;
		$('header').addClass('fixedheader');
		$('header').addClass('fixedheader_show');
		$('.searchscreen').toggleClass('searchscreenactive');
		$(this).children('.lines').toggleClass('linesactive');
		$('.menu, .header-mid').toggleClass('headerMenuopened');
		$('.fullScrMenu__footer').toggleClass('headfotterMenuopened');
	});


	//Скролл к Сео секции
	// $('.catmainsec__desc__lnk').on('click', function(event){
	// 	event.preventDefault();
	// 	var id = $(this).attr('href'),
	// 		dest = $(id).offset().top;
	// 	$('body, html').animate({scrollTop: dest}, 1000);
	// });

	//Шеврон на сабменю
	$('.menu').find('.menu__sub2menu').each(function(index, element){
		$(element).closest('.menu__submenuitem').find('.menu__sublnkwrap').addClass('havesubm');
	});

	//Попап С картинкой. Появление Обычная галерея
	$('.galleryslider_wrap').on('click', '.galleryslider_item_img', function(){
		if($(this).parents('.center, .active').length == 0) return;
		var imgpath = $(this).attr('src');
		var html = '<div class="galleryimgbg"><div class="galleryimgbg__imgwrap"><img src="'+imgpath+'" alt="Image" class="galleryimgbg__img"><div class="galleryimgbg__close"><img src="/wp-content/themes/dental/img/crossslider.svg" alt="" class="galleryimgbg__close__ico"></div></div></div>';
		$('body').append(html);
	});
	//Попап С картинкой. Появление Кирпичная галерея
	$('.brickgallery_item').on('click', function(){
		var imgpath = $(this).find('.brickgallery_item__img').attr('src');
		var html = '<div class="galleryimgbg"><div class="galleryimgbg__imgwrap"><img src="'+imgpath+'" alt="Image" class="galleryimgbg__img"><div class="galleryimgbg__close"><img src="/wp-content/themes/dental/img/crossslider.svg" alt="" class="galleryimgbg__close__ico"></div></div></div>';
		$('body').append(html);
	});
	//Попап с картинкой. убирается
	$('body').on('click', '.galleryimgbg__close__ico', function(){
		$('.galleryimgbg').css('animation-name', 'hidepopupbg');
		setTimeout(function(){
			$('.galleryimgbg').remove();
		}, 300)
	});

	//ЗАкрытие модального окна
	$('body').on('click', '.modalclose, .fbclose', function(){
		// $('.modalbg, .leavefbbg').fadeOut();
		$('.leavefbbg').css('animation', 'fadeout 1s forwards')
		setTimeout(function(){
			$('.modalbg, .leavefbbg').css('display', 'none');
			$('body').removeClass('ovhidden');
		}, 1000);
	});

	//Клик по аккордеону
	$('.accorditem .heading').on('click', function(event){
		event.preventDefault();
		$(".accorditem").removeClass('active');
		$(this).closest('.accorditem').addClass('active');
	});
	//нициализировать аккордеон
	$('.accordion-group').simpleAccordion();

	//Маска телефонов
	// var input = $('.phonemask');
	// input.each(function(){
	// 	$(this).inputmask("(999) 999-99-99");
	// });

	//Клик по сортировочному radio
	$('.directionitem_wrap').on('click', function(event){
		event.preventDefault();
		$('.picked').removeClass('picked');
		$(this).addClass('picked');
		var ids = [];
		$('.picked').each(function(index, item){
			var val = $(item).attr('data-key-id');
			if(val != undefined)
				ids.push(val);
		});
		if (ids.length == 0){
			showSortItems();
		}
		else{
			sortItems(ids);
		}
	});
	//Сброс фильтра
	$('.categorieswrap__controlswrap__subwrp__allnapr').on('click', function(event){
		event.preventDefault();
		$('.picked').removeClass('picked');
		showSortItems();
	});

	//TEST
	//размеры артинок
	resizeimgs();
	//высота меню
	// getHeightMenu();
	//Высота видосов
	setVideoSize();
	//Убрать ненужный js
	cleanTrash();

	//Обработка клика нашеврон мобильного меню
	$('.menumob__item__arrowwrap').on('click', function(){
		$(this).toggleClass('active').closest('li').find('.menumob__submenu').slideToggle();
	});

	//test btn
	$('.slider_controls__prev').on('click', function(){
		$(this).closest('.sliderwraptrgt').find('.owl-carousel').each(function(index, element){
			$(element).trigger('prev.owl.carousel');
			hideCaseLeftSlides();
			hideReviewLeftSlides();
		});
	});
	$('.slider_controls__next').on('click', function(){
		$(this).closest('.sliderwraptrgt').find('.owl-carousel').each(function(index, element){
			$(element).trigger('next.owl.carousel');
			hideCaseLeftSlides();
			hideReviewLeftSlides();
		});
	});

	//Показать модалку отзыва
	$('#reviewmodalshow, .rev_sliderwrap__controllwrap__reviewadd, .add-review-in-service').on('click', function(event){
		event.preventDefault();
		reviewModalShow();
	})

	//Раскрыть сео текст
	$('.gomore__readall').on('click', function(event){
		event.preventDefault();
		$('.txtverticlimiter').addClass('expand');
		$(this).hide();
	});

	//Инициализация кирпичной галереи
	$('.brickgallery_wrap').masonry({
		columnWidth: '.brickgallery_item',
		itemSelector: '.brickgallery_item'
	});
	setTimeout( () => {
		$('.brickgallery_wrap').masonry({
			columnWidth: '.brickgallery_item',
			itemSelector: '.brickgallery_item'
		});
	}, 500);

	initWorkDoctorSlider();
	initSrvSlider();
	initGallerySlider();
	initHomeSliders();
	initDirectsSlider();
	initOtherpostsSlider();
	setsearchplaceholders();
	variablefz();
	cleanTrash();
});
function hideCaseLeftSlides(){
	$('.cases_sliderbg').find('.owl-item.active').prevAll('.owl-item').addClass("cases_sliderbg_item_Hidden");
	$('.cases_sliderbg').find('.owl-item.active').removeClass('cases_sliderbg_item_Hidden');
	$('.cases_sliderbg').find('.owl-item.active').nextAll('.owl-item').removeClass("cases_sliderbg_item_Hidden");
}
function hideReviewLeftSlides(){
	$('.rev_slider').find('.owl-item.active').prevAll('.owl-item').addClass("cases_sliderbg_item_Hidden");
	$('.rev_slider').find('.owl-item.active').removeClass('cases_sliderbg_item_Hidden');
	$('.rev_slider').find('.owl-item.active').nextAll('.owl-item').removeClass("cases_sliderbg_item_Hidden");
}


$(window).resize(function(){
	resizeimgs();
	resizepartner();
	// getHeightMenu();
	setVideoSize();
	setsearchplaceholders();
	variablefz();
});

$(window).on('scroll', function(){
	var scrollTop = window.pageYOffset ? window.pageYOffset : (document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop);
	try{
		if($(window).width() > 600){
			if ($(this).scrollTop() > $(window).height()){
				$('.upanchor').addClass('fixedbtn-active');
				$('.callbtn').addClass('fixedbtn-active');
				$('header').addClass('fixedheader');

				if(!showmenu){
					if(scrollTop < lastscrollpos){
						$('header').addClass('fixedheader_show');
						$('.callbtn').removeClass('fixedbtn-active');
					}
					else{
						$('header').removeClass('fixedheader_show');
					}
				}
			}
			else{
				$('.upanchor').removeClass('fixedbtn-active');
				$('.callbtn').removeClass('fixedbtn-active');
				if(!showmenu){
					$('header').removeClass('fixedheader');
					$('header').removeClass('fixedheader_show');
				}
			}
		}
		else{
			let offset = $('.firstbanner').height() + 65; 
			if ($(this).scrollTop() > offset){
				$('.upanchor').addClass('fixedbtn-active');
				$('.callbtn').addClass('fixedbtn-active');
				$('header').addClass('fixedheader');

				if(!showmenu){
					if(scrollTop < lastscrollpos){
						$('header').addClass('fixedheader_show');
						$('.callbtn').removeClass('fixedbtn-active');
					}
					else{
						$('header').removeClass('fixedheader_show');
					}
				}
			}
			else{
				$('.upanchor').removeClass('fixedbtn-active');
				$('.callbtn').removeClass('fixedbtn-active');
				if(!showmenu){
					$('header').removeClass('fixedheader');
					$('header').removeClass('fixedheader_show');
				}
			}
		}
	}
	catch(err){

	}
	
	$(".stockwrap").css('top',Number(scrollTop) + (Number($(window).height())/2));
	lastscrollpos = scrollTop;
});


function resizeimgs(){
	//services
	var bw = $('.dent-directs__item__imgwrap').width();
	var bh = bw * 0.82;
	$('.dent-directs__item__imgwrap').height(bh);

	//Postitem images
	var bw = $('.postitem__img').width();
	var bh = bw * 0.67;
	$('.postitem__img').height(bh);

	//crew / slider
	if($(window).width() > 720){
		var bw = $('.crewitem__imgwrap, .workdoctorssl_item__imgwrap').width();
		var bh = bw * 1.205;
		$('.crewitem__imgwrap, .workdoctorssl_item__imgwrap').height(bh);
	}
	else{
		var bw = $('.crewitem__imgwrap, .workdoctorssl_item__imgwrap').width();
		var bh = bw * 1.538;
		$('.crewitem__imgwrap, .workdoctorssl_item__imgwrap').height(bh);
	}

}
function resizepartner(){
	var contsize = $('.partners__container__item').width();
	$('.partners__container__item__img').each(function(index, element){
		var imgW = $(element).attr('width');
		var imgH = $(element).attr('height');
		if(Number(imgW) >= Number(imgH)){
			var sizeindex = imgH / imgW;
			$(element).width(contsize);
			$(element).height(contsize * sizeindex);
		}
		else{
			var sizeindex = imgW / imgH;
			$(element).height(contsize);
			$(element).width(contsize * sizeindex);
		}
	});
	$(".partners__container__item__img").delay(5000).show();
}

// Походу не надо
function getHeightMenu(){
	var height = $(window).height();
	$(".fullScrMenu").children('.container').css('height', height-160-50).css('overflow', 'auto');
}

function setVideoSize(){
	$('.vidwrap').each(function(index, element){
		var w = $(element).width();
		var h = w * 9 / 16;
		$(element).height(h);
	});
}

function initWorkDoctorSlider(){
	var itemcount = $('.workdoctorsslider').children('.workdoctorssl_item').length;
	var mob, tabl, def, fhd;
	switch(itemcount) {
		case 3:
			fhd = 3;
			def = 3;
			tabl = 2;
			mob = 1;
		break;
		case 2:
			fhd = 2;
			def = 2;
			tabl = 2;
			mob = 1;
		break;
		case 1:
			fhd = 1;
			def = 1;
			tabl = 1;
			mob = 1;
		break;
		default:
			fhd = 4;
			def = 3;
			tabl = 2;
			mob = 1;
		break;
	}
	$(".workdoctorsslider").owlCarousel({
		// items: 4,
		// mouseDrag: false,
		// touchDrag: false,
		onInitialized: resizeimgs,
		dots: true,
		nav: false,
		// loop: true,
		// center: true,
		responsive:{
			0:{
				items: mob
			},
			// 721
			568:{
				items: tabl
			},
			1151:{
				items: def
			},
			1600:{
				items: fhd
			}
		}
	});
}
// слайдер сортировки направлений
function initDirectsSlider(){
	$(".directionsslider").owlCarousel({
		// items: 4,
		// mouseDrag: false,
		// touchDrag: false,
		onInitialized: resizeimgs,
		dots: true,
		nav: false,
		// loop: true,
		// center: true,
		responsive:{
			0:{
				items: 1
			},
			340:{
				items: 2
			},
			485:{
				items: 3
			},
			721:{
				items: 4
			},
			1151:{
				items: 6
			},
			1600:{
				items: 8
			}
		}
	});
}
function initSrvSlider(){
	var itemcount = $('.usfsrvlslider').children('.usfsrvlslider_item').length;
	var mob, tabl, def, fhd;
	switch(itemcount) {
		case 4:
			fhd = 4;
			def = 4;
			tabl = 2;
			mob = 1;
		break;
		case 3:
			fhd = 3;
			def = 3;
			tabl = 2;
			mob = 1;
		break;
		case 2:
			fhd = 2;
			def = 2;
			tabl = 2;
			mob = 1;
		break;
		case 1:
			fhd = 1;
			def = 1;
			tabl = 1;
			mob = 1;
		break;
		default:
			fhd = 5;
			def = 4;
			tabl = 2;
			mob = 1;
		break;
	}
	$(".usfsrvlslider").owlCarousel({
		// items: 3,
		// mouseDrag: false,
		// touchDrag: false,
		dots: true,
		nav: false
		// loop: true
		// center: true
		,
		responsive:{
			0:{
				items: mob
			},
			// 721
			568:{
				items: tabl
			},
			1151:{
				items: def
			},
			1600:{
				items: fhd
			}
		}
	});
}
function initOtherpostsSlider(){
	$(".therpostsslider").owlCarousel({
		// items: 3,
		// mouseDrag: false,
		// touchDrag: false,
		dots: true,
		nav: false,
		onInitialized: resizeimgs
		// loop: true
		// center: true
		,
		responsive:{
			0:{
				items: 1
			},
			// // 721
			568:{
				items: 2
			},
			1151:{
				items: 3
			},
			1600:{
				items: 3
			}
		}
	});
}
function initGallerySlider(){
	var itemcount = $('.galleryslider').children('.galleryslider_item').length;
	var islooped = undefined;
	if(itemcount > 2)
		islooped = true;
	else
		islooped = false;

	$(".galleryslider").owlCarousel({
		items: 1,
		mouseDrag: false,
		touchDrag: false,
		// onTranslated: hideCaseLeftSlides,
		dots: true,
		nav: false,
		loop: islooped,
		autoWidth:true,
		center: true
	});
}
function initHomeSliders(){
	$(".cases_sliderbg").owlCarousel({
		items: 1,
		mouseDrag: false,
		touchDrag: false,
		// onTranslated: hideCaseLeftSlides,
		dots: false,
		nav: false,
		loop: true
	});
	$(".slidertext").owlCarousel({
		items: 1,
		mouseDrag: false,
		touchDrag: false,
		dots: false,
		nav: false,
		loop: true
	});

	$(".rev_slider").owlCarousel({
		items: 1,
		mouseDrag: false,
		touchDrag: false,
		dots: false,
		nav: false,
		// onTranslated: hideReviewLeftSlides,
		loop: true
	});
	hideCaseLeftSlides();
	hideReviewLeftSlides();
}

// ИНИЦИАЛИЗАЦИЯ КАРТЫ
var map;
function initMap() {
	var addr = {lat: 50.512203, lng: 30.492229};
	map = new google.maps.Map(document.getElementById('gmap1'), {
		center: addr,
		zoom: 16
	});
	var marker = new google.maps.Marker({position: addr, map: map, icon:'img/Pin.svg'});
}

// ОЧИСТИТЬ СКРИПТЫ В HTML
function cleanTrash(){
	$('.clean').remove();
}

// РАСТАВИТЬ ПЛЕЙСХОЛЖЕРЫ НА СТРАНИЦЕ ПОИСКА
function setsearchplaceholders(){
	var srvpholder = '<div class="col-lg-3 col-md-6 col-6 srvcolplaceholder"><div href="#" class="dent-directs__item placeholderService"></div></div>';
	var postpholder = '<div class="col-lg-4 col-md-6 col-sm-6 postcolplaceholder"><div class="postitem plaseholderPostitem"><div class="postitem__img"></div><div class="postitem__textwrap"></div></div></div>';
	$('.srvcolplaceholder, .postcolplaceholder').remove();
	if ($('.searchresults').length != 0){
		var width = $(window).width();
		var srvcount = $('.srvcol').length;
		var postcount = $('.postcol').length;
		//Для услуг
		if(width >= 1150){
			// var phcount = 4 - (srvcount % 4);
			var temp = (srvcount % 4)
			var phcount = (temp == 0 ? 0 : (4 - temp));
			for(var i = 1; i <= phcount; i++){
				$('.srvrow').append(srvpholder);
				console.log('Srv плейсхолджер кставел');
			}
		}
		else{
			var temp = (srvcount % 2)
			var phcount = (temp == 0 ? 0 : (2 - temp));
			// var phcount = 2 - (srvcount % 2);
			for(var i = 1; i <= phcount; i++){
				$('.srvrow').append(srvpholder);
			}
		}
		//Для постов
		if(width >= 1150){
			var temp = (postcount % 3)
			var phcount = (temp == 0 ? 0 : (3 - temp));
			for(var i = 1; i <= phcount; i++){
				$('.postrow').append(postpholder);
			}
		}
		else if(width<=1149 && width>=568){
			var temp = (postcount % 2)
			var phcount = (temp == 0 ? 0 : (2 - temp));
			for(var i = 1; i <= phcount; i++){
				$('.postrow').append(postpholder);
			}
		}
	}
}


// Паттерн проверки ФИ[О]
// var regExp = /^([А-ЯA-Z]|[А-ЯA-Z][\x27а-яa-z]{1,}|[А-ЯA-Z][\x27а-яa-z]{1,}\-([А-ЯA-Z][\x27а-яa-z]{1,}|(оглы)|(кызы)))\040[А-ЯA-Z][\x27а-яa-z]{1,}(\040[А-ЯA-Z][\x27а-яa-z]{1,})?$/;
// Паттерн проверки Имя
var regExp = /^[a-zA-Zа-яёА-ЯЁ]+$/u;

// Выбор звезды от 1 до 5
$('body').on('click', '.vatestar', function(){
	try{
		var val = Number($(this).data('val'));
		$('.fbform__vote').val(val);
		$('.vatestar').removeClass('picked');
		$('.vatestar').each(function(index){
			$(this).addClass('picked');
			if(index >= val-1) return false;
		});
	}
	catch(err){
		console.log(err);
	}
});

// ФОРМА ФИДБЕКА
var errorclass = 'inputerrorhighlight';
$('body').on('submit', '.fbform',function(event){
	//event.preventDefault();
	// $(this).find('*').removeClass('fberrorhighlight');
	var errors = [];
	var serialarray = $(this).serializeArray();
	var data = {};
	$(serialarray).each(function(index, obj){
		data[obj.name] = obj.value;
	});

	if(!regExp.test(data["fbname"])){
		errors.push("Некорректное имя");
		$('.fbform__name').addClass(errorclass);
	}
	else{
		data["fbname"] = data["fbname"].charAt(0).toUpperCase() + data["fbname"].slice(1);
	}
	if(data['fbphone'].indexOf('_') != -1){
		errors.push("Некорректный номер телефона");
		$('.fbform__phone').addClass(errorclass);
	}
	if(data['fbservice'] == ""){
		errors.push("Не выбранна услуга");
		$('.selectize-control').addClass(errorclass);
	}

	//     fberrorhighlight
	setTimeout(function() {
		$('.fbform__name').removeClass(errorclass);
		$('.fbform__phone').removeClass(errorclass);
		$('.fbform__name').removeClass(errorclass);
		$('.fbform__date').removeClass(errorclass);
		$('.selectize-control').removeClass(errorclass);
		$('.fbform__textarea').removeClass(errorclass);
	}, 2000);


	if(errors.length != 0)
		//console.log(errors);
		return false;
	else
		return true;
		//console.log(data);
});
// Для формы внизу страницы
$('.cformbanner__form').submit(function(event){
	//event.preventDefault();
	// $(this).find('*').removeClass('fberrorhighlight');
	var errors = [];
	var serialarray = $(this).serializeArray();
	var data = {};
	$(serialarray).each(function(index, obj){
		data[obj.name] = obj.value;
	});

	if(!regExp.test(data["name"])){
		errors.push("Некорректное имя");
		$('.cformbanner__form__name').addClass(errorclass);
	}
	else{
		data["name"] = data["name"].charAt(0).toUpperCase() + data["name"].slice(1);
	}
	if(data['phone'].indexOf('_') != -1 || data['phone'] == ""){
		errors.push("Некорректный номер телефона");
		$('.cformbanner__form__phone').addClass(errorclass);
	}
	if(data['srv'] == ""){
		errors.push("Не выбранна услуга");
		$('.selectize-control').addClass(errorclass);
	}

	//     fberrorhighlight
	setTimeout(function() {
		$('.cformbanner__form__name').removeClass(errorclass);
		$('.cformbanner__form__phone').removeClass(errorclass);
		$('.selectize-control').removeClass(errorclass);
	}, 2000);


	if(errors.length != 0)
		//console.log(errors);
		return false;
	else
		return true;
		//console.log(data);
});
// ДЛЯ ОСТАЛЬНЫХ ФОРМ НА СТРАНИЦАХ (НЕ МОДАЛ)
$('.formwrap__form').submit(function(event){
	//event.preventDefault();
	// $(this).find('*').removeClass('fberrorhighlight');
	var errors = [];
	var serialarray = $(this).serializeArray();
	var data = {};
	$(serialarray).each(function(index, obj){
		data[obj.name] = obj.value;
	});

	if(!regExp.test(data["name"])){
		errors.push("Некорректное имя");
		$('.formwrap__form__name').addClass(errorclass);
	}
	else{
		data["name"] = data["name"].charAt(0).toUpperCase() + data["name"].slice(1);
	}
	if(data['phone'].indexOf('_') != -1 || data['phone'] == ""){
		errors.push("Некорректный номер телефона");
		$('.formwrap__form__phone').addClass(errorclass);
	}
	if(data['srv'] == ""){
		errors.push("Не выбранна услуга");
		$('.selectize-control').addClass(errorclass);
	}

	//     fberrorhighlight
	setTimeout(function() {
		$('.formwrap__form__name').removeClass(errorclass);
		$('.formwrap__form__phone').removeClass(errorclass);
		$('.selectize-control').removeClass(errorclass);
	}, 2000);


	if(errors.length != 0)
		return false;
		//console.log(errors);
	else
		return true;
		//console.log(data);
});
// Для модалки перезвона
$('.modalcontentwrap__form').submit(function(event){
	//event.preventDefault();
	var errors = [];
	var serialarray = $(this).serializeArray();
	var data = {};
	$(serialarray).each(function(index, obj){
		data[obj.name] = obj.value;
	});
	console.log(data);
	if(!regExp.test(data["name"])){
		errors.push("Некорректное имя");
		$('.modalcontentwrap__form__name').addClass(errorclass);
	}
	else{
		data["name"] = data["name"].charAt(0).toUpperCase() + data["name"].slice(1);
	}
	if(data['phone'].indexOf('_') != -1 || data['phone'] == ""){
		errors.push("Некорректный номер телефона");
		$('.modalcontentwrap__form__phone').addClass(errorclass);
	}
	if(data['srv'] != undefined){
		if(data['srv'] == ""){
			errors.push("Не выбранна услуга");
			$('.selectize-control').addClass(errorclass);
		}
	}



	//     fberrorhighlight
	setTimeout(function() {
		$('.modalcontentwrap__form__name').removeClass(errorclass);
		$('.modalcontentwrap__form__phone').removeClass(errorclass);
		$('.selectize-control').removeClass(errorclass);
	}, 2000);

	if(errors.length != 0)
		return false;
		//console.log(errors);
	else
		return true;
		//console.log(data);
});

function reviewModalShow(){
	$('.leavefbbg').css('animation', 'fadein 1s forwards').css('display', 'flex');
	$('body').addClass('ovhidden');
}


function variablefz(){
	//.variablefz
	$('.variablefz').each(function(){
		$(this).css('font-size', '');
		var fz = parseFloat($(this).css('font-size'));
		var lh = parseFloat($(this).css('line-height'));
		var height = $(this).height();
		// console.log('Изначальный размер шрифта '+ fz);
		// console.log('Изначальная высота строки '+ lh);
		// console.log('Суммарная высота заголовка( по сути высота всех строк) '+ height);
		var lines = Math.round(height / lh);
		// console.log('строки кол-во'+lines);

		//lines - колво строк
		if($(window).width() > 568){
			switch (lines){
				case 1:
					$(this).css("font-size", 60);
					$(this).css("line-height", 62+'px');
					break;
				case 2:
					$(this).css("font-size", 46);
					$(this).css("line-height", 48+'px');
					break;
				case 3:
					$(this).css("font-size", 38);
					$(this).css("line-height", 40+'px');
					break;

				// если не 1 не 2 и не 3 тогда...
				default:
					$(this).css("font-size", 36);
					$(this).css("line-height", 38+'px');
					break;
			}
		}
		else{
			switch (lines){
				case 1:
					$(this).css("font-size", 42);
					$(this).css("line-height", 44+'px');
					break;
				case 2:
					$(this).css("font-size", 32);
					$(this).css("line-height", 34+'px');
					break;
				case 3:
					$(this).css("font-size", 28);
					$(this).css("line-height", 30+'px');
					break;

				// если не 1 не 2 и не 3 тогда...
				default:
					$(this).css("font-size", 26);
					$(this).css("line-height", 28+'px');
					break;
			}
		}
	});
}

// Открытие input file на форме фидбека
$('body').on('click', '.fbform__imgloadwrap', function(){
	showOpenFileDialog();
});
function showOpenFileDialog(){
	$('#photoinput').click();
}
$('body').on('change', '#photoinput', function(){
	var input = $("#photoinput")[0];
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
			$('.fbform__imgload').css('opacity', 0);
			$('.fbform__imgloadwrap').css('background', 'no-repeat center/cover url('+e.target.result+')');
		}
		reader.readAsDataURL(input.files[0]);
	}
});

function sortItems(ids){
	// отобразить все
	showSortItems();
	// убрать лишнее
	var havedocs = false;
	$('*[data-sort-key]').each(function(index, item){
		var groupids = $(item).attr('data-sort-key').split(',');
		// console.log(groupids);
		for (var i = ids.length - 1; i >= 0; i--) {
			for (var j = groupids.length - 1; j >= 0; j--) {
				if (ids[i] == groupids[j]) {
					havedocs = true;
					return true;
				}
			}
		}
		$(item).css('display', 'none');
	});
	if(!havedocs){
		// alert('Докторов нет');
		$('.sortcontainer').append('<span class="sortnothing">Сортировка не дала результатов.</span>')
	}
}
function showSortItems(){
	$('*[data-sort-key]').css('display', 'block');
	$('.sortnothing').remove();
}

/////////////////////////////////////
/////////////////////////////////////
//Аккордеон фреймворк
;(function ($, window, document, undefined) {
	"use strict";
	var pluginName = 'simpleAccordion',
	defaults = {
		multiple: false,
		speedOpen: 1000,
		speedClose: 1000,
		easingOpen: null,
		easingClose: null,
		headClass: 'accordion-header',
		bodyClass: 'accordion-body',
		openClass: 'open',
		defaultOpenClass: 'default-open',
		cbClose: null, //function (e, $this) {},
		cbOpen: null //function (e, $this) {}
	};
	function Accordion(element, options) {
	    this.$el = $(element);
	    this.options = $.extend({}, defaults, options);
	    this._defaults = defaults;
	    this._name = pluginName;
	    if (typeof this.$el.data('multiple') !== 'undefined') {
	        this.options.multiple = this.$el.data('multiple');
			} else {
	        this.options.multiple = this._defaults.multiple;
		}
	    this.init();
	}
	Accordion.prototype = {
	    init: function () {
	        var o = this.options,
			$headings = this.$el.children('.' + o.headClass);
	        $headings.on('click', {_t:this}, this.headingClick);
	        $headings.filter('.' + o.defaultOpenClass).first().click();
		},
	    headingClick: function (e) {
	        var $this = $(this),
			_t = e.data._t,
			o = _t.options,
			$headings = _t.$el.children('.' + o.headClass),
			$currentOpen = $headings.filter('.' + o.openClass);
	        if (!$this.hasClass(o.openClass)) {
	            if ($currentOpen.length && o.multiple === false) {
	                $currentOpen.removeClass(o.openClass).next('.' + o.bodyClass).slideUp(o.speedClose, o.easingClose, function () {
	                    if ($.isFunction(o.cbClose)) {
	                        o.cbClose(e, $currentOpen);
						}
	                    $this.addClass(o.openClass).next('.' + o.bodyClass).slideDown(o.speedOpen, o.easingOpen, function () {
	                        if ($.isFunction(o.cbOpen)) {
	                            o.cbOpen(e, $this);
							}
						});
					});
					} else {
	                $this.addClass(o.openClass).next('.' + o.bodyClass).slideDown(o.speedOpen, o.easingOpen, function () {
	                    $this.removeClass(o.defaultOpenClass);
	                    if ($.isFunction(o.cbOpen)) {
	                        o.cbOpen(e, $this);
						}
					});
				}
				} else {
	            /*$this.removeClass(o.openClass).next('.' + o.bodyClass).slideUp(o.speedClose, o.easingClose, function () {
	                if ($.isFunction(o.cbClose)) {
	                    o.cbClose(e, $this);
					}
				});*/
			}
		}
	};
	$.fn[pluginName] = function (options) {
	    return this.each(function () {
	        if (!$.data(this, 'plugin_' + pluginName)) {
	            $.data(this, 'plugin_' + pluginName,
				new Accordion(this, options));
			}
		});
	};
}(jQuery, window, document));

