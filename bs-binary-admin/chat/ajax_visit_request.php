<?php
date_default_timezone_set('Asia/Seoul');
session_start();

    header("Pragma: no-cache"); // 이 두줄의 코드는 웹 브라우저에게 응답 내용을 캐시로 남기지 말라는
    header("Cache-Control: no-cache,must-revalidate");                // 의미를 전달하는 응답 헤더임.
    header("Content-Type: text/plain");
    $current = date("Y-m-d H:i:s");

		$db = new mysqli('localhost', 'root', '7878', 'test');
		$db->set_charset('utf8');
		$table_name = 'form_siteon';
		$session_id = $_SESSION['user_id'];
		$page = $_SERVER['HTTP_REFERER'];

$query0 = "select * from form_siteon where session=" .$session_id;
$result0=$db->query($query0);
$row_cnt0= $result0->num_rows;
if ($row_cnt0 != 1) {
	$query = "insert into $table_name set session='$session_id'";
	$db->query($query);
}
if(isset($session_id)){
	$query = "update $table_name set page='$page', ctime=now() where session='$session_id'";
	$db->query($query);
}
$query = "delete from $table_name where ctime < DATE_SUB(NOW(), INTERVAL 1 SECOND)";
	$db->query($query);
			$query = "select * from $table_name";
			$result = $db->query($query);
			$row_cnt= $result->num_rows;
			echo "인원 ".$row_cnt."명<br /><br />\n";

			while($row = $result->fetch_assoc()) 	{
				echo  $row['session']."<br />";
			}

?>
