<?php
//DAO
 
class appapiDao
{
	function __construct(){
		global $log;
		$log->info("AppapiDao-__construct");
	}
	function __destruct(){
		global $log;
		$log->info("AppapiDao-__destruct");
	}
	function __toString(){
		global $log;
		$log->info("AppapiDao-__toString");
	}
	//상세삭제    
	public function delApi($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "D";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLID"] = "delApi";
		$RtnVal["SQLTXT"] = "UPDATE APP_API SET DEL_YN='Y' WHERE API_SEQ = #{F4-API_SEQ}
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array("F4-API_SEQ"	);
		$RtnVal["BINDTYPE"] = "i";
		return $RtnVal;
    }  
	//삭제    
	public function delApiG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "D";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLID"] = "delApiG";
		$RtnVal["SQLTXT"] = "UPDATE  APP_API SET DEL_YN ='Y' WHERE API_SEQ = #{API_SEQ}";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "i";
		return $RtnVal;
    }  
	//완전삭제    
	public function delCompApiG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "D";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLID"] = "delCompApiG";
		$RtnVal["SQLTXT"] = "DELETE FROM APP_API WHERE API_SEQ = #{API_SEQ}";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "i";
		return $RtnVal;
    }  
	//상세    
	public function detailApi($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLID"] = "detailApi";
		$RtnVal["SQLTXT"] = "SELECT
	API_SEQ, API_NM, PGM_ID, URL, REQ_BODY
	,REQ_ENCTYPE, REQ_DATATYPE, RES_BODY, MYFILE, concat('/c.g/up/',MYFILESVRNM) as MYFILE_link
	, '/img/enc.gif^/img/enc.gif,/c.g/up/PIC_171213122506BdIm.png^/c.g/up/PIC_171213122506BdIm.png' MYFILE_VIEWER
	, MYFILESVRNM, ADD_DT, MOD_DT
FROM 
	APP_API
WHERE DEL_YN='N'
	AND API_SEQ = #{G3-API_SEQ} ";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array("G3-API_SEQ"	);
		$RtnVal["BINDTYPE"] = "i";
		return $RtnVal;
    }  
	//추가    
	public function insApi($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLID"] = "insApi";
		$RtnVal["SQLTXT"] = "INSERT INTO APP_API(
	API_NM, PGM_ID, URL, REQ_BODY, REQ_DATATYPE
	, REQ_ENCTYPE, RES_BODY, MYFILE, MYFILESVRNM
	, ADD_DT
) VALUES (
	#{F4-API_NM}, #{F4-PGM_ID}, #{F4-URL}, #{F4-REQ_BODY}, #{F4-REQ_DATATYPE}
	,#{F4-REQ_ENCTYPE},#{F4-RES_BODY}, #{F4-MYFILE_name}, #{F4-MYFILE_svr_name}
	,date_format(sysdate(),'%Y%m%d%H%i%s')
) ";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array("F4-API_NM"	);
		$RtnVal["BINDTYPE"] = "sssssssss";
		return $RtnVal;
    }  
	//목록추가    
	public function insApiG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLID"] = "insApiG";
		$RtnVal["SQLTXT"] = "INSERT INTO APP_API(
	API_NM, PGM_ID, URL, REQ_BODY, REQ_DATATYPE
	, REQ_ENCTYPE, RES_BODY, MYFILE, MYFILESVRNM
	, ADD_DT
) VALUES (
	#{API_NM}, #{PGM_ID}, #{URL}, #{REQ_BODY}, #{REQ_DATATYPE}
	,#{REQ_ENCTYPE},#{RES_BODY}, #{MYFILE}, #{MYFILESVRNM}
	,date_format(sysdate(),'%Y%m%d%H%i%s')
)";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array("API_NM"	);
		$RtnVal["BINDTYPE"] = "sssssssss";
		return $RtnVal;
    }  
	//조회    
	public function searchApiG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLID"] = "searchApiG";
		$RtnVal["SQLTXT"] = "SELECT
	 '' AS ROWCHK,API_SEQ, API_NM, PGM_ID, URL 
	, REQ_ENCTYPE, REQ_DATATYPE, REQ_BODY, RES_BODY, ifnull(MYFILE,'') as MYFILE, ifnull(MYFILESVRNM,'') as MYFILESVRNM
	, 'http://www.naver.com/^네이버^_blank' as LINK
	, 'http://www.naver.com/^네이버^_blank,http://www.daum.net/^다음^_blank,http://www.gmail.com/^지메일^_blank' as MULTILINK
	, ADD_DT, ifnull(MOD_DT,'') as MOD_DT,'0' AS CHK
FROM 
	APP_API
WHERE DEL_YN='N'
ORDER BY API_SEQ DESC";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
	//상세수정    
	public function updApi($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLID"] = "updApi";
		$RtnVal["SQLTXT"] = "UPDATE
	APP_API
SET 
	API_NM = #{F4-API_NM}
	,PGM_ID = #{F4-PGM_ID}
	,URL = #{F4-URL}
	,REQ_ENCTYPE = #{F4-REQ_ENCTYPE}
	,REQ_DATATYPE = #{F4-REQ_DATATYPE}
	,REQ_BODY = #{F4-REQ_BODY}
	,RES_BODY = #{F4-RES_BODY}
	,MOD_DT = date_format(sysdate(),'%Y%m%d%H%i%s')
WHERE API_SEQ = #{F4-API_SEQ} ";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array("F4-API_NM"	);
		$RtnVal["BINDTYPE"] = "sssssssi";
		return $RtnVal;
    }  
	//G상세수정    
	public function updApiG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLID"] = "updApiG";
		$RtnVal["SQLTXT"] = "UPDATE
	APP_API
SET 
	API_NM = #{API_NM}
	,PGM_ID = #{PGM_ID}
	,URL = #{URL}
	,REQ_ENCTYPE = #{REQ_ENCTYPE}
	,REQ_DATATYPE = #{REQ_DATATYPE}
	,REQ_BODY = #{REQ_BODY}
	,RES_BODY = #{RES_BODY}
	,MOD_DT = date_format(sysdate(),'%Y%m%d%H%i%s')
WHERE API_SEQ = #{API_SEQ} ";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "sssssssi";
		return $RtnVal;
    }  
}
                                                             
?>