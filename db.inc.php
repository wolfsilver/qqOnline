<?
static $_config=array();
//获取数据库密码等
$db = SAE_MYSQL_DB;//数据库名
$host = SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT;//getenv('HTTP_BAE_ENV_ADDR_SQL_IP').":".getenv('HTTP_BAE_ENV_ADDR_SQL_PORT');
$user = SAE_MYSQL_USER;//getenv('HTTP_BAE_ENV_AK');
$password = SAE_MYSQL_PASS;//getenv('HTTP_BAE_ENV_SK');

$table="qq_"; //数据表前缀,勿修改
$weibo=""; //腾讯微博账号
$msg="欢迎使用网页挂QQ！"; //公告（顶部）
$gqfaq="挂机时间：每日0-6点"; //帮助（底部）
$webname="网页挂Q"; //网站名称
$sjwebname="网页挂Q手机版"; //手机网站名称
$pcwapid=""; //那个PcwapID

$spuser=""; //管理员账号
$sppass=""; //管理员密码
$ad1=""; //广告位1
$ad2=""; //广告位2
?>