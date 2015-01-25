<?
	$order_num = $data['response']['total_results'];
	$order_trades = $data['response']['trades'];
	$i = 0;
	for ($i; $i < $order_num; $i ++){
		$nid = $order_trades[$i]['orders'][0]['num_iid'];
		$price = $order_trades[$i]['orders'][0]['price'];
		$userid = $order_trades[$i]['orders'][0]['buyer_messages'][0]['content'];
		$password = $order_trades[$i]['orders'][0]['buyer_messages'][1]['content'];
		$phone = $order_trades[$i]['orders'][0]['buyer_messages'][2]['content'];
		$count = $price * 10 / 3;
		$add_result = file_get_contents('http://message.ldustu.com/add.php?userid='.$userid.'&password='.$password.'&phone='.$phone.'&count='.$count);
		$add_arr = json_decode($add_result,true);
		if($add_arr['error'] != 0){
			fwrite($err_log,
				$add_result.
				json_encode(
					array(
						'userid'=>$userid,
						'time'=>date('Y-m-d H:i:s',time())
					)
				)."\n"
			);
			continue;
		}
		if($add_arr['error'] == 203){
			fwrite($err_log,
				json_encode(
					array(
						'error'=>203,
						'data'=>'这个问题严重，请联系范明非解决',
						'userid'=>$userid,
						'time'=>date('Y-m-d H:i:s',time())
					)
				)."\n"
			);
			continue;
		}
	}
