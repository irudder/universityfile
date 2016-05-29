<?php
	session_start();
	
	define("VIEW_PATH", "/divcss/views/");
	header("content-type:text/html;charset=utf-8");
	
	function checkLogin() {
		if( !isset($_SESSION["cus"]) ) {
			header("Location: /divcss/login.html");
			exit();
		}
	}
	
	function __autoload($class_name) {
		//通过传入的类名来进行相应的类文件引入
		//hc($class_name);
		$controlpath = $_SERVER["DOCUMENT_ROOT"]."/divcss/control/{$class_name}.class.php";
		$modelpath = $_SERVER["DOCUMENT_ROOT"]."/divcss/model/{$class_name}.class.php";
		if( file_exists($controlpath) ){
			require_once $controlpath;
			//hc($controlpath);
		}else if( file_exists($modelpath) ){
			require_once $modelpath;
			//hc($modelpath);
		}else{
			hc("无法找到需要引入的类文件".$class_name);
		}
	}
	
	function show( $filename ) {
		$filepath = $_SERVER["DOCUMENT_ROOT"] . VIEW_PATH . $filename;
		echo file_get_contents($filepath);
		exit();
	}
	
	function hc( $val ){
		var_dump($val);
		exit;
	}
