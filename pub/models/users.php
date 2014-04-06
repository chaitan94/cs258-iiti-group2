<?php
include_once('models/database.php');
/**
 * Handles database request related to a user.
 */
class User extends DB{
	public $id;
	public $name;
	public $pass;
	public $email;
	public $phone;
	public $type;
	public function __construct($id=0){
		parent::__construct();
		if($id){
			$this->id = $id;
			$r = $this->getOne($id);
			if($r != false){
				$this->name = $r->name;
				$this->email = $r->email;
				$this->phone = $r->phone;
				$this->type = $r->type;
			}else{
				$this->id = 0;
			}
		}
	}
	public function getOne($id){
		$st = $this->executeQuery("SELECT * FROM users WHERE id=?;",array($id));
        return($st->fetchObject());
	}
	public function getAll($id){
		$st = $this->executeQuery("SELECT * FROM users;",array($id));
        return($st->fetch(PDO::FETCH_OBJ));
	}
	public function insert($u){
		$st = $this->executeQuery("SELECT id FROM users WHERE email=?;",array($u['email']));
		if(!$st->rowCount()){
			include_once('vendor/ircmaxell/password-compat/lib/password.php');
			$st=$this->db->prepare("INSERT INTO users(name,pass,email,phone,type) VALUES(?,?,?,?,?);");
			if($st->execute(array($u['name'],
								password_hash($u['pass'],PASSWORD_BCRYPT),
								$u['email'],
								$u['phone'],
								$u['type'])))
				return $this->db->lastInsertId();
			else return 0;
		} else return -1;
	}
	public function getTenders(){
		$r = $this->executeQuery("SELECT tu.id, tenders.title, tu.tenderid FROM tender_user as tu INNER JOIN tenders WHERE tu.userid=? AND tu.tenderid=tenders.id;",array($this->id));
		if($r) return $r->fetchAll(PDO::FETCH_OBJ);
		else return false;
	}
	public function getOwnedTenders(){
		$r = $this->executeQuery("SELECT title, id FROM tenders WHERE ownerid=?;",array($this->id));
		if($r) return $r->fetchAll(PDO::FETCH_OBJ);
		else return false;
	}
	public function verify($email,$pass){
		include_once('vendor/ircmaxell/password-compat/lib/password.php');
		$st=$this->executeQuery("SELECT id,pass FROM users WHERE email=?;",array($email));
		if($r = $st->fetch(PDO::FETCH_ASSOC)){
			if(password_verify($pass,$r['pass'])){
				$_SESSION['id']=$r['id'];
				return 1;
			}else return 0;
		}else return -1;
	}
}
?>
