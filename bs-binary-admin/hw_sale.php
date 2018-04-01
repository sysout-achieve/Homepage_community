<?
session_start();
require_once("dbconfig.php");

if(!isset($_SESSION['user_id'])) {
	echo "<meta http-equiv='refresh' content='0;url=login.html'>";
	exit;
}
$user_id = $_SESSION['user_id'];

//$_GET['bno']이 있을 때만 $bno 선언
if(isset($_GET['hw_no'])) {
	$hw_no = $_GET['hw_no'];
}

if(isset($hw_no)) {
$sql = 'select * from bod_hw where hw_no = ' . $hw_no;
	$result = $db->query($sql);
	$row = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
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
							<a  href="form.html"><i class="fa fa-edit fa-3x"></i> 업계 현황 </a>
					</li>



						</li>
				<li  >
							<a  href="blank.html"><i class="fa fa-square-o fa-3x"></i> Donation</a>
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

                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
								 <form action="hw_upload.php" method="post" enctype="multipart/form-data">
									 <?php		//bno를 포스트로 write update에 보내야함
	 								if(isset($hw_no)) {
	 									echo '<input type="hidden" name="hwno" value="' . $hw_no . '">';
	 								}
	 								?>
								 <div class="panel panel-primary">
								 		<div class="panel-heading">

											<input size="50%" style="background-color: #white; color:black;" type="text" name="hw_title" placeholder="제품명" value="<?php echo isset($row['hw_title'])?$row['hw_title']:null?>"/>
								 		</div>
								 		<div class="panel-body">
												<!--  이미지 저장 -->
											<p>
												<p><img src=<?php echo isset($row['hw_image'])?$row['hw_image']:null ?>></p>
													저장할 이미지를 선택해주세요: <input type="file" name="fileToUpload" id="fileToUpload" value="이미지 선택">


												</p>
								 		</div>

										<div class="row">
									 <div class="col-md-12 col-sm-12">
											 <div class="panel panel-default">
													 <div class="panel-heading">
															세부 정보
													 </div>
													 <div class="panel-body">


															 <div class="tab-content">
																	 <div class="tab-pane fade active in" id="home">
																			 <h4>Item 정보</h4>
																			 <p><textarea cols="100" rows="5" name="hw_Content" id="hw_Content" placeholder="제품 구입 시기, 제품 특징이나 스펙, 팔게 된 이유 등을 작성해주세요."><?php echo isset($row['hw_iteminfo'])?$row['hw_iteminfo']:null?></textarea></p>
																	 </div>
																	 <div class="tab-content" id="profile">
																			 <h4>판매자 정보</h4>
																			  <p><input type="hidden" name="hw_writer" value="<? echo $_SESSION['user_id'] ?>"></input>
																				 작성자 : &nbsp <? echo $user_id;?>
																			 </p>
																			 <p><input size="70%" style="background-color: #white; color:black;" type="text" name="hw_em" placeholder="email" value="<?php echo isset($row['hw_email'])?$row['hw_email']:null?>"/></p>
																						<p><input size="70%" style="background-color: #white; color:black;" type="text" name="hw_phone" placeholder="phone_number" value="<?php echo isset($row['hw_phone'])?$row['hw_phone']:null?>"/>
																				</p>
																	 </div>
																	 <div class="tab-content" id="messages">
																			 <h4>거래 방법</h4>
																			 <p><label for="select-id">방법 선택</label></p>
																						<p><select name="hw_name" id="select-id">
																						  <option value="직거래만">직거래만</option>
																						  <option value="택배거래만">택배거래만</option>
																						  <option value="직거래 & 택배거래 모두 가능">직거래 & 택배거래 모두 가능</option>
																						  <option value="팀노바 안전거래">팀노바 안전거래</option>
																						</select></p>
																				<p> <textarea cols="100" rows="5" name="hw_info" id="hw_info" placeholder="직거래 or 택배거래, 지역, 시간 등 거래에 필요한 기타 사항을 작성해주세요."><?php echo isset($row['hw_method'])?$row['hw_method']:null?></textarea></p>
																	 </div>

															 </div>
													 </div>
											 </div>
									 </div>
								 </div>

								 		<div class="panel-footer">
								 		<input size="50%" style="background-color: #white; color:black;" type="text" name="hw_price" placeholder="가격" value="<?php echo isset($row['hw_price'])?$row['hw_price']:null?>"/>
								 		</div>
								 </div>

								 <div align="center">
								 <button class="btn" type="submit"><?php echo isset($hw_no)?'수정하기':'판매글 올리기'?></button>
							<a href="tab-panel.php" style="background-color:#E6E6E6" class="btn">돌아가기</a>
							 </div>
</form>
               <!-- 코드 삭제 시작 -->

							 <!-- 코드 삭제 끝 -->
                    <!-- /. ROW  -->

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
