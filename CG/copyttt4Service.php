<?php
//SVC
 
//include_once('Copyttt4Interface.php');
include_once('copyttt4Dao.php');
//class Copyttt4Service implements Copyttt4Interface
class copyttt4Service 
{
	private $DAO;
	private $DB;
	//생성자
	function __construct(){
		alog("Copyttt4Service-__construct");

		$this->DAO = new copyttt4Dao();
	}
	//파괴자
	function __destruct(){
		alog("Copyttt4Service-__destruct");

		unset($this->DAO);
		unset($this->DB);
	}
	function __toString(){
		alog("Copyttt4Service-__toString");
	}
}
                                                             
?>
