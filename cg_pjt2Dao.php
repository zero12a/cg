<?php
//DAO
 
class Pjt2Dao
{
	function __construct(){
		alog("Test2Dao-__construct");
	}
	function __destruct(){
		alog("Test2Dao-__destruct");
	}
	function __toString(){
		alog("Test2Dao-__toString");
	}
	//PJT    
	public function getSql1($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SQLTXT"] = "select
 PJTID,PJTNM,DELYN,UITOOL,SVRLANG,PKGROOT,ADDDT,MODDT
from
 CG_PJTINFO	
";
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
	//PJT    
	public function getSql2($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "D";//CRUD 
		$RtnVal["SQLTXT"] = "delete from CG_PJTINFO where PJTID = #PJTID#";
		$RtnVal["BINDTYPE"] = "s";
		return $RtnVal;
    }  
	//PJT    
	public function getSql3($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SQLTXT"] = "update CG_PJTINFO set PJTNM = #PJTNM#, UITOOL = #UITOOL#, SVRLANG = #SVRLANG#, PKGROOT = #PKGROOT#, MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
where PJTID = #PJTID#
";
		$RtnVal["BINDTYPE"] = "sssss";
		return $RtnVal;
    }  
	//PJT    
	public function getSql4($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SQLTXT"] = "insert into CG_PJTINFO (
	PJTID,PJTNM,UITOOL,SVRLANG,PKGROOT,ADDDT
) values (
#PJTID#,#PJTNM#,#UITOOL#,#SVRLANG#,#PKGROOT#,date_format(sysdate(),'%Y%m%d%H%i%s')	

	
	)";
		$RtnVal["BINDTYPE"] = "sssss";
		return $RtnVal;
    }  
	//PGM    
	public function getSql6($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SQLTXT"] = "select PJTID,PGMID,PGMNM,PKGGRP,ADDDT,MODDT 
from
 CG_PGMINFO	
where PJTID = #G3_PJTID#
order by ADDDT desc
";
		$RtnVal["BINDTYPE"] = "s";
		return $RtnVal;
    }  
	//PGM    
	public function getSql7($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SQLTXT"] = "insert into CG_PGMINFO(PJTID,PGMID,PGMNM,PKGGRP,ADDDT) values (
#PJTID#,#PGMID#,#PGMNM#,#PKGGRP#,date_format(sysdate(),'%Y%m%d%H%i%s')	
)";
		$RtnVal["BINDTYPE"] = "ssss";
		return $RtnVal;
    }  
	//PGM    
	public function getSql8($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SQLTXT"] = "update
 CG_PGMINFO
set 
 PGMNM = #PGMNM#
 , PKGGRP = #PKGGRP#
 , MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')	
where PJTID = #PJTID# and PGMID = #PGMID#
order by ADDDT desc
";
		$RtnVal["BINDTYPE"] = "ssss";
		return $RtnVal;
    }  
	//PGM    
	public function getSql9($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "D";//CRUD 
		$RtnVal["SQLTXT"] = "delete from CG_PGMINFO
where PJTID = #PJTID# and PGMID = #PGMID#";
		$RtnVal["BINDTYPE"] = "ss";
		return $RtnVal;
    }  
	//DD    
	public function getSql10($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SQLTXT"] = "select 
 PJTID,COLID,COLNM,COLSNM,DATATYPE,DATASIZE,OBJTYPE,LBLWIDTH,LBLHEIGHT,OBJWIDTH,OBJHEIGHT,OBJALIGN,ADDDT,MODDT
from CG_DD
where PJTID = #G3_PJTID#
order by ADDDT desc
";
		$RtnVal["BINDTYPE"] = "s";
		return $RtnVal;
    }  
	//DD    
	public function getSql11($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SQLTXT"] = "insert into CG_DD (
	PJTID,COLID,COLNM,COLSNM,DATATYPE
	,DATASIZE,OBJTYPE,LBLWIDTH,LBLHEIGHT,OBJWIDTH
	,OBJHEIGHT,OBJALIGN,ADDDT
) values (
	#PJTID#, #COLID#, #COLNM#, #COLSNM#, #DATATYPE#
	, #DATASIZE#, #OBJTYPE#, #LBLWIDTH#, #LBLHEIGHT#, #OBJWIDTH#
	, #OBJHEIGHT#, #OBJALIGN#,date_format(sysdate(),'%Y%m%d%H%i%s') 
)";
		$RtnVal["BINDTYPE"] = "sssss sssss ss";
		return $RtnVal;
    }  
	//DD    
	public function getSql12($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SQLTXT"] = "update CG_DD
set
	COLNM = #COLNM#, COLSNM = #COLSNM#, DATATYPE = #DATATYPE#, DATASIZE = #DATASIZE#, OBJTYPE = #OBJTYPE#
	, LBLWIDTH = #LBLWIDTH#, LBLHEIGHT = #LBLHEIGHT#, OBJWIDTH = #OBJWIDTH#, OBJHEIGHT = #OBJHEIGHT#, OBJALIGN = #OBJALIGN#
	, MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
where PJTID = #PJTID# and COLID = #COLID#";
		$RtnVal["BINDTYPE"] = "sssss sssss ss";
		return $RtnVal;
    }  
	//DD    
	public function getSql13($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "D";//CRUD 
		$RtnVal["SQLTXT"] = "delete from CG_DD 
where PJTID = #PJTID# and COLID = #COLID#";
		$RtnVal["BINDTYPE"] = "ss";
		return $RtnVal;
    }  
}
                                                             
?>