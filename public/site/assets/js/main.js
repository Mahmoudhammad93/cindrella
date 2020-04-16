/*
	Retrospect by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
*/

(function($) {

	skel
		.breakpoints({
			xlarge: '(max-width: 1680px)',
			large: '(max-width: 1280px)',
			medium: '(max-width: 980px)',
			small: '(max-width: 736px)',
			xsmall: '(max-width: 480px)'
		});

	$(function() {

		var	$window = $(window),
			$body = $('body');

		// Disable animations/transitions until the page has loaded.
        // $body.addClass('is-loading');
        $body.addClass('loading');

			$window.on('load', function() {
				window.setTimeout(function() {
                    $body.removeClass('is-loading');
                    $body.removeClass('loading');
				}, 100);
			});

		// Fix: Placeholder polyfill.
			$('form').placeholder();

		// Prioritize "important" elements on medium.
			skel.on('+medium -medium', function() {
				$.prioritize(
					'.important\\28 medium\\29',
					skel.breakpoint('medium').active
				);
			});

		// Nav.
			$('#nav')
				.append('<a href="#nav" class="close"></a>')

				.panel({
					delay: 500,
					hideOnClick: true,
					hideOnSwipe: true,
					resetScroll: true,
					resetForms: true,
					side: 'right'
				});

	});

    $('.wrapper.style3.slider').height(window.innerHeight / 1.3);

    //Smooth Scroll To Div
    $('#banner .actions a.button.big.special').click(function (e) {
        e.preventDefault();
        $('html, body').animate({
            scrollTop: $('#' + $(this).data('value')).offset().top - 30
        }, 1000);
    });

    //Smooth Scroll To Div From Top Nav
    $('.top-navbar .nav ul li a, #nav > ul.links > li a').click(function (e) {
        $(this).parent().addClass('active').siblings().removeClass('active');
        if($(this).attr('data-value')){
            e.preventDefault();
            $('html, body').animate({
                scrollTop: $('#' + $(this).data('value')).offset().top - 30
            }, 1000);
        }
    });

    // $(window).scroll(function () {
    //     if ($('body').hasClass('landing') && $(this).scrollTop() >= 300){
    //         $('header').removeClass('alt');
    //     }else{
    //         $('header').addClass('alt');
    //     }
    // });

    $(document).ready(function(){

        var $p1 = $('.progress1'),
            $p2 = $('.progress2'),
            $p3 = $('.progress3'),
            $p4 = $('.progress4'),
            $p5 = $('.progress5');

        var $input1 = $('#setVal1'),
            $input2 = $('#setVal2'),
            $input3 = $('#setVal3'),
            $input4 = $('#setVal4'),
            $input5 = $('#setVal5');

        var val1 = parseInt($input1.val(), 10);
        if(val1 <= 100 && val1 > 0) {
            $p1.css({
                width: val1 + '%',
                backgroundPosition: val1 + '%'
            });
        }

        var val2 = parseInt($input2.val(), 10);
        if(val2 <= 100 && val2 > 0) {
            $p2.css({
                width: val2 + '%',
                backgroundPosition: val2 + '%'
            });
        }

        var val3 = parseInt($input3.val(), 10);
        if(val3 <= 100 && val3 > 0) {
            $p3.css({
                width: val3+ '%',
                backgroundPosition: val3 + '%'
            });
        }

        var val4 = parseInt($input4.val(), 10);
        if(val4 <= 100 && val4 > 0) {
            $p4.css({
                width: val4 + '%',
                backgroundPosition: val4 + '%'
            });
        }

        var val5 = parseInt($input5.val(), 10);
        if(val5 <= 100 && val5 > 0) {
            $p5.css({
                width: val5 + '%',
                backgroundPosition: val5 + '%'
            });
        }
    })//.focus()

    // To show rating details
    // To Show Rating Details
    $(document).on('click', '.rate-info-btn', function () {
        $(this).parent().find('.rate-bars').toggleClass('show');
        return false;
    });

    // To Open Search
    $(document).on('click', '#search', function () {
        $('.search').addClass('search-open');
        return false;
    });

    // To Close Search
    $(document).on('click', '.close-search', function () {
        $('.search').removeClass('search-open');
        $('#search-field').val('');
        $('.search-result').html('');
        $('.search-result').slideUp(0);
        return false;
    })

    // To Make Top Bar Absolute
    $(window).scroll(function(){
        if($(this).scrollTop() > 50){
            $('#header').addClass('in-scroll');
        }else{
            $('#header').removeClass('in-scroll');
        }
    })

    // To Add Class Active To Top Bar Links
    var scrollBotton = $("#scroll-top");
    $(window).scroll(function () {
        var scrollTop = $(this).scrollTop();
        if (scrollTop >= 600) {
            scrollBotton.addClass('fade-scrolltop');
        } else {
            scrollBotton.removeClass('fade-scrolltop');
        }
    });
    scrollBotton.click(function () {
        $("html,body").animate({scrollTop : 0}, 500);
    });

    // To Add Span Before For Active Link
    $(document).ready(function(){
        var span = '<span class="before"></span>';
        $('.top-navbar .nav ul li').append(span);
    })

})(jQuery);
