<?php
$content = file_get_contents('./req/appid.php');
$arr = explode('**',$content);
var_dump($arr);
//exit;		
require './req/weixin.php';
$encodingAesKey = 'cmbjxccwtnylfyshlzdscmbjxccwtnylfyshlzds015';
$token = 'diemeng2015';
$appId = "wxqqqqqq";
$timeStamp =$arr[1];
$nonce = $arr[2];
$msg_sign = $arr[3];
$encryptMsg = $arr[0];
$pc = new WXBizMsgCrypt($token, $encodingAesKey, $appId);
$xml_tree = new DOMDocument();
$xml_tree -> loadXML($encryptMsg);
$array_e = $xml_tree -> getElementsByTagName('Encrypt');
$encrypt = $array_e -> item(0) -> nodeValue;

$format = "<xml><ToUserName><![CDATA[toUser]]></ToUserName><Encrypt><![CDATA[%s]]></Encrypt></xml>";
$from_xml = sprintf($format, $encrypt);

// 第三方收到公众号平台发送的消息
$msg = '';
$errCode = $pc -> decryptMsg($msg_sign, $timeStamp, $nonce, $from_xml, $msg);
if ($errCode == 0) {
	//print("解密后: " . $msg . "\n");
	$xml = new DOMDocument();
	$xml -> loadXML($msg);
	$array_e = $xml -> getElementsByTagName('ComponentVerifyTicket');
	$component_verify_ticket = $array_e -> item(0) -> nodeValue;
	/*$array_e = $xml -> getElementsByTagName('ComponentVerifyTicket');
	$component_verify_ticket = $array_e -> item(0) -> nodeValue;
	$array_b = $xml->getElementsByTagName('InfoType');
	$infotype = $array_b->item(0)->nodeValue;
	$array_c = $xml->getElementsByTagName('AuthorizerAppid');
	$authorizerappid = $array_c->item(0)->nodeValue;
	$array_d = $xml->getElementsByTagName('event');
	$event = $array_d->item(0)->nodeValue;
	$array_e = $xml->getElementsByTagName('FromUserName');
	$from_user = $array_e->item(0)->nodeValue;
	*/
	//echo "$authorizerappid";
	//记录解密的xml数据
	//file_put_contents("./get.php", "\r\n". $msg."\r\n" .$infotype."\r\n".$authorizerappid, FILE_APPEND);

    if($component_verify_ticket){
    	//file::write('./cache/component_verify_ticket.json', json_encode(array('component_verify_ticket' => $component_verify_ticket)));
		//db::update('ticket',"ticket='$component_verify_ticket',time='$timeStamp'","id=1");
		echo 'success';
    }
}
?>
