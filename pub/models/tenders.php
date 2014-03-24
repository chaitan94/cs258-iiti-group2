<?php
include_once('models/database.php');
/**
 * Handles database request related to a tender.
 */
class Tender extends DB{
	public $id;
	public $title;
	public $brief;
	public $emd;
	public $category;
	public $closedate;
	public $closetime;
	public $startdate;
	public $starttime;
	public $ownerid;
	public $open;
	public function __construct($id=0){
		parent::__construct();
		if($id){
			$this->id = $id;
			$r = $this->getOne($id);
			$this->title = $r->title;
			$this->brief = $r->brief;
			$this->emd = $r->emd;
			$this->category = $r->category;
			$this->closedate = $r->closedate;
			$this->closetime = $r->closetime;
			$this->startdate = $r->startdate;
			$this->starttime = $r->starttime;
			$this->ownerid = $r->ownerid;
			$this->open = $r->open;
		}
	}
	public function getOne($id){
		$st = $this->executeQuery("SELECT * FROM tenders WHERE id=?;",array($id));
        return($st->fetchObject());
	}
	public function getAll(){
		$r = $this->db->query("SELECT * FROM tenders");
		return $r->fetchAll(PDO::FETCH_OBJ);
	}
	public function insert($t){
		$st = $this->executeQuery("INSERT INTO tenders(title,brief,emd,category,closedate,closetime,startdate,starttime,ownerid) 
			VALUES(?,?,?,?,?,?,?,?,?);",
			array($t['title'],$t['brief'],$t['emd'],$t['category'],$t['closedate'],$t['closetime'],$t['startdate'],$t['starttime'],$_SESSION['id']));
		if($st) return true;
		else return false;
	}
	public function isAppliedBy($uid){
		$r = $this->executeQuery("SELECT * FROM tender_user WHERE tenderid=? AND userid=?;",array($this->id,$uid));
		return $r->rowCount();
	}
	public function getApplicants(){
		$r = $this->executeQuery("SELECT users.name, tu.userid FROM tender_user as tu INNER JOIN users WHERE tu.tenderid=? AND tu.userid=users.id;",array($this->id));
		if($r) return $r->fetchAll(PDO::FETCH_OBJ);
		else return false;
	}
	public function getTendersByOwner($owner){
		$r=$this->executeQuery("SELECT title FROM tenders WHERE ownerid = ? AND open= 'true';",array($owner));
		return $r->fetchAll(PDO::FETCH_OBJ);
	}
}
?>
