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
chdir("./md");

$new_path = getcwd();
//echo "<BR>\n new_path =  " . $new_path ;

$F_CTL = reqGetString("CTL",100);

$F_CALLBACK = reqGetString("callback",100);
$F_DB = reqGetString("DB",30);
$F_DB = getFilter($F_DB,"REGEXMAT","/^[a-zA-Z0-9_]+$/");

$F_TARGET_DB = reqGetString("TARGET_DB",30);
$F_TARGET_DB = getFilter($F_TARGET_DB,"REGEXMAT","/^[a-zA-Z0-9_]+$/");

$F_TABLE = reqGetString("TABLE",100);
$F_TABLE = getFilter($F_TABLE,"REGEXMAT","/^[a-zA-Z0-9_]+$/");


//로컬에 파일 만들기
if($F_CTL =="MAKELOCALFILE"){

    
    // ex > mysqldump --single-transaction CG -h172.17.0.1 -utestid -ptestpwd CG_CODE CG_CODED CG_OBJINFO CG_OBJINFOA CG_OBJINFOB CG_OBJINFOD > CG_20200209_CODE_N_OBJINFO.sql
    
    // 파일 이름 정의
    $sqlFileNm = $F_DB . "-" . $F_TABLE . "_" . date("Ymd") . ".sql";
    $sqlFileNmMaster = $F_DB . "-" . $F_TABLE . ".sql";
    $sqlFileNmmasterBackup = $F_DB . "-" . $F_TABLE . "_BACKUP.sql";
    
    //10 기본 파일 백업하고
    $sh = "mysqldump --single-transaction " . $F_DB . " -h" . $CFG["CFG_DB"][$F_DB]["HOST"] . " -u" .$CFG["CFG_DB"][$F_DB]["ID"] . " -p" . aes_decrypt($CFG["CFG_DB"][$F_DB]["PW"],$CFG["CFG_SEC_KEY"]) . " " . $F_TABLE . " > " . $sqlFileNm;
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
}else if($F_CTL =="LOADFROMGITHUB"){
    //깃허브에서 데이터 파일 받아와서 db에 넣기.

    if($F_DB =="")JsonMsg("500","299","(LOADFROMGITHUB) DB 필수입력해야합니다.");
    if($F_TARGET_DB =="")JsonMsg("500","299","(LOADFROMGITHUB) TARGET_DB 필수입력해야합니다.");
    if($F_TABLE =="")JsonMsg("500","299","(LOADFROMGITHUB) TABLE 필수입력해야합니다.");

    // 파일 이름 정의
    $sqlFileNm = $F_DB . "-" . $F_TABLE . ".sql";
    $sqlFileNmBackup = $F_TARGET_DB . "-" . $F_TABLE . "_BACKUP_" . date("Ymd") . ".sql";
    
    //10 깃허브에서 데이터 파일 받아오기
    $sh1 = "wget -O " . $sqlFileNm . " https://raw.githubusercontent.com/zero12a/cg/master/md/" . $sqlFileNm ;
    shell_exec($sh1 . " 2>&1");

    //20 기존DB 백업하기
    $sh2 = "mysqldump --single-transaction " . $F_TARGET_DB .  " -h" . $CFG["CFG_DB"][$F_DB]["HOST"] . " -u" .$CFG["CFG_DB"][$F_DB]["ID"] . " -p" . aes_decrypt($CFG["CFG_DB"][$F_DB]["PW"],$CFG["CFG_SEC_KEY"]) . " " . $F_TABLE . " > " . $sqlFileNmBackup;
    shell_exec($sh2 . " 2>&1");

    //30 db에 부어 넣기.
    $sh3 = "mysql " . $F_TARGET_DB . " -h" . $CFG["mysql_m_host"] . " -u" . $CFG["mysql_m_userid"] . " -p" . $CFG["mysql_m_passwd"] . " < " . $sqlFileNm;
    shell_exec($sh3 . " 2>&1");


}else{
    JsonMsg("500","999","CTL 명령어가 없습니다.");
}



?>
<?=$F_CALLBACK?>({"RTN_CD":"200","ERR_CD":"<?=$F_TABLE?>","RTN_MSG":"test"})