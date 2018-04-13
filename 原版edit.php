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
		echo "<script type='text/javascript'>alert('\u60a8\u53d1\u5e03\u7684\u6587\u7ae0\u5df2\u7ecf\u8fbe\u5230\u4e0a\u9650\uff01');location.href='edit.php';</script>";
		exit;
	}
	$long=guolv(trim($_POST['wxlink']));
    //$telno='134843204';
	$telno=trim($_POST['telnumber']);
	//$ifadtop='1';
	$ifadtop=trim($_POST['adweizhi']);
	$infoid=trim($_POST['artid']);;
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
		echo "<script>alert('\u7f51\u5740\u4e0d\u5b58\u5728');location.href='weixin.php'</script>";
		exit;		
	}
	
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
<title>发布文章 - 掌上推广</title>
<meta name="description" content="" />
<meta name="viewport" content="width=device-width , initial-scale=1.0 , user-scalable=0 , minimum-scale=1.0 , maximum-scale=1.0" />
<link rel="stylesheet" href="css/css.css"> 
<style type="text/css">
.bot_main li.ico_1{
  background:#F1901F;
}
</style>
<script type='text/javascript' src='js/jquery-2.0.3.min.js'></script>
<script type='text/javascript' src='js/patch/mobileBUGFix.mini.js'></script>
    <script type="text/javascript"> 
//##################未点击分类菜单加载信息
     $(function() {  
    // $(".0cjclas").click(function() {
	  // var cjclasid="cjid="+$(this).attr("id"); 
      $.ajax({ 
				url: 'infolist.php', 
				data:"cjid=pc_0",
				//data:cjclasid,
				type: "post", 
				cache : false, 
				//
				beforeSend:function(){
             
			$(".cjlist").html("<span class='loading'><img src='images/loading.gif' width='81' height='78'></span>");
       },
				//
				success: function(data) 
					{
					  //$("#pig").html(data); 
					  $(".cjlist").html(data);
					  }, //	
				
				//000
				error:function(){
                     $(".cjlist").html("信息加载失败!");
               }
				
				//000
				});
 //999999
     //});    
    });  
  

//################
    $(function() {  
     $(".cjclas").click(function() {
	   var cjclasid="cjid="+$(this).attr("id"); 
      $.ajax({ 
				url: 'infolist.php', 
				//data:"cjid=22",
				data:cjclasid,
				type: "post", 
				cache : false, 
				//
				beforeSend:function(){
             
			$(".cjlist").html("<span class='loading'><img src='images/loading.gif' width='81' height='78'></span>");
       },
				//
				success: function(data) 
					{
					  //$("#pig").html(data); 
					  $(".cjlist").html(data);
					  }, //	
				
				//000
				error:function(){
                     $(".cjlist").html("信息加载失败!");
               }
				
				//000
				});
 //999999
     });    
    });  
   //000000
    $(document).ready(function() {  
     $(".qqcopyurl").click(function() {
		 var fburl=$(this).attr("id"); 
		 $("#wxlink").val(fburl);
		 //alert(fburl);
		 $("#sswxlink").html(fburl);
		// $("#m_div").html("<button>变成button了</button>")  
		 });
	 });
   //00000000   
    </script>
 
