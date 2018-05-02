<?php
//SVC
 
//include_once('IntroadminInterface.php');
include_once('introadminDao.php');
//class IntroadminService implements IntroadminInterface
class introadminService 
{
	private $DAO;
	private $DB;
	//생성자
	function __construct(){
		alog("IntroadminService-__construct");

		$this->DAO = new introadminDao();
	    //$this->DB = db_s_open();
		$this->DB["DATING"] = db_obj_open(getDbSvrInfo("DATING"));
	}
	//파괴자
	function __destruct(){
		alog("IntroadminService-__destruct");

		unset($this->DAO);
		if($this->DB["DATING"])$this->DB["DATING"]->close();
		unset($this->DB);
	}
	function __toString(){
		alog("IntroadminService-__toString");
	}
	//조건, 조회(전체)
	public function goG1Searchall(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("INTROADMINService-goG1Searchall________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("INTROADMINService-goG1Searchall________________________end");
	}
	//조건, 저장
	public function goG1Save(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("INTROADMINService-goG1Save________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("INTROADMINService-goG1Save________________________end");
	}
	//월점검, 조회
	public function goF9Search(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("INTROADMINService-goF9Search________________________start");
//FORMVIEW SEARCH
	//암호화컬럼
		$FORMVIEW["COLCRYPT"] = array();
// SQL LOOP
		// MONTH
		$FORMVIEW["SQL"]["R"] = $this->DAO->sMonthG($REQ); 
		$rtnVal = makeFormviewSearchJson($FORMVIEW,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME F9]",microtime(true)));
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("INTROADMINService-goF9Search________________________end");
	}
	//월점검, 저장
	public function goF9Save(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("INTROADMINService-goF9Save________________________start");
		//FORMVIEW SAVE
		$grpId="F9";
		$FORMVIEW["FNCTYPE"] = $REQ[$grpId . "-CTLCUD"]; 
		$GRID["KEYCOLID"] = "";  //KEY컬럼 COLID, -1
		$GRID["SEQYN"] = "N";  //시퀀스 컬럼 유무
	//암호화컬럼
		$FORMVIEW["COLCRYPT"] = array();	
			//CTLCUD 명령어에 따른 분개 처리
		if( $FORMVIEW["FNCTYPE"] == "C" || $FORMVIEW["FNCTYPE"] == "U"){ 
			switch($FORMVIEW["FNCTYPE"]){
				case "C":////MONTH
					//추가
					$FORMVIEW["SQL"][$FORMVIEW["FNCTYPE"]] = $this->DAO->iMonthG($REQ); 
					break;
				default:
					//처리 결과 리턴
					$rtnVal->RTN_CD = "500";
					$rtnVal->ERR_CD = "593";
					echo json_encode($rtnVal);
					return;	
			}

			$tmpVal = makeFormviewSaveJson($FORMVIEW,$this->DB);
			array_push($_RTIME,array("[TIME 50.DB_TIME F9]",microtime(true)));

			$al->GRPID = $grpId;
			array_push($rtnVal->GRP_DATA, $tmpVal);

			//$rtnVal = makeFormviewSaveJson($FORMVIEW,$this->DB);

		}//C,U 일때만 DB처리
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("INTROADMINService-goF9Save________________________end");
	}
	//월점검, 조회
	public function goG8Search(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("INTROADMINService-goG8Search________________________start");
		//그리드 서버 조회 
		//GRID_SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 0; // KEY 컬럼, CFM_SEQ

		//조회
		//V_GRPNM : 월점검
		$GRID["SQL"]["R"] = $this->DAO->s2MonthG($REQ); //SEARCH, 조회,MONTH
	//암호화컬럼
		$GRID["COLCRYPT"] = array();
		$rtnVal = makeGridSearchJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G8]",microtime(true)));
		//GRID_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("INTROADMINService-goG8Search________________________end");
	}
	//월점검, 저장
	public function goG8Save(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("INTROADMINService-goG8Save________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("INTROADMINService-goG8Save________________________end");
	}
	//로그인성공, 조회
	public function goG2Search(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("INTROADMINService-goG2Search________________________start");
		//그리드 서버 조회 
		//GRID_SEARCH____________________________start
		$GRID["KEYCOLIDX"] = -1; // KEY 컬럼, 

		//조회
		//V_GRPNM : 로그인성공
		$GRID["SQL"]["R"] = $this->DAO->sLgnSuccG($REQ); //SEARCH, 조회,LOGIN
	//암호화컬럼
		$GRID["COLCRYPT"] = array();
		$rtnVal = makeGridSearchJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G2]",microtime(true)));
		//GRID_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("INTROADMINService-goG2Search________________________end");
	}
	//로그인성공, 엑셀다운로드
	public function goG2Excel(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("INTROADMINService-goG2Excel________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("INTROADMINService-goG2Excel________________________end");
	}
	//잠금횟수, 조회
	public function goG3Search(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("INTROADMINService-goG3Search________________________start");
		//그리드 서버 조회 
		//GRID_SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 0; // KEY 컬럼, USR_ID

		//조회
		//V_GRPNM : 잠금횟수
		$GRID["SQL"]["R"] = $this->DAO->sLgnLockG($REQ); //SEARCH, 조회,LOGIN
	//암호화컬럼
		$GRID["COLCRYPT"] = array();
		$rtnVal = makeGridSearchJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G3]",microtime(true)));
		//GRID_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("INTROADMINService-goG3Search________________________end");
	}
	//잠금횟수, 엑셀다운로드
	public function goG3Excel(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("INTROADMINService-goG3Excel________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("INTROADMINService-goG3Excel________________________end");
	}
	//로그인실패, 조회
	public function goG4Search(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("INTROADMINService-goG4Search________________________start");
		//그리드 서버 조회 
		//GRID_SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 0; // KEY 컬럼, USR_ID

		//조회
		//V_GRPNM : 로그인실패
		$GRID["SQL"]["R"] = $this->DAO->sLgnFailG($REQ); //SEARCH, 조회,LOGIN
	//암호화컬럼
		$GRID["COLCRYPT"] = array();
		$rtnVal = makeGridSearchJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G4]",microtime(true)));
		//GRID_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("INTROADMINService-goG4Search________________________end");
	}
	//로그인실패, 엑셀다운로드
	public function goG4Excel(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("INTROADMINService-goG4Excel________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("INTROADMINService-goG4Excel________________________end");
	}
	//개인정보접근, 조회
	public function goG5Search(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("INTROADMINService-goG5Search________________________start");
		//그리드 서버 조회 
		//GRID_SEARCH____________________________start
		$GRID["KEYCOLIDX"] = -1; // KEY 컬럼, 

		//조회
		//V_GRPNM : 개인정보접근
		$GRID["SQL"]["R"] = $this->DAO->sAuthPiG($REQ); //SEARCH, 조회,AUTH
	//암호화컬럼
		$GRID["COLCRYPT"] = array();
		$rtnVal = makeGridSearchJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G5]",microtime(true)));
		//GRID_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("INTROADMINService-goG5Search________________________end");
	}
	//개인정보접근, 엑셀다운로드
	public function goG5Excel(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("INTROADMINService-goG5Excel________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("INTROADMINService-goG5Excel________________________end");
	}
	//로그인실패IP, 조회
	public function goG6Search(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("INTROADMINService-goG6Search________________________start");
		//그리드 서버 조회 
		//GRID_SEARCH____________________________start
		$GRID["KEYCOLIDX"] = -1; // KEY 컬럼, 

		//조회
		//V_GRPNM : 로그인실패IP
		$GRID["SQL"]["R"] = $this->DAO->sLgnIpG($REQ); //SEARCH, 조회,LOGIN
	//암호화컬럼
		$GRID["COLCRYPT"] = array();
		$rtnVal = makeGridSearchJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G6]",microtime(true)));
		//GRID_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("INTROADMINService-goG6Search________________________end");
	}
	//로그인실패IP, 엑셀다운로드
	public function goG6Excel(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("INTROADMINService-goG6Excel________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("INTROADMINService-goG6Excel________________________end");
	}
	//비인가메뉴접근, 조회
	public function goG7Search(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("INTROADMINService-goG7Search________________________start");
		//그리드 서버 조회 
		//GRID_SEARCH____________________________start
		$GRID["KEYCOLIDX"] = -1; // KEY 컬럼, 

		//조회
		//V_GRPNM : 비인가메뉴접근
		$GRID["SQL"]["R"] = $this->DAO->sAuthNoG($REQ); //SEARCH, 조회,AUTH
	//암호화컬럼
		$GRID["COLCRYPT"] = array();
		$rtnVal = makeGridSearchJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G7]",microtime(true)));
		//GRID_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("INTROADMINService-goG7Search________________________end");
	}
	//비인가메뉴접근, 엑셀다운로드
	public function goG7Excel(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("INTROADMINService-goG7Excel________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("INTROADMINService-goG7Excel________________________end");
	}
}
                                                             
?>
