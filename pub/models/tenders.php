<?php
include_once('models/database.php');
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
		$st = $this->db->prepare("INSERT INTO tenders(title,brief,emd,category,closedate,closetime,startdate,starttime) VALUES(?,?,?,?,?,?,?,?);");
		$st->execute(array($t['title'],$t['brief'],$t['emd'],$t['category'],$t['closedate'],$t['closetime'],$t['startdate'],$t['starttime']));
		var_dump($t);
		return 1;
	}
	public function isAppliedBy($uid){
		$r = $this->db->prepare("SELECT * FROM tender_user WHERE tenderid=? AND userid=?;");
		$r->execute(array($this->id,$uid));
		return $r->rowCount();
	}
	public function getApplicants(){
		$r = $this->db->prepare("SELECT users.name, tu.userid FROM tender_user as tu INNER JOIN users WHERE tu.tenderid=? AND tu.userid=users.id;");
		$r->execute(array($this->id));
		return $r->fetchAll(PDO::FETCH_OBJ);
	}
}
?>