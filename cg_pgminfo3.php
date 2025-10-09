<?php
header("Content-Type: text/html; charset=UTF-8");
header("Cache-Control:no-cache");
header("Pragma:no-cache");

    //로그인 검사
    $CFG = require_once("../common/include/incConfig.php");
    
    require_once("../common/include/incUtil.php");
    require_once("../common/include/incUser.php");


    require_once("../common/include/incLoginCheck.php");//로그인 검사

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>PGM</title>

	<meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">

	<!--jquery / json-->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    
	<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/jquery/jquery-1.12.4.min.js"></script>
    <script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/toastr.min.js"></script>
	<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/json2.min.js"></script>

    <script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/lodash.min.js"></script>

    <script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/hashmap.js" type="text/javascript" charset="UTF-8"></script> <!--HASHMAP-->

	<!--dhmltx    -->
    <script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/dhtmlxSuite/codebase/dhtmlx.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/dhtmlxSuite/codebase/dhtmlx.css" type="text/css" charset="utf-8">


    <!--chart-->
    <script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/Chart.min.js" type="text/javascript" charset="UTF-8"></script> <!--Chart.js-->
    <script src="/common/chartjs_util.js" type="text/javascript" charset="UTF-8"></script> <!--Chart.js-->

    <!--codemirror-->
    <link rel=stylesheet href="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/codemirror/lib/codemirror.css">

    <script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/codemirror/lib/codemirror.js"></script>
    <script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/codemirror/mode/sql/sql.js"></script>
    <script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/codemirror/mode/javascript/javascript.js"></script>    
    <script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/codemirror/addon/selection/active-line.js"></script>

    <!--프로퍼티 그리드-->
    <script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/jqPropertyGrid.js"></script>  
    <link href="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/jqPropertyGrid.css" rel="stylesheet" type="text/css" />

    <!--공통-->
    <script type="text/javascript" charset="utf-8">
        var CFG_MAKE_URL = "<?=$CFG["CFG_MAKE_URL"]?>";
        var CFG_DEMO_URL = "<?=$CFG["CFG_DEMO_URL"]?>";        
        var oauthToken = "<?=getAccessToken()?>";
        var CFG_URL_LIBS_ROOT = "<?=$CFG["CFG_URL_LIBS_ROOT"]?>";
        var CFG_URL_CODE_API = "<?=$CFG["CFG_URL_CODE_API"]?>";
    </script>
    <script src="/common/common_dhtmlx.js?<?=getRndVal(10)?>" type="text/javascript" charset="utf-8"></script>    
    <script src="/common/common.js?<?=getRndVal(10)?>" type="text/javascript" charset="utf-8"></script>    
    <link href="/common/common.css?<?=getRndVal(10)?>" rel="stylesheet" type="text/css" />
    <link href="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/toastr.min.css" rel="stylesheet" type="text/css" />

    <style>
        @import url(//fonts.googleapis.com/earlyaccess/nanumgothiccoding.css);
        
        html,body,div,span,td,a,p {font-family: "Nanum Gothic Coding", monospace;}

        input[type=button]{
            padding: 3px 5px 3px 5px;
            font-size: 12px;
            border-radius: 0;
            -webkit-appearance: none;
        }


    </style>

    <script src="cg_pgminfo3.js?<?=getRndVal(10)?>"></script>
    <script src="cg_pgminfo3_bodyinit.js?<?=getRndVal(10)?>"></script>
    <script src="cg_pgminfo3_pg.js?<?=getRndVal(10)?>"></script>

</head>
<body onload="initBody();" class="HTML_BODY">

<div id="BODY_BOX" class="BODY_BOX">

	<div  class="GRID_LABELGRP_SLIM" style="vertical-align:bottom;">
		<div class="GRID_LABEL" style="vertical-align:text-bottom;">* PGMINFO3
			<!--popup--><a href="?" target="_blank"><img src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>img/popup.png" height=10 align=absmiddle border=0></a>
			<!--reload--><a href="javascript:location.reload();"><img src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>img/reload.png" width=11 height=10 align=absmiddle border=0></a>
		</div>
		<div  class="GRID_LABELBTN"  style="vertical-align: bottom;" >
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
            type="button" name="some_name" value="MakeAsync" onclick="MakeAsync(uuidv4());">
            
            <!--
            Queue
            <input 
            type="button" name="some_name" value="V" onclick="MakeQueue('HTML');"><input 
            type="button" name="some_name" value="J" onclick="MakeQueue('HTMLJS');"><input 
            type="button" name="some_name" value="C" onclick="MakeQueue('SVRCTL');"><input 
            type="button" name="some_name" value="S" onclick="MakeQueue('SVRSVC');"><input 
            type="button" name="some_name" value="D" onclick="MakeQueue('SVRDAO');">

            Single
            -->
            <input 
            type="button" name="some_name" value="V" onclick="Make('HTML');"><input 
            type="button" name="some_name" value="J" onclick="Make('HTMLJS');"><input 
            type="button" name="some_name" value="C" onclick="Make('SVRCTL');"><input 
            type="button" name="some_name" value="S" onclick="Make('SVRSVC');"><input 
            type="button" name="some_name" value="D" onclick="Make('SVRDAO');">
            
            <input 
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
            <div  class="GRID_LABELGRP_SLIM" >
                <div class="GRID_LABEL" >* 그룹</div>
                <div  class="GRID_LABELBTN"  >
                    <span id="spanGrpCnt">N</span>
                    <input type="checkbox" name="GRP_EDIT_MODE" id="GRP_EDIT_MODE" value="Y" style="vertical-align:middle;">Edit<input 
                    type="button" name="some_name" value="V" onclick="viewGrp();"><input 
                    type="button" name="some_name" value="S" onclick="grpSave();"><input 
                    type="button" name="select_Layout" value="Stack Layout" onclick="selectLayout(this);"><input 
                    type="button" name="select_Layout" value="Split Layout" onclick="selectLayoutSplit(this);"><input 
                    type="button" name="add" value="+" onclick="addRow1();"><input 
                    type="button" name="delete" value="-" onclick="delRow(mygridGrp);">  
                </div>
            </div>
            <div class="GRID_OBJECT" >
                <div id="grid1" width="100%" height="300px" style="background-color:white;z-index:30;"></div>
            </div>
        </div>

        <div class="GRP_OBJECT" style="width:20%;">

            <div  class="GRID_LABELGRP_SLIM" >
                <div class="GRID_LABEL" >* 기능</div>
                <div  class="GRID_LABELBTN"  >
                    <span id="spanFncCnt">N</span>
                    <input type="button" name="some_name" value="V" onclick="viewFnc();"><input 
                    type="button" name="some_name" value="S" onclick="fncSave();"><input 
                    type="button" name="getfnccode" value="C" onclick="getFncCode();"><input 
                    type="button" name="add" value="+" onclick="addRow5();"><input 
                    type="button" name="delete" value="-" onclick="delRow(mygridFnc);"><input 
                    type="button" name="reload" value="R" onclick="reloadFnc();">
                </div>
            </div>
            <div class="GRID_OBJECT" >
                <div id="grid5" width="100%" height="173px" style="background-color:white;z-index:40;"></div>
            </div>

            <div  class="GRID_LABELGRP_SLIM" >
                <div class="GRID_LABEL" >* 이벤트</div>
                <div  class="GRID_LABELBTN"  >
                    <span id="spanEvtCnt">N</span>
                    <input 
                    type="button" name="some_name" value="V" onclick="viewEvt();"><input 
                    type="button" name="some_name" value="S" onclick="evtSave();"><!--<input 
                    type="button" name="getevtcode" value="C" onclick="getEvtCode();">--><input 
                    type="button" name="add" value="+" onclick="addRowEvt();"><input 
                    type="button" name="delete" value="-" onclick="delRow(mygridEvt);"><input 
                    type="button" name="reload" value="R" onclick="reloadEvt();">
                </div>
            </div>
            <div class="GRID_OBJECT" >
                <div id="gridEvt" width="100%" height="100px" style="background-color:white;z-index:40;"></div>
            </div>

        </div>

        <div class="GRP_OBJECT" style="width:38%;">

            <div  class="GRID_LABELGRP_SLIM" >
                <div class="GRID_LABEL" >* 오브젝트</div>
                <div  class="GRID_LABELBTN"  >
                    <span id="spanIoCnt">N</span>
                    <input type="button" name="some_name" value="V" onclick="viewIo();"><input 
                    type="button" name="some_name" value="S" onclick="save4();"><input 
                    type="button" name="ttt" value="C" onclick="getColOutput();"><input 
                    type="button" name="add" value="+" onclick="addRow4();"><input 
                    type="button" name="delete" value="-" onclick="delRow(mygridIo);"><input 
                    type="button" name="reload" value="R" onclick="gridReload4()">
                </div>
            </div>
            <div class="GRID_OBJECT" >
                <div id="grid4" width="100%" height="300px" style="background-color:white;overflow:hidden"></div>
            </div>
        </div>

        <div class="GRP_OBJECT" style="width:15%;">
            <div  class="GRID_LABELGRP_SLIM" >
                <div class="GRID_LABEL" >* 상속</div>
                <div  class="GRID_LABELBTN"  >
                    <span id="spanInheritCnt">N</span>
                    <input type="button" name="some_name" value="S" onclick="saveInherit();"><input 
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

            <div  class="GRID_LABELGRP_SLIM" >
                <div class="GRID_LABEL" >* 서비스</div>
                <div  class="GRID_LABELBTN"  >
                    <span id="spanSvcCnt">N</span>
					<input type="button" name="some_name" value="S" onclick="save9();"><input 
                    type="button" name="add" value="+" onclick="addRow9();"><input type="button" name="delete" value="-" onclick="delRow(mygridSvc);">
                </div>
            </div>
            <div class="GRID_OBJECT" >
                <div id="grid9" width="100%" height="120px" style="background-color:white;z-index:40;"></div>
            </div>




            <div  class="GRID_LABELGRP_SLIM" >
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
            <div  class="GRID_LABELGRP_SLIM" >
                <div class="GRID_LABEL" >* SQL</div>
                <div  class="GRID_LABELBTN"  >
                    <span id="spanSqlCnt">N</span>
					<input type="button" name="some_name" value="S" onclick="saveSql();"><input 
                    type="button" name="add" value="+" onclick="addRow2();"><input 
                    type="button" name="delete" value="-" onclick="delRow(mygridSql);"><input 
                    type="button" name="reload" value="R" onclick="gridReload2();">
                </div>
            </div>
            <div class="GRID_OBJECT" ><div id="grid2" width="99%" height="320px" style="background-color:white;z-index:40;"></div>
            </div>
        </div>
        <div class="GRP_OBJECT" style="width:50%;">
        <div  class="GRID_LABELGRP_SLIM" >
                <div class="GRID_LABEL" >* SQL Edit</div>
                <div  class="GRID_LABELBTN"  >
                    <select id="selSqlHint" name="selSqlHint" onchange="addSqlHint()" style="font-size:9pt">
                        <option value="">-힌트 추가-</option>
                        <option value="date_format(sysdate(),'%Y%m%d%H%i%s')">현재날짜</option>                          
                        <option value="#{USER.ID}">(입력) 유저ID</option>                        
                        <option value="#{USER.SEQ}">(입력) 유저SEQ</option>
                        <option value="#{USER.NM}">(입력) 유저이름</option>
                        <option value="#{USER.TEAMCD}">(입력) 팀CD</option>
                        <option value="#{USER.TEAMNM}">(입력) 팀이름</option>
                        <option value="#{USER.TEAM_SEQ}">(입력) 팀SEQ</option>
                        <option value="#{USER.ACCESS_TOKEN}">(입력) 인증토큰</option>                        
                        <option value="#{SERVER.REMOTE_ADDR}">(입력) 접속자IP</option>
                        <option value="#{CFG.CFG_MAKE_URL}">(입력) 설정-MAKE URL</option>
                        <option value="#{CFG.CFG_CGWEG_URL}">(입력) 설정-CGWEB URL</option>
                        <option value="#{GRPID-COLID_DEL}">(입력) 파일삭제(FORM)</option>
                        <option value="#{GRPID-COLID_NM}">(입력) 파일이름(FORM)</option>
                        <option value="#{GRPID-COLID_SVRNM}">(입력) 파일/사인 서버이름(FORM)</option>
                        <option value="#{GRPID-COLID_SIZE}">(입력) 파일/사인 SIZE(FORM)</option>              
                        <option value="#{GRPID-COLID_HASH}">(입력) 파일/사인 HASH(FORM)</option>      
                        <option value="#{GRPID-COLID_IMGTYPE}">(입력) 파일/사인 이미지타입(FORM)</option>                
                        <option value="#{GRPID-COLID}">(입력) 체크[값1,값2,값3~] (FORM)</option>      
                        <option value="#{GRPID-COLID}">(입력) 라디오 (FORM)</option>      
                        <option value="#{GRPID-COLID}">(입력) 코드검색[CD만저장됨] (FORM)</option>            
                        <option value="CD^NM^GRPID">(출력3V) 코드검색(GRID)</option>
                        <option value="NM^LINK^TARGET">(출력3V) 링크(GRID)</option>      
                        <option value="LINK^NM^TARGET">(출력3V) 링크(GRIDBT)</option>                       
                        <option value="CD^NM">(출력2V) 코드검색(FORM)</option>
                        <option value="LINK^NM">(출력2V) 링크뷰(FORM)</option>           
                        <option value="CHK1,CHK2,CHK3 ~">(출력NV) 체크박스(FORM)</option>        
                        <option value="LINK1^NM1,LINK2^NM2,LINK3^NM3 ~">(출력NV) 이미지뷰어(FORM)</option>   
                        <option value="LINK^NM">(출력2V) 파일(FORM)</option>     
                        <option value="VAL1^VAL2">(출력2V) BIVIEW</option>                   
                        <option value="/common/cg_read_filestore.php?fileinfo=TimsStamp|FileStoreId|FileSvrNm|FileOrgNm">(출력1V) 파일조회</option>                    
                    </select><input 
                    type="button" name="bigFont" value="+" onclick="changeCodemirrorFontSize('+')"><input 
                    type="button" name="bigFont" value="-" onclick="changeCodemirrorFontSize('-')"><input 
                    type="button" name="SqlSearch" value="Sql검색" onclick="goSqlSearch();"><input 
                    type="button" name="SqlPreview" value="Preview" onclick="goSqlpreview();">
                </div>
            </div>
            <div class="GRID_OBJECT" >
                <textarea id="codemSql" name="codemSql" ></textarea>
            </div>
        </div>
        <div class="GRP_OBJECT" style="width:15%;">
            <div  class="GRID_LABELGRP_SLIM" >
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
                <div class="CON_OBJECT" style="width:200px;"><input type="text" name="TO_PGMID" value="" id="TO_PGMID" style="width:180px;"></div>
            </div>  
            <div class="CON_OBJGRP" style="">
                <div class="CON_OBJECT" style="width:150px;">
                    <input type="button" name="some_name" value="Copy" onclick="popCopyPgm();">
                </div>
            </div>
            </form>
        </div>
    </div>

    <!--그룹타입에 따른 프로퍼티 그리드-->
    <div id="divPgGrpFormview" style="position:absolute;top:0px;left:0px;width:100%;display: none;z-index;5"></div>
    <div id="divPgGrpGrid" style="position:absolute;top:0px;left:0px;width:100%;display: none;z-index;5"></div>
    <div id="divPgGrpChart" style="position:absolute;top:0px;left:0px;width:100%;display: none;z-index;5"></div>
    <div id="divPgFncUserdefJS" style="position:absolute;top:0px;left:0px;width:100%;height:321px;display: none;z-index;35">
        <textarea id="codemFnc" name="codemFnc"></textarea>
    </div>
    <div id="divPgIoPopup" style="position:absolute;top:0px;left:0px;width:100%;display: none;z-index;5"></div>
    <div id="divPgIoBtn" style="position:absolute;top:0px;left:0px;width:100%;display: none;z-index;5"></div>
    
</div>


</body>
</html>
