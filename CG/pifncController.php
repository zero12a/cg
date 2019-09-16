<?php
header("Content-Type: text/html; charset=UTF-8"); //SVRCTL
header("Cache-Control:no-cache");
header("Pragma:no-cache");
$_RTIME = array();
array_push($_RTIME,array("[TIME 00.START]",microtime(true)));
include_once('pifncService.php');

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
alog("PifncControl___________________________start");

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
}else if($objAuth->isAuth("PIFNC",$ctl)){
	$objAuth->LAUTH_SEQ = $objAuth->logUsrAuth($reqToken,$resToken,"PIFNC",$ctl,"Y");
}else{
	$objAuth->logUsrAuth($reqToken,$resToken,"PIFNC",$ctl,"N");
	JsonMsg("500","120",$ctl . " 권한이 없습니다.");
}
		//사용자 정보 가져오기
	$REQ["USER.SEQ"] = getUserSeq();
//로그 저장 방식 결정
//일반로그, 권한변경로그, PI로그
//NORMAL, POWER, PI
$PGM_CFG["SECTYPE"] = "NORMAL";
$PGM_CFG["SQLTXT"] = array();
array_push($_RTIME,array("[TIME 30.AUTH_CHECK]",microtime(true)));
$REQ["G3-CTLCUD"] = reqPostString("G3-CTLCUD",2);

//FILE먼저 : G1, 
//FILE먼저 : G2, 
//FILE먼저 : G3, 

