/*
Template Name: Manit
Author: wpoceans
Version: 1.0
*/

(function ($) {
    'use strict';

    /*------------------------------------------
        = Header search toggle
    -------------------------------------------*/
    if ($(".global-header__search-wrapper").length) {
        var searchToggleBtn = $(".global-search__toggle-btn");
        var searchToggleBtnIcon = $(".global-search__toggle-btn i");
        var searchContent = $(".global_header__search-form");
        var body = $("body");

        searchToggleBtn.on("click", function (e) {
            searchContent.toggleClass("global_header__content-toggle");
            searchToggleBtnIcon.toggleClass("fi ti-close");
            e.stopPropagation();
        });

        body.on("click", function () {
            searchContent.removeClass("global_header__content-toggle");
        }).find(searchContent).on("click", function (e) {
            e.stopPropagation();
        });
    }

    // Toggle mobile navigation
    function toggleMobileNavigation() {
        var navbar = $(".navigation__collapse");
        var openBtn = $(".mobile__navigation .open__navbar");
        var xbutton = $(".mobile__navigation .navbar-toggler");

        openBtn.on("click", function (e) {
            e.stopImmediatePropagation();
            navbar.toggleClass("slideInn");
            xbutton.toggleClass("x-close");
            return false;
        })
    }

    toggleMobileNavigation();

    // Function for toggle class for small menu
    function toggleClassForSmallNav() {
        var windowWidth = window.innerWidth;
        var mainNav = $("#navbar > ul");

        if (windowWidth <= 991) {
            mainNav.addClass("small-nav");
        } else {
            mainNav.removeClass("small-nav");
        }
    }

    toggleClassForSmallNav();

    // Function for small menu
    function smallNavFunctionality() {
        var windowWidth = window.innerWidth;
        var mainNav = $(".navigation__collapse");
        var smallNav = $(".navigation__collapse > .small-nav");
        var subMenu = smallNav.find(".sub-menu");
        var megamenu = smallNav.find(".mega-menu");
        var menuItemWidthSubMenu = smallNav.find(".menu-item-has-children > a");

        if (windowWidth <= 991) {
            subMenu.hide();
            megamenu.hide();
            menuItemWidthSubMenu.on("click", function (e) {
                var $this = $(this);
                $this.siblings().slideToggle();
                e.preventDefault();
                e.stopImmediatePropagation();
                $this.toggleClass("rotate");
            })
        } else if (windowWidth > 991) {
            mainNav.find(".sub-menu").show();
            mainNav.find(".mega-menu").show();
        }
    }

    smallNavFunctionality();

    $("body").on("click", function () {
        $('.navigation__collapse').removeClass('slideInn');
    });
    $(".menu-close").on("click", function () {
        $('.navigation__collapse').removeClass('slideInn');
    });
    $(".menu-close").on("click", function () {
        $('.open-btn').removeClass('x-close');
    });


    /*------------------------------------------
        = STICKY HEADER
    -------------------------------------------*/

    // Function for clone an element for sticky menu
    function cloneNavForSticyMenu($ele, $newElmClass) {
        $ele.addClass('original').clone().insertAfter($ele).addClass($newElmClass).removeClass('original');
    }

    // clone home style 1 navigation for sticky menu
    if ($('.global-header__navigation .global__navigation').length) {
        cloneNavForSticyMenu($('.global-header__navigation .global__navigation'), "sticky-header");
    }

    var lastScrollTop = '';

    function stickyMenu($targetMenu, $toggleClass) {
        var st = $(window).scrollTop();
        var mainMenuTop = $('.global-header__navigation .global__navigation');

        if ($(window).scrollTop() > 500) {
            if (st > lastScrollTop) {
                // hide sticky menu on scroll down
                $targetMenu.addClass($toggleClass);

            } else {
                // active sticky menu on scroll up
                $targetMenu.addClass($toggleClass);
            }

        } else {
            $targetMenu.removeClass($toggleClass);
        }

        lastScrollTop = st;


    }

    /*==========================================================================
       WHEN WINDOW SCROLL
   ==========================================================================*/
    $(window).on("scroll", function () {

        if ($(".global-header__navigation").length) {
            stickyMenu($('.global-header__navigation .global__navigation'), "sticky-on");
        }


    });

    /*=========================================================================
        WHEN DOCUMENT LOADING
    ==========================================================================*/
    $(window).on('load', function () {

        toggleMobileNavigation();

    });


    /*==========================================================================
       WHEN WINDOW RESIZE
   ==========================================================================*/
    $(window).on("resize", function () {
        toggleClassForSmallNav();

        clearTimeout($.data(this, 'resizeTimer'));
        $.data(this, 'resizeTimer', setTimeout(function () {
            smallNavFunctionality();
        }, 200));
    });


    /*----- ELEMENTOR LOAD FUNTION CALL ---*/

    $(window).on('elementor/frontend/init', function () {

        var swiper_slide = function () {

            // HERO SLIDER
            var menu = [];
            jQuery('.swiper-slide').each(function (index) {
                menu.push(jQuery(this).find('.slide-inner').attr("data-text"));
            });
            var interleaveOffset = 0.5;
            var swiperOptions = {
                loop: true,
                speed: 1000,
                parallax: true,
                autoplay: {
                    delay: 6500,
                    disableOnInteraction: false,
                },
                watchSlidesProgress: true,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                    renderBullet: function (index, className) {
                        return '<span class="' + className + '">' + (index + 1) + "</span>";
                    },
                },

                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },

                on: {
                    progress: function () {
                        var swiper = this;
                        for (var i = 0; i < swiper.slides.length; i++) {
                            var slideProgress = swiper.slides[i].progress;
                            var innerOffset = swiper.width * interleaveOffset;
                            var innerTranslate = slideProgress * innerOffset;
                            swiper.slides[i].querySelector(".slide-inner").style.transform =
                                "translate3d(" + innerTranslate + "px, 0, 0)";
                        }
                    },

                    touchStart: function () {
                        var swiper = this;
                        for (var i = 0; i < swiper.slides.length; i++) {
                            swiper.slides[i].style.transition = "";
                        }
                    },

                    setTransition: function (speed) {
                        var swiper = this;
                        for (var i = 0; i < swiper.slides.length; i++) {
                            swiper.slides[i].style.transition = speed + "ms";
                            swiper.slides[i].querySelector(".slide-inner").style.transition =
                                speed + "ms";
                        }
                    }
                }
            };

            var swiper = new Swiper(".swiper-container", swiperOptions);


        }; // end



        // sliderBgSetting

        var sliderBgSetting = function () {
            // DATA BACKGROUND IMAGE
            var sliderBgSetting = $(".slide-bg-image");
            sliderBgSetting.each(function (indx) {
                if ($(this).attr("data-background")) {
                    $(this).css("background-image", "url(" + $(this).data("background") + ")");
                }
            });



        }; // end



        var hero_slider = function () {


            /* hero - slider */
            if ($(".hero-slider").length) {
                $('.hero-slider').slick({
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    autoplay: true,
                    arrows: false,
                });
            }
            /* hero-slider-s2 */
            if ($(".hero-slider-s2").length) {
                $('.hero-slider-s2').slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    autoplay: true,
                    arrows: false,
                    fade: true,
                });
            }



        }; // end


        var project_slider = function () {
            /* project-slider */
            if ($(".project-slider").length) {
                $('.project-slider').slick({
                    centerMode: true,
                    infinite: true,
                    centerPadding: '0px',
                    speed: 500,
                    dots: true,
                    variableWidth: true,
                    responsive: [{
                        breakpoint: 575,
                        settings: {
                            slidesToShow: 1,
                            variableWidth: false,
                            centerMode: false,
                        }
                    },

                    ]
                });
            }
        }; // end
        var project_slider2 = function () {
            /* project-slider */
            if ($(".project-slider-s2").length) {
                $('.project-slider-s2').slick({
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    speed: 500,
                    dots: true,
                    responsive: [{
                        breakpoint: 1199,
                        settings: {
                            slidesToShow: 2,
                            variableWidth: false,
                        }
                    },
                    {
                        breakpoint: 767,
                        settings: {
                            slidesToShow: 1,
                            variableWidth: false,
                        }
                    },

                    ]
                });
            }
        }; // end


        var hero_odometer = function () {

            /*------------------------------------------
              = FUNFACT
              -------------------------------------------*/
            if ($(".odometer").length) {
                $('.odometer').appear();
                $(document.body).on('appear', '.odometer', function (e) {
                    var odo = $(".odometer");
                    odo.each(function () {
                        var countNumber = $(this).attr("data-count");
                        $(this).html(countNumber);
                    });
                });
            }

        }; // end



        var testimonials_slider = function () {

            /* testimonial - slider */
            $('.testimonial-active').slick({
                slidesToShow: 2,
                slidesToScroll: 1,
                arrows: false,
                responsive: [{
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 1,
                        dots: true,

                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 1,
                        dots: true,
                        arrows: false,
                    }
                },
                ]
            });

        }; 
        
        // end
        var testimonials_slider2 = function () {

            /* testimonial - slider */
            $('.testimonial-active-s2').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                dots: true,
                arrows: false,
                responsive: [
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 2,
                            dots: true,
    
                        }
                    },{
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 2,
                        dots: true,

                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 1,
                        dots: true,
                        arrows: false,
                    }
                },
                ]
            });

        }; // end
        

        // end
        var project_single_slider = function () {

            /* project-single-main-img - slider */
            if ($(".project-single-main-img").length) {
                $(".project-single-main-img").owlCarousel({
                    mouseDrag: false,
                    smartSpeed: 500,
                    margin: 30,
                    loop: true,
                    nav: true,
                    navText: ['<i class="fi ti-arrow-left"></i>', '<i class="fi ti-arrow-right"></i>'],
                    dots: false,
                    items: 1
                });
            }
    
        }; // end






        var odometer = function () {

            /*------------------------------------------
             = FUNFACT
             -------------------------------------------*/
            if ($(".odometer").length) {
                $('.odometer').appear();
                $(document.body).on('appear', '.odometer', function (e) {
                    var odo = $(".odometer");
                    odo.each(function () {
                        var countNumber = $(this).attr("data-count");
                        $(this).html(countNumber);
                    });
                });
            }



        }; // end




        var partners_slider = function () {

            /*------------------------------------------
                    = PARTNERS SLIDER
                -------------------------------------------*/
            if ($(".partners-slider").length) {
                $(".partners-slider").owlCarousel({
                    autoplay: true,
                    smartSpeed: 300,
                    margin: 60,
                    loop: true,
                    autoplayHoverPause: true,
                    dots: false,
                    responsive: {
                        0: {
                            items: 3
                        },

                        550: {
                            items: 4
                        },

                        992: {
                            items: 5
                        },

                        1200: {
                            items: 7
                        }
                    }
                });
            }

        }; // end



        var event_date = function () {


            // Set the target elements with the same class
            var dateElements = $(".event-date");

            // Update each set of date elements
            dateElements.each(function () {
                updateClock($(this));
            });

            // Set interval to update every second
            setInterval(function () {
                dateElements.each(function () {
                    updateClock($(this));
                });
            }, 1000);

            function updateClock(dateElement) {
                var eventDate = new Date(dateElement.data("event-date")); // Get the date from data attribute
                var currentDate = new Date();

                var difference = Math.abs(eventDate - currentDate);
                var days = Math.floor(difference / (1000 * 60 * 60 * 24));
                var hours = Math.floor((difference / (1000 * 60 * 60)) % 24);
                var mins = Math.floor((difference / (1000 * 60)) % 60);
                var seconds = Math.floor((difference / 1000) % 60);

                // Select elements within the dateElement
                var getday = dateElement.find(".days");
                var gethour = dateElement.find(".hours");
                var getmins = dateElement.find(".mins");
                var getsec = dateElement.find(".sec");

                getday.text(checkZero(days));
                gethour.text(checkZero(hours));
                getmins.text(checkZero(mins));
                getsec.text(checkZero(seconds));
            }

            function checkZero(mytime) {
                return mytime < 10 ? "0" + mytime : mytime;
            }



        }; // end


        var eventSlider_active = function () {


            if ($(".event-active").length) {
                $(".event-active").slick({
                    autoplay: false,
                    autoplaySpeed: 6000,
                    pauseOnHover: true,
                    arrows: true,
                    dots: false,
                    fade: true,
                    cssEase: 'linear',
                    responsive: [{
                        breakpoint: 991,
                        settings: {
                            arrows: false,
                            dots: true
                        }
                    }]

                });
            }

        }; // end


        var event_slider = function () {


            if ($(".event-slider").length) {
                $('.event-slider').slick({
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    arrows: true,
                    responsive: [{
                        breakpoint: 1199,
                        settings: {
                            slidesToShow: 2,
                        }
                    },
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 2,
                            dots: true,
                            arrows: false,
                        }
                    },
                    {
                        breakpoint: 767,
                        settings: {
                            slidesToShow: 1,
                            dots: true,
                            arrows: false,
                        }
                    },
                    ]
                });

            }

        }; // end

        //hero_slider
        elementorFrontend.hooks.addAction('frontend/element_ready/wpo-manit_hero.default', function ($scope, $) {
            hero_slider();
        });

        //hero_odometer
        elementorFrontend.hooks.addAction('frontend/element_ready/wpo-manit_hero.default', function ($scope, $) {
            hero_odometer();
        });

        //Slider
        elementorFrontend.hooks.addAction('frontend/element_ready/wpo-manit_slider.default', function ($scope, $) {
            swiper_slide();
        });

        //sliderBgSetting
        elementorFrontend.hooks.addAction('frontend/element_ready/wpo-manit_slider.default', function ($scope, $) {
            sliderBgSetting();
        });


        //project
        elementorFrontend.hooks.addAction('frontend/element_ready/wpo-manit_project.default', function ($scope, $) {
            project_slider();
        });
        //project
        elementorFrontend.hooks.addAction('frontend/element_ready/wpo-manit_project.default', function ($scope, $) {
            project_slider2();
        });

        //testimonial
        elementorFrontend.hooks.addAction('frontend/element_ready/wpo-manit_testimonial.default', function ($scope, $) {
            testimonials_slider();
        });
        //testimonial
        elementorFrontend.hooks.addAction('frontend/element_ready/wpo-manit_testimonial.default', function ($scope, $) {
            testimonials_slider2();
        });

        //Project Single
        elementorFrontend.hooks.addAction('frontend/element_ready/wpo-manit_gallery.default', function ($scope, $) {
           project_single_slider();
        });

        //odometer
        elementorFrontend.hooks.addAction('frontend/element_ready/wpo-manit_funfact.default', function ($scope, $) {
            odometer();
        });

        //partners_slider
        elementorFrontend.hooks.addAction('frontend/element_ready/wpo-manit_client.default', function ($scope, $) {
            partners_slider();
        });

        //event_date
        elementorFrontend.hooks.addAction('frontend/element_ready/wpo-manit_event.default', function ($scope, $) {
            event_date();
        });

        //eventSlider_active
        elementorFrontend.hooks.addAction('frontend/element_ready/wpo-manit_event.default', function ($scope, $) {
            eventSlider_active();
        });

        //event_slider
        elementorFrontend.hooks.addAction('frontend/element_ready/wpo-manit_event.default', function ($scope, $) {
            event_slider();
        });


    });


})(jQuery);  