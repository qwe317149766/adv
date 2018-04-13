<?php
header('Content-Type:text/html; charset=utf-8');
define('IN_QY',true);
require("../include/common.inc.php");
require("check.php");

if($_GET['act']=='add'){
	if($_POST["pwd"]){
		if($_POST["pwd"]==$_POST["repwd"]){
			$pwd = $_POST["pwd"];
		}else{
			echo "<script type='text/javascript'>alert('两次密码不一致!');history.go(-1);</script>";
			exit;
		}
	}else{	
		$pwd = "123456";
	}
	
	$sqli = "select * from tbl_user where userid = '".$_POST["userid"]."'";
	$queryi=mysql_query($sqli);
	$rowi=mysql_fetch_array($queryi);
	if($rowi){
		echo "<script type='text/javascript'>alert('该用户ID已存在!');history.go(-1);</script>";
		exit;
	}


	$sql="INSERT INTO tbl_user " .
	"VALUES(
	0,
	'".$_POST["username"]."',
	'".$pwd."',
	'".$_POST["usersn"]."',
	'".$_POST["type"]."',
	'".date('Y-m-d H:i:s')."',
	'".$_POST["userid"]."'
	)";
	mysql_query($sql);
	if(mysql_affected_rows() == 1){
		qy_close();
		echo "<script type='text/javascript'>alert('添加成功!');location.href='userlist.php';</script>";
		exit;
	}else{
		qy_close();
		qy_alert_back('信息添加失败!');
	}
}

if($_GET['act']=='edit'){
	if($_POST["pwd"]){
		if($_POST["pwd"]==$_POST["repwd"]){
			$pwdsql = "userpwd = '".$_POST["pwd"]."',";
		}else{
			echo "<script type='text/javascript'>alert('两次密码不一致!');history.go(-1);</script>";
			exit;
		}
	}
	$sql="UPDATE tbl_user SET 
	username='".$_POST["username"]."',
	type='".$_POST["type"]."',
	$pwdsql
	usersn='".$_POST["usersn"]."'
	
	WHERE id=".$_POST["id"];
	//echo $sql;exit;
	mysql_query($sql);
	if(mysql_affected_rows() == 1){
		qy_close();
		echo "<script>alert('编辑成功！');window.location.href='userlist.php';</script>";
		exit;
	}else{
		qy_close();
		qy_alert_back('信息编辑失败或无修改动作!');
	}
}
$id=$_GET['id'];
$query=mysql_query("SELECT * FROM tbl_user WHERE id='$id'");
$row=mysql_fetch_array($query);
if($id){
	$action = "?id=$id&act=edit";
}else{
	$action = "?act=add";
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>广州搜一下网络科技有限公司</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/select.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/select-ui.min.js"></script>
 
<script type="text/javascript">
$(document).ready(function(e) {
    $(".select1").uedSelect({
		width : 345			  
	});
	$(".select2").uedSelect({
		width : 167  
	});
	$(".select3").uedSelect({
		width : 100
	});
	
});
</script>

</head>

<body>

	<div class="place">
    <span>位置：</span>
    <ul class="placeul">
    <li><a href="#">首页</a></li>
    <li><a href="#">用户管理</a></li>
    </ul>
    </div>


    <form action="<?=$action?>" method="post" name="newsform">
	<input name="id" value="<?=$id?>" type="hidden">
    <div class="formbody">
    
    <div class="formtitle"><span>基本信息</span></div>

    <ul class="forminfo">

    <li><label>用户登录ID</label><input name="userid" type="text" class="dfinput" value="<?=$row['userid']?>" <? if ($id){echo 'disabled';}?>/><i>唯一，不能重复</i></li>
	<li><label>用户姓名</label><input name="username" type="text" class="dfinput" value="<?=$row['username']?>"/><i></i></li>
	<li><label>联系电话</label><input name="usersn" type="text" class="dfinput"  value="<?=$row['usersn']?>" /><i></i></li>
    <li><label>密码</label><input name="pwd" type="password" class="dfinput" value="" /><? if (!$id){echo '<i>不填写密码为默认123456</i>';}?></li>
	<li><label>确认密码</label><input name="repwd" type="password" class="dfinput" value="" /></li>
    <li><label>&nbsp;</label><input name="" type="submit" class="btn" value="确认保存"/></li>
    </ul>
    </div>
	</form>

</body>
</html>
