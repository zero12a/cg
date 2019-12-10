<?php
//DAO
 
class intronormalDao
{
	function __construct(){
		alog("IntronormalDao-__construct");
	}
	function __destruct(){
		alog("IntronormalDao-__destruct");
	}
	function __toString(){
		alog("IntronormalDao-__toString");
	}
	//login    
	public function sLoginG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLTXT"] = "SELECT
	LOGIN_SEQ, USR_ID, SESSION_ID, SUCCESS_YN, RESPONSE_MSG
	, PW_ERR_CNT, LOCKCD, USR_SEQ, SERVER_NAME, REMOTE_ADDR
	, USER_AGENT, ADD_DT
FROM CMN_LOG_LOGIN
WHERE USR_ID = #{USER.ID}
ORDER BY LOGIN_SEQ DESC";
		$RtnVal["BINDTYPE"] = "s";
		return $RtnVal;
    }  
	//lock    
	public function sLockG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLTXT"] = "SELECT
	LOGIN_SEQ, USR_ID, SESSION_ID, SUCCESS_YN, LOCKCD, PW_ERR_CNT, LOCK_LIMIT_DT
	, USR_SEQ, ADD_DT
FROM CMN_LOG_LOGIN
WHERE LOCKCD IN ('GOLOCK','UNLOCK')
	AND USR_ID = #{USER.ID}
ORDER BY LOGIN_SEQ DESC";
		$RtnVal["BINDTYPE"] = "s";
		return $RtnVal;
    }  
	//menu    
	public function sMenuG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLTXT"] = "SELECT
	LAUTH_SEQ, REQ_TOKEN, RES_TOKEN, USR_SEQ, USR_ID
	, PGMID, AUTH_ID, SUCCESS_YN, ADD_DT
FROM CMN_LOG_AUTH
WHERE USR_ID = #{USER.ID}
ORDER BY LAUTH_SEQ DESC";
		$RtnVal["BINDTYPE"] = "s";
		return $RtnVal;
    }  
}
                                                             
?>