<?php
session_start();
	require_once("dbconfig.php");
	//$_POST['hw_no']이 있을 때만 $h_wno 선언
if(isset($_GET['hw_no'])){
	$hw_no = $_GET['hw_no'];
	$user_id = $_SESSION['user_id'];

		$sql = 'insert into like_user (num, id, hw_n) values(null, "' . $user_id . '", "' . $hw_no .'")';
		$result = $db -> query($sql);
		if($result){
		 $msg = '찜했습니다.';
		 $replaceURL = 'inner_tab.php?sale_num=' . $hw_no;
	 } else{
		 $msg  = '찜을 성공하지 못했습니다.';
	 }
}
?>
<script>
	alert("<?php echo $msg?>");
	history.back();
</script>
