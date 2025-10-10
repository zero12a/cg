<?php
//SVC
 
//include_once('FindfooterInterface.php');

//class FindfooterService implements FindfooterInterface
class cg_pgminfo_svc 
{
	private $DAO;
	private $DB;

	//생성자
	function __construct($dsNm){
		alog("cg_pgminfo_svc-__construct");
		global $CFG;

		$this->DAO = new cg_pgminfo_dao();
	    //$this->DB = db_s_open();
		$this->DB["CG"] = getDbConn($CFG["CFG_DB"][$dsNm]);
	}
	//파괴자
	function __destruct(){
		alog("cg_pgminfo_svc-__destruct");

		unset($this->DAO);
		closeDb($this->DB["CG"]);

		//if($this->DB["CG"])$this->DB["CG"]->close();
		unset($this->DB);
	}
	function __toString(){
		alog("cg_pgminfo_svc-__toString");
	}

	public function goPgmSearch(){
		global $REQ,$_RTIME;
		$rtnVal = new stdClass(); $rtnVal->GRP_DATA = array();
		$tmpVal = null;
		$grpId = null;

		alog("cg_pgminfo_svc-goPgmSearch________________________start");
		//CHARTBAR SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 3; // KEY 컬럼, 

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
		alog("cg_pgminfo_svc-goPgmSearch________________________end");
	}	

}
                                                             
?>
