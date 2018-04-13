<?php 
define('IN_QY',true);
session_start();
require("include/common.inc.php");
require('include/functions.php');
require('include/QueryList.class.php');
//include 'phpQuery/phpQuery.php'; 
if(!$_COOKIE['userid']){
	echo "<script type='text/javascript'>location.href='login.php';</script>";
	exit;
}
 
$sqlu = "select * from tbl_user where id=".$_COOKIE['userid'];
$queryu=mysql_query($sqlu);
$rowu=mysql_fetch_array($queryu);
$time2=strtotime($rowu['beizhu1']);
$time1=strtotime(date("Y-m-d H:i:s")); 
$tt = ceil(($time2-$time1)/86400);
$daili=$rowu['shuyu'];

$sqla = "select count(*) as cc from tbl_info where userid='".$_COOKIE['username']."'";
$querya=mysql_query($sqla);
$rowa=mysql_fetch_array($querya);

$s = $rowu['anums']-$rowa['cc'];

if($_GET['act']=='add'){
	
	if($s<1){
		echo "<script type='text/javascript'>alert('您发布的文章已经达到上限，请联系客服！');location.href='edit.php';</script>";
		exit;
	}
	if($tt<0){
		echo "<script type='text/javascript'>alert('您的会员时间已经到期，请联系客服！');location.href='edit.php';</script>";
		exit;
	}
	
    //$telno='134843204';
	$telno=trim($_POST['telnumber']);
	//$ifadtop='1';
	$ifadtop=trim($_POST['adweizhi']);
	$infoid=trim($_POST['artid']);
	$html=get_contents($long);
	$html=str_replace('data-src','src',$html);	
	$title=trim($_POST['title']);
	$content=trim($_POST['content']);
	$quyu='';
	$arr = $hj->jsonArr;
	$ywyuedu=$arr[0]['ywyuedu'];
	$sqlad = "select * from tbl_ad where id = ".$_POST['adid'];
	$queryad=mysql_query($sqlad);
	$rowad=mysql_fetch_array($queryad);
    $ifPublicNumber=trim($_POST['ifgongzhonghao']);
	//$ywyuedu='qq';
	//$sql = "insert into tbl_info values (0,'".$title."','".addslashes($content)."','".$rowad['ad_img']."','".$rowad['ad_link']."','".$_COOKIE['username']."',0,0,'".date('Y-m-d H:i:s')."')";
	$sql = "insert into tbl_info values (0,'".$title."','".addslashes($content)."','".$rowad['ad_img']."','".$rowad['ad_link']."','".$_COOKIE['username']."',0,0,'".date('Y-m-d H:i:s')."','".$rowad['adtelnumber']."','".$ifadtop."','".$gongzhonghao."','".$ifPublicNumber."','".$rowad['erweima']."','".$ywyuedu."','".$infoid."','".$daili."')";
	mysql_query($sql);
	echo "<script type='text/javascript'>alert('\u53d1\u5e03\u6210\u529f\uff01');location.href='view.php?fid=".$infoid."';</script>";
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>发布文章 - 爱分享</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta name="viewport" content="width=device-width , initial-scale=1.0 , user-scalable=0 , minimum-scale=1.0 , maximum-scale=1.0" />
    <script type="text/javascript" charset="utf-8" src="ueditor/ueditor.config-2.js"></script>
    <script type="text/javascript" charset="utf-8" src="ueditor/ueditor.all.min.js"> </script>
<script type='text/javascript' src='js/jquery-2.0.3.min.js'></script>
<script type="text/javascript" charset="utf-8" src="ueditor/ueditor-ok.all.js"> </script>
<script type="text/javascript">
//实例化编辑器
//建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
UE.getEditor('editor');
</script>
<link rel="stylesheet" href="css/css.css">
<style type="text/css">
.bot_main li.ico_1 {
	background: #F1901F;
}
</style>
</head>
<body>
<div style='margin-top:-17px;'></div>
<div class="apply" id="apply">
  <p>发布文章</p>
  <div class="apply" id="apply">
    <div class="blank10"></div>
    <form action="?act=add" id="signupok" method="post" name="addform"  enctype="multipart/form-data" onSubmit="return check()">
      <input type="hidden" name="artid" value="<?php echo time().rand(10,1000);?>" />

      <dl class="clearfix">
        <dd>标题：</dd>
        <dd>
          <input type="text" value="" style="width:100%" name="title">
        </dd>
      </dl>
      
      <dl class="clearfix">
          <dd>
        <select class="input_txt sel" name="adid" >
            <option value="">请选择广告</option>
				<?php
				$sql = "select * from tbl_ad where userid = '".$_COOKIE['userid']."' ORDER by id DESC";
				$query=mysql_query($sql);
				while($row=mysql_fetch_array($query)){
				?>
					<option value="<?=$row['id']?>"><?=$row['ad_title']?></option>
				<?php
				}	
				?>
			</select>
      </dd>
        </dl>
		
    <dl class="clearfix">
 
			<dd>广告位置：<label>顶部 <input type="radio" name="adweizhi" value="0" id="adweizhitop" /></label>
                 <label style="margin-left:10px;">底部 <input name="adweizhi" type="radio" id="adweizhibtm" value="1" checked="CHECKED" /></label>
                 <label style="margin-left:10px;">顶部+底部 <input name="adweizhi" type="radio"   id="adweizhitopbtm"  value="2"  /></label>
             
            </dd>
            <dd> <span style="margin-left:16px;">公众号：</span><label>显示 <input type="radio" name="ifgongzhonghao" value="1" checked="CHECKED" /></label>
                 <label style="margin-left:10px;">隐藏 <input name="ifgongzhonghao" type="radio"  value="0"  /></label></dd>
            <dd style="color:#F1901F; font-size:12px;line-height:30px;  margin-top:6px; height:30px; border-top:#ccc 1px solid;">声明：禁止发布黄赌毒以及违反任何国家相关法律法规的信息</dd>
      </dl>
      <dl class="clearfix">
        <dd>文章内容：</dd>
		<div style='margin-left:1px; margin-top:-5px; margin-right:10px; font-size:16px; color:#FF0000;'>说明：建议使用电脑版发布文章,发布后的文章需要编辑可以在已发布列表进行编辑!</div>
        <dd>
           <script id="editor" type="text/plain" name="content" style="width:100%;height:500px;"> </script>
		   

	
        </dd>
      </dl>

      <label></label>
      <div class="blank10"></div>
      <div class="btn_box" style="margin-bottom:5px;" align="center">
       <div class="btn_box">
			<input type="submit" name="signup" class="button" value="确认提交">
		</div>
      </div>
      <div class="blank10"></div>
    </form>
  </div>
</div>

<script type="text/javascript">
function check(){
	if (document.addform.title.value==""){
	    alert('请填写文章标题！');
		document.addform.title.focus();
		return false;
	}	
	if (document.addform.adid.value=="" ){
		alert('请选择广告！');
		document.addform.adid.focus();
		return false;
	}
	
    if (document.addform.content.value=="" ){
		alert('请填写文章内容！');
		document.addform.content.focus();
		return false;
	}
/*	if(document.addform.adweizhi.value==document.addform.adweizhi1.value){
		alert('请选择不同的广告位置！');
		document.addform.adweizhi.focus();
		return false;
	}*/
	if (document.addform.telnumber.value=="" ){
		alert('请输入电话号码！');
		document.addform.adid.focus();
		return false;
	}	
	
	document.addform.submit();
	return true;	
}
</script>
</body>
</html>