<?php
header("Content-Type: text/html; charset=UTF-8"); //SVRCTL
header("Cache-Control:no-cache");
header("Pragma:no-cache");
$_RTIME = array();
array_push($_RTIME,array("[TIME 00.START]",microtime(true)));
$CFG = include_once('./incConfig.CG.php');//CG CONFIG
include_once('authmngService.php');

array_push($_RTIME,array("[TIME 10.INCLUDE SERVICE]",microtime(true)));
include_once('../include/incUtil.php');//CG UTIL
include_once('../include/incRequest.php');//CG REQUEST
include_once('../include/incDB.php');//CG DB
include_once('../include/incSec.php');//CG SEC
include_once('../include/incAuth.php');//CG AUTH
include_once('../include/incUser.php');//CG USER
//하위에서 LOADDING LIB 처리
	array_push($_RTIME,array("[TIME 20.IMPORT]",microtime(true)));
$reqToken = reqGetString("TOKEN",37);
$resToken = uniqid();

$log = getLogger(
	array(
	"LIST_NM"=>"log_CG"
	, "PGM_ID"=>"AUTHMNG"
	, "REQTOKEN" => $reqToken
	, "RESTOKEN" => $resToken
	)
);
$log->info("AuthmngControl___________________________start");
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
}else if($objAuth->isAuth("AUTHMNG",$ctl)){
	$objAuth->LAUTH_SEQ = $objAuth->logUsrAuth($reqToken,$resToken,"AUTHMNG",$ctl,"Y");
}else{
	$objAuth->logUsrAuth($reqToken,$resToken,"AUTHMNG",$ctl,"N");
	JsonMsg("500","120",$ctl . " 권한이 없습니다.");
}
		//사용자 정보 가져오기
//로그 저장 방식 결정
//일반로그, 권한변경로그, PI로그
//NORMAL, POWER, PI
$PGM_CFG["SECTYPE"] = "POWER";
$PGM_CFG["SQLTXT"] = array();
array_push($_RTIME,array("[TIME 30.AUTH_CHECK]",microtime(true)));
$REQ["G3-CTLCUD"] = reqPostString("G3-CTLCUD",2);

//FILE먼저 : G1, 조회조건
//FILE먼저 : G2, 권한목록
//FILE먼저 : G3, 권한상세