//G1, 
$REQ["G1-GRPSEQ"] = reqPostNumber("G1-GRPSEQ",30);//GRPSEQ	
$REQ["G1-GRPSEQ"] = getFilter($REQ["G1-GRPSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G1-PJTSEQ"] = reqPostNumber("G1-PJTSEQ",20);//PJTSEQ	
$REQ["G1-PJTSEQ"] = getFilter($REQ["G1-PJTSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G1-PGMSEQ"] = reqPostNumber("G1-PGMSEQ",30);//PGMSEQ	
$REQ["G1-PGMSEQ"] = getFilter($REQ["G1-PGMSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G1-FNCID"] = reqPostString("G1-FNCID",30);//FNCID	
$REQ["G1-FNCID"] = getFilter($REQ["G1-FNCID"],"CLEARTEXT","/--미 정의--/");	
$REQ["G1-FNCNM"] = reqPostString("G1-FNCNM",30);//FNCNM	
$REQ["G1-FNCNM"] = getFilter($REQ["G1-FNCNM"],"CLEARTEXT","/--미 정의--/");	

//G2, 
$REQ["G2-PJTSEQ"] = reqPostNumber("G2-PJTSEQ",20);//PJTSEQ	
$REQ["G2-PJTSEQ"] = getFilter($REQ["G2-PJTSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-PGMSEQ"] = reqPostNumber("G2-PGMSEQ",30);//PGMSEQ	
$REQ["G2-PGMSEQ"] = getFilter($REQ["G2-PGMSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-GRPSEQ"] = reqPostNumber("G2-GRPSEQ",30);//GRPSEQ	
$REQ["G2-GRPSEQ"] = getFilter($REQ["G2-GRPSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-FNCSEQ"] = reqPostString("G2-FNCSEQ",30);//FNCSEQ	
$REQ["G2-FNCSEQ"] = getFilter($REQ["G2-FNCSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-FNCID"] = reqPostString("G2-FNCID",30);//FNCID	
$REQ["G2-FNCID"] = getFilter($REQ["G2-FNCID"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-FNCCD"] = reqPostString("G2-FNCCD",30);//FNCCD	
$REQ["G2-FNCCD"] = getFilter($REQ["G2-FNCCD"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-FNCNM"] = reqPostString("G2-FNCNM",30);//FNCNM	
$REQ["G2-FNCNM"] = getFilter($REQ["G2-FNCNM"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-FNCTYPE"] = reqPostString("G2-FNCTYPE",30);//FNCTYPE	
$REQ["G2-FNCTYPE"] = getFilter($REQ["G2-FNCTYPE"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-FNCORD"] = reqPostNumber("G2-FNCORD",3);//FNCORD	
$REQ["G2-FNCORD"] = getFilter($REQ["G2-FNCORD"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-USEYN"] = reqPostString("G2-USEYN",1);//사용	
$REQ["G2-USEYN"] = getFilter($REQ["G2-USEYN"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G2-USERDEFJS"] = reqPostString("G2-USERDEFJS",500);//USERDEFJS	
$REQ["G2-USERDEFJS"] = getFilter($REQ["G2-USERDEFJS"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-LINK"] = reqPostString("G2-LINK",100);//LINK	
$REQ["G2-LINK"] = getFilter($REQ["G2-LINK"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-ADDDT"] = reqPostString("G2-ADDDT",14);//ADDDT	
$REQ["G2-ADDDT"] = getFilter($REQ["G2-ADDDT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-MODDT"] = reqPostString("G2-MODDT",14);//MODDT	
$REQ["G2-MODDT"] = getFilter($REQ["G2-MODDT"],"REGEXMAT","/^[0-9]+$/");	

//G3, 
$REQ["G3-PJTSEQ"] = reqPostNumber("G3-PJTSEQ",20);//PJTSEQ	
$REQ["G3-PJTSEQ"] = getFilter($REQ["G3-PJTSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-PGMSEQ"] = reqPostNumber("G3-PGMSEQ",30);//PGMSEQ	
$REQ["G3-PGMSEQ"] = getFilter($REQ["G3-PGMSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-GRPSEQ"] = reqPostNumber("G3-GRPSEQ",30);//GRPSEQ	
$REQ["G3-GRPSEQ"] = getFilter($REQ["G3-GRPSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-FNCSEQ"] = reqPostNumber("G3-FNCSEQ",30);//FNCSEQ	
$REQ["G3-FNCSEQ"] = getFilter($REQ["G3-FNCSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-FNCID"] = reqPostString("G3-FNCID",30);//FNCID	
$REQ["G3-FNCID"] = getFilter($REQ["G3-FNCID"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-FNCCD"] = reqPostString("G3-FNCCD",30);//FNCCD	
$REQ["G3-FNCCD"] = getFilter($REQ["G3-FNCCD"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-FNCNM"] = reqPostString("G3-FNCNM",30);//FNCNM	
$REQ["G3-FNCNM"] = getFilter($REQ["G3-FNCNM"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-FNCTYPE"] = reqPostString("G3-FNCTYPE",30);//FNCTYPE	
$REQ["G3-FNCTYPE"] = getFilter($REQ["G3-FNCTYPE"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-FNCORD"] = reqPostNumber("G3-FNCORD",3);//FNCORD	
$REQ["G3-FNCORD"] = getFilter($REQ["G3-FNCORD"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-USEYN"] = reqPostString("G3-USEYN",1);//사용	
$REQ["G3-USEYN"] = getFilter($REQ["G3-USEYN"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G3-USERDEFJS"] = reqPostString("G3-USERDEFJS",500);//USERDEFJS	
$REQ["G3-USERDEFJS"] = getFilter($REQ["G3-USERDEFJS"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-ADDDT"] = reqPostString("G3-ADDDT",14);//ADDDT	
$REQ["G3-ADDDT"] = getFilter($REQ["G3-ADDDT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-MODDT"] = reqPostString("G3-MODDT",14);//MODDT	
$REQ["G3-MODDT"] = getFilter($REQ["G3-MODDT"],"REGEXMAT","/^[0-9]+$/");	
//,  입력값 필터 
	array_push($_RTIME,array("[TIME 40.REQ_VALID]",microtime(true)));
	//서비스 클래스 생성
$objService = new pifncService();
	//컨트롤 명령별 분개처리
alog("ctl:" . $ctl);
switch ($ctl){
			case "G1_SEARCHALL" :
  		echo $objService->goG1Searchall(); //, 조회(전체)
  		break;
	case "G1_SAVE" :
  		echo $objService->goG1Save(); //, 저장
  		break;
	case "G2_SEARCH" :
  		echo $objService->goG2Search(); //, 조회
  		break;
	case "G2_CHKSAVE" :
  		echo $objService->goG2Chksave(); //, 선택저장
  		break;
	case "G3_SEARCH" :
  		echo $objService->goG3Search(); //, 조회
  		break;
	case "G3_SAVE" :
  		echo $objService->goG3Save(); //, 저장
  		break;
	case "G3_DELETE" :
  		echo $objService->goG3Delete(); //, 삭제
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

alog("PifncControl___________________________end");

?>	