<?php
//SVC
 
//include_once('ValidmngInterface.php');
include_once('validmngDao.php');
//class ValidmngService implements ValidmngInterface
class validmngService 
{
	private $DAO;
	private $DB;
	//생성자
	function __construct(){
		alog("ValidmngService-__construct");

		$this->DAO = new validmngDao();
	    //$this->DB = db_s_open();
		$this->DB["CG"] = db_obj_open(getDbSvrInfo("CG"));
	}
	//파괴자
	function __destruct(){
		alog("ValidmngService-__destruct");

		unset($this->DAO);
		if($this->DB["CG"])$this->DB["CG"]->close();
		unset($this->DB);
	}
	function __toString(){
		alog("ValidmngService-__toString");
	}
	//조회조건, 조회(전체)
	public function goC1Searchall(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("VALIDMNGService-goC1Searchall________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("VALIDMNGService-goC1Searchall________________________end");
	}
	//조회조건, 저장
	public function goC1Save(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("VALIDMNGService-goC1Save________________________start");
		//GRID_SAVE____________________________start
		$grpId="G2";
		$GRID["XML"]=$REQ[$grpId."-XML"];
		$GRID["COLORD"] = "ROWCHK,VALIDSEQ,PJTSEQ,DATATYPE,VALIDID,VALIDNM,VALIDORD,VALIDTYPE,INVALIDMSG,MATSTR,ADDDT,MODDT"; //그리드 컬럼순서(Hidden컬럼포함)
	//암호화컬럼
		$GRID["COLCRYPT"] = array();	
		$GRID["KEYCOLID"] = "VALIDSEQ";  //KEY컬럼 COLID, 1
		$GRID["SEQYN"] = "Y";  //시퀀스 컬럼 유무
		//저장
		$GRID["SQL"]["U"] = $this->DAO->updValidG($REQ); // SAVE, 저장, 목록수정
		$GRID["SQL"]["C"] = $this->DAO->insValidG($REQ); // SAVE, 저장, 목록추가
		$tmpVal = makeGridSaveJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G2]",microtime(true)));

		$tmpVal->GRPID = $grpId;
		array_push($rtnVal->GRP_DATA, $tmpVal);
		//GRID_SAVE____________________________end


		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("VALIDMNGService-goC1Save________________________end");
	}
	//목록, 조회
	public function goG2Search(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("VALIDMNGService-goG2Search________________________start");
		//그리드 서버 조회 
		//GRID_SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 1; // KEY 컬럼, VALIDSEQ

		//조회
		//V_GRPNM : 목록
		$GRID["SQL"]["R"] = $this->DAO->selValidG($REQ); //SEARCH, 조회,목록조회
	//암호화컬럼
		$GRID["COLCRYPT"] = array();
		$rtnVal = makeGridSearchJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G2]",microtime(true)));
		//GRID_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("VALIDMNGService-goG2Search________________________end");
	}
	//목록, 저장
	public function goG2Save(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("VALIDMNGService-goG2Save________________________start");
		//GRID_SAVE____________________________start
		$grpId="G2";
		$GRID["XML"]=$REQ[$grpId."-XML"];
		$GRID["COLORD"] = "ROWCHK,VALIDSEQ,PJTSEQ,DATATYPE,VALIDID,VALIDNM,VALIDORD,VALIDTYPE,INVALIDMSG,MATSTR,ADDDT,MODDT"; //그리드 컬럼순서(Hidden컬럼포함)
	//암호화컬럼
		$GRID["COLCRYPT"] = array();	
		$GRID["KEYCOLID"] = "VALIDSEQ";  //KEY컬럼 COLID, 1
		$GRID["SEQYN"] = "Y";  //시퀀스 컬럼 유무
		//저장
		$GRID["SQL"]["U"] = $this->DAO->updValidG($REQ); // SAVE, 저장, 목록수정
		$GRID["SQL"]["C"] = $this->DAO->insValidG($REQ); // SAVE, 저장, 목록추가
		$GRID["SQL"]["D"] = $this->DAO->delValidG($REQ); // SAVE, 저장, 목록삭제
		$tmpVal = makeGridSaveJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G2]",microtime(true)));

		$tmpVal->GRPID = $grpId;
		array_push($rtnVal->GRP_DATA, $tmpVal);
		//GRID_SAVE____________________________end


		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("VALIDMNGService-goG2Save________________________end");
	}
	//목록, 엑셀다운로드
	public function goG2Excel(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("VALIDMNGService-goG2Excel________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("VALIDMNGService-goG2Excel________________________end");
	}
	//목록, 선택저장
	public function goG2Chksave(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("VALIDMNGService-goG2Chksave________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("VALIDMNGService-goG2Chksave________________________end");
	}
	//상세, 조회
	public function goF3Search(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("VALIDMNGService-goF3Search________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("VALIDMNGService-goF3Search________________________end");
	}
	//상세, 저장
	public function goF3Save(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("VALIDMNGService-goF3Save________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("VALIDMNGService-goF3Save________________________end");
	}
	//상세, 삭제
	public function goF3Delete(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("VALIDMNGService-goF3Delete________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("VALIDMNGService-goF3Delete________________________end");
	}
}
                                                             
?>
