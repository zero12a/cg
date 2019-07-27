<?php
//DAO
 
class copyttt5Dao
{
	function __construct(){
		alog("Copyttt5Dao-__construct");
	}
	function __destruct(){
		alog("Copyttt5Dao-__destruct");
	}
	function __toString(){
		alog("Copyttt5Dao-__toString");
	}
	//MAS    
	public function selMasG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLID"] = "selMasG";
		$RtnVal["SQLTXT"] = "select 
	0 as CHK, PCD,PNM,PCDDESC,ORD
	,UITOOL,USEYN,DELYN
	,ADDDT,MODDT
from 
	CG_CODE
order by ORD asc";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
}
                                                             
?>