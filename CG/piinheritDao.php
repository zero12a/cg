<?php
//DAO
 
class piinheritDao
{
	function __construct(){
		alog("PiinheritDao-__construct");
	}
	function __destruct(){
		alog("PiinheritDao-__destruct");
	}
	function __toString(){
		alog("PiinheritDao-__toString");
	}
	//selInherF    
	public function selInherF($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLID"] = "selInherF";
		$RtnVal["SQLTXT"] = "select
	INHERITSEQ, PJTSEQ, PGMSEQ, GRPSEQ, COLID, CHILDGRPID
	, ADDDT, MODDT
from
	CG_PGMINHERIT
where 
	PJTSEQ = #{G1-PJTSEQ} and PGMSEQ = #{G1-PGMSEQ} and GRPSEQ = #{G1-GRPSEQ} and INHERITSEQ = #{G2-INHERITSEQ}";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "iiii";
		return $RtnVal;
    }  
	//selInherG    
	public function selInherG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLID"] = "selInherG";
		$RtnVal["SQLTXT"] = "select
	INHERITSEQ, PJTSEQ, PGMSEQ, GRPSEQ, COLID, CHILDGRPID
	, ADDDT, MODDT
from
	CG_PGMINHERIT
where 
	PJTSEQ = #{G1-PJTSEQ} and PGMSEQ = #{G1-PGMSEQ} and GRPSEQ = #{G1-GRPSEQ}
	";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "iii";
		return $RtnVal;
    }  
}
                                                             
?>