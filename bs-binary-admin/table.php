<?
session_start();
require_once("dbconfig.php");
date_default_timezone_set('Asia/Seoul');
if(!isset($_SESSION['user_id'])) {
	echo "<meta http-equiv='refresh' content='0;url=login.html'>";
	exit;
}
$user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Nova Network</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->

        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
     <!-- TABLE STYLES-->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
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
float: right;
font-size: 16px;">
<?php
echo "access : ";

echo $_SESSION['user_id'];

?>

  &nbsp; <a href="logout.php" class="btn btn-danger square-btn-adjust">Logout</a> </div>
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
							<a href="tab-panel.php"><i class="fa fa-qrcode fa-3x"></i> hardware 장터</a>
					</li>

					<li  >
							<a  href="chat/form.php"><i class="fa fa-edit fa-3x"></i> 업계 현황 </a>
					</li>



						</li>
				<li  >
							<a  href="blank.php"><i class="fa fa-square-o fa-3x"></i> 찜 목록</a>
					</li>
					<li>
						<a class="active-menu" href="table.php"><i class="fa fa-table fa-3x"></i>구매이력</a>
				</li>
                </ul>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>구매이력</h2>
                        <h5>구매한 항목을 보여줍니다.</h5>

                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />

            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            구매이력
                        </div>
												<?

											 	$sql = 'select * from sale where id="' . $user_id .'" order by num desc' ;
												$result = $db->query($sql);

												while ($row = $result->fetch_assoc())
				 								{
				 									$datetime = explode(' ', $row['date']);
				 									$date = $datetime[0];
				 									$time = $datetime[1];
				 									if ($date == Date('Y-m-d')) {
				 										$row['date'] = $time;
				 									} else {
				 										$row['date'] = $date;
													}
				 							?>


												<div class="col-md-8 col-sm-12" >
													<form name="inner_tab" action="inner_tab.php" method="get">
															<input type="hidden" name="sale_num" value="<?php echo $row['hw_no']?>">

																<div class="panel panel-primary" onclick="location.href='inner_tab.php?sale_num=<?php echo $row['hw_no']?>'" style="cursor: pointer;">
																<div class="panel-heading">
																	<?php
																	echo $row['hw_no']. ". &nbsp ";
																	echo $row['hw_name'];
																	 ?>
																	</div>

																	<div class="panel-body" style="padding: 5px 50px 5px 25px; ">
																		 <p><img src=<? echo $row['hw_img']; ?> height="140" width="160"></p>
																	</div>
																	<div class="panel-footer">
																		가격: &nbsp		<?php echo $row['price']?>
																	</div>
													</div>
													</form>
												</div>


												<div class="col-md-4 col-sm-12">
													<div class="panel panel-default">
														<div class="panel-heading">
															결제 상태
														</div>
														<div class="panel-body">
														<?
														if($row['process']==5){
														?>
														<br />
															<span style="float: center;"> 결제 완료 </span><br />
															<span style="float: center;">결제 시간 : <?	echo $row['date'];?></span>
															<br />
															<br />
														<?
														} else if ($row['process']==5){
														?>
													<span style="float: center;"> 거래 완료 </span>
													<span style="float: center;"><?	echo $row['date'];?></span>

														<?
														}
														?>
														</div>
														<div class="panel-footer">
															<br />
														</div>
													</div>

												</div>
												<?php
					 								}
													?>
                    <!--End Advanced Tables -->
                </div>
            </div>
                <!-- /. ROW  -->


			<!-- 삭제한 코드 시작 -->
			<!-- GET을 이용해 게시판 내용 전달 스크립트-->
			<script src="js/table_submit.js"></script>
			<!-- /. PAGE WRAPPER  -->
			<!-- /. WRAPPER  -->
			<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
			<!-- JQUERY SCRIPTS -->
			<script src="assets/js/jquery-1.10.2.js"></script>
			<!-- BOOTSTRAP SCRIPTS -->
			<script src="assets/js/bootstrap.min.js"></script>
			<!-- METISMENU SCRIPTS -->
			<script src="assets/js/jquery.metisMenu.js"></script>
			<!-- DATA TABLE SCRIPTS -->
			<script src="assets/js/dataTables/jquery.dataTables.js"></script>
			<script src="assets/js/dataTables/dataTables.bootstrap.js"></script>

			<script>
			$(document).ready(function () {
					$('#dataTables-example').dataTable();
			});
			</script>
			<!-- CUSTOM SCRIPTS -->
			<script src="assets/js/custom.js"></script>
			<!--  삭제한 코드 끝-->


</body>
</html>
