<?
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
	<title>PGM</title>

	<meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">

	<!--jquery / json-->
	<script src="./lib/jquery-1.11.1.min.js"></script>
	<script src="./lib/json2.min.js"></script>

	<!--dhmltx-->
    <script src="./lib/dhtmlxSuite/codebase/dhtmlx.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="./lib/dhtmlxSuite/codebase/dhtmlx.css" type="text/css" charset="utf-8">

    <!--공통-->
    <script src="./rst/common.js?11" type="text/javascript" charset="utf-8"></script>

    <!--codemirror-->
    <link rel=stylesheet href="./lib/codemirror/doc/docs.css">
    <link rel=stylesheet href="./lib/codemirror/lib/codemirror.css">

    <script src="./lib/codemirror/lib/codemirror.js"></script>
    <script src="./lib/codemirror/mode/sql/sql.js"></script>
    <script src="./lib/codemirror/addon/selection/active-line.js"></script>

    <link href="./common/common.css" rel="stylesheet" type="text/css" />
    <style>
        .CodeMirror {
            border-top: 1px solid black;
            border-bottom: 1px solid black;
            width:100%;height:321px;
        }
        .cm-tab {
            background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAMCAYAAAAkuj5RAAAAAXNSR0IArs4c6QAAAGFJREFUSMft1LsRQFAQheHPowAKoACx3IgEKtaEHujDjORSgWTH/ZOdnZOcM/sgk/kFFWY0qV8foQwS4MKBCS3qR6ixBJvElOobYAtivseIE120FaowJPN75GMu8j/LfMwNjh4HUpwg4LUAAAAASUVORK5CYII=);
            background-position: right;
            background-repeat: no-repeat;
        }
    </style>

    <script src="cg_pgminfo3.js?<?=getRndVal(10)?>"></script>


</head>
<body onload="initBody();" class="HTML_BODY">

