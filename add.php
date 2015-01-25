<?
	error_reporting(E_ALL^E_NOTICE);
	$userid = $_GET['userid'];
	$password = $_GET['password'];
	$phone = $_GET['phone'];
	$count = $_GET['count'];
	if(!isset($userid) || !isset($password) || !isset($phone) || !isset($count)){		
        	 $result = array(
                       'error' => 201,
                       'data' => 'data null'
                 );
                 echo json_encode($result);
                 return;
	}
	$cj_data = file_get_contents('http://cj.ldustu.com/api/score?userid='.$userid.'&password='.$password.'&from=message&appid=10002&secret=message@ldsn');
	$arr_data = json_decode($cj_data,true);
	$error = $arr_data['error'];
	if ($error != 0) {
		echo $cj_data;
		return;
	}
	//$cj_data = str_replace('\\', '\\\\', $cj_data);
//	$dbh = mysql_connect($_SERVER['DB_HOST'],$_SERVER['DB_USER'],$_SERVER['DB_PASSWD']);
$dbh = mysql_connect('localhost','cj','wangluobu@tw');
	if(!$dbh){die("error");}
	mysql_select_db('cj', $dbh);


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
                $value = urlencode("#money#=".$count * 3 / 10);
                $url='http://yunpian.com/v1/sms/tpl_send.json';
                $post="apikey=0d679b8688ff199c06196328e578eeae&mobile=$phone&tpl_id=672601&tpl_value=$value";
                $ch = curl_init($url);
                curl_setopt($ch,CURLOPT_HEADER,0);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1) ;
                curl_setopt($ch, CURLOPT_POST,1) ;
                curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
                $message_result = curl_exec($ch);
                curl_close($ch);
                $json_message_result = json_decode($message_result,true);
                $error = $json_message_result['code'];
                if ($error != 0){
                        $result = array(
                                'error' => $error,
                                'data' => $json_message_result['msg'],
                                'detail' => $json_message_result['detail']
                        );
                        echo json_encode($result);
                        return;
                }
	$sql = sprintf(
                "select * from youhui where xh = '%s'",
                mysql_real_escape_string($xh)
        );

        $has = mysql_query($sql,$dbh);
        $has_count = mysql_num_rows($has);

        if($has_count != 0){
		$count += 2;
        }
	$sql = sprintf(
		"insert into %s (user_id, pass, phone, cj_data, count) values ('%s', '%s', '%s', '%s', %d)",
		mysql_real_escape_string('user'),
		mysql_real_escape_string($userid),
		mysql_real_escape_string($password),
		mysql_real_escape_string($phone),
		mysql_real_escape_string($cj_data),
		mysql_real_escape_string($count)
	);
	if(mysql_query($sql,$dbh)) {
		$result = array(
			'error' => 0,
			'data' => 'success'
		);
		
		echo json_encode($result);
	}else{
		$result = array(
                        'error' => 203,
                        'data' => 'sql error'
                );
                echo json_encode($result);
	}
