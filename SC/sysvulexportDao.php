<?php
//DAO
 
class sysvulexportDao
{
	function __construct(){
		alog("SysvulexportDao-__construct");
	}
	function __destruct(){
		alog("SysvulexportDao-__destruct");
	}
	function __toString(){
		alog("SysvulexportDao-__toString");
	}
	//sList    
	public function sList($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "SC";
		$RtnVal["SQLID"] = "sList";
		$RtnVal["SQLTXT"] = "select
	VUL_SEQ, TEAM_NM, SYS_NM, SUBSYS_NM, FILE_NM
	, RULESET_ID, SOURCEPATH, PRIORITY, VUL_CNT, ADD_DT
	, MOD_DT
from VULINFO
where TEAM_NM like concat('%',#{G1-TEAM_NM},'%')
order by VUL_SEQ desc";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "s";
		return $RtnVal;
    }  
	//uList    
	public function uList($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "SC";
		$RtnVal["SQLID"] = "uList";
		$RtnVal["SQLTXT"] = "update VULINFO
set 
	TEAM_NM = #{TEAM_NM}, SYS_NM = #{SYS_NM}, SUBSYS_NM = #{SUBSYS_NM},
	, MOD_DT = date_format(sysdate(),'%Y%m%d%H%i%s') 
where VUL_SEQ = #{VUL_SEQ}
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "sssi";
		return $RtnVal;
    }  
}
                                                             
?>