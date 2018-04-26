<?
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
	$REQ["PJTSEQ"] = $_POST["PJTSEQ"];


	if($FNC == "PGMLIST"){
		$map["SQL"]["R"]["SQLTXT"] = " 
			select a.PGMSEQ, a.PGMNM, a.PGMID, concat(b.MKFILEFORMAT,'.',b.MKFILEEXT) as MKFILE, a.ADDDT, a.MODDT
			from 
				CG_PGMINFO a
				join CG_PJTFILE b on a.PJTSEQ = b.PJTSEQ and b.MKFILETYPE='HTML'
			where a.PJTSEQ = #{PJTSEQ}
			";

		$map["SQL"]["R"]["BINDTYPE"] = "i";
		
		//ServerViewTxt("N","N","Y","Y");

		$db=db_m_open();

		$rtnVal1 = makeGridSearchJson($map,$db);
		$rtnVal1->RTN_CD = "200";
		$rtnVal1->ERR_CD = "200";
		$rtnVal2 = $rtnVal1;


		$T = "";
		for($i=0;$i<count($rtnVal1->RTN_DATA->rows);$i++){
				$row = $rtnVal1->RTN_DATA->rows[$i];
				//alog("i = ". $i);
				//alog("	row 3 = " . $row["data"][3] );
				//alog("	row 2 = " . $row["data"][2] );
				$T["P"]["PGMID"] = $row["data"][2];
				//alog("	R = " . R($row["data"][3],$T) );
				$row["data"][3] = R($row["data"][3],$T);
				$rtnVal2->RTN_DATA->rows[$i] = $row;


		}

		//		var_dump($trnVal2);
		echo json_encode($rtnVal2);		
	    $db->close();

	}else{

		$REQ["USERSEQ"] = 1;
		$map["SQL"]["R"]["SQLTXT"] = " 
			select a.* from 
				CG_PJTINFO a
				join CG_PJTUSER b on a.PJTSEQ = b.PJTSEQ
				join CG_USERS c on c.USERSEQ = b.USERSEQ
			where c.USERSEQ = #{USERSEQ}
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
