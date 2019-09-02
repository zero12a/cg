<?php
//DAO
 
class pisqlDao
{
	function __construct(){
		alog("PisqlDao-__construct");
	}
	function __destruct(){
		alog("PisqlDao-__destruct");
	}
	function __toString(){
		alog("PisqlDao-__toString");
	}
	//selSqlF    
	public function selSqlF($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLID"] = "selSqlF";
		$RtnVal["SQLTXT"] = "select 
	SQLSEQ, PJTSEQ, PGMSEQ, SQLID, SQLNM
	, SVRSEQ, CRUD, RTN_TYPE, SQLORD, PSQLSEQ
	, SQLTXT
	, ADDDT, MODDT
from 
	CG_PGMSQL
where PJTSEQ = #{G1-PJTSEQ} and PGMSEQ = #{G1-PGMSEQ} and SQLSEQ = #{G2-SQLSEQ}";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "iii";
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
	SQLSEQ, PJTSEQ, PGMSEQ, SQLID, SQLNM
	, SVRSEQ, CRUD, RTN_TYPE, SQLORD, PSQLSEQ
	, concat('pisqldView?PJTSEQ=',PJTSEQ,'&PGMSEQ=',PGMSEQ,'&SQLSEQ=',SQLSEQ,'^SQLD^_blank') as LINK
	, ADDDT, MODDT
from 
	CG_PGMSQL
where PJTSEQ = #{G1-PJTSEQ} and PGMSEQ = #{G1-PGMSEQ}
order by SQLORD asc
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "ii";
		return $RtnVal;
    }  
}
                                                             
?>