<?php
	require_once("dbconfig.php");
	/* 페이징 시작 */
	//페이지 get 변수가 있다면 받아오고, 없다면 1페이지를 보여준다.
	/* 검색 시작 */
if($page_refer==ui){	//ui paging 시작.
	if(isset($_GET['searchColumn'])) {
		$searchColumn = $_GET['searchColumn'];
		$subString .= '&amp;searchColumn=' . $searchColumn;
	}

	if(isset($_GET['searchText'])) {
		$searchText = $_GET['searchText'];
			if($searchText == " "){
?>
				<script>
				alert('검색어를 입력하세요.');
				return false;
				</script>
<?
		}
			$subString .= '&amp;searchText=' . $searchText;
	}

	if(isset($searchColumn) && isset($searchText)) {
		$searchSql = ' where ' . $searchColumn . ' like "%' . $searchText . '%"';
	} else {
		$searchSql = '';
	}
	/* 검색 끝 */
	$sql = 'select count(*) as cnt from board_free' . $searchSql;
	$result = $db->query($sql);
	$row = $result->fetch_assoc();
	$allPost = $row['cnt']; //전체 게시글의 수
		if(empty($allPost)) {

			$emptyData = '<tr><td class="textCenter" colspan="5">글이 존재하지 않습니다.</td></tr>';

		} else {

		$onePage = 15; // 한 페이지에 보여줄 게시글의 수.
		$allPage = ceil($allPost / $onePage); //전체 페이지의 수
			if($page < 1 || ($allPage && $page > $allPage)) {
		?>
				<script>
					alert("존재하지 않는 페이지입니다.");
					history.back();
				</script>
		<?php
				exit;
			}
			$oneSection = 10; //한번에 보여줄 총 페이지 개수(1 ~ 10, 11 ~ 20 ...)
			$currentSection = ceil($page / $oneSection); //현재 섹션
			$allSection = ceil($allPage / $oneSection); //전체 섹션의 수
			$firstPage = ($currentSection * $oneSection) - ($oneSection - 1); //현재 섹션의 처음 페이지

		if ($currentSection == $allSection) {
			$lastPage = $allPage; //현재 섹션이 마지막 섹션이라면 $allPage가 마지막 페이지가 된다.
		} else {
			$lastPage = $currentSection * $oneSection; //현재 섹션의 마지막 페이지
		}
		$prevPage = (($currentSection - 1) * $oneSection); //이전 페이지, 11~20일 때 이전을 누르면 10 페이지로 이동.
		$nextPage = (($currentSection + 1) * $oneSection) - ($oneSection - 1); //다음 페이지, 11~20일 때 다음을 누르면 21 페이지로 이동.

		$paging = '<ul>'; // 페이징을 저장할 변수

		//첫 페이지가 아니라면 처음 버튼을 생성
		if($page != 1) {
			$paging .= '<li class="page page_start"><a href="./ui.php?page=1' . $subString . '"">처음</a></li>';
		}
		//첫 섹션이 아니라면 이전 버튼을 생성
		if($currentSection != 1) {
			$paging .= '<li class="page page_prev"><a href="./ui.php?page=' . $prevPage . $subString .'">이전</a></li>';
		}
			for ($i = $firstPage; $i <= $lastPage; $i++) {
				if ($i == $page) {
					$paging .= '<li class="page current">' . $i . '</li>';
				} else {
					$paging .= '<li class="page"><a href="./ui.php?page=' . $i .$subString . '">' . $i . '</a></li>';
				}
			}

		//마지막 섹션이 아니라면 다음 버튼을 생성
		if($currentSection != $allSection) {
			$paging .= '<li class="page page_next"><a href="./ui.php?page=' . $nextPage .$subString . '">다음</a></li>';
		}

		//마지막 페이지가 아니라면 끝 버튼을 생성
		if($page != $allPage) {
			$paging .= '<li class="page page_end"><a href="./ui.php?page=' . $allPage . $subString .'">끝</a></li>';
		}

	$paging .= '</ul>';

	/* 페이징 끝 */
	$currentLimit = ($onePage * $page) - $onePage; //몇 번째의 글부터 가져오는지
	$sqlLimit = ' limit ' . $currentLimit . ', ' . $onePage; //limit sql 구문

	$sql = 'select * from board_free' . $searchSql . ' order by b_no desc' . $sqlLimit;  //원하는 개수만큼 가져온다. (0번째부터 20번째까지
	$result = $db->query($sql);
	}
}//ui paging 끝.

