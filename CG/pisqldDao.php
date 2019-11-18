<?php
//DAO
 
class pisqldDao
{
	function __construct(){
		global $log;
		$log->info("PisqldDao-__construct");
	}
	function __destruct(){
		global $log;
		$log->info("PisqldDao-__destruct");
	}
	function __toString(){
		global $log;
		$log->info("PisqldDao-__toString");
	}
	//selSqlF    
	public function selSqlF($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLID"] = "selSqlF";
		$RtnVal["SQLTXT"] = "select
	SQLSEQ, COLSEQ, PJTSEQ, PGMSEQ, SQLGBN
	, COLID, DDCOLID, REQUIREYN, ORD
	, ADDDT	MODDT
from 
	CG_PGMSQLD
where PJTSEQ = #{G1-PJTSEQ} and PGMSEQ = #{G1-PGMSEQ} and SQLSEQ = #{G1-SQLSEQ}
	and COLSEQ = #{G2-COLSEQ}";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "iiii";
		return $RtnVal;
    }  
	//selSqlG    
	public function selSqlG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLID"] = "selSqlG";
		$RtnVal["SQLTXT"] = "select
	SQLSEQ, COLSEQ, PJTSEQ, PGMSEQ, SQLGBN
	, COLID, DDCOLID, REQUIREYN, ORD
	, ADDDT, MODDT
from 
	CG_PGMSQLD
where PJTSEQ = #{G1-PJTSEQ} and PGMSEQ = #{G1-PGMSEQ} and SQLSEQ = #{G1-SQLSEQ}
order by SQLGBN, ORD";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "iii";
		return $RtnVal;
    }  
}
                                                             
?>