<?php
//DAO
 
class layoutmngDao
{
	function __construct(){
		alog("LayoutmngDao-__construct");
	}
	function __destruct(){
		alog("LayoutmngDao-__destruct");
	}
	function __toString(){
		alog("LayoutmngDao-__toString");
	}
	//LAYOUT    
	public function sLayoutG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "SELECT 
	PJTSEQ, LAYOUTID, GRPCNT, USEYN, ADDDT, ADDID, MODDT, MODID
FROM CG_LAYOUT
WHERE LAYOUTID like if(#{G1-LAYOUTID}='','%',#{G1-LAYOUTID})";
		$RtnVal["BINDTYPE"] = "ss";
		return $RtnVal;
    }  
	//LAYOUT    
	public function uLayoutG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "UPDATE CG_LAYOUT SET
	GRPCNT = #{GRPCNT}, USEYN = #{USEYN}
	, MODDT = date_format(sysdate(),'%Y%m%d%H%i%s'), MODID = #{USER.SEQ}
WHERE LAYOUTID = #{LAYOUTID} AND PJTSEQ = #{PJTSEQ}
";
		$RtnVal["BINDTYPE"] = "isisi";
		return $RtnVal;
    }  
	//LAYOUTD    
	public function sLayoutDG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "SELECT 
	LAYOUTDSEQ, PJTSEQ, LAYOUTID, GRPID, REFGRPID
	, ORD, GRPTYPE, GRPWIDTH, GRPHEIGHT, VBOX
	, ADDDT, MODDT
FROM CG_LAYOUTD
WHERE LAYOUTID = #{G2-LAYOUTID}
 ";
		$RtnVal["BINDTYPE"] = "s";
		return $RtnVal;
    }  
	//LAYOUTD    
	public function uLayoutDG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "UPDATE  CG_LAYOUTD SET 
	LAYOUTID = #{LAYOUTID}, GRPID = #{GRPID}, REFGRPID = #{REFGRPID}
	, ORD = #{ORD}, GRPTYPE = #{GRPTYPE}, GRPWIDTH = #{GRPWIDTH}, GRPHEIGHT = #{GRPHEIGHT}, VBOX = #{VBOX}
	, MODDT = date_format(sysdate(),'%Y%m%d%H%i%s'), ADDID = #{USER.SEQ}
WHERE LAYOUTDSEQ = #{LAYOUTDSEQ} AND PJTSEQ = #{PJTSEQ}
";
		$RtnVal["BINDTYPE"] = "sssissssiii";
		return $RtnVal;
    }  
	//LAYOUT    
	public function iLayoutG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "INSERT INTO CG_LAYOUT (
	PJTSEQ, LAYOUTID, GRPCNT
	, ADDDT, ADDID
) VALUES (
	#{PJTSEQ}, #{LAYOUTID}, #{GRPCNT}
	, date_format(sysdate(),'%Y%m%d%H%i%s'), #{USER.SEQ}
)";
		$RtnVal["BINDTYPE"] = "isii";
		return $RtnVal;
    }  
	//LAYOUTD    
	public function iLayoutDG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "INSERT INTO CG_LAYOUTD (
	PJTSEQ, LAYOUTID, GRPID, REFGRPID, ORD
	, GRPTYPE, GRPWIDTH, GRPHEIGHT, VBOX
	, ADDDT, ADDID
) VALUES (
	#{PJTSEQ}, #{LAYOUTID}, #{GRPID}, #{REFGRPID}, #{ORD}
	, #{GRPTYPE}, #{GRPWIDTH}, #{GRPHEIGHT}, #{VBOX}
	, date_format(sysdate(),'%Y%m%d%H%i%s'), #{USER.SEQ}
)";
		$RtnVal["BINDTYPE"] = "isssissssi";
		return $RtnVal;
    }  
	//LAYOUTD    
	public function dLayoutG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "D";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "DELETE FROM CG_LAYOUT WHERE LAYOUTID = #{LAYOUTID}";
		$RtnVal["BINDTYPE"] = "s";
		return $RtnVal;
    }  
	//LAYOUTD    
	public function dLayoutDG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "D";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "DELETE FROM CG_LAYOUTD WHERE PJTSEQ = #{PJTSEQ} AND LAYOUTDSEQ = #{LAYOUTDSEQ}";
		$RtnVal["BINDTYPE"] = "ii";
		return $RtnVal;
    }  
}
                                                             
?>