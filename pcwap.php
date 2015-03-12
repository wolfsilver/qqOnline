<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="undefined">
<head>
<TITLE><?php include('db.inc.php'); echo $webname;?>|iWap在线浏览器|IZZX</TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="icon" type="image/ico" href="favicon.ico" />
  <link href="./css/login.css" rel="stylesheet" />
  <link href="./css/css.css" rel="stylesheet" />
  <link href="./css/loginbox.css" rel="stylesheet" />
  <link href="./css/webscan_user.css" rel="stylesheet" />
  <script type="text/javascript" src="./png.js"></script>
</head>
<!--[if IE 6]>
<div style="color:#B94A48;text-align:center;font-size:12px;border:1px solid #dedede;background:#FCF8E3;height:24px;line-height:24px;">您的浏览器版本过低，心挂Q浏览效果不佳，推荐您升级到<a href="http://windows.microsoft.com/zh-CN/internet-explorer/products/ie/home" target="_blank">IE8</a>以上或者使用<a href="http://www.google.cn/chrome/intl/zh-CN/landing_chrome.html" target="_blank">谷歌浏览器</a></div>
<![endif]-->
  <div class="wrapper"align=center>
  <div class="google-header-bar">
  <div class="header content clearfix">
  <a href='index.php'><img class="logo" src="./img/logo.png" alt="IZZX"></a>
  <span class="signup-button">
  第一次使用心挂Q？
  <a id="link-signup" class="g-button g-button-red" href="reg.php">
  创建帐户  </a>  </span>  </div>
  </div>
  <br>
<?php 
include './function.inc.php';
//$test=$_GET['url'];
$url=urlencode($_GET['url']);
//echo 'url=='.$url.'<br>';
//$u2=urldecode($url); 
//echo 'u2=='.$u2;

?>
<div class="wrap2 clearfix">
    <div class="login_left2">
      <IFRAME src="http://open.pctowap.com/dowap/dowap1.php?app_id=<?php echo $pcwapid; ?>&u=<?php echo $url; ?>" marginWidth=0 marginHeight=0 scrolling=no frameBorder=0 class="STYLE1" style="WIDTH: 100%; HEIGHT: 440px"></IFRAME>
    </div>
    <div class="login_right"align=left>
			<h2 style="margin:15px 0;">快捷通道<span id="login_error_infor"></span></h2>
            <form action="iphone.php">
            <dl>
            <dt>QQ号码</dt>
            <dt><input  id="qq" type="text" name="qq" class="login_input" onKeyDown="" onKeyUp="" value='<?php echo $_GET['qq']; ?>'/></dt>
            </dl>
            <dl>
            <dt>SID码</dt>
            <dt><input  id="qq" type="text" name="sid" class="login_input" onKeyDown="" onKeyUp="" value="<?php echo $_GET['sid']; ?>"/></dt>
            </dl>
            <dt>
            <input class="g-button g-button-red" id="userlogin" type="submit" name="submit" value="iPhone说说" />
            <a id="link-signup" class="g-button g-button-write" href="index.php">返回首页</a>
            </dt>
            </form>
			<div class="login_box">
			
    </div>
</div>
</div>
<?php include('footer.php'); ?>