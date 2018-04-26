<?php
header("Content-Type: text/html; charset=UTF-8"); //SVRCTL
header("Cache-Control:no-cache");
header("Pragma:no-cache");
$_RTIME = array();
array_push($_RTIME,array("[TIME 00.START]",microtime(true)));
include_once('grpauthmngService.php');

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
alog("GrpauthmngControl___________________________start");

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
}else if($objAuth->isAuth("GRPAUTHMNG",$ctl)){
	$objAuth->LAUTH_SEQ = $objAuth->logUsrAuth($reqToken,$resToken,"GRPAUTHMNG",$ctl,"Y");
}else{
	$objAuth->logUsrAuth($reqToken,$resToken,"GRPAUTHMNG",$ctl,"N");
	JsonMsg("500","120",$ctl . " 권한이 없습니다.");
}
	//로그 저장 방식 결정
//일반로그, 권한변경로그, PI로그, 권한&PI로그
//NORMAL, POWER, PI, POWER_N_PI
$PGM_CFG["LOGTYPE"] = "";
$PGM_CFG["SQLTXT"] = array();
array_push($_RTIME,array("[TIME 30.AUTH_CHECK]",microtime(true)));
//FILE먼저 : G1, 조회조건
//FILE먼저 : G2, 그룹목록
//FILE먼저 : G3, 보유 권한
//FILE먼저 : G4, 미보유 권한

//G1, 조회조건

//G2, 그룹목록
$REQ["G2-GRP_SEQ"] = reqPostString("G2-GRP_SEQ",30);//GRP_SEQ	
$REQ["G2-GRP_SEQ"] = getFilter($REQ["G2-GRP_SEQ"],"REGEXMAT","/^[0-9]{1}[0-9]*$/");	
$REQ["G2-GRP_NM"] = reqPostString("G2-GRP_NM",30);//GRP_NM	
$REQ["G2-GRP_NM"] = getFilter($REQ["G2-GRP_NM"],"SAFETEXT","/--미 정의--/");	
$REQ["G2-USE_YN"] = reqPostString("G2-USE_YN",1);//USE_YN	
$REQ["G2-USE_YN"] = getFilter($REQ["G2-USE_YN"],"SAFETEXT","/--미 정의--/");	
$REQ["G2-ADD_DT"] = reqPostString("G2-ADD_DT",14);//ADD	
$REQ["G2-ADD_DT"] = getFilter($REQ["G2-ADD_DT"],"REGEXMAT","/^[0-9]{1}[0-9]*$/");	
$REQ["G2-ADD_ID"] = reqPostString("G2-ADD_ID",30);//ADD_ID	
$REQ["G2-ADD_ID"] = getFilter($REQ["G2-ADD_ID"],"SAFETEXT","/--미 정의--/");	

