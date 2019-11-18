<?php
//DAO
 
class errmngDao
{
	function __construct(){
		global $log;
		$log->info("ErrmngDao-__construct");
	}
	function __destruct(){
		global $log;
		$log->info("ErrmngDao-__destruct");
	}
	function __toString(){
		global $log;
		$log->info("ErrmngDao-__toString");
	}
	//에러저장    
	public function cErr($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SVRID"] = "";
		$RtnVal["SQLID"] = "cErr";
		$RtnVal["SQLTXT"] = "insert into CG_ERRLOG (
	SESSIONID, ERRNO, ERRCD, ERRSTR, ERRFILE
	,ERRLINE, ERRCONTEXT, ADDDT
	) values
	(
	#{SESSIONID}, #{ERRNO}, #{ERRCD}, #{ERRSTR}, #{ERRFILE}
	,#{ERRLINE}, #{ERRCONTEXT}, date_format(sysdate(),'%Y%m%d%H%i%s')
	)
	";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "sssssss";
		return $RtnVal;
    }  
	//에러삭제    
	public function dErr($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "D";//CRUD 
		$RtnVal["SVRID"] = "";
		$RtnVal["SQLID"] = "dErr";
		$RtnVal["SQLTXT"] = "delete from CG_ERRLOG 
where ERRLOGSEQ = #{ERRLOGSEQ}
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "i";
		return $RtnVal;
    }  
	//에러상세    
	public function rErrDetail($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "";
		$RtnVal["SQLID"] = "rErrDetail";
		$RtnVal["SQLTXT"] = "SELECT
	SESSIONID, ERRCD, ERRFILE
FROM
	CG_ERRLOG
WHERE ERRLOGSEQ  = #{G3_ERRLOGSEQ}
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "s";
		return $RtnVal;
    }  
	//에러목록    
	public function rErrList($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "";
		$RtnVal["SQLID"] = "rErrList";
		$RtnVal["SQLTXT"] = "SELECT
	ERRLOGSEQ, SESSIONID, REQID, ERRNO, ERRCD, ERRSTR, ERRFILE, ERRLINE, ERRCONTEXT, ADDDT, MODDT
FROM
	CG_ERRLOG
ORDER BY ERRLOGSEQ DESC
LIMIT 0,100
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
}
                                                             
?>