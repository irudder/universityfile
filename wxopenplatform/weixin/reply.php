<?php
//error_reporting(0);
$content = file_get_contents("php://input");
if($content){
	file_put_contents("content.php", "\r\n" . $content .'**'. $_GET['timestamp'] . '**' . $_GET['nonce'] . "**" . $_GET['msg_signature']);
}
$content = file_get_contents('content.php');
//var_dump($content);
$arr = explode('**',$content);
require '../req/weixin.php';
$encodingAesKey = 'cmbjxccwtnylfyshlzdscmbjxccwtnylfyshlzds015';
$token = 'diemeng2015';
$appId = "wxqqqqqq";
$timeStamp =$arr[1];
$nonce = $arr[2];
$msg_sign = $arr[3];
$encryptMsg = $arr[0];
$pc = new WXBizMsgCrypt($token, $encodingAesKey, $appId);

//echo $encryptMsg;

$xml_tree = new DOMDocument();
$xml_tree -> loadXML($encryptMsg);
$array_e = $xml_tree -> getElementsByTagName('Encrypt');
$encrypt = $array_e -> item(0) -> nodeValue;
//echo $encrypt;
$format = "<xml><ToUserName><![CDATA[toUser]]></ToUserName><Encrypt><![CDATA[%s]]></Encrypt></xml>";
$from_xml = sprintf($format, $encrypt);
//var_dump($from_xml);
// 第三方收到公众号平台发送的消息
$msg = '';
$errCode = $pc -> decryptMsg($msg_sign, $timeStamp, $nonce, $from_xml, $msg);
//var_dump($arr);
//echo "<hr>";
//var_dump($msg);
//echo "<hr/>";
//echo $errCode;
//echo "<hr/>";
if ($errCode == 0) {
	//print("解密后: " . $msg . "\n");
	$xml = new DOMDocument();
	$xml -> loadXML($msg);
	//获取发送者 接受者  发送的内容 
	$content = $xml -> getElementsByTagName('Content');
	$Content = $content -> item(0) -> nodeValue;
	
	$ToUserName = $xml -> getElementsByTagName('ToUserName');
	$ToUserName = $ToUserName -> item(0) -> nodeValue;
	
	$FromUserName = $xml -> getElementsByTagName('FromUserName');
	$FromUserName = $FromUserName -> item(0) -> nodeValue;
	//$Content = $_GET['key'];
	//echo $Content;
	//var_dump($Content);
	//echo "<hr/>";
	/*
	$con = mysql_connect("域名","root","密码");
	$db  = mysql_select_db("wp",$con);
	mysql_query("set names utf8");
	//$sql = "select `content` from `wp_custom_reply_text` where `keyword`='$Content'";
	$sql = "select * from `wp_custom_reply_text` where `keyword` like '%$Content%'";
	$result = mysql_query($sql ,$con);
	//$contentStr = '没有进行查询';
	//echo $sql;
	//echo "<hr>";
	//var_dump($result);
	*/
	/*
	$contentStr = '没有进行查询';
	$res = conn($key);
	
	if($row = mysql_fetch_array($result)){
		/*$contentStr = "<a href='http://www.woxiangyao.me/forum/'>萌萌机器人：不知道为啥，就是搜索不到你说的这个，让我再想想怎么办好呢。。</a>";*\/
		//$url = "http://www.tuling123.com/openapi/api?key=d812d695a5e0df258df952698faca6cc&info=".$Content;//weiphp的
		//$url = "http://www.tuling123.com/openapi/api?key=1ccf45268dcafb72785e86e638164753&info=".$Content;//我的
		$url = "http://www.tuling123.com/openapi/api?key=07c75391574596404af60937d9ee9bf8&info=".$Content;//蝶梦
		$contentStr = "萌萌机器人：".json_decode(request_get($url))->text;
	}else{
		while($row = mysql_fetch_array($result))
		{			
			$contentStr = $row['content'];
		}
	}
	
	while($contentStr=="没有进行查询"){
		$i = 0;
		if(!mysql_fetch_row($result)){
			$contentStr = "<a href='http://www.woxiangyao.me/forum/'>萌萌机器人：不知道为啥，就是搜索不到你说的这个，让我再想想怎么办好呢。。</a>";
		}else{
			while($row = mysql_fetch_array($result))
			{
				$contentStr = $row['content'];
			}
		}
		$i++;
		if($i=10){
			//echo $i;
			break;
		}
	}*/
	
	//echo $contentStr;
	//echo '<hr>';
	//echo $Content;
	$contentStr = "<a href='http://www.woxiangyao.me/forum/'>萌萌机器人：不知道为啥，就是搜索不到你说的这个，让我再想想怎么办好呢。。</a>";
	$res = conn($Content);
	//var_dump($res);
	//echo $res['content'];
	if(!$res || $res==''){
		$url = "http://www.tuling123.com/openapi/api?key=07c75391574596404af60937d9ee9bf8&info=".$Content;//蝶梦
		$contentStr = "萌萌机器人：".json_decode(request_get($url))->text;
	}else{
		//var_dump($res);
		$contentStr = $res[0]['content'];
	}
	
	//echo $contentStr;
	$text = '
		<xml><ToUserName><![CDATA[%s]]></ToUserName>
		<FromUserName><![CDATA[%s]]></FromUserName>
		<CreateTime>%s</CreateTime>
		<MsgType><![CDATA[text]]></MsgType>
		<Content><![CDATA[%s]]></Content>
		<FuncFlag>0</FuncFlag>
		</xml>
	';
	$CreateTime = time();
	$text = sprintf($text, $FromUserName, $ToUserName, $CreateTime, $contentStr);
	//var_dump($text);
	/* 可直接运用的例子
	$text = '
		<xml><ToUserName><![CDATA[o8Srytz6M_tDPD87lNDv1Pp-594c]]></ToUserName>
		<FromUserName><![CDATA[gh_e4b2564839f6]]></FromUserName>
		<CreateTime>1449298059</CreateTime>
		<MsgType><![CDATA[text]]></MsgType>
		<Content><![CDATA[爱你]]></Content>
		<FuncFlag>0</FuncFlag>
		</xml>
	';
	*/
	$from_xml = sprintf($format, $encrypt);
	//$errCode = $pc -> encryptMsg($msg_sign, $timeStamp, $nonce, $msg);
	$errCode = $pc->encryptMsg($text, $timeStamp, $nonce, $encryptMsg);
	//echo $encryptMsg;
	$arr = explode('    ',$encryptMsg);//4个空格
	//var_dump($arr);
	
	$encryptMsg = substr($arr[1],0,-1);
	$signature = substr($arr[2],0,-1);
	$timestamp = substr($arr[3],0,-1);
	$nonce  = substr($arr[4],0,-1);
	
	$format = "<xml>
	<Encrypt><![CDATA[%s]]></Encrypt>
	<MsgSignature><![CDATA[%s]]></MsgSignature>
	<TimeStamp>%s</TimeStamp>
	<Nonce><![CDATA[%s]]></Nonce>
	</xml>";
	echo sprintf($format, $encryptMsg, $signature, $timestamp, $nonce);
	
	
	//var_dump($from_xml);
	 
	//var_dump($msg);
	//echo $errCode;
	
}else{
	echo "解密出错。，。。";
}


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

