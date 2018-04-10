<?php
$id=$_POST['id'];
$pw=$_POST['password'];
$name=$_POST['name'];
$email=$_POST['email'];
$code= $_POST['chk_code'];

if($code==1234){
	if($id==NULL || $pw==NULL || $name==NULL || $email==NULL) //
	{
	    echo "빈 칸을 모두 채워주세요";
	    echo "<br></br><a href=login.html>login page</a>";
	    exit();
	}

	$mysqli=mysqli_connect("localhost","root","7878","user");

	$check="SELECT * from user_info WHERE id='$id' ";
	$result=$mysqli->query($check);
	if($result->num_rows==1)
	{
	    echo "중복된 id입니다.";
	    echo "<br></br><a href=login.html>back page</a>";
	    exit();
	}

	$signup=mysqli_query($mysqli,"INSERT INTO user_info (id,password,name,email)
	VALUES ('$id','$pw','$name','$email')");
	if($signup){
	    echo "sign up success";
			echo "<br></br><a href=login.html>login page</a>";
			exit();
	}
} else{
	echo "수료 코드가 존재하지 않습니다.";
	echo "<br></br><a href=login.html>login page</a>";
	exit();
}
?>
