<?php
include_once('models/database.php');
class TenderUser extends DB{
	public $id;
	public $tenderid;
	public $userid;
	function __construct($id=0){
		parent::__construct();
		if($id){
			$this->id = $id;
			$st = $this->prepare("SELECT * FROM tender_user WHERE id=?;");
			$st->execute(array($id));
			$r = $st->fetch(PDO::FETCH_ASSOC);
			$this->userid = $r['userid'];
			$this->tenderid = $r['tenderid'];
		}
	}
	function insert($a,$b){
		$st = $this->prepare("SELECT id FROM tender_user WHERE tenderid=? AND userid=?;");
		$st->execute(array($a,$b));
		if($st->rowCount()){}else{
			$st = $this->prepare("INSERT INTO tender_user(tenderid,userid) VALUES(?,?);");
			$st->execute(array($a,$b));
			$this->id=$this->lastInsertId();
			$this->userid=$b;
			$this->tenderid=$a;
		}
	}
	function getAll(){
		$r = $this->query("SELECT * FROM tender_user");
		return $r->fetchAll(PDO::FETCH_ASSOC);
	}
}
?>