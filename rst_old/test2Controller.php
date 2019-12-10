<?php
header("Content-Type: text/html; charset=UTF-8"); //SVRCTL
header("Cache-Control:no-cache");
header("Pragma:no-cache");
include_once('test2Service.php');
include_once('../include/incUtil.php');//CG UTIL
include_once('../include/incDB.php');//CG DB
include_once('../incConfig.php');//CG CONFIG
alog("Test2Control___________________________start");

//컨트롤 명령 받기
$ctl = "";
$ctl1 = $_GET["CTLGRP"];
$ctl2 = $_GET["CTLFNC"];


if($ctl1 == "" || $ctl2 == ""){
	JsonMsg("500","100","처리 명령이 잘못되었습니다.(no input ctl)");
}else{
	$ctl = $ctl1 . "_" . $ctl2;
}
//FILE먼저 : G1, 1
//FILE먼저 : G2, 2
//FILE먼저 : G3, PJT
//FILE먼저 : G4, PGM
//FILE먼저 : G5, DD
//FILE먼저 : G6, CONFIG
//FILE먼저 : G7, FILE

//G1, 1
$REQ["G1_aaa"] = $_POST["G1_aaa"];//12

//G2, 2
$REQ["G2_PJTID"] = $_POST["G2_PJTID"];//프로젝트ID
$REQ["G2_ADDDT"] = $_POST["G2_ADDDT"];//생성일

//G3, PJT
$REQ["G3_PJTSEQ"] = $_POST["G3_PJTSEQ"];//SEQ
$REQ["G3_PJTID"] = $_POST["G3_PJTID"];//프로젝트ID
$REQ["G3_PJTNM"] = $_POST["G3_PJTNM"];//프로젝트명
$REQ["G3_FILECHARSET"] = $_POST["G3_FILECHARSET"];//파일 CHARSET
$REQ["G3_UITOOL"] = $_POST["G3_UITOOL"];//UITOOL
$REQ["G3_SVRLANG"] = $_POST["G3_SVRLANG"];//서버언어
$REQ["G3_PKGROOT"] = $_POST["G3_PKGROOT"];//패키지ROOT
$REQ["G3_STARTDT"] = $_POST["G3_STARTDT"];//시작일
$REQ["G3_ENDDT"] = $_POST["G3_ENDDT"];//종료일
$REQ["G3_DELYN"] = $_POST["G3_DELYN"];//삭제YN
$REQ["G3_ADDDT"] = $_POST["G3_ADDDT"];//ADDDT
$REQ["G3_MODDT"] = $_POST["G3_MODDT"];//수정일

//G4, PGM
$REQ["G4_PJTSEQ"] = $_POST["G4_PJTSEQ"];//PJTSEQ
$REQ["G4_PGMSEQ"] = $_POST["G4_PGMSEQ"];//SEQ
$REQ["G4_PGMID"] = $_POST["G4_PGMID"];//프로그램ID
$REQ["G4_PGMNM"] = $_POST["G4_PGMNM"];//프로그램이름
$REQ["G4_PKGGRP"] = $_POST["G4_PKGGRP"];//PKGGRP
$REQ["G4_ADDDT"] = $_POST["G4_ADDDT"];//ADDDT
$REQ["G4_MODDT"] = $_POST["G4_MODDT"];//MODDT

//G5, DD
$REQ["G5_PJTSEQ"] = $_POST["G5_PJTSEQ"];//PJTSEQ
$REQ["G5_COLID"] = $_POST["G5_COLID"];//컬럼ID
$REQ["G5_COLNM"] = $_POST["G5_COLNM"];//컬럼명
$REQ["G5_COLSNM"] = $_POST["G5_COLSNM"];//단축명
$REQ["G5_DATATYPE"] = $_POST["G5_DATATYPE"];//데이터타입
$REQ["G5_DATASIZE"] = $_POST["G5_DATASIZE"];//데이터사이즈
$REQ["G5_OBJTYPE"] = $_POST["G5_OBJTYPE"];//오브젝트타입
$REQ["G5_LBLWIDTH"] = $_POST["G5_LBLWIDTH"];//라벨가로
$REQ["G5_LBLHEIGHT"] = $_POST["G5_LBLHEIGHT"];//가벨세로
$REQ["G5_OBJWIDTH"] = $_POST["G5_OBJWIDTH"];//오브젝트가로
$REQ["G5_OBJHEIGHT"] = $_POST["G5_OBJHEIGHT"];//오브젝트세로
$REQ["G5_OBJALIGN"] = $_POST["G5_OBJALIGN"];//가로정렬
$REQ["G5_ADDDT"] = $_POST["G5_ADDDT"];//등록일
$REQ["G5_MODDT"] = $_POST["G5_MODDT"];//수정일