/**连接数据库*/
function conn($key){
	/*try {
		$dbh = new PDO('mysql:host=域名;dbname=wp', 'root', '密码');
		$dbh->exec("SET NAMES 'utf8'");
		$sql = "SELECT `content` from wp_custom_reply_text where `keyword` like '%$key%' AND `token`='gh_e261fc4ecccb' limit 1";
		$data = $dbh->query($sql);
		var_dump($data);
		foreach($data as $row) {
			//print_r($row);
			return $row;
		}
		$dbh = null;*/
			try {
		$dbh = new PDO('mysql:host=域名;dbname=wp', 'root', '密码');
		$dbh->exec("SET NAMES 'utf8'");
		$sql = "SELECT `content` from wp_custom_reply_text where `keyword`='$key' AND `token`='gh_e261fc4ecccb' limit 1";
		//echo $sql;
		$rs = $dbh->query($sql);
		$data = $rs->fetchAll();
		if($data){
			//echo 1;
		}else{
			$sql = "SELECT `content` from wp_custom_reply_text where `keyword` like '%$key' AND `token`='gh_e261fc4ecccb' limit 1";
			$rs = $dbh->query($sql);
			$data = $rs->fetchAll();
			if($data){
				//echo 2;
			}else{
				$sql = "SELECT `content` from wp_custom_reply_text where `keyword` like '$key%' AND `token`='gh_e261fc4ecccb' limit 1";
				$rs = $dbh->query($sql);
				$data = $rs->fetchAll();
				//echo 3;
			}
		}
		//echo $sql;
		return $data;
		
		$dbh = null;
	} catch (PDOException $e) {
		//print "Error!: " . $e->getMessage() . "<br/>";
		return "Error!: " . $e->getMessage() . "<br/>";
		die();
	}
}

