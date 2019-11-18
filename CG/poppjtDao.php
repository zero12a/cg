<?php
//DAO
 
class poppjtDao
{
	function __construct(){
		global $log;
		$log->info("PoppjtDao-__construct");
	}
	function __destruct(){
		global $log;
		$log->info("PoppjtDao-__destruct");
	}
	function __toString(){
		global $log;
		$log->info("PoppjtDao-__toString");
	}
	//PJT    
	public function sPjtList($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLID"] = "sPjtList";
		$RtnVal["SQLTXT"] = "select
	PJTSEQ,PJTID,PJTNM,FILECHARSET,UITOOL
	,SVRLANG,DEPLOYKEY,PKGROOT,STARTDT,ENDDT
	,DELYN,ADDDT,MODDT 
from
 CG_PJTINFO	
where DELYN = 'N'
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
}
                                                             
?>