<?php
//DAO
 
class authdownDao
{
	function __construct(){
		alog("AuthdownDao-__construct");
	}
	function __destruct(){
		alog("AuthdownDao-__destruct");
	}
	function __toString(){
		alog("AuthdownDao-__toString");
	}
	//권한목록    
	public function selAuthG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
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
		$RtnVal["BINDTYPE"] = "iss";
		return $RtnVal;
    }  
}
                                                             
?>