// -----------------------------------------------------------------------------
// This file contains all product detail js.
// -----------------------------------------------------------------------------

// var $ = require('jquery');
// window.$ = $;
// require('slick-slider/slick/slick');
require('jquery-migrate/dist/jquery-migrate');


$(document).ready(function () {
    /********************************/
    /* Slides Slick Promo Detail */
    /********************************/
    $('.sldroth').on('init', function (slick) {
        $('.ct-slider-ot').removeClass('slider-lazy');
    });
    $('.sldroth').on('lazyLoaded', function(event, slick, image, imageSource){
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
    $('.sldroth').slick({
        lazyLoad: 'ondemand',
        centerMode: false,
        slidesToShow: 6,
        slidesToScroll: 1,
        dots: false,
        focusOnSelect: false,
        arrows: true,
        autoplay: false,
        autoplaySpeed: 2000,
        infinite: true,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 5
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 4
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 400,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });
});