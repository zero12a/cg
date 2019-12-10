<?php
//DAO
 
class bomainDao
{
	function __construct(){
		alog("BomainDao-__construct");
	}
	function __destruct(){
		alog("BomainDao-__destruct");
	}
	function __toString(){
		alog("BomainDao-__toString");
	}
	//API찾기    
	public function apiSearch($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "";
		$RtnVal["SQLTXT"] = "	SELECT * FROM APP_API";
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
}
                                                             
?>