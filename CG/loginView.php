<?php
//PGMID : LOGIN
//PGMNM : D 로그인
header("Content-Type: text/html; charset=UTF-8"); //HTML

require_once("../include/incUtil.php");
include_once('../include/incRequest.php');//CG REQUEST
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>	
<title>D 로그인</title>
<meta http-equiv="Context-Type" context="text/html;charset=UTF-8" />
<!--CSS/JS 불러오기-->
<script src="/lib/feather.min.js" type="text/javascript" charset="UTF-8"></script> <!--FEATHER ICON JS-->
<script src="../lib/jquery-1.11.1.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY CORE-->
<script src="../lib/jquery-ui-1.11.1.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY UI-->
<script src="../lib/json2.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY JSON-->
<script src="/lib/hashmap.js" type="text/javascript" charset="UTF-8"></script> <!--HASHMAP-->
<script src="../lib/dhtmlxSuite/codebase/dhtmlx.js" type="text/javascript" charset="UTF-8"></script> <!--DHTMLX CORE-->
<script src="/lib/chart.min.js" type="text/javascript" charset="UTF-8"></script> <!--Chart.js-->
<script src="/chartjs_util.js" type="text/javascript" charset="UTF-8"></script> <!--Chart.js-->
<script src="../common/common.js" type="text/javascript" charset="UTF-8"></script> <!--DHTMLX EXT-->
<script src="/lib/moment.min.js" type="text/javascript" charset="UTF-8"></script> <!--Moment Date-->
<link rel="stylesheet" href="../common/common.css" type="text/css" charset="UTF-8"><!--FEATHER ICON CSS-->
<link rel="stylesheet" href="../lib/dhtmlxSuite/codebase/dhtmlx.css" type="text/css" charset="UTF-8"><!--DHTMLX CORE-->
<link rel="stylesheet" href="../lib/jquery-ui-1.8.18.css" type="text/css" charset="UTF-8"><!--JQUERY UI-->
<script src="login.js?<?=getRndVal(10)?>"></script>
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

<div id="BODY_BOX" class="BODY_BOX"><!--그룹별 IO출력-->	<!--
	#####################################################
	## 컨디션 입력폼 - START G.GRPID : G1-
	#####################################################
	-->
 	<div class="GRP_OBJECT" style="width:100%;">
        <div class="GRP_GAP"><!--흰색 바깥 여백-->
            <div class="GRP_INNER" style="height:184px;">	
		
	  		<div style="width:0px;height:0px;overflow: hidden"><form id="condition" onsubmit="return false;"></div>
		<div class="CONDITION_LABELGRP">
			<div class="CONDITION_LABEL"  style="">
				<b>* D 로그인</b>	
				<!--popup--><a href="?" target="_blank"><img src="/c.g/img/popup.png" height=10 align=absmiddle border=0></a>
				<!--reload--><a href="javascript:location.reload();"><img src="/c.g/img/reload.png" width=11 height=10 align=absmiddle border=0></a>
			</div>	
			<div class="CONDITION_LABELBTN">				<input type="button" name="BTN_G1_SEARCHALL" value="조회(전체)" onclick="G1_SEARCHALL(uuidv4());">
				<input type="button" name="BTN_G1_SAVE" value="저장" onclick="G1_SAVE(uuidv4());">
				<input type="button" name="BTN_G1_RESET" value="입력 초기화" onclick="G1_RESET(uuidv4());">
			</div>
		</div>
		<div style="height:162px;border-radius:3px;-moz-border-radius: 3px;" class="CONDITION_OBJECT">
			<DIV class="CON_LINE" is_br_tag>
		<!--컨디션 IO리스트-->
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : USR_ID-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						USR_ID
					</div>
					<!-- style="width:200px;"-->
					<div class="CON_OBJECT">
	<!--USR_ID오브젝트출력-->						<input type="text" name="G1-USR_ID" value="<?=getFilter(reqPostString("USR_ID",10),"SAFEECHO","")?>" id="G1-USR_ID" style="width:200px;">
					</div>
				</div>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : USR_PWD-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						USR_PWD<img src="../img/crypt_lock.png" title="sha hashed" align="absmiddle">
					</div>
					<!-- style="width:200px;"-->
					<div class="CON_OBJECT">
	<!--USR_PWD오브젝트출력-->						<input type="text" name="G1-USR_PWD" value="<?=getFilter(reqPostString("USR_PWD",10),"SAFEECHO","")?>" id="G1-USR_PWD" style="width:200px;">
					</div>
				</div>
			</div><!-- is_br_tag end -->
		</div>
		<div style="width:0px;height:0px;overflow: hidden"></form></div>    
		</div></div>
	</div>
	<!--
	#####################################################
	## 폼뷰 조회결과 - START
	#####################################################
	-->
    <div class="GRP_OBJECT" style="width:100%;">
        <div class="GRP_GAP"><!--흰색 바깥 여백-->
            <div class="GRP_INNER" style="height:184px;">
				
			<div sty_le="width:0px;height:0px;overflow: hidden">
				<form id="formviewG2" name="formviewG2" method="post" enctype="multipart/form-data"  onsubmit="return false;">
				<input type="hidden" name="G2-CTLCUD"  id="G2-CTLCUD" value="">
			</div>	
		<div class="FORMVIEW_LABELGRP">
			<div class="FORMVIEW_LABEL"  style="">
				* 조회결과
			</div>
			<div class="FORMVIEW_LABELBTN"  style="">
				<input type="button" name="BTN_G2_SAVE" value="비번변경" onclick="G2_SAVE(uuidv4());">				<input type="button" name="BTN_G2_EDIT" value="수정" onclick="G2_EDIT(uuidv4());">			</div>
		</div>
		<div style="height:162px;" class="FORMVIEW_OBJECT">
			<DIV class="CON_LINE" is_br_tag>
			<!--OBJECT LIST PRINT.-->
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : USR_ID-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						USR_ID
					</div>
					<!-- style="width:200px;"-->
					<div class="CON_OBJECT">
	<!--USR_ID오브젝트출력-->						<input type="text" name="G2-USR_ID" value="" id="G2-USR_ID" style="width:200px;">
					</div>
				</div>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : USR_SEQ-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						USE_SEQ
					</div>
					<!-- style="width:200px;"-->
					<div class="CON_OBJECT">
	<!--USR_SEQ오브젝트출력-->						<input type="text" name="G2-USR_SEQ" value="" id="G2-USR_SEQ" style="width:200px;">
					</div>
				</div>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : USR_NM-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						USR_NM
					</div>
					<!-- style="width:200px;"-->
					<div class="CON_OBJECT">
	<!--USR_NM오브젝트출력-->						<input type="text" name="G2-USR_NM" value="" id="G2-USR_NM" style="width:200px;">
					</div>
				</div>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : USR_PWD-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						USR_PWD<img src="../img/crypt_lock.png" title="sha hashed" align="absmiddle">
					</div>
					<!-- style="width:200px;"-->
					<div class="CON_OBJECT">
	<!--USR_PWD오브젝트출력-->						<input type="text" name="G2-USR_PWD" value="" id="G2-USR_PWD" style="width:200px;">
					</div>
				</div>
			</DIV><!--is_br_tab end-->
		</div>
		<div style="width:0px;height:0px;overflow: hidden"></form></div>    
		</div>
		</div>
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