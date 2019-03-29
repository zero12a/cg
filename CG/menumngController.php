<?php
header("Content-Type: text/html; charset=UTF-8"); //SVRCTL
header("Cache-Control:no-cache");
header("Pragma:no-cache");
$_RTIME = array();
array_push($_RTIME,array("[TIME 00.START]",microtime(true)));
include_once('menumngService.php');

array_push($_RTIME,array("[TIME 10.INCLUDE SERVICE]",microtime(true)));
include_once('../include/incUtil.php');//CG UTIL
	include_once('../include/incRequest.php');//CG REQUEST
	include_once('../include/incDB.php');//CG DB
	include_once('../include/incSEC.php');//CG SEC
	include_once('../include/incAuth.php');//CG AUTH
	include_once('./incConfig.CG.php');//CG CONFIG
	include_once('../include/incUser.php');//CG USER
	//하위에서 LOADDING LIB 처리
	array_push($_RTIME,array("[TIME 20.IMPORT]",microtime(true)));
alog("MenumngControl___________________________start");

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
}else if($objAuth->isAuth("MENUMNG",$ctl)){
	$objAuth->LAUTH_SEQ = $objAuth->logUsrAuth($reqToken,$resToken,"MENUMNG",$ctl,"Y");
}else{
	$objAuth->logUsrAuth($reqToken,$resToken,"MENUMNG",$ctl,"N");
	JsonMsg("500","120",$ctl . " 권한이 없습니다.");
}
		//사용자 정보 가져오기
//로그 저장 방식 결정
//일반로그, 권한변경로그, PI로그
//NORMAL, POWER, PI
$PGM_CFG["SECTYPE"] = "POWER";
$PGM_CFG["SQLTXT"] = array();
array_push($_RTIME,array("[TIME 30.AUTH_CHECK]",microtime(true)));

//로그인정보 및 환경경수 받기
$REQ["USER.SEQ"] = getUserSeq();

//FILE먼저 : G1, 조회조건
//FILE먼저 : G2, 폴더
//FILE먼저 : G3, 메뉴

//G1, 조회조건