<div id="BODY_BOX" class="BODY_BOX">

	<div  class="GRID_LABELGRP" >
		<div class="GRID_LABEL" >* PGMINFO3
			<!--popup--><a href="?" target="_blank"><img src="./img/popup.png" height=10 align=absmiddle border=0></a>
			<!--reload--><a href="javascript:location.reload();"><img src="./img/reload.png" width=11 height=10 align=absmiddle border=0></a>
		</div>
		<div  class="GRID_LABELBTN"  >
            <!--"HTML","HTMLJS","SVRCTL","SVRSVC","SVRDAO"-->
            <span id="makeHTML"></span>
            <span id="makeHTMLJS"></span>
            <span id="makeSVRCTL"></span>
            <span id="makeSVRSVC"></span>
            <span id="makeSVRDAO"></span>
            <input 
            type="button" name="some_name" value="Search1" onclick="search1();"><input 
            type="button" name="some_name" value="Copy" id="btnCopyPgm"><input 
            type="button" name="some_name" value="Del" id="btnDelPgm"><input 
            type="button" name="some_name" value="Make" onclick="Make('');"><input 
            type="button" name="some_name" value="MakeAsync" onclick="MakeAsync(uuidv4());"><input 
            type="button" name="some_name" value="V" onclick="Make('HTML');"><input 
            type="button" name="some_name" value="J" onclick="Make('HTMLJS');"><input 
            type="button" name="some_name" value="C" onclick="Make('SVRCTL');"><input 
            type="button" name="some_name" value="S" onclick="Make('SVRSVC');"><input 
            type="button" name="some_name" value="D" onclick="Make('SVRDAO');"><input 
            type="button" name="some_name" value="GetAuth" onclick="getAuth();"><input 
            type="button" name="some_name" value="Run" onclick="Run();"><input 
            type="button" name="some_name" value="SourceView" onclick="SourceView();">
		</div>
	</div>


    <div style="position: relative;width:100%;background-color:yellow;padding:0 0 0 0;overflow:auto;border-radius:3px;-moz-border-radius: 3px;">
        <div style="position: relative;background-color:#eeeeee;padding:5px 5px 5px 5px;overflow:auto;">
            <div style="width:0px;height:0px;overflow: hidden"><form id="condition1"></div>

            <div class="CON_LINE" style="">
                <div class="CON_OBJGRP" style="">
                    <div class="CON_LABEL" style="width:60px;">PJTID</div>
                    <div class="CON_OBJECT" ><input style="width:70px" type="text" name="F_PJTID" value="" id="F_PJTID"></div>
                </div>
                <div class="CON_OBJGRP" style="">
                    <div class="CON_LABEL" style="width:60px;">PJTSEQ</div>
                    <div class="CON_OBJECT" ><input style="width:50px;" type="text" name="F_PJTSEQ" value="" id="F_PJTSEQ"></div>
                </div>
                <div class="CON_OBJGRP" style="">
                    <div class="CON_LABEL" style="width:60px;">PGMSEQ</div>
                    <div class="CON_OBJECT" ><input type="text" style="width:50px;" name="F_PGMSEQ" value="" id="F_PGMSEQ">
                    <input type="button" value="S" id="btnPgmSearch1"></div>
                </div>
                <div class="CON_OBJGRP" style="">
                    <div class="CON_LABEL" style="width:60px;">PGMID</div>
                    <div class="CON_OBJECT" ><input style="width:70px;" type="text" name="F_PGMID" value="" id="F_PGMID"></div>
                </div>
                <div class="CON_OBJGRP" style="">
                    <div class="CON_LABEL" style="width:60px;">PGMNM</div>
                    <div class="CON_OBJECT"><input  style="width:90px;" type="text" name="F_PGMNM" value="" id="F_PGMNM"></div>
                </div>
                <div class="CON_OBJGRP" style="">
                    <div class="CON_LABEL" style="width:60px;">PGMURL</div>
                    <div class="CON_OBJECT" ><input style="width:120px;" type="text" name="F_PGMURL" value="" id="F_PGMURL"></div>
                </div>
                <div class="CON_OBJGRP" style="">
                    <div class="CON_LABEL" style="width:60px;">PGMTYPE</div>
                    <div class="CON_OBJECT" ><input style="width:80px;" type="text" name="F_PGMTYPE" value="" id="F_PGMTYPE"></div>
                </div>                
            </div>

        </div>
    </div>


    <div class="GRP_LINE" >
        <div class="GRP_OBJECT" style="width:27%;">
            <div  class="GRID_LABELGRP" >
                <div class="GRID_LABEL" >* 그룹</div>
                <div  class="GRID_LABELBTN"  >
                    <span id="spanGrpCnt">N</span>
                    <input type="checkbox" name="GRP_EDIT_MODE" id="GRP_EDIT_MODE" value="Y" style="vertical-align:middle;">Edit<input 
                    type="button" name="some_name" value="V" onclick="view1();"><input 
                    type="button" name="some_name" value="S" onclick="save1();"><input 
                    type="button" name="select_Layout" value="select Layout" onclick="selectLayout(this);"><input 
                    type="button" name="add" value="+" onclick="addRow1();"><input 
                    type="button" name="delete" value="-" onclick="delRow(mygridGrp);">  
                </div>
            </div>
            <div class="GRID_OBJECT" >
                <div id="grid1" width="100%" height="300px" style="background-color:white;z-index:30;"></div>
            </div>
        </div>

        <div class="GRP_OBJECT" style="width:20%;">

            <div  class="GRID_LABELGRP" >
                <div class="GRID_LABEL" >* 기능</div>
                <div  class="GRID_LABELBTN"  >
                    <span id="spanFncCnt">N</span>
                    <input type="button" name="some_name" value="V" onclick="view5();">
					<input type="button" name="some_name" value="S" onclick="save5();">
					<input type="button" name="getfnccode" value="C" onclick="getFncCode();">
					<input type="button" name="add" value="+" onclick="addRow5();">
					<input type="button" name="delete" value="-" onclick="delRow(mygridFnc);">
                </div>
            </div>
            <div class="GRID_OBJECT" >
                <div id="grid5" width="100%" height="300px" style="background-color:white;z-index:40;"></div>
            </div>

        </div>

        <div class="GRP_OBJECT" style="width:38%;">

            <div  class="GRID_LABELGRP" >
                <div class="GRID_LABEL" >* 오브젝트</div>
                <div  class="GRID_LABELBTN"  >
                    <span id="spanIoCnt">N</span>
                    <input type="button" name="some_name" value="V" onclick="view4();">                
				    <input type="button" name="some_name" value="S" onclick="save4();">
					<input type="button" name="ttt" value="C" onclick="getColOutput();">
					<input type="button" name="add" value="+" onclick="addRow4();">
                    <input type="button" name="delete" value="-" onclick="delRow(mygridIo);">
                    <input type="button" name="reload" value="R" onclick="gridReload4()">
                </div>
            </div>
            <div class="GRID_OBJECT" >
                <div id="grid4" width="100%" height="300px" style="background-color:white;overflow:hidden"></div>
            </div>
        </div>

        <div class="GRP_OBJECT" style="width:15%;">
            <div  class="GRID_LABELGRP" >
                <div class="GRID_LABEL" >* 상속</div>
                <div  class="GRID_LABELBTN"  >
                    <span id="spanInheritCnt">N</span>
                    <input type="button" name="some_name" value="S" onclick="save6();"><input 
                    type="button" name="add" value="+" onclick="addRow6();"><input 
                    type="button" name="delete" value="-" onclick="delRow(mygridInherit);"><input 
                    type="button" name="reload" value="R" onclick="gridReload6()">
                </div>
            </div>
            <div class="GRID_OBJECT" >
                <div id="grid6" width="100%" height="300px" style="background-color:white;overflow:hidden"></div>
            </div>
        </div>

    </div>

    <div class="GRP_LINE" style="">

        <div class="GRP_OBJECT" style="width:13%;">

            <div  class="GRID_LABELGRP" >
                <div class="GRID_LABEL" >* 서비스</div>
                <div  class="GRID_LABELBTN"  >
                    <span id="spanSvcCnt">N</span>
					<input type="button" name="some_name" value="S" onclick="save9();"><input 
                    type="button" name="add" value="+" onclick="addRow9();">
                    <input type="button" name="delete" value="-" onclick="delRow(mygridSvc);">
                </div>
            </div>
            <div class="GRID_OBJECT" >
                <div id="grid9" width="100%" height="120px" style="background-color:white;z-index:40;"></div>
            </div>




            <div  class="GRID_LABELGRP" >
                <div class="GRID_LABEL" >* DB처리</div>
                <div  class="GRID_LABELBTN"  >
                    <span id="spanSqlrCnt">N</span>
                    <input  type="button" name="some_name" value="S" onclick="save7();"><input 
                    type="button" name="add" value="+" onclick="addRow7();"><input 
                    type="button" name="delete" value="-" onclick="delRow(mygridSqlR);">
                </div>
            </div>
            <div class="GRID_OBJECT" >
                <div id="grid7" width="100%" height="176px" style="background-color:white;z-index:40;"></div>
            </div>



        </div>

        <div class="GRP_OBJECT" style="width:22%;">
            <div  class="GRID_LABELGRP" >
                <div class="GRID_LABEL" >* SQL</div>
                <div  class="GRID_LABELBTN"  >
                    <span id="spanSqlCnt">N</span>
					<input type="button" name="some_name" value="S" onclick="save2();"><input 
                    type="button" name="add" value="+" onclick="addRow2();"><input 
                    type="button" name="delete" value="-" onclick="delRow(mygridSql);"><input 
                    type="button" name="reload" value="R" onclick="gridReload2();"><input 
                    type="button" name="SqlPreview" value="P" onclick="goSqlpreview();">
                </div>
            </div>
            <div class="GRID_OBJECT" ><div id="grid2" width="99%" height="320px" style="background-color:white;z-index:40;"></div>
            </div>
        </div>
        <div class="GRP_OBJECT" style="width:50%;">
        <div  class="GRID_LABELGRP" >
                <div class="GRID_LABEL" >* SQL Edit</div>
                <div  class="GRID_LABELBTN"  >
                    <select id="selSqlHint" name="selSqlHint" onchange="addSqlHint()" style="font-size:9pt">
                        <option value="">-힌트 추가-</option>
                        <option value="#{USER.ID}">유저ID</option>                        
                        <option value="#{USER.SEQ}">유저SEQ</option>
                        <option value="#{SERVER.REMOTE_ADDR}">접속자IP</option>
                        <option value="date_format(sysdate(),'%Y%m%d%H%i%s')">현재날짜</option>  
                        <option value="concat(CD,'^',NM,'^','GRPID')">그리드:버튼</option>
                        <option value="<![CDATA[SomeText]]>">CDATA</option>                        
                    </select>
                    <input type="button" name="SqlSearch" value="Sql검색" onclick="goSqlSearch();">
                    <input type="button" name="SqlPreview" value="Preview" onclick="goSqlpreview();">
                </div>
            </div>
            <div class="GRID_OBJECT" >
                <textarea id="codem" name="codem"></textarea>
            </div>
        </div>
        <div class="GRP_OBJECT" style="width:15%;">
            <div  class="GRID_LABELGRP" >
                <div class="GRID_LABEL" >* SQL IO</div>
                <div  class="GRID_LABELBTN"  >
                    <span id="spanColCnt">N</span>
                    <input type="button" name="some_name" value="V" onclick="viewGrid3();"><input 
                    type="button" name="some_name" value="S" onclick="save3();"><input 
                    type="button" name="add" value="+" onclick="addRow3();"><input 
                    type="button" name="delete" value="-" onclick="delRow(mygridCol);">
                </div>
            </div>

            <div class="GRID_OBJECT" >
                <div id="grid3" width="100%" height="320px" style="background-color:white;z-index:3;"></div>
            </div>
        </div>


    </div>




    <!--프로그램 검색 팝업 윈도우 WINSOWS-->
    <div style="position:absolute;top:0px;left:0px;display: none;width:700px;height:400px;z-index;5" id="divPgm">
        <div class="CON_LINE" style=""><form name="pgmPopForm">
            <div class="CON_OBJGRP" style="">
                <div class="CON_LABEL" style="width:50px;">PGMID</div>
                <div class="CON_OBJECT" style="width:90px;"><input type="text" name="POP_PGMID" value="" id="POP_PGMID" style="width:80px;"></div>
            </div>
            <div class="CON_OBJGRP" style="">
                <div class="CON_LABEL" style="width:50px;">PGMNM</div>
                <div class="CON_OBJECT" style="width:90px;"><input type="text" name="POP_PGMNM" value="" id="POP_PGMNM" style="width:80px;"></div>
            </div>
            <div class="CON_OBJGRP" style="">
                <div class="CON_LABEL" style="width:70px;">PGMTYPE</div>
                <div class="CON_OBJECT" style="width:90px;"><input type="text" name="POP_PGMTYPE" value="" id="POP_PGMTYPE" style="width:80px;"></div>
            </div>        
            <div class="CON_OBJGRP" style="">
                <div class="CON_OBJECT" style="width:150px;"><input type="hidden" name="POP_PJTSEQ" value="" id="POP_PJTSEQ" style="width:80px;">
                <input type="button" name="some_name" id="btnPgmSearch2" value="Search" onclick="gridSearchPgm();">
                <input type="button" name="btnReset" id="btnReset" value="Reset" onclick="pgmConditionReset()">
                </div>
                <div class="CON_LABEL" style="width:60px;"><span id="spanPgmCnt">N</span></div>
            </div>
            </form>
        </div>
        <div id="gridPgm" width="660px" height="400px" style="background-color:white;z-index:30;"></div>
    </div>


    <!--프로그램 COPY 팝업 윈도우 WINSOWS-->
    <div style="position:absolute;top:0px;left:0px;display: none;width:700px;height:400px;z-index;5" id="divPgmCopy">
        <div class="CON_LINE" style=""><form name="pgmCopyForm">
            <div class="CON_OBJGRP" style="">
                <div class="CON_LABEL" style="width:80px;">to PJTSEQ</div>
                <div class="CON_OBJECT" style="width:100px;"><input type="text" name="TO_PJTSEQ" value="" id="TO_PJTSEQ" style="width:80px;"></div>
            </div>
            <div class="CON_OBJGRP" style="">
                <div class="CON_LABEL" style="width:80px;">to PGMID</div>
                <div class="CON_OBJECT" style="width:100px;"><input type="text" name="TO_PGMID" value="" id="TO_PGMID" style="width:80px;"></div>
            </div>  
            <div class="CON_OBJGRP" style="">
                <div class="CON_OBJECT" style="width:150px;">
                    <input type="button" name="some_name" value="Copy" onclick="popCopyPgm();">
                </div>
            </div>
            </form>
        </div>
    </div>



</div>

<!--
<textarea style="width:100%;height:300px;font-size:9pt;" id="tt"></textarea>
<textarea style="width:100%;height:300px;font-size:9pt;" id="tt2"></textarea>
-->
</body>
</html>
