<?php
//DAO
 
class introadminDao
{
	function __construct(){
		global $log;
		$log->info("IntroadminDao-__construct");
	}
	function __destruct(){
		global $log;
		$log->info("IntroadminDao-__destruct");
	}
	function __toString(){
		global $log;
		$log->info("IntroadminDao-__toString");
	}
	//iMonthG    
	public function iMonthG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLID"] = "iMonthG";
		$RtnVal["SQLTXT"] = "INSERT INTO CMN_LOG_CFM (
	FROM_DT, TO_DT, CFM_DESC, ADD_DT, ADD_ID 
) VALUES (
	replace(#{G2-FROM_DT},'.',''), replace(#{G2-TO_DT},'.',''), #{G2-CFM_DESC}, date_format(sysdate(),'%Y%m%d%H%i%s'), #{USER.SEQ}
)";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "sssi";
		return $RtnVal;
    }  
	//s2MonthG    
	public function s2MonthG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLID"] = "s2MonthG";
		$RtnVal["SQLTXT"] = "SELECT 
	CFM_SEQ, FROM_DT, TO_DT, CFM_DESC, ADD_DT
	, ADD_ID
FROM CMN_LOG_CFM
ORDER BY CFM_SEQ DESC";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
	//sAuthNoG    
	public function sAuthNoG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLID"] = "sAuthNoG";
		$RtnVal["SQLTXT"] = "SELECT USR_ID,count(LAUTH_SEQ) as AUTH_CNT
FROM `CMN_LOG_AUTH` 
WHERE SUCCESS_YN = 'N'
GROUP BY USR_ID
ORDER BY count(LAUTH_SEQ) desc";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
	//sAuthPiG    
	public function sAuthPiG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLID"] = "sAuthPiG";
		$RtnVal["SQLTXT"] = "SELECT b.USR_ID,count(a.LAUTHD_SEQ) as REQ_PI_CNT,sum(a.ROW_CNT) as VIEW_ROW_SUM 
FROM CMN_LOG_AUTHD a
	JOIN CMN_LOG_AUTH b ON a.REQ_TOKEN = b.REQ_TOKEN
WHERE PI_IN_COLIDS != '' AND PI_IN_COLIDS is not NULL
GROUP BY b.USR_ID
ORDER BY count(a.ROW_CNT) desc";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
	//sLgnFailG    
	public function sLgnFailG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLID"] = "sLgnFailG";
		$RtnVal["SQLTXT"] = "SELECT USR_ID, count(LOGIN_SEQ) as LOGIN_CNT 
FROM CMN_LOG_LOGIN
WHERE SUCCESS_YN = 'N'
GROUP by USR_ID ORDER BY count(login_seq) desc";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
	//sLgnIpG    
	public function sLgnIpG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLID"] = "sLgnIpG";
		$RtnVal["SQLTXT"] = "SELECT REMOTE_ADDR, count(LOGIN_SEQ) as LOGIN_CNT 
FROM CMN_LOG_LOGIN
WHERE SUCCESS_YN = 'N'
GROUP by REMOTE_ADDR ORDER BY count(login_seq) desc";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
	//sLgnLockG    
	public function sLgnLockG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLID"] = "sLgnLockG";
		$RtnVal["SQLTXT"] = "SELECT USR_ID, count(LOGIN_SEQ) as LOGIN_CNT 
FROM CMN_LOG_LOGIN
WHERE LOCKCD in ('GOLOCK')
GROUP by USR_ID ORDER BY count(login_seq) desc ";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
	//sMonthG    
	public function sMonthG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLID"] = "sMonthG";
		$RtnVal["SQLTXT"] = "SELECT #{G1-FROM_DT} as FROM_DT, #{G1-TO_DT} as TO_DT";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "ss";
		return $RtnVal;
    }  
}
                                                             
?>