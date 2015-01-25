<?php
	error_reporting(E_ALL^E_NOTICE);
	$xh = $_REQUEST['xh'];
	if(!isset($xh))
	{
		$result = array(
			"error" => 1,
			"data" => "no have xh"
		);
		echo json_encode($result);
		return;
	}	

	if(strlen($xh) != 11) {
		$result = array(
                        "error" => 2,
                        "data" => "学号应该是11位"
                );
                echo json_encode($result);
                return;
	}
//	$dbh = mysql_connect($_SERVER['DB_HOST'],$_SERVER['DB_USER'],$_SERVER['DB_PASSWORD']);
	$dbh = mysql_connect("localhost","cj","wangluobu@tw");
	
	if(!$dbh){die("error");}
	mysql_select_db('cj', $dbh);
	$sql = sprintf(
		"select * from youhui where xh = '%s'",
		mysql_real_escape_string($xh)
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
 		"insert into %s (xh) values ('%s')",
  		mysql_real_escape_string('youhui'),
 		mysql_real_escape_string($xh)
	);

	if(mysql_query($sql,$dbh)){
		$result = array(
			'error' => 0,
			'data' => 'success'
		);
		
		echo json_encode($result);
	}	
