<?php
header("Content-Type: text/html; charset=UTF-8"); //SVRCTL
header("Cache-Control:no-cache");
header("Pragma:no-cache");
$_RTIME = array();
array_push($_RTIME,array("[TIME 00.START]",microtime(true)));
$CFG = include_once('../../common/include/incConfig.php');//CG CONFIG
include_once('intronormalService.php');

array_push($_RTIME,array("[TIME 10.INCLUDE SERVICE]",microtime(true)));
include_once('../../common/include/incUtil.php');//CG UTIL
include_once('../../common/include/incRequest.php');//CG REQUEST
include_once('../../common/include/incDB.php');//CG DB
include_once('../../common/include/incSec.php');//CG SEC
include_once('../../common/include/incAuth.php');//CG AUTH
include_once('../../common/include/incUser.php');//CG USER
//하위에서 LOADDING LIB 처리
	array_push($_RTIME,array("[TIME 20.IMPORT]",microtime(true)));
$reqToken = reqGetString("TOKEN",37);
$resToken = uniqid();

$log = getLogger(
	array(
	"LIST_NM"=>"log_CG"
	, "PGM_ID"=>"INTRONORMAL"
	, "REQTOKEN" => $reqToken
	, "RESTOKEN" => $resToken
	)
);
$log->info("IntronormalControl___________________________start");
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
}else if($objAuth->isAuth("INTRONORMAL",$ctl)){
	$objAuth->LAUTH_SEQ = $objAuth->logUsrAuth($reqToken,$resToken,"INTRONORMAL",$ctl,"Y");
}else{
	$objAuth->logUsrAuth($reqToken,$resToken,"INTRONORMAL",$ctl,"N");
	JsonMsg("500","120",$ctl . " 권한이 없습니다.");
}
		//사용자 정보 가져오기
	$REQ["USER.ID"] = getUserId();
//로그 저장 방식 결정
//일반로그, 권한변경로그, PI로그
//NORMAL, POWER, PI
$PGM_CFG["SECTYPE"] = "NORMAL";
$PGM_CFG["SQLTXT"] = array();
array_push($_RTIME,array("[TIME 30.AUTH_CHECK]",microtime(true)));

//FILE먼저 : G1, 
//FILE먼저 : G2, 로그인
//FILE먼저 : G3, 잠금
//FILE먼저 : G4, 메뉴이력

//G1, 

