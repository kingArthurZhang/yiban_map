var begin_time;
$(document).ready(function(){
    var game = new Game($(".go-board"), $(".board tbody"));

    var adjustSize = adjustSizeGen();

    $(window).resize(adjustSize);

    adjustSize();
    $.mobile.defaultDialogTransition = 'flip';
    $.mobile.defaultPageTransition = 'flip';

    $('#mode-select input[type="radio"]').on('change', function(){
        gameData.mode=$(this).val();
    });

    $('#color-select input[type="radio"]').on('change', function(){
        gameData.color=$(this).val();
    });

    $('#level-select input[type="radio"]').on('change', function(){
        gameData.level=$(this).val();
    });

    $('.back-to-game').on('tap',function(){
        $.mobile.changePage('#game-page');
    });

    $("#start-game").on('click',function(){
        try{
            game.white.worker.terminate();
            game.black.worker.terminate();
        }catch(e){}
        if(gameData.mode==='vshuman'){
            game.mode='hvh';
            game.init(new HumanPlayer("black"), new HumanPlayer("white"));
        }else{
            var color, other;
            if(gameData.color==='black'){
                color='black';
                other='white';
            }else{
                color='white';
                other='black';
            }
            begin_time=Date.parse(new Date());
            begin_time=begin_time/1000;
            game.mode=gameData.level;
            game.init(new HumanPlayer(color), new AIPlayer(game.mode, other));
        }
        $.mobile.changePage('#game-page');
        game.start();
        setTimeout(function(){$('.back-to-game').button('enable');},100);
    });

    $("#undo-button").on('tap', function(){
        game.undo();
    });

    $('.fullscreen-wrapper').on('tap', function(){
        $(this).hide();
        $.mobile.changePage('#game-won');
    });

    $('#new-game').page();
    $('#game-won').page();
    gameData.load();
    $('.back-to-game').button('disable');
    $.mobile.changePage('#new-game',{changeHash: false});

    window.gameInfo = (function(){
        var blinking = false,
            text = "",
            color = "";

        var self = {};

        self.getBlinking = function(){
            return blinking;
        };

        var mainObj = $("#game-info");
        self.setBlinking = function(val){
            if(val !== blinking){
                blinking = val;
                if(val){
                    mainObj.addClass("blinking");
                }else{
                    mainObj.removeClass("blinking");
                }
            }
        };

        self.getText = function(){
            return text;
        };

        var textObj = $("#game-info>.cont");
        self.setText = function(val){
            text = val;
            textObj.html(val);
        };

        self.getColor = function(){
            return color;
        };

        var colorObj = $("#game-info>.go");
        self.setColor = function(color){
            colorObj.removeClass("white").removeClass("black");
            if(color){
                colorObj.addClass(color);
            }
        };

        return self;
    })();
});

var history_result;
var end_time;
var history_time;
function showWinDialog(game){
    gameInfo.setBlinking(false);
    if(game.mode === 'hvh'){
        var who=(function(string){ return string.charAt(0).toUpperCase() + string.slice(1);})(game.getCurrentPlayer().color);
        $("#game-won h4").html(who+'赢了！');
        gameInfo.value=who+'赢了！'
        $("#win-content").html(who+'赢了，再来一局?');
        end_time=Date.parse(new Date());
        end_time=end_time/1000;
        history_time=end_time - begin_time;
        var history=[history_mode,history_level,history_round,history_result,history_time];
        post('../show.php',history.join(' '));
        $('#happy-outer').fadeIn(500);

    }else{
        if(game.getCurrentPlayer() instanceof HumanPlayer){
            $("#game-won h4").html('你赢了!');
            $("#win-content").html('你赢了，再来一局?');
            gameInfo.value='You won.'
            history_result="胜利";
            end_time=Date.parse(new Date());
            end_time=end_time/1000;
            history_time=end_time - begin_time;
            $('#sad-outer').fadeIn(500);
        }else{
            $("#game-won h4").html('你输了！');
            $("#win-content").html('你输了，再来一局?');
            gameInfo.value='Computer won.'
            history_result="失败";
            end_time=Date.parse(new Date());
            end_time=end_time/1000;
            history_time=end_time - begin_time;
            var history=[history_mode,history_level,history_round,history_result,history_time];
            post('../show.php',history.join(' '));
            $('#happy-outer').fadeIn(500);
        }
    }
}
