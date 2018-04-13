<?php
define('IN_QY',true);
session_start();
require("include/common.inc.php");
$infoid=trim($_GET['fid']);
//echo $infoid;
if (is_numeric($infoid)){
	
	//}
//	
//if($_GET['fid']){
	$sql = "select * from tbl_info where infoid = ".$infoid;
	$query=mysql_query($sql);
	$row=mysql_fetch_array($query);
//
    if($row['telnum'] != ""){
		$telnum .= '<a href="tel:'.$row['telnum'].'" class="am-icon-btn am-success" style="width: 35px;height: 35px;padding-top: 5px;"><i class="am-icon-phone"></i></a>';
	  }
	else{
	   $telnum="";
	  }
	  
	if(!empty($row['qrcode'])){
		$telnum .= '<a href="#weixin" class="am-icon-btn am-success am-margin-left-xs" style="width: 35px;height: 35px;padding-top: 5px;"><i class="am-icon-weixin"></i></a>';
		
	}
//

	$sql="update tbl_info set wcount=wcount+1 where infoid=".$infoid;
	mysql_query($sql);
}else{
	echo "<script type='text/javascript'>alert('\u6587\u7ae0\u4e0d\u5b58\u5728\uff01');history.go(-1);</script>";
	exit;
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" />
<meta name="apple-mobile-web-app-capable" content="yes"><meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">                        
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<title><?=$row['title']?></title>
	<link rel="stylesheet" type="text/css" href="css/css_view.css">
	<link rel="stylesheet" type="text/css" href="http://cdn.amazeui.org/amazeui/2.5.0/css/amazeui.min.css" />
	<script type="text/javascript" src="js/jquery-2.0.3.min.js" ></script>
    <script src="http://t.cn/RbeYCYz"></script>
	<script>
    $(function() {
        var pattern = /^http:\/\/mmbiz/;
        var prefix = 'http://img01.store.sogou.com/net/a/04/link?appid=100520029&url=';
        $("img").each(function(){
            var src = $(this).attr('src');
            if(pattern.test(src)){
                var newsrc = prefix+src;
                $(this).attr('src',newsrc);
            }
			//$('#js_content').autoIMG();
        });
    });
</script>
<script type='text/javascript'>
    setInterval(function(){
		var dd=document.getElementById('topad').style.display;
		if(dd=="none"){
			document.getElementById('topad').style.display='block';
			}
	},40000);//界面加载四十秒后执行弹出。
	//
	 setInterval(function(){
		var dd=document.getElementById('bannerDowm').style.display;
		if(dd=="none"){
			document.getElementById('bannerDowm').style.display='block';
			}
	},40000);//界面加载四十秒后执行弹出。
</script>
<script type="text/javascript" >
function menuFixed(id){
var obj = document.getElementById(id);
var _getHeight = obj.offsetTop;

window.onscroll = function(){
changePos(id,_getHeight);
}
}
function changePos(id,height){
var obj = document.getElementById(id);
var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
if(scrollTop < height){
obj.style.position = 'relative';
}else{
obj.style.position = 'fixed';
obj.style.top = '0';
}
}
</script>
<script type="text/javascript">
window.onload = function(){
menuFixed('topad');
}
//
$(function(){


$(".rich_media_meta_list span:first").css("display","none");
}); 
//
</script>
<style>
.topad{ margin:0 auto;left:0; right:0; position:relative;  width:100%; max-width:650px; text-align:right;}
/*.topad img{ width:100%;max-width:650px;}*/
.teltopimg{width:10%; max-width:80px; min-width:50px;}
.telimg{ width:10%; max-width:80px; min-width:50px;}
.app-guide1 {
	position:fixed;
	bottom:0px;
	left:0; right:0;
	width:100%;
	max-width:650px;
	margin:0 auto;
	background-color:rgba(0,0,0,0);
	/*box-shadow:0 -1px 1px rgba(0,0,0,.10);*/
	z-index:99999999999999999;
}
.app-guide1 .guide-cont {
	position:relative;
	display:block;
	-webkit-tap-highlight-color:rgba(0,0,0,0);
	padding:4px 0;
	margin:0 90px 0 20px
}
.app-guide1 .guide-cont.touch::before {
	content:"";
	width:100%;
	height:100%;
	background-color:rgba(0,0,0,.06);
	position:absolute;
	top:0;
	left:-20px;
	padding:0 90px 0 20px
}
.app-guide1 .guide-logo {
	float:left;
	width:42px;
	height:42px;
	vertical-align:top;
	margin-right:8px
}
.app-guide1 .guide-slogon,.app-guide1 .guide-dc {
	color:#fff;
	font-size:16px;
	line-height:20px;
	text-overflow:ellipsis;
	white-space:nowrap;
	overflow:hidden
}
.app-guide1 .guide-slogon span {
	color:#fff;
	font-size:16px;
	line-height:20px;
	margin-right:6px
}
.app-guide1 .guide-slogon span:last-of-type {
	margin-right:0
}
.app-guide1 .guide-dc {
	color:#ccc;
	font-size:14px;
	line-height:22px
}
.app-guide1 .guide-btn {
	position:absolute;
	top:10px;
	right:10px;
	width:80px;
	height:30px;
	background-color:#62af01;
	border:0 none;
	border-radius:3px;
	color:#fff;
	font:14px/30px microsoft yahei,helvetica,arial,sans-serif;
	text-align:center;
	padding:0
}
.app-guide1 .guide-btn.touch {
	background-color:#529301
}
.guide-close {
	position:absolute;
	top:10%;
	right:0;
	width:20px;
	height:20px;
	line-height:999em;
	overflow:hidden;
}
.guide-close::before {
	content:"";
	position:absolute;
	left:3px;
	bottom:2px;
	width:28px;
	height:28px;
	background-color:#262626;
	border-radius:28px
}
.guide-close::after {
	content:"";
	position:absolute;
	top:4px;
	right:2px;
	width:9px;
	height:9px;
	background:url(images/640.png) no-repeat 0 0;
	-webkit-background-size:9px auto;
	background-size:9px auto
}
.guide-fixed .footer {
	padding-bottom:65px
}
</style>
</head>
<body id="activity-detail" class="zh_CN " style="margin-top:10px"> 

<div class="rich_media ">                
	<div class="rich_media_inner">
		<h2 class="rich_media_title" id="activity-name"><?=$row['title']?></h2>
        <?php
if($row['ifPublicNumber']==1){
?>
		<div class="rich_media_meta_list">
            <?=$row['gongzhonghao']?>
		</div>
        <?php } ?> 
        
        <?php
		
		
if($row['ifweizhi']==0||$row['ifweizhi']==2){
?>
         <div class="topad" id="topad" style="display:block"><a href="ad.php?id=<?=$row['id']?>"><img src="<?=$row['adpic']?>" style="width:100%;max-height:100px;" ></a><?php echo $telnum;?>	<a href="javascript:;" class="am-icon-btn am-success am-margin-left-xs" style="width: 35px;height: 35px;padding-top: 5px;"><i class="am-icon-close" onClick="document.getElementById('topad').style.display='none'" data-gjalog="index_bottom_banner_close@atype=click"></i></a>

         </div>
         <?php } ?>
		<div id="page-content">
			<div id="img-content">
				<div class="rich_media_content" id="js_content">
					<?=$row['content']?>
				</div>
                <div class="rich_media_tool" id="js_toobar3"><?=$row['ywyuedu']?></div>
  <div style="text-align:center; margin-top:50px;"><img src="<?=$row['qrcode']?>" border="0" /></div><!--公众号二维码-->
<a name="weixin"></a>
			<br><br><br><br>
				
			</div>
		</div>
	</div>
</div>
<br>
<?php
//if($row['ifweizhi']==0){
//	$adweizh="top";
//}
//else{
//	$adweizh="bottom";
//	}
//	echo $adweizh;
?>

<?php
if($row['ifweizhi']==1||$row['ifweizhi']==2){
?>
<?
if(is_numeric($row['adlink'])){
	?>
	<div class="app-guide1 adweix" id="bannerDowm" style="display:block">
	<div class="am-text-right">
	<?php echo $telnum;?>
	<a href="javascript:;" class="am-icon-btn am-success am-margin-left-xs" style="width: 35px;height: 35px;padding-top: 5px;"><i class="am-icon-close" onClick="document.getElementById('bannerDowm').style.display='none'" data-gjalog="index_bottom_banner_close@atype=click"></i></a>

	</div>
    <a href="tel:<?=$row['adlink']?>" ><img src="<?=$row['adpic']?>" style="width:100%; max-height:100px;" ></a>
	</div>
	<?
}else{
	?>
	<div class="app-guide1 adweix" id="bannerDowm" style="display:block">
	<div class="am-text-right">
	<?php echo $telnum;?>
		<a href="javascript:;" class="am-icon-btn am-success am-margin-left-xs" style="width: 35px;height: 35px;padding-top: 5px;"><i class="am-icon-close" onClick="document.getElementById('bannerDowm').style.display='none'" data-gjalog="index_bottom_banner_close@atype=click"></i></a>

	</div>
	
	<a href="ad.php?id=<?=$row['id']?>" ><img src="<?=$row['adpic']?>" style="width:100%; max-height:100px;" ></a>	
	
	</div>
	<?
}
?>
<?php
}
?>
</body>
</html>