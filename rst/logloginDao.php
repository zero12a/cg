<?php
//DAO
 
class logloginDao
{
	function __construct(){
		alog("LogloginDao-__construct");
	}
	function __destruct(){
		alog("LogloginDao-__destruct");
	}
	function __toString(){
		alog("LogloginDao-__toString");
	}
	//selLogG    
	public function selLogG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLTXT"] = "select 
	LOGIN_SEQ, USR_ID, SESSION_ID, SUCCESS_YN, RESPONSE_MSG
	, LOCKCD, USR_SEQ, SERVER_NAME, REMOTE_ADDR, USER_AGENT
	, ADD_DT
from 
	CMN_LOG_LOGIN
where USR_ID like if(#{G1-USR_ID}='','%',#{G1-USR_ID})
order by  LOGIN_SEQ desc";
		$RtnVal["BINDTYPE"] = "ss";
		return $RtnVal;
    }  
	//selLogF    
	public function selLogF($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLTXT"] = "select
	LOGIN_SEQ, SESSION_ID, USER_AGENT, AUTH_JSON
from
	CMN_LOG_LOGIN	
where LOGIN_SEQ = #{G2-LOGIN_SEQ}
";
		$RtnVal["BINDTYPE"] = "i";
		return $RtnVal;
    }  
}
                                                             
?>