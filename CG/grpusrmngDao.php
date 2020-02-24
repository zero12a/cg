<?php
//DAO
 
class grpusrmngDao
{
	function __construct(){
		global $log;
		$log->info("GrpusrmngDao-__construct");
	}
	function __destruct(){
		global $log;
		$log->info("GrpusrmngDao-__destruct");
	}
	function __toString(){
		global $log;
		$log->info("GrpusrmngDao-__toString");
	}
	//사용자권한삭제    
	public function delHoldG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "D";//CRUD 
		$RtnVal["SVRID"] = "OS";
		$RtnVal["SQLID"] = "delHoldG";
		$RtnVal["SQLTXT"] = "delete from CMN_GRP_USR where GRP_SEQ = #{G2-GRP_SEQ} and USR_SEQ = #{USR_SEQ}
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "si";
		return $RtnVal;
    }  
	//사용자추가    
	public function insNoToHoldG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SVRID"] = "OS";
		$RtnVal["SQLID"] = "insNoToHoldG";
		$RtnVal["SQLTXT"] = "insert into CMN_GRP_USR (
	GRP_SEQ, USR_SEQ, ADD_DT, ADD_ID
) values (
	#{G2-GRP_SEQ}, #{USR_SEQ}, date_format(sysdate(),'%Y%m%d%H%i%s'), 0
)
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
		$RtnVal["SVRID"] = "OS";
		$RtnVal["SQLID"] = "selGrpG";
		$RtnVal["SQLTXT"] = "select GRP_SEQ, GRP_NM, USE_YN, ADD_DT, MOD_DT
from CMN_GRP
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
	//권한보유사용자    
	public function selHoldG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "OS";
		$RtnVal["SQLID"] = "selHoldG";
		$RtnVal["SQLTXT"] = "select
	0 as CHK, a.GRP_SEQ, a.USR_SEQ, b.USR_ID, b.USR_NM, a.ADD_DT, a.ADD_ID, a.ADD_ID as ADD_ID2
from CMN_GRP_USR a
	join CMN_USR b on a.USR_SEQ = b.USR_SEQ
where GRP_SEQ = #{G2-GRP_SEQ}	";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "s";
		return $RtnVal;
    }  
	//권한미보유    
	public function selNoG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "OS";
		$RtnVal["SQLID"] = "selNoG";
		$RtnVal["SQLTXT"] = "select 
	0 as CHK, USR_SEQ, USR_ID, USR_NM
from 
	CMN_USR
where USR_SEQ not in (
	select USR_SEQ
	from CMN_GRP_USR
	where GRP_SEQ = #{G2-GRP_SEQ}
)
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "s";
		return $RtnVal;
    }  
}
                                                             
?>