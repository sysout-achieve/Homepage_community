<?php
 require_once('dbconfig.php');

 $bNo = $_POST['bno'];
 $coId = $_POST['coId'];
 $coPassword = $_POST['coPassword'];
 $coContent = $_POST['coContent'];

$sql = 'insert into comment_free values(null, ' .$bNo . ', null, "' . $coContent . '", "' . $coId . '", password("' . $coPassword . '"))';
 $result = $db->query($sql);
 $coNo = $db->insert_id;
 $sql = 'update comment_free set co_order = co_no where co_no = ' . $coNo;
 $result = $db->query($sql);
 if($result) {
?>
 <script>
	 alert('댓글이 정상적으로 작성되었습니다.');
	 location.replace("bod_free_view.php?bno=<?php echo $bNo?>");
 </script>
<?php
 }
?>
