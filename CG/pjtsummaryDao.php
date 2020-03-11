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