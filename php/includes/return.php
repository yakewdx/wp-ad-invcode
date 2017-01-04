﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>充值成功</title>
   </head>
    <body>
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
}
echo '充值成功';

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
</div>
</div>
<div style="text-align: center">Copyright © <?php echo date('Y'); ?> <a href="<?php echo get_option(siteurl); ?>/"><?php echo get_option(blogname); ?></a>
版权所有.
</div>
    </body>
</html>