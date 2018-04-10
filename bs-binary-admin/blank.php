<?php
require_once("dbconfig.php");

session_start();
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
							<a  href="tab-panel.php"><i class="fa fa-qrcode fa-3x"></i> hardware 장터</a>
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
							<a class="active-menu" href="blank.php"><i class="fa fa-square-o fa-3x"></i> 찜 목록</a>
					</li>
                </ul>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>찜 목록</h2>
                        <h5>당신이 찜한 목록입니다. </h5>
													<hr></hr>
                    </div>


                 <!-- /. ROW  -->
                 <hr />
								 <?php
								date_default_timezone_set('Asia/Seoul');
							//hw 제품 hw_no의 순서대로 db에서 값 불러와서 각 div에 값을 넣어줌.
							$sql = 'select * from bod_hw order by hw_no desc';
							$sql = 'select * from like_user where id="' . $user_id .'" order by hw_n desc' ;
									$result = $db->query($sql);
									while($row = $result->fetch_assoc())
									{
										$sql2 = 'select * from bod_hw where hw_no=' .$row['hw_n'];
										$result2 = $db->query($sql2);
										while($row2 = $result2->fetch_assoc()){

								?>


									<div class="col-md-4 col-sm-4" >
										<form name="inner_tab" action="inner_tab.php" method="get">
												<input type="hidden" name="sale_num" value="<?php echo $row2['hw_no']?>">
													<?php		//판매완료 시 sale 숫자가 1이되고 판매 완료 버튼이 사라짐
														 if($row2['sale'] == 0){
													?>
							<div class="panel panel-primary" onclick="location.href='inner_tab.php?sale_num=<?php echo $row2['hw_no']?>'" style="cursor: pointer;">													 <?
						} if($row2['sale'] == 1){
													 ?>
							<div class="panel panel-danger" onclick="location.href='inner_tab.php?sale_num=<?php echo $row2['hw_no']?>'" style="cursor: pointer;">															<?
														}
															?>

													<div class="panel-heading">
														<?php
														echo $row2['hw_no']. ". &nbsp ";
														 echo $row2['hw_title'];
														 ?>
														</div>

														<div class="panel-body">
															<?php echo $row2['hw_date'];
																//판매완료 시 sale 숫자가 1이되고 판매 완료 버튼이 사라짐
																 if($row2['sale'] == 0){
															?>
															<p>	<img src=<?php echo $row2['hw_image']?> height="300" width="400">  </p>
															<?
														}else if($row2['sale'] == 1){
															 ?>
														<p>	<img src="img/soldout.png" height="300" width="400">  </p>
																<?
																}
																	?>


														</div>
														<div class="panel-footer">


															가격: &nbsp		<?php echo $row2['hw_price']?>
														</div>
										</div>
										</form>
									</div>

								<?php
									}
								}
								?>
							</div>

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
