<?php
//PGMID : APP_API
//PGMNM : 앱API
header("Content-Type: text/html; charset=UTF-8"); //HTML

require_once("../include/incUtil.php");
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>	
<title>앱API</title>
<meta http-equiv="Context-Type" context="text/html;charset=UTF-8" />
<link href="../common/common.css" rel="stylesheet" type="text/css" /><!--CSS/JS 불러오기-->
<script src="../lib/jquery-1.11.1.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY CORE-->
<script src="../lib/jquery-ui-1.11.1.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY UI-->
<script src="../lib/json2.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY JSON-->
<script src="../lib/dhtmlxSuite/codebase/dhtmlx.js" type="text/javascript" charset="UTF-8"></script> <!--DHTMLX CORE-->
<script src="../common/common.js" type="text/javascript" charset="UTF-8"></script> <!--DHTMLX EXT-->
<link rel="stylesheet" href="../lib/dhtmlxSuite/codebase/dhtmlx.css" type="text/css" charset="UTF-8"><!--DHTMLX CORE-->
<link rel="stylesheet" href="../lib/jquery-ui-1.8.18.css" type="text/css" charset="UTF-8"><!--JQUERY UI-->
<script src="app_api.js?<?=getRndVal(10)?>"></script></head>
<body onload="initBody();">

