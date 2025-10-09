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
	

	public function pgmSearch($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "
		select
			0, a.PJTSEQ, c.PJTID, a.PGMSEQ, '-' as STATUS, a.PGMID, a.PGMNM
			, concat(a.VIEWURL,'^http://',#{CFG.CFG_DEMO_URL},':8040/d.s/',c.PJTID,'/',a.VIEWURL,'?access_token=',#{USER.ACCESS_TOKEN},'^_blank') as VIEWURL
			, concat('권한받기^http://',#{CFG.CFG_DEMO_URL},':8040/d.s/cg_pgminfo_getauth.php?PJTSEQ=',a.PJTSEQ,'&PGMSEQ=',a.PGMSEQ,'^_blank') as GETAUTH
			, a.PGMTYPE
			,b.VERDT, b.DEGREE, b.ADDDT as MAKEDT, a.ADDDT, a.MODDT
		from 
			CG_PGMINFO a
				left outer join CG_PGMVER b on a.PJTSEQ = b.PJTSEQ and a.PGMSEQ = b.PGMSEQ and b.ACTIVEYN='Y'
				join CGCORE.CG_PJTINFO c on a.PJTSEQ = c.PJTSEQ
		where a.PJTSEQ = #{POP_PJTSEQ} and (a.PGMID = #{POP_PGMID} or a.PGMNM LIKE #{POP_PGMNM} or a.PGMTYPE LIKE #{POP_PGMTYPE})
		order by a.PGMSEQ desc
		";
		$RtnVal["BINDTYPE"] = "sss isss";

		return $RtnVal;
	}  



}
                                                             
?>