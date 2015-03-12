<?php
include('./header.php');
?>
<!--[if IE 6]>
<div style="color:#B94A48;text-align:center;font-size:12px;border:1px solid #dedede;background:#FCF8E3;height:24px;line-height:24px;">您的浏览器版本过低，心挂Q浏览效果不佳，推荐您升级到<a href="http://windows.microsoft.com/zh-CN/internet-explorer/products/ie/home" target="_blank">IE8</a>以上或者使用<a href="http://www.google.cn/chrome/intl/zh-CN/landing_chrome.html" target="_blank">谷歌浏览器</a></div>
<![endif]-->
  <div class="google-header-bar">
  <div class="header content clearfix">
  <a href='index.php'><img class="logo" src="./img/logo.png" alt="IZZX"></a>
  <span class="signup-button">
  挂Q配额用完了吗？
  <a id="link-signup" class="g-button g-button-red" href="logout.php">
  更换帐户  </a>  </span>  </div>
  </div>
<?php

include './db.inc.php';
include './function.inc.php';

if(!empty($_COOKIE['user'])) {
    $myname=$_COOKIE["user"];
} else {$myname="";}
@$qqnumber=$_GET['qqnumber'];//获取index传来的值
$qqdel=$_GET['qqdel'];//同上
?>
<? if(empty($_POST['submit'])){?>
  <div class="wrap2 clearfix">
  
		<div class="login_right">
			<h2 style="margin:15px 0;">删除QQ<span id="login_error_infor"></span></h2>

			<div class="login_box">
<form method="post" action="<? echo $_SERVER['PHP_SELF'].'?action=delete&qqdel='.$qqdel ?>">
<p class="margin-b-10">
<b>确定删除吗</b>
<input id="loginsubmit" class="login_btn_new" type="submit" name="submit" value="确  定"/><br><br>
<a href='index.php' />返回</a>

</p>
</div>
</div>
<? }else{$qqdel=$_GET['qqdel'];//获取要删除的QQ序号
	 $con=mysql_connect("$host","$user","$password")or die("无法连接服务器");
	 mysql_select_db($db,$con);
     $qqresult = mysql_query("SELECT * FROM {$table}users
WHERE name='$myname'");
     $row = mysql_fetch_array($qqresult);
     $delsid=$row['sid'.$qqdel];//得到删除的sid
	 del_online($delsid);//同步删除在线QQ列表
	 $sidname="sid$qqdel";//获取字段名
     $qqname="qq$qqdel";//同上
     mysql_query("UPDATE {$table}users SET $sidname = '0',$qqname='0'
WHERE name = '$myname'");
	 echo '  <div class="wrap2 clearfix">
  
		<div class="login_right">
			<h2 style="margin:15px 0;">删除QQ<span id="login_error_infor"></span></h2>

			<div class="login_box">删除成功'  ;
	 echo ' </br><a href="index.php">返回首页</a></div></div></div>';
	 exit();} ?>
<div class="login_left">

			<?php include('bottom.php'); ?>
</div>
</div>
</div>
<?php
include('footer.php');
?>