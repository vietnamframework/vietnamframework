'use strict';

var Web5s = function (options) {
    // Login Register
    var runLoginTrigger = function () {
        $("#modal_trigger").leanModal({top: 150, overlay: 0.6, closeButton: ".modal_close"});
        $(function () {
            // Calling Register Form
            $("#register_form").click(function () {
                $(".user_login").hide();
                $(".user_register").show();
                $(".header_title").text('Đăng ký');
                return false;
            });

            // Going back to Login Forms
            $(".back_btn").click(function () {
                $(".user_login").show();
                $(".user_register").hide();
                $(".header_title").text('Đăng nhập');
                return false;
            });
        });
    }
    // Menu Home
    var runMenuHome = function () {
        jQuery(document).ready(function () {
            jQuery('.menu-trigger a').on('click', function (e) {
                e.preventDefault();
                jQuery(this).closest('.nav-wrapper').children(".menu-dropdown").toggleClass("active");
                jQuery(this).children('.icon').delay(300).toggleClass('open');
            });
        });
    }

    // SlideShow
    var runSlideShow = function () {
        $("#owl-slideshow-web5s").owlCarousel({
            items: 1,
            loop: true,
            nav: true,
            navText: ["<i class='fa fa-caret-left'></i>", "<i class='fa fa-caret-right'></i>"],
            dots: true,
            smartSpeed: 450,
            animateOut: 'fadeOut',
            animateIn: 'fadeIn',
            autoplay: true,
            autoplayHoverPause: true
        });
        
        $('#hotdealTab a').click(function (e) {
            e.preventDefault();
            $(this).tab('show');
        });
    }

    // New Featured
    var runNewFeatured = function () {
        $("#owl-newfeatured-web5s").owlCarousel({
            items: 6,
            loop: true,
            nav: true,
            navText: ["<i class='fa fa-caret-left'></i>", "<i class='fa fa-caret-right'></i>"],
            dots: false,
            responsive: {
                0: {items: 1},
                414: {items: 2},
                768: {items: 3},
                992: {items: 3},
                1200: {items: 6}
            },
            autoplay: false,
            autoplayHoverPause: true
        });
    }

    // Scroll Filter
    var runScrollFilter = function () {
        $(document).ready(function () {
            $(".scroll-list ol").mCustomScrollbar({
                scrollButtons: {
                    enable: true
                }
            });
        });
    }

    // IMG Zoom
    var runIMGZoom = function () {
        $('#web5s-zoom').elevateZoom({
            zoomType: "inner",
            cursor: "pointer",
            zoomWindowFadeIn: 500,
            zoomWindowFadeOut: 750,
            gallery: 'gallery-img-list',
            galleryActiveClass: 'active'
        });

        var windowsize = $(window).width();
        if (windowsize < 767) {
            $('#gallery-img-list').bxSlider({
                mode: 'vertical',
                minSlides: 1,
                pager: false,
                slideMargin: 6,
                moveSlides: 1,
                nextSelector: '#slider-next',
                prevSelector: '#slider-prev',
                nextText: '<i class="fa fa-angle-down"></i>',
                prevText: '<i class="fa fa-angle-up"></i>',
                infiniteLoop: false,
                hideControlOnEnd: true
            });
        } else {
            $('#gallery-img-list').bxSlider({
                mode: 'vertical',
                minSlides: 4,
                pager: false,
                slideMargin: 6,
                moveSlides: 1,
                nextSelector: '#slider-next',
                prevSelector: '#slider-prev',
                nextText: '<i class="fa fa-angle-down"></i>',
                prevText: '<i class="fa fa-angle-up"></i>',
                infiniteLoop: false,
                hideControlOnEnd: true
            });
        }
    }

    // Custom JS
    var runCustomJS = function () {
        $('.le-quantity a').click(function (e) {
            e.preventDefault();
            var currentQty = $(this).parent().parent().find('input[name=qty], .le-quantity input[type=text]').val();
            if ($(this).hasClass('minus') && currentQty > 0) {
                $(this).parent().parent().find('input[name=qty], .le-quantity input[type=text]').val(parseInt(currentQty, 10) - 1);
            } else {
                if ($(this).hasClass('plus')) {
                    $(this).parent().parent().find('input[name=qty], .le-quantity input[type=text]').val(parseInt(currentQty, 10) + 1);
                }
            }
        });

        $('#productTab a').click(function (e) {
            e.preventDefault();
            $(this).tab('show');
        });
        (function ($) {
            fakewaffle.responsiveTabs(['xs', 'sm']);
        })(jQuery);
    }

    var runCheckout = function()
    {
        $("#divCheckoutLogin").show();
        $("#divCheckoutCallback").hide();
        $("input[name$='user_type']").click(function() 
        {
            var _url  =  $(this).attr("_url");
            var value = $(this).val();

            // Set action cho form
            $("#form_checkout").attr("action", _url);
            if (value == 'Yes') 
            {
                  $("#divCheckoutLogin").show();
                  $("#divCheckoutCallback").hide();
                  $("button[type=submit]").removeAttr("disabled");
                  $('#form_login_password').prop('disabled', false);
            } 
            else 
            {
                  $("#divCheckoutCallback").show();
                  $("#divCheckoutLogin").hide();
                  $("#divCheckoutLogin button[type=submit]").attr("disabled", "disabled");
                  $('#form_login_password').prop('disabled', true);
            }
        });
    }

    var runTooltip = function () {
        var originalLeave = $.fn.popover.Constructor.prototype.leave;
        $.fn.popover.Constructor.prototype.leave = function (obj) {
            var self = obj instanceof this.constructor ?
                    obj : $(obj.currentTarget)[this.type](this.getDelegateOptions()).data('bs.' + this.type)
            var container, timeout;
            originalLeave.call(this, obj);
            if (obj.currentTarget) {
                container = $(obj.currentTarget).siblings('.popover')
                timeout = self.timeout;
                container.one('mouseenter', function () {
                    clearTimeout(timeout);
                    container.one('mouseleave', function () {
                        $.fn.popover.Constructor.prototype.leave.call(self, self);
                    });
                })
            }
        };
        $('[data-toggle="popover"]').popover({
            html: true,
            trigger: 'click hover',
            placement: 'top',
            delay: {show: 50, hide: 50}
        });
    }

    // Sale Code
    var runsaleCode = function () {
        $(document).ready(function () {
            $('#saleOff_label a').click(function () {
                $('#saleoffCode').addClass('show');
            });
            $('.hb-remove').click(function () {
                $('#saleoffCode').removeClass('show');
            });
        });

        $('input[type="checkbox"]').click(function () {
            if ($(this).attr("value") == "addhome") {
                $("#frm-shipping").slideToggle(400);
            }
            if ($(this).attr("value") == "addVAT") {
                $(".body_VAT").slideToggle(400);
            }
        });
    }

    // Back to Top
    var runTotop = function () {
        var offset = 300,
                //browser window scroll (in pixels) after which the "back to top" link opacity is reduced
                offset_opacity = 1200,
                //duration of the top scrolling animation (in ms)
                scroll_top_duration = 700,
                //grab the "back to top" link
                $back_to_top = $('.bTo-top');

        //hide or show the "back to top" link
        $(window).scroll(function () {
            ($(this).scrollTop() > offset) ? $back_to_top.addClass('bTo-is-visible') : $back_to_top.removeClass('bTo-is-visible bTo-fade-out');
            if ($(this).scrollTop() > offset_opacity) {
                $back_to_top.addClass('bTo-fade-out');
            }
        });

        //smooth scroll to top
        $back_to_top.on('click', function (event) {
            event.preventDefault();
            $('body,html').animate({
                scrollTop: 0,
            }, scroll_top_duration
                    );
        });
    }

    return {
        init: function (options) {
            runLoginTrigger();
            runMenuHome();
            runSlideShow();
            runNewFeatured();
            runScrollFilter();
            runIMGZoom();
            runCustomJS();
            runCheckout();
            runTooltip();
            runsaleCode();
            runTotop();
        }
    }
}();
