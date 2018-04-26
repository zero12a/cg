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

    $db=db_b_open();


    //컬럼ROW받기 GRPID,GRPTYPE,GRPNM,GRPORD,BRCNT,REFGRPID,GRPWIDTH,GRPHEIGHT,GRPPADDING,
    $F_GRPID = $_GET['F_GRPID'];
    $G1_CRUD_MODE    = $_GET['G1_CRUD_MODE'];
    $G2_CRUD_MODE    = $_GET['G2_CRUD_MODE'];


    //그룹ID받기
    $REQ["F_SITEID"] = $_GET['F_SITEID'];
    $REQ["F_SCANURL"] = $_GET['F_SCANURL'];
    $REQ["F_SCANDESC"] = $_GET['F_SCANDESC'];
    $REQ["F_DT_TYPE"] = $_GET['F_DT_TYPE'];
    $REQ["F_START_DT"] = str_replace("-","",$_GET['F_START_DT']); //날짜 타입은 - 제거
    $REQ["F_END_DT"] = str_replace("-","",$_GET['F_END_DT']); //날짜 타입은 - 제거

        //컬럼ROW받기 GRPID,GRPTYPE,GRPNM,GRPORD,BRCNT,REFGRPID,GRPWIDTH,GRPHEIGHT,GRPPADDING,
    $REQ["G1_URLSEQ"] = $_GET['G1_URLSEQ'];







if($F_GRPID == "1" && $G1_CRUD_MODE == "read"){

    $to_coltype = "s";
    //LogMaster::log("        to_coltype : " . $to_coltype);
    $sql = "
          select
            URLSEQ,SITEID,SCANORD,PURLSEQ,URLDESC,PORT,SCANURL,REFERER,FORMTYPE,ADDDT,MODDT
          from BC_URL where SITEID = #F_SITEID#
          ";
    //LogMaster::log("        selected : " );
    $stmt = make_stmt($db,$sql, $to_coltype, $REQ);
    if(!$stmt){
        JsonMsg("500","100","stmt 생성 실패" . $db->errno . " -> " . $db->error);
    }

    echo make_grid_read_json($stmt,0);

    $db->close();

}else if($F_GRPID == "1"){
    //LogMaster::log("---------------GRP G1 ---------------------START");
    //LogMaster::log("        G1_CRUD_MODE : " .$G1_CRUD_MODE);
    //LogMaster::log("        xmldata : " .$_POST["xmldata"]);
    if($G2_CRUD_MODE == "SAVE"){
        //echo "xmldata:". $_POST["xmldata"];
    }

    $xml = $_POST["xmldata"];
    //echo "\n\n\n xml:". $xml;

    $xml = str_replace("<row","\n<row",$xml);
    $xml = str_replace("<cell","\n\t<cell",$xml);
    //LogMaster::log("        xml : " . $xml);


    $xml = simplexml_load_string($xml);
    //$xml_array = (array)$xml;
    $xml_json = json_encode($xml);
    $xml_array = (array) json_decode($xml_json,TRUE);


    //echo "\nxml_array row sizeof : " . sizeof($xml_array["row"]);
    //echo "\nxml_array is_assoc : " . is_assoc($xml_array["row"]);

    $colord = "URLSEQ,SITEID,SCANORD,PURLSEQ,URLDESC,PORT,SCANURL,REFERER,FORMTYPE,ADDDT,MODDT";


    $sql_inserted = "
               insert into BC_URL (
                                    SITEID,SCANORD,PURLSEQ,URLDESC,PORT
                                    ,SCANURL,REFERER,FORMTYPE
                                    ,ADDDT
               ) values (
                                    #SITEID#,#SCANORD#,#PURLSEQ#,#URLDESC#,#PORT#
                                    ,#SCANURL#,#REFERER#,#FORMTYPE#
                                    ,date_format(sysdate(),'%Y%m%d%H%i%s')
               )
    ";
    $sql_inserted_coltype = "siisi sss";

    $sql_deleted = " delete from BC_URL where SITEID = #SITEID# and URLSEQ = #URLSEQ#  ";
    $sql_deleted_coltype = "si";

    $sql_updated = "
              update BC_URL set
                  SCANORD = #SCANORD#, PURLSEQ = #PURLSEQ#, URLDESC = #URLDESC#, PORT = #PORT#, SCANURL = #SCANURL#
                  , REFERER = #REFERER#, FORMTYPE = #FORMTYPE#
                  ,MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
              where SITEID = #SITEID# and URLSEQ = #URLSEQ#
    ";
    $sql_updated_coltype = "iisis sssi";


    echo make_grid_save_json($db,$REQ,$colord,$xml_array,$sql_inserted,$sql_inserted_coltype,$sql_deleted,$sql_deleted_coltype,$sql_updated,$sql_updated_coltype);

    //echo "\n\n\n xml to array : ";
    //var_dump($xml_array);
    $db->close();
}





