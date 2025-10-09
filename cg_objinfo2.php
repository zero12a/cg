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
    <script src="./lib/dhtmlxSuite/codebase/dhtmlx.js" type="text/javascript" charset="utf-8"></script>
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





    <script>

    function search1(){
        //폼값 밸리데이션
        if( !jsonFormValid(obj_condition_valid.PJTID, "F_PJTID", "프로젝트ID", $("#F_PJTID").val()) ){return false;};

        //폼의 모든값 구하기
        var ConAllData = $( "#condition1" ).serialize();
        alog("ConAllData:" + ConAllData);


        lastinput1 = ConAllData;

		//파일 타입에 따른 콤보 변경
		//alert($(':radio[name="F_FILETYPE"]:checked').val());
		var chk_filetype = $('input:radio[name="F_FILETYPE"]:checked').val();

		//alert(chk_filetype);
		if(chk_filetype == "HTML" || chk_filetype == "HTMLJS"){
			alog("FNCHTML");
			setCodeCombo("GRID",mygrid2.getCombo(mygrid2.getColIndexById("OBJVAL")),"FNCHTML");
			setCodeCombo("GRID",mygrid2.getCombo(mygrid2.getColIndexById("OBJVALTYPE")),"FNCTYPE");
		}else if(chk_filetype == "HTMLBODY"){
			alog("BODYHTML");
			setCodeCombo("GRID",mygrid2.getCombo(mygrid2.getColIndexById("OBJVAL")),"BODYHTML");
			setCodeCombo("GRID",mygrid2.getCombo(mygrid2.getColIndexById("OBJVALTYPE")),"BODYTYPE");
		}else{
			alog("ELSE FNCHTML");
			setCodeCombo("GRID",mygrid2.getCombo(mygrid2.getColIndexById("OBJVAL")),"FNCHTML");
			setCodeCombo("GRID",mygrid2.getCombo(mygrid2.getColIndexById("OBJVALTYPE")),"FNCTYPE");
		}


        gridSearch1(lastinput1);

    }


    //mygrid.filterBy(0,function(a){ return (a<500);});

    function addRow1(){
        alog("addRow1()------------start");

        tgrid = mygrid1;

        var id=tgrid.uid();
        tgrid.addRow(id,'',0);
        tgrid.showRow(id);
        tgrid.selectRow(0);
        tgrid.cells(id,0).cell.wasChanged = true;
        tgrid.setUserData(id,"!nativeeditor_status","inserted");
        tgrid.setRowTextBold(id);
        addstatusyn1 = true;
        alog("addRow1()------------end");
    }
    function addRow2(){
        alog("addRow2()------------start");

        tgrid = mygrid2;

        var id=tgrid.uid();
        tgrid.addRow(id,["",lastinput2json.OBJTYPE],0);
        tgrid.showRow(id);
        tgrid.selectRow(0);
        tgrid.cells(id,0).cell.wasChanged = true;
        tgrid.setUserData(id,"!nativeeditor_status","inserted");
        tgrid.setRowTextBold(id);
        addstatusyn2 = true;
        alog("addRow2()------------end");
    }
    function addRow3(){
        alog("addRow3()------------start");

        tgrid = mygrid3;

        var id=tgrid.uid();
        tgrid.addRow(id,["",lastinput3json.OBJTYPE,lastinput3json.OBJDSEQ],0);
        tgrid.showRow(id);
        tgrid.selectRow(0);
        tgrid.cells(id,0).cell.wasChanged = true;
        tgrid.setUserData(id,"!nativeeditor_status","inserted");
        tgrid.setRowTextBold(id);
        addstatusyn3 = true;
        alog("addRow3()------------end");
    }

    function addRow4(){
        alog("addRow4()------------start");

        tgrid = mygrid4;

        var id=tgrid.uid();
        tgrid.addRow(id,["",lastinput4json.OBJTYPE,lastinput4json.OBJASEQ],0);
        tgrid.showRow(id);
        tgrid.selectRow(0);
        tgrid.cells(id,0).cell.wasChanged = true;
        tgrid.setUserData(id,"!nativeeditor_status","inserted");
        tgrid.setRowTextBold(id);
        addstatusyn4 = true;
        alog("addRow4()------------end");
    }



    function delRow1(){
        alog("delRow1()------------start");

        tgrid = mygrid1;

        rid = tgrid.getSelectedRowId();
        tgrid.setUserData(rid,"!nativeeditor_status","deleted");
        tgrid.setRowTextBold(rid);
        tgrid.cells(rid,0).cell.wasChanged=true;

        alog("delRow1()------------end");
    }
    function delRow2(){
        alog("delRow2()------------start");

        tgrid = mygrid2;

        rid = tgrid.getSelectedRowId();
        tgrid.setUserData(rid,"!nativeeditor_status","deleted");
        tgrid.setRowTextBold(rid);
        tgrid.cells(rid,0).cell.wasChanged=true;

        alog("delRow2()------------end");
    }
    function delRow3(){
        alog("delRow3()------------start");

        tgrid = mygrid3;

        rid = tgrid.getSelectedRowId();
        tgrid.setUserData(rid,"!nativeeditor_status","deleted");
        tgrid.setRowTextBold(rid);
        tgrid.cells(rid,0).cell.wasChanged=true;

        alog("delRow3()------------end");
    }

    function delRow4(){
        alog("delRow4()------------start");

        tgrid = mygrid4;

        rid = tgrid.getSelectedRowId();
        tgrid.setUserData(rid,"!nativeeditor_status","deleted");
        tgrid.setRowTextBold(rid);
        tgrid.cells(rid,0).cell.wasChanged=true;

        alog("delRow4()------------end");
    }




    function saveAll(){
        alog("saveAll()------------start");
        save1();
        save2();
        save3();
        alog("saveAll()------------end");
    }


    function loadxml(){
        alog("save1()------------start");
        //serialize user data or not,
        //serialize 'selected' attribute for the rows tags,
        //serialize grid structure info,
        //serialize the 'changed' attribute for the cells tags,
        //include just changed rows to serialization,
        //serialize cell values as CDATA sections

        //tgrid = mygrid1;

        mygrid2.setSerializationLevel(true,false,false,true,true,false);
        //mygrid4.serialize();
        var myXmlString = mygrid2.serialize();

        mygrid3.setSerializationLevel(true,false,false,true,true,false);
        //mygrid4.serialize();
        var myXmlString2 = mygrid3.serialize();

        //alog("xml : " + myXmlString);

        //컨디션 데이터 모두 말기
        var ConAllData = $( "#condition1" ).serialize();
        alog("   ConAllData = " + ConAllData);

        var xml = myXmlString;
        xml = xml.replace(new RegExp("<row","g"),"\n<row");
        xml = xml.replace(new RegExp("</row","g"),"\n</row");
        xml = xml.replace(new RegExp("<cell","g"),"\n\t<cell");

        var xml2 = myXmlString2;
        xml2 = xml2.replace(new RegExp("<row","g"),"\n<row");
        xml2 = xml2.replace(new RegExp("</row","g"),"\n</row");
        xml2 = xml2.replace(new RegExp("<cell","g"),"\n\t<cell");

        $("#tt").val(xml);
        $("#tt2").val(xml2);
    }

    function save1(){
        alog("save1()------------start");
        //serialize user data or not,
        //serialize 'selected' attribute for the rows tags,
        //serialize grid structure info,
        //serialize the 'changed' attribute for the cells tags,
        //include just changed rows to serialization,
        //serialize cell values as CDATA sections

        tgrid = mygrid1;

        tgrid.setSerializationLevel(true,false,false,false,true,true);
        //mygrid4.serialize();
        var myXmlString = tgrid.serialize();

        tgrid.setSerializationLevel(true,false,false,false,false,true);
        //mygrid4.serialize();
        var myXmlString2 = tgrid.serialize();

        //alog("xml : " + myXmlString);

        //컨디션 데이터 모두 말기
        var ConAllData = $( "#condition1" ).serialize();
        alog("   ConAllData = " + ConAllData);

        var xml = myXmlString;
        xml = xml.replace(new RegExp("<row","g"),"\n<row");
        xml = xml.replace(new RegExp("</row","g"),"\n</row");
        xml = xml.replace(new RegExp("<cell","g"),"\n\t<cell");

        var xml2 = myXmlString2;
        xml2 = xml2.replace(new RegExp("<row","g"),"\n<row");
        xml2 = xml2.replace(new RegExp("</row","g"),"\n</row");
        xml2 = xml2.replace(new RegExp("<cell","g"),"\n\t<cell");

        $("#tt").val(xml);
        $("#tt2").val(xml2);

        $.ajax({
            type : "POST",
            url : url_1+"&G1_CRUD_MODE=SAVE&" + lastinput1 ,
            data : {xmldata : myXmlString},
            dataType: "json",
            async:false,
            success: function(data){
                alog("   save1 json return----------------------");
                //alog("   json data : " + data);
                //alog("   json RTN_CD : " + data.RTN_CD);
                //alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                saveToGrid(tgrid,data);

            },
            error: function(error){
                alog("Error:");
                alog(error);
            }
        });

        addstatusyn1 = false;
        alog("save1()------------end");
    }


    function save2(){
        alog("save2()------------start");
        //serialize user data or not,
        //serialize 'selected' attribute for the rows tags,
        //serialize grid structure info,
        //serialize the 'changed' attribute for the cells tags,
        //include just changed rows to serialization,
        //serialize cell values as CDATA sections

        tgrid = mygrid2;

        tgrid.setSerializationLevel(true,false,false,false,true,true);
        //mygrid4.serialize();
        var myXmlString = tgrid.serialize();

        tgrid.setSerializationLevel(true,false,false,false,false,true);
        //mygrid4.serialize();
        var myXmlString2 = tgrid.serialize();

        //alog("xml : " + myXmlString);

        //컨디션 데이터 모두 말기
        var ConAllData = $( "#condition1" ).serialize();
        alog("   ConAllData = " + ConAllData);

        var xml = myXmlString;
        xml = xml.replace(new RegExp("<row","g"),"\n<row");
        xml = xml.replace(new RegExp("</row","g"),"\n</row");
        xml = xml.replace(new RegExp("<cell","g"),"\n\t<cell");

        var xml2 = myXmlString2;
        xml2 = xml2.replace(new RegExp("<row","g"),"\n<row");
        xml2 = xml2.replace(new RegExp("</row","g"),"\n</row");
        xml2 = xml2.replace(new RegExp("<cell","g"),"\n\t<cell");

        $("#tt").val(xml);
        $("#tt2").val(xml2);

        $.ajax({
            type : "POST",
            url : url_2+"&G2_CRUD_MODE=SAVE&" + lastinput2 ,
            data : {xmldata : myXmlString},
            dataType: "json",
            async:false,
            success: function(data){
                alog("   save2 json return----------------------");
                //alog("   json data : " + data);
                //alog("   json RTN_CD : " + data.RTN_CD);
                //alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                saveToGrid(tgrid,data);

            },
            error: function(error){
                alog("Error:");
                alog(error);
            }
        });

        addstatusyn2 = false;
        alog("save2()------------end");
    }


    function save3(){
        alog("save3()------------start");
        //serialize user data or not,
        //serialize 'selected' attribute for the rows tags,
        //serialize grid structure info,
        //serialize the 'changed' attribute for the cells tags,
        //include just changed rows to serialization,
        //serialize cell values as CDATA sections

        tgrid = mygrid3;

        tgrid.setSerializationLevel(true,false,false,false,true,true);
        //mygrid4.serialize();
        var myXmlString = tgrid.serialize();

        tgrid.setSerializationLevel(true,false,false,false,false,true);
        //mygrid4.serialize();
        var myXmlString2 = tgrid.serialize();

        //alog("xml : " + myXmlString);

        //컨디션 데이터 모두 말기
        var ConAllData = $( "#condition1" ).serialize();
        alog("   ConAllData = " + ConAllData);

        var xml = myXmlString;
        xml = xml.replace(new RegExp("<row","g"),"\n<row");
        xml = xml.replace(new RegExp("</row","g"),"\n</row");
        xml = xml.replace(new RegExp("<cell","g"),"\n\t<cell");

        var xml2 = myXmlString2;
        xml2 = xml2.replace(new RegExp("<row","g"),"\n<row");
        xml2 = xml2.replace(new RegExp("</row","g"),"\n</row");
        xml2 = xml2.replace(new RegExp("<cell","g"),"\n\t<cell");

        $("#tt").val(xml);
        $("#tt2").val(xml2);

        $.ajax({
            type : "POST",
            url : url_3+"&G3_CRUD_MODE=SAVE&" + lastinput3 ,
            data : {xmldata : myXmlString},
            dataType: "json",
            async:false,
            success: function(data){
                alog("   save3 json return----------------------");
                //alog("   json data : " + data);
                //alog("   json RTN_CD : " + data.RTN_CD);
                //alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                saveToGrid(tgrid,data);

            },
            error: function(error){
                alog("Error:");
                alog(error);
            }
        });

        addstatusyn1 = false;
        alog("save3()------------end");
    }


    function save4(){
        alog("save4()------------start");

        tgrid = mygrid4;

        tgrid.setSerializationLevel(true,false,false,false,true,true);
        //mygrid4.serialize();
        var myXmlString = tgrid.serialize();

        tgrid.setSerializationLevel(true,false,false,false,false,true);
        //mygrid4.serialize();
        var myXmlString2 = tgrid.serialize();

        //alog("xml : " + myXmlString);

        //컨디션 데이터 모두 말기
        var ConAllData = $( "#condition1" ).serialize();
        alog("   ConAllData = " + ConAllData);

        var xml = myXmlString;
        xml = xml.replace(new RegExp("<row","g"),"\n<row");
        xml = xml.replace(new RegExp("</row","g"),"\n</row");
        xml = xml.replace(new RegExp("<cell","g"),"\n\t<cell");

        var xml2 = myXmlString2;
        xml2 = xml2.replace(new RegExp("<row","g"),"\n<row");
        xml2 = xml2.replace(new RegExp("</row","g"),"\n</row");
        xml2 = xml2.replace(new RegExp("<cell","g"),"\n\t<cell");

        $("#tt").val(xml);
        $("#tt2").val(xml2);

        $.ajax({
            type : "POST",
            url : url_5+"&G5_CRUD_MODE=SAVE&" + lastinput3 ,
            data : {xmldata : myXmlString},
            dataType: "json",
            async:false,
            success: function(data){
                alog("   save3 json return----------------------");
                //alog("   json data : " + data);
                //alog("   json RTN_CD : " + data.RTN_CD);
                //alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                saveToGrid(tgrid,data);

            },
            error: function(error){
                alog("Error:");
                alog(error);
            }
        });

        addstatusyn4 = false;
        alog("save4()------------end");
    }




    function clearRowChanged(tgrid,trid){
        alog("clearRowChanged----------------------------start");
        alog("       tgrid.getColumnCount : " + tgrid.getColumnCount());
        alog("       trid : " + trid);
        tgrid.setUserData(trid,"!nativeeditor_status","");
        tgrid.setRowTextStyle(trid, "font-weight:normal;text-decoration:none;");
        for(var j=0;j<tgrid.getColumnCount();j++){
            alog("           j : " + j);
            tgrid.cells(trid,j).cell.wasChanged=false;
        }
        alog("clearRowChanged----------------------------end");
    }





    //그리드 조회
    function gridSearch1(tinput){
        alog("gridSearch1()------------start");

        //처리할 그리드
        tgrid = mygrid1;

        //그리드 초기화
        tgrid.clearAll();

        //불러오기
        $.ajax({
            type : "POST",
            url : url_1+"&G1_CRUD_MODE=read&" + tinput ,
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
                    alog(JSON.stringify(data.RTN_DATA));

                    tgrid.parse(data.RTN_DATA,"json");

                }else{
                    alert("서버 조회중 에러가 발생했습니다.\nRTN_CD : " + data.RTN_CD + "\nERR_CD : " + data.ERR_CD + "\nRTN_MSG :" + data.RTN_MSG);
                }


            },
            error: function(error){
                alog("Error:");
                alog(error);
            }
        });

        alog("gridSearch1()------------end");
    }

    //그리드 조회
    function gridSearch2(tinput){
        alog("gridSearch2()------------start");

        //처리할 그리드
        tgrid = mygrid2;

        //그리드 초기화
        tgrid.clearAll();

        //불러오기
        $.ajax({
            type : "POST",
            url : url_2+"&G2_CRUD_MODE=read&" + tinput ,
            data : {xmldata : ""},
            dataType: "json",
            async: true,
            success: function(data){
                alog("   gridSearch2 json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
                    if(data.RTN_DATA)tgrid.parse(data.RTN_DATA,"json");
					alog(JSON.stringify(data.RTN_DATA));
					msgNotice("[그리드2] 조회 성공했습니다",1);
                    

                }else{
                    alert("서버 조회중 에러가 발생했습니다.\nRTN_CD : " + data.RTN_CD + "\nERR_CD : " + data.ERR_CD + "\nRTN_MSG :" + data.RTN_MSG);
                }


            },
            error: function(error){
                alog("Error:");
                alog(error);
            }
        });

        alog("gridSearch2()------------end");
    }

    //그리드 조회
    function gridSearch3(tinput){
        alog("gridSearch3()------------start");

        //처리할 그리드
        tgrid = mygrid3;

		//데이터스토어 지우기
		tds = mygrid3ds;
		tds.clearAll();

        //그리드 초기화
        //tgrid.clearAll();

        //불러오기
        $.ajax({
            type : "POST",
            url : url_3+"&G3_CRUD_MODE=read&" + tinput ,
            data : {xmldata : ""},
            dataType: "json",
            async: true,
            success: function(data){
                alog("   gridSearch3 json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
					alog(JSON.stringify(data.RTN_DATA));

					//ds 로딩
					tds.load(data.RTN_DATA,function(){
						alert("tds load 로딩함");
					});
					
					alert(tds.dataCount());
					tgrid.sync(tds);

					//기존꺼
					//if(data.RTN_DATA)tgrid.parse(data.RTN_DATA,"json");
                    

                    msgNotice("[그리드3] 조회 성공했습니다.",1);


                }else{
                    alert("서버 조회중 에러가 발생했습니다.\nRTN_CD : " + data.RTN_CD + "\nERR_CD : " + data.ERR_CD + "\nRTN_MSG :" + data.RTN_MSG);
                }


            },
            error: function(error){
                alog("Error:");
                alog(error);
            }
        });

        alog("gridSearch3()------------end");
    }


    //그리드 조회
    function gridSearch4(tinput){
        alog("gridSearch4()------------start");

        //처리할 그리드
        tgrid = mygrid4;

        //그리드 초기화
        tgrid.clearAll();

        //불러오기
        $.ajax({
            type : "POST",
            url : url_5+"&G5_CRUD_MODE=read&" + tinput ,
            data : {xmldata : ""},
            dataType: "json",
            async: true,
            success: function(data){
                alog("   gridSearch4 json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
					if(data.RTN_DATA)tgrid.parse(data.RTN_DATA,"json");
                    alog(JSON.stringify(data.RTN_DATA));

                    msgNotice("[그리드4] 조회 성공했습니다.",1);


                }else{
                    alert("[그리드4] 서버 조회중 에러가 발생했습니다.\nRTN_CD : " + data.RTN_CD + "\nERR_CD : " + data.ERR_CD + "\nRTN_MSG :" + data.RTN_MSG);
                }


            },
            error: function(error){
                alert("[그리드4] Error:");
                alog(error);
            }
        });

        alog("gridSearch3()------------end");
    }



    //정적 변수 선언
    var myCalendar;
    var mygrid1,selrowid1,lastinput1,lastinput1json;
    var mygrid2,selrowid2,lastinput2,lastinput2json;
    var mygrid3,selrowid3,lastinput3,lastinput3json,mygrid3ds;
    var mygrid4,selrowid3,lastinput4,lastinput4json;
    var url_1 = "cg_objinfo_crud2.php?F_GRPID=1&";
    var url_2 = "cg_objinfo_crud2.php?F_GRPID=2&";
    var url_3 = "cg_objinfo_crud2.php?F_GRPID=3&";
    var url_4 = "cg_objinfo_crud2.php?F_GRPID=4&";
    var url_5 = "cg_objinfo_crud2.php?F_GRPID=5&";
    var validmsg = jQuery.parseJSON('{"REQUARED":"[0]는 반드시 입력바랍니다.", "MIN":"this는 [0]이상 입력바랍니다."}');


    //동적 변수 선언
    var obj_condition_valid = jQuery.parseJSON( '{ "":"" ' +
        ', "PJTID": {"REQUARED":"Y",  "MIN":"0",  "MAX":"ZZZ",  "DATASIZE":10,  "DATATYPE":"STRING"} ' +
        '}' );

    //디테일 변수 선언
    var obj_F4_valid = jQuery.parseJSON( '{ "":"" ' +
        ' , "OBJTYPE": {"REQUARED":"Y",  "MIN":"0",  "MAX":"ZZZ",  "DATASIZE":10,  "DATATYPE":"STRING"}' +
        ' , "STARTTXT": {"REQUARED":"Y",  "MIN":"0",  "MAX":"ZZZ",  "DATASIZE":10,  "DATATYPE":"STRING"}' +
       "}" );


    //화면 초기화
    function initBody(){
        alog("initBody()---------start")

		//dhtmlx 메시지 박스 초기화
		dhtmlx.message.position="bottom"


        //프로젝트 id초기화
        $("#F_PJTID").val("CG");

        //날짜 박스 초기
        myCalendar = new dhtmlXCalendarObject([{input:"F_START_DT",
            button:"F_START_DT_ICON"},{input:"F_END_DT",
            button:"F_END_DT_ICON"}]);



        //코드 미러 초기화
        cm2 = CodeMirror.fromTextArea(document.getElementById('code2'), {
            mode: "application/x-httpd-php",
            styleActiveLine: true,
            indentWithTabs: true,
            smartIndent: true,
            lineNumbers: true,
            matchBrackets : true,
            tabSize: 4,
            indentUnit: 4,
            indentWithTabs: true
        });

        cm2.on("change", function(cm, change) {
            alog("cm2 change -------------------------------start");
            alog("    cm.getValue :  (" + cm.getValue() + ")");
            alog("    change.origin : (" + change.origin + ")");
            alog("    change.from : (" + change.to + ")");
            alog("    change.text : (" + change.text + ")");
            alog("    change.removed : (" + change.removed + ")");
            alog("    change.to : (" + change.to + ")");

            //바인드 정보로 리턴하기
            if(change.origin != "setValue"){
                rid = mygrid2.getSelectedId();
                cidx = mygrid2.getColIndexById("SRCTXT");
                mygrid2.cells(rid,cidx).setValue(cm.getValue());
                mygrid2.cells(rid,cidx).cell.wasChanged = true;
            
				RowEditStatus = mygrid2.getUserData(rid,"!nativeeditor_status");
				if(RowEditStatus == "")mygrid2.setUserData(rid,"!nativeeditor_status","updated");
                mygrid2.setRowTextBold(rid);
            }

        });
        cm2.on("focus", function() {
            alog("cm2 focus -------------------------------start");
            rid = mygrid2.getSelectedId();

            alog("       rid : " + rid);

            if(rid == null)alert("변경할 Row를 선택해 주세요.");
        });

        cm2.on("blur", function() {
            alog("cm2 blur -------------------------------start");
        });






        //코드 미러 초기화
        cm3 = CodeMirror.fromTextArea(document.getElementById('code3'), {
            mode: "application/x-httpd-php",
            styleActiveLine: true,
            indentWithTabs: true,
            smartIndent: true,
            lineNumbers: true,
            matchBrackets : true,
            tabSize: 4,
            indentUnit: 4,
            indentWithTabs: true
        });

        cm3.on("change", function(cm, change) {
            alog("cm3 change -------------------------------start");
            alog("    cm.getValue :  (" + cm.getValue() + ")");
            alog("    change.origin : (" + change.origin + ")");
            alog("    change.from : (" + change.to + ")");
            alog("    change.text : (" + change.text + ")");
            alog("    change.removed : (" + change.removed + ")");
            alog("    change.to : (" + change.to + ")");

            //바인드 정보로 리턴하기
            if(change.origin != "setValue"){
                rid = mygrid3.getSelectedId();
                cidx = mygrid3.getColIndexById("SRCTXT");
                mygrid3.cells(rid,cidx).setValue(cm.getValue());
                mygrid3.cells(rid,cidx).cell.wasChanged = true;

				RowEditStatus = mygrid3.getUserData(rid,"!nativeeditor_status");
				if(RowEditStatus == "") mygrid3.setUserData(rid,"!nativeeditor_status","updated");

                mygrid3.setRowTextBold(rid);
            }

        });
        cm3.on("focus", function() {
            alog("cm3 focus -------------------------------start");
            rid = mygrid3.getSelectedId();

            alog("       rid : " + rid);

            if(rid == null)alert("변경할 Row를 선택해 주세요.");
        });

        cm3.on("blur", function() {
            alog("cm3 blur -------------------------------start");
        });






        //코드 미러 초기화
        cm4 = CodeMirror.fromTextArea(document.getElementById('code4'), {
            mode: "application/x-httpd-php",
            styleActiveLine: true,
            indentWithTabs: true,
            smartIndent: true,
            lineNumbers: true,
            matchBrackets : true,
            tabSize: 4,
            indentUnit: 4,
            indentWithTabs: true
        });

        cm4.on("change", function(cm, change) {
            alog("cm4 change -------------------------------start");
            alog("    cm.getValue :  (" + cm.getValue() + ")");
            alog("    change.origin : (" + change.origin + ")");
            alog("    change.from : (" + change.to + ")");
            alog("    change.text : (" + change.text + ")");
            alog("    change.removed : (" + change.removed + ")");
            alog("    change.to : (" + change.to + ")");

            //바인드 정보로 리턴하기
            if(change.origin != "setValue"){
                rid = mygrid4.getSelectedId();
                cidx = mygrid4.getColIndexById("SRCTXT");
                mygrid4.cells(rid,cidx).setValue(cm.getValue());
                mygrid4.cells(rid,cidx).cell.wasChanged = true;

				RowEditStatus = mygrid4.getUserData(rid,"!nativeeditor_status");
				if(RowEditStatus == "") mygrid4.setUserData(rid,"!nativeeditor_status","updated");

                mygrid4.setRowTextBold(rid);
            }

        });
        cm4.on("focus", function() {
            alog("cm4 focus -------------------------------start");
            rid = mygrid4.getSelectedId();

            alog("       rid : " + rid);

            if(rid == null)alert("변경할 Row를 선택해 주세요.");
        });

        cm3.on("blur", function() {
            alog("cm4 blur -------------------------------start");
        });






        alog("       grid1 init-----------start");

        //그리드 초기화
        mygrid1 = new dhtmlXGridObject('grid1');
        mygrid1.setImagePath("../dhtmlx/imgs/");
        mygrid1.setHeader("OLD_OBJTYPE,OBJTYPE,STARTTXT,LBLSTARTTXT,LBLTXT,LBLENDTXT,OBJSTARTTXT,OBJTXT,OBJENDTXT,ENDTXT,사용여부,ADDDT,MODDT");
        mygrid1.setColumnIds("OLD_OBJTYPE,OBJTYPE,STARTTXT,LBLSTARTTXT,LBLTXT,LBLENDTXT,OBJSTARTTXT,OBJTXT,OBJENDTXT,ENDTXT,USEYN,ADDDT,MODDT");
        //mygrid1.attachHeader("#connector_text_filter,#connector_text_filter,#connector_text_filter,#connector_text_filter")
        mygrid1.setInitWidths("60,60,200,200,200,50,200,200,50,50,60,60,60")
        mygrid1.setColTypes("ed,ed,txttxt,txttxt,txttxt,txttxt,txttxt,txttxt,txttxt,txttxt,ed,ro,ro");
        mygrid1.enableSmartRendering(false);
        mygrid1.enableMultiselect(true);
        mygrid1.init();
        mygrid1.splitAt(2);
        mygrid1.setColumnHidden(2,true); //PJTID
        mygrid1.setColumnHidden(3,true); //PJTID
        mygrid1.setColumnHidden(4,true); //PJTID
        mygrid1.setColumnHidden(5,true); //PJTID
        mygrid1.setColumnHidden(6,true); //PJTID
        mygrid1.setColumnHidden(7,true); //PJTID
        mygrid1.setColumnHidden(8,true); //PJTID
        mygrid1.setColumnHidden(9,true); //PJTID

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

        mygrid1.attachEvent("onRowSelect",function(rowID,celInd){
            alog("mygrid1 - onRowSelect ----------start");
            alog("   rowID = " + rowID);
            alog("   celInd = " + celInd);
            mygrid2.clearAll();

            selrowid1 = rowID;

            //선택된 ROW의 모든컬럼 추출하기
            var RowAllData;
            RowAllData = getRowsColid(mygrid1,rowID,"G1",["OBJTYPE"]);
            alog("   RowAllData = " + RowAllData);

            var ConAllData = $( "#condition1" ).serialize();
            alog("   ConAllData = " + ConAllData);

            //alert( mygrid1.cells(rowID,celInd).getValue() );

            lastinput2 = ConAllData + RowAllData;
            lastinput4 = ConAllData + RowAllData;

            //디테일 4 조회
            //detailSearch4(lastinput4);


            lastinput2json = jQuery.parseJSON('{ "__NAME":"lastinput3json"' +
                ', "OBJTYPE" : "' + q(mygrid1.cells(rowID,1).getValue()) + '"' +
                '}');


            //그리드 2 조회
            gridSearch2(lastinput2);



            alog("mygrid1 - onRowSelect ----------end");
        });

        alog("       grid1 init-----------end");

        mygrid2 = new dhtmlXGridObject('grid2');
        mygrid2.setImagePath("../dhtmlx/imgs/");
        mygrid2.setHeader("DSEQ,OBJTYPE,FILETYPE,OBJVAL,ORD,OBJVALTYPE,OBJVALNM,DESC,SRCTXT,SPT,INPUT,PARAM,TYPE,FILTER,ADDDT,MODDT");
        mygrid2.setColumnIds("OBJDSEQ,OBJTYPE,FILETYPE,OBJVAL,OBJDORD,OBJVALTYPE,OBJVALNM,OBJDESC,SRCTXT,SPTTXT,INPUT,PARAM,SRCTYPE,FILTER,ADDDT,MODDT");
        //mygrid2.attachHeader("#connector_text_filter,#connector_text_filter,#connector_text_filter,#connector_text_filter")
        mygrid2.setInitWidths("30,50,30,100,30,60,60,60,400,40,60,60,40,50,60,60")
        mygrid2.setColTypes("ro,ed,coro,coro,ed,coro,ed,ed,txttxt,ed,ed,edtxt,ed,ed,ro,ro");
        mygrid2.setColAlign("left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left")
        //mygrid2.isColumnHidden(0);//PJTID숨기기
		mygrid2.setColSorting("int,str,str,str,int,str,str,str,str,str,str,str,str,str,str,str");

        mygrid2.enableSmartRendering(false)
        mygrid2.enableMultiselect(true)
        mygrid2.init();
        mygrid2.splitAt(5);

		//GRPTYPE 콤보
		setCodeCombo("GRID",mygrid2.getCombo(mygrid2.getColIndexById("FILETYPE")),"FILETYPE");



        //mygrid2.loadXML("cg_pjtinfo_crud2.php");
        mygrid2.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){

            alog("mygrid2  onEditCell ------------------start");
            alog("       stage : " + stage);
            alog("       rId : " + rId);
            alog("       cInd : " + cInd);
            alog("       nValue : " + nValue);
            alog("       oValue : " + oValue);

            RowEditStatus = mygrid2.getUserData(rId,"!nativeeditor_status");
            if(stage == 2
                && RowEditStatus != "inserted"
                && RowEditStatus != "deleted"
                && nValue != oValue
                ){
                if(RowEditStatus == "") {
                    mygrid2.setUserData(rId,"!nativeeditor_status","updated");
                    mygrid2.setRowTextBold(rId);
                }
                mygrid2.cells(rId,cInd).cell.wasChanged = true;
            }
            return true;

        });
        mygrid2.attachEvent("onRowSelect",function(rowID,celInd){
            alog("mygrid2 - onRowSelect ----------start");
            alog("   rowID = " + rowID);
            alog("   celInd = " + celInd);


            selrowid2 = rowID;


            //그리드 3처리 데이터 처리
            mygrid3ds.clearAll();

            //그리드 3처리
            //mygrid3.clearAll();

            //선택된 ROW의 모든컬럼 추출하기
            var RowAllData;
            var RowAllData1;
            RowAllData1 = getRowsColid(mygrid1,selrowid1,"G1");
            var RowAllData2;
            RowAllData2 = getRowsColid(mygrid2,rowID,"G2");
            RowAllData = RowAllData1 + RowAllData2;
            alog("   RowAllData = " + RowAllData);

            var ConAllData = $( "#condition1" ).serialize();
            alog("   ConAllData = " + ConAllData);

            //alert( mygrid1.cells(rowID,celInd).getValue() );

            lastinput3 = ConAllData + RowAllData;

            lastinput3json = jQuery.parseJSON('{ "__NAME":"lastinput3json"' +
                ', "OBJDSEQ" : "' + q(mygrid2.cells(rowID,0).getValue()) + '"' +
                ', "OBJTYPE" : "' + q(mygrid2.cells(rowID,1).getValue()) + '"' +
                '}');


            //그리드 2 조회
            gridSearch3(lastinput3);


            //세팅하기
            //alert(mygrid2.cells(rowID,celInd).getValue());
            cidx = mygrid2.getColIndexById("SRCTXT");
            cm2.setValue(mygrid2.cells(rowID,cidx).getValue());




            alog("mygrid2 - onRowSelect ----------end");
        });





        alog("       grid2 init-----------end");


		//DataStore정의
		mygrid3ds = new dhtmlXDataStore({  
			datatype:"json"
		});

        mygrid3 = new dhtmlXGridObject('grid3');
        mygrid3.setImagePath("../dhtmlx/imgs/");
        mygrid3.setHeader("ASEQ,OBJTYPE,DSEQ,ORD,OBJDESC,SRCTXT,SPT,INPUT,PARAM,TYPE,FILTER,ADDDT,MODDT");
        mygrid3.setColumnIds("OBJASEQ,OBJTYPE,OBJDSEQ,OBJAORD,OBJDESC,SRCTXT,SPTTXT,INPUT,PARAM,SRCTYPE,FILTER,ADDDT,MODDT");
        //mygrd3.attachHeader("#connector_text_filter,#connector_text_filter,#connector_text_filter,#connector_text_filter")
        mygrid3.setInitWidths("30,50,30,30,80,500,30,80,80,50,50,70,70")
        mygrid3.setColTypes("ro,ed,ed,ed,ed,txttxt,ed,ed,edtxt,ed,ed,ro,ro");
        mygrid3.setColAlign("left,left,left,left,left,left,left,left,left,left,left,left,left")
		mygrid3.setColSorting("int,str,int,int,str,str,str,str,str,str,str,str,str");
        //mygrid2.isColumnHidden(0);//PJTID숨기기

        mygrid3.enableSmartRendering(false)
        mygrid3.enableMultiselect(true)
        mygrid3.init();
		mygrid3.sync(mygrid3ds); // ds와 연결
        mygrid3.splitAt(5);

        mygrid3.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){

            alog("mygrid3  onEditCell ------------------start");
            alog("       stage : " + stage);
            alog("       rId : " + rId);
            alog("       cInd : " + cInd);
            alog("       nValue : " + nValue);
            alog("       oValue : " + oValue);

            RowEditStatus = mygrid3.getUserData(rId,"!nativeeditor_status");
            if(stage == 2
                && RowEditStatus != "inserted"
                && RowEditStatus != "deleted"
                && nValue != oValue
                ){
                if(RowEditStatus == "") {
                    mygrid3.setUserData(rId,"!nativeeditor_status","updated");
                    mygrid3.setRowTextBold(rId);
                }
                mygrid3.cells(rId,cInd).cell.wasChanged = true;
            }
            return true;

        });



        mygrid3.attachEvent("onRowSelect",function(rowID,celInd){
            alog("mygrid3 - onRowSelect ----------start");
            alog("   rowID = " + rowID);
            alog("   celInd = " + celInd);


            selrowid3 = rowID;


            //그리드 3처리
            mygrid4.clearAll();

            //선택된 ROW의 모든컬럼 추출하기
            var RowAllData;
            RowAllData = getRowsColid(mygrid3,rowID,"G3");
            alog("   RowAllData = " + RowAllData);
            var ConAllData = $( "#condition1" ).serialize();
            alog("   ConAllData = " + ConAllData);

            //alert( mygrid1.cells(rowID,celInd).getValue() );

            lastinput4 = ConAllData + RowAllData;


            lastinput4json = jQuery.parseJSON('{ "__NAME":"lastinput4json"' +
                ', "OBJASEQ" : "' + q(mygrid3.cells(rowID,0).getValue()) + '"' +
                ', "OBJTYPE" : "' + q(mygrid3.cells(rowID,1).getValue()) + '"' +
                '}');


            //그리드 2 조회
            gridSearch4(lastinput4);


            //세팅하기
            //alert(mygrid2.cells(rowID,celInd).getValue());
            cidx = mygrid3.getColIndexById("SRCTXT");
            cm3.setValue(mygrid3.cells(rowID,cidx).getValue());




            alog("mygrid3 - onRowSelect ----------end");
        });






        mygrid4 = new dhtmlXGridObject('grid4');
        mygrid4.setImagePath("../dhtmlx/imgs/");
        mygrid4.setHeader("BSEQ,OBJTYPE,ASEQ,ORD,OBJDESC,SRCTXT,SPT,INPUT,PARAM,TYPE,FILTER,ADDDT,MODDT");
        mygrid4.setColumnIds("OBJBSEQ,OBJTYPE,OBJASEQ,OBJBORD,OBJDESC,SRCTXT,SPTTXT,INPUT,PARAM,SRCTYPE,FILTER,ADDDT,MODDT");

        mygrid4.setInitWidths("30,50,30,30,80,500,30,80,80,50,50,70,70");
        mygrid4.setColTypes("ro,ed,ed,ed,ed,txttxt,ed,ed,edtxt,ed,ed,ro,ro");
        mygrid4.setColAlign("left,left,left,left,left,left,left,left,left,left,left,left,left");
        //mygrid2.isColumnHidden(0);//PJTID숨기기
		mygrid4.setColSorting("int,str,int,int,str,str,str,str,str,str,str,str,str");

        mygrid4.enableSmartRendering(false)
        mygrid4.enableMultiselect(true)
        mygrid4.init();
        mygrid4.splitAt(5);

        mygrid4.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){

            alog("mygrid4  onEditCell ------------------start");
            alog("       stage : " + stage);
            alog("       rId : " + rId);
            alog("       cInd : " + cInd);
            alog("       nValue : " + nValue);
            alog("       oValue : " + oValue);

            RowEditStatus = mygrid4.getUserData(rId,"!nativeeditor_status");
            if(stage == 2
                && RowEditStatus != "inserted"
                && RowEditStatus != "deleted"
                && nValue != oValue
                ){
                if(RowEditStatus == "") {
                    mygrid4.setUserData(rId,"!nativeeditor_status","updated");
                    mygrid4.setRowTextBold(rId);
                }
                mygrid4.cells(rId,cInd).cell.wasChanged = true;
            }
            return true;

        });
        mygrid4.attachEvent("onRowSelect",function(rowID,celInd){
            alog("mygrid4 - onRowSelect ----------start");

            //세팅하기
            //alert(mygrid2.cells(rowID,celInd).getValue());
            cidx = mygrid4.getColIndexById("SRCTXT");
            cm4.setValue(mygrid4.cells(rowID,cidx).getValue());


        });
        alog(" initBody()-----------------end");

    }//initBody();



    function detailNew4(){
        alog("DetailNew4()-----------------------start");

        alog("       form_F4 serial : " + $("#form_F4").serialize());

        //CRUD모드 new
        $("#F4_CRUD_MODE").val("new");

        //모든 컬럼값 (NEW)
        $("#F4_OBJTYPE").val("");
        $("#F4_STARTTXT").val("");
        $("#F4_STARTTXT").val("");
    }

    function detailSearch4(tinput){
        alog("DetailSearch4()------------start");
        alog("   tinput : " + tinput);
        //serialize user data or not,
        //serialize 'selected' attribute for the rows tags,
        //serialize grid structure info,
        //serialize the 'changed' attribute for the cells tags,
        //include just changed rows to serialization,
        //serialize cell values as CDATA sections

        $.ajax({
            type : "POST",
            url : url_4 + "&F4_CRUD_MODE=read&" + tinput ,
            data : {F4_OBJTYPE: $("#F4_OBJTYPE").val(),F4_STARTTXT: $("#F4_STARTTXT").val(), F4_LBLSTARTTXT: $("#F4_LBLSTARTTXT").val(), F4_LBLTXT: $("#F4_LBLTXT").val(), F4_LBLENDTXT: $("#F4_LBLENDTXT").val(), F4_OBJSTARTTXT: $("#F4_OBJSTARTTXT").val(), F4_OBJTXT: $("#F4_OBJTXT").val(), F4_OBJENDTXT: $("#F4_OBJENDTXT").val(), F4_ENDTXT: $("#F4_ENDTXT").val(), F4_USEYN: $("#F4_USEYN").val() },
            dataType: "json",
            success: function(data){
                msgNotice("   DetailSearch4 json return----------------------",1);
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                alog("   json RTN_MSG : " + data.RTN_MSG);
                alog("   json RTN_DATA  : " + data.RTN_DATA);


                //폼에 데이터 반영(SETVAL)
                if(data.RTN_CD == "200"){

                    //CRUD모드 new
                    $("#F4_CRUD_MODE").val("update");

                    //SETVAL
                    $("#F4_OBJTYPE").val(data.RTN_DATA.OBJTYPE);
                    $("#F4_STARTTXT").val(data.RTN_DATA.STARTTXT);
                    $("#F4_LBLSTARTTXT").val(data.RTN_DATA.LBLSTARTTXT);
                    $("#F4_LBLTXT").val(data.RTN_DATA.LBLTXT);
                    $("#F4_LBLENDTXT").val(data.RTN_DATA.LBLENDTXT);
                    $("#F4_OBJSTARTTXT").val(data.RTN_DATA.OBJSTARTTXT);
                    $("#F4_OBJTXT").val(data.RTN_DATA.OBJTXT);
                    $("#F4_OBJENDTXT").val(data.RTN_DATA.OBJENDTXT);
                    $("#F4_ENDTXT").val(data.RTN_DATA.ENDTXT);
                    $("#F4_USEYN").val(data.RTN_DATA.USEYN);

					msgNotice("[폼뷰] 조회 성공",3);

                }else{
                    msgError(data.RTN_MSG,3);
                }


                //그리드에 데이터 반영
                //saveToGrid(tgrid,data);

            },
            error: function(error){
                msgError("DetailSearch4 Error:",3);
                alog(error);
            }
        });

        addstatusyn2 = false;
        alog("DetailSearch4()------------end");

    }
    function detailSave4(){

        alog("DetailSave4()------------start");
        //serialize user data or not,
        //serialize 'selected' attribute for the rows tags,
        //serialize grid structure info,
        //serialize the 'changed' attribute for the cells tags,
        //include just changed rows to serialization,
        //serialize cell values as CDATA sections

        //전송전 입력값 validation
        if( !jsonFormValid(obj_F4_valid.OBJTYPE, "F4_OBJTYPE", "오브젝트타입", $("#F4_OBJTYPE").val()) ){return false;};
        if( !jsonFormValid(obj_F4_valid.STARTTXT, "F4_STARTTXT", "오브젝트타입", $("#F4_STARTTXT").val()) ){return false;};




        var AllData = "";

        $.ajax({
            type : "POST",
            url : url_4+"&F4_CRUD_MODE=" + $("#F4_CRUD_MODE").val() + "&" + lastinput4 ,
            data : {OBJTYPE: $("#F4_OBJTYPE").val(),STARTTXT: $("#F4_STARTTXT").val(), LBLSTARTTXT: $("#F4_LBLSTARTTXT").val(), LBLTXT: $("#F4_LBLTXT").val(), LBLENDTXT: $("#F4_LBLENDTXT").val(), OBJSTARTTXT: $("#F4_OBJSTARTTXT").val(), OBJTXT: $("#F4_OBJTXT").val(), OBJENDTXT: $("#F4_OBJENDTXT").val(), ENDTXT: $("#F4_ENDTXT").val(), USEYN: $("#F4_USEYN").val() },
            dataType: "json",
            success: function(data){
                alog("   save2 json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                alog("   json RTN_DATA  : " + data.RTN_DATA);

                //메시지 출력
                if(data.RTN_CD == "200"){
                    dhtmlx.message({
                            text: "Success save data.",
                            expire: 1000
                        });
                }else{
                    alert(data.RTN_MSG);
                }

            },
            error: function(error){
                alog("Error:");
                alog(error);
            }
        });

        addstatusyn2 = false;
        alog("DetailSave4()------------end");
    }

    </script>


</head>
<body onload="initBody();">

<div id="BODY_BOX" class="BODY_BOX">


	<div  class="GRID_LABELGRP" >
		<div class="GRID_LABEL" >* OBJINFO2 
			<!--popup--><a href="?" target="_blank"><img src="./img/popup.PNG" height=10 align=absmiddle border=0></a>
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
					<input type="radio" name="F_FILETYPE" value="HTML" id="F_FILETYPE">HTML
					<input type="radio" name="F_FILETYPE" value="SVRCTL" id="F_FILETYPE">SVRCTL
					<input type="radio" name="F_FILETYPE" value="SVRDAO" id="F_FILETYPE">SVRDAO
					
					</div>
                </div>
            </div>

            <div style="width:0px;height:0px;overflow: hidden"></form></div>
        </div>
    </div>

    <div class="GRP_LINE" >
        <div class="GRP_OBJECT" style="width:10%;height:967px">
            <div style="position: relative;width:100%;padding:0 0 0 0;text-align:right;">
	        <input type="button" name="some_name" value="Save1" onclick="save1();">
            <input type="button" name="add" value="+" onclick="addRow1();">
            <input type="button" name="delete" value="-" onclick="delRow1();">
            </div>

            <div style="position: relative;width:100%;padding:0 0 0 0;">
            <div id="grid1" width="100%"  style="height:845px;background-color:white;overflow:hidden"></div>
            </div>
        </div>

        <div class="GRP_OBJECT" style="width:90%;height:900px">
            


			<div class="GRP_LINE" >
				<div class="GRP_OBJECT" style="width:60%;">
					<div style="position: relative;width:100%;padding:0 0 0 0;text-align:right;">
					<input type="button" name="some_name" value="Save2" onclick="save2();">
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
						<input type="button" name="some_name" value="Save3" onclick="save3();">
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
						<input type="button" name="some_name" value="Save4" onclick="save4();">
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
