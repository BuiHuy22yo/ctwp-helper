// (function($) {
//     var ctwpPostSwiper = function ($scope, $) {
//
//         $('.elementor-widget-ctwp-posts-swiper').each( function( index, el ) {
//             var $this1 = $(el);
//             var wrapperSlider1 = $this1.find('.elementor-ctwp_posts-wrapper.swiper'),
//             desktopView = wrapperSlider1.attr('data-limit-desktop'),
//             tabletView = wrapperSlider1.attr('data-limit-tablet'),
//             mobileView = wrapperSlider1.attr('data-limit-mobile');
//
//             var swiperctwpPostSwiper = new Swiper('.elementor-ctwp_posts-wrapper.swiper-container', {
//                 slidesPerView: mobileView,
//                 navigation: {
//                     nextEl: '.swiper-button-next',
//                     prevEl: '.swiper-button-prev',
//                 },
//                 pagination: {
//                     el: '.swiper-pagination',
//                     clickable: true,
//                 },
//                 breakpoints: {
//                     640: {
//                         slidesPerView: mobileView,
//                     },
//                     768: {
//                         slidesPerView: tabletView,
//                     },
//                     1024: {
//                         slidesPerView: desktopView,
//                     },
//                 }
//             });
//         });
//     };
//
//     $(window).on('elementor/frontend/init', function () {
//         elementorFrontend.hooks.addAction('frontend/element_ready/ctwp-posts-swiper.default', ctwpPostSwiper);
//     });
//
// })(jQuery);
// (function($) {
//     var ctwpProductsSwiper = function($scope, $) {
//
//         $('.elementor-widget-ctwp-products-swiper').each(function(index, el) {
//             var $this2 = $(el);
//             var wrapperSlider2 = $this2.find('.elementor-ctwp_products-wrapper.swiper'),
//                 desktopView = wrapperSlider2.attr('data-limit-desktop'),
//                 tabletView = wrapperSlider2.attr('data-limit-tablet'),
//                 mobileView = wrapperSlider2.attr('data-limit-mobile');
//
//             var swiperctwpProductsSwiper = new Swiper('.elementor-ctwp_products-wrapper.swiper-container', {
//                 slidesPerView: mobileView,
//                 navigation: {
//                     nextEl: '.swiper-button-next',
//                     prevEl: '.swiper-button-prev',
//                 },
//                 pagination: {
//                     el: '.swiper-pagination',
//                     clickable: true,
//                 },
//                 breakpoints: {
//                     640: {
//                         slidesPerView: mobileView,
//                     },
//                     768: {
//                         slidesPerView: tabletView,
//                     },
//                     1024: {
//                         slidesPerView: desktopView,
//                     },
//                 }
//             });
//         });
//     };
//
//     $(window).on('elementor/frontend/init', function() {
//         elementorFrontend.hooks.addAction('frontend/element_ready/ctwp-products-swiper.default', ctwpProductsSwiper);
//     });
//
// })(jQuery);

