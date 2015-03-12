<?php

include './db.inc.php';
include './function.inc.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css">
<title><? echo $_GET['qqnumber'] . "配置--".$webname ?></title>
</head>
<div class="main-nav">
<p><a><? echo $_GET['qqnumber'] . "配置"; ?></a></p>
</div>
<?php
if(!empty($_COOKIE['user'])) {
    $myname=$_COOKIE["user"];
} else {$myname="";}
@$qqnumber=$_GET['qqnumber'];
$qqset=$_GET['qqset'];
$qqsid="sid$qqset";
$con=mysql_connect("$host","$user","$password")or die(“无法连接服务器”);
mysql_select_db($db,$con);
$qqresult = mysql_query("SELECT * FROM {$table}users
WHERE name='$myname'");
$row = mysql_fetch_array($qqresult);
$sidecho=$row['sid'.$qqset];
if(empty($_POST['submit'])){
	global $sidecho;
	die('<div class="module"><div class="module-content"><div class="padding-5-0 border-btm"><p>请登录！</p></div></div><div class="padding-5-0 border-btm"><form action="index.php"><input id="returnsubmit" class="ipt-btn-gray-s" type="submit" name="reg" value="回到首页"/></form>
</div></div>');
?>
<div class="module">
  <div class="module-content">
    <div class="padding-5-0 border-btm">
<font style="color:#0000FF">该QQ的SID码:</font>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'].'?action=set&qqset='.$qqset;?>">
  <input name="data" type="text" value="<?php echo $sidecho;?>" size="30" />
  <br/>
<?php
$zhuangtai=check_ifonline($sidecho);
if ($zhuangtai==true){?>
<select id="ifonline" name="ifonline">
             <option value="yes" selected="selected"> 上线</option>
             <option value="no"> 下线</option>
</select>
	
<?php } else {?>
<select id="ifonline" name="ifonline">
             <option value="yes" > 上线</option>
             <option value="no" selected="selected"> 下线</option>
</select><?php } ?>
<input type="hidden" name="zhuangtai" value='<?php echo $zhuangtai;?>'>
<input type="submit" class="ipt-btn-gray-s" name="submit" value="修改"/>

</form>
<?php
if ($zhuangtai==true){
$result = mysql_query("SELECT * FROM {$table}online
WHERE url='$sidecho'");
$row = mysql_fetch_array($result);
$onlinetime=$row['time'];
$time1 = strtotime($onlinetime);
$time2 = strtotime('now');
//相减得到相差的 秒 数
$time3 = $time1 - $time2;
//输出
echo '</br><b>注意:</b></br><font style="color:#0000FF">距SID过期还有：</font>'.time2string($time3);}else{
	echo'';}
} else {
	global $sidecho;
	$onlinetime=add_onlinetime();
	$setsid=$_POST['data'];
	$qqtz=$_POST['ifonline'];
	$zhuangtai=$_POST['zhuangtai'];
	if($qqtz=="yes"&&$qqtz=$zhuangtai){echo '';}
    elseif($qqtz=="no"){del_online($sidecho);}
	else{add_online($sidecho, $_GET['qqnumber'], $onlinetime);}
	if($setsid==""){echo "不能输入空的SID";}
	elseif($setsid==$sidecho&&$qqtz=$zhuangtai){echo "SID未作任何改变</br>状态修改成功";}
	elseif(strlen($setsid)<>24){echo "输入的SID长度有误";}
	else{

		mysql_query("UPDATE {$table}users SET $qqsid = '$setsid'
WHERE name = '$myname'");
		
		change_online($setsid,$sidecho,$onlinetime);//同步修改在线QQ列表
		echo '修改成功';
		}echo '</br><a href="index.php">返回首页</a>';}
?>
</div>
<div class="padding-5-0 border-btm">
<form action="index.php">
<input id="returnsubmit" class="ipt-btn-gray-s" type="submit" name="reg" value="回到首页"/>
</form>
</div>
</div>
<br>
<div id="footer">
<?php
$con=mysql_connect("$host","$user","$password")or die('无法连接服务器');
mysql_select_db($db,$con); 
$sql="SELECT COUNT(id) FROM {$table}online";
$row = mysql_fetch_array( mysql_query($sql) );
echo '服务器上共有<font style="color:#FF0033">'.$row[0].'</font>个QQ。';
?>
<p>
<a href="http://www.izzx.cc">官方博客</a>-
<a href="http://miniqq.izzx.cc">手机挂Q网</a>
</p>
<p class="txt-fade">
IZZX旗下网站
</p>
</div>