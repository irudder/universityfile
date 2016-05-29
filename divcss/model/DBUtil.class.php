<?php
	/**
	 * 单例模式创建数据连接，析构关闭数据库连接
	 */
	class DBUtil {
		const DBHOST='127.0.0.1';
		const DBPORT='3306';
		const DBUSER='root';
		const DBPWD='';
		const DB='divcss';
		
		private static $conn; //保存数据连接
		private static $obj;  //保存一个DBUtil对象
		
		public static function getConn() {
			if( !isset(self::$obj) ) {
				self::$obj = new DBUtil();
			}
			
			return self::$conn;
		}
		
		private function __construct() {
			self::$conn = new  PDO ( "mysql:dbname=".DBUtil::DB.";host=".DBUtil::DBHOST,DBUtil::DBUSER, DBUtil::DBPWD);
			//mysql_query("set names utf8",self::$conn);
			self::$conn->exec('set names utf8');
		}
		
		private function __clone() {
			
		}
		
		public function __destruct() {
			//mysql_close(self::$conn);
			self::$conn=null;
		}
	}