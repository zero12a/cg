<?php
//DAO
 
class pisvcDao
{
	function __construct(){
		global $log;
		$log->info("PisvcDao-__construct");
	}
	function __destruct(){
		global $log;
		$log->info("PisvcDao-__destruct");
	}
	function __toString(){
		global $log;
		$log->info("PisvcDao-__toString");
	}
	//delSvcF    
	public function delSvcF($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "D";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLID"] = "delSvcF";
		$RtnVal["SQLTXT"] = "delete from  CG_PGMSVC
where PJTSEQ = #{G3-PJTSEQ} and PGMSEQ = #{G3-PGMSEQ} and FNCSEQ = #{G3-FNCSEQ} and SVCSEQ = #{G3-SVCSEQ}
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "iiii";
		return $RtnVal;
    }  
	//insSvcF    
	public function insSvcF($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLID"] = "insSvcF";
		$RtnVal["SQLTXT"] = "insert into CG_PGMSVC
(
	PJTSEQ, PGMSEQ, GRPSEQ, FNCSEQ, SVCGRPID
	, ORD
	, ADDID, ADDDT
) values (
	#{G1-PJTSEQ}, #{G1-PGMSEQ}, #{G1-GRPSEQ},  #{G1-FNCSEQ}, #{G3-SVCGRPID}
	, #{G3-ORD}
	, #{USER.SEQ},  date_format(sysdate(),'%Y%m%d%H%i%s')
)
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "iiiisii";
		return $RtnVal;
    }  
	//selSvcF    
	public function selSvcF($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLID"] = "selSvcF";
		$RtnVal["SQLTXT"] = "select 
	SVCSEQ, PJTSEQ, PGMSEQ, GRPSEQ, FNCSEQ
	, SVCGRPID, ORD, ADDDT, MODDT
from
	CG_PGMSVC
where 
	PJTSEQ = #{G1-PJTSEQ} and PGMSEQ = #{G1-PGMSEQ} and GRPSEQ = #{G1-GRPSEQ} and FNCSEQ = #{G1-FNCSEQ}
	and SVCSEQ = #{G2-SVCSEQ}
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "iiiii";
		return $RtnVal;
    }  
	//selSvcG    
	public function selSvcG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLID"] = "selSvcG";
		$RtnVal["SQLTXT"] = "select 
	SVCSEQ, PJTSEQ, PGMSEQ, GRPSEQ, FNCSEQ
	, SVCGRPID, ORD, concat('piSqlrView?PJTSEQ=', PJTSEQ, '&PGMSEQ=', PGMSEQ, '&GRPSEQ=', GRPSEQ , '&FNCSEQ=', FNCSEQ, '&SVCSEQ=', SVCSEQ, '^sqlr^_blank') as LINK, ADDDT, MODDT
from
	CG_PGMSVC
where 
	PJTSEQ = #{G1-PJTSEQ} and PGMSEQ = #{G1-PGMSEQ} and GRPSEQ = #{G1-GRPSEQ} and FNCSEQ = #{G1-FNCSEQ}
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "iiii";
		return $RtnVal;
    }  
	//updSvcF    
	public function updSvcF($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLID"] = "updSvcF";
		$RtnVal["SQLTXT"] = "update CG_PGMSVC set
	SVCGRPID =  #{G3-SVCGRPID}, ORD = #{G3-ORD}
	, MODID = #{USER.SEQ},  MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
where PJTSEQ = #{G3-PJTSEQ} and PGMSEQ = #{G3-PGMSEQ} and FNCSEQ = #{G3-FNCSEQ} and SVCSEQ = #{G3-SVCSEQ}
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "siiiiii";
		return $RtnVal;
    }  
}
                                                             
?>