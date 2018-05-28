<?php
//SVC
 
//include_once('DeploypgmInterface.php');
include_once('deploypgmDao.php');
//class DeploypgmService implements DeploypgmInterface
class deploypgmService 
{
	private $DAO;
	private $DB;
	//생성자
	function __construct(){
		alog("DeploypgmService-__construct");

		$this->DAO = new deploypgmDao();
	    //$this->DB = db_s_open();
		$this->DB["CG"] = db_obj_open(getDbSvrInfo("CG"));
	}
	//파괴자
	function __destruct(){
		alog("DeploypgmService-__destruct");

		unset($this->DAO);
		if($this->DB["CG"])$this->DB["CG"]->close();
		unset($this->DB);
	}
	function __toString(){
		alog("DeploypgmService-__toString");
	}
	//, 조회(전체)
	public function goG1Searchall(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("DEPLOYPGMService-goG1Searchall________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("DEPLOYPGMService-goG1Searchall________________________end");
	}
	//, 저장
	public function goG1Save(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("DEPLOYPGMService-goG1Save________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("DEPLOYPGMService-goG1Save________________________end");
	}
	//파일, 조회
	public function goG2Search(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("DEPLOYPGMService-goG2Search________________________start");
		//그리드 서버 조회 
		//GRID_SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 3; // KEY 컬럼, FILESEQ

		//조회
		//V_GRPNM : 파일
		$GRID["SQL"]["R"] = $this->DAO->sFileG($REQ); //SEARCH, 조회,FILE
	//암호화컬럼
		$GRID["COLCRYPT"] = array();
		$rtnVal = makeGridSearchJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G2]",microtime(true)));
		//GRID_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("DEPLOYPGMService-goG2Search________________________end");
	}
	//파일, 저장
	public function goG2Save(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("DEPLOYPGMService-goG2Save________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("DEPLOYPGMService-goG2Save________________________end");
	}
	//파일, 엑셀다운로드
	public function goG2Excel(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("DEPLOYPGMService-goG2Excel________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("DEPLOYPGMService-goG2Excel________________________end");
	}
	//파일, 선택저장
	public function goG2Chksave(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("DEPLOYPGMService-goG2Chksave________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("DEPLOYPGMService-goG2Chksave________________________end");
	}
	//SQL PGM, 조회
	public function goG3Search(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("DEPLOYPGMService-goG3Search________________________start");
		//그리드 서버 조회 
		//GRID_SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 1; // KEY 컬럼, PGMSEQ

		//001 원격에서 PGM목록 가져오기
		$url = "http://172.17.0.1:8080/c.g/deploy_remote.php?PJTSEQ=3&PJTSEQ=3&PGMSEQ=66&PGM_LIST_YN=Y";

		$body = getHttpBody($url);
		//alog($body);
		$bodyJson = json_decode($body,true);

		$deployArr = array();
		alog("sizeof  bodyJson = " . count($bodyJson["PGM_LIST"]));
		for($i=0; $i<count($bodyJson["PGM_LIST"]); $i++){
			$tPgmMap = $bodyJson["PGM_LIST"][$i];

			//PGM정보가 R.D에 있는지 검사하기
			$sql = sprintf("select ifnull(count(PGMID),0) as CNT from DATING.CMN_MNU where PGMID = '%s' "
				, addSqlSlashes($tPgmMap["PGMID"])
			);
			//alog("sql = " . $sql);
			$result = $this->DB["CG"]->query($sql) or JsonMsg("500","300", "PGM_LIST_YN [" . $this->DB["CG"]->errno . "] " . $this->DB["CG"]->error) ;

			//$line2 = null;
			$arr = fetch_all($result,MYSQLI_ASSOC);
			if(intval($arr[0]["CNT"]) == 0){
				//alog("신규파일 : " . $i . " -> " . $tPgmMap["PGMID"]);
				array_push($deployArr,$tPgmMap);
			}else{
				//alog("신규파일 아님 : " . $i . " -> " . $tPgmMap["PGMID"]);
			}
			$result->close();
		}

		alog("sizeof(deployArr) = ". sizeof($deployArr));
		//exit;

		//리턴 배열 만들기
		$rtnVal->RTN_DATA = new stdClass();
		for($j=0;$j<count($deployArr);$j++){
			alog("j = " . $j . " -> " . $tPgmMap["PGMSEQ"]);
			$tPgmMap = $deployArr[$j];

			$rtnVal->RTN_DATA->rows[$j]['id']=$tPgmMap["PGMSEQ"];
			$one_row = array(0); //첫번째 컬럼 chk
			foreach($tPgmMap as $k=>$v){
				alog(" add value = " . $v);
				array_push($one_row,$v);
			}
			$rtnVal->RTN_DATA->rows[$j]['data']=$one_row;
		}

		/*
		//조회
		//V_GRPNM : SQL PGM
		$GRID["SQL"]["R"] = $this->DAO->sPgmG($REQ); //SEARCH, 조회,PGM
		
		//암호화컬럼
		$GRID["COLCRYPT"] = array();
		$rtnVal = makeGridSearchJson($GRID,$this->DB);
		*/


		array_push($_RTIME,array("[TIME 50.DB_TIME G3]",microtime(true)));
		//GRID_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("DEPLOYPGMService-goG3Search________________________end");
	}
	//SQL PGM, 저장
	public function goG3Save(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("DEPLOYPGMService-goG3Save________________________start");


		alog("PGMMNGService-goG4Save________________________start");
		//GRID_SAVE____________________________start
		$grpId="G3";
		$GRID["XML"]=$REQ[$grpId."-XML"];
		$GRID["COLORD"] = "PJTSEQ,PGMSEQ,PGMID,PGMNM,VIEWURL,MNUORD,FOLDER_SEQ,PGMTYPE,POPWIDTH,POPHEIGHT,SECTYPE,PKGGRP,ADDDT,MODDT"; //그리드 컬럼순서(Hidden컬럼포함)
		$GRID["COLCRYPT"] = array();	//암호화컬럼
		$GRID["KEYCOLID"] = "PGMSEQ";  //KEY컬럼 COLID, 1
		$GRID["SEQYN"] = "Y";  //시퀀스 컬럼 유무
		//저장
		$GRID["SQL"]["C"] = $this->DAO->insMnuG($REQ); // SAVE, 저장, PGM
		$tmpVal = makeGridSaveJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G4]",microtime(true)));

		$tmpVal->GRPID = $grpId;
		array_push($rtnVal->GRP_DATA, $tmpVal);
		//GRID_SAVE____________________________end


		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("DEPLOYPGMService-goG3Save________________________end");
	}
	//SQL PGM, 엑셀다운로드
	public function goG3Excel(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("DEPLOYPGMService-goG3Excel________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("DEPLOYPGMService-goG3Excel________________________end");
	}
	//SQL PGM, 선택저장
	public function goG3Chksave(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("DEPLOYPGMService-goG3Chksave________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("DEPLOYPGMService-goG3Chksave________________________end");
	}
	//SQL AUTH, 조회
	public function goG4Search(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("DEPLOYPGMService-goG4Search________________________start");
		//그리드 서버 조회 
		//GRID_SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 1; // KEY 컬럼, ROWID

		//조회
		//V_GRPNM : SQL AUTH
		$GRID["SQL"]["R"] = $this->DAO->sAuthG($REQ); //SEARCH, 조회,AUTH
	//암호화컬럼
		$GRID["COLCRYPT"] = array();
		$rtnVal = makeGridSearchJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G4]",microtime(true)));
		//GRID_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("DEPLOYPGMService-goG4Search________________________end");
	}
	//SQL AUTH, 저장
	public function goG4Save(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("DEPLOYPGMService-goG4Save________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("DEPLOYPGMService-goG4Save________________________end");
	}
	//SQL AUTH, 엑셀다운로드
	public function goG4Excel(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("DEPLOYPGMService-goG4Excel________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("DEPLOYPGMService-goG4Excel________________________end");
	}
	//SQL AUTH, 선택저장
	public function goG4Chksave(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("DEPLOYPGMService-goG4Chksave________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("DEPLOYPGMService-goG4Chksave________________________end");
	}
}
                                                             
?>
