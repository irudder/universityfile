<?php
$authorizer_access_token = file_get_contents('req/authorizer_access_token.php');
//获取全部永久素材
$url = "https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token=".$authorizer_access_token;
$post_data4['type']       = 'news';
$post_data4['offset']       = 0;
$post_data4['count']       = 20;
$post_data = json_encode($post_data4);
$resdata = request_post($url, $post_data);
$resdata = json_decode($resdata);
$resdata = $resdata->item;
////foreach($resdata as $key=>$val){
	//echo $val->media_id;
	//echo "&nbsp;&nbsp;";
	//var_dump($resdata[6]->content->news_item);
	echo "<br>";
	//var_dump($val->content->news_item[0]->title);
	echo "<br>";
//}

$mediadata = $resdata[1]->content->news_item;
foreach($mediadata as $key=>$val){
	echo $val->thumb_media_id;
	echo "&nbsp;&nbsp;";
	echo $val->title;
	echo "<br>";
}
echo "<hr/>";
/*
var_dump($resdata[8]);
echo "<hr/>";
$mediadata = $resdata[8]->content->news_item;
foreach($mediadata as $key=>$val){
	echo $val->thumb_media_id;
	echo "&nbsp;&nbsp;";
	echo $val->title;
	echo "<br>";
}
*/
$url = "https://api.weixin.qq.com/cgi-bin/material/get_material?access_token=".$authorizer_access_token;
$post_data6['media_id']       = 'TCelQtZUkPbI9BZe2zS4f8j-EeNak7jzcnuPCP6tvRo';
$post_data = json_encode($post_data6);
$resdata = request_post($url, $post_data);
$resdata = json_decode($resdata);
$resdata = $resdata->item;
var_dump($resdata);

/*
//获取指定media_id的素材
$url = "https://api.weixin.qq.com/cgi-bin/material/get_material?access_token=".$authorizer_access_token;
$post_data5['media_id']       = 'ZEYdr1p9fWH8C4YElr5052jbtnHrsuIE2qkBz1DvvJs';
$post_data = json_encode($post_data5);
$resdata = request_post($url, $post_data);
var_dump($resdata);
*/

//自定义菜单
$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$authorizer_access_token;

$xjson = '{
     "button":[
		{
			"type": "view_limited", 
			"name":"使用教程",	
			"media_id": "TCelQtZUkPbI9BZe2zS4f8j-EeNak7jzcnuPCP6tvRo"
		},
		{
			"type": "view_limited", 
			"name":"公告通知",	
			"media_id": "TCelQtZUkPbI9BZe2zS4f8j-EeNak7jzcnuPCP6tvRo"
		},
		{   
			"name":"今日更新",
			"sub_button":[
				{	
					"type": "view_limited", 
					"name": "剧集目录", 
					"media_id": "TCelQtZUkPbI9BZe2zS4f8j-EeNak7jzcnuPCP6tvRo"
				},
				{	
					"type": "view_limited", 
					"name": "电影更新", 
					"media_id": "TCelQtZUkPbI9BZe2zS4f8j-EeNak7jzcnuPCP6tvRo"
				},
				{	
					"type": "view_limited", 
					"name": "动漫更新", 
					"media_id": "TCelQtZUkPbI9BZe2zS4f8j-EeNak7jzcnuPCP6tvRo"
				},
			]
		}
		
	]
}';
$res = request_post($url, $xjson);
$res = json_decode($res);
//echo $res->errmsg;
var_dump($res);
exit;
if($res->errmsg!='ok'){
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
	
	//获取刷新令牌和授权方的appid
	$arr = file_get_contents('req/authorizer_refresh_token.php');
	$arr = explode('**', $arr);
	var_dump($arr);
	echo "<hr/>";
	$appid = $arr[0];
	$authorizer_refresh_token = $arr[1];
	$url = "https://api.weixin.qq.com/cgi-bin/component/api_authorizer_token?component_access_token=".$component_access_token;
	$post_data5['component_appid']       = 'wxqqqqqq';
	$post_data5['authorizer_appid']       = $appid;
	$post_data5['authorizer_refresh_token']       = $authorizer_refresh_token;
	$post_data = json_encode($post_data5);
	$resdata = request_post($url, $post_data);
	$resdata = json_decode($resdata);
	var_dump($resdata);
	echo "<hr/>";
	$authorizer_access_token = $resdata->authorizer_access_token;
	$authorizer_refresh_token = $appid.'**'.$resdata->authorizer_refresh_token;
	
	if($authorizer_access_token=='' || !$resdata->authorizer_refresh_token){
		echo "缺少必要的数据，请刷新试试";
		exit;
	}
	
	$myfile1 = fopen("req/authorizer_access_token.php", "w") or die("权限错误!");
	fwrite($myfile1, $authorizer_access_token);
	fclose($myfile1);

	$myfile2 = fopen("req/authorizer_refresh_token.php", "w") or die("权限错误!");
	fwrite($myfile2, $authorizer_appid.'**'.$authorizer_refresh_token);
	fclose($myfile2);
}


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