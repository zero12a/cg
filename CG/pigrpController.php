<?php
header("Content-Type: text/html; charset=UTF-8"); //SVRCTL
header("Cache-Control:no-cache");
header("Pragma:no-cache");
$_RTIME = array();
array_push($_RTIME,array("[TIME 00.START]",microtime(true)));
include_once('pigrpService.php');

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
alog("PigrpControl___________________________start");

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
}else if($objAuth->isAuth("PIGRP",$ctl)){
	$objAuth->LAUTH_SEQ = $objAuth->logUsrAuth($reqToken,$resToken,"PIGRP",$ctl,"Y");
}else{
	$objAuth->logUsrAuth($reqToken,$resToken,"PIGRP",$ctl,"N");
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

//FILE먼저 : G1, 조건
//FILE먼저 : G2, GRP목록
//FILE먼저 : G3, GRP상세

//G1, 조건
$REQ["G1-PJTSEQ"] = reqPostNumber("G1-PJTSEQ",20);//PJTSEQ	
$REQ["G1-PJTSEQ"] = getFilter($REQ["G1-PJTSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G1-PGMSEQ"] = reqPostNumber("G1-PGMSEQ",30);//PGMSEQ	
$REQ["G1-PGMSEQ"] = getFilter($REQ["G1-PGMSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G1-GRPNM"] = reqPostString("G1-GRPNM",100);//GRPNM	
$REQ["G1-GRPNM"] = getFilter($REQ["G1-GRPNM"],"CLEARTEXT","/--미 정의--/");	

//G2, GRP목록
$REQ["G2-PJTSEQ"] = reqPostNumber("G2-PJTSEQ",20);//PJTSEQ	
$REQ["G2-PJTSEQ"] = getFilter($REQ["G2-PJTSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-PGMSEQ"] = reqPostNumber("G2-PGMSEQ",30);//PGMSEQ	
$REQ["G2-PGMSEQ"] = getFilter($REQ["G2-PGMSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-GRPSEQ"] = reqPostNumber("G2-GRPSEQ",30);//GRPSEQ	
$REQ["G2-GRPSEQ"] = getFilter($REQ["G2-GRPSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-GRPID"] = reqPostString("G2-GRPID",30);//GRPID	
$REQ["G2-GRPID"] = getFilter($REQ["G2-GRPID"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G2-GRPTYPE"] = reqPostString("G2-GRPTYPE",10);//GRPTYPE	
$REQ["G2-GRPTYPE"] = getFilter($REQ["G2-GRPTYPE"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G2-GRPNM"] = reqPostString("G2-GRPNM",100);//GRPNM	
$REQ["G2-GRPNM"] = getFilter($REQ["G2-GRPNM"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-GRPORD"] = reqPostNumber("G2-GRPORD",30);//GRPORD	
$REQ["G2-GRPORD"] = getFilter($REQ["G2-GRPORD"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-LINK"] = reqPostString("G2-LINK",100);//LINK	
$REQ["G2-LINK"] = getFilter($REQ["G2-LINK"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-ADDDT"] = reqPostString("G2-ADDDT",14);//ADDDT	
$REQ["G2-ADDDT"] = getFilter($REQ["G2-ADDDT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-MODDT"] = reqPostString("G2-MODDT",14);//MODDT	
$REQ["G2-MODDT"] = getFilter($REQ["G2-MODDT"],"REGEXMAT","/^[0-9]+$/");	

//G3, GRP상세
$REQ["G3-PJTSEQ"] = reqPostNumber("G3-PJTSEQ",20);//PJTSEQ	
$REQ["G3-PJTSEQ"] = getFilter($REQ["G3-PJTSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-PGMSEQ"] = reqPostNumber("G3-PGMSEQ",30);//PGMSEQ	
$REQ["G3-PGMSEQ"] = getFilter($REQ["G3-PGMSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-GRPSEQ"] = reqPostNumber("G3-GRPSEQ",30);//GRPSEQ	
$REQ["G3-GRPSEQ"] = getFilter($REQ["G3-GRPSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-GRPID"] = reqPostString("G3-GRPID",30);//GRPID	
$REQ["G3-GRPID"] = getFilter($REQ["G3-GRPID"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G3-GRPTYPE"] = reqPostString("G3-GRPTYPE",10);//GRPTYPE	
$REQ["G3-GRPTYPE"] = getFilter($REQ["G3-GRPTYPE"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G3-GRPNM"] = reqPostString("G3-GRPNM",100);//GRPNM	
$REQ["G3-GRPNM"] = getFilter($REQ["G3-GRPNM"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-GRPORD"] = reqPostNumber("G3-GRPORD",30);//GRPORD	
$REQ["G3-GRPORD"] = getFilter($REQ["G3-GRPORD"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-FREEZECNT"] = reqPostNumber("G3-FREEZECNT",10);//(Grid)FREEZECNT	
$REQ["G3-FREEZECNT"] = getFilter($REQ["G3-FREEZECNT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-VBOX"] = reqPostString("G3-VBOX",10);//VBOX	
$REQ["G3-VBOX"] = getFilter($REQ["G3-VBOX"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-REFGRPID"] = reqPostString("G3-REFGRPID",30);//REFGRPID	
$REQ["G3-REFGRPID"] = getFilter($REQ["G3-REFGRPID"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G3-GRPWIDTH"] = reqPostString("G3-GRPWIDTH",10);//GRPWIDTH	
$REQ["G3-GRPWIDTH"] = getFilter($REQ["G3-GRPWIDTH"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-GRPHEIGHT"] = reqPostString("G3-GRPHEIGHT",10);//GRPHEIGHT	
$REQ["G3-GRPHEIGHT"] = getFilter($REQ["G3-GRPHEIGHT"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-COLSIZETYPE"] = reqPostString("G3-COLSIZETYPE",10);//COLSIZETYPE	
$REQ["G3-COLSIZETYPE"] = getFilter($REQ["G3-COLSIZETYPE"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-LEGENDALIGN"] = reqPostString("G3-LEGENDALIGN",10);//(Chart)LEGENDALIGN	
$REQ["G3-LEGENDALIGN"] = getFilter($REQ["G3-LEGENDALIGN"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G3-STACKED"] = reqPostString("G3-STACKED",10);//(Chart)STACKED	
$REQ["G3-STACKED"] = getFilter($REQ["G3-STACKED"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G3-ADDDT"] = reqPostString("G3-ADDDT",14);//ADDDT	
$REQ["G3-ADDDT"] = getFilter($REQ["G3-ADDDT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-MODDT"] = reqPostString("G3-MODDT",14);//MODDT	
$REQ["G3-MODDT"] = getFilter($REQ["G3-MODDT"],"REGEXMAT","/^[0-9]+$/");	
//,  입력값 필터 
	array_push($_RTIME,array("[TIME 40.REQ_VALID]",microtime(true)));
	//서비스 클래스 생성
$objService = new pigrpService();
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
  		echo $objService->goG2Search(); //GRP목록, 조회
  		break;
	case "G2_CHKSAVE" :
  		echo $objService->goG2Chksave(); //GRP목록, 선택저장
  		break;
	case "G3_SEARCH" :
  		echo $objService->goG3Search(); //GRP상세, 조회
  		break;
	case "G3_save" :
  		echo $objService->goG3Save(); //GRP상세, 저장
  		break;
	case "G3_del" :
  		echo $objService->goG3Del(); //GRP상세, 삭제
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

alog("PigrpControl___________________________end");

?>	