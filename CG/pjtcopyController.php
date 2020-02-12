<?php
header("Content-Type: text/html; charset=UTF-8"); //SVRCTL
header("Cache-Control:no-cache");
header("Pragma:no-cache");
$_RTIME = array();
array_push($_RTIME,array("[TIME 00.START]",microtime(true)));
$CFG = require_once('../../common/include/incConfig.php');//CG CONFIG
require_once($CFG["CFG_LIBS_VENDOR"]);
require_once('pjtcopyService.php');

array_push($_RTIME,array("[TIME 10.INCLUDE SERVICE]",microtime(true)));
require_once('../../common/include/incUtil.php');//CG UTIL
require_once('../../common/include/incRequest.php');//CG REQUEST
require_once('../../common/include/incDB.php');//CG DB
require_once('../../common/include/incSec.php');//CG SEC
require_once('../../common/include/incAuth.php');//CG AUTH
require_once('../../common/include/incUser.php');//CG USER
//하위에서 LOADDING LIB 처리
array_push($_RTIME,array("[TIME 20.IMPORT]",microtime(true)));
$reqToken = reqGetString("TOKEN",37);
$resToken = uniqid();

$log = getLogger(
	array(
	"LIST_NM"=>"log_CG"
	, "PGM_ID"=>"PJTCOPY"
	, "REQTOKEN" => $reqToken
	, "RESTOKEN" => $resToken
	, "LOG_LEVEL" => Monolog\Logger::ERROR
	)
);
$log->info("PjtcopyControl___________________________start");
$objAuth = new authObject();


//컨트롤 명령 받기
$ctl = "";
$ctl1 = reqGetString("CTLGRP",50);
$ctl2 = reqGetString("CTLFNC",50);


if($ctl1 == "" || $ctl2 == ""){
	JsonMsg("500","100","처리 명령이 잘못되었습니다.(no input ctl)");
}else{
	$ctl = $ctl1 . "_" . $ctl2;
}
//로그인 : 권한정보 검사하기 in_array("aix", $os)
if(!isLogin()){
	JsonMsg("500","110"," 로그아웃되었습니다.");
}else if(!$objAuth->isOneConnection()){
	logOut();
	JsonMsg("500","120"," 다른기기(PC,브라우저 등)에서 로그인하였습니다. 다시로그인 후 사용해 주세요.");
}else if($objAuth->isAuth("PJTCOPY",$ctl)){
	$objAuth->LAUTH_SEQ = $objAuth->logUsrAuth($reqToken,$resToken,"PJTCOPY",$ctl,"Y");
}else{
	$objAuth->logUsrAuth($reqToken,$resToken,"PJTCOPY",$ctl,"N");
	JsonMsg("500","120",$ctl . " 권한이 없습니다.");
}
		//사용자 정보 가져오기
	$REQ["USER.SEQ"] = getUserSeq();
//로그 저장 방식 결정
//일반로그, 권한변경로그, PI로그
//NORMAL, POWER, PI
$PGM_CFG["SECTYPE"] = "NORMAL";
$PGM_CFG["SQLTXT"] = array();
array_push($_RTIME,array("[TIME 30.AUTH_CHECK]",microtime(true)));

//FILE먼저 : G1, 
//FILE먼저 : G2, from CFG
//FILE먼저 : G3, from FILE
//FILE먼저 : G4, to CFG
//FILE먼저 : G5, to FILE

