<?php
header("Content-Type: text/html; charset=UTF-8"); //SVRCTL
header("Cache-Control:no-cache");
header("Pragma:no-cache");
$_RTIME = array();
array_push($_RTIME,array("[TIME 00.START]",microtime(true)));
include_once('chartbarService.php');

array_push($_RTIME,array("[TIME 10.INCLUDE SERVICE]",microtime(true)));
include_once('../include/incUtil.php');//CG UTIL
	include_once('../include/incRequest.php');//CG REQUEST
	include_once('../include/incDB.php');//CG DB
	include_once('../include/incSEC.php');//CG SEC
	include_once('../include/incAuth.php');//CG AUTH
	include_once('./incConfig.CG.php');//CG CONFIG
	include_once('../include/incUser.php');//CG USER
	//하위에서 LOADDING LIB 처리
	array_push($_RTIME,array("[TIME 20.IMPORT]",microtime(true)));
alog("ChartbarControl___________________________start");

$reqToken = reqGetString("TOKEN",37);
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
//로그인 : 권한정보 검사하기 in_array("aix", $os)
if(!isLogin()){
	JsonMsg("500","110"," 로그아웃되었습니다.");
}else if(!$objAuth->isOneConnection()){
	logOut();
	JsonMsg("500","120"," 다른기기(PC,브라우저 등)에서 로그인하였습니다. 다시로그인 후 사용해 주세요.");
}else if($objAuth->isAuth("CHARTBAR",$ctl)){
	$objAuth->LAUTH_SEQ = $objAuth->logUsrAuth($reqToken,$resToken,"CHARTBAR",$ctl,"Y");
}else{
	$objAuth->logUsrAuth($reqToken,$resToken,"CHARTBAR",$ctl,"N");
	JsonMsg("500","120",$ctl . " 권한이 없습니다.");
}
		//사용자 정보 가져오기
//로그 저장 방식 결정
//일반로그, 권한변경로그, PI로그
//NORMAL, POWER, PI
$PGM_CFG["SECTYPE"] = "NORMAL";
$PGM_CFG["SQLTXT"] = array();
array_push($_RTIME,array("[TIME 30.AUTH_CHECK]",microtime(true)));

//로그인정보 및 환경경수 받기

//FILE먼저 : G1, 컨디션
//FILE먼저 : G2, 챠트
//FILE먼저 : G3, PIE
//FILE먼저 : G4, BAR상속
//FILE먼저 : G5, PIE상속

//G1, 컨디션

