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
        .GRP_OBJECT {background-color:blue;position: relative;float:left;z-index:20;}
    </style>
    <style>
        .CodeMirror {
            border-top: 1px solid black;
            border-bottom: 1px solid black;
            width:100%;height:100%;
        }

    </style>


	<!--jquery / json-->
	<script src="./lib/jquery-1.11.1.min.js"></script>
	<script src="./lib/json2.min.js"></script>

	<!--dhmltx-->
    <script src="./lib/dhtmlxSuite/codebase/dhtmlx.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="./lib/dhtmlxSuite/codebase/dhtmlx.css" type="text/css" charset="utf-8">



    <!--codemirror-->
    <link rel=stylesheet href="./lib/codemirror/doc/docs.css">
    <link rel=stylesheet href="./lib/codemirror/lib/codemirror.css">

    <script src="./lib/codemirror/lib/codemirror.js"></script>
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



    <script>

 


    //그리드 조회
    function gridSearch(){
        console.log("gridSearch4()------------start");

        //처리할 그리드
        tgrid = mygrid3;

        //그리드 초기화
        tgrid.clearAll();

        //불러오기
        $.ajax({
            type : "POST",
            url : "grid_data1.txt" ,
            data : {xmldata : ""},
            dataType: "json",
            async: true,
            success: function(data){
                console.log("   gridSearch4 json return----------------------");
                console.log("   json data : " + data);
                console.log("   json RTN_CD : " + data.RTN_CD);
                console.log("   json ERR_CD : " + data.ERR_CD);
                //console.log("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
					if(data.RTN_DATA)tgrid.parse(data.RTN_DATA,"json");
                    console.log(JSON.stringify(data.RTN_DATA));
                   alert("[grid] success",1);
                }else{
                    alert("[grid] no data");
                }


            },
            error: function(error){
                alert("[grid] http error");
                //console.log(error);
            }
        });

        console.log("gridSearch3()------------end");
    }



    //정적 변수 선언
    var myCalendar;
    var mygrid1,selrowid1,lastinput1,lastinput1json;
    var mygrid2,selrowid2,lastinput2,lastinput2json;
    var mygrid3,selrowid3,lastinput3,lastinput3json;
    var mygrid4,selrowid3,lastinput4,lastinput4json;
    var url_1 = "cg_objinfo_crud2.php?F_GRPID=1&";
    var url_2 = "cg_objinfo_crud2.php?F_GRPID=2&";
    var url_3 = "cg_objinfo_crud2.php?F_GRPID=3&";
    var url_4 = "cg_objinfo_crud2.php?F_GRPID=4&";
    var url_5 = "cg_objinfo_crud2.php?F_GRPID=5&";
    var validmsg = jQuery.parseJSON('{"REQUARED":"[0]는 반드시 입력바랍니다.", "MIN":"this는 [0]이상 입력바랍니다."}');



    //화면 초기화
    function initBody(){
        console.log("initBody()---------start")

		//dhtmlx 메시지 박스 초기화
		dhtmlx.message.position="bottom"

        console.log("       grid1 init-----------start");





        //코드 미러 초기화
        cm3 = CodeMirror.fromTextArea(document.getElementById('code3'), {
            mode: "text/html",
            styleActiveLine: true,
            indentWithTabs: true,
            smartIndent: true,
            lineNumbers: true,
            matchBrackets : true,
            tabSize: 4,
            indentUnit: 4,
            indentWithTabs: true
        });

        mygrid3 = new dhtmlXGridObject('grid3');
        mygrid3.setImagePath("../dhtmlx/imgs/");
        mygrid3.setHeader("ASEQ,OBJTYPE,DSEQ,ORD,OBJDESC,SRCTXT,SPT,INPUT,PARAM,TYPE,ADDDT,MODDT");
        mygrid3.setColumnIds("OBJASEQ,OBJTYPE,OBJDSEQ,OBJAORD,OBJDESC,SRCTXT,SPTTXT,INPUT,PARAM,SRCTYPE,ADDDT,MODDT");
        //mygrd3.attachHeader("#connector_text_filter,#connector_text_filter,#connector_text_filter,#connector_text_filter")
        mygrid3.setInitWidths("50,50,50,50,80,500,30,80,80,50,70,70")
        mygrid3.setColTypes("ro,ed,ed,ed,ed,txttxt,ed,ed,ed,ed,ro,ro");
        mygrid3.setColAlign("left,left,left,left,left,left,left,left,left,left,left,right")
        //mygrid2.isColumnHidden(0);//PJTID숨기기

        mygrid3.enableSmartRendering(false)
        mygrid3.enableMultiselect(true)
        mygrid3.init();
        mygrid3.splitAt(3);

        mygrid3.attachEvent("onRowSelect",function(rowID,celInd){
            console.log("mygrid3 - onRowSelect ----------start");


			cidx = mygrid3.getColIndexById("SRCTXT");
            cm3.setValue(mygrid3.cells(rowID,cidx).getValue());

            console.log("mygrid3 - onRowSelect ----------end");
        });

		//data loading
		gridSearch();

        console.log(" initBody()-----------------end");

    }//initBody();



    </script>


</head>
<body onload="initBody();">

<div id="BODY_BOX" class="BODY_BOX">

    <div class="GRP_LINE" >

		<div class="GRP_OBJECT" style="width:60%;">
			<div class="GRID_LABELGRP">
				<input type="button" name="some_name" value="Save3" onclick="save3();">
				<input type="button" name="add" value="+" onclick="addRow3();">
				<input type="button" name="delete" value="-" onclick="delRow3();">
			</div>

			<div class="GRID_OBJECT">
				<div id="grid3" width="100%" height="300px" style="background-color:white;overflow:hidden"></div>
			</div>
		</div>
		<div class="GRP_OBJECT" style="width:40%;height:322px;">
			<textarea id="code3" name="code3">

			</textarea>
		</div>
    </div>


</div>
</body>
</html>
