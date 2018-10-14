<?php
header("Content-Type: text/html; charset=UTF-8"); //SVRCTL
header("Cache-Control:no-cache");
header("Pragma:no-cache");
$_RTIME = array();
array_push($_RTIME,array("[TIME 00.START]",microtime(true)));
include_once('sysvulexportService.php');

array_push($_RTIME,array("[TIME 10.INCLUDE SERVICE]",microtime(true)));
include_once('../include/incUtil.php');//CG UTIL
	include_once('../include/incRequest.php');//CG REQUEST
	include_once('../include/incDB.php');//CG DB
	include_once('../include/incSEC.php');//CG SEC
	include_once('../include/incAuth.php');//CG AUTH
	include_once('./incConfig.SC.php');//CG CONFIG
	include_once('../include/incUser.php');//CG USER
	//하위에서 LOADDING LIB 처리
	array_push($_RTIME,array("[TIME 20.IMPORT]",microtime(true)));
alog("SysvulexportControl___________________________start");

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
}else if($objAuth->isAuth("sysVulExport",$ctl)){
	$objAuth->LAUTH_SEQ = $objAuth->logUsrAuth($reqToken,$resToken,"sysVulExport",$ctl,"Y");
}else{
	$objAuth->logUsrAuth($reqToken,$resToken,"sysVulExport",$ctl,"N");
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

//FILE먼저 : G1, 
//FILE먼저 : G2, 

//G1, 
$REQ["G1-TEAM_NM"] = reqPostString("G1-TEAM_NM",100);//TEAM_NM	
$REQ["G1-TEAM_NM"] = getFilter($REQ["G1-TEAM_NM"],"CLEARTEXT","/--미 정의--/");	

//G2, 
$REQ["G2-VUL_SEQ"] = reqPostNumber("G2-VUL_SEQ",30);//VUL_SEQ	
$REQ["G2-VUL_SEQ"] = getFilter($REQ["G2-VUL_SEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-TEAM_NM"] = reqPostString("G2-TEAM_NM",100);//TEAM_NM	
$REQ["G2-TEAM_NM"] = getFilter($REQ["G2-TEAM_NM"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-SYS_NM"] = reqPostString("G2-SYS_NM",1000);//SYS_NM	
$REQ["G2-SYS_NM"] = getFilter($REQ["G2-SYS_NM"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-SUBSYS_NM"] = reqPostString("G2-SUBSYS_NM",1000);//SUBSYS_NM	
$REQ["G2-SUBSYS_NM"] = getFilter($REQ["G2-SUBSYS_NM"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-FILE_NM"] = reqPostString("G2-FILE_NM",1000);//FILE_NM	
$REQ["G2-FILE_NM"] = getFilter($REQ["G2-FILE_NM"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-RULESET_ID"] = reqPostString("G2-RULESET_ID",300);//RULESET_ID	
$REQ["G2-RULESET_ID"] = getFilter($REQ["G2-RULESET_ID"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-SOURCEPATH"] = reqPostString("G2-SOURCEPATH",30);//SOURCEPATH	
$REQ["G2-SOURCEPATH"] = getFilter($REQ["G2-SOURCEPATH"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-PRIORITY"] = reqPostNumber("G2-PRIORITY",30);//우선순위	
$REQ["G2-PRIORITY"] = getFilter($REQ["G2-PRIORITY"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-VUL_CNT"] = reqPostNumber("G2-VUL_CNT",30);//취약점갯수	
$REQ["G2-VUL_CNT"] = getFilter($REQ["G2-VUL_CNT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-ADD_DT"] = reqPostString("G2-ADD_DT",14);//ADD_DT	
$REQ["G2-ADD_DT"] = getFilter($REQ["G2-ADD_DT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-MOD_DT"] = reqPostString("G2-MOD_DT",14);//MOD_DT	
$REQ["G2-MOD_DT"] = getFilter($REQ["G2-MOD_DT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-XML"] = getXml2Array($_POST["G2-XML"]);//	
	//,  입력값 필터 
	$REQ["G2-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G2-XML"]
		,"COLORD"=>"VUL_SEQ,TEAM_NM,SYS_NM,SUBSYS_NM,FILE_NM,RULESET_ID,SOURCEPATH,PRIORITY,VUL_CNT,ADD_DT,MOD_DT"
		,"VALID"=>
			array(
			"VUL_SEQ"=>array("NUMBER",30)	
			,"TEAM_NM"=>array("STRING",100)	
			,"SYS_NM"=>array("STRING",1000)	
			,"SUBSYS_NM"=>array("STRING",1000)	
			,"FILE_NM"=>array("STRING",1000)	
			,"RULESET_ID"=>array("STRING",300)	
			,"SOURCEPATH"=>array("STRING",30)	
			,"PRIORITY"=>array("NUMBER",30)	
			,"VUL_CNT"=>array("NUMBER",30)	
			,"ADD_DT"=>array("STRING",14)	
			,"MOD_DT"=>array("STRING",14)	
					)
		,"FILTER"=>
			array(
			"VUL_SEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"TEAM_NM"=>array("CLEARTEXT","/--미 정의--/")
			,"SYS_NM"=>array("CLEARTEXT","/--미 정의--/")
			,"SUBSYS_NM"=>array("CLEARTEXT","/--미 정의--/")
			,"FILE_NM"=>array("CLEARTEXT","/--미 정의--/")
			,"RULESET_ID"=>array("CLEARTEXT","/--미 정의--/")
			,"SOURCEPATH"=>array("CLEARTEXT","/--미 정의--/")
			,"PRIORITY"=>array("REGEXMAT","/^[0-9]+$/")
			,"VUL_CNT"=>array("REGEXMAT","/^[0-9]+$/")
			,"ADD_DT"=>array("REGEXMAT","/^[0-9]+$/")
			,"MOD_DT"=>array("REGEXMAT","/^[0-9]+$/")
					)
	)
);
	
array_push($_RTIME,array("[TIME 40.REQ_VALID]",microtime(true)));
	//서비스 클래스 생성
$objService = new sysvulexportService();
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
	case "G2_SAVE" :
  		echo $objService->goG2Save(); //, 저장
  		break;
	case "G2_EXCEL" :
  		echo $objService->goG2Excel(); //, 엑셀다운로드
  		break;
	case "G2_CHKSAVE" :
  		echo $objService->goG2Chksave(); //, 선택저장
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

alog("SysvulexportControl___________________________end");

?>	