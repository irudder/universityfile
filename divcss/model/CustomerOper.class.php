<?php
	class CustomerOper {
		public function regist() {
			try {
				$conn = DBUtil::getConn();
				$sql = "insert into customer values(default,?,?,?,?,?,?,?,?,?,?)";
				$param[]="{$_POST["username"]}";
				$param[]="{$_POST["truename"]}";
				$param[]="{$_POST["pwd"]}";
				$param[]="{$_POST["sex"]}";
				$param[]="{$_POST["birthdy"]}";
				$param[]="{$_POST["personcard"]}";
				$param[]="{$_POST["email"]}";
				$param[]="{$_POST["mobile"]}";
				$param[]="{$_POST["address"]}";
				$param[]=now();
				
				$pre = $conn->prepare($sql);
				$pre->execute($param);
				//判断这条语句是否执行成功
				if($pre->rowCount()==1 ) {
					return true;
				} else {
					return false;
				}
			}catch(Exception $e) {
				print_r(mysql_error());
				exit();
			}
		}
		
		/**
		 * 检测用户名是否可用
		 * 要用返回true,不可用返回false
		 */
		public function checkUserName() {
			try {
				//连接数据
				$con = DBUtil::getConn();
				
				//执行sql语句
				$sql = "select count(*) from customer c where c.cname = '{$_POST["username"]}'";
				$rs = mysql_query($sql);
				
				//获取结果集中数据
				$retarr = array();
				$row = mysql_fetch_array($rs);
				
				//关闭结果集
				mysql_free_result($rs);
				
				if( $row[0] == 0 ) {
					return true;
				} else {
					return false;
				}
			}catch(Exception $e) {
				print_r(mysql_error());
				exit();
			}
		}	
	
		/**
		 * 登录方法
		 */
		public function login() {
			try{
				$conn = DBUtil::getConn();
				
				$sql = "select * from customer where cname = '{$_POST["username"]}' and pwd = '{$_POST["pwd"]}'";
				$rs = mysql_query($sql, $conn);
			
				return mysql_fetch_array($rs);
			}catch(Exception $e) {
				print_r(mysql_error());
				exit();
			}
		}
		
		//获取用户数据
		public function getuserdata( $pagestart, $page ){
			try{
				$conn = DBUtil::getConn();
				
				$param = array();
				//获取当前页的数据
				$sql = "select * from customer where 1=1";
				//组合查询
				if( !empty($_POST['cname'])){
					//hc($_POST['cname']);
					$sql = $sql." and cname like ? ";
					$param[] = "%{$_POST["cname"]}%";
				}
				if( !empty($_POST["email"]) ) {
					$sql = $sql . " and email like ? ";
					$param[] = "%{$_POST["email"]}%";
				}
				
				if( !empty($_POST["phone"]) ) {
					$sql = $sql . " and mobile like ?";
					$param[] = "%{$_POST["phone"]}%";
				}
				
				if( !empty($_POST["starttime"]) && !empty($_POST["endtime"])) {
					$sql = $sql . " and (reday > ? and reday <? )";
					$param[] = "%{$_POST["starttime"]}%";
					$param[] = "%{$_POST["endtime"]}%";
				} else if( !empty($_POST["starttime"]) && empty($_POST["endtime"]) ) {
					$sql = $sql . " and reday > ?";
					$param[] = "%{$_POST["starttime"]}%";
				} else if( empty($_POST["starttime"]) && !empty($_POST["endtime"]) ) {
					$sql = $sql . " and reday < ?";
					$param[] = "%{$_POST["endtime"]}%";
				}
				
				//分页修改为有查询内容的查询
				$countsql = "select count(*) from ({$sql}) as t";
				$pre = $conn->prepare($countsql);
				$pre->execute($param);
				$arr = $pre->fetchAll();
				$count = $arr[0][0];
				
				$sql = $sql." limit {$pagestart},{$page} ";
				//hc($sql);
				
				$pre = $conn->prepare($sql);
				$pre->execute($param);
				$temp = $pre->fetchAll();
				
				$res = array('count'=>$count,'temp'=>$temp);
				return $res;
			}catch(exception $e) {
				print_r($conn->errorInfo());
				exit();
			}
		}
		//删除指定用户
		public function deldata( $uid ){
			try{
				//hc($uid);
				$conn = DBUtil::getConn();
				$uid=mysql_escape_string($uid);
				$sql = "delete from customer where id in ({$uid})";
				//$param=array("({$uid})");
				//pdo不支持批量删除
				$pre = $conn->prepare($sql);
				$pre->execute();
				
				
				if( $pre->rowCount()>=1 ){
					return true;
				}else{
					return false;
				}
				
			}catch( exception $e){
				print_r($conn->errorInfo());
				exit();
			}
		}
		//修改指定用户
		public function modifydata( $uid ){
			try{
				$conn = DBUtil::getConn();
				$param = array();
				$sql = "update customer set cname=?,turename=?,sex=?,birthday=?,idcard=?,
				email=?,mobile=?,address=? where id=?";
				$param[]="{$_POST["username"]}";
				$param[]="{$_POST["truename"]}";
				$param[]="{$_POST["sex"]}";
				$param[]="{$_POST["birthdy"]}";
				$param[]="{$_POST["personcard"]}";
				$param[]="{$_POST["email"]}";
				$param[]="{$_POST["mobile"]}";
				$param[]="{$_POST["address"]}";
				$param[]="{$uid}";
				//hc($sql);
				$pre = $conn->prepare($sql);
				$pre->execute($param);

				if( $pre->rowCount()==1 ){
					return true;
				}else{
					return false;
				}
				
			}catch(exception $e){
				print_r($conn->errorInfo());
				exit();
			}
		}
		//获取指定用户数据
		public function getOneUser( $uid ){
			try{
				$conn = DBUtil::getConn();
				$sql = "select * from customer where id=?";
				$param[]="{$uid}";
				$pre = $conn->prepare($sql);
				$pre->execute($param);
				$temp = $pre->fetchAll();
				
				return $temp;
			}catch(exception $e){
				print_r($conn->errorInfo());
				exit();
			}
		}
	}