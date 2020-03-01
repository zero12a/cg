<?php
//DAO
 
class authdeployDao
{
	function __construct(){
		global $log;
		$log->info("AuthdeployDao-__construct");
	}
	function __destruct(){
		global $log;
		$log->info("AuthdeployDao-__destruct");
	}
	function __toString(){
		global $log;
		$log->info("AuthdeployDao-__toString");
	}
	//insSvcAuth    
	public function insSvcAuth($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "OS";
		$RtnVal["SQLID"] = "insSvcAuth";
		$RtnVal["SQLTXT"] = "insert into CMN_AUTH (
	PGMID, AUTH_ID, AUTH_NM, USE_YN
	,ADD_DT
)
select 
	#{PGMID} as PGMID, #{AUTH_ID} as AUTH_ID, #{AUTH_NM} as AUTH_NM, 'Y' as USE_YN
	, date_format(sysdate(),'%Y%m%d%H%i%s') as ADD_DT
from CMN_MNU
where 
 0 =  ( select count(MNU_SEQ)  from CMN_AUTH where PGMID = #{PGMID} and AUTH_ID = #{AUTH_ID})
limit 1";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "sssss";
		return $RtnVal;
    }  
	//insSvcPgm    
	public function insSvcPgmG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "OS";
		$RtnVal["SQLID"] = "insSvcPgmG";
		$RtnVal["SQLTXT"] = "insert into CMN_MNU (
	MNU_NM, PGMID, URL, PGMTYPE, MNU_ORD
	, FOLDER_SEQ, USE_YN, ADD_DT, ADD_ID
)
select 
	#{PGMNM} as MNU_NM, #{PGMID} as PGMID, #{VIEWURL} as URL, #{PGMTYPE} as PGMTYPE, 10 as MNU_ORD
	, 0 as FOLER_SEQ, 'Y' as USE_YN, date_format(sysdate(),'%Y%m%d%H%i%s') as ADD_DT, 0 as ADD_ID
from CMN_MNU
where 
 0 =  ( select count(MNU_SEQ)  from CMN_MNU where PGMID = #{PGMID} )
limit 1";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "sssss";
		return $RtnVal;
    }  
	//AUTH    
	public function sAuthG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CGPJT1";
		$RtnVal["SQLID"] = "sAuthG";
		$RtnVal["SQLTXT"] = "  SELECT 
 		0 as CHK
		, concat(p.PGMID,'-',g.GRPID,'_',f.FNCID) as ROWID
      ,p.PGMID 
      ,concat(g.GRPID,'_',f.FNCID) as AUTH_ID
      ,concat(g.GRPNM,'_',f.FNCNM) as AUTH_NM 
	  ,f.ADDDT
  FROM 
      CG_PGMGRP g
      JOIN CG_PGMFNC f on g.GRPSEQ = f.GRPSEQ and g.PGMSEQ = f.PGMSEQ
      JOIN CG_PGMINFO p on p.PGMSEQ = g.PGMSEQ
  WHERE p.PJTSEQ = #{G1-PJTSEQ} AND ( f.FNCTYPE != '' && f.FNCTYPE is not null )
      order by p.PGMID,g.GRPORD asc,f.FNCORD asc  
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "i";
		return $RtnVal;
    }  
	//PGM    
	public function sPgmG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CGPJT1";
		$RtnVal["SQLID"] = "sPgmG";
		$RtnVal["SQLTXT"] = "SELECT 
        0 as CHK, PGMSEQ, PGMID, PGMNM, PKGGRP, VIEWURL, PGMTYPE, SECTYPE, ADDDT, MODDT
    FROM 
        CG_PGMINFO
    WHERE PJTSEQ = #{G1-PJTSEQ}
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "i";
		return $RtnVal;
    }  
	//SVCAUTH    
	public function sSvcAuthG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "OS";
		$RtnVal["SQLID"] = "sSvcAuthG";
		$RtnVal["SQLTXT"] = "SELECT 
	AUTH_SEQ, PGMID, AUTH_ID, AUTH_NM, USE_YN
	, ADD_DT, MOD_DT 
FROM CMN_AUTH
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
	//SVCMENU    
	public function sSvcMenuG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "OS";
		$RtnVal["SQLID"] = "sSvcMenuG";
		$RtnVal["SQLTXT"] = "SELECT 
	MNU_SEQ, MNU_NM, PGMID, URL, PGMTYPE
	, MNU_ORD, FOLDER_SEQ, USE_YN, ADD_DT, ADD_ID
	,MOD_DT, MOD_ID  
FROM CMN_MNU";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
}
                                                             
?>