(function($) {

    "use strict";

    /*==============================

        Is mobile

    ==============================*/

    var isMobile = {

        Android: function() {

            return navigator.userAgent.match(/Android/i);

        },

        BlackBerry: function() {

            return navigator.userAgent.match(/BlackBerry/i);

        },

        iOS: function() {

            return navigator.userAgent.match(/iPhone|iPad|iPod/i);

        },

        Opera: function() {

            return navigator.userAgent.match(/Opera Mini/i);

        },

        Windows: function() {

            return navigator.userAgent.match(/IEMobile/i);

        },

        any: function() {

            return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());

        }

    };



    /*Accordion*/

    Accordion();

    function Accordion() {

        $( ".accordion" ).accordion({

          heightStyle: "content"

        });

    }



    /* Tabs */

    Tabs();

    function Tabs() {

        $('.tabs').tabs({

            show: { effect: "fadeIn", duration: 300 },

            hide: { effect: "fadeOut", duration: 300 }

        });

    }



    /* Select */

    aweSelect();

    function aweSelect() {

        $('.awe-select').each(function(index, el) {

            $(this).selectpicker();

        });

        

    }



    /* aweCalendar */

    aweCalendar();

    function aweCalendar() {

        $('.awe-calendar').each(function() {

            var aweselect = $(this);

            aweselect.wrap('<div class="awe-calendar-wrapper"></div>');

            aweselect.after('<i class="hillter-icon-calendar"></i>');

        });

    }



    /*Menu Sticky*/ 

    function MenuSticky() {



        if($('#header').length) {



            var $this = $('#header'),

                size_point = $this.data().responsive,

                window_w = $(window).innerWidth(),

                window_scroll = $(window).scrollTop(),

                top_h = $('#header .header_top').innerHeight(),

                top_h2 = $('#header_content').innerHeight(),

                this_h = $this.innerHeight();



                if(size_point == undefined || size_point == '') {

                    size_point = 1199;

                }



                if( window_scroll > (top_h - 20) ) {



                    if(($this).hasClass('header-sticky') == false) {

                        $this.addClass('header-sticky');



                        if(window_w <= size_point) {

                            $this.find('.header_menu').css('top', (this_h + top_h2) + 'px');

                        }

                    }



                } else {

                    $this.removeClass('header-sticky');



                    if(window_w <= size_point) {

                        $this.find('.header_menu').css('top', (this_h + top_h + 2) + 'px');

                    }

                }



                

        }

    }



    /* Menu Resize */

    function MenuResize() {



        if( $('#header_content').length ) {



            var $this = $('#header_content'),

                size_point = $this.data().responsive,

                window_scroll = $(window).scrollTop(),

                top_h = $('#header .header_top').innerHeight(),

                this_h = $this.innerHeight(),

                window_w = $(window).innerWidth();



            if(size_point == undefined || size_point == '') {

                size_point = 1199;

            }



            if(window_w <= size_point) {

                $this.addClass('header_mobile').removeClass('header_content');

            } else {

                $('.menu-bars').removeClass('active');

                $this.removeClass('header_mobile').addClass('header_content');

                $('#header_content .header_menu').css({

                    'top':''

                }).removeClass('active').find('ul').css('display', '');

            }

        }

    }



    /* Menu Click */

    MenuBar();

    function MenuBar() {



        $('.menu-bars').click(function(event) {



            if( $('.header_menu').hasClass('active') ) {

                $('.header_menu').removeClass('active');

                $(this).removeClass('active');

            } else {

                $('.header_menu').addClass('active');

                $(this).addClass('active');

            }



        });



        $('.menu li a').on('click', 'span', function(event) {

            event.preventDefault();

            

            var $this = $(this),

                $parent_li = $this.parent('a').parent('li'),

                $parent_ul = $parent_li.parent('ul');



            if( $parent_li.find('> ul').is(':hidden') ) {

                $parent_ul.find('> li > ul').slideUp();

                $parent_li.find('> ul').slideDown();

            } else {

                $parent_li.find('> ul').slideUp();

            }



            return false;

        });

    }



    /* AwePopup */

    AwePopup(CallBackPopup);



    function CallBackPopup() {

        PopupCenter();

    }

    

    function AwePopup(callback){



        $('.awe-ajax').click(function(event) {

            var $this = $(this),

                link_href= $this.attr('href');



            $('body').addClass('awe-overflow-h');

            $('#awe-popup-overlay, #awe-popup-wrap').addClass('in');



            getContentAjax(link_href,'#awe-popup-wrap .awe-popup-content', callback);



            return false;

        });



        $(document).on('click', '#awe-popup-overlay, #awe-popup-close, #awe-popup-wrap', function(event) {

            event.preventDefault();

            $('#awe-popup-wrap, #awe-popup-overlay').removeClass('in');

            $('body').removeClass('awe-overflow-h');

            $('#awe-popup-wrap .awe-popup-content').html('');

            return false;

        });



        $(document).on('click', '#awe-popup-wrap .awe-popup-content', function(event) {

            event.stopPropagation();

        });

    }



    function PopupCenter() {

        if($('#awe-popup-wrap').hasClass('in')) {



            var $this = $('#awe-popup-wrap .awe-popup-content'),

                window_h = $(window).innerHeight(),

                height_e = $this.innerHeight(),

                height_part = (window_h - height_e) / 2;



            if( height_e < window_h && height_e > 0) {



                $this.parent().css({

                    'padding-top': height_part + 'px',

                    'padding-bottom': '0'

                });



            } else {



                $this.parent().css({

                    'padding-top': '10px',

                    'padding-bottom': '10px'

                });

            }

        }

    }



    function getContentAjax(url, id, callback, beforesend) {

        $.ajax({

            url: url,

            type: 'POST',

            dataType: 'html',

            beforeSend: function() {

                if(beforesend) {

                    beforesend();

                }

            }

        })

        .done(function(data) {



            $(id).html(data);



            // Apply callback

            if (callback) {

                callback();

            }

        })

        .fail(function() {

            console.log("error");

        })

        .always(function() {

            console.log("complete");

        });

    }

    

    /*Banner Slide Mob*/

    BannerSliderMob();

    function BannerSliderMob() {

        if($('#banner-slider-mob').length) {

            var offset_h = $('#header').innerHeight();

            $('#banner-slider-mob').owlCarousel({

                autoPlay: 5000,

                navigation: true,

                singleItem: true,

                pagination:false,

                transitionStyle:'fade',

                navigationText: ['<i class="hillter-icon-left-arrow"></i>','<i class="hillter-icon-right-arrow"></i>'],

                beforeInit: function () {

                    var height = $('#banner-slider-mob').data().height,

                        window_h = $(window).height(),

                        window_w = $(window).width();



                    $('.slider-item').each(function(index, el) {

                        var url = $(this).data().image;



                        $(this).css('background-image', 'url('+url+')');



                        if( height !='' && height != undefined ) {



                            if(window_w > 767 ) {

                                $(this).css('height', height);

                            } else if(window_w <= 767 ) {

                                $(this).css('height', 500);

                            } else if(window_w <= 480 ) {

                                $(this).css('height', 400);

                            }



                        }else {

                            $(this).css('height', window_h - offset_h);

                        }



                    });



                },

                beforeUpdate: function() {

                    var height = $('#banner-slider-mob').data().height,

                        window_w = $(window).width();



                    if(!(height !='' && height != undefined)) {

                        $('.slider-item').each(function(index, el) {

                            var window_h = $(window).height();

                            $(this).css('height', window_h - offset_h +'px');

                        });

                    } else {

                        $('.slider-item').each(function(index, el) {

                            if(window_w > 767 ) {

                                $(this).css('height', height);

                            } else if(window_w <= 767 ) {

                                $(this).css('height', 500);

                            } else if(window_w <= 480 ) {

                                $(this).css('height', 400);

                            }

                        });

                    }

                }

            });

        }

    }



    /*Banner Slide*/

    BannerSlider();

    function BannerSlider() {

        if($('#banner-slider').length) {

            //var offset_h = $('#header').innerHeight();

            $('#banner-slider').owlCarousel({

                autoPlay: 5000,

                navigation: true,

                singleItem: true,

                pagination:false,

                transitionStyle:'fade',

                navigationText: ['<i class="hillter-icon-left-arrow"></i>','<i class="hillter-icon-right-arrow"></i>']

                // beforeInit: function () {

                //     var height = $('#banner-slider').data().height,

                //         window_h = $(window).height(),

                //         window_w = $(window).width();

                //

                //     $('.slider-item').each(function(index, el) {

                //         var url = $(this).data().image;

                //

                //         $(this).css('background-image', 'url('+url+')');

                //

                //         if( height !='' && height != undefined ) {

                //

                //             if(window_w > 767 ) {

                //                 $(this).css('height', height);

                //             } else if(window_w <= 767 ) {

                //                 $(this).css('height', 500);

                //             } else if(window_w <= 480 ) {

                //                 $(this).css('height', 400);

                //             }

                //

                //         }else {

                //             $(this).css('height', window_h - offset_h);

                //         }

                //

                //     });

                //

                // },

                // beforeUpdate: function() {

                //     var height = $('#banner-slider').data().height,

                //         window_w = $(window).width();

                //

                //     if(!(height !='' && height != undefined)) {

                //         $('.slider-item').each(function(index, el) {

                //             var window_h = $(window).height()

                //             $(this).css('height', window_h - offset_h +'px');

                //         });

                //     } else {

                //         $('.slider-item').each(function(index, el) {

                //             if(window_w > 767 ) {

                //                 $(this).css('height', height);

                //             } else if(window_w <= 767 ) {

                //                 $(this).css('height', 500);

                //             } else if(window_w <= 480 ) {

                //                 $(this).css('height', 400);

                //             }

                //         });

                //     }

                // }

            });

        }

    }



    /*Slider Home*/

    SliderRevolution();

    function SliderRevolution(){

        if($('#slider-revolution').length) {

            jQuery('#slider-revolution').show().revolution({

                dottedOverlay:"none",

                delay:7000,

                startwidth:1060,

                startheight:700,

                hideThumbs:200,

                

                thumbWidth:100,

                thumbHeight:50,

                thumbAmount:5,

                

                navigationType:"both",

                navigationArrows:"none",

                navigationStyle:"round",

                

                touchenabled:"on",

                onHoverStop:"off",

                

                swipe_velocity: 0.7,

                swipe_min_touches: 1,

                swipe_max_touches: 1,

                drag_block_vertical: false,

                                        

                parallax:"mouse",

                parallaxBgFreeze:"on",

                parallaxLevels:[7,4,3,2,5,4,3,2,1,0],

                                        

                keyboardNavigation:"off",

                

                navigationHAlign:"center",

                navigationVAlign:"bottom",

                navigationHOffset:0,

                navigationVOffset:20,



                soloArrowLeftHalign:"left",

                soloArrowLeftValign:"center",

                soloArrowLeftHOffset:20,

                soloArrowLeftVOffset:0,



                soloArrowRightHalign:"right",

                soloArrowRightValign:"center",

                soloArrowRightHOffset:20,

                soloArrowRightVOffset:0,

                        

                shadow:0,

                fullWidth:"on",

                fullScreen:"on",



                spinner:"spinner4",

                

                stopLoop:"off",

                stopAfterLoops:-1,

                stopAtSlide:-1,



                shuffle:"off",

                

                autoHeight:"off",                       

                forceFullWidth:"off",                       

                                        

                                        

                                        

                hideThumbsOnMobile:"off",

                hideNavDelayOnMobile:1500,                      

                hideBulletsOnMobile:"off",

                hideArrowsOnMobile:"off",

                hideThumbsUnderResolution:0,

                

                hideSliderAtLimit:0,

                hideCaptionAtLimit:0,

                hideAllCaptionAtLilmit:0,

                startWithSlide:0,

                fullScreenOffsetContainer: "#header"   

            });

        }

    }



    /* Gallery Isotope */

    function GalleryIsotope() {

        if($('.gallery').length ) {

            $('.gallery').each(function(index, el) {

                var $this = $(this),

                    $isotope = $this.find('.gallery-isotope'),

                    $filter = $this.find('.gallery-cat');



                    if($isotope.length) {

                        var isotope_run = function(filter) { 

                            $isotope.isotope({

                                itemSelector: '.item-isotope',

                                filter: filter,

                                percentPosition: true,

                                masonry: { columnWidth: '.item-size'},

                                transitionDuration: '0.8s',

                                hiddenStyle: { opacity: 0 },

                                visibleStyle: { opacity: 1 }

                            });

                        };



                        $filter.on('click', 'a:not(.disable__click)', function(event) {

                            event.preventDefault();

                            $(this).parents('ul').find('.active').removeClass('active');

                            $(this).parent('li').addClass('active');

                            isotope_run($(this).attr('data-filter'));

                        });

                        

                        var dataFilter = jQuery('.gallery-cat ul li:eq(0) a').attr('data-filter');

                            isotope_run(dataFilter);



                        /*if(window.location.pathname == '/') {

                            var dataFilter = jQuery('.gallery-cat ul li:eq(0) a').attr('data-filter');

                            isotope_run(dataFilter);

                        } else {

                            isotope_run('*');

                        }*/

                    }

            });

        }

    }



    /* Guest Book Masonry */

    function GuestBookMasonry() {

        if($('.guest-book_mansory').length ) {

            $('.guest-book_mansory').each(function(index, el) {

                $(this).isotope({

                    itemSelector: '.item-masonry'

                });

            });

        }

    }



    /* Owl Single */

    OwlSingle();

    function OwlSingle() {

        if($('.owl-single').length) {

            $('.owl-single').each(function(index, el) {

                var $this = $(this);

                $this.owlCarousel({

                    autoPlay: 4000,

                    autoplayHoverPause: true,

                    singleItem: true,

                    smartSpeed: 1000,

                    navigation:true,

                    navigationText: ['<i class="hillter-icon-left-arrow"></i>','<i class="hillter-icon-right-arrow"></i>']

                });

            });

        }

    }



    /* Coming Soon */

    CountDown();

    function CountDown() {

        if($('#countdown').length) {



            var nextYear = new Date(new Date().getFullYear() + 1, 1 - 1, 26);

            $('#countdown').countdown(nextYear, function(event) {

                var $this = $(this).html(event.strftime(''

                + '<div class="item"><span class="count">%D</span><span>Days</span></div>'

                + '<div class="item"><span class="count">%H</span><span>Hours</span></div>'

                + '<div class="item"><span class="count">%M</span><span>Minutes</span></div>'

                + '<div class="item"><span class="count">%S</span><span>Seconds</span></div>'));

            });

        }

    }



    CountDate();

    /*==========  Count Date ==========*/

    function CountDate(){

        if($('.count-date').length){

            $('.count-date').each(function(index, el) {

                var $this = $(this),

                    end_date = $this.attr('data-end');



                if($this.attr('data-end') !=='' && typeof $this.attr('data-end') !== 'undefined' ) {



                   $this.countdown(end_date, function(event) {

                     $(this).html(

                        event.strftime('<span> %D <span>Days</span></span> <span> %H <span>HOURS</span></span> <span> %M <span>MINUTES</span></span> <span> %S <span>SECONDS</span></span>')

                     );

                  });



                }



            });

        }

    }



    /* Popup Gallery */

    GalleryPopup();

    function GalleryPopup() {



        if($('.gallery_item').length) {



            $('.gallery_item a').magnificPopup({

                //delegate: 'a', // the selector for gallery item

                type: 'image',

                mainClass: 'mfp-with-zoom',

                zoom: {

                    enabled: true,

                    duration: 300,

                    easing: 'ease-in-out'

                },

                gallery: {

                    enabled: true,

                    arrowMarkup: '<button title="%title%" type="button" class="mfp-prevent-%dir% hillter-icon-%dir%-arrow"></button>',

                    tPrev: '',

                    tNext: '',

                    tCounter: '<span class="mfp-counter">%curr% из %total%</span>'

                }

            });

        }

    }



    /*Gallery Room Detail*/

    GalleryRoomDetail();

    function GalleryRoomDetail() {



        if($('.room-detail_img').length ) {



            $(".room-detail_img").owlCarousel({

                navigation : true,

                pagination: false,

                navigationText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],

                singleItem: true,

                mouseDrag:false,

                transitionStyle:'fade'

            });

        }



        if($('.room-detail_thumbs').length ) {



            $(".room-detail_thumbs").owlCarousel({

                items: 7,

                pagination: false,

                navigation : true,

                mouseDrag:false,

                navigationText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],

                itemsCustom:[[0,3], [320,4], [480,5], [768,6], [992,7], [1200,7]]

            });



            if( $(".room-detail_img").data("owlCarousel") !== undefined && $(".room-detail_thumbs").data("owlCarousel") !== undefined ) {

                $('.room-detail_thumbs').on('click','.owl-item',function(event) {



                    var $this= $(this),

                        index = $this.index();

                    $('.room-detail_thumbs').find('.active').removeClass('active');

                    $this.addClass('active');

                    $(".room-detail_img").data("owlCarousel").goTo(index);



                    return false;

                });

            }

        }

    }



    /* ACCOMMODATIONS SLIDE */

    Accommodations1();

    function Accommodations1() {

        if( $('.accomd-modations-slide_1').length ) {



            $(".accomd-modations-slide_1").owlCarousel({

                pagination: true,

                navigation : false,

                itemsCustom:[[0,1], [480,2], [992,3], [1200,3]]

            });



        }

    }

    

    GalleryCarousel();

    function GalleryCarousel() {

        if ($('.gallery-carousel'.length)) {

            $(".gallery-carousel").owlCarousel({

                navigation: true,

                singleItem: true,

                pagination:false,

                transitionStyle:'fade',

                navigationText: ['<i class="hillter-icon-left-arrow"></i>','<i class="hillter-icon-right-arrow"></i>']

            });

        }

    }



    /* SET BACKGROUND ROOM ITEM */

    BackgroundRoomItem();

    function BackgroundRoomItem() {

        $('.room_item-6, .room_item-5').each(function(index, el) {

            var $this = $(this),

                link_src = $this.data().background;

                

            if(link_src != undefined && link_src !='') {

                $this.css('background-image', 'url('+ link_src +')');

            }

        });

    }



    /* Parallax */

    function ParallaxScroll() {

        if (isMobile.iOS()) {

            $('.awe-parallax, .awe-static').addClass('fix-background-ios');

        } else {

            $('.awe-parallax').each(function(index, el) {

                $(this).parallax("50%", 0.2);

            });

        }

    }



    /*GOOGLE MAP*/

    function ContactMap() {

        if($('#map').length) {

            var $this = $('#map'),

                center = ($this.data().center).split(','),

                locations = ($this.data().locations).split('--');



            var LatLng_center = new google.maps.LatLng(center[0], center[1]);



            /* Map Option */

            var mapOptions = {

                zoom: 16,

                scrollwheel: false,

                center: LatLng_center

            };



            /* Create Map*/

            var map = new google.maps.Map(document.getElementById('map'), mapOptions);



            /* Marker Map */

            for (var i = 0; i < locations.length; i++) {

                var LatLng = locations[i].split(',');



                var locationmarker = new google.maps.LatLng(LatLng[0], LatLng[1])



                setMarket(map, locationmarker, '', '');

            }



            $('.location-item').on('click', function(event) {

                event.preventDefault();

                 var $this = $(this),

                    location_item = ($this.data().location).split(',');



                var location_center = new google.maps.LatLng(location_item[0], location_item[1]);



                map.setCenter(location_center);

            });

        }

    }



    /* Set Market */

    function setMarket(map, location, title, content) {



        /* Icon Marker*/

        var icon_map = {

            url:'images/icon-marker.png',

            size: new google.maps.Size(27, 40), 

            origin: new google.maps.Point(0,0),

            anchor: new google.maps.Point(14,40)

        };



        var marker =  new google.maps.Marker({

            position: location,

            map: map,

            draggable: false,

            icon: icon_map,

            title: title

        });

    }



    /* MAP ATTRACTION */ 

    function AttractionMap() {



        if($('#attraction-maps').length ) {

            var infoWindow = new google.maps.InfoWindow();

            var $firstload = $('#attraction_location').find('.active a'),

                firstlocation = ($firstload.data().latlng).split(',');



            var latlng = new google.maps.LatLng(firstlocation[0], firstlocation[1]);



            /* Map Option */

            var mapOptions = {

                zoom: 16,

                scrollwheel: false,

                center: latlng

            };



            /* Create Map*/

            var map = new google.maps.Map(document.getElementById('attraction-maps'), mapOptions);



            infoWindow.setOptions({

                content: "<div class='info-location-map'><h2>"+$firstload.data().title+"</h2><span>"+$firstload.data().address+"</span></div>",

                position: latlng,

            });



            infoWindow.open(map); 



            $(document).on('click', '#attraction_location a', function(event) {

                event.preventDefault();



                var $this = $(this),

                    url = $this.attr('href'),

                    location = ($this.data().latlng).split(','),

                    title = $this.data().title,

                    address = $this.data().address;



                $this.parents('#attraction_location').find('.active').removeClass('active');

                $this.parent('li').addClass('active');



                /* Ajax Content */

                getContentAjax(url,'#attraction_content');



                /* Info Window */

                latlng = new google.maps.LatLng(location[0], location[1]);



                map.setCenter(latlng); 



                infoWindow.open(map); 



                infoWindow.setOptions({

                    content: "<div class='info-location-map'><h2>"+ title +"</h2><span>"+ address +"</span></div>",

                    position: latlng,

                });



                return false;



            });



            google.maps.event.addDomListener(window, "resize", function() {

                google.maps.event.trigger(map, "resize");

                map.setCenter(latlng); 

            });

        }

    }



    function AttractionClick(){

        var window_w = window.innerWidth;



        if( window_w < 991 ) {

            $('.attraction_sidebar .attraction_heading').addClass('attraction_heading_dropdown');

        } else {

            $('.attraction_sidebar .attraction_heading').removeClass('attraction_heading_dropdown');

            $('.attraction_sidebar .attraction_sidebar-content').css('display', '');

        }

    }



    AttractionList();

    function AttractionList() {

        $('.attraction_sidebar').on('click', '.attraction_heading_dropdown', function(event) {

            event.preventDefault();



            if($('.attraction_sidebar-content').is(':hidden')) {

                $('.attraction_sidebar .attraction_sidebar-content').slideDown();

            } else {

                $('.attraction_sidebar .attraction_sidebar-content').slideUp();

            }

        });

    }



    /*STATISTICS Count Number*/

    StatisticsCount();

    function StatisticsCount() {

        if($('.statistics_item .count').length) {



            $('.statistics_item').appear(function () {



                var count_element = $('.count', this).html();

                $(".count", this).countTo({

                    from: 0,

                    to: count_element,

                    speed: 2000,

                    refreshInterval: 50,

                });

            });

        }

    }



    /*View Password*/

    ViewPassword();

    function ViewPassword() {

        $('.view-pass').mousedown(function(event) {

            $(this).prev('input[type="password"]').attr('type', 'text');

        });

        $('.view-pass').mouseup(function(event) {

            $(this).prev('input[type="text"]').attr('type', 'password');

        });

    }



    $(document).ready(function() {

        $(window).load(function() {

            $('#preloader').delay(1000).fadeOut('400', function() {

                    $(this).fadeOut()

            });

            $('body').append('<div class="awe-popup-overlay" id="awe-popup-overlay"></div><div class="awe-popup-wrap" id="awe-popup-wrap"><div class="awe-popup-content"></div><span class="awe-popup-close" id="awe-popup-close"></div>');

            GalleryIsotope();

            GuestBookMasonry();

            AttractionMap();

            ContactMap();

        });



        $(window).scroll(function(event) {

            MenuSticky();

        });



        $(window).resize(function(event) {

            ParallaxScroll();

            PopupCenter();

            MenuResize();

            MenuSticky();

            AttractionClick();

        }).trigger('resize');

        

    });



    //scroll-pane

    jQuery('.scroll-pane').jScrollPane();



    jQuery('.gallery__item').magnificPopup({

        tClose: 'Закрыть',

        tLoading: 'Загрузка...',

        type: 'image',

        zoom: {

            enabled: true,

            duration: 300,

            easing: 'ease-in-out'

        }

    });



    $('.table__price .gallery').each(function() { // the containers for all your galleries

        $(this).magnificPopup({

            delegate: 'a',

            type: 'image',

            gallery: {

                enabled:true,

                arrowMarkup: '<button title="%title%" type="button" class="mfp-prevent-%dir% hillter-icon-%dir%-arrow"></button>',

                tPrev: '',

                tNext: '',

                tCounter: '<span class="mfp-counter">%curr% из %total%</span>'

            }

        });

    });



    jQuery('.guest-book_item a, a.colorbox').magnificPopup({

        tClose: 'Закрыть',

        tLoading: 'Загрузка...',

        type: 'image',

        zoom: {

            enabled: true,

            duration: 300,

            easing: 'ease-in-out'

        },

        gallery: {

            enabled: true,

            arrowMarkup: '<button title="%title%" type="button" class="mfp-prevent-%dir% hillter-icon-%dir%-arrow"></button>',

            tPrev: '',

            tNext: '',

            tCounter: '<span class="mfp-counter">%curr% из %total%</span>'

        }

    });



    /*

    |-----------------------------------------------------------

    |   custom datepicker

    |-----------------------------------------------------------

    */

    var arrival_date = jQuery('.date_in input'),

        departure_date = jQuery('.date_out input'),

        tomorrow = new Date(new Date().getTime() + 24 * 60 * 60 * 1000);



    departure_date.datepicker({

        'autoClose': true,

        'dateFormat': 'dd.mm.yyyy',

        'minDate': tomorrow

    });



    arrival_date.datepicker({

        'autoClose': true,

        'dateFormat': 'dd.mm.yyyy',

        'minDate': new Date(),

        onSelect: function (fd, date) {

            if(date){

                var change_date = new Date(date.getTime()),

                    departure_date_val = departure_date.val().split('.');



                departure_date_val = new Date(

                    parseInt(departure_date_val[2]),

                    parseInt(departure_date_val[1]) - 1,

                    parseInt(departure_date_val[0])

                );



                departure_date.data('datepicker').update('minDate', new Date(date.getTime() + 24*60*60*1000));



                if(departure_date_val <= change_date){

                    return departure_date.val('');

                }

            }

            return true;

        }

    });



    var form = jQuery('form');

    form.on('click', '.hillter-icon-calendar', function () {

        return jQuery(this).closest('div').find('label').click();

    });



    if($('.preloader').length){

		$('.preloader').delay(200).fadeOut(500);

    }

		

    var roomName = window.location.href.split("#")[1];

    if(roomName){

        jQuery("form option[value='" + decodeURIComponent(roomName) + "']").prop("selected", true);

    }



    //form message

    form.on('click', '.message label', function () {

        return jQuery(this).next('textarea').toggle();

    });



    jQuery('.rooms__carousel').owlCarousel({

        navigation : true, // Show next and prev buttons

        slideSpeed : 1500,

        //autoPlay: 5000,

        paginationSpeed : 1000,

        items: 4,

        itemsTablet: [768,2],

        itemsDesktopSmall: [979,3],

        itemsDesktop: [1199,3],

        itemsMobile: [479,1],

        navigationText: ['<i class="hillter-icon-left-arrow"></i>','<i class="hillter-icon-right-arrow"></i>'],

        pagination: false

    });



    roomName = jQuery('.text h1').text();

    if(roomName){

        jQuery("form.form_room_booking option[value='" + roomName + "']").prop("selected", true);

    }



    var menuBar = jQuery('.for__mobile-gallery-cat');

    menuBar.on('click', '.title', function () {

        return menuBar.find('.list-inline').toggleClass('for__mobile-gallery-cat-hidden');

    });

    menuBar.on('click', 'li', function () {

        return menuBar.find('.list-inline').addClass('for__mobile-gallery-cat-hidden');

    });



    jQuery('.disable__click').on('click', function (e) {

        return e.preventDefault();

    });



    var sliderAction = jQuery(".slider__actions");

    if(sliderAction.length) {

        sliderAction.owlCarousel({

            autoPlay: 5000,

            navigation: true,

            singleItem: true,

            pagination:false,

            transitionStyle:'fade',

            navigationText: ['','']

        });

    }



    madeAjaxForm('#guestbook__form');

    madeAjaxForm('#calculate__form');

    madeAjaxForm('#form_main_booking', true);

    madeAjaxForm('#form_ask_question');

    madeAjaxForm('#form_callback');

    madeAjaxForm('#form_recall');

    madeAjaxForm('#form_room_booking', true);



})(jQuery);



