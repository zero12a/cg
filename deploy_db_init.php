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
$REQ["DOWN_CREATE_YN"] = $_GET["DOWN_CREATE_YN"];
$REQ["DOWN_AUTH_YN"] = $_GET["DOWN_AUTH_YN"];

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

//db 스크립트 생성
if($REQ["DOWN_CREATE_YN"] =="Y"){
  $zip->addFromString("create_table.sql", "

    CREATE TABLE CMN_AUTH (
      AUTH_SEQ int(11) NOT NULL,
      PGMID varchar(30) NOT NULL,
      AUTH_ID varchar(100) NOT NULL,
      AUTH_NM varchar(200) NOT NULL,
      USE_YN varchar(1) NOT NULL DEFAULT 'Y',
      ADD_DT varchar(14) NOT NULL,
      MOD_DT varchar(14) DEFAULT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    
    CREATE TABLE CMN_FOLDER (
      FOLDER_SEQ int(11) NOT NULL,
      FOLDER_NM varchar(200) NOT NULL,
      USE_YN varchar(1) NOT NULL DEFAULT 'Y',
      FOLDER_ORD int(11) NOT NULL DEFAULT '10',
      ADD_DT varchar(14) NOT NULL,
      ADD_ID int(11) NOT NULL,
      MOD_DT varchar(14) DEFAULT NULL,
      MOD_ID int(11) DEFAULT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    
    CREATE TABLE CMN_GRP (
      GRP_SEQ int(11) NOT NULL,
      GRP_NM varchar(200) NOT NULL,
      USE_YN varchar(1) NOT NULL,
      ADD_DT varchar(14) NOT NULL,
      ADD_ID int(11) NOT NULL,
      MOD_DT varchar(14) NOT NULL,
      MOD_ID int(11) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    
    CREATE TABLE CMN_GRP_MNU (
      GRP_SEQ int(11) NOT NULL,
      MNU_SEQ int(11) NOT NULL,
      ADD_DT varchar(14) NOT NULL,
      ADD_ID int(11) NOT NULL,
      MOD_DT varchar(14) DEFAULT NULL,
      MOD_ID int(11) DEFAULT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    
    CREATE TABLE CMN_GRP_USR (
      GRP_SEQ int(11) NOT NULL,
      USR_SEQ int(11) NOT NULL,
      ADD_DT varchar(14) NOT NULL,
      ADD_ID int(11) NOT NULL,
      MOD_DT varchar(14) NOT NULL,
      MOD_ID int(11) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    
    CREATE TABLE CMN_MNU (
      MNU_SEQ int(11) NOT NULL,
      MNU_NM varchar(100) NOT NULL,
      PGMID varchar(30) DEFAULT NULL,
      URL varchar(200) NOT NULL,
      MNU_ORD int(11) NOT NULL DEFAULT '10',
      FOLDER_SEQ int(11) NOT NULL,
      USE_YN varchar(1) NOT NULL DEFAULT 'Y',
      ADD_DT varchar(14) NOT NULL,
      ADD_ID int(11) NOT NULL,
      MOD_DT varchar(14) DEFAULT NULL,
      MOD_ID int(11) DEFAULT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    
    CREATE TABLE CMN_USR (
      USR_SEQ int(11) NOT NULL,
      USR_ID varchar(20) NOT NULL,
      USR_NM varchar(50) NOT NULL,
      PHONE varchar(50) NOT NULL,
      USE_YN varchar(1) NOT NULL DEFAULT 'Y',
      USR_PWD varchar(1) NOT NULL,
      PW_ERR_CNT int(11) NOT NULL DEFAULT '0',
      LAST_STATUS varchar(2) NOT NULL COMMENT '최종 상태',
      LOCK_LIMIT_DT varchar(14) NOT NULL,
      EXPIRE_DT varchar(14) NOT NULL,
      ADD_DT varchar(14) NOT NULL,
      ADD_ID int(11) NOT NULL,
      MOD_DT varchar(14) NOT NULL,
      MOD_ID int(11) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    
    
    ALTER TABLE CMN_AUTH
      ADD PRIMARY KEY (AUTH_SEQ),
      ADD UNIQUE KEY PGMID (PGMID,AUTH_ID);

    ALTER TABLE CMN_FOLDER
      ADD PRIMARY KEY (FOLDER_SEQ);
    
    ALTER TABLE CMN_GRP
      ADD PRIMARY KEY (GRP_SEQ);
    
    ALTER TABLE CMN_GRP_MNU
      ADD PRIMARY KEY (GRP_SEQ,MNU_SEQ);
    
    ALTER TABLE CMN_GRP_USR
      ADD PRIMARY KEY (GRP_SEQ,USR_SEQ);
    
    ALTER TABLE CMN_MNU
      ADD PRIMARY KEY (MNU_SEQ),
      ADD UNIQUE KEY PGMID (PGMID);
    
    ALTER TABLE CMN_USR
      ADD PRIMARY KEY (USR_SEQ);
    
    ALTER TABLE CMN_AUTH
      MODIFY AUTH_SEQ int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
    
    ALTER TABLE CMN_FOLDER
      MODIFY FOLDER_SEQ int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
    
    ALTER TABLE CMN_GRP
      MODIFY GRP_SEQ int(11) NOT NULL AUTO_INCREMENT;
    
    ALTER TABLE CMN_MNU
      MODIFY MNU_SEQ int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
    
    ALTER TABLE CMN_USR
      MODIFY USR_SEQ int(11) NOT NULL AUTO_INCREMENT;
    
  ");

}

//db 권한 생성
if($REQ["DOWN_AUTH_YN"] =="Y"){


  $T_SQL  = sprintf("
  SELECT 
      p.PGMID, p.PGMNM, p.VIEWURL
      ,concat(g.GRPID,'_',f.FNCID) as AUTH_ID
      ,concat(g.GRPNM,'_',f.FNCNM) as AUTH_NM 
  FROM 
      CG.CG_PGMGRP g
      JOIN CG.CG_PGMFNC f on g.GRPSEQ = f.GRPSEQ and g.PGMSEQ = f.PGMSEQ
      JOIN CG.CG_PGMINFO p on p.PGMSEQ = g.PGMSEQ
  WHERE p.PJTSEQ = %d AND ( f.FNCTYPE != '' && f.FNCTYPE is not null )
      order by p.PGMID,g.GRPORD asc,f.FNCORD asc        
  ", addSqlSlashes($REQ["PJTSEQ"]));
  $result = $db->query($T_SQL) or ServerMsg("500","300", "DOWN_AUTH_YN [" . $db->errno . "] " . $db->error) ;

  //$line2 = null;
  $arr = fetch_all($result,MYSQLI_ASSOC);

  $lastPgmId = "";
  $menu_sql_str = "";
  $auth_sql_str = "";

  for($k=0;$k<count($arr);$k++){
    //메뉴 정보
    if($lastPgmId != $arr[$k]["PGMID"]){
      $menu_sql_str .= sprintf("
        insert into CMN_MNU (
            MNU_NM, PGMID, URL, MNU_ORD, FOLDER_SEQ
            ,USE_YN, ADD_ID, ADD_DT
        ) values (
            '%s','%s','%s',%s,%s
            ,'Y',%s,%s
        );
        " 
        ,$arr[$k]["PGMNM"]
        ,$arr[$k]["PGMID"]
        ,$arr[$k]["VIEWURL"]        
        ,"10"
        ,"2"
        ,"0"
        ,"date_format(sysdate(),'%Y%m%d%H%i%s')"
        );
    }


    $auth_sql_str .= sprintf("
    insert into CMN_AUTH (
        PGMID,AUTH_ID,AUTH_NM,USE_YN,ADD_DT
    ) values (
        '%s','%s','%s','Y',%s
    );
    " 
    ,$arr[$k]["PGMID"]
    ,$arr[$k]["AUTH_ID"]
    ,$arr[$k]["AUTH_NM"]
    ,"date_format(sysdate(),'%Y%m%d%H%i%s')"
    );   

    $lastPgmId = $arr[$k]["PGMID"];
  }//for

  //메뉴 추가
  $zip->addFromString("insert_menu.sql",  $menu_sql_str);

  //권한 추가
  $zip->addFromString("insert_auth.sql",  $auth_sql_str);
  

}

//db닫기
$db->close();

echo "<br>numfiles: " . $zip->numFiles . "\n";
echo "<br>status:" . $zip->status . "\n";
$zip->close();
?><br>다운로드 : <a href="/c.g/up/<?=$filename?>"><?=$filename?></a>