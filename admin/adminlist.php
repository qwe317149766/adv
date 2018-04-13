<?
header('Content-Type:text/html; charset=utf-8');
define('IN_QY',true);
require('../include/common.inc.php');
define('SCRIPT','adminlist');
require("check.php");
session_start();
if($_GET["act"]=="del")
{
	 $sql="delete from tbl_admin where id=".$_GET['id'];
	 mysql_query($sql);
	 mysql_close();
	 echo "<script type='text/javascript'>alert('成功删除!');location.href='adminlist.php';</script>";
	 exit;
}
if($_GET["act"]=="repass")
{
	$bl='lyk';
	$yiersan = 123456;
	$password=md5(md5($yiersan.$bl));

	 $sql="update tbl_admin set password = '".$password."' where id=".$_GET['id'];
	 mysql_query($sql);
	 mysql_close();
	 echo "<script type='text/javascript'>alert('密码重置成功!');location.href='adminlist.php';</script>";
	 exit;
}

$types = array('1'=>'个险用户','2'=>'银保用户','3'=>'财富用户');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>掌上神器</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.js"></script>

<script language="javascript">
$(function(){	
	//导航切换
	$(".imglist li").click(function(){
		$(".imglist li.selected").removeClass("selected")
		$(this).addClass("selected");
	})	
})	
</script>
<script type="text/javascript">
$(document).ready(function(){
  $(".click").click(function(){
  $(".tip").fadeIn(200);
  });
  
  $(".tiptop a").click(function(){
  $(".tip").fadeOut(200);
});

  $(".sure").click(function(){
  $(".tip").fadeOut(100);
});

  $(".cancel").click(function(){
  $(".tip").fadeOut(100);
});

});
</script>
</head>
<body>

	<div class="place">
    <span>位置：</span>
    <ul class="placeul">
    <li><a href="#">首页</a></li>
    <li><a href="#">代理管理</a></li>
    </ul>
    </div>
    
    <div class="rightinfo">
    <div class="tools">
    	<ul class="toolbar">
        <li class="click"><a href="admindit.php"><span><img src="images/t01.png" /></span>添加代理</a></li>
		
        </ul>

    </div>

    <table class="imgtable">
    <thead>
    <tr>
    <th>ID</th>
    <th>用户名</th>
	<th>登录次数</th>
	<th>下属会员</th>
    <th>最后登录</th>
	<th>重置密码</th>
    <th>操作</th>
    </tr>
    </thead>
    
    <tbody>
    <?
	

/*	if($_GET["act"]=="search" && $_POST['title']!='')
	{
		 $where .= " and (username like '%".$_POST['title']."%' or userid like '%".$_POST['title']."%' or qq like '%".$_POST['title']."%')";
	}*/
	
	$page_sql = "select * from tbl_admin where 1=1 ";
	qy_page($page_sql,20);
	$sql = "select * from tbl_admin where 1=1 ORDER by id DESC LIMIT $_pagenum,$_pagesize";
	$_id ='id='.$_GET['id'].'&';	
	
	
	
	$query=mysql_query($sql);
	while($row=mysql_fetch_array($query)){

		$sqlcc = "select count(*) as ccc from tbl_user where shuyu = '".$row['username']."'";
		$querycc=mysql_query($sqlcc);
		$rowcc=mysql_fetch_array($querycc);
	?>
    <tr height="35px">
		<td><?=$row['id']?></td>
		<td><?=$row['username']?></td>
		<td><?=$row['logintimes']?> 次</td>
		
		<td><?=$rowcc['ccc']?>&nbsp;<? if($rowcc['ccc']>0){?><a href="userlist.php?act=search&title=<?=$row['username']?>" class="tablelink"></a><?}?></td>
		<td><?=$row['lasttime']?></td>
		<td><a href="?act=repass&id=<?=$row['id']?>" alt="重置为默认密码123456" title="重置为默认密码123456">重置密码</a></td>

		<td><a href="adminlist.php?id=<?=$row['id']?>&act=del" onclick="if (confirm('确定要删除吗？')) return true; else return false;" class="tablelink"> 删除</a></td>
    </tr>
    <?
	}
	?>    
    </tbody>
    
    </table>
    
    <div class="pagin">
    	<?=qy_paginga()?>
    </div>
</div>
<script type="text/javascript">
	$('.imgtable tbody tr:odd').addClass('odd');
</script>
</body>
</html>
