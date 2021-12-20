import $ from 'jquery';
window.$ = window.jQuery = $;
import 'jquery.maskedinput/src/jquery.maskedinput.js'
require('lightbox2/dist/js/lightbox.min.js');

$(document).ready(function($) {
  const preloader = document.getElementById('preloader');

  setTimeout( () => {
      preloader.classList.add('fade')
  }, 500);

  let IS_MOBILE = true,
      IS_OPEN_MODAL = false;

  if ($( window ).width() > 767) {
    IS_MOBILE = false;
  }

  // header
  if (!IS_MOBILE) {
    const offsetTop = $('main').offset().top;
    $(window).on('scroll', function() {
      if ($(this).scrollTop() > offsetTop) {
        $('.header').addClass("header_fixed")
      } else {
        $('.header').removeClass("header_fixed")
      }
    })
  }

  // mobile menu
  $('[data-js-action="toggle-menu"]').on("click", function() {
    $('[data-js-action="mobile-menu"]').toggleClass("mobile-nav_active");
    $(document.body).toggleClass('modal-open')
  })

  $('.js-mobile-toggle').on("click", function(e) {
    e.preventDefault();
    $('.js-mobile-toggle').not(this).next('.js-mobile-dropdown').slideUp();

    $(this).toggleClass('js-active');
    if ($(this).hasClass('js-active')) {
      $(this).next('.js-mobile-dropdown').slideDown();
    } else {
      $(this).next('.js-mobile-dropdown').slideUp();
    }
  })

  $('.ajax-form').on('ajaxSuccess', function(event) {
    event.currentTarget.reset();
  });

  function getScrollBarWith() {
    const documentWidth = parseInt(document.documentElement.clientWidth);
    const windowsWidth = parseInt(window.innerWidth);
    return windowsWidth - documentWidth;
  }

  function setOffset(elem, width = 0) {
    elem.style.paddingRight = `${width}px`;
    if ($(".header").hasClass("header_fixed")) {
      $('[data-js-action="header"]').css({'margin-right': width + 'px'});
    }
    if ($(".button-up").hasClass("button-up_active")) {
      $('.button-up').css({'margin-right': width + 'px'});
    }
  }

  function setModalTitle(value) {
    $('[data-modal="title"]').text(value);
  }

	$('.popup-open').click(function() {
    const bodyOffset = getScrollBarWith();
		$('.popup-fade').fadeIn();
    $(document.body).addClass('modal-open');
    setOffset(document.body, bodyOffset);

    let popupTitle = "Оставить заявку";
    const btnDataTitle = $(this).data('title');
    if (btnDataTitle) {
      $('[data-form="product-name"]').val(btnDataTitle);
      popupTitle = `Заказать: ${btnDataTitle}`;
    }

    setModalTitle(popupTitle);
    return false;
	});

	$('.popup-close').click(function() {
		$(this).parents('.popup-fade').fadeOut();
    $(document.body).removeClass('modal-open');
    setOffset(document.body);
		return false;
	});

	$(document).keydown(function(e) {
		if (e.keyCode === 27) {
			e.stopPropagation();
			$('.popup-fade').fadeOut();
      $(document.body).removeClass('modal-open');
      setOffset(document.body);
		}
	});

	$('.popup-fade').click(function(e) {
		if ($(e.target).closest('.popup').length == 0) {
			$(this).fadeOut();
      $(document.body).removeClass('modal-open');
      setOffset(document.body);
		}
  });


    $('.post-1').wrapAll('<div class="col-lg-5">');
    $('.post-2, .post-3').wrapAll('<div class="col-lg-7">');
    $('.phone__mask').mask("8(999)999-99-99");

    $('li.has-child > a').on('click', function(e){

        $(this).siblings('.sub-menu').slideToggle();
        $(this).parent('li').toggleClass('open');
        e.preventDefault();
        e.stopPropagation();
    });

//yandex map

const spinner = $('.ymap-container').children('.loader');
let check_if_load = false;

//Функция создания карты сайта и затем вставки ее в блок с идентификатором &#34;map-yandex&#34;
function init () {
  var myMapTemp = new ymaps.Map("map", {
    center: [48.661867, 44.461890], // координаты центра на карте
    zoom: 15, // коэффициент приближения карты
    controls: ['zoomControl', 'fullscreenControl'] // выбираем только те функции, которые необходимы при использовании
  });
  var myPlacemarkTemp = new ymaps.Placemark([48.661867, 44.461890], {
      balloonContent: "<b>Промпак</b> <br>400019, г. Волгоград, ул. Слесарная, д.103",
  }, {
      // Опции.
      // Необходимо указать данный тип макета.
      iconLayout: 'default#imageWithContent',
      // Своё изображение иконки метки.
      iconImageHref: 'themes/voltager/assets/icons/map.svg',
      // Размеры метки.
      iconImageSize: [60, 60],
      // Смещение левого верхнего угла иконки относительно
      // её "ножки" (точки привязки).
      iconImageOffset: [-25, -50],
  });
  myMapTemp.geoObjects.add(myPlacemarkTemp); // помещаем флажок на карту

  // Получаем первый экземпляр коллекции слоев, потом первый слой коллекции
  var layer = myMapTemp.layers.get(0).get(0);

  // Решение по callback-у для определения полной загрузки карты
  waitForTilesLoad(layer).then(function() {
    // Скрываем индикатор загрузки после полной загрузки карты
    spinner.removeClass('is-active');
  });
}

// Функция для определения полной загрузки карты (на самом деле проверяется загрузка тайлов)
function waitForTilesLoad(layer) {
  return new ymaps.vow.Promise(function (resolve, reject) {
    var tc = getTileContainer(layer), readyAll = true;
    tc.tiles.each(function (tile, number) {
      if (!tile.isReady()) {
        readyAll = false;
      }
    });
    if (readyAll) {
      resolve();
    } else {
      tc.events.once("ready", function() {
        resolve();
      });
    }
  });
}

function getTileContainer(layer) {
  for (var k in layer) {
    if (layer.hasOwnProperty(k)) {
      if (
        layer[k] instanceof ymaps.layer.tileContainer.CanvasContainer
        || layer[k] instanceof ymaps.layer.tileContainer.DomContainer
      ) {
        return layer[k];
      }
    }
  }
  return null;
}

// Функция загрузки API Яндекс.Карт по требованию (в нашем случае при наведении)
function loadScript(url, callback){
  var script = document.createElement("script");

  if (script.readyState){  // IE
    script.onreadystatechange = function(){
      if (script.readyState == "loaded" ||
              script.readyState == "complete"){
        script.onreadystatechange = null;
        callback();
      }
    };
  } else {  // Другие браузеры
    script.onload = function(){
      callback();
    };
  }

  script.src = url;
  document.getElementsByTagName("head")[0].appendChild(script);
}

// Основная функция, которая проверяет когда мы навели на блок с классом &#34;ymap-container&#34;
var ymap = function() {
  $('.ymap-container').mouseenter(function(){
      if (!check_if_load) { // проверяем первый ли раз загружается Яндекс.Карта, если да, то загружаем

	  	// Чтобы не было повторной загрузки карты, мы изменяем значение переменной
        check_if_load = true;

		// Показываем индикатор загрузки до тех пор, пока карта не загрузится
        spinner.addClass('is-active');

		// Загружаем API Яндекс.Карт
        loadScript("//api-maps.yandex.ru/2.1/?lang=ru_RU&amp;loadByRequire=1", function(){
           // Как только API Яндекс.Карт загрузились, сразу формируем карту и помещаем в блок с идентификатором &#34;map-yandex&#34;
           ymaps.load(init);
        });
      }
    }
  );
}

$(function() {

//Запускаем основную функцию
    ymap();

});

});