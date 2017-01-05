<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>SPAY免签约支付宝即时到账交易接口</title>
</head>
<?php
/* *
 * 功能：即时到账交易接口接入页
 * 
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。
 */

require_once("alipay.config.php");
require_once("lib/alipay_submit.class.php");

/**************************请求参数**************************/
        $notify_url = "http://xxx.xxx/notify_url.php";
        //需http://格式的完整路径，不能加?id=123这类自定义参数
        //页面跳转同步通知页面路径
        $return_url = "http://xxx.xxx/return_url.php";
        //需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/
        //商户订单号
        $out_trade_no = $_POST['WIDout_trade_no'];
        //商户网站订单系统中唯一订单号，必填
        //付款金额
        $total_fee = $_POST['WIDtotal_fee'];
        //必填
        //订单描述

/************************************************************/

//构造要请求的参数数组，无需改动
$parameter = array(
		"service" => "create_direct_pay_by_user",
		"partner" => trim($alipay_config['partner']),
		"notify_url"	=> $notify_url,
		"return_url"	=> $return_url,
		"out_trade_no"	=> $out_trade_no,
		"total_fee"	=> $total_fee
);

//建立请求
$alipaySubmit = new SPAYSubmit($alipay_config);
$html_text = $alipaySubmit->buildRequestForm($parameter);
echo $html_text;

?>
</body>
</html>