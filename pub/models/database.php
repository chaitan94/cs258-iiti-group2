<?php
/**
 * Common class for all the other models.
 * Contains information about database.
 */
class DB{
	public $db;
	protected $dbhost='localhost';
	protected $dbname='eprocdb';
	protected $dbuser='root';
	protected $dbpass='';
	public function __construct(){
		$this->db = new PDO("mysql:dbname=".$this->dbname.";host=".$this->dbhost,$this->dbuser,$this->dbpass);
	}
    public function executeQuery($query,$data = null){
        $st = $this->db->prepare($query);
        $st->execute($data);
        return $st;
    }
}
?>
