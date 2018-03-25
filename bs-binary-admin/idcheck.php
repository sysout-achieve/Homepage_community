<?php

$id = $_POST['a'];
header('Content-Type: application/json');
$mysqli=mysqli_connect("localhost","root","7878","user");
// $id = $_POST["a"];
$check="SELECT * from user_info WHERE id='$id' ";

$chkid=$mysqli->query($check);
try{
	if(!$id){
		throw new exception("Error Processing Request");

	}
		if($chkid->num_rows==0)
		{
			$result['success']	= true;
			$result['data']		= "{$id} 는 사용할 수 있습니다.";

		} else {
			$result['success'] = false;
			$result['msg'] = "중복된 아이디가 존재합니다.";
		}

 } catch(exception $e) {

		$result['success']	= false;
 		$result['msg']		= "$id";
		$result['code']		= $e->getCode();

	}
	finally {
		echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
	}

?>
