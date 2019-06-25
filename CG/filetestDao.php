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
		$RtnVal["SQLTXT"] = "select FILESEQ, FILESVRNM, FILENM, FILETYPE from FILETEST 
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
	FILESVRNM, FILENM, FILETYPE
) values (
	#{G3-FILE1-SVRNM}, #{G3-FILE1-NM}, #{G3-FILE1-TYPE}
)";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "sss";
		return $RtnVal;
    }  
	//selF    
	public function selF($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "SC";
		$RtnVal["SQLID"] = "selF";
		$RtnVal["SQLTXT"] = "select FILESEQ, FILESVRNM, FILENM,'http://www.naver.com^네이버.pdf' as FILE1
	, 'http://www.naver.com/?2^네이버2.pdf' as LINKVIEW
	, 'http://www.naver.com/?3^네이버3.pdf' as HIDDENLINK
	, '99999999999' as BIVAL1A
from FILETEST 
where FILESEQ = #{G2-FILESEQ}
 and 1<>2 ";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "s";
		return $RtnVal;
    }  
	//selBI1    
	public function selBI1($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "SC";
		$RtnVal["SQLID"] = "selBI1";
		$RtnVal["SQLTXT"] = "select '값이여라' as BIVAL1A ";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
	//selBI2    
	public function selBI2($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "SC";
		$RtnVal["SQLID"] = "selBI2";
		$RtnVal["SQLTXT"] = "select '값이여라^두개여라' as BIVAL1A ";
		$RtnVal["PARENT_FNCTYPE"] = ""; // PSQLSEQ가 있으면 상위 SQL이 존재	
		$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
}
                                                             
?>