<?php
require('req/do.php');
/*
echo "<hr/>";
echo $msg;
echo "<hr/>";
echo $component_verify_ticket;
echo "<hr/>";
*/
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
$web_url = "http://demo.irudder.me/deal.php";
$href='https://mp.weixin.qq.com/cgi-bin/componentloginpage?component_appid='.$appId.'&pre_auth_code='.$pre_auth_code.'&redirect_uri='.$web_url;
echo $href;
header('refresh:3;url='.$href);
echo "<hr/>";


//使用授权码换取公众号的授权信息
$parameter = "component_access_token=".$component_access_token;
$url = "https://api.weixin.qq.com/cgi-bin/component/api_query_auth?".$parameter;
//授权后才会有的！
$auth_code = "queryauthcode@@@j41WQzJIfyu8nEQ7NvTipcq-H1Mn2rMODIPVCd0QT_fX61qTHDhpJJ2YzYIve-Jx1MgerGDTLb-SLArpaFoEYA";
$post_data3['component_appid']       = 'wxqqqqqq';
$post_data3['authorization_code']       = $auth_code;
$post_data = json_encode($post_data3);
$resdata = request_post($url, $post_data);
$resdata = json_decode($resdata);
//var_dump($resdata);
$authorizer_access_token = $resdata->authorization_info->authorizer_access_token;
/*
$authorizer_refresh_token = $resdata->authorization_info->authorizer_refresh_token;
echo $authorizer_access_token;
file_put_contents("./req/authorizer_access_token.php", $authorizer_access_token);

file_put_contents("./req/authorizer_refresh_token.php", $authorizer_refresh_token);
/*$authorizer_refresh_token = $resdata->authorizer_refresh_token;
echo $authorizer_refresh_token;*/

echo "<hr/>";

//在指定ip下使用上面的到的第三方authorizer_access_token 去调用公众号开发接口！！
//N4Zd9p_Qz0a-3HxH5iUpJ3KCcMQuthhbrfPOcHO7qf0_UHBpZe2Q3Oonaq3MEtQ0nc7I8TRFt99zYX1YgdlU-XySXdMdYCwb6MLm3m5W1zsMA5kqxRR3FfdO3ce-NHN3EPFhADDALB

/*
$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$authorizer_access_token;

$xjson = '{
     "button":[
     {	
          "type":"click",
          "name":"今日歌曲",
          "key":"V1001_TODAY_MUSIC"
		}
	]
}';
$res = request_post($url, $xjson);
var_dump($res);
*/

$art ='{
  "articles": [{
       "title": TITLE,
       "thumb_media_id": THUMB_MEDIA_ID,
       "author": AUTHOR,
       "digest": DIGEST,
       "show_cover_pic": SHOW_COVER_PIC(0 / 1),
       "content": CONTENT,
       "content_source_url": CONTENT_SOURCE_URL
    },
    //若新增的是多图文素材，则此处应还有几段articles结构
 ]
}';

//$type = "image";
//$filepath = "9.png";
//$filedata = array("file1"  => "@".$filepath);
/*
$file_info = array(
	'filename' => "9.png",
	'content-type'=>"image/jpeg",
	'filelength'=>"78710"
);
$filedata= array("media"=>"9.png",'form-data'=>$file_info);
$filedata= json_encode($filedata);
*/
/*
$filepath = "9.png";
$ajson = '{
	  "articles": [{
		   "title": "你好呀",
		   "thumb_media_id": "20151116",
		   "author": "rudder",
		   "digest": '',
		   "show_cover_pic": 1,
		   "content": "这是内容了，<img src=$filepath />...",
		   "content_source_url": "http://irudder.me",
		},
		]
	}';

$url = "https://api.weixin.qq.com/cgi-bin/material/add_news?access_token=".$authorizer_access_token;
*/
var_dump(request_get("https://api.weixin.qq.com/cgi-bin/media/get?access_token=RsuienekdmR2bJYPG3HZiThYmW8ksad5IIvxp1sfGYV6CkSXUwe1Hd7qQgDMCZJf61Q37Z-j3pHnjhCyl-kpcQvQcYEXkSBaN0n-uLREtlHVIoeARkzeB2-BMZ0_P2MlFEIfALDSRV&media_id=Yb1K-aOWqptks7TAhi45Sd6HP0OLnKk84ARCzMl4HSmMiXQKDyWyYtLJ4l92lq8r"));


//$res = request_post($url, $ajson);
//var_dump($res);

echo "<hr />";

function request_get($url = ''){
	$ch=curl_init($url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_BINARYTRANSFER,true);
	$output=curl_exec($ch);
	$fh=fopen("test.php",'w');
	fwrite($fh,$output);
	fclose($fh);
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
?>