<?
	$userid = $_GET['userid'];
	$password = $_GET['password'];
	$count = $_GET['count'];
	$cj_data = file_get_contents('http://cj.ldustu.com/api/score?userid='.$userid.'&password='.$password.'&from=message&appid=10002&secret=message@ldsn');
	$arr_data = json_decode($cj_data,true);
	$error = $arr_data['error'];
	if ($error != 0) {
		echo $cj_data;
		return;
	}
	//$cj_data = str_replace('\\', '\\\\', $cj_data);
	$dbh = mysql_connect("127.0.0.1:3306","root","8641683");
	if(!$dbh){die("error");}
	mysql_select_db("cj", $dbh);
	$sql = sprintf(
		"select * from %s where user_id = %d",
		mysql_real_escape_string('user'),
		mysql_real_escape_string($userid)
	);
	$has = mysql_query($sql,$dbh);
	$has_count = mysql_num_rows($has);
	if($has_count != 0){
		$result = array(
			'error' => 202,
			'data' => 'user exists'
		);
		echo json_encode($result);
		return;
	}
	$sql = sprintf(
		"insert into %s (user_id, pass, cj_data, count) values ('%s', '%s', '%s', %d)",
		mysql_real_escape_string('user'),
		mysql_real_escape_string($userid),
		mysql_real_escape_string($password),
		mysql_real_escape_string($cj_data),
		mysql_real_escape_string($count)
	);
	if(mysql_query($sql,$dbh)) {
		$result = array(
			'error' => 0,
			'data' => 'success'
		);
		echo json_encode($result);
	}
