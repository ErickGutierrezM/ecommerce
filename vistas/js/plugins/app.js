(function($) {
    "use strict"; // Start of use strict
    // Smooth scrolling using jQuery easing
    $('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function() {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location
            .hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                $('html, body').animate({
                    scrollTop: (target.offset().top - 54)
                }, 1000, "easeInOutExpo");
                return false;
            }
        }
    });

    // Closes responsive menu when a scroll trigger link is clicked
    $('.js-scroll-trigger').click(function() {
        $('.navbar-collapse').collapse('hide');
    });

    // Activate scrollspy to add active class to navbar items on scroll
    $('body').scrollspy({
        target: '#mainNav',
        offset: 56
    });

    // Collapse Navbar
    var navbarCollapse = function() {
        if ($("#mainNav").offset().top > 10) {
            $("#mainNav").addClass("navbar-shrink");
        } else {
            $("#mainNav").removeClass("navbar-shrink");
        }
    };
    // Collapse now if page is not at top
    navbarCollapse();
    // Collapse the navbar when page is scrolled
    $(window).scroll(navbarCollapse);

    // Hide navbar when modals trigger
    $('.portfolio-modal').on('show.bs.modal', function(e) {
        $(".navbar").addClass("d-none");
    })
    $('.portfolio-modal').on('hidden.bs.modal', function(e) {
        $(".navbar").removeClass("d-none");
    })

})(jQuery); // End of use strict

// $(document).mouseup(function (e){
// 	var container = $(".navbar-collapse.collapse.show .navbar-nav");
// 	if (!container.is(e.target) && container.has(e.target).length === 0){
// 	  $('.navbar-collapse').collapse('hide');
// 	}
// });


$('.navbar-nav>li>a').click(function() {
    $('.navbar-collapse').collapse('hide');
    $('#burger-icon').toggleClass('show');

});

$('#burger-icon').click(function(e) {
    $(this).toggleClass('show');
    var container = $(".navbar-collapse.collapse.show .navbar-nav");
    if (!container.is(e.target) && container.has(e.target).length === 0) {
        $('.navbar-collapse').collapse('hide');
    }
});


$(document).ready(function() {
    var href = window.location.href;
    $('navbar-nav a').each(function(e, i) {
        if (href.indexOf($(this).attr('href')) >= 0) {
            $(this).addClass('active');
        }
    });
});

$(window).resize(function() {
    if ($(window).width() < 768) {
        $('#separator').removeClass('separator');
        $('#nuestroServicios img').each(function() {
            $(this).attr('src', $(this).attr('data-mobile'));
        });
    } else {
        $('#separator').addClass('separator');
        $('#nuestroServicios img').each(function() {
            $(this).attr('src', $(this).attr('data-default'));
        });
    }
}).resize();

$(document).click(function(e) {
    var clickover = $(e.target);
    var open = $(".navbar-collapse").hasClass("show");
    if (open === true && !clickover.hasClass("navbar-toggler")) {
        $(".navbar-toggler").click();
    }
});

//menu azul
$(document).ready(function() {
    "use strict";

    var menuActive = false;
    var header = $('.header');
    setHeader();
    initCustomDropdown();
    initPageMenu();

    function setHeader() {

        if (window.innerWidth > 991 && menuActive) {
            closeMenu();
        }
    }

    function initCustomDropdown() {
        if ($('.custom_dropdown_placeholder').length && $('.custom_list').length) {
            var placeholder = $('.custom_dropdown_placeholder');
            var list = $('.custom_list');
        }

        placeholder.on('click', function(ev) {
            if (list.hasClass('active')) {
                list.removeClass('active');
            } else {
                list.addClass('active');
            }

            $(document).one('click', function closeForm(e) {
                if ($(e.target).hasClass('clc')) {
                    $(document).one('click', closeForm);
                } else {
                    list.removeClass('active');
                }
            });

        });

        $('.custom_list a').on('click', function(ev) {
            ev.preventDefault();
            var index = $(this).parent().index();

            placeholder.text($(this).text()).css('opacity', '1');

            if (list.hasClass('active')) {
                list.removeClass('active');
            } else {
                list.addClass('active');
            }
        });


        $('select').on('change', function(e) {
            placeholder.text(this.value);

            $(this).animate({ width: placeholder.width() + 'px' });
        });
    }

    /*

    4. Init Page Menu

    */

    function initPageMenu() {
        if ($('.page_menu').length && $('.page_menu_content').length) {
            var menu = $('.page_menu');
            var menuContent = $('.page_menu_content');
            var menuTrigger = $('.menu_trigger');

            //Open / close page menu
            menuTrigger.on('click', function() {
                if (!menuActive) {
                    openMenu();
                } else {
                    closeMenu();
                }
            });

            //Handle page menu
            if ($('.page_menu_item').length) {
                var items = $('.page_menu_item');
                items.each(function() {
                    var item = $(this);
                    if (item.hasClass("has-children")) {
                        item.on('click', function(evt) {
                            evt.preventDefault();
                            evt.stopPropagation();
                            var subItem = item.find('> ul');
                            if (subItem.hasClass('active')) {
                                subItem.toggleClass('active');
                                TweenMax.to(subItem, 0.3, { height: 0 });
                            } else {
                                subItem.toggleClass('active');
                                TweenMax.set(subItem, { height: "auto" });
                                TweenMax.from(subItem, 0.3, { height: 0 });
                            }
                        });
                    }
                });
            }
        }
    }

    function openMenu() {
        var menu = $('.page_menu');
        var menuContent = $('.page_menu_content');
        TweenMax.set(menuContent, { height: "auto" });
        TweenMax.from(menuContent, 0.3, { height: 0 });
        menuActive = true;
    }

    function closeMenu() {
        var menu = $('.page_menu');
        var menuContent = $('.page_menu_content');
        TweenMax.to(menuContent, 0.3, { height: 0 });
        menuActive = false;
    }


});