<?php
header('Content-Type:text/html; charset=utf-8');
define('IN_QY',true);
require("../include/common.inc.php");
require("check.php");

if($_GET['act']=="mod"){
	if(!$_POST['passwd']){
		qy_alert_back('请输入修改密码!');
	}
	if($_POST['passwd']!=$_POST['repasswd']){
		qy_alert_back('两次密码不一致，请重新填写!');
	}
	$bl='lyk';
	$password=md5(md5($_POST['passwd'].$bl));
	$sql="update tbl_admin set password='".$password."' where id=".$_SESSION['adminid'];
	//echo $sql;exit;
	mysql_query($sql);
	if(mysql_affected_rows() == 1){
		qy_close();
		echo "<script type='text/javascript'>alert('修改成功!');top.location.href='main.php';</script>";
		exit;
	}else{
		qy_close();
		qy_alert_back('信息修改失败!');
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>掌上神器</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/select.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/select-ui.min.js"></script>


</head>

<body>

	<div class="place">
    <span>位置：</span>
    <ul class="placeul">
    <li><a href="#">首页</a></li>
    <li><a href="#">修改密码</a></li>
    </ul>
    </div>


    <form action="?act=mod" method="post" name="newsform">
	<input name="id" value="<?=$id?>" type="hidden">
    <div class="formbody">
    
    <div class="formtitle"><span>修改密码</span></div>

    <ul class="forminfo">

		<li><label>输入密码：</label><input name="passwd" type="password" class="dfinput"/><i></i></li>
		<li><label>确认密码：</label><input name="repasswd" type="password" class="dfinput"/><i></i></li>

		<li><label>&nbsp;</label><input name="" type="submit" class="btn" value="确认保存"/></li>
    </ul>
    </div>
	</form>

</body>
</html>
