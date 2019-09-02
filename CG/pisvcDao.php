<?php
//DAO
 
class pisvcDao
{
	function __construct(){
		alog("PisvcDao-__construct");
	}
	function __destruct(){
		alog("PisvcDao-__destruct");
	}
	function __toString(){
		alog("PisvcDao-__toString");
	}
	//selSvcF    
	public function selSvcF($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLID"] = "selSvcF";
		$RtnVal["SQLTXT"] = "select
	SVCSEQ, PJTSEQ, PGMSEQ, GRPSEQ, FNCSEQ
	, SVCGRPID, ORD
	, ADDDT, MODDT
from 
	CG_PGMSVC
where PJTSEQ = #{G1-PJTSEQ} and  PGMSEQ = #{G1-PGMSEQ} and GRPSEQ = #{G1-GRPSEQ} and FNCSEQ = #{G1-FNCSEQ}
	and SVCSEQ = #{G2-SVCSEQ}
	";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "iiiii";
		return $RtnVal;
    }  
	//selSvcG    
	public function selSvcG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLID"] = "selSvcG";
		$RtnVal["SQLTXT"] = "select
	SVCSEQ, PJTSEQ, PGMSEQ, GRPSEQ, FNCSEQ
	, SVCGRPID, ORD 
	, concat('pisqlrView?PJTSEQ=',PJTSEQ,'&PGMSEQ=',PGMSEQ,'&GRPSEQ=',GRPSEQ,'&FNCSEQ=',FNCSEQ,'&SVCSEQ=',SVCSEQ,'^SQLR^_blank') as LINK
	, ADDDT, MODDT
from 
	CG_PGMSVC
where PJTSEQ = #{G1-PJTSEQ} and  PGMSEQ = #{G1-PGMSEQ} and GRPSEQ = #{G1-GRPSEQ} and FNCSEQ = #{G1-FNCSEQ}
order by ORD asc";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "iiii";
		return $RtnVal;
    }  
}
                                                             
?>