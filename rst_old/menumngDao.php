<?php
//DAO
 
class menumngDao
{
	function __construct(){
		alog("MenumngDao-__construct");
	}
	function __destruct(){
		alog("MenumngDao-__destruct");
	}
	function __toString(){
		alog("MenumngDao-__toString");
	}
	//selFoldG    
	public function selFoldG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLTXT"] = "select
 FOLDER_SEQ, FOLDER_NM, USE_YN, FOLDER_ORD, ADD_DT, ADD_ID, MOD_DT, MOD_ID
from
	CMN_FOLDER

";
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
	//selMenuG    
	public function selMenuG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLTXT"] = "select 
	0 as CHK, MNU_SEQ, PGMID, MNU_NM, URL
	, PGMTYPE, MNU_ORD, FOLDER_SEQ, USE_YN
	, ADD_DT, ADD_ID, MOD_ID, MOD_DT
from CMN_MNU
where FOLDER_SEQ = #{G2-FOLDER_SEQ}";
		$RtnVal["BINDTYPE"] = "s";
		return $RtnVal;
    }  
	//insMenuG    
	public function insMenuG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLTXT"] = "insert into CMN_MNU (
	PGMID, MNU_NM, URL, MNU_ORD, FOLDER_SEQ
	,USE_YN, PGMTYPE, ADD_DT, ADD_ID
) values (
	#{PGMID}, #{MNU_NM}, #{URL}, if(#{MNU_ORD}='',10,#{MNU_ORD}), #{FOLDER_SEQ}
	,if(#{USE_YN}='','Y',#{USE_YN}), #{PGMTYPE}, date_format(sysdate(),'%Y%m%d%H%i%s'), #{USER.SEQ}
)
";
		$RtnVal["BINDTYPE"] = "sssssisssi";
		return $RtnVal;
    }  
	//delMenuG    
	public function delMenuG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "D";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLTXT"] = "delete from CMN_MNU
where MNU_SEQ = #{MNU_SEQ}";
		$RtnVal["BINDTYPE"] = "s";
		return $RtnVal;
    }  
	//updMenuG    
	public function updMenuG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLTXT"] = "update CMN_MNU set
	PGMID = #{PGMID}, MNU_NM = #{MNU_NM}, MNU_ORD = if(#{MNU_ORD}='',10,#{MNU_ORD}), FOLDER_SEQ = #{FOLDER_SEQ}, USE_YN = #{USE_YN}
	,PGMTYPE = #{PGMTYPE}
	,MOD_DT =  date_format(sysdate(),'%Y%m%d%H%i%s')
	,MOD_ID = #{USER.SEQ}
where MNU_SEQ = #{MNU_SEQ}
";
		$RtnVal["BINDTYPE"] = "ssssissis";
		return $RtnVal;
    }  
}
                                                             
?>