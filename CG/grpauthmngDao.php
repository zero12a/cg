<?php
//DAO
 
class grpauthmngDao
{
	function __construct(){
		global $log;
		$log->info("GrpauthmngDao-__construct");
	}
	function __destruct(){
		global $log;
		$log->info("GrpauthmngDao-__destruct");
	}
	function __toString(){
		global $log;
		$log->info("GrpauthmngDao-__toString");
	}
	//권한 삭제    
	public function delHoldG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLID"] = "delHoldG";
		$RtnVal["SQLTXT"] = "delete from CMN_GRP_AUTH where GRP_SEQ = #{G2-GRP_SEQ} and GA_SEQ = #{GA_SEQ}
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "si";
		return $RtnVal;
    }  
	//권한 추가    
	public function insNoToHoldG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLID"] = "insNoToHoldG";
		$RtnVal["SQLTXT"] = "insert into CMN_GRP_AUTH (
	GRP_SEQ, PGMID, AUTH_ID, ADD_DT, ADD_ID
) 
select
	#{G2-GRP_SEQ} as  GRP_SEQ, PGMID, AUTH_ID, date_format(sysdate(),'%Y%m%d%H%i%s') as ADD_DT, 0 as ADD_ID
from CMN_AUTH
WHERE AUTH_SEQ = #{AUTH_SEQ}
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "si";
		return $RtnVal;
    }  
	//그룹목록    
	public function selGrpG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLID"] = "selGrpG";
		$RtnVal["SQLTXT"] = "select 
	GRP_SEQ, GRP_NM, USE_YN, ADD_DT, ADD_ID
from CMN_GRP";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
	//보유 권한    
	public function selHoldG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLID"] = "selHoldG";
		$RtnVal["SQLTXT"] = "select
	0 as CHK, a.GA_SEQ, a.GRP_SEQ, a.PGMID, b.MNU_NM, a.AUTH_ID, c.AUTH_NM, a.ADD_DT, a.ADD_ID
from CMN_GRP_AUTH a
	left outer join CMN_MNU b on a.PGMID = b.PGMID
	left outer join CMN_AUTH c on a.PGMID = c.PGMID and a.AUTH_ID = c.AUTH_ID
where a.GRP_SEQ = #{G2-GRP_SEQ}
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "s";
		return $RtnVal;
    }  
	//미보유 권한    
	public function selNoG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLID"] = "selNoG";
		$RtnVal["SQLTXT"] = "select
	0 as CHK, a.AUTH_SEQ, a.PGMID, c.MNU_NM, a.AUTH_ID, a.AUTH_NM, a.USE_YN, a.ADD_DT, a.MOD_DT		
from CMN_AUTH a
	left outer join CMN_MNU c on a.PGMID = c.PGMID
where not exists(
	select
		*
	from CMN_GRP_AUTH b
	where b.GRP_SEQ = #{G2-GRP_SEQ} and a.PGMID = b.PGMID and a.AUTH_ID = b.AUTH_ID
)
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "s";
		return $RtnVal;
    }  
}
                                                             
?>