<meta charset="utf-8">
<?php
    error_reporting(E_ALL ^ E_DEPRECATED);
    $info = $_POST['info'];
    header("Content-type:text/html;charset=utf-8");
    if ($info == 'fail'){
        echo 'fail';
    }
    else{
        $split = explode(' ',$info);
        $history_mode = $split[0];  //模式
        $history_level = $split[1];  //难度
        $history_round = $split[2];  //回合数
        $history_result = $split[3];  //结果
        $history_time = $split[4];  //时间
    }
    $time = date('y-m-d h:i:s',time());

    $conn = ConnectDB();
    $tsql="INSERT INTO `historyGrade`(`mode`,`level`,`round`,`result`,`time`,`current`) VALUES ('".$history_mode."','".$history_level."','".$history_round."','".$history_result."','".$history_time."','".$time."')";
    //echo ($tsql."<br>");
    mysql_query("set names 'utf8'");
    $result = mysql_query($tsql,$conn);
    //echo $result;


    function ConnectDB(){
        //连接数据库，返回数据库连接指针
        $mysql_name="127.0.0.1:3306";
        $mysql_username="arthur";
        $mysql_password="Arthur1022";
        $mysql_database="wuziqi";
        $mysql_datatable="historyGrade";
        $conn=mysql_connect($mysql_name,$mysql_username,$mysql_password)or die("数据库连接失败");
        mysql_select_db($mysql_database)or die("数据库连接失败");
        return $conn;
    }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>游戏结束</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="/favicon.ico">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm.min.css">
    <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm-extend.min.css">
    <link rel="stylesheet" type="text/css" href="css/fdbc.css">

  </head>
  <body>
    <div>
        <div class="page">
        <!-- 你的html代码 -->


    <header class="bar bar-nav">
      <a class="icon icon-left pull-left" href="game.php"></a>
      <h1 class='title'>游戏结束</h1>
    </header>

      <div class="content">
        <img src="img/thinking.png">
          <div class="content-block">
            <p class="up"><a href="game/game.html" class="button button-big button-round">继续游戏</a></p>
            <p id="back"><a href="map.html" class="button button-big button-round">返回主页</a></p>
          </div>
        </div>

        </div>
    </div>

    <script type='text/javascript' src='//g.alicdn.com/sj/lib/zepto/zepto.min.js' charset='utf-8'></script>
    <script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm.min.js' charset='utf-8'></script>
    <script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm-extend.min.js' charset='utf-8'></script>
  </body>
</html>

