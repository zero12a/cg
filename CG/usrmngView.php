<?php
//PGMID : USRMNG
//PGMNM : D  사용자관리
header("Content-Type: text/html; charset=UTF-8"); //HTML

//설정 함수 읽기
$CFG = require_once '../../common/include/incConfig.php';

//MONO Autoload
require_once($CFG["CFG_LIBS_MONO_LOG"]);

//LIBS
include_once('../../common/include/incUtil.php');//CG UTIL
include_once('../../common/include/incRequest.php');//CG REQUEST
include_once('../../common/include/incDB.php');//CG DB
include_once('../../common/include/incSec.php');//CG SEC
include_once('../../common/include/incAuth.php');//CG AUTH
include_once('../../common/include/incUser.php');//CG USER

//인증 게이트웨이
require_once('../../common/include/incLoginOauthGateway.php');//CG USER
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>	
<title>D  사용자관리</title>
<meta http-equiv="Context-Type" context="text/html;charset=UTF-8" />
<!--CSS/JS 불러오기-->
<!--JS 불러오기-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/feather.min.js" type="text/javascript" charset="UTF-8"></script> <!--FEATHER ICON JS-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/jquery/jquery-3.4.1.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY CORE-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/jquery/jquery-ui.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY UI-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/tableExport/FileSaver.min.js" type="text/javascript" charset="UTF-8"></script> <!--BT4 TABLE EXPORT SAVER-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/tableExport/tableExport.min.js" type="text/javascript" charset="UTF-8"></script> <!--BT4 TABLE EXPORT-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/json2.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY JSON-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/hashmap.js" type="text/javascript" charset="UTF-8"></script> <!--HASHMAP-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/dhtmlxSuite/codebase/dhtmlx.js" type="text/javascript" charset="UTF-8"></script> <!--DHTMLX CORE-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/Chart.min.js" type="text/javascript" charset="UTF-8"></script> <!--Chart.js-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/moment.min.js" type="text/javascript" charset="UTF-8"></script> <!--Moment Date-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/bootstrap-table/bootstrap-table.min.js" type="text/javascript" charset="UTF-8"></script> <!--BT4 Table JS-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/bootstrap-table/locale/bootstrap-table-ko-KR.min.js" type="text/javascript" charset="UTF-8"></script> <!--BT4 Table JS Lang-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/codemirror/lib/codemirror.js" type="text/javascript" charset="UTF-8"></script> <!--CODE MIRROR1-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/codemirror/mode/sql/sql.js" type="text/javascript" charset="UTF-8"></script> <!--CODE MIRROR2-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/codemirror/addon/selection/active-line.js" type="text/javascript" charset="UTF-8"></script> <!--CODE MIRROR3-->

<!--CSS 불러오기-->
<link rel="stylesheet" href="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/dhtmlxSuite/codebase/dhtmlx.css" type="text/css" charset="UTF-8"><!--DHTMLX CORE-->
<link rel="stylesheet" href="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/jquery/jquery-ui.min.css" type="text/css" charset="UTF-8"><!--JQUERY UI-->
<link rel="stylesheet" href="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/bootstrap4/css/bootstrap.min.css" type="text/css" charset="UTF-8"><!--BOOTSTRAP V4-->
<link rel="stylesheet" href="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/bootstrap-table/bootstrap-table.min.css" type="text/css" charset="UTF-8"><!--BT4 Table CSS-->
<link rel="stylesheet" href="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/codemirror/lib/codemirror.css" type="text/css" charset="UTF-8"><!--CODE MIRROR CSS-->
<!--공통 js/css-->
<script>
var CFG_URL_LIBS_ROOT = "<?=$CFG["CFG_URL_LIBS_ROOT"]?>";  // 형식 http://url:port/
</script>
<script src="/common/common.js?<?=getRndVal(10)?>"></script>
<link rel="stylesheet" href="/common/common.css?<?=getRndVal(10)?>" type="text/css" charset="UTF-8">

<script src="usrmng.js?<?=getRndVal(10)?>"></script>
<script>
	//팝업창인 경우 오프너에게서 파라미터 받기
    var grpId = "<?=getFilter(reqPostString("GRPID",20),"SAFEECHO","")?>";
    var rowId = "<?=getFilter(reqPostString("ROWID",30),"SAFEECHO","")?>";
    var colId = "<?=getFilter(reqPostString("COLID",30),"SAFEECHO","")?>";
    var btnNm = "<?=getFilter(reqPostString("BTNNM",30),"SAFEECHO","")?>";
</script>
</head>
<body onload="initBody();">

