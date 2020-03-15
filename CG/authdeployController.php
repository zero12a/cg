<?php
header("Content-Type: text/html; charset=UTF-8"); //SVRCTL
header("Cache-Control:no-cache");
header("Pragma:no-cache");
$_RTIME = array();
array_push($_RTIME,array("[TIME 00.START]",microtime(true)));
$CFG = require_once('../../common/include/incConfig.php');//CG CONFIG
require_once($CFG["CFG_LIBS_VENDOR"]);
require_once('authdeployService.php');

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
	, "PGM_ID"=>"AUTHDEPLOY"
	, "REQTOKEN" => $reqToken
	, "RESTOKEN" => $resToken
	, "LOG_LEVEL" => Monolog\Logger::ERROR
	)
);
$log->info("AuthdeployControl___________________________start");
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
}else if($objAuth->isAuth("AUTHDEPLOY",$ctl)){
	$objAuth->LAUTH_SEQ = $objAuth->logUsrAuth($reqToken,$resToken,"AUTHDEPLOY",$ctl,"Y");
}else{
	$objAuth->logUsrAuth($reqToken,$resToken,"AUTHDEPLOY",$ctl,"N");
	JsonMsg("500","120",$ctl . " 권한이 없습니다.");
}
		//사용자 정보 가져오기
//로그 저장 방식 결정
//일반로그, 권한변경로그, PI로그
//NORMAL, POWER, PI
$PGM_CFG["SECTYPE"] = "POWER";
$PGM_CFG["SQLTXT"] = array();
array_push($_RTIME,array("[TIME 30.AUTH_CHECK]",microtime(true)));

//FILE먼저 : G1, 
//FILE먼저 : G2, PGM
//FILE먼저 : G3, SVC MENU
//FILE먼저 : G4, AUTH
//FILE먼저 : G5, SVC AUTH

//G1,  - RW속성 오브젝트만 필터 적용 ( RO속성은 제외 )
$REQ["G1-PJTSEQ"] = reqPostNumber("G1-PJTSEQ",20);//PJTSEQ	
$REQ["G1-PJTSEQ"] = getFilter($REQ["G1-PJTSEQ"],"REGEXMAT","/^[0-9]+$/");	

