<?php
//SVC
 
//include_once('FindfooterInterface.php');
include_once('cg_pgminfo_dao.php');
//class FindfooterService implements FindfooterInterface
class cg_pgminfo_svc 
{
	private $DAO;
	private $DB;
	//생성자
	function __construct(){
		alog("cg_pgminfo_svc-__construct");

		$this->DAO = new cg_pgminfo_dao();
	    //$this->DB = db_s_open();
		$this->DB["CG"] = db_obj_open(getDbSvrInfo("CG"));
	}
	//파괴자
	function __destruct(){
		alog("cg_pgminfo_svc-__destruct");

		unset($this->DAO);
		if($this->DB["CG"])$this->DB["CG"]->close();
		unset($this->DB);
	}
	function __toString(){
		alog("cg_pgminfo_svc-__toString");
	}



	public function goDdSearch(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("cg_pgminfo_svc-goDdSearch________________________start");
		//CHARTBAR SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 2; // KEY 컬럼, 

		//조회
		//V_GRPNM : 팀별 현황 (보안취약점 갯수)
		$GRID["SQL"]["R"] = $this->DAO->ddSearch($REQ); //SEARCH, 조회,TEAM
		//암호화컬럼
		$GRID["COLCRYPT"] = array();
		$rtnVal = makeGridSearchJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G2]",microtime(true)));
		//CHARTBAR_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("cg_pgminfo_svc-goDdSearch________________________end");
	}	
	public function goIocdSearch(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("cg_pgminfo_svc-goIocdSearch________________________start");
		//CHARTBAR SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 2; // KEY 컬럼, 

		//조회
		//V_GRPNM : 팀별 현황 (보안취약점 갯수)
		$GRID["SQL"]["R"] = $this->DAO->iocdSearch($REQ); //SEARCH, 조회,TEAM
		//암호화컬럼
		$GRID["COLCRYPT"] = array();
		$rtnVal = makeGridSearchJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G2]",microtime(true)));
		//CHARTBAR_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("cg_pgminfo_svc-goIocdSearch________________________end");
	}	

	public function goFnccdSearch(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("cg_pgminfo_svc-goFnccdSearch________________________start");
		//CHARTBAR SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 2; // KEY 컬럼, 

		//조회
		//V_GRPNM : 팀별 현황 (보안취약점 갯수)
		$GRID["SQL"]["R"] = $this->DAO->fnccdSearch($REQ); //SEARCH, 조회,TEAM
		//암호화컬럼
		$GRID["COLCRYPT"] = array();
		$rtnVal = makeGridSearchJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G2]",microtime(true)));
		//CHARTBAR_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("cg_pgminfo_svc-goFnccdSearch________________________end");
	}	

	public function goLayoutdSearch(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("cg_pgminfo_svc-goLayoutdSearch________________________start");
		//CHARTBAR SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 2; // KEY 컬럼, 

		//조회
		//V_GRPNM : 팀별 현황 (보안취약점 갯수)
		$GRID["SQL"]["R"] = $this->DAO->layoutdSearch($REQ); //SEARCH, 조회,TEAM
		//암호화컬럼
		$GRID["COLCRYPT"] = array();
		$rtnVal = makeGridSearchJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G2]",microtime(true)));
		//CHARTBAR_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("cg_pgminfo_svc-goLayoutdSearch________________________end");
	}	

	public function goLayoutSearch(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("cg_pgminfo_svc-goLayoutSearch________________________start");
		//CHARTBAR SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 2; // KEY 컬럼, 

		//조회
		//V_GRPNM : 팀별 현황 (보안취약점 갯수)
		$GRID["SQL"]["R"] = $this->DAO->layoutSearch($REQ); //SEARCH, 조회,TEAM
		//암호화컬럼
		$GRID["COLCRYPT"] = array();
		$rtnVal = makeGridSearchJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G2]",microtime(true)));
		//CHARTBAR_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("cg_pgminfo_svc-goLayoutSearch________________________end");
	}	



	public function goPgmSearch(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("cg_pgminfo_svc-goSqldSearch________________________start");
		//CHARTBAR SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 2; // KEY 컬럼, 

		//조회
		//V_GRPNM : 팀별 현황 (보안취약점 갯수)
		$GRID["SQL"]["R"] = $this->DAO->pgmSearch($REQ); //SEARCH, 조회,TEAM
		//암호화컬럼
		$GRID["COLCRYPT"] = array();
		$rtnVal = makeGridSearchJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G2]",microtime(true)));
		//CHARTBAR_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("cg_pgminfo_svc-goSqldSearch________________________end");
	}	

	public function goSqldSearch(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("cg_pgminfo_svc-goSqldSearch________________________start");
		//CHARTBAR SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 0; // KEY 컬럼, 

		//조회
		//V_GRPNM : 팀별 현황 (보안취약점 갯수)
		$GRID["SQL"]["R"] = $this->DAO->sqldSearch($REQ); //SEARCH, 조회,TEAM
		//암호화컬럼
		$GRID["COLCRYPT"] = array();
		$rtnVal = makeGridSearchJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G2]",microtime(true)));
		//CHARTBAR_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("cg_pgminfo_svc-goSqldSearch________________________end");
	}
	

	public function goSqlrSearch(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("cg_pgminfo_svc-goSqlrSearch________________________start");
		//CHARTBAR SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 0; // KEY 컬럼, 

		//조회
		//V_GRPNM : 팀별 현황 (보안취약점 갯수)
		$GRID["SQL"]["R"] = $this->DAO->sqlrSearch($REQ); //SEARCH, 조회,TEAM
		//암호화컬럼
		$GRID["COLCRYPT"] = array();
		$rtnVal = makeGridSearchJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G2]",microtime(true)));
		//CHARTBAR_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("cg_pgminfo_svc-goSqlrSearch________________________end");
	}



	public function goSvcSearch(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("cg_pgminfo_svc-goSvcSearch________________________start");
		//CHARTBAR SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 0; // KEY 컬럼, 

		//조회
		//V_GRPNM : 팀별 현황 (보안취약점 갯수)
		$GRID["SQL"]["R"] = $this->DAO->svcSearch($REQ); //SEARCH, 조회,TEAM
		//암호화컬럼
		$GRID["COLCRYPT"] = array();
		$rtnVal = makeGridSearchJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G2]",microtime(true)));
		//CHARTBAR_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("cg_pgminfo_svc-goSvcSearch________________________end");
	}


	public function goInheritSearch(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("cg_pgminfo_svc-goInheritSearch________________________start");
		//CHARTBAR SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 0; // KEY 컬럼, 

		//조회
		//V_GRPNM : 팀별 현황 (보안취약점 갯수)
		$GRID["SQL"]["R"] = $this->DAO->inheritSearch($REQ); //SEARCH, 조회,TEAM
		//암호화컬럼
		$GRID["COLCRYPT"] = array();
		$rtnVal = makeGridSearchJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G2]",microtime(true)));
		//CHARTBAR_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("cg_pgminfo_svc-goInheritSearch________________________end");
	}



	public function goIoSearch(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("cg_pgminfo_svc-goIoSearch________________________start");
		//CHARTBAR SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 3; // KEY 컬럼, 

		//조회
		//V_GRPNM : 팀별 현황 (보안취약점 갯수)
		$GRID["SQL"]["R"] = $this->DAO->ioSearch($REQ); //SEARCH, 조회,TEAM
		//암호화컬럼
		$GRID["COLCRYPT"] = array();
		$rtnVal = makeGridSearchJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G2]",microtime(true)));
		//CHARTBAR_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("cg_pgminfo_svc-goIoSearch________________________end");
	}


	public function goFncSearch(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("cg_pgminfo_svc-goFncSearch________________________start");
		//CHARTBAR SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 3; // KEY 컬럼, 

		//조회
		//V_GRPNM : 팀별 현황 (보안취약점 갯수)
		$GRID["SQL"]["R"] = $this->DAO->fncSearch($REQ); //SEARCH, 조회,TEAM
		//암호화컬럼
		$GRID["COLCRYPT"] = array();
		$rtnVal = makeGridSearchJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G2]",microtime(true)));
		//CHARTBAR_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("cg_pgminfo_svc-goFncSearch________________________end");
	}

	public function goGrpSearch(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("cg_pgminfo_svc-goGrpSearch________________________start");
		//CHARTBAR SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 2; // KEY 컬럼, 

		//조회
		//V_GRPNM : 팀별 현황 (보안취약점 갯수)
		$GRID["SQL"]["R"] = $this->DAO->grpSearch($REQ); //SEARCH, 조회,TEAM
		//암호화컬럼
		$GRID["COLCRYPT"] = array();
		$rtnVal = makeGridSearchJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G2]",microtime(true)));
		//CHARTBAR_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("cg_pgminfo_svc-goGrpSearch________________________end");
	}
	
	public function goSqlSearch(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("cg_pgminfo_svc-goSqlSearch________________________start");
		//CHARTBAR SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 2; // KEY 컬럼, 

		//조회
		//V_GRPNM : 팀별 현황 (보안취약점 갯수)
		$GRID["SQL"]["R"] = $this->DAO->sqlSearch($REQ); //SEARCH, 조회,TEAM
		//암호화컬럼
		$GRID["COLCRYPT"] = array();
		$rtnVal = makeGridSearchJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G2]",microtime(true)));
		//CHARTBAR_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("cg_pgminfo_svc-goSqlSearch________________________end");
	}
	
}
                                                             
?>
