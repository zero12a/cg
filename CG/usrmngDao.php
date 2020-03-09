<?php
//DAO
 
class usrmngDao
{
	function __construct(){
		global $log;
		$log->info("UsrmngDao-__construct");
	}
	function __destruct(){
		global $log;
		$log->info("UsrmngDao-__destruct");
	}
	function __toString(){
		global $log;
		$log->info("UsrmngDao-__toString");
	}
	//회원삭제F    
	public function delUsrF($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "D";//CRUD 
		$RtnVal["SVRID"] = "OS";
		$RtnVal["SQLID"] = "delUsrF";
		$RtnVal["SQLTXT"] = "delete from CMN_USR where USR_SEQ = #{G3-USR_SEQ}
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "i";
		return $RtnVal;
    }  
	//회원삭제G    
	public function delUsrG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "D";//CRUD 
		$RtnVal["SVRID"] = "OS";
		$RtnVal["SQLID"] = "delUsrG";
		$RtnVal["SQLTXT"] = "delete from CMN_USR where USR_SEQ = #{USR_SEQ}
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "i";
		return $RtnVal;
    }  
	//회원등록폼    
	public function insUsrF($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SVRID"] = "OS";
		$RtnVal["SQLID"] = "insUsrF";
		$RtnVal["SQLTXT"] = "INSERT INTO CMN_USR(
	USR_ID, USR_NM, USR_PWD, ADD_DT, ADD_ID
) VALUES (
	#{G3-USR_ID}, #{G3-USR_NM}, #{G3-USR_PWD}, date_format(sysdate(),'%Y%m%d%H%i%s'), 0
)";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array("G3-USR_ID"	);
		$RtnVal["BINDTYPE"] = "sss";
		return $RtnVal;
    }  
	//회원등록    
	public function insUsrG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SVRID"] = "OS";
		$RtnVal["SQLID"] = "insUsrG";
		$RtnVal["SQLTXT"] = "INSERT INTO CMN_USR(
	USR_ID, USR_NM, USR_PWD, ADD_DT, ADD_ID
) VALUES (
	#{USR_ID}, #{USR_NM}, #{USR_PWD}, date_format(sysdate(),'%Y%m%d%H%i%s'), 0
)";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "sss";
		return $RtnVal;
    }  
	//회원상세    
	public function selUsrF($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "OS";
		$RtnVal["SQLID"] = "selUsrF";
		$RtnVal["SQLTXT"] = "select 
	USR_SEQ, USR_ID, USR_NM, '--Hashed--' as USR_PWD, PW_CHG_DT, PHONE
	, PW_ERR_CNT, LAST_STATUS, ADD_DT, MOD_DT 
from CMN_USR 
where USR_SEQ = #{G2-USR_SEQ}
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array("G2-USR_SEQ"	);
		$RtnVal["BINDTYPE"] = "i";
		return $RtnVal;
    }  
	//회원목록    
	public function selUsrG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "OS";
		$RtnVal["SQLID"] = "selUsrG";
		$RtnVal["SQLTXT"] = "select 
	USR_SEQ, USR_ID, USR_NM, '--hashed--' as USR_PWD, PW_CHG_DT, PHONE
	, PW_ERR_CNT, LAST_STATUS, USE_YN, ADD_DT, MOD_DT 
from CMN_USR 
where USR_ID like if(#{G1-USR_ID}='','%',#{G1-USR_ID})";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "ss";
		return $RtnVal;
    }  
	//회원수정F    
	public function updUsrF($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "OS";
		$RtnVal["SQLID"] = "updUsrF";
		$RtnVal["SQLTXT"] = "update CMN_USR set
	USR_NM = #{G3-USR_NM}, USR_ID = #{G3-USR_ID}, MOD_DT = date_format(sysdate(),'%Y%m%d%H%i%s')
where USR_SEQ = #{G3-USR_SEQ}
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "ssi";
		return $RtnVal;
    }  
	//비번변경    
	public function updUsrPwG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "OS";
		$RtnVal["SQLID"] = "updUsrPwG";
		$RtnVal["SQLTXT"] = "update CMN_USR set
	USR_PWD = #{USR_PWD}, PW_CHG_DT = date_format(sysdate(),'%Y%m%d%H%i%s')
where USR_ID = #{USR_ID}
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "ss";
		return $RtnVal;
    }  
}
                                                             
?>