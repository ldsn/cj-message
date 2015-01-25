<?php 
set_time_limit(0);
$appId = '999e8a0710c29ef7d3';
$appSecret = '2c0471eaec0d4acbd8e99b1d23716344';
$cur_time = date("Y-m-d H:i:s",time());
$method = 'kdt.trades.sold.get';

function get($params){
        global $appId,$appSecret,$cur_time,$method;

        $params['app_id']=$appId;
        $params['timestamp']=$cur_time;
        $params['method']=$method;
        $params['v']='1.0';
        $params['format']='json';
        $params['sign_method']='md5';
        ksort($params);

        $line ='';
        $url = '';
        foreach($params as $key=>$v){
                $line = $line.$key.$v;
                $url = $url.$key."=".$v."&";
        }
        $md5 = md5($appSecret.$line.$appSecret);
        $url = "http://open.koudaitong.com/api/entry?sign=".$md5."&".substr($url,0,strlen($url)-1);
	$url = str_replace(' ','%20',$url);
	return file_get_contents($url);
}
	


$fp = fopen('aa.html','a');
$err_log = fopen('err_log.html','a');
$end_time = date("Y-m-d H:i:s",time()+58);
$sleep = 4;



do{
	$start_time = $end_time;
        $end_time  =  date("Y-m-d H:i:s",time()+58);
$params = array(
        'status' => 'WAIT_SELLER_SEND_GOODS',
        'start_update' => $start_time,
	'end_created' => $end_time,

);

        $json =  get($params);
	$data = json_decode($json,true);
include ('./add.php');
	
        sleep($sleep);
}while(true);