(function($) {
    // var body = $('body');
    // if(body.hasClass("home")) {
        var ctwpTestimonials = function ($scope, $) {

            $('.ctwp_testimonials-wrapper').each( function( index, el ) {
                var $this3 = $(el);
                var dataStyle = $this3.attr('data-style');
                var currentAcitve = null;
                var widthW = $(window).width();

                if (dataStyle=='style-1') {
                    var wrapperSlider3 = $this3.find('.elementor-ctwp_testimonials-wrapper.swiper');
                    var desktopView = wrapperSlider3.attr('data-limit-desktop'),
                        tabletView = wrapperSlider3.attr('data-limit-tablet'),
                        mobileView = wrapperSlider3.attr('data-limit-mobile');

                    var swiperctwpTestimonials = new Swiper('.elementor-ctwp_testimonials-wrapper.swiper-container', {
                        slidesPerView: mobileView,
                        loop: true,
                        allowTouchMove: false,
                        navigation: {
                            nextEl: '.swiper-button-next',
                            prevEl: '.swiper-button-prev',
                        },
                        pagination: {
                            el: '.swiper-pagination',
                            clickable: true,
                        },
                        breakpoints: {
                            320: {
                                loop: false,
                                allowTouchMove: true,
                            },
                            640: {
                                loop: false,
                                allowTouchMove: true,
                                slidesPerView: mobileView,
                            },
                            768: {
                                slidesPerView: tabletView,
                            },
                            1024: {
                                slidesPerView: desktopView,
                            },
                        },
                        on: {
                            init: function () {
                                if (widthW > 1023) {
                                    var defaultSlide = this.slides[parseInt(desktopView)*2 - 1];
                                    defaultSlide.classList.add('active')
                                }
                                if (widthW > 767 && widthW <= 1023) {
                                    var defaultSlide = this.slides[parseInt(tabletView)*2 - 1];
                                    defaultSlide.classList.add('active')
                                }
                            }
                        }
                    });
                    let totalSlides = swiperctwpTestimonials.slides.length;
                    swiperctwpTestimonials.on("slideNextTransitionStart", function() {
                        if (widthW > 1023) {
                            // click 1 = 1
                            let index = swiperctwpTestimonials.realIndex;
                            if (currentAcitve == null) {
                                currentAcitve = parseInt(desktopView)*2 - 1 + index // 4
                            }else {
                                if( totalSlides == parseInt(currentAcitve) + 1 ) {
                                    currentAcitve = parseInt(desktopView)*2
                                }else {
                                    currentAcitve = currentAcitve + 1; // 5
                                }
                            }
                            let defaultSlide = this.slides[currentAcitve];
                            for (let i = 0; i < swiperctwpTestimonials.slides.length; i++) {
                                swiperctwpTestimonials.slides[i].classList.remove('active')
                            }
                            defaultSlide.classList.add('active')
                        }

                    });
                    swiperctwpTestimonials.on("slidePrevTransitionStart", function() {
                        if (widthW > 1023) {
                            let index = swiperctwpTestimonials.realIndex;
                            if (currentAcitve == null) {
                                currentAcitve = parseInt(desktopView)*3  - index - 1
                            }else {
                                if( parseInt(currentAcitve) - 1 == parseInt(desktopView) +1 ) {
                                     currentAcitve = parseInt(desktopView)*3 -1;
                                    console.log(currentAcitve);
                                }else {
                                    currentAcitve = currentAcitve - 1;
                                }
                            }

                            let defaultSlide = this.slides[currentAcitve];
                            for (let i = 0; i < swiperctwpTestimonials.slides.length; i++) {
                                swiperctwpTestimonials.slides[i].classList.remove('active')
                            }
                            defaultSlide.classList.add('active')
                        }

                    });
                    swiperctwpTestimonials.on("slideNextTransitionStart", function() {
                        if (widthW > 767 && widthW <= 1023) {
                            let index = swiperctwpTestimonials.realIndex;
                            if (currentAcitve == null) {
                                currentAcitve = parseInt(tabletView)*2 - 1 + index // 4
                            }else {
                                if( totalSlides == parseInt(currentAcitve) + 1 ) {
                                    currentAcitve = parseInt(tabletView)*2
                                }else {
                                    currentAcitve = currentAcitve + 1; // 5
                                }
                            }
                            let defaultSlide = this.slides[currentAcitve];
                            for (let i = 0; i < swiperctwpTestimonials.slides.length; i++) {
                                swiperctwpTestimonials.slides[i].classList.remove('active')
                            }
                            defaultSlide.classList.add('active')
                        }

                    });
                    swiperctwpTestimonials.on("slidePrevTransitionStart", function() {
                        if (widthW > 767 && widthW <= 1023) {
                            let index = swiperctwpTestimonials.realIndex;
                            if (currentAcitve == null) {
                                currentAcitve = parseInt(tabletView)*3  - index
                            }else {
                                if( parseInt(currentAcitve) - 1  == parseInt(tabletView) ) {
                                    currentAcitve = parseInt(tabletView)*3;
                                }else {
                                    currentAcitve = currentAcitve - 1;
                                }

                            }
                            let defaultSlide = this.slides[currentAcitve];
                            for (let i = 0; i < swiperctwpTestimonials.slides.length; i++) {
                                swiperctwpTestimonials.slides[i].classList.remove('active')
                            }
                            defaultSlide.classList.add('active')
                        }

                    });
                }
            });

        };

        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction('frontend/element_ready/ctwp-testimonials-swiper.default', ctwpTestimonials);
        });
    // }

})(jQuery);


