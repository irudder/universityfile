<?php
require('./req/do.php');

//获取第三方平台access_token
$url = "https://api.weixin.qq.com/cgi-bin/component/api_component_token";
$post_data1['component_appid']       = 'wxqqqqqq';
$post_data1['component_appsecret']      = 'a8c304ab88a7300673ca2321bb816390';
$post_data1['component_verify_ticket'] = $component_verify_ticket;
$post_data = json_encode($post_data1);
$resdata = request_post($url, $post_data);
$resdata = json_decode($resdata);
//var_dump($resdata);
$component_access_token = $resdata->component_access_token;
//echo $component_access_token;

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
//echo $pre_auth_code;

echo "<hr/>";


//使用授权码换取公众号的授权信息
$parameter = "component_access_token=".$component_access_token;
$url = "https://api.weixin.qq.com/cgi-bin/component/api_query_auth?".$parameter;
//授权后才会有的！
$auth_code = $_GET['auth_code']; //"queryauthcode@@@j41WQzJIfyu8nEQ7NvTipcq-H1Mn2rMODIPVCd0QT_fX61qTHDhpJJ2YzYIve-Jx1MgerGDTLb-SLArpaFoEYA";
$post_data3['component_appid']       = 'wxqqqqqq';
$post_data3['authorization_code']       = $auth_code;
$post_data = json_encode($post_data3);
$resdata = request_post($url, $post_data);
$resdata = json_decode($resdata);
//var_dump($resdata);
/*
$authorizer_access_token = $resdata->authorization_info->authorizer_access_token;
echo $authorizer_access_token;
/*$authorizer_refresh_token = $resdata->authorizer_refresh_token;
echo $authorizer_refresh_token;*/
//获取令牌 和刷新令牌  存入
$authorizer_access_token = $resdata->authorization_info->authorizer_access_token;
$authorizer_refresh_token = $resdata->authorization_info->authorizer_refresh_token;
$authorizer_appid = $resdata->authorization_info->authorizer_appid;
echo $authorizer_access_token;
echo "<br/>";
echo $authorizer_refresh_token;
//echo file_put_contents("req/authorizer_access_token.php", 'hhhhhhhhhhhhhhjashdfhsadjfhkjsadfhksahdfksahdfkjhsadkjfhksajdfh你算的复苏回暖');
//echo file_put_contents("req/authorizer_refresh_token.php", $authorizer_refresh_token);

$myfile1 = fopen("req/authorizer_access_token.php", "w") or die("权限错误!");
fwrite($myfile1, $authorizer_access_token);
fclose($myfile1);

$myfile2 = fopen("req/authorizer_refresh_token.php", "w") or die("权限错误!");
fwrite($myfile2, $authorizer_appid.'**'.$authorizer_refresh_token);
fclose($myfile2);

echo "<hr/>";

//在指定ip下使用上面的到的第三方authorizer_access_token 去调用公众号开发接口！！
//N4Zd9p_Qz0a-3HxH5iUpJ3KCcMQuthhbrfPOcHO7qf0_UHBpZe2Q3Oonaq3MEtQ0nc7I8TRFt99zYX1YgdlU-XySXdMdYCwb6MLm3m5W1zsMA5kqxRR3FfdO3ce-NHN3EPFhADDALB

/*
//获取全部永久素材
$url = "https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token=".$authorizer_access_token;
$post_data4['type']       = 'news';
$post_data4['offset']       = 0;
$post_data4['count']       = 20;
$post_data = json_encode($post_data4);
$resdata = request_post($url, $post_data);
$resdata = json_decode($resdata);
$resdata = $resdata->item;
foreach($resdata as $key=>$val){
	echo $val->media_id;
	echo "&nbsp;&nbsp;&nbsp;";
}
*/

/*
//获取指定media_id的素材
$url = "https://api.weixin.qq.com/cgi-bin/material/get_material?access_token=".$authorizer_access_token;
$post_data5['media_id']       = 'ZEYdr1p9fWH8C4YElr5052jbtnHrsuIE2qkBz1DvvJs';
$post_data = json_encode($post_data5);
$resdata = request_post($url, $post_data);
var_dump($resdata);
*/
/*
//自定义菜单
$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$authorizer_access_token;

$xjson = '{
     "button":[
		{   
			"name":"菜单",
			"sub_button":[
			{	
                "type": "view_limited", 
				"name": "手撕", 
				"media_id": "ZEYdr1p9fWH8C4YElr5052jbtnHrsuIE2qkBz1DvvJs"
            },
		}
	]
}';
$res = request_post($url, $xjson);
var_dump($res);

*/











echo "<hr />";

function request_get($url = ''){
	$ch=curl_init($url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_BINARYTRANSFER,true);
	$output=curl_exec($ch);
	//$fh=fopen("test.php",'w');
	$data = curl_exec($ch);//运行curl
	//fwrite($fh,$output);
	//fclose($ch);
	
	return $data;
}


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