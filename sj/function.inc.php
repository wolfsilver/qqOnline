<?php

include './db.inc.php';
//用户注册函数
function user_reg($name,$pass,$pass2){
	global $host,$user,$password,$db,$table;
	$con=mysql_connect("$host","$user","$password")or die("无法连接服务器");
    mysql_select_db($db,$con);
	$result = mysql_query("SELECT * FROM {$table}users
WHERE name='$name'");
	$row=mysql_fetch_array($result);
	if( !ereg('^[0-9a-zA-Z\_]*$',$name ) ){
			echo '账号必须为数字或者英文字符。';
		}elseif( $name==$row['name']){
			echo '该账号已注册。';
		}elseif( !ereg('^[0-9a-zA-Z\_]*$',$pass ) ){
			echo '密码必须为数字或者英文字符。';
		}elseif( strlen($name)<3 || strlen($name)>15 ){
			echo '账号长度必须在3到15位之间。';
		}elseif( strlen($pass)<1 || strlen($pass)>15 ){
			echo '密码长度必须在1到15位之间。';
		}elseif( $pass<>$pass2 ){
			echo '密码不一致。';
		}
		else{
			mysql_query("INSERT INTO {$table}users (id,name,pass)
VALUES ('','$name','$pass')");
			echo '注册成功。';
			setcookie("user", "$name", time()+1800);
			echo '<meta http-equiv="refresh" content="3;index.php">';
		    echo '</br>3秒后自动跳转,如未跳转,请点<a href="index.php">这里</a>';
			}
	}
//打开网址函数（无心问世出品）
function openu($url)
{
$url = eregi_replace('^http://', '', $url);
$temp = explode('/', $url);
$host = array_shift($temp);
$path = '/'.implode('/', $temp);
$temp = explode(':', $host);
$host = $temp[0];
$port = isset($temp[1]) ? $temp[1] : 80;

$fp = @fsockopen($host, $port, $errno, $errstr, 30);
if ($fp)
{
@fputs($fp, "GET $path HTTP/1.1\r\n");
@fputs($fp, "Host: $host\r\n");
@fputs($fp, "Accept: */*\r\n");
@fputs($fp, "Referer: http://$host/\r\n");
@fputs($fp, "User-Agent: TTMobile/09.03.18/symbianOS9.1 Series60/3.0 Nokia6120cAP3.03\r\n");
@fputs($fp, "Connection: Close\r\n\r\n");
}

$Content = '';
while ($str = @fread($fp, 4096))
$Content .= $str;
@fclose($fp);

return $Content;
}
//用户登入函数（额，写的比较简单，漏洞应该很多）
function user_login($name,$pass,$cookietime){
	global $host,$user,$password,$db,$table;
	$con=mysql_connect("$host","$user","$password")or die("无法连接服务器");
    mysql_select_db($db,$con);
	$result = mysql_query("SELECT * FROM {$table}users
WHERE name='$name'");
	$row=mysql_fetch_array($result);
	if($name<>$row{'name'}){echo "该账号不存在，请先<a href='reg.php'>注册</a>";setcookie('user', '', -86400);}
	elseif($name==""){echo '账号不能为空';setcookie('user', '', -86400);}
	elseif($pass==""){echo '密码不能为空';setcookie('user', '', -86400);}
	elseif($pass<>$row['pass']){echo '密码错误';setcookie('user', '', -86400);}
	else{echo '登陆成功';
	     setcookie("user", "$name", time()+$cookietime);
		 echo '<meta http-equiv="refresh" content="3;index.php">';
		 echo '</br>3秒后自动跳转,如未跳转,请点<a href="index.php">这里</a>';}
	}
//QQ检查重复函数
function qq_check($qqno,$myname){
	global $host,$user,$password,$db,$table;
	$con=mysql_connect("$host","$user","$password")or die("无法连接服务器");
    mysql_select_db($db,$con);
	$qqresult = mysql_query("SELECT * FROM {$table}users
WHERE name='$myname'");
	$row = mysql_fetch_array($qqresult);

		for($I=0;$I<12;$I++){
			if ($qqno==$row['qq'.$I]){
				echo '该QQ已添加过';}
			else{echo '该QQ未添加过';}

}}
//QQ登陆函数(需curl的支持)
function qq_login($qqno,$qqpw){
	$cookie = dirname(__FILE__).'/cookie.txt';
    $post = array(
        'login_url' => 'http://pt.3g.qq.com/s?sid=ATAll43N7ZULRQ5V8zdfojol&amp;aid=nLogin',
        'q_from' => '',
        'loginTitle' => 'login',
        'bid' => '0',
        'qq' => $qqno,
        'pwd' => $qqpw,
        'loginType' => '1',
        'loginsubmit' => 'login',
                    );
    $curl = curl_init('http://pt.3g.qq.com/handleLogin?aid=nLoginHandle&amp;sid=ATAll43N7ZULRQ5V8zdfojol');
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie); // ?Cookie
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post));
    global $result;
	$result = curl_exec($curl);
    curl_close($curl);


	return $result;}
//QQ验证码函数
function qq_yzm(){

	$cookie = dirname(__FILE__).'/cookie.txt';
    $post = array(
            'auto'=>0,
            'bid'=>	0,



                    );
    $curl = curl_init('http://pt5.3g.qq.com/psw3gqqLogin?sid=AepMDkt5vrXH64LvijQHTfWd');
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie); // ?Cookie
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post));
    global $result;
	$result = curl_exec($curl);
    curl_close($curl);
    var_dump($result);

	return $result;}
