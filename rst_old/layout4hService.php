<?php
//SVC
 
//include_once('Layout4hInterface.php');
include_once('layout4hDao.php');
//class Layout4hService implements Layout4hInterface
class layout4hService 
{
	private $DAO;
	private $DB;
	//생성자
	function __construct(){
		alog("Layout4hService-__construct");

		$this->DAO = new layout4hDao();
	}
	//파괴자
	function __destruct(){
		alog("Layout4hService-__destruct");

		unset($this->DAO);
		unset($this->DB);
	}
	function __toString(){
		alog("Layout4hService-__toString");
	}
}
                                                             
?>
