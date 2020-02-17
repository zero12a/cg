<?php
//DAO
 
class pipgmDao
{
	function __construct(){
		global $log;
		$log->info("PipgmDao-__construct");
	}
	function __destruct(){
		global $log;
		$log->info("PipgmDao-__destruct");
	}
	function __toString(){
		global $log;
		$log->info("PipgmDao-__toString");
	}
	//insPgmF    
	public function insPgmF($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SVRID"] = "CGPJT1";
		$RtnVal["SQLID"] = "insPgmF";
		$RtnVal["SQLTXT"] = "insert into CG_PGMINFO (
	PJTSEQ, PGMID, PGMNM, VIEWURL
	, PGMTYPE
	, ADDID, ADDDT, MODDT
) values (
	#{G3-PJTSEQ}, #{G3-PGMID}, #{G3-PGMNM}, #{G3-VIEWURL}, #{G3-PGMTYPE}
	, #{USER.ID}, date_format(sysdate(),'%Y%m%d%H%i%s'), null 
)
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "isssss";
		return $RtnVal;
    }  
	//selPgmF    
	public function selPgmF($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CGPJT1";
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
		$RtnVal["SVRID"] = "CGPJT1";
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
	//updPgmF    
	public function updPgmF($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "CGPJT1";
		$RtnVal["SQLID"] = "updPgmF";
		$RtnVal["SQLTXT"] = "update CG_PGMINFO set
	PGMID = #{G3-PGMID}, PGMNM = #{G3-PGMNM}, VIEWURL = #{G3-VIEWURL}, PGMTYPE = #{G3-PGMTYPE}
	, MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
where PJTSEQ = #{G3-PJTSEQ} and PGMSEQ = #{G3-PGMSEQ}
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "ssssii";
		return $RtnVal;
    }  
}
                                                             
?>