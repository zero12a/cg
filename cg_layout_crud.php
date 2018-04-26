<?php
    header("Content-Type: text/html; charset=UTF-8");
    header("Cache-Control:no-cache");
    header("Pragma:no-cache");

    require_once("./include/incUtil.php");
    require_once("./incConfig.php");
    require_once("./include/incUtil.php");
    require_once("./include/incDB.php");

    require_once("./lib/PHP-SQL-Parser/src/PHPSQLParser.php");

    //ServerViewTxt("N","N","Y","Y");

    $db=db_m_open();

    //컬럼ROW받기 GRPID,GRPTYPE,GRPNM,GRPORD,BRCNT,REFGRPID,GRPWIDTH,GRPHEIGHT,GRPPADDING,
    $F_GRPID = $_GET['F_GRPID'];
    $G1_CRUD_MODE    = $_GET['G1_CRUD_MODE'];
    $G2_CRUD_MODE    = $_GET['G2_CRUD_MODE'];


    //그룹ID받기
    $REQ["F_PJTID"] = $_GET['F_PJTID'];
    $REQ["F_PGMID"] = $_GET['F_PGMID'];
    $REQ["F_PGMNM"] = $_GET['F_PGMNM'];
    $REQ["F_DT_TYPE"] = $_GET['F_DT_TYPE'];
    $REQ["F_START_DT"] = str_replace("-","",$_GET['F_START_DT']); //날짜 타입은 - 제거
    $REQ["F_END_DT"] = str_replace("-","",$_GET['F_END_DT']); //날짜 타입은 - 제거

        //컬럼ROW받기 GRPID,GRPTYPE,GRPNM,GRPORD,BRCNT,REFGRPID,GRPWIDTH,GRPHEIGHT,GRPPADDING,
    $REQ["G1_PJTSEQ"] = $_GET['G1_PJTSEQ'];
    $REQ["G1_LAYOUTID"] = $_GET['G1_LAYOUTID'];
    $REQ["G1_GRPCNT"] = $_GET['G1_GRPCNT'];





