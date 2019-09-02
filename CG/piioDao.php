<?php
//DAO
 
class piioDao
{
	function __construct(){
		alog("PiioDao-__construct");
	}
	function __destruct(){
		alog("PiioDao-__destruct");
	}
	function __toString(){
		alog("PiioDao-__toString");
	}
	//selIoF    
	public function selIoF($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLID"] = "selIoF";
		$RtnVal["SQLTXT"] = "select
	PJTSEQ, PGMSEQ, GRPSEQ, IOSEQ, COLORD, COLID, COLNM, DATATYPE, VALIDSEQ, DATASIZE
	, OBJTYPE, POPUP, KEYYN, SEQYN, LBLHIDDENYN, LBLWIDTH, LBLALIGN, OBJWIDTH, OBJHEIGHT
	, OBJALIGN, HIDDENYN, EDITYN, FNINIT, BRYN, FORMAT, FOOTERMATH, FOOTERNM, ICONNM, ICONSTYLE
	, LBLSTYLE, OBJSTYLE, OBJ2STYLE, ADDDT, ADDID, MODDT, MODID
from
	CG_PGMIO
where PJTSEQ = #{G1-PJTSEQ} and PGMSEQ = #{G1-PGMSEQ} and GRPSEQ = #{G1-GRPSEQ}
	and IOSEQ = #{G2-IOSEQ}";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "iiii";
		return $RtnVal;
    }  
	//selIoG    
	public function selIoG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLID"] = "selIoG";
		$RtnVal["SQLTXT"] = "select
	PJTSEQ, PGMSEQ, GRPSEQ, IOSEQ, COLORD, COLID, COLNM, DATATYPE, VALIDSEQ, DATASIZE
	, OBJTYPE, POPUP, KEYYN, SEQYN, LBLHIDDENYN, LBLWIDTH, LBLALIGN, OBJWIDTH, OBJHEIGHT
	, OBJALIGN, HIDDENYN, EDITYN, FNINIT, BRYN, FORMAT, FOOTERMATH, FOOTERNM, ICONNM, ICONSTYLE
	, LBLSTYLE, OBJSTYLE, OBJ2STYLE, ADDDT, ADDID, MODDT, MODID
from
	CG_PGMIO
where PJTSEQ = #{G1-PJTSEQ} and PGMSEQ = #{G1-PGMSEQ} and GRPSEQ = #{G1-GRPSEQ}
order by COLORD asc
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "iii";
		return $RtnVal;
    }  
}
                                                             
?>