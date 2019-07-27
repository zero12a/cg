<?php
//SVC
 
//include_once('Copyttt2Interface.php');
include_once('copyttt2Dao.php');
//class Copyttt2Service implements Copyttt2Interface
class copyttt2Service 
{
	private $DAO;
	private $DB;
	//생성자
	function __construct(){
		alog("Copyttt2Service-__construct");

		$this->DAO = new copyttt2Dao();
	}
	//파괴자
	function __destruct(){
		alog("Copyttt2Service-__destruct");

		unset($this->DAO);
		unset($this->DB);
	}
	function __toString(){
		alog("Copyttt2Service-__toString");
	}
}
                                                             
?>
