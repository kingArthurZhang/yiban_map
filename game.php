<?php
error_reporting(E_ALL ^ E_DEPRECATED);
mysql_connect('127.0.0.1:3306','arthur','Arthur1022');
mysql_select_db('wuziqi');
mysql_query('set names utf8');
$sql="SELECT * FROM historyGrade ORDER BY id DESC LIMIT 5";
$result=mysql_query($sql);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>游戏</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="/favicon.ico">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm.min.css">
    <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm-extend.min.css">
    <link rel="stylesheet" href="css/game.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>

  </head>
  <body>
     <div class="page">
    <header class="bar bar-nav">
    <h1 class="title">游戏</h1>
  </header>
  <nav class="bar bar-tab">
    <a class="tab-item external" href="map.html">
      <span class="icon icon-home"></span>
      <span class="tab-label">主页</span>
    </a>
    <a class="tab-item active" href="game.php">
      <span class="icon icon-computer"></span>
      <span class="tab-label">游戏</span>
    </a>
    <a class="tab-item external" href="info.html">
      <span class="icon icon-message"></span>
      <span class="tab-label">帮助与反馈</span>
      <span class="badge">2</span>

    </a>
  </nav>
  <div class="content" style="font-family:Microsoft Yahei;background-color:#eee;">

<div class="history_list">
<a href="game/game.html">
    <div class="history_item">
      <span>新游戏</span>
      <span class="icon icon-right"></span>
    </div>
  </a>
  </div>

	<div class="title_history">历史成绩</div>
	<div class="history_list">
		<?php
    while($row=mysql_fetch_array($result)){
      if ($row['result'] == ''){
        $class = 'pk';
      }else if($row['result'] == '胜利'){
        $class = 'win';
      }else if ($row['result'] == '失败'){
        $class = 'lose';
      }
    ?>

    <div class="history_item">
			<span class="type <?php  echo $class;?>"><?php echo $row['mode']; ?></span>
			<span class="time"><?php echo $row['current']; ?></span>
      <span class="icon icon-down"></span>
      <span class="icon icon-up"></span>
			<span class="arrow"></span>
		</div>
		<div class="detail">
			<div class="detail_item">难度：<?php echo $row['level']; ?></div>
			<div class="detail_item">回合：<?php echo $row['round']; ?> 轮</div>
			<div class="detail_item">结果：<?php echo $row['result']; ?></div>
			<div class="detail_item">用时：<?php echo $row['time']; ?> 秒</div>
		</div>
  <?php } ?>
	</div>

  </div>

    </div>
    <script>$.init()</script>
    <script type='text/javascript' src='//g.alicdn.com/sj/lib/zepto/zepto.min.js' charset='utf-8'></script>
    <script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm.min.js' charset='utf-8'></script>
    <script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm-extend.min.js' charset='utf-8'></script>
    <script type="text/javascript" src="js/game.js"></script>
  </body>
</html>


