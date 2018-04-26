<?
header("Content-Type: text/html; charset=UTF-8");
header("Cache-Control:no-cache");
header("Pragma:no-cache");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>PGM</title>
    <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
<style>
    body {margin:0;padding:0}
    div,input {font-size: 11px;}

    #F_START_DT, #F_END_DT {
        border: 1px solid #909090;
    }


    .BODY_BOX {100%;background-color:yellowgreen;padding:5px 5px 5px 5px;}

    .CON_LINE {position: relative;width:100%;height:22px;line-height;122px;overflow:visible;}
    .CON_OBJGRP {position: relative;float:left;background-color: #eeeeee;height:22px;line-height:22px;vertical-align:middle ;overflow:visible;}
    .CON_LABEL {position: relative;float:left;background-color: #eeeeee;height:22px;line-height:22px;vertical-align:middle ;padding-left:5px;}
    .CON_OBJECT {position: relative;float:left;background-color: #eeeeee;height:22px;line-height:22px;vertical-align:middle ;}
    .CON_LINEBREAK {position: relative;height:5px;overflow:auto;}

    .GRID_LABELGRP {position:relative;width:100%;height:22px;z-index:20;}
    .GRID_LABEL {position:relative;float:left;width:20%;height:22px;line-height:22px;vertical-align:middle;z-index:30;}
    .GRID_LABELBTN {position: relative;float:left;width:80%;height:22px;line-height:22px;vertical-align:middle;text-align:right;z-index:30;}
    .GRID_OBJECT {position: relative;width:100%;padding:0 0 0 0;z-index:20;}

    .GRP_LINE {position: relative;width:100%;z-index:10;overflow:auto;}
    .GRP_OBJECT {position: relative;float:left;z-index:20;}
</style>
	<!--jquery / json-->
	<script src="./lib/jquery-1.11.1.min.js"></script>
	<script src="./lib/json2.min.js"></script>

	<!--dhmltx-->
    <script src="./lib/dhtmlxSuite/codebase/dhtmlx.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="./lib/dhtmlxSuite/codebase/dhtmlx.css" type="text/css" charset="utf-8">

    <!--공통-->
    <script src="./rst/common.js" type="text/javascript" charset="utf-8"></script>

    <!--codemirror-->
    <link rel=stylesheet href="./lib/codemirror/doc/docs.css">
    <link rel=stylesheet href="./lib/codemirror/lib/codemirror.css">

    <script src="./lib/codemirror/lib/codemirror.js"></script>
    <script src="./lib/codemirror/mode/sql/sql.js"></script>
    <script src="./lib/codemirror/addon/selection/active-line.js"></script>
    <style>
        .CodeMirror {
            border-top: 1px solid black;
            border-bottom: 1px solid black;
            width:100%;height:222px;
        }
        .cm-tab {
            background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAMCAYAAAAkuj5RAAAAAXNSR0IArs4c6QAAAGFJREFUSMft1LsRQFAQheHPowAKoACx3IgEKtaEHujDjORSgWTH/ZOdnZOcM/sgk/kFFWY0qV8foQwS4MKBCS3qR6ixBJvElOobYAtivseIE120FaowJPN75GMu8j/LfMwNjh4HUpwg4LUAAAAASUVORK5CYII=);
            background-position: right;
            background-repeat: no-repeat;
        }
    </style>







    <script>





    function Make() {
        window.open("cg_make.php?pgmid=" + $("#F_PGMID").val());
    }
    function Run() {
        window.open("./rst/" + $("#F_PGMID").val() + ".php");
    }
    function SourceView() {
        window.open("cg_view.php?pgmid=" + $("#F_PGMID").val());
    }

    function search1(){
        //폼값 밸리데이션
        if( !jsonFormValid(obj_condition_valid.F_PJTID, "F_PJTID", "프로젝트ID", $("#F_PJTID").val()) ){return false;};
        if( !jsonFormValid(obj_condition_valid.F_PGMID, "F_PGMID", "프로그램ID", $("#F_PGMID").val()) ){return false;};


        //폼의 모든값 구하기
        var ConAllData = $( "#condition1" ).serialize();
        alog("ConAllData:" + ConAllData);

        lastCondition = ConAllData;

		//KEY컬럼만 자식에게 전달
		lastinput1json = jQuery.parseJSON('{ "__NAME":"lastinput1json"' +
			', "PJTID" : "' + q($("#F_PJTID").val()) + '"' +
			', "PGMID" : "' + q($("#F_PGMID").val()) + '"' +
			'}');

        //그리드 조회
        gridSearch1(ConAllData);

    }


	//행추가1 (group)
	function addRow1(){
		if( !(lastinput1json) || !(lastinput1json.PJTID) || !(lastinput1json.PGMID) ){
			msgError("조회 후에 행추가 가능합니다",3);
		}else{
			var tCols = [lastinput1json.PJTID,lastinput1json.PGMID];//초기값
			addRow(mygrid1,tCols);
		}
	}


	//행추가4 (io)
	function addRow4(){
		if( !(lastinput4json) || !(lastinput4json.PJTID) || !(lastinput4json.PGMID)  || !(lastinput4json.GRPID)  ){
			msgError("조회 후에 행추가 가능합니다",3);
		}else{
			var tCols = [lastinput4json.PJTID,lastinput4json.PGMID,lastinput4json.GRPID];//초기값
			addRow(mygrid4,tCols);
		}
	}



    //그리드 조회
    function gridSearch1(tinput){
        alog("gridSearch1()------------start");

        //그리드 초기화
        mygrid1.clearAll();

        //불러오기
        $.ajax({
            type : "POST",
            url : "grid_test2_1.txt" ,
            data : {xmldata : ""},
            dataType: "json",
            async: true,
            success: function(data){
                alog("   gridSearch1 json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){

					var row_cnt = 0;
					if(data.RTN_DATA){
						mygrid1.parse(data.RTN_DATA,"json");
						row_cnt = data.RTN_DATA.rows.length;
					}
					msgNotice("[GRP] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("GRP] 서버 조회중 에러가 발생했습니다.\nRTN_CD : " + data.RTN_CD + "\nERR_CD : " + data.ERR_CD + "\nRTN_MSG :" + data.RTN_MSG,3);
                }


            },
            error: function(error){
				msgError("GRP] Ajax http 500 error ( " + error + " )",3);
                alog("GRP] Ajax http 500 error ( " + error + " )");
            }
        });

        alog("gridSearch1()------------end");
    }



    //그리드 조회
    function gridSearch4(tinput){
        alog("gridSearch4()------------start");

        //그리드 초기화
        mygrid4.clearAll();

        //불러오기
        $.ajax({
            type : "POST",
            url : "grid_test2_4.txt" ,
            data : {xmldata : ""},
            dataType: "json",
            async: false,
            success: function(data){
                alog("   gridSearch4 json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
					var row_cnt = 0;
					if(data.RTN_DATA){
						mygrid4.parse(data.RTN_DATA,"json");
						row_cnt = data.RTN_DATA.rows.length;
					}
					msgNotice("[IO] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[IO] 서버 조회중 에러가 발생했습니다.\nRTN_CD : " + data.RTN_CD + "\nERR_CD : " + data.ERR_CD + "\nRTN_MSG :" + data.RTN_MSG,3);
                }


            },
            error: function(error){
				msgError("[IO] Ajax http 500 error ( " + error + " )",3);
                alog("[IO] Ajax http 500 error ( " + error + " )");
            }
        });

        alog("gridSearch4()------------end");
    }




    //정적 변수 선언
    var myCalendar;
    var lastCondition;
    var mygrid1,dp1,addstatusyn1,lastinput1,lastinput1json,lastrowid1;
    var mygrid2,dp2,addstatusyn2,lastinput2,lastinput2json,lastrowid2;
    var mygrid3,dp3,addstatusyn3,lastinput3,lastinput3json,lastrowid3;
    var mygrid4,dp4,addstatusyn4,lastinput4,lastinput4json,lastrowid4;
    var mygrid5,dp5,addstatusyn5,lastinput5,lastinput5json,lastrowid5;
    var mygrid6,dp6,addstatusyn6,lastinput6,lastinput6json,lastrowid6;
    var mygrid1_url = "cg_pgminfo_crud2.php?F_GRPID=1&";
    var mygrid2_url = "cg_pgminfo_crud2.php?F_GRPID=2&";
    var mygrid3_url = "cg_pgminfo_crud2.php?F_GRPID=3&";
    var mygrid4_url = "cg_pgminfo_crud2.php?F_GRPID=4&";
    var mygrid5_url = "cg_pgminfo_crud2.php?F_GRPID=5&";
    var mygrid6_url = "cg_pgminfo_crud2.php?F_GRPID=6&";
    var mygrid7_url = "cg_pgminfo_crud2.php?F_GRPID=7&";
    var mygrid8_url = "cg_pgminfo_crud2.php?F_GRPID=8&";
    var mygrid9_url = "cg_pgminfo_crud2.php?F_GRPID=9&";
    var validmsg = jQuery.parseJSON('{"REQUARED":"[0]는 반드시 입력바랍니다.", "MIN":"this는 [0]이상 입력바랍니다."}');

	var isLayoutLoaded = false;

    //동적 변수 선언
    var obj_condition_valid = jQuery.parseJSON( '{"__NAME":"obj_condition_valid"' +
        ' ,"F_PJTID": {"REQUARED":"Y",  "MIN":"0",  "MAX":"ZZZ",  "DATASIZE":10,  "DATATYPE":"STRING"} ' +
        ' ,"F_PGMID": {"REQUARED":"Y",  "MIN":"0",  "MAX":"ZZZ",  "DATASIZE":10,  "DATATYPE":"STRING"} ' +
        '}');
    var obj_G4_valid = jQuery.parseJSON( '{"__NAME":"obj_G4_valid"' +
        ' ,"OBJTYPE": {"REQUARED":"Y",  "MIN":"0",  "MAX":"ZZZ",  "DATASIZE":10,  "DATATYPE":"STRING"} ' +
        ' ,"F_PGMID": {"REQUARED":"Y",  "MIN":"0",  "MAX":"ZZZ",  "DATASIZE":10,  "DATATYPE":"STRING"} ' +
        '}');


    //화면 초기화
    function initBody(){
		//dhtmlx 메시지 박스 초기화
		dhtmlx.message.position="bottom"


        //컨디션 초기화
        $("#F_PJTID").val("CG");
        $("#F_PGMID").val("TEST2");

        //날짜 박스 초기
        alog("initBody()---------start")

        //그리드 초기화
        mygrid1 = new dhtmlXGridObject('grid1');
		mygrid1.setUserData("","gridTitle","grid1 : group list"); //글로별 변수에 그리드 타이블 넣기
        mygrid1.setImagePath("./lib/dhtmlxSuite/codebase/imgs/");
        mygrid1.setHeader("PJTID,PGMID,GRPID,GRPTYPE,GRPNM,GRPORD,FREEZECNT,COLBRCNT,REFGRPID,VBOXNO,GRPWIDTH,GRPHEIGHT,GRPPADDING,ADDDT,MODDT");
        mygrid1.setColumnIds("PJTID,PGMID,GRPID,GRPTYPE,GRPNM,GRPORD,FREEZECNT,COLBRCNT,REFGRPID,VBOXNO,GRPWIDTH,GRPHEIGHT,GRPPADDING,ADDDT,MODDT");
        mygrid1.setInitWidths("50,50,50,50,50,50,50,50,50,50,50,50,50,50,50")
        mygrid1.setColTypes("ed,ed,ed,coro,ed,ed,ed,ed,ed,ed,ed,ed,ed,ro,ro");

		mygrid1.enableSmartRendering(false);
        mygrid1.enableMultiselect(true);
		//GRPTYPE 콤보
		setCodeCombo("GRID",mygrid1.getCombo(mygrid1.getColIndexById("GRPTYPE")),"GRPTYPE");

        mygrid1.splitAt(3);//'freezes' 0 columns // ROW선택 이벤트
        mygrid1.init();

        mygrid1.setColumnHidden(0,true); //PJTID
        mygrid1.setColumnHidden(1,true); //PGMID

        mygrid1.attachEvent("onRowSelect",function(rowID,celInd){
            alog("mygrid1 - onRowSelect ----------start");
            alog("   rowID = " + rowID);
            alog("   celInd = " + celInd);


            lastrowid1 = rowID;

            //선택된 ROW의 모든컬럼 추출하기
            var RowAllData;
            RowAllData = getRowsColid(mygrid1,rowID,"G1");
            alog("   RowAllData = " + RowAllData);

            var ConAllData = $( "#condition1" ).serialize();
            alog("   ConAllData = " + ConAllData);

            //마지막 선송 정보 저장
			lastinput4 = RowAllData + "&" + ConAllData;


            //KEY컬럼만 자식에게 전달
            lastinput4json = jQuery.parseJSON('{ "__NAME":"lastinput4json"' +
                ', "PJTID" : "' + q(mygrid1.cells(lastrowid1,0).getValue()) + '"' +
                ', "PGMID" : "' + q(mygrid1.cells(lastrowid1,1).getValue()) + '"' +
                ', "GRPID" : "' + q(mygrid1.cells(lastrowid1,2).getValue()) + '"' +
                '}');

            //그리드 4번 조회
            gridSearch4(lastinput4);



            alog("mygrid1 - onRowSelect ----------end");
        });



        mygrid1.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){

            alog("mygrid1  onEditCell ------------------start");
            alog("       stage : " + stage);
            alog("       rId : " + rId);
            alog("       cInd : " + cInd);
            alog("       nValue : " + nValue);
            alog("       oValue : " + oValue);

            RowEditStatus = mygrid1.getUserData(rId,"!nativeeditor_status");
            if(stage == 2
                && RowEditStatus != "inserted"
                && RowEditStatus != "deleted"
                && nValue != oValue
                ){
                if(RowEditStatus == "") {
                    mygrid1.setUserData(rId,"!nativeeditor_status","updated");
                    mygrid1.setRowTextBold(rId);
                }
                mygrid1.cells(rId,cInd).cell.wasChanged = true;
            }
            return true;

        });




        //2번째 그리드 초기화
        mygrid2 = new dhtmlXGridObject('grid2');
		mygrid2.setUserData("","gridTitle","grid2 : sql list"); //글로별 변수에 그리드 타이블 넣기
        mygrid2.setImagePath("./lib/dhtmlxSuite/codebase/imgs/");
        mygrid2.setHeader("PJTID,PGMID,GRPID,FNCID,SQLID,SQLNM,CRUD,SQLORD,SQLTXT,ADDDT,MODDT");
        mygrid2.setColumnIds("PJTID,PGMID,GRPID,FNCID,SQLID,SQLNM,CRUD,SQLORD,SQLTXT,ADDDT,MODDT");
        //mygrid2.attachHeader("#connector_text_filter,#connector_text_filter,#connector_text_filter,#connector_text_filter")
        mygrid2.setInitWidths("50,50,50,50,50,50,50,50,50,50,50")
        mygrid2.setColTypes("ro,ed,ed,ed,ed,ed,coro,ed,txt,ro,ro");
        mygrid2.setColAlign("left,left,left,left,left,left,left,left,left,left,left")
        //mygrid2.setColumnHidden(0,true);
        //mygrid2.isColumnHidden(0);//PJTID숨기기

        mygrid2.enableSmartRendering(false);
        mygrid2.enableMultiselect(true);

		//GRPTYPE 콤보
		setCodeCombo("GRID",mygrid2.getCombo(mygrid2.getColIndexById("CRUD")),"CRUD");

        mygrid2.init();

        mygrid2.setColumnHidden(0,true); //PJTID
        mygrid2.setColumnHidden(1,true); //PGMID
        mygrid2.setColumnHidden(2,true); //GRPID
        mygrid2.setColumnHidden(3,true); //FNCID


        mygrid2.attachEvent("onRowSelect",function(rowID,celInd){
            alog("mygrid2 - onRowSelect ----------start");
            alog("   rowID = " + rowID);
            alog("   celInd = " + celInd);

            lastrowid2 = rowID;


            var RowAllData = getRowsColid(mygrid2,rowID,"G2");
            alog("   RowAllData = " + RowAllData);

            var ConAllData = $( "#condition1" ).serialize();
            alog("   ConAllData = " + ConAllData);

            //마지막 선송 정보 저장
            lastinput3 = RowAllData + "&" + ConAllData;


			//KEY컬럼만 자식에게 전달
            lastinput3json = jQuery.parseJSON('{ "__NAME":"lastinput2json"' +
                ', "PJTID" : "' + q(mygrid2.cells(lastrowid2,0).getValue()) + '"' +
                ', "PGMID" : "' + q(mygrid2.cells(lastrowid2,1).getValue()) + '"' +
                ', "GRPID" : "' + q(mygrid2.cells(lastrowid2,2).getValue()) + '"' +
                ', "FNCID" : "' + q(mygrid2.cells(lastrowid2,3).getValue()) + '"' +
                ', "SQLID" : "' + q(mygrid2.cells(lastrowid2,4).getValue()) + '"' +
                '}');


            //세팅하기
            //alert(mygrid2.cells(rowID,celInd).getValue());
            cidx = mygrid2.getColIndexById("SQLTXT");
            alog("   cidx = " + cidx);

			//alert(mygrid2.cells(rowID,cidx-1).getValue());
            cm.setValue(mygrid2.cells(rowID,cidx).getValue());

            //그리드 3번 조회
            gridSearch3(lastinput3);

            alog("mygrid2 - onRowSelect ----------end");
        });



        //mygrid2.loadXML("cg_pjtinfo_crud2.php");




        //5번째 그리드 초기화
        mygrid5 = new dhtmlXGridObject('grid5');
		mygrid5.setUserData("","gridTitle","grid5 : fnc list"); //글로별 변수에 그리드 타이블 넣기
        mygrid5.setImagePath("./lib/dhtmlxSuite/codebase/imgs/");
        mygrid5.setHeader("PJTID,PGMID,GRPID,FNCID,FNCCD,FNCNM,FNCTYPE,BTNWIDTH,ORD,ADDDT,MODDT");
        mygrid5.setColumnIds("PJTID,PGMID,GRPID,FNCID,FNCCD,FNCNM,FNCTYPE,BTNWIDTH,ORD,ADDDT,MODDT");
        mygrid5.setInitWidths("50,50,50,50,50,50,50,50,50,50,50");
        mygrid5.setColTypes("ed,ed,ed,ed,coro,ed,ed,ed,ed,ro,ro");
        mygrid5.setColAlign("left,left,left,left,left,left,left,left,left,left,left");
        //mygrid2.isColumnHidden(0);//PJTID숨기기

        mygrid5.enableSmartRendering(false);
        mygrid5.enableMultiselect(true);

		//GRPTYPE 콤보
		setCodeCombo("GRID",mygrid5.getCombo(mygrid5.getColIndexById("FNCCD")),"FNC");

        mygrid5.init();

        mygrid5.setColumnHidden(0,true); //PJTID
		mygrid5.setColumnHidden(1,true); //PGMID
        mygrid5.setColumnHidden(2,true); //GRPID


        //6번째 그리드 초기화 (inherrit)
        mygrid6 = new dhtmlXGridObject('grid6');
		mygrid6.setUserData("","gridTitle","grid6 : fnc list"); //글로별 변수에 그리드 타이블 넣기
        mygrid6.setImagePath("./lib/dhtmlxSuite/codebase/imgs/");
        mygrid6.setHeader("PJTID,PGMID,GRPID,COLID,CHILDGRPID,FILTERYN,VALUEYN,ADDDT,MODDT");
        mygrid6.setColumnIds("PJTID,PGMID,GRPID,COLID,CHILDGRPID,FILTERYN,VALUEYN,ADDDT,MODDT");
        mygrid6.setInitWidths("50,50,50,50,50,50,50,50,50");
        mygrid6.setColTypes("ed,ed,ed,ed,ed,ed,ed,ro,ro");
        mygrid6.setColAlign("left,left,left,left,left,left,left,left,left");
        //mygrid2.isColumnHidden(0);//PJTID숨기기

        mygrid6.enableSmartRendering(false);
        mygrid6.enableMultiselect(true);

        mygrid6.init();



        //3번째 그리드 초기화
        mygrid3 = new dhtmlXGridObject('grid3');
		mygrid3.setUserData("","gridTitle","grid3 : sql column list"); //글로별 변수에 그리드 타이블 넣기
        mygrid3.setImagePath("./lib/dhtmlxSuite/codebase/imgs/");
        mygrid3.setHeader("COLSEQ,PJTID,PGMID,GRPID,FNCID,SQLID,COLID,SQLGBN,ORD,ADDDT,MODDT");
        mygrid3.setColumnIds("COLSEQ,PJTID,PGMID,GRPID,FNCID,SQLID,COLID,SQLGBN,ORD,ADDDT,MODDT");
        //mygrid2.attachHeader("#connector_text_filter,#connector_text_filter,#connector_text_filter,#connector_text_filter")
        mygrid3.setInitWidths("50,50,50,50,50,50,50,50,100,50,60");
        mygrid3.setColTypes("ro,ed,ed,ed,ed,ed,ed,ed,ed,ro,ro");
        mygrid3.setColAlign("left,left,left,left,left,left,left,left,left,left,left");
        //mygrid2.isColumnHidden(0);//PJTID숨기기

        mygrid3.enableSmartRendering(false);
        mygrid3.enableMultiselect(true);
        mygrid3.init();

        mygrid3.setColumnHidden(0,true); //COLSEQ
        mygrid3.setColumnHidden(1,true); //PJTID
        mygrid3.setColumnHidden(2,true); //PGMID
        mygrid3.setColumnHidden(3,true); //GRPID
        mygrid3.setColumnHidden(4,true); //FNCID
        mygrid3.setColumnHidden(5,true); //SQLID



        //4번째 그리드 초기화
        mygrid4 = new dhtmlXGridObject('grid4');
		mygrid4.setUserData("","gridTitle","grid3 : io list"); //글로별 변수에 그리드 타이블 넣기
        mygrid4.setImagePath("./lib/dhtmlxSuite/codebase/imgs/");
        mygrid4.setHeader("PJTID,PGMID,GRPID,COLID,COLORD,COLNM,DATATYPE,DATASIZE,OBJTYPE,BRYN,LBLHIDDENYN,LBLWIDTH,OBJWIDTH,OBJHEIGHT,KEYYN,HIDDENYN,EDITYN,FNINIT,FNNMSEARCH,FNPOPSEARCH,COLFORMAT,VALIDREQUARE,VALIDMIN,VALIDMAX,OBJALIGN,REFCOLID,ADDDT,MODDT"); //28
        mygrid4.setColumnIds("PJTID,PGMID,GRPID,COLID,COLORD,COLNM,DATATYPE,DATASIZE,OBJTYPE,BRYN,LBLHIDDENYN,LBLWIDTH,OBJWIDTH,OBJHEIGHT,KEYYN,HIDDENYN,EDITYN,FNINIT,FNNMSEARCH,FNPOPSEARCH,COLFORMAT,VALIDREQUARE,VALIDMIN,VALIDMAX,OBJALIGN,REFCOLID,ADDDT,MODDT"); //28

        //mygrid2.attachHeader("#connector_text_filter,#connector_text_filter,#connector_text_filter,#connector_text_filter")
        mygrid4.setInitWidths("50,50,50,50,50,50,50,50,50,50,50,50,50,50,50,50,50,50,50,50,50,50,50,50,50,50,50,50"); //28
        mygrid4.setColTypes("ed,ed,ed,ed,ed,ed,ed,ed,ed,ed,ed,ed,ed,ed,ed,ed,ed,ed,ed,ed,ed,ed,ed,ed,ed,ed,ro,ro"); //28
        mygrid4.setColAlign("left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left");//28
        mygrid4.enableSmartRendering(true);
        mygrid4.enableMultiselect(true);
        mygrid4.splitAt(4);//'freezes' 0 columns // ROW선택 이벤트
		mygrid4.init();

        mygrid4.setColumnHidden(0,true); //PJTID
        mygrid4.setColumnHidden(1,true); //PGMID
        mygrid4.setColumnHidden(2,true); //GRPID



    }//initBody();



    </script>


