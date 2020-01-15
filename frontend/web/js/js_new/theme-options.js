/*
 *
 *		THEME-OPTIONS.JS
 *
 */

$(document).ready(function() {

    var theme_options_content = ' \
		<h4>Template Options</h4> \
		<a href="#"></a> \
		<br> \
		<h5>Change Color</h5> \
		<div class="colors clearfix"> \
			<a id="default" href="#" data-style="default"></a> \
			<a id="dark-gold" href="#" data-style="dark-gold"></a> \
			<a id="gold" href="#" data-style="gold"></a> \
			<a id="yellow" href="#" data-style="yellow"></a> \
			<a id="silver" href="#" data-style="silver"></a> \
			<a id="red" href="#" data-style="red"></a> \
			<a id="orange" href="#" data-style="orange"></a> \
			<a id="bordo" href="#" data-style="bordo"></a> \
			<a id="green" href="#" data-style="green"></a> \
			<a id="blue" href="#" data-style="blue"></a> \
		</div><!-- colors --> \
		<h5>Sticky Header</h5> \
		<div class="sticky clearfix"> \
			<div class="toggle-button"> \
				ON <span class="button"><a class="sticky-on" href="#" data-style="sticky-header-on"></a><a class="sticky-off" href="#" data-style="sticky-header-off"></a></span> OFF \
			</div><!-- toggle-button --> \
		</div><!-- sticky --> \
		<h5>Footer Style</h5> \
		<div class="footer clearfix"> \
			<div class="toggle-button"> \
				Parallax <span class="button"><a class="footer-parallax-on" href="#" data-style="footer-parallax-on"></a><a class="footer-parallax-off" href="#" data-style="footer-parallax-off"></a></span> Classic \
			</div><!-- toggle-button --> \
		</div><!-- footer --> \
	\ ';

    $("#theme-options").prepend(theme_options_content);

    $("#theme-options > a").on("click", function(e) {

        e.preventDefault();
        e.stopPropagation();
        $("#theme-options").toggleClass("open");

    });

    $("#theme-options").on("click", function(e) {

        e.stopPropagation();

    });

    $("body").on("click", function() {
        if ($("#theme-options").hasClass("open")) {
            $("#theme-options").removeClass("open");
        }
    });

    $(".sticky .button a").on("click", function(e) {
        e.preventDefault();
        $(".sticky .button a").removeClass("active")
        $(this).addClass("active");
    });

    $(".footer .button a").on("click", function(e) {
        e.preventDefault();
        $(".footer .button a").removeClass("active")
        $(this).addClass("active");
    });


    var link = $('link[data-style="styles"]');
    var justice_colors = $.cookie('justice_colors'),
        justice_sticky = $.cookie('justice_sticky'),
        justice_footer = $.cookie('justice_footer');

    if (!($.cookie('justice_colors'))) {

        $.cookie('justice_colors', 'default', 365);
        justice_colors = $.cookie('justice_colors');
        $('#theme-options .colors a[data-style="'+justice_colors+'"]');

    } else {

        link.attr('href','assets/css/alternative-styles/' + justice_colors + '.css');
        $(".header-classic #logo img").attr('src', 'assets/css/alternative-styles/logos/logo-' + justice_colors + '.png');
        $(".header-center #logo img, .header-bordered #logo img, #footer img").attr('src', 'assets/css/alternative-styles/logos/logo-white-' + justice_colors + '.png');
        $('#theme-options .colors a[data-style="'+justice_colors+'"]');

    };


    if (!($.cookie('justice_sticky'))) {

        $.cookie('justice_sticky', 'sticky-header-on', 365);
        justice_sticky = $.cookie('justice_sticky');
        $("body").addClass(justice_sticky);
        $('#theme-options .sticky a[data-style="sticky-header-on"]');

    } else {

        if (justice_sticky=="sticky-header-off") {

            $("body").addClass(justice_sticky);
            $("body").removeClass("sticky-header-on");

        } else {

            $("body").addClass(justice_sticky);
            $("body").removeClass("sticky-header-off");

        };

    };


    if (!($.cookie('justice_footer'))) {

        $.cookie('justice_footer', 'footer-parallax-on', 365);
        justice_footer = $.cookie('justice_footer');
        $("body").addClass(justice_footer);
        $('#theme-options .footer a[data-style="footer-parallax-on"]');

    } else {

        if (justice_footer=="footer-parallax-off") {

            $("body").addClass(justice_footer);
            $("body").removeClass("footer-parallax-on");

        } else {

            $("body").addClass(justice_footer);
            $("body").removeClass("footer-parallax-off");

        };

    };


    // CHANGE COLOR //
    $('#theme-options .colors a').on('click',function(e) {

        var $this = $(this),
            justice_colors = $this.data('style');

        e.preventDefault();

        link.attr('href', 'assets/css/alternative-styles/' + justice_colors + '.css');
        $(".header-classic #logo img").attr('src', 'assets/css/alternative-styles/logos/logo-' + justice_colors + '.png');
        $(".header-center #logo img, .header-bordered #logo img, #footer img").attr('src', 'assets/css/alternative-styles/logos/logo-white-' + justice_colors + '.png');
        $.cookie('justice_colors', justice_colors, 365);

    });


    // STICKY ON //
    $('#theme-options .sticky a.sticky-off').on('click',function(e) {

        e.preventDefault();

        $("body").addClass("sticky-header-off");
        $("body").removeClass("sticky-header-on");
        $.cookie('justice_sticky', 'sticky-header-off', 365);

    });

    // STICKY OFF //
    $('#theme-options .sticky a.sticky-on').on('click',function(e) {

        e.preventDefault();

        $("body").addClass("sticky-header-on");
        $("body").removeClass("sticky-header-off");
        $.cookie('justice_sticky', 'sticky-header-on', 365);

    });


    // FOOTER PARALLAX ON //
    $('#theme-options .footer a.footer-parallax-off').on('click',function(e) {

        e.preventDefault();

        $("body").addClass("footer-parallax-off");
        $("body").removeClass("footer-parallax-on");
        $.cookie('justice_footer', 'footer-parallax-off', 365);

    });

    // FOOTER PARALLAX OFF //
    $('#theme-options .footer a.footer-parallax-on').on('click',function(e) {

        e.preventDefault();

        $("body").addClass("footer-parallax-on");
        $("body").removeClass("footer-parallax-off");
        $.cookie('justice_footer', 'footer-parallax-on', 365);

    });


    if ($("body").hasClass("sticky-header-off") || (!$("body").hasClass("sticky-header"))) {
        $("#theme-options .sticky .button a.sticky-off").addClass("active");
    } else {
        $("#theme-options .sticky .button a.sticky-on").addClass("active");
    }

    if ($("body").hasClass("footer-parallax-off") || (!$("body").hasClass("footer-parallax"))) {
        $("#theme-options .footer .button a.footer-parallax-off").addClass("active");
    } else {
        $("#theme-options .footer .button a.footer-parallax-on").addClass("active");
    }

});