<?php
$dbh = mysql_connect("127.0.0.1:3306","root","root"); 
if(!$dbh){die("error");} 
mysql_select_db("cj", $dbh); 
$q = "select * from user"; 
///$sql = sprintf("select count(*) from %s", DB_TABLENAME);  
ignore_user_abort();
set_time_limit(0); 
$interval=2; 
function judgeEqual($key1,$key2){
    if(array_diff($key1,$key2) || array_diff($key2,$key1)){
        return true;
    }else{
        return false;
    }
    
}

do{
$rs = mysql_query($q, $dbh); 
//var_dump($rs);
while( $row = mysql_fetch_array($rs) ){
	$json_mysql = $row['cj_data'];
	$arr_mysql  = json_decode($json_mysql,true)["score"];
	//var_dump($arr_mysql);

	$userid=$row['user_id'];
    $password=$row['pass'];

	$json_server = file_get_contents('http://cj.ldustu.com/api/score?userid=20123116743&password=021995&from=message&appid=10002&secret=message@ldsn');
	$arr_server  = json_decode($json_server,true)["score"];
	//var_dump($status);
	//var_dump($arr_server);
	for($i=0;$i<sizeof($arr_server);$i++){
		$status = judgeEqual($arr_mysql[$i],$arr_server[$i]);
		if($status == true){
			$message = "学科:".$arr_mysql[$i]['kcm']."由:".$arr_mysql[$i]['cj']." 更新到:" . $arr_server[$i]['cj'].'<br />';
			$fp = fopen('text3.txt','a');
			fwrite($fp,$message);
			fclose($fp);

		}	
	}
	//foreach ($arr_server as $value) {
	//print_r($value);
//	}
}


sleep($interval);
}while(true);


?>
