<?php
//SVC
 
include_once('cg_pjt2Interface.php');
include_once('cg_pjt2Dao.php');
class Pjt2Service implements Pjt2Interface
{
	private $DAO;
	private $DB;

	function __construct(){
		alog("Test2Service-__construct");

		$this->DAO = new Pjt2Dao();
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
		global $REQ;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("TEST2Service-goG1Save________________________start");


		//GRID_SAVE____________________________start
		$grpId = "G3";
		alog("	" . $grpId . " SAVE ");
		$GRID["XML"] = $REQ[$grpId . "_XML"];
		$GRID["COLORD"] = "PJTID,PJTNM,DELYN,UITOOL,SVRLANG,PKGROOT,ADDDT,MODDT"; //그리드 컬럼순서(Hidden컬럼포함)
		$GRID["KEYCOLID"] = "PJTID";  //KEY컬럼 COLID, 1
		$GRID["SEQYN"] = "N";  //시퀀스 컬럼 유무
		//저장
		//V_GRPNM : PGM
		$GRID["SQL"]["C"] = $this->DAO->getSql4(); // SAVE, 저장, PJT
		//V_GRPNM : PGM
		$GRID["SQL"]["U"] = $this->DAO->getSql3(); // SAVE, 저장, PJT
		//V_GRPNM : PGM
		$GRID["SQL"]["D"] = $this->DAO->getSql2(); // SAVE, 저장, PJT

		$tmpVal = makeGridSaveJson($GRID,$this->DB);
		$tmpVal->GRPID = $grpId;
		array_push($rtnVal->GRP_DATA, $tmpVal);
		//GRID_SAVE____________________________end

		//GRID_SAVE____________________________start
		$grpId = "G4";
		alog("	" . $grpId . " SAVE ");
		$GRID["XML"] = $REQ[$grpId . "_XML"];
		$GRID["COLORD"] = "PJTID,PGMID,PGMNM,PKGGRP,ADDDT,MODDT"; //그리드 컬럼순서(Hidden컬럼포함)
		$GRID["KEYCOLID"] = "PGMID";  //KEY컬럼 COLID, 1
		$GRID["SEQYN"] = "N";  //시퀀스 컬럼 유무
		//저장
		//V_GRPNM : PGM
		$GRID["SQL"]["C"] = $this->DAO->getSql7(); // SAVE, 저장, PGM
		//V_GRPNM : PGM
		$GRID["SQL"]["U"] = $this->DAO->getSql8(); // SAVE, 저장, PGM
		//V_GRPNM : PGM
		$GRID["SQL"]["D"] = $this->DAO->getSql9(); // SAVE, 저장, PGM

		$tmpVal = makeGridSaveJson($GRID,$this->DB);
		$tmpVal->GRPID = $grpId;
		array_push($rtnVal->GRP_DATA, $tmpVal);
		//GRID_SAVE____________________________end


		//GRID_SAVE____________________________start
		$grpId = "G5";
		alog("	" . $grpId . " SAVE ");
		$GRID["XML"] = $REQ[$grpId . "_XML"];
		$GRID["COLORD"] = "PJTID,COLID,COLNM,COLSNM,DATATYPE,DATASIZE,OBJTYPE,LBLWIDTH,LBLHEIGHT,OBJWIDTH,OBJHEIGHT,OBJALIGN,ADDDT,MODDT"; //그리드 컬럼순서(Hidden컬럼포함)
		$GRID["KEYCOLID"] = "COLID";  //KEY컬럼 COLID, 1
		$GRID["SEQYN"] = "N";  //시퀀스 컬럼 유무
		//저장
		//V_GRPNM : DD
		$GRID["SQL"]["C"] = $this->DAO->getSql11(); // SAVE, 저장, DD
		//V_GRPNM : DD
		$GRID["SQL"]["U"] = $this->DAO->getSql12(); // SAVE, 저장, DD
		//V_GRPNM : DD
		$GRID["SQL"]["D"] = $this->DAO->getSql13(); // SAVE, 저장, DD

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
		global $REQ,$rtnVal;
		alog("TEST2Service-goG3Search________________________start");
		//그리드 서버 조회 
		//GRID_SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 0; // KEY 컬럼, PJTID

		//조회
		//V_GRPNM : PJT
		$GRID["SQL"]["R"] = $this->DAO->getSql1($REQ); //SEARCH, 조회,PJT
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
		global $REQ;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();


		alog("TEST2Service-goG3Save________________________start");
		//GRID_SAVE____________________________start
		$grpId = "G3";
		$GRID["XML"] = $REQ[$grpId . "_XML"];
		$GRID["COLORD"] = "PJTID,PJTNM,DELYN,UITOOL,SVRLANG,PKGROOT,ADDDT,MODDT"; //그리드 컬럼순서(Hidden컬럼포함)
		$GRID["KEYCOLID"] = "PJTID";  //KEY컬럼 COLID, 0
		//저장
		//V_GRPNM : PJT
		$GRID["SQL"]["D"] = $this->DAO->getSql2(); // SAVE, 저장, PJT
		//V_GRPNM : PJT
		$GRID["SQL"]["U"] = $this->DAO->getSql3(); // SAVE, 저장, PJT
		//V_GRPNM : PJT
		$GRID["SQL"]["C"] = $this->DAO->getSql4(); // SAVE, 저장, PJT

		$tmpVal = makeGridSaveJson($GRID,$this->DB);
		$tmpVal->GRPID = $grpId;
		array_push($rtnVal->GRP_DATA, $tmpVal);

		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);

		
		//GRID_SAVE____________________________end
		alog("TEST2Service-goG3Save________________________end");
	}
	//PGM, 조회
	public function goG4Search(){
		global $REQ,$rtnVal;
		alog("TEST2Service-goG4Search________________________start");
		//그리드 서버 조회 
		//GRID_SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 1; // KEY 컬럼, PGMID

		//조회
		//V_GRPNM : PGM
		$GRID["SQL"]["R"] = $this->DAO->getSql6($REQ); //SEARCH, 조회,PGM
		$rtnVal = makeGridSearchJson($GRID,$this->DB);

		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);


		//GRID_SEARCH____________________________end
		alog("TEST2Service-goG4Search________________________end");
	}
	//PGM, 저장
	public function goG4Save(){
		global $REQ;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();


		alog("TEST2Service-goG4Save________________________start");
		//GRID_SAVE____________________________start
		$grpId = "G4";
		$GRID["XML"] = $REQ[$grpId . "_XML"];
		$GRID["COLORD"] = "PJTID,PGMID,PGMNM,ADDDT,MODDT"; //그리드 컬럼순서(Hidden컬럼포함)
		$GRID["KEYCOLID"] = "PGMID";  //KEY컬럼 COLID, 1
		//저장
		//V_GRPNM : PGM
		$GRID["SQL"]["C"] = $this->DAO->getSql7(); // SAVE, 저장, PGM
		//V_GRPNM : PGM
		$GRID["SQL"]["U"] = $this->DAO->getSql8(); // SAVE, 저장, PGM
		//V_GRPNM : PGM
		$GRID["SQL"]["D"] = $this->DAO->getSql9(); // SAVE, 저장, PGM

		$tmpVal = makeGridSaveJson($GRID,$this->DB);
		$tmpVal->GRPID = $grpId;
		array_push($rtnVal->GRP_DATA, $tmpVal);


		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);

		//GRID_SAVE____________________________end
		alog("TEST2Service-goG4Save________________________end");
	}
	//DD, 조회
	public function goG5Search(){
		global $REQ,$rtnVal;
		alog("TEST2Service-goG5Search________________________start");
		//그리드 서버 조회 
		//GRID_SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 1; // KEY 컬럼, COLID

		//조회
		//V_GRPNM : DD
		$GRID["SQL"]["R"] = $this->DAO->getSql10($REQ); //SEARCH, 조회,DD
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
		global $REQ;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();


		alog("TEST2Service-goG5Save________________________start");
		//GRID_SAVE____________________________start
		$grpId = "G5";
		$GRID["XML"] = $REQ[$grpId . "_XML"];
		$GRID["COLORD"] = "PJTID,COLID,COLNM,COLSNM,DATATYPE,DATASIZE,OBJTYPE,LBLWIDTH,LBLHEIGHT,OBJWIDTH,OBJHEIGHT,OBJALIGN,ADDDT,MODDT"; //그리드 컬럼순서(Hidden컬럼포함)
		$GRID["KEYCOLID"] = "COLID";  //KEY컬럼 COLID, 1
		//저장
		//V_GRPNM : DD
		$GRID["SQL"]["C"] = $this->DAO->getSql11(); // SAVE, 저장, DD
		//V_GRPNM : DD
		$GRID["SQL"]["U"] = $this->DAO->getSql12(); // SAVE, 저장, DD
		//V_GRPNM : DD
		$GRID["SQL"]["D"] = $this->DAO->getSql13(); // SAVE, 저장, DD


		$tmpVal = makeGridSaveJson($GRID,$this->DB);
		$tmpVal->GRPID = $grpId;
		array_push($rtnVal->GRP_DATA, $tmpVal);


		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);

		//GRID_SAVE____________________________end
		alog("TEST2Service-goG5Save________________________end");
	}
}
                                                             
?>