</head>
<body onload="initBody();">

<div id="BODY_BOX" class="BODY_BOX">
	<div  class="GRID_LABELGRP" >
		<div class="GRID_LABEL" >* PGMINFO2</div>
		<div  class="GRID_LABELBTN"  >
			<input type="button" name="some_name" value="Search1" onclick="search1();">
		</div>
	</div>


    <div style="position: relative;width:100%;background-color:yellow;padding:0 0 0 0;overflow:auto;border-radius:3px;-moz-border-radius: 3px;">
        <div style="position: relative;background-color:#eeeeee;padding:5px 5px 5px 5px;overflow:auto;">
            <div style="width:0px;height:0px;overflow: hidden"><form id="condition1"></div>

            <div class="CON_LINE" style="">
                <div class="CON_OBJGRP" style="">
                    <div class="CON_LABEL" style="width:100px;">PJTID *</div>
                    <div class="CON_OBJECT" style="width:150px;"><input type="text" name="F_PJTID" value="" id="F_PJTID"></div>
                </div>
                <div class="CON_OBJGRP" style="">
                    <div class="CON_LABEL" style="width:100px;">PGMID</div>
                    <div class="CON_OBJECT" style="width:150px;"><input type="text" name="F_PGMID" value="" id="F_PGMID"></div>
                </div>
                <div class="CON_OBJGRP" style="">
                    <div class="CON_LABEL" style="width:100px;">PGMNM</div>
                    <div class="CON_OBJECT" style="width:150px;"><input type="text" name="F_PGMNM" value="" id="F_PGMNM"></div>
                </div>
            </div>

            <div class="CON_LINEBREAK" style=""></div>

            <div class="CON_LINE" style="">
                <div class="CON_OBJGRP" style="">
                    <div class="CON_LABEL" style="width:100px;">날짜종류</div>
                    <div class="CON_OBJECT" style="width:200px;"><input type="radio" name="F_DT_TYPE" value="ADDDT" id="F_DT_TYPE" checked>생성일, <input type="radio" name="F_DT_TYPE" value="MODDT" id="F_DT_TYPE">변경일</div>
                </div>
                <div class="CON_OBJGRP" style="">
                    <div class="CON_LABEL" style="width:100px;">날짜범위</div>
                    <div class="CON_OBJECT" style="width:300px;">
                        <input type="text" name="F_START_DT" value="" id="F_START_DT" style="width:80px"><img id="F_START_DT_ICON" src="./lib/dhtmlxSuite/calendar.png" border="0" align="absmiddle">
                        <input type="text" name="F_END_DT" value="" id="F_END_DT" style="width:80px"><img id="F_END_DT_ICON" src="./lib/dhtmlxSuite/calendar.png" border="0" align="absmiddle">
                    </div>
                </div>
            </div>


        </div>
    </div>


    <div class="GRP_LINE" >
        <div class="GRP_OBJECT" style="width:35%;">
            <div class="GRID_OBJECT" >
                <div id="grid1" width="100%" height="200px" style="background-color:white;z-index:30;"></div>
            </div>
        </div>

        <div class="GRP_OBJECT" style="width:20%;">

            <div class="GRID_OBJECT" >
                <div id="grid5" width="100%" height="200px" style="background-color:white;z-index:40;"></div>
            </div>
        </div>

        <div class="GRP_OBJECT" style="width:20%;">


            <div class="GRID_OBJECT" >
                <div id="grid2" width="100%" height="200px" style="background-color:white;z-index:40;"></div>
            </div>
        </div>

        <div class="GRP_OBJECT" style="width:25%;">
            <textarea id="code" name="code">

            </textarea>
        </div>
    </div>

    <div class="GRP_LINE" style="">

        <div class="GRP_OBJECT" style="width:60%;">
            <div class="GRID_OBJECT" >
                <div id="grid4" width="100%" height="300px" style="background-color:white;overflow:hidden"></div>
            </div>
        </div>
        <div class="GRP_OBJECT" style="width:20%;">
            <div class="GRID_OBJECT" >
                <div id="grid6" width="100%" height="300px" style="background-color:white;overflow:hidden"></div>
            </div>
        </div>
        <div class="GRP_OBJECT" style="width:20%;">

            <div class="GRID_OBJECT" >
                <div id="grid3" width="100%" height="300px" style="background-color:white;z-index:3;"></div>
            </div>
        </div>

    </div>

</div>
<div id="div_layout" style="display: none;background-color:silver;position:absolute;top:24px;left:10px;overflow: auto;width:100%;z-index;100">

</div>

<div style="width:0px;height:0px;overflow: hidden"></form></div>


</body>
</html>
