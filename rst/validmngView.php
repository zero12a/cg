<?php
//PGMID : VALIDMNG
//PGMNM : 입력값검증
header("Content-Type: text/html; charset=UTF-8"); //HTML

require_once("../include/incUtil.php");
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>	
<title>입력값검증</title>
<meta http-equiv="Context-Type" context="text/html;charset=UTF-8" />
<link href="../common/common.css" rel="stylesheet" type="text/css" /><!--CSS/JS 불러오기-->
<script src="../lib/jquery-1.11.1.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY CORE-->
<script src="../lib/jquery-ui-1.11.1.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY UI-->
<script src="../lib/json2.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY JSON-->
<script src="../lib/dhtmlxSuite/codebase/dhtmlx.js" type="text/javascript" charset="UTF-8"></script> <!--DHTMLX CORE-->
<script src="../common/common.js" type="text/javascript" charset="UTF-8"></script> <!--DHTMLX EXT-->
<link rel="stylesheet" href="../lib/dhtmlxSuite/codebase/dhtmlx.css" type="text/css" charset="UTF-8"><!--DHTMLX CORE-->
<link rel="stylesheet" href="../lib/jquery-ui-1.8.18.css" type="text/css" charset="UTF-8"><!--JQUERY UI-->
<script src="validmng.js?<?=getRndVal(10)?>"></script></head>
<body onload="initBody();">

<div id="BODY_BOX" class="BODY_BOX"><!--그룹별 IO출력-->	<!--D72 : STARTTXT, TAG-->
	<!--G.GRPID : C1-->
	<div class="GRP_OBJECT" style="width:100%;height:80px;border-radius:3px;-moz-border-radius: 3px;">
	  <div style="width:0px;height:0px;overflow: hidden"><form id="condition"></div>
		<div class="DETAIL_LABELGRP">
			<div class="DETAIL_LABEL"  style="">
				<b>* 입력값검증</b>	
				<!--popup--><a href="?" target="_blank"><img src="/c.g/img/popup.png" height=10 align=absmiddle border=0></a>
				<!--reload--><a href="javascript:location.reload();"><img src="/c.g/img/reload.png" width=11 height=10 align=absmiddle border=0></a>
			</div>	
			<div class="DETAIL_LABELBTN">				<input type="button" name="BTN_C1_SEARCHALL" value="조회(전체)" onclick="C1_SEARCHALL();">
				<input type="button" name="BTN_C1_SAVE" value="저장" onclick="C1_SAVE();">
				<input type="button" name="BTN_C1_RESET" value="입력 초기화" onclick="C1_RESET();">
			</div>
		</div>
		<div style="height:38px;border-radius:3px;-moz-border-radius: 3px;" class="CONDITION_OBJECT">
			<DIV class="CON_LINE" is_br_tag>
		<!--컨디션 IO리스트-->
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : PJTSEQ-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100pxpx;">
						PJTSEQ
					</div>
					<!-- style="width:30px;"-->
					<div class="CON_OBJECT">
						<input type="text" name="C1-PJTSEQ" value="" id="C1-PJTSEQ" style="width:30px;">
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
	<div class="GRP_OBJECT" style="width:60%;height:500px;">

			<div  class="GRID_LABELGRP">
  			<div id="div_grid4_GRID_LABEL"class="GRID_LABEL" >
	  				* 목록      
			</div>
			<div id="div_grid20_GRID_LABELBTN" class="GRID_LABELBTN"  style="">
				<span id="spanG2Cnt" name="그리드 ROW 갯수">N</span>
			<input type="button" name="BTN_G2_SAVE" value="저장" onclick="G2_SAVE();">
			<input type="button" name="BTN_G2_ROWDELETE" value="행삭제" onclick="G2_ROWDELETE();">
			<input type="button" name="BTN_G2_ROWADD" value="행추가" onclick="G2_ROWADD();">
			<input type="button" name="BTN_G2_RELOAD" value="새로고침" onclick="G2_RELOAD();">
			<input type="button" name="BTN_G2_HIDDENCOL" value="숨김필드보기" onclick="G2_HIDDENCOL();">
			<input type="button" name="BTN_G2_EXCEL" value="엑셀다운로드" onclick="G2_EXCEL();">
			<input type="button" name="BTN_G2_CHKSAVE" value="선택저장" onclick="G2_CHKSAVE();">
			</div>
		</div>
		<div  class="GRID_OBJECT"  style="">
			<div id="gridG2"  style="background-color:white;overflow:hidden;height:478px;width:100%;"></div>
		</div>
	</div>
	<!--
	#####################################################
	## 그리드 - END
	#####################################################
	-->
	<!--
	#####################################################
	## 폼뷰 - START
	#####################################################
	-->
	<div class="GRP_OBJECT" style="width:40%;height:500px;">
		<div sty_le="width:0px;height:0px;overflow: hidden">
			<form id="formviewF3" name="formviewF3" method="post" enctype="multipart/form-data">
			<input type="hidden" name="F3-CTLCUD"  id="F3-CTLCUD" value="">
		</div>	
		<div class="DETAIL_LABELGRP">
			<div class="DETAIL_LABEL"  style="">
				* 상세
			</div>
			<div class="DETAIL_LABELBTN"  style="">
				<input type="button" name="BTN_F3_SAVE" value="저장" onclick="F3_SAVE();">				<input type="button" name="BTN_F3_RELOAD" value="새로고침" onclick="F3_RELOAD();">				<input type="button" name="BTN_F3_NEW" value="신규" onclick="F3_NEW();">				<input type="button" name="BTN_F3_MODIFY" value="수정" onclick="F3_MODIFY();">				<input type="button" name="BTN_F3_DELETE" value="삭제" onclick="F3_DELETE();">			</div>
		</div>
		<div style="height:458px;" class="DETAIL_OBJECT">
			<DIV class="CON_LINE" is_br_tag>
			<!--OBJECT LIST PRINT.-->
			</DIV><!--is_br_tab end-->
		</div>
		<div style="width:0px;height:0px;overflow: hidden"></form></div>    
	</div>
	<!--
	#####################################################
	## 폼뷰 - END
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