if($F_GRPID == "2" && $G2_CRUD_MODE == "read"){

    $to_coltype = "s";
    //LogMaster::log("        to_coltype : " . $to_coltype);
    $sql = "
          select
            PARAMSEQ,SITEID,PARAMORD,PARAMNAME,ADDDT,MODDT
          from BC_PARAM where SITEID  = #F_SITEID#
          order by PARAMORD
          ";
    //LogMaster::log("        selected : " );
    $stmt = make_stmt($db,$sql, $to_coltype, $REQ);
    if(!$stmt){
        JsonMsg("500","100","stmt 생성 실패" . $db->errno . " -> " . $db->error);
    }

    echo make_grid_read_json($stmt,0);

    $db->close();

}else if($F_GRPID == "2"){
    //LogMaster::log("---------------GRP G2 ---------------------START");
    //LogMaster::log("        G2_CRUD_MODE : " .$G2_CRUD_MODE);
    //LogMaster::log("        xmldata : " .$_POST["xmldata"]);
    if($G2_CRUD_MODE == "SAVE"){
        //echo "xmldata:". $_POST["xmldata"];
    }

    $xml = $_POST["xmldata"];
    //echo "\n\n\n xml:". $xml;

    $xml = str_replace("<row","\n<row",$xml);
    $xml = str_replace("<cell","\n\t<cell",$xml);
    //LogMaster::log("        xml : " . $xml);


    $xml = simplexml_load_string($xml);
    //$xml_array = (array)$xml;
    $xml_json = json_encode($xml);
    $xml_array = (array) json_decode($xml_json,TRUE);


    //echo "\nxml_array row sizeof : " . sizeof($xml_array["row"]);
    //echo "\nxml_array is_assoc : " . is_assoc($xml_array["row"]);

    $colord = "PARAMSEQ,SITEID,PARAMORD,PARAMNAME,ADDDT,MODDT";


    $sql_inserted = "
               insert into BC_PARAM (
                                    SITEID,PARAMORD,PARAMNAME
                                    ,ADDDT
               ) values (
                                    #SITEID#,#PARAMORD#,#PARAMNAME#
                                    ,date_format(sysdate(),'%Y%m%d%H%i%s')
               )
    ";
    $sql_inserted_coltype = "sss";

    $sql_deleted = " delete from BC_PARAM where PARAMSEQ = #PARAMSEQ# ";
    $sql_deleted_coltype = "i";

    $sql_updated = "
              update BC_PARAM set
                    PARAMORD = #PARAMORD#, PARAMNAME = #PARAMNAME#
                    ,MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
              where PARAMSEQ = #PARAMSEQ#
    ";
    $sql_updated_coltype = "isi";


    echo make_grid_save_json($db,$REQ,$colord,$xml_array,$sql_inserted,$sql_inserted_coltype,$sql_deleted,$sql_deleted_coltype,$sql_updated,$sql_updated_coltype);

    //echo "\n\n\n xml to array : ";
    //var_dump($xml_array);
    $db->close();
}



?>