<?php
//DAO
 
class introadminDao
{
	function __construct(){
		alog("IntroadminDao-__construct");
	}
	function __destruct(){
		alog("IntroadminDao-__destruct");
	}
	function __toString(){
		alog("IntroadminDao-__toString");
	}
	//LOGIN    
	public function sLgnSuccG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLTXT"] = "SELECT USR_ID, count(LOGIN_SEQ) as LOGIN_CNT 
FROM CMN_LOG_LOGIN
WHERE SUCCESS_YN = 'Y'
GROUP by USR_ID ORDER BY count(login_seq) desc ";
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
	//LOGIN    
	public function sLgnFailG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLTXT"] = "SELECT USR_ID, count(LOGIN_SEQ) as LOGIN_CNT 
FROM CMN_LOG_LOGIN
WHERE SUCCESS_YN = 'N'
GROUP by USR_ID ORDER BY count(login_seq) desc ";
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
	//LOGIN    
	public function sLgnIpG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLTXT"] = "SELECT REMOTE_ADDR, count(LOGIN_SEQ) as LOGIN_CNT 
FROM CMN_LOG_LOGIN
WHERE SUCCESS_YN = 'N'
GROUP by REMOTE_ADDR ORDER BY count(login_seq) desc ";
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
	//AUTH    
	public function sAuthNoG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLTXT"] = "SELECT USR_ID,count(LAUTH_SEQ) as AUTH_CNT
FROM `CMN_LOG_AUTH` 
WHERE SUCCESS_YN = 'N'
GROUP BY USR_ID
ORDER BY count(LAUTH_SEQ) desc";
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
	//LOGIN    
	public function sLgnLockG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLTXT"] = "SELECT USR_ID, count(LOGIN_SEQ) as LOGIN_CNT 
FROM CMN_LOG_LOGIN
WHERE LOCKCD in ('GOLOCK')
GROUP by USR_ID ORDER BY count(login_seq) desc ";
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
	//AUTH    
	public function sAuthPiG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLTXT"] = "SELECT b.USR_ID,sum(a.ROW_CNT) as AUTH_ROW_SUM FROM `CMN_LOG_AUTHD` a
JOIN CMN_LOG_AUTH b ON a.LAUTH_SEQ = b.LAUTH_SEQ
WHERE PI_IN_COLIDS != '' AND PI_IN_COLIDS is not NULL
GROUP BY b.USR_ID
ORDER BY count(a.ROW_CNT) desc";
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
}
                                                             
?>