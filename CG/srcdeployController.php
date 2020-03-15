<?php
header("Content-Type: text/html; charset=UTF-8"); //SVRCTL
header("Cache-Control:no-cache");
header("Pragma:no-cache");
$_RTIME = array();
array_push($_RTIME,array("[TIME 00.START]",microtime(true)));
$CFG = require_once('../../common/include/incConfig.php');//CG CONFIG
require_once($CFG["CFG_LIBS_VENDOR"]);
require_once('srcdeployService.php');

array_push($_RTIME,array("[TIME 10.INCLUDE SERVICE]",microtime(true)));
require_once('../../common/include/incUtil.php');//CG UTIL
require_once('../../common/include/incRequest.php');//CG REQUEST
require_once('../../common/include/incDB.php');//CG DB
require_once('../../common/include/incSec.php');//CG SEC
require_once('../../common/include/incAuth.php');//CG AUTH
require_once('../../common/include/incUser.php');//CG USER
//하위에서 LOADDING LIB 처리
array_push($_RTIME,array("[TIME 20.IMPORT]",microtime(true)));
$reqToken = reqGetString("TOKEN",37);
$resToken = uniqid();

$log = getLogger(
	array(
	"LIST_NM"=>"log_CG"
	, "PGM_ID"=>"SRCDEPLOY"
	, "REQTOKEN" => $reqToken
	, "RESTOKEN" => $resToken
	, "LOG_LEVEL" => Monolog\Logger::ERROR
	)
);
$log->info("SrcdeployControl___________________________start");
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
}else if($objAuth->isAuth("SRCDEPLOY",$ctl)){
	$objAuth->LAUTH_SEQ = $objAuth->logUsrAuth($reqToken,$resToken,"SRCDEPLOY",$ctl,"Y");
}else{
	$objAuth->logUsrAuth($reqToken,$resToken,"SRCDEPLOY",$ctl,"N");
	JsonMsg("500","120",$ctl . " 권한이 없습니다.");
}
		//사용자 정보 가져오기
	$REQ["CFG.CFG_MAKE_URL"] = $CFG["CFG_MAKE_URL"];
//로그 저장 방식 결정
//일반로그, 권한변경로그, PI로그
//NORMAL, POWER, PI
$PGM_CFG["SECTYPE"] = "NORMAL";
$PGM_CFG["SQLTXT"] = array();
array_push($_RTIME,array("[TIME 30.AUTH_CHECK]",microtime(true)));
$REQ["G3-CTLCUD"] = reqPostString("G3-CTLCUD",2);

//FILE먼저 : G1, 
//FILE먼저 : G2, 프로젝트목록
//FILE먼저 : G3, 배포 상세

//G1,  - RW속성 오브젝트만 필터 적용 ( RO속성은 제외 )
$REQ["G1-PJTNM"] = reqPostString("G1-PJTNM",100);//프로젝트명	
$REQ["G1-PJTNM"] = getFilter($REQ["G1-PJTNM"],"SAFETEXT","/--미 정의--/");	

