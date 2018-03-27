<?php
	require_once("dbconfig.php");
	session_start();
	if(!isset($_SESSION['user_id'])) {
		echo "<meta http-equiv='refresh' content='0;url=login.html'>";
		exit;
	}
	$user_id = $_SESSION['user_id'];
	//$_GET['bno']이 있을 때만 $bno 선언
	if(isset($_GET['bno'])) {
		$bNo = $_GET['bno'];
	}

	if(isset($bNo)) {
		$sql = 'select b_title, b_content, b_id from board_free where b_no = ' . $bNo;
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
     <!-- MORRIS CHART STYLES-->

        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
     <!-- TABLE STYLES-->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
		<style type='text/css'>
	table {
	  width: 95%;

	  border: 1px solid #C5B798;
	  margin-top: 15px;
	  margin-bottom: 25px;
	}
	td {
	  border-bottom: 1px solid #CDC1A7;
	  padding: 5px;
	}
	th {
	  font-family: "Trebuchet MS", Arial, Verdana;
	  font-size: 14px;
	  padding: 5px;
	  border-bottom-width: 1px;
	  border-bottom-style: solid;
	  border-bottom-color: #CDC1A7;
	  background-color: #CDC1A7;
	  color: #993300;
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
float: right;
font-size: 16px;">
<?php
echo "access : ";

echo $_SESSION['user_id'];

?>
  &nbsp; <a href="login.html" class="btn btn-danger square-btn-adjust">Logout</a> </div>
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
											 <a class="active-menu" href="ui.php"><i class="fa fa-desktop fa-3x"></i> 자유게시판</a>
									 </li>
									 <li>
											 <a href="tab-panel.php"><i class="fa fa-qrcode fa-3x"></i> hardware 장터</a>
									 </li>
									 <li>
												 <a href="chart.html"><i class="fa fa-bar-chart-o fa-3x"></i> 알고리즘 퀴즈</a>
									 </li>
										 <li>
											 <a href="table.html"><i class="fa fa-table fa-3x"></i>개발정보</a>
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
                     <h2>자유게시판 </h2>
                        <h5>글 작성</h5>

                    </div>
                </div>
                 <!-- /. ROW  -->
								 <div class="row">
										 <div class="col-md-12">
												 <!-- Advanced Tables -->
												 <div class="panel panel-default">
														 <div class="panel-heading">
																	자유게시판 글 쓰기
														 </div>
														 <article class="boardArticle">



		<div id="boardWrite">

			<form action="write_upd_bod_free.php" method="post">
								<?php		//bno를 포스트로 write update에 보내야함
								if(isset($bNo)) {
									echo '<input type="hidden" name="bno" value="' . $bNo . '">';
								}
								?>
				<table id="boardWrite">

					<tbody>

						<tr>

							<th scope="row"><label for="bID"> 작성자</label></th>

							<td class="id"><?php

							echo 	$user_id ?></td>

						</tr>

						<tr>

							<th scope="row"><label for="bTitle"> 제목</label></th>

							<td class="title"><input type="text" size="100" name="bTitle" id="bTitle" value="<?php echo isset($row['b_title'])?$row['b_title']:null?>"></td>

						</tr>

						<tr>

							<th scope="row"><label for="bContent">내용</label></th>

							<td><textarea cols="100" rows="20" name="bContent" id="bContent"><?php echo isset($row['b_content'])?$row['b_content']:null?></textarea></td>

						</tr>

					</tbody>

				</table>

				<div class="btnSet">

					<button type="submit" class="btnSubmit btn"><?php echo isset($bNo)?'수정':'작성'?></button>

					<a href="ui.php" class="btnList btn">목록</a>

				</div>

			</form>

		</div>

	</article>

															</tr>
												</table>
											</div>
									</div>
								</div>
							</div>





</body>
</html>
