<?php
header("Content-Type: text/html; charset=UTF-8");
header("Cache-Control:no-cache");
header("Pragma:no-cache");

    //로그인 검사
    $CFG = require_once("../common/include/incConfig.php");

    require_once("../common/include/incUtil.php");
    require_once("../common/include/incUser.php");

    require_once("../common/include/incLoginCheck.php");//로그인 검사

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>PGM MNG</title>

	<meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">

	<!--jquery / json-->
	<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/jquery/jquery-1.12.4.min.js"></script>
    <script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/toastr.min.js"></script>
	<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/json2.min.js"></script>

	<!--dhmltx-->
    <script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/dhtmlxSuite/codebase/dhtmlx.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/dhtmlxSuite/codebase/dhtmlx.css" type="text/css" charset="utf-8">

   <!--chart-->
   <script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/Chart.min.js" type="text/javascript" charset="UTF-8"></script> <!--Chart.js-->
    <script src="/common/chartjs_util.js" type="text/javascript" charset="UTF-8"></script> <!--Chart.js-->


    <!--공통-->
    <script type="text/javascript" charset="utf-8">
        var CFG_MAKE_URL = "<?=$CFG["CFG_MAKE_URL"]?>";
        var oauthToken = "<?=getAccessToken()?>";
        var CFG_URL_LIBS_ROOT = "<?=$CFG["CFG_URL_LIBS_ROOT"]?>";
    </script>
    <script src="/common/common.js?<?=getRndVal(10)?>" type="text/javascript" charset="utf-8"></script>    
    <link href="/common/common.css?<?=getRndVal(10)?>" rel="stylesheet" type="text/css" />
    <link href="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/toastr.min.css" rel="stylesheet" type="text/css" />

    <script src="cg_pgmmng.js?<?=getRndVal(10)?>"></script>


</head>
<body onload="initBody();" class="HTML_BODY">

<div id="BODY_BOX" class="BODY_BOX">


<div  class="GRID_LABELGRP" >
		<div class="GRID_LABEL" >* PGM MNG
			<!--popup--><a href="?" target="_blank"><img src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>img/popup.png" height=10 align=absmiddle border=0></a>
			<!--reload--><a href="javascript:location.reload();"><img src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>img/reload.png" width=11 height=10 align=absmiddle border=0></a>
		</div>
		<div  class="GRID_LABELBTN"  >
            
            <form name="pgmPopForm">
            <div class="CON_OBJGRP" style="">
                <div class="CON_LABEL" style="width:50px;">PJTSEQ</div>
                <div class="CON_OBJECT" style="width:90px;"><input type="text" name="POP_PJTSEQ" value="" id="POP_PJTSEQ" style="width:80px;"></div>
            </div>            
            <div class="CON_OBJGRP" style="">
                <div class="CON_LABEL" style="width:50px;">PGMID</div>
                <div class="CON_OBJECT" style="width:90px;"><input type="text" name="POP_PGMID" value="" id="POP_PGMID" style="width:80px;"></div>
            </div>
            <div class="CON_OBJGRP" style="">
                <div class="CON_LABEL" style="width:55px;">PGMNM</div>
                <div class="CON_OBJECT" style="width:90px;"><input type="text" name="POP_PGMNM" value="" id="POP_PGMNM" style="width:80px;"></div>
            </div>
            <div class="CON_OBJGRP" style="">
                <div class="CON_LABEL" style="width:70px;">PGMTYPE</div>
                <div class="CON_OBJECT" style="width:90px;"><input type="text" name="POP_PGMTYPE" value="" id="POP_PGMTYPE" style="width:80px;"></div>
            </div>        
            <div class="CON_OBJGRP" style="">
                <div class="CON_OBJECT" style="width:250px;">
                <input type="button" name="some_name" id="btnPgmSearch2" value="Search" onclick="gridSearchPgm();">
                <input type="button" name="btnReset" id="btnReset" value="Reset" onclick="pgmConditionReset()">
                <input type="button" name="btnReset" id="btnMakeSync" value="MakeSync" onclick="makeChkAsync(uuidv4())">
                </div>
                <div class="CON_LABEL" style="width:60px;"><span id="spanPgmCnt">N</span></div>
            </div>
            </form>

		</div>
	</div>



    <!--프로그램 검색 팝업 윈도우 WINSOWS-->
    <div class="GRP_OBJECT" style="width:100%;">
            <div  class="GRID_LABELGRP" >
                <div class="GRID_LABEL" >* 그룹</div>
                <div  class="GRID_LABELBTN">
                    동시요청 최대수(Queue) : 
                    <select id="maxQueue" name="maxQueue">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4" selected="selected">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                    </select>
                </div>
            </div>
            <div class="GRID_OBJECT" >
                <div id="gridPgm" width="100%" height="600px" style="background-color:white;z-index:30;"></div>
            </div>
        </div>

</div>


</body>
</html>
