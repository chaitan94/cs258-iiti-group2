<?php
include_once('models/database.php');
class User extends DB{
	public $id;
	public $name;
	public $pass;
	function __construct($id=0){
		parent::__construct();
		if($id){
			$this->id = $id;
			$st = $this->prepare("SELECT * FROM users WHERE id=?;");
			$st->execute(array($id));
			$r = $st->fetch(PDO::FETCH_ASSOC);
			$this->name = $r['name'];
		}
	}
	function insert($user,$pass){
		$st=$this->prepare("INSERT INTO users(name,pass) VALUES(?,?);");
		$st->bindParam(1,$user);
		$st->bindParam(2,$pass);
		$st->execute();
	}
	function verify($user,$pass){
		$st=$this->prepare("SELECT * FROM users WHERE name=?;");
		$st->execute(array($user));
		if($r = $st->fetch(PDO::FETCH_ASSOC)){
			if($r['pass']==$pass){
				session_start();
				$_SESSION['id']=$r['id'];
				return 1;
			}else return 0;
		}else return -1;
	}
}
?>