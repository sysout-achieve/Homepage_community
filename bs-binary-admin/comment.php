<?php
date_default_timezone_set('Asia/Seoul');


?>
<div id="commentView">
	<form action="comment_update.php" method="post">
		<input type="hidden" name="bno" value="<?php echo $bNo?>">
		<?php
		if(isset($_GET['page'])) {
			$page = $_GET['page'];
		} else {
			$page = 1;
		}
		$page_refer=reply;
		require_once("paging.php");
		$result = $db->query($sql);
			while($row = $result->fetch_assoc()) {
		?>
		<ul class="oneDepth">

				<div class="col-md-12 col-sm-1">
					<div class="panel panel-danger">
 						<div class="panel-heading">
								 댓글
							</div>
							<div class="panel-body">

				<div id="co_<?php echo $row['co_no']?>" class="commentSet">
					<div class="commentInfo">
						<div class="commentBtn">
							<a href="#" class="comt write">댓글</a>
							<?
							if($row['co_id'] == $_SESSION['user_id']){
							?>
							<a href="#" class="comt modify">수정</a>
							<a href="#" class="comt delete">삭제</a>
							<?
							 }
							?>
						</div>
					<p>	<div class="commentId">작성자: <span class="coId"><?php echo $row['co_id']?></span></div></p>

					</div>
					<div class="commentContent"><?php echo $row['co_content']?></div>
				</div>
						</div>
							 <div class="panel-footer">
								 	<div align="right">	 <?php echo $row['co_date'];?></div>
									 </div>
			</div>
			</div>
				<?php
					$sql2 = 'select * from comment_free where co_no!=co_order and co_order=' . $row['co_no'];
					$result2 = $db->query($sql2);

					while($row2 = $result2->fetch_assoc()) {
				?>
				<ul class="twoDepth">
					<div class="col-md-11 col-sm-1">
						<div class="panel panel-info">
	 						<div class="panel-heading">
					                대댓글
												</div>
												<div class="panel-body">
						<div  style="padding: 5px 5px 5px 5px" id="co_<?php echo $row2['co_no']?>" class="commentSet">
							<div style="padding: 5px 5px 5px 5px" class="commentInfo">
								<div class="commentBtn">
									<?
									if($row2['co_id'] == $_SESSION['user_id']){
									?>
									<a href="#" class="comt modify" >수정</a>
									<a href="#" class="comt delete">삭제</a>
									<?
									 }
									?>
								</div>
								<div  style="padding: 5px 5px 5px 5px"  class="commentId">작성자:  <span class="coId"><?php echo $row2['co_id']?></span></div>

							<div class="commentContent"><?php echo $row2['co_content'] ?></div>
							</div>
						</div>
					</div>
					<div class="panel-footer">
						 <div align="right">	 <?php echo $row2['co_date'];?></div>
							</div>
					</li>
				</ul>
				<?php
					}
				?>

		</ul>
		<?php } ?>
	</form>
</div>
<div style="width:1000px" id="boardList">
		<div class="paging" >
			<?php echo $paging ?>
		</div>
	</div>
</div>



<p>

</p>

					<!-- 댓글 달기 시작. -->
<div class="col-md-12">
	 <div class="panel panel-default">
			 <div class="panel-heading">
					 댓글달기
			 </div>
			 <div class="panel-body">
				 <form name="comment_form" id="comment_form" action="comment_update.php" method="post">
					 <input type="hidden" name="bno" value="<?php echo $bNo?>"></input>
					 <input type="hidden" name="coId" value="<? echo $_SESSION['user_id'] ?>"></input>
								<label for="coId">작성자 </label> &nbsp <? echo $_SESSION['user_id']; ?>
								<hr>
					<label for="coContent">내용</label>
					<br>
			<textarea cols="140" rows="3" name="coContent" id="coContent"></textarea>
			 </div>
			 <div class="panel-footer">
						<button class="btnSubmit btn" > 댓글 달기 </button>

					</form>

		 </div>
				 </div>
</div>
<!-- 댓글 달기 끝. -->
<script>
	$(document).ready(function () {
		var commentSet = '';
		var action = '';
		$('#commentView').delegate('.comt', 'click', function () {
			//현재 작성 내용을 변수에 넣고, active 클래스 추가.
			commentSet = $(this).parents('.commentSet').html();
			$(this).parents('.commentSet').addClass('active');

			//취소 버튼
			var commentBtn = '<a href="#" class="addComt cancel">취소</a>';

			//버튼 삭제 & 추가
			$('.comt').hide();
			$(this).parents('.commentBtn').append(commentBtn);


			//commentInfo의 ID를 가져온다.
			var co_no = $(this).parents('.commentSet').attr('id');

			//전체 길이에서 3("co_")를 뺀 나머지가 co_no
			co_no = co_no.substr(3, co_no.length);

			var addOption = '<input type="hidden" name="co_no" value="' + co_no + '">';

			//변수 초기화
			var comment = '';
			var coId = '';
			var coContent = '';

			if($(this).hasClass('write')) {
				//댓글 쓰기
				action = 'w';
				//ID 영역 출력
				coId = '<input type="text" name="coId" id="coId">';

			} else if($(this).hasClass('modify')) {
				//댓글 수정
				action = 'u';
				$(this).parents('.commentBtn');

				var modifyParent = $(this).parents('.commentSet');
				var coId = modifyParent.find('.coId').text();
				var coContent = modifyParent.find('.commentContent').text();

			} else if($(this).hasClass('delete')) {
				//댓글 삭제
				action = 'd';

			}

				comment += '<div class="writeComment">';
				comment += '	<input type="hidden" name="w" value="' + action + '">';
				comment += addOption;
				comment += '	<table>';
				comment += '		<tbody>';
				if(action !== 'd') {
					comment += '			<tr>';
					comment += '				<th scope="row"><label for="coId">아이디</label></th>';
					comment += '				<td>' +" <? echo $_SESSION['user_id'] ?>" + '</td>';
					comment += '			</tr>';
				}

				if(action !== 'd') {
					comment += '			<tr>';
					comment += '				<th scope="row"><label for="coContent">내용</label></th>';
					comment += '				<td><textarea class="col-sm-10"  name="coContent" id="coContent">' + coContent + '</textarea></td>';
					comment += '			</tr>';
				}
				comment += '		</tbody>';
				comment += '	</table>';
				comment += '	<div class="btnSet">';
				comment += '		<input type="submit" style="background-color:#E6E6E6" class="btnList btn" value="확인">';
				comment += '	</div>';
				comment += '</div>';

				$(this).parents('.commentSet').after(comment);
			return false;
		});

		$('#commentView').delegate(".cancel", "click", function () {
			if(action == 'w') {
				$('.writeComment').remove();
			} else if(action == 'u') {
				$('.writeComment').remove();
			} else{
				$('.writeComment').remove();
			}
				$('.commentSet.active').removeClass('active');
				$('.addComt').remove();
				$('.comt').show();
			return false;
		});
	});
</script>
