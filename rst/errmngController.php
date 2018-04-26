<?php
header("Content-Type: text/html; charset=UTF-8"); //SVRCTL
header("Cache-Control:no-cache");
header("Pragma:no-cache");
include_once('errmngService.php');
include_once('../include/incUtil.php');//CG UTIL
include_once('../include/incDB.php');//CG DB
include_once('../incConfig.php');//CG CONFIG
alog("ErrmngControl___________________________start");

//컨트롤 명령 받기
$ctl = "";
$ctl1 = $_GET["CTLGRP"];
$ctl2 = $_GET["CTLFNC"];


if($ctl1 == "" || $ctl2 == ""){
	JsonMsg("500","100","처리 명령이 잘못되었습니다.(no input ctl)");
}else{
	$ctl = $ctl1 . "_" . $ctl2;
}
$REQ["G3_ERRLOGSEQ"] = $_POST["G3_ERRLOGSEQ"];//SEQ
$REQ["G3_SESSIONID"] = $_POST["G3_SESSIONID"];//SESSION
$REQ["G3_REQID"] = $_POST["G3_REQID"];//REQID
$REQ["G3_ERRNO"] = $_POST["G3_ERRNO"];//NO
$REQ["G3_ERRCD"] = $_POST["G3_ERRCD"];//CD
$REQ["G3_ERRSTR"] = $_POST["G3_ERRSTR"];//STR
$REQ["G3_ERRFILE"] = $_POST["G3_ERRFILE"];//FILE
$REQ["G3_ERRLINE"] = $_POST["G3_ERRLINE"];//LINE
$REQ["G3_ERRCONTEXT"] = $_POST["G3_ERRCONTEXT"];//CONTEXT
$REQ["G3_ADDDT"] = $_POST["G3_ADDDT"];//ADD
$REQ["G3_MODDT"] = $_POST["G3_MODDT"];//MOD
$REQ["G4_SESSIONID"] = $_POST["G4_SESSIONID"];//SESSIONID
$REQ["G4_ERRCD"] = $_POST["G4_ERRCD"];//ERRCD
$REQ["G4_ERRFILE"] = $_POST["G4_ERRFILE"];//에러파일
$REQ["G3_XML"] = getXml2Array($_POST["G3_XML"]);//에러	
//서비스 클래스 생성
$objService = new errmngService();//컨트롤 명령별 분개처리
alog("ctl:" . $ctl);
switch ($ctl){case "G1_SAVE" :
  echo $objService->goG1Save(); //, 저장
  break;
case "G3_USERDEF" :
  echo $objService->goG3Userdef(); //에러, 사용자정의
  break;
case "G3_SEARCH" :
  echo $objService->goG3Search(); //에러, 조회
  break;
case "G3_SAVE" :
  echo $objService->goG3Save(); //에러, 저장
  break;
case "G3_EXCEL" :
  echo $objService->goG3Excel(); //에러, 엑셀다운로드
  break;
case "G4_SEARCH" :
  echo $objService->goG4Search(); //, 조회
  break;
case "G4_SAVE" :
  echo $objService->goG4Save(); //, 저장
  break;
case "G4_DELETE" :
  echo $objService->goG4Delete(); //, 삭제
  break;
	default:
		JsonMsg("500","110","처리 명령을 찾을 수 없습니다. (no search ctl)");
		break;
}//서비스 클래스 비우기
unset($objService);

alog("ErrmngControl___________________________end");

?>