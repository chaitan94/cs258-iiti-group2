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
		$st = $this->executeQuery("SELECT * FROM tenders WHERE id=?;", array($id));
        return($st->fetchObject());
	}
	public function getAll(){
		$r = $this->db->query("SELECT * FROM tenders");
		return $r->fetchAll(PDO::FETCH_OBJ);
	}
	public function getCount(){
		$r = $this->db->query("SELECT COUNT(id) FROM tenders;");
		return intval($r->fetch()[0]);
	}
	public function getRecent($num=10, $offset=0){
		$r = $this->db->query("SELECT * FROM tenders ORDER BY timestamp DESC LIMIT $num OFFSET $offset;");
		if($r) return $r->fetchAll(PDO::FETCH_OBJ);
		else return false;
	}
	public function getSOQ(){
		if(file_exists("data/tenders/$this->id/soq.json")){
			$f = fopen("data/tenders/$this->id/soq.json", "r");
			$soq = json_decode(fread($f, 1000));
			fclose($f);
			return $soq;
		}else return false;
	}
	public function getQuestionnaire(){
		if(file_exists("data/tenders/$this->id/questionnaire.json")){
			$f = fopen("data/tenders/$this->id/questionnaire.json", "r");
			$questionnaire = json_decode(fread($f, 1000));
			fclose($f);
			return $questionnaire;
		}else return false;
	}
	public function getSearchResults($terms, $num=10, $offset=0){
		foreach ($terms as $key => $keyword)
			$terms[$key] = preg_replace('/[^A-Za-z0-9\-]/', '', $keyword);
		$like = implode($terms, "%' OR title LIKE '%");
		$r = $this->db->query("SELECT * FROM tenders WHERE title LIKE '%$like%' ORDER BY timestamp DESC");
		return $r->fetchAll(PDO::FETCH_OBJ);
	}
	public function insert($t, $f){
        $st = $this->executeQuery("INSERT INTO tenders(title, brief, emd, category, closedate, closetime, startdate, starttime, ownerid)
			VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?);",
			array($t['title'], $t['brief'], $t['emd'], $t['category'], $t['closedate'], $t['closetime'], $t['startdate'], $t['starttime'], $_SESSION['id']));
        if($st) {
            $id = $this->db->lastInsertId();
            mkdir("data/tenders/$id");

            $soqjson = fopen("data/tenders/$id/soq.json", "w");
            fwrite($soqjson, $t['itemsjson']);
            fclose($soqjson);
            
            $qjson = fopen("data/tenders/$id/questionnaire.json", "w");
            fwrite($qjson, $t['questionnairejson']);
            fclose($qjson);
            
            move_uploaded_file($f['NIT']['tmp_name'], "data/tenders/$id/NIT.pdf");
            move_uploaded_file($f['tenderdoc']['tmp_name'], "data/tenders/$id/tenderdoc.pdf");
            return true;
        } else return false;
	}
	public function isAppliedBy($uid){
		$r = $this->executeQuery("SELECT * FROM tender_user WHERE tenderid=? AND userid=?;", array($this->id, $uid));
		return $r->rowCount();
	}
	public function getApplicants(){
		$r = $this->executeQuery("SELECT users.name, tu.id, tu.userid, tu.score FROM tender_user as tu INNER JOIN users WHERE tu.tenderid=? AND tu.userid=users.id ORDER BY tu.score DESC;", array($this->id));
		if($r) return $r->fetchAll(PDO::FETCH_OBJ);
		else return false;
	}
	public function getTendersByOwner($owner){
		$r=$this->executeQuery("SELECT * FROM tenders WHERE ownerid = ? AND open = 'true';", array($owner));
		if($r) return $r->fetchAll(PDO::FETCH_OBJ);
		else return false;
	}
}
?>
