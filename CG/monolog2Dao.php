<?php
//DAO
 
class monolog2Dao
{
	function __construct(){
		global $log;
		$log->info("Monolog2Dao-__construct");
	}
	function __destruct(){
		global $log;
		$log->info("Monolog2Dao-__destruct");
	}
	function __toString(){
		global $log;
		$log->info("Monolog2Dao-__toString");
	}
	//selF    
	public function selF($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLID"] = "selF";
		$RtnVal["SQLTXT"] = "select LOGSEQ, URL, SESSIONID, REQTOKEN, RESTOKEN, USERID, USERSEQ, LISTNM, LOGLEVEL, LOGDT, LOGMSG, CHANNEL, ADDDT
from CG_MONOLOG
where  LOGSEQ = #{G2-LOGSEQ}
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "i";
		return $RtnVal;
    }  
	//selG    
	public function selG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLID"] = "selG";
		$RtnVal["SQLTXT"] = "select LOGSEQ, URL, SESSIONID, REQTOKEN, RESTOKEN, USERID, USERSEQ, LISTNM, LOGLEVEL, LOGDT, LOGMSG, CHANNEL, ADDDT
from CG_MONOLOG
where ADDDT >= concat(replace(#{G1-ADDDT},'.',''),'000000')
	and ADDDT <= concat(replace(#{G1-ADDDT},'.',''),'235959')
	and
	case when length(#{G1-LISTNM}) > 0 
		then LISTNM like concat('%',#{G1-LISTNM},'%')
		else 1=1
	end and
	case when length(#{G1-LOGLEVEL}) > 0 
		then LOGLEVEL like concat('%',#{G1-LOGLEVEL},'%')
		else 1=1
	end and
	case when length(#{G1-LOGMSG}) > 0 
		then LOGMSG like concat('%',#{G1-LOGMSG},'%')
		else 1=1
	end and
	case when length(#{G1-CHANNEL}) > 0 
		then CHANNEL like concat('%',#{G1-CHANNEL},'%')
		else 1=1
	end
order by LOGSEQ desc
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "ssssssssss";
		return $RtnVal;
    }  
}
                                                             
?>