$(window).scroll(function() {
    if ($(".navbar").offset().top > 50) {
        $(".navbar-fixed-top").addClass("top-nav-collapse");
    } else {
        $(".navbar-fixed-top").removeClass("top-nav-collapse");
    }
});

$(function() {
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });

    // TODO: Intro Parallax?
    //skrollr.init({
    //    forceHeight: false
    //});

    $("#nexus_slider").coinslider({
        width: 263, // Not responsive at all!!!
        height: 515,
        delay: 3200, // delay between images in ms
        sDelay: 10, // delay beetwen squares in ms
        opacity: 0.7, // opacity of title and navigation
        titleSpeed: 500, // speed of title appereance in ms
        effect: '', // random, swirl, rain, straight
        links : false, // show images as links
        showNavigationButtons: false
    });

    $("#iphone_slider").coinslider({
        width: 261, // Not responsive at all!!!
        height: 532,
        delay: 3500, // delay between images in ms
        sDelay: 10, // delay beetwen squares in ms
        opacity: 0.7, // opacity of title and navigation
        titleSpeed: 500, // speed of title appereance in ms
        effect: 'rain', // random, swirl, rain, straight
        links : false, // show images as links
        showNavigationButtons: false
    });

    $("#galaxy_slider").coinslider({
        width: 266, // Not responsive at all!!!
        height: 515,
        delay: 3300, // delay between images in ms
        sDelay: 10, // delay beetwen squares in ms
        opacity: 0.7, // opacity of title and navigation
        titleSpeed: 500, // speed of title appereance in ms
        effect: 'random', // random, swirl, rain, straight
        links : false, // show images as links
        showNavigationButtons: false
    });


    $('[data-toggle="tooltip"]').tooltip();

    $('[data-toggle="popover"]').popover({
        container: 'body',
        html: true,
        placement: function (pop, dom_el) {
            var width = window.innerWidth;

            if (width <= 767) return 'bottom';

            var left_pos = $(dom_el).offset().left;
            if (width - left_pos > 400) return 'right';

            return 'left';
        },
        content: function () {
            var clone = $($(this).data('popover-content')).clone(true).removeClass('hide');
            return clone;
        }
    }).click(function(e) {
        $('[data-toggle="popover"]').not(this).popover('hide'); //all but this
        e.preventDefault();
    });

});

$('.navbar-collapse ul li a').click(function() {
    $('.navbar-toggle:visible').click();
});