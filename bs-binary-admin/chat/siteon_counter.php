<?

$connect = @mysql_connect("localhost", "root", "7878") or die("");
@mysql_select_db("test") or die("");
@mysql_query("set names utf8");
//mysql_query("set names latin1");
//mysql_query("set names euckr");
$table_name = 'form_siteon';
$session_id = $_SESSION['user_id'];
$page = $_SERVER['HTTP_REFERER'];
if (strlen($page)<1) $page="direct";
$query = "insert into $table_name set session='$session_id'";
@mysql_query($query);
$query = "update $table_name set page='$page', ctime=now() where session='$session_id'";
@mysql_query($query);
$query = "delete from $table_name where ctime < DATE_SUB(NOW(), INTERVAL 10 SECOND)";
@mysql_query($query);

?>
