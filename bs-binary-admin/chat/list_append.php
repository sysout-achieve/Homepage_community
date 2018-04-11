<?
$db = new mysqli('localhost', 'root', '7878', 'test');
$db->set_charset('utf8');

$start = $_POST['start'];
$list = $_POST['list'];

$query = "select * from chat";
$result = $db->query($query);
$cnt = $result->num_rows;
$cnt_last = $cnt-15-$start;
$query = "select * from chat order by no asc limit {$cnt_last}, {$list}" ;
$result = $db->query($query);
while($row = $result->fetch_assoc()){
echo '<dt>'. $row['name'].'</dt>';
echo '<dd>'. $row['msg'].'</dd>';
echo '<date>'. $row['date'].'</date>';
}
?>


<!-- SELECT * FROM ( SELECT @NO := @NO + 1 AS ROWNUM, A.* FROM ( SELECT * FROM chat ) A, ( SELECT @NO := 0 ) B ) C WHERE C.ROWNUM BETWEEN 11 AND 15; --WHERE C.ROWNUM >= 11 AND C.ROWNUM <= 15; -->
