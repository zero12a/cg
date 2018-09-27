<?php
//DAO
 
class cg_pgminfo_dao
{
	function __construct(){
		alog("cg_pgminfo_dao-__construct");
	}
	function __destruct(){
		alog("cg_pgminfo_dao-__destruct");
	}
	function __toString(){
		alog("cg_pgminfo_dao-__toString");
	}
	

	public function ddSearch($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "
		select
		a.PJTSEQ, a.DDSEQ,a.COLID,a.COLNM,a.DATATYPE,a.DATASIZE
		,ifnull(b.OBJTYPE,'') as OBJTYPE, a.POPUP, a.LBLWIDTH,a.LBLHEIGHT,a.OBJWIDTH
		,a.OBJHEIGHT,a.VALIDSEQ, a.LBLALIGN, a.OBJALIGN
		,a.ADDDT,a.MODDT
	from CG_DD a
		left outer join CG_DDOBJ b on a.DDSEQ = b.DDSEQ and b.GRPTYPE = #{G1-GRPTYPE}
	where a.PJTSEQ=#{F_PJTSEQ} and a.COLID = #{searchdd}
		";
		$RtnVal["BINDTYPE"] = "sis";

		return $RtnVal;
	}  

	public function iocdSearch($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "
		select
		ifnull(b.DDSEQ,'') AS DDSEQ
		,a.COLID,a.ORD
		,ifnull(b.COLNM,'') as COLNM
		,ifnull(b.DATATYPE,'') as DATATYPE
		,ifnull(b.VALIDSEQ,'') as VALIDSEQ            
		,ifnull(b.DATASIZE,'') as DATASIZE
		,ifnull(b.OBJTYPE,'') as OBJTYPE
		,ifnull(b.POPUP,'') as POPUP
		,ifnull(b.LBLWIDTH,'') as LBLWIDTH
		,ifnull(b.LBLALIGN,'') as LBLALIGN            
		,ifnull(b.OBJWIDTH,'') as OBJWIDTH
		,ifnull(b.OBJHEIGHT,'') as OBJHEIGHT
		,ifnull(b.OBJALIGN,'') as OBJALIGN
	  from CG_PGMSQLD a
		left outer join CG_DD b on a.PJTSEQ = b.PJTSEQ and a.COLID = b.COLID
	  where a.SQLGBN = 'O' and a.PJTSEQ = #{G1-PJTSEQ} and a.PGMSEQ = #{G1-PGMSEQ} and a.SQLSEQ = #{G2-SQLSEQ}
	  order by ORD desc
		";
		$RtnVal["BINDTYPE"] = "iii";

		return $RtnVal;
	}  

	public function fnccdSearch($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "
		select a.CD,b.NM,a.CDVAL
		from CG_CODED a join CG_CODED b on  a.CD = b.CD 
		where a.PCD = #{G1-PCD} and b.PCD = 'FNC'
		";
		$RtnVal["BINDTYPE"] = "s";

		return $RtnVal;
	} 

