<?php

ob_start();
include './db.inc.php';
include './function.inc.php';
include './header.php';
?>
  <!--[if IE 6]>
<div style="color:#B94A48;text-align:center;font-size:12px;border:1px solid #dedede;background:#FCF8E3;height:24px;line-height:24px;">您的浏览器版本过低，心挂Q浏览效果不佳，推荐您升级到<a href="http://windows.microsoft.com/zh-CN/internet-explorer/products/ie/home" target="_blank">IE8</a>以上或者使用<a href="http://www.google.cn/chrome/intl/zh-CN/landing_chrome.html" target="_blank">谷歌浏览器</a></div>
<![endif]-->
  <div class="wrapper">
  <div class="google-header-bar">
  <div class="header content clearfix">
  <a href='index.php'><img class="logo" src="./img/logo.png" alt="IZZX"></a>
  <span class="signup-button">
  第一次使用心挂Q？
  <a id="link-signup" class="g-button g-button-red" href="reg.php">
  创建帐户  </a>  </span>  </div>
  </div>
  <br>
  <div class="wrap2 clearfix">
  
		<div class="login_right">
			<h2 style="margin:15px 0;">注册<span id="login_error_infor"></span></h2>
<?  if(empty($_POST['submit'])) {?>
<div class="login_box">
        <form id="qq_regform" action="reg.php" method="post">
        <dt>请输入昵称</dt>

        <input class="login_input" id="qq" type="text" name="name" value="" maxlength="16"/>

        <dt>请设置登录密码</dt>

        <input class="login_input" id="pwd" type="password" name="pass" value="" maxlength="16"/>

        <dt>再输一次密码</dt>

        <input class="login_input" id="cellNum" type="password" name="pass2" value="" maxlength="16"/>
<br><br>
        <input class="login_btn_new" id="action" class="btn-s" type="submit" name="submit" value="注册"/>
       <br/>
       </form>
     </div>
	 <br><br>
   <a href="index.php">返回登陆</a>
</div><div class="login_left">
			<?php include('bottom.php'); ?>
	</div></div>
<? } else {
	$name=$_POST['name'];
	$pass=$_POST['pass'];
	$pass2=$_POST['pass2'];//获取post值
	user_reg($name,$pass,$pass2);//将变量传入注册函数
	}?>


<?php
include('footer.php');
?>