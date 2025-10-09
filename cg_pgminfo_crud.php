<?php
    header("Content-Type: text/html; charset=UTF-8");
    header("Cache-Control:no-cache");
    header("Pragma:no-cache");

	require_once("./dhtmlx_config.php");
    require_once("./include/incUtil.php");

    //ServerViewTxt("N","N","Y","Y");


	$res=mysql_connect($mysql_server,$mysql_user,$mysql_pass);
	mysql_select_db($mysql_db);

	require("./lib/dhtmlxConnector/codebase/grid_connector.php");
	$grid = new GridConnector($res);
    $grid->enable_log("./log/dhtmlx_connector.log",true);
    $grid->dynamic_loading(100);
    $grid->sql->set_transaction_mode("record"); //global


    //그룹ID받기
    $F_GRPID = $_GET['F_GRPID'];
    $F_PJTID = $_GET['F_PJTID'];
    $F_PGMID = $_GET['F_PGMID'];
    $F_PGMNM = $_GET['F_PGMNM'];
    $F_DT_TYPE = $_GET['F_DT_TYPE'];
    $F_START_DT = str_replace("-","",$_GET['F_START_DT']); //날짜 타입은 - 제거
    $F_END_DT = str_replace("-","",$_GET['F_END_DT']); //날짜 타입은 - 제거

    //컬럼ROW받기 GRPID,GRPTYPE,GRPNM,GRPORD,BRCNT,REFGRPID,GRPWIDTH,GRPHEIGHT,GRPPADDING,
    $G_GRPID = $_GET['G_GRPID'];
    $G_GRPTYPE = $_GET['G_GRPTYPE'];
    $G_GRPNM = $_GET['G_GRPNM'];
    $G_GRPORD = $_GET['G_GRPORD'];
    $G_COLBRCNT = $_GET['G_COLBRCNT'];
    $G_REFGRPID = $_GET['G_REFGRPID'];
    $G_GRPWIDTH = $_GET['G_GRPWIDTH'];
    $G_GRPHEIGHT = $_GET['G_GRPHEIGHT'];
    $G_GRPPADDING = $_GET['G_GRPPADDING'];

    function custom_filter1($filter_by){
        //폼값 가져오기
        global $F_GRPID,$F_PJTID,$F_PCD,$F_PNM,$F_DT_TYPE,$F_START_DT,$F_END_DT;


        //필터 추
        $filter_by->clear();
        if($F_PJTID != "")        $filter_by->add("PJTID",$F_PJTID,"=");
        if($F_PGMID != "")        $filter_by->add("PGMID",$F_PGMID,"=");
        //if($F_PGMID != "")        $filter_by->add("PGMID","%".$F_PGMID."%","LIKE");
        if($F_PGMNM != "")        $filter_by->add("PGMNM","%".$F_PGMNM."%","LIKE");
        if($F_START_DT != "" )
            ($_GET['F_DT_TYPE'] == "ADDDT")?$filter_by->add("ADDDT",$F_START_DT,">="):$filter_by->add("MODDT",$F_START_DT,">=") ;
        if($F_END_DT != "" )
            ($_GET['F_DT_TYPE'] == "ADDDT")?$filter_by->add("ADDDT",$F_END_DT,"<="):$filter_by->add("MODDT",$F_END_DT,"<=") ;



        //$filter_by->rules[$index]["name"] = "PJTNM";
        //$filter_by->rules[$index]["value"] = ;
        //$filter_by->rules[$index]["operation"] = "=";

    }

    //입력값 밸리데이션
    function check_data_1($action){
        if(  $action->get_value("GRPID")=="" || $action->get_value("GRPNM")=="" || !is_numeric($action->get_value("COLBRCNT")) || !is_numeric($action->get_value("FREEZECNT")) )
            $action->invalid();
    }
    function check_data_2($action){
        if ($action->get_value("CRUD")=="" || !is_numeric($action->get_value("SQLORD")) )
            $action->invalid();
    }
    function check_data_4($action){
        if ($action->get_value("COLID")=="" || !is_numeric($action->get_value("COLORD")) || $action->get_value("OBJTYPE")=="" || $action->get_value("OBJWIDTH")==""  )
            $action->invalid();
    }

    if($F_GRPID == "1"){
        if($grid->is_select_mode()){
            //조건부검색
            $grid->event->attach("beforeFilter","custom_filter1");

            $grid->render_table("(select * from CG_PGMINFOD where PJTID='$F_PJTID' and PGMID ='$F_PGMID') T1 ","GRPID","GRPID,GRPTYPE,GRPNM,GRPORD,FREEZECNT,COLBRCNT,REFGRPID,BRYN,GRPWIDTH,GRPHEIGHT,GRPPADDING");
        }else{
            //밸리데이션
            $grid->event->attach("beforeProcessing",check_data_1);

            $grid->sql->attach("delete","delete from  CG_PGMINFOD  where PJTID = '$F_PJTID' and PGMID = '$F_PGMID' and GRPID = {GRPID} ");
            $grid->sql->attach("insert","
                insert into CG_PGMINFOD (
                    PJTID,PGMID,GRPID,GRPNM,GRPTYPE
                    ,GRPORD,COLBRCNT,REFGRPID,GRPWIDTH,GRPHEIGHT
                    ,GRPPADDING,BRYN,FREEZECNT
                    ,ADDDT
                ) values (
                    '$F_PJTID','$F_PGMID','{GRPID}','{GRPNM}','{GRPTYPE}'
                    ,{GRPORD},{COLBRCNT},'{REFGRPID}','{GRPWIDTH}','{GRPHEIGHT}'
                    ,'{GRPPADDING}','{BRYN}',{FREEZECNT}
                    ,date_format(sysdate(),'%Y%m%d%H%i%s')
                ) ");
            $grid->sql->attach("update","
                update CG_PGMINFOD set
                    GRPNM='{GRPNM}', GRPTYPE = '{GRPTYPE}', GRPORD = {GRPORD}, COLBRCNT = {COLBRCNT}, REFGRPID = '{REFGRPID}'
                    , GRPWIDTH = '{GRPWIDTH}',GRPHEIGHT = '{GRPHEIGHT}',GRPPADDING = '{GRPPADDING}', BRYN='{BRYN}', FREEZECNT = '{FREEZECNT}'
                    , MODDT =date_format(sysdate(),'%Y%m%d%H%i%s')
                where PJTID='$F_PJTID' and PGMID = '$F_PGMID' and GRPID='{GRPID}' ");

            $grid->render_table("(select * from CG_PGMINFOD where PJTID='$F_PJTID' and PGMID ='$F_PGMID') T1 ","GRPID","GRPID,GRPTYPE,GRPNM,GRPORD,FREEZECNT,COLBRCNT,REFGRPID,BRYN,GRPWIDTH,GRPHEIGHT,GRPPADDING");
        }
    }

    if($F_GRPID == "2"){

        if($grid->is_select_mode()){
            $grid->render_table("(select * from CG_SQLINFO where PJTID = '$F_PJTID' and PGMID = '$F_PGMID' and GRPID = '$G_GRPID') T1 "
                ,"SQLORD","CRUD,SQLORD,SQLTXT,ADDDT,MODDT");
        }else{
            //밸리데이션
            $grid->event->attach("beforeProcessing",check_data_2);


            $grid->sql->attach("delete","delete from CG_SQLINFO where PJTID='$F_PJTID' and PGMID = '$F_PGMID' and GRPID = '$G_GRPID' and CRUD = '{CRUD}' and SQLORD = {SQLORD} ");
            $grid->sql->attach("insert","
                insert into CG_SQLINFO (
                                    PJTID,PGMID,GRPID,CRUD,SQLORD
                                    ,SQLTXT
                                    ,ADDDT
               ) values (
                                    '$F_PJTID','$F_PGMID','$G_GRPID','{CRUD}',{SQLORD}
                                    ,'{SQLTXT}'
                                    ,date_format(sysdate(),'%Y%m%d%H%i%s')
               ) ");
            $grid->sql->attach("update","
                update CG_SQLINFO set
                    SQLTXT='{SQLTXT}'
                    ,MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
                where PJTID='$F_PJTID' and PGMID = '$F_PGMID' and GRPID = '$G_GRPID' and CRUD = '{CRUD}' and SQLORD = {SQLORD} ");

            $grid->render_table("(select * from CG_SQLINFO where PJTID = '$F_PJTID' and PGMID = '$F_PGMID' and GRPID = '$G_GRPID') T1","SQLORD","CRUD,SQLORD,SQLTXT,ADDDT,MODDT");
        }

    }




    if($F_GRPID == "4"){

        if($grid->is_select_mode()){
            $grid->render_table("(select * from CG_IOINFO where PJTID = '$F_PJTID' and PGMID = '$F_PGMID' and GRPID = '$G_GRPID') T1 "
                ,"COLID","COLORD,COLID,COLNM,DATATYPE,DATASIZE,OBJTYPE,BRYN,LBLHIDDENYN,LBLWIDTH,OBJWIDTH,OBJHEIGHT,KEYYN,HIDDENYN,EDITYN,FNINIT,FNNMSEARCH,FNPOPSEARCH,COLFORMAT,VALIDREQUARE,VALIDMIN,VALIDMAX,OBJALIGN,REFCOLID,ADDDT,MODDT");
        }else{
            //밸리데이션
            //$grid->event->attach("beforeProcessing",check_data_4);


            $grid->sql->attach("delete","delete from CG_IOINFO where PJTID='$F_PJTID' and PGMID = '$F_PGMID' and GRPID = '$G_GRPID' and COLID = '{COLID}' ");
            $grid->sql->attach("insert","
                    insert into CG_IOINFO (
                                        PJTID,PGMID,GRPID,COLID,COLORD
                                        ,COLNM,DATATYPE,DATASIZE,OBJTYPE,LBLHIDDENYN
                                        ,LBLWIDTH,OBJWIDTH,HIDDENYN,EDITYN,FNINIT
                                        ,FNNMSEARCH,FNPOPSEARCH,COLFORMAT,VALIDREQUARE,VALIDMIN
                                        ,VALIDMAX,OBJALIGN,REFCOLID,KEYYN,OBJHEIGHT
                                        ,ADDDT
                   ) values (
                                        '$F_PJTID','$F_PGMID','$G_GRPID','{COLID}',{COLORD}
                                        ,'{COLNM}','{DATATYPE}','{DATASIZE}','{OBJTYPE}','{LBLHIDDENYN}'
                                        ,'{LBLWIDTH}','{OBJWIDTH}','{HIDDENYN}','{EDITYN}','{FNINIT}'
                                        ,'{FNNMSEARCH}','{FNPOPSEARCH}','{COLFORMAT}','{VALIDREQUARE}','{VALIDMIN}'
                                        ,'{VALIDMAX}','{OBJALIGN}','{REFCOLID}','{KEYYN}','{OBJHEIGHT}'
                                        ,date_format(sysdate(),'%Y%m%d%H%i%s')
                   ) ");
            $grid->sql->attach("update","
                    update CG_IOINFO set
                        COLORD={COLORD},COLNM='{COLNM}',DATATYPE='{DATATYPE}',DATASIZE={DATASIZE},OBJTYPE = '{OBJTYPE}'
                        ,LBLHIDDENYN='{LBLHIDDENYN}',LBLWIDTH='{LBLWIDTH}',OBJWIDTH='{OBJWIDTH}',HIDDENYN='{HIDDENYN}',EDITYN='{EDITYN}'
                        ,FNINIT='{FNINIT}',FNNMSEARCH='{FNNMSEARCH}',FNPOPSEARCH='{FNPOPSEARCH}',COLFORMAT='{COLFORMAT}',VALIDREQUARE='{VALIDREQUARE}'
                        ,VALIDMIN='{VALIDMIN}',VALIDMAX='{VALIDMAX}',OBJALIGN='{OBJALIGN}',REFCOLID='{REFCOLID}', KEYYN='{KEYYN}'
                        ,BRYN='{BRYN}', OBJHEIGHT='{OBJHEIGHT}'
                        ,MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
                    where PJTID='$F_PJTID' and PGMID = '$F_PGMID' and GRPID = '$G_GRPID' and COLID = '{COLID}'  ");


            $grid->render_table("(select * from CG_IOINFO where PJTID = '$F_PJTID' and PGMID = '$F_PGMID' and GRPID = '$G_GRPID') T1 "
                ,"COLID","COLORD,COLID,COLNM,DATATYPE,DATASIZE,OBJTYPE,BRYN,LBLHIDDENYN,LBLWIDTH,OBJWIDTH,OBJHEIGHT,KEYYN,HIDDENYN,EDITYN,FNINIT,FNNMSEARCH,FNPOPSEARCH,COLFORMAT,VALIDREQUARE,VALIDMIN,VALIDMAX,OBJALIGN,REFCOLID,ADDDT,MODDT");


        }

    }
?>