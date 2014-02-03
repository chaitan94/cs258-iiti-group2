<?php
include_once('models/database.php');
class Tender extends DB{
	public $id;
	public $name;
	function __construct($id=0){
		parent::__construct();
		if($id){
			$this->id = $id;
			$st = $this->prepare("SELECT * FROM tenders WHERE id=?;");
			$st->execute(array($id));
			$r = $st->fetch(PDO::FETCH_ASSOC);
			$this->name = $r['name'];
		}
	}
	function insert($a,$b){
		$st = $this->prepare("INSERT INTO tenders VALUES(?,?);");
		$st->execute();
	}
	function isAppliedBy($uid){
		$r = $this->prepare("SELECT * FROM tender_user WHERE tenderid=? AND userid=?;");
		$r->execute(array($this->id,$uid));
		return $r->rowCount();
	}
	function getApplicants(){
		$r = $this->prepare("SELECT users.name, tu.userid FROM tender_user as tu INNER JOIN users WHERE tu.tenderid=? AND tu.userid=users.id;");
		$r->execute(array($this->id));
		return $r->fetchAll(PDO::FETCH_ASSOC);
	}
	function getAll(){
		$r = $this->query("SELECT * FROM tenders");
		return $r->fetchAll(PDO::FETCH_ASSOC);
	}
}
?>