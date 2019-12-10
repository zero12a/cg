<?php
//DAO
 
class errmngDao
{
	function __construct(){
		alog("ErrmngDao-__construct");
	}
	function __destruct(){
		alog("ErrmngDao-__destruct");
	}
	function __toString(){
		alog("ErrmngDao-__toString");
	}
	//에러목록    
	public function rErrList($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SQLTXT"] = "SELECT
	ERRLOGSEQ, SESSIONID, REQID, ERRNO, ERRCD, ERRSTR, ERRFILE, ERRLINE, ERRCONTEXT, ADDDT, MODDT
FROM
	CG_ERRLOG
ORDER BY ERRLOGSEQ DESC
LIMIT 0,100
";
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
	//에러저장    
	public function cErr($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SQLTXT"] = "insert into CG_ERRLOG (
	SESSIONID, ERRNO, ERRCD, ERRSTR, ERRFILE
	,ERRLINE, ERRCONTEXT, ADDDT
	) values
	(
	#{SESSIONID}, #{ERRNO}, #{ERRCD}, #{ERRSTR}, #{ERRFILE}
	,#{ERRLINE}, #{ERRCONTEXT}, date_format(sysdate(),'%Y%m%d%H%i%s')
	)
	";
		$RtnVal["BINDTYPE"] = "sssssss";
		return $RtnVal;
    }  
	//에러상세    
	public function rErrDetail($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SQLTXT"] = "SELECT
	SESSIONID, ERRCD, ERRFILE
FROM
	CG_ERRLOG
WHERE ERRLOGSEQ  = #{G3_ERRLOGSEQ}
";
		$RtnVal["BINDTYPE"] = "s";
		return $RtnVal;
    }  
	//에러삭제    
	public function dErr($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "D";//CRUD 
		$RtnVal["SQLTXT"] = "delete from CG_ERRLOG 
where ERRLOGSEQ = #{ERRLOGSEQ}
";
		$RtnVal["BINDTYPE"] = "s";
		return $RtnVal;
    }  
}
                                                             
?>