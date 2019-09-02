<?php
//DAO
 
class pifncDao
{
	function __construct(){
		alog("PifncDao-__construct");
	}
	function __destruct(){
		alog("PifncDao-__destruct");
	}
	function __toString(){
		alog("PifncDao-__toString");
	}
	//selFncF    
	public function selFncF($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLID"] = "selFncF";
		$RtnVal["SQLTXT"] = "select
	PJTSEQ, PGMSEQ, GRPSEQ, FNCSEQ, FNCID
	, FNCCD, FNCNM, FNCTYPE, FNCORD, USEYN
	, USERDEFJS
	, ADDDT, MODDT
from 
	CG_PGMFNC
where PJTSEQ = #{G1-PJTSEQ} and PGMSEQ = #{G1-PGMSEQ} and GRPSEQ = #{G1-GRPSEQ}
	and FNCSEQ = #{G2-FNCSEQ}";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "iiii";
		return $RtnVal;
    }  
	//selFncG    
	public function selFncG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLID"] = "selFncG";
		$RtnVal["SQLTXT"] = "select
	PJTSEQ, PGMSEQ, GRPSEQ, FNCSEQ, FNCID
	, FNCCD, FNCNM, FNCTYPE, FNCORD, USEYN
	, USERDEFJS, concat('pisvcView?PJTSEQ=',PJTSEQ,'&PGMSEQ=',PGMSEQ,'&GRPSEQ=',GRPSEQ,'&FNCSEQ=',FNCSEQ,'^SVC^_blank') as LINK
	, ADDDT, MODDT
from 
	CG_PGMFNC
where PJTSEQ = #{G1-PJTSEQ} and PGMSEQ = #{G1-PGMSEQ} and GRPSEQ = #{G1-GRPSEQ}
order by FNCORD asc
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "iii";
		return $RtnVal;
    }  
}
                                                             
?>