<?php
//DAO
 
class codemngDao
{
	function __construct(){
		global $log;
		$log->info("CodemngDao-__construct");
	}
	function __destruct(){
		global $log;
		$log->info("CodemngDao-__destruct");
	}
	function __toString(){
		global $log;
		$log->info("CodemngDao-__toString");
	}
	//DTL    
	public function delDtlG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "D";//CRUD 
		$RtnVal["SVRID"] = "CGCORE";
		$RtnVal["SQLID"] = "delDtlG";
		$RtnVal["SQLTXT"] = "delete from CG_CODED 
where PCD = #{PCD} and CD = #{CD}
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "ss";
		return $RtnVal;
    }  
	//MAS    
	public function delMasG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "D";//CRUD 
		$RtnVal["SVRID"] = "CGCORE";
		$RtnVal["SQLID"] = "delMasG";
		$RtnVal["SQLTXT"] = "delete from CG_CODE
where PCD = #{PCD} 
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "s";
		return $RtnVal;
    }  
	//DTL    
	public function insDtlG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SVRID"] = "CGCORE";
		$RtnVal["SQLID"] = "insDtlG";
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
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "ssssiisssssssssss";
		return $RtnVal;
    }  
	//MAS    
	public function insMasG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SVRID"] = "CGCORE";
		$RtnVal["SQLID"] = "insMasG";
		$RtnVal["SQLTXT"] = "insert into CG_CODE (
	PCD,PNM,PCDDESC,ORD
	,UITOOL,USEYN,DELYN
	,ADDDT
) values (
	#{PCD},#{PNM},#{PCDDESC},if(#{ORD}='','10',#{ORD})
	,#{UITOOL},if(#{USEYN}='','Y',#{USEYN}),if(#{DELYN}='','N',#{DELYN})
	,date_format(sysdate(),'%Y%m%d%H%i%s')
)";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "sssiisssss";
		return $RtnVal;
    }  
	//DTL    
	public function selDtlG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CGCORE";
		$RtnVal["SQLID"] = "selDtlG";
		$RtnVal["SQLTXT"] = "select
	CODED_SEQ,CD,NM,CDDESC,PCD,ORD
	,CDVAL,CDVAL2,CDMIN,CDMAX,DATATYPE
	,EDITYN,FORMATYN,USEYN,DELYN
	,ADDDT,MODDT
from CG_CODED
where PCD = #{G2-PCD}
order by ORD ";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "s";
		return $RtnVal;
    }  
	//MAS    
	public function selMasD($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CGCORE";
		$RtnVal["SQLID"] = "selMasD";
		$RtnVal["SQLTXT"] = "select 
	'LINESTART' as MYRADIO, 'LINESTART,LINEEND' as MYCHECK, '20191212' as ADD_DT
from 
	CG_CODE
where PCD = #{G2-PCD}
order by ORD asc";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "s";
		return $RtnVal;
    }  
	//MAS    
	public function selMasG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CGCORE";
		$RtnVal["SQLID"] = "selMasG";
		$RtnVal["SQLTXT"] = "select 
	PCD,PNM,PCDDESC,ORD
	,UITOOL,USEYN,DELYN
	,ADDDT,MODDT
from 
	CG_CODE
order by ORD asc";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
	//DTL    
	public function updDtlG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "CGCORE";
		$RtnVal["SQLID"] = "updDtlG";
		$RtnVal["SQLTXT"] = "update  CG_CODED set
	CD = #{CD}, NM = #{NM}, CDDESC = #{CDDESC},ORD = #{ORD}, CDVAL = #{CDVAL}, CDVAL2 = #{CDVAL2}
	, CDMIN = #{CDMIN}, CDMAX = #{CDMAX}, DATATYPE = #{DATATYPE}, EDITYN = #{EDITYN}, FORMATYN = #{FORMATYN}
	, USEYN = #{USEYN}, DELYN = #{DELYN}, PCD = #{PCD}
	, MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
where  CODED_SEQ = #{CODED_SEQ}
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "sssissssssssssi";
		return $RtnVal;
    }  
	//MAS    
	public function updMasG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "CGCORE";
		$RtnVal["SQLID"] = "updMasG";
		$RtnVal["SQLTXT"] = "update CG_CODE set
	PNM = #{PNM}, PCDDESC = #{PCDDESC}, ORD = #{ORD}, UITOOL = #{UITOOL}, USEYN = #{USEYN}
	, DELYN = #{DELYN}
	, MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
where PCD = #{PCD}
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "ssissss";
		return $RtnVal;
    }  
}
                                                             
?>