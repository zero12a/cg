<?php
header("Content-Type: text/html; charset=UTF-8"); //SVRCTL
header("Cache-Control:no-cache");
header("Pragma:no-cache");
$_RTIME = array();
array_push($_RTIME,array("[TIME 00.START]",microtime(true)));
include_once('authdownService.php');

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
alog("AuthdownControl___________________________start");

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
}else if($objAuth->isAuth("AUTHDOWN",$ctl)){
	$objAuth->LAUTH_SEQ = $objAuth->logUsrAuth($reqToken,$resToken,"AUTHDOWN",$ctl,"Y");
}else{
	$objAuth->logUsrAuth($reqToken,$resToken,"AUTHDOWN",$ctl,"N");
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

//FILE먼저 : G1, 조회조건
//FILE먼저 : G2, 권한목록

//G1, 조회조건
$REQ["G1-PGMID"] = reqPostString("G1-PGMID",20);//프로그램ID	
$REQ["G1-PGMID"] = getFilter($REQ["G1-PGMID"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G1-PJTSEQ"] = reqPostNumber("G1-PJTSEQ",20);//PJTSEQ	
$REQ["G1-PJTSEQ"] = getFilter($REQ["G1-PJTSEQ"],"REGEXMAT","/^[0-9]+$/");	

//G2, 권한목록
$REQ["G2-FNCSEQ"] = reqPostString("G2-FNCSEQ",30);//FNCSEQ	
$REQ["G2-FNCSEQ"] = getFilter($REQ["G2-FNCSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-PGMID"] = reqPostString("G2-PGMID",20);//프로그램ID	
$REQ["G2-PGMID"] = getFilter($REQ["G2-PGMID"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G2-AUTH_ID"] = reqPostString("G2-AUTH_ID",50);//AUTH_ID	
$REQ["G2-AUTH_ID"] = getFilter($REQ["G2-AUTH_ID"],"REGEXMAT","/^[a-zA-Z]{1}[_a-zA-Z0-9]*$/");	
$REQ["G2-AUTH_NM"] = reqPostString("G2-AUTH_NM",50);//AUTH_NM	
$REQ["G2-AUTH_NM"] = getFilter($REQ["G2-AUTH_NM"],"SAFETEXT","/--미 정의--/");	
$REQ["G2-USE_YN"] = reqPostString("G2-USE_YN",1);//USE_YN	
$REQ["G2-USE_YN"] = getFilter($REQ["G2-USE_YN"],"SAFETEXT","/--미 정의--/");	
$REQ["G2-PGMID2"] = reqPostString("G2-PGMID2",30);//PGMID2	
$REQ["G2-PGMID2"] = getFilter($REQ["G2-PGMID2"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G2-XML"] = getXml2Array($_POST["G2-XML"]);//권한목록	
	//,  입력값 필터 
	$REQ["G2-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G2-XML"]
		,"COLORD"=>"FNCSEQ,PGMID,AUTH_ID,AUTH_NM,USE_YN,PGMID2"
		,"VALID"=>
			array(
			"FNCSEQ"=>array("STRING",30)	
			,"PGMID"=>array("STRING",20)	
			,"AUTH_ID"=>array("STRING",50)	
			,"AUTH_NM"=>array("STRING",50)	
			,"USE_YN"=>array("STRING",1)	
			,"PGMID2"=>array("STRING",30)	
					)
		,"FILTER"=>
			array(
			"FNCSEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"PGMID"=>array("REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/")
			,"AUTH_ID"=>array("REGEXMAT","/^[a-zA-Z]{1}[_a-zA-Z0-9]*$/")
			,"AUTH_NM"=>array("SAFETEXT","/--미 정의--/")
			,"USE_YN"=>array("SAFETEXT","/--미 정의--/")
			,"PGMID2"=>array("REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/")
					)
	)
);
	
array_push($_RTIME,array("[TIME 40.REQ_VALID]",microtime(true)));
	//서비스 클래스 생성
$objService = new authdownService();
	//컨트롤 명령별 분개처리
alog("ctl:" . $ctl);
switch ($ctl){
			case "G1_SEARCHALL" :
  		echo $objService->goG1Searchall(); //조회조건, 조회(전체)
  		break;
	case "G1_SAVE" :
  		echo $objService->goG1Save(); //조회조건, 저장
  		break;
	case "G2_SEARCH" :
  		echo $objService->goG2Search(); //권한목록, 조회
  		break;
	case "G2_EXCEL" :
  		echo $objService->goG2Excel(); //권한목록, 엑셀다운로드
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

alog("AuthdownControl___________________________end");

?>	