<?php

$url = "https://api.weixin.qq.com/cgi-bin/component/api_component_token";
$post_data1['component_appid']       = 'wxqqqqqq';
$post_data1['component_appsecret']      = 'a8c304ab88a7300673ca2321bb816390';
$post_data1['component_verify_ticket'] = 'ticket@@@V2qugs6veYTi8GLD-_SFQTB2ket6SIrDQEqYRM3QsQL1uU431KePyHLm3rIiwX7nwe-j1eVrBtJFOPTuNdfRkQ';
$post_data = json_encode($post_data1);
$resdata = request_post($url, $post_data);
$resdata = json_decode($resdata);
//var_dump($resdata);
$component_access_token = $resdata->component_access_token;
echo $component_access_token;

echo "<hr/>";

//获取预授权码
$parameter = "component_access_token=".$component_access_token;
$url = "https://api.weixin.qq.com/cgi-bin/component/api_create_preauthcode?".$parameter;
$post_data2['component_appid']       = 'wxqqqqqq';
$post_data = json_encode($post_data2);
$resdata = request_post($url, $post_data);
$resdata = json_decode($resdata);
//var_dump($resdata);
$pre_auth_code = $resdata->pre_auth_code;
echo $pre_auth_code;

echo "<hr/>";

//公众号授权给第三方
/*$web_url = "http://demo.irudder.me/wei/user/wxlogin";
$href='https://mp.weixin.qq.com/cgi-bin/componentloginpage?component_appid='.$appId.'&pre_auth_code='.$pre_auth_code.'&redirect_uri='.$web_url;
echo $href;
header('refresh:3;url='.$href);
echo "<hr/>";
*/

//使用授权码换取公众号的授权信息
$parameter = "component_access_token=".$component_access_token;
$url = "https://api.weixin.qq.com/cgi-bin/component/api_query_auth?".$parameter;
//授权后才会有的！
$auth_code = "preauthcode@@@vZWncWE6F0FFQ20BDc6UP-07N2eba3v7EZzW1ZNKKk-5QC-05uhaL7NTeM2eY0is";
$post_data3['component_appid']       = 'wxqqqqqq';
$post_data3['authorization_code']       = $auth_code;
$post_data = json_encode($post_data3);
$resdata = request_post($url, $post_data);
$resdata = json_decode($resdata);
//var_dump($resdata);
$authorizer_access_token = $resdata->authorization_info->authorizer_access_token;
echo $authorizer_access_token;


/**
 * 模拟post进行url请求
 * @param string $url
 * @param array $post_data
 */
function request_post($url = '', $post_data = array()) {
	if (empty($url) || empty($post_data)) {
		return false;
	}

	$postUrl = $url;
	$curlPost = $post_data;
	$ch = curl_init();//初始化curl
	curl_setopt($ch, CURLOPT_URL,$postUrl);//抓取指定网页
	curl_setopt($ch, CURLOPT_HEADER, 0);//设置header
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
	curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
	curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
	$data = curl_exec($ch);//运行curl
	curl_close($ch);
	
	return $data;
}