//hw paging 시작.
else if($page_refer==hw){
	if (isset($_GET['sale'])) {
		$sale = $_GET['sale'];
		$subSalenum .= '&amp;sale=' . $sale;
	} else {
		$sale = 0;
		$subSalenum .= '&amp;sale=' . $sale;
	}

	if(isset($_GET['searchColumn'])) {
		$searchColumn = $_GET['searchColumn'];
		$subString .= '&amp;searchColumn=' . $searchColumn;
	}

	if(isset($_GET['searchText'])) {
		$searchText = $_GET['searchText'];
			$subString .= '&amp;searchText=' . $searchText;
	}

	if(isset($searchColumn) && isset($searchText)) {
		$searchSql = ' where ' . $searchColumn . ' like "%' . $searchText . '%" AND sale=' .$sale;
			if ($sale !=1 && $sale != 0) {
				$searchSql = ' where ' . $searchColumn . ' like "%' . $searchText . '%"';
				}
	} else {
		$searchSql = '';
	}
	/* 검색 끝 */
	$sql = 'select count(*) as cnt from bod_hw' . $searchSql;
	$result = $db->query($sql);
	$row = $result->fetch_assoc();
	$allPost = $row['cnt']; //전체 게시글의 수
		if(empty($allPost)) {

			$emptyData = '<tr><td class="textCenter" colspan="5">글이 존재하지 않습니다.</td></tr>';

		} else {

		$onePage = 9; // 한 페이지에 보여줄 게시글의 수.
		$allPage = ceil($allPost / $onePage); //전체 페이지의 수
			if($page < 1 || ($allPage && $page > $allPage)) {
		?>
				<script>
					alert("존재하지 않는 페이지입니다.");
					history.back();
				</script>
		<?php
				exit;
			}
			$oneSection = 10; //한번에 보여줄 총 페이지 개수(1 ~ 10, 11 ~ 20 ...)
			$currentSection = ceil($page / $oneSection); //현재 섹션
			$allSection = ceil($allPage / $oneSection); //전체 섹션의 수
			$firstPage = ($currentSection * $oneSection) - ($oneSection - 1); //현재 섹션의 처음 페이지

		if ($currentSection == $allSection) {
			$lastPage = $allPage; //현재 섹션이 마지막 섹션이라면 $allPage가 마지막 페이지가 된다.
		} else {
			$lastPage = $currentSection * $oneSection; //현재 섹션의 마지막 페이지
		}
		$prevPage = (($currentSection - 1) * $oneSection); //이전 페이지, 11~20일 때 이전을 누르면 10 페이지로 이동.
		$nextPage = (($currentSection + 1) * $oneSection) - ($oneSection - 1); //다음 페이지, 11~20일 때 다음을 누르면 21 페이지로 이동.

		$paging = '<ul>'; // 페이징을 저장할 변수

		//첫 페이지가 아니라면 처음 버튼을 생성
		if($page != 1) {
			$paging .= '<li class="page page_start"><a href="./tab-panel.php?page=1' . $subString . $subSalenum.'"">처음</a></li>';
		}
		//첫 섹션이 아니라면 이전 버튼을 생성
		if($currentSection != 1) {
			$paging .= '<li class="page page_prev"><a href="./tab-panel.php?page=' . $prevPage . $subString .$subSalenum.'">이전</a></li>';
		}
			for ($i = $firstPage; $i <= $lastPage; $i++) {
				if ($i == $page) {
					$paging .= '<li class="page current">' . $i . '</li>';
				} else {
					$paging .= '<li class="page"><a href="./tab-panel.php?page=' . $i .$subString .$subSalenum. '">' . $i . '</a></li>';
				}
			}

		//마지막 섹션이 아니라면 다음 버튼을 생성
		if($currentSection != $allSection) {
			$paging .= '<li class="page page_next"><a href="./tab-panel.php?page=' . $nextPage .$subString . $subSalenum.'">다음</a></li>';
		}

		//마지막 페이지가 아니라면 끝 버튼을 생성
		if($page != $allPage) {
			$paging .= '<li class="page page_end"><a href="./tab-panel.php?page=' . $allPage . $subString .$subSalenum.'">끝</a></li>';
		}

	$paging .= '</ul>';

	/* 페이징 끝 */
	$currentLimit = ($onePage * $page) - $onePage; //몇 번째의 글부터 가져오는지
	$sqlLimit = ' limit ' . $currentLimit . ', ' . $onePage; //limit sql 구문

	$sql = 'select * from bod_hw' . $searchSql . ' order by hw_no desc' . $sqlLimit;  //원하는 개수만큼 가져온다. (0번째부터 20번째까지
	$result = $db->query($sql);
	}
}






















