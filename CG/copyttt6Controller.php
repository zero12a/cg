<?php
header("Content-Type: text/html; charset=UTF-8"); //SVRCTL
header("Cache-Control:no-cache");
header("Pragma:no-cache");
$_RTIME = array();
array_push($_RTIME,array("[TIME 00.START]",microtime(true)));
include_once('copyttt6Service.php');

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
alog("Copyttt6Control___________________________start");

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
}else if($objAuth->isAuth("COPYTTT6",$ctl)){
	$objAuth->LAUTH_SEQ = $objAuth->logUsrAuth($reqToken,$resToken,"COPYTTT6",$ctl,"Y");
}else{
	$objAuth->logUsrAuth($reqToken,$resToken,"COPYTTT6",$ctl,"N");
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

//FILE먼저 : G1, 1
//FILE먼저 : G2, 마스터

//G1, 1
$REQ["G1-MYRADIO"] = reqPostString("G1-MYRADIO",30);//나의라디오	
$REQ["G1-MYRADIO"] = getFilter($REQ["G1-MYRADIO"],"CLEARTEXT","/--미 정의--/");	
$REQ["G1-ADD_DT"] = reqPostString("G1-ADD_DT",14);//ADD	
$REQ["G1-ADD_DT"] = getFilter($REQ["G1-ADD_DT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G1-PNM"] = reqPostString("G1-PNM",100);//PNM	
$REQ["G1-PNM"] = getFilter($REQ["G1-PNM"],"SAFETEXT","/--미 정의--/");	

//G2, 마스터
$REQ["G2-XML"] = getXml2Array($_POST["G2-XML"]);//마스터	
	//,  입력값 필터 
	$REQ["G2-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G2-XML"]
		,"COLORD"=>""
		,"VALID"=>
			array(
					)
		,"FILTER"=>
			array(
					)
	)
);
$REQ["G1-MYCHECK"] = $_POST["G1-MYCHECK"];	//checkbox 받기
$REQ["G1-MYCHECK"] = filterGridChk($REQ["G1-MYCHECK"],"STRING",11,"CLEARTEXT","/--미 정의--/");//MYCHECK 입력값검증
	
array_push($_RTIME,array("[TIME 40.REQ_VALID]",microtime(true)));
	//서비스 클래스 생성
$objService = new copyttt6Service();
	//컨트롤 명령별 분개처리
alog("ctl:" . $ctl);
switch ($ctl){
			case "G1_SEARCHALL" :
  		echo $objService->goG1Searchall(); //1, 조회(전체)
  		break;
	case "G1_SAVE" :
  		echo $objService->goG1Save(); //1, 저장
  		break;
	case "G2_SEARCH" :
  		echo $objService->goG2Search(); //마스터, 조회
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

alog("Copyttt6Control___________________________end");

?>	