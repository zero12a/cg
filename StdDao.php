<?php
 
class StdDao
{
	function __construct(){
		alog("StdDao-__construct");
	}
	function __destruct(){
		alog("StdDao-__destruct");
	}
	function __toString(){
		alog("StdDao-__toString");
	}

    public function getGrid1Search1Sql1($req){
		//GRID 조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD
		$RtnVal["SQLTXT"] = "
		  select
            PJTID,PGMID,GRPID,FNCID,FNCCD,FNCNM,FNCTYPE,BTNWIDTH,ORD,ADDDT,MODDT
          from CG_PGMFNC where PJTID = #PJTID# and GRPID = #GRPID#
          ";
		$RtnVal["BINDTYPE"] = "ss";

        return $RtnVal;
    }                                                   
 
    public function getGrid1Save2Sql1($req){
		//GRID 조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD
		$RtnVal["SQLTXT"] = "
		  select
            PJTID,PGMID,GRPID,FNCID,FNCCD,FNCNM,FNCTYPE,BTNWIDTH,ORD,ADDDT,MODDT
          from CG_PGMFNC where PJTID = #PJTID# and GRPID = #GRPID#
          ";
		$RtnVal["BINDTYPE"] = "ss";

        return $RtnVal;
    }                                                   
 
    public function getGrid1Save2Sql2($req){
		//GRID 조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD
		$RtnVal["SQLTXT"] = "
		  select
            PJTID,PGMID,GRPID,FNCID,FNCCD,FNCNM,FNCTYPE,BTNWIDTH,ORD,ADDDT,MODDT
          from CG_PGMFNC where PJTID = #PJTID# and GRPID = #GRPID#
          ";
		$RtnVal["BINDTYPE"] = "ss";

        return $RtnVal;
    }                                                   
 
    public function getGrid1Save2Sql3($req){
		//GRID 조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "D";//CRUD
		$RtnVal["SQLTXT"] = "
		  select
            PJTID,PGMID,GRPID,FNCID,FNCCD,FNCNM,FNCTYPE,BTNWIDTH,ORD,ADDDT,MODDT
          from CG_PGMFNC where PJTID = #PJTID# and GRPID = #GRPID#
          ";
		$RtnVal["BINDTYPE"] = "ss";

        return $RtnVal;
    }                                                   
 
    public function getFormview2Search1Sql1($req){
		alog("StdDao-getFormview2Search1Sql1");
		//GRID 조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD
		$RtnVal["SQLTXT"] = "
		  select
            PJTID,PGMID,GRPID,FNCID,FNCCD,FNCNM,FNCTYPE,BTNWIDTH,ORD,ADDDT,MODDT
          from CG_PGMFNC where PJTID = #PJTID# and GRPID = #GRPID#
          ";
		$RtnVal["BINDTYPE"] = "ss";

		return $RtnVal;
    }                                                   
 
    public function getFormview2Save2Sql1($req){
		alog("StdDao-getFormview2Save2Sql1");

		//GRID 조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD
		$RtnVal["SQLTXT"] = "
		  select
            PJTID,PGMID,GRPID,FNCID,FNCCD,FNCNM,FNCTYPE,BTNWIDTH,ORD,ADDDT,MODDT
          from CG_PGMFNC where PJTID = #PJTID# and GRPID = #GRPID#
          ";
		$RtnVal["BINDTYPE"] = "ss";

		return $RtnVal;
    }                                                   
 
    public function getFormview2Save2Sql2($req){
		//GRID 조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD
		$RtnVal["SQLTXT"] = "
		  select
            PJTID,PGMID,GRPID,FNCID,FNCCD,FNCNM,FNCTYPE,BTNWIDTH,ORD,ADDDT,MODDT
          from CG_PGMFNC where PJTID = #F_PJTID# and GRPID = #G1_GRPID#
          ";
		$RtnVal["BINDTYPE"] = "ss";
    }                                                   
 
    public function getFormview2Save2Sql3($req){
		//GRID 조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "D";//CRUD
		$RtnVal["SQLTXT"] = "
		  select
            PJTID,PGMID,GRPID,FNCID,FNCCD,FNCNM,FNCTYPE,BTNWIDTH,ORD,ADDDT,MODDT
          from CG_PGMFNC where PJTID = #F_PJTID# and GRPID = #G1_GRPID#
          ";
		$RtnVal["BINDTYPE"] = "ss";

		return $RtnVal;
    }                                                   
 
    public function getFormview2Delete3Sql1($req){
		//GRID 조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "D";//CRUD
		$RtnVal["SQLTXT"] = "
		  select
            PJTID,PGMID,GRPID,FNCID,FNCCD,FNCNM,FNCTYPE,BTNWIDTH,ORD,ADDDT,MODDT
          from CG_PGMFNC where PJTID = #PJTID# and GRPID = #GRPID#
          ";
		$RtnVal["BINDTYPE"] = "ss";

		return $RtnVal;
    }                                                   
 
}
                                                             
?>

