<?php
class DB extends PDO{
	private static $current;
	function __construct(){
		// new PDO(dsn, username, passwd, options)
		// parent::__construct("sqlite:data/data.db");
		
		$dbhost='localhost';
		$dbname='eprocdb';
		$dbuser='root';
		$dbpass='';
		// $dbhost='mysql8.000webhost.com';
		// $dbname='a9061174_db';
		// $dbuser='a9061174_db';
		// $dbpass='BKChere!!1';
		parent::__construct("mysql:dbname=$dbname;host=$dbhost",$dbuser,$dbpass);
	}
}
?>
