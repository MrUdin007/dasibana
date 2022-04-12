// -----------------------------------------------------------------------------
// This file contains all product detail js.
// -----------------------------------------------------------------------------

// var $ = require('jquery');
// window.$ = $;
// require('slick-slider/slick/slick');
require('jquery-migrate/dist/jquery-migrate');

$(document).ready(function () {
    var offset_header = $('#hgt-header').height();
    
    /********************************/
    /* Slides Slick Product Detail */
    /********************************/
    $('.slider-detail-for').on('init', function (slick) {
        $('.slider-detail-prd').removeClass('slider-lazy');
    });
    $('.slider-detail-for').on('lazyLoaded', function(event, slick, image, imageSource){
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
    $('.slider-detail-for').slick({
        lazyLoad: 'ondemand',
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.slider-detail-nav'
    });
    $('.slider-detail-nav').on('lazyLoaded', function(event, slick, image, imageSource){
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
    $('.slider-detail-nav').slick({
        lazyLoad: 'ondemand',
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: '.slider-detail-for',
        dots: false,
        centerMode: false,
        focusOnSelect: true,
        autoplay: false,
        autoplaySpeed: 2000,
        responsive: [
            {
                breakpoint: 500,
                settings: {
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 425,
                settings: {
                    slidesToShow: 2
                }
            }
        ]
    });

    $('.sldr-news').on('init', function (slick) {
        $('.ct-sldr-news').removeClass('slider-lazy');
    });

    $('.sldr-news').on('lazyLoaded', function(event, slick, image, imageSource){
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

    $('.sldr-news').slick({
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
                breakpoint: 1200,
                settings: {
                    slidesToShow: 1,
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
            }
        ]
    });

    /********************************/
    /* Add smooth scrolling to all links */
    /********************************/
    $(".anchr-btn").on('click', function(event) {
        event.preventDefault();
        var hash = $(this).data('target');
        $('html, body').animate({
            scrollTop: $(hash).offset().top - offset_header
        }, 500);

        var parent = $(this).parent();
        if(!parent.hasClass('active')) {
            parent.addClass('active');
            parent.siblings().removeClass('active');
        }
    });

    /********************************/
    /*Show and Hide toggle report/edit&delete*/
    /********************************/
    $('.report-btns').on('click', function(e){
        /*Show and Hide toggle edit delete menu*/
        $('#report-'+$(this).data('id')+'').toggle();

        /*Show and Hide toggle report menu*/
        // $('#report'+$(this).data('id')+'').toggle();
        // $('#content-chs'+$(this).data('id')+'').slideUp();

        $(this).removeClass('option-rpt');
        $(this).addClass('close-option-rpt');
        // $('.list-threads').siblings().find('.mn-tgllsa').addClass('d-none');
        // $('.list-threads').siblings().find($('.mn-tgllsa_'+$(this).data('id')+'')).removeClass('d-none');
    });
    // $('.report-btn').on('click', function(e){
    //     $('#content-chs'+$(this).data('id')+'').slideDown();
    // });
});