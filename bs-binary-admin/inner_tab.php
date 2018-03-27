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

	$sql = 'select hw_no, hw_title, hw_image, hw_iteminfo, hw_id, hw_email, hw_method, hw_phone, hw_name, hw_like, hw_date, hw_price from bod_hw where hw_no = ' .$num;
		$result = $db->query($sql);
		$row = $result->fetch_assoc()
	?>
﻿<!DOCTYPE html>
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

?> &nbsp; <a href="login.html" class="btn btn-danger square-btn-adjust">Logout</a> </div>
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
								 <div class="panel panel-primary">
								 		<div class="panel-heading">
											<?php

											#echo $num;



												echo $row['hw_title'];
											?>

								 		</div>
								 		<div class="panel-body">

								 				<p><img src=<? echo $row['hw_image']; ?>></p>
								 		</div>

										<div class="row">
									 <div class="col-md-12 col-sm-12">
											 <div class="panel panel-default">
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
																			 <p><? echo $row['hw_method']; ?></p>
																	 </div>

															 </div>
													 </div>
											 </div>
									 </div>
								 </div>

								 		<div class="panel-footer">
								 		<? echo $row['hw_price']; ?>

								 		</div>
								 </div>


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
