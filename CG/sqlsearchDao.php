<?php
//DAO
 
class sqlsearchDao
{
	function __construct(){
		global $log;
		$log->info("SqlsearchDao-__construct");
	}
	function __destruct(){
		global $log;
		$log->info("SqlsearchDao-__destruct");
	}
	function __toString(){
		global $log;
		$log->info("SqlsearchDao-__toString");
	}
	//pgm    
	public function sPgmG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLID"] = "sPgmG";
		$RtnVal["SQLTXT"] = "SELECT 
	PJTSEQ,PGMSEQ,PGMID,PGMNM,ADDDT
FROM 
	CG_PGMINFO
WHERE PJTSEQ = #{G1-PJTSEQ}";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "i";
		return $RtnVal;
    }  
	//sql    
	public function sSqlF($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLID"] = "sSqlF";
		$RtnVal["SQLTXT"] = "SELECT 
	SQLID, SQLTXT
FROM 
	CG_PGMSQL
WHERE PJTSEQ = #{G3-PJTSEQ} 
	AND PGMSEQ = #{G3-PGMSEQ} 
	AND SQLSEQ = #{G3-SQLSEQ}";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "iii";
		return $RtnVal;
    }  
	//sql    
	public function sSqlG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLID"] = "sSqlG";
		$RtnVal["SQLTXT"] = "SELECT 
	PJTSEQ, PGMSEQ, SQLSEQ, SQLID, SQLNM
	, CRUD, RTN_TYPE, ADDDT
FROM 
	CG_PGMSQL
WHERE PJTSEQ = #{G2-PJTSEQ} AND PGMSEQ = #{G2-PGMSEQ}
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "ii";
		return $RtnVal;
    }  
}
                                                             
?>