// (function($) {
//     var body = $('body');
//     if(body.hasClass("home")) {
//         return;
//     }
//     var ctwpTestimonials4 = function ($scope, $) {
//
//         $('.ctwp_testimonials-wrapper.top').each( function( index, el ) {
//             var $this4 = $(el);
//             var dataStyle = $this4.attr('data-style');
//             if (dataStyle=='style-1') {
//                 var wrapperSlider4 = $this4.find('.elementor-ctwp_testimonials-wrapper.swiper');
//                 var desktopView = wrapperSlider4.attr('data-limit-desktop'),
//                     tabletView = wrapperSlider4.attr('data-limit-tablet'),
//                     mobileView = wrapperSlider4.attr('data-limit-mobile');
//
//                 var swiper4 = new Swiper('.ctwp_testimonials-wrapper.top .swiper-container', {
//                     grabCursor: true,
//                     slidesPerView: mobileView,
//                     allowTouchMove: true,
//                     navigation: {
//                         nextEl: '.swiper-button-next',
//                         prevEl: '.swiper-button-prev',
//                     },
//                     pagination: {
//                         el: '.swiper-pagination',
//                         clickable: true,
//                     },
//                     breakpoints: {
//                         640: {
//                             slidesPerView: mobileView,
//                         },
//                         768: {
//                             slidesPerView: tabletView,
//                         },
//                         1024: {
//                             slidesPerView: desktopView,
//                         },
//                     },
//
//                 });
//                 swiper4.on("slidePrevTransitionEnd", function() {
//                     let index = this.realIndex;
//                     let paginationwrap = $this4[0].querySelectorAll('.swiper-pagination-bullet');
//                     if( paginationwrap !== null ) {
//                         for (var p = 0; p < paginationwrap.length; p++) {
//                             paginationwrap[p].classList.remove('swiper-pagination-bullet-active');
//                         }
//                     }
//                     paginationwrap[index].classList.add('swiper-pagination-bullet-active');
//
//                 });
//                 swiper4.on("slideNextTransitionEnd", function() {
//                     let index = this.realIndex;
//                     let paginationwrap = $this4[0].querySelectorAll('.swiper-pagination-bullet');
//                     if( paginationwrap !== null ) {
//                         for (var p = 0; p < paginationwrap.length; p++) {
//                             paginationwrap[p].classList.remove('swiper-pagination-bullet-active');
//                         }
//                     }
//                     paginationwrap[index].classList.add('swiper-pagination-bullet-active');
//                 });
//             }
//         });
//
//     };
//
//     $(window).on('elementor/frontend/init', function () {
//         elementorFrontend.hooks.addAction('frontend/element_ready/ctwp-testimonials-swiper.default', ctwpTestimonials4);
//     });
//
// })(jQuery);
//
//
// (function($) {
//     var body = $('body');
//     if(body.hasClass("home")) {
//         return;
//     }
//     var ctwpTestimonials5 = function ($scope, $) {
//
//         $('.ctwp_testimonials-wrapper.bottom').each( function( index, el ) {
//             var $this5 = $(el);
//             var dataStyle = $this5.attr('data-style');
//             if (dataStyle=='style-1') {
//                 var wrapperSlider5 = $this5.find('.elementor-ctwp_testimonials-wrapper.swiper');
//                 var desktopView = wrapperSlider5.attr('data-limit-desktop'),
//                     tabletView = wrapperSlider5.attr('data-limit-tablet'),
//                     mobileView = wrapperSlider5.attr('data-limit-mobile');
//
//                 var swiper5 = new Swiper('.ctwp_testimonials-wrapper.bottom .swiper-container', {
//                     grabCursor: true,
//                     slidesPerView: mobileView,
//                     allowTouchMove: true,
//                     navigation: {
//                         nextEl: '.swiper-button-next',
//                         prevEl: '.swiper-button-prev',
//                     },
//                     pagination: {
//                         el: '.swiper-pagination',
//                         clickable: true,
//                     },
//                     breakpoints: {
//                         640: {
//                             slidesPerView: mobileView,
//                         },
//                         768: {
//                             slidesPerView: tabletView,
//                         },
//                         1024: {
//                             slidesPerView: desktopView,
//                         },
//                     },
//
//                 });
//                 swiper5.on("slidePrevTransitionEnd", function() {
//                     console.log('aaa');
//                     let index = this.realIndex;
//                     let paginationwrap = $this5[0].querySelectorAll('.swiper-pagination-bullet');
//                     if( paginationwrap !== null ) {
//                         for (var p = 0; p < paginationwrap.length; p++) {
//                             paginationwrap[p].classList.remove('swiper-pagination-bullet-active');
//                         }
//                     }
//                     paginationwrap[index].classList.add('swiper-pagination-bullet-active');
//
//                 });
//                 swiper5.on("slideNextTransitionEnd", function() {
//                     let index = this.realIndex;
//                     let paginationwrap = $this5[0].querySelectorAll('.swiper-pagination-bullet');
//                     if( paginationwrap !== null ) {
//                         for (var p = 0; p < paginationwrap.length; p++) {
//                             paginationwrap[p].classList.remove('swiper-pagination-bullet-active');
//                         }
//                     }
//                     paginationwrap[index].classList.add('swiper-pagination-bullet-active');
//
//                 });
//
//             }
//         });
//
//     };
//
//     $(window).on('elementor/frontend/init', function () {
//         elementorFrontend.hooks.addAction('frontend/element_ready/ctwp-testimonials-swiper.default', ctwpTestimonials5);
//     });
//
// })(jQuery);
//
//
// (function($) {
//
//     var ctwpQuotes = function ($scope, $) {
//
//         $('.ctwp_quotes-wrapper').each( function( index, el ) {
//             var $this6 = $(el);
//             var dataStyle = $this6.attr('data-style');
//             if (dataStyle=='style-1') {
//                 var wrapperSlider6 = $this6.find('.elementor-ctwp_quotes-wrapper.swiper');
//                 var desktopView = wrapperSlider6.attr('data-limit-desktop'),
//                     tabletView = wrapperSlider6.attr('data-limit-tablet'),
//                     mobileView = wrapperSlider6.attr('data-limit-mobile');
//
//                 var swiper6 = new Swiper('.elementor-ctwp_quotes-wrapper.swiper-container', {
//                     slidesPerView: mobileView,
//                     navigation: {
//                         nextEl: '.swiper-button-next',
//                         prevEl: '.swiper-button-prev',
//                     },
//                     pagination: {
//                         el: '.swiper-pagination',
//                         clickable: true,
//                     },
//                     breakpoints: {
//                         640: {
//                             slidesPerView: mobileView,
//                         },
//                         768: {
//                             slidesPerView: tabletView,
//                         },
//                         1024: {
//                             slidesPerView: desktopView,
//                         },
//                     },
//                 });
//             }
//         });
//
//     };
//
//     $(window).on('elementor/frontend/init', function () {
//         elementorFrontend.hooks.addAction('frontend/element_ready/ctwp-quotes-swiper.default', ctwpQuotes);
//     });
//
// })(jQuery);