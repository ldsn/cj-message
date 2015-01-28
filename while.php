<?php
//$dbh = mysql_connect($_SERVER['DB_HOST'],$_SERVER['DB_USER'],$_SERVER['DB_PASSWD']);
include('data.php');
if(!$dbh){die("error");} 
mysql_select_db('cj', $dbh); 
$q = "select * from user"; 
ignore_user_abort();
set_time_limit(0); 
$interval=2; 
//一直循环数据库里的内容 把 n 条记录取出 然后每个人的每门成绩进行对比
$item_count = 0;
$local = "/data/www/ldsn/cj-message/";
do{
$rs = mysql_query($q, $dbh); 
//下面这个循环是针对一个人的
$item_count ++;
$err_fp = fopen($local.'check.txt','a');
fwrite($err_fp,"{count:\"".$item_count."\",time:\"".date('Y-m-d H:i:s', time())."\"}\n");
fclose($err_fp);
while( $row = mysql_fetch_array($rs) ){
	if($row['count'] == 0){
		$err_fp = fopen($local.'err_log.txt','a');
                fwrite($err_fp,"{error:'111',data:'message over',time:'".date("Y-m-d H:i:s", time())."',user:'". $row['user_id'] ."'}\n");
                fclose($err_fp);
		mysql_query("INSERT  INTO  over  (user_id, pass, cj_data) SELECT user_id, pass, cj_data FROM user WHERE id ='". $row['id']."'",$dbh);
		mysql_query("DELETE FROM user WHERE id = '".$row['id']."'");
		continue;
	}
	$json_mysql = $row['cj_data'];
	$old_arr = json_decode($json_mysql,true);
	$arr_mysql  = $old_arr["score"];

	$userid=$row['user_id'];
	$password=$row['pass'];
	//从服务器取出成绩来
	$json_server = file_get_contents('http://cj.ldustu.com/api/score?userid='.$userid.'&password='.$password.'&from=message&appid=10002&secret=message@ldsn');
	$cur_arr = json_decode($json_server,true);
	$error = $cur_arr['error'];
	//如果接到错误 打到log 里，并进行下一个循环
	if ($error != 0) {
		$err_fp = fopen('err_log.txt','a');
		fwrite($err_fp,$json_server."+{time:'".date("Y-m-d H:i:s", time())."',user:'". $row['user_id'] ."'}\n");
		fclose($err_fp);
		continue;
	}
	$arr_server = $cur_arr["score"];
	for ($i = 0; $i < sizeof($arr_server); $i++) {
		$kch = $arr_server[$i]['kch'];
		$kc_server[$kch]['cj'] = $arr_server[$i]['cj'];
		$kc_server[$kch]['kcm'] = $arr_server[$i]['kcm'];		

		$kch = $arr_mysql[$i]['kch'];
		$kc_mysql[$kch]['cj'] = $arr_mysql[$i]['cj'];
		$kc_mysql[$kch]['kcm'] = $arr_mysql[$i]['kcm'];

	}

	for($i=0;$i<sizeof($arr_server);$i++){
		$kch = $arr_server[$i]['kch'];
	
		if($kc_server[$kch]['cj'] == $kc_mysql[$kch]['cj']) {
                       	$status = true;
                }else{
                       	$status = false;
                }

		//如果成绩改变 要干的事情，未来改成发送短信
		if($status == false){
			//$message = "学科:".$kc_mysql[$kch]['kcm']."由:".$kc_mysql[$kch]['cj']." 更新到:" . $kc_server[$kch]['cj'].'<br />';

			//$fp = fopen('sc.html','a');
			//fwrite($fp,$message);
			//fclose($fp);
			$change_kcm = $kc_mysql[$kch]['kcm'];
			$change_cj = $kc_server[$kch]['cj'];
			$phone = $row['phone'];
	
		$value = urlencode("#kcm#=".$change_kcm."&#score#=".$change_cj);
                
		if($change_cj=="") {
			$value = urlencode("#kcm#=".$change_kcm."&#score#=空");
		} 
		
		$url='http://yunpian.com/v1/sms/tpl_send.json';
                $post="apikey=0d679b8688ff199c06196328e578eeae&mobile=$phone&tpl_id=672359&tpl_value=$value";
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
                        $err_data = json_encode($result);
                        $err_fp = fopen('err_log.txt','a');
                        fwrite($err_fp,$err_data."+{time:'".date("Y-m-d H:i:s", time())."',user:'". $row['user_id'] ."'}\n");
                        fclose($err_fp);
                       	continue;
                }

			$change = true;
		}
	}
	//转移范斜杠 存数据的时候防止被吃掉
	if(isset($change)){
		$json_server = str_replace("\\", "\\\\", $json_server);
		mysql_query("update user set cj_data = '".$json_server."', count = count-1 where id = '".$row['id']."'");
		unset($change);
	}
	sleep($interval);
}


}while(true);

?>
