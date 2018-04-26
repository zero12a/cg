<?
    header("Content-Type: text/html; charset=UTF-8");
    header("Cache-Control:no-cache");
    header("Pragma:no-cache");


    require_once("./include/incUtil.php");
    require_once("./incConfig.php");
    require_once("./include/incDB.php");


    //ServerViewTxt("N","N","Y","Y");

    $db=db_m_open();

    echo '
<?xml version="1.0" encoding="utf-8"?>
<tree id="0" radio="1">
	<item   text="CG" id="cg" open="1">
        <item text="PJTINFO" id="pjtinfo:/c.g/rst/pgmmngView.php">test2View</item>
        <item text="CODE" id="code:/c.g/cg_code.php">cg_code.php2</item>
        <item text="OBJIFO" id="objinfo:/c.g/cg_objinfo3.php">cg_objinfo.php2</item>
        <item text="PGMINFO" id="pgminfo3:/c.g/cg_pgminfo3.php">cg_pgminfo.php3</item>
        <item text="LAYOUT" id="layout:/c.g/cg_layout.php">cg_pgminfo.php2</item>
	</item>

';
    
alog("---------------GRP PGM ---------------------START");

    $to_coltype = "";
    alog("        to_coltype : " . $to_coltype);
    $sql = "
      select PJTSEQ,PJTID,PJTNM from CG_PJTINFO where DELYN='N'
          ";

    $REQ = null;
    $stmt = make_stmt($db,$sql, $to_coltype, $REQ);
    if(!$stmt)   JsonMsg("500","108","stmt 생성 실패" . $db->errno . " -> " . $db->error);
    //var_dump( make_grid_read_array($stmt) );

    $tResultArray = make_grid_read_array($stmt);
    foreach($tResultArray->RTN_DATA->data as $tMap) {
        ?>
        <item   text="<?=$tMap["PJTNM"]?>" id="<?=$tMap["PJTID"]?>" open="1">
        <?

        $REQ["PJTSEQ"] = $tMap["PJTSEQ"];
        $to_coltype = "i";
        $sql = " select PGMSEQ,PGMID,PGMNM,VIEWURL from CG_PGMINFO where PJTSEQ = #PJTSEQ# ";

        $stmt = make_stmt($db,$sql, $to_coltype, $REQ);
        if(!$stmt)   JsonMsg("500","109","stmt 생성 실패" . $db->errno . " -> " . $db->error);
        //var_dump( make_grid_read_array($stmt) );
    
        $tPgmArray = make_grid_read_array($stmt);
        $subItemCnt = 0;
        foreach($tPgmArray->RTN_DATA->data as $tMap2) {
            echo '      <item text="' . $tMap2["PGMNM"] . '" id="' . $tMap2["PGMSEQ"] . ":/c.g/rst/" . $tMap2["VIEWURL"] . '"></item>' . PHP_EOL;
            $subItemCnt++;
        }
        if($subItemCnt == 0){
        ?>
        <item text="-" id="<?=$REQ["PJTSEQ"]?>:-"></item>
        <?
        }
        ?>
        </item>
        <?
    }
    $db->close();
?>        

</tree>