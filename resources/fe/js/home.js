// -----------------------------------------------------------------------------
// This file contains all home js.
// -----------------------------------------------------------------------------

// var $ = require('jquery');
// window.$ = $;
// require('slick-slider/slick/slick');
require('jquery-migrate/dist/jquery-migrate');

$(document).ready(function () {
    /********************************/
    /* Slides Slick Home */
    /********************************/
    $('.slider-banner').on('init', function (slick) {
        $('.sec-banner').removeClass('slider-lazy');
    });

    $('.slider-banner').on('lazyLoaded', function(event, slick, image, imageSource){
        var img = new Image(),
            src = imageSource,
            ele = $(image).parent(),
            parent = ele.parent();
        image.remove();
        img.onload = function() {
            ele.css("background-image", "url('"+src+"')");
            ele.addClass('loaded');
        }
        img.src = src;
    });

    $('.slider-banner').slick({
        lazyLoad: 'ondemand',
        centerMode: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: true,
        focusOnSelect: false,
        arrows: false,
        autoplay: false,
        autoplaySpeed: 2200,
        speed: 1200,
        infinite: true,
        cssEase: 'linear'
    });

    $('.slider-prdct').on('init', function (slick) {
        $(this).parent().removeClass('slider-lazy');
    });

    $('.slider-prdct').on('lazyLoaded', function(event, slick, image, imageSource){
        var img = new Image(),
            src = imageSource,
            ele = $(image).parent();
        image.remove();
        img.onload = function() {
            ele.css("background-image", "url('"+src+"')");
            ele.addClass('loaded');
        }
        img.src = src;
    });

    $('.slider-prdct').slick({
        lazyLoad: 'ondemand',
        centerMode: false,
        slidesToShow: 5,
        slidesToScroll: 1,
        dots: false,
        focusOnSelect: false,
        arrows: true,
        autoplay: false,
        autoplaySpeed: 2200,
        speed: 1200,
        infinite: true,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 4
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2
                }
            }
        ]
    });

    if (window.matchMedia('(min-width: 425px)').matches) {
        $('.vgn-mobileView').remove();
    }

    $('.vegan-news-slider').on('init', function (slick) {
        $('.main-vegan-news-slider').removeClass('slider-lazy');
    });

    $('.vegan-news-slider').on('lazyLoaded', function(event, slick, image, imageSource){
        var img = new Image(),
            src = imageSource,
            sib = $(image).parent(),
            btn = $(image).next();
        image.remove();
        img.onload = function() {
            sib.css("background-image", "url('"+src+"')");
            sib.addClass('loaded');
            btn.show();
        }
        img.src = src;
    });

    $('.vegan-news-slider').slick({
        slidesToShow: 2,
        slidesToScroll: 1,
        dots: false,
        focusOnSelect: false,
        arrows: true,
        autoplay: false,
        autoplaySpeed: 2200,
        speed: 1200,
        rows: 2,
        infinite: true,
        nextArrow: '<button class="slick-next slick-arrow fa" aria-label="Next" type="button" aria-disabled="false">Next</button>',
        prevArrow: '<button class="slick-prev slick-arrow fa" aria-label="Previous" type="button" aria-disabled="false">Previous</button>',
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                }
            },
            {
                breakpoint: 425,
                settings: {
                    rows: 1
                }
            },
            {
                breakpoint: 400,
                settings: {
                    rows: 1,
                    slidesToShow: 1
                }
            }
        ]
    });

    $('.news-slider').on('init', function (slick) {
        $('.main-news-slider').removeClass('slider-lazy');
    });

    $('.news-slider').on('lazyLoaded', function(event, slick, image, imageSource){
        var img = new Image(),
            src = imageSource,
            sib = $(image).parent(),
            btn = $(image).next();
        image.remove();
        img.onload = function() {
            sib.css("background-image", "url('"+src+"')");
            sib.addClass('loaded');
            btn.show();
        }
        img.src = src;
    });

    $('.news-slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: false,
        focusOnSelect: false,
        arrows: true,
        autoplay: false,
        autoplaySpeed: 2200,
        speed: 1200,
        infinite: true,
        nextArrow: '<button class="slick-next slick-arrow fa" aria-label="Next" type="button" aria-disabled="false">Next</button>',
        prevArrow: '<button class="slick-prev slick-arrow fa" aria-label="Previous" type="button" aria-disabled="false">Previous</button>',
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });

    /********************************/
    /*menu scrollbar*/
    /********************************/
    $("#trendLeft").click(function () {
        var leftPos = $('.dv-scrbamn').scrollLeft();
        $(".dv-scrbamn-trnd").animate({
            scrollLeft: leftPos - 200
        }, 800);
    });

    $("#trendRight").click(function () {
        var leftPos = $('.dv-scrbamn').scrollLeft();
        $(".dv-scrbamn-trnd").animate({
            scrollLeft: leftPos + 200
        }, 800);
    });

    $("#saleLeft").click(function () {
        var leftPos = $('.dv-scrbamn').scrollLeft();
        $(".dv-scrbamn-hotItems").animate({
            scrollLeft: leftPos - 200
        }, 800);
    });

    $("#saleRight").click(function () {
        var leftPos = $('.dv-scrbamn').scrollLeft();
        $(".dv-scrbamn-hotItems").animate({
            scrollLeft: leftPos + 200
        }, 800);
    });
    
    /********************************/
    /*show & hide arrow menu tab*/
    /********************************/
    var jumlahmenu = 0;
    $('.dv-scrbamn li').each(function(index) {
        jumlahmenu += parseInt($(this).width());
    });
    var widthTab = $('.scroll-menu-tab').width();
    
    if(jumlahmenu > widthTab){
        $('.scroll-menu-tab')
            .mouseover(function(){
                $('.arrow-scrl').css('visibility', 'visible');
            })
            .mouseout(function(){
                $('.arrow-scrl').css('visibility', 'hidden');
            });
    }
});
