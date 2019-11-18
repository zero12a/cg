<?php
    header("Content-Type: text/html; charset=UTF-8");
    header("Cache-Control:no-cache");
    header("Pragma:no-cache");

    $CFG = include_once("./incConfig.php");
    include_once('./include/incSec.php');//CG SEC
    include_once("./include/incUtil.php");
	include_once('./include/incRequest.php');//CG REQUEST    

    include_once("./include/incDB.php");
    include_once("./include/incUser.php");

    include_once("./cg_pgmmng_svc.php");
    include_once('./cg_pgmmng_dao.php');
    //ServerViewTxt("N","N","Y","Y");

    $db=db_m_open();

	//내부함수 호출 후 리던 배열 
	$rtnArr = array();

    //그룹ID받기
    $F_GRPID = $_GET['F_GRPID'];
    $F_PJTID = $_GET['F_PJTID'];
    $F_PGMID = $_GET['F_PGMID'];
    $F_PJTSEQ = $_GET['F_PJTSEQ'];
    $F_PGMSEQ = $_GET['F_PGMSEQ'];
    $F_PGMNM = $_GET['F_PGMNM'];
    $F_DT_TYPE = $_GET['F_DT_TYPE'];
    $F_START_DT = str_replace("-","",$_GET['F_START_DT']); //날짜 타입은 - 제거
    $F_END_DT = str_replace("-","",$_GET['F_END_DT']); //날짜 타입은 - 제거

    //컬럼ROW받기 GRPID,GRPTYPE,GRPNM,GRPORD,BRCNT,REFGRPID,GRPWIDTH,GRPHEIGHT,
 


    //로그인 정보
    $REQ["ADDID"] = getUserSeq();
    $REQ["MODID"] = $REQ["ADDID"];

    //그룹ID받기
    $REQ["F_GRPID"] = $_GET['F_GRPID'];
    $REQ["F_GRPSEQ"] = $_GET['F_GRPSEQ'];
    $REQ["F_PJTSEQ"] = $_GET['F_PJTSEQ'];
    $REQ["F_PGMSEQ"] = $_GET['F_PGMSEQ'];
    $REQ["F_PGMNM"] = $_GET['F_PGMNM'];
    $REQ["F_DT_TYPE"] = $_GET['F_DT_TYPE'];
    $REQ["F_START_DT"] = str_replace("-","",$_GET['F_START_DT']); //날짜 타입은 - 제거
    $REQ["F_END_DT"] = str_replace("-","",$_GET['F_END_DT']); //날짜 타입은 - 제거


    $REQ["G1-PJTSEQ"]   = $_GET['G1-PJTSEQ'];
    $REQ["G1-PGMSEQ"]   = $_GET['G1-PGMSEQ'];
    $REQ["G1-GRPSEQ"]   = $_GET['G1-GRPSEQ'];
    $REQ["G1-GRPTYPE"]   = $_GET['G1-GRPTYPE'];    
    $REQ["G1-GRPID"]   = $_GET['G1-GRPID'];
    $REQ["G1-PCD"]	   = $_GET['G1-PCD'];

    $REQ["G5-PJTSEQ"]   = $_GET['G5-PJTSEQ'];
    $REQ["G5-PGMSEQ"]   = $_GET['G5-PGMSEQ'];
    $REQ["G5-GRPSEQ"]   = $_GET['G5-GRPSEQ'];
    $REQ["G5-FNCSEQ"]   = $_GET['G5-FNCSEQ'];

    $REQ["G2-PJTSEQ"]   = $_GET['G2-PJTSEQ'];
    $REQ["G2-PGMSEQ"]   = $_GET['G2-PGMSEQ'];
    $REQ["G2-GRPSEQ"]   = $_GET['G2-GRPSEQ'];
    $REQ["G2-FNCSEQ"]   = $_GET['G2-FNCSEQ'];
    $REQ["G2-SQLID"]   = $_GET['G2-SQLID'];
    $REQ["G2-SQLSEQ"]   = $_GET['G2-SQLSEQ'];

    $REQ["G9-SVCSEQ"]  = $_GET['G9-SVCSEQ'];
    $REQ["G9-PJTSEQ"]   = $_GET['G9-PJTSEQ'];
    $REQ["G9-PGMSEQ"]   = $_GET['G9-PGMSEQ'];
    $REQ["G9-GRPSEQ"]   = $_GET['G9-GRPSEQ'];
    $REQ["G9-FNCSEQ"]   = $_GET['G9-FNCSEQ'];

    $REQ["G1_CRUD_MODE"]    = $_GET['G1_CRUD_MODE'];
    $REQ["G2_CRUD_MODE"]    = $_GET['G2_CRUD_MODE'];
    $REQ["G2_CRUD"]         = $_GET['G2_CRUD'];
    $REQ["G3_CRUD_MODE"]    = $_GET['G3_CRUD_MODE'];
    $REQ["G4_CRUD_MODE"]    = $_GET['G4_CRUD_MODE'];
    $REQ["G5_CRUD_MODE"]    = $_GET['G5_CRUD_MODE'];
    $REQ["G6_CRUD_MODE"]    = $_GET['G6_CRUD_MODE'];
    $REQ["G7_CRUD_MODE"]    = $_GET['G7_CRUD_MODE'];
    $REQ["G8_CRUD_MODE"]    = $_GET['G8_CRUD_MODE'];
    $REQ["G9_CRUD_MODE"]    = $_GET['G9_CRUD_MODE'];
    $REQ["G10_CRUD_MODE"]    = $_GET['G10_CRUD_MODE'];
    $REQ["G11_CRUD_MODE"]    = $_GET['G11_CRUD_MODE'];
    $REQ["G12_CRUD_MODE"]    = $_GET['G12_CRUD_MODE'];
    $REQ["G13_CRUD_MODE"]    = $_GET['G13_CRUD_MODE'];

    $REQ["PGM_CRUD_MODE"]    = $_GET['PGM_CRUD_MODE'];
    $REQ["POP_PGMID"]    = $_POST['POP_PGMID'];
    $REQ["POP_PGMNM"]    = $_POST['POP_PGMNM'];
    $REQ["POP_PJTSEQ"]    = $_POST['POP_PJTSEQ'];
	alog("POP_PGMID=" . $_POST['POP_PGMID']);
	alog("POP_PGMNM=" . $_POST['POP_PGMNM']);
	alog("POP_PJTSEQ=" . $_POST['POP_PJTSEQ']);

	$REQ["POP_PGMNM"] = "%" . $REQ["POP_PGMNM"] . "%";
	

    $REQ["F_LAYOUTID"]    = $_POST['F_LAYOUTID'];
    $REQ["searchdd"]    = $_POST['searchdd'];


    $REQ["GRP-XML"] = getXml2Array($_POST["GRP-XML"]);//GRP
    $REQ["FNC-XML"] = getXml2Array($_POST["FNC-XML"]);//FNC
    $REQ["IO-XML"] = getXml2Array($_POST["IO-XML"]);//IO
    $REQ["INHERIT-XML"] = getXml2Array($_POST["INHERIT-XML"]);//INHERIT
    $REQ["SVC-XML"] = getXml2Array($_POST["SVC-XML"]);//SVC
    $REQ["SQLR-XML"] = getXml2Array($_POST["SQLR-XML"]);//SQLR
    $REQ["SQL-XML"] = getXml2Array($_POST["SQL-XML"]);//SQL
    $REQ["SQLD-XML"] = getXml2Array($_POST["SQLD-XML"]);//SQLD

    //서비스 클래스 생성
    $objService = new cg_pgminfo_svc();

    //컨트롤 명령 받기
    $ctl = "";
    $ctl1 = reqGetString("CTLGRP",50);
    $ctl2 = reqGetString("CTLFNC",50);
    
    if($ctl1 == "" || $ctl2 == ""){
        JsonMsg("500","100","처리 명령이 잘못되었습니다.(no input ctl)");
    }else{
        $ctl = $ctl1 . "_" . $ctl2;
    }

    alog("ctl:" . $ctl);
    switch ($ctl){
           
        case "PGM_SEARCH" :
            echo $objService->goPgmSearch(); //
            break;                                          
        default:
            JsonMsg("500","110","처리 명령을 찾을 수 없습니다. (no search ctl)");
            break;
    }





?>
