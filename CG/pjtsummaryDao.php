<?php
//DAO
 
class pjtsummaryDao
{
	function __construct(){
		global $log;
		$log->info("PjtsummaryDao-__construct");
	}
	function __destruct(){
		global $log;
		$log->info("PjtsummaryDao-__destruct");
	}
	function __toString(){
		global $log;
		$log->info("PjtsummaryDao-__toString");
	}
	//selCfgDDCnt    
	public function selCfgDdCnt($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CGPJT1";
		$RtnVal["SQLID"] = "selCfgDdCnt";
		$RtnVal["SQLTXT"] = "select concat(a.VAL1,'^',b.VAL2) as VAL1
from 
	( select count(*) as VAL1 from CG_PJTCFG ) a join
	( select count(*) as VAL2 from CG_DD ) b";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
	//selIoChart    
	public function selIoChart($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CGPJT1";
		$RtnVal["SQLID"] = "selIoChart";
		$RtnVal["SQLTXT"] = "SELECT substr(ADDDT,1,6) as LABEL,count(*) as VAL1,count(*) as VAL2 FROM 
(select ADDDT from `CG_PGMIO` 
 union all select ADDDT from CG_PGMGRP
  union all select ADDDT from CG_PGMFNC
 union all select ADDDT from CG_PGMSQL
 ) a
group by substr(ADDDT,1,6)
order by substr(ADDDT,1,6) asc";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
	//selPgmCnt    
	public function selPgmCnt($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CGPJT1";
		$RtnVal["SQLID"] = "selPgmCnt";
		$RtnVal["SQLTXT"] = "select count(*) as VAL1 from CG_PGMINFO";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
}
                                                             
?>