//G6, CONFIG
$REQ["G6_PJTSEQ"] = $_POST["G6_PJTSEQ"];//PJTSEQ
$REQ["G6_CFGSEQ"] = $_POST["G6_CFGSEQ"];//SEQ
$REQ["G6_CFGID"] = $_POST["G6_CFGID"];//CFGID
$REQ["G6_CFGNM"] = $_POST["G6_CFGNM"];//CFGNM
$REQ["G6_MVCGBN"] = $_POST["G6_MVCGBN"];//MVCGBN
$REQ["G6_PATH"] = $_POST["G6_PATH"];//PATH
$REQ["G6_CFGORD"] = $_POST["G6_CFGORD"];//ORD
$REQ["G6_ADDDT"] = $_POST["G6_ADDDT"];//ADDDT
$REQ["G6_MODDT"] = $_POST["G6_MODDT"];//MODDT

//G7, FILE
$REQ["G7_PJTSEQ"] = $_POST["G7_PJTSEQ"];//PJTSEQ
$REQ["G7_FILESEQ"] = $_POST["G7_FILESEQ"];//SEQ
$REQ["G7_MKFILETYPE"] = $_POST["G7_MKFILETYPE"];//파일타입
$REQ["G7_MKFILETYPENM"] = $_POST["G7_MKFILETYPENM"];//타입명
$REQ["G7_MKFILEFORMAT"] = $_POST["G7_MKFILEFORMAT"];//포멧
$REQ["G7_MKFILEEXT"] = $_POST["G7_MKFILEEXT"];//확장자
$REQ["G7_TEMPLATE"] = $_POST["G7_TEMPLATE"];//템플릿
$REQ["G7_FILEORD"] = $_POST["G7_FILEORD"];//순번
$REQ["G7_USEYN"] = $_POST["G7_USEYN"];//사용
$REQ["G7_ADDDT"] = $_POST["G7_ADDDT"];//ADDDT
$REQ["G7_MODDT"] = $_POST["G7_MODDT"];//MODDT
$REQ["G3_XML"] = getXml2Array($_POST["G3_XML"]);//PJT	
$REQ["G4_XML"] = getXml2Array($_POST["G4_XML"]);//PGM	
$REQ["G5_XML"] = getXml2Array($_POST["G5_XML"]);//DD	
$REQ["G6_XML"] = getXml2Array($_POST["G6_XML"]);//CONFIG	
$REQ["G7_XML"] = getXml2Array($_POST["G7_XML"]);//FILE	
//서비스 클래스 생성
$objService = new test2Service();//컨트롤 명령별 분개처리
alog("ctl:" . $ctl);
switch ($ctl){case "G1_SAVE" :
  echo $objService->goG1Save(); //1, 저장
  break;
case "G3_SEARCH" :
  echo $objService->goG3Search(); //PJT, 조회
  break;
case "G3_SAVE" :
  echo $objService->goG3Save(); //PJT, 저장
  break;
case "G3_LINK" :
  echo $objService->goG3Link(); //PJT, 링크이동합니다
  break;
case "G4_SEARCH" :
  echo $objService->goG4Search(); //PGM, 조회
  break;
case "G4_SAVE" :
  echo $objService->goG4Save(); //PGM, 저장
  break;
case "G5_SEARCH" :
  echo $objService->goG5Search(); //DD, 조회
  break;
case "G5_SAVE" :
  echo $objService->goG5Save(); //DD, 저장
  break;
case "G6_USERDEF" :
  echo $objService->goG6Userdef(); //CONFIG, 사용자정의
  break;
case "G6_SEARCH" :
  echo $objService->goG6Search(); //CONFIG, 조회
  break;
case "G6_SAVE" :
  echo $objService->goG6Save(); //CONFIG, 저장
  break;
case "G6_EXCEL" :
  echo $objService->goG6Excel(); //CONFIG, 엑셀다운로드
  break;
case "G7_USERDEF" :
  echo $objService->goG7Userdef(); //FILE, 사용자정의
  break;
case "G7_SEARCH" :
  echo $objService->goG7Search(); //FILE, 조회
  break;
case "G7_SAVE" :
  echo $objService->goG7Save(); //FILE, 저장
  break;
case "G7_EXCEL" :
  echo $objService->goG7Excel(); //FILE, 엑셀다운로드
  break;
	default:
		JsonMsg("500","110","처리 명령을 찾을 수 없습니다. (no search ctl)");
		break;
}//서비스 클래스 비우기
unset($objService);

alog("Test2Control___________________________end");

?>