<?php
//SVC
 
//include_once('CopytttInterface.php');
include_once('copytttDao.php');
//class CopytttService implements CopytttInterface
class copytttService 
{
	private $DAO;
	private $DB;
	//생성자
	function __construct(){
		alog("CopytttService-__construct");

		$this->DAO = new copytttDao();
	}
	//파괴자
	function __destruct(){
		alog("CopytttService-__destruct");

		unset($this->DAO);
		unset($this->DB);
	}
	function __toString(){
		alog("CopytttService-__toString");
	}
}
                                                             
?>
