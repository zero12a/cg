<?php
//SVC
 
//include_once('LoginInterface.php');
include_once('loginDao.php');
//class LoginService implements LoginInterface
class loginService 
{
	private $DAO;
	private $DB;
	//생성자
	function __construct(){
		alog("LoginService-__construct");

		$this->DAO = new loginDao();
	    //$this->DB = db_s_open();
		$this->DB["DATING"] = db_obj_open(getDbSvrInfo("DATING"));
	}
	//파괴자
	function __destruct(){
		alog("LoginService-__destruct");

		unset($this->DAO);
		if($this->DB["DATING"])$this->DB["DATING"]->close();
		unset($this->DB);
	}
	function __toString(){
		alog("LoginService-__toString");
	}
	//입력폼, 조회(전체)
	public function goG1Searchall(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("LOGINService-goG1Searchall________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("LOGINService-goG1Searchall________________________end");
	}
	//입력폼, 저장
	public function goG1Save(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("LOGINService-goG1Save________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("LOGINService-goG1Save________________________end");
	}
	//조회결과, 조회
	public function goG2Search(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("LOGINService-goG2Search________________________start");
//FORMVIEW SEARCH
	//암호화컬럼
		$FORMVIEW["COLCRYPT"] = array("USR_PWD"=>"HASH");
// SQL LOOP
		// getUsr
		$FORMVIEW["SQL"]["R"] = $this->DAO->getUsr($REQ); 
		$rtnVal = makeFormviewSearchJson($FORMVIEW,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G2]",microtime(true)));
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("LOGINService-goG2Search________________________end");
	}
	//조회결과, 비번변경
	public function goG2Save(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("LOGINService-goG2Save________________________start");
		//FORMVIEW SAVE
		$grpId="G2";
		$FORMVIEW["FNCTYPE"] = $REQ[$grpId . "-CTLCUD"]; 
		$GRID["KEYCOLID"] = "";  //KEY컬럼 COLID, -1
		$GRID["SEQYN"] = "N";  //시퀀스 컬럼 유무
	//암호화컬럼
		$FORMVIEW["COLCRYPT"] = array("USR_PWD"=>"HASH");	
			//CTLCUD 명령어에 따른 분개 처리
		if( $FORMVIEW["FNCTYPE"] == "C" || $FORMVIEW["FNCTYPE"] == "U"){ 
			switch($FORMVIEW["FNCTYPE"]){
				case "U":////uprUsr
					//추가
					$FORMVIEW["SQL"][$FORMVIEW["FNCTYPE"]] = $this->DAO->updUsr($REQ); 
					break;
				default:
					//처리 결과 리턴
					$rtnVal->RTN_CD = "500";
					$rtnVal->ERR_CD = "593";
					echo json_encode($rtnVal);
					return;	
			}

			$tmpVal = makeFormviewSaveJson($FORMVIEW,$this->DB);
			array_push($_RTIME,array("[TIME 50.DB_TIME G2]",microtime(true)));

			$al->GRPID = $grpId;
			array_push($rtnVal->GRP_DATA, $tmpVal);

			//$rtnVal = makeFormviewSaveJson($FORMVIEW,$this->DB);

		}//C,U 일때만 DB처리
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("LOGINService-goG2Save________________________end");
	}
}
                                                             
?>
