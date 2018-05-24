<?php
//DAO
 
class chartbarDao
{
	function __construct(){
		alog("ChartbarDao-__construct");
	}
	function __destruct(){
		alog("ChartbarDao-__destruct");
	}
	function __toString(){
		alog("ChartbarDao-__toString");
	}
	//LOGIN    
	public function sLogin($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLTXT"] = "SELECT substring(add_dt,1,8) as LOGIN_DT
	, count(login_seq) as LOGIN_CNT 
	, count(login_seq)+10 as LOGIN_CNT2
FROM CMN_LOG_LOGIN
GROUP BY substring(add_dt,1,8)
ORDER BY substring(add_dt,1,8)
";
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
}
                                                             
?>