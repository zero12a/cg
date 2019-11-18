<?php
//DAO
 
class pifncDao
{
	function __construct(){
		global $log;
		$log->info("PifncDao-__construct");
	}
	function __destruct(){
		global $log;
		$log->info("PifncDao-__destruct");
	}
	function __toString(){
		global $log;
		$log->info("PifncDao-__toString");
	}
	//delFncF    
	public function delFncF($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "D";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLID"] = "delFncF";
		$RtnVal["SQLTXT"] = "delete from  CG_PGMFNC 
where PJTSEQ = #{G3-PJTSEQ} and PGMSEQ = #{G3-PGMSEQ} and GRPSEQ = #{G3-GRPSEQ} and FNCSEQ = #{G3-FNCSEQ}
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "iiii";
		return $RtnVal;
    }  
	//insFncF    
	public function insFncF($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLID"] = "insFncF";
		$RtnVal["SQLTXT"] = "insert into CG_PGMFNC
(
	PJTSEQ, PGMSEQ, GRPSEQ, FNCID, FNCCD
	, FNCNM, FNCTYPE, FNCORD, USEYN, USERDEFJS
	, ADDDT, MODDT
) values (
	#{G1-PJTSEQ}, #{G1-PGMSEQ}, #{G1-GRPSEQ}, #{G3-FNCID}, #{G3-FNCCD}
	, #{G3-FNCNM}, #{G3-FNCTYPE}, #{G3-FNCORD}, #{G3-USEYN}, #{G3-USERDEFJS}
	, #{USER.SEQ}, date_format(sysdate(),'%Y%m%d%H%i%s')
)
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "iiissssissi";
		return $RtnVal;
    }  
	//selFncF    
	public function selFncF($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLID"] = "selFncF";
		$RtnVal["SQLTXT"] = "select
	PJTSEQ, PGMSEQ, GRPSEQ, FNCSEQ, FNCID
	, FNCCD, FNCNM, FNCTYPE, FNCORD, USEYN
	, USERDEFJS
	, ADDDT, MODDT
from 
	CG_PGMFNC
where PJTSEQ = #{G1-PJTSEQ} and PGMSEQ = #{G1-PGMSEQ} and GRPSEQ = #{G1-GRPSEQ}
	and FNCSEQ = #{G2-FNCSEQ}";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "iiii";
		return $RtnVal;
    }  
	//selFncG    
	public function selFncG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLID"] = "selFncG";
		$RtnVal["SQLTXT"] = "select
	PJTSEQ, PGMSEQ, GRPSEQ, FNCSEQ, FNCID
	, FNCCD, FNCNM, FNCTYPE, FNCORD, USEYN
	, USERDEFJS, concat('pisvcView?PJTSEQ=',PJTSEQ,'&PGMSEQ=',PGMSEQ,'&GRPSEQ=',GRPSEQ,'&FNCSEQ=',FNCSEQ,'^SVC^_blank') as LINK
	, ADDDT, MODDT
from 
	CG_PGMFNC
where PJTSEQ = #{G1-PJTSEQ} and PGMSEQ = #{G1-PGMSEQ} and GRPSEQ = #{G1-GRPSEQ}
order by FNCORD asc
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "iii";
		return $RtnVal;
    }  
	//updFncF    
	public function updFncF($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLID"] = "updFncF";
		$RtnVal["SQLTXT"] = "update CG_PGMFNC set
	FNCID = #{G3-FNCID}, FNCCD = #{G3-FNCCD}, FNCNM = #{G3-FNCNM}, FNCTYPE = #{G3-FNCTYPE}, FNCORD = #{G3-FNCORD}
	, USEYN = #{G3-USEYN}, USERDEFJS = #{G3-USERDEFJS}
	, MODID = #{USER.SEQ}, MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
where PJTSEQ = #{G3-PJTSEQ} and PGMSEQ = #{G3-PGMSEQ} and GRPSEQ = #{G3-GRPSEQ} and FNCSEQ = #{G3-FNCSEQ}
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "ssssissiiiii";
		return $RtnVal;
    }  
}
                                                             
?>