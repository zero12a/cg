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
$REQ["DEPLOYKEY"] = $_GET["DEPLOY_KEY"]; //배포 인증키

alog("REQ.DEPLOYKEY = " . $REQ["DEPLOYKEY"] );

$REQ["FILE_LIST_YN"] = $_GET["FILE_LIST_YN"];
$REQ["PGMSEQ"] = $_GET["PGMSEQ"];
$REQ["FILESEQ"] = $_GET["FILESEQ"];
$REQ["FILEHASH"] = $_GET["FILEHASH"];
$REQ["FILE_FILENM"] = $_GET["FILE_FILENM"];
$REQ["PGM_LIST_YN"] = $_GET["PGM_LIST_YN"];
$REQ["AUTH_LIST_YN"] = $_GET["AUTH_LIST_YN"];

if(!is_numeric($REQ["PJTSEQ"])){JsonMsg("500","000","PJTSEQ를 입력해 주세요.");}

//DB연결 정보 생성
$db = db_m_open();

$RtnArr = null;





//100 간편 인증 해당 프로젝트에 대한 배포키가 일치 하는지 확인 하기
$T_SQL = sprintf("select PJTID,PJTNM,DEPLOYKEY from CG_PJTINFO where PJTSEQ = %d "
    , addSqlSlashes($REQ["PJTSEQ"])
    );

//echo $T_SQL;
$result = $db->query($T_SQL) or JsonMsg("500","300", "FILESEQ [" . $db->errno . "] " . $db->error) ;

$row = $result->fetch_assoc();

alog("Searched Project = " . $row["PJTID"] . ", " . $row["PJTNM"] );
alog("Searched DEPLOYKEY = " . $row["DEPLOYKEY"]);

if($row["PJTID"] == "")JsonMsg("500","100","해당 프로젝트가 존재하지 않습니다.");
if($row["DEPLOYKEY"] != $REQ["DEPLOYKEY"])JsonMsg("500","110","배포키가 일치하지 않습니다.");
$result->close();



//200 PGM 상세 불러오기
if($REQ["FILESEQ"] != ""){
    
    $T_SQL = sprintf("
    select SRCTXT
    from CG_RST a
        join CG_RSTFILE b 
            on b.PJTSEQ = a.PJTSEQ and b.PGMSEQ = a.PGMSEQ 
                and b.FILETYPE = a.FILETYPE and b.VERSEQ = a.VERSEQ 
    where b.PJTSEQ = %d and b.PGMSEQ = %d and b.FILESEQ = %d and b.FILEHASH = '%s' and b.ACTIVEYN = 'Y'
    order by SRCORD ASC"
    , addSqlSlashes($REQ["PJTSEQ"])
    , addSqlSlashes($REQ["PGMSEQ"])
    , addSqlSlashes($REQ["FILESEQ"])
    , addSqlSlashes($REQ["FILEHASH"]) 
    );

    //echo $T_SQL;
    $result = $db->query($T_SQL) or JsonMsg("500","300", "FILESEQ [" . $db->errno . "] " . $db->error) ;

    $arr = fetch_all($result,MYSQLI_ASSOC);
    $tmpStr = "";
    for($k=0;$k<count($arr);$k++){
        $tmpStr .= $arr[$k]["SRCTXT"];
    }

    $RtnArr["FILE_SRC"] =  $tmpStr;

    $result->close();

}


//300 pgm list 생성
if($REQ["FILE_LIST_YN"] =="Y"){
    
    $T_SQL  = sprintf("
    SELECT 
        0 as CHK, a.PGMSEQ, a.VERSEQ, a.FILESEQ, b.PGMID, b.PGMNM, a.FILETYPE, a.FILENM, a.FILEHASH, a.FILESIZE, a.ADDDT, a.MODDT
    FROM 
        CG.CG_RSTFILE a
        join CG_PGMINFO b on a.PJTSEQ = b.PJTSEQ and a.PGMSEQ = b.PGMSEQ
    WHERE a.PJTSEQ = %d and a.ACTIVEYN = 'Y'
    ORDER BY a.ADDDT DESC
    ", addSqlSlashes($REQ["PJTSEQ"]));
    $result = $db->query($T_SQL) or JsonMsg("500","300", "FILE_LIST_YN [" . $db->errno . "] " . $db->error) ;

    //$line2 = null;
    $arr = fetch_all($result,MYSQLI_ASSOC);
    $RtnArr["FILE_LIST"] =  $arr;

    $result->close();

}


//400 pgm list 생성
if($REQ["PGM_LIST_YN"] =="Y"){
    
    $T_SQL  = sprintf("
    SELECT 
        0 as CHK, PGMSEQ, PGMID, PGMNM, PKGGRP, VIEWURL, '10' as MNU_ORD, 0 as FOLDER_SEQ, PGMTYPE, SECTYPE, ADDDT, MODDT
    FROM 
        CG.CG_PGMINFO
    WHERE PJTSEQ = %d       
    ", addSqlSlashes($REQ["PJTSEQ"]));
    $result = $db->query($T_SQL) or JsonMsg("500","300", "PGM_LIST_YN [" . $db->errno . "] " . $db->error) ;

    //$line2 = null;
    $arr = fetch_all($result,MYSQLI_ASSOC);
    $RtnArr["PGM_LIST"] =  $arr;

    $result->close();

}

//500 db 권한 생성
if($REQ["AUTH_LIST_YN"] =="Y"){

  $T_SQL  = sprintf("
  SELECT 
      0 as CHK
      , concat(p.PGMID, '-', g.GRPID, '_', f.FNCID) as ROWID
      , p.PGMID 
      , concat(g.GRPID,'_',f.FNCID) as AUTH_ID
      , concat(g.GRPNM,'_',f.FNCNM) as AUTH_NM 
  FROM 
      CG.CG_PGMGRP g
      JOIN CG.CG_PGMFNC f on g.GRPSEQ = f.GRPSEQ and g.PGMSEQ = f.PGMSEQ
      JOIN CG.CG_PGMINFO p on p.PGMSEQ = g.PGMSEQ
  WHERE p.PJTSEQ = %d AND ( f.FNCTYPE != '' && f.FNCTYPE is not null )
      order by p.PGMID,g.GRPORD asc,f.FNCORD asc        
  ", addSqlSlashes($REQ["PJTSEQ"]));
  $result = $db->query($T_SQL) or JsonMsg("500","300", "AUTH_LIST_YN [" . $db->errno . "] " . $db->error) ;

  //$line2 = null;
  $arr = fetch_all($result,MYSQLI_ASSOC);
  $RtnArr["AUTH_LIST"] =  $arr;

  $result->close();

}

//db닫기
$db->close();

if($RtnArr == null){
    JsonMsg("500","999", "RtnArr is null") ;
}else{
    $RtnArr["RTN_CD"] = "200";
    $RtnArr["ERR_CD"] = "200";    
    echo json_encode($RtnArr);
}
?>