<?php
//DAO
 
class test2Dao
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
	public function sql1($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SQLTXT"] = "select
 PJTSEQ,PJTID,PJTNM,FILECHARSET,UITOOL,SVRLANG,PKGROOT,STARTDT,ENDDT,DELYN,ADDDT,MODDT 
from
 CG_PJTINFO	
where DELYN = 'N'
";
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
	//PJT    
	public function sql2($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "D";//CRUD 
		$RtnVal["SQLTXT"] = "update CG_PJTINFO set DELYN = 'Y' where PJTSEQ = #{PJTSEQ} 
";
		$RtnVal["BINDTYPE"] = "s";
		return $RtnVal;
    }  
	//PJT    
	public function sql3($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SQLTXT"] = "update CG_PJTINFO set 
PJTID = #{PJTID}, PJTNM = #{PJTNM},FILECHARSET = #{FILECHARSET}, UITOOL = #{UITOOL}
, SVRLANG = #{SVRLANG}, STARTDT = #{STARTDT}, ENDDT = #{ENDDT}
,PKGROOT = #{PKGROOT} ,MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')  
where PJTSEQ = #{PJTSEQ} 

";
		$RtnVal["BINDTYPE"] = "sssssssss";
		return $RtnVal;
    }  
	//PJT    
	public function sql4($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SQLTXT"] = "insert into CG_PJTINFO (
	PJTID,PJTNM,FILECHARSET,UITOOL,SVRLANG
	,PKGROOT,STARTDT,ENDDT,ADDDT
) values (
	#{PJTID},#{PJTNM},#{FILECHARSET},#{UITOOL},#{SVRLANG}
	,#{PKGROOT},#{STARTDT},#{ENDDT},date_format(sysdate(),'%Y%m%d%H%i%s')	
	)
	";
		$RtnVal["BINDTYPE"] = "ssssssss";
		return $RtnVal;
    }  
	//PGM    
	public function sql6($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SQLTXT"] = "select PJTSEQ,PGMSEQ,PGMID,PGMNM,PKGGRP,ADDDT,MODDT 
from
 CG_PGMINFO	
where PJTSEQ = #{G3_PJTSEQ} 
 ";
		$RtnVal["BINDTYPE"] = "s";
		return $RtnVal;
    }  
	//PGM    
	public function sql7($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SQLTXT"] = "insert into CG_PGMINFO(
 PJTSEQ,PGMID,PGMNM,PKGGRP
 ,ADDDT
) values (
 #{PJTSEQ},#{PGMID},#{PGMNM}, #{PKGGRP}
 ,date_format(sysdate(),'%Y%m%d%H%i%s')	
) 
";
		$RtnVal["BINDTYPE"] = "ssss";
		return $RtnVal;
    }  
	//PGM    
	public function sql8($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SQLTXT"] = "update
 CG_PGMINFO
set 
 PGMNM = #{PGMNM}, PGMID = #{PGMID}, PKGGRP = #{PKGGRP}
 , MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')	
where PJTSEQ = #{PJTSEQ} and PGMSEQ = #{PGMSEQ} 
";
		$RtnVal["BINDTYPE"] = "sssss";
		return $RtnVal;
    }  
	//PGM    
	public function sql9($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "D";//CRUD 
		$RtnVal["SQLTXT"] = "delete from CG_PGMINFO
where PJTSEQ = #{PJTSEQ} and PGMSEQ = #{PGMSEQ} 
";
		$RtnVal["BINDTYPE"] = "ss";
		return $RtnVal;
    }  
	//DD    
	public function sql10($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SQLTXT"] = "select 
 PJTSEQ,COLID,COLNM,COLSNM,DATATYPE,DATASIZE,OBJTYPE,LBLWIDTH,LBLHEIGHT,OBJWIDTH,OBJHEIGHT,OBJALIGN
,ADDDT,MODDT
from CG_DD
where PJTSEQ = #{G3_PJTSEQ} 
";
		$RtnVal["BINDTYPE"] = "s";
		return $RtnVal;
    }  
	//DD    
	public function sql11($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SQLTXT"] = "insert into CG_DD (
PJTSEQ,COLID,COLNM,COLSNM,DATATYPE
,DATASIZE,OBJTYPE,LBLWIDTH,LBLHEIGHT,OBJWIDTH,OBJHEIGHT,OBJALIGN
	,ADDDT
) values (
#{PJTSEQ}, #{COLID}, #{COLNM], #{COLSNM}, #{DATATYPE}, #{DATASIZE}
, #{OBJTYPE}, #{LBLWIDTH}, #{LBLHEIGHT}, #{OBJWIDTH}, #{OBJHEIGHT}
	, #{OBJALIGN}
	,date_format(sysdate(),'%Y%m%d%H%i%s')	
) 
";
		$RtnVal["BINDTYPE"] = "sssssssssss";
		return $RtnVal;
    }  
	//DD    
	public function sql12($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SQLTXT"] = "update CG_DD
set
COLNM = #{COLNM}, COLSNM = #{COLSNM}, DATATYPE = #{DATATYPE}, DATASIZE = #{DATASIZE}
, OBJTYPE = #{OBJTYPE}, LBLWIDTH = #{LBLWIDTH}, LBLHEIGHT = #{LBLHEIGHT}, OBJWIDTH = #{OBJWIDTH}
, OBJHEIGHT = #{OBJHEIGHT}, OBJALIGN = #{OBJALIGN}
, MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
where PJTSEQ = #{PJTSEQ} and COLID = #{COLID} 
";
		$RtnVal["BINDTYPE"] = "ssssssssssss";
		return $RtnVal;
    }  
	//DD    
	public function sql13($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "D";//CRUD 
		$RtnVal["SQLTXT"] = "delete from CG_DD 
where PJTSEQ = #{PJTSEQ} and COLID = #{COLID} 
";
		$RtnVal["BINDTYPE"] = "ss";
		return $RtnVal;
    }  
	//CONFIG    
	public function impR($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SQLTXT"] = "select 
 PJTSEQ,CFGSEQ,CFGID,CFGNM,MVCGBN,PATH,CFGORD,ADDDT,MODDT
from CG_PJTCFG
where PJTSEQ = #{G3_PJTSEQ} 
";
		$RtnVal["BINDTYPE"] = "s";
		return $RtnVal;
    }  
	//CONFIG    
	public function impC($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SQLTXT"] = "insert into CG_PJTCFG (
 PJTSEQ,CFGID,CFGNM,MVCGBN,PATH
 ,CFGORD
 ,ADDDT 
) values (
 #{PJTSEQ},#{CFGID}, #{CFGNM}, #{MVCGBN}, #{PATH}
 , #{CFGORD}
 ,date_format(sysdate(),'%Y%m%d%H%i%s') 
) 
";
		$RtnVal["BINDTYPE"] = "ssssss";
		return $RtnVal;
    }  
	//CONFIG    
	public function impU($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SQLTXT"] = "update CG_PJTCFG set
 CFGID = #{CFGID}, CFGNM = #{CFGNM}, MVCGBN = #{MVCGBN}, PATH = #{PATH}
, MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')  
where PJTSEQ = #{PJTSEQ} and CFGSEQ = #{CFGSEQ}
";
		$RtnVal["BINDTYPE"] = "ssssss";
		return $RtnVal;
    }  
	//CONFIG    
	public function impD($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "D";//CRUD 
		$RtnVal["SQLTXT"] = "delete from CG_PJTCFG
where PJTSEQ = #{PJTSEQ} and CFGSEQ = #{CFGSEQ} 
";
		$RtnVal["BINDTYPE"] = "ss";
		return $RtnVal;
    }  
	//FILE    
	public function fileR($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SQLTXT"] = "SELECT PJTSEQ,FILESEQ,MKFILETYPE,MKFILETYPENM,MKFILEFORMAT,MKFILEEXT,TEMPLATE,FILEORD,USEYN,ADDDT,MODDT
FROM CG_PJTFILE
WHERE PJTSEQ = #{G3_PJTSEQ}
";
		$RtnVal["BINDTYPE"] = "s";
		return $RtnVal;
    }  
	//FILE    
	public function fileC($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SQLTXT"] = "INSERT INTO CG_PJTFILE (
	PJTSEQ, MKFILETYPE, MKFILETYPENM, MKFILEFORMAT, MKFILEEXT
	, TEMPLATE, FILEORD, USEYN, ADDDT
) VALUES (
	#{PJTSEQ}, #{MKFILETYPE}, #{MKFILETYPENM}, #{MKFILEFORMAT}, #{MKFILEEXT}
	,#{TEMPLATE}, #{FILEORD}, #{USEYN}, date_format(sysdate(),'%Y%m%d%H%i%s') 
)";
		$RtnVal["BINDTYPE"] = "ssssssss";
		return $RtnVal;
    }  
	//FILE    
	public function fileU($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SQLTXT"] = "UPDATE CG_PJTFILE SET
	MKFILETYPE = #{MKFILETYPE}, MKFILETYPENM = #{MKFILETYPENM}, MKFILEFORMAT = #{MKFILEFORMAT}, MKFILEEXT = #{MKFILEEXT}, TEMPLATE = #{TEMPLATE}
	, FILEORD = #{FILEORD}, USEYN = #{USEYN}
	, MODDT = date_format(sysdate(),'%Y%m%d%H%i%s') 
WHERE PJTSEQ = #{PJTSEQ} AND FILESEQ = #{FILESEQ}
";
		$RtnVal["BINDTYPE"] = "sssssssss";
		return $RtnVal;
    }  
}
                                                             
?>