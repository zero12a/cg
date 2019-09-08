<?php
//DAO
 
class pisvcDao
{
	function __construct(){
		alog("PisvcDao-__construct");
	}
	function __destruct(){
		alog("PisvcDao-__destruct");
	}
	function __toString(){
		alog("PisvcDao-__toString");
	}
	//selSvcF    
	public function selSvcF($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLID"] = "selSvcF";
		$RtnVal["SQLTXT"] = "";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "iiiii";
		return $RtnVal;
    }  
	//selSvcG    
	public function selSvcG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLID"] = "selSvcG";
		$RtnVal["SQLTXT"] = "sdfsdfsfsfsfsfd";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "iiii";
		return $RtnVal;
    }  
}
                                                             
?>