<?php
header("Content-Type: text/html; charset=UTF-8");
header("Cache-Control:no-cache");
header("Pragma:no-cache");


    require_once("./include/incUtil.php");
    require_once("./incConfig.php");
    require_once("./include/incDB.php");
    require_once("cg_make_func.php");

	
	//명령어
	$FNC = $_GET["FNC"];

	//데이터
	//$REQ["PJTSEQ"] = $_GET["PJTSEQ"];
	$REQ["PJTSEQ"] = $_POST["PJTSEQ"];


	if($FNC == "PGMLIST"){
		$map["SQL"]["R"]["SQLTXT"] = " 
			select a.PGMSEQ as id, a.PGMNM as text, a.PGMID, 1 as open,concat(b.MKFILEFORMAT,'.',b.MKFILEEXT) as MKFILE, a.ADDDT, a.MODDT
			from 
				CG_PGMINFO a
				join CG_PJTFILE b on a.PJTSEQ = b.PJTSEQ and b.MKFILETYPE='HTML'
			where a.PJTSEQ = #{PJTSEQ}
			";

		$map["SQL"]["R"]["BINDTYPE"] = "i";
		
		//ServerViewTxt("N","N","Y","Y");

		$db=db_m_open();

		$rtnVal1 = makeDataviewSearchJson($map,$db);

		$T = "";
		for($i=0;$i<count($rtnVal1);$i++){
				$row = $rtnVal1[$i];
				//alog("i = ". $i);
				//alog("	row 3 = " . $row["data"][3] );
				//alog("	row 2 = " . $row["data"][2] );
				$T["P"]["PGMID"] = $row["PGMID"];
				//alog("	R = " . R($row["data"][3],$T) );
				$row["id"] = R($row["MKFILE"],$T);
				$rtnVal2[$i] = $row;


		}



		echo '{"id":0,"item":';
		echo json_encode($rtnVal2);		
		echo '}';
	    $db->close();

	}else if($FNC == "PJTINFO"){
		$map["SQL"]["R"]["SQLTXT"] = " 
			select PJTSEQ,PJTID,PJTNM,ADDDT,MODDT
			from 
				CG_PJTINFO
			where PJTSEQ = #{PJTSEQ}
			";

		$map["SQL"]["R"]["BINDTYPE"] = "i";
		
		//ServerViewTxt("N","N","Y","Y");

		$db=db_m_open();

		$rtnVal = makeDataviewSearchJson($map,$db);
		echo json_encode($rtnVal);		
	    $db->close();

	}else{

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
		$rtnVal = makeGridSearchJson($map,$db);
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);		
	    $db->close();
	}
?>
