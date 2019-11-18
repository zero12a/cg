<?php
//DAO
 
class piioDao
{
	function __construct(){
		global $log;
		$log->info("PiioDao-__construct");
	}
	function __destruct(){
		global $log;
		$log->info("PiioDao-__destruct");
	}
	function __toString(){
		global $log;
		$log->info("PiioDao-__toString");
	}
	//delIoF    
	public function delIoF($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "D";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLID"] = "delIoF";
		$RtnVal["SQLTXT"] = "delete from  CG_PGMIO 
where PJTSEQ = #{G3-PJTSEQ} and PGMSEQ = #{G3-PGMSEQ} and GRPSEQ = #{G3-GRPSEQ} and IOSEQ = #{G3-IOSEQ}
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "iiii";
		return $RtnVal;
    }  
	//insIoF    
	public function insIoF($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLID"] = "insIoF";
		$RtnVal["SQLTXT"] = "insert into CG_PGMIO
(
	PJTSEQ, PGMSEQ, GRPSEQ, COLORD, COLID
	, COLNM, DATATYPE, VALIDSEQ, DATASIZE, OBJTYPE
	, POPUP, KEYYN, SEQYN, LBLHIDDENYN, LBLWIDTH
	, LBLALIGN, OBJWIDTH, OBJHEIGHT, OBJALIGN, HIDDENYN
	, EDITYN, FNINIT, BRYN, FORMAT, FOOTERMATH
	, FOOTERNM, ICONNM, ICONSTYLE, LBLSTYLE, OBJSTYLE
	, OBJ2STYLE
	, ADDID, ADDDT
) values (
	#{G1-PJTSEQ}, #{G1-PGMSEQ}, #{G1-GRPSEQ}, #{G3-COLORD}, #{G3-COLID}
	, #{G3-COLNM}, #{G3-DATATYPE}, #{G3-VALIDSEQ}, #{G3-DATASIZE}, #{G3-OBJTYPE}
	, #{G3-POPUP}, #{G3-KEYYN}, #{G3-SEQYN}, #{G3-LBLHIDDENYN}, #{G3-LBLWIDTH}
	, #{G3-LBLALIGN}, #{G3-OBJWIDTH}, #{G3-OBJHEIGHT}, #{G3-OBJALIGN}, #{G3-HIDDENYN}
	, #{G3-EDITYN}, #{G3-FNINIT}, #{G3-BRYN}, #{G3-FORMAT}, #{G3-FOOTERMATH}
	, #{G3-FOOTERNM}, #{G3-ICONNM}, #{G3-ICONSTYLE}, #{G3-LBLSTYLE}, #{G3-OBJSTYLE}
	, #{G3-OBJ2STYLE}
	, #{USER.SEQ}, date_format(sysdate(),'%Y%m%d%H%i%s')
)
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "iiiisssiissssssssssssssssssssssi";
		return $RtnVal;
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
	//updIoF    
	public function updIoF($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLID"] = "updIoF";
		$RtnVal["SQLTXT"] = "update CG_PGMIO set
	COLORD = #{G3-COLORD}, COLID = #{G3-COLID}, COLNM = #{G3-COLNM}, DATATYPE = #{G3-DATATYPE}, VALIDSEQ = #{G3-VALIDSEQ}
	, DATASIZE = #{G3-DATASIZE}, OBJTYPE = #{G3-OBJTYPE}, POPUP = #{G3-POPUP}, KEYYN = #{G3-KEYYN}, SEQYN = #{G3-SEQYN}
	, LBLHIDDENYN = #{G3-LBLHIDDENYN}, LBLWIDTH = #{G3-LBLWIDTH}, LBLALIGN = #{G3-LBLALIGN}, OBJWIDTH = #{G3-OBJWIDTH}, OBJHEIGHT = #{G3-OBJHEIGHT}
	, OBJALIGN = #{G3-OBJALIGN}, HIDDENYN = #{G3-HIDDENYN}, EDITYN = #{G3-EDITYN}, FNINIT = #{G3-FNINIT}, BRYN = #{G3-BRYN}
	, FORMAT = #{G3-FORMAT}, FOOTERMATH = #{G3-FOOTERMATH}, FOOTERNM = #{G3-FOOTERNM}, ICONNM = #{G3-ICONNM}, ICONSTYLE = #{G3-ICONSTYLE}
	, LBLSTYLE = #{G3-LBLSTYLE}, OBJSTYLE = #{G3-OBJSTYLE}, OBJ2STYLE = #{G3-OBJ2STYLE}
	, MODID = #{USER.SEQ}, MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
where PJTSEQ = #{G3-PJTSEQ} and PGMSEQ = #{G3-PGMSEQ} and GRPSEQ = #{G3-GRPSEQ} and IOSEQ = #{G3-IOSEQ}
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "isssiissssssssssssssssssssssiiiii";
		return $RtnVal;
    }  
}
                                                             
?>