if($F_GRPID == "1" && $G1_CRUD_MODE == "read"){

    $to_coltype = "s";
    alog("        to_coltype : " . $to_coltype);
    $sql = "
          select
            PJTSEQ,LAYOUTID,GRPCNT,ADDDT,MODDT
          from CG_LAYOUT where PJTSEQ = ( SELECT PJTSEQ FROM CG_PJTINFO WHERE PJTID = #F_PJTID# )
          ";
    alog("        selected : " );
    $stmt = make_stmt($db,$sql, $to_coltype, $REQ);
    if(!$stmt){
        JsonMsg("500","100","stmt 생성 실패" . $db->errno . " -> " . $db->error);
    }

    echo make_grid_read_json($stmt,1);

    $db->close();

}else if($F_GRPID == "1"){
    alog("---------------GRP G1 ---------------------START");
    alog("        G1_CRUD_MODE : " .$G1_CRUD_MODE);
    alog("        xmldata : " .$_POST["xmldata"]);

	$xml_array = getXml2Array($_POST["xmldata"]);



    $colord = "PJTSEQ,LAYOUTID,GRPCNT,ADDDT,MODDT";


    $sql_inserted = "
               insert into CG_LAYOUT (
                                    PJTSEQ,LAYOUTID,GRPCNT
                                    ,ADDDT
               ) values (
                                    #PJTSEQ#,#LAYOUTID#,#GRPCNT#
                                    ,date_format(sysdate(),'%Y%m%d%H%i%s')
               )
    ";
    $sql_inserted_coltype = "ssi";

    $sql_deleted = " delete from CG_LAYOUT where PJTSEQ = #PJTSEQ# and LAYOUTID = #LAYOUTID#  ";
    $sql_deleted_coltype = "ss";

    $sql_updated = "
              update CG_LAYOUT set
                    GRPCNT = #GRPCNT#
                    ,MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
                where PJTSEQ = #PJTSEQ# and LAYOUTID = #LAYOUTID#
    ";
    $sql_updated_coltype = "iss";


    echo make_grid_save_json($db,$REQ,$colord,$xml_array,$sql_inserted,$sql_inserted_coltype,$sql_deleted,$sql_deleted_coltype,$sql_updated,$sql_updated_coltype,$ai_yn="N",$key_colid="LAYOUTID");

    //echo "\n\n\n xml to array : ";
    //var_dump($xml_array);
    $db->close();
}





if($F_GRPID == "2" && $G2_CRUD_MODE == "read"){

    $to_coltype = "ss";
    alog("        to_coltype : " . $to_coltype);
    $sql = "
          select
            LAYOUTDSEQ, PJTSEQ,LAYOUTID,GRPID,REFGRPID,ORD,GRPTYPE,GRPWIDTH,GRPHEIGHT,VBOXNO,ADDDT,MODDT
          from CG_LAYOUTD where PJTSEQ = #G1_PJTSEQ# and LAYOUTID = #G1_LAYOUTID#
          ";
    alog("        selected : " );
    $stmt = make_stmt($db,$sql, $to_coltype, $REQ);
    if(!$stmt)   JsonMsg("500","100","stmt 생성 실패" . $db->errno . " -> " . $db->error);

    echo make_grid_read_json($stmt,0);

    $db->close();

}else if($F_GRPID == "2"){
    alog("---------------GRP G2 ---------------------START");
    alog("        G2_CRUD_MODE : " .$G2_CRUD_MODE);
    alog("        xmldata : " .$_POST["xmldata"]);

	$xml_array = getXml2Array($_POST["xmldata"]);


    //echo "\nxml_array row sizeof : " . sizeof($xml_array["row"]);
    //echo "\nxml_array is_assoc : " . is_assoc($xml_array["row"]);

    $colord = "LAYOUTDSEQ,PJTSEQ,LAYOUTID,GRPID,REFGRPID,ORD,GRPTYPE,GRPWIDTH,GRPHEIGHT,VBOXNO,ADDDT,MODDT";


    $sql_inserted = "
               insert into CG_LAYOUTD (
                 PJTSEQ,LAYOUTID,ORD,GRPWIDTH,GRPHEIGHT
                ,VBOXNO,GRPTYPE,GRPID,REFGRPID
                ,ADDDT
               ) values (
                    #PJTSEQ#,#LAYOUTID#,#ORD#,#GRPWIDTH#,#GRPHEIGHT#
                    ,#VBOXNO#,#GRPTYPE#,#GRPID#,#REFGRPID#
                    ,date_format(sysdate(),'%Y%m%d%H%i%s')
               )
    ";
    $sql_inserted_coltype = "ssiss isss";

    $sql_deleted = " delete from CG_LAYOUTD where PJTSEQ = #G1_PJTSEQ# and LAYOUTDSEQ= #LAYOUTDSEQ# ";
    $sql_deleted_coltype = "ii";

    $sql_updated = "
              update CG_LAYOUTD set
                    GRPID = #GRPID#, GRPWIDTH = #GRPWIDTH#, GRPHEIGHT = #GRPHEIGHT#, VBOXNO = #VBOXNO#, GRPTYPE = #GRPTYPE#
                    , ORD = #ORD#,REFGRPID = #REFGRPID#
                    ,MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
              where PJTSEQ = #G1_PJTSEQ#  and LAYOUTDSEQ= #LAYOUTDSEQ# 
    ";
    $sql_updated_coltype = "sssis is si";


    echo make_grid_save_json($db,$REQ,$colord,$xml_array,$sql_inserted,$sql_inserted_coltype,$sql_deleted,$sql_deleted_coltype,$sql_updated,$sql_updated_coltype,"Y","LAYOUTDSEQ");

    //echo "\n\n\n xml to array : ";
    //var_dump($xml_array);
    $db->close();
}



?>