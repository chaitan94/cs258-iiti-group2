<?php
include('models/database.php');
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
	function getAll(){
		$r = $this->query("SELECT * FROM tenders");
		return $r->fetchAll(PDO::FETCH_ASSOC);
	}
}
?>