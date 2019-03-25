<?php
//PGMID : findFooter
//PGMNM : 파일 통계(비로그인)
header("Content-Type: text/html; charset=UTF-8"); //HTML

require_once("../include/incUtil.php");
include_once('../include/incRequest.php');//CG REQUEST
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>	
<title>파일 통계(비로그인)</title>
<meta http-equiv="Context-Type" context="text/html;charset=UTF-8" />
<!--CSS/JS 불러오기-->
<script src="../lib/jquery-1.11.1.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY CORE-->
<script src="../lib/jquery-ui-1.11.1.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY UI-->
<script src="../lib/json2.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY JSON-->
<script src="../lib/dhtmlxSuite/codebase/dhtmlx.js" type="text/javascript" charset="UTF-8"></script> <!--DHTMLX CORE-->
<script src="/lib/chart.min.js" type="text/javascript" charset="UTF-8"></script> <!--Chart.js-->
<script src="/chartjs_util.js" type="text/javascript" charset="UTF-8"></script> <!--Chart.js-->
<script src="../common/common.js" type="text/javascript" charset="UTF-8"></script> <!--DHTMLX EXT-->
<script src="/lib/moment.min.js" type="text/javascript" charset="UTF-8"></script> <!--Moment Date-->
<link rel="stylesheet" href="../lib/dhtmlxSuite/codebase/dhtmlx.css" type="text/css" charset="UTF-8"><!--DHTMLX CORE-->
<link rel="stylesheet" href="../lib/jquery-ui-1.8.18.css" type="text/css" charset="UTF-8"><!--JQUERY UI-->
<script src="findfooter.js?<?=getRndVal(10)?>"></script>
<link href="../common/common.css" rel="stylesheet" type="text/css" />
<script>
	//팝업창인 경우 오프너에게서 파라미터 받기
    var grpId = "<?=getFilter(reqPostString("GRPID",20),"SAFEECHO","")?>";
    var rowId = "<?=getFilter(reqPostString("ROWID",30),"SAFEECHO","")?>";
    var colId = "<?=getFilter(reqPostString("COLID",30),"SAFEECHO","")?>";
    var btnNm = "<?=getFilter(reqPostString("BTNNM",30),"SAFEECHO","")?>";
</script>
</head>
<body onload="initBody();">

<div id="BODY_BOX" class="BODY_BOX"><!--그룹별 IO출력-->	<!--D72 : STARTTXT, TAG-->
	<!--G.GRPID : G1-->
	<div class="GRP_OBJECT" style="width:100%;height:90px;border-radius:3px;-moz-border-radius: 3px;">
	  <div style="width:0px;height:0px;overflow: hidden"><form id="condition" onsubmit="return false;"></div>
			<div class="DETAIL_LABELGRP">
			<div class="DETAIL_LABEL"  style="">
				<b>* 파일 통계(비로그인)</b>	
				<!--popup--><a href="?" target="_blank"><img src="/c.g/img/popup.png" height=10 align=absmiddle border=0></a>
				<!--reload--><a href="javascript:location.reload();"><img src="/c.g/img/reload.png" width=11 height=10 align=absmiddle border=0></a>
			</div>	
			<div class="DETAIL_LABELBTN">				<input type="button" name="BTN_G1_SEARCHALL" value="조회(전체)" onclick="G1_SEARCHALL(uuidv4());">
			</div>
		</div>
		<div style="height:48px;border-radius:3px;-moz-border-radius: 3px;" class="CONDITION_OBJECT">
			<DIV class="CON_LINE" is_br_tag>
		<!--컨디션 IO리스트-->
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : EX_TEAM_NM-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						그래프 제외 팀명
					</div>
					<!-- style="width:150px;"-->
					<div class="CON_OBJECT">
	<!--EX_TEAM_NM오브젝트출력-->						<input type="text" name="G1-EX_TEAM_NM" value="<?=getFilter(reqPostString("EX_TEAM_NM",100),"SAFEECHO","")?>" id="G1-EX_TEAM_NM" style="width:150px;">
					</div>
				</div>
			</div><!-- is_br_tag end -->
		</div>
		<div style="width:0px;height:0px;overflow: hidden"></form></div>    
	</div>
	<!--G.GRPID : G2-->
	<div class="GRP_OBJECT" style="width:100%;height:800px;">
		<div class="GRID_LABELGRP">
			<div class="GRID_LABEL"  style="">
					* 팀별 현황 (보안취약점 갯수)1				</div>	
				<div class="GRID_LABELBTN">
			</div>
		</div>
			<div class="GRID_OBJECT" style="border-radius:3px;-moz-border-radius: 3px;">
				<canvas id="canvasG2" style="width:100%;height:778px"></canvas>
		</div>
		</div>
	<!--
	#####################################################
	## 그리드 - START
	#####################################################
	-->
	<div class="GRP_OBJECT" style="width:33%;height:400px;">

		<div  class="GRID_LABELGRP">
  			<div id="div_gridG3_GRID_LABEL"class="GRID_LABEL" >
	  				* 팀별 현황 (보안취약점 갯수)2      
			</div>
			<div id="div_gridG3_GRID_LABELBTN" class="GRID_LABELBTN"  style="">
				<span id="spanG3Cnt" name="그리드 ROW 갯수">N</span>
