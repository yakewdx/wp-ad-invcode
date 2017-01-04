<?php
$payhid = ''; //HUX支付平台HID，必填
$paypass = ''; //HUX支付平台支付密钥，必填
$orderid = addslashes($_GET['orderid']); //订单号
$param = array(
	'hid' => $payhid,
	'orderid' => $orderid,
);
ksort($param);
$params = '';
foreach($param as $k => $v) {
	$params .= '&'.$k.'='.rawurlencode($v);
}

$params .= '&md5hash='.md5(substr($params, 1).$paypass);

$rrrrr = hux_get_data('http://api.k1cn.com/index.php?action=payurl&hid='.$payhid);
$r = hux_get_data('http://'.$rrrrr.'/plugin.php?id=hux_api:pay&action=getresult&'.substr($params, 1));
$paystatus = explode(',',$r); //返回数据，$paystatus[0]为支付状态：0=未付款 1=已付款 2=已发货 $paystatus[1]为用户唯一ID $paystatus[2]为提交时传递的other参数
if ($paystatus[0] == '1') {
	//逻辑代码开始
	
	
	//逻辑代码结束
	echo 1;
} else {
	echo 0;
}


function hux_get_data($url) {
	global $_G;
	if (function_exists('curl_init')) {
		$curl = curl_init(); 
		curl_setopt($curl, CURLOPT_URL, $url); 
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
		$result = curl_exec($curl); 
		curl_close($curl);
	} else {
		$result = file_get_contents($url);
	}
	return $result;
}
?>