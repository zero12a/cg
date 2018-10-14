<?php
    header("Content-Type: text/html; charset=UTF-8");
    header("Cache-Control:no-cache");
    header("Pragma:no-cache");

    session_start();

    require_once("./include/incUtil.php");
    require_once("./incConfig.php");
    require_once("./include/incDB.php");
    require_once("./include/incAuth.php");
    

    
    $db=db_m_open();

    //그룹ID받기
    $REQ["PJTSEQ"] = $_GET['PJTSEQ'];
    $REQ["PGMSEQ"] = $_GET['PGMSEQ'];

    //PJT정보 가져오기
    $to_coltype = "i";
    $sql = " 
    SELECT 
        *
    FROM 
        CG.CG_PJTINFO 
    WHERE PJTSEQ = #PJTSEQ#
    ";    
    $stmt = make_stmt($db,$sql, $to_coltype, $REQ);    
    if(!$stmt)JsonMsg("500","100","stmt 생성 실패" . $db->errno . " -> " . $db->error);

    $tPjt =  getStmtArray($stmt);
    $stmt->close();
    
    //로그인 처리 (임의 유저 세팅하기)
    alog("세션부여 : " . $tPjt[0]["PJTID"] . "_USR_SEQ");
    $_SESSION[ $tPjt[0]["PJTID"] . "_USR_SEQ"] = 0;

    //마지막 로그인세션 기록용(중복로그인 방지)
    $CFG_SID_PREFIX = $tPjt[0]["PJTID"];

    //마지막 로그인 세션id기록용
    $objAuth= new authObject();	
    
    $objAuth->setLastSession(0,session_id());

    //PGM정보 가져오기
    $to_coltype = "ii";
    $sql = " 
    SELECT 
       *
    FROM 
        CG.CG_PGMINFO 
    WHERE PJTSEQ = #PJTSEQ# and PGMSEQ=#PGMSEQ# 
    ";    
    $stmt = make_stmt($db,$sql, $to_coltype, $REQ);    
    if(!$stmt)JsonMsg("500","100","stmt 생성 실패" . $db->errno . " -> " . $db->error);

    $tPgm =  getStmtArray($stmt);
    $stmt->close();

    //SVC에서 사용할 GRP목록 가져오기
    $to_coltype = "ii";
    $sql = " 
    SELECT 
        p.PGMID
        ,concat(g.GRPID,'_',f.FNCID) as AUTH_ID
        ,concat(g.GRPNM,'_',f.FNCNM) as AUTH_NM 
    FROM 
        CG.CG_PGMGRP g
        JOIN CG.CG_PGMFNC f on g.GRPSEQ = f.GRPSEQ and g.PGMSEQ = f.PGMSEQ
        JOIN CG.CG_PGMINFO p on p.PGMSEQ = g.PGMSEQ
    WHERE p.PJTSEQ = #PJTSEQ# and p.PGMSEQ=#PGMSEQ# AND ( f.FNCTYPE != '' && f.FNCTYPE is not null )
        order by p.PGMID,g.GRPORD asc,f.FNCORD asc        
    ";

    mlog("cg_clode_json.php...............333");

    $stmt = make_stmt($db,$sql, $to_coltype, $REQ);

    //alog("cg_clode_json.php...............444");

    if(!$stmt)JsonMsg("500","100","stmt 생성 실패" . $db->errno . " -> " . $db->error);

    $tArr =  getStmtArray($stmt);
    $stmt->close();

    $lastPgmid = "";
    $rtnVal = null;
    $sqlVal = null;
    for($i=0;$i<count($tArr);$i++){
        $tMap = $tArr[$i];
        if($lastPgmid != $tMap["PGMID"]){
            $rtnVal[$tMap["PGMID"]] = array();
            $sqlVal[$tMap["PGMID"]] = array();
            $j=0;          
        }else{
            $j++;        
        }
        $rtnVal[$tMap["PGMID"]][$j] = $tMap["AUTH_ID"];
        $sqlVal[$tMap["PGMID"]][$j]["AUTH_ID"] = $tMap["AUTH_ID"];
        $sqlVal[$tMap["PGMID"]][$j]["AUTH_NM"] = $tMap["AUTH_NM"];  

        $lastPgmid = $tMap["PGMID"];
    }
    //화면에 SQL문 출력
    echo "<BR>lastPgmid : " . $lastPgmid;
    echo "<BR>count(sqlVal[lastPgmid]) : " . count($rtnVal[$lastPgmid]);    
    echo "<textarea style='width:100%;height:120px;font-size:8pt'>";
    $tMap = $sqlVal[$lastPgmid][$j];
    echo sprintf("
        insert into CMN_MNU (
            MNU_NM, PGMID, URL, MNU_ORD, FOLDER_SEQ
            ,USE_YN, ADD_ID, ADD_DT
        ) values (
            '%s','%s','%s',%s,%s
            ,'Y',%s,%s
        );
        " 
        ,$tPgm[0]["PGMNM"]
        ,$tPgm[0]["PGMID"]
        ,$tPgm[0]["VIEWURL"]        
        ,"10"
        ,"2"
        ,"0"
        ,"date_format(sysdate(),'%Y%m%d%H%i%s')"
        );    
    echo "</textarea>";

    echo "<textarea style='width:100%;height:500px;font-size:8pt'>";
    for($j=0;$j<count($sqlVal[$lastPgmid]);$j++){
        $tMap = $sqlVal[$lastPgmid][$j];
        echo sprintf("
        insert into CMN_AUTH (
            PGMID,AUTH_ID,AUTH_NM,USE_YN,ADD_DT
        ) values (
            '%s','%s','%s','Y',%s
        );
        " 
        ,$lastPgmid
        ,$tMap["AUTH_ID"]
        ,$tMap["AUTH_NM"]
        ,"date_format(sysdate(),'%Y%m%d%H%i%s')"
        );
    }
    echo "</textarea>";
    //기존 세션 정보 가져오기
    $sessAuth = $_SESSION['CG_AUTH']; //true줘야 일반 배열이 되고, true없으면 stdclass()가 됨
    $sessAuth[$lastPgmid] = $rtnVal[$lastPgmid];

    //alog("cg_clode_json.php...............555");

    $db->close();

    //$strAuthJson = json_encode($sessAuth);
    $strAuthJson = json_encode($sessAuth);

    $_SESSION['CG_AUTH'] = $sessAuth;
?>세션부여 완료(CG_AUTH) : <?=$strAuthJson?>