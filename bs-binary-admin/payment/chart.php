<?php
session_start();
require_once("../dbconfig.php");
date_default_timezone_set('Asia/Seoul');
if(!isset($_SESSION['user_id'])) {
	echo "<meta http-equiv='refresh' content='0;url=../login.html'>";
	exit;
}
 $user_id = $_SESSION['user_id'];

$hno = $_GET['hw_no'];
$sql = 'select hw_no, hw_title, hw_image, hw_iteminfo, hw_id, hw_email, hw_method, hw_phone, hw_name, hw_like, hw_date, hw_price, sale, category from bod_hw where hw_no = ' .$hno;
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
    <link href="../assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="../assets/css/font-awesome.css" rel="stylesheet" />
		<script src="../js/jquery-2.1.3.min.js"></script>
		<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js" ></script>
		<script type="text/javascript" src="https://service.iamport.kr/js/iamport.payment-1.1.5.js"></script>
        <!-- CUSTOM STYLES-->
    <link href="../assets/css/custom.css" rel="stylesheet" />
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
&nbsp; <a href="../logout.php" class="btn btn-danger square-btn-adjust">Logout</a> </div>
<script>
	IMP.init('imp31514230');
	IMP.request_pay({
	    pg : 'inicis', // version 1.1.0부터 지원.
	    pay_method : 'card',
	    merchant_uid : 'merchant_' + new Date().getTime(),
	    name : '<?echo $row['hw_title']?>',
	    amount : '<?echo $row['hw_price']?>',
			buyer_email : 'iamport@siot.do',
	 		buyer_name : '<?echo $user_id?>',
	    m_redirect_url : 'http://192.168.111.145/project/new/inner_tab.php?sale_num=<? echo $hno ?>'
	}, function(rsp) {
	    if ( rsp.success ) {
	        var msg = '결제가 완료되었습니다.';
	        msg += '고유ID : ' + rsp.imp_uid;
	        msg += '\n상점 거래ID : ' + rsp.merchant_uid;
	        msg += '\n결제 금액 : ' + rsp.paid_amount;
	        msg += '\n카드 승인번호 : ' + rsp.apply_num;
	    } else {
	        var msg = '결제에 실패하였습니다.';
	        msg += '에러내용 : ' + rsp.error_msg;
	    }
	    alert(msg);
	});
</script>
        </nav>
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
				<li class="text-center">
                    <img src="../assets/img/find_user.png" class="user-image img-responsive"/>
					</li>


					<li>
							<a href="../index.html"><i class="fa fa-dashboard fa-3x"></i> 내 정보</a>
					</li>
					 <li>
							<a href="../ui.php"><i class="fa fa-desktop fa-3x"></i> 자유게시판</a>
					</li>
					<li>
							<a href="../tab-panel.php"><i class="fa fa-qrcode fa-3x"></i> hardware 장터</a>
					</li>

					<li  >
							<a  href="../chat/form.php"><i class="fa fa-edit fa-3x"></i> 업계 현황 </a>
					</li>

						</li>
				<li  >
							<a  href="../blank.php"><i class="fa fa-square-o fa-3x"></i> 찜 목록</a>
					</li>
					<li>
						<a href="../table.php"><i class="fa fa-table fa-3x"></i>구매이력</a>
				</li>
					<li>
								<a class="active-menu" href="chart.php"><i class="fa fa-bar-chart-o fa-3x"></i> 결제</a>
					</li>
                </ul>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>결제</h2>
                        <h5>안전 거래창입니다.<br /> 자신이 구매하려는 물품을 꼭 확인하고 구매하세요. </h5>

                    </div>

                </div>
                 <!-- /. ROW  -->
                 <hr />




								 									<div class="col-md-8 col-sm-12" >
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
								 															<p>	<img src=../<?php echo $row['hw_image']?> height="100" width="120">  </p>
								 															<?
								 														} else if ($row['sale'] == 1) {
								 															 ?>
								 														<p>	<img src="../img/soldout.png" height="50" width="80">  </p>														<?
								 																}
								 																	?>


								 														</div>
								 														<div class="panel-footer">


								 															가격: &nbsp		<?php echo $row['hw_price']?>
								 														</div>
								 										</div>
								 										</form>
								 									</div>
																	<div class="col-md-4 col-sm-12" >
																		<div class="panel panel-default">
																			<div class="panel-heading">
																				결제 상태
																			</div>
																			<div class="panel-body">
																				
																			</div>
																		</div>

																	</div>
								 							</div>
								 						</div>


<!-- 코드를 삭제했습니다 -->



               <!--여기까기 코드 삭제  ---참고자료1.2  -->
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->



</body>
</html>
