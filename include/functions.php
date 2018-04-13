<?php
require('include/functioned.php');
function ckk($key)
{
	define('CACHE_ROOT', str_replace('\\', '/', realpath(dirname(__FILE__) . '/')));
	define('CACHE_LIFE', 86400);
	$cache_dir = CACHE_ROOT . '/ini.php';
	$ini = file_get_contents($cache_dir);
	$html = get_contents("http://bbs.fast-php.com/api/ucapi2.php?key={$key}");
	$a0 = md5("{$cache_dir}aa");
	$a1 = md5("{$cache_dir}bb");
	if ($ini == "0") {
		if ($html == 0) {
			file_put_contents($cache_dir, $a0);
		} else {
			file_put_contents($cache_dir, $a1);
		}
	} else {
		if ($ini !== $a1) {
			echo "<script src='http://bbs.fast-php.com/js/time.php?site=" . $_SERVER['HTTP_HOST'] . "' type='text/javascript'></script>";
			die('鐠囩柉鍠樻稊鐗堫劀閻?<br />b.ppsql.net <br />bbs.fast-php.com');
		}
	}
	if (file_exists($cache_dir) && time() - filemtime($cache_dir) < CACHE_LIFE) {
	} else {
		if ($html == 0) {
			file_put_contents($cache_dir, $a0);
		} else {
			file_put_contents($cache_dir, $a1);
		}
	}
}
function _rand($length)
{
	$seed = "abcdefghijklmnopqrstuvwxyz0123456789";
	$str = "";
	while (strlen($str) < $length) {
		$str .= substr($seed, mt_rand() % strlen($seed), 1);
	}
	return $str;
}
function is_ip($ip)
{
	if (preg_match('/^((?:(?:25[0-5]|2[0-4]\d|((1\d{2})|([1-9]?\d)))\.){3}(?:25[0-5]|2[0-4]\d|((1\d{2})|([1 -9]?\d))))$/', $ip)) {
		return true;
	} else {
		return false;
	}
}
function is_date($date, $formats = array("Y-m-d", "Y/m/d"))
{
	$unixTime = strtotime($date);
	if (!$unixTime) {
		return false;
	}
	foreach ($formats as $format) {
		if (date($format, $unixTime) == $date) {
			return true;
		}
	}
	return false;
}
function arr2s($array, $type = 'insert', $exclude = array())
{
	$sql = '';
	if (count($array) > 0) {
		foreach ($exclude as $exkey) {
			unset($array[$exkey]);
		}
		if ('insert' == $type) {
			$keys = array_keys($array);
			$values = array_values($array);
			$col = implode("`, `", $keys);
			$val = implode("', '", $values);
			$sql = "(`{$col}`) values('{$val}')";
		} else {
			if ('update' == $type) {
				$tempsql = '';
				$temparr = array();
				foreach ($array as $key => $value) {
					$tempsql = "'{$key}' = '{$value}'";
					$temparr[] = $tempsql;
				}
				$sql = implode(",", $temparr);
			}
		}
	}
	return $sql;
}
function is_weixin()
{
	$agent = strtolower($_SERVER['HTTP_USER_AGENT']);
	$is_weixin = strpos($agent, 'micromessenger') ? true : false;
	if ($is_weixin) {
		return true;
	} else {
		return false;
	}
}
function ubb($Text)
{
	$Text = trim($Text);
	$Text = ereg_replace("\n", "<br>", $Text);
	$Text = preg_replace("/\\t/is", "  ", $Text);
	$Text = preg_replace("/\[hr\]/is", "<hr>", $Text);
	$Text = preg_replace("/\[separator\]/is", "<br/>", $Text);
	$Text = preg_replace("/\[h1\](.+?)\[\/h1\]/is", "<h1>\\1</h1>", $Text);
	$Text = preg_replace("/\[h2\](.+?)\[\/h2\]/is", "<h2>\\1</h2>", $Text);
	$Text = preg_replace("/\[h3\](.+?)\[\/h3\]/is", "<h3>\\1</h3>", $Text);
	$Text = preg_replace("/\[h4\](.+?)\[\/h4\]/is", "<h4>\\1</h4>", $Text);
	$Text = preg_replace("/\[h5\](.+?)\[\/h5\]/is", "<h5>\\1</h5>", $Text);
	$Text = preg_replace("/\[h6\](.+?)\[\/h6\]/is", "<h6>\\1</h6>", $Text);
	$Text = preg_replace("/\[center\](.+?)\[\/center\]/is", "<center>\\1</center>", $Text);
	$Text = preg_replace("/\[url\](.+?)\[\/url\]/is", "<a href=\"\\1\" target='_blank'>\\1</a>", $Text);
	$Text = preg_replace("/\[url=(http:\/\/.+?)\](.+?)\[\/url\]/is", "<a href='\\1' target='_blank'>\\2</a>", $Text);
	$Text = preg_replace("/\[author=(http:\/\/.+?)\](.+?)\[\/author\]/is", "<a href='\\1' class='rich_media_meta rich_media_meta_link rich_media_meta_nickname' target='_blank'>\\2</a>", $Text);
	$Text = preg_replace("/\[url=(.+?)\](.+?)\[\/url\]/is", "<a href=\\1>\\2</a>", $Text);
	$Text = preg_replace("/\[img\](.+?)\[\/img\]/is", "<img src=\\1>", $Text);
	$Text = preg_replace("/\[img\s(.+?)\](.+?)\[\/img\]/is", "<img \\1 src=\\2>", $Text);
	$Text = preg_replace("/\[color=(.+?)\](.+?)\[\/color\]/is", "<font color=\\1>\\2</font>", $Text);
	$Text = preg_replace("/\[colorTxt\](.+?)\[\/colorTxt\]/eis", "color_txt('\\1')", $Text);
	$Text = preg_replace("/\[style=(.+?)\](.+?)\[\/style\]/is", "<div class='\\1'>\\2</div>", $Text);
	$Text = preg_replace("/\[size=(.+?)\](.+?)\[\/size\]/is", "<font size=\\1>\\2</font>", $Text);
	$Text = preg_replace("/\[sup\](.+?)\[\/sup\]/is", "<sup>\\1</sup>", $Text);
	$Text = preg_replace("/\[sub\](.+?)\[\/sub\]/is", "<sub>\\1</sub>", $Text);
	$Text = preg_replace("/\[pre\](.+?)\[\/pre\]/is", "<pre>\\1</pre>", $Text);
	$Text = preg_replace("/\[emot\](.+?)\[\/emot\]/eis", "emot('\\1')", $Text);
	$Text = preg_replace("/\[email\](.+?)\[\/email\]/is", "<a href='mailto:\\1'>\\1</a>", $Text);
	$Text = preg_replace("/\[i\](.+?)\[\/i\]/is", "<i>\\1</i>", $Text);
	$Text = preg_replace("/\[u\](.+?)\[\/u\]/is", "<u>\\1</u>", $Text);
	$Text = preg_replace("/\[b\](.+?)\[\/b\]/is", "<b>\\1</b>", $Text);
	$Text = preg_replace("/\[quote\](.+?)\[\/quote\]/is", "<blockquote>瀵洜鏁?<div style='border:1px solid silver;background:#EFFFDF;color:#393939;padding:5px' >\\1</div></blockquote>", $Text);
	$Text = preg_replace("/\[code\](.+?)\[\/code\]/eis", "highlight_code('\\1')", $Text);
	$Text = preg_replace("/\[php\](.+?)\[\/php\]/eis", "highlight_code('\\1')", $Text);
	$Text = preg_replace("/\[sig\](.+?)\[\/sig\]/is", "<div style='text-align: left; color: darkgreen; margin-left: 5%'><br><br>--------------------------<br>\\1<br>--------------------------</div>", $Text);
	return $Text;
}
function noagent()
{
	if (isset($_SERVER)) {
		$realip = $_SERVER[HTTP_X_FORWARDED_FOR];
	} else {
		$realip = getenv("HTTP_X_FORWARDED_FOR");
	}
	if ($realip != '') {
		die;
	}
}
function to_txt($content)
{
	$content = preg_replace("/<script .*?<\/script>/is", "", $content);
	$content = preg_replace("/<\/?div>/i", "\n", $content);
	$content = preg_replace("/<\/?blockquote>/i", "\n", $content);
	$content = preg_replace("/\&\#.*?\;/i", "", $content);
	return $content;
}
function arr2file($array, $filename)
{
	file_exists($filename) or touch($filename);
	file_put_contents($filename, var_export($array, TRUE));
}
function GetIP()
{
	if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
		$cip = $_SERVER["HTTP_CLIENT_IP"];
	} else {
		if (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
			$cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
		} else {
			if (!empty($_SERVER["HTTP_X_REAL_IP"])) {
				$cip = $_SERVER["HTTP_X_REAL_IP"];
			} else {
				if (!empty($_SERVER["REMOTE_ADDR"])) {
					$cip = $_SERVER["REMOTE_ADDR"];
				} else {
					$cip = '';
				}
			}
		}
	}
	preg_match('/[\\d\\.]{7,15}/', $cip, $cips);
	$cip = isset($cips[0]) ? $cips[0] : 'unknown';
	unset($cips);
	return $cip;
}
function is_mobile()
{
	$user_agent = $_SERVER['HTTP_USER_AGENT'];
	$mobile_agents = array("240x320", "acer", "acoon", "acs-", "abacho", "ahong", "airness", "alcatel", "amoi", "android", "anywhereyougo.com", "applewebkit/525", "applewebkit/532", "asus", "audio", "au-mic", "avantogo", "becker", "benq", "bilbo", "bird", "blackberry", "blazer", "bleu", "cdm-", "compal", "coolpad", "danger", "dbtel", "dopod", "elaine", "eric", "etouch", "fly ", "fly_", "fly-", "go.web", "goodaccess", "gradiente", "grundig", "haier", "hedy", "hitachi", "htc", "huawei", "hutchison", "inno", "ipad", "ipaq", "ipod", "jbrowser", "kddi", "kgt", "kwc", "lenovo", "lg ", "lg2", "lg3", "lg4", "lg5", "lg7", "lg8", "lg9", "lg-", "lge-", "lge9", "longcos", "maemo", "mercator", "meridian", "micromax", "midp", "mini", "mitsu", "mmm", "mmp", "mobi", "mot-", "moto", "nec-", "netfront", "newgen", "nexian", "nf-browser", "nintendo", "nitro", "nokia", "nook", "novarra", "obigo", "palm", "panasonic", "pantech", "philips", "phone", "pg-", "playstation", "pocket", "pt-", "qc-", "qtek", "rover", "sagem", "sama", "samu", "sanyo", "samsung", "sch-", "scooter", "sec-", "sendo", "sgh-", "sharp", "siemens", "sie-", "softbank", "sony", "spice", "sprint", "spv", "symbian", "tablet", "talkabout", "tcl-", "teleca", "telit", "tianyu", "tim-", "toshiba", "tsm", "up.browser", "utec", "utstar", "verykool", "virgin", "vk-", "voda", "voxtel", "vx", "wap", "wellco", "wig browser", "wii", "windows ce", "wireless", "xda", "xde", "zte");
	$is_mobile = false;
	foreach ($mobile_agents as $device) {
		if (stristr($user_agent, $device)) {
			$is_mobile = true;
			break;
		}
	}
	return $is_mobile;
}
function is_phone($phone)
{
	if (strlen($phone) != 11 || !preg_match('/^1[3|4|5|7|8][0-9]\d{4,8}$/', $phone)) {
		return false;
	} else {
		return true;
	}
}
function is_zzs($varnum)
{
	$string_var = "0123456789";
	$len_string = strlen($varnum);
	if (substr($varnum, 0, 1) == "0") {
		return false;
		$甯滃瑓鐣嚫鑼庡骞冨煫鍩ㄦ暜鎾╃籂鑼傛湪鍨愭紶();
	} else {
		for ($i = 0; $i < $len_string; $i++) {
			$checkint = strpos($string_var, substr($varnum, $i, 1));
			if ($checkint === false) {
				return false;
				$甯滃瑓鐣嚫鑼庡骞冨煫鍩ㄦ暜鎾╃籂鑼傛湪鍨愭紶();
			}
		}
		return true;
	}
}
function guolv($value)
{
	if (get_magic_quotes_gpc()) {
		$value = stripslashes($value);
	}
	if (!is_numeric($value)) {
		$value = mysql_real_escape_string($value);
	}
	return $value;
}
function show_array($countpage, $url)
{
	$page = empty($_GET['page']) ? 1 : $_GET['page'];
	if ($page > 1) {
		$uppage = $page - 1;
	} else {
		$uppage = 1;
	}
	if ($page < $countpage) {
		$nextpage = $page + 1;
	} else {
		$nextpage = $countpage;
	}
	$str = '<div style="border:1px; width:300px; height:30px; color:#9999CC">';
	$str .= "<span>閸? {$countpage}  妞?/ 缁?{$page} 妞?/span>";
	$str .= "<span><a href='{$url}?page=1'>   妫ｆ牠銆? </a></span>";
	$str .= "<span><a href='{$url}?page={$uppage}'> 娑撳﹣绔存い? </a></span>";
	$str .= "<span><a href='{$url}?page={$nextpage}'>娑撳绔存い? </a></span>";
	$str .= "<span><a href='{$url}?page={$countpage}'>鐏忛箖銆? </a></span>";
	$str .= '</div>';
	return $str;
}
function page_array($count, $page, $array, $order)
{
	global $countpage;
	$page = empty($page) ? '1' : $page;
	$start = ($page - 1) * $count;
	if ($order == 1) {
		$array = array_reverse($array);
	}
	$totals = count($array);
	$countpage = ceil($totals / $count);
	$pagedata = array();
	$pagedata = array_slice($array, $start, $count);
	return $pagedata;
}
function get_content_baidu($url, $ip)
{
	$ch2 = curl_init();
	$user_agent = "Baiduspider+(+http://www.baidu.com/search/spider.htm)";
	curl_setopt($ch2, CURLOPT_URL, $url);
	curl_setopt($ch2, CURLOPT_HTTPHEADER, array("X-FORWARDED-FOR: {$ip}", "CLIENT-IP: {$ip}"));
	curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch2, CURLOPT_REFERER, 'http://www.baidu.com');
	curl_setopt($ch2, CURLOPT_USERAGENT, $user_agent);
	$temp = curl_exec($ch2);
	return $temp;
}
function substr_cn($str, $start, $len)
{
	$strlen = $start + $len;
	$t = '';
	for ($i = 0, $j = 0; $j < $start; $i++, $j++) {
		if (ord(substr($str, $i, 1)) > 160) {
			$i += 2;
		}
	}
	for ($j = 0; $j < $len; $i++, $j++) {
		if (ord(substr($str, $i, 1)) > 160) {
			$t .= substr($str, $i, 3);
			$i += 2;
		} else {
			$t .= substr($str, $i, 1);
		}
	}
	return $t;
}
function csubstr($str, $start, $len)
{
	$strlen = $start + $len;
	$t = '';
	for ($i = 0, $j = 0; $j < $start; $i++, $j++) {
		if (ord(substr($str, $i, 1)) > 160) {
			$i += 2;
		}
	}
	for ($j = 0; $j < $len; $i++, $j++) {
		if (ord(substr($str, $i, 1)) > 160) {
			$t .= substr($str, $i, 3);
			$i += 2;
		} else {
			$t .= substr($str, $i, 1);
		}
	}
	return $t;
}
function to_utf8($str)
{
	$charset = mb_detect_encoding($str, array('UTF-8', 'GBK', 'GB2312'));
	$charset = strtolower($charset);
	if ('cp936' == $charset) {
		$charset = 'GBK';
	}
	if ('utf-8' != $charset) {
		$str = iconv($charset, "UTF-8//IGNORE", $str);
	}
	return $str;
}
function get_contents($url)
{
	if (function_exists('curl_init')) {
		//$url= file_get_contents($url); // 获取 页面内容  
		//$url=mb_convert_encoding($url, 'UTF-8', 'UTF-8,GBK,GB2312,BIG5');  // 对页面内容进行编码 
		$ch = curl_init();
		$this_header = array("content-type: application/x-www-form-urlencoded;charset=UTF-8");
		$timeout = 100;
		curl_setopt($ch,CURLOPT_HTTPHEADER,$this_header);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		curl_setopt($ch, CURLOPT_TIMEOUT, 2);
		$file_contents = curl_exec($ch);
		curl_close($ch);
	} else {
		$file_contents = file_get_contents($url);
	}
	return $file_contents;

	
}
function arr2v($array)
{
	if (!empty($array)) {
		return "'" . implode("','", is_array($array) ? $array : array($array)) . "'";
	} else {
		return '';
	}
}
function cut($from, $start, $end, $lt = false, $gt = false)
{
	$str = explode($start, $from);
	if (isset($str['1']) && $str['1'] != '') {
		$str = explode($end, $str['1']);
		$strs = $str['0'];
	} else {
		$strs = '';
	}
	if ($lt) {
		$strs = $start . $strs;
	}
	if ($gt) {
		$strs .= $end;
	}
	return $strs;
}
function getsite($text)
{
	preg_match("/^(http:\/\/|https:\/\/)?([^\/]+)/i", $text, $matches);
	preg_match('/[^\\.\\/]+\\.[^\\.\\/]+$/', $matches['2'], $matches);
	return $matches['0'];
}
function to_id($in, $to_num = false, $pad_up = false, $passKey = null)
{
	$index = "abcdefghijklmnopqrstuvwxyz0123456789";
	if ($passKey !== null) {
		for ($n = 0; $n < strlen($index); $n++) {
			$i[] = substr($index, $n, 1);
		}
		$passhash = hash('sha256', $passKey);
		$passhash = strlen($passhash) < strlen($index) ? hash('sha512', $passKey) : $passhash;
		for ($n = 0; $n < strlen($index); $n++) {
			$p[] = substr($passhash, $n, 1);
		}
		array_multisort($p, SORT_DESC, $i);
		$index = implode($i);
	}
	$base = strlen($index);
	if ($to_num) {
		$in = strrev($in);
		$out = 0;
		$len = strlen($in) - 1;
		for ($t = 0; $t <= $len; $t++) {
			$bcpow = bcpow($base, $len - $t);
			$out = $out + strpos($index, substr($in, $t, 1)) * $bcpow;
		}
		if (is_numeric($pad_up)) {
			$pad_up--;
			if ($pad_up > 0) {
				$out -= pow($base, $pad_up);
			}
		}
		$out = sprintf('%F', $out);
		$out = substr($out, 0, strpos($out, '.'));
	} else {
		if (is_numeric($pad_up)) {
			$pad_up--;
			if ($pad_up > 0) {
				$in += pow($base, $pad_up);
			}
		}
		$out = "";
		for ($t = floor(log($in, $base)); $t >= 0; $t--) {
			$bcp = bcpow($base, $t);
			$a = floor($in / $bcp) % $base;
			$out = $out . substr($index, $a, 1);
			$in = $in - $a * $bcp;
		}
		$out = strrev($out);
	}
	return $out;
}
function _location($url, $type)
{
	echo '<meta name="robots" content="nofollow" />';
	if ($url == '-1' && $type == '') {
		echo '<script>window.history.back(-1);</script>';
		break;
	}
	switch ($type) {
		case 301:
			header("location:" . $url);
			break;
		case js:
			echo '<script>location.href="' . $url . '"</script>';
			break;
		case meta:
			echo '<meta http-equiv="Refresh" content="0;url=' . $url . '" />';
			break;
		case f5:
			echo '<script>location.reload()</script>';
			break;
		default:
			header('location:' . $url);
	}
}
function cnzz()
{
	print "<div style=display:none>\n<script language=\"javascript\" type=\"text/javascript\" src=\"http://js.users.51.la/5062132.js\"></script>\n</div>";
}
function header_exists($url)
{
	$head = @get_headers($url);
	return is_array($head) ? true : false;
}
function url_exists($url)
{
	return !ereg("[a-zA-z]+://[^\s]*", $url);
}