//G2, 챠트
$REQ["G2-LOGIN_DT"] = reqPostString("G2-LOGIN_DT",20);//LOGIN_DT	
$REQ["G2-LOGIN_DT"] = getFilter($REQ["G2-LOGIN_DT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-LOGIN_CNT"] = reqPostNumber("G2-LOGIN_CNT",20);//LOGIN_CNT	
$REQ["G2-LOGIN_CNT"] = getFilter($REQ["G2-LOGIN_CNT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-LOGIN_CNT2"] = reqPostNumber("G2-LOGIN_CNT2",20);//LOGIN_CNT2	
$REQ["G2-LOGIN_CNT2"] = getFilter($REQ["G2-LOGIN_CNT2"],"REGEXMAT","/^[0-9]+$/");	

//G3, PIE
$REQ["G3-LOGIN_DT"] = reqPostString("G3-LOGIN_DT",20);//LOGIN_DT	
$REQ["G3-LOGIN_DT"] = getFilter($REQ["G3-LOGIN_DT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-LOGIN_CNT"] = reqPostNumber("G3-LOGIN_CNT",20);//LOGIN_CNT	
$REQ["G3-LOGIN_CNT"] = getFilter($REQ["G3-LOGIN_CNT"],"REGEXMAT","/^[0-9]+$/");	

//G4, BAR상속
$REQ["G4-LOGIN_DT"] = reqPostString("G4-LOGIN_DT",20);//LOGIN_DT	
$REQ["G4-LOGIN_DT"] = getFilter($REQ["G4-LOGIN_DT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G4-LOGIN_CNT"] = reqPostNumber("G4-LOGIN_CNT",20);//LOGIN_CNT	
$REQ["G4-LOGIN_CNT"] = getFilter($REQ["G4-LOGIN_CNT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G4-LOGIN_CNT2"] = reqPostNumber("G4-LOGIN_CNT2",20);//LOGIN_CNT2	
$REQ["G4-LOGIN_CNT2"] = getFilter($REQ["G4-LOGIN_CNT2"],"REGEXMAT","/^[0-9]+$/");	

//G5, PIE상속
$REQ["G5-LOGIN_DT"] = reqPostString("G5-LOGIN_DT",20);//LOGIN_DT	
$REQ["G5-LOGIN_DT"] = getFilter($REQ["G5-LOGIN_DT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G5-LOGIN_CNT"] = reqPostNumber("G5-LOGIN_CNT",20);//LOGIN_CNT	
$REQ["G5-LOGIN_CNT"] = getFilter($REQ["G5-LOGIN_CNT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G5-LOGIN_CNT2"] = reqPostNumber("G5-LOGIN_CNT2",20);//LOGIN_CNT2	
$REQ["G5-LOGIN_CNT2"] = getFilter($REQ["G5-LOGIN_CNT2"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G4-XML"] = getXml2Array($_POST["G4-XML"]);//BAR상속	
	$REQ["G5-XML"] = getXml2Array($_POST["G5-XML"]);//PIE상속	
	//,  입력값 필터 
	$REQ["G4-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G4-XML"]
		,"COLORD"=>"LOGIN_DT,LOGIN_CNT,LOGIN_CNT2"
		,"VALID"=>
			array(
			"LOGIN_DT"=>array("STRING",20)	
			,"LOGIN_CNT"=>array("NUMBER",20)	
			,"LOGIN_CNT2"=>array("NUMBER",20)	
					)
		,"FILTER"=>
			array(
			"LOGIN_DT"=>array("REGEXMAT","/^[0-9]+$/")
			,"LOGIN_CNT"=>array("REGEXMAT","/^[0-9]+$/")
			,"LOGIN_CNT2"=>array("REGEXMAT","/^[0-9]+$/")
					)
	)
);
$REQ["G5-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G5-XML"]
		,"COLORD"=>"LOGIN_DT,LOGIN_CNT,LOGIN_CNT2"
		,"VALID"=>
			array(
			"LOGIN_DT"=>array("STRING",20)	
			,"LOGIN_CNT"=>array("NUMBER",20)	
			,"LOGIN_CNT2"=>array("NUMBER",20)	
					)
		,"FILTER"=>
			array(
			"LOGIN_DT"=>array("REGEXMAT","/^[0-9]+$/")
			,"LOGIN_CNT"=>array("REGEXMAT","/^[0-9]+$/")
			,"LOGIN_CNT2"=>array("REGEXMAT","/^[0-9]+$/")
					)
	)
);
	
array_push($_RTIME,array("[TIME 40.REQ_VALID]",microtime(true)));
	//서비스 클래스 생성
$objService = new chartbarService();
	//컨트롤 명령별 분개처리
alog("ctl:" . $ctl);
switch ($ctl){
			case "G1_SEARCHALL" :
  		echo $objService->goG1Searchall(); //컨디션, 조회(전체)
  		break;
	case "G1_SAVE" :
  		echo $objService->goG1Save(); //컨디션, 저장
  		break;
	case "G2_SEARCH" :
  		echo $objService->goG2Search(); //챠트, 조회
  		break;
	case "G3_SEARCH" :
  		echo $objService->goG3Search(); //PIE, 조회
  		break;
	case "G4_SEARCH" :
  		echo $objService->goG4Search(); //BAR상속, 조회
  		break;
	case "G4_SAVE" :
  		echo $objService->goG4Save(); //BAR상속, 저장
  		break;
	case "G5_SEARCH" :
  		echo $objService->goG5Search(); //PIE상속, 조회
  		break;
	case "G5_SAVE" :
  		echo $objService->goG5Save(); //PIE상속, 저장
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

alog("ChartbarControl___________________________end");

?>	