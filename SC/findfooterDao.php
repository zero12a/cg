<?php
//DAO
 
class findfooterDao
{
	function __construct(){
		alog("FindfooterDao-__construct");
	}
	function __destruct(){
		alog("FindfooterDao-__destruct");
	}
	function __toString(){
		alog("FindfooterDao-__toString");
	}
	//TEAM    
	public function sTeam($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "SC";
		$RtnVal["SQLTXT"] = "select uuid() as UUID_SEQ, c.TEAM_NM
, sum( case when priority = 1 then 1 else 0 end ) as PRIORITY_1
, sum( case when priority = 2 then 1 else 0 end ) as PRIORITY_2
, sum( case when priority = 3 then 1 else 0 end ) as PRIORITY_3
, count(b.LOADD_SEQ) as vul_cnt  
from 
	TEAMINFO c
	left outer join FILELOAD a on c.TEAM_NM = a.TEAM_NM
    left outer join  FILELOADD b on a.load_seq = b.LOAD_SEQ
group by c.TEAM_NM
order by ifnull(count(b.LOADD_SEQ),0) desc";
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
	//SYS    
	public function sSys($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "SC";
		$RtnVal["SQLTXT"] = "select UUID() as UUID_SEQ, TEAM_NM,SYS_NM, SUBSYS_NM, count(b.LOADD_SEQ) as VUL_CNT
from 
	FILELOAD a 
    join  FILELOADD b on a.load_seq = b.LOAD_SEQ
where a.TEAM_NM  = #{G3-TEAM_NM}
group by TEAM_NM, SYS_NM, SUBSYS_NM
order by count(b.LOADD_SEQ) desc";
		$RtnVal["BINDTYPE"] = "s";
		return $RtnVal;
    }  
	//RULESET    
	public function sRule($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "SC";
		$RtnVal["SQLTXT"] = "select UUID() as UUID_SEQ, TEAM_NM, SYS_NM, SUBSYS_NM, b.TYPE as RULESET, count(b.LOADD_SEQ) as vul_cnt
from 
	FILELOAD a 
    join  FILELOADD b on a.load_seq = b.LOAD_SEQ
where a.TEAM_NM = #{G4-TEAM_NM} and 
 	case 
		when #{G4-SUBSYS_NM} = '' then 
 			a.SUBSYS_NM  = '' or a.SUBSYS_NM is null
		else a.SUBSYS_NM = #{G4-SUBSYS_NM}
	end 
	and a.SYS_NM = #{G4-SYS_NM} 
group by TEAM_NM, SYS_NM, SUBSYS_NM, b.TYPE
order by count(b.LOADD_SEQ) desc";
		$RtnVal["BINDTYPE"] = "ssss";
		return $RtnVal;
    }  
	//TEAM    
	public function sTeamChart($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "SC";
		$RtnVal["SQLTXT"] = "select c.TEAM_NM, count(distinct b.type) as TYPE_CNT, ifnull(count(b.LOADD_SEQ),0) as VUL_CNT
from 
	TEAMINFO c 
	left outer join FILELOAD a on c.TEAM_NM = a.TEAM_NM
    left outer join  FILELOADD b on a.load_seq = b.LOAD_SEQ
where 
case when #{G1-EX_TEAM_NM} <> '' then c.TEAM_NM <> #{G1-EX_TEAM_NM} 
	else
		1=1
	end
group by c.TEAM_NM
order by ifnull(count(b.LOADD_SEQ),0) desc";
		$RtnVal["BINDTYPE"] = "ss";
		return $RtnVal;
    }  
}
                                                             
?>