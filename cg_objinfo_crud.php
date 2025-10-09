<?php

    header("Content-Type: text/html; charset=UTF-8");
    header("Cache-Control:no-cache");
    header("Pragma:no-cache");

    require_once("./include/incUtil.php");
    require_once("./incConfig.php");
    require_once("./include/incUtil.php");
    require_once("./include/incDB.php");

    //ServerViewTxt("N","N","Y","Y");
    $db=db_m_open();


    //그룹ID받기
    $F_GRPID = $_GET['F_GRPID'];
    $F_PJTID = $_GET['F_PJTID'];
    $F_OBJTYPE = $_GET['F_OBJTYPE'];
    $F_DT_TYPE = $_GET['F_DT_TYPE'];
    $F_START_DT = str_replace("-","",$_GET['F_START_DT']); //날짜 타입은 - 제거
    $F_END_DT = str_replace("-","",$_GET['F_END_DT']); //날짜 타입은 - 제거

    //컬럼ROW받기 (REFGRID의 컬럼 정보 받기)
    $G1_OBJTYPE = $_GET['G1_OBJTYPE'];
    $G1_LBLTXT = $_GET['G1_LBLTXT'];
    $G1_OBJTXT = $_GET['G1_OBJTXT'];
    $G1_SRCTXT = $_GET['G1_SRCTXT'];
    $G1_SPTTXT = $_GET['G1_SPTTXT'];
    $G1_INPUT = $_GET['G1_INPUT'];
    $G1_PARAM = $_GET['G1_PARAM'];
    $G1_SRCTYPE = $_GET['G1_SRCTYPE'];

    $G2_OBJDSEQ = $_GET['G2_OBJDSEQ'];



    //그룹ID받기
    $REQ["F_GRPID"] = $_GET['F_GRPID'];
    $REQ["F_PJTID"] = $_GET['F_PJTID'];
    $REQ["F_FILETYPE"] = $_GET['F_FILETYPE'];
    $REQ["F_OBJTYPE"] = $_GET['F_OBJTYPE'];
    $REQ["F_DT_TYPE"] = $_GET['F_DT_TYPE'];
    $REQ["F_START_DT"] = str_replace("-","",$_GET['F_START_DT']); //날짜 타입은 - 제거
    $REQ["F_END_DT"] = str_replace("-","",$_GET['F_END_DT']); //날짜 타입은 - 제거

    //컬럼ROW받기 (REFGRID의 컬럼 정보 받기)
    $REQ["G1_OBJTYPE"] = $_GET['G1_OBJTYPE'];
    $REQ["G1_LBLTXT"] = $_GET['G1_LBLTXT'];
    $REQ["G1_OBJTXT"] = $_GET['G1_OBJTXT'];
    $REQ["G1_SRCTXT"] = $_GET['G1_SRCTXT'];
    $REQ["G1_SPTTXT"] = $_GET['G1_SPTTXT'];
    $REQ["G1_INPUT"] = $_GET['G1_INPUT'];
    $REQ["G1_PARAM"] = $_GET['G1_PARAM'];
    $REQ["G1_SRCTYPE"] = $_GET['G1_SRCTYPE'];

    $REQ["G2_OBJDSEQ"] = $_GET['G2_OBJDSEQ'];


    //폼뷰
    $REQ["OBJTYPE"]      = $_POST['OBJTYPE'];
    $REQ["STARTTXT"]     = $_POST['STARTTXT'];
    $REQ["LBLSTARTTXT"]  = $_POST['LBLSTARTTXT'];
    $REQ["LBLTXT"]       = $_POST['LBLTXT'];
    $REQ["LBLENDTXT"]    = $_POST['LBLENDTXT'];
    $REQ["OBJSTARTTXT"]  = $_POST['OBJSTARTTXT'];
    $REQ["OBJTXT"]       = $_POST['OBJTXT'];
    $REQ["OBJENDTXT"]    = $_POST['OBJENDTXT'];
    $REQ["ENDTXT"]       = $_POST['ENDTXT'];
    $REQ["USEYN"]        = $_POST['USEYN'];


    $REQ["G1_CRUD_MODE"]    = $_GET['G1_CRUD_MODE'];
    $REQ["G2_CRUD_MODE"]    = $_GET['G2_CRUD_MODE'];
    $REQ["G3_CRUD_MODE"]    = $_GET['G3_CRUD_MODE'];
    $REQ["F4_CRUD_MODE"]    = $_GET['F4_CRUD_MODE'];


