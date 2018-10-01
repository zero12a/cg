<?php
//SVC
 
//include_once('FindfooterInterface.php');
include_once('cg_pgminfo_dao.php');
//class FindfooterService implements FindfooterInterface
class cg_pgminfo_svc 
{
	private $DAO;
	private $DB;
	//생성자
	function __construct(){
		alog("cg_pgminfo_svc-__construct");

		$this->DAO = new cg_pgminfo_dao();
	    //$this->DB = db_s_open();
		$this->DB["CG"] = db_obj_open(getDbSvrInfo("CG"));
	}
	//파괴자
	function __destruct(){
		alog("cg_pgminfo_svc-__destruct");

		unset($this->DAO);
		if($this->DB["CG"])$this->DB["CG"]->close();
		unset($this->DB);
	}
	function __toString(){
		alog("cg_pgminfo_svc-__toString");
	}



	public function goDdSearch(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("cg_pgminfo_svc-goDdSearch________________________start");
		//CHARTBAR SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 2; // KEY 컬럼, 

		//조회
		//V_GRPNM : 팀별 현황 (보안취약점 갯수)
		$GRID["SQL"]["R"] = $this->DAO->ddSearch($REQ); //SEARCH, 조회,TEAM
		//암호화컬럼
		$GRID["COLCRYPT"] = array();
		$rtnVal = makeGridSearchJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G2]",microtime(true)));
		//CHARTBAR_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("cg_pgminfo_svc-goDdSearch________________________end");
	}	
	

	public function goIocdSearch(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("cg_pgminfo_svc-goIocdSearch________________________start");
		//CHARTBAR SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 2; // KEY 컬럼, 

		//조회
		//V_GRPNM : 팀별 현황 (보안취약점 갯수)
		$GRID["SQL"]["R"] = $this->DAO->iocdSearch($REQ); //SEARCH, 조회,TEAM
		//암호화컬럼
		$GRID["COLCRYPT"] = array();
		$rtnVal = makeGridSearchJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G2]",microtime(true)));
		//CHARTBAR_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("cg_pgminfo_svc-goIocdSearch________________________end");
	}	

	public function goFnccdSearch(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("cg_pgminfo_svc-goFnccdSearch________________________start");
		//CHARTBAR SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 2; // KEY 컬럼, 

		//조회
		//V_GRPNM : 팀별 현황 (보안취약점 갯수)
		$GRID["SQL"]["R"] = $this->DAO->fnccdSearch($REQ); //SEARCH, 조회,TEAM
		//암호화컬럼
		$GRID["COLCRYPT"] = array();
		$rtnVal = makeGridSearchJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G2]",microtime(true)));
		//CHARTBAR_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("cg_pgminfo_svc-goFnccdSearch________________________end");
	}	

	public function goLayoutdSearch(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("cg_pgminfo_svc-goLayoutdSearch________________________start");
		//CHARTBAR SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 2; // KEY 컬럼, 

		//조회
		//V_GRPNM : 팀별 현황 (보안취약점 갯수)
		$GRID["SQL"]["R"] = $this->DAO->layoutdSearch($REQ); //SEARCH, 조회,TEAM
		//암호화컬럼
		$GRID["COLCRYPT"] = array();
		$rtnVal = makeGridSearchJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G2]",microtime(true)));
		//CHARTBAR_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("cg_pgminfo_svc-goLayoutdSearch________________________end");
	}	

	public function goLayoutSearch(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("cg_pgminfo_svc-goLayoutSearch________________________start");
		//CHARTBAR SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 2; // KEY 컬럼, 

		//조회
		//V_GRPNM : 팀별 현황 (보안취약점 갯수)
		$GRID["SQL"]["R"] = $this->DAO->layoutSearch($REQ); //SEARCH, 조회,TEAM
		//암호화컬럼
		$GRID["COLCRYPT"] = array();
		$rtnVal = makeGridSearchJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G2]",microtime(true)));
		//CHARTBAR_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("cg_pgminfo_svc-goLayoutSearch________________________end");
	}	



	public function goPgmSearch(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("cg_pgminfo_svc-goSqldSearch________________________start");
		//CHARTBAR SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 2; // KEY 컬럼, 

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
		alog("cg_pgminfo_svc-goSqldSearch________________________end");
	}	

	public function goSqldSearch(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("cg_pgminfo_svc-goSqldSearch________________________start");
		//CHARTBAR SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 0; // KEY 컬럼, 

		//조회
		//V_GRPNM : 팀별 현황 (보안취약점 갯수)
		$GRID["SQL"]["R"] = $this->DAO->sqldSearch($REQ); //SEARCH, 조회,TEAM
		//암호화컬럼
		$GRID["COLCRYPT"] = array();
		$rtnVal = makeGridSearchJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G2]",microtime(true)));
		//CHARTBAR_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("cg_pgminfo_svc-goSqldSearch________________________end");
	}
	

	public function goSqldSave(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("PGMMNGService-goSqldSave________________________start");
		//GRID_SAVE____________________________start
		$grpId="SQLD";
		$GRID["XML"]=$REQ[$grpId."-XML"];
		$GRID["COLORD"] = "COLSEQ,PJTSEQ,PGMSEQ,SQLSEQ,DDCOLID,COLID,DATATYPE,SQLGBN,ORD,ADDDT,MODDT"; //그리드 컬럼순서(Hidden컬럼포함)
		//암호화컬럼
		$GRID["COLCRYPT"] = array();	
		$GRID["KEYCOLID"] = "COLSEQ";  //KEY컬럼 COLID, 0
		$GRID["SEQYN"] = "Y";  //시퀀스 컬럼 유무

		//저장
		$GRID["SQL"]["D"] = $this->DAO->sqldDel($REQ); // SAVE, 저장, PJT
		$GRID["SQL"]["U"] = $this->DAO->sqldUpd($REQ); // SAVE, 저장, PJT
		$GRID["SQL"]["C"] = $this->DAO->sqldIns($REQ); // SAVE, 저장, PJT

		$tmpVal = makeGridSaveJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME SQLD]",microtime(true)));

		$tmpVal->GRPID = $grpId;
		array_push($rtnVal->GRP_DATA, $tmpVal);
		//GRID_SAVE____________________________end



		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("PGMMNGService-goSqldSave________________________end");
	}	

	public function goSqlrSearch(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("cg_pgminfo_svc-goSqlrSearch________________________start");
		//CHARTBAR SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 0; // KEY 컬럼, 

		//조회
		//V_GRPNM : 팀별 현황 (보안취약점 갯수)
		$GRID["SQL"]["R"] = $this->DAO->sqlrSearch($REQ); //SEARCH, 조회,TEAM
		//암호화컬럼
		$GRID["COLCRYPT"] = array();
		$rtnVal = makeGridSearchJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G2]",microtime(true)));
		//CHARTBAR_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("cg_pgminfo_svc-goSqlrSearch________________________end");
	}


	public function goSqlrSave(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("PGMMNGService-goSqlrSave________________________start");
		//GRID_SAVE____________________________start
		$grpId="SQLR";
		$GRID["XML"]=$REQ[$grpId."-XML"];
		$GRID["COLORD"] = "SQLRSEQ,PJTSEQ,PGMSEQ,SVCSEQ,SQLID,ORD,ADDDT,MODDT"; //그리드 컬럼순서(Hidden컬럼포함)
		//암호화컬럼
		$GRID["COLCRYPT"] = array();	
		$GRID["KEYCOLID"] = "SQLRSEQ";  //KEY컬럼 COLID, 0
		$GRID["SEQYN"] = "Y";  //시퀀스 컬럼 유무

		//저장
		$GRID["SQL"]["D"] = $this->DAO->sqlrDel($REQ); // SAVE, 저장, PJT
		$GRID["SQL"]["U"] = $this->DAO->sqlrUpd($REQ); // SAVE, 저장, PJT
		$GRID["SQL"]["C"] = $this->DAO->sqlrIns($REQ); // SAVE, 저장, PJT

		$tmpVal = makeGridSaveJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME SQLR]",microtime(true)));

		$tmpVal->GRPID = $grpId;
		array_push($rtnVal->GRP_DATA, $tmpVal);
		//GRID_SAVE____________________________end


		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("PGMMNGService-goSqlrSave________________________end");
	}	



	public function goSvcSearch(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("cg_pgminfo_svc-goSvcSearch________________________start");
		//CHARTBAR SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 0; // KEY 컬럼, 

		//조회
		//V_GRPNM : 팀별 현황 (보안취약점 갯수)
		$GRID["SQL"]["R"] = $this->DAO->svcSearch($REQ); //SEARCH, 조회,TEAM
		//암호화컬럼
		$GRID["COLCRYPT"] = array();
		$rtnVal = makeGridSearchJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G2]",microtime(true)));
		//CHARTBAR_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("cg_pgminfo_svc-goSvcSearch________________________end");
	}

	public function goSvcSave(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("PGMMNGService-goSvcSave________________________start");
		//GRID_SAVE____________________________start
		$grpId="SVC";
		$GRID["XML"]=$REQ[$grpId."-XML"];
		$GRID["COLORD"] = "SVCSEQ,PJTSEQ,PGMSEQ,GRPSEQ,FNCSEQ,ORD,SVCGRPID,ADDDT,MODDT"; //그리드 컬럼순서(Hidden컬럼포함)
		//암호화컬럼
		$GRID["COLCRYPT"] = array();	
		$GRID["KEYCOLID"] = "SVCSEQ";  //KEY컬럼 COLID, 0
		$GRID["SEQYN"] = "Y";  //시퀀스 컬럼 유무
		//저장
		$GRID["SQL"]["D"] = $this->DAO->svcDel($REQ); // SAVE, 저장, PJT
		$GRID["SQL"]["U"] = $this->DAO->svcUpd($REQ); // SAVE, 저장, PJT
		$GRID["SQL"]["C"] = $this->DAO->svcIns($REQ); // SAVE, 저장, PJT

		$tmpVal = makeGridSaveJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME SVC]",microtime(true)));

		$tmpVal->GRPID = $grpId;
		array_push($rtnVal->GRP_DATA, $tmpVal);
		//GRID_SAVE____________________________end


		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("PGMMNGService-goSvcSave________________________end");
	}	





	public function goInheritSearch(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("cg_pgminfo_svc-goInheritSearch________________________start");
		//CHARTBAR SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 0; // KEY 컬럼, 

		//조회
		//V_GRPNM : 팀별 현황 (보안취약점 갯수)
		$GRID["SQL"]["R"] = $this->DAO->inheritSearch($REQ); //SEARCH, 조회,TEAM
		//암호화컬럼
		$GRID["COLCRYPT"] = array();
		$rtnVal = makeGridSearchJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G2]",microtime(true)));
		//CHARTBAR_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("cg_pgminfo_svc-goInheritSearch________________________end");
	}



	public function goInheritSave(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("PGMMNGService-goInheritSave________________________start");
		//GRID_SAVE____________________________start
		$grpId="INHERIT";
		$GRID["XML"]=$REQ[$grpId."-XML"];
		$GRID["COLORD"] = "INHERITSEQ,PJTSEQ,PGMSEQ,GRPSEQ,COLID,CHILDGRPID,ADDDT,MODDT"; //그리드 컬럼순서(Hidden컬럼포함)
		//암호화컬럼
		$GRID["COLCRYPT"] = array();	
		$GRID["KEYCOLID"] = "INHERITSEQ";  //KEY컬럼 COLID, 0
		$GRID["SEQYN"] = "Y";  //시퀀스 컬럼 유무
		//저장
		$GRID["SQL"]["D"] = $this->DAO->inheritDel($REQ); // SAVE, 저장, PJT
		$GRID["SQL"]["U"] = $this->DAO->inheritUpd($REQ); // SAVE, 저장, PJT
		$GRID["SQL"]["C"] = $this->DAO->inheritIns($REQ); // SAVE, 저장, PJT

		$tmpVal = makeGridSaveJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME INHERIT]",microtime(true)));

		$tmpVal->GRPID = $grpId;
		array_push($rtnVal->GRP_DATA, $tmpVal);
		//GRID_SAVE____________________________end


		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("PGMMNGService-goInheritSave________________________end");
	}	

	/*
	######################################################
	##	IO
	######################################################
	*/
	public function goIoSearch(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("cg_pgminfo_svc-goIoSearch________________________start");
		//CHARTBAR SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 3; // KEY 컬럼, 

		//조회
		//V_GRPNM : 팀별 현황 (보안취약점 갯수)
		$GRID["SQL"]["R"] = $this->DAO->ioSearch($REQ); //SEARCH, 조회,TEAM
		//암호화컬럼
		$GRID["COLCRYPT"] = array();
		$rtnVal = makeGridSearchJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G2]",microtime(true)));
		//CHARTBAR_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("cg_pgminfo_svc-goIoSearch________________________end");
	}

	public function goIoSave(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("PGMMNGService-goIoSave________________________start");
		//GRID_SAVE____________________________start
		$grpId="IO";
		$GRID["XML"]=$REQ[$grpId."-XML"];
		$GRID["COLORD"] = "PJTSEQ,PGMSEQ,GRPSEQ,IOSEQ,DDSEQ,COLID,COLORD,COLNM,DATATYPE,VALIDSEQ,DATASIZE,OBJTYPE,POPUP,BRYN,LBLHIDDENYN,LBLWIDTH,LBLALIGN,OBJWIDTH,OBJHEIGHT,OBJALIGN,KEYYN,SEQYN,HIDDENYN,EDITYN,FNINIT,FORMAT,FOOTERNM,FOOTERMATH,ADDDT,MODDT"; //그리드 컬럼순서(Hidden컬럼포함)
		
		//암호화컬럼
		$GRID["COLCRYPT"] = array();	
		$GRID["KEYCOLID"] = "IOSEQ";  //KEY컬럼 COLID, 0
		$GRID["SEQYN"] = "Y";  //시퀀스 컬럼 유무
		//저장
		$GRID["SQL"]["D"] = $this->DAO->ioDel($REQ); // SAVE, 저장, PJT
		$GRID["SQL"]["U"] = $this->DAO->ioUpd($REQ); // SAVE, 저장, PJT
		$GRID["SQL"]["C"] = $this->DAO->ioIns($REQ); // SAVE, 저장, PJT

		$tmpVal = makeGridSaveJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME IO]",microtime(true)));

		$tmpVal->GRPID = $grpId;
		array_push($rtnVal->GRP_DATA, $tmpVal);
		//GRID_SAVE____________________________end


		//데이터 딕셔너리에 추가/수정해 주기
		updateDd($GRID["XML"],$GRID["COLORD"],$this->DB["CG"],$REQ);

		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("PGMMNGService-goIoSave________________________end");
	}	

	private function updateDd($xml_array,$colord, &$db,$REQ){
		alog("updateDd.......................................start()");
		$colord_array = explode(",",$colord);

		$xml_array_last = null;
		alog("is_assoc : " . is_assoc($xml_array["row"]) );
		if(is_assoc($xml_array["row"]) == 1) {
			alog(" Y " );
			$xml_array_last[0] = $xml_array["row"];
		}else{
			alog(" N " );

			$xml_array_last = $xml_array["row"];
		}
		//var_dump($xml_array_last);

		$RtnVal = null;
		$RtnCnt = 0;
		alog("xml sizeof : " . sizeof($xml_array_last));
		for($i=0;$i<sizeof($xml_array_last);$i++){
			alog("	i : " . $i);
			$row = $xml_array_last[$i];
			for($j=0;$j<sizeof($row["cell"]);$j++){
				$col = $row["cell"][$j];
				if(is_array($col)){
					$to_row[trim($colord_array[$j])] = "";
				}else{
					$to_row[trim($colord_array[$j])] = $col;
				}
			}


			$tarray = array_merge($REQ,$to_row);

			//이미 등록된 dd인지 확인하기
			$to_coltype = "is";
			$sql = "
				select
				*
				from CG_DD
				where PJTSEQ=#{F_PJTSEQ} and COLID = #{COLID}
				";
			alog("        selected : " );
			$stmt = makeStmt($db,$sql, $to_coltype, $tarray);
			if(!$stmt)JsonMsg("500","100","stmt 생성 실패" . $db->errno . " -> " . $db->error);
			if(!$stmt->execute())JsonMsg("500","110","(makeGridSearchJson) stmt 실행 실패" . $db->errno . " -> " . $db->error);
			if($stmt->fetch()){
				$stmt->close();
				alog("데이터딕셔너리 UPDATE : " . $tarray["COLID"]);

				//이미 존재
				$to_coltype = "ssiss sssss is i is";
				$sql = "
					update CG_DD set
						COLNM = #{COLNM}, DATATYPE = #{DATATYPE}, DATASIZE = #{DATASIZE}, OBJTYPE = #{OBJTYPE}, LBLWIDTH = #{LBLWIDTH}
						,LBLHEIGHT = #{LBLHEIGHT}, LBLALIGN = #{LBLALIGN},  OBJWIDTH = #{OBJWIDTH}, OBJHEIGHT = #{OBJHEIGHT}, OBJALIGN = #{OBJALIGN}
						, VALIDSEQ = #{VALIDSEQ}, POPUP = #{POPUP}
						,MODDT = date_format(sysdate(),'%Y%m%d%H%i%s'), MODID = #{MODID}
					where PJTSEQ = #{F_PJTSEQ} and COLID = #{COLID}
					";
				
				$stmt = makeStmt($db,$sql, $to_coltype, $tarray);
				if(!$stmt)JsonMsg("500","10U","stmt 생성 실패" . $db->errno . " -> " . $db->error);
				if(!$stmt->execute())JsonMsg("500","11U","(makeGridSearchJson) stmt 실행 실패" . $db->errno . " -> " . $db->error);
				$stmt->close();

			}else{
				$stmt->close();
				alog("데이터딕셔너리 INSERT : " . $tarray["COLID"]);

				//신규 추가
				$to_coltype = "isssi sssss ssis i";
				$sql = "
					insert into CG_DD (
						PJTSEQ, COLID, COLNM, DATATYPE, DATASIZE
						,OBJTYPE, LBLWIDTH, LBLHEIGHT, LBLALIGN, OBJWIDTH
						,OBJHEIGHT, OBJALIGN, VALIDSEQ, POPUP
						,ADDDT, ADDID
					) values (
						#{F_PJTSEQ}, #{COLID}, #{COLNM}, #{DATATYPE}, #{DATASIZE}
						,#{OBJTYPE}, #{LBLWIDTH}, #{LBLHEIGHT}, #{LBLALIGN}, #{OBJWIDTH}
						,#{OBJHEIGHT}, #{OBJALIGN}, #{VALIDSEQ}, #{POPUP}
						,date_format(sysdate(),'%Y%m%d%H%i%s'), #{ADDID}
					)
					";
				
				$stmt = makeStmt($db,$sql, $to_coltype, $tarray);
				if(!$stmt)JsonMsg("500","10I","stmt 생성 실패" . $db->errno . " -> " . $db->error);
				if(!$stmt->execute())JsonMsg("500","11I","(makeGridSearchJson) stmt 실행 실패" . $db->errno . " -> " . $db->error);
				$stmt->close();

			}
			

			//데이터 딕셔너리 오브젝트 타입 등록하기
			$to_coltype = "iss i iss i";
			$sql = "
				insert into CG_DDOBJ (
					DDSEQ,GRPTYPE,OBJTYPE
					,ADDDT, ADDID
				) values (
					#{DDSEQ},#{G1-GRPTYPE},#{OBJTYPE}
					,date_format(sysdate(),'%Y%m%d%H%i%s'), #{ADDID}
				)
				ON DUPLICATE KEY 
					UPDATE DDSEQ = #{DDSEQ}, GRPTYPE = #{G1-GRPTYPE}, OBJTYPE = #{OBJTYPE}
					,MODDT = date_format(sysdate(),'%Y%m%d%H%i%s'), MODID = #{MODID}
				";
			
			$stmt = makeStmt($db,$sql, $to_coltype, $tarray);
			if(!$stmt)JsonMsg("500","10I","[CG_DDOBJ] stmt 생성 실패 " . $db->errno . " -> " . $db->error);
			if(!$stmt->execute())JsonMsg("500","11I","[CG_DDOBJ] stmt 실행 실패 " . $stmt->error);
			$stmt->close();

			
		}

		alog("updateDd.......................................end()");

	}


	/*
	######################################################
	##	FNC
	######################################################
	*/
	public function goFncSearch(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("cg_pgminfo_svc-goFncSearch________________________start");
		//CHARTBAR SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 3; // KEY 컬럼, 

		//조회
		//V_GRPNM : 팀별 현황 (보안취약점 갯수)
		$GRID["SQL"]["R"] = $this->DAO->fncSearch($REQ); //SEARCH, 조회,TEAM
		//암호화컬럼
		$GRID["COLCRYPT"] = array();
		$rtnVal = makeGridSearchJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G2]",microtime(true)));
		//CHARTBAR_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("cg_pgminfo_svc-goFncSearch________________________end");
	}



	public function goFncSave(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("PGMMNGService-goFncSave________________________start");
		//GRID_SAVE____________________________start
		$grpId="FNC";
		$GRID["XML"]=$REQ[$grpId."-XML"];
		$GRID["COLORD"] = "PJTSEQ,PGMSEQ,GRPSEQ,FNCSEQ,USEYN,FNCID,FNCCD,FNCNM,FNCTYPE,FNCORD,ADDDT,MODDT"; //그리드 컬럼순서(Hidden컬럼포함)
		//암호화컬럼
		$GRID["COLCRYPT"] = array();	
		$GRID["KEYCOLID"] = "FNCSEQ";  //KEY컬럼 COLID, 0
		$GRID["SEQYN"] = "Y";  //시퀀스 컬럼 유무
		//저장
		$GRID["SQL"]["D"] = $this->DAO->fncDel($REQ); // SAVE, 저장, PJT
		$GRID["SQL"]["U"] = $this->DAO->fncUpd($REQ); // SAVE, 저장, PJT
		$GRID["SQL"]["C"] = $this->DAO->fncIns($REQ); // SAVE, 저장, PJT

		$tmpVal = makeGridSaveJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME GRP]",microtime(true)));

		$tmpVal->GRPID = $grpId;
		array_push($rtnVal->GRP_DATA, $tmpVal);
		//GRID_SAVE____________________________end


		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("PGMMNGService-goFncSave________________________end");
	}	

	public function goGrpSearch(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("cg_pgminfo_svc-goGrpSearch________________________start");
		//CHARTBAR SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 2; // KEY 컬럼, 

		//조회
		//V_GRPNM : 팀별 현황 (보안취약점 갯수)
		$GRID["SQL"]["R"] = $this->DAO->grpSearch($REQ); //SEARCH, 조회,TEAM
		//암호화컬럼
		$GRID["COLCRYPT"] = array();
		$rtnVal = makeGridSearchJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G2]",microtime(true)));
		//CHARTBAR_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("cg_pgminfo_svc-goGrpSearch________________________end");
	}


	public function goGrpSave(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("PGMMNGService-goGrpSave________________________start");
		//GRID_SAVE____________________________start
		$grpId="GRP";
		$GRID["XML"]=$REQ[$grpId."-XML"];
		$GRID["COLORD"] = "PJTSEQ,PGMSEQ,GRPSEQ,GRPID,GRPTYPE,GRPNM,GRPORD,FREEZECNT,REFGRPID,VBOX,GRPWIDTH,GRPHEIGHT,COLSIZETYPE,LEGENDALIGN,STACKED,PROPERTY,ADDDT,MODDT"; //그리드 컬럼순서(Hidden컬럼포함)
		//암호화컬럼
		$GRID["COLCRYPT"] = array();	
		$GRID["KEYCOLID"] = "GRPSEQ";  //KEY컬럼 COLID, 0
		$GRID["SEQYN"] = "Y";  //시퀀스 컬럼 유무
		//저장
		$GRID["SQL"]["D"] = $this->DAO->grpDel($REQ); // SAVE, 저장, PJT
		$GRID["SQL"]["U"] = $this->DAO->grpUpd($REQ); // SAVE, 저장, PJT
		$GRID["SQL"]["C"] = $this->DAO->grpIns($REQ); // SAVE, 저장, PJT

		$tmpVal = makeGridSaveJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME GRP]",microtime(true)));

		$tmpVal->GRPID = $grpId;
		array_push($rtnVal->GRP_DATA, $tmpVal);
		//GRID_SAVE____________________________end


		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("PGMMNGService-goGrpSave________________________end");
	}	
	
	public function goSqlSearch(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("cg_pgminfo_svc-goSqlSearch________________________start");
		//CHARTBAR SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 2; // KEY 컬럼, 

		//조회
		//V_GRPNM : 팀별 현황 (보안취약점 갯수)
		$GRID["SQL"]["R"] = $this->DAO->sqlSearch($REQ); //SEARCH, 조회,TEAM
		//암호화컬럼
		$GRID["COLCRYPT"] = array();
		$rtnVal = makeGridSearchJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G2]",microtime(true)));
		//CHARTBAR_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("cg_pgminfo_svc-goSqlSearch________________________end");
	}
	
	public function goSqlSave(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("PGMMNGService-goSqlSave________________________start");
		//GRID_SAVE____________________________start
		$grpId="SQL";
		$GRID["XML"]=$REQ[$grpId."-XML"];
		$GRID["COLORD"] = "PJTSEQ,PGMSEQ,SQLSEQ,SQLID,SQLNM,SVRSEQ,CRUD,RTN_TYPE,SQLORD,SQLTXT,ADDDT,MODDT"; //그리드 컬럼순서(Hidden컬럼포함)
		//암호화컬럼
		$GRID["COLCRYPT"] = array();	
		$GRID["KEYCOLID"] = "SQLSEQ";  //KEY컬럼 COLID, 0
		$GRID["SEQYN"] = "Y";  //시퀀스 컬럼 유무
		//저장
		$GRID["SQL"]["D"] = $this->DAO->sqlDel($REQ); // SAVE, 저장, PJT
		$GRID["SQL"]["U"] = $this->DAO->sqlUpd($REQ); // SAVE, 저장, PJT
		$GRID["SQL"]["C"] = $this->DAO->sqlIns($REQ); // SAVE, 저장, PJT

		$tmpVal = makeGridSaveJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME SQL]",microtime(true)));

		$tmpVal->GRPID = $grpId;
		array_push($rtnVal->GRP_DATA, $tmpVal);
		//GRID_SAVE____________________________end





		//SQLD 자동으로 추출하기
		$colord_array = explode(",",$GRID["COLORD"]);

		$xml_array_last = null;
		if(is_assoc($GRID["XML"]["row"]) == 1) {
			$xml_array_last[0] = $GRID["XML"]["row"];
		}else{
			$xml_array_last = $GRID["XML"]["row"];
		}
		//var_dump($xml_array_last);
	
		$RtnVal = null;
		$RtnCnt = 0;
		
		alog("        xml_array_last sizeof : " . sizeof($xml_array_last));
	
		for($i=0;$i<sizeof($xml_array_last);$i++){
	
			$row = $xml_array_last[$i];
			alog("        @attributes : " . $row["@attributes"]["id"]);
			alog("        userdata : " . $row["userdata"]);

			//echo "\n @attributes : ". $row["@attributes"]["id"];
			//echo "\n userdata : ". $row["userdata"];
			//echo "\n cell sizeof : ". sizeof($row["cell"]);
	
			//현재 그리드 line을 bind 배열에 담기
			$to_row = null;
			$to_coltype = null;
			$sql = null;
			for($j=0;$j<sizeof($row["cell"]);$j++){
				$col = $row["cell"][$j];
				if(is_array($col)){
					$to_row[$colord_array[$j]] = "";
				}else{
					$to_row[$colord_array[$j]] = $col;
				}
				//alog("        ★★★ " . $colord_array[$j] . "=" .$col );
			}
			alog("		############################ $i NEW_ID= " . $tmpVal->ROWS[$i]["NEW_ID"]);		
			if($row["userdata"] == "inserted" && !is_numeric($to_row["SQLSEQ"])){
				$to_row["SQLSEQ"] = $tmpVal->ROWS[$i]["NEW_ID"];
			}
			
			//$to_row["SQLSEQ"] = $rtnArr[$i];
	
	
			//SQL 파싱하기
			alog("        SQLTXT : " . $to_row["SQLTXT"]);
	
			$parser = new PHPSQLParser($to_row["SQLTXT"]);
			
			$sql_row = null;
	
			//기존꺼 지우기
			$sql = "delete from CG_PGMSQLD where  PJTSEQ = #{PJTSEQ} and PGMSEQ = #{PGMSEQ} and SQLSEQ = #{SQLSEQ}  ";
			$to_coltype = "iii";
			
			$stmt = makeStmt($this->DB["CG"],$sql, $to_coltype, array_merge($REQ,$to_row));
			//$stmt = make_stmt($db,$sql, $to_coltype, array_merge($REQ,$to_row));
			if(!$stmt) JsonMsg("500","101","stmt 생성 실패" . $this->DB["CG"]->errno . " -> " . $this->DB["CG"]->error);
			$stmt->execute();
			//echo "\n db affected_rows : " .  $db->affected_rows; //stmt를 클로즈 하기 전에 해야
			$to_affected_rows = $this->DB["CG"]->affected_rows;
			$stmt->close();
	
	
			alog("        SELECT절 sizeof : " . sizeof($parser->parsed["SELECT"]) );
			alog("        WHERE절 sizeof : " . sizeof($parser->parsed["WHERE"]) );
	
			//SELECT절이 있을 경우에만
			for($s=0;$s<sizeof($parser->parsed["SELECT"]); $s++){
				alog("  s : " . $s);
				alog("      alias : " . $parser->parsed["SELECT"][$s]["alias"]);
				alog("      alias.name : " . $parser->parsed["SELECT"][$s]["alias"]["name"]);
				alog("      expr_type : " . $parser->parsed["SELECT"][$s]["expr_type"]);            
				alog("      base_expr before : " . $parser->parsed["SELECT"][$s]["base_expr"]);
	
				// A.COLID를 COLID로 변경
				$base_expr = $parser->parsed["SELECT"][$s]["base_expr"];
				$base_expr = strpos($base_expr,".")>0?explode(".",$base_expr)[1]:$base_expr;
	
				//alog("      base_expr after : " . $base_expr);
				$sql_row["COLID"] = is_array($parser->parsed["SELECT"][$s]["alias"])?$parser->parsed["SELECT"][$s]["alias"]["name"]:$base_expr;
				$sql_row["DDCOLID"] = $sql_row["COLID"];
	
				alog("            OUTPUT 절 $s :  " . $sql_row["COLID"] );
				$sql_row["SQLGBN"] = "O";
				$sql_row["ORD"] = ($s+1) * 10;
				$sql = "insert into CG_PGMSQLD (
						PJTSEQ, PGMSEQ, SQLSEQ, SQLGBN, COLID
						, DDCOLID, ORD
						, ADDDT
					)values(
						#{PJTSEQ}, #{PGMSEQ}, #{SQLSEQ}, #{SQLGBN}, #{COLID}
						, #{DDCOLID}, #{ORD}
						, date_format(sysdate(),'%Y%m%d%H%i%s')
					)
				";
				$to_coltype = "iiiss si";
	
				$stmt = makeStmt($this->DB["CG"],$sql, $to_coltype, array_merge($REQ,$to_row,$sql_row));
				if(!$stmt)JsonMsg("500","102","stmt 생성 실패" . $this->DB["CG"]->errno . " -> " . $this->DB["CG"]->error);
				$stmt->execute();
				//echo "\n db affected_rows : " .  $db->affected_rows; //stmt를 클로즈 하기 전에 해야
				$to_affected_rows = $this->DB["CG"]->affected_rows;
				$stmt->close();
	
			}
	
			//WHERE절이 있을 경우에만
			$to_sql = $to_row["SQLTXT"];
			$s=0;
			//정규식에서 .를 검색할때는 []안에 인수 값중에 맨뒤에 가면 동작안함.
			while(preg_match("/(#{)([\.a-zA-Z0-9_-]+)(})/",$to_sql,$mat)){
				//alog("org : " . HtmlEncode($org));
				//alog("매칭0 : " . $mat[0]);
				//alog("매칭1 : " . $mat[1]);
				//alog("매칭2 : " . $mat[2]);
				//alog("매칭3 : " . $mat[3]);
				//alog("매칭4 : " . $mat[4]);
	
	
				$sql_row["COLID"] = $mat[2];
				$sql_row["DDCOLID"] = ( strpos($sql_row["COLID"],"-") > 0 )?explode("-",$sql_row["COLID"])[1]:$sql_row["COLID"];
							
				$to_sql = str_replace_once($mat[1].$mat[2].$mat[3],"?",$to_sql); //방금 찾은겨 치환
	
				alog("            INPUT 절 $s :  " . $sql_row["COLID"] );
				$sql_row["SQLGBN"] = "I";
				$sql_row["ORD"] = ($s+1) * 10;
				$sql = "insert into CG_PGMSQLD (
						PJTSEQ,PGMSEQ,SQLSEQ,SQLGBN,COLID
						, DDCOLID, ORD
						,ADDDT
					)values(
						#{PJTSEQ},#{PGMSEQ},#{SQLSEQ},#{SQLGBN},#{COLID}
						, #{DDCOLID}, #{ORD}
						,date_format(sysdate(),'%Y%m%d%H%i%s')
					)
				";
				$to_coltype = "iiiss si";
	
				$stmt = makeStmt($this->DB["CG"],$sql, $to_coltype, array_merge($REQ,$to_row,$sql_row));
				if(!$stmt) JsonMsg("500","103","stmt 생성 실패 " . $this->DB["CG"]->errno . " -> " . $this->DB["CG"]->error);
				$stmt->execute();
				//echo "\n db affected_rows : " .  $db->affected_rows; //stmt를 클로즈 하기 전에 해야
				$to_affected_rows = $this->DB["CG"]->affected_rows;
				$stmt->close();
	
				$s++;
				//echo "\ntosql : " . $tosql;
				//exit;
			}
		}






		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("PGMMNGService-goSqlSave________________________end");
	}		
}
                                                             
?>