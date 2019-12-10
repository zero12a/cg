<?php
//SVC
 
//include_once('Test2Interface.php');
include_once('test2Dao.php');
//class Test2Service implements Test2Interface
class test2Service 
{
	private $DAO;
	private $DB;

	function __construct(){
		alog("Test2Service-__construct");

		$this->DAO = new test2Dao();
	    $this->DB = db_m_open();
	}
	function __destruct(){
		alog("Test2Service-__destruct");

		unset($this->DAO);
		if($this->DB)$this->DB->close();
		unset($this->DB);
	}
	function __toString(){
		alog("Test2Service-__toString");
	}
	//1, 저장
	public function goG1Save(){
		global $REQ,$CFG_UPLOAD_DIR;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("TEST2Service-goG1Save________________________start");
		//GRID_SAVE____________________________start
		$grpId="G4";
		$GRID["XML"]=$REQ[$grpId."_XML"];
		$GRID["COLORD"] = "PJTSEQ,PGMSEQ,PGMID,PGMNM,PKGGRP,ADDDT,MODDT"; //그리드 컬럼순서(Hidden컬럼포함)
		$GRID["KEYCOLID"] = "PGMSEQ";  //KEY컬럼 COLID, 1
		$GRID["SEQYN"] = "Y";  //시퀀스 컬럼 유무
		//저장
		$GRID["SQL"]["C"] = $this->DAO->sql7($REQ); // SAVE, 저장, PGM
		$GRID["SQL"]["U"] = $this->DAO->sql8($REQ); // SAVE, 저장, PGM
		$GRID["SQL"]["D"] = $this->DAO->sql9($REQ); // SAVE, 저장, PGM
		$tmpVal = makeGridSaveJson($GRID,$this->DB);
		$tmpVal->GRPID = $grpId;
		array_push($rtnVal->GRP_DATA, $tmpVal);
		//GRID_SAVE____________________________end


		//GRID_SAVE____________________________start
		$grpId="G5";
		$GRID["XML"]=$REQ[$grpId."_XML"];
		$GRID["COLORD"] = "PJTSEQ,COLID,COLNM,COLSNM,DATATYPE,DATASIZE,OBJTYPE,LBLWIDTH,LBLHEIGHT,OBJWIDTH,OBJHEIGHT,OBJALIGN,ADDDT,MODDT"; //그리드 컬럼순서(Hidden컬럼포함)
		$GRID["KEYCOLID"] = "COLID";  //KEY컬럼 COLID, 1
		$GRID["SEQYN"] = "N";  //시퀀스 컬럼 유무
		//저장
		$GRID["SQL"]["C"] = $this->DAO->sql11($REQ); // SAVE, 저장, DD
		$GRID["SQL"]["U"] = $this->DAO->sql12($REQ); // SAVE, 저장, DD
		$GRID["SQL"]["D"] = $this->DAO->sql13($REQ); // SAVE, 저장, DD
		$tmpVal = makeGridSaveJson($GRID,$this->DB);
		$tmpVal->GRPID = $grpId;
		array_push($rtnVal->GRP_DATA, $tmpVal);
		//GRID_SAVE____________________________end


		//GRID_SAVE____________________________start
		$grpId="G3";
		$GRID["XML"]=$REQ[$grpId."_XML"];
		$GRID["COLORD"] = "PJTSEQ,PJTID,PJTNM,FILECHARSET,UITOOL,SVRLANG,PKGROOT,STARTDT,ENDDT,DELYN,ADDDT,MODDT"; //그리드 컬럼순서(Hidden컬럼포함)
		$GRID["KEYCOLID"] = "PJTSEQ";  //KEY컬럼 COLID, 0
		$GRID["SEQYN"] = "Y";  //시퀀스 컬럼 유무
		//저장
		$GRID["SQL"]["D"] = $this->DAO->sql2($REQ); // SAVE, 저장, PJT
		$GRID["SQL"]["U"] = $this->DAO->sql3($REQ); // SAVE, 저장, PJT
		$GRID["SQL"]["C"] = $this->DAO->sql4($REQ); // SAVE, 저장, PJT
		$tmpVal = makeGridSaveJson($GRID,$this->DB);
		$tmpVal->GRPID = $grpId;
		array_push($rtnVal->GRP_DATA, $tmpVal);
		//GRID_SAVE____________________________end


		//GRID_SAVE____________________________start
		$grpId="G6";
		$GRID["XML"]=$REQ[$grpId."_XML"];
		$GRID["COLORD"] = "PJTSEQ,CFGSEQ,CFGID,CFGNM,MVCGBN,PATH,CFGORD,ADDDT,MODDT"; //그리드 컬럼순서(Hidden컬럼포함)
		$GRID["KEYCOLID"] = "CFGSEQ";  //KEY컬럼 COLID, 1
		$GRID["SEQYN"] = "Y";  //시퀀스 컬럼 유무
		//저장
		$GRID["SQL"]["C"] = $this->DAO->impC($REQ); // SAVE, 저장, CONFIG
		$GRID["SQL"]["U"] = $this->DAO->impU($REQ); // SAVE, 저장, CONFIG
		$GRID["SQL"]["D"] = $this->DAO->impD($REQ); // SAVE, 저장, CONFIG
		$tmpVal = makeGridSaveJson($GRID,$this->DB);
		$tmpVal->GRPID = $grpId;
		array_push($rtnVal->GRP_DATA, $tmpVal);
		//GRID_SAVE____________________________end


		//GRID_SAVE____________________________start
		$grpId="G7";
		$GRID["XML"]=$REQ[$grpId."_XML"];
		$GRID["COLORD"] = "PJTSEQ,FILESEQ,MKFILETYPE,MKFILETYPENM,MKFILEFORMAT,MKFILEEXT,TEMPLATE,FILEORD,USEYN,ADDDT,MODDT"; //그리드 컬럼순서(Hidden컬럼포함)
		$GRID["KEYCOLID"] = "FILESEQ";  //KEY컬럼 COLID, 1
		$GRID["SEQYN"] = "Y";  //시퀀스 컬럼 유무
		//저장
		$GRID["SQL"]["C"] = $this->DAO->fileC($REQ); // SAVE, 저장, FILE
		$GRID["SQL"]["U"] = $this->DAO->fileU($REQ); // SAVE, 저장, FILE
		$tmpVal = makeGridSaveJson($GRID,$this->DB);
		$tmpVal->GRPID = $grpId;
		array_push($rtnVal->GRP_DATA, $tmpVal);
		//GRID_SAVE____________________________end


		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("TEST2Service-goG1Save________________________end");
	}
	//PJT, 조회
	public function goG3Search(){
		global $REQ,$CFG_UPLOAD_DIR;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("TEST2Service-goG3Search________________________start");
		//그리드 서버 조회 
		//GRID_SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 0; // KEY 컬럼, PJTSEQ

		//조회
		//V_GRPNM : PJT
		$GRID["SQL"]["R"] = $this->DAO->sql1($REQ); //SEARCH, 조회,PJT
		$rtnVal = makeGridSearchJson($GRID,$this->DB);
		//GRID_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("TEST2Service-goG3Search________________________end");
	}
	//PJT, 저장
	public function goG3Save(){
		global $REQ,$CFG_UPLOAD_DIR;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("TEST2Service-goG3Save________________________start");
		//GRID_SAVE____________________________start
		$grpId="G3";
		$GRID["XML"]=$REQ[$grpId."_XML"];
		$GRID["COLORD"] = "PJTSEQ,PJTID,PJTNM,FILECHARSET,UITOOL,SVRLANG,PKGROOT,STARTDT,ENDDT,DELYN,ADDDT,MODDT"; //그리드 컬럼순서(Hidden컬럼포함)
		$GRID["KEYCOLID"] = "PJTSEQ";  //KEY컬럼 COLID, 0
		$GRID["SEQYN"] = "Y";  //시퀀스 컬럼 유무
		//저장
		$GRID["SQL"]["D"] = $this->DAO->sql2($REQ); // SAVE, 저장, PJT
		$GRID["SQL"]["U"] = $this->DAO->sql3($REQ); // SAVE, 저장, PJT
		$GRID["SQL"]["C"] = $this->DAO->sql4($REQ); // SAVE, 저장, PJT
		$tmpVal = makeGridSaveJson($GRID,$this->DB);
		$tmpVal->GRPID = $grpId;
		array_push($rtnVal->GRP_DATA, $tmpVal);
		//GRID_SAVE____________________________end


		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("TEST2Service-goG3Save________________________end");
	}
	//PJT, 링크이동합니다
	public function goG3Link(){
		global $REQ,$CFG_UPLOAD_DIR;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("TEST2Service-goG3Link________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("TEST2Service-goG3Link________________________end");
	}
	//PGM, 조회
	public function goG4Search(){
		global $REQ,$CFG_UPLOAD_DIR;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("TEST2Service-goG4Search________________________start");
		//그리드 서버 조회 
		//GRID_SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 1; // KEY 컬럼, PGMSEQ

		//조회
		//V_GRPNM : PGM
		$GRID["SQL"]["R"] = $this->DAO->sql6($REQ); //SEARCH, 조회,PGM
		$rtnVal = makeGridSearchJson($GRID,$this->DB);
		//GRID_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("TEST2Service-goG4Search________________________end");
	}
	//PGM, 저장
	public function goG4Save(){
		global $REQ,$CFG_UPLOAD_DIR;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("TEST2Service-goG4Save________________________start");
		//GRID_SAVE____________________________start
		$grpId="G4";
		$GRID["XML"]=$REQ[$grpId."_XML"];
		$GRID["COLORD"] = "PJTSEQ,PGMSEQ,PGMID,PGMNM,PKGGRP,ADDDT,MODDT"; //그리드 컬럼순서(Hidden컬럼포함)
		$GRID["KEYCOLID"] = "PGMSEQ";  //KEY컬럼 COLID, 1
		$GRID["SEQYN"] = "Y";  //시퀀스 컬럼 유무
		//저장
		$GRID["SQL"]["C"] = $this->DAO->sql7($REQ); // SAVE, 저장, PGM
		$GRID["SQL"]["U"] = $this->DAO->sql8($REQ); // SAVE, 저장, PGM
		$GRID["SQL"]["D"] = $this->DAO->sql9($REQ); // SAVE, 저장, PGM
		$tmpVal = makeGridSaveJson($GRID,$this->DB);
		$tmpVal->GRPID = $grpId;
		array_push($rtnVal->GRP_DATA, $tmpVal);
		//GRID_SAVE____________________________end


		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("TEST2Service-goG4Save________________________end");
	}
	//DD, 조회
	public function goG5Search(){
		global $REQ,$CFG_UPLOAD_DIR;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("TEST2Service-goG5Search________________________start");
		//그리드 서버 조회 
		//GRID_SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 1; // KEY 컬럼, COLID

		//조회
		//V_GRPNM : DD
		$GRID["SQL"]["R"] = $this->DAO->sql10($REQ); //SEARCH, 조회,DD
		$rtnVal = makeGridSearchJson($GRID,$this->DB);
		//GRID_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("TEST2Service-goG5Search________________________end");
	}
	//DD, 저장
	public function goG5Save(){
		global $REQ,$CFG_UPLOAD_DIR;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("TEST2Service-goG5Save________________________start");
		//GRID_SAVE____________________________start
		$grpId="G5";
		$GRID["XML"]=$REQ[$grpId."_XML"];
		$GRID["COLORD"] = "PJTSEQ,COLID,COLNM,COLSNM,DATATYPE,DATASIZE,OBJTYPE,LBLWIDTH,LBLHEIGHT,OBJWIDTH,OBJHEIGHT,OBJALIGN,ADDDT,MODDT"; //그리드 컬럼순서(Hidden컬럼포함)
		$GRID["KEYCOLID"] = "COLID";  //KEY컬럼 COLID, 1
		$GRID["SEQYN"] = "N";  //시퀀스 컬럼 유무
		//저장
		$GRID["SQL"]["C"] = $this->DAO->sql11($REQ); // SAVE, 저장, DD
		$GRID["SQL"]["U"] = $this->DAO->sql12($REQ); // SAVE, 저장, DD
		$GRID["SQL"]["D"] = $this->DAO->sql13($REQ); // SAVE, 저장, DD
		$tmpVal = makeGridSaveJson($GRID,$this->DB);
		$tmpVal->GRPID = $grpId;
		array_push($rtnVal->GRP_DATA, $tmpVal);
		//GRID_SAVE____________________________end


		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("TEST2Service-goG5Save________________________end");
	}
	//CONFIG, 사용자정의
	public function goG6Userdef(){
		global $REQ,$CFG_UPLOAD_DIR;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("TEST2Service-goG6Userdef________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("TEST2Service-goG6Userdef________________________end");
	}
	//CONFIG, 조회
	public function goG6Search(){
		global $REQ,$CFG_UPLOAD_DIR;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("TEST2Service-goG6Search________________________start");
		//그리드 서버 조회 
		//GRID_SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 1; // KEY 컬럼, CFGSEQ

		//조회
		//V_GRPNM : CONFIG
		$GRID["SQL"]["R"] = $this->DAO->impR($REQ); //SEARCH, 조회,CONFIG
		$rtnVal = makeGridSearchJson($GRID,$this->DB);
		//GRID_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("TEST2Service-goG6Search________________________end");
	}
	//CONFIG, 저장
	public function goG6Save(){
		global $REQ,$CFG_UPLOAD_DIR;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("TEST2Service-goG6Save________________________start");
		//GRID_SAVE____________________________start
		$grpId="G6";
		$GRID["XML"]=$REQ[$grpId."_XML"];
		$GRID["COLORD"] = "PJTSEQ,CFGSEQ,CFGID,CFGNM,MVCGBN,PATH,CFGORD,ADDDT,MODDT"; //그리드 컬럼순서(Hidden컬럼포함)
		$GRID["KEYCOLID"] = "CFGSEQ";  //KEY컬럼 COLID, 1
		$GRID["SEQYN"] = "Y";  //시퀀스 컬럼 유무
		//저장
		$GRID["SQL"]["C"] = $this->DAO->impC($REQ); // SAVE, 저장, CONFIG
		$GRID["SQL"]["U"] = $this->DAO->impU($REQ); // SAVE, 저장, CONFIG
		$GRID["SQL"]["D"] = $this->DAO->impD($REQ); // SAVE, 저장, CONFIG
		$tmpVal = makeGridSaveJson($GRID,$this->DB);
		$tmpVal->GRPID = $grpId;
		array_push($rtnVal->GRP_DATA, $tmpVal);
		//GRID_SAVE____________________________end


		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("TEST2Service-goG6Save________________________end");
	}
	//CONFIG, 엑셀다운로드
	public function goG6Excel(){
		global $REQ,$CFG_UPLOAD_DIR;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("TEST2Service-goG6Excel________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("TEST2Service-goG6Excel________________________end");
	}
	//FILE, 사용자정의
	public function goG7Userdef(){
		global $REQ,$CFG_UPLOAD_DIR;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("TEST2Service-goG7Userdef________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("TEST2Service-goG7Userdef________________________end");
	}
	//FILE, 조회
	public function goG7Search(){
		global $REQ,$CFG_UPLOAD_DIR;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("TEST2Service-goG7Search________________________start");
		//그리드 서버 조회 
		//GRID_SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 1; // KEY 컬럼, FILESEQ

		//조회
		//V_GRPNM : FILE
		$GRID["SQL"]["R"] = $this->DAO->fileR($REQ); //SEARCH, 조회,FILE
		$rtnVal = makeGridSearchJson($GRID,$this->DB);
		//GRID_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("TEST2Service-goG7Search________________________end");
	}
	//FILE, 저장
	public function goG7Save(){
		global $REQ,$CFG_UPLOAD_DIR;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("TEST2Service-goG7Save________________________start");
		//GRID_SAVE____________________________start
		$grpId="G7";
		$GRID["XML"]=$REQ[$grpId."_XML"];
		$GRID["COLORD"] = "PJTSEQ,FILESEQ,MKFILETYPE,MKFILETYPENM,MKFILEFORMAT,MKFILEEXT,TEMPLATE,FILEORD,USEYN,ADDDT,MODDT"; //그리드 컬럼순서(Hidden컬럼포함)
		$GRID["KEYCOLID"] = "FILESEQ";  //KEY컬럼 COLID, 1
		$GRID["SEQYN"] = "Y";  //시퀀스 컬럼 유무
		//저장
		$GRID["SQL"]["C"] = $this->DAO->fileC($REQ); // SAVE, 저장, FILE
		$tmpVal = makeGridSaveJson($GRID,$this->DB);
		$tmpVal->GRPID = $grpId;
		array_push($rtnVal->GRP_DATA, $tmpVal);
		//GRID_SAVE____________________________end


		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("TEST2Service-goG7Save________________________end");
	}
	//FILE, 엑셀다운로드
	public function goG7Excel(){
		global $REQ,$CFG_UPLOAD_DIR;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("TEST2Service-goG7Excel________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("TEST2Service-goG7Excel________________________end");
	}
}
                                                             
?>
