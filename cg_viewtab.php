<?php
/**
 * Created by PhpStorm.
 * User: zero12a
 * Date: 2014. 6. 29.
 * Time: 오후 9:32
 */

header("Content-Type: text/html; charset=UTF-8");

//설정 함수 읽기
$CFG = require_once '../common/include/incConfig.php';
if(!require_once '../common/include/incDB.php')			echo "include fail(2)";
if(!require_once '../common/include/incUtil.php')		echo "include fail(3)";
if(!require_once '../common/include/incSec.php')		echo "include fail(4)";
if(!require_once '../common/include/incRequest.php')		echo "include fail(5)";


$F_PGMSEQ= reqGetNumber("pgmseq",10);
$F_PJTSEQ= reqGetNumber("pjtseq",10);
?>
<!DOCTYPE html>
<html>
<head>
	<title>SourceView</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>


	<!--dhmltx-->
    <script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/dhtmlxSuite/codebase/dhtmlx.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/dhtmlxSuite/codebase/dhtmlx.css" type="text/css" charset="utf-8">


	<script>
		var myTabbar;
		function doOnLoad() {
			
			myTabbar = new dhtmlXTabBar("my_tabbar");
			
			//addTab(mixed id,string text,int width,int position,boolean active,boolean close);
			myTabbar.addTab("a1", "VIEW", null, null, true);
			myTabbar.addTab("a2", "JS");
			myTabbar.addTab("a3", "CTL");
			myTabbar.addTab("a4", "SVC");
			myTabbar.addTab("a5", "DAO");
			
			myTabbar.tabs("a1").attachURL("cg_view.php", null, {"pgmseq":"<?=$F_PGMSEQ?>","pjtseq":"<?=$F_PJTSEQ?>","filetype":"HTML"});
			myTabbar.tabs("a2").attachURL("cg_view.php", null, {"pgmseq":"<?=$F_PGMSEQ?>","pjtseq":"<?=$F_PJTSEQ?>","filetype":"HTMLJS"});
			myTabbar.tabs("a3").attachURL("cg_view.php", null, {"pgmseq":"<?=$F_PGMSEQ?>","pjtseq":"<?=$F_PJTSEQ?>","filetype":"SVRCTL"});
			myTabbar.tabs("a4").attachURL("cg_view.php", null, {"pgmseq":"<?=$F_PGMSEQ?>","pjtseq":"<?=$F_PJTSEQ?>","filetype":"SVRSVC"});
			myTabbar.tabs("a5").attachURL("cg_view.php", null, {"pgmseq":"<?=$F_PGMSEQ?>","pjtseq":"<?=$F_PJTSEQ?>","filetype":"SVRDAO"});
		}
	</script>

    <style>
		html,body {margin:0;padding:0;height: 100%}

	</style>
</head>
<body onload="doOnLoad();">
	<div id="my_tabbar" style="position:relative;height:100%;"></div>
</body>
</html>