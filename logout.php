<?
setcookie('user', '', -86400);//生成同步退出的代码
include './db.inc.php';
include './header.php';
include './function.inc.php';
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
  <div class="wrap2 clearfix">
  
		<div class="login_right">
		
			<h2 style="margin:15px 0;">登出<span id="login_error_infor"></span></h2>

			<div class="login_box">
<div class="module">
  <div class="module-content">
    <?
	  echo '退出成功<br><a href="index.php">继续</a>';
      ?>
   </div>
</div>
   </div>
</div>
<div class="login_left">

			<?php include('bottom.php'); ?>
	</div>
</div>
</div>
<?php
include('footer.php');
exit;
?>