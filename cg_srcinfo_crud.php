<?php
	require_once("./dhtmlx_config.php");
    require_once("./include/incUtil.php");

    //ServerViewTxt("N","N","Y","Y");


	$res=mysql_connect($mysql_server,$mysql_user,$mysql_pass);
	mysql_select_db($mysql_db);

	require("./lib/dhtmlxConnector/codebase/grid_connector.php");
	$grid = new GridConnector($res);
    $grid->enable_log("./log/dhtmlx_connector.log",true);
    //$grid->dynamic_loading(100);
    $grid->sql->set_transaction_mode("record"); //global


    //그룹ID받기
    $F_GRPID = $_GET['F_GRPID'];
    $F_PJTID = $_GET['F_PJTID'];
    $F_SRCORD = $_GET['F_SRCORD'];
    $F_SRCDESC = $_GET['F_SRCDESC'];
    $F_FILETYPE = $_GET['F_FILETYPE'];
    $F_DT_TYPE = $_GET['F_DT_TYPE'];
    $F_START_DT = str_replace("-","",$_GET['F_START_DT']); //날짜 타입은 - 제거
    $F_END_DT = str_replace("-","",$_GET['F_END_DT']); //날짜 타입은 - 제거

    //컬럼ROW받기 GRPID,GRPTYPE,GRPNM,GRPORD,COLCNT,REFGRPID,GRPWIDTH,GRPHEIGHT,GRPPADDING,
    $G1_SRCSEQ = $_GET['G1_SRCSEQ'];
    $G1_FILETYPE = $_GET['G1_FILETYPE'];
    $G1_SRCORD = $_GET['G1_SRCORD'];
    $G1_SRCTXT = $_GET['G1_SRCTXT'];
    $G1_INPUT = $_GET['G1_INPUT'];
    $G1_SRCTYPE = $_GET['G1_SRCTYPE'];

    $G2_SRCDSEQ = $_GET['G2_SRCDSEQ'];
    $G2_SRCDORD = $_GET['G2_SRCDORD'];
    $G2_SRCTXT = $_GET['G2_SRCTXT'];
    $G2_INPUT = $_GET['G2_INPUT'];
    $G2_SRCTYPE = $_GET['G2_SRCTYPE'];


    function custom_filter1($filter_by){
        //폼값 가져오기
        global $F_GRPID,$F_PJTID,$F_PCD,$F_PNM,$F_DT_TYPE,$F_START_DT,$F_END_DT,$F_FILETYPE;


        //필터 추
        $filter_by->clear();
        if($F_PJTID != "")        $filter_by->add("PJTID",$F_PJTID,"=");
        if($F_FILETYPE != "")        $filter_by->add("FILETYPE",$F_FILETYPE,"=");

        if($F_SRCDESC != "")        $filter_by->add("SRCDESC","%".$F_SRCDESC."%","LIKE");
        //if($F_PGMID != "")        $filter_by->add("PGMID","%".$F_PGMID."%","LIKE");
        if($F_SRCORD != "")        $filter_by->add("SRCORD", $F_SRCORD ,"=");
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
        if ( $action->get_value("SRCDESC")=="" || $action->get_value("SRCORD")=="")
            $action->invalid();
    }
    function check_data_2($action){
        if ( $action->get_value("SRCDORD")==""  )
            $action->invalid();
    }
    function check_data_3($action){
        if ( !is_numeric($action->get_value("SRCAORD")) )
            $action->invalid();
    }

    if($F_GRPID == "1"){
        if($grid->is_select_mode()){
            //조건부검색
            $grid->event->attach("beforeFilter","custom_filter1");

            $grid->set_options("FILETYPE",array("JS"=> "JS","HTML"=> "HTML", "PHP"=>"PHP"));

                $grid->render_table("(select * from CG_SRCINFO where PJTID='$F_PJTID' order by SRCORD asc ) T1 ","SRCSEQ","SRCSEQ,FILETYPE,SRCORD,SRCDESC,SRCTXT,INPUT,PARAM,SRCTYPE,ADDDT,MODDT");
        }else{

            LogMaster::log("---------------GRP 1---------------------START1");

            //밸리데이션
            $grid->event->attach("beforeProcessing",check_data_1);

            $grid->sql->attach("delete","delete from  CG_SRCINFO  where PJTID = '$F_PJTID' and SRCSEQ = {SRCSEQ} ");
            $grid->sql->attach("insert","
                insert into CG_SRCINFO (
                    PJTID,FILETYPE,SRCORD,SRCDESC,SRCTXT
                    ,INPUT,PARAM,SRCTYPE
                    ,ADDDT
                ) values (
                    '$F_PJTID','{FILETYPE}',{SRCORD},'{SRCDESC}','{SRCTXT}'
                    ,'{INPUT}','{PARAM}','{SRCTYPE}'
                    ,date_format(sysdate(),'%Y%m%d%H%i%s')
                ) ");
            $grid->sql->attach("update","
                update CG_SRCINFO set
                    FILETYPE='{FILETYPE}', SRCORD = {SRCORD}, SRCDESC = '{SRCDESC}', SRCTXT = '{SRCTXT}', INPUT = '{INPUT}'
                    , SRCTYPE = '{SRCTYPE}', PARAM = '{PARAM}'
                    , MODDT =date_format(sysdate(),'%Y%m%d%H%i%s')
                where PJTID='$F_PJTID' and SRCSEQ={SRCSEQ} ");
            LogMaster::log("---------------GRP 1---------------------START2");
            $grid->render_table("(select * from CG_SRCINFO where PJTID='$F_PJTID' order by SRCORD asc ) T1 ","SRCSEQ","SRCSEQ,FILETYPE,SRCORD,SRCDESC,SRCTXT,INPUT,PARAM,SRCTYPE,ADDDT,MODDT");
            LogMaster::log("---------------GRP 1---------------------START3");
        }
    }

    if($F_GRPID == "2"){

        if($grid->is_select_mode()){
            $grid->render_table("(select * from CG_SRCINFOD where PJTID = '$F_PJTID' and SRCSEQ = $G1_SRCSEQ) T1 "
                ,"SRCDSEQ","SRCDSEQ,SRCDORD,SRCDESC,SRCTXT,SPTTXT,INPUT,PARAM,SRCTYPE,ADDDT,MODDT");
        }else{
            //밸리데이션
            $grid->event->attach("beforeProcessing",check_data_2);


            $grid->sql->attach("delete","delete from CG_SRCINFOD where PJTID='$F_PJTID' and SRCDSEQ = {SRCDSEQ} ");
            $grid->sql->attach("insert","
                insert into CG_SRCINFOD (
                                    PJTID,SRCSEQ,SRCDORD,SRCTXT,INPUT
                                    ,SRCTYPE,PARAM,SRCDESC,SPTTXT
                                    ,ADDDT
               ) values (
                                    '$F_PJTID',$G1_SRCSEQ,{SRCDORD},'{SRCTXT}','{INPUT}'
                                    ,'{SRCTYPE}','{PARAM}','{SRCDESC}','{SPTTXT'
                                    ,date_format(sysdate(),'%Y%m%d%H%i%s')
               ) ");
            $grid->sql->attach("update","
                update CG_SRCINFOD set
                    SRCDORD = {SRCDORD}, SRCTXT='{SRCTXT}', INPUT = '{INPUT}', PARAM = '{PARAM}', SRCTYPE = '{SRCTYPE}'
                    ,SRCDESC = '{SRCDESC}', SPTTXT = '{SPTTXT}'
                    ,MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
                where PJTID='$F_PJTID' and SRCDSEQ = {SRCDSEQ} ");

            $grid->render_table("(select * from CG_SRCINFOD where PJTID = '$F_PJTID' and SRCSEQ = $G1_SRCSEQ) T1 "
                ,"SRCDSEQ","SRCDSEQ,SRCDORD,SRCDESC,SRCTXT,SPTTXT,INPUT,PARAM,SRCTYPE,ADDDT,MODDT");
        }

    }




    if($F_GRPID == "3"){

        if($grid->is_select_mode()){
            $grid->render_table("(select * from CG_SRCINFOA where PJTID = '$F_PJTID' and SRCDSEQ = $G2_SRCDSEQ) T1 "
                ,"SRCAORD","SRCASEQ,SRCAORD,SRCDESC,SRCTXT,SPTTXT,INPUT,PARAM,SRCTYPE,ADDDT,MODDT");
        }else{
            //밸리데이션
            $grid->event->attach("beforeProcessing",check_data_3);


            $grid->sql->attach("delete","delete from CG_SRCINFOA where PJTID='$F_PJTID' and SRCASEQ = {SRCASEQ} ");
            $grid->sql->attach("insert","
                insert into CG_SRCINFOA (
                                    PJTID,SRCDSEQ,SRCAORD,SRCTXT,INPUT
                                    ,SRCTYPE,PARAM,SRCDESC,SPTTXT
                                    ,ADDDT
               ) values (
                                    '$F_PJTID',$G2_SRCDSEQ,{SRCAORD},'{SRCTXT}','{INPUT}'
                                    ,'{SRCTYPE}','{PARAM}','{SRCDESC}','{SPTTXT}'
                                    ,date_format(sysdate(),'%Y%m%d%H%i%s')
               ) ");
            $grid->sql->attach("update","
                update CG_SRCINFOA set
                    SRCAORD = {SRCAORD}, SRCTXT='{SRCTXT}', INPUT = '{INPUT}', SRCTYPE = '{SRCTYPE}',PARAM='{PARAM}'
                    ,SRCDESC = '{SRCDESC}',SPTTXT = '{SPTTXT}'
                    ,MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
                where PJTID='$F_PJTID' and SRCASEQ = {SRCASEQ} ");

            $grid->render_table("(select * from CG_SRCINFOA where PJTID = '$F_PJTID' and SRCDSEQ = $G2_SRCDSEQ) T1 "
                ,"SRCAORD","SRCASEQ,SRCAORD,SRCDESC,SRCTXT,SPTTXT,INPUT,PARAM,SRCTYPE,ADDDT,MODDT");
        }

    }
?>