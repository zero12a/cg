<?php
//DAO
 
class codetestDao
{
	function __construct(){
		alog("CodetestDao-__construct");
	}
	function __destruct(){
		alog("CodetestDao-__destruct");
	}
	function __toString(){
		alog("CodetestDao-__toString");
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
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
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
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
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
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
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
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
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
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
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
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array("CDMIN"	);
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
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "delete from CG_CODE
where PCD = #{PCD} 
";
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
		$RtnVal["SVRID"] = "CG";
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
	//aa    
	public function aa($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "aaaa";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
	//MAS    
	public function hitMasG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "update CG_CODE set ORD = ORD + 1  where PCD = #{G2-PCD}";
		$RtnVal["PARENT_FNCTYPE"] = "R"; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "s";
		return $RtnVal;
    }  
	//DTL    
	public function hitDtlG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "update CG_CODED set ORD = ORD + 1 where CD = #{CD} and PCD = #{PCD}  and ORD = #{ORD}
";
		$RtnVal["PARENT_FNCTYPE"] = "U"; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array("ORD"	);
		$RtnVal["BINDTYPE"] = "ssi";
		return $RtnVal;
    }  
	//MASD    
	public function updMasD($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "update
	CG_CODE
set
	PCDDESC = #{G4-ADD_DT}
where PCD = #{G4-PCD}";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "ss";
		return $RtnVal;
    }  
}
                                                             
?>