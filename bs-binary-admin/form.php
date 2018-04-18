<?
session_start();
if(!isset($_SESSION['user_id'])) {
	echo "<meta http-equiv='refresh' content='0;url=login.html'>";
	exit;
}
$user_id = $_SESSION['user_id'];
?>
﻿<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<script type="text/javascript" src="chat/chat.js"></script>

		<link rel="stylesheet" type="text/css" href="chat/chat.css" />
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
											 <a href="tab-panel.php"><i class="fa fa-qrcode fa-3x"></i> hardware 장터</a>
									 </li>

									 <li  >
											 <a class="active-menu" href="form.php"><i class="fa fa-edit fa-3x"></i> 업계 현황 </a>
									 </li>



										 </li>
								 <li  >
											 <a  href="blank.php"><i class="fa fa-square-o fa-3x"></i> 찜 목록</a>
									 </li>
									 <li>
										 <a href="table.php"><i class="fa fa-table fa-3x"></i>구매이력</a>
								 </li>
                </ul>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>업계 현황</h2><br>
                        <h6>객관적으로 자신이 어느 위치에 있는지 파악해보세요. <br>
													현업에서 자신의 회사에 대해 느낀 점을 공유하는 공간입니다. </h6>
													<hr>

<!-- 채팅박스 시작. -->
<div panel-info>
	채팅방
</div>
<dl id="list"></dl>

<form onsubmit="chatManager.write(this); return false;">
<input name="name" id="name" type="text" />
<input name="msg" id="msg" type="text" />
<input name="btn" id="btn" type="submit" value="입력" />
</form>


												<div class="row">
														<div class="col-md-6 col-sm-12 col-xs-12">

														<div class="chat-panel panel panel-default chat-boder chat-panel-head" >
																<div class="panel-heading">
																		<i class="fa fa-comments fa-fw"></i>
																		Chat Box
																		<div class="btn-group pull-right">
																				<button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
																						<i class="fa fa-chevron-down"></i>
																				</button>
																				<ul class="dropdown-menu slidedown">
																						<li>
																								<a href="#">
																										<i class="fa fa-refresh fa-fw"></i>Refresh
																								</a>
																						</li>
																						<li>
																								<a href="#">
																										<i class="fa fa-check-circle fa-fw"></i>Available
																								</a>
																						</li>
																						<li>
																								<a href="#">
																										<i class="fa fa-times fa-fw"></i>Busy
																								</a>
																						</li>
																						<li>
																								<a href="#">
																										<i class="fa fa-clock-o fa-fw"></i>Away
																								</a>
																						</li>
																						<li class="divider"></li>
																						<li>
																								<a href="#">
																										<i class="fa fa-sign-out fa-fw"></i>Sign Out
																								</a>
																						</li>
																				</ul>
																		</div>
																</div>

																<div class="panel-body">
																		<ul class="chat-box">
																				<li class="left clearfix">
																						<span class="chat-img pull-left">
																								<img src="assets/img/1.png" alt="User" class="img-circle" />
																						</span>
																						<div class="chat-body">
																										<strong >Jack Sparrow</strong>
																										<small class="pull-right text-muted">
																												<i class="fa fa-clock-o fa-fw"></i>12 mins ago
																										</small>
																								<p>
																										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
																								</p>
																						</div>
																				</li>
																				<li class="right clearfix">
																						<span class="chat-img pull-right">

																								<img src="assets/img/2.png" alt="User" class="img-circle" />
																						</span>
																						<div class="chat-body clearfix">

																										<small class=" text-muted">
																												<i class="fa fa-clock-o fa-fw"></i>13 mins ago</small>
																										<strong class="pull-right">Jhonson Deed</strong>

																								<p>
																										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
																								</p>
																						</div>
																				</li>
																				<li class="left clearfix">
																						<span class="chat-img pull-left">
																								 <img src="assets/img/3.png" alt="User" class="img-circle" />
																						</span>
																						<div class="chat-body clearfix">

																										<strong >Jack Sparrow</strong>
																										<small class="pull-right text-muted">
																												<i class="fa fa-clock-o fa-fw"></i>14 mins ago</small>

																								<p>
																										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
																								</p>
																						</div>
																				</li>
																				<li class="right clearfix">
																						<span class="chat-img pull-right">
																								 <img src="assets/img/4.png" alt="User" class="img-circle" />
																						</span>
																						<div class="chat-body clearfix">

																										<small class=" text-muted">
																												<i class="fa fa-clock-o fa-fw"></i>15 mins ago</small>
																										<strong class="pull-right">Jhonson Deed</strong>

																								<p>
																										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
																								</p>
																						</div>
																				</li>
																						<li class="left clearfix">
																						<span class="chat-img pull-left">
																								<img src="assets/img/1.png" alt="User" class="img-circle" />
																						</span>
																						<div class="chat-body">
																										<strong >Jack Sparrow</strong>
																										<small class="pull-right text-muted">
																												<i class="fa fa-clock-o fa-fw"></i>12 mins ago
																										</small>
																								<p>
																										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
																								</p>
																						</div>
																				</li>
																				<li class="right clearfix">
																						<span class="chat-img pull-right">
																							 <img src="assets/img/2.png" alt="User" class="img-circle" />
																						</span>
																						<div class="chat-body clearfix">

																										<small class=" text-muted">
																												<i class="fa fa-clock-o fa-fw"></i>13 mins ago</small>
																										<strong class="pull-right">Jhonson Deed</strong>

																								<p>
																										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
																								</p>
																						</div>
																				</li>
																		</ul>
																</div>

																<div class="panel-footer">
																		<div class="input-group">
																				<input id="btn-input" type="text" class="form-control input-sm" placeholder="Type your message to send..." />
																				<span class="input-group-btn">
																						<button class="btn btn-warning btn-sm" id="btn-chat">
																								Send
																						</button>
																				</span>
																		</div>
																</div>

														</div>

												</div>
<!-- 채팅박스 끝. -->


                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />

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
