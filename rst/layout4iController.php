<?php
header("Content-Type: text/html; charset=UTF-8"); //SVRCTL
header("Cache-Control:no-cache");
header("Pragma:no-cache");
$_RTIME = array();
array_push($_RTIME,array("[TIME 00.START]",microtime(true)));
include_once('layout4iService.php');

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
alog("Layout4iControl___________________________start");

$reqToken = reqGetString("TOKEN",30);
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
}else if($objAuth->isAuth("LAYOUT4I",$ctl)){
	$objAuth->LAUTH_SEQ = $objAuth->logUsrAuth($reqToken,$resToken,"LAYOUT4I",$ctl,"Y");
}else{
	$objAuth->logUsrAuth($reqToken,$resToken,"LAYOUT4I",$ctl,"N");
	JsonMsg("500","120",$ctl . " 권한이 없습니다.");
}
	//로그 저장 방식 결정
//일반로그, 권한변경로그, PI로그
//NORMAL, POWER, PI
$PGM_CFG["PGMTYPE"] = "";
$PGM_CFG["SQLTXT"] = array();
array_push($_RTIME,array("[TIME 30.AUTH_CHECK]",microtime(true)));

//로그인정보 및 환경경수 받기

//FILE먼저 : G1, 
//FILE먼저 : G2, G2
//FILE먼저 : G3, G3
//FILE먼저 : G4, G4

//G1, 

//G2, G2
$REQ["G2-ADDDT"] = reqPostString("G2-ADDDT",14);//ADDDT	
$REQ["G2-ADDDT"] = getFilter($REQ["G2-ADDDT"],"REGEXMAT","/^[0-9]+$/");	

//G3, G3
$REQ["G3-ADDDT"] = reqPostString("G3-ADDDT",14);//ADDDT	
$REQ["G3-ADDDT"] = getFilter($REQ["G3-ADDDT"],"REGEXMAT","/^[0-9]+$/");	

//G4, G4
$REQ["G4-ADDDT"] = reqPostString("G4-ADDDT",14);//ADDDT	
$REQ["G4-ADDDT"] = getFilter($REQ["G4-ADDDT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-XML"] = getXml2Array($_POST["G2-XML"]);//G2	
	$REQ["G3-XML"] = getXml2Array($_POST["G3-XML"]);//G3	
	$REQ["G4-XML"] = getXml2Array($_POST["G4-XML"]);//G4	
	//,  입력값 필터 
	$REQ["G2-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G2-XML"]
		,"COLORD"=>"ADDDT"
		,"VALID"=>
			array(
			"ADDDT"=>array("STRING",14)	
					)
		,"FILTER"=>
			array(
			"ADDDT"=>array("REGEXMAT","/^[0-9]+$/")
					)
	)
);
$REQ["G3-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G3-XML"]
		,"COLORD"=>"ADDDT"
		,"VALID"=>
			array(
			"ADDDT"=>array("STRING",14)	
					)
		,"FILTER"=>
			array(
			"ADDDT"=>array("REGEXMAT","/^[0-9]+$/")
					)
	)
);
$REQ["G4-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G4-XML"]
		,"COLORD"=>"ADDDT"
		,"VALID"=>
			array(
			"ADDDT"=>array("STRING",14)	
					)
		,"FILTER"=>
			array(
			"ADDDT"=>array("REGEXMAT","/^[0-9]+$/")
					)
	)
);
	
array_push($_RTIME,array("[TIME 40.REQ_VALID]",microtime(true)));
	//서비스 클래스 생성
$objService = new layout4iService();
	//컨트롤 명령별 분개처리
alog("ctl:" . $ctl);
switch ($ctl){
			case "G2_SEARCH" :
  		echo $objService->goG2Search(); //G2, 조회
  		break;
	case "G2_SAVE" :
  		echo $objService->goG2Save(); //G2, 저장
  		break;
	case "G2_EXCEL" :
  		echo $objService->goG2Excel(); //G2, 엑셀다운로드
  		break;
	case "G2_CHKSAVE" :
  		echo $objService->goG2Chksave(); //G2, 선택저장
  		break;
	case "G3_SEARCH" :
  		echo $objService->goG3Search(); //G3, 조회
  		break;
	case "G3_SAVE" :
  		echo $objService->goG3Save(); //G3, 저장
  		break;
	case "G3_EXCEL" :
  		echo $objService->goG3Excel(); //G3, 엑셀다운로드
  		break;
	case "G3_CHKSAVE" :
  		echo $objService->goG3Chksave(); //G3, 선택저장
  		break;
	case "G4_SEARCH" :
  		echo $objService->goG4Search(); //G4, 조회
  		break;
	case "G4_SAVE" :
  		echo $objService->goG4Save(); //G4, 저장
  		break;
	case "G4_EXCEL" :
  		echo $objService->goG4Excel(); //G4, 엑셀다운로드
  		break;
	case "G4_CHKSAVE" :
  		echo $objService->goG4Chksave(); //G4, 선택저장
  		break;
	default:
		JsonMsg("500","110","처리 명령을 찾을 수 없습니다. (no search ctl)");
		break;
}
	array_push($_RTIME,array("[TIME 50.SVC]",microtime(true)));
if($PGM_CFG["PGMTYPE"] == "POWER" || $PGM_CFG["PGMTYPE"] == "PI") $objAuth->logUsrAuthD($reqToken,$resToken);;	//권한변경 로그 저장
	array_push($_RTIME,array("[TIME 60.AUGHD_LOG]",microtime(true)));
//실행시간 검사
for($j=1;$j<sizeof($_RTIME);$j++){
	alog( $_RTIME[$j][0] . " " . number_format($_RTIME[$j][1]-$_RTIME[$j-1][1],4) );

	if($j == sizeof($_RTIME)-1) alog( "RUN TIME : " . number_format($_RTIME[$j][1]-$_RTIME[0][1],4) );
}
//서비스 클래스 비우기
unset($objService);
unset($objAuth);

alog("Layout4iControl___________________________end");

?>	