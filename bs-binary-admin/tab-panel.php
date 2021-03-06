<?php
session_start();
if (!isset($_SESSION['user_id'])) {
	echo "<meta http-equiv='refresh' content='0;url=login.html'>";
	exit;
}
$user_id = $_SESSION['user_id'];
	require_once("dbconfig.php");
	date_default_timezone_set('Asia/Seoul');

		if (isset($_GET['page'])) {
			$page = $_GET['page'];
		} else {
			$page = 1;
		}
		$page_refer=hw;
		require_once("paging.php");
	?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>NOVA NETWORK</title>
	<!-- BOOTSTRAP STYLES-->
		<link rel="stylesheet" href="./css/board.css" />
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

<hr>

<div align="center">
	<button class="panel-warning btn" onclick="location.href='hw_sale.php'">판매글 등록</button>

</div>
						     <!-- /. ROW  -->
                 <hr />
<article class="boardArticle">
								 <?php
	 							date_default_timezone_set('Asia/Seoul');
							//hw 제품 hw_no의 순서대로 db에서 값 불러와서 각 div에 값을 넣어줌.
							if (isset($emptyData)) {

									echo $emptyData;

								} else {
	 								while ($row = $result->fetch_assoc())
	 								{
	 									$datetime = explode(' ', $row['hw_date']);
	 									$date = $datetime[0];
	 									$time = $datetime[1];
	 									if ($date == Date('Y-m-d')) {
	 										$row['hw_date'] = $time;
	 									} else {
	 										$row['hw_date'] = $date;
										}
	 							?>


									<div class="col-md-4 col-sm-4" >
										<form name="inner_tab" action="inner_tab.php" method="get">
												<input type="hidden" name="sale_num" value="<?php echo $row['hw_no']?>">
													<?php		//판매완료 시 sale 숫자가 1이되고 판매 완료 버튼이 사라짐
														 if($row['sale'] == 0) {
													?>
													<div class="panel panel-primary" onclick="location.href='inner_tab.php?sale_num=<?php echo $row['hw_no']?>'" style="cursor: pointer;">													 <?
												}else if ($row['sale'] == 1) {
													 ?>
													 <div class="panel panel-danger" onclick="location.href='inner_tab.php?sale_num=<?php echo $row['hw_no']?>'" style="cursor: pointer;">															<?
														}
															?>

													<div class="panel-heading">
														<?php
														echo $row['hw_no']. ". &nbsp ";
														 echo $row['hw_title'];
														 ?>
														</div>

														<div class="panel-body">
															<?php echo $row['hw_date'];
																//판매완료 시 sale 숫자가 1이되고 판매 완료 버튼이 사라짐
																 if ($row['sale'] == 0) {
															?>
															<p>	<img src=<?php echo $row['hw_image']?> height="300" width="400">  </p>
															<?
														} else if ($row['sale'] == 1) {
															 ?>
														<p>	<img src="img/soldout.png" height="300" width="400">  </p>														<?
																}
																	?>


														</div>
														<div class="panel-footer">


															가격: &nbsp		<?php echo $row['hw_price']?>
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
							<hr></hr>
							<div id="boardList">
									<div class="paging">
												<?php echo $paging ?>
											</div>
											<hr>
											<div class="searchBox">
								<form action="tab-panel.php" method="get">
								<label>	<input type="checkbox" name="sale" value="1"> 판매완료 게시물</lebel><br>
										<select name="searchColumn">
											<option <?php echo $searchColumn=='hw_title'?'selected="selected"':null?> value="hw_title">제목</option>
											<option <?php echo $searchColumn=='hw_method'?'selected="selected"':null?> value="hw_method">거래방법</option>
											<option <?php echo $searchColumn=='hw_id'?'selected="selected"':null?> value="hw_id">작성자</option>
										</select>
									<input type="text" name="searchText" onkeyup="noSpaceForm(this);" onchange="noSpaceForm(this);" value="<?php echo isset($searchText)?$searchText:null?>">
										<script>
											function noSpaceForm(obj) { // 공백 사용 못하게 하는 methoid.
													var str_space = /\s/;  // 변수로 공백 체크
													if(str_space.exec(obj.value)) {
															alert("해당 항목에는 공백을 사용할수 없습니다.\n\n공백은 자동적으로 제거 됩니다.");
															obj.focus();
															obj.value = obj.value.replace(' ',''); // 공백제거
															return false;
													}
											 // onkeyup="noSpaceForm(this);" onchange="noSpaceForm(this);"
											}
											</script>
									<button type="submit">검색</button>
								</form>
							</div>
										</div>
									</article>
										<hr>

							<div align="center">
								<button class="panel-warning btn" onclick="location.href='hw_sale.php'">판매글 등록</button>

						</div>
						<hr>
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