function madeAjaxForm(selector, hiddenForm){

    if(!hiddenForm){

        hiddenForm = false;

    }

    jQuery(document).on("submit", selector, function(e){

        e.preventDefault();

        var _this = jQuery(this),

        url = _this.attr('action'),

        data = _this.serialize();



        jQuery.ajax({

            type: "POST",

            dataType: "json",

            url: url,

            data: data

        }).done(function(data){

            _this.find('.alert__box')

                .removeClass('alert-danger')

                .removeClass('robot')

                .removeClass('alert-success')

                .addClass('alert-' + data.status)

                .show();



            if (data.status == 'success') {

                _this.trigger('reset');

                if(hiddenForm) {

                    _this.hide();

                } else {

                    setTimeout(hideForm, 3000);

                }

            }



            return jQuery('.alert__box').html(data.message);

        });

    });

}



function hideForm() {

    jQuery('.alert__box').fadeIn().delay(3000).fadeOut();

    $('#awe-popup-wrap, #awe-popup-overlay').removeClass('in');

    $('body').removeClass('awe-overflow-h');

    return $('#awe-popup-wrap .awe-popup-content').html('');

}



var onLoadCaptchaCallback = function() {

    var mysitekey = jQuery('.g-recaptcha').attr('data-sitekey');

    $(function(){

        $(".g-recaptcha").each(function(indx, element){

            var elId = $(element).attr('id');

            if (elId) {

                grecaptcha.render(elId, {

                    'sitekey' : mysitekey

                });

            } else {

                console.log('fail captcha selector');

            }

        });

    });



};



/* PRICE HEADER FIX */
function windowSizeForTablePrice(){
    if ($(window).width() <= '767'){
        $("table.hidden-xs").detach();
        $('.table__price:not(.hidden-xs)').stickypricehead({
            stickPrevP: true,
            offsetBlock: '.header_mobile'
        });
        $('.table__price tr:first-child th:first-child').hide();
    } else {
        $('.table__price:not(.visible-xs)').stickypricehead({
            stickPrevP: true
        });
    }
};

$(document).ready(windowSizeForTablePrice);

/* AND | PRICE HEADER FIX */

