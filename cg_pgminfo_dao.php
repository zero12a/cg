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


	/*
	######################################################
	##	SQLD
	######################################################
	*/
	public function sqldSearch($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["REQUIRE"] = array("G2-SQLSEQ");
		$RtnVal["SQLTXT"] = "
		select 
			a.COLSEQ, a.PJTSEQ, a.PGMSEQ, a.SQLSEQ, a.DDCOLID, a.COLID, b.DATATYPE, a.SQLGBN, a.REQUIREYN, a.ORD, a.ADDDT, a.MODDT 
		from CG_PGMSQLD a
			left outer join CG_DD b on a.PJTSEQ = b.PJTSEQ and a.DDCOLID = b.COLID
		where a.PJTSEQ=#{G2-PJTSEQ} and a.PGMSEQ = #{G2-PGMSEQ} and a.SQLSEQ = #{G2-SQLSEQ}
		order by a.SQLGBN,a.ORD asc
		";
		$RtnVal["BINDTYPE"] = "iii";

		return $RtnVal;
	}  

	public function sqldIns($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "
		insert into CG_PGMSQLD (
			PJTSEQ, PGMSEQ, SQLSEQ, COLID, SQLGBN
			, DDCOLID, REQUIREYN, ORD
			,ADDDT
		) values (
			#{PJTSEQ}, #{PGMSEQ}, #{SQLSEQ}, #{COLID}, #{SQLGBN}
			, #{DDCOLID}, #{REQUIREYN}, #{ORD}
			,date_format(sysdate(),'%Y%m%d%H%i%s')
		)
		";
		$RtnVal["BINDTYPE"] = "iiiss ssi";
		return $RtnVal;
    }  
	public function sqldUpd($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["REQUIRE"] = array("SQLGBN", "REQUIREYN");		
		$RtnVal["SQLTXT"] = "
		update CG_PGMSQLD set
		ORD = #{ORD}, SQLGBN = #{SQLGBN}, COLID = #{COLID}, DDCOLID = #{DDCOLID}, REQUIREYN = #{REQUIREYN}
		,MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
  		where PJTSEQ=#{PJTSEQ} and PGMSEQ = #{PGMSEQ} and SQLSEQ = #{SQLSEQ} and COLSEQ = #{COLSEQ}
		";
		$RtnVal["BINDTYPE"] = "issss iiii";
		return $RtnVal;
    }  
	public function sqldDel($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "D";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "
		delete from CG_PGMSQLD where PJTSEQ=#{PJTSEQ} and PGMSEQ = #{PGMSEQ} and SQLSEQ = #{SQLSEQ} and COLSEQ = #{COLSEQ}
		";
		$RtnVal["BINDTYPE"] = "iiii";
		return $RtnVal;
    }  
	/*
	######################################################
	##	SQLR
	######################################################
	*/
	public function sqlrSearch($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "
		select
			SQLRSEQ,PJTSEQ,PGMSEQ,SVCSEQ,ifnull(SQLSEQ,0) as SQLSEQ,ORD,ADDDT,MODDT
		from CG_PGMSQLR where PJTSEQ = #{F_PJTSEQ} and PGMSEQ = #{F_PGMSEQ} and SVCSEQ = #{G9-SVCSEQ}
		order by ORD asc
		";
		$RtnVal["BINDTYPE"] = "iii";

		return $RtnVal;
	}  


	public function sqlrIns($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "
		insert into CG_PGMSQLR (
			PJTSEQ,PGMSEQ,SVCSEQ,SQLSEQ,ORD
			,ADDDT
		) values (
			#{PJTSEQ},#{PGMSEQ},#{SVCSEQ},#{SQLSEQ},#{ORD}
			,date_format(sysdate(),'%Y%m%d%H%i%s')
		)
		";
		$RtnVal["BINDTYPE"] = "iiiii";
		return $RtnVal;
    }  
	public function sqlrUpd($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "
		update CG_PGMSQLR set
		SQLSEQ = #{SQLSEQ}, ORD = #{ORD}
		,MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
  		where PJTSEQ = #{PJTSEQ} and PGMSEQ = #{PGMSEQ} and SQLRSEQ = #{SQLRSEQ} 
		";
		$RtnVal["BINDTYPE"] = "si iii";
		return $RtnVal;
    }  
	public function sqlrDel($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "D";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "
		delete from CG_PGMSQLR where PJTSEQ = #{PJTSEQ} and PGMSEQ = #{PGMSEQ} and SQLRSEQ = #{SQLRSEQ}
		";
		$RtnVal["BINDTYPE"] = "iii";
		return $RtnVal;
    }  

	/*
	######################################################
	##	SVC
	######################################################
	*/
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

	public function svcIns($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "
		insert into CG_PGMSVC (
			PJTSEQ,PGMSEQ,GRPSEQ,FNCSEQ,ORD
			,SVCGRPID
			,ADDDT
		) values (
			#{PJTSEQ},#{PGMSEQ},#{GRPSEQ},#{FNCSEQ},#{ORD}
			,#{SVCGRPID}
			,date_format(sysdate(),'%Y%m%d%H%i%s')
		)
		";
		$RtnVal["BINDTYPE"] = "iiiii s";
		return $RtnVal;
    }  
	public function svcUpd($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "
		update CG_PGMSVC set
		ORD = #{ORD}, SVCGRPID = #{SVCGRPID}
		,MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
  		where PJTSEQ = #{PJTSEQ} and PGMSEQ = #{PGMSEQ} and SVCSEQ = #{SVCSEQ} 
		";
		$RtnVal["BINDTYPE"] = "is iii";
		return $RtnVal;
    }  
	public function svcDel($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "D";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "
		delete from CG_PGMSVC where PJTSEQ = #{PJTSEQ} and PGMSEQ = #{PGMSEQ} and SVCSEQ = #{SVCSEQ}
		";
		$RtnVal["BINDTYPE"] = "ssi";
		return $RtnVal;
    }  


	/*
	######################################################
	##	INHERIT
	######################################################
	*/
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


	public function inheritIns($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "
		insert into CG_PGMINHERIT (
			PJTSEQ,PGMSEQ,GRPSEQ,COLID,CHILDGRPID
			,ADDDT
		) values (
			#{PJTSEQ},#{PGMSEQ},#{GRPSEQ},#{COLID},#{CHILDGRPID}
			,date_format(sysdate(),'%Y%m%d%H%i%s')
		)
		";
		$RtnVal["BINDTYPE"] = "iiiss";
		return $RtnVal;
    }  
	public function inheritUpd($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "
		update CG_PGMINHERIT set
		COLID = #{COLID}, CHILDGRPID = #{CHILDGRPID}
		,MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
 		 where PJTSEQ = #{PJTSEQ} and PGMSEQ = #{PGMSEQ} and INHERITSEQ = #{INHERITSEQ}
		";
		$RtnVal["BINDTYPE"] = "ss iii";
		return $RtnVal;
    }  
	public function inheritDel($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "D";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "
		delete from CG_PGMINHERIT where PJTSEQ = #{PJTSEQ} and PGMSEQ = #{PGMSEQ} and INHERITSEQ = #{INHERITSEQ} 
		";
		$RtnVal["BINDTYPE"] = "iii";
		return $RtnVal;
    }  


	/*
	######################################################
	##	IO
	######################################################
	*/
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
		  , a.KEYYN, a.SEQYN, a.HIDDENYN, a.EDITYN, a.FNINIT
		  , ifnull(a.FNCHANGE,'') as FNCHANGE, a.FORMAT, a.FOOTERNM
		  , ifnull(a.FOOTERMATH,'') as FOOTERMATH
		  , ifnull(a.ICONNM,'') as ICONNM
		  , ifnull(a.ICONSTYLE,'') as ICONSTYLE
		  , ifnull(a.LBLSTYLE,'') as LBLSTYLE
		  , ifnull(a.OBJSTYLE,'') as OBJSTYLE
		  , ifnull(a.OBJ2STYLE,'') as OBJ2STYLE		  
          , a.ADDDT, a.MODDT
        from CG_PGMIO a
            left outer join CG_DD b on a.PJTSEQ = b.PJTSEQ and a.COLID = b.COLID
        where a.PJTSEQ=#{F_PJTSEQ} and a.PGMSEQ = #{F_PGMSEQ} and a.GRPSEQ = #{G1-GRPSEQ}
        ORDER BY a.COLORD ASC
		";
		$RtnVal["BINDTYPE"] = "iii";

		return $RtnVal;
	}  


	public function ioIns($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "
		insert into CG_PGMIO (
			PJTSEQ,PGMSEQ,GRPSEQ,COLID,COLORD
			,COLNM,DATATYPE,DATASIZE,OBJTYPE,LBLHIDDENYN
			,LBLWIDTH, LBLALIGN, OBJWIDTH,OBJHEIGHT,OBJALIGN
			,HIDDENYN,EDITYN,FNINIT,KEYYN,SEQYN
			,VALIDSEQ,POPUP,FORMAT,FOOTERNM,FOOTERMATH
			,ICONNM, ICONSTYLE, LBLSTYLE, OBJSTYLE, OBJ2STYLE
			,FNCHANGE
			,ADDDT,ADDID
		) values (
			#{F_PJTSEQ},#{F_PGMSEQ},#{G1-GRPSEQ},#{COLID},#{COLORD}
			,#{COLNM},#{DATATYPE},#{DATASIZE},#{OBJTYPE},#{LBLHIDDENYN}
			,#{LBLWIDTH}, #{LBLALIGN}, #{OBJWIDTH}, #{OBJHEIGHT}, #{OBJALIGN}
			,#{HIDDENYN},if(#{EDITYN}='','Y',#{EDITYN}),#{FNINIT},#{KEYYN},#{SEQYN}
			,#{VALIDSEQ},#{POPUP}, #{FORMAT}, #{FOOTERNM}, #{FOOTERMATH}
			,#{ICONNM}, #{ICONSTYLE}, #{LBLSTYLE}, #{OBJSTYLE}, #{OBJ2STYLE}
			,#{FNCHANGE}
			,date_format(sysdate(),'%Y%m%d%H%i%s'),#{ADDID}
		)
		";
		$RtnVal["BINDTYPE"] = "iiisi ssiss sssss ssssss issss sssss si";
		return $RtnVal;
    }  
	public function ioUpd($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "
		update CG_PGMIO set
		COLID = #{COLID}, COLORD=#{COLORD}, COLNM=#{COLNM}, DATATYPE=#{DATATYPE}, DATASIZE=#{DATASIZE}
		,OBJTYPE = #{OBJTYPE}, LBLHIDDENYN=#{LBLHIDDENYN}, LBLWIDTH=#{LBLWIDTH}, LBLALIGN=#{LBLALIGN}, OBJWIDTH=#{OBJWIDTH}
		, OBJHEIGHT=#{OBJHEIGHT}, OBJALIGN=#{OBJALIGN}, HIDDENYN=#{HIDDENYN}, EDITYN=#{EDITYN}, FNINIT=#{FNINIT}
		, KEYYN=#{KEYYN}, SEQYN = #{SEQYN}, BRYN=#{BRYN}, VALIDSEQ = #{VALIDSEQ}, POPUP = #{POPUP}
		, FORMAT = #{FORMAT}, FOOTERNM = #{FOOTERNM}, FOOTERMATH = #{FOOTERMATH}
		, ICONNM = #{ICONNM}, ICONSTYLE = #{ICONSTYLE}, LBLSTYLE = #{LBLSTYLE}, OBJSTYLE = #{OBJSTYLE}, OBJ2STYLE = #{OBJ2STYLE}
		, FNCHANGE = #{FNCHANGE}
		,MODDT = date_format(sysdate(),'%Y%m%d%H%i%s'), MODID = #{MODID}
  		where PJTSEQ=#{F_PJTSEQ} and PGMSEQ = #{F_PGMSEQ} and GRPSEQ = #{G1-GRPSEQ} and IOSEQ = #{IOSEQ}
		";
		$RtnVal["BINDTYPE"] = "sissi sssss sssss sssis sss sssss s i iiii";
		return $RtnVal;
    }  
	public function ioDel($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "D";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "
		delete from CG_PGMIO where PJTSEQ=#{F_PJTSEQ} and PGMSEQ = #{F_PGMSEQ} and GRPSEQ = #{G1-GRPSEQ} and IOSEQ = #{IOSEQ}
		";
		$RtnVal["BINDTYPE"] = "iiii";
		return $RtnVal;
	}  
	
	/*
	######################################################
	##	FNC
	######################################################
	*/
	public function fncSearch($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "
		select
            PJTSEQ,PGMSEQ,GRPSEQ,FNCSEQ,IF(USEYN='Y',1,0) AS USEYN,FNCID,FNCCD,FNCNM,FNCTYPE,FNCORD,concat(FNCID,' - ',FNCNM,'^^FNC') as PROPERTY,ifnull(USERDEFJS,'') as USERDEFJS,ADDDT,MODDT
    from CG_PGMFNC where PJTSEQ = #{F_PJTSEQ} and PGMSEQ = #{F_PGMSEQ} and GRPSEQ = #{G1-GRPSEQ}
		";
		$RtnVal["BINDTYPE"] = "iii";

		return $RtnVal;
	}  


	public function fncIns($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "
		insert into CG_PGMFNC (
			PJTSEQ,PGMSEQ,GRPSEQ,FNCID,FNCCD
			,FNCNM,FNCTYPE,USEYN,FNCORD,USERDEFJS
			,ADDDT
		) values (
			#{F_PJTSEQ},#{F_PGMSEQ},#{G1-GRPSEQ},#{FNCID},#{FNCCD}
			,#{FNCNM},#{FNCTYPE},case #{USEYN} when 1 then 'Y' else 'N' end,#{FNCORD},#{USERDEFJS}
			,date_format(sysdate(),'%Y%m%d%H%i%s')
		)
		";
		$RtnVal["BINDTYPE"] = "iiiss sssis";
		return $RtnVal;
    }  
	public function fncUpd($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "
	update CG_PGMFNC set
		FNCID = #{FNCID}, FNCCD = #{FNCCD}, FNCNM = #{FNCNM}, FNCTYPE = #{FNCTYPE}, USEYN = case #{USEYN} when 1 then 'Y' else 'N' end
		, FNCORD = #{FNCORD}, USERDEFJS = #{USERDEFJS}
		,MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
  	where PJTSEQ = #{PJTSEQ} and PGMSEQ = #{PGMSEQ} and GRPSEQ = #{GRPSEQ} and FNCSEQ = #{FNCSEQ}
		";
		$RtnVal["BINDTYPE"] = "sssss is iiii";
		return $RtnVal;
    }  
	public function fncDel($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "D";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "
		delete from CG_PGMFNC where PJTSEQ = #{PJTSEQ} and PGMSEQ = #{PGMSEQ} and GRPSEQ = #{GRPSEQ} and FNCSEQ = #{FNCSEQ}
		";
		$RtnVal["BINDTYPE"] = "iiii";
		return $RtnVal;
    }  

	public function sqlSearch($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "
		select PJTSEQ,PGMSEQ,SQLSEQ,SQLID,SQLNM,SVRSEQ,CRUD,RTN_TYPE,SQLORD,ifnull(PSQLSEQ,0) as PSQLSEQ,SQLTXT,ADDDT,MODDT 
		from CG_PGMSQL 
		where PJTSEQ = #{F_PJTSEQ} and PGMSEQ = #{F_PGMSEQ}
		";
		$RtnVal["BINDTYPE"] = "ii";

		return $RtnVal;
    }  
   
	public function sqlIns($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "
		insert into CG_PGMSQL (
			PJTSEQ,PGMSEQ,SQLID,SQLNM,SVRSEQ
			,CRUD,RTN_TYPE,SQLORD,SQLTXT,PSQLSEQ
			,ADDDT
		) values (
			#{PJTSEQ},#{PGMSEQ},#{SQLID},#{SQLNM},#{SVRSEQ}
			,#{CRUD},#{RTN_TYPE},#{SQLORD},#{SQLTXT},ifnull(#{PSQLSEQ},0)
			,date_format(sysdate(),'%Y%m%d%H%i%s')
		)
		";
		$RtnVal["BINDTYPE"] = "iissi ssisi";
		return $RtnVal;
    }  
	public function sqlUpd($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "
		update CG_PGMSQL set
			SQLID = #{SQLID}, SQLNM = #{SQLNM}, SVRSEQ = #{SVRSEQ}, CRUD = #{CRUD} , RTN_TYPE = #{RTN_TYPE}
			, SQLTXT = #{SQLTXT}, SQLORD = #{SQLORD}, PSQLSEQ = ifnull(#{PSQLSEQ},0)
			, MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
		where PJTSEQ = #{PJTSEQ}  and PGMSEQ = #{PGMSEQ} and SQLSEQ = #{SQLSEQ} 
		";
		$RtnVal["BINDTYPE"] = "ssiss sii iii";
		return $RtnVal;
    }  
	public function sqlDel($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "D";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "
		delete from CG_PGMSQL where PJTSEQ=#{PJTSEQ} and PGMSEQ = #{PGMSEQ} and SQLSEQ = #{SQLSEQ}
		";
		$RtnVal["BINDTYPE"] = "iii";
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
	
	public function grpIns($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "
		insert into CG_PGMGRP (
			PJTSEQ,PGMSEQ,GRPID,GRPNM,GRPTYPE
            ,GRPORD,REFGRPID,VBOX,GRPWIDTH,GRPHEIGHT
            ,BRYN,FREEZECNT,COLSIZETYPE,LEGENDALIGN,STACKED
			,ADDDT
		) values (
			#{PJTSEQ}, #{PGMSEQ}, #{GRPID}, #{GRPNM}, #{GRPTYPE}
            ,#{GRPORD}, #{REFGRPID}, #{VBOX}, #{GRPWIDTH}, #{GRPHEIGHT}
            ,#{BRYN}, #{FREEZECNT}, if(#{COLSIZETYPE}='','X',#{COLSIZETYPE}),#{LEGENDALIGN},#{STACKED}
			,date_format(sysdate(),'%Y%m%d%H%i%s')
		)
		";
		$RtnVal["BINDTYPE"] = "iisss issss sissss";
		return $RtnVal;
    }  
	public function grpUpd($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "
		update CG_PGMGRP set
            GRPID = #{GRPID}, GRPNM = #{GRPNM}, GRPTYPE = #{GRPTYPE}, GRPORD = #{GRPORD}, REFGRPID = #{REFGRPID}
            , GRPWIDTH = #{GRPWIDTH}, GRPHEIGHT = #{GRPHEIGHT}, BRYN = #{BRYN}, FREEZECNT = #{FREEZECNT}, COLSIZETYPE = #{COLSIZETYPE}
            , VBOX = #{VBOX}, LEGENDALIGN = #{LEGENDALIGN}, STACKED = #{STACKED}
            , MODDT =date_format(sysdate(),'%Y%m%d%H%i%s')
		where PJTSEQ = #{PJTSEQ} and PGMSEQ = #{PGMSEQ} and GRPSEQ = #{GRPSEQ}
		";
		$RtnVal["BINDTYPE"] = "sssis sssis sss iii";
		return $RtnVal;
    }  
	public function grpDel($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "D";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "
		delete from  CG_PGMGRP  where PJTSEQ = #{PJTSEQ} and PGMSEQ = #{PGMSEQ} and GRPSEQ = #{GRPSEQ}	
		";
		$RtnVal["BINDTYPE"] = "iii";
		return $RtnVal;
    }  

}
                                                             
?>