<div id="BODY_BOX" class="BODY_BOX"><!--그룹별 IO출력-->	<!--D72 : STARTTXT, TAG-->
	<!--G.GRPID : C2-->
	<div class="GRP_OBJECT" style="width:100%;height:80px;border-radius:3px;-moz-border-radius: 3px;">
	  <div style="width:0px;height:0px;overflow: hidden"><form id="condition"></div>
		<div class="DETAIL_LABELGRP">
			<div class="DETAIL_LABEL"  style="">
				<b>* 앱API</b>	
				<!--popup--><a href="?" target="_blank"><img src="/c.g/img/popup.png" height=10 align=absmiddle border=0></a>
				<!--reload--><a href="javascript:location.reload();"><img src="/c.g/img/reload.png" width=11 height=10 align=absmiddle border=0></a>
			</div>	
			<div class="DETAIL_LABELBTN">				<input type="button" name="BTN_C2_SEARCHALL" value="조회(전체)" onclick="C2_SEARCHALL();">
				<input type="button" name="BTN_C2_SAVE" value="저장" onclick="C2_SAVE();">
				<input type="button" name="BTN_C2_RESET" value="검색조건 초기화" onclick="C2_RESET();">
			</div>
		</div>
		<div style="height:38px;border-radius:3px;-moz-border-radius: 3px;" class="CONDITION_OBJECT">
			<DIV class="CON_LINE" is_br_tag>
		<!--컨디션 IO리스트-->
			</DIV><!--is_br_tab end-->
			<DIV class="CON_LINE" is_br_tag>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : API_SEQ-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:80pxpx;">
						SEQ
					</div>
					<!-- style="width:80pxpx;"-->
					<div class="CON_OBJECT">
						<input type="text" name="C2-API_SEQ" value="" id="C2-API_SEQ" style="width:80pxpx;">
					</div>
				</div>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : API_NM-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:80pxpx;">
						NM
					</div>
					<!-- style="width:80pxpx;"-->
					<div class="CON_OBJECT">
						<input type="text" name="C2-API_NM" value="" id="C2-API_NM" style="width:80pxpx;">
					</div>
				</div>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : PGM_ID-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:80pxpx;">
						ID
					</div>
					<!-- style="width:80pxpx;"-->
					<div class="CON_OBJECT">
						<input type="text" name="C2-PGM_ID" value="" id="C2-PGM_ID" style="width:80pxpx;">
					</div>
				</div>
			</DIV><!--is_br_tab end-->
			<DIV class="CON_LINE" is_br_tag>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : URL-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:80pxpx;">
						URL
					</div>
					<!-- style="width:80pxpx;"-->
					<div class="CON_OBJECT">
						<input type="text" name="C2-URL" value="" id="C2-URL" style="width:80pxpx;">
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
	<div class="GRP_OBJECT" style="width:50%;height:450px;">

			<div  class="GRID_LABELGRP">
  			<div id="div_grid4_GRID_LABEL"class="GRID_LABEL" >
	  				* 그리드1      
			</div>
			<div id="div_grid20_GRID_LABELBTN" class="GRID_LABELBTN"  style="">
				<span id="spanG3Cnt" name="그리드 ROW 갯수">N</span>
			<input type="button" name="BTN_G3_CHKSAVE" value="완전삭제" onclick="G3_CHKSAVE();">
			<input type="button" name="BTN_G3_SAVE" value="S" onclick="G3_SAVE();">
			<input type="button" name="BTN_G3_RELOAD" value="R" onclick="G3_RELOAD();">
			<input type="button" name="BTN_G3_EXCEL" value="E" onclick="G3_EXCEL();">
			<input type="button" name="BTN_G3_HIDDENCOL" value="V" onclick="G3_HIDDENCOL();">
			<input type="button" name="BTN_G3_ROWDELETE" value="-" onclick="G3_ROWDELETE();">
			<input type="button" name="BTN_G3_ROWADD" value="+" onclick="G3_ROWADD();">
			</div>
		</div>
		<div  class="GRID_OBJECT"  style="">
			<div id="gridG3"  style="background-color:white;overflow:hidden;height:428px;width:100%;"></div>
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
	<div class="GRP_OBJECT" style="width:50%;height:450px;">
		<div sty_le="width:0px;height:0px;overflow: hidden">
			<form id="formviewF4" name="formviewF4" method="post" enctype="multipart/form-data">
			<input type="hidden" name="F4-CTLCUD"  id="F4-CTLCUD" value="">
		</div>	
		<div class="DETAIL_LABELGRP">
			<div class="DETAIL_LABEL"  style="">
				* 폼뷰1
			</div>
			<div class="DETAIL_LABELBTN"  style="">
				<input type="button" name="BTN_F4_SAVE" value="저장" onclick="F4_SAVE();">				<input type="button" name="BTN_F4_RELOAD" value="새로고침" onclick="F4_RELOAD();">				<input type="button" name="BTN_F4_NEW" value="신규" onclick="F4_NEW();">				<input type="button" name="BTN_F4_DELETE" value="삭제" onclick="F4_DELETE();">				<input type="button" name="BTN_F4_MOD" value="수정" onclick="F4_MOD();">			</div>
		</div>
		<div style="height:408px;" class="DETAIL_OBJECT">
			<DIV class="CON_LINE" is_br_tag>
			<!--OBJECT LIST PRINT.-->
			</DIV><!--is_br_tab end-->
			<DIV class="CON_LINE" is_br_tag>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : API_SEQ-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:120px;">
						SEQ
					</div>
					<!-- style="width:120px;"-->
					<div class="CON_OBJECT">
						<input type="text" name="F4-API_SEQ" value="" id="F4-API_SEQ" style="width:120px;">
					</div>
				</div>
			</DIV><!--is_br_tab end-->
			<DIV class="CON_LINE" is_br_tag>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : API_NM-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:120px;">
						NM
					</div>
					<!-- style="width:120px;"-->
					<div class="CON_OBJECT">
						<input type="text" name="F4-API_NM" value="" id="F4-API_NM" style="width:120px;">
					</div>
				</div>
			</DIV><!--is_br_tab end-->
			<DIV class="CON_LINE" is_br_tag>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : PGM_ID-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:120px;">
						ID
					</div>
					<!-- style="width:120px;"-->
					<div class="CON_OBJECT">
						<input type="text" name="F4-PGM_ID" value="" id="F4-PGM_ID" style="width:120px;">
					</div>
				</div>
			</DIV><!--is_br_tab end-->
			<DIV class="CON_LINE" is_br_tag>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : URL-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:120px;">
						URL
					</div>
					<!-- style="width:120px;"-->
					<div class="CON_OBJECT">
						<input type="text" name="F4-URL" value="" id="F4-URL" style="width:120px;">
					</div>
				</div>
		</DIV>
		<DIV class="CON_LINE" is_br_tag>
		<!--, REQENCTYPE-->
		<div class="CON_OBJGRP" style="">			<div class="CON_LABEL" style="width:120px;">
				REQENCTYPE
			</div>
			<div class="CON_OBJECT" style="width:200px;">
				<select id="F4-REQ_ENCTYPE" name="F4-REQ_ENCTYPE" style="width:200px"></select>
			</div>
		</div>
		</DIV>
		<DIV class="CON_LINE" is_br_tag>
		<!--, REQDATATYPE-->
		<div class="CON_OBJGRP" style="">			<div class="CON_LABEL" style="width:120px;">
				REQDATATYPE
			</div>
			<div class="CON_OBJECT" style="width:200px;">
				<select id="F4-REQ_DATATYPE" name="F4-REQ_DATATYPE" style="width:200px"></select>
			</div>
		</div>

			</DIV><!--is_br_tab end-->
			<DIV class="CON_LINE" is_br_tag>
		<!--REQ_BODY, REQBODY-->
			<div class="CON_OBJGRP" style="">			<div class="CON_LABEL" style="width:120px;">
				REQBODY<img src="../img/crypt_shield.png" title="aes crypted" align="absmiddle">
			</div>
				<!--width:200;height:60-->
				<div class="CON_OBJECT" style="">
					<textarea  name="F4-REQ_BODY"  id="F4-REQ_BODY" style="width:200px;height:60px"></textarea>
				</div>
			</div>

			</DIV><!--is_br_tab end-->
			<DIV class="CON_LINE" is_br_tag>
		<!--RES_BODY, RESBODY-->
			<div class="CON_OBJGRP" style="">			<div class="CON_LABEL" style="width:120px;">
				RESBODY<img src="../img/crypt_shield.png" title="aes crypted" align="absmiddle">
			</div>
				<!--width:200;height:60-->
				<div class="CON_OBJECT" style="">
					<textarea  name="F4-RES_BODY"  id="F4-RES_BODY" style="width:200px;height:60px"></textarea>
				</div>
			</div>
			</DIV><!--is_br_tab end-->
			<DIV class="CON_LINE" is_br_tag>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : MYFILESVRNM-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:120px;">
						MYFILESVRNM
					</div>
					<!-- style="width:200px;"-->
					<div class="CON_OBJECT">
						<input type="text" name="F4-MYFILESVRNM" value="" id="F4-MYFILESVRNM" style="width:200px;">
					</div>
				</div>
			</DIV>
		<DIV class="CON_LINE" is_br_tag>
		<!--D101: STARTTXT, TAG-->
		<!--I.COLID : MYFILE-->
		<div class="CON_OBJGRP" style="">
			<div class="CON_LABEL" style="width:120px;">
				MYFILE
			</div>
		<!-- style="width:150;"-->	
		<div class="CON_OBJECT">
		<input type="file" name="F4-MYFILE" value="" id="F4-MYFILE" style="width:150px;">
		<a href="" target="_blank" name="F4-MYFILE_link" id="F4-MYFILE_link"><span id="F4-MYFILE_name" name="F4-MYFILE_name"></span></a>
		</div>	
	</div>	
			</DIV><!--is_br_tab end-->
			<DIV class="CON_LINE" is_br_tag>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : MYFILE_VIEWER-->
				<div class="CON_OBJGRP" style="">
				<div class="CON_LABEL" style="width:120px;">	
					이미지뷰어	
				</div>	
				<!-- style="width:320;"-->
				<div class="CON_OBJECT">
					<div name="F4-MYFILE_VIEWER" id="F4-MYFILE_VIEWER" class="FORMVIEW_IMGVIEWER" style="width:320px;">
				</div>
			</div>
			</DIV><!--is_br_tab end-->
			<DIV class="CON_LINE" is_br_tag>
		<!--D101: STARTTXT, TAG-->
		<!--I.COLID : ADD_DT-->
			<div class="CON_OBJGRP" style="">
				<div class="CON_LABEL" style="width:120px;">	
					ADD	
				</div>	
				<!-- style="width:120;"-->
				<div class="CON_OBJECT">
					<div name="F4-ADD_DT" id="F4-ADD_DT" style="width:120px;"></div>
				</div>
			</div>
		<!--D101: STARTTXT, TAG-->
		<!--I.COLID : MOD_DT-->
			<div class="CON_OBJGRP" style="">
				<div class="CON_LABEL" style="width:120px;">	
					MOD	
				</div>	
				<!-- style="width:120;"-->
				<div class="CON_OBJECT">
					<div name="F4-MOD_DT" id="F4-MOD_DT" style="width:120px;"></div>
				</div>
			</div>
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
