<?php
//DAO
 
class usermngDao
{
	function __construct(){
		global $log;
		$log->info("UsermngDao-__construct");
	}
	function __destruct(){
		global $log;
		$log->info("UsermngDao-__destruct");
	}
	function __toString(){
		global $log;
		$log->info("UsermngDao-__toString");
	}
	//사용자비번변경    
	public function chgUserPwG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "CGCORE";
		$RtnVal["SQLID"] = "chgUserPwG";
		$RtnVal["SQLTXT"] = "update CG_USERS set
 PASSWD = #{PASSWD}
 , LASTPWCHGDT = date_format(sysdate(),'%Y%m%d%H%i%s')
where USERSEQ = #{USERSEQ}";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "si";
		return $RtnVal;
    }  
	//서버추가    
	public function insSvrG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SVRID"] = "CGCORE";
		$RtnVal["SQLID"] = "insSvrG";
		$RtnVal["SQLTXT"] = "INSERT INTO CG_SVR (
	SVRID, SVRNM, PJTSEQ, USERSEQ, DBDRIVER
	, DBHOST, DBPORT, DBNAME, DBUSRID, DBUSRPW
	, USEYN
	, ADDDT
)VALUES(
	#{SVRID},#{SVRNM},#{PJTSEQ}, #{USERSEQ}, #{DBDRIVER}
	, #{DBHOST}, #{DBPORT}, #{DBNAME}, #{DBUSRID}, #{DBUSRPW}
	, #{USEYN}
	,date_format(sysdate(),'%Y%m%d%H%i%s')
)";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "ssiisssssss";
		return $RtnVal;
    }  
	//사용자추가    
	public function insUserG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SVRID"] = "CGCORE";
		$RtnVal["SQLID"] = "insUserG";
		$RtnVal["SQLTXT"] = "";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
	//프로젝목록    
	public function selPjtG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CGCORE";
		$RtnVal["SQLID"] = "selPjtG";
		$RtnVal["SQLTXT"] = "select
	USERSEQ, PJTSEQ, ADDDT, MODDT
from 
	CG_PJTUSER
where USERSEQ = #{G2-USERSEQ}
 ";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "i";
		return $RtnVal;
    }  
	//서버록록    
	public function selSvrG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CGCORE";
		$RtnVal["SQLID"] = "selSvrG";
		$RtnVal["SQLTXT"] = "select
	SVRSEQ,SVRID,SVRNM, PJTSEQ, USERSEQ
	,DBDRIVER, DBHOST, DBPORT, DBNAME, DBUSRID
	, DBUSRPW,USEYN
	,ADDDT, MODDT
from 
	CG_SVR
where USERSEQ = #{G2-USERSEQ}
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "i";
		return $RtnVal;
    }  
	//사용자목록    
	public function selUserG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CGCORE";
		$RtnVal["SQLID"] = "selUserG";
		$RtnVal["SQLTXT"] = "select 
 USERSEQ, EMAIL,'--Hashed--' as PASSWD, EMAILVALIDYN,LASTPWCHGDT
 , PWFAILCNT, LOCKYN, FREEZEDT, LOCKDT, SERVERSEQ
 , ADDDT, MODDT
from
 CG_USERS
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
	//서버변경    
	public function updSvrG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "CGCORE";
		$RtnVal["SQLID"] = "updSvrG";
		$RtnVal["SQLTXT"] = "update CG_SVR
set
	SVRNM = #{SVRNM}, USERSEQ = #{USERSEQ}, DBDRIVER = #{DBDRIVER}, DBHOST = #{DBHOST},DBPORT = #{DBPORT}
	, DBNAME = #{DBNAME}, DBUSRID = #{DBUSRID}, DBUSRPW = #{DBUSRPW}, USEYN = #{USEYN}
	, MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
where SVRSEQ = #{SVRSEQ}
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "sisssssssi";
		return $RtnVal;
    }  
	//사용자수정    
	public function updUserG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "CGCORE";
		$RtnVal["SQLID"] = "updUserG";
		$RtnVal["SQLTXT"] = "update CG_USERS set
 EMAIL = #{EMAIL}, PWFAILCNT = #{PWFAILCNT}, LOCKYN = #{LOCKYN},LOCKDT = #{LOCKDT}
 , MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
where USERSEQ = #{USERSEQ}
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "sissi";
		return $RtnVal;
    }  
}
                                                             
?>