//G3, 보유 권한
$REQ["G3-GA_SEQ"] = reqPostNumber("G3-GA_SEQ",20);//GA_SEQ	
$REQ["G3-GA_SEQ"] = getFilter($REQ["G3-GA_SEQ"],"REGEXMAT","/^[0-9]{1}[0-9]*$/");	
$REQ["G3-GRP_SEQ"] = reqPostString("G3-GRP_SEQ",30);//GRP_SEQ	
$REQ["G3-GRP_SEQ"] = getFilter($REQ["G3-GRP_SEQ"],"REGEXMAT","/^[0-9]{1}[0-9]*$/");	
$REQ["G3-MNU_NM"] = reqPostString("G3-MNU_NM",30);//MNU_NM	
$REQ["G3-MNU_NM"] = getFilter($REQ["G3-MNU_NM"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-PGMID"] = reqPostString("G3-PGMID",20);//프로그램ID	
$REQ["G3-PGMID"] = getFilter($REQ["G3-PGMID"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G3-AUTH_ID"] = reqPostString("G3-AUTH_ID",50);//AUTH_ID	
$REQ["G3-AUTH_ID"] = getFilter($REQ["G3-AUTH_ID"],"REGEXMAT","/^[a-zA-Z]{1}[_a-zA-Z0-9]*$/");	
$REQ["G3-AUTH_NM"] = reqPostString("G3-AUTH_NM",50);//AUTH_NM	
$REQ["G3-AUTH_NM"] = getFilter($REQ["G3-AUTH_NM"],"SAFETEXT","/--미 정의--/");	
$REQ["G3-ADD_DT"] = reqPostString("G3-ADD_DT",14);//ADD	
$REQ["G3-ADD_DT"] = getFilter($REQ["G3-ADD_DT"],"REGEXMAT","/^[0-9]{1}[0-9]*$/");	
$REQ["G3-ADD_ID"] = reqPostString("G3-ADD_ID",30);//ADD_ID	
$REQ["G3-ADD_ID"] = getFilter($REQ["G3-ADD_ID"],"SAFETEXT","/--미 정의--/");	

//G4, 미보유 권한
$REQ["G4-AUTH_SEQ"] = reqPostNumber("G4-AUTH_SEQ",10);//AUTH_SEQ	
$REQ["G4-AUTH_SEQ"] = getFilter($REQ["G4-AUTH_SEQ"],"REGEXMAT","/^[0-9]{1}[0-9]*$/");	
$REQ["G4-PGMID"] = reqPostString("G4-PGMID",20);//프로그램ID	
$REQ["G4-PGMID"] = getFilter($REQ["G4-PGMID"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G4-MNU_NM"] = reqPostString("G4-MNU_NM",30);//MNU_NM	
$REQ["G4-MNU_NM"] = getFilter($REQ["G4-MNU_NM"],"CLEARTEXT","/--미 정의--/");	
$REQ["G4-AUTH_ID"] = reqPostString("G4-AUTH_ID",50);//AUTH_ID	
$REQ["G4-AUTH_ID"] = getFilter($REQ["G4-AUTH_ID"],"REGEXMAT","/^[a-zA-Z]{1}[_a-zA-Z0-9]*$/");	
$REQ["G4-AUTH_NM"] = reqPostString("G4-AUTH_NM",50);//AUTH_NM	
$REQ["G4-AUTH_NM"] = getFilter($REQ["G4-AUTH_NM"],"SAFETEXT","/--미 정의--/");	
$REQ["G4-USE_YN"] = reqPostString("G4-USE_YN",1);//USE_YN	
$REQ["G4-USE_YN"] = getFilter($REQ["G4-USE_YN"],"SAFETEXT","/--미 정의--/");	
$REQ["G4-ADD_DT"] = reqPostString("G4-ADD_DT",14);//ADD	
$REQ["G4-ADD_DT"] = getFilter($REQ["G4-ADD_DT"],"REGEXMAT","/^[0-9]{1}[0-9]*$/");	
$REQ["G4-MOD_DT"] = reqPostString("G4-MOD_DT",50);//MOD	
$REQ["G4-MOD_DT"] = getFilter($REQ["G4-MOD_DT"],"SAFETEXT","/--미 정의--/");	
$REQ["G2-XML"] = getXml2Array($_POST["G2-XML"]);//그룹목록	
	$REQ["G3-XML"] = getXml2Array($_POST["G3-XML"]);//보유 권한	
	$REQ["G4-XML"] = getXml2Array($_POST["G4-XML"]);//미보유 권한	
	//,  입력값 필터 
	$REQ["G2-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G2-XML"]
		,"COLORD"=>"GRP_SEQ,GRP_NM,USE_YN,ADD_DT,ADD_ID"
		,"VALID"=>
			array(
			"GRP_SEQ"=>array("STRING",30)	
			,"GRP_NM"=>array("STRING",30)	
			,"USE_YN"=>array("STRING",1)	
			,"ADD_DT"=>array("STRING",14)	
			,"ADD_ID"=>array("STRING",30)	
					)
		,"FILTER"=>
			array(
			"GRP_SEQ"=>array("REGEXMAT","/^[0-9]{1}[0-9]*$/")
			,"GRP_NM"=>array("SAFETEXT","/--미 정의--/")
			,"USE_YN"=>array("SAFETEXT","/--미 정의--/")
			,"ADD_DT"=>array("REGEXMAT","/^[0-9]{1}[0-9]*$/")
			,"ADD_ID"=>array("SAFETEXT","/--미 정의--/")
					)
	)
);
$REQ["G3-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G3-XML"]
		,"COLORD"=>"CHK,GA_SEQ,GRP_SEQ,MNU_NM,PGMID,AUTH_ID,AUTH_NM,ADD_DT,ADD_ID"
		,"VALID"=>
			array(
			"CHK"=>array("NUMBER",1)	
			,"GA_SEQ"=>array("NUMBER",20)	
			,"GRP_SEQ"=>array("STRING",30)	
			,"MNU_NM"=>array("STRING",30)	
			,"PGMID"=>array("STRING",20)	
			,"AUTH_ID"=>array("STRING",50)	
			,"AUTH_NM"=>array("STRING",50)	
			,"ADD_DT"=>array("STRING",14)	
			,"ADD_ID"=>array("STRING",30)	
					)
		,"FILTER"=>
			array(
			"CHK"=>array("REGEXMAT","/^([0-9a-zA-Z]|,)+$/")
			,"GA_SEQ"=>array("REGEXMAT","/^[0-9]{1}[0-9]*$/")
			,"GRP_SEQ"=>array("REGEXMAT","/^[0-9]{1}[0-9]*$/")
			,"MNU_NM"=>array("CLEARTEXT","/--미 정의--/")
			,"PGMID"=>array("REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/")
			,"AUTH_ID"=>array("REGEXMAT","/^[a-zA-Z]{1}[_a-zA-Z0-9]*$/")
			,"AUTH_NM"=>array("SAFETEXT","/--미 정의--/")
			,"ADD_DT"=>array("REGEXMAT","/^[0-9]{1}[0-9]*$/")
			,"ADD_ID"=>array("SAFETEXT","/--미 정의--/")
					)
	)
);
$REQ["G4-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G4-XML"]
		,"COLORD"=>"CHK,AUTH_SEQ,PGMID,MNU_NM,AUTH_ID,AUTH_NM,USE_YN,ADD_DT,MOD_DT"
		,"VALID"=>
			array(
			"CHK"=>array("NUMBER",1)	
			,"AUTH_SEQ"=>array("NUMBER",10)	
			,"PGMID"=>array("STRING",20)	
			,"MNU_NM"=>array("STRING",30)	
			,"AUTH_ID"=>array("STRING",50)	
			,"AUTH_NM"=>array("STRING",50)	
			,"USE_YN"=>array("STRING",1)	
			,"ADD_DT"=>array("STRING",14)	
			,"MOD_DT"=>array("STRING",50)	
					)
		,"FILTER"=>
			array(
			"CHK"=>array("REGEXMAT","/^([0-9a-zA-Z]|,)+$/")
			,"AUTH_SEQ"=>array("REGEXMAT","/^[0-9]{1}[0-9]*$/")
			,"PGMID"=>array("REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/")
			,"MNU_NM"=>array("CLEARTEXT","/--미 정의--/")
			,"AUTH_ID"=>array("REGEXMAT","/^[a-zA-Z]{1}[_a-zA-Z0-9]*$/")
			,"AUTH_NM"=>array("SAFETEXT","/--미 정의--/")
			,"USE_YN"=>array("SAFETEXT","/--미 정의--/")
			,"ADD_DT"=>array("REGEXMAT","/^[0-9]{1}[0-9]*$/")
			,"MOD_DT"=>array("SAFETEXT","/--미 정의--/")
					)
	)
);
	
