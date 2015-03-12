<?php include './header.php'; ?>
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
  <div class="wrap2 clearfix">
  
		<div class="login_right"align=left>
			<h2 style="margin:15px 0;">登录<span id="login_error_infor"></span></h2>

			<div class="login_box">
			<form id="qq_loginform" name="qq_loginform" action="index.php?type=login" method="post">
             <?  if(empty($_POST['submit'])) {?>
			 <dl>
				  <dt>用户名</dt>
			      <dt>
			        <input  id="qq" type="text" name="name" class="login_input" onKeyDown="" onKeyUp="" />
                  </dt>
		        </dl>

				<dl>

				 <dt>密码</dt>

				 <dd><input id="pwd" type="password" name="password" value="" class="login_input" /></dd>
				</dl>

				<div class="login_box_sub_new"><input class="login_btn_new" id="userlogin" type="submit" name="submit" value="登  录" />  <select id="cookieType" name="cookieType">
             <option value="3"> cookie保存30分钟 </option>
             <option value="1"> cookie保存3天  </option>
             <option value="2" selected="selected">  cookie保存30天</option>
           </select></div>

				<p align="right" class="fc_forget"><a href="http://gq.izzx.cc" title="">忘记密码？</a></p>
			<?php if($ad1!=""){echo'<h2 style="margin:15px 0;">广告合作<span id="login_error_infor"></span></h2>'.$ad1;} ?>
			</form>
			</div>
		</div>
<div class="login_left">
			<?php include('bottom.php'); ?>
	</div>
</div>
<?php
include('footer.php');
?>
<?php }
if(@$_GET['type']=='check'){
	$qqnumber=$_POST['qqnumber'];
	$a=qq_ifonline($qqnumber);
	
	echo $a;
	}
if(@$_GET['type']=='login') {
	$name=$_POST['name'];
	$pass=$_POST['password'];
	$cookietype=$_POST['cookieType'];//获取cookie变量值
	if ($cookietype==3){$cookietime=1800;}
	elseif($cookietype==1){$cookietime=3600*24*3;}
	else{$cookietime=3600*24*30;}
	
    user_login($name,$pass,$cookietime);
	} ?>