//G2, PGM - RW속성 오브젝트만 필터 적용 ( RO속성은 제외 )
$REQ["G2-ROWCHKUP"] = reqPostNumber("G2-ROWCHKUP",1);//CHK	
$REQ["G2-ROWCHKUP"] = getFilter($REQ["G2-ROWCHKUP"],"REGEXMAT","/^([0-9a-zA-Z]|,)+$/");	
$REQ["G2-PGMSEQ"] = reqPostNumber("G2-PGMSEQ",30);//PGMSEQ	
$REQ["G2-PGMSEQ"] = getFilter($REQ["G2-PGMSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-PGMID"] = reqPostString("G2-PGMID",20);//프로그램ID	
$REQ["G2-PGMID"] = getFilter($REQ["G2-PGMID"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G2-PGMNM"] = reqPostString("G2-PGMNM",50);//프로그램이름	
$REQ["G2-PGMNM"] = getFilter($REQ["G2-PGMNM"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-PKGGRP"] = reqPostString("G2-PKGGRP",15);//PKGGRP	
$REQ["G2-PKGGRP"] = getFilter($REQ["G2-PKGGRP"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-VIEWURL"] = reqPostString("G2-VIEWURL",30);//VIEWURL	
$REQ["G2-VIEWURL"] = getFilter($REQ["G2-VIEWURL"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-PGMTYPE"] = reqPostString("G2-PGMTYPE",10);//PGMTYPE	
$REQ["G2-PGMTYPE"] = getFilter($REQ["G2-PGMTYPE"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-SECTYPE"] = reqPostString("G2-SECTYPE",10);//SECTYPE	
$REQ["G2-SECTYPE"] = getFilter($REQ["G2-SECTYPE"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G2-ADDDT"] = reqPostString("G2-ADDDT",14);//ADDDT	
$REQ["G2-ADDDT"] = getFilter($REQ["G2-ADDDT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-MODDT"] = reqPostString("G2-MODDT",14);//MODDT	
$REQ["G2-MODDT"] = getFilter($REQ["G2-MODDT"],"REGEXMAT","/^[0-9]+$/");	

//G3, SVC MENU - RW속성 오브젝트만 필터 적용 ( RO속성은 제외 )
$REQ["G3-MNU_SEQ"] = reqPostString("G3-MNU_SEQ",20);//MNU_SEQ	
$REQ["G3-MNU_SEQ"] = getFilter($REQ["G3-MNU_SEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-MNU_NM"] = reqPostString("G3-MNU_NM",30);//MNU_NM	
$REQ["G3-MNU_NM"] = getFilter($REQ["G3-MNU_NM"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-PGMID"] = reqPostString("G3-PGMID",20);//프로그램ID	
$REQ["G3-PGMID"] = getFilter($REQ["G3-PGMID"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G3-URL"] = reqPostString("G3-URL",50);//URL	
$REQ["G3-URL"] = getFilter($REQ["G3-URL"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-PGMTYPE"] = reqPostString("G3-PGMTYPE",10);//PGMTYPE	
$REQ["G3-PGMTYPE"] = getFilter($REQ["G3-PGMTYPE"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-MNU_ORD"] = reqPostString("G3-MNU_ORD",30);//MNU_ORD	
$REQ["G3-MNU_ORD"] = getFilter($REQ["G3-MNU_ORD"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-FOLDER_SEQ"] = reqPostNumber("G3-FOLDER_SEQ",30);//FOLDER_SEQ	
$REQ["G3-FOLDER_SEQ"] = getFilter($REQ["G3-FOLDER_SEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-USE_YN"] = reqPostString("G3-USE_YN",1);//USE_YN	
$REQ["G3-USE_YN"] = getFilter($REQ["G3-USE_YN"],"SAFETEXT","/--미 정의--/");	
$REQ["G3-ADD_DT"] = reqPostString("G3-ADD_DT",14);//ADD	
$REQ["G3-ADD_DT"] = getFilter($REQ["G3-ADD_DT"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-ADD_ID"] = reqPostString("G3-ADD_ID",30);//ADD_ID	
$REQ["G3-ADD_ID"] = getFilter($REQ["G3-ADD_ID"],"SAFETEXT","/--미 정의--/");	
$REQ["G3-MOD_DT"] = reqPostString("G3-MOD_DT",14);//MOD	
$REQ["G3-MOD_DT"] = getFilter($REQ["G3-MOD_DT"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-MOD_ID"] = reqPostString("G3-MOD_ID",30);//MOD_ID	
$REQ["G3-MOD_ID"] = getFilter($REQ["G3-MOD_ID"],"SAFETEXT","/--미 정의--/");	

//G4, AUTH - RW속성 오브젝트만 필터 적용 ( RO속성은 제외 )
$REQ["G4-CHK"] = reqPostNumber("G4-CHK",1);//CHK	
$REQ["G4-CHK"] = getFilter($REQ["G4-CHK"],"REGEXMAT","/^([0-9a-zA-Z]|,)+$/");	
$REQ["G4-ROWID"] = reqPostString("G4-ROWID",40);//ROWID	
$REQ["G4-ROWID"] = getFilter($REQ["G4-ROWID"],"SAFETEXT","/--미 정의--/");	
$REQ["G4-PGMID"] = reqPostString("G4-PGMID",20);//프로그램ID	
$REQ["G4-PGMID"] = getFilter($REQ["G4-PGMID"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G4-AUTH_ID"] = reqPostString("G4-AUTH_ID",50);//AUTH_ID	
$REQ["G4-AUTH_ID"] = getFilter($REQ["G4-AUTH_ID"],"REGEXMAT","/^[a-zA-Z]{1}[_a-zA-Z0-9]*$/");	
$REQ["G4-AUTH_NM"] = reqPostString("G4-AUTH_NM",50);//AUTH_NM	
$REQ["G4-AUTH_NM"] = getFilter($REQ["G4-AUTH_NM"],"SAFETEXT","/--미 정의--/");	
$REQ["G4-ADDDT"] = reqPostString("G4-ADDDT",14);//ADDDT	
$REQ["G4-ADDDT"] = getFilter($REQ["G4-ADDDT"],"REGEXMAT","/^[0-9]+$/");	

//G5, SVC AUTH - RW속성 오브젝트만 필터 적용 ( RO속성은 제외 )
$REQ["G5-AUTH_SEQ"] = reqPostNumber("G5-AUTH_SEQ",10);//AUTH_SEQ	
$REQ["G5-AUTH_SEQ"] = getFilter($REQ["G5-AUTH_SEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G5-PGMID"] = reqPostString("G5-PGMID",20);//프로그램ID	
$REQ["G5-PGMID"] = getFilter($REQ["G5-PGMID"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G5-AUTH_ID"] = reqPostString("G5-AUTH_ID",50);//AUTH_ID	
$REQ["G5-AUTH_ID"] = getFilter($REQ["G5-AUTH_ID"],"REGEXMAT","/^[a-zA-Z]{1}[_a-zA-Z0-9]*$/");	
$REQ["G5-AUTH_NM"] = reqPostString("G5-AUTH_NM",50);//AUTH_NM	
$REQ["G5-AUTH_NM"] = getFilter($REQ["G5-AUTH_NM"],"SAFETEXT","/--미 정의--/");	
$REQ["G5-USE_YN"] = reqPostString("G5-USE_YN",1);//USE_YN	
$REQ["G5-USE_YN"] = getFilter($REQ["G5-USE_YN"],"SAFETEXT","/--미 정의--/");	
$REQ["G5-ADD_DT"] = reqPostString("G5-ADD_DT",14);//ADD	
$REQ["G5-ADD_DT"] = getFilter($REQ["G5-ADD_DT"],"CLEARTEXT","/--미 정의--/");	
$REQ["G5-MOD_DT"] = reqPostString("G5-MOD_DT",14);//MOD	
$REQ["G5-MOD_DT"] = getFilter($REQ["G5-MOD_DT"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-XML"] = getXml2Array($_POST["G2-XML"]);//PGM	
$REQ["G3-XML"] = getXml2Array($_POST["G3-XML"]);//SVC MENU	
$REQ["G4-XML"] = getXml2Array($_POST["G4-XML"]);//AUTH	
$REQ["G5-XML"] = getXml2Array($_POST["G5-XML"]);//SVC AUTH	
//,  입력값 필터 
	$REQ["G2-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G2-XML"]
		,"COLORD"=>"ROWCHKUP,PGMSEQ,PGMID,PGMNM,PKGGRP,VIEWURL,PGMTYPE,SECTYPE,ADDDT,MODDT"
		,"VALID"=>
			array(
			"ROWCHKUP"=>array("NUMBER",1)	
			,"PGMSEQ"=>array("NUMBER",30)	
			,"PGMID"=>array("STRING",20)	
			,"PGMNM"=>array("STRING",50)	
			,"PKGGRP"=>array("STRING",15)	
			,"VIEWURL"=>array("STRING",30)	
			,"PGMTYPE"=>array("STRING",10)	
			,"SECTYPE"=>array("STRING",10)	
			,"ADDDT"=>array("STRING",14)	
			,"MODDT"=>array("STRING",14)	
					)
		,"FILTER"=>
			array(
			"ROWCHKUP"=>array("REGEXMAT","/^([0-9a-zA-Z]|,)+$/")
			,"PGMSEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"PGMID"=>array("REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/")
			,"PGMNM"=>array("CLEARTEXT","/--미 정의--/")
			,"PKGGRP"=>array("CLEARTEXT","/--미 정의--/")
			,"VIEWURL"=>array("CLEARTEXT","/--미 정의--/")
			,"PGMTYPE"=>array("CLEARTEXT","/--미 정의--/")
			,"SECTYPE"=>array("REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/")
			,"ADDDT"=>array("REGEXMAT","/^[0-9]+$/")
			,"MODDT"=>array("REGEXMAT","/^[0-9]+$/")
					)
	)
);
$REQ["G3-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G3-XML"]
		,"COLORD"=>"MNU_SEQ,MNU_NM,PGMID,URL,PGMTYPE,MNU_ORD,FOLDER_SEQ,USE_YN,ADD_DT,ADD_ID,MOD_DT,MOD_ID"
		,"VALID"=>
			array(
			"MNU_SEQ"=>array("STRING",20)	
			,"MNU_NM"=>array("STRING",30)	
			,"PGMID"=>array("STRING",20)	
			,"URL"=>array("STRING",50)	
			,"PGMTYPE"=>array("STRING",10)	
			,"MNU_ORD"=>array("STRING",30)	
			,"FOLDER_SEQ"=>array("NUMBER",30)	
			,"USE_YN"=>array("STRING",1)	
			,"ADD_DT"=>array("STRING",14)	
			,"ADD_ID"=>array("STRING",30)	
			,"MOD_DT"=>array("STRING",14)	
			,"MOD_ID"=>array("STRING",30)	
					)
		,"FILTER"=>
			array(
			"MNU_SEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"MNU_NM"=>array("CLEARTEXT","/--미 정의--/")
			,"PGMID"=>array("REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/")
			,"URL"=>array("CLEARTEXT","/--미 정의--/")
			,"PGMTYPE"=>array("CLEARTEXT","/--미 정의--/")
			,"MNU_ORD"=>array("REGEXMAT","/^[0-9]+$/")
			,"FOLDER_SEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"USE_YN"=>array("SAFETEXT","/--미 정의--/")
			,"ADD_DT"=>array("CLEARTEXT","/--미 정의--/")
			,"ADD_ID"=>array("SAFETEXT","/--미 정의--/")
			,"MOD_DT"=>array("CLEARTEXT","/--미 정의--/")
			,"MOD_ID"=>array("SAFETEXT","/--미 정의--/")
					)
	)
);
$REQ["G4-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G4-XML"]
		,"COLORD"=>"CHK,ROWID,PGMID,AUTH_ID,AUTH_NM,ADDDT"
		,"VALID"=>
			array(
			"CHK"=>array("NUMBER",1)	
			,"ROWID"=>array("STRING",40)	
			,"PGMID"=>array("STRING",20)	
			,"AUTH_ID"=>array("STRING",50)	
			,"AUTH_NM"=>array("STRING",50)	
			,"ADDDT"=>array("STRING",14)	
					)
		,"FILTER"=>
			array(
			"CHK"=>array("REGEXMAT","/^([0-9a-zA-Z]|,)+$/")
			,"ROWID"=>array("SAFETEXT","/--미 정의--/")
			,"PGMID"=>array("REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/")
			,"AUTH_ID"=>array("REGEXMAT","/^[a-zA-Z]{1}[_a-zA-Z0-9]*$/")
			,"AUTH_NM"=>array("SAFETEXT","/--미 정의--/")
			,"ADDDT"=>array("REGEXMAT","/^[0-9]+$/")
					)
	)
);
$REQ["G5-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G5-XML"]
		,"COLORD"=>"AUTH_SEQ,PGMID,AUTH_ID,AUTH_NM,USE_YN,ADD_DT,MOD_DT"
		,"VALID"=>
			array(
			"AUTH_SEQ"=>array("NUMBER",10)	
			,"PGMID"=>array("STRING",20)	
			,"AUTH_ID"=>array("STRING",50)	
			,"AUTH_NM"=>array("STRING",50)	
			,"USE_YN"=>array("STRING",1)	
			,"ADD_DT"=>array("STRING",14)	
			,"MOD_DT"=>array("STRING",14)	
					)
		,"FILTER"=>
			array(
			"AUTH_SEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"PGMID"=>array("REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/")
			,"AUTH_ID"=>array("REGEXMAT","/^[a-zA-Z]{1}[_a-zA-Z0-9]*$/")
			,"AUTH_NM"=>array("SAFETEXT","/--미 정의--/")
			,"USE_YN"=>array("SAFETEXT","/--미 정의--/")
			,"ADD_DT"=>array("CLEARTEXT","/--미 정의--/")
			,"MOD_DT"=>array("CLEARTEXT","/--미 정의--/")
					)
	)
);
array_push($_RTIME,array("[TIME 40.REQ_VALID]",microtime(true)));
	//서비스 클래스 생성
$objService = new authdeployService();
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
  		echo $objService->goG2Search(); //PGM, 조회
  		break;
	case "G2_EXCEL" :
  		echo $objService->goG2Excel(); //PGM, 엑셀다운로드
  		break;
	case "G2_SAVE" :
  		echo $objService->goG2Save(); //PGM, 체크 저장
  		break;
	case "G3_SEARCH" :
  		echo $objService->goG3Search(); //SVC MENU, 조회
  		break;
	case "G3_SAVE" :
  		echo $objService->goG3Save(); //SVC MENU, 저장
  		break;
	case "G3_EXCEL" :
  		echo $objService->goG3Excel(); //SVC MENU, 엑셀다운로드
  		break;
	case "G3_CHKSAVE" :
  		echo $objService->goG3Chksave(); //SVC MENU, 선택저장
  		break;
	case "G4_SEARCH" :
  		echo $objService->goG4Search(); //AUTH, 조회
  		break;
	case "G4_EXCEL" :
  		echo $objService->goG4Excel(); //AUTH, 엑셀다운로드
  		break;
	case "G4_CHKSAVE" :
  		echo $objService->goG4Chksave(); //AUTH, 선택저장
  		break;
	case "G4_SAVE" :
  		echo $objService->goG4Save(); //AUTH, 체크 저장
  		break;
	case "G5_SEARCH" :
  		echo $objService->goG5Search(); //SVC AUTH, 조회
  		break;
	case "G5_SAVE" :
  		echo $objService->goG5Save(); //SVC AUTH, 저장
  		break;
	case "G5_EXCEL" :
  		echo $objService->goG5Excel(); //SVC AUTH, 엑셀다운로드
  		break;
	case "G5_CHKSAVE" :
  		echo $objService->goG5Chksave(); //SVC AUTH, 선택저장
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

$log->info("AuthdeployControl___________________________end");
$log->close(); unset($log);
?>
