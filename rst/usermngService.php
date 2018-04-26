<?php
//SVC
 
//include_once('UsermngInterface.php');
include_once('usermngDao.php');
//class UsermngService implements UsermngInterface
class usermngService 
{
	private $DAO;
	private $DB;
	//생성자
	function __construct(){
		alog("UsermngService-__construct");

		$this->DAO = new usermngDao();
	    //$this->DB = db_s_open();
		$this->DB["CG"] = db_obj_open(getDbSvrInfo("CG"));
	}
	//파괴자
	function __destruct(){
		alog("UsermngService-__destruct");

		unset($this->DAO);
		if($this->DB["CG"])$this->DB["CG"]->close();
		unset($this->DB);
	}
	function __toString(){
		alog("UsermngService-__toString");
	}
	//USR, 비번변경
	public function goG2Userdef(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("USERMNGService-goG2Userdef________________________start");
		//GRID_SAVE____________________________start
		$grpId="G2";
		$GRID["XML"]=$REQ[$grpId."-XML"];
		$GRID["COLORD"] = "USERSEQ,EMAIL,PASSWD,EMAILVALIDYN,LASTPWCHGDT,PWFAILCNT,LOCKYN,FREEZEDT,LOCKDT,SERVERSEQ,ADDDT,MODDT"; //그리드 컬럼순서(Hidden컬럼포함)
	//암호화컬럼
		$GRID["COLCRYPT"] = array("PASSWD"=>"HASH");	
		$GRID["KEYCOLID"] = "USERSEQ";  //KEY컬럼 COLID, 0
		$GRID["SEQYN"] = "Y";  //시퀀스 컬럼 유무
		//비번변경
		$GRID["SQL"]["U"] = $this->DAO->chgUserPwG($REQ); // USERDEF, 비번변경, 사용자비번변경
		$tmpVal = makeGridSaveJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G2]",microtime(true)));

		$tmpVal->GRPID = $grpId;
		array_push($rtnVal->GRP_DATA, $tmpVal);
		//GRID_SAVE____________________________end


		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("USERMNGService-goG2Userdef________________________end");
	}
	//USR, 조회
	public function goG2Search(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("USERMNGService-goG2Search________________________start");
		//그리드 서버 조회 
		//GRID_SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 0; // KEY 컬럼, USERSEQ

		//조회
		//V_GRPNM : USR
		$GRID["SQL"]["R"] = $this->DAO->selUserG($REQ); //SEARCH, 조회,사용자목록
	//암호화컬럼
		$GRID["COLCRYPT"] = array("PASSWD"=>"HASH");
		$rtnVal = makeGridSearchJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G2]",microtime(true)));
		//GRID_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("USERMNGService-goG2Search________________________end");
	}
	//USR, S
	public function goG2Save(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("USERMNGService-goG2Save________________________start");
		//GRID_SAVE____________________________start
		$grpId="G2";
		$GRID["XML"]=$REQ[$grpId."-XML"];
		$GRID["COLORD"] = "USERSEQ,EMAIL,PASSWD,EMAILVALIDYN,LASTPWCHGDT,PWFAILCNT,LOCKYN,FREEZEDT,LOCKDT,SERVERSEQ,ADDDT,MODDT"; //그리드 컬럼순서(Hidden컬럼포함)
	//암호화컬럼
		$GRID["COLCRYPT"] = array("PASSWD"=>"HASH");	
		$GRID["KEYCOLID"] = "USERSEQ";  //KEY컬럼 COLID, 0
		$GRID["SEQYN"] = "Y";  //시퀀스 컬럼 유무
		//S
		$GRID["SQL"]["U"] = $this->DAO->updUserG($REQ); // SAVE, S, 사용자수정
		$tmpVal = makeGridSaveJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G2]",microtime(true)));

		$tmpVal->GRPID = $grpId;
		array_push($rtnVal->GRP_DATA, $tmpVal);
		//GRID_SAVE____________________________end


		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("USERMNGService-goG2Save________________________end");
	}
	//USR, E
	public function goG2Excel(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("USERMNGService-goG2Excel________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("USERMNGService-goG2Excel________________________end");
	}
	//USR, 선택저장
	public function goG2Chksave(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("USERMNGService-goG2Chksave________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("USERMNGService-goG2Chksave________________________end");
	}
	//PJT, 조회
	public function goG3Search(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("USERMNGService-goG3Search________________________start");
		//그리드 서버 조회 
		//GRID_SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 1; // KEY 컬럼, PJTSEQ

		//조회
		//V_GRPNM : PJT
		$GRID["SQL"]["R"] = $this->DAO->selPjtG($REQ); //SEARCH, 조회,프로젝목록
	//암호화컬럼
		$GRID["COLCRYPT"] = array();
		$rtnVal = makeGridSearchJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G3]",microtime(true)));
		//GRID_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("USERMNGService-goG3Search________________________end");
	}
	//PJT, S
	public function goG3Save(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("USERMNGService-goG3Save________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("USERMNGService-goG3Save________________________end");
	}
	//PJT, E
	public function goG3Excel(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("USERMNGService-goG3Excel________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("USERMNGService-goG3Excel________________________end");
	}
	//SVR, 사용자정의
	public function goG4Userdef(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("USERMNGService-goG4Userdef________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("USERMNGService-goG4Userdef________________________end");
	}
	//SVR, 조회
	public function goG4Search(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("USERMNGService-goG4Search________________________start");
		//그리드 서버 조회 
		//GRID_SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 0; // KEY 컬럼, SVRSEQ

		//조회
		//V_GRPNM : SVR
		$GRID["SQL"]["R"] = $this->DAO->selSvrG($REQ); //SEARCH, 조회,서버록록
	//암호화컬럼
		$GRID["COLCRYPT"] = array("DBUSRPW"=>"CRYPT");
		$rtnVal = makeGridSearchJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G4]",microtime(true)));
		//GRID_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("USERMNGService-goG4Search________________________end");
	}
	//SVR, S
	public function goG4Save(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("USERMNGService-goG4Save________________________start");
		//GRID_SAVE____________________________start
		$grpId="G4";
		$GRID["XML"]=$REQ[$grpId."-XML"];
		$GRID["COLORD"] = "SVRSEQ,SVRID,SVRNM,PJTSEQ,USERSEQ,DBHOST,DBPORT,DBNAME,DBUSRID,DBUSRPW,USEYN,ADDDT,MODDT"; //그리드 컬럼순서(Hidden컬럼포함)
	//암호화컬럼
		$GRID["COLCRYPT"] = array("DBUSRPW"=>"CRYPT");	
		$GRID["KEYCOLID"] = "SVRSEQ";  //KEY컬럼 COLID, 0
		$GRID["SEQYN"] = "Y";  //시퀀스 컬럼 유무
		//S
		$GRID["SQL"]["U"] = $this->DAO->updSvrG($REQ); // SAVE, S, 서버변경
		$GRID["SQL"]["C"] = $this->DAO->insSvrG($REQ); // SAVE, S, 서버추가
		$tmpVal = makeGridSaveJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G4]",microtime(true)));

		$tmpVal->GRPID = $grpId;
		array_push($rtnVal->GRP_DATA, $tmpVal);
		//GRID_SAVE____________________________end


		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("USERMNGService-goG4Save________________________end");
	}
	//SVR, E
	public function goG4Excel(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("USERMNGService-goG4Excel________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("USERMNGService-goG4Excel________________________end");
	}
	//SVR, 선택저장
	public function goG4Chksave(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("USERMNGService-goG4Chksave________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("USERMNGService-goG4Chksave________________________end");
	}
}
                                                             
?>
