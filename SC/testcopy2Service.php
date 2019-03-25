<?php
//SVC
 
//include_once('Testcopy2Interface.php');
include_once('testcopy2Dao.php');
//class Testcopy2Service implements Testcopy2Interface
class testcopy2Service 
{
	private $DAO;
	private $DB;
	//생성자
	function __construct(){
		alog("Testcopy2Service-__construct");

		$this->DAO = new testcopy2Dao();
	    //$this->DB = db_s_open();
		$this->DB["SC"] = db_obj_open(getDbSvrInfo("SC"));
	}
	//파괴자
	function __destruct(){
		alog("Testcopy2Service-__destruct");

		unset($this->DAO);
		if($this->DB["SC"])$this->DB["SC"]->close();
		unset($this->DB);
	}
	function __toString(){
		alog("Testcopy2Service-__toString");
	}
	//, 조회(전체)
	public function goG1Searchall(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("TESTCOPY2Service-goG1Searchall________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("TESTCOPY2Service-goG1Searchall________________________end");
	}
	//팀별 현황 (보안취약점 갯수)1, 조회
	public function goG2Search(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("TESTCOPY2Service-goG2Search________________________start");
		//CHARTBAR SEARCH____________________________start
		$GRID["KEYCOLIDX"] = -1; // KEY 컬럼, 

		//조회
		//V_GRPNM : 팀별 현황 (보안취약점 갯수)1
		$GRID["SQL"]["R"] = $this->DAO->sTeamChart($REQ); //SEARCH, 조회,TEAM2
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
		//CHARTBAR_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("TESTCOPY2Service-goG2Search________________________end");
	}
	//팀별 현황 (보안취약점 갯수)2, 조회
	public function goG3Search(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("TESTCOPY2Service-goG3Search________________________start");
		//그리드 서버 조회 
		//GRID_SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 0; // KEY 컬럼, UUID_SEQ

		//조회
		//V_GRPNM : 팀별 현황 (보안취약점 갯수)2
		$GRID["SQL"]["R"] = $this->DAO->sTeam($REQ); //SEARCH, 조회,TEAM1
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
		alog("TESTCOPY2Service-goG3Search________________________end");
	}
	//시스템별 현황, 조회
	public function goG4Search(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("TESTCOPY2Service-goG4Search________________________start");
		//그리드 서버 조회 
		//GRID_SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 0; // KEY 컬럼, UUID_SEQ

		//조회
		//V_GRPNM : 시스템별 현황
		$GRID["SQL"]["R"] = $this->DAO->sSys($REQ); //SEARCH, 조회,SYS
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
		alog("TESTCOPY2Service-goG4Search________________________end");
	}
	//취약점별 현황, 조회
	public function goG5Search(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("TESTCOPY2Service-goG5Search________________________start");
		//그리드 서버 조회 
		//GRID_SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 0; // KEY 컬럼, UUID_SEQ

		//조회
		//V_GRPNM : 취약점별 현황
		$GRID["SQL"]["R"] = $this->DAO->sRule($REQ); //SEARCH, 조회,RULESET
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
		alog("TESTCOPY2Service-goG5Search________________________end");
	}
}
                                                             
?>
