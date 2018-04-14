<?php
	require_once("../dbconfig.php");
	session_start();
	date_default_timezone_set('Asia/Seoul');

	$user_id = $_SESSION['user_id'];
	$date = date('Y-m-d H:i:s');
	//$_POST['hw_no']이 있을 때만 $hw_no 선언
	$hw_no = $_GET['hw_no'];
		$hw_name_in= $_GET['hw_name'];
		$hw_price_in= $_GET['hw_price'];
		$hw_img_in= $_GET['hw_img'];

echo $hw_no, $hw_name_in,$hw_price_in,$hw_img_in;

		$sql = 'update bod_hw set sale=1 where hw_no = ' . $hw_no;
		$result = $db -> query($sql);

			$sql = 'INSERT INTO sale (num, id, hw_no, price, process, date, hw_name, hw_img) VALUES(null, "' . $user_id . '", "' . $hw_no . '",  "' . $hw_price_in . '" , 5 , "' . $date . '", "' . $hw_name_in . '", "' . $hw_img_in . '")';
				$result = $db -> query($sql);
			 $replaceURL = '../table.php';
			?>
			<script>
			alert("결제 완료");
			location.replace("<?php echo $replaceURL?>");
			</script>
