<?
session_start();
require_once("../dbconfig.php");
date_default_timezone_set('Asia/Seoul');
if(!isset($_SESSION['user_id'])) {
	echo "<meta http-equiv='refresh' content='0;url=login.html'>";
	exit;
}
$user_id = $_SESSION['user_id'];
$sql2 = 'select name, email from user_info where id='.$user_id ;
$result2 = $db->query($sql2);
while($row = $result2->fetch_assoc()){
	$user_name = $row['name'];
	$user_email = $row['email'];

}

?>
