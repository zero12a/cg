<?php
//DAO
 
class pjtcopyDao
{
	function __construct(){
		global $log;
		$log->info("PjtcopyDao-__construct");
	}
	function __destruct(){
		global $log;
		$log->info("PjtcopyDao-__destruct");
	}
	function __toString(){
		global $log;
		$log->info("PjtcopyDao-__toString");
	}
	//delToCfg    
	public function delToCfg($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "D";//CRUD 
		$RtnVal["SVRID"] = "CGPJT2";
		$RtnVal["SQLID"] = "delToCfg";
		$RtnVal["SQLTXT"] = "delete from CG_PJTCFG where CFGSEQ = #{CFGSEQ}";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "i";
		return $RtnVal;
    }  
	//delToFile    
	public function delToFile($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "D";//CRUD 
		$RtnVal["SVRID"] = "CGPJT2";
		$RtnVal["SQLID"] = "delToFile";
		$RtnVal["SQLTXT"] = "delete from CG_PJTFILE where FILESEQ = #{FILESEQ}";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "s";
		return $RtnVal;
    }  
	//CopyCFG    
	public function iFromCFG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "CGPJT2";
		$RtnVal["SQLID"] = "iFromCFG";
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
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "issssisi";
		return $RtnVal;
    }  
	//CopyFile    
	public function iFromFile($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "CGPJT2";
		$RtnVal["SQLID"] = "iFromFile";
		$RtnVal["SQLTXT"] = "INSERT INTO CG_PJTFILE (
	PJTSEQ, MKFILETYPE, MKFILETYPENM, MKFILEFORMAT, MKFILEEXT
	, TEMPLATE, FILEORD, USEYN, ADDDT, ADDID
) VALUES (
	#{G1-TO_PJTSEQ}, #{MKFILETYPE}, #{MKFILETYPENM}, #{MKFILEFORMAT}, #{MKFILEEXT}
	,#{TEMPLATE}, #{FILEORD}, #{USEYN}, date_format(sysdate(),'%Y%m%d%H%i%s'), #{USER.SEQ}
)";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "isssssssi";
		return $RtnVal;
    }  
	//FromCfg    
	public function sFromCFG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CGPJT1";
		$RtnVal["SQLID"] = "sFromCFG";
		$RtnVal["SQLTXT"] = "select 
 0 as CHKEDIT,PJTSEQ,CFGSEQ,USEYN,CFGID,CFGNM,MVCGBN,PATH,CFGORD,ADDDT,MODDT
from CG_PJTCFG
where PJTSEQ = #{G1-FROM_PJTSEQ} 
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "i";
		return $RtnVal;
    }  
	//FromFile    
	public function sFromFile($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CGPJT1";
		$RtnVal["SQLID"] = "sFromFile";
		$RtnVal["SQLTXT"] = "SELECT 
 0 as CHKEDIT, PJTSEQ,FILESEQ,MKFILETYPE,MKFILETYPENM,MKFILEFORMAT,MKFILEEXT,TEMPLATE,FILEORD,USEYN,ADDDT,MODDT
FROM CG_PJTFILE
WHERE PJTSEQ = #{G1-FROM_PJTSEQ}
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "i";
		return $RtnVal;
    }  
	//ToCfg    
	public function sToCFG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CGPJT2";
		$RtnVal["SQLID"] = "sToCFG";
		$RtnVal["SQLTXT"] = "select
	0 as CHK
	, PJTSEQ,CFGSEQ,USEYN,CFGID,CFGNM,MVCGBN,PATH,CFGORD,ADDDT,MODDT
from CG_PJTCFG
where PJTSEQ = #{G1-TO_PJTSEQ} ";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "i";
		return $RtnVal;
    }  
	//ToFile    
	public function sToFile($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CGPJT2";
		$RtnVal["SQLID"] = "sToFile";
		$RtnVal["SQLTXT"] = "SELECT 
	0 as CHK
	, PJTSEQ,FILESEQ,MKFILETYPE,MKFILETYPENM,MKFILEFORMAT,MKFILEEXT,TEMPLATE,FILEORD,USEYN,ADDDT,MODDT
FROM CG_PJTFILE
WHERE PJTSEQ = #{G1-TO_PJTSEQ}
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "i";
		return $RtnVal;
    }  
}
                                                             
?>