	public function layoutdSearch($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "
        select
          GRPID,GRPTYPE,ORD,REFGRPID,VBOX,GRPWIDTH,GRPHEIGHT
        from CG_LAYOUTD
        where ( PJTSEQ=#{F_PJTSEQ} or 1=1 ) and LAYOUTID = #{F_LAYOUTID}
        order by ORD desc
		";
		$RtnVal["BINDTYPE"] = "is";

		return $RtnVal;
	}  

	public function layoutSearch($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "
		select
			LAYOUTID,GRPCNT
		from CG_LAYOUT
		where PJTSEQ=#{F_PJTSEQ} or 1=1
		order by GRPCNT asc,LAYOUTID asc
		";
		$RtnVal["BINDTYPE"] = "i";

		return $RtnVal;
	}  

	public function pgmSearch($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "
		select
			a.PJTSEQ, c.PJTID, a.PGMSEQ, a.PGMID, a.PGMNM, a.VIEWURL, a.PGMTYPE
			,b.VERDT, b.DEGREE, a.ADDDT, a.MODDT
		from 
			CG_PGMINFO a
				left outer join CG_PGMVER b on a.PJTSEQ = b.PJTSEQ and a.PGMSEQ = b.PGMSEQ and b.ACTIVEYN='Y'
				join CG_PJTINFO c on a.PJTSEQ = c.PJTSEQ
		where a.PJTSEQ = #{POP_PJTSEQ} and (a.PGMID = #{POP_PGMID} or a.PGMNM LIKE #{POP_PGMNM} or a.PGMTYPE LIKE #{POP_PGMTYPE})
		order by a.PGMSEQ desc
		";
		$RtnVal["BINDTYPE"] = "isss";

		return $RtnVal;
	}  

	public function sqldSearch($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "
		select 
			a.COLSEQ, a.PJTSEQ, a.PGMSEQ, a.SQLSEQ, a.DDCOLID, a.COLID, b.DATATYPE, a.SQLGBN, a.ORD, a.ADDDT, a.MODDT 
		from CG_PGMSQLD a
			left outer join CG_DD b on a.PJTSEQ = b.PJTSEQ and a.DDCOLID = b.COLID
		where a.PJTSEQ=#{G2-PJTSEQ} and a.PGMSEQ = #{G2-PGMSEQ} and a.SQLSEQ = #{G2-SQLSEQ}
		order by a.SQLGBN,a.ORD asc
		";
		$RtnVal["BINDTYPE"] = "iii";

		return $RtnVal;
	}  

	public function sqlrSearch($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "
		select
			SQLRSEQ,PJTSEQ,PGMSEQ,SVCSEQ,SQLID,ORD,ADDDT,MODDT
		from CG_PGMSQLR where PJTSEQ = #{F_PJTSEQ} and PGMSEQ = #{F_PGMSEQ} and SVCSEQ = #{G9-SVCSEQ}
		order by ORD asc
		";
		$RtnVal["BINDTYPE"] = "iii";

		return $RtnVal;
	}  



	public function svcSearch($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "
		select
		SVCSEQ,PJTSEQ,PGMSEQ,GRPSEQ,FNCSEQ,ORD,SVCGRPID,ADDDT,MODDT
	  from CG_PGMSVC 
	  where PJTSEQ = #{G5-PJTSEQ} and PGMSEQ = #{G5-PGMSEQ} and GRPSEQ = #{G5-GRPSEQ} and FNCSEQ = #{G5-FNCSEQ}
	  order by ORD desc
		";
		$RtnVal["BINDTYPE"] = "iiii";

		return $RtnVal;
	}  

	public function inheritSearch($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "
		select
			INHERITSEQ,PJTSEQ,PGMSEQ,GRPSEQ,COLID,CHILDGRPID,ADDDT,MODDT
	  	from CG_PGMINHERIT where PJTSEQ = #{F_PJTSEQ} and PGMSEQ = #{F_PGMSEQ} and GRPSEQ = #{G1-GRPSEQ}
		";
		$RtnVal["BINDTYPE"] = "iii";

		return $RtnVal;
	}  

	public function ioSearch($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "
        select
		  a.PJTSEQ, a.PGMSEQ, a.GRPSEQ, a.IOSEQ, b.DDSEQ
          , a.COLID, a.COLORD, a.COLNM, a.DATATYPE,ifnull(a.VALIDSEQ,'') AS VALIDSEQ
          , a.DATASIZE, a.OBJTYPE, a.POPUP, a.BRYN, a.LBLHIDDENYN
          , a.LBLWIDTH, a.LBLALIGN, a.OBJWIDTH, a.OBJHEIGHT, a.OBJALIGN
          , a.KEYYN, a.SEQYN, a.HIDDENYN, a.EDITYN, a.FNINIT, a.FORMAT, a.FOOTERNM
          , ifnull(a.FOOTERMATH,'') as FOOTERMATH
          , a.ADDDT, a.MODDT
        from CG_PGMIO a
            left outer join CG_DD b on a.PJTSEQ = b.PJTSEQ and a.COLID = b.COLID
        where a.PJTSEQ=#{F_PJTSEQ} and a.PGMSEQ = #{F_PGMSEQ} and a.GRPSEQ = #{G1-GRPSEQ}
        ORDER BY a.COLORD ASC
		";
		$RtnVal["BINDTYPE"] = "iii";

		return $RtnVal;
	}  

	public function fncSearch($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "
		select
            PJTSEQ,PGMSEQ,GRPSEQ,FNCSEQ,IF(USEYN='Y',1,0) AS USEYN,FNCID,FNCCD,FNCNM,FNCTYPE,FNCORD,ADDDT,MODDT
          from CG_PGMFNC where PJTSEQ = #{F_PJTSEQ} and PGMSEQ = #{F_PGMSEQ} and GRPSEQ = #{G1-GRPSEQ}
		";
		$RtnVal["BINDTYPE"] = "iii";

		return $RtnVal;
	}  



	public function sqlSearch($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "
		select PJTSEQ,PGMSEQ,SQLSEQ,SQLID,SQLNM,SVRSEQ,CRUD,RTN_TYPE,SQLORD,SQLTXT,ADDDT,MODDT 
		from CG_PGMSQL 
		where PJTSEQ = #{F_PJTSEQ} and PGMSEQ = #{F_PGMSEQ}
		";
		$RtnVal["BINDTYPE"] = "ii";

		return $RtnVal;
    }  
   
	public function grpSearch($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "
		select
        PJTSEQ,PGMSEQ,GRPSEQ,GRPID,GRPTYPE,GRPNM,GRPORD,FREEZECNT,REFGRPID,VBOX,GRPWIDTH,GRPHEIGHT,COLSIZETYPE,LEGENDALIGN,STACKED,concat(GRPID,' - ',GRPNM,'^^GRP') as PROPERTY,ADDDT,MODDT
      from CG_PGMGRP where PJTSEQ = #{F_PJTSEQ} and PGMSEQ = #{F_PGMSEQ}
      order by GRPORD	
		";
		$RtnVal["BINDTYPE"] = "ii";
		return $RtnVal;
    }  
	
}
                                                             
?>