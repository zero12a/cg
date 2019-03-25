<?php
header("Content-Type: text/html; charset=UTF-8");
header("Cache-Control:no-cache");
header("Pragma:no-cache");

	//로그인 검사
    require_once("./include/incUtil.php");
    require_once("./include/incUser.php");
    require_once("./incConfig.php");

    require_once("./include/incLoginCheck.php");//로그인 검사

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>OBJ</title>
    <meta http-equiv="Context-Type" context="text/html;charset=UTF-8" />
    <style>
        body {margin:0;padding:0}
        div,input {font-size: 11px;}

        #F_START_DT, #F_END_DT {
            border: 1px solid #909090;
        }


        .BODY_BOX {100%;background-color:yellowgreen;padding:5px 5px 5px 5px;}

        .CON_LINE {position: relative;width:100%;overflow:auto;}
        .CON_OBJGRP {position: relative;float:left;background-color: #eeeeee;vertical-align:middle ;}
        .CON_LABEL {position: relative;float:left;background-color: #eeeeee;vertical-align:middle ;padding-left:5px;}
        .CON_OBJECT {position: relative;float:left;background-color: #eeeeee;vertical-align:middle ;}
        .CON_LINEBREAK {position: relative;height:5px;overflow:auto;}

        .GRID_LABELGRP {position:relative;width:100%;height:22px;z-index:20;}
        .GRID_LABEL {position:relative;float:left;width:60%;height:22px;line-height:22px;vertical-align:middle;z-index:30;}
        .GRID_LABELBTN {position: relative;float:left;width:40%;height:22px;line-height:22px;vertical-align:middle;text-align:right;z-index:30;}
        .GRID_OBJECT {position: relative;width:100%;padding:0 0 0 0;z-index:20;}

        .GRP_LINE {position: relative;width:100%;z-index:10;overflow:auto;}
        .GRP_OBJECT {position: relative;float:left;z-index:20;}
    </style>

	<!--jquery / json-->
	<script src="./lib/jquery-1.11.1.min.js"></script>
	<script src="./lib/json2.min.js"></script>

	<!--dhmltx-->
    <script src="./lib/dhtmlxSuite/codebase/dhtmlx461_beautify.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="./lib/dhtmlxSuite/codebase/dhtmlx.css" type="text/css" charset="utf-8">


    <!--codemirror-->
    <link rel=stylesheet href="./lib/codemirror/doc/docs.css">
    <link rel=stylesheet href="./lib/codemirror/lib/codemirror.css">

    <script src="./lib/codemirror/lib/codemirror.js"></script>
    <script src="./lib/codemirror/mode/php/php.js"></script>
    <script src="./lib/codemirror/mode/sql/sql.js"></script>
    <script src="./lib/codemirror/addon/selection/active-line.js"></script>

    <script src="./lib/codemirror/mode/xml/xml.js"></script>
    <script src="./lib/codemirror/mode/javascript/javascript.js"></script>
    <script src="./lib/codemirror/mode/css/css.js"></script>
    <script src="./lib/codemirror/mode/htmlmixed/htmlmixed.js"></script>

    <script src="./lib/codemirror/addon/edit/matchbrackets.js"></script>
    <script src="./lib/codemirror/addon/comment/continuecomment.js"></script>
    <script src="./lib/codemirror/addon/comment/comment.js"></script>
    <script src="./lib/codemirror/mode/clike/clike.js"></script>


    <!--공통-->
    <script src="./rst/common.js" type="text/javascript" charset="utf-8"></script>



    <style>
        .CodeMirror {
            border-top: 1px solid black;
            border-bottom: 1px solid black;
            width:100%;height:100%;
        }

    </style>




    <script src="cg_objinfo3.js?s4" type="text/javascript" charset="utf-8"></script>


</head>
<body onload="initBody();">

<div id="BODY_BOX" class="BODY_BOX">


	<div  class="GRID_LABELGRP" >
		<div class="GRID_LABEL" >* OBJINFO3 
			<!--popup--><a href="?" target="_blank"><img src="./img/popup.png" height=10 align=absmiddle border=0></a>
			<!--reload--><a href="javascript:location.reload();"><img src="./img/reload.png" width=11 height=10 align=absmiddle border=0></a>		
		</div>
		<div  class="GRID_LABELBTN"  >
			<input type="button" name="some_name" value="Search1" onclick="search1();">
			<input type="button" name="some_name" value="detailNew4" onclick="detailNew4();">
			<input type="button" name="some_name" value="detailSave4" onclick="detailSave4();">
			<input type="button" name="some_name" value="loadxml" onclick="loadxml();">
			<input type="button" name="some_name" value="SaveAll" onclick="saveAll();">
		</div>
	</div>

    <div style="position: relative;width:100%;background-color:yellow;padding:0 0 0 0;overflow:auto;">
        <div style="position: relative;background-color:#eeeeee;padding:10px 10px 10px 10px;overflow:auto;">
            <div style="width:0px;height:0px;overflow: hidden"><form id="condition1"></div>

            <div class="CON_LINE" style="">
                <div class="CON_OBJGRP" style="">
                    <div class="CON_LABEL" style="width:100px;">PJTID *</div>
                    <div class="CON_OBJECT" style="width:150px;"><input type="text" name="F_PJTID" value="" id="F_PJTID"></div>
                </div>
                <div class="CON_OBJGRP" style="">
                    <div class="CON_LABEL" style="width:100px;">OBJTYPE</div>
                    <div class="CON_OBJECT" style="width:150px;"><input type="text" name="F_OBJTYPE" value="" id="F_OBJTYPE"></div>
                </div>
                <div class="CON_OBJGRP" style="">
                    <div class="CON_LABEL" style="width:100px;">FILETYPE</div>
                    <div class="CON_OBJECT" style="width:400px;">
					<input type="radio" name="F_FILETYPE" value="" id="F_FILETYPE" checked>전체
					<input type="radio" name="F_FILETYPE" value="HTMLJS" id="F_FILETYPE">HTMLJS
                    <input type="radio" name="F_FILETYPE" value="HTML" id="F_FILETYPE">HTML
					<input type="radio" name="F_FILETYPE" value="SVRCTL" id="F_FILETYPE">SVRCTL
                    <input type="radio" name="F_FILETYPE" value="SVRSVC" id="F_FILETYPE">SVRSVC
					<input type="radio" name="F_FILETYPE" value="SVRDAO" id="F_FILETYPE">SVRDAO
					
					</div>
                </div>
            </div>

            <div style="width:0px;height:0px;overflow: hidden"></form></div>
        </div>
    </div>

    <div class="GRP_LINE" >
        <div class="GRP_OBJECT" style="width:12%;height:967px">
            <div style="position: relative;width:100%;padding:0 0 0 0;text-align:right;">
	        OBJINFO
			<input type="button" name="some_name" value="S1" onclick="save1();">
            <input type="button" name="add" value="+" onclick="addRow1();">
            <input type="button" name="delete" value="-" onclick="delRow1();">
            </div>

            <div style="position: relative;width:100%;padding:0 0 0 0;">
            <div id="grid1" width="100%"  style="height:845px;background-color:white;overflow:hidden"></div>
            </div>
        </div>

        <div class="GRP_OBJECT" style="width:88%;height:900px">
            


			<div class="GRP_LINE" >
				<div class="GRP_OBJECT" style="width:60%;">
					<div style="position: relative;width:100%;padding:0 0 0 0;text-align:right;">
					D
					<input type="button" name="some_name" value="S2" onclick="save2();">
					<input type="button" name="add" value="+" onclick="addRow2();">
					<input type="button" name="delete" value="-" onclick="delRow2();">
					</div>

					<div style="position: relative;width:100%;padding:0 0 0 0;">
						<div id="grid2" width="100%" height="200px" style="background-color:white;overflow:hidden"></div>
					</div>
				</div>
				<div class="GRP_OBJECT" style="width:40%;height:222px;">
						<textarea id="code2" name="code2">

						</textarea>
				</div>
			</div>

			<div class="GRP_LINE" >
				<div class="GRP_OBJECT" style="width:60%;">
					<div style="position: relative;width:100%;padding:0 0 0 0;text-align:right;">
					A
						<input type="button" name="some_name" value="S3" onclick="save3();">
						<input type="button" name="add" value="+" onclick="addRow3();">
						<input type="button" name="delete" value="-" onclick="delRow3();">
					</div>

					<div style="position: relative;width:100%;padding:0 0 0 0;">
						<div id="grid3" width="100%" height="300px" style="background-color:white;overflow:hidden"></div>
					</div>
				</div>

				<div class="GRP_OBJECT" style="width:40%;height:322px;">
					<textarea id="code3" name="code3">

					</textarea>
				</div>
			</div>


			<div class="GRP_LINE" >
				<div class="GRP_OBJECT" style="width:60%;">
					<div style="position: relative;width:100%;padding:0 0 0 0;text-align:right;">
					B
						<input type="button" name="some_name" value="S4" onclick="save4();">
						<input type="button" name="add" value="+" onclick="addRow4();">
						<input type="button" name="delete" value="-" onclick="delRow4();">
					</div>

					<div style="position: relative;width:100%;padding:0 0 0 0;">
						<div id="grid4" width="100%" height="300px" style="background-color:white;overflow:hidden"></div>
					</div>
				</div>

				<div class="GRP_OBJECT" style="width:40%;height:322px;">
					<textarea id="code4" name="code4">

					</textarea>
				</div>
			</div>


        </div>

    </div>


</div>



<textarea style="width:100%;height:300px;font-size:9pt;" id="tt"></textarea>
<textarea style="width:100%;height:300px;font-size:9pt;" id="tt2"></textarea>
</body>
</html>
