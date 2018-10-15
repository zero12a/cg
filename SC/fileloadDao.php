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
	//LOADD    
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
	$RtnVal["REQUIRE"] = array(	);
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
	0 as CHK, LOAD_SEQ, FILE_NM, TEAM_NM, length(TEAM_NM) as TEAM_NM_LEN
	, SYS_NM, length(SYS_NM) as SYS_NM_LEN, SUBSYS_NM, length(ifnull(SUBSYS_NM,'')) as SUBSYS_NM_LEN, FILE_HASH
	, XML_VERSION, XML_TIMESTAMP, XML_ANAL_TIMESTAMP, XML_DT, XML_ANAL_DT
	, BUG_CNT, LOAD_END_DT
	, ADD_DT, MOD_DT
from 
	FILELOAD
where file_nm like concat('%',#{G1-FILE_NM},'%') 
	and team_nm like  concat('%',#{G1-TEAM_NM},'%') 
	and CASE
          WHEN #{G1-ADD_DT} <>'' THEN ADD_DT like concat('%',#{G1-ADD_DT},'%')
          ELSE 1=1	
	END
order by LOAD_SEQ desc

";
	$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "ssss";
		return $RtnVal;
    }  
	//LOAD    
	public function dLoad($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "D";//CRUD 
		$RtnVal["SVRID"] = "SC";
		$RtnVal["SQLTXT"] = "delete from FILELOAD where LOAD_SEQ = #{LOAD_SEQ}";
	$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "i";
		return $RtnVal;
    }  
	//LOAD    
	public function uLoad($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "SC";
		$RtnVal["SQLTXT"] = "update FILELOAD
set 
	TEAM_NM = #{TEAM_NM}
	, SYS_NM = #{SYS_NM}
	, SUBSYS_NM = #{SUBSYS_NM}
	, MOD_DT = date_format(sysdate(),'%Y%m%d%H%i%s')
where LOAD_SEQ = #{LOAD_SEQ}";
	$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "sssi";
		return $RtnVal;
    }  
}
                                                             
?>