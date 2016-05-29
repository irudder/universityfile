<?php
$content = file_get_contents("php://input");
if($content){
	file_put_contents("./req/appid.php", "\r\n" . $content .'**'. $_GET['timestamp'] . '**' . $_GET['nonce'] . "**" . $_GET['msg_signature']);
	echo "success";
	}