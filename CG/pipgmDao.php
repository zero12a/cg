<?php
//DAO
 
class pipgmDao
{
	function __construct(){
		alog("PipgmDao-__construct");
	}
	function __destruct(){
		alog("PipgmDao-__destruct");
	}
	function __toString(){
		alog("PipgmDao-__toString");
	}
	//selPgmF    
	public function selPgmF($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLID"] = "selPgmF";
		$RtnVal["SQLTXT"] = "select
	PJTSEQ, PGMSEQ, PGMID, PJTSEQ, PGMNM, VIEWURL, PGMTYPE, ADDDT, MODDT
from 
	CG_PGMINFO
where PJTSEQ = #{G2-PJTSEQ} and PGMSEQ = #{G2-PGMSEQ}
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "ii";
		return $RtnVal;
    }  
	//selPgmG    
	public function selPgmG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLID"] = "selPgmG";
		$RtnVal["SQLTXT"] = "select
	PJTSEQ, PGMSEQ, PGMID, PGMNM, VIEWURL, PGMTYPE
	, concat(
			'pigrpView?PJTSEQ=', PJTSEQ, '&PGMSEQ=', PGMSEQ, '^GRP^_blank',
			',pisqlView?PJTSEQ=', PJTSEQ, '&PGMSEQ=', PGMSEQ, '^SQL^_blank'
		) as LINK
	, ADDDT, MODDT
from 
	CG_PGMINFO
where PJTSEQ = #{G1-PJTSEQ}
order by PGMSEQ desc
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "i";
		return $RtnVal;
    }  
}
                                                             
?>