//G2, 폴더
$REQ["G2-FOLDER_SEQ"] = reqPostNumber("G2-FOLDER_SEQ",30);//FOLDER_SEQ	
$REQ["G2-FOLDER_SEQ"] = getFilter($REQ["G2-FOLDER_SEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-FOLDER_NM"] = reqPostString("G2-FOLDER_NM",30);//FOLDER_NM	
$REQ["G2-FOLDER_NM"] = getFilter($REQ["G2-FOLDER_NM"],"SAFETEXT","/--미 정의--/");	
$REQ["G2-USE_YN"] = reqPostString("G2-USE_YN",1);//USE_YN	
$REQ["G2-USE_YN"] = getFilter($REQ["G2-USE_YN"],"SAFETEXT","/--미 정의--/");	
$REQ["G2-FOLDER_ORD"] = reqPostNumber("G2-FOLDER_ORD",30);//FOLDER_ORD	
$REQ["G2-FOLDER_ORD"] = getFilter($REQ["G2-FOLDER_ORD"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-ADD_DT"] = reqPostString("G2-ADD_DT",14);//ADD	
$REQ["G2-ADD_DT"] = getFilter($REQ["G2-ADD_DT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-ADD_ID"] = reqPostString("G2-ADD_ID",30);//ADD_ID	
$REQ["G2-ADD_ID"] = getFilter($REQ["G2-ADD_ID"],"SAFETEXT","/--미 정의--/");	
$REQ["G2-MOD_DT"] = reqPostString("G2-MOD_DT",14);//MOD	
$REQ["G2-MOD_DT"] = getFilter($REQ["G2-MOD_DT"],"SAFETEXT","/--미 정의--/");	
$REQ["G2-MOD_ID"] = reqPostString("G2-MOD_ID",30);//MOD_ID	
$REQ["G2-MOD_ID"] = getFilter($REQ["G2-MOD_ID"],"SAFETEXT","/--미 정의--/");	

//G3, 메뉴
$REQ["G3-MNU_SEQ"] = reqPostString("G3-MNU_SEQ",20);//MNU_SEQ	
$REQ["G3-MNU_SEQ"] = getFilter($REQ["G3-MNU_SEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-PGMID"] = reqPostString("G3-PGMID",20);//프로그램ID	
$REQ["G3-PGMID"] = getFilter($REQ["G3-PGMID"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G3-MNU_NM"] = reqPostString("G3-MNU_NM",30);//MNU_NM	
$REQ["G3-MNU_NM"] = getFilter($REQ["G3-MNU_NM"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-URL"] = reqPostString("G3-URL",50);//URL	
$REQ["G3-URL"] = getFilter($REQ["G3-URL"],"SAFETEXT","/--미 정의--/");	
$REQ["G3-PGMTYPE"] = reqPostString("G3-PGMTYPE",10);//PGMTYPE	
$REQ["G3-PGMTYPE"] = getFilter($REQ["G3-PGMTYPE"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-MNU_ORD"] = reqPostString("G3-MNU_ORD",30);//MNU_ORD	
$REQ["G3-MNU_ORD"] = getFilter($REQ["G3-MNU_ORD"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-FOLDER_SEQ"] = reqPostNumber("G3-FOLDER_SEQ",30);//FOLDER_SEQ	
$REQ["G3-FOLDER_SEQ"] = getFilter($REQ["G3-FOLDER_SEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-USE_YN"] = reqPostString("G3-USE_YN",1);//USE_YN	
$REQ["G3-USE_YN"] = getFilter($REQ["G3-USE_YN"],"SAFETEXT","/--미 정의--/");	
$REQ["G3-ADD_DT"] = reqPostString("G3-ADD_DT",14);//ADD	
$REQ["G3-ADD_DT"] = getFilter($REQ["G3-ADD_DT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-ADD_ID"] = reqPostString("G3-ADD_ID",30);//ADD_ID	
$REQ["G3-ADD_ID"] = getFilter($REQ["G3-ADD_ID"],"SAFETEXT","/--미 정의--/");	
$REQ["G3-MOD_ID"] = reqPostString("G3-MOD_ID",30);//MOD_ID	
$REQ["G3-MOD_ID"] = getFilter($REQ["G3-MOD_ID"],"SAFETEXT","/--미 정의--/");	
$REQ["G3-MOD_DT"] = reqPostString("G3-MOD_DT",14);//MOD	
$REQ["G3-MOD_DT"] = getFilter($REQ["G3-MOD_DT"],"SAFETEXT","/--미 정의--/");	
$REQ["G2-XML"] = getXml2Array($_POST["G2-XML"]);//폴더	
	$REQ["G3-XML"] = getXml2Array($_POST["G3-XML"]);//메뉴	
	//,  입력값 필터 
	$REQ["G2-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G2-XML"]
		,"COLORD"=>"FOLDER_SEQ,FOLDER_NM,USE_YN,FOLDER_ORD,ADD_DT,ADD_ID,MOD_DT,MOD_ID"
		,"VALID"=>
			array(
			"FOLDER_SEQ"=>array("NUMBER",30)	
			,"FOLDER_NM"=>array("STRING",30)	
			,"USE_YN"=>array("STRING",1)	
			,"FOLDER_ORD"=>array("NUMBER",30)	
			,"ADD_DT"=>array("STRING",14)	
			,"ADD_ID"=>array("STRING",30)	
			,"MOD_DT"=>array("STRING",14)	
			,"MOD_ID"=>array("STRING",30)	
					)
		,"FILTER"=>
			array(
			"FOLDER_SEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"FOLDER_NM"=>array("SAFETEXT","/--미 정의--/")
			,"USE_YN"=>array("SAFETEXT","/--미 정의--/")
			,"FOLDER_ORD"=>array("REGEXMAT","/^[0-9]+$/")
			,"ADD_DT"=>array("REGEXMAT","/^[0-9]+$/")
			,"ADD_ID"=>array("SAFETEXT","/--미 정의--/")
			,"MOD_DT"=>array("SAFETEXT","/--미 정의--/")
			,"MOD_ID"=>array("SAFETEXT","/--미 정의--/")
					)
	)
);
$REQ["G3-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G3-XML"]
		,"COLORD"=>"CHK,MNU_SEQ,PGMID,MNU_NM,URL,PGMTYPE,MNU_ORD,FOLDER_SEQ,USE_YN,ADD_DT,ADD_ID,MOD_ID,MOD_DT"
		,"VALID"=>
			array(
			"CHK"=>array("NUMBER",1)	
			,"MNU_SEQ"=>array("STRING",20)	
			,"PGMID"=>array("STRING",20)	
			,"MNU_NM"=>array("STRING",30)	
			,"URL"=>array("STRING",50)	
			,"PGMTYPE"=>array("STRING",10)	
			,"MNU_ORD"=>array("STRING",30)	
			,"FOLDER_SEQ"=>array("NUMBER",30)	
			,"USE_YN"=>array("STRING",1)	
			,"ADD_DT"=>array("STRING",14)	
			,"ADD_ID"=>array("STRING",30)	
			,"MOD_ID"=>array("STRING",30)	
			,"MOD_DT"=>array("STRING",14)	
					)
		,"FILTER"=>
			array(
			"CHK"=>array("REGEXMAT","/^([0-9a-zA-Z]|,)+$/")
			,"MNU_SEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"PGMID"=>array("REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/")
			,"MNU_NM"=>array("CLEARTEXT","/--미 정의--/")
			,"URL"=>array("SAFETEXT","/--미 정의--/")
			,"PGMTYPE"=>array("CLEARTEXT","/--미 정의--/")
			,"MNU_ORD"=>array("REGEXMAT","/^[0-9]+$/")
			,"FOLDER_SEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"USE_YN"=>array("SAFETEXT","/--미 정의--/")
			,"ADD_DT"=>array("REGEXMAT","/^[0-9]+$/")
			,"ADD_ID"=>array("SAFETEXT","/--미 정의--/")
			,"MOD_ID"=>array("SAFETEXT","/--미 정의--/")
			,"MOD_DT"=>array("SAFETEXT","/--미 정의--/")
					)
	)
);
	
$REQ["G3-CHK"] = $_POST["G3-CHK"];//CHK 받기
//filterGridChk($tStr,$tDataType,$tDataSize,$tValidType,$tValidRule)
$REQ["G3-CHK"] = filterGridChk($REQ["G3-CHK"],"STRING",20,"REGEXMAT","/^[0-9]+$/");//MNU_SEQ 입력값검증
	array_push($_RTIME,array("[TIME 40.REQ_VALID]",microtime(true)));
	//서비스 클래스 생성
$objService = new menumngService();
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
  		echo $objService->goG2Search(); //폴더, 조회
  		break;
	case "G2_SAVE" :
  		echo $objService->goG2Save(); //폴더, S
  		break;
	case "G2_EXCEL" :
  		echo $objService->goG2Excel(); //폴더, 엑셀다운로드
  		break;
	case "G2_CHKSAVE" :
  		echo $objService->goG2Chksave(); //폴더, 선택저장
  		break;
	case "G3_SEARCH" :
  		echo $objService->goG3Search(); //메뉴, 조회
  		break;
	case "G3_SAVE" :
  		echo $objService->goG3Save(); //메뉴, S
  		break;
	case "G3_EXCEL" :
  		echo $objService->goG3Excel(); //메뉴, 엑셀다운로드
  		break;
	case "G3_CHKSAVE" :
  		echo $objService->goG3Chksave(); //메뉴, 선택 삭제
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

alog("MenumngControl___________________________end");

?>	