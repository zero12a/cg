<?php
//SVC
 
//include_once('Copyttt3Interface.php');
include_once('copyttt3Dao.php');
//class Copyttt3Service implements Copyttt3Interface
class copyttt3Service 
{
	private $DAO;
	private $DB;
	//생성자
	function __construct(){
		alog("Copyttt3Service-__construct");

		$this->DAO = new copyttt3Dao();
	}
	//파괴자
	function __destruct(){
		alog("Copyttt3Service-__destruct");

		unset($this->DAO);
		unset($this->DB);
	}
	function __toString(){
		alog("Copyttt3Service-__toString");
	}
}
                                                             
?>
