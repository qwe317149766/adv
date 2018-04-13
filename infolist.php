<script>
 $(document).ready(function() {  
     $(".copyurl").click(function() {
		 var fburl=$(this).attr("id"); 
		 //alert(fburl);
		 //$("#wxlink").html(fburl);
		 $("#wxlink").val(fburl);
		 });
	 }); 
    </script>
<?php
error_reporting(0); 
header("content-Type: text/html; charset=Utf-8");
set_time_limit(60);
include 'include/phpQuery/phpQuery.php'; 
$cjid=$_POST['cjid'];
$cjtitle='';
$preg='/<a .*?href="(.*?)".*?>/is';//取链接正则
$ydpreg='/<\/span>阅读(.*?)<bb/is';//阅读量正则
//$titreg='/<h4>(.*?)<\/h4>/is';//标题正则
$cjurl="http://weixin.sogou.com/pcindex/pc/".$cjid."/".$cjid.".html";//要采集地址

//phpQuery::newDocumentFile('http://weixin.sogou.com/pcindex/pc/pc_1/pc_1.html'); 
phpQuery::newDocumentFile($cjurl);
//$artlist = pq("#pc_0_subd");
//$artlist = pq(".wx-news-info2");
////$imglist = pq(".wx-img-box");
//$cjzong=$artlist;
////if(is_array($cjzong)){
////echo "8888<br>";
////}
//$a = get_object_vars($cjzong);

foreach(pq("li") as $key=> $company){
	$cont=pq($company)->find('h4')->html();
	$ydcont=pq($company)->find('.s-p')->html();//阅读量
	//$strimg=pq($imglist)->find('.img')->html();
	preg_match_all($preg,$cont,$match);//链接
	preg_match_all($ydpreg,$ydcont,$ydmatch);//阅读量
	$tHref=$match[1][0];
	//$gtHref = str_replace('&amp;',"|",$tHref);
	$gtHref=str_replace(array("&amp;","#"),array("|",".."),$tHref);
 // $cjtitle=$cjtitle."<li>".$cont.$tHref."</li>";
    $cjtitle=$cjtitle."<li><ul><li class='tit'>".$ydcont."</li>";
    $cjtitle=$cjtitle."<li class='cont'><span class='ydl'>阅读".$ydmatch[1][0]."</span><span><a href='javascript:void(0);' class='copyurl' id=".$tHref.">复制地址</a><a href='cjsave.php?xz=1&ad=".time().rand(10,100)."22&ur=".$gtHref."'>立即分享</a></span></li></ul></li>";

}
echo $cjtitle;
//echo $imglist;
//
?>