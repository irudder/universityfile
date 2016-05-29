<?php
	require_once $_SERVER["DOCUMENT_ROOT"]."/divcss/smarty/libs/Smarty.class.php";
	require_once $_SERVER["DOCUMENT_ROOT"]."/divcss/control/common.php";
	//避免samrty中有自动加载函数的影响，此处需要增加一个函数注册一个自动加载的函数
	spl_autoload_register("__autoload");
	$initc = new InitControl();
	$initc->init( 'Admin|goAdmin' );

