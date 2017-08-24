
$('div.detail').hide();
$('.icon-up').hide();
$('div.history_item').click(function(){
        d=$(this).next().css('display');
        if (d=='block') {
            $(this).next().fadeOut(200);
            $(this).find('.icon-up').hide();
            $(this).find('.icon-down').show();
        }else{
            $(this).next().fadeIn(200);
            $(this).find('.icon-up').show();
            $(this).find('.icon-down').hide();
        }

    });