<?php

	require_once("dbconfig.php");
	date_default_timezone_set('Asia/Seoul');

	//$_POST['bno']이 있을 때만 $bno 선언
		if(isset($_POST['bno'])) {
			$bNo = $_POST['bno'];
		}

		//bno이 없다면(글 쓰기라면) 변수 선언
		if(empty($bNo)) {
			$bID = $_POST['bID'];
			$date = date('Y-m-d H:i:s');
		}

	$bPassword = $_POST['bPassword'];
	$bTitle = $_POST['bTitle'];
	$bContent = $_POST['bContent'];


	//글 수정
	if(isset($bNo)) {
		$sql = 'update board_free set b_title="' . $bTitle . '", b_content="' . $bContent . '" where b_no = ' . $bNo;
		$msgState = '수정';
	}
		//글 등록
	else{
	$sql = 'insert into board_free (b_no, b_title, b_content, b_date, b_hit, b_id, b_password) values(null, "' . $bTitle . '", "' . $bContent . '", "' . $date . '", 0, "' . $bID . '", password("' . $bPassword . '"))';
	$msgState='등록';
	}
	$result = $db->query($sql);

	if($result) { // query가 정상실행 되었다면,
		$msg = '정상적으로 글이 ' . $msgState . '되었습니다.';
		if(empty($bNo)) {
			$bNo = $db->insert_id;
		}
			$replaceURL = 'ui.php';
	} else {
			$msg = '글을 ' . $msgState . '하지 못했습니다.';
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