if($REQ["F_GRPID"] == "4" && $REQ["F4_CRUD_MODE"] == "read"){

    $to_coltype = "ss";
    alog("        to_coltype : " . $to_coltype);
    $sql = "
          select
            OBJTYPE,STARTTXT,LBLSTARTTXT,LBLTXT,LBLENDTXT,OBJSTARTTXT,OBJTXT,OBJENDTXT,ENDTXT,USEYN,ADDDT,MODDT
          from CG_OBJINFO where DELYN='N' and PJTID = #F_PJTID# and OBJTYPE = #G1_OBJTYPE#
          limit 1
          ";

    alog("        selected : " . $sql);
    $stmt = make_stmt($db,$sql, $to_coltype, $REQ);
    if(!$stmt)  JsonMsg("500","100","stmt 생성 실패" . $db->errno . " -> " . $db->error);

    echo make_detail_read_json($stmt);
    $db->close();

}else if($REQ["F_GRPID"] == "4"){
    alog("---------------GRP G4 ---------------------START");
    alog("        F4_CRUD_MODE : " .$F4_CRUD_MODE);
    alog("        xmldata : " .$_POST["xmldata"]);
	
	$xml_array = getXml2Array($_POST["xmldata"]);


    $sql_inserted = "
                insert into CG_OBJINFO (
                    PJTID,OBJTYPE,LBLTXT,OBJTXT,USEYN
                    ,STARTTXT,ENDTXT,LBLSTARTTXT,LBLENDTXT,OBJSTARTTXT
                    ,OBJENDTXT
                    ,ADDDT
                ) values (
                    #F_PJTID#,#OBJTYPE#,#LBLTXT#,#OBJTXT#,#USEYN#
                    ,#STARTTXT#,#ENDTXT#,#LBLSTARTTXT#,#LBLENDTXT#,#OBJSTARTTXT#
                    ,#OBJENDTXT#
                    ,date_format(sysdate(),'%Y%m%d%H%i%s')
                )
    ";
    $sql_inserted_coltype = "sssss sssss s";

    $sql_deleted = "delete from  CG_OBJINFO where PJTID = #F_PJTID# and OBJTYPE = #OBJTYPE# ";
    $sql_deleted_coltype = "ss";

    $sql_updated = "
                update CG_OBJINFO set
                    LBLTXT = #LBLTXT#,OBJTXT = #OBJTXT#, USEYN = #USEYN#
                    ,STARTTXT = #STARTTXT#, ENDTXT = #ENDTXT#,LBLSTARTTXT = #LBLSTARTTXT#,LBLENDTXT = #LBLENDTXT#,OBJSTARTTXT = #OBJSTARTTXT#
                    ,OBJENDTXT = #OBJENDTXT#
                    , MODDT =date_format(sysdate(),'%Y%m%d%H%i%s')
                where PJTID = #F_PJTID# and OBJTYPE = #OBJTYPE#
    ";
    $sql_updated_coltype = "sssss sssss s";


    $sql=null;
    $coltype=null;
    if($REQ["F4_CRUD_MODE"] == "new"){
        $sql = $sql_inserted;
        $coltype = $sql_inserted_coltype;
    }
    if($REQ["F4_CRUD_MODE"] == "update"){
        $sql = $sql_updated;
        $coltype = $sql_updated_coltype;
    }
    if($REQ["F4_CRUD_MODE"] == "delete"){
        $sql = $sql_deleted;
        $coltype = $sql_deleted_coltype;
    }

    echo make_detail_save_json($db,$REQ,$sql,$coltype);

    //echo "\n\n\n xml to array : ";
    //var_dump($xml_array);
    $db->close();
}