<input type="button" name="BTN_G3_RELOAD" value="새로고침" onclick="G3_RELOAD(uuidv4());">
<input type="checkbox" name="G3-EDITMD_EDIT_MODE" id="G3-EDITMD_EDIT_MODE" value="Y" style="vertical-align:middle;">편집모드
				</div>
		</div>
		<div  class="GRID_OBJECT"  style="">
			<div id="gridG3"  style="background-color:white;overflow:hidden;height:378px;width:100%;"></div>
		</div>
	</div>
	<!--
	#####################################################
	## 그리드 - END
	#####################################################
	-->
	<!--
	#####################################################
	## 그리드 - START
	#####################################################
	-->
	<div class="GRP_OBJECT" style="width:33%;height:400px;">

		<div  class="GRID_LABELGRP">
  			<div id="div_gridG4_GRID_LABEL"class="GRID_LABEL" >
	  				* 시스템별 현황      
			</div>
			<div id="div_gridG4_GRID_LABELBTN" class="GRID_LABELBTN"  style="">
				<span id="spanG4Cnt" name="그리드 ROW 갯수">N</span>
<input type="button" name="BTN_G4_RELOAD" value="새로고침" onclick="G4_RELOAD(uuidv4());">
<input type="button" name="BTN_G4_VIEWHIDDEN" value="V" onclick="G4_VIEWHIDDEN(uuidv4());">
			</div>
		</div>
		<div  class="GRID_OBJECT"  style="">
			<div id="gridG4"  style="background-color:white;overflow:hidden;height:378px;width:100%;"></div>
		</div>
	</div>
	<!--
	#####################################################
	## 그리드 - END
	#####################################################
	-->
	<!--
	#####################################################
	## 그리드 - START
	#####################################################
	-->
	<div class="GRP_OBJECT" style="width:34%;height:400px;">

		<div  class="GRID_LABELGRP">
  			<div id="div_gridG5_GRID_LABEL"class="GRID_LABEL" >
	  				* 취약점별 현황      
			</div>
			<div id="div_gridG5_GRID_LABELBTN" class="GRID_LABELBTN"  style="">
				<span id="spanG5Cnt" name="그리드 ROW 갯수">N</span>
<input type="button" name="BTN_G5_RELOAD" value="새로고침" onclick="G5_RELOAD(uuidv4());">
<input type="button" name="BTN_G5_HIDDENCOL" value="V" onclick="G5_HIDDENCOL(uuidv4());">
			</div>
		</div>
		<div  class="GRID_OBJECT"  style="">
			<div id="gridG5"  style="background-color:white;overflow:hidden;height:378px;width:100%;"></div>
		</div>
	</div>
	<!--
	#####################################################
	## 그리드 - END
	#####################################################
	-->
<div style="width:0px;height:0px;overflow: hidden">
	<form name="excelDownForm" id="excelDownForm">
	<input type="hidden" name="DATA_HEADERS" id="DATA_HEADERS">
	<input type="hidden" name="DATA_WIDTHS" id="DATA_WIDTHS">
	<input type="hidden" name="DATA_ROWS" id="DATA_ROWS">
	</form>
</div>
<div style="width:0px;height:0px;overflow: hidden">
	<form name="popupForm" id="popupForm">
	<input type="text" name="GRPID" id="GRPID">
	<input type="text" name="ROWID" id="ROWID">	
	<input type="text" name="COLID" id="COLID">
	<input type="text" name="BTNNM" id="BTNNM">
	</form>
</div>
</div>



</body>
</html>
