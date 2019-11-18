<?php
//DAO
 
class pigrpDao
{
	function __construct(){
		global $log;
		$log->info("PigrpDao-__construct");
	}
	function __destruct(){
		global $log;
		$log->info("PigrpDao-__destruct");
	}
	function __toString(){
		global $log;
		$log->info("PigrpDao-__toString");
	}
	//delGrpF    
	public function delGrpF($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "D";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLID"] = "delGrpF";
		$RtnVal["SQLTXT"] = "delete from  CG_PGMGRP 
where PJTSEQ = #{G3-PJTSEQ}  and PGMSEQ = #{G3-PGMSEQ} and GRPSEQ =  #{G3-GRPSEQ}
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "iii";
		return $RtnVal;
    }  
	//insGrpF    
	public function insGrpF($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLID"] = "insGrpF";
		$RtnVal["SQLTXT"] = "insert into CG_PGMGRP
(
	PJTSEQ, PGMSEQ, GRPID, GRPTYPE, GRPNM
	, GRPORD, FREEZECNT, VBOX, REFGRPID, GRPWIDTH
	, GRPHEIGHT, COLSIZETYPE, LEGENDALIGN, STACKED
	, ADDID, ADDDT
) values (
	#{G1-PJTSEQ} , #{G1-PGMSEQ}, #{G3-GRPID}, #{G3-GRPTYPE}, #{G3-GRPNM} 
	, #{G3-GRPORD}, #{G3-FREEZECNT}, #{G3-VBOX}, #{G3-REFGRPID}, #{G3-GRPWIDTH} 
	, #{G3-GRPHEIGHT}, #{G3-COLSIZETYPE}, #{G3-LEGENDALIGN}, #{G3-STACKED}
	, #{USER.SEQ}, date_format(sysdate(),'%Y%m%d%H%i%s')
)
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "iisssiisssssssi";
		return $RtnVal;
    }  
	//selGrpF    
	public function selGrpF($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLID"] = "selGrpF";
		$RtnVal["SQLTXT"] = "select
	PJTSEQ, PGMSEQ, GRPSEQ, GRPID, GRPTYPE
	, GRPNM, GRPORD, FREEZECNT, VBOX, REFGRPID
	, GRPWIDTH, GRPHEIGHT, COLSIZETYPE, LEGENDALIGN, STACKED
	, ADDDT, MODDT
from CG_PGMGRP
where PJTSEQ = #{G2-PJTSEQ} and PGMSEQ = #{G2-PGMSEQ} and GRPSEQ = #{G2-GRPSEQ}
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array("G2-GRPSEQ"	);
		$RtnVal["BINDTYPE"] = "iii";
		return $RtnVal;
    }  
	//selGrpG    
	public function selGrpG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLID"] = "selGrpG";
		$RtnVal["SQLTXT"] = "select
	PJTSEQ, PGMSEQ, GRPSEQ, GRPID, GRPTYPE, GRPNM, GRPORD
	,concat(
		'pifncView?PJTSEQ=',PJTSEQ,'&PGMSEQ=',PGMSEQ,'&GRPSEQ=',GRPSEQ,'^FNC^_blank'
		,',piioView?PJTSEQ=',PJTSEQ,'&PGMSEQ=',PGMSEQ,'&GRPSEQ=',GRPSEQ,'^IO^_blank'
		,',piinheritView?PJTSEQ=',PJTSEQ,'&PGMSEQ=',PGMSEQ,'&GRPSEQ=',GRPSEQ,'^INHERIT^_blank'
	) as LINK
	,ADDDT, MODDT
from CG_PGMGRP
where PJTSEQ = #{G1-PJTSEQ} and PGMSEQ = #{G1-PGMSEQ}
order by GRPORD asc";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "ii";
		return $RtnVal;
    }  
	//updGrpF    
	public function updGrpF($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLID"] = "updGrpF";
		$RtnVal["SQLTXT"] = "update CG_PGMGRP set 
	GRPID = #{G3-GRPID}, GRPTYPE = #{G3-GRPTYPE}, GRPNM = #{G3-GRPNM} , GRPORD = #{G3-GRPORD}, FREEZECNT = #{G3-FREEZECNT}
	, VBOX = #{G3-VBOX}, REFGRPID = #{G3-REFGRPID}, GRPWIDTH = #{G3-GRPWIDTH} , GRPHEIGHT = #{G3-GRPHEIGHT}, COLSIZETYPE = #{G3-COLSIZETYPE}
	, LEGENDALIGN = #{G3-LEGENDALIGN}, STACKED = #{G3-STACKED}
	, MODID = #{USER.SEQ}, MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
where PJTSEQ = #{G3-PJTSEQ}  and PGMSEQ = #{G3-PGMSEQ} and GRPSEQ =  #{G3-GRPSEQ}
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "sssiisssssssiiii";
		return $RtnVal;
    }  
}
                                                             
?>