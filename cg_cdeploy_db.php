<?php
header("Content-Type: text/html; charset=UTF-8"); //SVRCTL
header("Cache-Control:no-cache");
header("Pragma:no-cache");

//설정 함수 읽기
$CFG = require_once '../common/include/incConfig.php';
if(!include_once '../common/include/incDB.php')			echo "include fail(2)";
if(!include_once '../common/include/incUtil.php')		echo "include fail(3)";
if(!include_once '../common/include/incSec.php')		echo "include fail(4)";
if(!include_once '../common/include/incUser.php')		echo "include fail(5)";
if(!include_once '../common/include/incRequest.php')		echo "include fail(6)";

$old_path = getcwd();
//echo "<BR>\n old_path =  " . $old_path ;
chdir($CFG["CFG_DEPLOY_MAKE_ROOT"] . "/md");

$new_path = getcwd();
//echo "<BR>\n new_path =  " . $new_path ;

$F_CALLBACK = reqGetString("callback",100);
$F_DB = reqGetString("DB",30);
$F_DB = getFilter($F_DB,"REGEXMAT","/^[a-zA-Z0-9_]+$/");

$F_TABLE = reqGetString("TABLE",100);
$F_TABLE = getFilter($F_TABLE,"REGEXMAT","/^[a-zA-Z0-9_]+$/");

// ex > mysqldump --single-transaction CG -h172.17.0.1 -utestid -ptestpwd CG_CODE CG_CODED CG_OBJINFO CG_OBJINFOA CG_OBJINFOB CG_OBJINFOD > CG_20200209_CODE_N_OBJINFO.sql

// 파일 이름 정의
$sqlFileNm = $F_DB . "-" . $F_TABLE . "_" . date("Ymd") . ".sql";
$sqlFileNmMaster = $F_DB . "-" . $F_TABLE . ".sql";
$sqlFileNmmasterBackup = $F_DB . "-" . $F_TABLE . "_BACKUP.sql";

//10 기본 파일 백업하고
$sh = "mysqldump --single-transaction " . $F_DB . " -h" . $CFG["mysql_m_host"] . " -u" . $CFG["mysql_m_userid"] . " -p" . $CFG["mysql_m_passwd"] . " " . $F_TABLE . " > " . $sqlFileNm;
//echo "<BR> sh = " . $sh;
//echo "<BR>\n 10. mysqldump db is " . $F_DB . ", table is " . $F_TABLE . " = " . shell_exec($sh . " 2>&1");

shell_exec($sh . " 2>&1");


//20 기존 마스터 파일을 백업하기
$sh2 = "mv " . $sqlFileNmMaster . " " . $sqlFileNmmasterBackup;

//echo "<BR>\n 20. backup master -> old = " . shell_exec($sh2 . " 2>&1");
shell_exec($sh2 . " 2>&1");

//30 새로 생성한 파일을 오늘날짜로 카피
$sh3 = "cp " . $sqlFileNm . " " . $sqlFileNmMaster;
//echo "<BR>\n 30. copy today -> master = " . shell_exec($sh3 . " 2>&1");
shell_exec($sh3 . " 2>&1");


?>
<?=$F_CALLBACK?>({"RTN_CD":"200","ERR_CD":"<?=$F_TABLE?>","RTN_MSG":"test"})