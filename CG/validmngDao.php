<?php
//DAO
 
class validmngDao
{
	function __construct(){
		alog("ValidmngDao-__construct");
	}
	function __destruct(){
		alog("ValidmngDao-__destruct");
	}
	function __toString(){
		alog("ValidmngDao-__toString");
	}
	//목록수정    
	public function updValidG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "update CG_VALID set
	DATATYPE = #{DATATYPE}, VALIDID = #{VALIDID}, VALIDORD = #{VALIDORD}, VALIDNM = #{VALIDNM}, VALIDTYPE= #{VALIDTYPE}
	, INVALIDMSG = #{INVALIDMSG}, MATSTR = #{MATSTR}
	, MODDT = date_format(sysdate(),'%Y%m%d%H%i%s'), MODID = #{USER.SEQ}
where PJTSEQ = #{PJTSEQ} and VALIDSEQ = #{VALIDSEQ}
";
	$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "sssssssiii";
		return $RtnVal;
    }  
	//목록추가    
	public function insValidG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "insert into CG_VALID  (
	PJTSEQ, DATATYPE, VALIDID, VALIDORD, VALIDNM
	, VALIDTYPE, INVALIDMSG, MATSTR
	, ADDDT, ADDID
)values(
	#{PJTSEQ}, #{DATATYPE}, #{VALIDID}, #{VALIDORD}, #{VALIDNM}
	,#{VALIDTYPE}, #{INVALIDMSG}, #{MATSTR}
	,date_format(sysdate(),'%Y%m%d%H%i%s'), #{USER.SEQ}
)";
	$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "isssssssi";
		return $RtnVal;
    }  
	//목록조회    
	public function selValidG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "select 
	0 AS ROWCHK, VALIDSEQ, PJTSEQ, DATATYPE, VALIDID
	, VALIDNM, VALIDORD, VALIDTYPE, INVALIDMSG, MATSTR
	, ADDDT, MODDT
from CG_VALID
where PJTSEQ = #{C1-PJTSEQ}";
	$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "s";
		return $RtnVal;
    }  
	//목록삭제    
	public function delValidG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "D";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "delete from  CG_VALID 
where PJTSEQ = #{PJTSEQ} and VALIDSEQ = #{VALIDSEQ}
";
	$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "ii";
		return $RtnVal;
    }  
}
                                                             
?>