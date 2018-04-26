<?php
header("Content-Type: text/html; charset=UTF-8"); //SVRCTL
header("Cache-Control:no-cache");
header("Pragma:no-cache");
$_RTIME = array();
array_push($_RTIME,array("[TIME 00.START]",microtime(true)));
include_once('logloginService.php');

array_push($_RTIME,array("[TIME 10.INCLUDE SERVICE]",microtime(true)));
include_once('../include/incUtil.php');//CG UTIL
	include_once('../include/incRequest.php');//CG REQUEST
	include_once('../include/incDB.php');//CG DB
	include_once('../include/incSEC.php');//CG SEC
	include_once('../include/incAuth.php');//CG AUTH
	include_once('../incConfig.php');//CG CONFIG
	include_once('../include/incUser.php');//CG USER
	//하위에서 LOADDING LIB 처리
	array_push($_RTIME,array("[TIME 20.IMPORT]",microtime(true)));
alog("LogloginControl___________________________start");

$reqToken = reqGetString("TOKEN",36);
$resToken = uniqid();
alog("reqToken : " . $reqToken);
alog("resToken : " . $resToken);

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
//권한정보 검사하기 in_array("aix", $os)
if(!isLogin()){
	JsonMsg("500","110"," 로그아웃되었습니다.");
}else if(!$objAuth->isOneConnection()){
	logOut();
	JsonMsg("500","120"," 다른기기(PC,브라우저 등)에서 로그인하였습니다. 다시로그인 후 사용해 주세요.");
}else if($objAuth->isAuth("LOGLOGIN",$ctl)){
	$objAuth->LAUTH_SEQ = $objAuth->logUsrAuth($reqToken,$resToken,"LOGLOGIN",$ctl,"Y");
}else{
	$objAuth->logUsrAuth($reqToken,$resToken,"LOGLOGIN",$ctl,"N");
	JsonMsg("500","120",$ctl . " 권한이 없습니다.");
}
	//로그 저장 방식 결정
//일반로그, 권한변경로그, PI로그
//NORMAL, POWER, PI
$PGM_CFG["SECTYPE"] = "POWER";
$PGM_CFG["SQLTXT"] = array();
array_push($_RTIME,array("[TIME 30.AUTH_CHECK]",microtime(true)));
$REQ["G3-CTLCUD"] = reqPostString("G3-CTLCUD",2);

//로그인정보 및 환경경수 받기

//FILE먼저 : G1, 조건
//FILE먼저 : G2, 목록
//FILE먼저 : G3, 상세

