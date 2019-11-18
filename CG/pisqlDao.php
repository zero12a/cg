<?php
//DAO
 
class pisqlDao
{
	function __construct(){
		global $log;
		$log->info("PisqlDao-__construct");
	}
	function __destruct(){
		global $log;
		$log->info("PisqlDao-__destruct");
	}
	function __toString(){
		global $log;
		$log->info("PisqlDao-__toString");
	}
	//insSqlF    
	public function insSqlF($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLID"] = "insSqlF";
		$RtnVal["SQLTXT"] = "insert into  CG_PGMSQL (
	SQLID, SQLNM, SVRSEQ, CRUD, RTN_TYPE
	, SQLORD, PSQLSEQ
	, ADDDT 
	) values (
		#{G3-SQLID}, #{G3-SQLNM}, #{G3-SVRSEQ}, #{G3-CRUD}, #{G3-RTN_TYPE}
		,#{G3-SQLORD}, #{G3-PSQLSEQ}
		date_format(sysdate(),'%Y%m%d%H%i%s')
	)
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "ssissii";
		return $RtnVal;
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
	//updSqlF    
	public function updSqlF($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLID"] = "updSqlF";
		$RtnVal["SQLTXT"] = "update CG_PGMSQL
set 
	SQLID = #{G3-SQLID}, SQLNM = #{G3-SQLNM}, SVRSEQ = #{G3-SVRSEQ}
	,CRUD = #{G3-CRUD}, RTN_TYPE = #{G3-RTN_TYPE}, SQLORD = #{G3-SQLORD}, PSQLSEQ = #{G3-PSQLSEQ}
	,SQLTXT = #{G3-SQLTXT}, MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
where
	PJTSEQ = #{G3-PJTSEQ} and PGMSEQ = #{G3-PGMSEQ} and SQLSEQ = #{SQLSEQ}";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "ssissiisiii";
		return $RtnVal;
    }  
}
                                                             
?>