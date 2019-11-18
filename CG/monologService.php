<?php
//SVC
 
//include_once('MonologInterface.php');
include_once('monologDao.php');
//class MonologService implements MonologInterface
class monologService 
{
	private $DAO;
	private $DB;
	//생성자
	function __construct(){
		global $log;
		$log->info("MonologService-__construct");

		$this->DAO = new monologDao();
	    //$this->DB = db_s_open();
		$this->DB["CG"] = db_obj_open(getDbSvrInfo("CG"));
	}
	//파괴자
	function __destruct(){
		global $log;
		$log->info("MonologService-__destruct");

		unset($this->DAO);
		if($this->DB["CG"])$this->DB["CG"]->close();
		unset($this->DB);
	}
	function __toString(){
		global $log;
		$log->info("MonologService-__toString");
	}
	//, 조회(전체)
	public function goG1Searchall(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("MONOLOGService-goG1Searchall________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		$log->info("MONOLOGService-goG1Searchall________________________end");
	}
	//로그, 조회
	public function goG2Search(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("MONOLOGService-goG2Search________________________start");
		//그리드 서버 조회 
		//GRID_SEARCH____________________________start
		$GRID["SQL"] = array();
		$GRID["GRPTYPE"] = "GRID_DHTMLX";
		$GRID["KEYCOLIDX"] = 0; // KEY 컬럼, LOGSEQ

		//조회
		//V_GRPNM : 로그
		array_push($GRID["SQL"], $this->DAO->selG($REQ)); //SEARCH, 조회,selG
	//암호화컬럼
		$GRID["COLCRYPT"] = array();
		//필수 여부 검사
		$tmpVal = requireGridSearchArray($GRID["COLORD"],$GRID["XML"],$GRID["SQL"]);
		if($tmpVal->RTN_CD == "500"){
			$log->info("requireGrid - fail.");
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
		$log->info("MONOLOGService-goG2Search________________________end");
	}
	//로그, 엑셀다운로드
	public function goG2Excel(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("MONOLOGService-goG2Excel________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		$log->info("MONOLOGService-goG2Excel________________________end");
	}
	//상세, 조회
	public function goG3Search(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("MONOLOGService-goG3Search________________________start");
//FORMVIEW SEARCH
		$grpId="G3";
	//암호화컬럼
		$FORMVIEW["COLCRYPT"] = array();
		$FORMVIEW["SQL"] = array();
	// SQL LOOP
		// selF
		array_push($FORMVIEW["SQL"], $this->DAO->selF($REQ)); 
		//필수 여부 검사
		$tmpVal = requireFormviewSearchArray($FORMVIEW["SQL"]);
		if($tmpVal->RTN_CD == "500"){
			$log->info("requireFormview - fail.");
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
		$log->info("MONOLOGService-goG3Search________________________end");
	}
}
                                                             
?>
