<?php
//DAO
 
class ddiomngDao
{
	function __construct(){
		global $log;
		$log->info("DdiomngDao-__construct");
	}
	function __destruct(){
		global $log;
		$log->info("DdiomngDao-__destruct");
	}
	function __toString(){
		global $log;
		$log->info("DdiomngDao-__toString");
	}
	//SIZE    
	public function selSizeG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CGPJT1";
		$RtnVal["SQLID"] = "selSizeG";
		$RtnVal["SQLTXT"] = "SELECT 
  0 as CHK, a.COLID,b.PGMSEQ,b.IOSEQ,a.DATASIZE AS DD_DATASIZE
 , b.DATASIZE AS IO_DATASIZE
 , b.ADDDT, b.MODDT
FROM CG_DD a 
 JOIN CG_PGMIO b on a.PJTSEQ = b.PJTSEQ and a.COLID = b.COLID
where a.PJTSEQ = 3 anD a.DATASIZE != b.DATASIZE
ORDER BY COLID ASC";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
	//TYPE    
	public function selTypeG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CGPJT1";
		$RtnVal["SQLID"] = "selTypeG";
		$RtnVal["SQLTXT"] = "SELECT 
  0 as CHK, a.COLID,b.PGMSEQ,b.IOSEQ,a.DATATYPE AS DD_DATATYPE
 , b.DATATYPE AS IO_DATATYPE
 , b.ADDDT, b.MODDT
FROM CG_DD a 
 JOIN CG_PGMIO b on a.PJTSEQ = b.PJTSEQ and a.COLID = b.COLID
where a.PJTSEQ = 3 anD a.DATATYPE != b.DATATYPE
ORDER BY COLID ASC";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
	//VALID    
	public function selValidG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CGPJT1";
		$RtnVal["SQLID"] = "selValidG";
		$RtnVal["SQLTXT"] = "SELECT 
  0 as CHK, a.COLID,b.PGMSEQ,b.IOSEQ,a.VALIDSEQ AS DD_VALIDSEQ
 , b.VALIDSEQ AS IO_VALIDSEQ
 , b.ADDDT, b.MODDT
FROM CG_DD a 
 JOIN CG_PGMIO b on a.PJTSEQ = b.PJTSEQ and a.COLID = b.COLID
where a.PJTSEQ = 3 anD a.VALIDSEQ != b.VALIDSEQ
ORDER BY COLID ASC";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
	//SIZE    
	public function updSizeG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "CGPJT1";
		$RtnVal["SQLID"] = "updSizeG";
		$RtnVal["SQLTXT"] = "update CG_PGMIO io JOIN CG_DD dd
	on io.COLID = dd.COLID
        and io.PJTSEQ = dd.PJTSEQ
set
        io.DATASIZE = dd.DATASIZE
        ,io.MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
where io.IOSEQ = #{IOSEQ}";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "i";
		return $RtnVal;
    }  
	//TYPE    
	public function updTypeG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "CGPJT1";
		$RtnVal["SQLID"] = "updTypeG";
		$RtnVal["SQLTXT"] = "update CG_PGMIO io JOIN CG_DD dd
	on io.COLID = dd.COLID
        and io.PJTSEQ = dd.PJTSEQ
set
        io.DATATYPE = dd.DATATYPE
        ,io.MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
where io.IOSEQ = #{IOSEQ}";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "i";
		return $RtnVal;
    }  
	//VALID    
	public function updValidG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "CGPJT1";
		$RtnVal["SQLID"] = "updValidG";
		$RtnVal["SQLTXT"] = "update CG_PGMIO io JOIN CG_DD dd
	on io.COLID = dd.COLID
        and io.PJTSEQ = dd.PJTSEQ
set
        io.VALIDSEQ = dd.VALIDSEQ
        ,io.MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
where io.IOSEQ = #{IOSEQ}";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "i";
		return $RtnVal;
    }  
}
                                                             
?>