/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./node_modules/share-buttons/dist/share-buttons.js":
/*!**********************************************************!*\
  !*** ./node_modules/share-buttons/dist/share-buttons.js ***!
  \**********************************************************/
/***/ (function(module) {

!function(e,t){ true?module.exports=t():0}(this,function(){"use strict";var f=window,m=f.document;var e=new function(){function s(e,n){return e.replace(/\{(\d+)\}/g,function(e,t){return n[t]||e})}function u(e){return e.join(" - ")}function l(e){return encodeURIComponent(e)}this.i=function(){var e,t=m.querySelectorAll(".share-btn");for(e=t.length;e--;)n(t[e])};var n=function(e){var t,n=e.querySelectorAll("a");for(t=n.length;t--;)r(n[t],{id:"",url:i(e),title:c(e),desc:o(e)})},r=function(e,t){t.id=h(e,"data-id"),t.id&&a(e,"click",t)},i=function(e){return h(e,"data-url")||location.href||" "},c=function(e){return h(e,"data-title")||m.title||" "},o=function(e){var t=m.querySelector("meta[name=description]");return h(e,"data-desc")||t&&h(t,"content")||" "},a=function(e,t,n){function r(){d(n.id,n.url,n.title,n.desc)}e.addEventListener?e.addEventListener(t,r):e.attachEvent("on"+t,function(){r.call(e)})},h=function(e,t){return e.getAttribute(t)},d=function(e,t,n,r){var i=l(t),c=l(r),o=l(n),a=o||c||"";switch(e){case"fb":p(s("https://www.facebook.com/sharer/sharer.php?u={0}&quote={1}",[i,o]),n);break;case"vk":p(s("https://vk.com/share.php?url={0}&title={1}",[i,u([o,c])]),n);break;case"tw":p(s("https://twitter.com/intent/tweet?url={0}&text={1}",[i,u([o,c])]),n);break;case"tg":p(s("https://t.me/share/url?url={0}&text={1}",[i,u([o,c])]),n);break;case"pk":p(s("https://getpocket.com/edit?url={0}&title={1}",[i,u([o,c])]),n);break;case"re":p(s("https://reddit.com/submit?url={0}&title={1}",[i,o]),n);break;case"ev":p(s("https://www.evernote.com/clip.action?url={0}&t={1}",[i,o]),n);break;case"in":p(s("https://www.linkedin.com/shareArticle?mini=true&url={0}&title={1}&summary={2}&source={0}",[i,o,u([o,c])]),n);break;case"pi":p(s("https://pinterest.com/pin/create/button/?url={0}&media={0}&description={1}",[i,u([o,c])]),n);break;case"sk":p(s("https://web.skype.com/share?url={0}&source=button&text={1}",[i,u([o,c])]),n);break;case"wa":p(s("https://wa.me/?text={0}%20{1}",[u([o,c]),i]),n);break;case"ok":p(s("https://connect.ok.ru/dk?st.cmd=WidgetSharePreview&service=odnoklassniki&st.shareUrl={0}",[i]),n);break;case"tu":p(s("https://www.tumblr.com/widgets/share/tool?posttype=link&title={0}&caption={0}&content={1}&canonicalUrl={1}&shareSource=tumblr_share_button",[u([o,c]),i]),n);break;case"hn":p(s("https://news.ycombinator.com/submitlink?t={0}&u={1}",[u([o,c]),i]),n);break;case"xi":p(s("https://www.xing.com/app/user?op=share;url={0};title={1}",[i,u([o,c])]),n);break;case"mail":0<o.length&&0<c.length&&(a=u([o,c])),0<i.length&&(a=a+" / "+i),location.href=s("mailto:?subject={0}&body={1}",[o,a]);break;case"print":window.print()}},p=function(e,t){var n=void 0!==f.screenLeft?f.screenLeft:screen.left,r=void 0!==f.screenTop?f.screenTop:screen.top,i=(f.innerWidth||m.documentElement.clientWidth||screen.width)/2-300+n,c=(f.innerHeight||m.documentElement.clientHeight||screen.height)/3-400/3+r,o=f.open(e,"",s("resizable,toolbar=yes,location=yes,scrollbars=yes,menubar=yes,width={0},height={1},top={2},left={3}",[600,400,c,i]));null!==o&&o.focus&&o.focus()}};return e.i(),{update:function(){e.i()}}});

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!*********************************!*\
  !*** ./resources/fe/js/main.js ***!
  \*********************************/
// -----------------------------------------------------------------------------
// This file contains all main js.
// -----------------------------------------------------------------------------
// var $ = require('jquery');
// window.$ = $;
__webpack_require__(/*! share-buttons/dist/share-buttons */ "./node_modules/share-buttons/dist/share-buttons.js");

$(document).ready(function () {
  var testprice = 10000;

  function tesdiscount(testprice, tesamount) {
    var testprice = testprice - testprice * tesamount;
    return testprice;
  }

  tesdiscount(testprice, 0.25); // alert(testprice)

  $('.tesnumbernya').html(testprice);
  var datateks = ["Arief membeli apel 2 buah.", "Arief membeli apel 2 buah.", "Dewi membeli kelereng 3 biji.", "Silvi menukar sawi 2 buah."];
  var str = 'Arief membeli apel 2 buah, Arief membeli apel 2 buah, Dewi membeli kelereng 3 biji, Silvi menukar sawi 2 buah'; // alert(str.match(/buah\w*/g));

  var tesproduct = {
    name: 'towel',
    price: 6000
  };
  $('.tesproduknya').html(tesproduct.price);
  $(".containertes .btn-show").click(function () {
    alert("berhasil");
  });
  $('.dropdown-item-vegan.active').parent().prev().addClass('active');
  var mxHght = $(window).height();
  var hgtHeader = $('#hgt-header').height();
  var hgtHeaderMob = $('#hgt-headermob').height();
  var height_search = mxHght - (hgtHeader + 50);
  $('#globalSearchResult').css('max-height', height_search);
  /********************************/

  /*Set only first name user*/

  /********************************/

  var totalWords = $('#namauser').data('nama');
  var firstWord = totalWords.replace(/ .*/, '');
  $('#setnamauser').text(firstWord);
  /********************************/

  /*Get Thumbnail Video*/

  /********************************/

  function generateThumbnail() {
    if (Math.round($("video")[0].currentTime) % 5 != 0) return; //only draw if its a 5th second!!!

    var context = canvas.getContext('2d');
    context.drawImage(video, 0, 0, 220, 150);
    var dataURL = canvas.toDataURL();
    var img = document.createElement('img');
    img.setAttribute('src', dataURL);
    document.getElementById('thumbnailContainer').appendChild(img);
  }

  $("video").bind('play', function () {
    thumbnailing = setInterval(function () {
      generateThumbnail();
    }, 1000);
  });
  $("video").bind('pause', function () {
    clearInterval(thumbnailing);
  });
  /********************************/

  /*Change format constant number*/

  /********************************/

  var kFormatter = function kFormatter(num) {
    if (Math.abs(num) > 999 && Math.abs(num) < 1000000) {
      return "".concat(Math.sign(num) * (Math.abs(num) / 1000).toFixed(1), " RB");
    } else if (Math.abs(num) > 999999 && Math.abs(num) < 1000000000) {
      return "".concat(Math.sign(num) * (Math.abs(num) / 1000000).toFixed(1), " JT");
    } else if (Math.abs(num) > 999999999 && Math.abs(num) < 1000000000000) {
      return "".concat(Math.sign(num) * (Math.abs(num) / 1000000000).toFixed(1), " 'M");
    } else if (Math.abs(num) > 999999999999) {
      return "".concat(Math.sign(num) * (Math.abs(num) / 1000000000000).toFixed(1), " T");
    } else {
      return "".concat(Math.sign(num) * Math.abs(num));
    }
  };

  $(".constantformatnumber").each(function () {
    var getNumberCs = kFormatter(parseInt($(this).data('content')));
    $(this).html(getNumberCs);
  });
  /********************************/

  /*Change format constant number for cart & notif*/

  /********************************/

  var kFormatterCN = function kFormatterCN(num) {
    if (Math.abs(num) > 99) {
      return '99+';
    } else {
      return "".concat(Math.abs(num));
    }
  };

  $(".constantformatnumberCN").each(function () {
    var getNumberCs = kFormatterCN(parseInt($(this).data('content')));
    $(this).html(getNumberCs);
  });
  /********************************/

  /*Resize input select for sorting menu*/

  /********************************/

  $("select.resizeselect").change(function () {
    var arrowWidth = 30;
    var $this = $(this);
    var text = $this.find("option:selected").text();
    var $test = $("<span>").html(text).css({
      "font-size": $this.css("font-size"),
      "visibility": "hidden"
    });
    $test.appendTo($this.parent());
    var width = $test.width();
    $test.remove();
    $this.width(width + arrowWidth);
  });
  /********************************/

  /*Show & Hide global mask*/

  /********************************/

  $(window).click(function () {
    if ($(this).attr('aria-expanded') === "false") {
      $(this).parent().addClass('--active');
      $('#globalMask').show();
    } else {
      $(this).parent().removeClass('--active');
      $('#globalMask').hide();
      $('#globalSearchResult').hide();
    }

    if ($("#globalSearch").is(":focus")) {
      $('#globalMask').show();
      $(".drpmnu-oz").attr('aria-expanded', 'false');
    } else {
      $('#globalMask').hide();
    }
  });
  $(".drpmnu-oz").click(function () {
    if ($(this).attr('aria-expanded') === "false") {
      $(this).parent().addClass('--active');
      $('#globalMask').show();
      $('#globalSearchResult').hide();
    } else {
      $(this).parent().removeClass('--active');
      $('#globalMask').hide();
    }
  });
  /********************************/

  /*Cart & Notif Style*/

  /********************************/

  $("#cartBtn").click(function () {
    $(this).addClass("active");
    $('#cartbox').removeClass("d-none");
    $('#cartbox').addClass('animates');
    $('#cartMask').addClass('d-block');
    $('#globalSearchResult').addClass('d-none');
    $('body').addClass('overflow-hidden');
    var hgtTopCart = $('#top-product-cart').height();
    var hgtBottomCart = $('#bottom-product-cart').height();
    var totalHgtCart = mxHght - (hgtTopCart + hgtBottomCart);
    $('#ls-product-cart').css({
      'max-height': totalHgtCart,
      'top': hgtTopCart,
      'bottom': hgtBottomCart
    });
  });
  $("#notifBtn").click(function () {
    $(this).addClass("active");
    $('#notifbox').removeClass("d-none");
    $('#notifbox').addClass('animates');
    $('#cartMask').addClass('d-block');
    $('#globalSearchResult').addClass('d-none');
    $('body').addClass('overflow-hidden');
    var hgtTopNotif = $('#top-notif-vegan').height();
    var tabnotif = $('#tabnotif').height();
    var totalHgtNotif = mxHght - (hgtTopNotif + tabnotif);
    $('.ls-vegan-notif').css({
      'max-height': totalHgtNotif
    });
  });
  $("#closeCart").click(function () {
    $(this).removeClass("active");
    $('#cartbox').addClass("d-none");
    $('#cartbox').removeClass('animates');
    $('#cartMask').removeClass('d-block');
    $('body').removeClass('overflow-hidden');
  });
  $("#closeNotif").click(function () {
    $(this).removeClass("active");
    $('#notifbox').addClass("d-none");
    $('#notifbox').removeClass('animates');
    $('#cartMask').removeClass('d-block');
    $('body').removeClass('overflow-hidden');
  });
  /********************************/

  /*Show & Hide GlobalMask*/

  /********************************/

  if (window.matchMedia('(max-width: 767px)').matches) {
    $('#navbar-togglers').on('click', function () {
      if ($('#navbarPln').hasClass('show')) {
        $('#globalMask').hide();
      }
    });
  }
  /********************************/

  /*Change height responsive for global search input*/

  /********************************/


  var totalHeightSearch = mxHght - (hgtHeader - 40);

  if (window.matchMedia('(min-width: 768px) and (max-height: 430px)').matches) {
    $('#globalSearchResult').css({
      'max-height': totalHeightSearch,
      'overflow-y': 'auto'
    });
  }

  var totalHeightSearchMob = mxHght - hgtHeaderMob;

  if (window.matchMedia('(max-width: 767px) and (max-height: 430px)').matches) {
    $('#globalSearchResult').css({
      'max-height': totalHeightSearchMob,
      'overflow-y': 'auto'
    });
  }
  /********************************/

  /*Responsive Menu Profile Header*/

  /********************************/


  var totalHeightPrf = mxHght - (hgtHeader - 30);
  $('#headProf').css({
    'max-height': totalHeightPrf,
    'overflow-y': 'auto'
  });

  if (window.matchMedia('(max-width: 767px)').matches) {
    var totalHeightPrf = mxHght - hgtHeaderMob;
    $('#headProf').css({
      'max-height': totalHeightPrf
    });
  }
  /********************************/

  /*Animate header while scroll*/

  /********************************/


  if (window.matchMedia('(max-width: 767px)').matches) {
    var scroll_start = 0;
    var startchange = $('#content-vegan');
    var offset = startchange.offset();
    var main_header_pck = $('.mob-top-header');
    var height_head = $('.mob-top-header');

    if (startchange.length) {
      $(window).scroll(function () {
        scroll_start = $(this).scrollTop();

        if (scroll_start > offset.top - 100) {
          $(main_header_pck).addClass('animated faster slideInDown');
          $(height_head).addClass('scrl-heg');
        } else {
          $(main_header_pck).removeClass('animated faster slideInDown');
          $(height_head).removeClass('scrl-heg');
        }
      });
    }
  }
  /********************************/

  /*Clone Sidebar Akun For Mobile View*/

  /********************************/


  if (window.matchMedia('(max-width: 991px)').matches) {
    $(".sidebar-set-vegan").prependTo("#showSidebarAkun").html();
    var filterAkun = $('#filter-akun');
    var closeAkun = $('#cls-akun');
    $(filterAkun).click(function () {
      $('.backdrop-blur-vegan').show();
      $('#showSidebarAkun').toggle("slide");
      $('body').css('overflow-y', 'hidden');
    });
    $(closeAkun).click(function () {
      $('.backdrop-blur-vegan').hide();
      $('#showSidebarAkun').toggle("hide");
      $('body').css('overflow-y', 'auto');
    });
  }
  /********************************/

  /*Clone Sidebar Artikel For Mobile View*/

  /********************************/


  if (window.matchMedia('(max-width: 991px)').matches) {
    $(".sidebar-art-ouz").prependTo("#showSidebarArtikel").html();
    $(".right-mn-sdr-rt").prependTo("#rght-mn").html();
    var filterArtikel = $('#filter-artikel');
    var closeartikel = $('#cls-artikel');
    $(filterArtikel).click(function () {
      $('.backdrop-blur-vegan').toggle();
      $('#showSidebarArtikel').toggle("slide");
      $('body').css('overflow-y', 'hidden');
    });
    $(closeartikel).click(function () {
      $('.backdrop-blur-vegan').toggle('hide');
      $('#showSidebarArtikel').toggle("hide");
      $('body').css('overflow-y', 'auto');
    });
  }
  /********************************/

  /*Clone Countdown Flash Sale*/

  /********************************/


  if (window.matchMedia('(max-width: 991px)').matches) {
    $(".fs-countdown").prependTo("#clone-countdown").html();
    $("#clone-countdown").attr('style', 'display: block');
  }
  /********************************/

  /*disable area click menu dropdown*/

  /********************************/


  $('.dropdown-menu').bind('click', function (e) {
    e.stopPropagation();
  });
  /********************************/

  /*Global Clipboard Copy*/

  /********************************/

  function setToggle(id) {
    $("#copyclip-vegan" + id).slideDown();
  }

  function hideToggle(id) {
    setTimeout(function () {
      $('#copyclip-vegan' + id).slideUp();
    }, 1200);
  }

  var clp = new ClipboardJS('.copyclp-vegan-btn');
  clp.on('success', function (e) {
    setToggle($(e.trigger).data('target'));
    hideToggle($(e.trigger).data('target'));
  });
  /********************************/

  /*Upload File*/

  /********************************/

  $(".brw-fields").on("change", ".file-upload-field", function () {
    $(this).parent(".file-upload-wrapper").attr("data-text", $(this).val().replace(/.*(\/|\\)/, ''));
  });
  /********************************/

  /*Show and Hide toggle report/edit&delete*/

  /********************************/

  $('.option-rpt').on('click', function (e) {
    /*Show and Hide toggle edit delete menu*/
    $('#ud_' + $(this).data('id') + '').toggle();
    /*Show and Hide toggle report menu*/

    $('#report' + $(this).data('id') + '').toggle();
    $('#content-chs' + $(this).data('id') + '').slideUp();
    $(this).removeClass('option-rpt');
    $(this).addClass('close-option-rpt');
    $('.list-threads').siblings().find('.mn-tgllsa').addClass('d-none');
    $('.list-threads').siblings().find($('.mn-tgllsa_' + $(this).data('id') + '')).removeClass('d-none');
  });
  $('.report-btn').on('click', function (e) {
    $('#content-chs' + $(this).data('id') + '').slideDown();
  });
  /********************************/

  /*Check sort active*/

  /********************************/

  if ($('.list-sortmns').hasClass('active_sort')) {
    $('.list-sortmns').parent().addClass('active');
  }
});
})();

/******/ })()
;