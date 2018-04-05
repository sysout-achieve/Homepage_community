<?php
session_start();
if(!isset($_SESSION['user_id'])) {
	echo "<meta http-equiv='refresh' content='0;url=login.html'>";
	exit;
}
$user_id = $_SESSION['user_id'];

	require_once("dbconfig.php");
	date_default_timezone_set('Asia/Seoul');

	$num=$_GET['sale_num'];

	$sql = 'select hw_no, hw_title, hw_image, hw_iteminfo, hw_id, hw_email, hw_method, hw_phone, hw_name, hw_like, hw_date, hw_price, sale from bod_hw where hw_no = ' .$num;
		$result = $db->query($sql);
		$row = $result->fetch_assoc()
	?>
﻿<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
				<script src="./js/jquery-2.1.3.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>NOVA NETWORK</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
	<style type='text/css'>
	 table {
 	  width: 95%;

 	  border: 1px solid #C5B798;
 	  margin-top: 15px;
 	  margin-bottom: 25px;
 	}
 	td {
 	  border-bottom: 1px solid #CDC1A7;
 		border-bottom-width: 1px;
 	  padding: 5px;
 	}
 	th {
 	  font-family: "Trebuchet MS", Arial, Verdana;
 	  font-size: 14px;
 	  padding: 5px;
 	  border-bottom-width: 1px;
 	  border-bottom-style: solid;
 	  border-bottom-color: #03B4FA;
 	  background-color: #FAABD3;
 	  color: #black;
 	}
 	</style>
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">NOVA NETWORK</a>
            </div>
  <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;z
font-size: 16px;">
<?php
echo "access : ";

echo $_SESSION['user_id'];

?> &nbsp; <a href="logout.php" class="btn btn-danger square-btn-adjust">Logout</a> </div>
        </nav>
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
				<li class="text-center">
                    <img src="assets/img/find_user.png" class="user-image img-responsive"/>
					</li>


					<li>
							<a href="index.html"><i class="fa fa-dashboard fa-3x"></i> 내 정보</a>
					</li>
					 <li>
							<a href="ui.php"><i class="fa fa-desktop fa-3x"></i> 자유게시판</a>
					</li>
					<li>
							<a class="active-menu" href="tab-panel.php"><i class="fa fa-qrcode fa-3x"></i> hardware 장터</a>
					</li>
					<li>
								<a href="chart.html"><i class="fa fa-bar-chart-o fa-3x"></i> 알고리즘 퀴즈</a>
					</li>
						<li>
							<a  href="table.html"><i class="fa fa-table fa-3x"></i>개발정보</a>
					</li>
					<li  >
							<a  href="chat/form.php"><i class="fa fa-edit fa-3x"></i> 업계 현황 </a>
					</li>



						</li>
				<li  >
							<a  href="blank.php"><i class="fa fa-square-o fa-3x"></i> 찜 목록</a>
					</li>
                </ul>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Hardware 장터 </h2>
                        <h5></h5>
