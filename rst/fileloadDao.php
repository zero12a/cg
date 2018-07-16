<?php
//DAO
 
class fileloadDao
{
	function __construct(){
		alog("FileloadDao-__construct");
	}
	function __destruct(){
		alog("FileloadDao-__destruct");
	}
	function __toString(){
		alog("FileloadDao-__toString");
	}
	//LOAD    
	public function sLoadD($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "SC";
		$RtnVal["SQLTXT"] = "select
	LOADD_SEQ, LOAD_SEQ ,TYPE, PRIORITY, CLASSNAME, 
	CLASS_LINE_S, CLASS_LINE_E, SOURCEFILE, SOURCEPATH, METHOD_NAME
	, METHOD_LINE_S, METHOD_LINE_E, FIELD_NAME, FIELD_LINE_S, FIELD_LINE_E
	, LINE_CNT, BUG_LINE_S, ADD_DT
from
	FILELOADD
where LOAD_SEQ = #{G2-LOAD_SEQ}
order by LOADD_SEQ desc";
		$RtnVal["BINDTYPE"] = "i";
		return $RtnVal;
    }  
	//LOAD    
	public function sLoad($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "SC";
		$RtnVal["SQLTXT"] = "select 
	LOAD_SEQ, FILE_NM, TEAM_NM, SYS_NM, SUBSYS_NM
	FILE_HASH, XML_VERSION, XML_TIMESTAMP, XML_ANAL_TIMESTAMP, XML_DT
	, XML_ANAL_DT, BUG_CNT, LOAD_END_DT, ADD_DT, MOD_DT
from 
	FILELOAD
order by LOAD_SEQ desc";
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
}
                                                             
?>