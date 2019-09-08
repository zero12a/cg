<?php
header("Content-Type: text/html; charset=UTF-8"); //SVRCTL
header("Cache-Control:no-cache");
header("Pragma:no-cache");
$_RTIME = array();
array_push($_RTIME,array("[TIME 00.START]",microtime(true)));
include_once('codetestService.php');

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
alog("CodetestControl___________________________start");

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
}else if($objAuth->isAuth("CODETEST",$ctl)){
	$objAuth->LAUTH_SEQ = $objAuth->logUsrAuth($reqToken,$resToken,"CODETEST",$ctl,"Y");
}else{
	$objAuth->logUsrAuth($reqToken,$resToken,"CODETEST",$ctl,"N");
	JsonMsg("500","120",$ctl . " 권한이 없습니다.");
}
		//사용자 정보 가져오기
//로그 저장 방식 결정
//일반로그, 권한변경로그, PI로그
//NORMAL, POWER, PI
$PGM_CFG["SECTYPE"] = "NORMAL";
$PGM_CFG["SQLTXT"] = array();
array_push($_RTIME,array("[TIME 30.AUTH_CHECK]",microtime(true)));
$REQ["G4-CTLCUD"] = reqPostString("G4-CTLCUD",2);

//FILE먼저 : G1, 1
//FILE먼저 : G2, 마스터
//FILE먼저 : G3, 상세
//FILE먼저 : G4, 상세폼
$REQ["G4-TFILE-NM"] = $_FILES["G4-TFILE"]["name"];//파일
$REQ["G4-TFILE-TYPE"] = $_FILES["G4-TFILE"]["type"];//파일
$REQ["G4-TFILE-TMPNM"] = $_FILES["G4-TFILE"]["tmp_name"];//파일
$REQ["G4-TFILE-SIZE"] = $_FILES["G4-TFILE"]["size"];//파일
$REQ["G4-TFILE-ERROR"] = $_FILES["G4-TFILE"]["error"];//파일

