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
        window.open("./rst/" + getCamelCase($("#F_PGMID").val()) + "View.php");
    }
    function SourceView() {
        window.open("cg_viewtab.php?pgmid=" + $("#F_PGMID").val());
    }

    function search1(){
        //폼값 밸리데이션
        if( !jsonFormValid(obj_condition_valid.F_PJTID, "F_PJTID", "프로젝트ID", $("#F_PJTID").val()) ){return false;};
        if( !jsonFormValid(obj_condition_valid.F_PGMID, "F_PGMID", "프로그램ID", $("#F_PGMID").val()) ){return false;};


        //폼의 모든값 구하기
        var ConAllData = $( "#condition1" ).serialize();
        alog("ConAllData:" + ConAllData);

        lastCondition = ConAllData;


		lastinput1 = ConAllData;
		lastinput2 = ConAllData;


		//KEY컬럼만 자식에게 전달(grp)
		lastinput1json = jQuery.parseJSON('{ "__NAME":"lastinput1json"' +
			', "PJTID" : "' + q($("#F_PJTID").val()) + '"' +
			', "PGMID" : "' + q($("#F_PGMID").val()) + '"' +
			'}');

		//KEY컬럼만 자식에게 전달(sql)
		lastinput2json = jQuery.parseJSON('{ "__NAME":"lastinput2json"' +
			', "PJTID" : "' + q($("#F_PJTID").val()) + '"' +
			', "PGMID" : "' + q($("#F_PGMID").val()) + '"' +
			'}');

        //그리드 조회
        gridSearch1(ConAllData);

        //그리드 조회
        gridSearch2(ConAllData);

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

	//행추가2 (sql)
	function addRow2(){
		if( !(lastinput2json) || !(lastinput2json.PJTID) || !(lastinput2json.PGMID)  ){
			msgError("조회 후에 행추가 가능합니다",3);
		}else{
			var tCols = [lastinput2json.PJTID,lastinput2json.PGMID];//초기값
			addRow(mygrid2,tCols);
		}
	}

	//행추가3 (sql컬럼)
	function addRow3(){
		if( !(lastinput3json) || !(lastinput3json.PJTID) || !(lastinput3json.PGMID)  || !(lastinput3json.SQLSEQ) ){
			msgError("조회 후에 행추가 가능합니다",3);
		}else{
			var tCols = ["",lastinput3json.PJTID,lastinput3json.PGMID,lastinput3json.SQLSEQ];//초기값
			addRow(mygrid3,tCols);
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

	//행추가5 (fnc)
	function addRow5(){
		if( !(lastinput5json) || !(lastinput5json.PJTID) || !(lastinput5json.PGMID)  || !(lastinput5json.GRPID)  ){
			msgError("조회 후에 행추가 가능합니다",3);
		}else{
			var tCols = [lastinput5json.PJTID,lastinput5json.PGMID,lastinput5json.GRPID];//초기값
			addRow(mygrid5,tCols);
		}
	}

	//행추가6 (inherit)
	function addRow6(){
		if( !(lastinput6json) || !(lastinput6json.PJTID) || !(lastinput6json.PGMID)  || !(lastinput6json.GRPID)  ){
			msgError("조회 후에 행추가 가능합니다",3);
		}else{
			var tCols = ["",lastinput6json.PJTID,lastinput6json.PGMID,lastinput6json.GRPID];//초기값
			addRow(mygrid6,tCols);
		}
	}

	//행추가7 (sqlr)
	function addRow7(){
		if( !(lastinput7json) || !(lastinput7json.PJTID) || !(lastinput7json.PGMID)  || !(lastinput7json.SVCSEQ)  ){
			msgError("조회 후에 행추가 가능합니다",3);
		}else{
			var tCols = [null,lastinput7json.PJTID,lastinput7json.PGMID,lastinput7json.SVCSEQ];//초기값
			addRow(mygrid7,tCols);
		}
	}


	//행추가8 (valid)
	function addRow8(){
		if( !(lastinput8json) || !(lastinput8json.PJTID) || !(lastinput8json.PGMID)  || !(lastinput8json.GRPID) || !(lastinput8json.FNCID)  ){
			msgError("조회 후에 행추가 가능합니다",3);
		}else{
			var tCols = [null,lastinput8json.PJTID,lastinput8json.PGMID,lastinput8json.GRPID,lastinput8json.FNCID];//초기값
			addRow(mygrid8,tCols);
		}
	}

	//행추가9 (svc)
	function addRow9(){
		if( !(lastinput9json) || !(lastinput9json.PJTID) || !(lastinput9json.PGMID)  || !(lastinput9json.GRPID) || !(lastinput9json.FNCID)  ){
			msgError("조회 후에 행추가 가능합니다",3);
		}else{
			var tCols = [null,lastinput9json.PJTID,lastinput9json.PGMID,lastinput9json.GRPID,lastinput9json.FNCID];//초기값
			addRow(mygrid9,tCols);
		}
	}



    //그리드 조회
    function selectLayout(tinput){
        alog("selectLayout()------------start");

        $("#div_layout").show();

		if(!isLayoutLoaded){

			//불러오기
			$.ajax({
				type : "POST",
				url : mygrid6_url+"&G6_CRUD_MODE=read&" + lastCondition ,
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

						var tmp="";

						for(var i=0;i<data.RTN_DATA.rows.length;i++){
							alog( "   i : " + i);

							//내 행 업데이트
							tmp = tmp + "<a href=\"#\" onclick=\"selectLayoutD('" + data.RTN_DATA.rows[i].data[0] + "')\"><img src=\"./img/" + data.RTN_DATA.rows[i].data[0] +  ".png\" width=50 border=1></a> ";//LAYOUTID

						}
						//내 행 업데이트
						tmp = tmp + "<a href=\"#\" onclick=\"isLayoutLoaded=false;popSelectLayout.hide()\"><img src=\"./img/close.png\" border=0 width=15></a>";//LAYOUTID

						isLayoutLoaded=true;

						//팝업 객체 띄우기
						popSelectLayout = new dhtmlXPopup();
						popSelectLayout.attachHTML(tmp);

						var x = window.dhx4.absLeft(tinput);
						var y = window.dhx4.absTop(tinput);
						var w = tinput.offsetWidth;
						var h = tinput.offsetHeight;
						popSelectLayout.show(x,y,w,h);


					}else{
						msgError("서버 조회중 에러가 발생했습니다.\nRTN_CD : " + data.RTN_CD + "\nERR_CD : " + data.ERR_CD + "\nRTN_MSG :" + data.RTN_MSG,3);
					}


				},
				error: function(error){
					msgError("Ajax http 500 error ( " + error + " )");
					alog("Ajax http 500 error ( " + error + " )");
				}
			});
		}else{
			alog("이미지 레이아웃 로딩함");
		}
        alog("selectLayout()------------end");
    }

    //그리드 조회
    function selectLayoutD(tlayoutid){
        alog("selectLayoutD()------------start");
        alog("	tlayoutid : " + tlayoutid);

        $("#div_layout").hide();
		if(tlayoutid=="")return;

        //기존 행이 있는지 검사해서 삭제 여부 묻기
        if(mygrid1.getRowsNum() > 0 && !confirm("이미 등록된 행이 있습니다. 삭제 후 재등록 하시겠습니까?")){return}

        mygrid1.clearAll();

        //불러오기
        $.ajax({
            type : "POST",
            url : mygrid6_url+"&G6_CRUD_MODE=read2&" + lastCondition ,
            data : {xmldata : "", F_LAYOUTID : tlayoutid},
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

					var tCols;
                    for(var i=0;i<data.RTN_DATA.rows.length;i++){
                        alog( "   i : " + i);

						//GRP : PJTID,PGMID,GRPID,GRPTYPE,GRPNM		,GRPORD,FREEZECNT,COLBRCNT,REFGRPID,VBOXNO		,GRPWIDTH,GRPHEIGHT,GRPPADDING,ADDDT,MODDT
						//LAYOUT : GRPID,GRPTYPE,ORD,REFGRPID,VBOXNO,GRPWIDTH,GRPHEIGHT

						tCols = [
							lastinput1json.PJTID   //1
							,lastinput1json.PGMID
							,data.RTN_DATA.rows[i].data[0]
							,data.RTN_DATA.rows[i].data[1]
							,""
							,data.RTN_DATA.rows[i].data[2]//6
							,0
							,0
							,data.RTN_DATA.rows[i].data[3]
							,data.RTN_DATA.rows[i].data[4]
							,data.RTN_DATA.rows[i].data[5]//11
							,data.RTN_DATA.rows[i].data[6]
							,""
							,""
							,""
							];//초기값
						
						addRow(mygrid1,tCols);


                        //내 행 업데이트
                        //$("#div_layout").append("<a href=\"#\" onclick=\"selectLayoutD('" + data.RTN_DATA.rows[i].data[0] + "')\"><img src=\"./img/" + data.RTN_DATA.rows[i].data[0] +  ".png\" width=100></a>");//LAYOUTID


                    }

                }else{
                    msgError("서버 조회중 에러가 발생했습니다.\nRTN_CD : " + data.RTN_CD + "\nERR_CD : " + data.ERR_CD + "\nRTN_MSG :" + data.RTN_MSG,3);
                }


            },
            error: function(error){
				msgError("Ajax http 500 error ( " + error + " )",3);
                alog("Ajax http 500 error ( " + error + " )");
            }
        });

        alog("selectLayoutD()------------end");
    }




    //FNC 
    function getFncCode(){
        alog("getFncCode()------------start");


        //기존 행이 있는지 검사해서 삭제 여부 묻기
        if(mygrid5.getRowsNum() > 0 && !confirm("이미 등록된 행이 있습니다. 삭제 후 재등록 하시겠습니까?")){return}

        mygrid5.clearAll();

		//선택된 행의 GRPTYPE 가져오기
		var tFnc = mygrid1.cells(lastrowid1,mygrid1.getColIndexById("GRPTYPE")).getValue();
		
		alog("	tFnc :  " + tFnc);

        //불러오기
        $.ajax({
            type : "POST",
            url : mygrid8_url+"&G8_CRUD_MODE=read&" + lastinput5 + "&G1_PCD=FNC" + tFnc ,
            data : {xmldata : ""},
            dataType: "json",
            async: true,
            success: function(data){
                alog("   getFncCode json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
                    alog(JSON.stringify(data.RTN_DATA));

					var tCols;
                    for(var i=0;i<data.RTN_DATA.rows.length;i++){
                        alog( "   i : " + i);

						tCols = [
							lastinput5json.PJTID
							,lastinput5json.PGMID
							,lastinput5json.GRPID
							,"Y"
							,data.RTN_DATA.rows[i].data[0]
							,data.RTN_DATA.rows[i].data[0]
							,data.RTN_DATA.rows[i].data[1]
							,data.RTN_DATA.rows[i].data[2]
						];//초기값
						
						addRow(mygrid5,tCols);

                    }

                }else{
                    msgError("서버 조회중 에러가 발생했습니다.\nRTN_CD : " + data.RTN_CD + "\nERR_CD : " + data.ERR_CD + "\nRTN_MSG :" + data.RTN_MSG,3);
                }


            },
            error: function(error){
				msgError("Ajax http 500 error ( " + error + " )",3);
                alog("Ajax http 500 error ( " + error + " )");
            }
        });

        alog("selectLayoutD()------------end");
    }





    //SQL 
    function getSqlCode(){
        alog("getSqlCode()------------start");
        alog("	lastrowid5 : " + lastrowid5);


		tGrid = mygrid7;

        //기존 행이 있는지 검사해서 삭제 여부 묻기
        if(tGrid.getRowsNum() > 0 && !confirm("이미 등록된 행이 있습니다. 삭제 후 재등록 하시겠습니까?")){return}

        tGrid.clearAll();

		//선택된 행의 GRPTYPE 가져오기
		var tCrud = mygrid5.cells(lastrowid5,mygrid5.getColIndexById("FNCTYPE")).getValue();
		
		alog("	tCrud :  " + tCrud);

		//alert(tCrud.length);
		//return;

		var tStr = "";
		for(var i=0;i<tCrud.length;i++){
			alog( "   i : " + i);
			tStr = tCrud.substring(i,i+1);
			//SEQ,PJTID,PGMID,GRPID,FNCID,SQLID,ADDDT,MODDT
			tCols = [
				""
				,lastinput7json.PJTID
				,lastinput7json.PGMID
				,lastinput7json.GRPID
				,lastinput7json.FNCID
				,""
			];//초기값
			
			addRow(tGrid,tCols);

		}


        alog("selectLayoutD()------------end");
    }



    //SQL에서 Output컬럼 뽑아내기 
    function getColOutput(){
        alog("getColOutput()------------start");
        alog("	lastrowid4 : " + lastrowid4);


		grpGrid = mygrid1; //GRP그리드
		sqlGrid = mygrid2; //SQL그리드
		toGrid = mygrid4; //IO그리드


		if(grpGrid.getSelectedRowId() == null){
			alert("(getColOutput)그룹을 먼저 선택해 주세요");
			return;
		}

		if(sqlGrid.getSelectedRowId() == null){
			alert("(getColOutput)컬럼을 추출할 SQL을 선택해 주세요");
			return;
		}

        //기존 행이 있는지 검사해서 삭제 여부 묻기
        if(toGrid.getRowsNum() > 0 && !confirm("(getColOutput)이미 등록된 행이 있습니다. 삭제 후 재등록 하시겠습니까?")){return}

        toGrid.clearAll();

        //불러오기
        $.ajax({
            type : "POST",
            url : mygrid11_url+"&G11_CRUD_MODE=read&" + lastinput4 + "&G2_SQLSEQ=" + sqlGrid.getSelectedRowId(),
            data : {xmldata : ""},
            dataType: "json",
            async: true,
            success: function(data){
                alog("   getFncCode json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
                    alog(JSON.stringify(data.RTN_DATA));

					var tCols;
                    for(var i=0;i<data.RTN_DATA.rows.length;i++){
                        alog( "   i : " + i);


						//a.COLID,a.ORD,b.COLNM,b.DATATYPE,b.DATASIZE,b.OBJTYPE,b.LBLWIDTH,b.OBJWIDTH,b.OBJHEIGHT
						tCols = [
							lastinput4json.PJTID
							,lastinput4json.PGMID
							,lastinput4json.GRPID
							,data.RTN_DATA.rows[i].data[0] //COLID
							,data.RTN_DATA.rows[i].data[1] //COLORD
							,data.RTN_DATA.rows[i].data[2] //COLNM
							,data.RTN_DATA.rows[i].data[3] //DATTYPE
							,data.RTN_DATA.rows[i].data[4] //DATASIZE
							,data.RTN_DATA.rows[i].data[5] //OBJTYPE
							,"N" //BRYN
							,"N" //LBLHIDDENYN
							,data.RTN_DATA.rows[i].data[6] //LBLWIDTH
							,data.RTN_DATA.rows[i].data[7] //OBJWIDTH
							,data.RTN_DATA.rows[i].data[8] //OBJHEIGHT
							,"N" //KEYYN
							,"N" //SEQYN
							,"N" //HIDDENYN
						];//초기값
						
						addRow(toGrid,tCols);

                    }

                }else{
                    msgError("서버 조회중 에러가 발생했습니다.\nRTN_CD : " + data.RTN_CD + "\nERR_CD : " + data.ERR_CD + "\nRTN_MSG :" + data.RTN_MSG,3);
                }


            },
            error: function(error){
				msgError("Ajax http 500 error ( " + error + " )",3);
                alog("Ajax http 500 error ( " + error + " )");
            }
        });


        alog("selectLayoutD()------------end");
    }



    //그리드 조회
    function gridSearch1(tinput){
        alog("gridSearch1()------------start");

        //그리드 초기화
        mygrid1.clearAll();

        //불러오기
        $.ajax({
            type : "POST",
            url : mygrid1_url+"&G1_CRUD_MODE=read&" + tinput ,
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
    function gridSearch2(tinput){
        alog("gridSearch2()------------start");

        //그리드 초기화
        mygrid2.clearAll();

        //불러오기
        $.ajax({
            type : "POST",
            url : mygrid2_url+"&G2_CRUD_MODE=read&" + tinput ,
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
					var row_cnt = 0;
					if(data.RTN_DATA){
						mygrid2.parse(data.RTN_DATA,"json");
						row_cnt = data.RTN_DATA.rows.length;
					}

					msgNotice("[SQL] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[SQL] 서버 조회중 에러가 발생했습니다.\nRTN_CD : " + data.RTN_CD + "\nERR_CD : " + data.ERR_CD + "\nRTN_MSG :" + data.RTN_MSG,3);
                }


            },
            error: function(error){
				msgError("[SQL] Ajax http 500 error ( " + error + " )",3);
                alog("[SQL] Ajax http 500 error ( " + error + " )");
            }
        });

        alog("gridSearch2()------------end");
    }

    //그리드 조회
    function gridSearch3(tinput){
        alog("gridSearch3()------------start");

        //그리드 초기화
        mygrid3.clearAll();

        //불러오기
        $.ajax({
            type : "POST",
            url : mygrid3_url+"&G3_CRUD_MODE=read&" + tinput ,
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
					var row_cnt = 0;
					if(data.RTN_DATA){
						mygrid3.parse(data.RTN_DATA,"json");
						row_cnt = data.RTN_DATA.rows.length;
					}
					msgNotice("[SQL COLUMN] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[SQL COLUMN] 서버 조회중 에러가 발생했습니다.\nRTN_CD : " + data.RTN_CD + "\nERR_CD : " + data.ERR_CD + "\nRTN_MSG :" + data.RTN_MSG,3);
                }


            },
            error: function(error){
				msgError("[SQL COLUMN] Ajax http 500 error ( " + error + " )",3);
                alog("[SQL COLUMN] Ajax http 500 error ( " + error + " )");
            }
        });

        alog("gridSearch3()------------end");
    }


	//그리드 다시 조회
	function gridReload4(){
		gridSearch4(lastinput4);
	}

	//그리드 다시 조회
	function gridReload2(){
		gridSearch2(lastinput2);
	}

    //그리드 조회
    function gridSearch4(tinput){
        alog("gridSearch4()------------start");

        //그리드 초기화
        mygrid4.clearAll();

        //불러오기
        $.ajax({
            type : "POST",
            url : mygrid4_url+"&G4_CRUD_MODE=read&" + tinput ,
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


    //그리드 조회(FNC)
    function gridSearch5(tinput){
        alog("gridSearch5()------------start");

        //그리드 초기화
        mygrid5.clearAll();

        //불러오기
        $.ajax({
            type : "POST",
            url : mygrid7_url+"&G7_CRUD_MODE=read&" + tinput ,
            data : {xmldata : ""},
            dataType: "json",
            async: true,
            success: function(data){
                alog("   gridSearch5 json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
					var row_cnt = 0;
					if(data.RTN_DATA){
						mygrid5.parse(data.RTN_DATA,"json");
						row_cnt = data.RTN_DATA.rows.length;
					}
					msgNotice("[FNC] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[FNC] 서버 조회중 에러가 발생했습니다.\nRTN_CD : " + data.RTN_CD + "\nERR_CD : " + data.ERR_CD + "\nRTN_MSG :" + data.RTN_MSG,3);
                }


            },
            error: function(error){
				msgError("[FNC] Ajax http 500 error ( " + error + " )",3);
                alog("[FNC] Ajax http 500 error ( " + error + " )");
            }
        });

        alog("gridSearch5()------------end");
    }




    //그리드 조회(INHERIT)
    function gridSearch6(tinput){
        alog("gridSearch6()------------start");

		var tGrid = mygrid6;

        //그리드 초기화
        tGrid.clearAll();

        //불러오기
        $.ajax({
            type : "POST",
            url : mygrid9_url+"&G9_CRUD_MODE=read&" + tinput ,
            data : {xmldata : ""},
            dataType: "json",
            async: true,
            success: function(data){
                alog("   gridSearch6 json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
					var row_cnt = 0;
					if(data.RTN_DATA){
						tGrid.parse(data.RTN_DATA,"json");
						row_cnt = data.RTN_DATA.rows.length;
					}
					msgNotice("[INHERIT] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[INHERIT] 서버 조회중 에러가 발생했습니다.\nRTN_CD : " + data.RTN_CD + "\nERR_CD : " + data.ERR_CD + "\nRTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[INHERIT] Ajax http 500 error ( " + error + " )",3);
                alog("[INHERIT] Ajax http 500 error ( " + error + " )");
            }
        });

        alog("gridSearch6()------------end");
    }





    //그리드 조회(SQLR)
    function gridSearch7(tinput){
        alog("gridSearch7()------------start");

		var tGrid = mygrid7;

        //그리드 초기화
        tGrid.clearAll();

        //불러오기
        $.ajax({
            type : "POST",
            url : mygrid10_url+"&G10_CRUD_MODE=read&" + tinput ,
            data : {xmldata : ""},
            dataType: "json",
            async: true,
            success: function(data){
                alog("   gridSearch6 json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
					var row_cnt = 0;
					if(data.RTN_DATA){
						tGrid.parse(data.RTN_DATA,"json");
						row_cnt = data.RTN_DATA.rows.length;
					}
					msgNotice("[SQLR] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[SQLR] 서버 조회중 에러가 발생했습니다.\nRTN_CD : " + data.RTN_CD + "\nERR_CD : " + data.ERR_CD + "\nRTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[SQLR] Ajax http 500 error ( " + error + " )",3);
                alog("[SQLR] Ajax http 500 error ( " + error + " )");
            }
        });

        alog("gridSearch7()------------end");
    }

   


    //그리드 조회(SVC)
    function gridSearch9(tinput){
        alog("gridSearch9()------------start");

		var tGrid = mygrid9;

        //그리드 초기화
        tGrid.clearAll();

        //불러오기
        $.ajax({
            type : "POST",
            url : mygrid13_url+"&G13_CRUD_MODE=read&" + tinput ,
            data : {xmldata : ""},
            dataType: "json",
            async: true,
            success: function(data){
                alog("   gridSearch9 json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
					var row_cnt = 0;
					if(data.RTN_DATA){
						tGrid.parse(data.RTN_DATA,"json");
						row_cnt = data.RTN_DATA.rows.length;
					}
					msgNotice("[SVC] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[SVC] 서버 조회중 에러가 발생했습니다.\nRTN_CD : " + data.RTN_CD + "\nERR_CD : " + data.ERR_CD + "\nRTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[SVC] Ajax http 500 error ( " + error + " )",3);
                alog("[SVC] Ajax http 500 error ( " + error + " )");
            }
        });

        alog("gridSearch9()------------end");
    }





    function addRow1Layout(tGRPID,tGRPTYPE,tGRPORD,tVBOXNO,tGRPWIDTH,tGRPHEIGHT){
        alog("addRow1Layout()------------start");
        var id=mygrid1.uid();
		var tREFGRPID = "";
		if(tGRPORD > 1)tREFGRPID = "GRP" + (tGRPORD-1);
        mygrid1.addRow(id,["GRP"+tGRPORD,tGRPTYPE,tGRPTYPE+tGRPORD,tGRPORD,0,0,tREFGRPID,tVBOXNO,tGRPWIDTH,tGRPHEIGHT],0);
        mygrid1.showRow(id);
        mygrid1.selectRow(0);
        mygrid1.cells(id,0).cell.wasChanged = true;
        mygrid1.setUserData(id,"!nativeeditor_status","inserted");
        mygrid1.setRowTextBold(id);
        addstatusyn1 = true;
        alog("addRow1Layout()------------end");
    }


    function saveAll(){
        alog("saveAll()------------start");
        save1();
        save2();
        save3();
        save4();
        addstatusyn1 = false;
        addstatusyn2 = false;
        addstatusyn3 = false;
        addstatusyn4 = false;
        alog("saveAll()------------end");
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

        tgrid.setSerializationLevel(true,false,false,false,true,false);
        //mygrid4.serialize();
        var myXmlString = tgrid.serialize();

        tgrid.setSerializationLevel(true,false,false,false,false,false);
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
            url : mygrid1_url+"&G1_CRUD_MODE=SAVE&" + lastinput2 ,
            data : {xmldata : myXmlString},
            dataType: "json",
            async: false,
            success: function(data){
                alog("   json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                saveToGrid(tgrid,data);

            },
            error: function(error){
				msgError("Ajax http 500 error ( " + error + " )");
                alog("Ajax http 500 error ( " + error + " )");
            }
        });

        addstatusyn2 = false;
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

        mygrid2.setSerializationLevel(true,false,false,false,true,false);
        //mygrid4.serialize();
        var myXmlString = mygrid2.serialize();

        mygrid2.setSerializationLevel(true,false,false,false,false,false);
        //mygrid4.serialize();
        var myXmlString2 = mygrid2.serialize();

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
            url : mygrid2_url+"&G2_CRUD_MODE=SAVE&" + lastinput2 ,
            data : {xmldata : myXmlString},
            dataType: "json",
            async: false,
            success: function(data){
                alog("   json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                saveToGrid(mygrid2,data);

            },
            error: function(error){
				msgError("Ajax http 500 error ( " + error + " )");
                alog("Ajax http 500 error ( " + error + " )");
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

        mygrid3.setSerializationLevel(true,false,false,false,true,false);
        //mygrid4.serialize();
        var myXmlString = mygrid3.serialize();


        //alog("xml : " + myXmlString);

        //컨디션 데이터 모두 말기
        var ConAllData = $( "#condition1" ).serialize();
        alog("   ConAllData = " + ConAllData);

        var xml = myXmlString;
        xml = xml.replace(new RegExp("<row","g"),"\n<row");
        xml = xml.replace(new RegExp("</row","g"),"\n</row");
        xml = xml.replace(new RegExp("<cell","g"),"\n\t<cell");

        $("#tt").val(xml);


        $.ajax({
            type : "POST",
            url : mygrid3_url+"&G3_CRUD_MODE=SAVE&" + lastinput3 ,
            data : {xmldata : myXmlString},
            dataType: "json",
            async: false,
            success: function(data){
                alog("   json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                saveToGrid(mygrid3,data);

            },
            error: function(error){
				msgError("Ajax http 500 error ( " + error + " )");
                alog("Ajax http 500 error ( " + error + " )");
            }
        });

        addstatusyn3 = false;
        alog("save3()------------end");
    }




    function save5(){
        alog("save5()------------start");

        mygrid5.setSerializationLevel(true,false,false,false,true,false);
        var myXmlString = mygrid5.serialize();

		//컨디션 데이터 모두 말기
        var ConAllData = $( "#condition1" ).serialize();
        alog("   ConAllData = " + ConAllData);

        var xml = myXmlString;
        xml = xml.replace(new RegExp("<row","g"),"\n<row");
        xml = xml.replace(new RegExp("</row","g"),"\n</row");
        xml = xml.replace(new RegExp("<cell","g"),"\n\t<cell");

        $("#tt").val(xml);

        $.ajax({
            type : "POST",
            url : mygrid7_url+"&G7_CRUD_MODE=SAVE&" + lastinput5 ,
            data : {xmldata : myXmlString},
            dataType: "json",
            async: false,
            success: function(data){
                alog("   json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                saveToGrid(mygrid5,data);
            },
            error: function(error){
				msgError("Ajax http 500 error ( " + error + " )");
                alog("Ajax http 500 error ( " + error + " )");
            }
        });

        addstatusyn3 = false;
        alog("save3()------------end");
    }





    function save6(){
        alog("save6()------------start");

        mygrid6.setSerializationLevel(true,false,false,false,true,false);
        var myXmlString = mygrid6.serialize();

		//컨디션 데이터 모두 말기
        var ConAllData = $( "#condition1" ).serialize();
        alog("   ConAllData = " + ConAllData);

        var xml = myXmlString;
        xml = xml.replace(new RegExp("<row","g"),"\n<row");
        xml = xml.replace(new RegExp("</row","g"),"\n</row");
        xml = xml.replace(new RegExp("<cell","g"),"\n\t<cell");

        $("#tt").val(xml);

        $.ajax({
            type : "POST",
            url : mygrid9_url+"&G9_CRUD_MODE=SAVE&" + lastinput5 ,
            data : {xmldata : myXmlString},
            dataType: "json",
            async: false,
            success: function(data){
                alog("   json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                saveToGrid(mygrid6,data);
            },
            error: function(error){
				msgError("[INHERIT SAVE] Ajax http 500 error ( " + error + " )",3);
                alog("Ajax http 500 error ( " + error + " )");
            }
        });

        addstatusyn6 = false;
        alog("save6()------------end");
    }


    function save7(){
        alog("save7()------------start");

        mygrid7.setSerializationLevel(true,false,false,false,true,false);
        var myXmlString = mygrid7.serialize();

		//컨디션 데이터 모두 말기
        var ConAllData = $( "#condition1" ).serialize();
        alog("   ConAllData = " + ConAllData);

        var xml = myXmlString;
        xml = xml.replace(new RegExp("<row","g"),"\n<row");
        xml = xml.replace(new RegExp("</row","g"),"\n</row");
        xml = xml.replace(new RegExp("<cell","g"),"\n\t<cell");

        $("#tt").val(xml);

        $.ajax({
            type : "POST",
            url : mygrid10_url+"&G10_CRUD_MODE=SAVE&" + lastinput5 ,
            data : {xmldata : myXmlString},
            dataType: "json",
            async: false,
            success: function(data){
                alog("   json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                saveToGrid(mygrid7,data);
            },
            error: function(error){
				msgError("[SQLR SAVE] Ajax http 500 error ( " + error + " )",3);
                alog("Ajax http 500 error ( " + error + " )");
            }
        });

        addstatusyn7 = false;
        alog("save7()------------end");
    }


    function save8(){
        alog("save8()------------start");

        mygrid8.setSerializationLevel(true,false,false,false,true,false);
        var myXmlString = mygrid8.serialize();

		//컨디션 데이터 모두 말기
        var ConAllData = $( "#condition1" ).serialize();
        alog("   ConAllData = " + ConAllData);

        var xml = myXmlString;
        xml = xml.replace(new RegExp("<row","g"),"\n<row");
        xml = xml.replace(new RegExp("</row","g"),"\n</row");
        xml = xml.replace(new RegExp("<cell","g"),"\n\t<cell");

        $("#tt").val(xml);

        $.ajax({
            type : "POST",
            url : mygrid12_url+"&G12_CRUD_MODE=SAVE&" + lastinput8 ,
            data : {xmldata : myXmlString},
            dataType: "json",
            async: false,
            success: function(data){
                alog("   json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                saveToGrid(mygrid7,data);
            },
            error: function(error){
				msgError("[VALID] Ajax http 500 error ( " + error + " )",3);
                alog("[VALID] Ajax http 500 error ( " + error + " )");
            }
        });

        addstatusyn8 = false;
        alog("save8()------------end");
    }



	//SVC
    function save9(){
        alog("save9()------------start");

        mygrid9.setSerializationLevel(true,false,false,false,true,false);
        var myXmlString = mygrid9.serialize();

		//컨디션 데이터 모두 말기
        var ConAllData = $( "#condition1" ).serialize();
        alog("   ConAllData = " + ConAllData);

        var xml = myXmlString;
        xml = xml.replace(new RegExp("<row","g"),"\n<row");
        xml = xml.replace(new RegExp("</row","g"),"\n</row");
        xml = xml.replace(new RegExp("<cell","g"),"\n\t<cell");

        $("#tt").val(xml);

        $.ajax({
            type : "POST",
            url : mygrid13_url+"&G13_CRUD_MODE=SAVE&" + lastinput9 ,
            data : {xmldata : myXmlString},
            dataType: "json",
            async: false,
            success: function(data){
                alog("   json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                saveToGrid(mygrid9,data);
            },
            error: function(error){
				msgError("[SVC] Ajax http 500 error ( " + error + " )",3);
                alog("[SVC] Ajax http 500 error ( " + error + " )");
            }
        });

        addstatusyn9 = false;
        alog("save9()------------end");
    }


    function loadxml(){
        //serialize user data or not,
        //serialize 'selected' attribute for the rows tags,
        //serialize grid structure info,
        //serialize the 'changed' attribute for the cells tags,
        //include just changed rows to serialization,
        //serialize cell values as CDATA sections

        tgrid = mygrid4;

        tgrid.setSerializationLevel(true,false,false,true,false,false);

        //mygrid4.serialize();
        var myXmlString = tgrid.serialize();

        var xml = myXmlString;
        xml = xml.replace(new RegExp("<row","g"),"\n<row");
        xml = xml.replace(new RegExp("</row","g"),"\n</row");
        xml = xml.replace(new RegExp("<cell","g"),"\n\t<cell");

        $("#tt").val(xml);


        tgrid.setSerializationLevel(true,false,false,true,true,false);

        //mygrid4.serialize();
        var myXmlString = tgrid.serialize();

        var xml = myXmlString;
        xml = xml.replace(new RegExp("<row","g"),"\n<row");
        xml = xml.replace(new RegExp("</row","g"),"\n</row");
        xml = xml.replace(new RegExp("<cell","g"),"\n\t<cell");

        $("#tt2").val(xml);
    }


    function save4(){
        alog("save4()------------start");
        //dp4.sendData();


        //serialize user data or not,
        //serialize 'selected' attribute for the rows tags,
        //serialize grid structure info,
        //serialize the 'changed' attribute for the cells tags,
        //include just changed rows to serialization,
        //serialize cell values as CDATA sections

        mygrid4.setSerializationLevel(true,false,false,false,true,false);
        //mygrid4.serialize();
        var myXmlString = mygrid4.serialize();


        //alog("xml : " + myXmlString);

        //컨디션 데이터 모두 말기
        var ConAllData = $( "#condition1" ).serialize();
        alog("   ConAllData = " + ConAllData);

        var xml = myXmlString;
        xml = xml.replace(new RegExp("<row","g"),"\n<row");
        xml = xml.replace(new RegExp("</row","g"),"\n</row");
        xml = xml.replace(new RegExp("<cell","g"),"\n\t<cell");

        $("#tt").val(xml);


        $.ajax({
            type : "POST",
            url : mygrid4_url+"&G4_CRUD_MODE=save&" + lastinput4 ,
            data : {xmldata : myXmlString},
            dataType: "json",
            async: false,
            success: function(data){
                alog("   json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                saveToGrid(mygrid4,data);

            },
            error: function(error){
				msgError("Ajax http 500 error ( " + error + " )");
                alog("Ajax http 500 error ( " + error + " )");
            }
        });

        addstatusyn4 = false;
        alog("save4()------------end");
    }






    //정적 변수 선언
	var popSelectLayout; //레이아웃용
    var myCalendar;
    var lastCondition;
    var mygrid1,dp1,addstatusyn1,lastinput1,lastinput1json,lastrowid1;
    var mygrid2,dp2,addstatusyn2,lastinput2,lastinput2json,lastrowid2;
    var mygrid3,dp3,addstatusyn3,lastinput3,lastinput3json,lastrowid3;
    var mygrid4,dp4,addstatusyn4,lastinput4,lastinput4json,lastrowid4;
    var mygrid5,dp5,addstatusyn5,lastinput5,lastinput5json,lastrowid5;
    var mygrid6,dp6,addstatusyn6,lastinput6,lastinput6json,lastrowid6;
    var mygrid7,dp7,addstatusyn7,lastinput7,lastinput7json,lastrowid7;
    var mygrid8,dp8,addstatusyn8,lastinput8,lastinput8json,lastrowid8;
    var mygrid9,dp9,addstatusyn9,lastinput9,lastinput9json,lastrowid9;
    var mygrid1_url = "cg_pgminfo_crud2.php?F_GRPID=1&";
    var mygrid2_url = "cg_pgminfo_crud2.php?F_GRPID=2&";
    var mygrid3_url = "cg_pgminfo_crud2.php?F_GRPID=3&";
    var mygrid4_url = "cg_pgminfo_crud2.php?F_GRPID=4&";
    var mygrid5_url = "cg_pgminfo_crud2.php?F_GRPID=5&";
    var mygrid6_url = "cg_pgminfo_crud2.php?F_GRPID=6&";
    var mygrid7_url = "cg_pgminfo_crud2.php?F_GRPID=7&";
    var mygrid8_url = "cg_pgminfo_crud2.php?F_GRPID=8&";
    var mygrid9_url = "cg_pgminfo_crud2.php?F_GRPID=9&";
    var mygrid10_url = "cg_pgminfo_crud2.php?F_GRPID=10&";
    var mygrid11_url = "cg_pgminfo_crud2.php?F_GRPID=11&"; //IO그리드, COL그리드에서 상속받기
    var mygrid12_url = "cg_pgminfo_crud2.php?F_GRPID=12&"; //VALID
    var mygrid13_url = "cg_pgminfo_crud2.php?F_GRPID=13&"; //SVC
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
        //$("#F_PJTID").val("CG");
        //$("#F_PGMID").val("TEST3");
        $("#F_PJTSEQ").val("3");
        $("#F_PGMSEQ").val("20");

        //날짜 박스 초기
        alog("initBody()---------start")
        myCalendar = new dhtmlXCalendarObject([{input:"F_START_DT",
            button:"F_START_DT_ICON"},{input:"F_END_DT",
            button:"F_END_DT_ICON"}]);

        //코드 미러 초기화
        cm = CodeMirror.fromTextArea(document.getElementById('code'), {
            mode: "text/x-sql",
            styleActiveLine: true,
            indentWithTabs: true,
            smartIndent: true,
            lineNumbers: true,
            matchBrackets : true,
            tabSize: 4,
            indentUnit: 4,
            indentWithTabs: true,
			extraKeys: {"Ctrl-Space": "autocomplete"},
			hintOptions: {tables: {
			  users: {name: null, score: null, birthDate: null},
			  countries: {name: null, population: null, size: null}
			}}
        });

        cm.on("change", function(cm, change) {
            alog("cm change -------------------------------start");
            alog("    cm.getValue :  (" + cm.getValue() + ")");
            alog("    change.origin : (" + change.origin + ")");
            alog("    change.from : (" + change.to + ")");
            alog("    change.text : (" + change.text + ")");
            alog("    change.removed : (" + change.removed + ")");
            alog("    change.to : (" + change.to + ")");

            //바인드 정보로 리턴하기
            if(change.origin != "setValue"){

                alog("    mygrid2 SQLTXT 변경 상태 업데이트. ");
                rid = mygrid2.getSelectedId();
                cidx = mygrid2.getColIndexById("SQLTXT");
                alog("        " + rid + "," + cidx);
                mygrid2.cells(rid,cidx).setValue(cm.getValue());
                mygrid2.cells(rid,cidx).cell.wasChanged = true;
	            RowEditStatus = mygrid2.getUserData(rid,"!nativeeditor_status");
				if( RowEditStatus != "inserted" && RowEditStatus != "deleted"){
					mygrid2.setUserData(rid,"!nativeeditor_status","updated");
					mygrid2.setRowTextBold(rid);
				}	
            }

        });
        cm.on("focus", function() {
            alog("cm focus -------------------------------start");
            rid = mygrid2.getSelectedId();

            alog("       rid : " + rid);

            if(rid == null)alert("변경할 Row를 선택해 주세요.");
        });

        cm.on("blur", function() {
            alog("cm blur -------------------------------start");
        });

        //그리드 초기화(Group)
        mygrid1 = new dhtmlXGridObject('grid1');
		mygrid1.setUserData("","gridTitle","grid1 : group list"); //글로별 변수에 그리드 타이블 넣기
        mygrid1.setImagePath("./lib/dhtmlxSuite/codebase/imgs/");
        mygrid1.setHeader("PJTID,PGMID,GRPID,GRPTYPE,GRPNM,ORD,FREEZECNT,COLBRCNT,REFGRPID,VBOXNO,GRPWIDTH,GRPHEIGHT,COLSIZETYPE,ADDDT,MODDT");
        mygrid1.setColumnIds("PJTID,PGMID,GRPID,GRPTYPE,GRPNM,GRPORD,FREEZECNT,COLBRCNT,REFGRPID,VBOXNO,GRPWIDTH,GRPHEIGHT,COLSIZETYPE,ADDDT,MODDT");
        mygrid1.setInitWidths("50,50,50,50,50,30,50,50,50,50,50,50,50,50,50")
        mygrid1.setColTypes("ed,ed,ed,coro,ed,ed,ed,ed,ed,ed,ed,ed,coro,ro,ro");
		mygrid1.setColSorting("str,str,str,str,str,int,int,int,int,str,str,str,str,str");

		mygrid1.enableSmartRendering(false);
        mygrid1.enableMultiselect(true);
		//GRPTYPE 콤보
		setCodeCombo("GRID",mygrid1.getCombo(mygrid1.getColIndexById("GRPTYPE")),"GRPTYPE");
		setCodeCombo("GRID",mygrid1.getCombo(mygrid1.getColIndexById("COLSIZETYPE")),"COLSIZETYPE");

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
            lastinput6 = RowAllData + "&" + ConAllData;
            lastinput5 = RowAllData + "&" + ConAllData;
			lastinput4 = RowAllData + "&" + ConAllData;


            //KEY컬럼만 자식에게 전달
            lastinput6json = jQuery.parseJSON('{ "__NAME":"lastinput6json"' +
                ', "PJTID" : "' + q(mygrid1.cells(lastrowid1,0).getValue()) + '"' +
                ', "PGMID" : "' + q(mygrid1.cells(lastrowid1,1).getValue()) + '"' +
                ', "GRPID" : "' + q(mygrid1.cells(lastrowid1,2).getValue()) + '"' +
                '}');

            lastinput5json = jQuery.parseJSON('{ "__NAME":"lastinput5json"' +
                ', "PJTID" : "' + q(mygrid1.cells(lastrowid1,0).getValue()) + '"' +
                ', "PGMID" : "' + q(mygrid1.cells(lastrowid1,1).getValue()) + '"' +
                ', "GRPID" : "' + q(mygrid1.cells(lastrowid1,2).getValue()) + '"' +
                '}');

            lastinput4json = jQuery.parseJSON('{ "__NAME":"lastinput4json"' +
                ', "PJTID" : "' + q(mygrid1.cells(lastrowid1,0).getValue()) + '"' +
                ', "PGMID" : "' + q(mygrid1.cells(lastrowid1,1).getValue()) + '"' +
                ', "GRPID" : "' + q(mygrid1.cells(lastrowid1,2).getValue()) + '"' +
                '}');

            //그리드 2번 조회
            gridSearch5(lastinput5);

            //그리드 4번 조회
            gridSearch4(lastinput4);

            //그리드 5번 조회
            gridSearch6(lastinput6);


            alog("mygrid1 - onRowSelect ----------end");
        });
        mygrid1.attachEvent("onBeforeSorting", function(ind,type,direction){
            //any custom logic here
            return !addstatusyn1;
        });


        mygrid1.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){

            //alog("mygrid1  onEditCell ------------------start");
            //alog("       stage : " + stage);
            //alog("       rId : " + rId);
            //alog("       cInd : " + cInd);
            //alog("       nValue : " + nValue);
            //alog("       oValue : " + oValue);

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




        //2번째 그리드 초기화(sql)
        mygrid2 = new dhtmlXGridObject('grid2');
		mygrid2.setUserData("","gridTitle","grid2 : sql list"); //글로별 변수에 그리드 타이블 넣기
        mygrid2.setImagePath("./lib/dhtmlxSuite/codebase/imgs/");
        mygrid2.setHeader("PJTID,PGMID,SQLSEQ,SQLID,SQLNM,CRUD,RTN_TYPE,SQLORD,SQLTXT,ADDDT,MODDT");
        mygrid2.setColumnIds("PJTID,PGMID,SQLSEQ,SQLID,SQLNM,CRUD,RTN_TYPE,SQLORD,SQLTXT,ADDDT,MODDT");
        //mygrid2.attachHeader("#connector_text_filter,#connector_text_filter,#connector_text_filter,#connector_text_filter")
        mygrid2.setInitWidths("50,50,50,50,50,50,50,50,50,50,50")
        mygrid2.setColTypes("ro,ed,ro,ed,ed,coro,coro,ed,txt,ro,ro");
        mygrid2.setColAlign("left,left,left,left,left,left,,left,left,left,left,left")
		mygrid2.setColSorting("str,str,int,str,str,str,str,int,str,str,str");

        //mygrid2.setColumnHidden(0,true);
        //mygrid2.isColumnHidden(0);//PJTID숨기기

        mygrid2.enableSmartRendering(false);
        mygrid2.enableMultiselect(true);

		//GRPTYPE 콤보
		setCodeCombo("GRID",mygrid2.getCombo(mygrid2.getColIndexById("CRUD")),"CRUD");
		setCodeCombo("GRID",mygrid2.getCombo(mygrid2.getColIndexById("RTN_TYPE")),"RTN_TYPE");

        mygrid2.init();

        mygrid2.setColumnHidden(0,true); //PJTID
        mygrid2.setColumnHidden(1,true); //PGMID


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
            lastinput3json = jQuery.parseJSON('{ "__NAME":"lastinput3json"' +
                ', "PJTID" : "' + q(mygrid2.cells(lastrowid2,0).getValue()) + '"' +
                ', "PGMID" : "' + q(mygrid2.cells(lastrowid2,1).getValue()) + '"' +
                ', "SQLSEQ" : "' + q(mygrid2.cells(lastrowid2,2).getValue()) + '"' +
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

        mygrid2.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){

            //alog("mygrid2  onEditCell ------------------start");
            //alog("       stage : " + stage);
            //alog("       rId : " + rId);
            //alog("       cInd : " + cInd);
            //alog("       nValue : " + nValue);
            //alog("       oValue : " + oValue);

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

        //mygrid2.loadXML("cg_pjtinfo_crud2.php");




        //5번째 그리드 초기화 (fnc)
        mygrid5 = new dhtmlXGridObject('grid5');
		mygrid5.setUserData("","gridTitle","grid5 : fnc list"); //글로별 변수에 그리드 타이블 넣기
        mygrid5.setImagePath("./lib/dhtmlxSuite/codebase/imgs/");
        mygrid5.setHeader("PJTID,PGMID,GRPID,USE,FNCID,FNCCD,FNCNM,FNCTYPE,BTNWIDTH,ORD,ADDDT,MODDT");
        mygrid5.setColumnIds("PJTID,PGMID,GRPID,USEYN,FNCID,FNCCD,FNCNM,FNCTYPE,BTNWIDTH,FNCORD,ADDDT,MODDT");
        mygrid5.setInitWidths("50,50,50,35,50,50,50,50,50,50,40,50,50");
        mygrid5.setColTypes("ed,ed,ed,ch,ed,coro,ed,ed,ed,ed,ed,ro,ro");
        mygrid5.setColAlign("left,left,left,center,left,left,left,left,left,left,left,left,left");
		mygrid5.setColSorting("str,str,str,str,str,str,str,str,str,int,int,str,str");

        //mygrid2.isColumnHidden(0);//PJTID숨기기

        mygrid5.enableSmartRendering(false);
        mygrid5.enableMultiselect(true);

		//GRPTYPE 콤보
		setCodeCombo("GRID",mygrid5.getCombo(mygrid5.getColIndexById("FNCCD")),"FNC");

        mygrid5.init();

        mygrid5.setColumnHidden(0,true); //PJTID
		mygrid5.setColumnHidden(1,true); //PGMID
        mygrid5.setColumnHidden(2,true); //GRPID

		mygrid5.attachEvent("onCheck", function(rId,cInd,state){
			// your code here
            alog("mygrid5 - onCheck ----------start");
            alog("   rId = " + rId);
            alog("   cInd= " + cInd);
            alog("   state = " + state);

			mygrid5.cells(rId,cInd).cell.wasChanged=true;//변경 상태 업데이트
			mygrid5.setRowTextBold(rId);//변경 상태 업데이트
			mygrid5.setUserData(rId,"!nativeeditor_status","updated");//변경 상태 업데이트

		});
        mygrid5.attachEvent("onRowSelect",function(rowID,celInd){
            alog("mygrid5 - onRowSelect ----------start");
            alog("   rowID = " + rowID);
            alog("   celInd = " + celInd);


            lastrowid5 = rowID;

            //선택된 ROW의 모든컬럼 추출하기
            var RowAllData;
            RowAllData = getRowsColid(mygrid5,rowID,"G5");
            alog("   RowAllData = " + RowAllData);



            var ConAllData = $( "#condition1" ).serialize();
            alog("   ConAllData = " + ConAllData);

            //(SVC) 마지막 전송 정보 저장
            lastinput9 = RowAllData + "&" + ConAllData;

            //(VALID) 마지막 전송 정보 저장
            lastinput8 = RowAllData + "&" + ConAllData;

			//(SVC) KEY컬럼만 자식에게 전달
            lastinput9json = jQuery.parseJSON('{ "__NAME":"lastinput9json"' +
                ', "PJTID" : "' + q(mygrid5.cells(lastrowid5,0).getValue()) + '"' +
                ', "PGMID" : "' + q(mygrid5.cells(lastrowid5,1).getValue()) + '"' +
                ', "GRPID" : "' + q(mygrid5.cells(lastrowid5,2).getValue()) + '"' +
                ', "FNCID" : "' + q(mygrid5.cells(lastrowid5,4).getValue()) + '"' +
                '}');

			//(VALID) KEY컬럼만 자식에게 전달
            lastinput8json = jQuery.parseJSON('{ "__NAME":"lastinput8json"' +
                ', "PJTID" : "' + q(mygrid5.cells(lastrowid5,0).getValue()) + '"' +
                ', "PGMID" : "' + q(mygrid5.cells(lastrowid5,1).getValue()) + '"' +
                ', "GRPID" : "' + q(mygrid5.cells(lastrowid5,2).getValue()) + '"' +
                ', "FNCID" : "' + q(mygrid5.cells(lastrowid5,3).getValue()) + '"' +
                '}');

            //(SVC) 그리드 조회
            gridSearch9(lastinput9);


            alog("mygrid5 - onRowSelect ----------end");
        });
        mygrid5.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){

            //alog("mygrid5  onEditCell ------------------start");
            //alog("       stage : " + stage);
            //alog("       rId : " + rId);
            //alog("       cInd : " + cInd);
            //alog("       nValue : " + nValue);
            //alog("       oValue : " + oValue);

            RowEditStatus = mygrid5.getUserData(rId,"!nativeeditor_status");
            if(stage == 2
                && RowEditStatus != "inserted"
                && RowEditStatus != "deleted"
                && nValue != oValue
                ){
                if(RowEditStatus == "") {
                    mygrid5.setUserData(rId,"!nativeeditor_status","updated");
                    mygrid5.setRowTextBold(rId);
                }
                mygrid5.cells(rId,cInd).cell.wasChanged = true;
            }
            return true;

        });
        //mygrid2.loadXML("cg_pjtinfo_crud2.php");


        //6번째 그리드 초기화 (inherrit)
        mygrid6 = new dhtmlXGridObject('grid6');
		mygrid6.setUserData("","gridTitle","grid6 : inherrit list"); //글로별 변수에 그리드 타이블 넣기
        mygrid6.setImagePath("./lib/dhtmlxSuite/codebase/imgs/");
        mygrid6.setHeader("INHERITSEQ,PJTID,PGMID,GRPID,COLID,CHILDGRPID,FILTERYN,VALUEYN,ADDDT,MODDT");
        mygrid6.setColumnIds("INHERITSEQ,PJTID,PGMID,GRPID,COLID,CHILDGRPID,FILTERYN,VALUEYN,ADDDT,MODDT");
        mygrid6.setInitWidths("50,50,50,50,50,50,50,50,50,50");
        mygrid6.setColTypes("ro,ed,ed,ed,ed,ed,ed,ed,ro,ro");
        mygrid6.setColAlign("left,left,left,left,left,left,left,left,left,left");
		mygrid6.setColSorting("int,str,str,str,str,str,str,str,str,str");

        //mygrid2.isColumnHidden(0);//PJTID숨기기

        mygrid6.enableSmartRendering(false);
        mygrid6.enableMultiselect(true);

        mygrid6.init();

        mygrid6.setColumnHidden(0,true); //INHERITSEQ
		mygrid6.setColumnHidden(1,true); //PJTID
        mygrid6.setColumnHidden(2,true); //PGMID
        mygrid6.setColumnHidden(3,true); //GRPID

        mygrid6.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){

            //alog("mygrid6  onEditCell ------------------start");
            //alog("       stage : " + stage);
            //alog("       rId : " + rId);
            //alog("       cInd : " + cInd);
            //alog("       nValue : " + nValue);
            //alog("       oValue : " + oValue);

            RowEditStatus = mygrid6.getUserData(rId,"!nativeeditor_status");
            if(stage == 2
                && RowEditStatus != "inserted"
                && RowEditStatus != "deleted"
                && nValue != oValue
                ){
                if(RowEditStatus == "") {
                    mygrid6.setUserData(rId,"!nativeeditor_status","updated");
                    mygrid6.setRowTextBold(rId);
                }
                mygrid6.cells(rId,cInd).cell.wasChanged = true;
            }
            return true;

        });
        //mygrid2.loadXML("cg_pjtinfo_crud2.php");



        //6번째 그리드 초기화 (sqlR)
        mygrid7 = new dhtmlXGridObject('grid7');
		mygrid7.setUserData("","gridTitle","gridSQLR : fnc list"); //글로별 변수에 그리드 타이블 넣기
        mygrid7.setImagePath("./lib/dhtmlxSuite/codebase/imgs/");
        mygrid7.setHeader("SEQ,PJTID,PGMID,SVCSEQ,SQLID,ORD,ADDDT,MODDT");
        mygrid7.setColumnIds("SQLRSEQ,PJTID,PGMID,SVCSEQ,SQLID,ORD,ADDDT,MODDT");
        mygrid7.setInitWidths("50,50,50,50,50,50,50,50");
        mygrid7.setColTypes("ed,ed,ed,ed,ed,ed,ro,ro");
        mygrid7.setColAlign("left,left,left,left,left,left,left,left");
        //mygrid2.isColumnHidden(0);//PJTID숨기기
		mygrid7.setColSorting("int,str,str,str,str,int,str,str");

        mygrid7.enableSmartRendering(false);
        mygrid7.enableMultiselect(true);

        mygrid7.init();

        mygrid7.setColumnHidden(0,true); //SQLRSEQ
		mygrid7.setColumnHidden(1,true); //pjtid
        mygrid7.setColumnHidden(2,true); //pgmid
        mygrid7.setColumnHidden(3,true); //SVCSEQ

        mygrid7.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){

            //alog("mygrid7  onEditCell ------------------start");
            //alog("       stage : " + stage);
            //alog("       rId : " + rId);
            //alog("       cInd : " + cInd);
            //alog("       nValue : " + nValue);
            //alog("       oValue : " + oValue);

            RowEditStatus = mygrid7.getUserData(rId,"!nativeeditor_status");
            if(stage == 2
                && RowEditStatus != "inserted"
                && RowEditStatus != "deleted"
                && nValue != oValue
                ){
                if(RowEditStatus == "") {
                    mygrid7.setUserData(rId,"!nativeeditor_status","updated");
                    mygrid7.setRowTextBold(rId);
                }
                mygrid7.cells(rId,cInd).cell.wasChanged = true;
            }
            return true;

        });
        //mygrid2.loadXML("cg_pjtinfo_crud2.php");



        //3번째 그리드 초기화(col)
        mygrid3 = new dhtmlXGridObject('grid3');
		mygrid3.setUserData("","gridTitle","grid3 : sql column list"); //글로별 변수에 그리드 타이블 넣기
        mygrid3.setImagePath("./lib/dhtmlxSuite/codebase/imgs/");
        mygrid3.setHeader("COLSEQ,PJTID,PGMID,SQLSEQ,COLID,DATATYPE,SQLGBN,ORD,ADDDT,MODDT");
        mygrid3.setColumnIds("COLSEQ,PJTID,PGMID,SQLSEQ,COLID,DATATYPE,SQLGBN,ORD,ADDDT,MODDT");
        //mygrid2.attachHeader("#connector_text_filter,#connector_text_filter,#connector_text_filter,#connector_text_filter")
        mygrid3.setInitWidths("50,50,50,50,50,50,50,50,50,60");
        mygrid3.setColTypes("ro,ed,ed,ro,ed,ed,coro,ed,ro,ro");
        mygrid3.setColAlign("left,left,left,left,left,left,left,left,left,left");
		mygrid3.setColSorting("int,str,str,int,str,str,str,int,str,str");

        //mygrid2.isColumnHidden(0);//PJTID숨기기

        mygrid3.enableSmartRendering(false);
        mygrid3.enableMultiselect(true);
        mygrid3.init();

        mygrid3.setColumnHidden(0,true); //COLSEQ
        mygrid3.setColumnHidden(1,true); //PJTID
        mygrid3.setColumnHidden(2,true); //PGMID
        //mygrid3.setColumnHidden(3,true); //SQLSEQ

		//GRPTYPE 콤보
		setCodeCombo("GRID",mygrid3.getCombo(mygrid3.getColIndexById("SQLGBN")),"SQLGBN");


        mygrid3.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){

            //alog("mygrid3  onEditCell ------------------start");
            //alog("       stage : " + stage);
            //alog("       rId : " + rId);
            //alog("       cInd : " + cInd);
            //alog("       nValue : " + nValue);
            //alog("       oValue : " + oValue);

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
        //mygrid2.loadXML("cg_pjtinfo_crud2.php");


        //4번째 그리드 초기화(io)
        mygrid4 = new dhtmlXGridObject('grid4');
		mygrid4.setUserData("","gridTitle","grid3 : io list"); //글로별 변수에 그리드 타이블 넣기
        mygrid4.setImagePath("./lib/dhtmlxSuite/codebase/imgs/");
        mygrid4.setHeader("PJTID,PGMID,GRPID,COLID,COLORD,COLNM,DATATYPE,DATASIZE,OBJTYPE,BRYN,LBLHIDDENYN,LBLWIDTH,OBJWIDTH,OBJHEIGHT,KEYYN,SEQYN,HIDDENYN,EDITYN,FNINIT,FNNMSEARCH,FNPOPSEARCH,COLFORMAT,VALIDREQUARE,VALIDMIN,VALIDMAX,OBJALIGN,REFCOLID,ADDDT,MODDT"); //29

        mygrid4.setColumnIds("PJTID,PGMID,GRPID,COLID,COLORD,COLNM,DATATYPE,DATASIZE,OBJTYPE,BRYN,LBLHIDDENYN,LBLWIDTH,OBJWIDTH,OBJHEIGHT,KEYYN,SEQYN,HIDDENYN,EDITYN,FNINIT,FNNMSEARCH,FNPOPSEARCH,COLFORMAT,VALIDREQUARE,VALIDMIN,VALIDMAX,OBJALIGN,REFCOLID,ADDDT,MODDT"); //29

        //mygrid2.attachHeader("#connector_text_filter,#connector_text_filter,#connector_text_filter,#connector_text_filter")
        mygrid4.setInitWidths("50,50,50,50,50,50,50,50,50,50,50,50,50,50,50,50,50,50,50,50,50,50,50,50,50,50,50,50,50"); //29
        mygrid4.setColTypes("ed,ed,ed,ed,ed,ed,coro,ed,coro,ed,ed,ed,ed,ed,ed,ed,ed,ed,ed,ed,ed,coro,ed,ed,ed,ed,ed,ro,ro"); //29
        mygrid4.setColAlign("left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left");//29
		mygrid4.setColSorting("str,str,str,str,int,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str");//29

        mygrid4.enableSmartRendering(true);
        mygrid4.enableMultiselect(true);
        mygrid4.splitAt(4);//'freezes' 0 columns // ROW선택 이벤트
		mygrid4.init();

        mygrid4.setColumnHidden(0,true); //PJTID
        mygrid4.setColumnHidden(1,true); //PGMID
        mygrid4.setColumnHidden(2,true); //GRPID

		//GRPTYPE 콤보
		setCodeCombo("GRID",mygrid4.getCombo(mygrid4.getColIndexById("DATATYPE")),"DATATYPE");
		setCodeCombo("GRID",mygrid4.getCombo(mygrid4.getColIndexById("OBJTYPE")),"CTGRID");
		setCodeCombo("GRID",mygrid4.getCombo(mygrid4.getColIndexById("COLFORMAT")),"COLFORMAT");

        mygrid4.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){

            //alog("mygrid4  onEditCell ------------------start");
            //alog("       stage : " + stage);
            //alog("       rId : " + rId);
            //alog("       cInd : " + cInd);
            //alog("       COLID : " + mygrid4.getColumnId(cInd));
            //alog("       nValue : " + nValue);
            //alog("       oValue : " + oValue);
			
            RowEditStatus = mygrid4.getUserData(rId,"!nativeeditor_status");
            if(stage == 2
                && RowEditStatus != "inserted"
                && RowEditStatus != "deleted"
                && nValue != oValue
                ){
                //컬럼이름이나 컬럼ID로 검색하기
                if(cInd == 1 || cInd == 2){
                    var ConAllData = $( "#condition1" ).serialize();
                    alog("   ConAllData = " + ConAllData);

                    //마지막 선송 정보 저장
                    lastinput5 =  ConAllData;



                    //서버에서 DD가져오기
                    $.ajax({
                        type : "POST",
                        url : mygrid5_url+"&G5_CRUD_MODE=read&" + lastinput5,
                        data : { searchdd :  nValue },
                        dataType: "json",
                        success: function(data){
                            alog("   json return----------------------");
                            alog("   json data : " + data);
                            alog("   json RTN_CD : " + data.RTN_CD);
                            alog("   json ERR_CD : " + data.ERR_CD);
                            alog("   json RTN_MSG : " + data.RTN_MSG);

                            //그리드 저장 처리
                            if(data.RTN_CD == "200"){
								if(data.RTN_DATA){
									for(var i=0;i<data.RTN_DATA.rows.length;i++){
										alog( "   i : " + i);

										//내 행 업데이트
										mygrid4.cells(rId,1).setValue(data.RTN_DATA.rows[i].data[1]);//COLID
										mygrid4.cells(rId,2).setValue(data.RTN_DATA.rows[i].data[2]);//COLNM
										mygrid4.cells(rId,3).setValue(data.RTN_DATA.rows[i].data[4]);//DATATYPE
										mygrid4.cells(rId,4).setValue(data.RTN_DATA.rows[i].data[5]);//DATASIZE
										mygrid4.cells(rId,5).setValue(data.RTN_DATA.rows[i].data[6]);//OBJTYPE
										mygrid4.cells(rId,9).setValue(data.RTN_DATA.rows[i].data[7]);//LBLWIDTH
										mygrid4.cells(rId,10).setValue(data.RTN_DATA.rows[i].data[8]);//OBJWIDTH

									}
								}
                            }else{
                                msgError("서버 저장중 에러가 발생했습니다.\nRTN_CD : " + data.RTN_CD + "\nERR_CD : " + data.ERR_CD + "\nRTN_MSG :" + data.RTN_MSG,3);
                            }


                        },
                        error: function(error){
							msgError("Ajax http 500 error ( " + error + " )",3);
							alog("Ajax http 500 error ( " + error + " )");
                        }
                    });

                }

                if(jsonFormValid(eval("obj_G4_valid."+mygrid4.getColumnId(cInd)), "OBJTYPE", "오브젝트타임", nValue)){
                    if(RowEditStatus == "") {
                        mygrid4.setUserData(rId,"!nativeeditor_status","updated");
                        mygrid4.setRowTextBold(rId);
                    }
                    mygrid4.cells(rId,cInd).wasChanged = true;

                }else{
                    return false;
                }
            }

			alog("6666");
            return true;

        });






		//9번째 그리드 초기화(SVC)
		alog("grid9-----------------------------start");
		mygrid9 = new dhtmlXGridObject('grid9');
		mygrid9.setUserData("","gridTitle","grid9 : sql column list"); //글로별 변수에 그리드 타이블 넣기
		mygrid9.setImagePath("./lib/dhtmlxSuite/codebase/imgs/");
		mygrid9.setHeader("SVCSEQ,PJTID,PGMID,GRPID,FNCID,ORD,SVCGRPID,ADDDT,MODDT");
		mygrid9.setColumnIds("SVCSEQ,PJTID,PGMID,GRPID,FNCID,ORD,SVCGRPID,ADDDT,MODDT");
		mygrid9.setInitWidths("50,50,50,50,50,50,50,50,50");
		mygrid9.setColTypes("ro,ed,ed,ed,ed,ed,ed,ro,ro");
		mygrid9.setColAlign("left,left,left,left,left,left,left,left,left");
		mygrid9.setColSorting("int,str,str,str,str,int,str,str,str");


		mygrid9.enableSmartRendering(false);
		mygrid9.enableMultiselect(true);
		mygrid9.init();

		mygrid9.setColumnHidden(0,true); //SVCSEQ
		mygrid9.setColumnHidden(1,true); //PJTID
		mygrid9.setColumnHidden(2,true); //PGMID
		mygrid9.setColumnHidden(3,true); //GRPID
		mygrid9.setColumnHidden(4,true); //FNCID

		mygrid9.attachEvent("onRowSelect",function(rowID,celInd){
            alog("mygrid9 - onRowSelect ----------start");
            alog("   rowID = " + rowID);
            alog("   celInd = " + celInd);


            lastrowid5 = rowID;

            //선택된 ROW의 모든컬럼 추출하기
            var RowAllData;
            RowAllData = getRowsColid(mygrid9,rowID,"G9");
            alog("   RowAllData = " + RowAllData);



            var ConAllData = $( "#condition1" ).serialize();
            alog("   ConAllData = " + ConAllData);

            //(SQLR) 마지막 전송 정보 저장
            lastinput7 = RowAllData + "&" + ConAllData;


			//(SQLR) KEY컬럼만 자식에게 전달
            lastinput7json = jQuery.parseJSON('{ "__NAME":"lastinput7json"' +
                ', "SVCSEQ" : "' + q(mygrid9.cells(lastrowid5,0).getValue()) + '"' +
                ', "PJTID" : "' + q(mygrid9.cells(lastrowid5,1).getValue()) + '"' +
                ', "PGMID" : "' + q(mygrid9.cells(lastrowid5,2).getValue()) + '"' +
                ', "GRPID" : "' + q(mygrid9.cells(lastrowid5,3).getValue()) + '"' +
                ', "FNCID" : "' + q(mygrid9.cells(lastrowid5,4).getValue()) + '"' +
                '}');


            //(SQLR) 그리드 조회
            gridSearch7(lastinput7);


            alog("mygrid9 - onRowSelect ----------end");
        });

		mygrid9.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){

			//alog("mygrid9  onEditCell ------------------start");
			//alog("       stage : " + stage);
			//alog("       rId : " + rId);
			//alog("       cInd : " + cInd);
			//alog("       nValue : " + nValue);
			//alog("       oValue : " + oValue);

			RowEditStatus = mygrid9.getUserData(rId,"!nativeeditor_status");
			if(stage == 2
				&& RowEditStatus != "inserted"
				&& RowEditStatus != "deleted"
				&& nValue != oValue
				){
				if(RowEditStatus == "") {
					mygrid9.setUserData(rId,"!nativeeditor_status","updated");
					mygrid9.setRowTextBold(rId);
				}
				mygrid9.cells(rId,cInd).cell.wasChanged = true;
			}
			return true;

		});




		
		alog("initBody-----------------------------end");

    }//initBody();



    </script>


</head>
<body onload="initBody();">

<div id="BODY_BOX" class="BODY_BOX">
	<div  class="GRID_LABELGRP" >
		<div class="GRID_LABEL" >* PGMINFO2 
			<!--popup--><a href="?" target="_blank"><img src="./img/popup.PNG" height=10 align=absmiddle border=0></a>
			<!--reload--><a href="javascript:location.reload();"><img src="./img/reload.png" width=11 height=10 align=absmiddle border=0></a>
		</div>
		<div  class="GRID_LABELBTN"  >
			<input type="button" name="some_name" value="Search1" onclick="search1();">
			<input type="button" name="some_name" value="LoadXml" onclick="loadxml();">
			<input type="button" name="some_name" value="SaveAll" onclick="saveAll();">
			<input type="button" name="some_name" value="Make" onclick="Make();">
			<input type="button" name="some_name" value="Run" onclick="Run();">
			<input type="button" name="some_name" value="SourceView" onclick="SourceView();">
		</div>
	</div>


    <div style="position: relative;width:100%;background-color:yellow;padding:0 0 0 0;overflow:auto;border-radius:3px;-moz-border-radius: 3px;">
        <div style="position: relative;background-color:#eeeeee;padding:5px 5px 5px 5px;overflow:auto;">
            <div style="width:0px;height:0px;overflow: hidden"><form id="condition1"></div>

            <div class="CON_LINE" style="">
                <div class="CON_OBJGRP" style="">
                    <div class="CON_LABEL" style="width:100px;">PJTID</div>
                    <div class="CON_OBJECT" style="width:150px;"><input type="text" name="F_PJTID" value="" id="F_PJTID"></div>
                </div>
                <div class="CON_OBJGRP" style="">
                    <div class="CON_LABEL" style="width:100px;">PGMID</div>
                    <div class="CON_OBJECT" style="width:150px;"><input type="text" name="F_PGMID" value="" id="F_PGMID"></div>
                </div>
                <div class="CON_OBJGRP" style="">
                    <div class="CON_LABEL" style="width:100px;">PJTSEQ</div>
                    <div class="CON_OBJECT" style="width:150px;"><input type="text" name="F_PJTSEQ" value="" id="F_PJTSEQ"></div>
                </div>
                <div class="CON_OBJGRP" style="">
                    <div class="CON_LABEL" style="width:100px;">PGMSEQ</div>
                    <div class="CON_OBJECT" style="width:150px;"><input type="text" name="F_PGMSEQ" value="" id="F_PGMSEQ"></div>
                </div>
                <div class="CON_OBJGRP" style="">
                    <div class="CON_LABEL" style="width:100px;">PGMNM</div>
                    <div class="CON_OBJECT" style="width:150px;"><input type="text" name="F_PGMNM" value="" id="F_PGMNM"></div>
                </div>
            </div>

        </div>
    </div>


    <div class="GRP_LINE" >
        <div class="GRP_OBJECT" style="width:40%;">
            <div  class="GRID_LABELGRP" >
                <div class="GRID_LABEL" >* GRP</div>
                <div  class="GRID_LABELBTN"  >
			    <input type="button" name="some_name" value="S1" onclick="save1();">
				<input type="button" name="select_Layout" value="select Layout" onclick="selectLayout(this);">
                <input type="button" name="add" value="+" onclick="addRow1();">
                <input type="button" name="delete" value="-" onclick="delRow(mygrid1);">  
                </div>
            </div>
            <div class="GRID_OBJECT" >
                <div id="grid1" width="100%" height="200px" style="background-color:white;z-index:30;"></div>
            </div>
        </div>

        <div class="GRP_OBJECT" style="width:20%;">

            <div  class="GRID_LABELGRP" >
                <div class="GRID_LABEL" >* FNC</div>
                <div  class="GRID_LABELBTN"  >
					<input type="button" name="some_name" value="S5" onclick="save5();">
					<input type="button" name="getfnccode" value="C" onclick="getFncCode();">
					<input type="button" name="add" value="+" onclick="addRow5();">
					<input type="button" name="delete" value="-" onclick="delRow(mygrid5);">
                </div>
            </div>
            <div class="GRID_OBJECT" >
                <div id="grid5" width="100%" height="200px" style="background-color:white;z-index:40;"></div>
            </div>
        </div>

        <div class="GRP_OBJECT" style="width:25%;">

            <div  class="GRID_LABELGRP" >
                <div class="GRID_LABEL" >* IO</div>
                <div  class="GRID_LABELBTN"  >
				    <input type="button" name="some_name" value="S4" onclick="save4();">
					<input type="button" name="ttt" value="C" onclick="getColOutput();">
					<input type="button" name="add" value="+" onclick="addRow4();">
                    <input type="button" name="delete" value="-" onclick="delRow(mygrid4);">
                    <input type="button" name="reload" value="R" onclick="gridReload4()">
                </div>
            </div>
            <div class="GRID_OBJECT" >
                <div id="grid4" width="100%" height="200px" style="background-color:white;overflow:hidden"></div>
            </div>
        </div>

        <div class="GRP_OBJECT" style="width:15%;">
            <div  class="GRID_LABELGRP" >
                <div class="GRID_LABEL" >* INHERIT</div>
                <div  class="GRID_LABELBTN"  >
				    <input type="button" name="some_name" value="S6" onclick="save6();"><input type="button" name="add" value="+" onclick="addRow6();"><input type="button" name="delete" value="-" onclick="delRow(mygrid6);"><input type="button" name="reload" value="R" onclick="gridReload6()">
                </div>
            </div>
            <div class="GRID_OBJECT" >
                <div id="grid6" width="100%" height="200px" style="background-color:white;overflow:hidden"></div>
            </div>
        </div>

    </div>

    <div class="GRP_LINE" style="">

        <div class="GRP_OBJECT" style="width:10%;">

            <div  class="GRID_LABELGRP" >
                <div class="GRID_LABEL" >* SVC</div>
                <div  class="GRID_LABELBTN"  >
					<input type="button" name="some_name" value="S9" onclick="save9();">
					<input type="button" name="getsqlcode" value="C" onclick="getSqlCode();">
					<input type="button" name="add" value="+" onclick="addRow9();">
					<input type="button" name="delete" value="-" onclick="delRow(mygrid9);">
                </div>
            </div>
            <div class="GRID_OBJECT" >
                <div id="grid9" width="100%" height="200px" style="background-color:white;z-index:40;"></div>
            </div>
        </div>

        <div class="GRP_OBJECT" style="width:15%;">

            <div  class="GRID_LABELGRP" >
                <div class="GRID_LABEL" >* SQLR</div>
                <div  class="GRID_LABELBTN"  >
					<input type="button" name="some_name" value="S7" onclick="save7();">
					<input type="button" name="getsqlcode" value="C" onclick="getSqlCode();">
					<input type="button" name="add" value="+" onclick="addRow7();">
					<input type="button" name="delete" value="-" onclick="delRow(mygrid7);">
                </div>
            </div>
            <div class="GRID_OBJECT" >
                <div id="grid7" width="100%" height="200px" style="background-color:white;z-index:40;"></div>
            </div>
        </div>

        <div class="GRP_OBJECT" style="width:25%;">
            <div  class="GRID_LABELGRP" >
                <div class="GRID_LABEL" >* SQL</div>
                <div  class="GRID_LABELBTN"  >
					<input type="button" name="some_name" value="S2" onclick="save2();">
					<input type="button" name="add" value="+" onclick="addRow2();">
					<input type="button" name="delete" value="-" onclick="delRow(mygrid2);">
					<input type="button" name="reload" value="R" onclick="gridReload2();">
                </div>
            </div>
            <div class="GRID_OBJECT" >
                <div id="grid2" width="100%" height="200px" style="background-color:white;z-index:40;"></div>
            </div>
        </div>
        <div class="GRP_OBJECT" style="width:35%;">
            <textarea id="code" name="code">

            </textarea>
        </div>
        <div class="GRP_OBJECT" style="width:15%;">
            <div  class="GRID_LABELGRP" >
                <div class="GRID_LABEL" >* COL</div>
                <div  class="GRID_LABELBTN"  >
				<input type="button" name="some_name" value="S3" onclick="save3();">
                <input type="button" name="add" value="+" onclick="addRow3();">
                <input type="button" name="delete" value="-" onclick="delRow(mygrid3);">
                </div>
            </div>

            <div class="GRID_OBJECT" >
                <div id="grid3" width="100%" height="200px" style="background-color:white;z-index:3;"></div>
            </div>
        </div>


    </div>

</div>
<div id="div_layout" style="display: none;background-color:silver;position:absolute;top:24px;left:10px;overflow: auto;width:100%;z-index;100">

</div>

<div style="width:0px;height:0px;overflow: hidden"></form></div>


<textarea style="width:100%;height:300px;font-size:9pt;" id="tt"></textarea>
<textarea style="width:100%;height:300px;font-size:9pt;" id="tt2"></textarea>
</body>
</html>
