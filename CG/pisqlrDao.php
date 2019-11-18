<?php
//DAO
 
class pisqlrDao
{
	function __construct(){
		global $log;
		$log->info("PisqlrDao-__construct");
	}
	function __destruct(){
		global $log;
		$log->info("PisqlrDao-__destruct");
	}
	function __toString(){
		global $log;
		$log->info("PisqlrDao-__toString");
	}
	//delSqlrF    
	public function delSqlrF($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "D";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLID"] = "delSqlrF";
		$RtnVal["SQLTXT"] = "delete from  CG_PGMSQLR 
where PJTSEQ = #{G3-PJTSEQ} and PGMSEQ = #{G3-PGMSEQ} and SVCSEQ = #{G3-SVCSEQ} and SQLRSEQ = #{G3-SQLRSEQ}
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "iiii";
		return $RtnVal;
    }  
	//insSqlrF    
	public function insSqlrF($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLID"] = "insSqlrF";
		$RtnVal["SQLTXT"] = "insert into CG_PGMSQLR
(
	SVCSEQ, PJTSEQ, PGMSEQ, SQLSEQ, ORD
	, ADDID, ADDDT
) values (
	#{G1-SVCSEQ}, #{G1-PJTSEQ}, #{G1-PGMSEQ}, #{G3-SQLSEQ}, #{G3-ORD}
	, #{USER.SEQ}, date_format(sysdate(),'%Y%m%d%H%i%s')
)
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "iiiiii";
		return $RtnVal;
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
	//updSqlrF    
	public function updSqlrF($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLID"] = "updSqlrF";
		$RtnVal["SQLTXT"] = "update  CG_PGMSQLR set 
	SQLSEQ = #{G3-SQLSEQ}, ORD = #{G3-ORD}
	, MODID = #{USER.SEQ}, MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
where PJTSEQ = #{G3-PJTSEQ} and PGMSEQ = #{G3-PGMSEQ} and SVCSEQ = #{G3-SVCSEQ} and SQLRSEQ = #{G3-SQLRSEQ}
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "iiiiiii";
		return $RtnVal;
    }  
}
                                                             
?>