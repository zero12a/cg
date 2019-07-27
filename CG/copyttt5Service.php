<?php
//SVC
 
//include_once('Copyttt5Interface.php');
include_once('copyttt5Dao.php');
//class Copyttt5Service implements Copyttt5Interface
class copyttt5Service 
{
	private $DAO;
	private $DB;
	//생성자
	function __construct(){
		alog("Copyttt5Service-__construct");

		$this->DAO = new copyttt5Dao();
	    //$this->DB = db_s_open();
		$this->DB["CG"] = db_obj_open(getDbSvrInfo("CG"));
	}
	//파괴자
	function __destruct(){
		alog("Copyttt5Service-__destruct");

		unset($this->DAO);
		if($this->DB["CG"])$this->DB["CG"]->close();
		unset($this->DB);
	}
	function __toString(){
		alog("Copyttt5Service-__toString");
	}
}
                                                             
?>
