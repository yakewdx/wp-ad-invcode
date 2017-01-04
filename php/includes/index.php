<?php
$payhid = ''; //HUX支付平台HID，必填
$paypass = ''; //HUX支付平台支付密钥，必填
$price   = isset($_POST['money']) && is_numeric($_POST['money']) ?$_POST['money'] :0;
$subject = '充值测试';  //订单名称，显示在支付宝收银台里的"商品名称"里，显示在支付宝的交易管理的"商品名称"的列表里。
/*以下参数是需要通过下单时的订单数据传入进来获得*/
//必填参数
$charset = 'utf-8'; //编码，gbk，utf-8
$uid = '0'; //充值用户唯一ID，请根据网站自身情况获取此ID
$orderid = date("YmdHis").mt_rand(10, 99).mt_rand(10,99);	//请与贵网站订单系统中的唯一订单号匹配
echo "<html>
    <head>
		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
        <title>充值</title>
    </head>
    <body>
	<form name='form1' method='post' target='_blank'>
	充值金额：<input name='money' value='1' type='text' />
	<input name='submit' value='确定' type='submit' />
	</form>";
// 将传入的数据写入数据库

if ($_POST['submit']) {
		$param = array(
			'orderid' => $orderid, //订单号
			'title' => $subject, //付款说明
			'price' => $price, //商品价格
			'paytype' => 'pay', //不用修改
			'dateline' => time(),
			'other' => $price, //付款后返回的数据，可为付款金额
		);

		ksort($param);
		$params = '';
		foreach($param as $k => $v) {
			$params .= '&'.$k.'='.rawurlencode($v);
		}
		$params .= '&hid='.$payhid.'&uid='.$uid.'&charset='.$charset.'&md5hash='.md5(substr($params, 1).$paypass);
		$r = hux_get_data('http://api.k1cn.com/index.php?action=payurl&hid='.$payhid); //获取支付平台域名，不用修改
		header("Location:http://".$r.'/plugin.php?id=hux_api:hux_api&huxac=pay&'.substr($params, 1)); 
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
    </body>
</html>