<?php
//DAO
 
class groupmngDao
{
	function __construct(){
		alog("GroupmngDao-__construct");
	}
	function __destruct(){
		alog("GroupmngDao-__destruct");
	}
	function __toString(){
		alog("GroupmngDao-__toString");
	}
	//selGrpG    
	public function selGrpG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLTXT"] = "select 
 GRP_SEQ, GRP_NM, USE_YN, ADD_DT, ADD_ID
 , MOD_DT, MOD_ID
from CMN_GRP
";
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
	//insGrpG    
	public function insGrpG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLTXT"] = "insert into CMN_GRP
(
	GRP_NM, USE_YN, ADD_DT, ADD_ID
) values (
	#{GRP_NM}, #{USE_YN}, date_format(sysdate(),'%Y%m%d%H%i%s'), 0
)
";
		$RtnVal["BINDTYPE"] = "ss";
		return $RtnVal;
    }  
	//updGrpG    
	public function updGrpG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLTXT"] = "update CMN_GRP set
	GRP_NM = #{GRP_NM}, USE_YN = #{USE_YN}
	,MOD_DT = date_format(sysdate(),'%Y%m%d%H%i%s'), MOD_ID = 0
where GRP_SEQ = #{GRP_SEQ}
";
		$RtnVal["BINDTYPE"] = "sss";
		return $RtnVal;
    }  
}
                                                             
?>