if($REQ["F_GRPID"] == "1" && $REQ["G1_CRUD_MODE"] == "read"){

    $to_coltype = "s";
    alog("        to_coltype : " . $to_coltype);
    $sql = "
          select
            OBJTYPE as OLD_OBJTYPE,OBJTYPE,STARTTXT,LBLSTARTTXT,LBLTXT,LBLENDTXT,OBJSTARTTXT,OBJTXT,OBJENDTXT,ENDTXT,USEYN,ADDDT,MODDT
          from CG_OBJINFO where DELYN='N' and PJTID = #F_PJTID#
          ";
    if($REQ["F_OBJTYPE"] != "") {
        $sql .= " and OBJTYPE = #F_OBJTYPE# ";
        $to_coltype .= "s";
    }


    alog("        selected : " );
    $stmt = make_stmt($db,$sql, $to_coltype, $REQ);
    if(!$stmt) JsonMsg("500","100","stmt 생성 실패" . $db->errno . " -> " . $db->error);

    echo make_grid_read_json($stmt,1);
    $db->close();

}else if($REQ["F_GRPID"] == "1"){
    alog("---------------GRP G1 ---------------------START");
    alog("        G1_CRUD_MODE : " .$G1_CRUD_MODE);
    alog("        xmldata : " .$_POST["xmldata"]);

	$xml_array = getXml2Array($_POST["xmldata"]);


    $colord = "OLD_OBJTYPE,OBJTYPE,STARTTXT,LBLSTARTTXT,LBLTXT,LBLENDTXT,OBJSTARTTXT,OBJTXT,OBJENDTXT,ENDTXT,USEYN,ADDDT,MODDT";


    $sql_inserted = "
                insert into CG_OBJINFO (
                    PJTID,OBJTYPE,LBLTXT,OBJTXT,USEYN
                    ,STARTTXT,ENDTXT,LBLSTARTTXT,LBLENDTXT,OBJSTARTTXT
                    ,OBJENDTXT
                    ,ADDDT
                ) values (
                    #F_PJTID#,#OBJTYPE#,#LBLTXT#,#OBJTXT#,#USEYN#
                    ,#STARTTXT#,#ENDTXT#,#LBLSTARTTXT#,#LBLENDTXT#,#OBJSTARTTXT#
                    ,#OBJENDTXT#
                    ,date_format(sysdate(),'%Y%m%d%H%i%s')
                )
    ";
    $sql_inserted_coltype = "sssss sssss s";

    $sql_deleted = "delete from  CG_OBJINFO where PJTID = #F_PJTID# and OBJTYPE = #OBJTYPE# ";
    $sql_deleted_coltype = "ss";

    $sql_updated = "
                update CG_OBJINFO set
                    OBJTYPE = #OBJTYPE#,LBLTXT = #LBLTXT#,OBJTXT = #OBJTXT#, USEYN = #USEYN#,STARTTXT = #STARTTXT#
					, ENDTXT = #ENDTXT#,LBLSTARTTXT = #LBLSTARTTXT#,LBLENDTXT = #LBLENDTXT#,OBJSTARTTXT = #OBJSTARTTXT#,OBJENDTXT = #OBJENDTXT#
                    , MODDT =date_format(sysdate(),'%Y%m%d%H%i%s')
                where PJTID = #F_PJTID# and OBJTYPE = #OLD_OBJTYPE#
    ";
    $sql_updated_coltype = "sssss sssss ss";


    echo make_grid_save_json($db,$REQ,$colord,$xml_array,$sql_inserted,$sql_inserted_coltype,$sql_deleted,$sql_deleted_coltype,$sql_updated,$sql_updated_coltype);

    //echo "\n\n\n xml to array : ";
    //var_dump($xml_array);
    $db->close();
}







if($REQ["F_GRPID"] == "2" && $REQ["G2_CRUD_MODE"] == "read"){
    alog("---------------GRP G2 ---------------------START");
    alog("        G2_CRUD_MODE : " .$REQ["G2_CRUD_MODE"]);	
	$add_sql = "";
    $to_coltype = "ss";
    if($REQ["F_FILETYPE"] != "") {
        $add_sql = " and FILETYPE = #F_FILETYPE# ";
        $to_coltype .= "s";
    }
    $sql = "
          select
             OBJDSEQ,OBJTYPE,FILETYPE,OBJVAL,OBJDORD,OBJVALTYPE,OBJVALNM,OBJDESC,SRCTXT,SPTTXT,INPUT,PARAM,SRCTYPE,ADDDT,MODDT
          from CG_OBJINFOD where PJTID = #F_PJTID# and OBJTYPE = #G1_OBJTYPE# $add_sql
		  order by OBJDORD asc
          ";
    alog("        to_coltype : " . $to_coltype);

    alog("        selected SQL : " . $sql);
    $stmt = make_stmt($db,$sql, $to_coltype, $REQ);
    if(!$stmt)    JsonMsg("500","109","stmt 생성 실패" . $db->errno . " -> " . $db->error);

    echo make_grid_read_json($stmt,0);
    $db->close();

}else if($REQ["F_GRPID"] == "2"){
    alog("---------------GRP G2 ---------------------START");
    alog("        G2_CRUD_MODE : " .$REQ["G2_CRUD_MODE"]);
    alog("        xmldata : " .$_POST["xmldata"]);

	$xml_array = getXml2Array($_POST["xmldata"]);


    $colord = "OBJDSEQ,OBJTYPE,FILETYPE,OBJVAL,OBJDORD,OBJVALTYPE,OBJVALNM,OBJDESC,SRCTXT,SPTTXT,INPUT,PARAM,SRCTYPE,ADDDT,MODDT";


    $sql_inserted = "
               insert into CG_OBJINFOD (
                                    PJTID,OBJTYPE,FILETYPE,OBJVAL,OBJDORD
									,OBJVALTYPE,OBJVALNM,OBJDESC,SRCTXT,SPTTXT
									,INPUT,PARAM,SRCTYPE
                                    ,ADDDT
               ) values (
                                    #F_PJTID#, #G1_OBJTYPE#,#FILETYPE#,#OBJVAL#,#OBJDORD#
									,#OBJVALTYPE#,#OBJVALNM#,#OBJDESC#,#SRCTXT#,#SPTTXT#
									,#INPUT#,#PARAM#,#SRCTYPE#
                                    ,date_format(sysdate(),'%Y%m%d%H%i%s')
               )
    ";
    $sql_inserted_coltype = "ssssi sssss sss";

    $sql_deleted = " delete from CG_OBJINFOD where PJTID = #F_PJTID# and OBJTYPE = #G1_OBJTYPE# and OBJDSEQ = #OBJDSEQ# ";
    $sql_deleted_coltype = "ssi";

    $sql_updated = "
               update CG_OBJINFOD set
                    OBJTYPE = #OBJTYPE#, FILETYPE = #FILETYPE#, OBJVAL = #OBJVAL#, OBJVALNM = #OBJVALNM#, OBJDORD = #OBJDORD#
					, OBJVALTYPE = #OBJVALTYPE#, OBJDESC = #OBJDESC#, SRCTXT = #SRCTXT#, SPTTXT = #SPTTXT#, INPUT = #INPUT#
					, PARAM = #PARAM#, SRCTYPE = #SRCTYPE#
                    ,MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
                where PJTID = #F_PJTID# and OBJDSEQ = #OBJDSEQ#
    ";
    $sql_updated_coltype = "ssssi sssss ss si";

	alog("111");
    echo make_grid_save_json($db,$REQ,$colord,$xml_array,$sql_inserted,$sql_inserted_coltype,$sql_deleted,$sql_deleted_coltype,$sql_updated,$sql_updated_coltype);
	alog("222");
    //echo "\n\n\n xml to array : ";
    //var_dump($xml_array);
    $db->close();
}







