<?php
//DAO
 
class loginDao
{
	function __construct(){
		global $log;
		$log->info("LoginDao-__construct");
	}
	function __destruct(){
		global $log;
		$log->info("LoginDao-__destruct");
	}
	function __toString(){
		global $log;
		$log->info("LoginDao-__toString");
	}
	//getUsr    
	public function getUsr($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLID"] = "getUsr";
		$RtnVal["SQLTXT"] = "SELECT USR_SEQ, USR_ID, USR_NM, '--Hashed--' as USR_PWD 
FROM CMN_USR 
WHERE USE_YN = 'Y' and USR_ID = #{G1-USR_ID} and USR_PWD = #{G1-USR_PWD}";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "ss";
		return $RtnVal;
    }  
	//uprUsr    
	public function updUsr($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLID"] = "updUsr";
		$RtnVal["SQLTXT"] = "update CMN_USR set
	USR_PWD = #{G2-USR_PWD}
where USR_SEQ = #{G2-USR_SEQ}";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "ss";
		return $RtnVal;
    }  
}
                                                             
?>