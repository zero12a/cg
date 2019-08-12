<?php
//SVC
 
//include_once('FiletestInterface.php');
include_once('filetestDao.php');
//class FiletestService implements FiletestInterface
class filetestService 
{
	private $DAO;
	private $DB;
	//생성자
	function __construct(){
		alog("FiletestService-__construct");

		$this->DAO = new filetestDao();
	    //$this->DB = db_s_open();
		$this->DB["SC"] = db_obj_open(getDbSvrInfo("SC"));
	}
	//파괴자
	function __destruct(){
		alog("FiletestService-__destruct");

		unset($this->DAO);
		if($this->DB["SC"])$this->DB["SC"]->close();
		unset($this->DB);
	}
	function __toString(){
		alog("FiletestService-__toString");
	}
	//컨디션, 조회(전체)
	public function goG1Searchall(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("FILETESTService-goG1Searchall________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("FILETESTService-goG1Searchall________________________end");
	}
	//컨디션, 저장
	public function goG1Save(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("FILETESTService-goG1Save________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("FILETESTService-goG1Save________________________end");
	}
	//a, 조회
	public function goG4Search(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("FILETESTService-goG4Search________________________start");
//BIVIEW SEARCH
		$grpId="G4";
	//암호화컬럼
		$BIVIEW["COLCRYPT"] = array();
		$BIVIEW["SQL"] = array();
	// SQL LOOP
		// selBI1
		array_push($BIVIEW["SQL"], $this->DAO->selBI1($REQ)); 
		//필수 여부 검사
		$tmpVal = requireFormviewSearchArray($BIVIEW["SQL"]);
		if($tmpVal->RTN_CD == "500"){
			alog("requireBIview - fail.");
			$tmpVal->GRPID = $grpId;
			echo json_encode($tmpVal);
			exit;
		}
		$rtnVal = makeFormviewSearchJsonArray($BIVIEW,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G4]",microtime(true)));
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("FILETESTService-goG4Search________________________end");
	}
	//b, 조회
	public function goG5Search(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("FILETESTService-goG5Search________________________start");
//BIVIEW SEARCH
		$grpId="G5";
	//암호화컬럼
		$BIVIEW["COLCRYPT"] = array();
		$BIVIEW["SQL"] = array();
	// SQL LOOP
		// selBI1
		array_push($BIVIEW["SQL"], $this->DAO->selBI1($REQ)); 
		//필수 여부 검사
		$tmpVal = requireFormviewSearchArray($BIVIEW["SQL"]);
		if($tmpVal->RTN_CD == "500"){
			alog("requireBIview - fail.");
			$tmpVal->GRPID = $grpId;
			echo json_encode($tmpVal);
			exit;
		}
		$rtnVal = makeFormviewSearchJsonArray($BIVIEW,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G5]",microtime(true)));
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("FILETESTService-goG5Search________________________end");
	}
	//c, 조회
	public function goG6Search(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("FILETESTService-goG6Search________________________start");
//BIVIEW SEARCH
		$grpId="G6";
	//암호화컬럼
		$BIVIEW["COLCRYPT"] = array();
		$BIVIEW["SQL"] = array();
	// SQL LOOP
		// selBI2
		array_push($BIVIEW["SQL"], $this->DAO->selBI2($REQ)); 
		//필수 여부 검사
		$tmpVal = requireFormviewSearchArray($BIVIEW["SQL"]);
		if($tmpVal->RTN_CD == "500"){
			alog("requireBIview - fail.");
			$tmpVal->GRPID = $grpId;
			echo json_encode($tmpVal);
			exit;
		}
		$rtnVal = makeFormviewSearchJsonArray($BIVIEW,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G6]",microtime(true)));
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("FILETESTService-goG6Search________________________end");
	}
	//d, 조회
	public function goG7Search(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("FILETESTService-goG7Search________________________start");
//BIVIEW SEARCH
		$grpId="G7";
	//암호화컬럼
		$BIVIEW["COLCRYPT"] = array();
		$BIVIEW["SQL"] = array();
	// SQL LOOP
		// selBI2
		array_push($BIVIEW["SQL"], $this->DAO->selBI2($REQ)); 
		//필수 여부 검사
		$tmpVal = requireFormviewSearchArray($BIVIEW["SQL"]);
		if($tmpVal->RTN_CD == "500"){
			alog("requireBIview - fail.");
			$tmpVal->GRPID = $grpId;
			echo json_encode($tmpVal);
			exit;
		}
		$rtnVal = makeFormviewSearchJsonArray($BIVIEW,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G7]",microtime(true)));
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("FILETESTService-goG7Search________________________end");
	}
	//그리드, 조회
	public function goG2Search(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("FILETESTService-goG2Search________________________start");
		//그리드 서버 조회 
		//GRID_SEARCH____________________________start
		$GRID["SQL"] = array();
		$GRID["GRPTYPE"] = "GRID_DHTMLX";
		$GRID["KEYCOLIDX"] = 0; // KEY 컬럼, FILESEQ

		//조회
		//V_GRPNM : 그리드
		array_push($GRID["SQL"], $this->DAO->selG($REQ)); //SEARCH, 조회,selQ
	//암호화컬럼
		$GRID["COLCRYPT"] = array();
		//필수 여부 검사
		$tmpVal = requireGridSearchArray($GRID["COLORD"],$GRID["XML"],$GRID["SQL"]);
		if($tmpVal->RTN_CD == "500"){
			alog("requireGrid - fail.");
			$tmpVal->GRPID = $grpId;
			echo json_encode($tmpVal);
			exit;
		}
		$rtnVal = makeGridSearchJsonArray($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G2]",microtime(true)));
		//GRID_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("FILETESTService-goG2Search________________________end");
	}
	//그리드, 저장
	public function goG2Save(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("FILETESTService-goG2Save________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("FILETESTService-goG2Save________________________end");
	}
	//폼뷰, 조회
	public function goG3Search(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("FILETESTService-goG3Search________________________start");
//FORMVIEW SEARCH
		$grpId="G3";
	//암호화컬럼
		$FORMVIEW["COLCRYPT"] = array();
		$FORMVIEW["SQL"] = array();
	// SQL LOOP
		// selF
		array_push($FORMVIEW["SQL"], $this->DAO->selF($REQ)); 
		//필수 여부 검사
		$tmpVal = requireFormviewSearchArray($FORMVIEW["SQL"]);
		if($tmpVal->RTN_CD == "500"){
			alog("requireFormview - fail.");
			$tmpVal->GRPID = $grpId;
			echo json_encode($tmpVal);
			exit;
		}
		$rtnVal = makeFormviewSearchJsonArray($FORMVIEW,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G3]",microtime(true)));
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("FILETESTService-goG3Search________________________end");
	}
	//폼뷰, 저장
	public function goG3Save(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("FILETESTService-goG3Save________________________start");
		//FORMVIEW SAVE
		$grpId="G3";
		$FORMVIEW["FNCTYPE"] = $REQ[$grpId . "-CTLCUD"]; 
		$GRID["KEYCOLID"] = "";  //KEY컬럼 COLID, -1
		$GRID["SEQYN"] = "Y";  //시퀀스 컬럼 유무
	//암호화컬럼
		$FORMVIEW["COLCRYPT"] = array();	
			//파일저장
		alog("G3-FILE1-NM = " . $REQ["G3-FILE1-NM"]);
		if(strlen($REQ["G3-FILE1-NM"]) > 4  && isAllowExtension($REQ["G3-FILE1-NM"],$t_allow_extension=array("jpg", "gif", "png","peng","bmp","svg","xls","xlsx","doc","docx","ppt","pptx","pdf","hwp","txt"))){
			
			$REQ["G3-FILE1-SVRNM"] = getFileSvrNm($REQ["G3-FILE1-NM"], $t_prefix="PIC_");
			$MYFILE1 = $CFG_UPLOAD_DIR . $REQ["G3-FILE1-SVRNM"];
			alog("###### MYFILE1 : " . $MYFILE1 );

			if(!move_uploaded_file($REQ["G3-FILE1-TMPNM"], $MYFILE1)){
				//처리 결과 리턴
				$rtnVal->RTN_CD = "500";
				$rtnVal->ERR_CD = "591";
				echo json_encode($rtnVal);
				return;
			}
		}
		//CTLCUD 명령어에 따른 분개 처리
		if( $FORMVIEW["FNCTYPE"] == "C" || $FORMVIEW["FNCTYPE"] == "U"){ 

			$FORMVIEW["SQL"] = array();
			switch($FORMVIEW["FNCTYPE"]){
				case "C":
				array_push($FORMVIEW["SQL"],$this->DAO->insG($REQ)); 
						break;
				case "U":
					break;
				default : 
					alog("(SVC) FNCTYPE을 찾을수 없습니다.");
			}
			//필수 여부 검사
			$tmpVal = requireFormviewSaveArray($FORMVIEW["SQL"],$FORMVIEW["FNCTYPE"]);
			if($tmpVal->RTN_CD == "500"){
				alog("requireFormview - fail.");
				$tmpVal->GRPID = $grpId;
				echo json_encode($tmpVal);
				exit;
			}
			$tmpVal = makeFormviewSaveJsonArray($FORMVIEW,$this->DB);
			array_push($_RTIME,array("[TIME 50.DB_TIME G3]",microtime(true)));

			$al->GRPID = $grpId;
			array_push($rtnVal->GRP_DATA, $tmpVal);

			//$rtnVal = makeFormviewSaveJson($FORMVIEW,$this->DB);

		}//C,U 일때만 DB처리
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("FILETESTService-goG3Save________________________end");
	}
}
                                                             
?>
