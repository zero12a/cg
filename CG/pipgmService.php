<?php
//SVC
 
//include_once('PipgmInterface.php');
include_once('pipgmDao.php');
//class PipgmService implements PipgmInterface
class pipgmService 
{
	private $DAO;
	private $DB;
	//생성자
	function __construct(){
		alog("PipgmService-__construct");

		$this->DAO = new pipgmDao();
	    //$this->DB = db_s_open();
		$this->DB["CG"] = db_obj_open(getDbSvrInfo("CG"));
	}
	//파괴자
	function __destruct(){
		alog("PipgmService-__destruct");

		unset($this->DAO);
		if($this->DB["CG"])$this->DB["CG"]->close();
		unset($this->DB);
	}
	function __toString(){
		alog("PipgmService-__toString");
	}
	//검색, 조회(전체)
	public function goG1Searchall(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("PIPGMService-goG1Searchall________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("PIPGMService-goG1Searchall________________________end");
	}
	//검색, 저장
	public function goG1Save(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("PIPGMService-goG1Save________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("PIPGMService-goG1Save________________________end");
	}
	//PGM목록, 조회
	public function goG2Search(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("PIPGMService-goG2Search________________________start");
		//GRID_SEARCH____________________________start
		$GRID["SQL"] = array();
		$GRID["GRPTYPE"] = "GRID_BOOTSTRAP";
		$GRID["KEYCOLIDX"] = 1; // KEY 컬럼, PGMSEQ

		//조회
		//V_GRPNM : PGM목록
		array_push($GRID["SQL"], $this->DAO->selPgmG($REQ)); //SEARCH, 조회,selPgmG
	//암호화컬럼
		//필수 여부 검사
		$tmpVal = requireGridSearchArray($GRID["COLORD"],$GRID["XML"],$GRID["SQL"]);
		if($tmpVal->RTN_CD == "500"){
			alog("requireGrid - fail.");
			$tmpVal->GRPID = $grpId;
			echo json_encode($tmpVal);
			exit;
		}
		$rtnVal = makeGridSearchJsonArray($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G2]",microtime(true)));
		//GRID_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("PIPGMService-goG2Search________________________end");
	}
	//PGM상세, 조회
	public function goG3Search(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("PIPGMService-goG3Search________________________start");
//FORMVIEW SEARCH
		$grpId="G3";
	//암호화컬럼
		$FORMVIEW["COLCRYPT"] = array();
		$FORMVIEW["SQL"] = array();
	// SQL LOOP
		// selPgmF
		array_push($FORMVIEW["SQL"], $this->DAO->selPgmF($REQ)); 
		//필수 여부 검사
		$tmpVal = requireFormviewSearchArray($FORMVIEW["SQL"]);
		if($tmpVal->RTN_CD == "500"){
			alog("requireFormview - fail.");
			$tmpVal->GRPID = $grpId;
			echo json_encode($tmpVal);
			exit;
		}
		$rtnVal = makeFormviewSearchJsonArray($FORMVIEW,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G3]",microtime(true)));
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("PIPGMService-goG3Search________________________end");
	}
}
                                                             
?>
