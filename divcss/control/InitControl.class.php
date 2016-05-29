<?php
	class InitControl{
		public function init( $index ){
			$oper = $index;
			if( !empty( $_REQUEST['oper']) ){
				$oper = $_REQUEST['oper'];
			}
			//将传入的字符串进行分割得到类名和方法名
			$arr = explode('|', $oper);
			//hc($arr);
			
			//将得到的类首个单词进行首字母大写化，同时增加Control得到类名
			$classname = ucfirst($arr[0])."Control";
			//得到方法名
			$methodname = $arr[1];
			//echo $classname;
			//判断是否存在该类（通过判断是否有该类文件）
			if( file_exists($_SERVER['DOCUMENT_ROOT']."/divcss/control/{$classname}.class.php") ){
				$obj = new $classname();
				if( method_exists($obj, $methodname) ){
					$obj->$methodname();
				}else{
					echo "无此方法";
					exit;
				}
				
			}else{
				hc('不存在该类文件');
				header ( "HTTP/1.0 404 Not Found" );
			}
		}
		
		
	}
	