<?php
//DAO
 
class pjtcopyDao
{
	function __construct(){
		alog("PjtcopyDao-__construct");
	}
	function __destruct(){
		alog("PjtcopyDao-__destruct");
	}
	function __toString(){
		alog("PjtcopyDao-__toString");
	}
	//ToCfg    
	public function sToCFG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "select 
 PJTSEQ,CFGSEQ,USEYN,CFGID,CFGNM,MVCGBN,PATH,CFGORD,ADDDT,MODDT
from CG_PJTCFG
where PJTSEQ = #{G1-TO_PJTSEQ} ";
	$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "i";
		return $RtnVal;
    }  
	//FromCfg    
	public function sFromCFG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "select 
 0 as CHKEDIT,PJTSEQ,CFGSEQ,USEYN,CFGID,CFGNM,MVCGBN,PATH,CFGORD,ADDDT,MODDT
from CG_PJTCFG
where PJTSEQ = #{G1-FROM_PJTSEQ} 
";
	$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "i";
		return $RtnVal;
    }  
	//FromFile    
	public function sFromFile($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "SELECT 
 0 as CHKEDIT, PJTSEQ,FILESEQ,MKFILETYPE,MKFILETYPENM,MKFILEFORMAT,MKFILEEXT,TEMPLATE,FILEORD,USEYN,ADDDT,MODDT
FROM CG_PJTFILE
WHERE PJTSEQ = #{G1-FROM_PJTSEQ}
";
	$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "i";
		return $RtnVal;
    }  
	//ToFile    
	public function sToFile($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "SELECT PJTSEQ,FILESEQ,MKFILETYPE,MKFILETYPENM,MKFILEFORMAT,MKFILEEXT,TEMPLATE,FILEORD,USEYN,ADDDT,MODDT
FROM CG_PJTFILE
WHERE PJTSEQ = #{G1-TO_PJTSEQ}
";
	$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "i";
		return $RtnVal;
    }  
	//CopyFile    
	public function iFromFile($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "INSERT INTO CG_PJTFILE (
	PJTSEQ, MKFILETYPE, MKFILETYPENM, MKFILEFORMAT, MKFILEEXT
	, TEMPLATE, FILEORD, USEYN, ADDDT, ADDID
) VALUES (
	#{G1-TO_PJTSEQ}, #{MKFILETYPE}, #{MKFILETYPENM}, #{MKFILEFORMAT}, #{MKFILEEXT}
	,#{TEMPLATE}, #{FILEORD}, #{USEYN}, date_format(sysdate(),'%Y%m%d%H%i%s'), #{USER.SEQ}
)";
	$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "isssssssi";
		return $RtnVal;
    }  
	//CopyCFG    
	public function iFromCFG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "insert into CG_PJTCFG (
 PJTSEQ, CFGID, CFGNM, MVCGBN, PATH
 , CFGORD, USEYN
 , ADDDT, ADDID
) values (
 #{G1-TO_PJTSEQ}, #{CFGID}, #{CFGNM}, #{MVCGBN}, #{PATH}
 , #{CFGORD}, #{USEYN}
 , date_format(sysdate(),'%Y%m%d%H%i%s'), #{USER.SEQ}
) 
";
	$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "issssisi";
		return $RtnVal;
    }  
}
                                                             
?>