<?php
	require_once("dbconfig.php");
	//$_POST['bno']이 있을 때만 $bno 선언
	if(isset($_POST['bno'])) {
		$bNo = $_POST['bno'];
	}

	$sql = 'delete from board_free where b_no = ' . $bNo;
	$result = $db->query($sql);

	if($result) {
		$msg = '정상적으로 글이 삭제되었습니다.';
		$replaceURL = 'ui.php';
	} else {
		$msg = '글을 삭제하지 못했습니다.';
?>
	<script>
		alert("<?php echo $msg?>");
		history.back();
	</script>
	<?php
	exit;
}
?>
<script>
	alert("<?php echo $msg?>");
	location.replace("<?php echo $replaceURL?>");
</script>
