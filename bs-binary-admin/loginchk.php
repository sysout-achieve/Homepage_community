<?php

$id = $_POST['id'];
$password = $_POST['password'];

header('Content-Type: application/json');
$mysqli=mysqli_connect("localhost","root","7878","user");
$sql = "SELECT * FROM user_info WHERE id ='$id' AND password = '$password'";

$chklogin=$mysqli->query($sql);
try{
	$row = $chklogin->fetch_array(MYSQLI_ASSOC);	//넘어온 결과를 한 행씩 $row라는 배열에 담음.

		if($row!=null)
		{
			$result['success']=true;
			$result['data']=true;
		} else {
			$result['success'] = false;
			$result['msg'] = "아이디 혹은 비밀번호를 정확히 입력해주세요.";
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
