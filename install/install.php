<? 
include '../db.inc.php';
//数据库文件导入函数
function do_sql(){
global $host,$user,$password,$db;
@$conn=mysql_connect($host,$user,$password) or die("数据库链接失败！请检查你填写的数据库信息。");
@mysql_query("set names 'utf8'");
@$select=mysql_select_db($db,$conn);
if($conn and $select){
############执行数据库
$sql_txt=file_get_contents("qq.sql");
$explode = explode(";",$sql_txt);
$cnt = count($explode);
//循环导入数据库文件
for($i=0;$i<$cnt ;$i++){
    $sql = $explode[$i];
    $result = mysql_query($sql);}
if($result){
        echo "数据库初始化成功，共".$i."个查询<br>";
}else{
        echo "数据库初始化失败，请手动导入".mysql_error();
    }
}else{echo "数据库连接失败！<br />";}
}	
?>	
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title><?php include('./db.inc.php'); echo $webname;?></title>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<link rel="icon" type="image/ico" href="favicon.ico" />

<?php
	do_sql();



?>