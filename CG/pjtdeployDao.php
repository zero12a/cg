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
	,concat(#{CFG.CFG_MAKE_URL},'/m.k/cg_cdeploy?PJTID=',PJTID,'&CTL=INIT', '^GIT 초기화') as GITINIT
	,concat(#{CFG.CFG_MAKE_URL},'/m.k/cg_cdeploy?PJTID=',PJTID,'&CTL=COMMIT&MSG=Auto', '^GIT 커밋') as GITCOMMIT
	,concat(#{CFG.CFG_MAKE_URL},'/m.k/cg_cdeploy?PJTID=',PJTID,'&CTL=PUSH', '^GIT 푸쉬') as GITPUSH
	,concat(#{CFG.CFG_MAKE_URL},'/m.k/cg_cdeploy?PJTID=',PJTID,'&CTL=FORCE_PUSH', '^GIT 강제푸쉬') as GITFORCEPUSH
	,ADDDT,MODDT 
from
 CG_PJTINFO	
where PJTSEQ = #{G2-PJTSEQ}
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "ssssi";
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