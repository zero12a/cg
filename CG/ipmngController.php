<?php
header("Content-Type: text/html; charset=UTF-8"); //SVRCTL
header("Cache-Control:no-cache");
header("Pragma:no-cache");
$_RTIME = array();
array_push($_RTIME,array("[TIME 00.START]",microtime(true)));
include_once('ipmngService.php');

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
alog("IpmngControl___________________________start");

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
}else if($objAuth->isAuth("IPMNG",$ctl)){
	$objAuth->LAUTH_SEQ = $objAuth->logUsrAuth($reqToken,$resToken,"IPMNG",$ctl,"Y");
}else{
	$objAuth->logUsrAuth($reqToken,$resToken,"IPMNG",$ctl,"N");
	JsonMsg("500","120",$ctl . " 권한이 없습니다.");
}
		//사용자 정보 가져오기
//로그 저장 방식 결정
//일반로그, 권한변경로그, PI로그
//NORMAL, POWER, PI
$PGM_CFG["SECTYPE"] = "POWER";
$PGM_CFG["SQLTXT"] = array();
array_push($_RTIME,array("[TIME 30.AUTH_CHECK]",microtime(true)));

//FILE먼저 : G1, 조건
//FILE먼저 : G2, IP목록

//G1, 조건

//G2, IP목록
$REQ["G2-IP_SEQ"] = reqPostNumber("G2-IP_SEQ",10);//IP_SEQ	
$REQ["G2-IP_SEQ"] = getFilter($REQ["G2-IP_SEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-PGMTYPE"] = reqPostString("G2-PGMTYPE",10);//PGMTYPE	
$REQ["G2-PGMTYPE"] = getFilter($REQ["G2-PGMTYPE"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-IP"] = reqPostString("G2-IP",20);//IP	
$REQ["G2-IP"] = getFilter($REQ["G2-IP"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-IP_DESC"] = reqPostString("G2-IP_DESC",100);//DESC	
$REQ["G2-IP_DESC"] = getFilter($REQ["G2-IP_DESC"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-ADD_DT"] = reqPostString("G2-ADD_DT",14);//ADD	
$REQ["G2-ADD_DT"] = getFilter($REQ["G2-ADD_DT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-ADD_ID"] = reqPostString("G2-ADD_ID",30);//ADD_ID	
$REQ["G2-ADD_ID"] = getFilter($REQ["G2-ADD_ID"],"SAFETEXT","/--미 정의--/");	
$REQ["G2-MOD_DT"] = reqPostString("G2-MOD_DT",14);//MOD	
$REQ["G2-MOD_DT"] = getFilter($REQ["G2-MOD_DT"],"SAFETEXT","/--미 정의--/");	
$REQ["G2-MOD_ID"] = reqPostString("G2-MOD_ID",30);//MOD_ID	
$REQ["G2-MOD_ID"] = getFilter($REQ["G2-MOD_ID"],"SAFETEXT","/--미 정의--/");	
$REQ["G2-XML"] = getXml2Array($_POST["G2-XML"]);//IP목록	
	//,  입력값 필터 
	$REQ["G2-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G2-XML"]
		,"COLORD"=>"IP_SEQ,PGMTYPE,IP,IP_DESC,ADD_DT,ADD_ID,MOD_DT,MOD_ID"
		,"VALID"=>
			array(
			"IP_SEQ"=>array("NUMBER",10)	
			,"PGMTYPE"=>array("STRING",10)	
			,"IP"=>array("STRING",20)	
			,"IP_DESC"=>array("STRING",100)	
			,"ADD_DT"=>array("STRING",14)	
			,"ADD_ID"=>array("STRING",30)	
			,"MOD_DT"=>array("STRING",14)	
			,"MOD_ID"=>array("STRING",30)	
					)
		,"FILTER"=>
			array(
			"IP_SEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"PGMTYPE"=>array("CLEARTEXT","/--미 정의--/")
			,"IP"=>array("CLEARTEXT","/--미 정의--/")
			,"IP_DESC"=>array("CLEARTEXT","/--미 정의--/")
			,"ADD_DT"=>array("REGEXMAT","/^[0-9]+$/")
			,"ADD_ID"=>array("SAFETEXT","/--미 정의--/")
			,"MOD_DT"=>array("SAFETEXT","/--미 정의--/")
			,"MOD_ID"=>array("SAFETEXT","/--미 정의--/")
					)
	)
);
array_push($_RTIME,array("[TIME 40.REQ_VALID]",microtime(true)));
	//서비스 클래스 생성
$objService = new ipmngService();
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
  		echo $objService->goG2Search(); //IP목록, 조회
  		break;
	case "G2_SAVE" :
  		echo $objService->goG2Save(); //IP목록, 저장
  		break;
	case "G2_EXCEL" :
  		echo $objService->goG2Excel(); //IP목록, 엑셀다운로드
  		break;
	case "G2_CHKSAVE" :
  		echo $objService->goG2Chksave(); //IP목록, 선택저장
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

alog("IpmngControl___________________________end");

?>	