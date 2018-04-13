<?php 
define('IN_QY',true);
session_start();
require("include/common.inc.php");
require('include/functions.php');
require('include/QueryList.class.php');
if(!$_COOKIE['userid']){
	echo "<script type='text/javascript'>location.href='login.php';</script>";
	exit;
}
 
$sqlu = "select * from tbl_user where id=".$_COOKIE['userid'];
$queryu=mysql_query($sqlu);
$rowu=mysql_fetch_array($queryu);

$sqla = "select count(*) as cc from tbl_info where userid='".$_COOKIE['username']."'";
$querya=mysql_query($sqla);
$rowa=mysql_fetch_array($querya);

$s = $rowu['anums']-$rowa['cc'];


if($_GET['xz']=='1'){
	
	if($s<1){
		echo "<script type='text/javascript'>alert('\u60a8\u53d1\u5e03\u7684\u6587\u7ae0\u5df2\u7ecf\u8fbe\u5230\u4e0a\u9650\uff01');location.href='edit.php';</script>";
		exit;
	}
	$geturls=guolv(trim($_GET['ur']));
	$long=str_replace(array("|",".."),array("&","#"),$geturls);
	$telno=trim($_POST['telnumber']);
	$ifadtop=1;
	$infoid=trim($_GET['ad']);;
	$html=get_contents($long);
	$html=str_replace('data-src','src',$html);
	$vid=cut($html,'vid=','&');//获取视频ID
	$caiji = array(
		"title"=>array(".rich_media_title:first","text"),
		"content"=>array("#js_content","html"),
		"gongzhonghao"=>array(".rich_media_meta_list","html"),
		"ywyuedu"=>array("#js_toobar3","html"),
		);
	$quyu='';
	$hj = QueryList::Query($html,$caiji,$quyu);
	$arr = $hj->jsonArr;
	$title=$arr[0]['title'];
	$gongzhonghao=$arr[0]['gongzhonghao'];
	$ywyuedu=$arr[0]['ywyuedu'];
	$content=preg_replace("/<(\/?i?frame.*?)>/si","",$arr[0]['content']); //过滤frame标签
	if($vid!==''){
		$content="<p><iframe height=300 width=100% src=\"http://v.qq.com/iframe/player.html?vid={$vid}\" frameborder=0 allowfullscreen></iframe></p>".$content;
	}
	$pic=cut($html,'var msg_cdn_url = "','"');
	if(url_exists($long)==1){
		echo "<script>alert('\u7f51\u5740\u4e0d\u5b58\u5728');location.href='2edit.php'</script>";
		exit;		
	}
	$sqlad = "select * from tbl_ad where userid = '".$_COOKIE['userid']."' ORDER by id DESC limit 1";
	$queryad=mysql_query($sqlad);
	$rowad=mysql_fetch_array($queryad);
    $ifPublicNumber=1;
	//$sql = "insert into tbl_info values (0,'".$title."','".addslashes($content)."','".$rowad['ad_img']."','".$rowad['ad_link']."','".$_COOKIE['username']."',0,0,'".date('Y-m-d H:i:s')."')";
	$sql = "insert into tbl_info values (0,'".$title."','".addslashes($content)."','".$rowad['ad_img']."','".$rowad['ad_link']."','".$_COOKIE['username']."',0,0,'".date('Y-m-d H:i:s')."','".$rowad['adtelnumber']."','".$ifadtop."','".$gongzhonghao."','".$ifPublicNumber."','".$rowad['erweima']."','".$ywyuedu."','".$infoid."','".$daili."')";

	mysql_query($sql);
	echo "<script type='text/javascript'>alert('\u53d1\u5e03\u6210\u529f\uff01');location.href='view.php?fid=".$infoid."';</script>";
}
?>