if($REQ["F_GRPID"] == "3" && $REQ["G3_CRUD_MODE"] == "read"){

    $to_coltype = "si";
    alog("        to_coltype : " . $to_coltype);
    $sql = "
          select
            OBJASEQ,OBJTYPE,OBJAORD,OBJDESC,SRCTXT,SPTTXT,INPUT,PARAM,SRCTYPE,ADDDT,MODDT
          from CG_OBJINFOA where PJTID = #F_PJTID# and OBJDSEQ = #G2_OBJDSEQ#
          ";
    alog("        selected : " );
    $stmt = make_stmt($db,$sql, $to_coltype, $REQ);
    if(!$stmt)    JsonMsg("500","100","stmt 생성 실패" . $db->errno . " -> " . $db->error);

    echo make_grid_read_json($stmt,0);

    $db->close();

}else if($REQ["F_GRPID"] == "3"){
    alog("---------------GRP G3 ---------------------START");
    alog("        G3_CRUD_MODE : " .$REQ["G3_CRUD_MODE"]);
    alog("        xmldata : " .$_POST["xmldata"]);

	$xml_array = getXml2Array($_POST["xmldata"]);

    $colord = "OBJASEQ,OBJTYPE,OBJAORD,OBJDESC,SRCTXT,SPTTXT,INPUT,PARAM,SRCTYPE,ADDDT,MODDT";


    $sql_inserted = "
               insert into CG_OBJINFOA (
                                    PJTID,OBJTYPE,OBJDSEQ,OBJAORD,OBJDESC
                                    ,SRCTXT,SPTTXT,INPUT,PARAM,SRCTYPE
                                    ,ADDDT
               ) values (
                                    #F_PJTID#,#G1_OBJTYPE#,#G2_OBJDSEQ#,#OBJAORD#,#OBJDESC#
                                    ,#SRCTXT#,#SPTTXT#,#INPUT#,#PARAM#,#SRCTYPE#
                                    ,date_format(sysdate(),'%Y%m%d%H%i%s')
               )
    ";
    $sql_inserted_coltype = "ssiis sssss";

    $sql_deleted = " delete from CG_OBJINFOA where PJTID = #F_PJTID# and OBJTYPE = #G1_OBJTYPE# and OBJASEQ = #OBJASEQ# ";
    $sql_deleted_coltype = "ssi";

    $sql_updated = "
              update CG_OBJINFOA set
                    OBJTYPE = #OBJTYPE#, OBJDESC = #OBJDESC#, OBJAORD = #OBJAORD#, SRCTXT = #SRCTXT#, SPTTXT = #SPTTXT#
					, INPUT = #INPUT#, PARAM = #PARAM#, SRCTYPE = #SRCTYPE#
                    ,MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
                where PJTID = #F_PJTID# and OBJASEQ = #OBJASEQ#
    ";
    $sql_updated_coltype = "ssiss sss si";


    echo make_grid_save_json($db,$REQ,$colord,$xml_array,$sql_inserted,$sql_inserted_coltype,$sql_deleted,$sql_deleted_coltype,$sql_updated,$sql_updated_coltype);

    //echo "\n\n\n xml to array : ";
    //var_dump($xml_array);
    $db->close();
}



?>