<?

include './db.inc.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><? echo $webname?></title>
<link rel="stylesheet" type="text/css" href="common.css">
</head>
<body>
<div class="module">
  <div class="module-content">
    <?
      setcookie('user', '', -86400);
        //生成同步退出的代码
	  echo '退出成功<br><a href="index.php">继续</a>';
      exit;?>
   </div>
</div>
</body>
</html>