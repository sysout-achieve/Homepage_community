<?php
require_once("dbconfig.php");
date_default_timezone_set('Asia/Seoul');


	$hwtitle = $_POST['hw_title'];
	$hwContent = $_POST['hw_Content'];

	$hwwriter = $_POST['hw_writer'];
	$hwem = $_POST['hw_em'];
	$hwphone = $_POST['hw_phone'];

	$hwinfo = $_POST['hw_info'];
	$hwprice = $_POST['hw_price'];


	$date = date('Y-m-d H:i:s');


$target_dir = "img/upload/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$hw_image = $target_file;
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// 실제 이미지를 받아옴.
if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check !== false) {
				echo "이미지는 - " . $check["mime"] . ".";
				$uploadOk = 1;
		} else {
				echo "이미지파일만 올려주세요.";
				$uploadOk = 0;
		}
}
// 이미지의 크기가 5Mb 이하만 저장이 가능
if ($_FILES["fileToUpload"]["size"] > 5000000) {
		echo "이미지가 제한된 용량을 초과합니다. 5Mb";
		$uploadOk = 0;
}
// 확장자 검사
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
		echo "오직 JPG, JPEG, PNG, GIF 파일만 올릴 수 있습니다.";
		$uploadOk = 0;
}
// 업로드 완료 확인
if ($uploadOk == 0) {

} else {
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				echo "이미지 ". basename( $_FILES["fileToUpload"]["name"]). " 이 업로드 되었습니다.";
		} else {
				echo "이미지 업로드 중 에러가 발생했습니다.";
		}
}
$sql = 'INSERT INTO bod_hw (hw_no, hw_title, hw_image, hw_iteminfo, hw_id, hw_email, hw_method, hw_phone, hw_name, hw_like, hw_date, hw_price) VALUES(null, "' . $hwtitle . '", "' . $hw_image . '", "' . $hwContent . '", "' . $hwwriter . '", "' . $hwem . '", "' . $hwinfo . '", "' . $hwphone . '", 0, 0, "' . $date . '", "' . $hwprice . '")';

	$result = $db->query($sql);

	if($result) { // query가 정상실행 되었다면,
		$msg = "정상적으로 글이 등록되었습니다.";
		$bNo = $db->insert_id;
		$replaceURL = 'tab-panel.php';
	} else {
		$msg = "글을 등록하지 못했습니다.";
?>

		<script>
			alert("<?php echo $msg?>");
			history.back();
		</script>

<?php
	}
?>

<script>
	alert("<?php echo $msg?>");
	location.replace("<?php echo $replaceURL?>");
</script>
