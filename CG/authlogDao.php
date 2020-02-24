<?php
//DAO
 
class authlogDao
{
	function __construct(){
		global $log;
		$log->info("AuthlogDao-__construct");
	}
	function __destruct(){
		global $log;
		$log->info("AuthlogDao-__destruct");
	}
	function __toString(){
		global $log;
		$log->info("AuthlogDao-__toString");
	}
	//sAuthG    
	public function sAuthG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "OS";
		$RtnVal["SQLID"] = "sAuthG";
		$RtnVal["SQLTXT"] = "select
	LAUTH_SEQ, REQ_TOKEN, RES_TOKEN, USR_SEQ, USR_ID
	, PGMID, AUTH_ID, SUCCESS_YN, ADD_DT
from
	CMN_LOG_AUTH
order by LAUTH_SEQ desc
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
	//sAughdF    
	public function sAuthdF($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "OS";
		$RtnVal["SQLID"] = "sAuthdF";
		$RtnVal["SQLTXT"] = "select
	LAUTHD_SEQ, REQ_TOKEN, RES_TOKEN, LAUTH_SEQ, PREPARE_SQL
	,FULL_SQL, PARAM_COLIDS, DD_COLIDS, PI_IN_COLIDS, PI_OUT_COLIDS
	, ROW_CNT, ADD_DT
from 
	CMN_LOG_AUTHD
where LAUTHD_SEQ = #{G3-LAUTHD_SEQ}
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "s";
		return $RtnVal;
    }  
	//sAuthdG    
	public function sAuthdG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "OS";
		$RtnVal["SQLID"] = "sAuthdG";
		$RtnVal["SQLTXT"] = "select
	LAUTHD_SEQ, REQ_TOKEN, RES_TOKEN, LAUTH_SEQ, PARAM_COLIDS
	, DD_COLIDS, PI_IN_COLIDS, PI_OUT_COLIDS
	, ROW_CNT, ADD_DT
from 
	CMN_LOG_AUTHD
where RES_TOKEN = #{G2-RES_TOKEN}
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "s";
		return $RtnVal;
    }  
}
                                                             
?>