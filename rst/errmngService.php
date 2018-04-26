<?php
//SVC
 
//include_once('ErrmngInterface.php');
include_once('errmngDao.php');
//class ErrmngService implements ErrmngInterface
class errmngService 
{
	private $DAO;
	private $DB;

	function __construct(){
		alog("ErrmngService-__construct");

		$this->DAO = new errmngDao();
	    $this->DB = db_m_open();
	}
	function __destruct(){
		alog("ErrmngService-__destruct");

		unset($this->DAO);
		if($this->DB)$this->DB->close();
		unset($this->DB);
	}
	function __toString(){
		alog("ErrmngService-__toString");
	}
	//, 저장
	public function goG1Save(){
		global $REQ;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("ERRMNGService-goG1Save________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);		alog("ERRMNGService-goG1Save________________________end");
	}
	//에러, 사용자정의
	public function goG3Userdef(){
		global $REQ;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("ERRMNGService-goG3Userdef________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);		alog("ERRMNGService-goG3Userdef________________________end");
	}
	//에러, 조회
	public function goG3Search(){
		global $REQ;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("ERRMNGService-goG3Search________________________start");
		//그리드 서버 조회 
		//GRID_SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 0; // KEY 컬럼, ERRLOGSEQ

		//조회
		//V_GRPNM : 에러
		$GRID["SQL"]["R"] = $this->DAO->rErrList($REQ); //SEARCH, 조회,에러목록
$rtnVal = makeGridSearchJson($GRID,$this->DB);
		//GRID_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);		alog("ERRMNGService-goG3Search________________________end");
	}
	//에러, 저장
	public function goG3Save(){
		global $REQ;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("ERRMNGService-goG3Save________________________start");
		//GRID_SAVE____________________________start
		$grpId = "";
		$GRID["XML"] = $REQ[$grpId . "_XML"];
		$GRID["COLORD"] = "ERRLOGSEQ,SESSIONID,REQID,ERRNO,ERRCD,ERRSTR,ERRFILE,ERRLINE,ERRCONTEXT,ADDDT,MODDT"; //그리드 컬럼순서(Hidden컬럼포함)
		$GRID["KEYCOLID"] = "ERRLOGSEQ";  //KEY컬럼 COLID, 0
		$GRID["SEQYN"] = "Y";  //시퀀스 컬럼 유무
		//저장
		//V_GRPNM : 에러
		$GRID["SQL"]["D"] = $this->DAO->dErr(); // SAVE, 저장, 에러삭제
		//V_GRPNM : 에러
		$GRID["SQL"]["C"] = $this->DAO->cErr(); // SAVE, 저장, 에러저장
		$tmpVal = makeGridSaveJson($GRID,$this->DB);
		$tmpVal->GRPID = $grpId;
		array_push($rtnVal->GRP_DATA, $tmpVal);		//GRID_SAVE____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);		alog("ERRMNGService-goG3Save________________________end");
	}
	//에러, 엑셀다운로드
	public function goG3Excel(){
		global $REQ;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("ERRMNGService-goG3Excel________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);		alog("ERRMNGService-goG3Excel________________________end");
	}
	//, 조회
	public function goG4Search(){
		global $REQ;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("ERRMNGService-goG4Search________________________start");
//FORMVIEW SEARCH
// SQL LOOP
		// 에러상세
		$FORMVIEW["SQL"]["R"] = $this->DAO->rErrDetail($REQ); 
		$rtnVal = makeFormviewSearchJson($FORMVIEW,$this->DB);
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);		alog("ERRMNGService-goG4Search________________________end");
	}
	//, 저장
	public function goG4Save(){
		global $REQ;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("ERRMNGService-goG4Save________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);		alog("ERRMNGService-goG4Save________________________end");
	}
	//, 삭제
	public function goG4Delete(){
		global $REQ;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("ERRMNGService-goG4Delete________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);		alog("ERRMNGService-goG4Delete________________________end");
	}
}
                                                             
?>
