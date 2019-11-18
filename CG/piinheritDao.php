<?php
//DAO
 
class piinheritDao
{
	function __construct(){
		global $log;
		$log->info("PiinheritDao-__construct");
	}
	function __destruct(){
		global $log;
		$log->info("PiinheritDao-__destruct");
	}
	function __toString(){
		global $log;
		$log->info("PiinheritDao-__toString");
	}
	//delInherF    
	public function delInherF($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "D";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLID"] = "delInherF";
		$RtnVal["SQLTXT"] = "delete from CG_PGMINHERIT
where PJTSEQ = #{G3-PJTSEQ} and PGMSEQ = #{G3-PGMSEQ} and GRPSEQ = #{G3-GRPSEQ} and INHERITSEQ = #{G3-INHERITSEQ} 
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "iiii";
		return $RtnVal;
    }  
	//insInherF    
	public function insInherF($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLID"] = "insInherF";
		$RtnVal["SQLTXT"] = "insert into CG_PGMINHERIT
(
	PJTSEQ, PGMSEQ, GRPSEQ, COLID, CHILDGRPID
	, ADDID, ADDDT
) values (
	#{G1-PJTSEQ}, #{G1-PGMSEQ}, #{G1-GRPSEQ}, #{G3-COLID}, #{G3-CHILDGRPID}
	, #{USER.SEQ}, date_format(sysdate(),'%Y%m%d%H%i%s')
)
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "iiissi";
		return $RtnVal;
    }  
	//selInherF    
	public function selInherF($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLID"] = "selInherF";
		$RtnVal["SQLTXT"] = "select
	INHERITSEQ, PJTSEQ, PGMSEQ, GRPSEQ, COLID, CHILDGRPID
	, ADDDT, MODDT
from
	CG_PGMINHERIT
where 
	PJTSEQ = #{G1-PJTSEQ} and PGMSEQ = #{G1-PGMSEQ} and GRPSEQ = #{G1-GRPSEQ} and INHERITSEQ = #{G2-INHERITSEQ}";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "iiii";
		return $RtnVal;
    }  
	//selInherG    
	public function selInherG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLID"] = "selInherG";
		$RtnVal["SQLTXT"] = "select
	INHERITSEQ, PJTSEQ, PGMSEQ, GRPSEQ, COLID, CHILDGRPID
	, ADDDT, MODDT
from
	CG_PGMINHERIT
where 
	PJTSEQ = #{G1-PJTSEQ} and PGMSEQ = #{G1-PGMSEQ} and GRPSEQ = #{G1-GRPSEQ}
	";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "iii";
		return $RtnVal;
    }  
	//updInherF    
	public function updInherF($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLID"] = "updInherF";
		$RtnVal["SQLTXT"] = "update CG_PGMINHERIT set
	COLID = #{G3-COLID}, CHILDGRPID = #{G3-CHILDGRPID}
	, MODID = #{USER.SEQ}, MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
where PJTSEQ = #{G3-PJTSEQ} and PGMSEQ = #{G3-PGMSEQ} and GRPSEQ = #{G3-GRPSEQ} and INHERITSEQ = #{G3-INHERITSEQ} 
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "ssiiiii";
		return $RtnVal;
    }  
}
                                                             
?>