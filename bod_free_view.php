<?php
	require_once("dbconfig.php");

	$bNo = $_GET['bno'];
	if(!empty($bNo) && empty($_COOKIE['board_free_' . $bNo])) {
			$sql = 'update board_free set b_hit = b_hit + 1 where b_no = ' . $bNo;		//조회수를 1 올리는 커리
			$result = $db->query($sql);
			if(empty($result)) {
				?>
				<script>
					alert('오류가 발생했습니다.');
					history.back();
				</script>
				<?php
			} else { //쿠키가 없을 때 하루동안 조회수가 오르지 않는 쿠키를 만들어.
				setcookie('board_free_' . $bNo, TRUE, time() + (60 * 60 * 24), '/');
			}
		}
$sql = 'select b_title, b_content, b_date, b_hit, b_id from board_free where b_no = ' . $bNo;
$result = $db->query($sql);
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>NOVA NETWORK</title>
		<!-- 게시판 css -->
		<link rel="stylesheet" href="./css/normalize.css" />

		<link rel="stylesheet" href="./css/board.css" />
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
echo "access ID : ";

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
                     <h2>자유게시판 </h2>

										 <article class="boardArticle">
											 <div id="boardView">
												 <div class="panel panel-primary">
													 <div class="panel-heading">
														 <!-- 제목 -->
														 <div id="boardView">
															 <span id="board_num">
															 <h3 id="boardTitle"><? echo $bNo?>. &nbsp;<?php echo $row['b_title']?></h3>
													 </div>
												 </div>
												 <div class="panel-footer">
												 <!-- 작성자 -->
												 <div id="boardInfo">

															<span id="boardID">작성자: <?php echo $row['b_id']?></span>

															<hr size="1">
															<span id="boardHit">조회: <?php echo $row['b_hit']?></span>

															</div>
														</div>

													 <div class="panel-body">
												 <!-- 내용 -->

												 				<div id="boardContent"><?php echo $row['b_content']?></div>
																<hr>
													 </div>
													 	 <div class="panel-footer">

													 <span id="boardDate">작성일: <?php echo $row['b_date']?></span>
													 </div>
												 </div>
												 <div class="btnSet">
														 <form action="delete_freebod.php" method="post"  onsubmit="button_event(); return false;">
																<?php		//bno를 포스트로 delete_freebod.php에 보내야함
																if(isset($bNo)) {
																	echo '<input type="hidden" name="bno" value="' . $bNo . '">';
																}
																?>
															<button class="btnSubmit btn"><a href="./write_free.php?bno=<?php echo $bNo?>">수정</a></button>
															<button class="btnSubmit btn">삭제</button>
															<script type="text/javascript">
																	function button_event(){
																		if (confirm("정말 삭제하시겠습니까??") == true){
																				document.form.submit();
																		} else {
																				return false;
																		}
																	}
																	</script>
															<a href="ui.php" class="btnList btn">목록</a>
														</form>



											 <hr>


											 																<!--  댓글 내용 확인 시작.-->

																											<?php
																														$sql = 'select * from comment_free where co_no=co_order and b_no=' . $bNo;
																														$result = $db->query($sql);
																													?>
																													<div id="commentView">
																														<?php
																															while($row = $result->fetch_assoc()) {
																														?>

																																</div>
																																</div>
																																</div>


													 												<div class="col-md-12 col-sm-1">
													 										 			 <div class="panel panel-danger">
													 										 					 <div class="panel-heading">
													 										 							 댓글
													 										 					 </div>
													 										 					 <div class="panel-body">
																													 <ul class="oneDepth">
																														 <li>
																															 <div>
																																 <span>작성자: <?php echo $row['co_id']?></span>
																																 <p><?php echo $row['co_content']?></p>
																																 <?php
																																	 $sql2 = 'select * from comment_free where co_no!=co_order and co_order=' . $row['co_no'];
																																	 $result2 = $db->query($sql2);
																																	 while($row2 = $result2->fetch_assoc()) {
																																 ?>
																																 <ul class="twoDepth">
																																	 <li>
																																		 <div>
																																			 <span>작성자: <?php echo $row2['co_id']?></span>
																																			 <p><?php echo $row2['co_content'] ?></p>
																																		 </div>
																																	 </li>
																																 </ul>
																																 <?php
																																	 }
																																 ?>
																															 </li>
																														 </ul>
																														 <?php } ?>
																													 </div>

													 										 					 <div class="panel-footer">

													 										 							 <!-- 내용 -->
													 										 						 </form>

													 															 </div>
													 															 	 </div>

																														 <!-- 댓글 내용 확인 끝. -->


							<!-- 댓글달기 form -->
							<hr>

								<div class="col-md-12 col-sm-2">
									 <div class="panel panel-default">
											 <div class="panel-heading">
													 댓글달기
											 </div>
											 <div class="panel-body">
												 <form name="comment_form" action="comment_update.php" method="post">
													 <input type="hidden" name="bno" value="<?php echo $bNo?>">
												 				<label for="coId">아이디</label><input type="text" name="coId" id="coId">
																		<label for="coPassword">비밀번호</label><input type="password" name="coPassword" id="coPassword">
													<p> </p>
													 <hr>
													<label for="coContent">내용</label>
											<textarea cols="150" rows="3" name="coContent" id="coContent"></textarea>
											 </div>
											 <div class="panel-footer">
													  <button type="submit" class="btnSubmit btn" > 댓글 달기 </button>
													</form>

										 </div>
												 </div>


							<!--  댓글 달기 form 끝. -->

											<hr>
											<p></p>


												 </div>
											 </div>
										 </div>
										 </article>



</body>
</html>
