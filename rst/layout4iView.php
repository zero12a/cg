<?php
//PGMID : LAYOUT4I
//PGMNM : 4I
header("Content-Type: text/html; charset=UTF-8"); //HTML

require_once("../include/incUtil.php");
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>	
<title>4I</title>
<meta http-equiv="Context-Type" context="text/html;charset=UTF-8" />
<link href="../common/common.css" rel="stylesheet" type="text/css" /><!--CSS/JS 불러오기-->
<script src="../lib/jquery-1.11.1.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY CORE-->
<script src="../lib/jquery-ui-1.11.1.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY UI-->
<script src="../lib/json2.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY JSON-->
<script src="../lib/dhtmlxSuite/codebase/dhtmlx.js" type="text/javascript" charset="UTF-8"></script> <!--DHTMLX CORE-->
<script src="../common/common.js" type="text/javascript" charset="UTF-8"></script> <!--DHTMLX EXT-->
<link rel="stylesheet" href="../lib/dhtmlxSuite/codebase/dhtmlx.css" type="text/css" charset="UTF-8"><!--DHTMLX CORE-->
<link rel="stylesheet" href="../lib/jquery-ui-1.8.18.css" type="text/css" charset="UTF-8"><!--JQUERY UI-->
<script src="layout4i.js?<?=getRndVal(10)?>"></script></head>
<body onload="initBody();">

