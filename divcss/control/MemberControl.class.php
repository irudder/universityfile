<?php
	class MemberControl{
		
		/*
		 * 去登录页面
		 */
		public function gologin(){
			show("login.html");
		}
		/*
		 * 去注册页面
		 */
		public function goregist(){
			show("regist.html");
		}

		/*
		 * 处理登录页面
		 */
		function login() {
			$cus = new CustomerOper();
			
			$ret = $cus->login();
			if( $ret ) {
				$_SESSION["cus"] = $ret;
				
				echo "true";
			} else {
				echo "false";
			}
		}
		/*
		 * 处理注册页面
		 */
		function regist() {
			$c = new CustomerOper();
			
			$retarr = array();
			if( $c->regist() ){
				$retarr["code"] = "succ";
				$retarr["info"] = "注册成功!";
			} else {
				$retarr["code"] = "error";
				$retarr["info"] = "注册失败!";
			}
			
			echo json_encode($retarr);
		}
		/*
		 * 检查用户名是否重复
		 */
		function checkName() {
			$c = new CustomerOper();
			$retarr = array();
			if( $c->checkUserName() ) {
				$retarr["code"] = "succ";
				$retarr["info"] = "用户名可用!";
			} else {
				$retarr["code"] = "error";
				$retarr["info"] = "用户名重复!";
			}
			echo json_encode($retarr);
		}
	}
