<?php
//DAO
 
class ipmngDao
{
	function __construct(){
		alog("IpmngDao-__construct");
	}
	function __destruct(){
		alog("IpmngDao-__destruct");
	}
	function __toString(){
		alog("IpmngDao-__toString");
	}
	//IP    
	public function selIpG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLTXT"] = "select
	IP_SEQ, PGMTYPE, IP, IP_DESC, ADD_DT, ADD_ID
	, MOD_DT, MOD_ID 
from CMN_IP
order by IP_SEQ desc ";
	$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
	//IP    
	public function insIpG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLTXT"] = "INSERT INTO CMN_IP (
	PGMTYPE, IP, IP_DESC, ADD_DT, ADD_ID
) VALUES (	
	#{PGMTYPE}, #{IP}, #{IP_DESC}, date_format(sysdate(),'%Y%m%d%H%i%s'),#{USER.SEQ}   
)";
	$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "sssi";
		return $RtnVal;
    }  
	//IP    
	public function updIpG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLTXT"] = "UPDATE CMN_IP SET
	PGMTYPE = #{PGMTYPE}, IP = #{IP}, IP_DESC = #{IP_DESC}
	, MOD_DT = date_format(sysdate(),'%Y%m%d%H%i%s') , MOD_ID = #{USER.SEQ}
WHERE IP_SEQ = #{IP_SEQ}
";
	$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "sssii";
		return $RtnVal;
    }  
	//IP    
	public function delIpG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "D";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLTXT"] = "DELETE FROM  CMN_IP
WHERE IP_SEQ = #{IP_SEQ}
";
	$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "i";
		return $RtnVal;
    }  
}
                                                             
?>