<?php
//DAO
 
class sqlsearchDao
{
	function __construct(){
		alog("SqlsearchDao-__construct");
	}
	function __destruct(){
		alog("SqlsearchDao-__destruct");
	}
	function __toString(){
		alog("SqlsearchDao-__toString");
	}
	//sql    
	public function sSqlF($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "SELECT 
	SQLID, SQLTXT
FROM 
	CG_PGMSQL
WHERE PJTSEQ = #{G3-PJTSEQ} 
	AND PGMSEQ = #{G3-PGMSEQ} 
	AND SQLSEQ = #{G3-SQLSEQ}";
		$RtnVal["BINDTYPE"] = "iii";
		return $RtnVal;
    }  
	//sql    
	public function sSqlG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "SELECT 
	PJTSEQ, PGMSEQ, SQLSEQ, SQLID, SQLNM
	, CRUD, RTN_TYPE, ADDDT
FROM 
	CG_PGMSQL
WHERE PJTSEQ = #{G2-PJTSEQ} AND PGMSEQ = #{G2-PGMSEQ}
";
		$RtnVal["BINDTYPE"] = "ii";
		return $RtnVal;
    }  
	//pgm    
	public function sPgmG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "SELECT 
	PJTSEQ,PGMSEQ,PGMID,PGMNM,ADDDT
FROM 
	CG_PGMINFO
WHERE PJTSEQ = #{G1-PJTSEQ}";
		$RtnVal["BINDTYPE"] = "i";
		return $RtnVal;
    }  
}
                                                             
?>