//G2, 로그인
$REQ["G2-LOGIN_SEQ"] = reqPostNumber("G2-LOGIN_SEQ",10);//SEQ	
$REQ["G2-LOGIN_SEQ"] = getFilter($REQ["G2-LOGIN_SEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-USR_ID"] = reqPostString("G2-USR_ID",10);//USR_ID	
$REQ["G2-USR_ID"] = getFilter($REQ["G2-USR_ID"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G2-SESSION_ID"] = reqPostString("G2-SESSION_ID",30);//SESSION_ID	
$REQ["G2-SESSION_ID"] = getFilter($REQ["G2-SESSION_ID"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-SUCCESS_YN"] = reqPostString("G2-SUCCESS_YN",1);//SUCCESS_YN	
$REQ["G2-SUCCESS_YN"] = getFilter($REQ["G2-SUCCESS_YN"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-RESPONSE_MSG"] = reqPostString("G2-RESPONSE_MSG",100);//RESPONSE_MSG	
$REQ["G2-RESPONSE_MSG"] = getFilter($REQ["G2-RESPONSE_MSG"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-PW_ERR_CNT"] = reqPostNumber("G2-PW_ERR_CNT",2);//PW_ERR_CNT	
$REQ["G2-PW_ERR_CNT"] = getFilter($REQ["G2-PW_ERR_CNT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-LOCKCD"] = reqPostString("G2-LOCKCD",10);//LOCKCD	
$REQ["G2-LOCKCD"] = getFilter($REQ["G2-LOCKCD"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-USR_SEQ"] = reqPostNumber("G2-USR_SEQ",10);//USR_SEQ	
$REQ["G2-USR_SEQ"] = getFilter($REQ["G2-USR_SEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-SERVER_NAME"] = reqPostString("G2-SERVER_NAME",100);//SVR_NM	
$REQ["G2-SERVER_NAME"] = getFilter($REQ["G2-SERVER_NAME"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-REMOTE_ADDR"] = reqPostString("G2-REMOTE_ADDR",20);//IP	
$REQ["G2-REMOTE_ADDR"] = getFilter($REQ["G2-REMOTE_ADDR"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-USER_AGENT"] = reqPostString("G2-USER_AGENT",500);//BROWSER	
$REQ["G2-USER_AGENT"] = getFilter($REQ["G2-USER_AGENT"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-ADD_DT"] = reqPostString("G2-ADD_DT",14);//ADD	
$REQ["G2-ADD_DT"] = getFilter($REQ["G2-ADD_DT"],"REGEXMAT","/^[0-9]+$/");	

//G3, 잠금
$REQ["G3-LOGIN_SEQ"] = reqPostNumber("G3-LOGIN_SEQ",10);//SEQ	
$REQ["G3-LOGIN_SEQ"] = getFilter($REQ["G3-LOGIN_SEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-USR_ID"] = reqPostString("G3-USR_ID",10);//USR_ID	
$REQ["G3-USR_ID"] = getFilter($REQ["G3-USR_ID"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G3-SESSION_ID"] = reqPostString("G3-SESSION_ID",30);//SESSION_ID	
$REQ["G3-SESSION_ID"] = getFilter($REQ["G3-SESSION_ID"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-SUCCESS_YN"] = reqPostString("G3-SUCCESS_YN",1);//SUCCESS_YN	
$REQ["G3-SUCCESS_YN"] = getFilter($REQ["G3-SUCCESS_YN"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-LOCKCD"] = reqPostString("G3-LOCKCD",10);//LOCKCD	
$REQ["G3-LOCKCD"] = getFilter($REQ["G3-LOCKCD"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-PW_ERR_CNT"] = reqPostNumber("G3-PW_ERR_CNT",2);//PW_ERR_CNT	
$REQ["G3-PW_ERR_CNT"] = getFilter($REQ["G3-PW_ERR_CNT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-LOCK_LIMIT_DT"] = reqPostString("G3-LOCK_LIMIT_DT",14);//LOCK_LIMIT_DT	
$REQ["G3-LOCK_LIMIT_DT"] = getFilter($REQ["G3-LOCK_LIMIT_DT"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-USR_SEQ"] = reqPostNumber("G3-USR_SEQ",10);//USR_SEQ	
$REQ["G3-USR_SEQ"] = getFilter($REQ["G3-USR_SEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-ADD_DT"] = reqPostString("G3-ADD_DT",14);//ADD	
$REQ["G3-ADD_DT"] = getFilter($REQ["G3-ADD_DT"],"REGEXMAT","/^[0-9]+$/");	

//G4, 메뉴이력
$REQ["G4-LAUTH_SEQ"] = reqPostNumber("G4-LAUTH_SEQ",10);//SEQ	
$REQ["G4-LAUTH_SEQ"] = getFilter($REQ["G4-LAUTH_SEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G4-REQ_TOKEN"] = reqPostString("G4-REQ_TOKEN",30);//REQ	
$REQ["G4-REQ_TOKEN"] = getFilter($REQ["G4-REQ_TOKEN"],"CLEARTEXT","/--미 정의--/");	
$REQ["G4-RES_TOKEN"] = reqPostString("G4-RES_TOKEN",30);//RES	
$REQ["G4-RES_TOKEN"] = getFilter($REQ["G4-RES_TOKEN"],"CLEARTEXT","/--미 정의--/");	
$REQ["G4-USR_SEQ"] = reqPostNumber("G4-USR_SEQ",10);//USR_SEQ	
$REQ["G4-USR_SEQ"] = getFilter($REQ["G4-USR_SEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G4-USR_ID"] = reqPostString("G4-USR_ID",10);//USR_ID	
$REQ["G4-USR_ID"] = getFilter($REQ["G4-USR_ID"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G4-PGMID"] = reqPostString("G4-PGMID",20);//프로그램ID	
$REQ["G4-PGMID"] = getFilter($REQ["G4-PGMID"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G4-AUTH_ID"] = reqPostString("G4-AUTH_ID",50);//AUTH_ID	
$REQ["G4-AUTH_ID"] = getFilter($REQ["G4-AUTH_ID"],"REGEXMAT","/^[a-zA-Z]{1}[_a-zA-Z0-9]*$/");	
$REQ["G4-SUCCESS_YN"] = reqPostString("G4-SUCCESS_YN",1);//SUCCESS_YN	
$REQ["G4-SUCCESS_YN"] = getFilter($REQ["G4-SUCCESS_YN"],"CLEARTEXT","/--미 정의--/");	
$REQ["G4-ADD_DT"] = reqPostString("G4-ADD_DT",14);//ADD	
$REQ["G4-ADD_DT"] = getFilter($REQ["G4-ADD_DT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-XML"] = getXml2Array($_POST["G2-XML"]);//로그인	
	$REQ["G3-XML"] = getXml2Array($_POST["G3-XML"]);//잠금	
	$REQ["G4-XML"] = getXml2Array($_POST["G4-XML"]);//메뉴이력	
	//,  입력값 필터 
	$REQ["G2-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G2-XML"]
		,"COLORD"=>"LOGIN_SEQ,USR_ID,SESSION_ID,SUCCESS_YN,RESPONSE_MSG,PW_ERR_CNT,LOCKCD,USR_SEQ,SERVER_NAME,REMOTE_ADDR,USER_AGENT,ADD_DT"
		,"VALID"=>
			array(
			"LOGIN_SEQ"=>array("NUMBER",10)	
			,"USR_ID"=>array("STRING",10)	
			,"SESSION_ID"=>array("STRING",30)	
			,"SUCCESS_YN"=>array("STRING",1)	
			,"RESPONSE_MSG"=>array("STRING",100)	
			,"PW_ERR_CNT"=>array("NUMBER",2)	
			,"LOCKCD"=>array("STRING",10)	
			,"USR_SEQ"=>array("NUMBER",10)	
			,"SERVER_NAME"=>array("STRING",100)	
			,"REMOTE_ADDR"=>array("STRING",20)	
			,"USER_AGENT"=>array("STRING",500)	
			,"ADD_DT"=>array("STRING",14)	
					)
		,"FILTER"=>
			array(
			"LOGIN_SEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"USR_ID"=>array("REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/")
			,"SESSION_ID"=>array("CLEARTEXT","/--미 정의--/")
			,"SUCCESS_YN"=>array("CLEARTEXT","/--미 정의--/")
			,"RESPONSE_MSG"=>array("CLEARTEXT","/--미 정의--/")
			,"PW_ERR_CNT"=>array("REGEXMAT","/^[0-9]+$/")
			,"LOCKCD"=>array("CLEARTEXT","/--미 정의--/")
			,"USR_SEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"SERVER_NAME"=>array("CLEARTEXT","/--미 정의--/")
			,"REMOTE_ADDR"=>array("CLEARTEXT","/--미 정의--/")
			,"USER_AGENT"=>array("CLEARTEXT","/--미 정의--/")
			,"ADD_DT"=>array("REGEXMAT","/^[0-9]+$/")
					)
	)
);
$REQ["G3-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G3-XML"]
		,"COLORD"=>"LOGIN_SEQ,USR_ID,SESSION_ID,SUCCESS_YN,LOCKCD,PW_ERR_CNT,LOCK_LIMIT_DT,USR_SEQ,ADD_DT"
		,"VALID"=>
			array(
			"LOGIN_SEQ"=>array("NUMBER",10)	
			,"USR_ID"=>array("STRING",10)	
			,"SESSION_ID"=>array("STRING",30)	
			,"SUCCESS_YN"=>array("STRING",1)	
			,"LOCKCD"=>array("STRING",10)	
			,"PW_ERR_CNT"=>array("NUMBER",2)	
			,"LOCK_LIMIT_DT"=>array("STRING",14)	
			,"USR_SEQ"=>array("NUMBER",10)	
			,"ADD_DT"=>array("STRING",14)	
					)
		,"FILTER"=>
			array(
			"LOGIN_SEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"USR_ID"=>array("REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/")
			,"SESSION_ID"=>array("CLEARTEXT","/--미 정의--/")
			,"SUCCESS_YN"=>array("CLEARTEXT","/--미 정의--/")
			,"LOCKCD"=>array("CLEARTEXT","/--미 정의--/")
			,"PW_ERR_CNT"=>array("REGEXMAT","/^[0-9]+$/")
			,"LOCK_LIMIT_DT"=>array("CLEARTEXT","/--미 정의--/")
			,"USR_SEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"ADD_DT"=>array("REGEXMAT","/^[0-9]+$/")
					)
	)
);
$REQ["G4-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G4-XML"]
		,"COLORD"=>"LAUTH_SEQ,REQ_TOKEN,RES_TOKEN,USR_SEQ,USR_ID,PGMID,AUTH_ID,SUCCESS_YN,ADD_DT"
		,"VALID"=>
			array(
			"LAUTH_SEQ"=>array("NUMBER",10)	
			,"REQ_TOKEN"=>array("STRING",30)	
			,"RES_TOKEN"=>array("STRING",30)	
			,"USR_SEQ"=>array("NUMBER",10)	
			,"USR_ID"=>array("STRING",10)	
			,"PGMID"=>array("STRING",20)	
			,"AUTH_ID"=>array("STRING",50)	
			,"SUCCESS_YN"=>array("STRING",1)	
			,"ADD_DT"=>array("STRING",14)	
					)
		,"FILTER"=>
			array(
			"LAUTH_SEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"REQ_TOKEN"=>array("CLEARTEXT","/--미 정의--/")
			,"RES_TOKEN"=>array("CLEARTEXT","/--미 정의--/")
			,"USR_SEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"USR_ID"=>array("REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/")
			,"PGMID"=>array("REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/")
			,"AUTH_ID"=>array("REGEXMAT","/^[a-zA-Z]{1}[_a-zA-Z0-9]*$/")
			,"SUCCESS_YN"=>array("CLEARTEXT","/--미 정의--/")
			,"ADD_DT"=>array("REGEXMAT","/^[0-9]+$/")
					)
	)
);
array_push($_RTIME,array("[TIME 40.REQ_VALID]",microtime(true)));
	//서비스 클래스 생성
$objService = new intronormalService();
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
  		echo $objService->goG2Search(); //로그인, 조회
  		break;
	case "G2_EXCEL" :
  		echo $objService->goG2Excel(); //로그인, 엑셀다운로드
  		break;
	case "G3_SEARCH" :
  		echo $objService->goG3Search(); //잠금, 조회
  		break;
	case "G3_EXCEL" :
  		echo $objService->goG3Excel(); //잠금, 엑셀다운로드
  		break;
	case "G4_SEARCH" :
  		echo $objService->goG4Search(); //메뉴이력, 조회
  		break;
	case "G4_EXCEL" :
  		echo $objService->goG4Excel(); //메뉴이력, 엑셀다운로드
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

$log->info("IntronormalControl___________________________end");
$log->close(); unset($log);
?>
