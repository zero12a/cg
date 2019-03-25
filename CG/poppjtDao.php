<?php
//DAO
 
class poppjtDao
{
	function __construct(){
		alog("PoppjtDao-__construct");
	}
	function __destruct(){
		alog("PoppjtDao-__destruct");
	}
	function __toString(){
		alog("PoppjtDao-__toString");
	}
	//PJT    
	public function sPjtList($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "select
	PJTSEQ,PJTID,PJTNM,FILECHARSET,UITOOL
	,SVRLANG,DEPLOYKEY,PKGROOT,STARTDT,ENDDT
	,DELYN,ADDDT,MODDT 
from
 CG_PJTINFO	
where DELYN = 'N'
";
	$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
}
                                                             
?>