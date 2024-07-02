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



