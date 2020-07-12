<?php
    header("Content-Type: text/html; charset=UTF-8");
    header("Cache-Control:no-cache");
    header("Pragma:no-cache");

    $CFG = include_once("../common/include/incConfig.php");

    require_once($CFG["CFG_LIBS_VENDOR"]);

    require_once("../common/include/incUser.php");
    require_once("../common/include/incAuth.php");
    require_once("../common/include/incUtil.php");
    require_once("../common/include/incDB.php");
    require_once("../common/include/incSec.php");

    //ServerViewTxt("N","N","Y","Y");
    $resToken = uniqid();

    $log = getLogger(
        array(
        "LIST_NM"=>"log_CG"
        , "PGM_ID"=>"menu_data"
        , "REQTOKEN" => $reqToken
        , "RESTOKEN" => $resToken
        , "LOG_LEVEL" => Monolog\Logger::INFO
        )
    );

    $db=getDbConn($CFG["CFG_DB"]["CGCORE"]);

    echo '
<?xml version="1.0" encoding="utf-8"?>
<tree id="0" radio="1">
	<item   text="CG" id="cg" open="1">
        <item text="OBJIFO" id="objinfo^/c.g/cg_objinfo3.php">cg_objinfo.php2</item>
        <item text="PGMINFO" id="pgminfo3^/c.g/cg_pgminfo3.php">cg_pgminfo.php3</item>
        <item text="PGM관리" id="pgmmng^/c.g/cg_pgmmng.php">cg_pgmmng.php</item>
        <item text="CONFIG관리" id="configmng^/c.g/cg_configmng.php">cg_configmng.php</item>
        <item text="REDIS관리" id="redismng^http://localhost:8040/d.s/CG/redismngView.php">redismngView.php</item>
	</item>

';
    
alog("---------------GRP PGM ---------------------START");

    $to_coltype = "";
    alog("        to_coltype : " . $to_coltype);
    $sql = "
      select PJTSEQ,PJTID,PJTNM,DSNM from CG_PJTINFO where DELYN='N'
          ";

    $REQ = null;
    $stmt = makeStmt($db,$sql, $to_coltype, $REQ);
    if(!$stmt)   JsonMsg("500","108","stmt 생성 실패" . $db->errno . " -> " . $db->error);
    //var_dump( make_grid_read_array($stmt) );
    if(!$stmt->execute())JsonMsg("500","100","stmt 실행 실패" . $db->errno . " -> " . $db->error);
    

    //$tArr =  getStmtArray($stmt);

    //$tResultArray = make_grid_read_array($stmt);
    //$stmt->close();
    //echo "<br>리턴 결과 row수 : " . getRowCount($stmt);    
    while( $tMap = $stmt->fetch(PDO::FETCH_ASSOC) ) {
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

            /*
            if(function_exists($dbPjt->getAttribute)){
                echo "pdo_mysql";
            }else{
                echo "mysqli";
            }
            */

            $REQ["PJTSEQ"] = $tMap["PJTSEQ"];
            //echo "<BR>DSNM : " .  $tMap["DSNM"] ;
            //echo "<BR>PJTSEQ : " .  $REQ["PJTSEQ"] ;
            $to_coltype = "i";
            $sql = " select PGMSEQ,PGMID,PGMNM,VIEWURL from CG_PGMINFO where PJTSEQ = #{PJTSEQ} ";
    
            $stmt2 = makeStmt($dbPjt,$sql, $to_coltype, $REQ);
    
    
            if(!$stmt2)   JsonMsg("500","109","stmt 생성 실패" . $dbPjt->errno . " -> " . $dbPjt->error);
            if(function_exists($dbPjt->getAttribute)){
                //pdo
                try{
                    //echo "실행결과 : " . $stmt2->execute(array($REQ["PJTSEQ"]));

                    if(!$stmt2->execute(array($REQ["PJTSEQ"]))){
                        $arr = $stmt2->errorInfo();
                        print_r($arr);
                        //JsonMsg("500","100","stmt 실행 실패" . $dbPjt->errno . " -> " . $dbPjt->error);
                    }
                } catch(PDOException $e) {
                    echo "PDOException : " . $e->getMessage();
                }
                
            }else{
                
                //mysqli
                if(!$stmt2->execute())JsonMsg("500","100","stmt 실행 실패" . $dbPjt->errno . " -> " . $dbPjt->error);
                
            }


            //var_dump( make_grid_read_array($stmt) );
            //echo "<br>111";
    
            //$tPgmArray = make_grid_read_array($stmt);
            //$stmt->close();
            $subItemCnt = 0;

            if(function_exists($dbPjt->getAttribute)){
                //pdo
                //echo "444";                
                while( $tMap2 = $stmt2->fetch(PDO::FETCH_ASSOC) ) {
                    echo '      <item text="' . $tMap2["PGMNM"] . '" id="' . $tMap2["PGMSEQ"] . "^" . $CFG["CFG_DEMO_URL"] . "/d.s/" . $tMap["PJTID"] . "/" . $tMap2["VIEWURL"] . '"></item>' . PHP_EOL;
                    $subItemCnt++;
                }
            }else{
                //mysqli
                //echo "333";
                $result = $stmt2->get_result();
                //echo "<br>리턴 결과 row수 : " . getRowCount($result);
                while ($tMap2 = $result->fetch_array(MYSQLI_ASSOC)){

                    echo '      <item text="' . $tMap2["PGMNM"] . '" id="' . $tMap2["PGMSEQ"] . "^" . $CFG["CFG_DEMO_URL"] . "/d.s/" . $tMap["PJTID"] . "/" . $tMap2["VIEWURL"] . '"></item>' . PHP_EOL;
                    $subItemCnt++;
                }
            }


            closeStmt($stmt2);
            closeDb($dbPjt);
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
    closeStmt($stmt);
    closeDb($db);
    
?>        

</tree>