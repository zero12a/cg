<?php
//DAO
 
class chartbarDao
{
	function __construct(){
		global $log;
		$log->info("ChartbarDao-__construct");
	}
	function __destruct(){
		global $log;
		$log->info("ChartbarDao-__destruct");
	}
	function __toString(){
		global $log;
		$log->info("ChartbarDao-__toString");
	}
	//LOGIN    
	public function sLogin($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLID"] = "sLogin";
		$RtnVal["SQLTXT"] = "SELECT substring(add_dt,1,8) as LOGIN_DT
	, count(login_seq) as LOGIN_CNT 
	, count(login_seq)+10 as LOGIN_CNT2
FROM CMN_LOG_LOGIN
GROUP BY substring(add_dt,1,8)
ORDER BY substring(add_dt,1,8)
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
	//Pie    
	public function sPieD($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLID"] = "sPieD";
		$RtnVal["SQLTXT"] = "SELECT substring(add_dt,1,8) as LOGIN_DT
	, count(login_seq) as LOGIN_CNT 
	, count(login_seq)+10 as LOGIN_CNT2
FROM CMN_LOG_LOGIN
WHERE substring(add_dt,1,8) = #{G3-LOGIN_DT}
GROUP BY substring(add_dt,1,8)
ORDER BY substring(add_dt,1,8)
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "s";
		return $RtnVal;
    }  
	//PIE    
	public function sPieSel($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLID"] = "sPieSel";
		$RtnVal["SQLTXT"] = "SELECT substring(add_dt,1,8) as LOGIN_DT
	, count(login_seq) as LOGIN_CNT 
		, count(login_seq)+10 as LOGIN_CNT2
FROM CMN_LOG_LOGIN
GROUP BY substring(add_dt,1,8)
ORDER BY substring(add_dt,1,8)";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
}
                                                             
?>