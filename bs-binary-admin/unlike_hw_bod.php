<?php
session_start();
	require_once("dbconfig.php");
	//$_POST['hw_no']이 있을 때만 $h_wno 선언
if (isset($_GET['hw_no'])) {
	$hw_no = $_GET['hw_no'];
	$user_id = $_SESSION['user_id'];

	$sql = 'delete from like_user where id="' .$user_id.'"  and hw_n = ' . $hw_no;
	$result = $db->query($sql);

		if ($result) {
		 $msg = '찜을 해제했습니다.';
		 $replaceURL = 'inner_tab.php?sale_num=' . $hw_no;
	 } else {
		 $msg  = '찜 해제에 실패했습니다.';
	 }
}


?>
<script>
	alert("<?php echo $msg?>");
	history.back();
</script>
