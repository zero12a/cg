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
			, concat(a.VIEWURL,'^http://localhost:8060/c.g/',c.PJTID,'/',a.VIEWURL,'^_blank') as VIEWURL
			, concat('권한받기^http://localhost:8060/m.k/cg_pgminfo_getauth.php?PJTSEQ=',a.PJTSEQ,'&PGMSEQ=',a.PGMSEQ,'^_blank') as GETAUTH
			, a.PGMTYPE
			,b.VERDT, b.DEGREE, b.ADDDT as MAKEDT, a.ADDDT, a.MODDT
		from 
			CG_PGMINFO a
				left outer join CG_PGMVER b on a.PJTSEQ = b.PJTSEQ and a.PGMSEQ = b.PGMSEQ and b.ACTIVEYN='Y'
				join CG_PJTINFO c on a.PJTSEQ = c.PJTSEQ
		where a.PJTSEQ = #{POP_PJTSEQ} and (a.PGMID = #{POP_PGMID} or a.PGMNM LIKE #{POP_PGMNM} or a.PGMTYPE LIKE #{POP_PGMTYPE})
		order by a.PGMSEQ desc
		";
		$RtnVal["BINDTYPE"] = "isss";

		return $RtnVal;
	}  



}
                                                             
?>