<?php
//DAO
 
class authmngDao
{
	function __construct(){
		alog("AuthmngDao-__construct");
	}
	function __destruct(){
		alog("AuthmngDao-__destruct");
	}
	function __toString(){
		alog("AuthmngDao-__toString");
	}
	//selAuthG    
	public function selAuthG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLTXT"] = "select 
	0 as CHK, AUTH_SEQ, PGMID, AUTH_ID, AUTH_NM, USE_YN
	, ADD_DT, MOD_DT, concat(PGMID,'^',AUTH_NM,'^','G2') AS PGMID2
from CMN_AUTH
where PGMID like if(#{G1-PGMID} = '','%',#{G1-PGMID})
order by PGMID,AUTH_ID
";
	$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "ss";
		return $RtnVal;
    }  
	//체크삭제    
	public function delChkAuthG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "D";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLTXT"] = "delete from 
	CMN_AUTH
where AUTH_SEQ = #{AUTH_SEQ}
";
	$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "i";
		return $RtnVal;
    }  
	//권한추가    
	public function insAuthG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLTXT"] = "insert into CMN_AUTH (
	PGMID, AUTH_ID, AUTH_NM, USE_YN
	, ADD_DT
) values (
	#{PGMID}, #{AUTH_ID}, #{AUTH_NM}, if(#{USE_YN}='N','N','Y')
	,date_format(sysdate(),'%Y%m%d%H%i%s')
)
";
	$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "ssss";
		return $RtnVal;
    }  
}
                                                             
?>