</head>
<body>
<div class="apply" id="apply">
	<p>发布文章<span style="float:right;font-size:12px;margin-right:10px">剩余文章数：<?=$s?>&nbsp;&nbsp;剩余天数：<?=$tt?>天</span></p>
	
	<form action="?act=add" id="signupok" method="post" name="addform"  enctype="multipart/form-data">
       <input type="hidden" name="artid" value="<?php echo time().rand(10,1000);?>" />
		<input type="hidden" name="type" value="1" />
		<dl class="clearfix">
			
			<dd class="inptmain"><span class="link_inpt"><input type="text"  id="wxlink" value="" name="wxlink" placeholder="请输入原文链接"></span><span class="btnss"><input type="button" name="signup"  value="分享"  onclick="return postcheck();"></span></dd>
		</dl>
        <dl class="clearfix" style="display:none">
			<dd>联系电话：</dd>
			<dd><input type="hidden" class="input_txt" id="telnumber" value="13899999999" name="telnumber" placeholder="请输入电话号码"></dd>
		</dl>
		<dl class="clearfix">
			
			<dd>
			<select class="input_txt sel" name="adid" >
            <option value="">请选择广告</option>
				<?
				$sql = "select * from tbl_ad where userid = '".$_COOKIE['userid']."' ORDER by id DESC";
				$query=mysql_query($sql);
				while($row=mysql_fetch_array($query)){
				?>
					<option value="<?=$row['id']?>"><?=$row['ad_title']?></option>
				<?
				}	
				?>
			</select>
			</dd>
		</dl>
        
        <dl class="clearfix">
			
			<dd>广告位置：<label>顶部 <input type="radio" name="adweizhi" value="0" id="adweizhitop" /></label>
                 <label style="margin-left:10px;">底部 <input name="adweizhi" type="radio" id="adweizhibtm" value="1" checked="CHECKED" /></label>
                 
             
            </dd>
            <dd> <span style="margin-left:16px;">公众号：</span><label>显示 <input type="radio" name="ifgongzhonghao" value="1" checked="CHECKED" /></label>
                 <label style="margin-left:10px;">隐藏 <input name="ifgongzhonghao" type="radio"  value="0"  /></label></dd>
            <dd style="color:#F1901F; font-size:12px;line-height:30px;  margin-top:6px; height:30px; border-top:#ccc 1px solid;">声明：禁止发布黄赌毒以及违反任何国家相关法律法规的信息</dd>
		</dl>
		  <div class="cjfenlei"><a id="pc_0" class="cjclas" href="javascript:void(0);">热门</a><a id="pc_1" class="cjclas" href="javascript:void(0);">推荐</a><a id="pc_2" class="cjclas" href="javascript:void(0);">段子手</a><a id="pc_3" class="cjclas" href="javascript:void(0);">养生堂</a><a id="pc_4" class="cjclas" href="javascript:void(0);">私房话</a><a id="pc_5" class="cjclas" href="javascript:void(0);">八卦精</a><a id="pc_6" class="cjclas" href="javascript:void(0);">爱生活</a><a id="pc_7" class="cjclas" href="javascript:void(0);">财经迷</a><a id="pc_8" class="cjclas" href="javascript:void(0);">汽车迷</a><a id="pc_8" class="cjclas" href="http://wx.sogou.com" target="_blank">更多</a></div>
            
		
		<!--
		<dl class="clearfix">
			<dd>广告链接：</dd>
			<dd><input type="tel" class="input_txt" value="" name="adlink" id="adlink" placeholder="请输入广告链接" style="height:50px;">
			
			</dd>
		</dl>
		<dl class="clearfix">
			<dd>广告图片：</dd>
			<dd><input type="file" class="input_txt" type="file"  placeholder="选择上传广告图片" name="upfile" style="width: 100%;height:50px;box-sizing: border-box;padding: 14px;color: #696969;font-size: 12px;line-height: 12px;border: #e6e6e6 1px solid;background: #fff;"></dd>
		</dl>
		-->
       
         <div class="cjcontlist">
             <ul class="cjlist">
             <!---->
             <li>
                  <ul>
                   <li class="tit"><a uigs="pc_0_tit_0" href="http://mp.weixin.qq.com/s?__biz=MTE1OTE0MzU2MQ==&amp;mid=406212875&amp;idx=1&amp;sn=5dc213348f8474e1b6c3380f39ddee98&amp;3rd=MzA3MDU4NTYzMw==&amp;scene=6#rd" target="_blank">老婆没事就拿竹衣架抽我!杭州30岁男博士向妇联...</a></li>
                   <li class="cont"><span class="ydl">阅读&nbsp;51145&nbsp;&nbsp;&nbsp;</span><span><a href="javascript:void(0);" class="copyurl" id="http://mp.weixin.qq.com/s?__biz=MTE1OTE0MzU2MQ==&amp;mid=406212875&amp;idx=1&amp;sn=5dc213348f8474e1b6c3380f39ddee98&amp;3rd=MzA3MDU4NTYzMw==&amp;scene=6#rd">复制地址</a><a href="cjsave.php?bc=1&amp;f=145140653742122&amp;ur=http://mp.weixin.qq.com/s?__biz=MTE1OTE0MzU2MQ==|mid=406212875|idx=1|sn=5dc213348f8474e1b6c3380f39ddee98|3rd=MzA3MDU4NTYzMw==|scene=6#rd">立即分享</a></span></li>
                  </ul>
             </li>

 <li>
                  <ul>
                   <li class="tit"><a uigs="pc_0_tit_0" href="http://mp.weixin.qq.com/s?__biz=MTE1OTE0MzU2MQ==&amp;mid=406212875&amp;idx=1&amp;sn=5dc213348f8474e1b6c3380f39ddee98&amp;3rd=MzA3MDU4NTYzMw==&amp;scene=6#rd" target="_blank">老婆没事就拿竹衣架抽我!杭州30岁男博士向妇联...</a></li>
                   <li class="cont"><span class="ydl">阅读&nbsp;51145&nbsp;&nbsp;&nbsp;</span><span><a href="javascript:void(0);" class="copyurl" id="http://mp.weixin.qq.com/s?__biz=MTE1OTE0MzU2MQ==&amp;mid=406212875&amp;idx=1&amp;sn=5dc213348f8474e1b6c3380f39ddee98&amp;3rd=MzA3MDU4NTYzMw==&amp;scene=6#rd">复制地址</a><a href="cjsave.php?bc=1&amp;f=145140653742122&amp;ur=http://mp.weixin.qq.com/s?__biz=MTE1OTE0MzU2MQ==|mid=406212875|idx=1|sn=5dc213348f8474e1b6c3380f39ddee98|3rd=MzA3MDU4NTYzMw==|scene=6#rd">立即分享</a></span></li>
                  </ul>
             </li>

 <li>
                  <ul>
                   <li class="tit"><a uigs="pc_0_tit_0" href="http://mp.weixin.qq.com/s?__biz=MTE1OTE0MzU2MQ==&amp;mid=406212875&amp;idx=1&amp;sn=5dc213348f8474e1b6c3380f39ddee98&amp;3rd=MzA3MDU4NTYzMw==&amp;scene=6#rd" target="_blank">老婆没事就拿竹衣架抽我!杭州30岁男博士向妇联...</a></li>
                   <li class="cont"><span class="ydl">阅读&nbsp;51145&nbsp;&nbsp;&nbsp;</span><span><a href="javascript:void(0);" class="copyurl" id="http://mp.weixin.qq.com/s?__biz=MTE1OTE0MzU2MQ==&amp;mid=406212875&amp;idx=1&amp;sn=5dc213348f8474e1b6c3380f39ddee98&amp;3rd=MzA3MDU4NTYzMw==&amp;scene=6#rd">复制地址</a><a href="cjsave.php?bc=1&amp;f=145140653742122&amp;ur=http://mp.weixin.qq.com/s?__biz=MTE1OTE0MzU2MQ==|mid=406212875|idx=1|sn=5dc213348f8474e1b6c3380f39ddee98|3rd=MzA3MDU4NTYzMw==|scene=6#rd">立即分享</a></span></li>
                  </ul>
             </li>
             <!---->
             </ul>
          </div> 
		
		<div class="blank10"></div>
		
	</form>
</div>

<? include('foot.php');?>
<script type="text/javascript">
function postcheck(){
	if (document.addform.wxlink.value==""){
	    alert('请填写原文链接！');
		document.addform.wxlink.focus();
		return false;
	}
	
	if (document.addform.adid.value=="" ){
		alert('请选择广告！');
		document.addform.adid.focus();
		return false;
	}
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