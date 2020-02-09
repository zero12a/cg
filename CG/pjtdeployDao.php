<?php
//DAO
 
class pjtdeployDao
{
	function __construct(){
		global $log;
		$log->info("PjtdeployDao-__construct");
	}
	function __destruct(){
		global $log;
		$log->info("PjtdeployDao-__destruct");
	}
	function __toString(){
		global $log;
		$log->info("PjtdeployDao-__toString");
	}
	//dtlPjt    
	public function dtlPjt($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLID"] = "dtlPjt";
		$RtnVal["SQLTXT"] = "select
	PJTSEQ,PJTID,PJTNM,FILECHARSET,UITOOL
	,SVRLANG,DEPLOYKEY,PKGROOT,STARTDT,ENDDT
	,DELYN
	,concat(#,'/c.g/',PJTID,'/cg_cdeploy?CTL=INIT', '^GIT 초기화') as GITINIT
	,ADDDT,MODDT 
from
 CG_PJTINFO	
where PJTSEQ = #{G2-PJTSEQ}
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "si";
		return $RtnVal;
    }  
	//lstPjt    
	public function lstPjt($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLID"] = "lstPjt";
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