//G1, 조건
$REQ["G1-USR_ID"] = reqPostString("G1-USR_ID",10);//USR_ID	
$REQ["G1-USR_ID"] = getFilter($REQ["G1-USR_ID"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G1-REMOTE_ADDR"] = reqPostString("G1-REMOTE_ADDR",20);//IP	
$REQ["G1-REMOTE_ADDR"] = getFilter($REQ["G1-REMOTE_ADDR"],"CLEARTEXT","/--미 정의--/");	
$REQ["G1-FROM_DT"] = reqPostString("G1-FROM_DT",10);//FROM_DT	
$REQ["G1-FROM_DT"] = getFilter($REQ["G1-FROM_DT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G1-TO_DT"] = reqPostString("G1-TO_DT",10);//~	
$REQ["G1-TO_DT"] = getFilter($REQ["G1-TO_DT"],"REGEXMAT","/^[0-9]+$/");	

//G2, 목록
$REQ["G2-LOGIN_SEQ"] = reqPostNumber("G2-LOGIN_SEQ",10);//SEQ	
$REQ["G2-LOGIN_SEQ"] = getFilter($REQ["G2-LOGIN_SEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-USR_ID"] = reqPostString("G2-USR_ID",10);//USR_ID	
$REQ["G2-USR_ID"] = getFilter($REQ["G2-USR_ID"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G2-SESSION_ID"] = reqPostString("G2-SESSION_ID",30);//SESSION_ID	
$REQ["G2-SESSION_ID"] = getFilter($REQ["G2-SESSION_ID"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-SUCCESS_YN"] = reqPostString("G2-SUCCESS_YN",1);//SUCCESS_YN	
$REQ["G2-SUCCESS_YN"] = getFilter($REQ["G2-SUCCESS_YN"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-RESPONSE_MSG"] = reqPostString("G2-RESPONSE_MSG",100);//MSG	
$REQ["G2-RESPONSE_MSG"] = getFilter($REQ["G2-RESPONSE_MSG"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-LOCKCD"] = reqPostString("G2-LOCKCD",6);//LOCKCD	
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

//G3, 상세
$REQ["G3-LOGIN_SEQ"] = reqPostNumber("G3-LOGIN_SEQ",10);//SEQ	
$REQ["G3-LOGIN_SEQ"] = getFilter($REQ["G3-LOGIN_SEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-SESSION_ID"] = reqPostString("G3-SESSION_ID",30);//SESSION_ID	
$REQ["G3-SESSION_ID"] = getFilter($REQ["G3-SESSION_ID"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-USER_AGENT"] = reqPostString("G3-USER_AGENT",500);//BROWSER	
$REQ["G3-USER_AGENT"] = getFilter($REQ["G3-USER_AGENT"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-AUTH_JSON"] = reqPostString("G3-AUTH_JSON",300);//AUTH	
$REQ["G3-AUTH_JSON"] = getFilter($REQ["G3-AUTH_JSON"],"SAFETEXT","/--미 정의--/");	
$REQ["G2-XML"] = getXml2Array($_POST["G2-XML"]);//목록	
	//,  입력값 필터 
	$REQ["G2-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G2-XML"]
		,"COLORD"=>"LOGIN_SEQ,USR_ID,SESSION_ID,SUCCESS_YN,RESPONSE_MSG,LOCKCD,USR_SEQ,SERVER_NAME,REMOTE_ADDR,USER_AGENT,ADD_DT"
		,"VALID"=>
			array(
			"LOGIN_SEQ"=>array("NUMBER",10)	
			,"USR_ID"=>array("STRING",10)	
			,"SESSION_ID"=>array("STRING",30)	
			,"SUCCESS_YN"=>array("STRING",1)	
			,"RESPONSE_MSG"=>array("STRING",100)	
			,"LOCKCD"=>array("STRING",6)	
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
			,"LOCKCD"=>array("CLEARTEXT","/--미 정의--/")
			,"USR_SEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"SERVER_NAME"=>array("CLEARTEXT","/--미 정의--/")
			,"REMOTE_ADDR"=>array("CLEARTEXT","/--미 정의--/")
			,"USER_AGENT"=>array("CLEARTEXT","/--미 정의--/")
			,"ADD_DT"=>array("REGEXMAT","/^[0-9]+$/")
					)
	)
);
	
array_push($_RTIME,array("[TIME 40.REQ_VALID]",microtime(true)));
	//서비스 클래스 생성
$objService = new logloginService();
	//컨트롤 명령별 분개처리
alog("ctl:" . $ctl);
switch ($ctl){
			case "G1_SEARCHALL" :
  		echo $objService->goG1Searchall(); //조건, 조회(전체)
  		break;
	case "G1_SAVE" :
  		echo $objService->goG1Save(); //조건, 저장
  		break;
	case "G2_SEARCH" :
  		echo $objService->goG2Search(); //목록, 조회
  		break;
	case "G2_EXCEL" :
  		echo $objService->goG2Excel(); //목록, 엑셀다운로드
  		break;
	case "G3_SEARCH" :
  		echo $objService->goG3Search(); //상세, 조회
  		break;
	case "G3_SAVE" :
  		echo $objService->goG3Save(); //상세, 저장
  		break;
	case "G3_DELETE" :
  		echo $objService->goG3Delete(); //상세, 삭제
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
	alog( $_RTIME[$j][0] . " " . number_format($_RTIME[$j][1]-$_RTIME[$j-1][1],4) );

	if($j == sizeof($_RTIME)-1) alog( "RUN TIME : " . number_format($_RTIME[$j][1]-$_RTIME[0][1],4) );
}
//서비스 클래스 비우기
unset($objService);
unset($objAuth);

alog("LogloginControl___________________________end");

?>	