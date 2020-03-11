<?php
//SVC
 
//include_once('PjtsummaryInterface.php');
include_once('pjtsummaryDao.php');
//class PjtsummaryService implements PjtsummaryInterface
class pjtsummaryService 
{
	private $DAO;
	private $DB;
	//생성자
	function __construct(){
		global $log,$CFG;
		$log->info("PjtsummaryService-__construct");

		$this->DAO = new pjtsummaryDao();
		$this->DB["CGPJT1"] = getDbConn($CFG["CFG_DB"]["CGPJT1"]);
	}
	//파괴자
	function __destruct(){
		global $log;
		$log->info("PjtsummaryService-__destruct");

		unset($this->DAO);
		if($this->DB["CGPJT1"])closeDb($this->DB["CGPJT1"]);
		unset($this->DB);
	}
	function __toString(){
		global $log;
		$log->info("PjtsummaryService-__toString");
	}
	//, 조회(전체)
	public function goG1Searchall(){
		global $REQ,$CFG,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("PJTSUMMARYService-goG1Searchall________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		$log->info("PJTSUMMARYService-goG1Searchall________________________end");
	}
	//1, 조회
	public function goG2Search(){
		global $REQ,$CFG,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("PJTSUMMARYService-goG2Search________________________start");
//BIVIEW SEARCH
		$grpId="G2";
	//암호화컬럼
		$BIVIEW["COLCRYPT"] = array();
		$BIVIEW["SQL"] = array();
	// SQL LOOP
		// selPgmCnt
		array_push($BIVIEW["SQL"], $this->DAO->selPgmCnt($REQ)); 
		//필수 여부 검사
		$tmpVal = requireFormviewSearchArray($BIVIEW["SQL"]);
		if($tmpVal->RTN_CD == "500"){
			$log->info("requireBIview - fail.");
			$tmpVal->GRPID = $grpId;
			echo json_encode($tmpVal);
			exit;
		}
		$rtnVal = makeFormviewSearchJsonArray($BIVIEW,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G2]",microtime(true)));
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		$log->info("PJTSUMMARYService-goG2Search________________________end");
	}
	//2, 조회
	public function goG3Search(){
		global $REQ,$CFG,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("PJTSUMMARYService-goG3Search________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		$log->info("PJTSUMMARYService-goG3Search________________________end");
	}
	//3, 조회
	public function goG4Search(){
		global $REQ,$CFG,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("PJTSUMMARYService-goG4Search________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		$log->info("PJTSUMMARYService-goG4Search________________________end");
	}
	//4, 조회
	public function goG5Search(){
		global $REQ,$CFG,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("PJTSUMMARYService-goG5Search________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		$log->info("PJTSUMMARYService-goG5Search________________________end");
	}
}
                                                             
?>
