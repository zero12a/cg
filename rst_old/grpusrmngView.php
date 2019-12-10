<?php
//PGMID : GRPUSRMNG
//PGMNM : D 그룹의 사용자관리
header("Content-Type: text/html; charset=UTF-8"); //HTML

require_once("../include/incUtil.php");
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>	
<title>D 그룹의 사용자관리</title>
<meta http-equiv="Context-Type" context="text/html;charset=UTF-8" />
<link href="../common/common.css" rel="stylesheet" type="text/css" /><!--CSS/JS 불러오기-->
<script src="../lib/jquery-1.11.1.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY CORE-->
<script src="../lib/jquery-ui-1.11.1.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY UI-->
<script src="../lib/json2.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY JSON-->
<script src="../lib/dhtmlxSuite/codebase/dhtmlx.js" type="text/javascript" charset="UTF-8"></script> <!--DHTMLX CORE-->
<script src="../common/common.js" type="text/javascript" charset="UTF-8"></script> <!--DHTMLX EXT-->
<link rel="stylesheet" href="../lib/dhtmlxSuite/codebase/dhtmlx.css" type="text/css" charset="UTF-8"><!--DHTMLX CORE-->
<link rel="stylesheet" href="../lib/jquery-ui-1.8.18.css" type="text/css" charset="UTF-8"><!--JQUERY UI-->
<script src="grpusrmng.js?<?=getRndVal(10)?>"></script></head>
<body onload="initBody();">

<div id="BODY_BOX" class="BODY_BOX"><!--그룹별 IO출력-->	<!--D72 : STARTTXT, TAG-->
	<!--G.GRPID : G1-->
	<div class="GRP_OBJECT" style="width:100%;height:80px;border-radius:3px;-moz-border-radius: 3px;">
	  <div style="width:0px;height:0px;overflow: hidden"><form id="condition"></div>
		<div class="DETAIL_LABELGRP">
			<div class="DETAIL_LABEL"  style="">
				<b>* D 그룹의 사용자관리</b>	
				<!--popup--><a href="?" target="_blank"><img src="/c.g/img/popup.png" height=10 align=absmiddle border=0></a>
				<!--reload--><a href="javascript:location.reload();"><img src="/c.g/img/reload.png" width=11 height=10 align=absmiddle border=0></a>
			</div>	
			<div class="DETAIL_LABELBTN">				<input type="button" name="BTN_G1_SEARCHALL" value="조회(전체)" onclick="G1_SEARCHALL();">
				<input type="button" name="BTN_G1_SAVE" value="저장" onclick="G1_SAVE();">
				<input type="button" name="BTN_G1_RESET" value="입력 초기화" onclick="G1_RESET();">
			</div>
		</div>
		<div style="height:38px;border-radius:3px;-moz-border-radius: 3px;" class="CONDITION_OBJECT">
			<DIV class="CON_LINE" is_br_tag>
		<!--컨디션 IO리스트-->
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : GRP_NM-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:px;">
						GRP_NM
					</div>
					<!-- style="width:60px;"-->
					<div class="CON_OBJECT">
						<input type="text" name="G1-GRP_NM" value="" id="G1-GRP_NM" style="width:60px;">
					</div>
				</div>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : USE_YN-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:px;">
						USE_YN
					</div>
					<!-- style="width:px;"-->
					<div class="CON_OBJECT">
						<input type="text" name="G1-USE_YN" value="" id="G1-USE_YN" style="width:px;">
					</div>
				</div>
			</div><!-- is_br_tag end -->
		</div>
		<div style="width:0px;height:0px;overflow: hidden"></form></div>    
	</div>
	<!--
	#####################################################
	## 그리드 - START
	#####################################################
	-->
	<div class="GRP_OBJECT" style="width:100%;height:200px;">

			<div  class="GRID_LABELGRP">
  			<div id="div_grid4_GRID_LABEL"class="GRID_LABEL" >
	  				* 그룹      
			</div>
			<div id="div_grid20_GRID_LABELBTN" class="GRID_LABELBTN"  style="">
				<span id="spanG2Cnt" name="그리드 ROW 갯수">N</span>
			<input type="button" name="BTN_G2_SAVE" value="S" onclick="G2_SAVE();">
			<input type="button" name="BTN_G2_ROWDELETE" value="-" onclick="G2_ROWDELETE();">
			<input type="button" name="BTN_G2_ROWADD" value="+" onclick="G2_ROWADD();">
			<input type="button" name="BTN_G2_RELOAD" value="R" onclick="G2_RELOAD();">
			<input type="button" name="BTN_G2_HIDDENCOL" value="V" onclick="G2_HIDDENCOL();">
			</div>
		</div>
		<div  class="GRID_OBJECT"  style="">
			<div id="gridG2"  style="background-color:white;overflow:hidden;height:178px;width:100%;"></div>
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
	<div class="GRP_OBJECT" style="width:50%;height:400px;">

			<div  class="GRID_LABELGRP">
  			<div id="div_grid4_GRID_LABEL"class="GRID_LABEL" >
	  				* 그룹에 속함      
			</div>
			<div id="div_grid30_GRID_LABELBTN" class="GRID_LABELBTN"  style="">
				<span id="spanG3Cnt" name="그리드 ROW 갯수">N</span>
			<input type="button" name="BTN_G3_ROWDELETE" value="-" onclick="G3_ROWDELETE();">
			<input type="button" name="BTN_G3_ROWADD" value="+" onclick="G3_ROWADD();">
			<input type="button" name="BTN_G3_RELOAD" value="R" onclick="G3_RELOAD();">
			<input type="button" name="BTN_G3_HIDDENCOL" value="V" onclick="G3_HIDDENCOL();">
			<input type="button" name="BTN_G3_CHKSAVE" value="선택 삭제" onclick="G3_CHKSAVE();">
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
	<div class="GRP_OBJECT" style="width:50%;height:400px;">

			<div  class="GRID_LABELGRP">
  			<div id="div_grid4_GRID_LABEL"class="GRID_LABEL" >
	  				* 해당그룹에 미포함      
			</div>
			<div id="div_grid40_GRID_LABELBTN" class="GRID_LABELBTN"  style="">
				<span id="spanG4Cnt" name="그리드 ROW 갯수">N</span>
			<input type="button" name="BTN_G4_ROWDELETE" value="-" onclick="G4_ROWDELETE();">
			<input type="button" name="BTN_G4_ROWADD" value="+" onclick="G4_ROWADD();">
			<input type="button" name="BTN_G4_RELOAD" value="R" onclick="G4_RELOAD();">
			<input type="button" name="BTN_G4_HIDDENCOL" value="V" onclick="G4_HIDDENCOL();">
			<input type="button" name="BTN_G4_CHKSAVE" value="선택 추가" onclick="G4_CHKSAVE();">
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
<div style="width:0px;height:0px;overflow: hidden">
	<form name="excelDownForm" id="excelDownForm">
	<input type="hidden" name="DATA_HEADERS" id="DATA_HEADERS">
	<input type="hidden" name="DATA_WIDTHS" id="DATA_WIDTHS">
	<input type="hidden" name="DATA_ROWS" id="DATA_ROWS">
	</form>
</div>  </div>



</body>
</html>
