<script>
    $( document ).ready(function() {
        $('.box-search-car .carsearch-input input').click(function (event) {
            if (  $( ".box-search-car .carsearch-popup" ).is( ":hidden" ) ) {
                $( ".box-search-car .carsearch-popup" ).effect('slide', { direction: 'right', mode: 'show' }, 500);
            }
            event.stopPropagation();
        });
        
        $('.box-search-car .carsearch-exit').click(function (event) {
            $('.box-search-car .carsearch-lv2, .box-search-car .carsearch-lv3, .box-search-car .carsearch-lv4').hide();
            $('.box-search-car .carsearch-lv1').show();
            $( ".box-search-car .carsearch-popup" ).effect('slide', { direction: 'right', mode: 'hide' }, 500);
            event.stopPropagation();
        });
        
        $('.box-search-car .carsearch-head').click(function (event) {
            if (  $(this).parents('.box-search-car .carsearch-lv1').length) {
                $('..box-search-car carsearch-lv2, .box-search-car .carsearch-lv3, .box-search-car .carsearch-lv4').hide();
                $('.box-search-car .carsearch-lv1').show();
                $( ".box-search-car .carsearch-popup" ).effect('slide', { direction: 'right', mode: 'hide' }, 500);
            }else if (  $(this).parents('.box-search-car .carsearch-lv2').length) {
                $('.box-search-car .carsearch-lv1').fadeIn();
                $('.box-search-car .carsearch-lv2').hide();
            }else if (  $(this).parents('.box-search-car .carsearch-lv3').length) {
                $('.box-search-car .carsearch-lv2').fadeIn();
                $('.box-search-car .carsearch-lv3').hide();
            }else if (  $(this).parents('.box-search-car .carsearch-lv4').length) {
                $('.box-search-car .carsearch-lv3').fadeIn();
                $('.box-search-car .carsearch-lv4').hide();
            }
            event.stopPropagation();
        });

        $('.box-search-car .carsearch-ul > li > button').click(function (event) {
            $('.box-search-car .carsearch-input input').val($(this).attr('rel'));
            if ( $(this).hasClass('carsearch-select-all')){
                $('.box-search-car .carsearch-lv2, .box-search-car .carsearch-lv3, .box-search-car .carsearch-lv4').hide();
                $('.box-search-car .carsearch-lv1').show();
                $( ".box-search-car .carsearch-popup" ).effect('slide', { direction: 'right', mode: 'hide' }, 500);
            }else if (  $(this).parents('.box-search-car .carsearch-lv1').length) {
                $('.box-search-car .carsearch-lv2').fadeIn();
                $('.box-search-car .carsearch-lv1').hide();
            }else if (  $(this).parents('.box-search-car .carsearch-lv2').length) {
                $('.box-search-car .carsearch-lv3').fadeIn();
                $('.box-search-car .carsearch-lv2').hide();
            }else if (  $(this).parents('.box-search-car .carsearch-lv3').length) {
                $('.box-search-car .carsearch-lv4').fadeIn();
                $('.box-search-car .carsearch-lv3').hide();
            }else if (  $(this).parents('.box-search-car .carsearch-lv4').length) {
                $('.box-search-car .carsearch-lv2, .box-search-car .carsearch-lv3, .box-search-car .carsearch-lv4').hide();
                $('.box-search-car .carsearch-lv1').show();
                $( ".box-search-car .carsearch-popup" ).effect('slide', { direction: 'right', mode: 'hide' }, 500);
            }
            event.stopPropagation();
        });

        $('.box-search-car .btn-selectall-car button').click(function (event) {
            $('.box-search-car .carsearch-input input').val($(this).attr('rel'));
                $('.box-search-car .carsearch-lv2, .box-search-car .carsearch-lv3, .box-search-car .carsearch-lv4').hide();
                $('.box-search-car .carsearch-lv1').show();
                $( ".box-search-car .carsearch-popup" ).effect('slide', { direction: 'right', mode: 'hide' }, 500);
            event.stopPropagation();
        });

        $('.box-search-car .btn-advancesearch').click(function (event) {
            if (  $( ".box-search-car .box-advancesearch" ).is( ":hidden" ) ) {
                $( ".box-search-car .box-advancesearch" ).effect('slide', { direction: 'right', mode: 'show' }, 500);
            }
            event.preventDefault();
        });

        $('.box-search-car .advance-exit').click(function (event) {
            $( ".box-search-car .box-advancesearch" ).effect('slide', { direction: 'right', mode: 'hide' }, 500);
            event.stopPropagation();
        });

        $('.box-search-car .btn-submitsearch').click(function (event) {
            $( ".box-search-car .boxshow-advance" ).show();
            $( ".box-search-car .box-advancesearch" ).effect('slide', { direction: 'right', mode: 'hide' }, 500);
            event.preventDefault();
        });

        $('.box-search-car .btn-resetsearch').click(function (event) {
            $( ".box-search-car .boxshow-advance" ).hide();
            event.stopPropagation();
        });
        
    });
</script>

<!-- ตัวเลขวิ่ง -->
<script>
        $(document).ready(function() {

			testScroll();

$(window).scroll(testScroll);
var viewedth = false;
var viewedvn = false;
function isScrolledIntoView(elem) {
	var docViewTop = $(window).scrollTop();
	var docViewBottom = docViewTop + $(window).height();

	var elemTop = $(elem).offset().top;
	var elemBottom = elemTop + $(elem).height();

	return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
}

function testScroll() {
	if (isScrolledIntoView($(".numbers")) && !viewedth) {
		viewedth = true;
		$('.numbers').find('.txt-num').not('.active').each(function () {
			$(this).prop('Counter',0).addClass('active').animate({
				Counter: $(this).text()
			}, {
				duration: 1500,
				easing: 'swing',
				step: function (now) {
				// $(this).text(commaSeparateNumber(Math.ceil(now)));
				$(this).text(Math.ceil(now));
				}
			});
		});
	} 

	function commaSeparateNumber(val){
		while (/(\d+)(\d{3})/.test(val.toString())){
		val = val.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
		}
		return val;
	}
}
    });

</script>

