<?php
header("Content-Type: text/html; charset=UTF-8");
header("Cache-Control:no-cache");
header("Pragma:no-cache");

require_once("./include/incDB.php");
require_once("./include/incSEC.php");
require_once("./include/incUtil.php");
require_once("./incConfig.php");

//외부 파라미터 받기
$REQ["PJTSEQ"] = $_GET["PJTSEQ"];
$REQ["DOWN_CFG_YN"] = $_GET["DOWN_CFG_YN"];
$REQ["DOWN_LIB_YN"] = $_GET["DOWN_LIB_YN"];
$REQ["DOWN_INCLUDE_YN"] = $_GET["DOWN_INCLUDE_YN"];
$REQ["DOWN_PGM_YN"] = $_GET["DOWN_PGM_YN"];

if(!is_numeric($REQ["PJTSEQ"])){ServerMsg("500","000","PJTSEQ를 입력해 주세요.");}

//DB연결 정보 생성
$db = db_m_open();

$uppath = $CFG_UPLOAD_DIR;
$zip = new ZipArchive();
$filename = date("YmdHis_") . getRndVal(20) . ".zip";

echo "<br>make file : " . $uppath . $filename . "\n";

if ($zip->open($uppath . $filename, ZipArchive::CREATE)!==TRUE) {
    exit("<br>cannot open <$filename>\n");
}

//설명
$zip->addFromString("README.txt", "Create by CodeGen. Filename is " . $filename );

//incConfig.php 생성
if($REQ["DOWN_CFG_YN"] == "Y"){


    $T_SQL  = sprintf("select SVRID, SVRNM, DBHOST, DBPORT, DBNAME, DBUSRID, DBUSRPW from CG_SVR where PJTSEQ = %d", addSqlSlashes($REQ["PJTSEQ"]));
    $result = $db->query($T_SQL) or ServerMsg("500","300", "[" . $db->errno . "] " . $db->error) ;

    //$line2 = null;
    $arr = fetch_all($result,MYSQLI_ASSOC);
    $db_conn_str = "";
    for($k=0;$k<count($arr);$k++){
        $db_conn_str .= '
    //' . $arr[$k]["SVRNM"] . '
    $CFG_DB["' . $arr[$k]["SVRID"] . '"] = new stdClass();
    $CFG_DB["' . $arr[$k]["SVRID"] . '"]->MYSQL_HOST =  "'. $arr[$k]["DBHOST"] . '";
    $CFG_DB["' . $arr[$k]["SVRID"] . '"]->MYSQL_DB   =  "'. $arr[$k]["DBNAME"] . '";
    $CFG_DB["' . $arr[$k]["SVRID"] . '"]->MYSQL_ID   =  "'. $arr[$k]["DBUSRID"] . '";
    $CFG_DB["' . $arr[$k]["SVRID"] . '"]->MYSQL_PW   =  "'. aes_decrypt($arr[$k]["DBUSRPW"],$CFG_SEC_KEY) . '";  

        ';      
    }


    //CONFIG파일 생성
    $inc_cfg_str = '
    //세션시작
    session_start(); 

    //암호화 키
    $CFG_SEC_KEY = "bcb04b7e103a0cd8b54763051cef08bc55abe029fdebae5e1d417e2ffb2a00a3";
    $CFG_SEC_SALT = "codegen";

    //서버 PATH  정보들
    $CFG_ROOT_DIR = "/data/www/c.g/";

    //로그 저장 경로
    $CFG_LOG_PATH = $CFG_ROOT_DIR  . "log/cg_" . date("Ymd"). ".log"; 

    //업로드 폴더
    $CFG_UPLOAD_DIR =  $CFG_ROOT_DIR .  "up/" ;	  

    //DB연결 정보
    '. $db_conn_str;

    echo "<BR>inc_cfg_str = <pre>" . $inc_cfg_str . "</pre>";
    $zip->addFromString("inConfig.php", $inc_cfg_str);
}


//공통함수

//include/* 생성
if($REQ["DOWN_INCLUDE_YN"] == "Y"){
    $zip->addFile("./include/incDB.php", "include/incDB.php");
    $zip->addFile("./include/incUtil.php", "include/incUtil.php");
    $zip->addFile("./include/incLoginCheck.php", "include/incLoginCheck.php");
    $zip->addFile("./include/incUser.php", "include/incUser.php");
    $zip->addFile("./include/incSec.php", "include/incSec.php");
}

//lib/* 생성
if($REQ["DOWN_LIB_YN"] == "Y"){
    $zip->addFile("./lib/jquery.xml2json.js", "lib/jquery.xml2json.js");
    $zip->addFile("./lib/jquery-1.11.1.min.js", "lib/jquery-1.11.1.min.js");
    $zip->addFile("./lib/jquery-ui-1.8.18.css", "lib/jquery-ui-1.8.18.css");
    $zip->addFile("./lib/jquery-ui-1.11.1.min.js", "lib/jquery-ui-1.11.1.min.js");
    $zip->addFile("./lib/json2.min.js", "lib/json2.min.js");


    $zip = addDirectoryToZip($zip, "lib/codemirror", "");
    $zip = addDirectoryToZip($zip, "lib/dhtmlxSuite/codebase", "");
    $zip = addDirectoryToZip($zip, "lib/htmlpurifier-4.9.3", "");
    $zip = addDirectoryToZip($zip, "lib/js", "");
    $zip = addDirectoryToZip($zip, "lib/PHPExcel-1.8", "");
}

//프로그램 생성
if($REQ["DOWN_PGM_YN"] == "Y"){

    //공통JS
    $zip->addFile("./rst/cg_common.js", "rst/cg_common.js");

    //해당 프로젝트의 생성된 프로그램 목록중 ACTIVEYN = 'Y'불러오기
    $T_SQL  = sprintf("select VERSEQ, FILENM from CG_RSTFILE where PJTSEQ = %d and ACTIVEYN ='Y' ", addSqlSlashes($REQ["PJTSEQ"]));
    $result = $db->query($T_SQL) or ServerMsg("500","300", "DOWN_PGM_YN [" . $db->errno . "] " . $db->error) ;

    //$line2 = null;
    $arr = fetch_all($result,MYSQLI_ASSOC);

    for($k=0;$k<count($arr);$k++){
        $zip->addFile("./rst/" . $arr[$k]["FILENM"], "rst/". $arr[$k]["FILENM"]);
    }
}

//db닫기
$db->close();

//빈디렉토리 생성
$zip->addEmptyDir("log");
$zip->addEmptyDir("up");


echo "<br>numfiles: " . $zip->numFiles . "\n";
echo "<br>status:" . $zip->status . "\n";
$zip->close();
?><br>다운로드 : <a href="/c.g/up/<?=$filename?>"><?=$filename?></a>