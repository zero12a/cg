<?php
//DAO
 
class codemngDao
{
	function __construct(){
		alog("CodemngDao-__construct");
	}
	function __destruct(){
		alog("CodemngDao-__destruct");
	}
	function __toString(){
		alog("CodemngDao-__toString");
	}
	//MAS    
	public function selMasG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "select 
	PCD,PNM,PCDDESC,ORD
	,UITOOL,USEYN,DELYN
	,ADDDT,MODDT
from 
	CG_CODE
order by ORD asc";
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
	//DTL    
	public function selDtlG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "select
	CD,NM,CDDESC,PCD,ORD
	,CDVAL,CDVAL2,CDMIN,CDMAX,DATATYPE
	,EDITYN,FORMATYN,USEYN,DELYN
	,ADDDT,MODDT
from CG_CODED
where PCD = #{G2-PCD}
order by ORD ";
		$RtnVal["BINDTYPE"] = "s";
		return $RtnVal;
    }  
	//MAS    
	public function insMasG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "insert into CG_CODE (
	PCD,PNM,PCDDESC,ORD
	,UITOOL,USEYN,DELYN
	,ADDDT
) values (
	#{PCD},#{PNM},#{PCDDESC},if(#{ORD}='','10',#{ORD})
	,#{UITOOL},if(#{USEYN}='','Y',#{USEYN}),if(#{DELYN}='','N',#{DELYN})
	,date_format(sysdate(),'%Y%m%d%H%i%s')
)";
		$RtnVal["BINDTYPE"] = "sssiisssss";
		return $RtnVal;
    }  
	//DTL    
	public function insDtlG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "insert into CG_CODED (
	CD,NM,CDDESC,PCD
	,ORD,CDVAL,CDVAL2,CDMIN,CDMAX
	,DATATYPE,EDITYN,FORMATYN,USEYN,DELYN
	,ADDDT
) values (
	#{CD},#{NM},#{CDDESC},#{PCD}
	,if(#{ORD}='',10,#{ORD}),#{CDVAL},#{CDVAL2},#{CDMIN},#{CDMAX}
	,#{DATATYPE},#{EDITYN},#{FORMATYN},if(#{USEYN}='','Y',#{USEYN}),if(#{DELYN}='','N',#{DELYN})
	,date_format(sysdate(),'%Y%m%d%H%i%s')
)";
		$RtnVal["BINDTYPE"] = "ssssiisssssssssss";
		return $RtnVal;
    }  
	//MAS    
	public function updMasG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "update CG_CODE set
	PNM = #{PNM}, PCDDESC = #{PCDDESC}, ORD = #{ORD}, UITOOL = #{UITOOL}, USEYN = #{USEYN}
	, DELYN = #{DELYN}
	, MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
where PCD = #{PCD}
";
		$RtnVal["BINDTYPE"] = "ssissss";
		return $RtnVal;
    }  
	//DTL    
	public function updDtlG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "update  CG_CODED set
	NM = #{NM}, CDDESC = #{CDDESC},ORD = #{ORD}, CDVAL = #{CDVAL}, CDVAL2 = #{CDVAL2}
	, CDMIN = #{CDMIN}, CDMAX = #{CDMAX}, DATATYPE = #{DATATYPE}, EDITYN = #{EDITYN}, FORMATYN = #{FORMATYN}
	, USEYN = #{USEYN}, DELYN = #{DELYN}
	, MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
where  PCD = #{PCD} and CD = #{CD}
";
		$RtnVal["BINDTYPE"] = "ssisssssssssss";
		return $RtnVal;
    }  
	//DTL    
	public function delDtlG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "D";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "delete from CG_CODED 
where PCD = #{PCD} and CD = #{CD}
";
		$RtnVal["BINDTYPE"] = "ss";
		return $RtnVal;
    }  
	//MAS    
	public function delMasG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "D";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "delete from CG_CODE
where PCD = #{PCD} 
";
		$RtnVal["BINDTYPE"] = "s";
		return $RtnVal;
    }  
}
                                                             
?>