//G1, 조회조건
$REQ["G1-PGMID"] = reqPostString("G1-PGMID",20);//프로그램ID	
$REQ["G1-PGMID"] = getFilter($REQ["G1-PGMID"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	

//G2, 권한목록
$REQ["G2-AUTH_SEQ"] = reqPostNumber("G2-AUTH_SEQ",10);//AUTH_SEQ	
$REQ["G2-AUTH_SEQ"] = getFilter($REQ["G2-AUTH_SEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-PGMID"] = reqPostString("G2-PGMID",20);//프로그램ID	
$REQ["G2-PGMID"] = getFilter($REQ["G2-PGMID"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G2-AUTH_ID"] = reqPostString("G2-AUTH_ID",50);//AUTH_ID	
$REQ["G2-AUTH_ID"] = getFilter($REQ["G2-AUTH_ID"],"REGEXMAT","/^[a-zA-Z]{1}[_a-zA-Z0-9]*$/");	
$REQ["G2-AUTH_NM"] = reqPostString("G2-AUTH_NM",50);//AUTH_NM	
$REQ["G2-AUTH_NM"] = getFilter($REQ["G2-AUTH_NM"],"SAFETEXT","/--미 정의--/");	
$REQ["G2-USE_YN"] = reqPostString("G2-USE_YN",1);//USE_YN	
$REQ["G2-USE_YN"] = getFilter($REQ["G2-USE_YN"],"SAFETEXT","/--미 정의--/");	
$REQ["G2-ADD_DT"] = reqPostString("G2-ADD_DT",14);//ADD	
$REQ["G2-ADD_DT"] = getFilter($REQ["G2-ADD_DT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-MOD_DT"] = reqPostString("G2-MOD_DT",14);//MOD	
$REQ["G2-MOD_DT"] = getFilter($REQ["G2-MOD_DT"],"SAFETEXT","/--미 정의--/");	
$REQ["G2-PGMID2"] = reqPostString("G2-PGMID2",30);//PGMID2	
$REQ["G2-PGMID2"] = getFilter($REQ["G2-PGMID2"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	

//G3, 권한상세
$REQ["G2-XML"] = getXml2Array($_POST["G2-XML"]);//권한목록	
	//,  입력값 필터 
	$REQ["G2-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G2-XML"]
		,"COLORD"=>"CHK,AUTH_SEQ,PGMID,AUTH_ID,AUTH_NM,USE_YN,ADD_DT,MOD_DT,PGMID2"
		,"VALID"=>
			array(
			"CHK"=>array("NUMBER",1)	
			,"AUTH_SEQ"=>array("NUMBER",10)	
			,"PGMID"=>array("STRING",20)	
			,"AUTH_ID"=>array("STRING",50)	
			,"AUTH_NM"=>array("STRING",50)	
			,"USE_YN"=>array("STRING",1)	
			,"ADD_DT"=>array("STRING",14)	
			,"MOD_DT"=>array("STRING",14)	
			,"PGMID2"=>array("STRING",30)	
					)
		,"FILTER"=>
			array(
			"CHK"=>array("REGEXMAT","/^([0-9a-zA-Z]|,)+$/")
			,"AUTH_SEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"PGMID"=>array("REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/")
			,"AUTH_ID"=>array("REGEXMAT","/^[a-zA-Z]{1}[_a-zA-Z0-9]*$/")
			,"AUTH_NM"=>array("SAFETEXT","/--미 정의--/")
			,"USE_YN"=>array("SAFETEXT","/--미 정의--/")
			,"ADD_DT"=>array("REGEXMAT","/^[0-9]+$/")
			,"MOD_DT"=>array("SAFETEXT","/--미 정의--/")
			,"PGMID2"=>array("REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/")
					)
	)
);
$REQ["G2-CHK"] = $_POST["G2-CHK"];//CHK 받기
//filterGridChk($tStr,$tDataType,$tDataSize,$tValidType,$tValidRule)
$REQ["G2-CHK"] = filterGridChk($REQ["G2-CHK"],"NUMBER",10,"REGEXMAT","/^[0-9]+$/");//AUTH_SEQ 입력값검증
	array_push($_RTIME,array("[TIME 40.REQ_VALID]",microtime(true)));
	//서비스 클래스 생성
$objService = new authmngService();
	//컨트롤 명령별 분개처리
$log->info("ctl:" . $ctl);
switch ($ctl){
			case "G1_SEARCHALL" :
  		echo $objService->goG1Searchall(); //조회조건, 조회(전체)
  		break;
	case "G1_SAVE" :
  		echo $objService->goG1Save(); //조회조건, 저장
  		break;
	case "G2_SEARCH" :
  		echo $objService->goG2Search(); //권한목록, 조회
  		break;
	case "G2_SAVE" :
  		echo $objService->goG2Save(); //권한목록, S
  		break;
	case "G2_EXCEL" :
  		echo $objService->goG2Excel(); //권한목록, E
  		break;
	case "G2_CHKSAVE" :
  		echo $objService->goG2Chksave(); //권한목록, 선택 삭제
  		break;
	case "G3_SEARCH" :
  		echo $objService->goG3Search(); //권한상세, 조회
  		break;
	case "G3_SAVE" :
  		echo $objService->goG3Save(); //권한상세, 저장
  		break;
	case "G3_DELETE" :
  		echo $objService->goG3Delete(); //권한상세, 삭제
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
	$log->debug( $_RTIME[$j][0] . " " . number_format($_RTIME[$j][1]-$_RTIME[$j-1][1],4) );

	if($j == sizeof($_RTIME)-1) $log->debug( "RUN TIME : " . number_format($_RTIME[$j][1]-$_RTIME[0][1],4) );
}
//서비스 클래스 비우기
unset($objService);
unset($objAuth);

$log->info("AuthmngControl___________________________end");
$log->close(); unset($log);
?>
