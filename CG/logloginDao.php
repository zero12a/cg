<?php
//DAO
 
class logloginDao
{
	function __construct(){
		global $log;
		$log->info("LogloginDao-__construct");
	}
	function __destruct(){
		global $log;
		$log->info("LogloginDao-__destruct");
	}
	function __toString(){
		global $log;
		$log->info("LogloginDao-__toString");
	}
	//selLogF    
	public function selLogF($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLID"] = "selLogF";
		$RtnVal["SQLTXT"] = "select
	LOGIN_SEQ, SESSION_ID, USER_AGENT, AUTH_JSON
from
	CMN_LOG_LOGIN
where LOGIN_SEQ = #{G2-LOGIN_SEQ}
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "s";
		return $RtnVal;
    }  
	//selLogG    
	public function selLogG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLID"] = "selLogG";
		$RtnVal["SQLTXT"] = "select 
	LOGIN_SEQ, USR_ID, SESSION_ID, SUCCESS_YN, USR_SEQ
	,SERVER_NAME, REMOTE_ADDR, USER_AGENT, ADD_DT
from 
	CMN_LOG_LOGIN
where USR_ID like if(#{G1-USR_ID}='','%',#{G1-USR_ID})
order by  LOGIN_SEQ desc";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "ss";
		return $RtnVal;
    }  
}
                                                             
?>