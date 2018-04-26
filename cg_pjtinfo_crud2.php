<?php
	require_once("./dhtmlx_config.php");
	$res=mysql_connect($mysql_server,$mysql_user,$mysql_pass);
	mysql_select_db($mysql_db);

	require("./lib/dhtmlxConnector/codebase/grid_connector.php");
	$grid = new GridConnector($res);
    $grid->enable_log("./log/dhtmlx_connector.log",true);


    $F_PJTID = $_GET["PJTID"];

    //$grid->filter("PJTID",$F_PJTID);

    $grid->dynamic_loading(100);



if($grid->is_select_mode()){
    $grid->render_table("(select * from CG_PGMINFO where PJTID='$F_PJTID') T1 ","PGMID","PGMID,PGMNM,ADDDT,MODDT");
}else{
    $grid->sql->attach("delete","delete from CG_PGMINFO where PJTID='$F_PJTID' and PGMID = '{PGMID}' ");
    $grid->sql->attach("insert","insert into CG_PGMINFO ( PJTID,PGMID,PGMNM,ADDDT ) values (  '$F_PJTID','{PGMID}','{PGMNM}',date_format(sysdate(),'%Y%m%d%H%i%s')  ) ");
    $grid->sql->attach("update","update CG_PGMINFO set PGMNM='{PGMNM}', MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')  where PJTID='$F_PJTID' and PGMID = '{PGMID}' ");

    $grid->render_table("CG_PGMINFO","PGMID","PGMID,PGMNM,ADDDT,MODDT");
}


?>