<div id="BODY_BOX" class="BODY_BOX"><!--그룹별 IO출력-->	<!--D72 : STARTTXT, TAG-->
	<!--G.GRPID : G1-->
	<div class="GRP_OBJECT" style="width:100%;height:150px;border-radius:3px;-moz-border-radius: 3px;">
	  <div style="width:0px;height:0px;overflow: hidden"><form id="condition"></div>
			<div class="DETAIL_LABELGRP">
			<div class="DETAIL_LABEL"  style="">
				<b>* 4I</b>	
				<!--popup--><a href="?" target="_blank"><img src="/c.g/img/popup.png" height=10 align=absmiddle border=0></a>
				<!--reload--><a href="javascript:location.reload();"><img src="/c.g/img/reload.png" width=11 height=10 align=absmiddle border=0></a>
			</div>	
			<div class="DETAIL_LABELBTN">			</div>
		</div>
		<div style="height:108px;border-radius:3px;-moz-border-radius: 3px;" class="CONDITION_OBJECT">
			<DIV class="CON_LINE" is_br_tag>
		<!--컨디션 IO리스트-->
			</div><!-- is_br_tag end -->
		</div>
		<div style="width:0px;height:0px;overflow: hidden"></form></div>    
	</div>
	<!--
	#####################################################
	## 그리드 - START
	#####################################################
	-->
	<div class="GRP_OBJECT" style="width:50%;height:300px;">

		<div  class="GRID_LABELGRP">
  			<div id="div_gridG2_GRID_LABEL"class="GRID_LABEL" >
	  				* G2      
			</div>
			<div id="div_gridG2_GRID_LABELBTN" class="GRID_LABELBTN"  style="">
				<span id="spanG2Cnt" name="그리드 ROW 갯수">N</span>
			<input type="button" name="BTN_G2_SAVE" value="저장" onclick="G2_SAVE();">
			<input type="button" name="BTN_G2_ROWDELETE" value="행삭제" onclick="G2_ROWDELETE();">
			<input type="button" name="BTN_G2_ROWBULKADD" value="행대량추가" onclick="G2_ROWBULKADD();">
			<input type="button" name="BTN_G2_ROWADD" value="행추가" onclick="G2_ROWADD();">
			<input type="button" name="BTN_G2_RELOAD" value="새로고침" onclick="G2_RELOAD();">
			<input type="button" name="BTN_G2_HIDDENCOL" value="숨김필드보기" onclick="G2_HIDDENCOL();">
			<input type="button" name="BTN_G2_EXCEL" value="엑셀다운로드" onclick="G2_EXCEL();">
			<input type="button" name="BTN_G2_CHKSAVE" value="선택저장" onclick="G2_CHKSAVE();">
			</div>
		</div>
		<div  class="GRID_OBJECT"  style="">
			<div id="gridG2"  style="background-color:white;overflow:hidden;height:278px;width:100%;"></div>
		</div>
	</div>
	<!--
	#####################################################
	## 그리드 - END
	#####################################################
	-->
	<!--VBOX START-->
	<div class="GRP_OBJECT" style="width:50%;">
	<!--
	#####################################################
	## 그리드 - START
	#####################################################
	-->
	<div class="GRP_OBJECT" style="width:100%;height:150px;">

		<div  class="GRID_LABELGRP">
  			<div id="div_gridG3_GRID_LABEL"class="GRID_LABEL" >
	  				* G3      
			</div>
			<div id="div_gridG3_GRID_LABELBTN" class="GRID_LABELBTN"  style="">
				<span id="spanG3Cnt" name="그리드 ROW 갯수">N</span>
			<input type="button" name="BTN_G3_SAVE" value="저장" onclick="G3_SAVE();">
			<input type="button" name="BTN_G3_ROWDELETE" value="행삭제" onclick="G3_ROWDELETE();">
			<input type="button" name="BTN_G3_ROWBULKADD" value="행대량추가" onclick="G3_ROWBULKADD();">
			<input type="button" name="BTN_G3_ROWADD" value="행추가" onclick="G3_ROWADD();">
			<input type="button" name="BTN_G3_RELOAD" value="새로고침" onclick="G3_RELOAD();">
			<input type="button" name="BTN_G3_HIDDENCOL" value="숨김필드보기" onclick="G3_HIDDENCOL();">
			<input type="button" name="BTN_G3_EXCEL" value="엑셀다운로드" onclick="G3_EXCEL();">
			<input type="button" name="BTN_G3_CHKSAVE" value="선택저장" onclick="G3_CHKSAVE();">
			</div>
		</div>
		<div  class="GRID_OBJECT"  style="">
			<div id="gridG3"  style="background-color:white;overflow:hidden;height:128px;width:100%;"></div>
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
	<div class="GRP_OBJECT" style="width:100%;height:150px;">

		<div  class="GRID_LABELGRP">
  			<div id="div_gridG4_GRID_LABEL"class="GRID_LABEL" >
	  				* G4      
			</div>
			<div id="div_gridG4_GRID_LABELBTN" class="GRID_LABELBTN"  style="">
				<span id="spanG4Cnt" name="그리드 ROW 갯수">N</span>
			<input type="button" name="BTN_G4_SAVE" value="저장" onclick="G4_SAVE();">
			<input type="button" name="BTN_G4_ROWDELETE" value="행삭제" onclick="G4_ROWDELETE();">
			<input type="button" name="BTN_G4_ROWBULKADD" value="행대량추가" onclick="G4_ROWBULKADD();">
			<input type="button" name="BTN_G4_ROWADD" value="행추가" onclick="G4_ROWADD();">
			<input type="button" name="BTN_G4_RELOAD" value="새로고침" onclick="G4_RELOAD();">
			<input type="button" name="BTN_G4_HIDDENCOL" value="숨김필드보기" onclick="G4_HIDDENCOL();">
			<input type="button" name="BTN_G4_EXCEL" value="엑셀다운로드" onclick="G4_EXCEL();">
			<input type="button" name="BTN_G4_CHKSAVE" value="선택저장" onclick="G4_CHKSAVE();">
			</div>
		</div>
		<div  class="GRID_OBJECT"  style="">
			<div id="gridG4"  style="background-color:white;overflow:hidden;height:128px;width:100%;"></div>
		</div>
	</div>
	<!--
	#####################################################
	## 그리드 - END
	#####################################################
	-->
	</div>
	<!--VBOX END--><div style="width:0px;height:0px;overflow: hidden">
	<form name="excelDownForm" id="excelDownForm">
	<input type="hidden" name="DATA_HEADERS" id="DATA_HEADERS">
	<input type="hidden" name="DATA_WIDTHS" id="DATA_WIDTHS">
	<input type="hidden" name="DATA_ROWS" id="DATA_ROWS">
	</form>
</div>  </div>



</body>
</html>