else if($page_refer==reply){	//댓글 paging 시작.
	$bod_num = $_GET['bno'];
	$sql = 'select count(*) as cnt from comment_free where co_no=co_order and b_no='. $bNo;
	$result = $db->query($sql);
	$row = $result->fetch_assoc();

	$allPost = $row['cnt']; //전체 댓글의 수
		$onePage = 10; // 한 페이지에 보여줄 게시글의 수.
		$allPage = ceil($allPost / $onePage); //전체 페이지의 수
		if($page < 1 || ($allPage && $page > $allPage)) {

	?>
			<script>
				alert("존재하지 않는 페이지입니다.");
				history.back();
			</script>
	<?php
			exit;
		}
		$oneSection = 10; //한번에 보여줄 총 페이지 개수(1 ~ 10, 11 ~ 20 ...)
		$currentSection = ceil($page / $oneSection); //현재 섹션
		$allSection = ceil($allPage / $oneSection); //전체 섹션의 수
		$firstPage = ($currentSection * $oneSection) - ($oneSection - 1); //현재 섹션의 처음 페이지

		if($currentSection == $allSection) {
			$lastPage = $allPage; //현재 섹션이 마지막 섹션이라면 $allPage가 마지막 페이지가 된다.
		} else {
			$lastPage = $currentSection * $oneSection; //현재 섹션의 마지막 페이지
		}
		$prevPage = (($currentSection - 1) * $oneSection); //이전 페이지, 11~20일 때 이전을 누르면 10 페이지로 이동.
		$nextPage = (($currentSection + 1) * $oneSection) - ($oneSection - 1); //다음 페이지, 11~20일 때 다음을 누르면 21 페이지로 이동.
		$paging = '<ul>'; // 페이징을 저장할 변수
		//첫 페이지가 아니라면 처음 버튼을 생성
		if($page != 1) {
			$paging .= '<li class="page page_start"><a href="./bod_free_view.php?bno='.$bod_num.'page=1">처음</a></li>';
		}
		//첫 섹션이 아니라면 이전 버튼을 생성
		if($currentSection != 1) {
			$paging .= '<li class="page page_prev"><a href="./bod_free_view.php?bno='.$bod_num.'page=' . $prevPage . '">이전</a></li>';
		}
		for($i = $firstPage; $i <= $lastPage; $i++) {
			if($i == $page) {
				$paging .= '<li class="page current">' . $i . '</li>';
			} else {
				$paging .= '<li class="page"><a href="./bod_free_view.php?bno='.$bod_num.'&page=' . $i . '#open=1">' . $i . '</a></li>';
			}
		}
		//마지막 섹션이 아니라면 다음 버튼을 생성
		if($currentSection != $allSection) {
			$paging .= '<li class="page page_next"><a href="./bod_free_view.php?bno='.$bod_num.'&page=' . $nextPage . '">다음</a></li>';
		}
		//마지막 페이지가 아니라면 끝 버튼을 생성
		if($page != $allPage) {
			$paging .= '<li class="page page_end"><a href="./bod_free_view.php?bno='.$bod_num.'page=' . $allPage . '">끝</a></li>';
		}
		$paging .= '</ul>';
		/* 페이징 끝 */
		$currentLimit = ($onePage * $page) - $onePage; //몇 번째의 글부터 가져오는지
		$sqlLimit = ' limit ' . $currentLimit . ', ' . $onePage; //limit sql 구문
		$sql = 'select * from comment_free order by b_no desc' . $sqlLimit; //원하는 개수만큼 가져온다. (0번째부터 20번째까지
	}//comment paging 끝.
?>
