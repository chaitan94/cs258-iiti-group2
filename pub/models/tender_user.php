<?php
include_once('models/database.php');
/**
 * Handles database request related to a tender applications by users.
 */
class TenderUser extends DB{
	public $id;
	public $tenderid;
	public $userid;
	function __construct($id=0){
		parent::__construct();
		if($id){
			$this->id = $id;
			$r = $this->getOne($id);
			$this->userid = $r->userid;
			$this->tenderid = $r->tenderid;
		}
	}
	public function getOne($id){
		$st = $this->executeQuery("SELECT * FROM tender_user WHERE id=?;",array($id));
        return($st->fetchObject());
	}
	public function getAll(){
		$r = $this->db->query("SELECT * FROM tender_user");
		return $r->fetchAll(PDO::FETCH_OBJ);
	}
	public function getUserDetails(){
		if($this->id){
			include_once('models/users.php');
			return new User($this->userid);
		}else return false;
	}
	public function getTenderDetails(){
		if($this->id){
			include_once('models/tenders.php');
			return new Tender($this->tenderid);
		}else return false;
	}
	function insert($a, $b, $soq, $q){
		$st = $this->db->prepare("SELECT id FROM tender_user WHERE tenderid=? AND userid=?;");
		$st->execute(array($a,$b));
		if(!$st->rowCount()){
			$st = $this->db->prepare("INSERT INTO tender_user(tenderid,userid) VALUES(?,?);");
			$st->execute(array($a,$b));
			$this->id=$this->db->lastInsertId();
			$this->userid=$b;
			$this->tenderid=$a;

            mkdir("data/tender_applications/$this->id");
	        $soqjson = fopen("data/tender_applications/$this->id/soq_response.json", "w");
	        fwrite($soqjson, $soq);
	        fclose($soqjson);

	        $qjson = fopen("data/tender_applications/$this->id/questionnaire_response.json", "w");
	        fwrite($qjson, $q);
	        fclose($qjson);
		}
	}
}
?>
