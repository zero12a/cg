<?php
//DAO
 
class dbdeployDao
{
	function __construct(){
		global $log;
		$log->info("DbdeployDao-__construct");
	}
	function __destruct(){
		global $log;
		$log->info("DbdeployDao-__destruct");
	}
	function __toString(){
		global $log;
		$log->info("DbdeployDao-__toString");
	}
	//dtlTable    
	public function dtlTable($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CGPJT1";
		$RtnVal["SQLID"] = "dtlTable";
		$RtnVal["SQLTXT"] = "SELECT
TABLE_SCHEMA, TABLE_NAME,ENGINE,TABLE_ROWS,AUTO_INCREMENT
,CREATE_TIME,UPDATE_TIME,TABLE_COLLATION,TABLE_COMMENT 
FROM information_schema.TABLES 
where TABLE_SCHEMA =  #{G1-DB} and TABLE_NAME = #{G2-TABLE_NAME}
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "ss";
		return $RtnVal;
    }  
	//lstTAble    
	public function lstTable($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CGPJT1";
		$RtnVal["SQLID"] = "lstTable";
		$RtnVal["SQLTXT"] = "SELECT
0 as CHK,TABLE_SCHEMA, TABLE_NAME
,concat('SQL파일생성^',#{CFG.CFG_CGWEB_URL},'/c.g/cg_cdeploy_db.php?DB=', TABLE_SCHEMA , '&TABLE=' , TABLE_NAME , '^_blank') as SQLCRATE
,'' as RESULT
,ENGINE,TABLE_ROWS,AUTO_INCREMENT
,CREATE_TIME,UPDATE_TIME,TABLE_COLLATION,TABLE_COMMENT 
FROM information_schema.TABLES 
where TABLE_SCHEMA =  #{G1-DB}
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "ss";
		return $RtnVal;
    }  
}
                                                             
?>