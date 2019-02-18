<?php
//SVC
 
//include_once('PjtcopyInterface.php');
include_once('pjtcopyDao.php');
//class PjtcopyService implements PjtcopyInterface
class pjtcopyService 
{
	private $DAO;
	private $DB;
	//생성자
	function __construct(){
		alog("PjtcopyService-__construct");

		$this->DAO = new pjtcopyDao();
	    //$this->DB = db_s_open();
		$this->DB["CG"] = db_obj_open(getDbSvrInfo("CG"));
	}
	//파괴자
	function __destruct(){
		alog("PjtcopyService-__destruct");

		unset($this->DAO);
		if($this->DB["CG"])$this->DB["CG"]->close();
		unset($this->DB);
	}
	function __toString(){
		alog("PjtcopyService-__toString");
	}
	//, 조회(전체)
	public function goG1Searchall(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("PJTCOPYService-goG1Searchall________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("PJTCOPYService-goG1Searchall________________________end");
	}
	//, 저장
	public function goG1Save(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("PJTCOPYService-goG1Save________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("PJTCOPYService-goG1Save________________________end");
	}
	//from CFG, 조회
	public function goG2Search(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("PJTCOPYService-goG2Search________________________start");
		//그리드 서버 조회 
		//GRID_SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 2; // KEY 컬럼, CFGSEQ

		//조회
		//V_GRPNM : from CFG
		$GRID["SQL"]["R"] = $this->DAO->sFromCFG($REQ); //SEARCH, 조회,FromCfg
	//암호화컬럼
		$GRID["COLCRYPT"] = array();
		//필수 여부 검사
		$tmpVal = requireGridSearch($GRID["COLORD"],$GRID["XML"],$GRID["SQL"]);
		if($tmpVal->RTN_CD == "500"){
			alog("requireGrid - fail.");
			$tmpVal->GRPID = $grpId;
			echo json_encode($tmpVal);
			exit;
		}
		$rtnVal = makeGridSearchJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G2]",microtime(true)));
		//GRID_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("PJTCOPYService-goG2Search________________________end");
	}
	//from CFG, Copy
	public function goG2Save(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("PJTCOPYService-goG2Save________________________start");
		//GRID_SAVE____________________________start
		$grpId="G2";
		$GRID["XML"]=$REQ[$grpId."-XML"];
		$GRID["COLORD"] = "CHKEDIT,PJTSEQ,CFGSEQ,USEYN,CFGID,CFGNM,MVCGBN,PATH,CFGORD,ADDDT,MODDT"; //그리드 컬럼순서(Hidden컬럼포함)
	//암호화컬럼
		$GRID["COLCRYPT"] = array();	
		$GRID["KEYCOLID"] = "CFGSEQ";  //KEY컬럼 COLID, 2
		$GRID["SEQYN"] = "Y";  //시퀀스 컬럼 유무
		//Copy
		$GRID["SQL"]["U"] = $this->DAO->iFromCFG($REQ); // SAVE, Copy, CopyCFG
		$tmpVal = requireGridSave($GRID["COLORD"],$GRID["XML"],$GRID["SQL"]);
		if($tmpVal->RTN_CD == "500"){
			alog("requireGrid - fail.");
			$tmpVal->GRPID = $grpId;
			echo json_encode($tmpVal);
			exit;
		}
		$tmpVal = makeGridSaveJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G2]",microtime(true)));

		$tmpVal->GRPID = $grpId;
		array_push($rtnVal->GRP_DATA, $tmpVal);
		//GRID_SAVE____________________________end


		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("PJTCOPYService-goG2Save________________________end");
	}
	//from FILE, 조회
	public function goG3Search(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("PJTCOPYService-goG3Search________________________start");
		//그리드 서버 조회 
		//GRID_SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 2; // KEY 컬럼, FILESEQ

		//조회
		//V_GRPNM : from FILE
		$GRID["SQL"]["R"] = $this->DAO->sFromFile($REQ); //SEARCH, 조회,FromFile
	//암호화컬럼
		$GRID["COLCRYPT"] = array();
		//필수 여부 검사
		$tmpVal = requireGridSearch($GRID["COLORD"],$GRID["XML"],$GRID["SQL"]);
		if($tmpVal->RTN_CD == "500"){
			alog("requireGrid - fail.");
			$tmpVal->GRPID = $grpId;
			echo json_encode($tmpVal);
			exit;
		}
		$rtnVal = makeGridSearchJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G3]",microtime(true)));
		//GRID_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("PJTCOPYService-goG3Search________________________end");
	}
	//from FILE, Copy
	public function goG3Save(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("PJTCOPYService-goG3Save________________________start");
		//GRID_SAVE____________________________start
		$grpId="G3";
		$GRID["XML"]=$REQ[$grpId."-XML"];
		$GRID["COLORD"] = "CHKEDIT,PJTSEQ,FILESEQ,MKFILETYPE,MKFILETYPENM,MKFILEFORMAT,MKFILEEXT,TEMPLATE,FILEORD,USEYN,ADDDT,MODDT"; //그리드 컬럼순서(Hidden컬럼포함)
	//암호화컬럼
		$GRID["COLCRYPT"] = array();	
		$GRID["KEYCOLID"] = "FILESEQ";  //KEY컬럼 COLID, 2
		$GRID["SEQYN"] = "Y";  //시퀀스 컬럼 유무
		//Copy
		$GRID["SQL"]["U"] = $this->DAO->iFromFile($REQ); // SAVE, Copy, CopyFile
		$tmpVal = requireGridSave($GRID["COLORD"],$GRID["XML"],$GRID["SQL"]);
		if($tmpVal->RTN_CD == "500"){
			alog("requireGrid - fail.");
			$tmpVal->GRPID = $grpId;
			echo json_encode($tmpVal);
			exit;
		}
		$tmpVal = makeGridSaveJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G3]",microtime(true)));

		$tmpVal->GRPID = $grpId;
		array_push($rtnVal->GRP_DATA, $tmpVal);
		//GRID_SAVE____________________________end


		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("PJTCOPYService-goG3Save________________________end");
	}
	//to CFG, 조회
	public function goG4Search(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("PJTCOPYService-goG4Search________________________start");
		//그리드 서버 조회 
		//GRID_SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 1; // KEY 컬럼, CFGSEQ

		//조회
		//V_GRPNM : to CFG
		$GRID["SQL"]["R"] = $this->DAO->sToCFG($REQ); //SEARCH, 조회,ToCfg
	//암호화컬럼
		$GRID["COLCRYPT"] = array();
		//필수 여부 검사
		$tmpVal = requireGridSearch($GRID["COLORD"],$GRID["XML"],$GRID["SQL"]);
		if($tmpVal->RTN_CD == "500"){
			alog("requireGrid - fail.");
			$tmpVal->GRPID = $grpId;
			echo json_encode($tmpVal);
			exit;
		}
		$rtnVal = makeGridSearchJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G4]",microtime(true)));
		//GRID_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("PJTCOPYService-goG4Search________________________end");
	}
	//to CFG, 저장
	public function goG4Save(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("PJTCOPYService-goG4Save________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("PJTCOPYService-goG4Save________________________end");
	}
	//to CFG, 선택저장
	public function goG4Chksave(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("PJTCOPYService-goG4Chksave________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("PJTCOPYService-goG4Chksave________________________end");
	}
	//to FILE, 조회
	public function goG5Search(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("PJTCOPYService-goG5Search________________________start");
		//그리드 서버 조회 
		//GRID_SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 1; // KEY 컬럼, FILESEQ

		//조회
		//V_GRPNM : to FILE
		$GRID["SQL"]["R"] = $this->DAO->sToFile($REQ); //SEARCH, 조회,ToFile
	//암호화컬럼
		$GRID["COLCRYPT"] = array();
		//필수 여부 검사
		$tmpVal = requireGridSearch($GRID["COLORD"],$GRID["XML"],$GRID["SQL"]);
		if($tmpVal->RTN_CD == "500"){
			alog("requireGrid - fail.");
			$tmpVal->GRPID = $grpId;
			echo json_encode($tmpVal);
			exit;
		}
		$rtnVal = makeGridSearchJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G5]",microtime(true)));
		//GRID_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("PJTCOPYService-goG5Search________________________end");
	}
	//to FILE, 저장
	public function goG5Save(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("PJTCOPYService-goG5Save________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("PJTCOPYService-goG5Save________________________end");
	}
	//to FILE, 선택저장
	public function goG5Chksave(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("PJTCOPYService-goG5Chksave________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("PJTCOPYService-goG5Chksave________________________end");
	}
}
                                                             
?>
