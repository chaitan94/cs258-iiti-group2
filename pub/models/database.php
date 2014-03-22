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
		try{
			$this->db = new PDO("mysql:dbname=".$this->dbname.";host=".$this->dbhost,$this->dbuser,$this->dbpass);
		}catch(Exception $e){
			die("Error connecting to database.<br>Are sure your database is initialized?<br>Try opening <a href='/install.php'>/install.php</a>");
		}
	}
    public function executeQuery($query,$data = null){
        $st = $this->db->prepare($query);
        if($st->execute($data))
	        return $st;
	    else return false;
    }
}
?>
