
<?php
error_reporting(0); 
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>掌上神器</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="js/jquery.js"></script>

<script type="text/javascript">
$(function(){	
	//导航切换
	$(".menuson li").click(function(){
		$(".menuson li.active").removeClass("active")
		$(this).addClass("active");
	});
	
	$('.title').click(function(){
		var $ul = $(this).next('ul');
		$('dd').find('ul').slideUp();
		if($ul.is(':visible')){
			$(this).next('ul').slideUp();
		}else{
			$(this).next('ul').slideDown();
		}
	});
})	
</script>


</head>

<body style="background:#f0f9fd;">
	<div class="lefttop"><span></span>系统菜单</div>
    <dl class="leftmenu">
		<dd>
			<div class="title">
			<span><img src="images/leftico01.png" /></span>用户管理
			</div>
			<ul class="menuson">
				<li class="active"><cite></cite><a href="useredit.php" target="rightFrame">添加用户</a><i></i></li>
				<li><cite></cite><a href="userlist.php" target="rightFrame">旗下用户列表</a><i></i></li>
				<li><cite></cite><a href="artile.php" target="rightFrame">文章列表</a><i></i></li>
			</ul>
		</dd>
		        		
			<? 
				
				if ($_SESSION['admin_user'] == "admin"){
		echo '<dd><div class="title"><span><img src="images/leftico01.png" /></span>代理管理</div><ul class="menuson"><li><cite></cite><a href="admindit.php" target="rightFrame">添加代理</a><i></i></li> <li><cite></cite><a href="adminlist.php" target="rightFrame">代理列表</a><i></i></li>
		 <li><cite></cite><a href="guserlist.php" target="rightFrame">总用户列表</a><i></i></li> <li><cite></cite><a href="gartile.php" target="rightFrame">总文章列表</a><i></i></li></ul></dd>';
		}
				?>
    </dl>
</body>
</html>
