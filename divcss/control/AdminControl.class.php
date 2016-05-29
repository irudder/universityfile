<?php
	class AdminControl extends control{
		/*
		 * 去后台index页面
		 */
		public function goAdmin() {
			//checkLogin();

			$smart = $this->createSmarty();
			//$smart = new Smarty();
			$smart->display("adminIndex.html");
			//show("admin/adminIndex.html");
			
		}
		
		/*
		 * 去后台的用户管理页面
		 */
		public function usermanage(){
			
			
			$smart = $this->createSmarty();
			$pagecur =1;
			if( !empty($_POST['pagecur']) ){
				$pagecur = $_POST['pagecur'];
				//hc($pagecur);
			}
			$pagecount =5;
			$data = new CustomerOper();
			//当前页-1*每页查询的数据=查询的起点
			$info = $data->getuserdata( ($pagecur-1)*$pagecount,$pagecount );
			$count = ceil($info['count']/$pagecount);
			//var_dump($info);exit;
			//查询的总条数/分页数据=总页数
			$smart->assign('count',$count);
			$smart->assign("curpage",$pagecur);
			//查询的记录
			$smart->assign('info',$info['temp']);
			//$smart = new Smarty();
			$smart->display("usermanage.html");
		}
		
		//用户管理中的删除用户
		public function deluser(){
			if( isset($_POST['uid']) ){
				$deldata = new CustomerOper();
				$res = $deldata->deldata($_POST['uid']);
				$arr = array();
				if($res){
					$arr['code']=1;
				}else{
					$arr['code']=0;
					$arr['message']="删除失败";
				}
				echo json_encode($arr);
			}else{
				hc("传参出错啦");
			}
		}
		//修改用户数据
		public function userModify(){
			$smart = $this->createSmarty();
			$oper = new CustomerOper();
			if( isset($_POST['uid']) ){
				$userdata = $oper->getOneUser($_POST['uid']);
				//hc($userdata);
				$smart->assign('udata',$userdata[0]);	
			}
			if( isset($_POST['modify']) ){
				//echo 1;
				//hc($_POST['uid']);
				if($oper->modifydata($_POST['uid'])){
					//echo "true";
					$this->usermanage();
					exit();
				}else{
					return false;
				}
			}
			
			$smart ->display('userModify.html');
		}
		
	}
