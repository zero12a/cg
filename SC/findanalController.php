<?php
header("Content-Type: text/html; charset=UTF-8"); //SVRCTL
header("Cache-Control:no-cache");
header("Pragma:no-cache");
$_RTIME = array();
array_push($_RTIME,array("[TIME 00.START]",microtime(true)));
include_once('findanalService.php');

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
alog("FindanalControl___________________________start");

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
}else if($objAuth->isAuth("findAnal",$ctl)){
	$objAuth->LAUTH_SEQ = $objAuth->logUsrAuth($reqToken,$resToken,"findAnal",$ctl,"Y");
}else{
	$objAuth->logUsrAuth($reqToken,$resToken,"findAnal",$ctl,"N");
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
//FILE먼저 : G2, 팀별 현황 (보안취약점 갯수)
//FILE먼저 : G3, 팀별 현황 (보안취약점 갯수)
//FILE먼저 : G4, 시스템별 현황
//FILE먼저 : G5, 취약점별 현황

//G1, 
$REQ["G1-EX_TEAM_NM"] = reqPostString("G1-EX_TEAM_NM",100);//그래프 제외 팀명	
$REQ["G1-EX_TEAM_NM"] = getFilter($REQ["G1-EX_TEAM_NM"],"CLEARTEXT","/--미 정의--/");	

//G2, 팀별 현황 (보안취약점 갯수)
$REQ["G2-TYPE_CNT"] = reqPostNumber("G2-TYPE_CNT",0);//유형수	
$REQ["G2-TYPE_CNT"] = getFilter($REQ["G2-TYPE_CNT"],"","//");	
$REQ["G2-VUL_CNT"] = reqPostNumber("G2-VUL_CNT",30);//취약점갯수	
$REQ["G2-VUL_CNT"] = getFilter($REQ["G2-VUL_CNT"],"REGEXMAT","/^[0-9]+$/");	

//G3, 팀별 현황 (보안취약점 갯수)
$REQ["G3-UUID_SEQ"] = reqPostNumber("G3-UUID_SEQ",100);//UUID_SEQ	
$REQ["G3-UUID_SEQ"] = getFilter($REQ["G3-UUID_SEQ"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-TEAM_NM"] = reqPostString("G3-TEAM_NM",300);//TEAM_NM	
$REQ["G3-TEAM_NM"] = getFilter($REQ["G3-TEAM_NM"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-PRIORITY_1"] = reqPostNumber("G3-PRIORITY_1",30);//위험 상	
$REQ["G3-PRIORITY_1"] = getFilter($REQ["G3-PRIORITY_1"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-PRIORITY_2"] = reqPostNumber("G3-PRIORITY_2",30);//위험 중	
$REQ["G3-PRIORITY_2"] = getFilter($REQ["G3-PRIORITY_2"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-PRIORITY_3"] = reqPostNumber("G3-PRIORITY_3",30);//위험 하	
$REQ["G3-PRIORITY_3"] = getFilter($REQ["G3-PRIORITY_3"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-VUL_CNT"] = reqPostNumber("G3-VUL_CNT",30);//취약점갯수	
$REQ["G3-VUL_CNT"] = getFilter($REQ["G3-VUL_CNT"],"REGEXMAT","/^[0-9]+$/");	

//G4, 시스템별 현황
$REQ["G4-UUID_SEQ"] = reqPostNumber("G4-UUID_SEQ",100);//UUID_SEQ	
$REQ["G4-UUID_SEQ"] = getFilter($REQ["G4-UUID_SEQ"],"CLEARTEXT","/--미 정의--/");	
$REQ["G4-TEAM_NM"] = reqPostString("G4-TEAM_NM",300);//TEAM_NM	
$REQ["G4-TEAM_NM"] = getFilter($REQ["G4-TEAM_NM"],"CLEARTEXT","/--미 정의--/");	
$REQ["G4-SYS_NM"] = reqPostString("G4-SYS_NM",1000);//SYS_NM	
$REQ["G4-SYS_NM"] = getFilter($REQ["G4-SYS_NM"],"CLEARTEXT","/--미 정의--/");	
$REQ["G4-SUBSYS_NM"] = reqPostString("G4-SUBSYS_NM",1000);//SUBSYS_NM	
$REQ["G4-SUBSYS_NM"] = getFilter($REQ["G4-SUBSYS_NM"],"CLEARTEXT","/--미 정의--/");	
$REQ["G4-VUL_CNT"] = reqPostNumber("G4-VUL_CNT",30);//취약점갯수	
$REQ["G4-VUL_CNT"] = getFilter($REQ["G4-VUL_CNT"],"REGEXMAT","/^[0-9]+$/");	

//G5, 취약점별 현황
$REQ["G5-UUID_SEQ"] = reqPostNumber("G5-UUID_SEQ",100);//UUID_SEQ	
$REQ["G5-UUID_SEQ"] = getFilter($REQ["G5-UUID_SEQ"],"CLEARTEXT","/--미 정의--/");	
$REQ["G5-TEAM_NM"] = reqPostString("G5-TEAM_NM",300);//TEAM_NM	
$REQ["G5-TEAM_NM"] = getFilter($REQ["G5-TEAM_NM"],"CLEARTEXT","/--미 정의--/");	
$REQ["G5-SYS_NM"] = reqPostString("G5-SYS_NM",1000);//SYS_NM	
$REQ["G5-SYS_NM"] = getFilter($REQ["G5-SYS_NM"],"CLEARTEXT","/--미 정의--/");	
$REQ["G5-SUBSYS_NM"] = reqPostString("G5-SUBSYS_NM",1000);//SUBSYS_NM	
$REQ["G5-SUBSYS_NM"] = getFilter($REQ["G5-SUBSYS_NM"],"CLEARTEXT","/--미 정의--/");	
$REQ["G5-RULESET"] = reqPostString("G5-RULESET",300);//RUESET	
$REQ["G5-RULESET"] = getFilter($REQ["G5-RULESET"],"CLEARTEXT","/--미 정의--/");	
$REQ["G5-VUL_CNT"] = reqPostNumber("G5-VUL_CNT",30);//취약점갯수	
$REQ["G5-VUL_CNT"] = getFilter($REQ["G5-VUL_CNT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-XML"] = getXml2Array($_POST["G3-XML"]);//팀별 현황 (보안취약점 갯수)	
	$REQ["G4-XML"] = getXml2Array($_POST["G4-XML"]);//시스템별 현황	
	$REQ["G5-XML"] = getXml2Array($_POST["G5-XML"]);//취약점별 현황	
	//,  입력값 필터 
	$REQ["G3-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G3-XML"]
		,"COLORD"=>"UUID_SEQ,TEAM_NM,PRIORITY_1,PRIORITY_2,PRIORITY_3,VUL_CNT"
		,"VALID"=>
			array(
			"UUID_SEQ"=>array("NUMBER",100)	
			,"TEAM_NM"=>array("STRING",300)	
			,"PRIORITY_1"=>array("NUMBER",30)	
			,"PRIORITY_2"=>array("NUMBER",30)	
			,"PRIORITY_3"=>array("NUMBER",30)	
			,"VUL_CNT"=>array("NUMBER",30)	
					)
		,"FILTER"=>
			array(
			"UUID_SEQ"=>array("CLEARTEXT","/--미 정의--/")
			,"TEAM_NM"=>array("CLEARTEXT","/--미 정의--/")
			,"PRIORITY_1"=>array("REGEXMAT","/^[0-9]+$/")
			,"PRIORITY_2"=>array("REGEXMAT","/^[0-9]+$/")
			,"PRIORITY_3"=>array("REGEXMAT","/^[0-9]+$/")
			,"VUL_CNT"=>array("REGEXMAT","/^[0-9]+$/")
					)
	)
);
$REQ["G4-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G4-XML"]
		,"COLORD"=>"UUID_SEQ,TEAM_NM,SYS_NM,SUBSYS_NM,VUL_CNT"
		,"VALID"=>
			array(
			"UUID_SEQ"=>array("NUMBER",100)	
			,"TEAM_NM"=>array("STRING",300)	
			,"SYS_NM"=>array("STRING",1000)	
			,"SUBSYS_NM"=>array("STRING",1000)	
			,"VUL_CNT"=>array("NUMBER",30)	
					)
		,"FILTER"=>
			array(
			"UUID_SEQ"=>array("CLEARTEXT","/--미 정의--/")
			,"TEAM_NM"=>array("CLEARTEXT","/--미 정의--/")
			,"SYS_NM"=>array("CLEARTEXT","/--미 정의--/")
			,"SUBSYS_NM"=>array("CLEARTEXT","/--미 정의--/")
			,"VUL_CNT"=>array("REGEXMAT","/^[0-9]+$/")
					)
	)
);
$REQ["G5-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G5-XML"]
		,"COLORD"=>"UUID_SEQ,TEAM_NM,SYS_NM,SUBSYS_NM,RULESET,VUL_CNT"
		,"VALID"=>
			array(
			"UUID_SEQ"=>array("NUMBER",100)	
			,"TEAM_NM"=>array("STRING",300)	
			,"SYS_NM"=>array("STRING",1000)	
			,"SUBSYS_NM"=>array("STRING",1000)	
			,"RULESET"=>array("STRING",300)	
			,"VUL_CNT"=>array("NUMBER",30)	
					)
		,"FILTER"=>
			array(
			"UUID_SEQ"=>array("CLEARTEXT","/--미 정의--/")
			,"TEAM_NM"=>array("CLEARTEXT","/--미 정의--/")
			,"SYS_NM"=>array("CLEARTEXT","/--미 정의--/")
			,"SUBSYS_NM"=>array("CLEARTEXT","/--미 정의--/")
			,"RULESET"=>array("CLEARTEXT","/--미 정의--/")
			,"VUL_CNT"=>array("REGEXMAT","/^[0-9]+$/")
					)
	)
);
	
array_push($_RTIME,array("[TIME 40.REQ_VALID]",microtime(true)));
	//서비스 클래스 생성
$objService = new findanalService();
	//컨트롤 명령별 분개처리
alog("ctl:" . $ctl);
switch ($ctl){
			case "G1_SEARCHALL" :
  		echo $objService->goG1Searchall(); //, 조회(전체)
  		break;
	case "G2_SEARCH" :
  		echo $objService->goG2Search(); //팀별 현황 (보안취약점 갯수), 조회
  		break;
	case "G3_SEARCH" :
  		echo $objService->goG3Search(); //팀별 현황 (보안취약점 갯수), 조회
  		break;
	case "G4_SEARCH" :
  		echo $objService->goG4Search(); //시스템별 현황, 조회
  		break;
	case "G5_SEARCH" :
  		echo $objService->goG5Search(); //취약점별 현황, 조회
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

alog("FindanalControl___________________________end");

?>	