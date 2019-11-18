<?php
//DAO
 
class authdownDao
{
	function __construct(){
		global $log;
		$log->info("AuthdownDao-__construct");
	}
	function __destruct(){
		global $log;
		$log->info("AuthdownDao-__destruct");
	}
	function __toString(){
		global $log;
		$log->info("AuthdownDao-__toString");
	}
	//권한목록    
	public function selAuthG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLID"] = "selAuthG";
		$RtnVal["SQLTXT"] = "select 
	F.FNCSEQ as FNCSEQ
	, P.PGMID as PGMID
	, concat(G.GRPID,'_',F.FNCID) as AUTH_ID
	, concat(G.GRPNM,'_',F.FNCNM) as AUTH_NM
	,'Y' as USE_YN
	,concat(P.PGMID,'^#^',P.PGMNM,'^','G2')  
from 
	CG_PGMINFO P
	join CG_PGMGRP G on P.PGMSEQ = G.PGMSEQ
	join CG_PGMFNC F on P.PGMSEQ = F.PGMSEQ and G.GRPSEQ = F.GRPSEQ
where P.PJTSEQ = #{G1-PJTSEQ} and P.PGMID like if(#{G1-PGMID}='','%',#{G1-PGMID})

";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "iss";
		return $RtnVal;
    }  
}
                                                             
?>