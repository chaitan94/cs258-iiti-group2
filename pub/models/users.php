<?php
include_once('models/database.php');
class User extends DB{
	public $id;
	public $name;
	public $pass;
	public $email;
	public $phone;
	public $type;
	function __construct($id=0){
		parent::__construct();
		if($id){
			$this->id = $id;
			$st = $this->prepare("SELECT * FROM users WHERE id=?;");
			$st->execute(array($id));
			$r = $st->fetch(PDO::FETCH_ASSOC);
			$this->name = $r['name'];
			$this->email = $r['email'];
			$this->phone = $r['phone'];
			$this->type = $r['type'];
		}
	}
	function insert($u){
		$st=$this->prepare("INSERT INTO users(name,pass,email,phone,type) VALUES(?,?,?,?,?);");
		$st->execute(array($u['name'],
							$u['pass'],
							$u['email'],
							$u['phone'],
							$u['type']));
	}
	function getTenders(){
		$r = $this->prepare("SELECT tenders.name, tu.tenderid FROM tender_user as tu INNER JOIN tenders WHERE tu.userid=? AND tu.tenderid=tenders.id;");
		$r->execute(array($this->id));
		return $r->fetchAll(PDO::FETCH_ASSOC);
	}
	function verify($email,$pass){
		$st=$this->prepare("SELECT * FROM users WHERE email=?;");
		$st->execute(array($email));
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