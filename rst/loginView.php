<?php
//PGMID : LOGIN
//PGMNM : D 로그인
header("Content-Type: text/html; charset=UTF-8"); //HTML

require_once("../include/incUtil.php");
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>	
<title>D 로그인</title>
<meta http-equiv="Context-Type" context="text/html;charset=UTF-8" />
<link href="../common/common.css" rel="stylesheet" type="text/css" /><!--CSS/JS 불러오기-->
<script src="../lib/jquery-1.11.1.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY CORE-->
<script src="../lib/jquery-ui-1.11.1.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY UI-->
<script src="../lib/json2.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY JSON-->
<script src="../lib/dhtmlxSuite/codebase/dhtmlx.js" type="text/javascript" charset="UTF-8"></script> <!--DHTMLX CORE-->
<script src="../common/common.js" type="text/javascript" charset="UTF-8"></script> <!--DHTMLX EXT-->
<link rel="stylesheet" href="../lib/dhtmlxSuite/codebase/dhtmlx.css" type="text/css" charset="UTF-8"><!--DHTMLX CORE-->
<link rel="stylesheet" href="../lib/jquery-ui-1.8.18.css" type="text/css" charset="UTF-8"><!--JQUERY UI-->
<script src="login.js?<?=getRndVal(10)?>"></script></head>
<body onload="initBody();">

<div id="BODY_BOX" class="BODY_BOX"><!--그룹별 IO출력-->	<!--D72 : STARTTXT, TAG-->
	<!--G.GRPID : G1-->
	<div class="GRP_OBJECT" style="width:100%;height:200px;border-radius:3px;-moz-border-radius: 3px;">
	  <div style="width:0px;height:0px;overflow: hidden"><form id="condition"></div>
		<div class="DETAIL_LABELGRP">
			<div class="DETAIL_LABEL"  style="">
				<b>* D 로그인</b>	
				<!--popup--><a href="?" target="_blank"><img src="/c.g/img/popup.png" height=10 align=absmiddle border=0></a>
				<!--reload--><a href="javascript:location.reload();"><img src="/c.g/img/reload.png" width=11 height=10 align=absmiddle border=0></a>
			</div>	
			<div class="DETAIL_LABELBTN">				<input type="button" name="BTN_G1_SEARCHALL" value="조회(전체)" onclick="G1_SEARCHALL();">
				<input type="button" name="BTN_G1_SAVE" value="저장" onclick="G1_SAVE();">
				<input type="button" name="BTN_G1_RESET" value="입력 초기화" onclick="G1_RESET();">
			</div>
		</div>
		<div style="height:158px;border-radius:3px;-moz-border-radius: 3px;" class="CONDITION_OBJECT">
			<DIV class="CON_LINE" is_br_tag>
		<!--컨디션 IO리스트-->
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : USR_ID-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;">
						USR_ID
					</div>
					<!-- style="width:200px;"-->
					<div class="CON_OBJECT">
						<input type="text" name="G1-USR_ID" value="" id="G1-USR_ID" style="width:200px;">
					</div>
				</div>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : USR_PWD-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;">
						USR_PWD<img src="../img/crypt_lock.png" title="sha hashed" align="absmiddle">
					</div>
					<!-- style="width:200px;"-->
					<div class="CON_OBJECT">
						<input type="text" name="G1-USR_PWD" value="" id="G1-USR_PWD" style="width:200px;">
					</div>
				</div>
			</div><!-- is_br_tag end -->
		</div>
		<div style="width:0px;height:0px;overflow: hidden"></form></div>    
	</div>
	<!--
	#####################################################
	## 폼뷰 - START
	#####################################################
	-->
	<div class="GRP_OBJECT" style="width:100%;height:200px;">
		<div sty_le="width:0px;height:0px;overflow: hidden">
			<form id="formviewG2" name="formviewG2" method="post" enctype="multipart/form-data">
			<input type="hidden" name="G2-CTLCUD"  id="G2-CTLCUD" value="">
		</div>	
		<div class="DETAIL_LABELGRP">
			<div class="DETAIL_LABEL"  style="">
				* 조회결과
			</div>
			<div class="DETAIL_LABELBTN"  style="">
				<input type="button" name="BTN_G2_SAVE" value="비번변경" onclick="G2_SAVE();">				<input type="button" name="BTN_G2_EDIT" value="수정" onclick="G2_EDIT();">			</div>
		</div>
		<div style="height:158px;" class="DETAIL_OBJECT">
			<DIV class="CON_LINE" is_br_tag>
			<!--OBJECT LIST PRINT.-->
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : USR_ID-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;">
						USR_ID
					</div>
					<!-- style="width:200px;"-->
					<div class="CON_OBJECT">
						<input type="text" name="G2-USR_ID" value="" id="G2-USR_ID" style="width:200px;">
					</div>
				</div>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : USR_SEQ-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;">
						USE_SEQ
					</div>
					<!-- style="width:200px;"-->
					<div class="CON_OBJECT">
						<input type="text" name="G2-USR_SEQ" value="" id="G2-USR_SEQ" style="width:200px;">
					</div>
				</div>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : USR_NM-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;">
						USR_NM
					</div>
					<!-- style="width:200px;"-->
					<div class="CON_OBJECT">
						<input type="text" name="G2-USR_NM" value="" id="G2-USR_NM" style="width:200px;">
					</div>
				</div>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : USR_PWD-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;">
						USR_PWD<img src="../img/crypt_lock.png" title="sha hashed" align="absmiddle">
					</div>
					<!-- style="width:200px;"-->
					<div class="CON_OBJECT">
						<input type="text" name="G2-USR_PWD" value="" id="G2-USR_PWD" style="width:200px;">
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
