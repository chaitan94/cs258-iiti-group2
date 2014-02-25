<?php
class DB{
	public $db;
	protected $dbhost='localhost';
	protected $dbname='eprocdb';
	protected $dbuser='root';
	protected $dbpass='';
	// protected $dbhost='mysql8.000webhost.com';
	// protected $dbname='a9061174_db';
	// protected $dbuser='a9061174_db';
	// protected $dbpass='BKChere!!1';
	public function __construct(){
		// new PDO(dsn, username, passwd, options)
		// parent::__construct("sqlite:data/data.db");
		
		$this->db = new PDO("mysql:dbname=".$this->dbname.";host=".$this->dbhost,$this->dbuser,$this->dbpass);
	}
    public function executeQuery($query,$data = null){
        $st = $this->db->prepare($query);
        $st->execute($data);
        return $st;
    }
}
?>
