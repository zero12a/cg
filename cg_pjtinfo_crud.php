<?php
	require_once("./dhtmlx_config.php");
    require_once("./include/incUtil.php");

    //ServerViewTxt("N","N","Y","Y");


	$res=mysql_connect($mysql_server,$mysql_user,$mysql_pass);
	mysql_select_db($mysql_db);

	require("./lib/dhtmlxConnector/codebase/grid_connector.php");
	$grid = new GridConnector($res);
    $grid->enable_log("./log/dhtmlx_connector.log",true);
    $grid->dynamic_loading(100);
    $grid->sql->set_transaction_mode("record"); //record, global


    function custom_filter($filter_by){
        global $_GET;

        //변수로 받기
        $F_PJTID = $_GET['F_PJTID'];
        $F_PJTNM = $_GET['F_PJTNM'];
        $F_DT_TYPE = $_GET['F_DT_TYPE'];
        $F_START_DT = str_replace("-","",$_GET['F_START_DT']); //날짜 타입은 - 제거
        $F_END_DT = str_replace("-","",$_GET['F_END_DT']); //날짜 타입은 - 제거


        //필터 추
        $filter_by->clear();
        if($F_PJTID != "")        $filter_by->add("PJTID","%".$F_PJTID."%","LIKE");
        if($F_PJTNM != "")        $filter_by->add("PJTNM","%".$F_PJTNM."%","LIKE");
        if($F_START_DT != "" )
            ($_GET['F_DT_TYPE'] == "ADDDT")?$filter_by->add("ADDDT",$F_START_DT,">="):$filter_by->add("MODDT",$F_START_DT,">=") ;
        if($F_END_DT != "" )
            ($_GET['F_DT_TYPE'] == "ADDDT")?$filter_by->add("ADDDT",$F_END_DT,"<="):$filter_by->add("MODDT",$F_END_DT,"<=") ;



        //$filter_by->rules[$index]["name"] = "PJTNM";
        //$filter_by->rules[$index]["value"] = ;
        //$filter_by->rules[$index]["operation"] = "=";

    }
    function check_data($action){
        if ($action->get_value("PJTNM")=="" || $action->get_value("PJTID")=="")
            $action->invalid();
    }

    if($grid->is_select_mode()){
        //조건부검색
        $grid->event->attach("beforeFilter","custom_filter");

        $grid->render_table("(select * from CG_PJTINFO where DELYN='N') T1 ","PJTID","PJTID,PJTNM,ADDDT,MODDT");
    }else{
        //밸리데이션
        $grid->event->attach("beforeProcessing",check_data);

        $grid->sql->attach("delete","update CG_PJTINFO set DELYN='Y' where PJTID = '{PJTID}' ");
        $grid->sql->attach("insert","insert into CG_PJTINFO (PJTID,PJTNM,ADDDT) values (  '{PJTID}','{PJTNM}',date_format(sysdate(),'%Y%m%d%H%i%s')  ) ");
        $grid->sql->attach("update","update CG_PJTINFO set PJTNM='{PJTNM}', MODDT =date_format(sysdate(),'%Y%m%d%H%i%s')  where PJTID='{PJTID}' ");

        $grid->render_table("CG_PJTINFO","PJTID","PJTID,PJTNM,ADDDT,MODDT");
    }




?>