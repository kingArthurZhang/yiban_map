$('div.detail').hide();
$('.icon-up').hide();
$('div.info_item').click(function(){
        d=$(this).next().css('display');
        if (d=='block') {
            $(this).next().fadeOut(200);
            $('.icon-up').hide();
            $('.icon-down').show();
        }else{
            $(this).next().fadeIn(200);
            $('.icon-up').show();
            $('.icon-down').hide();
        }

    });