<?php
header("Content-Type: text/html; charset=UTF-8"); //SVRCTL
header("Cache-Control:no-cache");
header("Pragma:no-cache");
$_RTIME = array();
array_push($_RTIME,array("[TIME 00.START]",microtime(true)));
$CFG = require_once('../../common/include/incConfig.php');//CG CONFIG
require_once($CFG["CFG_LIBS_VENDOR"]);
require_once('piioService.php');

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
	, "PGM_ID"=>"PIIO"
	, "REQTOKEN" => $reqToken
	, "RESTOKEN" => $resToken
	, "LOG_LEVEL" => Monolog\Logger::ERROR
	)
);
$log->info("PiioControl___________________________start");
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
}else if($objAuth->isAuth("PIIO",$ctl)){
	$objAuth->LAUTH_SEQ = $objAuth->logUsrAuth($reqToken,$resToken,"PIIO",$ctl,"Y");
}else{
	$objAuth->logUsrAuth($reqToken,$resToken,"PIIO",$ctl,"N");
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
$REQ["G1-COLID"] = reqPostString("G1-COLID",30);//컬럼ID	
$REQ["G1-COLID"] = getFilter($REQ["G1-COLID"],"CLEARTEXT","/--미 정의--/");	
$REQ["G1-COLNM"] = reqPostString("G1-COLNM",30);//컬럼명	
$REQ["G1-COLNM"] = getFilter($REQ["G1-COLNM"],"CLEARTEXT","/--미 정의--/");	
$REQ["G1-PJTSEQ"] = reqPostNumber("G1-PJTSEQ",20);//PJTSEQ	
$REQ["G1-PJTSEQ"] = getFilter($REQ["G1-PJTSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G1-PGMSEQ"] = reqPostNumber("G1-PGMSEQ",30);//PGMSEQ	
$REQ["G1-PGMSEQ"] = getFilter($REQ["G1-PGMSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G1-GRPSEQ"] = reqPostNumber("G1-GRPSEQ",30);//GRPSEQ	
$REQ["G1-GRPSEQ"] = getFilter($REQ["G1-GRPSEQ"],"REGEXMAT","/^[0-9]+$/");	

//G2, 
$REQ["G2-PJTSEQ"] = reqPostNumber("G2-PJTSEQ",20);//PJTSEQ	
$REQ["G2-PJTSEQ"] = getFilter($REQ["G2-PJTSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-PGMSEQ"] = reqPostNumber("G2-PGMSEQ",30);//PGMSEQ	
$REQ["G2-PGMSEQ"] = getFilter($REQ["G2-PGMSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-GRPSEQ"] = reqPostNumber("G2-GRPSEQ",30);//GRPSEQ	
$REQ["G2-GRPSEQ"] = getFilter($REQ["G2-GRPSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-IOSEQ"] = reqPostNumber("G2-IOSEQ",30);//IOSEQ	
$REQ["G2-IOSEQ"] = getFilter($REQ["G2-IOSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-COLORD"] = reqPostNumber("G2-COLORD",3);//COLORD	
$REQ["G2-COLORD"] = getFilter($REQ["G2-COLORD"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-COLID"] = reqPostString("G2-COLID",30);//컬럼ID	
$REQ["G2-COLID"] = getFilter($REQ["G2-COLID"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-COLNM"] = reqPostString("G2-COLNM",30);//컬럼명	
$REQ["G2-COLNM"] = getFilter($REQ["G2-COLNM"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-DATATYPE"] = reqPostString("G2-DATATYPE",30);//데이터타입	
$REQ["G2-DATATYPE"] = getFilter($REQ["G2-DATATYPE"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G2-VALIDSEQ"] = reqPostNumber("G2-VALIDSEQ",30);//VALIDSEQ	
$REQ["G2-VALIDSEQ"] = getFilter($REQ["G2-VALIDSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-DATASIZE"] = reqPostNumber("G2-DATASIZE",30);//데이터사이즈	
$REQ["G2-DATASIZE"] = getFilter($REQ["G2-DATASIZE"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-OBJTYPE"] = reqPostString("G2-OBJTYPE",30);//오브젝트타입	
$REQ["G2-OBJTYPE"] = getFilter($REQ["G2-OBJTYPE"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G2-POPUP"] = reqPostString("G2-POPUP",60);//POPUP	
$REQ["G2-POPUP"] = getFilter($REQ["G2-POPUP"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-KEYYN"] = reqPostString("G2-KEYYN",60);//KEYYN	
$REQ["G2-KEYYN"] = getFilter($REQ["G2-KEYYN"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G2-SEQYN"] = reqPostString("G2-SEQYN",60);//SEQYN	
$REQ["G2-SEQYN"] = getFilter($REQ["G2-SEQYN"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G2-LBLHIDDENYN"] = reqPostString("G2-LBLHIDDENYN",60);//LBLHIDDENYN	
$REQ["G2-LBLHIDDENYN"] = getFilter($REQ["G2-LBLHIDDENYN"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G2-LBLWIDTH"] = reqPostString("G2-LBLWIDTH",30);//라벨가로	
$REQ["G2-LBLWIDTH"] = getFilter($REQ["G2-LBLWIDTH"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-LBLALIGN"] = reqPostString("G2-LBLALIGN",20);//LBLALIGN	
$REQ["G2-LBLALIGN"] = getFilter($REQ["G2-LBLALIGN"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G2-OBJWIDTH"] = reqPostString("G2-OBJWIDTH",30);//오브젝트가로	
$REQ["G2-OBJWIDTH"] = getFilter($REQ["G2-OBJWIDTH"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-OBJHEIGHT"] = reqPostString("G2-OBJHEIGHT",30);//오브젝트세로	
$REQ["G2-OBJHEIGHT"] = getFilter($REQ["G2-OBJHEIGHT"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-OBJALIGN"] = reqPostString("G2-OBJALIGN",30);//가로정렬	
$REQ["G2-OBJALIGN"] = getFilter($REQ["G2-OBJALIGN"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-HIDDENYN"] = reqPostString("G2-HIDDENYN",60);//HIDDENYN	
$REQ["G2-HIDDENYN"] = getFilter($REQ["G2-HIDDENYN"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-EDITYN"] = reqPostString("G2-EDITYN",1);//EDITYN	
$REQ["G2-EDITYN"] = getFilter($REQ["G2-EDITYN"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-FNINIT"] = reqPostString("G2-FNINIT",60);//FNINIT	
$REQ["G2-FNINIT"] = getFilter($REQ["G2-FNINIT"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-BRYN"] = reqPostString("G2-BRYN",60);//BRYN	
$REQ["G2-BRYN"] = getFilter($REQ["G2-BRYN"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-FORMAT"] = reqPostString("G2-FORMAT",60);//FORMAT	
$REQ["G2-FORMAT"] = getFilter($REQ["G2-FORMAT"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-FOOTERMATH"] = reqPostString("G2-FOOTERMATH",60);//FOOTERMATH	
$REQ["G2-FOOTERMATH"] = getFilter($REQ["G2-FOOTERMATH"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-FOOTERNM"] = reqPostString("G2-FOOTERNM",60);//FOOTERNM	
$REQ["G2-FOOTERNM"] = getFilter($REQ["G2-FOOTERNM"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-ICONNM"] = reqPostString("G2-ICONNM",60);//ICONNM	
$REQ["G2-ICONNM"] = getFilter($REQ["G2-ICONNM"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-ICONSTYLE"] = reqPostString("G2-ICONSTYLE",60);//ICONSTYLE	
$REQ["G2-ICONSTYLE"] = getFilter($REQ["G2-ICONSTYLE"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-LBLSTYLE"] = reqPostString("G2-LBLSTYLE",60);//LBLSTYLE	
$REQ["G2-LBLSTYLE"] = getFilter($REQ["G2-LBLSTYLE"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-OBJSTYLE"] = reqPostString("G2-OBJSTYLE",70);//OBJSTYLE	
$REQ["G2-OBJSTYLE"] = getFilter($REQ["G2-OBJSTYLE"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-OBJ2STYLE"] = reqPostString("G2-OBJ2STYLE",70);//OBJ2STYLE	
$REQ["G2-OBJ2STYLE"] = getFilter($REQ["G2-OBJ2STYLE"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-ADDDT"] = reqPostString("G2-ADDDT",14);//ADDDT	
$REQ["G2-ADDDT"] = getFilter($REQ["G2-ADDDT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-ADDID"] = reqPostNumber("G2-ADDID",10);//ADDID	
$REQ["G2-ADDID"] = getFilter($REQ["G2-ADDID"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-MODDT"] = reqPostString("G2-MODDT",14);//MODDT	
$REQ["G2-MODDT"] = getFilter($REQ["G2-MODDT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-MODID"] = reqPostNumber("G2-MODID",10);//MODID	
$REQ["G2-MODID"] = getFilter($REQ["G2-MODID"],"REGEXMAT","/^[0-9]+$/");	

//G3, 
$REQ["G3-PJTSEQ"] = reqPostNumber("G3-PJTSEQ",20);//PJTSEQ	
$REQ["G3-PJTSEQ"] = getFilter($REQ["G3-PJTSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-PGMSEQ"] = reqPostNumber("G3-PGMSEQ",30);//PGMSEQ	
$REQ["G3-PGMSEQ"] = getFilter($REQ["G3-PGMSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-GRPSEQ"] = reqPostNumber("G3-GRPSEQ",30);//GRPSEQ	
$REQ["G3-GRPSEQ"] = getFilter($REQ["G3-GRPSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-IOSEQ"] = reqPostNumber("G3-IOSEQ",30);//IOSEQ	
$REQ["G3-IOSEQ"] = getFilter($REQ["G3-IOSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-COLORD"] = reqPostNumber("G3-COLORD",3);//COLORD	
$REQ["G3-COLORD"] = getFilter($REQ["G3-COLORD"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-COLID"] = reqPostString("G3-COLID",30);//컬럼ID	
$REQ["G3-COLID"] = getFilter($REQ["G3-COLID"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-COLNM"] = reqPostString("G3-COLNM",30);//컬럼명	
$REQ["G3-COLNM"] = getFilter($REQ["G3-COLNM"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-DATATYPE"] = reqPostString("G3-DATATYPE",30);//데이터타입	
$REQ["G3-DATATYPE"] = getFilter($REQ["G3-DATATYPE"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G3-VALIDSEQ"] = reqPostNumber("G3-VALIDSEQ",30);//VALIDSEQ	
$REQ["G3-VALIDSEQ"] = getFilter($REQ["G3-VALIDSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-DATASIZE"] = reqPostNumber("G3-DATASIZE",30);//데이터사이즈	
$REQ["G3-DATASIZE"] = getFilter($REQ["G3-DATASIZE"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-OBJTYPE"] = reqPostString("G3-OBJTYPE",30);//오브젝트타입	
$REQ["G3-OBJTYPE"] = getFilter($REQ["G3-OBJTYPE"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G3-POPUP"] = reqPostString("G3-POPUP",60);//POPUP	
$REQ["G3-POPUP"] = getFilter($REQ["G3-POPUP"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-KEYYN"] = reqPostString("G3-KEYYN",60);//KEYYN	
$REQ["G3-KEYYN"] = getFilter($REQ["G3-KEYYN"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G3-SEQYN"] = reqPostString("G3-SEQYN",60);//SEQYN	
$REQ["G3-SEQYN"] = getFilter($REQ["G3-SEQYN"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G3-LBLHIDDENYN"] = reqPostString("G3-LBLHIDDENYN",60);//LBLHIDDENYN	
$REQ["G3-LBLHIDDENYN"] = getFilter($REQ["G3-LBLHIDDENYN"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G3-LBLWIDTH"] = reqPostString("G3-LBLWIDTH",30);//라벨가로	
$REQ["G3-LBLWIDTH"] = getFilter($REQ["G3-LBLWIDTH"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-LBLALIGN"] = reqPostString("G3-LBLALIGN",20);//LBLALIGN	
$REQ["G3-LBLALIGN"] = getFilter($REQ["G3-LBLALIGN"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G3-OBJWIDTH"] = reqPostString("G3-OBJWIDTH",30);//오브젝트가로	
$REQ["G3-OBJWIDTH"] = getFilter($REQ["G3-OBJWIDTH"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-OBJHEIGHT"] = reqPostString("G3-OBJHEIGHT",30);//오브젝트세로	
$REQ["G3-OBJHEIGHT"] = getFilter($REQ["G3-OBJHEIGHT"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-OBJALIGN"] = reqPostString("G3-OBJALIGN",30);//가로정렬	
$REQ["G3-OBJALIGN"] = getFilter($REQ["G3-OBJALIGN"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-HIDDENYN"] = reqPostString("G3-HIDDENYN",60);//HIDDENYN	
$REQ["G3-HIDDENYN"] = getFilter($REQ["G3-HIDDENYN"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-EDITYN"] = reqPostString("G3-EDITYN",1);//EDITYN	
$REQ["G3-EDITYN"] = getFilter($REQ["G3-EDITYN"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-FNINIT"] = reqPostString("G3-FNINIT",60);//FNINIT	
$REQ["G3-FNINIT"] = getFilter($REQ["G3-FNINIT"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-BRYN"] = reqPostString("G3-BRYN",60);//BRYN	
$REQ["G3-BRYN"] = getFilter($REQ["G3-BRYN"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-FORMAT"] = reqPostString("G3-FORMAT",60);//FORMAT	
$REQ["G3-FORMAT"] = getFilter($REQ["G3-FORMAT"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-FOOTERMATH"] = reqPostString("G3-FOOTERMATH",60);//FOOTERMATH	
$REQ["G3-FOOTERMATH"] = getFilter($REQ["G3-FOOTERMATH"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-FOOTERNM"] = reqPostString("G3-FOOTERNM",60);//FOOTERNM	
$REQ["G3-FOOTERNM"] = getFilter($REQ["G3-FOOTERNM"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-ICONNM"] = reqPostString("G3-ICONNM",60);//ICONNM	
$REQ["G3-ICONNM"] = getFilter($REQ["G3-ICONNM"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-ICONSTYLE"] = reqPostString("G3-ICONSTYLE",60);//ICONSTYLE	
$REQ["G3-ICONSTYLE"] = getFilter($REQ["G3-ICONSTYLE"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-LBLSTYLE"] = reqPostString("G3-LBLSTYLE",60);//LBLSTYLE	
$REQ["G3-LBLSTYLE"] = getFilter($REQ["G3-LBLSTYLE"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-OBJSTYLE"] = reqPostString("G3-OBJSTYLE",70);//OBJSTYLE	
$REQ["G3-OBJSTYLE"] = getFilter($REQ["G3-OBJSTYLE"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-OBJ2STYLE"] = reqPostString("G3-OBJ2STYLE",70);//OBJ2STYLE	
$REQ["G3-OBJ2STYLE"] = getFilter($REQ["G3-OBJ2STYLE"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-ADDDT"] = reqPostString("G3-ADDDT",14);//ADDDT	
$REQ["G3-ADDDT"] = getFilter($REQ["G3-ADDDT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-ADDID"] = reqPostNumber("G3-ADDID",10);//ADDID	
$REQ["G3-ADDID"] = getFilter($REQ["G3-ADDID"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-MODDT"] = reqPostString("G3-MODDT",14);//MODDT	
$REQ["G3-MODDT"] = getFilter($REQ["G3-MODDT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-MODID"] = reqPostNumber("G3-MODID",10);//MODID	
$REQ["G3-MODID"] = getFilter($REQ["G3-MODID"],"REGEXMAT","/^[0-9]+$/");	
//,  입력값 필터 
	array_push($_RTIME,array("[TIME 40.REQ_VALID]",microtime(true)));
	//서비스 클래스 생성
$objService = new piioService();
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

$log->info("PiioControl___________________________end");
$log->close(); unset($log);
?>
