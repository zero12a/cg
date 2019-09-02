<?php
//DAO
 
class pigrpDao
{
	function __construct(){
		alog("PigrpDao-__construct");
	}
	function __destruct(){
		alog("PigrpDao-__destruct");
	}
	function __toString(){
		alog("PigrpDao-__toString");
	}
	//selGrpF    
	public function selGrpF($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLID"] = "selGrpF";
		$RtnVal["SQLTXT"] = "select
	PJTSEQ, PGMSEQ, GRPSEQ, GRPID, GRPTYPE, GRPNM, GRPORD
	,ADDDT, MODDT
from CG_PGMGRP
where PJTSEQ = #{G2-PJTSEQ} and PGMSEQ = #{G2-PGMSEQ} and GRPSEQ = #{G2-GRPSEQ}
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array("G2-GRPSEQ"	);
		$RtnVal["BINDTYPE"] = "iii";
		return $RtnVal;
    }  
	//selGrpG    
	public function selGrpG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLID"] = "selGrpG";
		$RtnVal["SQLTXT"] = "select
	PJTSEQ, PGMSEQ, GRPSEQ, GRPID, GRPTYPE, GRPNM, GRPORD
	,concat(
		'pifncView?PJTSEQ=',PJTSEQ,'&PGMSEQ=',PGMSEQ,'&GRPSEQ=',GRPSEQ,'^FNC^_blank'
		,',piioView?PJTSEQ=',PJTSEQ,'&PGMSEQ=',PGMSEQ,'&GRPSEQ=',GRPSEQ,'^IO^_blank'
		,',piinheritView?PJTSEQ=',PJTSEQ,'&PGMSEQ=',PGMSEQ,'&GRPSEQ=',GRPSEQ,'^INHERIT^_blank'
	) as LINK
	,ADDDT, MODDT
from CG_PGMGRP
where PJTSEQ = #{G1-PJTSEQ} and PGMSEQ = #{G1-PGMSEQ}
order by GRPORD asc";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "ii";
		return $RtnVal;
    }  
}
                                                             
?>