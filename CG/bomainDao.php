<?php
//DAO
 
class bomainDao
{
	function __construct(){
		global $log;
		$log->info("BomainDao-__construct");
	}
	function __destruct(){
		global $log;
		$log->info("BomainDao-__destruct");
	}
	function __toString(){
		global $log;
		$log->info("BomainDao-__toString");
	}
	//API찾기    
	public function apiSearch($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "";
		$RtnVal["SQLID"] = "apiSearch";
		$RtnVal["SQLTXT"] = "	SELECT * FROM APP_API";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
	//업뎃    
	public function updGood($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SVRID"] = "";
		$RtnVal["SQLID"] = "updGood";
		$RtnVal["SQLTXT"] = "";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
}
                                                             
?>