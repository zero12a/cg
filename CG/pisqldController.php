<?php
header("Content-Type: text/html; charset=UTF-8"); //SVRCTL
header("Cache-Control:no-cache");
header("Pragma:no-cache");
$_RTIME = array();
array_push($_RTIME,array("[TIME 00.START]",microtime(true)));
$CFG = include_once('../../common/include/incConfig.php');//CG CONFIG
include_once('pisqldService.php');

array_push($_RTIME,array("[TIME 10.INCLUDE SERVICE]",microtime(true)));
include_once('../../common/include/incUtil.php');//CG UTIL
include_once('../../common/include/incRequest.php');//CG REQUEST
include_once('../../common/include/incDB.php');//CG DB
include_once('../../common/include/incSec.php');//CG SEC
include_once('../../common/include/incAuth.php');//CG AUTH
include_once('../../common/include/incUser.php');//CG USER
//하위에서 LOADDING LIB 처리
array_push($_RTIME,array("[TIME 20.IMPORT]",microtime(true)));
$reqToken = reqGetString("TOKEN",37);
$resToken = uniqid();

$log = getLogger(
	array(
	"LIST_NM"=>"log_CG"
	, "PGM_ID"=>"PISQLD"
	, "REQTOKEN" => $reqToken
	, "RESTOKEN" => $resToken
	, "LOG_LEVEL" => Monolog\Logger::ERROR
	)
);
$log->info("PisqldControl___________________________start");
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
}else if($objAuth->isAuth("PISQLD",$ctl)){
	$objAuth->LAUTH_SEQ = $objAuth->logUsrAuth($reqToken,$resToken,"PISQLD",$ctl,"Y");
}else{
	$objAuth->logUsrAuth($reqToken,$resToken,"PISQLD",$ctl,"N");
	JsonMsg("500","120",$ctl . " 권한이 없습니다.");
}
		//사용자 정보 가져오기
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
$REQ["G1-PGMSEQ"] = reqPostNumber("G1-PGMSEQ",30);//PGMSEQ	
$REQ["G1-PGMSEQ"] = getFilter($REQ["G1-PGMSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G1-COLID"] = reqPostString("G1-COLID",30);//컬럼ID	
$REQ["G1-COLID"] = getFilter($REQ["G1-COLID"],"CLEARTEXT","/--미 정의--/");	
$REQ["G1-PJTSEQ"] = reqPostNumber("G1-PJTSEQ",20);//PJTSEQ	
$REQ["G1-PJTSEQ"] = getFilter($REQ["G1-PJTSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G1-SQLSEQ"] = reqPostNumber("G1-SQLSEQ",30);//SQLSEQ	
$REQ["G1-SQLSEQ"] = getFilter($REQ["G1-SQLSEQ"],"REGEXMAT","/^[0-9]+$/");	

//G2, 
$REQ["G2-SQLSEQ"] = reqPostNumber("G2-SQLSEQ",30);//SQLSEQ	
$REQ["G2-SQLSEQ"] = getFilter($REQ["G2-SQLSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-COLSEQ"] = reqPostNumber("G2-COLSEQ",30);//COLSEQ	
$REQ["G2-COLSEQ"] = getFilter($REQ["G2-COLSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-PJTSEQ"] = reqPostNumber("G2-PJTSEQ",20);//PJTSEQ	
$REQ["G2-PJTSEQ"] = getFilter($REQ["G2-PJTSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-PGMSEQ"] = reqPostNumber("G2-PGMSEQ",30);//PGMSEQ	
$REQ["G2-PGMSEQ"] = getFilter($REQ["G2-PGMSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-SQLGBN"] = reqPostString("G2-SQLGBN",1);//SQLGBN	
$REQ["G2-SQLGBN"] = getFilter($REQ["G2-SQLGBN"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-COLID"] = reqPostString("G2-COLID",30);//컬럼ID	
$REQ["G2-COLID"] = getFilter($REQ["G2-COLID"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-DDCOLID"] = reqPostString("G2-DDCOLID",50);//DDCOLID	
$REQ["G2-DDCOLID"] = getFilter($REQ["G2-DDCOLID"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-REQUIREYN"] = reqPostString("G2-REQUIREYN",1);//필수	
$REQ["G2-REQUIREYN"] = getFilter($REQ["G2-REQUIREYN"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G2-ORD"] = reqPostNumber("G2-ORD",10);//ORD	
$REQ["G2-ORD"] = getFilter($REQ["G2-ORD"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-MODDT"] = reqPostString("G2-MODDT",14);//MODDT	
$REQ["G2-MODDT"] = getFilter($REQ["G2-MODDT"],"REGEXMAT","/^[0-9]+$/");	

//G3, 
$REQ["G3-SQLSEQ"] = reqPostNumber("G3-SQLSEQ",30);//SQLSEQ	
$REQ["G3-SQLSEQ"] = getFilter($REQ["G3-SQLSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-COLSEQ"] = reqPostNumber("G3-COLSEQ",30);//COLSEQ	
$REQ["G3-COLSEQ"] = getFilter($REQ["G3-COLSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-PJTSEQ"] = reqPostNumber("G3-PJTSEQ",20);//PJTSEQ	
$REQ["G3-PJTSEQ"] = getFilter($REQ["G3-PJTSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-PGMSEQ"] = reqPostNumber("G3-PGMSEQ",30);//PGMSEQ	
$REQ["G3-PGMSEQ"] = getFilter($REQ["G3-PGMSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-SQLGBN"] = reqPostString("G3-SQLGBN",1);//SQLGBN	
$REQ["G3-SQLGBN"] = getFilter($REQ["G3-SQLGBN"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-COLID"] = reqPostString("G3-COLID",30);//컬럼ID	
$REQ["G3-COLID"] = getFilter($REQ["G3-COLID"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-DDCOLID"] = reqPostString("G3-DDCOLID",50);//DDCOLID	
$REQ["G3-DDCOLID"] = getFilter($REQ["G3-DDCOLID"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-REQUIREYN"] = reqPostString("G3-REQUIREYN",1);//필수	
$REQ["G3-REQUIREYN"] = getFilter($REQ["G3-REQUIREYN"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G3-ORD"] = reqPostNumber("G3-ORD",10);//ORD	
$REQ["G3-ORD"] = getFilter($REQ["G3-ORD"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-MODDT"] = reqPostString("G3-MODDT",14);//MODDT	
$REQ["G3-MODDT"] = getFilter($REQ["G3-MODDT"],"REGEXMAT","/^[0-9]+$/");	
//,  입력값 필터 
	array_push($_RTIME,array("[TIME 40.REQ_VALID]",microtime(true)));
	//서비스 클래스 생성
$objService = new pisqldService();
	//컨트롤 명령별 분개처리
$log->info("ctl:" . $ctl);
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
	$log->debug( $_RTIME[$j][0] . " " . number_format($_RTIME[$j][1]-$_RTIME[$j-1][1],4) );

	if($j == sizeof($_RTIME)-1) $log->debug( "RUN TIME : " . number_format($_RTIME[$j][1]-$_RTIME[0][1],4) );
}
//서비스 클래스 비우기
unset($objService);
unset($objAuth);

$log->info("PisqldControl___________________________end");
$log->close(); unset($log);
?>