//G1, 
$REQ["G1-FROM_PJTSEQ"] = reqPostNumber("G1-FROM_PJTSEQ",20);//FROM_PJTSEQ	
$REQ["G1-FROM_PJTSEQ"] = getFilter($REQ["G1-FROM_PJTSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G1-TO_PJTSEQ"] = reqPostNumber("G1-TO_PJTSEQ",20);//TO_PJTSEQ	
$REQ["G1-TO_PJTSEQ"] = getFilter($REQ["G1-TO_PJTSEQ"],"REGEXMAT","/^[0-9]+$/");	

//G2, from CFG
$REQ["G2-CHKEDIT"] = reqPostNumber("G2-CHKEDIT",1);//CHK	
$REQ["G2-CHKEDIT"] = getFilter($REQ["G2-CHKEDIT"],"REGEXMAT","/^([0-9a-zA-Z]|,)+$/");	
$REQ["G2-PJTSEQ"] = reqPostNumber("G2-PJTSEQ",20);//PJTSEQ	
$REQ["G2-PJTSEQ"] = getFilter($REQ["G2-PJTSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-CFGSEQ"] = reqPostNumber("G2-CFGSEQ",30);//SEQ	
$REQ["G2-CFGSEQ"] = getFilter($REQ["G2-CFGSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-USEYN"] = reqPostString("G2-USEYN",1);//사용	
$REQ["G2-USEYN"] = getFilter($REQ["G2-USEYN"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G2-CFGID"] = reqPostString("G2-CFGID",30);//CFGID	
$REQ["G2-CFGID"] = getFilter($REQ["G2-CFGID"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-CFGNM"] = reqPostString("G2-CFGNM",100);//CFGNM	
$REQ["G2-CFGNM"] = getFilter($REQ["G2-CFGNM"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-MVCGBN"] = reqPostString("G2-MVCGBN",30);//MVCGBN	
$REQ["G2-MVCGBN"] = getFilter($REQ["G2-MVCGBN"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-PATH"] = reqPostString("G2-PATH",300);//PATH	
$REQ["G2-PATH"] = getFilter($REQ["G2-PATH"],"SAFETEXT","/--미 정의--/");	
$REQ["G2-CFGORD"] = reqPostNumber("G2-CFGORD",30);//ORD	
$REQ["G2-CFGORD"] = getFilter($REQ["G2-CFGORD"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-ADDDT"] = reqPostString("G2-ADDDT",14);//ADDDT	
$REQ["G2-ADDDT"] = getFilter($REQ["G2-ADDDT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-MODDT"] = reqPostString("G2-MODDT",14);//MODDT	
$REQ["G2-MODDT"] = getFilter($REQ["G2-MODDT"],"REGEXMAT","/^[0-9]+$/");	

//G3, from FILE
$REQ["G3-CHKEDIT"] = reqPostNumber("G3-CHKEDIT",1);//CHK	
$REQ["G3-CHKEDIT"] = getFilter($REQ["G3-CHKEDIT"],"REGEXMAT","/^([0-9a-zA-Z]|,)+$/");	
$REQ["G3-PJTSEQ"] = reqPostNumber("G3-PJTSEQ",20);//PJTSEQ	
$REQ["G3-PJTSEQ"] = getFilter($REQ["G3-PJTSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-FILESEQ"] = reqPostString("G3-FILESEQ",30);//FILESEQ	
$REQ["G3-FILESEQ"] = getFilter($REQ["G3-FILESEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-MKFILETYPE"] = reqPostString("G3-MKFILETYPE",200);//파일타입	
$REQ["G3-MKFILETYPE"] = getFilter($REQ["G3-MKFILETYPE"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-MKFILETYPENM"] = reqPostString("G3-MKFILETYPENM",200);//타입명	
$REQ["G3-MKFILETYPENM"] = getFilter($REQ["G3-MKFILETYPENM"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-MKFILEFORMAT"] = reqPostString("G3-MKFILEFORMAT",200);//포멧	
$REQ["G3-MKFILEFORMAT"] = getFilter($REQ["G3-MKFILEFORMAT"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-MKFILEEXT"] = reqPostString("G3-MKFILEEXT",100);//확장자	
$REQ["G3-MKFILEEXT"] = getFilter($REQ["G3-MKFILEEXT"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-TEMPLATE"] = reqPostString("G3-TEMPLATE",200);//템플릿	
$REQ["G3-TEMPLATE"] = getFilter($REQ["G3-TEMPLATE"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-FILEORD"] = reqPostString("G3-FILEORD",10);//순번	
$REQ["G3-FILEORD"] = getFilter($REQ["G3-FILEORD"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-USEYN"] = reqPostString("G3-USEYN",1);//사용	
$REQ["G3-USEYN"] = getFilter($REQ["G3-USEYN"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G3-ADDDT"] = reqPostString("G3-ADDDT",14);//ADDDT	
$REQ["G3-ADDDT"] = getFilter($REQ["G3-ADDDT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-MODDT"] = reqPostString("G3-MODDT",14);//MODDT	
$REQ["G3-MODDT"] = getFilter($REQ["G3-MODDT"],"REGEXMAT","/^[0-9]+$/");	

//G4, to CFG
$REQ["G4-PJTSEQ"] = reqPostNumber("G4-PJTSEQ",20);//PJTSEQ	
$REQ["G4-PJTSEQ"] = getFilter($REQ["G4-PJTSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G4-CFGSEQ"] = reqPostNumber("G4-CFGSEQ",30);//SEQ	
$REQ["G4-CFGSEQ"] = getFilter($REQ["G4-CFGSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G4-USEYN"] = reqPostString("G4-USEYN",1);//사용	
$REQ["G4-USEYN"] = getFilter($REQ["G4-USEYN"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G4-CFGID"] = reqPostString("G4-CFGID",30);//CFGID	
$REQ["G4-CFGID"] = getFilter($REQ["G4-CFGID"],"CLEARTEXT","/--미 정의--/");	
$REQ["G4-CFGNM"] = reqPostString("G4-CFGNM",100);//CFGNM	
$REQ["G4-CFGNM"] = getFilter($REQ["G4-CFGNM"],"CLEARTEXT","/--미 정의--/");	
$REQ["G4-MVCGBN"] = reqPostString("G4-MVCGBN",30);//MVCGBN	
$REQ["G4-MVCGBN"] = getFilter($REQ["G4-MVCGBN"],"CLEARTEXT","/--미 정의--/");	
$REQ["G4-PATH"] = reqPostString("G4-PATH",300);//PATH	
$REQ["G4-PATH"] = getFilter($REQ["G4-PATH"],"SAFETEXT","/--미 정의--/");	
$REQ["G4-CFGORD"] = reqPostNumber("G4-CFGORD",30);//ORD	
$REQ["G4-CFGORD"] = getFilter($REQ["G4-CFGORD"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G4-ADDDT"] = reqPostString("G4-ADDDT",14);//ADDDT	
$REQ["G4-ADDDT"] = getFilter($REQ["G4-ADDDT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G4-MODDT"] = reqPostString("G4-MODDT",14);//MODDT	
$REQ["G4-MODDT"] = getFilter($REQ["G4-MODDT"],"REGEXMAT","/^[0-9]+$/");	

//G5, to FILE
$REQ["G5-PJTSEQ"] = reqPostNumber("G5-PJTSEQ",20);//PJTSEQ	
$REQ["G5-PJTSEQ"] = getFilter($REQ["G5-PJTSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G5-FILESEQ"] = reqPostString("G5-FILESEQ",30);//FILESEQ	
$REQ["G5-FILESEQ"] = getFilter($REQ["G5-FILESEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G5-MKFILETYPE"] = reqPostString("G5-MKFILETYPE",0);//파일타입	
$REQ["G5-MKFILETYPE"] = getFilter($REQ["G5-MKFILETYPE"],"CLEARTEXT","/--미 정의--/");	
$REQ["G5-MKFILETYPENM"] = reqPostString("G5-MKFILETYPENM",0);//타입명	
$REQ["G5-MKFILETYPENM"] = getFilter($REQ["G5-MKFILETYPENM"],"CLEARTEXT","/--미 정의--/");	
$REQ["G5-MKFILEFORMAT"] = reqPostString("G5-MKFILEFORMAT",0);//포멧	
$REQ["G5-MKFILEFORMAT"] = getFilter($REQ["G5-MKFILEFORMAT"],"CLEARTEXT","/--미 정의--/");	
$REQ["G5-MKFILEEXT"] = reqPostString("G5-MKFILEEXT",0);//확장자	
$REQ["G5-MKFILEEXT"] = getFilter($REQ["G5-MKFILEEXT"],"CLEARTEXT","/--미 정의--/");	
$REQ["G5-TEMPLATE"] = reqPostString("G5-TEMPLATE",0);//템플릿	
$REQ["G5-TEMPLATE"] = getFilter($REQ["G5-TEMPLATE"],"CLEARTEXT","/--미 정의--/");	
$REQ["G5-FILEORD"] = reqPostString("G5-FILEORD",10);//순번	
$REQ["G5-FILEORD"] = getFilter($REQ["G5-FILEORD"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G5-USEYN"] = reqPostString("G5-USEYN",1);//사용	
$REQ["G5-USEYN"] = getFilter($REQ["G5-USEYN"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G5-ADDDT"] = reqPostString("G5-ADDDT",14);//ADDDT	
$REQ["G5-ADDDT"] = getFilter($REQ["G5-ADDDT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G5-MODDT"] = reqPostString("G5-MODDT",14);//MODDT	
$REQ["G5-MODDT"] = getFilter($REQ["G5-MODDT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-XML"] = getXml2Array($_POST["G2-XML"]);//from CFG	
	$REQ["G3-XML"] = getXml2Array($_POST["G3-XML"]);//from FILE	
	$REQ["G4-XML"] = getXml2Array($_POST["G4-XML"]);//to CFG	
	$REQ["G5-XML"] = getXml2Array($_POST["G5-XML"]);//to FILE	
	//,  입력값 필터 
	$REQ["G2-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G2-XML"]
		,"COLORD"=>"CHKEDIT,PJTSEQ,CFGSEQ,USEYN,CFGID,CFGNM,MVCGBN,PATH,CFGORD,ADDDT,MODDT"
		,"VALID"=>
			array(
			"CHKEDIT"=>array("NUMBER",1)	
			,"PJTSEQ"=>array("NUMBER",20)	
			,"CFGSEQ"=>array("NUMBER",30)	
			,"USEYN"=>array("STRING",1)	
			,"CFGID"=>array("STRING",30)	
			,"CFGNM"=>array("STRING",100)	
			,"MVCGBN"=>array("STRING",30)	
			,"PATH"=>array("STRING",300)	
			,"CFGORD"=>array("NUMBER",30)	
			,"ADDDT"=>array("STRING",14)	
			,"MODDT"=>array("STRING",14)	
					)
		,"FILTER"=>
			array(
			"CHKEDIT"=>array("REGEXMAT","/^([0-9a-zA-Z]|,)+$/")
			,"PJTSEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"CFGSEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"USEYN"=>array("REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/")
			,"CFGID"=>array("CLEARTEXT","/--미 정의--/")
			,"CFGNM"=>array("CLEARTEXT","/--미 정의--/")
			,"MVCGBN"=>array("CLEARTEXT","/--미 정의--/")
			,"PATH"=>array("SAFETEXT","/--미 정의--/")
			,"CFGORD"=>array("REGEXMAT","/^[0-9]+$/")
			,"ADDDT"=>array("REGEXMAT","/^[0-9]+$/")
			,"MODDT"=>array("REGEXMAT","/^[0-9]+$/")
					)
	)
);
$REQ["G3-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G3-XML"]
		,"COLORD"=>"CHKEDIT,PJTSEQ,FILESEQ,MKFILETYPE,MKFILETYPENM,MKFILEFORMAT,MKFILEEXT,TEMPLATE,FILEORD,USEYN,ADDDT,MODDT"
		,"VALID"=>
			array(
			"CHKEDIT"=>array("NUMBER",1)	
			,"PJTSEQ"=>array("NUMBER",20)	
			,"FILESEQ"=>array("STRING",30)	
			,"MKFILETYPE"=>array("STRING",200)	
			,"MKFILETYPENM"=>array("STRING",200)	
			,"MKFILEFORMAT"=>array("STRING",200)	
			,"MKFILEEXT"=>array("STRING",100)	
			,"TEMPLATE"=>array("STRING",200)	
			,"FILEORD"=>array("STRING",10)	
			,"USEYN"=>array("STRING",1)	
			,"ADDDT"=>array("STRING",14)	
			,"MODDT"=>array("STRING",14)	
					)
		,"FILTER"=>
			array(
			"CHKEDIT"=>array("REGEXMAT","/^([0-9a-zA-Z]|,)+$/")
			,"PJTSEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"FILESEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"MKFILETYPE"=>array("CLEARTEXT","/--미 정의--/")
			,"MKFILETYPENM"=>array("CLEARTEXT","/--미 정의--/")
			,"MKFILEFORMAT"=>array("CLEARTEXT","/--미 정의--/")
			,"MKFILEEXT"=>array("CLEARTEXT","/--미 정의--/")
			,"TEMPLATE"=>array("CLEARTEXT","/--미 정의--/")
			,"FILEORD"=>array("REGEXMAT","/^[0-9]+$/")
			,"USEYN"=>array("REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/")
			,"ADDDT"=>array("REGEXMAT","/^[0-9]+$/")
			,"MODDT"=>array("REGEXMAT","/^[0-9]+$/")
					)
	)
);
$REQ["G4-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G4-XML"]
		,"COLORD"=>"PJTSEQ,CFGSEQ,USEYN,CFGID,CFGNM,MVCGBN,PATH,CFGORD,ADDDT,MODDT"
		,"VALID"=>
			array(
			"PJTSEQ"=>array("NUMBER",20)	
			,"CFGSEQ"=>array("NUMBER",30)	
			,"USEYN"=>array("STRING",1)	
			,"CFGID"=>array("STRING",30)	
			,"CFGNM"=>array("STRING",100)	
			,"MVCGBN"=>array("STRING",30)	
			,"PATH"=>array("STRING",300)	
			,"CFGORD"=>array("NUMBER",30)	
			,"ADDDT"=>array("STRING",14)	
			,"MODDT"=>array("STRING",14)	
					)
		,"FILTER"=>
			array(
			"PJTSEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"CFGSEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"USEYN"=>array("REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/")
			,"CFGID"=>array("CLEARTEXT","/--미 정의--/")
			,"CFGNM"=>array("CLEARTEXT","/--미 정의--/")
			,"MVCGBN"=>array("CLEARTEXT","/--미 정의--/")
			,"PATH"=>array("SAFETEXT","/--미 정의--/")
			,"CFGORD"=>array("REGEXMAT","/^[0-9]+$/")
			,"ADDDT"=>array("REGEXMAT","/^[0-9]+$/")
			,"MODDT"=>array("REGEXMAT","/^[0-9]+$/")
					)
	)
);
$REQ["G5-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G5-XML"]
		,"COLORD"=>"PJTSEQ,FILESEQ,MKFILETYPE,MKFILETYPENM,MKFILEFORMAT,MKFILEEXT,TEMPLATE,FILEORD,USEYN,ADDDT,MODDT"
		,"VALID"=>
			array(
			"PJTSEQ"=>array("NUMBER",20)	
			,"FILESEQ"=>array("STRING",30)	
			,"MKFILETYPE"=>array("STRING",0)	
			,"MKFILETYPENM"=>array("STRING",0)	
			,"MKFILEFORMAT"=>array("STRING",0)	
			,"MKFILEEXT"=>array("STRING",0)	
			,"TEMPLATE"=>array("STRING",0)	
			,"FILEORD"=>array("STRING",10)	
			,"USEYN"=>array("STRING",1)	
			,"ADDDT"=>array("STRING",14)	
			,"MODDT"=>array("STRING",14)	
					)
		,"FILTER"=>
			array(
			"PJTSEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"FILESEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"MKFILETYPE"=>array("CLEARTEXT","/--미 정의--/")
			,"MKFILETYPENM"=>array("CLEARTEXT","/--미 정의--/")
			,"MKFILEFORMAT"=>array("CLEARTEXT","/--미 정의--/")
			,"MKFILEEXT"=>array("CLEARTEXT","/--미 정의--/")
			,"TEMPLATE"=>array("CLEARTEXT","/--미 정의--/")
			,"FILEORD"=>array("REGEXMAT","/^[0-9]+$/")
			,"USEYN"=>array("REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/")
			,"ADDDT"=>array("REGEXMAT","/^[0-9]+$/")
			,"MODDT"=>array("REGEXMAT","/^[0-9]+$/")
					)
	)
);
array_push($_RTIME,array("[TIME 40.REQ_VALID]",microtime(true)));
	//서비스 클래스 생성
$objService = new pjtcopyService();
	//컨트롤 명령별 분개처리
$log->info("ctl:" . $ctl);
switch ($ctl){
		case "G1_SEARCHALL" :
  		echo $objService->goG1Searchall(); //, 조회(전체)
  		break;
	case "G1_SAVE" :
  		echo $objService->goG1Save(); //, 저장
  		break;
	case "G2_SEARCH" :
  		echo $objService->goG2Search(); //from CFG, 조회
  		break;
	case "G2_SAVE" :
  		echo $objService->goG2Save(); //from CFG, Copy
  		break;
	case "G3_SEARCH" :
  		echo $objService->goG3Search(); //from FILE, 조회
  		break;
	case "G3_SAVE" :
  		echo $objService->goG3Save(); //from FILE, Copy
  		break;
	case "G4_SEARCH" :
  		echo $objService->goG4Search(); //to CFG, 조회
  		break;
	case "G4_SAVE" :
  		echo $objService->goG4Save(); //to CFG, 저장
  		break;
	case "G4_CHKSAVE" :
  		echo $objService->goG4Chksave(); //to CFG, 선택저장
  		break;
	case "G5_SEARCH" :
  		echo $objService->goG5Search(); //to FILE, 조회
  		break;
	case "G5_SAVE" :
  		echo $objService->goG5Save(); //to FILE, 저장
  		break;
	case "G5_CHKSAVE" :
  		echo $objService->goG5Chksave(); //to FILE, 선택저장
  		break;
	default:
		JsonMsg("500","110","처리 명령을 찾을 수 없습니다. (no search ctl)");
		break;
}
	array_push($_RTIME,array("[TIME 50.SVC]",microtime(true)));
if($PGM_CFG["SECTYPE"] == "POWER" || $PGM_CFG["SECTYPE"] == "PI") $objAuth->logUsrAuthD($reqToken,$resToken);;	//권한변경 로그 저장
	array_push($_RTIME,array("[TIME 60.AUGHD_LOG]",microtime(true)));
//실행시간 검사
for($j=1;$j<sizeof($_RTIME);$j++){
	$log->debug( $_RTIME[$j][0] . " " . number_format($_RTIME[$j][1]-$_RTIME[$j-1][1],4) );

	if($j == sizeof($_RTIME)-1) $log->debug( "RUN TIME : " . number_format($_RTIME[$j][1]-$_RTIME[0][1],4) );
}
//서비스 클래스 비우기
unset($objService);
unset($objAuth);

$log->info("PjtcopyControl___________________________end");
$log->close(); unset($log);
?>
