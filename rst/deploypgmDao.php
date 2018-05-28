<?php
//DAO
 
class deploypgmDao
{
	function __construct(){
		alog("DeploypgmDao-__construct");
	}
	function __destruct(){
		alog("DeploypgmDao-__destruct");
	}
	function __toString(){
		alog("DeploypgmDao-__toString");
	}
	//PGM    
	public function sPgmG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "SELECT 
        0 as CHK, PGMSEQ, PGMID, PGMNM, PKGGRP, VIEWURL, PGMTYPE, SECTYPE, ADDDT, MODDT
    FROM 
        CG.CG_PGMINFO
    WHERE PJTSEQ = #{G1-PJTSEQ}
";
		$RtnVal["BINDTYPE"] = "i";
		return $RtnVal;
	}  
	
	//MNU 
	public function insMnuG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "
		insert into CMN_MNU (
			PGMID, MNU_NM, URL, MNU_ORD, FOLDER_SEQ
			,USE_YN, PGMTYPE, ADD_DT, ADD_ID
		) values (
			#{PGMID}, #{PGMNM}, #{VIEWURL}, if(#{MNU_ORD}='',10,#{MNU_ORD}), #{FOLDER_SEQ}
			,if(#{USE_YN}='','Y',#{USE_YN}), #{PGMTYPE}, date_format(sysdate(),'%Y%m%d%H%i%s'), #{USER.SEQ}
		)		
";
		$RtnVal["BINDTYPE"] = "sssii isssi";
		return $RtnVal;
	}  
		
	//AUTH    
	public function sAuthG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "  SELECT 
 		0 as CHK
		, concat(p.PGMID,'-',g.GRPID,'_',f.FNCID) as ROWID
      ,p.PGMID 
      ,concat(g.GRPID,'_',f.FNCID) as AUTH_ID
      ,concat(g.GRPNM,'_',f.FNCNM) as AUTH_NM 
  FROM 
      CG.CG_PGMGRP g
      JOIN CG.CG_PGMFNC f on g.GRPSEQ = f.GRPSEQ and g.PGMSEQ = f.PGMSEQ
      JOIN CG.CG_PGMINFO p on p.PGMSEQ = g.PGMSEQ
  WHERE p.PJTSEQ = #{G1-PJTSEQ} AND ( f.FNCTYPE != '' && f.FNCTYPE is not null )
      order by p.PGMID,g.GRPORD asc,f.FNCORD asc  
";
		$RtnVal["BINDTYPE"] = "i";
		return $RtnVal;
    }  
	//FILE    
	public function sFileG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "    SELECT 
        0 as CHK, PGMSEQ, VERSEQ, FILESEQ, FILETYPE, FILENM, FILEHASH, FILESIZE, ADDDT, MODDT
    FROM 
        CG.CG_RSTFILE
    WHERE PJTSEQ = #{G1-PJTSEQ} and ACTIVEYN = 'Y'
";
		$RtnVal["BINDTYPE"] = "i";
		return $RtnVal;
    }  
}
                                                             
?>