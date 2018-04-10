<?php

	require_once("dbconfig.php");
	session_start();
	if(!isset($_SESSION['user_id'])) {
		echo "<meta http-equiv='refresh' content='0;url=login.html'>";
		exit;
	}
	$user_id = $_SESSION['user_id'];

	if(isset($_GET['page'])) {
		$page = $_GET['page'];
	} else {
		$page = 1;
	}
	$page_refer=ui;
	require_once("paging.php");
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
                    <span class="fa fa-bar"></span>
                    <span class="fa fa-bar"></span>
                    <span class="fa fa-bar"></span>
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
							<a class="active-menu" href="ui.php"><i class="fa fa-desktop fa-3x"></i> 자유게시판</a>
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
                     <h2>자유 게시판</h2>
<hr>
                        <h6>  [게시판 이용규칙]<br></br> 미풍양속을 해치지 않는 범위 내에서 자유롭게 작성해주세요. <br></br>
단, 질문글은 개발정보게시판을 이용해주세요. </h6>

                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
								 <article class="boardArticle">
<table>
	<thead>
				<tr>
					<th scope="col" class="no">번호</th>
					<th scope="col" class="title">제목</th>
					<th scope="col" class="author">작성자</th>
					<th scope="col" class="date">작성일</th>
					<th scope="col" class="hit">조회</th>
				</tr>
			</thead>
			<tbody>
					<?php
					date_default_timezone_set('Asia/Seoul');
						//게시판 게시글 b_no순서대로 불러서 row에 담음
					if(isset($emptyData)) {

							echo $emptyData;

						} else {
						while($row = $result->fetch_assoc()) 				//테이블에 db 내용 적용
						{
							$datetime = explode(' ', $row['b_date']);
							$date = $datetime[0];
							$time = $datetime[1];
							if($date == Date('Y-m-d'))
								$row['b_date'] = $time;
							else
								$row['b_date'] = $date;
					?>
					<!-- <form method="get" action="bod_free_view.php"> -->
					<tr>
					<td class="no"><?php echo $row['b_no']?></td>

					<td class="title"><a href="bod_free_view.php?bno=<?php echo $row['b_no']?>"><?php echo $row['b_title']?></a></td>
					<td class="author"><?php echo $row['b_id']?></td>
					<td class="date"><?php echo $row['b_date']?></td>
					<td class="hit"><?php echo $row['b_hit']?></td>
					</tr>
				</form>
					<?php
						}
					}
					?>
			</tbody>
			</table>

			<br></br>
				<button type="submit" value="글 작성" onclick="location.href='write_free.php'">글 작성</button>
			<div id="boardList">
					<div class="paging">
								<?php echo $paging ?>
							</div>
							<hr>
							<div class="searchBox">
				<form action="ui.php" method="get">
						<select name="searchColumn">
							<option <?php echo $searchColumn=='b_title'?'selected="selected"':null?> value="b_title">제목</option>
							<option <?php echo $searchColumn=='b_content'?'selected="selected"':null?> value="b_content">내용</option>
							<option <?php echo $searchColumn=='b_id'?'selected="selected"':null?> value="b_id">작성자</option>
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
