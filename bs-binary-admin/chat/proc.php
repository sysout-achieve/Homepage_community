<?
	date_default_timezone_set('Asia/Seoul');
if(!$_GET['date'])
{
	$_GET['date'] = date('Y-m-d H:i:s');
}

$data = array();
$date = $_GET['date'];

$db = new mysqli('localhost', 'root', '7878', 'test');
$db->query('SET NAMES utf8');

for($i=0; $i<100; $i++)
{
	$res = $db->query('SELECT * FROM chat WHERE date > "' . $_GET['date'] . '"');

	if($res->num_rows > 0)
	{
		while($v = $res->fetch_array(MYSQLI_ASSOC))
		{
			$data[] = $v;
			$date = $v['date'];
		}

		break;
	}

	usleep(500000);
}

echo json_encode(array('date' => $date, 'data' => $data));
?>
