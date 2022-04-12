// -----------------------------------------------------------------------------
// This file contains all blog js.
// -----------------------------------------------------------------------------

// var $ = require('jquery');
// window.$ = $;
// require('slick-slider/slick/slick');
require('jquery-migrate/dist/jquery-migrate');

$(document).ready(function () {
    /********************************/
    /* Slides Slick Blog */
    /********************************/
    $('.recommendation-slider').on('init', function (slick) {
        $('.main-recommendation-slider').removeClass('slider-lazy');
    });

    $('.recommendation-slider').on('lazyLoaded', function(event, slick, image, imageSource){
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

    $('.recommendation-slider').slick({
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
                breakpoint: 992,
                settings: {
                    slidesToShow: 1,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                    rows: 1,
                }
            }
        ]
    });
});