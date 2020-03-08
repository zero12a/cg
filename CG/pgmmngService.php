<?php
//SVC
 
//include_once('PgmmngInterface.php');
include_once('pgmmngDao.php');
//class PgmmngService implements PgmmngInterface
class pgmmngService 
{
	private $DAO;
	private $DB;
	//생성자
	function __construct(){
		global $log,$CFG;
		$log->info("PgmmngService-__construct");

		$this->DAO = new pgmmngDao();
		$this->DB["CGCORE"] = getDbConn($CFG["CFG_DB"]["CGCORE"]);
		$this->DB["CGPJT1"] = getDbConn($CFG["CFG_DB"]["CGPJT1"]);
	}
	//파괴자
	function __destruct(){
		global $log;
		$log->info("PgmmngService-__destruct");

		unset($this->DAO);
		if($this->DB["CGCORE"])closeDb($this->DB["CGCORE"]);
		if($this->DB["CGPJT1"])closeDb($this->DB["CGPJT1"]);
		unset($this->DB);
	}
	function __toString(){
		global $log;
		$log->info("PgmmngService-__toString");
	}
	//PJT, 조회
	public function goG3Search(){
		global $REQ,$CFG,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("PGMMNGService-goG3Search________________________start");
		//그리드 서버 조회 
		//GRID_SEARCH____________________________start
		$GRID["SQL"] = array();
		$GRID["GRPTYPE"] = "GRID_DHTMLX";
		$GRID["KEYCOLIDX"] = 0; // KEY 컬럼, PJTSEQ

		//조회
		//V_GRPNM : PJT
		array_push($GRID["SQL"], $this->DAO->sql1($REQ)); //SEARCH, 조회,PJT
	//암호화컬럼
		$GRID["COLCRYPT"] = array();
		//필수 여부 검사
		$tmpVal = requireGridSearchArray($GRID["COLORD"],$GRID["XML"],$GRID["SQL"]);
		if($tmpVal->RTN_CD == "500"){
			$log->info("requireGrid - fail.");
			$tmpVal->GRPID = $grpId;
			echo json_encode($tmpVal);
			exit;
		}
		$rtnVal = makeGridSearchJsonArray($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G3]",microtime(true)));
		//GRID_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		$log->info("PGMMNGService-goG3Search________________________end");
	}
	//PJT, 저장
	public function goG3Save(){
		global $REQ,$CFG,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("PGMMNGService-goG3Save________________________start");
		//GRID_SAVE____________________________start
		$GRID["SQL"]["C"] = array();
		$GRID["SQL"]["U"] = array();
		$GRID["SQL"]["D"] = array();
		$grpId="G3";
		$GRID["XML"]=$REQ[$grpId."-XML"];
		$GRID["COLORD"] = "PJTSEQ,PJTID,PJTNM,FILECHARSET,UITOOL,SVRLANG,DEPLOYKEY,PKGROOT,STARTDT,ENDDT,DELYN,ADDDT,MODDT"; //그리드 컬럼순서(Hidden컬럼포함)
	//암호화컬럼
		$GRID["COLCRYPT"] = array();	
		$GRID["KEYCOLID"] = "PJTSEQ";  //KEY컬럼 COLID, 0
		$GRID["SEQYN"] = "Y";  //시퀀스 컬럼 유무
		//저장
		//V_GRPNM : PJT
		array_push($GRID["SQL"]["D"], $this->DAO->sql2($REQ)); //SAVE, 저장,PJT
		//V_GRPNM : PJT
		array_push($GRID["SQL"]["U"], $this->DAO->sql3($REQ)); //SAVE, 저장,PJT
		//V_GRPNM : PJT
		array_push($GRID["SQL"]["C"], $this->DAO->sql4($REQ)); //SAVE, 저장,PJT
		$tmpVal = requireGridSaveArray($GRID["COLORD"],$GRID["XML"],$GRID["SQL"]);
		if($tmpVal->RTN_CD == "500"){
			$log->info("requireGrid - fail.");
			$tmpVal->GRPID = $grpId;
			echo json_encode($tmpVal);
			exit;
		}
		$tmpVal = makeGridSaveJsonArray($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G3]",microtime(true)));

		$tmpVal->GRPID = $grpId;
		array_push($rtnVal->GRP_DATA, $tmpVal);
		//GRID_SAVE____________________________end


		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		$log->info("PGMMNGService-goG3Save________________________end");
	}
	//PGM, 조회
	public function goG4Search(){
		global $REQ,$CFG,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("PGMMNGService-goG4Search________________________start");
		//그리드 서버 조회 
		//GRID_SEARCH____________________________start
		$GRID["SQL"] = array();
		$GRID["GRPTYPE"] = "GRID_DHTMLX";
		$GRID["KEYCOLIDX"] = 1; // KEY 컬럼, PGMSEQ

		//조회
		//V_GRPNM : PGM
		array_push($GRID["SQL"], $this->DAO->sql6($REQ)); //SEARCH, 조회,PGM
	//암호화컬럼
		$GRID["COLCRYPT"] = array();
		//필수 여부 검사
		$tmpVal = requireGridSearchArray($GRID["COLORD"],$GRID["XML"],$GRID["SQL"]);
		if($tmpVal->RTN_CD == "500"){
			$log->info("requireGrid - fail.");
			$tmpVal->GRPID = $grpId;
			echo json_encode($tmpVal);
			exit;
		}
		$rtnVal = makeGridSearchJsonArray($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G4]",microtime(true)));
		//GRID_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		$log->info("PGMMNGService-goG4Search________________________end");
	}
	//PGM, 저장
	public function goG4Save(){
		global $REQ,$CFG,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("PGMMNGService-goG4Save________________________start");
		//GRID_SAVE____________________________start
		$GRID["SQL"]["C"] = array();
		$GRID["SQL"]["U"] = array();
		$GRID["SQL"]["D"] = array();
		$grpId="G4";
		$GRID["XML"]=$REQ[$grpId."-XML"];
		$GRID["COLORD"] = "PJTSEQ,PGMSEQ,PGMID,PGMNM,VIEWURL,PGMTYPE,POPWIDTH,POPHEIGHT,SECTYPE,PKGGRP,LOGINYN,ADDDT,MODDT"; //그리드 컬럼순서(Hidden컬럼포함)
	//암호화컬럼
		$GRID["COLCRYPT"] = array();	
		$GRID["KEYCOLID"] = "PGMSEQ";  //KEY컬럼 COLID, 1
		$GRID["SEQYN"] = "Y";  //시퀀스 컬럼 유무
		//저장
		//V_GRPNM : PGM
		array_push($GRID["SQL"]["D"], $this->DAO->sql9($REQ)); //SAVE, 저장,PGM
		//V_GRPNM : PGM
		array_push($GRID["SQL"]["C"], $this->DAO->sql7($REQ)); //SAVE, 저장,PGM
		//V_GRPNM : PGM
		array_push($GRID["SQL"]["U"], $this->DAO->sql8($REQ)); //SAVE, 저장,PGM
		$tmpVal = requireGridSaveArray($GRID["COLORD"],$GRID["XML"],$GRID["SQL"]);
		if($tmpVal->RTN_CD == "500"){
			$log->info("requireGrid - fail.");
			$tmpVal->GRPID = $grpId;
			echo json_encode($tmpVal);
			exit;
		}
		$tmpVal = makeGridSaveJsonArray($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G4]",microtime(true)));

		$tmpVal->GRPID = $grpId;
		array_push($rtnVal->GRP_DATA, $tmpVal);
		//GRID_SAVE____________________________end


		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		$log->info("PGMMNGService-goG4Save________________________end");
	}
	//DD, 조회
	public function goG5Search(){
		global $REQ,$CFG,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("PGMMNGService-goG5Search________________________start");
		//그리드 서버 조회 
		//GRID_SEARCH____________________________start
		$GRID["SQL"] = array();
		$GRID["GRPTYPE"] = "GRID_DHTMLX";
		$GRID["KEYCOLIDX"] = 1; // KEY 컬럼, DDSEQ

		//조회
		//V_GRPNM : DD
		array_push($GRID["SQL"], $this->DAO->sql10($REQ)); //SEARCH, 조회,DD
	//암호화컬럼
		$GRID["COLCRYPT"] = array();
		//필수 여부 검사
		$tmpVal = requireGridSearchArray($GRID["COLORD"],$GRID["XML"],$GRID["SQL"]);
		if($tmpVal->RTN_CD == "500"){
			$log->info("requireGrid - fail.");
			$tmpVal->GRPID = $grpId;
			echo json_encode($tmpVal);
			exit;
		}
		$rtnVal = makeGridSearchJsonArray($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G5]",microtime(true)));
		//GRID_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		$log->info("PGMMNGService-goG5Search________________________end");
	}
	//DD, 저장
	public function goG5Save(){
		global $REQ,$CFG,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("PGMMNGService-goG5Save________________________start");
		//GRID_SAVE____________________________start
		$GRID["SQL"]["C"] = array();
		$GRID["SQL"]["U"] = array();
		$GRID["SQL"]["D"] = array();
		$grpId="G5";
		$GRID["XML"]=$REQ[$grpId."-XML"];
		$GRID["COLORD"] = "PJTSEQ,DDSEQ,COLID,COLNM,COLSNM,DATATYPE,DATASIZE,OBJTYPE,OBJTYPE_FORMVIEW,OBJTYPE_GRID,LBLWIDTH,LBLHEIGHT,LBLALIGN,OBJWIDTH,OBJHEIGHT,OBJALIGN,CRYPTCD,VALIDSEQ,PIYN,ADDDT,MODDT"; //그리드 컬럼순서(Hidden컬럼포함)
	//암호화컬럼
		$GRID["COLCRYPT"] = array();	
		$GRID["KEYCOLID"] = "DDSEQ";  //KEY컬럼 COLID, 1
		$GRID["SEQYN"] = "Y";  //시퀀스 컬럼 유무
		//저장
		//V_GRPNM : DD
		array_push($GRID["SQL"]["D"], $this->DAO->sql13($REQ)); //SAVE, 저장,DD
		//V_GRPNM : DD
		array_push($GRID["SQL"]["U"], $this->DAO->sql12($REQ)); //SAVE, 저장,DD
		//V_GRPNM : DD
		array_push($GRID["SQL"]["C"], $this->DAO->sql11($REQ)); //SAVE, 저장,DD
		$tmpVal = requireGridSaveArray($GRID["COLORD"],$GRID["XML"],$GRID["SQL"]);
		if($tmpVal->RTN_CD == "500"){
			$log->info("requireGrid - fail.");
			$tmpVal->GRPID = $grpId;
			echo json_encode($tmpVal);
			exit;
		}
		$tmpVal = makeGridSaveJsonArray($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G5]",microtime(true)));

		$tmpVal->GRPID = $grpId;
		array_push($rtnVal->GRP_DATA, $tmpVal);
		//GRID_SAVE____________________________end


		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		$log->info("PGMMNGService-goG5Save________________________end");
	}
	//CONFIG, 사용자정의
	public function goG6Userdef(){
		global $REQ,$CFG,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("PGMMNGService-goG6Userdef________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		$log->info("PGMMNGService-goG6Userdef________________________end");
	}
	//CONFIG, 조회
	public function goG6Search(){
		global $REQ,$CFG,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("PGMMNGService-goG6Search________________________start");
		//그리드 서버 조회 
		//GRID_SEARCH____________________________start
		$GRID["SQL"] = array();
		$GRID["GRPTYPE"] = "GRID_DHTMLX";
		$GRID["KEYCOLIDX"] = 1; // KEY 컬럼, CFGSEQ

		//조회
		//V_GRPNM : CONFIG
		array_push($GRID["SQL"], $this->DAO->impR($REQ)); //SEARCH, 조회,CONFIG
	//암호화컬럼
		$GRID["COLCRYPT"] = array();
		//필수 여부 검사
		$tmpVal = requireGridSearchArray($GRID["COLORD"],$GRID["XML"],$GRID["SQL"]);
		if($tmpVal->RTN_CD == "500"){
			$log->info("requireGrid - fail.");
			$tmpVal->GRPID = $grpId;
			echo json_encode($tmpVal);
			exit;
		}
		$rtnVal = makeGridSearchJsonArray($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G6]",microtime(true)));
		//GRID_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		$log->info("PGMMNGService-goG6Search________________________end");
	}
	//CONFIG, 저장
	public function goG6Save(){
		global $REQ,$CFG,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("PGMMNGService-goG6Save________________________start");
		//GRID_SAVE____________________________start
		$GRID["SQL"]["C"] = array();
		$GRID["SQL"]["U"] = array();
		$GRID["SQL"]["D"] = array();
		$grpId="G6";
		$GRID["XML"]=$REQ[$grpId."-XML"];
		$GRID["COLORD"] = "PJTSEQ,CFGSEQ,USEYN,CFGID,CFGNM,MVCGBN,PATH,CFGORD,ADDDT,MODDT"; //그리드 컬럼순서(Hidden컬럼포함)
	//암호화컬럼
		$GRID["COLCRYPT"] = array();	
		$GRID["KEYCOLID"] = "CFGSEQ";  //KEY컬럼 COLID, 1
		$GRID["SEQYN"] = "Y";  //시퀀스 컬럼 유무
		//저장
		//V_GRPNM : CONFIG
		array_push($GRID["SQL"]["C"], $this->DAO->impC($REQ)); //SAVE, 저장,CONFIG
		//V_GRPNM : CONFIG
		array_push($GRID["SQL"]["U"], $this->DAO->impU($REQ)); //SAVE, 저장,CONFIG
		//V_GRPNM : CONFIG
		array_push($GRID["SQL"]["D"], $this->DAO->impD($REQ)); //SAVE, 저장,CONFIG
		$tmpVal = requireGridSaveArray($GRID["COLORD"],$GRID["XML"],$GRID["SQL"]);
		if($tmpVal->RTN_CD == "500"){
			$log->info("requireGrid - fail.");
			$tmpVal->GRPID = $grpId;
			echo json_encode($tmpVal);
			exit;
		}
		$tmpVal = makeGridSaveJsonArray($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G6]",microtime(true)));

		$tmpVal->GRPID = $grpId;
		array_push($rtnVal->GRP_DATA, $tmpVal);
		//GRID_SAVE____________________________end


		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		$log->info("PGMMNGService-goG6Save________________________end");
	}
	//CONFIG, 엑셀다운로드
	public function goG6Excel(){
		global $REQ,$CFG,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("PGMMNGService-goG6Excel________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		$log->info("PGMMNGService-goG6Excel________________________end");
	}
	//FILE, 사용자정의
	public function goG7Userdef(){
		global $REQ,$CFG,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("PGMMNGService-goG7Userdef________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		$log->info("PGMMNGService-goG7Userdef________________________end");
	}
	//FILE, 조회
	public function goG7Search(){
		global $REQ,$CFG,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("PGMMNGService-goG7Search________________________start");
		//그리드 서버 조회 
		//GRID_SEARCH____________________________start
		$GRID["SQL"] = array();
		$GRID["GRPTYPE"] = "GRID_DHTMLX";
		$GRID["KEYCOLIDX"] = 1; // KEY 컬럼, FILESEQ

		//조회
		//V_GRPNM : FILE
		array_push($GRID["SQL"], $this->DAO->fileR($REQ)); //SEARCH, 조회,FILE
	//암호화컬럼
		$GRID["COLCRYPT"] = array();
		//필수 여부 검사
		$tmpVal = requireGridSearchArray($GRID["COLORD"],$GRID["XML"],$GRID["SQL"]);
		if($tmpVal->RTN_CD == "500"){
			$log->info("requireGrid - fail.");
			$tmpVal->GRPID = $grpId;
			echo json_encode($tmpVal);
			exit;
		}
		$rtnVal = makeGridSearchJsonArray($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G7]",microtime(true)));
		//GRID_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		$log->info("PGMMNGService-goG7Search________________________end");
	}
	//FILE, 저장
	public function goG7Save(){
		global $REQ,$CFG,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("PGMMNGService-goG7Save________________________start");
		//GRID_SAVE____________________________start
		$GRID["SQL"]["C"] = array();
		$GRID["SQL"]["U"] = array();
		$GRID["SQL"]["D"] = array();
		$grpId="G7";
		$GRID["XML"]=$REQ[$grpId."-XML"];
		$GRID["COLORD"] = "PJTSEQ,FILESEQ,MKFILETYPE,MKFILETYPENM,MKFILEFORMAT,MKFILEEXT,TEMPLATE,FILEORD,USEYN,ADDDT,MODDT"; //그리드 컬럼순서(Hidden컬럼포함)
	//암호화컬럼
		$GRID["COLCRYPT"] = array();	
		$GRID["KEYCOLID"] = "FILESEQ";  //KEY컬럼 COLID, 1
		$GRID["SEQYN"] = "Y";  //시퀀스 컬럼 유무
		//저장
		//V_GRPNM : FILE
		array_push($GRID["SQL"]["C"], $this->DAO->fileC($REQ)); //SAVE, 저장,FILE
		//V_GRPNM : FILE
		array_push($GRID["SQL"]["U"], $this->DAO->fileU($REQ)); //SAVE, 저장,FILE
		$tmpVal = requireGridSaveArray($GRID["COLORD"],$GRID["XML"],$GRID["SQL"]);
		if($tmpVal->RTN_CD == "500"){
			$log->info("requireGrid - fail.");
			$tmpVal->GRPID = $grpId;
			echo json_encode($tmpVal);
			exit;
		}
		$tmpVal = makeGridSaveJsonArray($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G7]",microtime(true)));

		$tmpVal->GRPID = $grpId;
		array_push($rtnVal->GRP_DATA, $tmpVal);
		//GRID_SAVE____________________________end


		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		$log->info("PGMMNGService-goG7Save________________________end");
	}
	//FILE, 엑셀다운로드
	public function goG7Excel(){
		global $REQ,$CFG,$_RTIME, $log;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		$log->info("PGMMNGService-goG7Excel________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		$log->info("PGMMNGService-goG7Excel________________________end");
	}
}
                                                             
?>
