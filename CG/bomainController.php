<?php
header("Content-Type: text/html; charset=UTF-8"); //SVRCTL
header("Cache-Control:no-cache");
header("Pragma:no-cache");
$_RTIME = array();
array_push($_RTIME,array("[TIME 00.START]",microtime(true)));
include_once('bomainService.php');

array_push($_RTIME,array("[TIME 10.INCLUDE SERVICE]",microtime(true)));
include_once('../include/incUtil.php');//CG UTIL
	include_once('../include/incRequest.php');//CG REQUEST
	include_once('../include/incDB.php');//CG DB
	include_once('../include/incSec.php');//CG SEC
	include_once('./incConfig.CG.php');//CG CONFIG
	include_once('../include/incAuth.php');//CG AUTH
	include_once('../include/incUser.php');//CG USER
	//하위에서 LOADDING LIB 처리
	array_push($_RTIME,array("[TIME 20.IMPORT]",microtime(true)));
alog("BomainControl___________________________start");

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
}else if($objAuth->isAuth("BOMAIN",$ctl)){
	$objAuth->LAUTH_SEQ = $objAuth->logUsrAuth($reqToken,$resToken,"BOMAIN",$ctl,"Y");
}else{
	$objAuth->logUsrAuth($reqToken,$resToken,"BOMAIN",$ctl,"N");
	JsonMsg("500","120",$ctl . " 권한이 없습니다.");
}
		//사용자 정보 가져오기
//로그 저장 방식 결정
//일반로그, 권한변경로그, PI로그
//NORMAL, POWER, PI
$PGM_CFG["SECTYPE"] = "NORMAL";
$PGM_CFG["SQLTXT"] = array();
array_push($_RTIME,array("[TIME 30.AUTH_CHECK]",microtime(true)));

//FILE먼저 : G1, 5
//FILE먼저 : G2, 10
//FILE먼저 : G3, 감사

//G1, 5

//G2, 10
$REQ["G2-MYCOL"] = reqPostString("G2-MYCOL",11);//입력해	
$REQ["G2-MYCOL"] = getFilter($REQ["G2-MYCOL"],"","//");	
$REQ["G2-TXT1"] = reqPost("G2-TXT1",12);//감사	
$REQ["G2-TXT1"] = getFilter($REQ["G2-TXT1"],"","//");	

//G3, 감사
$REQ["G3-bb"] = reqPostString("G3-bb",12);//AAA	
$REQ["G3-bb"] = getFilter($REQ["G3-bb"],"","//");	
$REQ["G3-aa"] = reqPostString("G3-aa",12);//BBB	
$REQ["G3-aa"] = getFilter($REQ["G3-aa"],"","//");	
$REQ["G3-XML"] = getXml2Array($_POST["G3-XML"]);//감사	
	//,  입력값 필터 
	$REQ["G3-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G3-XML"]
		,"COLORD"=>"bb,aa"
		,"VALID"=>
			array(
			"bb"=>array("STRING",12)	
			,"aa"=>array("STRING",12)	
					)
		,"FILTER"=>
			array(
					)
	)
);
array_push($_RTIME,array("[TIME 40.REQ_VALID]",microtime(true)));
	//서비스 클래스 생성
$objService = new bomainService();
	//컨트롤 명령별 분개처리
alog("ctl:" . $ctl);
switch ($ctl){
			case "G1_ALLSEARCH" :
  		echo $objService->goG1Allsearch(); //5, 조회
  		break;
	case "G3_USERDEF" :
  		echo $objService->goG3Userdef(); //감사, 사용자정의
  		break;
	case "G3_SEARCH" :
  		echo $objService->goG3Search(); //감사, 조회
  		break;
	case "G3_SAVE" :
  		echo $objService->goG3Save(); //감사, 저장
  		break;
	case "G3_EXCEL" :
  		echo $objService->goG3Excel(); //감사, 엑셀다운로드
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

alog("BomainControl___________________________end");

?>	