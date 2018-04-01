<?php
session_start();
if(!isset($_SESSION['user_id'])) {
	echo "<meta http-equiv='refresh' content='0;url=login.html'>";
	exit;
}
$user_id = $_SESSION['user_id'];
	require_once("dbconfig.php");
	date_default_timezone_set('Asia/Seoul');

	$sql = 'select hw_no, hw_title, hw_image, hw_iteminfo, hw_id, hw_email, hw_method, hw_phone, hw_name, hw_like, hw_date, hw_price from bod_hw where hw_no = 2';
		$result = $db->query($sql);
		$row = $result->fetch_assoc()
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

echo $user_id;

?>  &nbsp; <a href="logout.php" class="btn btn-danger square-btn-adjust">Logout</a> </div>
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
					<li>
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


                 <!-- /. ROW  -->
                 <hr />

								 <?php
	 							date_default_timezone_set('Asia/Seoul');

	 								$sql = 'select * from bod_hw order by hw_no desc';
	 								$result = $db->query($sql);
	 								while($row = $result->fetch_assoc())
	 								{
	 									$datetime = explode(' ', $row['hw_date']);
	 									$date = $datetime[0];
	 									$time = $datetime[1];
	 									if($date == Date('Y-m-d')){
	 										$row['hw_date'] = $time;
	 									}else{
	 										$row['hw_date'] = $date;
										}
	 							?>


									<div class="col-md-4 col-sm-4" >
										<form name="inner_tab" action="inner_tab.php" method="get">
												<input type="hidden" name="sale_num" value="<?php echo $row['hw_no']?>">
												<div class="panel panel-primary" onclick="location.href='inner_tab.php?sale_num=<?php echo $row['hw_no']?>'" style="cursor: pointer;">
													<div class="panel-heading">
														<?php
														echo $row['hw_no']. ". &nbsp ";
														 echo $row['hw_title'];
														 ?>
														</div>

														<div class="panel-body">
															<?php echo $row['hw_date']?>
																<p>
																	<img src=<?php echo $row['hw_image']?> height="250" width="200">  </p>
														</div>
														<div class="panel-footer">


															가격: &nbsp		<?php echo $row['hw_price']?>&nbsp&nbsp	&nbsp	&nbsp	&nbsp		&nbsp
														</div>
										</div>
										</form>
									</div>

	 							<?php
	 								}
	 							?>
							</div>
						</div>
							<hr></hr>
							<p></p>

							<div align="center">
								<button class="panel-warning btn" onclick="location.href='hw_sale.php'">판매글 등록</button>

						</div>
					</div>

</div>
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