$REQ["G3-CHK"] = $_POST["G3-CHK"];//CHK 받기
//filterGridChk($tStr,$tDataType,$tDataSize,$tValidType,$tValidRule)
$REQ["G3-CHK"] = filterGridChk($REQ["G3-CHK"],"NUMBER",20,"REGEXMAT","/^[0-9]{1}[0-9]*$/");//GA_SEQ 입력값검증
	$REQ["G4-CHK"] = $_POST["G4-CHK"];//CHK 받기
//filterGridChk($tStr,$tDataType,$tDataSize,$tValidType,$tValidRule)
$REQ["G4-CHK"] = filterGridChk($REQ["G4-CHK"],"NUMBER",10,"REGEXMAT","/^[0-9]{1}[0-9]*$/");//AUTH_SEQ 입력값검증
	array_push($_RTIME,array("[TIME 40.REQ_VALID]",microtime(true)));
	//서비스 클래스 생성
$objService = new grpauthmngService();
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
  		echo $objService->goG2Search(); //그룹목록, 조회
  		break;
	case "G3_SEARCH" :
  		echo $objService->goG3Search(); //보유 권한, 조회
  		break;
	case "G3_CHKSAVE" :
  		echo $objService->goG3Chksave(); //보유 권한, 선택 삭제
  		break;
	case "G4_SEARCH" :
  		echo $objService->goG4Search(); //미보유 권한, 조회
  		break;
	case "G4_CHKSAVE" :
  		echo $objService->goG4Chksave(); //미보유 권한, 선택 추가
  		break;
	default:
		JsonMsg("500","110","처리 명령을 찾을 수 없습니다. (no search ctl)");
		break;
}
	array_push($_RTIME,array("[TIME 50.SVC]",microtime(true)));
if($PGM_CFG["LOGTYPE"] == "POWER" || $PGM_CFG["LOGTYPE"] == "POWER_N_PI") $objAuth->logUsrAuthD($reqToken,$resToken);;	//권한변경 로그 저장
	array_push($_RTIME,array("[TIME 60.AUGHD_LOG]",microtime(true)));
//실행시간 검사
for($j=1;$j<sizeof($_RTIME);$j++){
	alog( $_RTIME[$j][0] . " " . number_format($_RTIME[$j][1]-$_RTIME[$j-1][1],4) );

	if($j == sizeof($_RTIME)-1) alog( "RUN TIME : " . number_format($_RTIME[$j][1]-$_RTIME[0][1],4) );
}
//서비스 클래스 비우기
unset($objService);
unset($objAuth);

alog("GrpauthmngControl___________________________end");

?>	