<hr></hr>
<hr></hr>
                    </div>

                 <!-- /. ROW  -->
                 <hr />

								 <div class="col-md-12 col-sm-12">

									 <?php		//판매완료 시 sale 숫자가 1이되고 판매 완료 버튼이 사라짐
											if($row['sale'] == 0){
									 ?>
											<div class="panel panel-primary">
										<?
									} if($row['sale'] == 1){
										?>
										 <div class="panel panel-danger">
											 <?
										 }
											 ?>
								 		<div class="panel-heading">
											<?php

											#echo $num;


												echo $row['hw_no']. ". &nbsp" ;
												echo $row['hw_title'];
											?>

								 		</div>
								 		<div class="panel-body">
											<? echo $row['hw_date']; ?>
											<?php		//판매완료 시 sale 숫자가 1이되고 soldout 이미지로 바뀜
												 if($row['sale'] == 0){
											?>
												 <p><img src=<? echo $row['hw_image']; ?>></p>
											 <?
										 } if($row['sale'] == 1){
											 ?>
										<p><img src="img/soldout.png"></p>
													<?
												}
													?>

								 		</div>

										<?php		//판매완료 시 sale 숫자가 1이되고 div 색이 변경
											 if($row['sale'] == 0){
										?>
											 <div class="panel panel-default">
										 <?
									 } if($row['sale'] == 1){
										 ?>
										 	<div class="panel panel-danger">
												<?
											}
												?>
													 <div class="panel-heading">
															세부 정보
													 </div>
													 <div class="panel-body">
															 <ul class="nav nav-tabs">
																	 <li class="active"><a href="#home" data-toggle="tab">Item 정보</a>
																	 </li>
																	 <li class=""><a href="#profile" data-toggle="tab">판매자 정보</a>
																	 </li>
																	 <li class=""><a href="#messages" data-toggle="tab">거래 방법</a>
																	 </li>

															 </ul>

															 <div class="tab-content">
																	 <div class="tab-pane fade active in" id="home">
																			 <h4>Item 정보</h4>
																			 <p><? echo $row['hw_iteminfo']; ?></p>
																	 </div>
																	 <div class="tab-pane fade" id="profile">
																			 <h4>판매자 정보</h4>
																			 <p> 판매자 아이디 : <? echo $row['hw_id']; ?>
																		<br>
																						E-mail : <? echo $row['hw_email'];?>
																					<br>
																					Phone :	<? echo $row['hw_phone'];?></p>
																	 </div>
																	 <div class="tab-pane fade" id="messages">
																			 <h4>거래 방법</h4>
																			 <p><? echo $row['hw_name'];?></p>
																			  <p><? echo $row['hw_method']; ?></p>
																	 </div>

															 </div>

									 </div>
								 </div>

								 		<div class="panel-footer">
								 		<? echo $row['hw_price']; ?>

								 		</div>
								 </div>		 <div class="btnSet">
													<form action="delete_hw_bod.php" method="post"  onsubmit="button_event(); return false;">
														<input type="hidden" name="hw_no" value="'<? echo $num ?> '">
														<?php		// id가 작성자와 같을 때만 수정 삭제 판매완료 버튼이 보임
															 if($row['hw_id'] == $_SESSION['user_id']){
														?>
													 <button class="btn" onclick="button_event_modify(); return false;">수정</button>

													 <script type="text/javascript">
															 function button_event_modify(){
																 if(confirm("수정하시겠습니까?")==true){
																	 location.href='./hw_sale.php?hw_no=<?php echo $num?>';
																 }
																 else{
																	 return false;
																 }
															 }
													 </script>

													 <button class="btnSubmit btn" onclick="button_event_delete(); return false;">삭제</button>
													 <script type="text/javascript">
															 function button_event_delete(){
																 if (confirm("정말 삭제하시겠습니까??") == true){
																		 document.form.submit();
																 } else {
																		 return false;
																 }
															 }
															 </script>
															 <?php		//판매완료 시 sale 숫자가 1이되고 판매 완료 버튼이 사라짐
																	if($row['sale'] == 0){
															 ?>
													 <button class="btnSubmit btn" onclick="button_event_fin(); return false;">판매완료</button>
													<script type="text/javascript">
															function button_event_fin(){
																if (confirm("판매를 완료 하시겠습니까?") == true){

																			location.href='./delete_hw_bod.php?hw_no=<?php echo $num?>';

																} else {
																		return false;
																}
															}
															</script>
														<?
															}
														}
														?>
													 <a href="tab-panel.php"  style="background-color:#E6E6E6" class="btnList btn">목록</a>
													 <div align="center">
													 <button class="btnSubmit btn" style="height:50px; width:70px;" onclick="button_event_like(); return false;">찜 ♥  </button>
													<script type="text/javascript">
															function button_event_like(){
																if (confirm("찜목록에 추가 하시겠습니까?") == true){

																			location.href='./like_hw_bod.php?hw_no=<?php echo $num?>';

																} else {
																		return false;
																}
															}
															</script>
														</div>
													 <hr>
												 </form>
												 </div>
							 </div>

							 <div id="boardComment">
						 		<?php require_once('./hw_comment.php')?>
						 	</div>

								 <!-- <div class="col-md-12 col-sm-1">
									 <hr></>
									 <div class="panel panel-default">
										 <div class="panel-heading">
											 댓글달기
										 </div>
										 <div class="panel-body">
											 <form name="comment_form" id="comment_form" action="hw_comment_update.php" method="post">
												 <input type="hidden" name="hwno" value="<?php echo $num?>"></input>
												 <input type="hidden" name="hwcoId" value="<? echo $_SESSION['user_id'] ?>"></input>
												 <label for="coId">작성자 </label> &nbsp <? echo $_SESSION['user_id']; ?>
												 <hr>
												 <label for="coContent">내용</label>
												 <br>
												 <textarea cols="140" rows="3" name="coContent" id="coContent"></textarea>
											 </div>
											 <div class="panel-footer">
												 <button class="btnSubmit btn" > 댓글 달기 </button> -->


							 						</form>

							 			 </div>
							 					 </div>

							 </div>

               <!-- 코드 삭제 시작 -->

							 <!-- 코드 삭제 끝 -->
                    <!-- /. ROW  -->
</div>
 </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>

</body>
</html>
