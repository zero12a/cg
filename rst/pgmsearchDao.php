<?php
//DAO
 
class pgmsearchDao
{
	function __construct(){
		alog("PgmsearchDao-__construct");
	}
	function __destruct(){
		alog("PgmsearchDao-__destruct");
	}
	function __toString(){
		alog("PgmsearchDao-__toString");
	}
	//PJT    
	public function selPjtG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "SELECT PJTSEQ,PJTID,PJTNM FROM CG_PJTINFO";
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
	//PGM    
	public function selPgmG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "SELECT PGMID,PGMNM,ADDDT,MODDT FROM CG_PGMINFO WHERE PJTSEQ = #{G2-PJTSEQ}";
		$RtnVal["BINDTYPE"] = "i";
		return $RtnVal;
    }  
}
                                                             
?>