<div id="BODY_BOX" class="BODY_BOX"><!--그룹별 IO출력-->
	<!--
	#####################################################
	## 컨디션 조회조건 - START G.GRPID : G1-
	#####################################################
	-->
 	<div class="GRP_OBJECT" style="width:100%;">
        <div class="GRP_GAP"><!--흰색 바깥 여백-->
            <div class="GRP_INNER" style="height:74px;">	
		
	  		<div style="width:0px;height:0px;overflow: hidden"><form id="condition" onsubmit="return false;"></div>
		<div class="CONDITION_LABELGRP">
			<div class="CONDITION_LABEL"  style="">
				<b>* D  사용자관리</b>	
				<!--popup--><a href="?" target="_blank"><img src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>img/popup.png" height=10 align=absmiddle border=0></a>
				<!--reload--><a href="javascript:location.reload();"><img src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>img/reload.png" width=11 height=10 align=absmiddle border=0></a>
			</div>	
			<div class="CONDITION_LABELBTN">				<input type="button" class="btn btn-secondary  btn-sm"  name="BTN_G1_SEARCHALL" value="조회(전체)" onclick="G1_SEARCHALL(uuidv4());">
				<input type="button" class="btn btn-secondary  btn-sm"  name="BTN_G1_SAVE" value="저장" onclick="G1_SAVE(uuidv4());">
				<input type="button" class="btn btn-secondary  btn-sm"  name="BTN_G1_RESET" value="입력 초기화" onclick="G1_RESET(uuidv4());">
			</div>
		</div>
		<div style="height:32px;border-radius:3px;-moz-border-radius: 3px;" class="CONDITION_OBJECT">
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
			<!--I.COLID : USR_NM-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						USR_NM
					</div>
					<!-- style="width:200px;"-->
					<div class="CON_OBJECT">
	<!--USR_NM오브젝트출력-->						<input type="text" name="G1-USR_NM" value="<?=getFilter(reqPostString("USR_NM",10),"SAFEECHO","")?>" id="G1-USR_NM" style="width:200px;">
					</div>
				</div>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : PHONE-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:px;text-align:left;">
						PHONE
					</div>
					<!-- style="width:200px;"-->
					<div class="CON_OBJECT">
	<!--PHONE오브젝트출력-->						<input type="text" name="G1-PHONE" value="<?=getFilter(reqPostString("PHONE",20),"SAFEECHO","")?>" id="G1-PHONE" style="width:200px;">
					</div>
				</div>
			</div><!-- is_br_tag end -->
		</div>
		<div style="width:0px;height:0px;overflow: hidden"></form></div>    
		</div></div>
	</div>
	<!--
	#####################################################
	## 그리드 - START
	#####################################################
	-->
    <div class="GRP_OBJECT" style="width:65%;">
        <div class="GRP_GAP"><!--흰색 바깥 여백-->
		<div  class="GRID_LABELGRP">
			<div class="GRID_LABELGRP_GAP">	<!--그리드만 필요-->
  			<div id="div_gridG2_GRID_LABEL"class="GRID_LABEL" >
	  				* 회원목록      
			</div>
			<div id="div_gridG2_GRID_LABELBTN" class="GRID_LABELBTN"  style="">
				<span id="spanG2Cnt" name="그리드 ROW 갯수">N</span>
			<input type="button" class="btn btn-secondary  btn-sm" name="BTN_G2_SAVE" value="저장" onclick="G2_SAVE(uuidv4());">
			<input type="button" class="btn btn-secondary  btn-sm" name="BTN_G2_ROWDELETE" value="행삭제" onclick="G2_ROWDELETE(uuidv4());">
			<input type="button" class="btn btn-secondary  btn-sm" name="BTN_G2_ROWADD" value="행추가" onclick="G2_ROWADD(uuidv4());">
			<input type="button" class="btn btn-secondary  btn-sm" name="BTN_G2_RELOAD" value="새로고침" onclick="G2_RELOAD(uuidv4());">
			<input type="button" class="btn btn-secondary  btn-sm" name="BTN_G2_HIDDENCOL" value="숨김필드보기" onclick="G2_HIDDENCOL(uuidv4());">
			<input type="button" class="btn btn-secondary  btn-sm" name="BTN_G2_EXCEL" value="엑셀다운로드" onclick="G2_EXCEL(uuidv4());">
			<input type="button" class="btn btn-secondary  btn-sm" name="BTN_G2_CHKSAVE" value="선택저장" onclick="G2_CHKSAVE(uuidv4());">
			<input type="button" class="btn btn-secondary  btn-sm" name="BTN_G2_SAVEPWD" value="비번변경" onclick="G2_SAVEPWD(uuidv4());">
			</div>
			</div><!--GAP-->
		</div>
		<div  class="GRID_OBJECT"  style="">
			<div id="gridG2"  style="background-color:white;overflow:hidden;height:355px;width:100%;"></div>
		</div>
		</div>
	</div>
	<!--
	#####################################################
	## 그리드 - END
	#####################################################
	-->
	<!--
	#####################################################
	## 폼뷰 회원상세 - START
	#####################################################
	-->
    <div class="GRP_OBJECT" style="width:35%;">
        <div class="GRP_GAP"><!--흰색 바깥 여백-->
            <div class="GRP_INNER" style="height:394px;">
				
			<div sty_le="width:0px;height:0px;overflow: hidden">
				<form id="formviewG3" name="formviewG3" method="post" enctype="multipart/form-data"  onsubmit="return false;">
				<input type="hidden" name="G3-CTLCUD"  id="G3-CTLCUD" value="">
			</div>	
		<div class="FORMVIEW_LABELGRP">
			<div class="FORMVIEW_LABEL"  style="">
				* 회원상세
			</div>
			<div class="FORMVIEW_LABELBTN"  style="">
			<input type="button" class="btn btn-secondary  btn-sm"  name="BTN_G3_SAVE" value="저장" onclick="G3_SAVE(uuidv4());">
			<input type="button" class="btn btn-secondary  btn-sm"  name="BTN_G3_RELOAD" value="새로고침" onclick="G3_RELOAD(uuidv4());">
			<input type="button" class="btn btn-secondary  btn-sm"  name="BTN_G3_NEW" value="신규" onclick="G3_NEW(uuidv4());">
			<input type="button" class="btn btn-secondary  btn-sm"  name="BTN_G3_MODIFY" value="수정" onclick="G3_MODIFY(uuidv4());">
			<input type="button" class="btn btn-secondary  btn-sm"  name="BTN_G3_DELETE" value="삭제" onclick="G3_DELETE(uuidv4());">
			</div>
		</div>
		<div style="height:352px;" class="FORMVIEW_OBJECT">
			<DIV class="CON_LINE" is_br_tag>
			<!--OBJECT LIST PRINT.-->
			</DIV><!--is_br_tab end-->
			<DIV class="OBJ_BR"></DIV>
			<DIV class="CON_LINE" is_br_tag>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : USR_ID-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						USR_ID
					</div>
					<!-- style="width:200px;"-->
					<div class="CON_OBJECT">
	<!--USR_ID오브젝트출력-->						<input type="text" name="G3-USR_ID" value="" id="G3-USR_ID" style="width:200px;">
					</div>
				</div>
			</DIV><!--is_br_tab end-->
			<DIV class="OBJ_BR"></DIV>
			<DIV class="CON_LINE" is_br_tag>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : USR_NM-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						USR_NM
					</div>
					<!-- style="width:200px;"-->
					<div class="CON_OBJECT">
	<!--USR_NM오브젝트출력-->						<input type="text" name="G3-USR_NM" value="" id="G3-USR_NM" style="width:200px;">
					</div>
				</div>
			</DIV><!--is_br_tab end-->
			<DIV class="OBJ_BR"></DIV>
			<DIV class="CON_LINE" is_br_tag>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : USR_PWD-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						USR_PWD<img src="../img/crypt_lock.png" title="sha hashed" align="absmiddle">
					</div>
					<!-- style="width:200px;"-->
					<div class="CON_OBJECT">
	<!--USR_PWD오브젝트출력-->						<input type="text" name="G3-USR_PWD" value="" id="G3-USR_PWD" style="width:200px;">
					</div>
				</div>
			</DIV><!--is_br_tab end-->
			<DIV class="OBJ_BR"></DIV>
			<DIV class="CON_LINE" is_br_tag>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : PHONE-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						PHONE
					</div>
					<!-- style="width:200px;"-->
					<div class="CON_OBJECT">
	<!--PHONE오브젝트출력-->						<input type="text" name="G3-PHONE" value="" id="G3-PHONE" style="width:200px;">
					</div>
				</div>
			</DIV><!--is_br_tab end-->
			<DIV class="OBJ_BR"></DIV>
			<DIV class="CON_LINE" is_br_tag>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : PW_ERR_CNT-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						PW_ERR_CNT
					</div>
					<!-- style="width:200px;"-->
					<div class="CON_OBJECT">
	<!--PW_ERR_CNT오브젝트출력-->						<input type="text" name="G3-PW_ERR_CNT" value="" id="G3-PW_ERR_CNT" style="width:200px;">
					</div>
				</div>
			</DIV><!--is_br_tab end-->
			<DIV class="OBJ_BR"></DIV>
			<DIV class="CON_LINE" is_br_tag>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : LAST_STATUS-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						LAST_STATUS
					</div>
					<!-- style="width:200px;"-->
					<div class="CON_OBJECT">
	<!--LAST_STATUS오브젝트출력-->						<input type="text" name="G3-LAST_STATUS" value="" id="G3-LAST_STATUS" style="width:200px;">
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
