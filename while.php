<?php
$dbh = mysql_connect("127.0.0.1:3306","root","8641683"); 
if(!$dbh){die("error");} 
mysql_select_db("cj", $dbh); 
$q = "select * from user"; 
ignore_user_abort();
set_time_limit(0); 
$interval=2; 
//一直循环数据库里的内容 把 n 条记录取出 然后每个人的每门成绩进行对比
do{
$rs = mysql_query($q, $dbh); 
//下面这个循环是针对一个人的
while( $row = mysql_fetch_array($rs) ){
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
		fwrite($err_fp,$json_server);
		fclose($err_fp);
		continue;
	}
	$arr_server  = $cur_arr["score"];
	for($i=0;$i<sizeof($arr_server);$i++){
		
		if($arr_mysql[$i]['cj'] == $arr_server[$i]['cj']){
			$status = true;
		}else{
			$status = false;
		}

		//如果成绩改变 要干的事情，未来改成发送短信
		if($status == false){
			$message = "学科:".$arr_mysql[$i]['kcm']."由:".$arr_mysql[$i]['cj']." 更新到:" . $arr_server[$i]['cj'].'<br />';
			$fp = fopen('sc.html','a');
			fwrite($fp,$message);
			fclose($fp);
		}
	}
	//转移范斜杠 存数据的时候防止被吃掉
	$json_server = str_replace("\\", "\\\\", $json_server);
	mysql_query("update user set cj_data = '".$json_server."' where id = '".$row['id']."'");
	sleep($interval);
}


}while(true);

?>
