<?php
//DAO
 
class filetestDao
{
	function __construct(){
		alog("FiletestDao-__construct");
	}
	function __destruct(){
		alog("FiletestDao-__destruct");
	}
	function __toString(){
		alog("FiletestDao-__toString");
	}
	//selQ    
	public function selG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "SC";
		$RtnVal["SQLID"] = "selG";
		$RtnVal["SQLTXT"] = "select FILESEQ, FILESVRNM, FILENM from FILETEST 
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
	//insG    
	public function insG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SVRID"] = "SC";
		$RtnVal["SQLID"] = "insG";
		$RtnVal["SQLTXT"] = "insert into FILETEST (
	FILESVRNM, FILENM
) values (
	#{G3-FILE1-SVRNM}, #{G3-FILE1-NM}
)";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "ss";
		return $RtnVal;
    }  
	//selF    
	public function selF($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "SC";
		$RtnVal["SQLID"] = "selF";
		$RtnVal["SQLTXT"] = "select FILESEQ, FILESVRNM, FILENM,'http://www.naver.com^네이버.pdf' as FILE1 from FILETEST 
where FILESEQ = #{G2-FILESEQ}
";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "s";
		return $RtnVal;
    }  
}
                                                             
?>