/*
$con = mysql_connect("域名","root","密码");
$db  = mysql_select_db("weiphp",$con);
mysql_query("set names utf8");
define("TOKEN", "diemeng2015");
$wechatObj = new wechatCallbackapiTest();
$wechatObj->responseMsg();

class wechatCallbackapiTest
{
	public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
        	echo $echoStr;
        	exit;
        }
    }

    public function responseMsg()
    {
		//get post data, May be due to the different environments
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

      	//extract post data
		if (!empty($postStr)){
                
              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
                $type = $postObj->MsgType;
				$event = $postObj->Event;
                $keyword = trim($postObj->Content);
                $time = time();
                $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>"; 
                                 //加载图文模版
				$picTpl = "<xml>
								 <ToUserName><![CDATA[%s]]></ToUserName>
								 <FromUserName><![CDATA[%s]]></FromUserName>
								 <CreateTime>%s</CreateTime>
								 <MsgType><![CDATA[%s]]></MsgType>
								 <ArticleCount>1</ArticleCount>
								 <Articles>
								 <item>
								 <Title><![CDATA[%s]]></Title> 
								 <Description><![CDATA[%s]]></Description>
								 <PicUrl><![CDATA[%s]]></PicUrl>
								 <Url><![CDATA[%s]]></Url>
								 </item>
								 </Articles>
								 <FuncFlag>1</FuncFlag>
							</xml> ";
				if($type == "event" && $event == "subscribe")
                {
              		$msgType = "text";
                	$contentStr = "欢迎关注蝶梦小筑！";
                	$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                	echo $resultStr;
                }else{
					//$keywords = iconv("UTF-8","gbk",$keyword);
					$result = mysql_query("select aid,typeid from `weiphp` where keyword like '%{$keywords}%' ");
					while ($row = mysql_fetch_array($result)) {
						$id = $row['aid'];
						$typeid = $row['typeid'];
					}
					if(empty($id)){
						$msgType = "text";
						$contentStr = "很抱歉没有搜索到相关信息，您可以登录http://m.365rzf.com来查询相关信息" ;
						$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
						echo $resultStr;
					}else{
						$url = array(
							1 => 'http://www.365rzf.com/rizu/',
							2 => 'http://www.365rzf.com/hour/',
							3 => 'http://www.365rzf.com/yuezu/',
							4 => 'http://www.365rzf.com/news/',
							5 => 'http://www.365rzf.com/student/',
							6 => 'http://www.365rzf.com/lvyou/',
							7 => 'http://www.365rzf.com/shop/'
						);
						$xinxi = mysql_query("select title,litpic,pubdate,description from `数据库` where id ={$id}");
						while ($jay = mysql_fetch_array($xinxi)) {
							$title = $jay['title'];
							$image = "http://www.365rzf.com".$jay['litpic'];
							$data  = date('Y/md',$jay['pubdate']);
							$desription = $jay['description'];
						}
						$turl = $url[$typeid].$data."/".$id.".html";    //url抵制
						$title= iconv("GBK","UTF-8",$title);            //标题名称
						$desription= iconv("GBK","UTF-8",$desription);  //描述
						$msgType = "news"; 								//类型
						$resultStr = sprintf($picTpl, $fromUsername, $toUsername, $time, $msgType, $title,$desription,$image,$turl);
						echo $resultStr;
					}
                }
        }else {
        	echo "";
        	exit;
        }
    }
	private function checkSignature()
	{
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];	
        		
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
	
}*/