<?php
	abstract class control{
		public function createSmarty(){
			//var_dump($_SERVER["DOCUMENT_ROOT"].'divcss/samrty/trmplates/templates/');exit();
			$smarty = new Smarty();
			//var_dump($smarty);
			//exit;
			//模版文件目录，
			$smarty->template_dir = $_SERVER["DOCUMENT_ROOT"].'divcss/views/admin/';
			//生成的php文件目录
			$smarty->compile_dir  = $_SERVER["DOCUMENT_ROOT"].'divcss/views_c';
			$smarty->config_dir   = $_SERVER["DOCUMENT_ROOT"].'divcss/configs/';
			$smarty->cache_dir    = $_SERVER["DOCUMENT_ROOT"].'divcss/cache/';
			$smarty->left_delimiter		=	'<{';
			$smarty->right_delimiter	=	'}>';
			//var_dump($smarty);
			return $smarty;
		}
		
	}
	