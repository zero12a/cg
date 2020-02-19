<?php
    header("Content-Type: text/html; charset=UTF-8");
    header("Cache-Control:no-cache");
    header("Pragma:no-cache");

    $CFG = include_once("../common/include/incConfig.php");

    require_once("../common/include/incUtil.php");
    require_once("../common/include/incDB.php");
    require_once("../common/include/incSec.php");

    //ServerViewTxt("N","N","Y","Y");

    $db=getDbConn($CFG["CFG_DB"]["CGCORE"]);

    echo '
<?xml version="1.0" encoding="utf-8"?>
<tree id="0" radio="1">
	<item   text="CG" id="cg" open="1">
        <item text="OBJIFO" id="objinfo^/c.g/cg_objinfo3.php">cg_objinfo.php2</item>
        <item text="PGMINFO" id="pgminfo3^/c.g/cg_pgminfo3.php">cg_pgminfo.php3</item>
        <item text="PGM관리" id="pgmmng^/c.g/cg_pgmmng.php">cg_pgmmng.php</item>
        <item text="CONFIG관리" id="configmng^/c.g/cg_configmng.php">cg_configmng.php</item>
	</item>

';
    
alog("---------------GRP PGM ---------------------START");

    $to_coltype = "";
    alog("        to_coltype : " . $to_coltype);
    $sql = "
      select PJTSEQ,PJTID,PJTNM,DSNM from CG_PJTINFO where DELYN='N'
          ";

    $REQ = null;
    $stmt = make_stmt($db,$sql, $to_coltype, $REQ);
    if(!$stmt)   JsonMsg("500","108","stmt 생성 실패" . $db->errno . " -> " . $db->error);
    //var_dump( make_grid_read_array($stmt) );

    $tResultArray = make_grid_read_array($stmt);
    $stmt->close();
    foreach($tResultArray->RTN_DATA->data as $tMap) {
        ?>
        <item   text="<?=$tMap["PJTNM"]?>" id="<?=$tMap["PJTID"]?>" open="1">
        <?php
        //echo "<br>tmap dsnm : " . $tMap["DSNM"];
        //echo "<br>cfg ds : " . $CFG["CFG_DB"][$tMap["DSNM"]];
        //exit;
        //var_dump($CFG["CFG_DB"][$tMap["DSNM"]]);
        //exit;

        //echo "<br>000";        
        if($tMap["DSNM"] !=""){

            $dbPjt=getDbConn($CFG["CFG_DB"][$tMap["DSNM"]]);

        

            $REQ["PJTSEQ"] = $tMap["PJTSEQ"];
            $to_coltype = "i";
            $sql = " select PGMSEQ,PGMID,PGMNM,VIEWURL from CG_PGMINFO where PJTSEQ = #PJTSEQ# ";
    
            $stmt = make_stmt($dbPjt,$sql, $to_coltype, $REQ);
    
    
            if(!$stmt)   JsonMsg("500","109","stmt 생성 실패" . $dbPjt->errno . " -> " . $dbPjt->error);
            //var_dump( make_grid_read_array($stmt) );
            //echo "<br>111";
    
            $tPgmArray = make_grid_read_array($stmt);
            $stmt->close();
            $subItemCnt = 0;
            foreach($tPgmArray->RTN_DATA->data as $tMap2) {
                echo '      <item text="' . $tMap2["PGMNM"] . '" id="' . $tMap2["PGMSEQ"] . "^" . $CFG["CFG_MAKE_URL"] . "/c.g/" . $tMap["PJTID"] . "/" . $tMap2["VIEWURL"] . '"></item>' . PHP_EOL;
                $subItemCnt++;
            }
            //echo "<br>222";        
            $dbPjt->close();
            unset($dbPjt);
        }

        if($subItemCnt == 0){
        ?>
        <item text="-" id="<?=$REQ["PJTSEQ"]?>:-"></item>
        <?php
        }
        ?>
        </item>
        <?php
                //echo "<br>333";
    }
    //echo "<br>444";
    $db->close();
?>        

</tree>