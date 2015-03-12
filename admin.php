<?php
session_start();
include 'header.php';
?>
<!--[if IE 6]>
<div style="color:#B94A48;text-align:center;font-size:12px;border:1px solid #dedede;background:#FCF8E3;height:24px;line-height:24px;">您的浏览器版本过低，心挂Q浏览效果不佳，推荐您升级到<a href="http://windows.microsoft.com/zh-CN/internet-explorer/products/ie/home" target="_blank">IE8</a>以上或者使用<a href="http://www.google.cn/chrome/intl/zh-CN/landing_chrome.html" target="_blank">谷歌浏览器</a></div>
<![endif]-->
  <div class="wrapper"align=center>
  <div class="google-header-bar">
  <div class="header content clearfix">
  <a href='index.php'><img class="logo" src="./img/logo.png" alt="IZZX"></a>
  <span class="signup-button">
  管理员欢迎您！
  </span>  </div>
  </div>
  <br>
  <div class="wrap2 clearfix">
  <div class="login_right"align=left>
<?php
include('function.inc.php');

if(!isset($_POST['submit'])){
    echo '<form name="form" method="post" action="admin.php">
    <h2 style="margin:15px 0;">'.$webname.' 管理员登陆<span id="login_error_infor"></span></h2>
      <dl><dt>管理员账号</dt>
        <dt><input type="text" class="login_input" name="spuser" value="localhost"/></dt>
      </dl>
	  <dl><dt>管理员密码</dt>
        <dt><input type="password" class="login_input" name="sppass" value=""/></dt>
      </dl>
      <dt>
        <input type="submit" name="submit" class="g-button g-button-write" value="登 陆" />
      </dt>
</form>';
    }
else{
        if(!isset($_POST['spuser'])){echo '请输入管理员账号';exit();}
        else if(!isset($_POST['sppass'])){echo '请输入管理员密码';exit();}
        else if($_POST['spuser']!=$spuser){echo '管理员账号错误';exit();}
        else if($_POST['sppass']!=$sppass){echo '管理员密码错误';exit();}
    else{
        echo'<form name="form1" method="post" action="admin.php">
    <h2 style="margin:15px 0;">'.$webname.' 管理中心<span id="login_error_infor"></span></h2>
    <dl>
      <dt>腾讯微博账号（设置此项使用户收听您的腾讯微博）
        <input type="text" class="login_input" name="weibo" value="'.$weibo.'"/></dt>
      </dl>
      
      <dl>
	  <dt>顶部 公告（请使用html代码）
        <input class="login_input" type="text" name="msg" value="'.$msg.'"/></dt>
      </dl>
      <dl>
      <dt>底部 公告（请使用html代码）
        <input class="login_input" type="text" name="qqfaq" value="'.$gqfaq.'"/></dt>
      </dl>
      <dl>
      <dt>网站名称:&nbsp&nbsp&nbsp
        <input type="text" class="login_input" name="webname" value="'.$webname.'"/></dt>
      </dl>
      <dl>
      <dt>Pctowap App_id(<a href="http://open.pctowap.com/pop_developer_login.html">申请一个</a>):
        <input type="text" class="login_input" name="pcwapid" value="'.$pcwapid.'"/></dt>
      </dl>
      <dl>
      <dt>管理员账号:
        <input type="text" class="login_input" name="user" value="'.$spuser.'"/></dt>
      </dl>
      <dl>
      <dt>管理员密码:
        <input type="text" class="login_input" name="pass" value="'.$sppass.'"/></dt>
        </dl>
      <dl>
      <dt>广告1（Cpc类型）:
        <input type="text" class="login_input" name="ad1" value="'.$ad1.'"/></dt>
        </dl>
      <dl>
      <dt>广告2（Cpv、Cpm类型）:
        <input type="text" class="login_input" name="ad2" value="'.$ad2.'"/></dt>
        </dl>
      <dt>
        <input type="submit" name="setup" class="g-button g-button-write" value="修 改" />
      </dt>
</form>';
    }
}
if(isset($_POST['setup'])){
if($_POST['weibo']==""&&$_POST['msg']==""&&$_POST['qqfaq']==""&&$_POST['webname']="")
    {
    echo '请输入完整的信息！<br><a href="admin.php">返回</a>';
    }
else{
$txt="<?
//本文件可以通过安装的时候生成！

static \$_config=array();

\$host=\"$host\"; //数据库的IP
\$db=\"$db\"; //数据库名字
\$user=\"$user\"; //数据库的用户名
\$password=\"$password\"; //数据库的密码
\$table=\"$table\"; //数据表前缀
\$weibo=\"$_POST[weibo]\"; //腾讯微博账号
\$msg=\"$_POST[msg]\"; //公告（顶部）
\$gqfaq=\"$_POST[qqfaq]\"; //帮助（底部）
\$webname=\"$_POST[webname]\"; //网站名称
\$pcwapid=\"$_POST[pcwapid]\"; 
/*Pctowap App_id  到http://open.pctowap.com/pop_developer_login.html申请一个账号并登陆。
点击\"申请应用\"来获得一个默认调用代码，将代码中的&app_id=***中的***写入即可。

例：

默认调用代码:
<script src='http://open.pctowap.com/dowap/popcall.php?u=123.pctowap.com/wap&app_id=114' ></script>        144即为App_id.  */


\$spuser=\"$_POST[user]\"; //管理员账号
\$sppass=\"$_POST[pass]\"; //管理员密码
\$ad1=\"$_POST[ad1]\"; //广告位1
\$ad2=\"$_POST[ad2]\"; //广告位2
?>";
        $fp=fopen('db.inc.php','w');
        flock($fp,LOCK_EX);
        $write=fputs($fp,$txt);
        flock($fp,LOCK_UN);
        fclose($fp);
        if($write){
	         echo '配置文件成功';
			 echo "</br><div class='btn-s'><a href='index.php'>进入首页</a></div>";
	    }else{
		     echo "保存配置失败！请开启目录0777权限。<br />";
		}
}
}
?>
</div>
  <div class="login_left">
			<h2><?php include('adminfaq.php'); ?></h2>

</div>
</div>
</div>
<?php include('footer.php'); ?>