//G2, 프로젝트목록 - RW속성 오브젝트만 필터 적용 ( RO속성은 제외 )
$REQ["G2-PJTSEQ"] = reqPostNumber("G2-PJTSEQ",20);//PJTSEQ	
$REQ["G2-PJTSEQ"] = getFilter($REQ["G2-PJTSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-PJTID"] = reqPostString("G2-PJTID",30);//프로젝트ID	
$REQ["G2-PJTID"] = getFilter($REQ["G2-PJTID"],"SAFETEXT","/--미 정의--/");	
$REQ["G2-PJTNM"] = reqPostString("G2-PJTNM",100);//프로젝트명	
$REQ["G2-PJTNM"] = getFilter($REQ["G2-PJTNM"],"SAFETEXT","/--미 정의--/");	
$REQ["G2-FILECHARSET"] = reqPostString("G2-FILECHARSET",30);//파일 CHARSET	
$REQ["G2-FILECHARSET"] = getFilter($REQ["G2-FILECHARSET"],"SAFETEXT","/--미 정의--/");	
$REQ["G2-UITOOL"] = reqPostString("G2-UITOOL",10);//UITOOL	
$REQ["G2-UITOOL"] = getFilter($REQ["G2-UITOOL"],"SAFETEXT","/--미 정의--/");	
$REQ["G2-SVRLANG"] = reqPostString("G2-SVRLANG",10);//서버언어	
$REQ["G2-SVRLANG"] = getFilter($REQ["G2-SVRLANG"],"SAFETEXT","/--미 정의--/");	
$REQ["G2-DEPLOYKEY"] = reqPostString("G2-DEPLOYKEY",50);//DEPLOYKEY	
$REQ["G2-DEPLOYKEY"] = getFilter($REQ["G2-DEPLOYKEY"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-PKGROOT"] = reqPostString("G2-PKGROOT",10);//패키지ROOT	
$REQ["G2-PKGROOT"] = getFilter($REQ["G2-PKGROOT"],"SAFETEXT","/--미 정의--/");	
$REQ["G2-STARTDT"] = reqPostString("G2-STARTDT",8);//시작일	
$REQ["G2-STARTDT"] = getFilter($REQ["G2-STARTDT"],"SAFETEXT","/--미 정의--/");	
$REQ["G2-ENDDT"] = reqPostString("G2-ENDDT",8);//종료일	
$REQ["G2-ENDDT"] = getFilter($REQ["G2-ENDDT"],"SAFETEXT","/--미 정의--/");	
$REQ["G2-DELYN"] = reqPostString("G2-DELYN",1);//삭제YN	
$REQ["G2-DELYN"] = getFilter($REQ["G2-DELYN"],"SAFETEXT","/--미 정의--/");	
$REQ["G2-ADDDT"] = reqPostString("G2-ADDDT",14);//ADDDT	
$REQ["G2-ADDDT"] = getFilter($REQ["G2-ADDDT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-MODDT"] = reqPostString("G2-MODDT",14);//MODDT	
$REQ["G2-MODDT"] = getFilter($REQ["G2-MODDT"],"REGEXMAT","/^[0-9]+$/");	

//G3, 배포 상세 - RW속성 오브젝트만 필터 적용 ( RO속성은 제외 )
$REQ["G3-PJTSEQ"] = reqPostNumber("G3-PJTSEQ",20);//PJTSEQ	
$REQ["G3-PJTSEQ"] = getFilter($REQ["G3-PJTSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-PJTID"] = reqPostString("G3-PJTID",30);//프로젝트ID	
$REQ["G3-PJTID"] = getFilter($REQ["G3-PJTID"],"SAFETEXT","/--미 정의--/");	
$REQ["G3-PJTNM"] = reqPostString("G3-PJTNM",100);//프로젝트명	
$REQ["G3-PJTNM"] = getFilter($REQ["G3-PJTNM"],"SAFETEXT","/--미 정의--/");	
$REQ["G3-FILECHARSET"] = reqPostString("G3-FILECHARSET",30);//파일 CHARSET	
$REQ["G3-FILECHARSET"] = getFilter($REQ["G3-FILECHARSET"],"SAFETEXT","/--미 정의--/");	
$REQ["G3-UITOOL"] = reqPostString("G3-UITOOL",10);//UITOOL	
$REQ["G3-UITOOL"] = getFilter($REQ["G3-UITOOL"],"SAFETEXT","/--미 정의--/");	
$REQ["G3-SVRLANG"] = reqPostString("G3-SVRLANG",10);//서버언어	
$REQ["G3-SVRLANG"] = getFilter($REQ["G3-SVRLANG"],"SAFETEXT","/--미 정의--/");	
$REQ["G3-DEPLOYKEY"] = reqPostString("G3-DEPLOYKEY",50);//DEPLOYKEY	
$REQ["G3-DEPLOYKEY"] = getFilter($REQ["G3-DEPLOYKEY"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-PKGROOT"] = reqPostString("G3-PKGROOT",10);//패키지ROOT	
$REQ["G3-PKGROOT"] = getFilter($REQ["G3-PKGROOT"],"SAFETEXT","/--미 정의--/");	
$REQ["G3-STARTDT"] = reqPostString("G3-STARTDT",8);//시작일	
$REQ["G3-STARTDT"] = getFilter($REQ["G3-STARTDT"],"SAFETEXT","/--미 정의--/");	
$REQ["G3-ENDDT"] = reqPostString("G3-ENDDT",8);//종료일	
$REQ["G3-ENDDT"] = getFilter($REQ["G3-ENDDT"],"SAFETEXT","/--미 정의--/");	
$REQ["G3-DELYN"] = reqPostString("G3-DELYN",1);//삭제YN	
$REQ["G3-DELYN"] = getFilter($REQ["G3-DELYN"],"SAFETEXT","/--미 정의--/");	
$REQ["G2-XML"] = getXml2Array($_POST["G2-XML"]);//프로젝트목록	
//,  입력값 필터 
	$REQ["G2-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G2-XML"]
		,"COLORD"=>"PJTSEQ,PJTID,PJTNM,FILECHARSET,UITOOL,SVRLANG,DEPLOYKEY,PKGROOT,STARTDT,ENDDT,DELYN,ADDDT,MODDT"
		,"VALID"=>
			array(
			"PJTSEQ"=>array("NUMBER",20)	
			,"PJTID"=>array("STRING",30)	
			,"PJTNM"=>array("STRING",100)	
			,"FILECHARSET"=>array("STRING",30)	
			,"UITOOL"=>array("STRING",10)	
			,"SVRLANG"=>array("STRING",10)	
			,"DEPLOYKEY"=>array("STRING",50)	
			,"PKGROOT"=>array("STRING",10)	
			,"STARTDT"=>array("STRING",8)	
			,"ENDDT"=>array("STRING",8)	
			,"DELYN"=>array("STRING",1)	
			,"ADDDT"=>array("STRING",14)	
			,"MODDT"=>array("STRING",14)	
					)
		,"FILTER"=>
			array(
			"PJTSEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"PJTID"=>array("SAFETEXT","/--미 정의--/")
			,"PJTNM"=>array("SAFETEXT","/--미 정의--/")
			,"FILECHARSET"=>array("SAFETEXT","/--미 정의--/")
			,"UITOOL"=>array("SAFETEXT","/--미 정의--/")
			,"SVRLANG"=>array("SAFETEXT","/--미 정의--/")
			,"DEPLOYKEY"=>array("CLEARTEXT","/--미 정의--/")
			,"PKGROOT"=>array("SAFETEXT","/--미 정의--/")
			,"STARTDT"=>array("SAFETEXT","/--미 정의--/")
			,"ENDDT"=>array("SAFETEXT","/--미 정의--/")
			,"DELYN"=>array("SAFETEXT","/--미 정의--/")
			,"ADDDT"=>array("REGEXMAT","/^[0-9]+$/")
			,"MODDT"=>array("REGEXMAT","/^[0-9]+$/")
					)
	)
);
array_push($_RTIME,array("[TIME 40.REQ_VALID]",microtime(true)));
	//서비스 클래스 생성
$objService = new srcdeployService();
//컨트롤 명령별 분개처리
$log->info("ctl:" . $ctl);
switch ($ctl){
		case "G1_SEARCHALL" :
  		echo $objService->goG1Searchall(); //, 조회(전체)
  		break;
	case "G2_SEARCH" :
  		echo $objService->goG2Search(); //프로젝트목록, 조회
  		break;
	case "G2_SAVE" :
  		echo $objService->goG2Save(); //프로젝트목록, 저장
  		break;
	case "G2_EXCEL" :
  		echo $objService->goG2Excel(); //프로젝트목록, 엑셀다운로드
  		break;
	case "G3_EXCEL" :
  		echo $objService->goG3Excel(); //배포 상세, 엑셀다운로드
  		break;
	case "G3_SEARCH" :
  		echo $objService->goG3Search(); //배포 상세, 조회
  		break;
	case "G3_SAVE" :
  		echo $objService->goG3Save(); //배포 상세, 저장
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

$log->info("SrcdeployControl___________________________end");
$log->close(); unset($log);
?>
