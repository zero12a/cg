<?php
//SVC
 
//include_once('MenumngInterface.php');
include_once('menumngDao.php');
//class MenumngService implements MenumngInterface
class menumngService 
{
	private $DAO;
	private $DB;
	//생성자
	function __construct(){
		alog("MenumngService-__construct");

		$this->DAO = new menumngDao();
	    //$this->DB = db_s_open();
		$this->DB["DATING"] = db_obj_open(getDbSvrInfo("DATING"));
	}
	//파괴자
	function __destruct(){
		alog("MenumngService-__destruct");

		unset($this->DAO);
		if($this->DB["DATING"])$this->DB["DATING"]->close();
		unset($this->DB);
	}
	function __toString(){
		alog("MenumngService-__toString");
	}
	//조회조건, 조회(전체)
	public function goG1Searchall(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("MENUMNGService-goG1Searchall________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("MENUMNGService-goG1Searchall________________________end");
	}
	//조회조건, 저장
	public function goG1Save(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("MENUMNGService-goG1Save________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("MENUMNGService-goG1Save________________________end");
	}
	//폴더, 조회
	public function goG2Search(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("MENUMNGService-goG2Search________________________start");
		//그리드 서버 조회 
		//GRID_SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 0; // KEY 컬럼, FOLDER_SEQ

		//조회
		//V_GRPNM : 폴더
		$GRID["SQL"]["R"] = $this->DAO->selFoldG($REQ); //SEARCH, 조회,selFoldG
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
		alog("MENUMNGService-goG2Search________________________end");
	}
	//폴더, S
	public function goG2Save(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("MENUMNGService-goG2Save________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("MENUMNGService-goG2Save________________________end");
	}
	//폴더, 엑셀다운로드
	public function goG2Excel(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("MENUMNGService-goG2Excel________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("MENUMNGService-goG2Excel________________________end");
	}
	//폴더, 선택저장
	public function goG2Chksave(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("MENUMNGService-goG2Chksave________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("MENUMNGService-goG2Chksave________________________end");
	}
	//메뉴, 조회
	public function goG3Search(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("MENUMNGService-goG3Search________________________start");
		//그리드 서버 조회 
		//GRID_SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 1; // KEY 컬럼, MNU_SEQ

		//조회
		//V_GRPNM : 메뉴
		$GRID["SQL"]["R"] = $this->DAO->selMenuG($REQ); //SEARCH, 조회,selMenuG
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
		alog("MENUMNGService-goG3Search________________________end");
	}
	//메뉴, S
	public function goG3Save(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("MENUMNGService-goG3Save________________________start");
		//GRID_SAVE____________________________start
		$grpId="G3";
		$GRID["XML"]=$REQ[$grpId."-XML"];
		$GRID["COLORD"] = "CHK,MNU_SEQ,PGMID,MNU_NM,URL,PGMTYPE,MNU_ORD,FOLDER_SEQ,USE_YN,ADD_DT,ADD_ID,MOD_ID,MOD_DT"; //그리드 컬럼순서(Hidden컬럼포함)
	//암호화컬럼
		$GRID["COLCRYPT"] = array();	
		$GRID["KEYCOLID"] = "MNU_SEQ";  //KEY컬럼 COLID, 1
		$GRID["SEQYN"] = "Y";  //시퀀스 컬럼 유무
		//S
		$GRID["SQL"]["C"] = $this->DAO->insMenuG($REQ); // SAVE, S, insMenuG
		$GRID["SQL"]["U"] = $this->DAO->updMenuG($REQ); // SAVE, S, updMenuG
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
		alog("MENUMNGService-goG3Save________________________end");
	}
	//메뉴, 엑셀다운로드
	public function goG3Excel(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("MENUMNGService-goG3Excel________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("MENUMNGService-goG3Excel________________________end");
	}
	//메뉴, 선택 삭제
	public function goG3Chksave(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("MENUMNGService-goG3Chksave________________________start");
		//GRID_CHK_SAVE____________________________start
		$grpId="G3";
		$GRID["CHK"]=$REQ[$grpId."-CHK"];
		$GRID["KEYCOLID"] = "MNU_SEQ";  //KEY컬럼 COLID, 1
		//선택 삭제	
		$GRID["SQL"] = $this->DAO->delMenuG($REQ); // CHKSAVE, 선택 삭제, delMenuG
			$tmpVal = makeGridChkJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G3]",microtime(true)));

		$tmpVal->GRPID = $grpId;
		array_push($rtnVal->GRP_DATA, $tmpVal);
		//GRID_CHK_SAVE____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("MENUMNGService-goG3Chksave________________________end");
	}
}
                                                             
?>