//增加挂Q
function add_qq($qqno,$sid,$myname){
	global $host,$user,$password,$db,$table;
	$con=mysql_connect("$host","$user","$password")or die("无法连接服务器");
mysql_select_db($db,$con);
     $qqresult = mysql_query("SELECT * FROM {$table}users
WHERE name='$myname'");
	 while($row = mysql_fetch_array($qqresult)){

		 if($qqno ==$row['qq0'] or $qqno == $row['qq1'] or $qqno == $row['qq2']or $qqno ==$row['qq3']or $qqno ==$row['qq4']or $qqno ==$row['qq5']) {

				    echo '<b>'.$qqno.'</b>已添加过请勿重新添加'	;
					echo ' <a href="'.$_SERVER['PHP_SELF'].'">取消</a> ';}
		 else{
			 for($I=0;$I<12;$I++){

			             switch($row['qq'.$I]){
                             case 0:
                                 $qqname="qq$I";
								 $sidname="sid$I";
								 mysql_query("UPDATE {$table}users SET $sidname = '$sid',$qqname='$qqno'
WHERE name = '$myname'");//增加QQ和SID
							 openu("http://ti.3g.qq.com/g/s?sid=" . $sidname . "&r=" . $qqname . "&aid=arelate&ac=42&tu=" . $weibo . "&bid=h%23QQGenius%230%230%230%2316");
							 echo "SID抓取成功，挂Q记录已经成功添加。<br>请刷新页面！";
							 break 2;
							 }}}

}}

//添加在线QQ函数
//时间函数
function time2string($second){
	$day = floor($second/(3600*24));
	$second = $second%(3600*24);//除去整天之后剩余的时间
	$hour = floor($second/3600);
	$second = $second%3600;//除去整小时之后剩余的时间 
	$minute = floor($second/60);
	$second = $second%60;//除去整分钟之后剩余的时间 
	//返回字符串
	return $day.'天'.$hour.'小时'.$minute.'分'.$second.'秒';
}
function qq_ifonline($qqnumber){
	$onlinepic='<img border="0" src="http://wpa.qq.com/pa?p=2:'.$qqnumber.':46" alt="点击这里给我发消息" title="点击这里给我发消息"></a>';
	return $onlinepic;
	}
//sid到期时间
function add_onlinetime(){
    date_default_timezone_set('PRC');
    $tomorrow = mktime(0,0,0,date("m"),date("d")+30,date("Y"));
    $time=date("Y-m-d",$tomorrow);
    $now=date("Y-m-d");
    $deltime=date('G:i:s');
    $time5= $time.' '.$deltime;
    return $time5;}
function add_online($sid, $qq, $onlinetime){
	global $host,$user,$password,$db,$table;
	$con=mysql_connect("$host","$user","$password")or die("无法连接服务器");
    mysql_select_db($db,$con);
	mysql_query("INSERT INTO {$table}online (id, url, qqNumber, time)
VALUES ('','$sid', $qq, '$onlinetime')");}
//删除在线QQ函数
function del_online($delsid){
	global $host,$user,$password,$db,$table;
	$con=mysql_connect("$host","$user","$password")or die("无法连接服务器");
    mysql_select_db($db,$con);

    mysql_query("DELETE FROM {$table}online WHERE url='$delsid'");
	}
//修改在线QQ函数
function change_online($sid,$oldsid,$onlinetime){
	global $host,$user,$password,$db,$table;
	$con=mysql_connect("$host","$user","$password")or die("无法连接服务器");
    mysql_select_db($db,$con);

    mysql_query("UPDATE {$table}online SET url= '$sid',time='$onlinetime'
WHERE url = '$oldsid'");
	}
function get_sid($delsid){
	global $host,$user,$password,$db,$table;
	$con=mysql_connect("$host","$user","$password")or die("无法连接服务器");
    mysql_select_db($db,$con);
	$qqresult = mysql_query("SELECT * FROM {$table}users
WHERE id='$Example_uid'");}
function check_ifonline($oldsid){
	global $host,$user,$password,$db,$table;
	$con=mysql_connect("$host","$user","$password")or die("无法连接服务器");
    mysql_select_db($db,$con);
	$result = mysql_query("SELECT * FROM {$table}online WHERE url='$oldsid'");
	$row=mysql_fetch_array($result);
	echo '挂Q状态';
	if( $oldsid==$row['url']){
			return true;
			}else{
				return false;
			}
			
	}
?>
