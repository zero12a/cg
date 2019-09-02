<?php
//DAO
 
class pisqlrDao
{
	function __construct(){
		alog("PisqlrDao-__construct");
	}
	function __destruct(){
		alog("PisqlrDao-__destruct");
	}
	function __toString(){
		alog("PisqlrDao-__toString");
	}
	//selSqlrF    
	public function selSqlrF($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLID"] = "selSqlrF";
		$RtnVal["SQLTXT"] = "select
	SQLRSEQ, SVCSEQ, PJTSEQ, PGMSEQ, SQLSEQ
	, ORD
	, ADDDT, MODDT
from
	CG_PGMSQLR
where PJTSEQ = #{G1-PJTSEQ} and PGMSEQ = #{G1-PGMSEQ} and SVCSEQ = #{G1-SVCSEQ}
	and SQLRSEQ = #{G2-SQLRSEQ}
	";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "iiii";
		return $RtnVal;
    }  
	//selSqlrG    
	public function selSqlrG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLID"] = "selSqlrG";
		$RtnVal["SQLTXT"] = "select
	SQLRSEQ, SVCSEQ, PJTSEQ, PGMSEQ, SQLSEQ
	, ORD
	, ADDDT, MODDT
from
	CG_PGMSQLR
where PJTSEQ = #{G1-PJTSEQ} and PGMSEQ = #{G1-PGMSEQ} and SVCSEQ = #{G1-SVCSEQ}
order by ORD asc";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "iii";
		return $RtnVal;
    }  
}
                                                             
?>