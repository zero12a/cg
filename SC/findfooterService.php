<?php
//SVC
 
//include_once('FindfooterInterface.php');
include_once('findfooterDao.php');
//class FindfooterService implements FindfooterInterface
class findfooterService 
{
	private $DAO;
	private $DB;
	//생성자
	function __construct(){
		alog("FindfooterService-__construct");

		$this->DAO = new findfooterDao();
	    //$this->DB = db_s_open();
		$this->DB["SC"] = db_obj_open(getDbSvrInfo("SC"));
	}
	//파괴자
	function __destruct(){
		alog("FindfooterService-__destruct");

		unset($this->DAO);
		if($this->DB["SC"])$this->DB["SC"]->close();
		unset($this->DB);
	}
	function __toString(){
		alog("FindfooterService-__toString");
	}
	//, 조회(전체)
	public function goG1Searchall(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("findFooterService-goG1Searchall________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("findFooterService-goG1Searchall________________________end");
	}
	//팀별 현황 (보안취약점 갯수), 조회
	public function goG2Search(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("findFooterService-goG2Search________________________start");
		//CHARTBAR2Y SEARCH____________________________start
		$GRID["KEYCOLIDX"] = -1; // KEY 컬럼, 

		//조회
		//V_GRPNM : 팀별 현황 (보안취약점 갯수)
		$GRID["SQL"]["R"] = $this->DAO->sTeamChart($REQ); //SEARCH, 조회,TEAM
		//암호화컬럼
		$GRID["COLCRYPT"] = array();
		$rtnVal = makeGridSearchJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G2]",microtime(true)));
		//CHARTBAR2Y_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("findFooterService-goG2Search________________________end");
	}
	//팀별 현황 (보안취약점 갯수), 조회
	public function goG3Search(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("findFooterService-goG3Search________________________start");
		//그리드 서버 조회 
		//GRID_SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 0; // KEY 컬럼, UUID_SEQ

		//조회
		//V_GRPNM : 팀별 현황 (보안취약점 갯수)
		$GRID["SQL"]["R"] = $this->DAO->sTeam($REQ); //SEARCH, 조회,TEAM
	//암호화컬럼
		$GRID["COLCRYPT"] = array();
		$rtnVal = makeGridSearchJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G3]",microtime(true)));
		//GRID_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("findFooterService-goG3Search________________________end");
	}
	//시스템별 현황, 조회
	public function goG4Search(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("findFooterService-goG4Search________________________start");
		//그리드 서버 조회 
		//GRID_SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 0; // KEY 컬럼, UUID_SEQ

		//조회
		//V_GRPNM : 시스템별 현황
		$GRID["SQL"]["R"] = $this->DAO->sSys($REQ); //SEARCH, 조회,SYS
	//암호화컬럼
		$GRID["COLCRYPT"] = array();
		$rtnVal = makeGridSearchJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G4]",microtime(true)));
		//GRID_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("findFooterService-goG4Search________________________end");
	}
	//취약점별 현황, 조회
	public function goG5Search(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("findFooterService-goG5Search________________________start");
		//그리드 서버 조회 
		//GRID_SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 0; // KEY 컬럼, UUID_SEQ

		//조회
		//V_GRPNM : 취약점별 현황
		$GRID["SQL"]["R"] = $this->DAO->sRule($REQ); //SEARCH, 조회,RULESET
	//암호화컬럼
		$GRID["COLCRYPT"] = array();
		$rtnVal = makeGridSearchJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G5]",microtime(true)));
		//GRID_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("findFooterService-goG5Search________________________end");
	}
}
                                                             
?>