<?php
header("Content-Type: text/html; charset=UTF-8");
header("Cache-Control:no-cache");
header("Pragma:no-cache");


    require_once("./include/incUtil.php");
    require_once("./incConfig.php");
    require_once("./include/incDB.php");

	
	$REQ["USERSEQ"] = 1;
	$map["SQL"]["R"]["SQLTXT"] = " 
		select a.* from 
			CG_PJTINFO a
			join CG_PJTUSER b on a.PJTSEQ = b.PJTSEQ
			join CG_USERS c on c.USERSEQ = b.USERSEQ
		where c.USERSEQ = #USERSEQ#
		";

	$map["SQL"]["R"]["BINDTYPE"] = "i";
	

    //ServerViewTxt("N","N","Y","Y");

    $db=db_m_open();
	echo json_encode(makeDataviewSearchJson($map, $db));

?>