//G1, 1
$REQ["G1-MYRADIO"] = reqPostString("G1-MYRADIO",30);//나의라디오	
$REQ["G1-MYRADIO"] = getFilter($REQ["G1-MYRADIO"],"CLEARTEXT","/--미 정의--/");	
$REQ["G1-ADD_DT"] = reqPostString("G1-ADD_DT",14);//ADD	
$REQ["G1-ADD_DT"] = getFilter($REQ["G1-ADD_DT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G1-PNM"] = reqPostString("G1-PNM",100);//PNM	
$REQ["G1-PNM"] = getFilter($REQ["G1-PNM"],"SAFETEXT","/--미 정의--/");	

//G2, 마스터
$REQ["G2-PCD"] = reqPostString("G2-PCD",30);//PCD	
$REQ["G2-PCD"] = getFilter($REQ["G2-PCD"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-PNM"] = reqPostString("G2-PNM",100);//PNM	
$REQ["G2-PNM"] = getFilter($REQ["G2-PNM"],"SAFETEXT","/--미 정의--/");	
$REQ["G2-PCDDESC"] = reqPostString("G2-PCDDESC",500);//PCDDESC	
$REQ["G2-PCDDESC"] = getFilter($REQ["G2-PCDDESC"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-ORD"] = reqPostNumber("G2-ORD",10);//ORD	
$REQ["G2-ORD"] = getFilter($REQ["G2-ORD"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-UITOOL"] = reqPostString("G2-UITOOL",10);//UITOOL	
$REQ["G2-UITOOL"] = getFilter($REQ["G2-UITOOL"],"SAFETEXT","/--미 정의--/");	
$REQ["G2-USEYN"] = reqPostString("G2-USEYN",1);//사용	
$REQ["G2-USEYN"] = getFilter($REQ["G2-USEYN"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G2-DELYN"] = reqPostString("G2-DELYN",1);//삭제YN	
$REQ["G2-DELYN"] = getFilter($REQ["G2-DELYN"],"SAFETEXT","/--미 정의--/");	
$REQ["G2-ADDDT"] = reqPostString("G2-ADDDT",14);//ADDDT	
$REQ["G2-ADDDT"] = getFilter($REQ["G2-ADDDT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-MODDT"] = reqPostString("G2-MODDT",14);//MODDT	
$REQ["G2-MODDT"] = getFilter($REQ["G2-MODDT"],"REGEXMAT","/^[0-9]+$/");	

//G3, 상세
$REQ["G3-CD"] = reqPostString("G3-CD",30);//CD	
$REQ["G3-CD"] = getFilter($REQ["G3-CD"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-NM"] = reqPostString("G3-NM",100);//NM	
$REQ["G3-NM"] = getFilter($REQ["G3-NM"],"SAFETEXT","/--미 정의--/");	
$REQ["G3-CDDESC"] = reqPostString("G3-CDDESC",200);//CDDESC	
$REQ["G3-CDDESC"] = getFilter($REQ["G3-CDDESC"],"SAFETEXT","/--미 정의--/");	
$REQ["G3-PCD"] = reqPostString("G3-PCD",30);//PCD	
$REQ["G3-PCD"] = getFilter($REQ["G3-PCD"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-ORD"] = reqPostNumber("G3-ORD",10);//ORD	
$REQ["G3-ORD"] = getFilter($REQ["G3-ORD"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-CDVAL"] = reqPostString("G3-CDVAL",30);//CDVAL	
$REQ["G3-CDVAL"] = getFilter($REQ["G3-CDVAL"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-CDVAL2"] = reqPostString("G3-CDVAL2",30);//CDVAL2	
$REQ["G3-CDVAL2"] = getFilter($REQ["G3-CDVAL2"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-CDMIN"] = reqPostString("G3-CDMIN",30);//CDMIN	
$REQ["G3-CDMIN"] = getFilter($REQ["G3-CDMIN"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-CDMAX"] = reqPostString("G3-CDMAX",30);//CDMAX	
$REQ["G3-CDMAX"] = getFilter($REQ["G3-CDMAX"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-DATATYPE"] = reqPostString("G3-DATATYPE",30);//데이터타입	
$REQ["G3-DATATYPE"] = getFilter($REQ["G3-DATATYPE"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G3-EDITYN"] = reqPostString("G3-EDITYN",1);//EDITYN	
$REQ["G3-EDITYN"] = getFilter($REQ["G3-EDITYN"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-FORMATYN"] = reqPostString("G3-FORMATYN",1);//FORMATYN	
$REQ["G3-FORMATYN"] = getFilter($REQ["G3-FORMATYN"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-USEYN"] = reqPostString("G3-USEYN",1);//사용	
$REQ["G3-USEYN"] = getFilter($REQ["G3-USEYN"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G3-DELYN"] = reqPostString("G3-DELYN",1);//삭제YN	
$REQ["G3-DELYN"] = getFilter($REQ["G3-DELYN"],"SAFETEXT","/--미 정의--/");	
$REQ["G3-ADDDT"] = reqPostString("G3-ADDDT",14);//ADDDT	
$REQ["G3-ADDDT"] = getFilter($REQ["G3-ADDDT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-MODDT"] = reqPostString("G3-MODDT",14);//MODDT	
$REQ["G3-MODDT"] = getFilter($REQ["G3-MODDT"],"REGEXMAT","/^[0-9]+$/");	

//G4, 상세폼
$REQ["G4-ADD_DT"] = reqPostString("G4-ADD_DT",14);//ADD	
$REQ["G4-ADD_DT"] = getFilter($REQ["G4-ADD_DT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G4-MYRADIO"] = reqPostString("G4-MYRADIO",30);//나의라디오	
$REQ["G4-MYRADIO"] = getFilter($REQ["G4-MYRADIO"],"CLEARTEXT","/--미 정의--/");	
$REQ["G4-HIDDENLINK"] = reqPostString("G4-HIDDENLINK",50);//히든링크	
$REQ["G4-HIDDENLINK"] = getFilter($REQ["G4-HIDDENLINK"],"CLEARTEXT","/--미 정의--/");	
$REQ["G4-PCD"] = reqPostString("G4-PCD",30);//PCD	
$REQ["G4-PCD"] = getFilter($REQ["G4-PCD"],"CLEARTEXT","/--미 정의--/");	
$REQ["G4-IMG"] = reqPostString("G4-IMG",200);//이미지뷰어	
$REQ["G4-IMG"] = getFilter($REQ["G4-IMG"],"CLEARTEXT","/--미 정의--/");	
$REQ["G4-TFILE"] = reqPostString("G4-TFILE",200);//파일	
$REQ["G4-TFILE"] = getFilter($REQ["G4-TFILE"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-XML"] = getXml2Array($_POST["G2-XML"]);//마스터	
	$REQ["G3-XML"] = getXml2Array($_POST["G3-XML"]);//상세	
	//,  입력값 필터 
	$REQ["G2-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G2-XML"]
		,"COLORD"=>"CHK,PCD,PNM,PCDDESC,ORD,UITOOL,USEYN,DELYN,ADDDT,MODDT"
		,"VALID"=>
			array(
			"CHK"=>array("NUMBER",1)	
			,"PCD"=>array("STRING",30)	
			,"PNM"=>array("STRING",100)	
			,"PCDDESC"=>array("STRING",500)	
			,"ORD"=>array("NUMBER",10)	
			,"UITOOL"=>array("STRING",10)	
			,"USEYN"=>array("STRING",1)	
			,"DELYN"=>array("STRING",1)	
			,"ADDDT"=>array("STRING",14)	
			,"MODDT"=>array("STRING",14)	
					)
		,"FILTER"=>
			array(
			"CHK"=>array("REGEXMAT","/^([0-9a-zA-Z]|,)+$/")
			,"PCD"=>array("CLEARTEXT","/--미 정의--/")
			,"PNM"=>array("SAFETEXT","/--미 정의--/")
			,"PCDDESC"=>array("CLEARTEXT","/--미 정의--/")
			,"ORD"=>array("REGEXMAT","/^[0-9]+$/")
			,"UITOOL"=>array("SAFETEXT","/--미 정의--/")
			,"USEYN"=>array("REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/")
			,"DELYN"=>array("SAFETEXT","/--미 정의--/")
			,"ADDDT"=>array("REGEXMAT","/^[0-9]+$/")
			,"MODDT"=>array("REGEXMAT","/^[0-9]+$/")
					)
	)
);
$REQ["G3-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G3-XML"]
		,"COLORD"=>"CD,NM,CDDESC,PCD,ORD,CDVAL,CDVAL2,CDMIN,CDMAX,DATATYPE,EDITYN,FORMATYN,USEYN,DELYN,ADDDT,MODDT"
		,"VALID"=>
			array(
			"CD"=>array("STRING",30)	
			,"NM"=>array("STRING",100)	
			,"CDDESC"=>array("STRING",200)	
			,"PCD"=>array("STRING",30)	
			,"ORD"=>array("NUMBER",10)	
			,"CDVAL"=>array("STRING",30)	
			,"CDVAL2"=>array("STRING",30)	
			,"CDMIN"=>array("STRING",30)	
			,"CDMAX"=>array("STRING",30)	
			,"DATATYPE"=>array("STRING",30)	
			,"EDITYN"=>array("STRING",1)	
			,"FORMATYN"=>array("STRING",1)	
			,"USEYN"=>array("STRING",1)	
			,"DELYN"=>array("STRING",1)	
			,"ADDDT"=>array("STRING",14)	
			,"MODDT"=>array("STRING",14)	
					)
		,"FILTER"=>
			array(
			"CD"=>array("CLEARTEXT","/--미 정의--/")
			,"NM"=>array("SAFETEXT","/--미 정의--/")
			,"CDDESC"=>array("SAFETEXT","/--미 정의--/")
			,"PCD"=>array("CLEARTEXT","/--미 정의--/")
			,"ORD"=>array("REGEXMAT","/^[0-9]+$/")
			,"CDVAL"=>array("CLEARTEXT","/--미 정의--/")
			,"CDVAL2"=>array("CLEARTEXT","/--미 정의--/")
			,"CDMIN"=>array("CLEARTEXT","/--미 정의--/")
			,"CDMAX"=>array("CLEARTEXT","/--미 정의--/")
			,"DATATYPE"=>array("REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/")
			,"EDITYN"=>array("CLEARTEXT","/--미 정의--/")
			,"FORMATYN"=>array("CLEARTEXT","/--미 정의--/")
			,"USEYN"=>array("REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/")
			,"DELYN"=>array("SAFETEXT","/--미 정의--/")
			,"ADDDT"=>array("REGEXMAT","/^[0-9]+$/")
			,"MODDT"=>array("REGEXMAT","/^[0-9]+$/")
					)
	)
);
$REQ["G1-MYCHECK"] = $_POST["G1-MYCHECK"];	//checkbox 받기
$REQ["G1-MYCHECK"] = filterGridChk($REQ["G1-MYCHECK"],"STRING",11,"CLEARTEXT","/--미 정의--/");//MYCHECK 입력값검증
$REQ["G4-MYCHECK"] = $_POST["G4-MYCHECK"];	//checkbox 받기
$REQ["G4-MYCHECK"] = filterFormviewChk($REQ["G4-MYCHECK"],"STRING",110,"CLEARTEXT","/--미 정의--/");//MYCHECK 입력값검증
$REQ["G2-CHK"] = $_POST["G2-CHK"];//CHK 받기
//filterGridChk($tStr,$tDataType,$tDataSize,$tValidType,$tValidRule)
$REQ["G2-CHK"] = filterGridChk($REQ["G2-CHK"],"STRING",30,"CLEARTEXT","/--미 정의--/");//PCD 입력값검증
	array_push($_RTIME,array("[TIME 40.REQ_VALID]",microtime(true)));
	//서비스 클래스 생성
$objService = new codetestService();
	//컨트롤 명령별 분개처리
alog("ctl:" . $ctl);
switch ($ctl){
			case "G1_SEARCHALL" :
  		echo $objService->goG1Searchall(); //1, 조회(전체)
  		break;
	case "G1_SAVE" :
  		echo $objService->goG1Save(); //1, 저장
  		break;
	case "G2_SEARCH" :
  		echo $objService->goG2Search(); //마스터, 조회
  		break;
	case "G2_SAVE" :
  		echo $objService->goG2Save(); //마스터, 저장
  		break;
	case "G2_CHKSAVE" :
  		echo $objService->goG2Chksave(); //마스터, 선택저장
  		break;
	case "G3_SEARCH" :
  		echo $objService->goG3Search(); //상세, 조회
  		break;
	case "G3_SAVE" :
  		echo $objService->goG3Save(); //상세, 저장
  		break;
	case "G3_EXCEL" :
  		echo $objService->goG3Excel(); //상세, 엑셀다운로드
  		break;
	case "G3_CHKSAVE" :
  		echo $objService->goG3Chksave(); //상세, 선택저장
  		break;
	case "G4_SEARCH" :
  		echo $objService->goG4Search(); //상세폼, 조회
  		break;
	case "G4_DELETE" :
  		echo $objService->goG4Delete(); //상세폼, 삭제
  		break;
	case "G4_save" :
  		echo $objService->goG4Save(); //상세폼, 저장
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

alog("CodetestControl___________________________end");

?>	