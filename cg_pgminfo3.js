    var grpInfo = new HashMap();

    grpInfo.set(
        "Io", 
            {
                "GRPTYPE": "GRID"
                ,"GRPNM": "오브젝트"
                ,"KEYCOLID": "COLSEQ"
                ,"SEQYN": "N"
                ,"COLS": [				
                ]
            }
    ); //컨디션1

    //정적 변수 선언
    var gridImagePath = CFG_URL_LIBS_ROOT + "lib/dhtmlxSuite/codebase/imgs/";
    var cmSql, cmFnc;//codemirror
    var makeSyncFileLineSum;
	var popSelectLayout; //레이아웃용
    var myCalendar;
    var lastCondition;
    var mygridGrp,dp1,addstatusyn1,lastinput1,lastinput1json,lastrowid1,isViewGrp;
    var mygridSql,dp2,addstatusyn2,lastinput2,lastinput2json,lastrowid2,isView2;
    var mygridCol,dp3,addstatusyn3,lastinput3,lastinput3json,lastrowid3,isView3;
    var mygridIo,dp4,addstatusyn4,lastinput4,lastinput4json,lastrowid4,isViewIo;
    var mygridFnc,dp5,addstatusyn5,lastinput5,lastinput5json,lastrowid5,isViewFnc;
    var mygridEvt,dpEvt,addstatusynEvt,lastinputEvt,lastinputEvtJson,lastrowidEvt,isViewEvt;
    var mygridInherit,dp6,addstatusyn6,lastinput6,lastinput6json,lastrowid6,isView6;
    var mygridSqlR,dp7,addstatusyn7,lastinput7,lastinput7json,lastrowid7,isView7;
    var mygrid8,dp8,addstatusyn8,lastinput8,lastinput8json,lastrowid8,isView8;
    var mygridSvc,dp9,addstatusyn9,lastinput9,lastinput9json,lastrowid9,isView9;
    var mygridPgm,addstatusynPgm,lastinputPgm,lastinputPgmjson,lastrowidPgm;
    var mygridEvt_url = "cg_pgminfo_crud3.php?CTLGRP=EVT&";//완
    var mygridGrp_url = "cg_pgminfo_crud3.php?CTLGRP=GRP&";//완
    var mygridSql_url = "cg_pgminfo_crud3.php?CTLGRP=SQL&";//완
    var mygridCol_url = "cg_pgminfo_crud3.php?CTLGRP=SQLD&";
    var mygridIo_url = "cg_pgminfo_crud3.php?CTLGRP=IO&";
    var mygridIocd_url = "cg_pgminfo_crud3.php?CTLGRP=IOCD&"; //IO그리드, COL그리드에서 상속받기    
    var mygridDd_url = "cg_pgminfo_crud3.php?CTLGRP=DD&";
    var mygridInherit_url = "cg_pgminfo_crud3.php?CTLGRP=INHERIT&";
    var mygridFnc_url = "cg_pgminfo_crud3.php?CTLGRP=FNC&";//완
    var mygridFnccd_url = "cg_pgminfo_crud3.php?CTLGRP=FNCCD&";
    var mygridSqlR_url = "cg_pgminfo_crud3.php?CTLGRP=SQLR&";
    var mygridLayout_url = "cg_pgminfo_crud3.php?CTLGRP=LAYOUT&";
    var mygridLayoutD_url = "cg_pgminfo_crud3.php?CTLGRP=LAYOUTD&";
    var mygridLayoutS_url = "cg_pgminfo_crud3.php?CTLGRP=LAYOUTS&";

    var mygridSvc_url = "cg_pgminfo_crud3.php?CTLGRP=SVC&"; //SVC
    var mygridPgm_url = "cg_pgminfo_crud3.php?CTLGRP=PGM&"; //팝업윈도우 프로그램 검색
    var validmsg = jQuery.parseJSON('{"REQUARED":"[0]는 반드시 입력바랍니다.", "MIN":"this는 [0]이상 입력바랍니다."}');

	var isLayoutLoaded = false;
    var myWins;
    var codeMirrorSqlFontSize = 11;

    //동적 변수 선언
    var obj_condition_valid = jQuery.parseJSON( '{"__NAME":"obj_condition_valid"' +
        ' ,"F_PJTID": {"REQUARED":"N",  "MIN":"0",  "MAX":"ZZZ",  "DATASIZE":10,  "DATATYPE":"STRING"} ' +
        ' ,"F_PGMID": {"REQUARED":"N",  "MIN":"0",  "MAX":"ZZZ",  "DATASIZE":10,  "DATATYPE":"STRING"} ' +
        '}');
    var obj_G4_valid = jQuery.parseJSON( '{"__NAME":"obj_G4_valid"' +
        ' ,"OBJTYPE": {"REQUARED":"N",  "MIN":"0",  "MAX":"ZZZ",  "DATASIZE":10,  "DATATYPE":"STRING"} ' +
        ' ,"F_PGMID": {"REQUARED":"N",  "MIN":"0",  "MAX":"ZZZ",  "DATASIZE":10,  "DATATYPE":"STRING"} ' +
        '}');

    var lastSelectPgRowId; //마지막 선택한 그리드 프로퍼티 row

    function MakeQueue(pgmtype) {
        window.open( "http://" + window.location.hostname + ":8060/m.k/cg_make_queue.php?pjtseq=" + $("#F_PJTSEQ").val() + "&pgmseq=" + $("#F_PGMSEQ").val()+ "&pgmtype=" + pgmtype ) ;
    }

    function Make(pgmtype) {
        window.open( "http://" + window.location.hostname + ":8060/m.k/cg_make.php?access_token=" + oauthToken + "&pjtseq=" + $("#F_PJTSEQ").val() + "&pgmseq=" + $("#F_PGMSEQ").val()+ "&pgmtype=" + pgmtype ) ;
    }

    function changeCodemirrorFontSize(sizeCmd){
        alog("changeCodemirrorFontSize..........start " + sizeCmd);

        if(sizeCmd == "+"){
            codeMirrorSqlFontSize = codeMirrorSqlFontSize + 2;
        }else{
            codeMirrorSqlFontSize = codeMirrorSqlFontSize - 2;
        }
    
        $(".CodeMirror").css('font-size',codeMirrorSqlFontSize + "px");

        //cmSql.getWrapperElement().style["font-size"] = size+"px";
        //cmSql.getWrapperElement().style.fontsize = size+"px";
        cmSql.refresh();
        alog("changeCodemirrorFontSize..........end");   
    }

    function MakeAsync(token){

        $("#makeHTMLJS").text("HTMLJS");
        $("#makeHTML").text("HTML");                    
        $("#makeSVRCTL").text("SVRCTL");
        $("#makeSVRSVC").text("SVRSVC");
        $("#makeSVRDAO").text("SVRDAO");
        
        var urls = [];
        urls["HTML"] = CFG_MAKE_URL + "/m.k/cg_make.php?async=Y&access_token=" + oauthToken + "&TOKEN=" + token + "&pjtseq=" + $("#F_PJTSEQ").val() + "&pgmseq=" + $("#F_PGMSEQ").val()+ "&pgmtype=HTML";
        urls["HTMLJS"] = CFG_MAKE_URL + "/m.k/cg_make.php?async=Y&access_token=" + oauthToken + "&TOKEN=" + token + "&pjtseq=" + $("#F_PJTSEQ").val() + "&pgmseq=" + $("#F_PGMSEQ").val()+ "&pgmtype=HTMLJS";
        urls["SVRCTL"] = CFG_MAKE_URL + "/m.k/cg_make.php?async=Y&access_token=" + oauthToken + "&TOKEN=" + token + "&pjtseq=" + $("#F_PJTSEQ").val() + "&pgmseq=" + $("#F_PGMSEQ").val()+ "&pgmtype=SVRCTL";
        urls["SVRSVC"] = CFG_MAKE_URL + "/m.k/cg_make.php?async=Y&access_token=" + oauthToken + "&TOKEN=" + token + "&pjtseq=" + $("#F_PJTSEQ").val() + "&pgmseq=" + $("#F_PGMSEQ").val()+ "&pgmtype=SVRSVC";
        urls["SVRDAO"] = CFG_MAKE_URL + "/m.k/cg_make.php?async=Y&access_token=" + oauthToken + "&TOKEN=" + token + "&pjtseq=" + $("#F_PJTSEQ").val() + "&pgmseq=" + $("#F_PGMSEQ").val()+ "&pgmtype=SVRDAO";

        startDate = _.now(); //lodash.js
        msgNotice("Axios로 비동기 요청 5개 발송",3);
        Promise.all([
            axios.get(urls["HTML"], {transitional: { forcedJSONParsing: true }}).then(function (response) {
                alog(response.data);
                res = response.data;
                var fixedRes = res.replace(/MakeAsync\(/g,'').replace(/\)/g,'');
                var resJson = JSON.parse(fixedRes);

                if(resJson.RTN_CD == "200"){
                    endDate = _.now(); //lodash.js        
                    makeDate = endDate - startDate;

                    msgNotice("HTML 완료, 소요(초) = " + (Math.round((makeDate/1000*10))/10),5); //소숫점 1자리까지만 표기
                    $("#makeHTML").text("R");
                }else{
                    msgError("MakeAsync(HTML) 응답오류 : " + resJson.RTN_MSG);
                }
              })
              .catch(function (error) {
                msgError("MakeAsync(HTML) Ajax http 500 error ( " + error + " )");
              }),
            axios.get(urls["HTMLJS"], {transitional: { forcedJSONParsing: true }}).then(function (response) {
                alog(response.data);
                res = response.data;
                var fixedRes = res.replace(/MakeAsync\(/g,'').replace(/\)/g,'');
                var resJson = JSON.parse(fixedRes);

                if(resJson.RTN_CD == "200"){
                    endDate = _.now(); //lodash.js        
                    makeDate = endDate - startDate;
                    msgNotice("HTMLJS 완료, 소요(초) = " + (Math.round((makeDate/1000*10))/10),5);
                    $("#makeHTMLJS").text("R");
                }else{
                    msgError("MakeAsync(HTMLJS) 응답오류 : " + resJson.RTN_MSG);
                }
              })
              .catch(function (error) {
                msgError("MakeAsync(HTMLJS) Ajax http 500 error ( " + error + " )");
              }),
            axios.get(urls["SVRCTL"], {transitional: { forcedJSONParsing: true }}).then(function (response) {
                alog(response.data);
                res = response.data;
                var fixedRes = res.replace(/MakeAsync\(/g,'').replace(/\)/g,'');
                var resJson = JSON.parse(fixedRes);

                if(resJson.RTN_CD == "200"){
                    endDate = _.now(); //lodash.js        
                    makeDate = endDate - startDate;
                    msgNotice("SVRCTL 완료, 소요(초) = " + (Math.round((makeDate/1000*10))/10),5);
                    $("#makeSVRCTL").text("R");
                }else{
                    msgError("MakeAsync(SVRCTL) 응답오류 : " + resJson.RTN_MSG);
                }
              })
              .catch(function (error) {
                msgError("MakeAsync(SVRCTL) Ajax http 500 error ( " + error + " )");
              }),
            axios.get(urls["SVRSVC"], {transitional: { forcedJSONParsing: true }}).then(function (response) {
                alog(response.data);
                res = response.data;
                var fixedRes = res.replace(/MakeAsync\(/g,'').replace(/\)/g,'');
                var resJson = JSON.parse(fixedRes);

                if(resJson.RTN_CD == "200"){
                    endDate = _.now(); //lodash.js        
                    makeDate = endDate - startDate;
                    msgNotice("SVRSVC 완료, 소요(초) = " + (Math.round((makeDate/1000*10))/10),5);
                    $("#makeSVRSVC").text("R");
                }else{
                    msgError("MakeAsync(SVRSVC) 응답오류 : " + resJson.RTN_MSG);
                }
              })
              .catch(function (error) {
                msgError("MakeAsync(SVRSVC) Ajax http 500 error ( " + error + " )");
              }),
            axios.get(urls["SVRDAO"], {transitional: { forcedJSONParsing: true }}).then(function (response) {
                alog(response.data);
                res = response.data;
                var fixedRes = res.replace(/MakeAsync\(/g,'').replace(/\)/g,'');
                var resJson = JSON.parse(fixedRes);

                if(resJson.RTN_CD == "200"){
                    endDate = _.now(); //lodash.js        
                    makeDate = endDate - startDate;
                    msgNotice("SVRDAO 완료, 소요(초) = " + (Math.round((makeDate/1000*10))/10),5);
                    $("#makeSVRDAO").text("R");
                }else{
                    msgError("MakeAsync(SVRDAO) 응답오류 : " + resJson.RTN_MSG);
                }
              })
              .catch(function (error) {
                msgError("MakeAsync(SVRDAO) Ajax http 500 error ( " + error + " )");
              }),
            ])
        .then(function (results) {
            endDate = _.now(); //lodash.js                
            makeDate = endDate - startDate;

            msgNotice("모두 완료. 소요(초) = " + (Math.round((makeDate/1000*10))/10),10);


            //alert("생성된 파일의 라인수 합계는 " + makeSyncFileLineSum);
            //alert("총 실행 시간(초)은 " + (makeDate/1000));
        

            const acct = results[0];
            const perm = results[1];
        });
    }


    function MakeAsyncJquery(token){

        //불러오기
        var types = ["HTML","HTMLJS","SVRCTL","SVRSVC","SVRDAO"];
        makeSyncFileLineSum = 0;
        //요청 토큰
        //var token = uuidv4();
        
        startDate = _.now(); //lodash.js

        for(i=0;i<types.length;i++){
            alog("MakeAsync = "  + types[i]);
            pgmtype =  types[i];

            $("#make" + pgmtype).text(pgmtype);
            $.ajax({
                type : "GET",
                url : CFG_MAKE_URL + "/m.k/cg_make.php?async=Y&access_token=" + oauthToken + "&TOKEN=" + token + "&pjtseq=" + $("#F_PJTSEQ").val() + "&pgmseq=" + $("#F_PGMSEQ").val()+ "&pgmtype=" + pgmtype,
                dataType : "jsonp",
                async: true,
                success: function(data){
                    alog(" Return : " + data.RTN_CD + " / " + data.RTN_MSG);

                    if(data.RTN_CD == "200"){
                        if(data.RTN_MSG.indexOf("HTMLJS") != -1) $("#makeHTMLJS").text("R");
                        if(data.RTN_MSG.indexOf("HTML") != -1) $("#makeHTML").text("R");                    
                        if(data.RTN_MSG.indexOf("SVRCTL") != -1) $("#makeSVRCTL").text("R");
                        if(data.RTN_MSG.indexOf("SVRSVC") != -1) $("#makeSVRSVC").text("R");
                        if(data.RTN_MSG.indexOf("SVRDAO") != -1) $("#makeSVRDAO").text("R");

                        makeSyncFileLineSum = makeSyncFileLineSum + parseInt(data.ERR_CD);
                        alog("makeHTMLJS = " + $("#makeHTMLJS").text() );
                        alog("makeHTML = " + $("#makeHTMLJS").text() );
                        alog("makeSVRCTL = " + $("#makeHTMLJS").text() );
                        alog("makeSVRSVC = " + $("#makeHTMLJS").text() );
                        alog("makeSVRSVC = " + $("#makeHTMLJS").text() );                        
                        if($("#makeHTMLJS").text() == "R"
                            && $("#makeHTML").text() == "R"
                            && $("#makeSVRCTL").text() == "R"
                            && $("#makeSVRSVC").text() == "R"
                            && $("#makeSVRDAO").text() == "R"
                        ){
                            endDate = _.now(); //lodash.js
                            
                            makeDate = endDate - startDate;
                            //alert("생성된 파일의 라인수 합계는 " + makeSyncFileLineSum);
                            alert("총 실행 시간(초)은 " + (makeDate/1000));
                        };
                        
                    }
                    msgNotice(data.RTN_MSG,10);
                },
                error: function(error){
                    msgError("MakeAsync() Ajax http 500 error ( " + error + " )");
                }
            });    
        }

        msgNotice(types.length + "개 비동기 요청 완료",1);
    }
    function Run() {
        if($("#F_PGMURL").val() == ""){
            alert("조회조건에 URL을 입력해 주세요.")
        }else{
            //window.open("./rst/" + $("#F_PGMURL").val() );//단일 프로젝트일때
            //alert(CFG_MAKE_URL + "/c.g/" + $("#F_PJTID").val() + "/" + $("#F_PGMURL").val());
            window.open( "http://" + window.location.hostname + ":8040/d.s/"  + $("#F_PJTID").val() + "/" + $("#F_PGMURL").val() + "?access_token=" + oauthToken );//멀티 프로젝트일때
        }
        
    }
    function SourceView() {
        window.open("cg_viewtab.php?pgmseq=" + $("#F_PGMSEQ").val() + "&pjtseq=" + $("#F_PJTSEQ").val());
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
			', "PJTSEQ" : "' + q($("#F_PJTSEQ").val()) + '"' +
			', "PGMSEQ" : "' + q($("#F_PGMSEQ").val()) + '"' +
			'}');

		//KEY컬럼만 자식에게 전달(sql)
		lastinput2json = jQuery.parseJSON('{ "__NAME":"lastinput2json"' +
			', "PJTSEQ" : "' + q($("#F_PJTSEQ").val()) + '"' +
			', "PGMSEQ" : "' + q($("#F_PGMSEQ").val()) + '"' +
			'}');

        //그리드 조회
        grpSearch(ConAllData);

        //그리드 조회
        gridSearch2(ConAllData);

        //POPUP
        goGridIoPopCombo();

        //코드미러 비우기
        codemirrorInit();
    }

    function codemirrorInit(){
        if(cmSql){
            cmSql.setValue("");;
            cmSql.setOption("readOnly",true);
        }
    }

	//행추가1 (group)
	function addRow1(){
		if( !(lastinput1json) || !(lastinput1json.PJTSEQ) || !(lastinput1json.PGMSEQ) ){
			msgError("조회 후에 행추가 가능합니다",3);
		}else{
			var tCols = [lastinput1json.PJTSEQ,lastinput1json.PGMSEQ];//초기값
			addRow(mygridGrp,tCols);
		}
	}

	//행추가2 (sql)
	function addRow2(){
		if( !(lastinput2json) || !(lastinput2json.PJTSEQ) || !(lastinput2json.PGMSEQ)  ){
			msgError("조회 후에 행추가 가능합니다",3);
		}else{
			var tCols = [lastinput2json.PJTSEQ,lastinput2json.PGMSEQ];//초기값
			addRow(mygridSql,tCols);
		}
	}

	//행추가3 (sql컬럼)
	function addRow3(){
		if( !(lastinput3json) || !(lastinput3json.PJTSEQ) || !(lastinput3json.PGMSEQ)  || !(lastinput3json.SQLSEQ) ){
			msgError("조회 후에 행추가 가능합니다",3);
		}else{
			var tCols = ["",lastinput3json.PJTSEQ,lastinput3json.PGMSEQ,lastinput3json.SQLSEQ];//초기값
			addRow(mygridCol,tCols);
		}
	}

	//행추가4 (io)
	function addRow4(){
		if( !(lastinput4json) || !(lastinput4json.PJTSEQ) || !(lastinput4json.PGMSEQ)  || !(lastinput4json.GRPSEQ)  ){
			msgError("조회 후에 행추가 가능합니다",3);
		}else{
			var tCols = [lastinput4json.PJTSEQ,lastinput4json.PGMSEQ,lastinput4json.GRPSEQ];//초기값
			addRow(mygridIo,tCols);
		}
	}

	//행추가5 (fnc)
	function addRow5(){
		if( !(lastinput5json) || !(lastinput5json.PJTSEQ) || !(lastinput5json.PGMSEQ)  || !(lastinput5json.GRPSEQ)  ){
			msgError("조회 후에 행추가 가능합니다",3);
		}else{
			var tCols = [lastinput5json.PJTSEQ,lastinput5json.PGMSEQ,lastinput5json.GRPSEQ];//초기값
			addRow(mygridFnc,tCols);
		}
    }
    
    //행추가5 (evt)
	function addRowEvt(){
		if( !(lastinputEvtjson) || !(lastinputEvtjson.PJTSEQ) || !(lastinputEvtjson.PGMSEQ)  || !(lastinputEvtjson.GRPSEQ)  ){
			msgError("조회 후에 행추가 가능합니다",3);
		}else{
			var tCols = [lastinputEvtjson.PJTSEQ,lastinputEvtjson.PGMSEQ,lastinputEvtjson.GRPSEQ,,1];//초기값
			addRow(mygridEvt,tCols);
		}
	}

	//행추가6 (inherit)
	function addRow6(){
		if( !(lastinput6json) || !(lastinput6json.PJTSEQ) || !(lastinput6json.PGMSEQ)  || !(lastinput6json.GRPSEQ)  ){
			msgError("조회 후에 행추가 가능합니다",3);
		}else{
            if(lastinput6json.GRPTYPE == "CONDITION"){
                msgError("컨디션은 RADIO외 모든 필드가 상속되기 때문에 지정 불필요합니다",3);
            }
            
            //else{
                var tCols = ["",lastinput6json.PJTSEQ,lastinput6json.PGMSEQ,lastinput6json.GRPSEQ];//초기값
                addRow(mygridInherit,tCols);
            //}
		}
	}

	//행추가7 (sqlr)
	function addRow7(){
		if( !(lastinput7json) || !(lastinput7json.PJTSEQ) || !(lastinput7json.PGMSEQ)  || !(lastinput7json.SVCSEQ)  ){
			msgError("조회 후에 행추가 가능합니다",3);
		}else{
			var tCols = [null,lastinput7json.PJTSEQ,lastinput7json.PGMSEQ,lastinput7json.SVCSEQ];//초기값
			addRow(mygridSqlR,tCols);
		}
	}


	//행추가8 (valid)
	function addRow8(){
		if( !(lastinput8json) || !(lastinput8json.PJTSEQ) || !(lastinput8json.PGMSEQ)  || !(lastinput8json.GRPSEQ) || !(lastinput8json.FNCSEQ)  ){
			msgError("조회 후에 행추가 가능합니다",3);
		}else{
			var tCols = [null,lastinput8json.PJTSEQ,lastinput8json.PGMSEQ,lastinput8json.GRPSEQ,lastinput8json.FNCSEQ];//초기값
			addRow(mygrid8,tCols);
		}
	}

	//행추가9 (svc)
	function addRow9(){
		if( !(lastinput9json) || !(lastinput9json.PJTSEQ) || !(lastinput9json.PGMSEQ)  || !(lastinput9json.GRPSEQ) || !(lastinput9json.FNCSEQ)  ){
			msgError("조회 후에 행추가 가능합니다",3);
		}else{
			var tCols = [null,lastinput9json.PJTSEQ,lastinput9json.PGMSEQ,lastinput9json.GRPSEQ,lastinput9json.FNCSEQ];//초기값
			addRow(mygridSvc,tCols);
		}
	}



    //그리드 조회
    function selectLayoutSplit(tinput){
        alog("selectLayout()------------start");
		var x = window.dhx4.absLeft(tinput);
		var y = window.dhx4.absTop(tinput);
		var w = tinput.offsetWidth;
		var h = tinput.offsetHeight;

        //$("#div_layout").show();

		if(popSelectLayout){
			popSelectLayout.show(x,y,w,h);
			return;
		}


		if(!isLayoutLoaded){

			//불러오기
			$.ajax({
				type : "POST",
				url : mygridLayout_url+"&CTLFNC=SEARCH&" + lastCondition ,
				data : {xmldata : ""},
				dataType: "json",
				async: true,
				success: function(data){
					alog("   gridSearcLayout json return----------------------");
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
							tmp = tmp + "<a href=\"#\" onclick=\"selectLayoutS('" + data.RTN_DATA.rows[i].data[0] + "')\"><img src=\"" + CFG_URL_LIBS_ROOT + "img/" + data.RTN_DATA.rows[i].data[0] +  ".png\" width=50 border=1></a> ";//LAYOUTID

						}
						//내 행 업데이트
						tmp = tmp + "<a href=\"#\" onclick=\"isLayoutLoaded=false;popSelectLayout.hide()\"><img src=\"" + CFG_URL_LIBS_ROOT + "img/close.png\" border=0 width=15></a>";//LAYOUTID

						isLayoutLoaded=true;

						//팝업 객체 띄우기
						popSelectLayout = new dhtmlXPopup();
						popSelectLayout.attachHTML(tmp);

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
    function selectLayout(tinput){
        alog("selectLayout()------------start");
		var x = window.dhx4.absLeft(tinput);
		var y = window.dhx4.absTop(tinput);
		var w = tinput.offsetWidth;
		var h = tinput.offsetHeight;

        //$("#div_layout").show();

		if(popSelectLayout){
			popSelectLayout.show(x,y,w,h);
			return;
		}


		if(!isLayoutLoaded){

			//불러오기
			$.ajax({
				type : "POST",
				url : mygridLayout_url+"&CTLFNC=SEARCH&" + lastCondition ,
				data : {xmldata : ""},
				dataType: "json",
				async: true,
				success: function(data){
					alog("   gridSearcLayout json return----------------------");
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
							tmp = tmp + "<a href=\"#\" onclick=\"selectLayoutD('" + data.RTN_DATA.rows[i].data[0] + "')\"><img src=\"" + CFG_URL_LIBS_ROOT + "img/" + data.RTN_DATA.rows[i].data[0] +  ".png\" width=50 border=1></a> ";//LAYOUTID

						}
						//내 행 업데이트
						tmp = tmp + "<a href=\"#\" onclick=\"isLayoutLoaded=false;popSelectLayout.hide()\"><img src=\"" + CFG_URL_LIBS_ROOT + "img/close.png\" border=0 width=15></a>";//LAYOUTID

						isLayoutLoaded=true;

						//팝업 객체 띄우기
						popSelectLayout = new dhtmlXPopup();
						popSelectLayout.attachHTML(tmp);

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
        if(mygridGrp.getRowsNum() > 0 && !confirm("이미 등록된 행이 있습니다. 삭제 후 재등록 하시겠습니까?")){return}

        //조회후에 선택 가능
        if(!lastinput1json || !lastinput1json.PJTSEQ ){
            alert("프로그램 조회 후에 레이아웃 선택가능합니다.");
            return;
        }
        
        mygridGrp.clearAll();

        //불러오기
        $.ajax({
            type : "POST",
            url : mygridLayoutD_url+"&CTLFNC=SEARCH&" + lastCondition ,
            data : {xmldata : "", F_LAYOUTID : tlayoutid},
            dataType: "json",
            async: true,
            success: function(data){
                alog("   gridSearchLayoutD json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
                    alog(JSON.stringify(data.RTN_DATA));

                    var tCols;
                    $("#spanGrpCnt").text(data.RTN_DATA.rows.length);

                    for(var i=0;i<data.RTN_DATA.rows.length;i++){
                        alog( "   i : " + i);

						//GRP : PJTID,PGMID,GRPID,GRPTYPE,GRPNM		,GRPORD,FREEZECNT,COLBRCNT,REFGRPID,VBOX		,GRPWIDTH,GRPHEIGHT,GRPPADDING,ADDDT,MODDT
                        //LAYOUT : GRPID,GRPTYPE,ORD,REFGRPID,VBOX,GRPWIDTH,GRPHEIGHT
                        

                        //GRPID,GRPTYPE,ORD,REFGRPID,VBOX,GRPWIDTH,GRPHEIGHT
						tCols = [
							lastinput1json.PJTSEQ   //1
                            ,lastinput1json.PGMSEQ
                            ,null //GRPSEQ
                            ,"" //PGRPID
							,data.RTN_DATA.rows[i].data[0] //GRPID
							,data.RTN_DATA.rows[i].data[1] //GRPTYPE
							,"" //GRPNM
							,data.RTN_DATA.rows[i].data[2] //ORD
							,0 //FREEZECNT
							,data.RTN_DATA.rows[i].data[3] //REFGRPID
							,data.RTN_DATA.rows[i].data[4] //VBOX
							,data.RTN_DATA.rows[i].data[5] //GRPWIDTH
							,data.RTN_DATA.rows[i].data[6] //GRPHEIGHT
							,""
                            ,""
                            ,""
                            ,""
                            ,"POST" //METHOD
							];//초기값
						
						addRow(mygridGrp,tCols);


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


    //그리드 조회
    function selectLayoutS(tlayoutid){
        alog("selectLayoutS()------------start");
        alog("	tlayoutid : " + tlayoutid);

        $("#div_layout").hide();
		if(tlayoutid=="")return;

        //기존 행이 있는지 검사해서 삭제 여부 묻기
        if(mygridGrp.getRowsNum() > 0 && !confirm("이미 등록된 행이 있습니다. 삭제 후 재등록 하시겠습니까?")){return}

        //조회후에 선택 가능
        if(!lastinput1json || !lastinput1json.PJTSEQ ){
            alert("프로그램 조회 후에 레이아웃 선택가능합니다.");
            return;
        }
        
        mygridGrp.clearAll();

        //불러오기
        $.ajax({
            type : "POST",
            url : mygridLayoutS_url+"&CTLFNC=SEARCH&" + lastCondition ,
            data : {xmldata : "", F_LAYOUTID : tlayoutid},
            dataType: "json",
            async: true,
            success: function(data){
                alog("   gridSearchLayoutD json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
                    alog(JSON.stringify(data.RTN_DATA));

                    var tCols;
                    $("#spanGrpCnt").text(data.RTN_DATA.rows.length);

                    for(var i=0;i<data.RTN_DATA.rows.length;i++){
                        alog( "   i : " + i);


                        //GRP GRID 컬럼순서
                        // PJTSEQ, PGMSEQ, GRPSEQ, PGRPID, GRPID
                        // , GRPTYPE, GRPNM, GRPORD, FREEZECNT, REFGRPID
                        // ,VBOX,GRPWIDTH,GRPHEIGHT,COLSIZETYPE,LEGENDALIGN
                        // ,STACKED,PROPERTY,METHOD,KEYCOLID,SEQYN
                        // ,SPLITDIRECTION,SPLITGUTTERSIZE,SPLITMINSIZE,ADDDT,MODDT

                        //LAYOUTS 컬럼순서
                        //  GRPID, REFGRPID, ORD, GRPTYPE, GRPWIDTH
			            //  ,GRPHEIGHT, PGRPID, SPLITGUTTERSIZE, SPLITDIRECTION, SPLITMINSIZE

                        tCols = [
							lastinput1json.PJTSEQ   //1
                            ,lastinput1json.PGMSEQ
                            ,"" //GRPSEQ
                            ,data.RTN_DATA.rows[i].data[6] //PGRPID
							,data.RTN_DATA.rows[i].data[0] //GRPID
							,data.RTN_DATA.rows[i].data[3] //GRPTYPE
							,"" //GRPNM
							,data.RTN_DATA.rows[i].data[2] //ORD
							,0 //FREEZECNT
							,data.RTN_DATA.rows[i].data[1] //REFGRPID
							,"" //VBOX
							,data.RTN_DATA.rows[i].data[4] //GRPWIDTH
							,data.RTN_DATA.rows[i].data[5] //GRPHEIGHT
							,""//COLSIZETYPE
                            ,""//LEGENDALIGN
                            ,""//STACKED
                            ,""//PROPERTY
                            ,"POST" //METHOD
                            ,"" //KEYCOLID
                            ,"" //SEQYN
                            ,data.RTN_DATA.rows[i].data[8]  //SPLITDIRECTION
                            ,data.RTN_DATA.rows[i].data[7]  //SPLITGUTTERSIZE
                            ,data.RTN_DATA.rows[i].data[9]  //SPLITMINSIZE
							];//초기값
						
						addRow(mygridGrp,tCols);


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
        if(mygridFnc.getRowsNum() > 0 && !confirm("이미 등록된 행이 있습니다. 삭제 후 재등록 하시겠습니까?")){return}

        mygridFnc.clearAll();

		//선택된 행의 GRPTYPE 가져오기
		var tFnc = mygridGrp.cells(lastrowid1,mygridGrp.getColIndexById("GRPTYPE")).getValue();
		
		alog("	tFnc :  " + tFnc);

        //불러오기
        $.ajax({
            type : "POST",
            url : mygridFnccd_url+"&CTLFNC=SEARCH&" + lastinput5 + "&G1-PCD=FNC" + tFnc ,
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

                    $("#spanFncCnt").text(data.RTN_DATA.rows.length);

                    for(var i=0;i<data.RTN_DATA.rows.length;i++){
                        alog( "   i : " + i);

						tCols = [
							lastinput5json.PJTSEQ
							,lastinput5json.PGMSEQ
                            ,lastinput5json.GRPSEQ
                            ,null
							,"Y"
							,data.RTN_DATA.rows[i].data[0]
							,data.RTN_DATA.rows[i].data[0]
							,data.RTN_DATA.rows[i].data[1]
                            ,data.RTN_DATA.rows[i].data[2]
                            ,10
						];//초기값
						
						addRow(mygridFnc,tCols);

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


		tGrid = mygridSqlR;

        //기존 행이 있는지 검사해서 삭제 여부 묻기
        if(tGrid.getRowsNum() > 0 && !confirm("이미 등록된 행이 있습니다. 삭제 후 재등록 하시겠습니까?")){return}

        tGrid.clearAll();

		//선택된 행의 GRPTYPE 가져오기
		var tCrud = mygridFnc.cells(lastrowid5,mygridFnc.getColIndexById("FNCTYPE")).getValue();
		
		alog("	tCrud :  " + tCrud);

		//alert(tCrud.length);
		//return;

        var tStr = "";
        $("#spanSqlrCnt").text(tCrud.length);

		for(var i=0;i<tCrud.length;i++){
			alog( "   i : " + i);
			tStr = tCrud.substring(i,i+1);
			//SEQ,PJTID,PGMID,GRPID,FNCID,SQLID,ADDDT,MODDT
			tCols = [
				""
				,lastinput7json.PJTSEQ
				,lastinput7json.PGMSEQ
				,lastinput7json.GRPSEQ
				,lastinput7json.FNCSEQ
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


		grpGrid = mygridGrp; //GRP그리드
		sqlGrid = mygridSql; //SQL그리드
		toGrid = mygridIo; //IO그리드


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
            url : mygridIocd_url+"&CTLFNC=SEARCH&" + lastinput4 + "&G2-SQLSEQ=" + sqlGrid.getSelectedRowId(),
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
                    
                    $("#spanIoCnt").text(data.RTN_DATA.rows.length);

                    for(var i=0;i<data.RTN_DATA.rows.length;i++){
                        alog( "   i : " + i);


						//PJTSEQ,PGMSEQ,GRPSEQ,IOSEQ,COLID,COLORD,COLNM,DATATYPE,VALIDSEQ,DATASIZE,OBJTYPE,BRYN,LBLHIDDENYN,LBLWIDTH,OBJWIDTH,OBJHEIGHT,OBJALIGN,KEYYN,SEQYN,HIDDENYN,EDITYN,FNINIT
                        tCols = [
							lastinput4json.PJTSEQ
							,lastinput4json.PGMSEQ
							,lastinput4json.GRPSEQ
                            ,"" //IOSEQ
                            ,data.RTN_DATA.rows[i].data[0] //DDSEQ
							,data.RTN_DATA.rows[i].data[1] //COLID
							,data.RTN_DATA.rows[i].data[2] //COLORD
							,data.RTN_DATA.rows[i].data[3] //COLNM
                            ,data.RTN_DATA.rows[i].data[4] //DATATYPE
							,data.RTN_DATA.rows[i].data[5] //VALIDSEQ                            
							,data.RTN_DATA.rows[i].data[6] //DATASIZE
                            ,data.RTN_DATA.rows[i].data[7] //OBJTYPE
                            ,""
                            ,data.RTN_DATA.rows[i].data[8] //POPUP
							,"N" //BRYN
							,"N" //LBLHIDDENYN
                            ,data.RTN_DATA.rows[i].data[9] //LBLWIDTH
                            ,data.RTN_DATA.rows[i].data[10] //LBLALIGN
							,data.RTN_DATA.rows[i].data[11] //OBJWIDTH
                            ,data.RTN_DATA.rows[i].data[12] //OBJHEIGHT
                            ,data.RTN_DATA.rows[i].data[13] //OBJALIGN
							,"N" //KEYYN
							,"N" //SEQYN
							,"N" //HIDDENYN
							,"Y" //EDITYN
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






    //파일 카피 하기
    function delPgm(){
        alog("delPgm()------------start");

        if(!confirm("정말로 삭제하시겠습니까?")){
            return;
        }

        sendFormData = new FormData();
        sendFormData.append("PJTSEQ",$("#F_PJTSEQ").val());
        sendFormData.append("PGMSEQ",$("#F_PGMSEQ").val());

        //불러오기
        $.ajax({
            type : "POST",
            url : "cg_pgminfo_del.php",
            data : sendFormData,
            processData: false,
            contentType: false,
            dataType: "json",
            async: true,
            success: function(data){
                alog("   delPgm json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
                    msgNotice("[PGM] Del 성공했습니다.",1);
                }else{
                    msgError("[PGM] Del 에러가 발생했습니다.\nRTN_CD : " + data.RTN_CD + "\nERR_CD : " + data.ERR_CD + "\nRTN_MSG :" + data.RTN_MSG,3);
                }

            },
            error: function(error){
                msgError("[PGM] Ajax http 500 error ( " + error + " )",3);
                alog("[PGM] Ajax http 500 error ( " + error + " )");
            }
        });

        alog("delPgm()------------end");
    }


    //파일 카피 하기
    function popCopyPgm(){
        alog("popCopyPgm()------------start");

        sendFormData = new FormData();
        sendFormData.append("FROM_PJTSEQ",$("#F_PJTSEQ").val());
        sendFormData.append("FROM_PGMSEQ",$("#F_PGMSEQ").val());
        sendFormData.append("TO_PJTSEQ",$("#TO_PJTSEQ").val());
        sendFormData.append("TO_PGMID",$("#TO_PGMID").val());

        //불러오기
        $.ajax({
            type : "POST",
            url : "cg_pgminfo_copy.php",
            data : sendFormData,
            processData: false,
            contentType: false,
            dataType: "json",
            async: true,
            success: function(data){
                alog("   popCopyPgm json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
                    msgNotice("[PGM] Copy 성공했습니다.",1);
                }else{
                    msgError("[PGM] Copy 에러가 발생했습니다.\nRTN_CD : " + data.RTN_CD + "\nERR_CD : " + data.ERR_CD + "\nRTN_MSG :" + data.RTN_MSG,3);
                }

            },
            error: function(error){
                msgError("[PGM] Ajax http 500 error ( " + error + " )",3);
                alog("[PGM] Ajax http 500 error ( " + error + " )");
            }
        });

        alog("popCopyPgm()------------end");
    }


    //그리드 조회 (pgm)
    function gridSearchPgm(tinput){
        alog("gridSearchPgm()------------start");

        //그리드 초기화
        mygridPgm.clearAll();

        //불러오기
        $.ajax({
            type : "POST",
            url : mygridPgm_url+"&CTLFNC=SEARCH&" + tinput ,
            data : {POP_PJTSEQ : $("#POP_PJTSEQ").val(),POP_PGMID : $("#POP_PGMID").val(),POP_PGMNM : $("#POP_PGMNM").val(),},
            dataType: "json",
            async: true,
            success: function(data){
                alog("   gridSearchPgm json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){

					var row_cnt = 0;
					if(data.RTN_DATA){
                        row_cnt = data.RTN_DATA.rows.length;
                        $("#spanPgmCnt").text(row_cnt);

						mygridPgm.parse(data.RTN_DATA,"json");
						
					}
					msgNotice("[PGM] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("PGM] 서버 조회중 에러가 발생했습니다.\nRTN_CD : " + data.RTN_CD + "\nERR_CD : " + data.ERR_CD + "\nRTN_MSG :" + data.RTN_MSG,3);
                }


            },
            error: function(error){
				msgError("[PGM] Ajax http 500 error ( " + error + " )",3);
                alog("[PGM] Ajax http 500 error ( " + error + " )");
            }
        });

        alog("gridSearchPgm()------------end");
    }

    //io 팝업 콤보 만들기
    function goGridIoPopCombo(){
        alog("goGridIoPopCombo()----------------start");

        if($("#F_PGMTYPE").val() == "POPUP"){
            //(IO) OBJTYPE 다시 불러오기
            setCodeCombo("GRID",mygridIo.getCombo(mygridIo.getColIndexById("POPUP")),"POPUPCD");   
        }else{
            //(IO) OBJTYPE 다시 불러오기
            setCodeCombo("GRID",mygridIo.getCombo(mygridIo.getColIndexById("POPUP")),"PGMSEQ_POPUP");   
        }

    }


    //그리드 조회
    function grpSearch(tinput){
        alog("grpSearch()------------start");

        //그리드 초기화
        mygridGrp.clearAll();

        //불러오기
        $.ajax({
            type : "POST",
            url : mygridGrp_url+"&CTLFNC=SEARCH&" + tinput ,
            data : {xmldata : ""},
            dataType: "json",
            async: true,
            success: function(data){
                alog("   grpSearch json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){

					var row_cnt = 0;
					if(data.RTN_DATA){

                        $("#spanGrpCnt").text(data.RTN_DATA.rows.length);     

						mygridGrp.parse(data.RTN_DATA,"json");
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

        alog("grpSearch()------------end");
    }

    //그리드 조회
    function gridSearch2(tinput){
        alog("gridSearch2()------------start");

        //그리드 초기화
        mygridSql.clearAll();

        //불러오기
        $.ajax({
            type : "POST",
            url : mygridSql_url+"&CTLFNC=SEARCH&" + tinput ,
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
                        $("#spanSqlCnt").text(data.RTN_DATA.rows.length);

                        //PSQLSEQ 코드 콤보 완성 시키기
                        tCombo = mygridSql.getCombo(mygridSql.getColIndexById("PSQLSEQ"))
                        tCombo.clear(); //비우기
                        tCombo.put("","");
    
                        for(var i=0;i<data.RTN_DATA.rows.length;i++){
                            tcd = data.RTN_DATA.rows[i].data[mygridSql.getColIndexById("SQLSEQ")];
                            tnm = data.RTN_DATA.rows[i].data[mygridSql.getColIndexById("SQLID")]
                            alog( tcd + "=" + tnm);
    
                            tCombo.put(tcd,tnm);
                        }

                        //그리드에 데이터 부어 넣기.
						mygridSql.parse(data.RTN_DATA,"json");
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
        mygridCol.clearAll();

        //불러오기
        $.ajax({
            type : "POST",
            url : mygridCol_url+"&CTLFNC=SEARCH&" + tinput ,
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
                        $("#spanColCnt").text(data.RTN_DATA.rows.length);

						mygridCol.parse(data.RTN_DATA,"json");
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
	function reloadFnc(){
		gridSearchFnc(lastinput5);
    }
    
	//그리드 다시 조회
	function reloadEvt(){
		gridSearchEvt(lastinputEvt);
    }
        
	//그리드 다시 조회
	function gridReload4(){
		gridSearchIo(lastinput4);
	}

	//그리드 다시 조회
	function gridReload2(){
        gridSearch2(lastinput2);
        
        codemirrorInit();//코드미러 비우기
	}

    //그리드 조회
    function gridSearchIo(tinput){
        alog("gridSearchIo()------------start");

        //그리드 초기화
        mygridIo.clearAll();

        //불러오기
        $.ajax({
            type : "POST",
            url : mygridIo_url+"&CTLFNC=SEARCH&" + tinput ,
            data : {xmldata : ""},
            dataType: "json",
            async: true,
            success: function(data){
                alog("   gridSearchIo json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
					var row_cnt = 0;
					if(data.RTN_DATA){
                        $("#spanIoCnt").text(data.RTN_DATA.rows.length);

						mygridIo.parse(data.RTN_DATA,"json");
                        row_cnt = data.RTN_DATA.rows.length;
                        

                        //Inherit Colid콤보 재생성하기
                        tCombo = mygridInherit.getCombo(mygridInherit.getColIndexById("COLID"));
                        tCombo.clear(); //비우기
                        tCombo.put("","");
    
                        for(var i=0;i<data.RTN_DATA.rows.length;i++){
                            alog(data.RTN_DATA.rows[i].data[5] + "=" + data.RTN_DATA.rows[i].data[7]);
    
                            tCombo.put(data.RTN_DATA.rows[i].data[5],data.RTN_DATA.rows[i].data[7]);
                        }
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

        alog("gridSearchIo()------------end");
    }


    //그리드 조회(FNC)
    function gridSearchFnc(tinput){
        alog("gridSearchFnc()------------start");

        //그리드 초기화
        mygridFnc.clearAll();

        $("#spanFncCnt").text("-");

        //불러오기
        $.ajax({
            type : "POST",
            url : mygridFnc_url+"&CTLFNC=SEARCH&" + tinput ,
            data : {xmldata : ""},
            dataType: "json",
            async: true,
            success: function(data){
                alog("   gridSearchFnc json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
					var row_cnt = 0;
					if(data.RTN_DATA){
                        $("#spanFncCnt").text(data.RTN_DATA.rows.length);

						mygridFnc.parse(data.RTN_DATA,"json");
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

        alog("gridSearchFnc()------------end");
    }


    //그리드 조회(EVT)
    function gridSearchEvt(tinput){
        alog("gridSearchEvt()------------start");

        //그리드 초기화
        mygridEvt.clearAll();

        $("#spanEvtCnt").text("-");

        //불러오기
        $.ajax({
            type : "POST",
            url : mygridEvt_url+"&CTLFNC=SEARCH&" + tinput ,
            data : {xmldata : ""},
            dataType: "json",
            async: true,
            success: function(data){
                alog("   gridSearchEvt json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
					var row_cnt = 0;
					if(data.RTN_DATA){
                        $("#spanEvtCnt").text(data.RTN_DATA.rows.length);

						mygridEvt.parse(data.RTN_DATA,"json");
						row_cnt = data.RTN_DATA.rows.length;
					}else{
                        $("#spanEvtCnt").text("0");
                    }
					msgNotice("[EVT] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[EVT] 서버 조회중 에러가 발생했습니다.\nRTN_CD : " + data.RTN_CD + "\nERR_CD : " + data.ERR_CD + "\nRTN_MSG :" + data.RTN_MSG,3);
                }


            },
            error: function(error){
				msgError("[EVT] Ajax http 500 error ( " + error + " )",3);
                alog("[EVT] Ajax http 500 error ( " + error + " )");
            }
        });

        alog("gridSearchEvt()------------end");
    }



    //그리드 조회(INHERIT)
    function gridSearch6(tinput){
        alog("gridSearch6()------------start");

		var tGrid = mygridInherit;

        //그리드 초기화
        tGrid.clearAll();

        //불러오기
        $.ajax({
            type : "POST",
            url : mygridInherit_url+"&CTLFNC=SEARCH&" + tinput ,
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
                        $("#spanInheritCnt").text(data.RTN_DATA.rows.length);

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

		var tGrid = mygridSqlR;

        //그리드 초기화
        tGrid.clearAll();

        //불러오기
        $.ajax({
            type : "POST",
            url : mygridSqlR_url+"&CTLFNC=SEARCH&" + tinput ,
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
                        $("#spanSqlrCnt").text(data.RTN_DATA.rows.length);

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

		var tGrid = mygridSvc;

        //그리드 초기화
        tGrid.clearAll();

        //불러오기
        $.ajax({
            type : "POST",
            url : mygridSvc_url+"&CTLFNC=SEARCH&" + tinput ,
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
                        $("#spanSvcCnt").text(data.RTN_DATA.rows.length);

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





    function addRow1Layout(tGRPID,tGRPTYPE,tGRPORD,tVBOX,tGRPWIDTH,tGRPHEIGHT){
        alog("addRow1Layout()------------start");
        var id=mygridGrp.uid();
		var tREFGRPID = "";
		if(tGRPORD > 1)tREFGRPID = "GRP" + (tGRPORD-1);
        mygridGrp.addRow(id,["GRP"+tGRPORD,tGRPTYPE,tGRPTYPE+tGRPORD,tGRPORD,0,0,tREFGRPID,tVBOX,tGRPWIDTH,tGRPHEIGHT],0);
        mygridGrp.showRow(id);
        mygridGrp.selectRow(0);
        mygridGrp.cells(id,0).cell.wasChanged = true;
        mygridGrp.setUserData(id,"!nativeeditor_status","inserted");
        mygridGrp.setRowTextBold(id);
        addstatusyn1 = true;
        alog("addRow1Layout()------------end");
    }



    function viewGrp(){ 
        if(isViewGrp || isViewGrp == null){
            isViewGrp = false;
            mygridGrp.setColumnHidden(mygridGrp.getColIndexById("PJTSEQ"),true); //PJTSEQ
            mygridGrp.setColumnHidden(mygridGrp.getColIndexById("PGMSEQ"),true); //PGMSEQ
            mygridGrp.setColumnHidden(mygridGrp.getColIndexById("GRPSEQ"),true); //GRPSEQ
            mygridGrp.setColumnHidden(mygridGrp.getColIndexById("FREEZECNT"),true); //그리드용
            mygridGrp.setColumnHidden(mygridGrp.getColIndexById("COLSIZETYPE"),true); //그리드용
            mygridGrp.setColumnHidden(mygridGrp.getColIndexById("LEGENDALIGN"),true); //챠트
            mygridGrp.setColumnHidden(mygridGrp.getColIndexById("STACKED"),true); //챠트
            mygridGrp.setColumnHidden(mygridGrp.getColIndexById("METHOD"),true); //폼뷰-컨디션
    
        }else{
            isViewGrp = true;
            mygridGrp.setColumnHidden(mygridGrp.getColIndexById("PJTSEQ"),false); //PJTSEQ
            mygridGrp.setColumnHidden(mygridGrp.getColIndexById("PGMSEQ"),false); //PGMSEQ
            mygridGrp.setColumnHidden(mygridGrp.getColIndexById("GRPSEQ"),false); //GRPSEQ
            mygridGrp.setColumnHidden(mygridGrp.getColIndexById("FREEZECNT"),false); //그리드용
            mygridGrp.setColumnHidden(mygridGrp.getColIndexById("COLSIZETYPE"),false); //그리드용
            mygridGrp.setColumnHidden(mygridGrp.getColIndexById("LEGENDALIGN"),false); //챠트
            mygridGrp.setColumnHidden(mygridGrp.getColIndexById("STACKED"),false); //챠트
            mygridGrp.setColumnHidden(mygridGrp.getColIndexById("METHOD"),false); //폼뷰-컨디션            

        }

    }

    function grpSave(){
        alog("grpSave()------------start");
        //serialize user data or not,
        //serialize 'selected' attribute for the rows tags,
        //serialize grid structure info,
        //serialize the 'changed' attribute for the cells tags,
        //include just changed rows to serialization,
        //serialize cell values as CDATA sections
	
		tgrid = mygridGrp;

        tgrid.setSerializationLevel(true,false,false,false,true,true);
        var myXmlString = tgrid.serialize();

        //컨디션 데이터 모두 말기
        var ConAllData = $( "#condition1" ).serialize();
        alog("   ConAllData = " + ConAllData);

        var xml = myXmlString;
        //xml = xml.replace(new RegExp("<row","g"),"\n<row");
        //xml = xml.replace(new RegExp("</row","g"),"\n</row");
        //xml = xml.replace(new RegExp("<cell","g"),"\n\t<cell");


       //$("#tt").val(xml);
        //$("#tt2").val(xml2);

        $.ajax({
            type : "POST",
            url : mygridGrp_url+"&CTLFNC=SAVE&" + lastinput2 ,
            data : {"GRP-XML" : myXmlString},
            dataType: "json",
            async: false,
            success: function(data){
                alog("   json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                saveToGrid(tgrid,data.GRP_DATA[0]);

            },
            error: function(error){
				msgError("Ajax http 500 error ( " + error + " )");
                alog("Ajax http 500 error ( " + error + " )");
            }
        });

        addstatusyn2 = false;
        alog("grpSave()------------end");
    }


    function saveSql(){
        alog("saveSql()------------start");
        //serialize user data or not,
        //serialize 'selected' attribute for the rows tags,
        //serialize grid structure info,
        //serialize the 'changed' attribute for the cells tags,
        //include just changed rows to serialization,
        //serialize cell values as CDATA sections

        mygridSql.setSerializationLevel(true,false,false,false,true,true);
        var myXmlString = mygridSql.serialize();

        var xml = myXmlString;
        //xml = "<![CDATA[" + xml + "]]>";
        //xml = xml.replace(new RegExp("<","g"),"<![CDATA[<]]>"); // <= 를 <![CDATA[<=]]>
        //xml = xml.replace(new RegExp("<>","g"),"<![CDATA[<>]]>"); // <> 를  <![CDATA[<>]]>

        //$("#tt").val(xml);
        //$("#tt2").val(xml2);

        $.ajax({
            type : "POST",
            url : mygridSql_url+"&CTLFNC=SAVE&" + lastinput2 ,
            data : {"SQL-XML" : xml},
            dataType: "json",
            async: false,
            success: function(data){
                alog("   json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                if(data.RTN_CD == "200"){
                    saveToGrid(mygridSql,data.GRP_DATA[0]);
                }else{
                    msgError("[SQLD SAVE]  " + data.RTN_MSG,3);
                }


            },
            error: function(error){
				msgError("Ajax http 500 error ( " + error + " )");
                alog("Ajax http 500 error ( " + error + " )");
            }
        });

        addstatusyn2 = false;
        alog("saveSql()------------end");
    }


    function save3(){
        alog("save3()------------start");
        //serialize user data or not,
        //serialize 'selected' attribute for the rows tags,
        //serialize grid structure info,
        //serialize the 'changed' attribute for the cells tags,
        //include just changed rows to serialization,
        //serialize cell values as CDATA sections

        mygridCol.setSerializationLevel(true,false,false,false,true,false);
        var myXmlString = mygridCol.serialize();


        //alog("xml : " + myXmlString);

        //컨디션 데이터 모두 말기
        var ConAllData = $( "#condition1" ).serialize();
        alog("   ConAllData = " + ConAllData);

        var xml = myXmlString;
        xml = xml.replace(new RegExp("<row","g"),"\n<row");
        xml = xml.replace(new RegExp("</row","g"),"\n</row");
        xml = xml.replace(new RegExp("<cell","g"),"\n\t<cell");

        //$("#tt").val(xml);


        $.ajax({
            type : "POST",
            url : mygridCol_url+"&CTLFNC=SAVE&" + lastinput3 ,
            data : {"SQLD-XML" : myXmlString},
            dataType: "json",
            async: false,
            success: function(data){
                alog("   json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
                    saveToGrid(mygridCol,data.GRP_DATA[0]);
                }else{
                    msgError("[SQLD SAVE]  " + data.RTN_MSG,3);
                }
                

            },
            error: function(error){
				msgError("Ajax http 500 error ( " + error + " )");
                alog("Ajax http 500 error ( " + error + " )");
            }
        });

        addstatusyn3 = false;
        alog("save3()------------end");
    }



    function viewFnc(){
        if(viewFnc){
            viewFnc = false;
            mygridFnc.setColumnHidden(0,true); //PJTSEQ
            mygridFnc.setColumnHidden(1,true); //PGMSEQ
            mygridFnc.setColumnHidden(2,true); //GRPSEQ
            mygridFnc.setColumnHidden(3,true); //FNCSEQ
        }else{
            viewFnc = true;
            mygridFnc.setColumnHidden(0,false); //PJTSEQ
            mygridFnc.setColumnHidden(1,false); //PGMSEQ
            mygridFnc.setColumnHidden(2,false); //GRPSEQ
            mygridFnc.setColumnHidden(3,false); //FNCSEQ
        }
    }

    function viewEvt(){
        if(isViewEvt){
            isViewEvt = false;
            mygridEvt.setColumnHidden(0,true); //PJTSEQ
            mygridEvt.setColumnHidden(1,true); //PGMSEQ
            mygridEvt.setColumnHidden(2,true); //GRPSEQ
            mygridEvt.setColumnHidden(3,true); //EVTSEQ
        }else{
            isViewEvt = true;
            mygridEvt.setColumnHidden(0,false); //PJTSEQ
            mygridEvt.setColumnHidden(1,false); //PGMSEQ
            mygridEvt.setColumnHidden(2,false); //GRPSEQ
            mygridEvt.setColumnHidden(3,false); //EVTSEQ
        }
    }




    function evtSave(){
        alog("evtSave()------------start");

        mygridEvt.setSerializationLevel(true,false,false,false,true,true);
        var myXmlString = mygridEvt.serialize();

		//컨디션 데이터 모두 말기
        var ConAllData = $( "#condition1" ).serialize();
        //alog("   ConAllData = " + ConAllData);

        var xml = myXmlString;
        xml = xml.replace(new RegExp("<row","g"),"\n<row");
        xml = xml.replace(new RegExp("</row","g"),"\n</row");
        xml = xml.replace(new RegExp("<cell","g"),"\n\t<cell");

        //$("#tt").val(xml);

        $.ajax({
            type : "POST",
            url : mygridEvt_url+"&CTLFNC=SAVE&" + lastinputEvt ,
            data : {"EVT-XML" : myXmlString},
            dataType: "json",
            async: false,
            success: function(data){
                alog("   evtSave(async:false) return----------------------");
                //alog("   json data : " + data);
                //alog("   json RTN_CD : " + data.RTN_CD);
                //alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
                    saveToGrid(mygridEvt,data.GRP_DATA[0]);
                }else{
                    msgError("[EVT] " + data.RTN_MSG);
                }
                
            },
            error: function(error){
				msgError("[EVT] Ajax http 500 error ( " + error + " )");
                alog("[EVT] Ajax http 500 error ( " + error + " )");
            }
        });

        addstatusynEvt = false;
        alog("evtSave()------------end");
    }


    function fncSave(){
        alog("fncSave()------------start");

        mygridFnc.setSerializationLevel(true,false,false,false,true,true);
        var myXmlString = mygridFnc.serialize();

		//컨디션 데이터 모두 말기
        var ConAllData = $( "#condition1" ).serialize();
        alog("   ConAllData = " + ConAllData);

        var xml = myXmlString;
        xml = xml.replace(new RegExp("<row","g"),"\n<row");
        xml = xml.replace(new RegExp("</row","g"),"\n</row");
        xml = xml.replace(new RegExp("<cell","g"),"\n\t<cell");

        //$("#tt").val(xml);

        $.ajax({
            type : "POST",
            url : mygridFnc_url+"&CTLFNC=SAVE&" + lastinput5 ,
            data : {"FNC-XML" : myXmlString},
            dataType: "json",
            async: false,
            success: function(data){
                alog("   json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                saveToGrid(mygridFnc,data.GRP_DATA[0]);
            },
            error: function(error){
				msgError("Ajax http 500 error ( " + error + " )");
                alog("Ajax http 500 error ( " + error + " )");
            }
        });

        addstatusyn5 = false;
        alog("fncSave()------------end");
    }





    function saveInherit(){
        alog("saveInherit()------------start");

        mygridInherit.setSerializationLevel(true,false,false,false,true,false);
        var myXmlString = mygridInherit.serialize();

		//컨디션 데이터 모두 말기
        var ConAllData = $( "#condition1" ).serialize();
        alog("   ConAllData = " + ConAllData);

        var xml = myXmlString;
        xml = xml.replace(new RegExp("<row","g"),"\n<row");
        xml = xml.replace(new RegExp("</row","g"),"\n</row");
        xml = xml.replace(new RegExp("<cell","g"),"\n\t<cell");

        //$("#tt").val(xml);

        $.ajax({
            type : "POST",
            url : mygridInherit_url+"&CTLFNC=SAVE&" + lastinput5 ,
            data : {"INHERIT-XML" : myXmlString},
            dataType: "json",
            async: false,
            success: function(data){
                alog("   json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
                    saveToGrid(mygridInherit,data.GRP_DATA[0]);
                }else{
                    msgError("[INHERIT SAVE] " + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[INHERIT SAVE] Ajax http 500 error ( " + error + " )",3);
                alog("Ajax http 500 error ( " + error + " )");
            }
        });

        addstatusyn6 = false;
        alog("saveInherit()------------end");
    }


    function save7(){
        alog("save7()------------start");

        mygridSqlR.setSerializationLevel(true,false,false,false,true,false);
        var myXmlString = mygridSqlR.serialize();

		//컨디션 데이터 모두 말기
        var ConAllData = $( "#condition1" ).serialize();
        alog("   ConAllData = " + ConAllData);

        var xml = myXmlString;
        xml = xml.replace(new RegExp("<row","g"),"\n<row");
        xml = xml.replace(new RegExp("</row","g"),"\n</row");
        xml = xml.replace(new RegExp("<cell","g"),"\n\t<cell");

        //$("#tt").val(xml);

        $.ajax({
            type : "POST",
            url : mygridSqlR_url+"&CTLFNC=SAVE&" + lastinput5 ,
            data : {"SQLR-XML" : myXmlString},
            dataType: "json",
            async: false,
            success: function(data){
                alog("   json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
                    saveToGrid(mygridSqlR,data.GRP_DATA[0]);
                }else{
                    msgError("[SQLR SAVE] " + data.RTN_MSG,3);
                }
                
            },
            error: function(error){
				msgError("[SQLR SAVE] Ajax http 500 error ( " + error + " )",3);
                alog("Ajax http 500 error ( " + error + " )");
            }
        });

        addstatusyn7 = false;
        alog("save7()------------end");
    }



	//SVC
    function save9(){
        alog("save9()------------start");

        mygridSvc.setSerializationLevel(true,false,false,false,true,false);
        var myXmlString = mygridSvc.serialize();

		//컨디션 데이터 모두 말기
        var ConAllData = $( "#condition1" ).serialize();
        alog("   ConAllData = " + ConAllData);

        var xml = myXmlString;
        xml = xml.replace(new RegExp("<row","g"),"\n<row");
        xml = xml.replace(new RegExp("</row","g"),"\n</row");
        xml = xml.replace(new RegExp("<cell","g"),"\n\t<cell");

       //$("#tt").val(xml);

        $.ajax({
            type : "POST",
            url : mygridSvc_url+"&CTLFNC=SAVE&" + lastinput9 ,
            data : {"SVC-XML" : myXmlString},
            dataType: "json",
            async: false,
            success: function(data){
                alog("   json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
                    saveToGrid(mygridSvc,data.GRP_DATA[0]);
                }else{
                    msgError("[SVC SAVE] " + data.RTN_MSG,3);
                }
                
            },
            error: function(error){
				msgError("[SVC] Ajax http 500 error ( " + error + " )",3);
                alog("[SVC] Ajax http 500 error ( " + error + " )");
            }
        });

        addstatusyn9 = false;
        alog("save9()------------end");
    }


    function viewIo(){

        if(isViewIo || isViewIo == null){
            isViewIo = false;
            mygridIo.setColumnHidden(0,true); //PJTSEQ
            mygridIo.setColumnHidden(1,true); //PGMSEQ
            mygridIo.setColumnHidden(2,true); //GRPSEQ
            mygridIo.setColumnHidden(3,true); //IOSEQ
            mygridIo.setColumnHidden(4,true); //DDSEQ
            if($("#F_PGMTYPE").val() != "POPUP"){
                mygridIo.setColumnHidden(mygridIo.getColIndexById("POPUP"),true);
            }   
            mygridIo.setColumnHidden(mygridIo.getColIndexById("BTNHIDDENYN"),true); 
        }else{
            isViewIo = true;
            mygridIo.setColumnHidden(0,false); //PJTSEQ
            mygridIo.setColumnHidden(1,false); //PGMSEQ
            mygridIo.setColumnHidden(2,false); //GRPSEQ
            mygridIo.setColumnHidden(3,false); //IOSEQ
            mygridIo.setColumnHidden(4,false); //DDSEQ    
            if($("#F_PGMTYPE").val() != "POPUP"){
                mygridIo.setColumnHidden(mygridIo.getColIndexById("POPUP"),false);   
            }
            mygridIo.setColumnHidden(mygridIo.getColIndexById("BTNHIDDENYN"),false);         
        }

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

        mygridIo.setSerializationLevel(true,false,false,false,true,false);
        //mygridIo.serialize();
        var myXmlString = mygridIo.serialize();


        //alog("xml : " + myXmlString);

        //컨디션 데이터 모두 말기
        var ConAllData = $( "#condition1" ).serialize();
        alog("   ConAllData = " + ConAllData);

        var xml = myXmlString;
        xml = xml.replace(new RegExp("<row","g"),"\n<row");
        xml = xml.replace(new RegExp("</row","g"),"\n</row");
        xml = xml.replace(new RegExp("<cell","g"),"\n\t<cell");

        //$("#tt").val(xml);


        $.ajax({
            type : "POST",
            url : mygridIo_url+"&CTLFNC=SAVE&" + lastinput4 ,
            data : {"IO-XML" : myXmlString},
            dataType: "json",
            async: false,
            success: function(data){
                alog("   json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
                    saveToGrid(mygridIo,data.GRP_DATA[0]);
                }else{
                    msgError("[IO SAVE] " + data.RTN_MSG,3);
                }
                
            },
            error: function(error){
				msgError("Ajax http 500 error ( " + error + " )");
                alog("Ajax http 500 error ( " + error + " )");
            }
        });

        addstatusyn4 = false;
        alog("save4()------------end");
    }





        
    //프로그램 검색
    function pgmCopy(){
        //alert( "#F_PGMNM for .change() called." );
        //alert($("#F_PGMNM").val());

        $("#divPgmCopy").css("display","");
        if(myWins && myWins.window("pgmCopyWindow")){
            //alert("show");
            myWins.window("pgmCopyWindow").show();
        }else{
            //alert("new");
            myWins = new dhtmlXWindows();

            myWins.createWindow({
                id:"pgmCopyWindow",
                left:20,
                top:30,
                width:680,
                height:470,
                caption:"프로그램 Copy"
            });
            //myWins.window("pgmwindow").hideHeader();

            myWins.window("pgmCopyWindow").attachEvent("onClose", function(win){
                //alert(1);
                myWins.window("pgmCopyWindow").hide();
                return false;
            });
            myWins.window("pgmCopyWindow").attachObject("divPgmCopy");
        }

    }

	//프로그램 검색
	function pgmSearch(inputNm){
		//alert( "#F_PGMNM for .change() called." );
		//alert($("#F_PGMNM").val());
        $("#POP_PJTSEQ").val($("#F_PJTSEQ").val());
        $("#POP_PGMID").val($("#F_PGMID").val());
		$("#POP_PGMNM").val($("#F_PGMNM").val());
		$("#divPgm").css("display","");
		if(myWins && myWins.window("pgmwindow")){
			//alert("show");
			myWins.window("pgmwindow").show();
		}else{
			//alert("new");
            myWins = new dhtmlXWindows();
  
			myWins.createWindow({
				id:"pgmwindow",
				left:20,
				top:30,
				width:680,
                height:470,
                caption:"프로그램 검색"
            });
            //myWins.window("pgmwindow").hideHeader();

			myWins.window("pgmwindow").attachEvent("onClose", function(win){
				//alert(1);
				myWins.window("pgmwindow").hide();
				return false;
			});
			myWins.window("pgmwindow").attachObject("divPgm");
		}

		$("#btnPgmSearch2").click();

	}




    function propertyGridInit(){
        var setObj = {
            FREEZECNT: ''
            ,COLSIZETYPE: '',
        };

        //그리드만 있는거 COLSIZETYPE
        //챠트BAR만 있는거 LEGENDALIGN, 스택여부
        //챠트PIE만 있는거 LEGENDALIGN
        //챠트BAR2Y만 있는거 LEGENDALIGN
        var metaObj = {
            FREEZECNT: {group : 'Grid', name : '좌측 고정 컬럼(숫자)',  type: 'text'}
            ,COLSIZETYPE: {group : 'Grid', name : '컬럼 가로 사이즈 타입',  type: 'options', options: [
                {text:'- 선택 -', value: ''}
                ,{text:'px', value: 'X'}
                ,{text:'%', value: 'P'}
            ]}
        };



        // Lets create the grid for it
        $('#divPgGrid').jqPropertyGrid(setObj, {meta: metaObj});
        //$('#pgGrid').css("display","");
        //$('#pgGrid').css({top:50 + 'px', left:200 + 'px'});
        //$('#pgGrid').show();

        // Now create another grid
        var setObj2 = {
            LEGENDALIGN: '',
            STACKED: false,
        };

        // This is the metadata object that describes the target object properties (optional)

        var metaObj2 = {
            LEGENDALIGN: {group: 'Chart', name : '범례 위치',  type: 'options', options: [
                {text:'- 선택 -', value: ''}
                ,{text:'TOP', value: 'TOP'}
                ,{text:'LEFT', value: 'LEFT'}
                ,{text:'RIGHT', value: 'RIGHT'}
                ,{text:'BOTTOM', value: 'BOTTOM'}
            ]},
            STACKED: {group: 'Chart', name : '스택으로 쌓기', type: 'boolean'}
        };

        $('#divPgChart').jqPropertyGrid(setObj2, {meta: metaObj2});
        //$('#pgChart').css("display","");
        //$('#pgChart').css({top:200, left:500, position:'absolute'});
        //$('#pgChart').show();


        //IoPopup
        var setObj3 = {
            POPUP: ''
        };

        // This is the metadata object that describes the target object properties (optional)

        var metaObj3 = {
            POPUP: {group: 'Popup', name : '팝업 프로그램 선택',  type: 'options', options: [
                {text:'- 선택 -', value: ''}
                ,{text:'TOP', value: 'TOP'}
                ,{text:'LEFT', value: 'LEFT'}
                ,{text:'RIGHT', value: 'RIGHT'}
                ,{text:'BOTTOM', value: 'BOTTOM'}
            ]}
        };

        $('#divPgIoPopup').jqPropertyGrid(setObj2, {meta: metaObj2});        


        //IoBtn
        var setObj4 = {
            BTNHIDDENYN: ''
        };

        // This is the metadata object that describes the target object properties (optional)

        var metaObj4 = {
            BTNHIDDENYN: {group: 'Iobtn', name : '버튼 감추기 여부',  type: 'options', options: [
                {text:'- 선택 -', value: ''}
                ,{text:'Y', value: 'Y'}
                ,{text:'N', value: 'N'}
            ]}
        };

        $('#divPgIoBtn').jqPropertyGrid(setObj4, {meta: metaObj4});           
    }

    function viewGrid3(){
        if(isView3){
            alog("viewGrid3..........보여줘");
            isView3 = false;
            
            mygridCol.setColumnHidden(mygridCol.getColIndexById("COLSEQ"),false); //COLSEQ
            mygridCol.setColumnHidden(mygridCol.getColIndexById("PJTSEQ"),false); //PJTSEQ
            mygridCol.setColumnHidden(mygridCol.getColIndexById("PGMSEQ"),false); //PGMSEQ
            mygridCol.setColumnHidden(mygridCol.getColIndexById("SQLSEQ"),false); //SQLSEQ
            mygridCol.setColumnHidden(mygridCol.getColIndexById("DDCOLID"),false); //SQLSEQ
        }else{
            alog("viewGrid3..........숨겨");            
            isView3 = true;

            mygridCol.setColumnHidden(mygridCol.getColIndexById("COLSEQ"),true); //COLSEQ
            mygridCol.setColumnHidden(mygridCol.getColIndexById("PJTSEQ"),true); //PJTSEQ
            mygridCol.setColumnHidden(mygridCol.getColIndexById("PGMSEQ"),true); //PGMSEQ
            mygridCol.setColumnHidden(mygridCol.getColIndexById("SQLSEQ"),true); //SQLSEQ
            mygridCol.setColumnHidden(mygridCol.getColIndexById("DDCOLID"),true); //SQLSEQ
        }

    }

    function goSqlSearch(){
		//alert(lastinput3json.SQLSEQ);
		window.open(CFG_DEMO_URL + "/d.s/CG/sqlsearchView.php","sqlsearch","width=800,height=600,scrollbars=yes");
    }

	function goSqlpreview(){
        //alert(lastinput3json.SQLSEQ);
        var SVRSEQ = mygridSql.cells(mygridSql.getSelectedRowId(), mygridSql.getColIndexById("SVRSEQ")).getValue();
        var SQLSEQ = mygridSql.cells(mygridSql.getSelectedRowId(), mygridSql.getColIndexById("SQLSEQ")).getValue();
		window.open("cg_sqlpreview.php?SVRSEQ=" + SVRSEQ + "&SQLSEQ="+ SQLSEQ + "&PJTSEQ=" + $("#F_PJTSEQ").val(),"sqlpreview","width=1024,height=600,scrollbars=yes");
    }
    
    function goSqlChange(tmp){
        alert(cmSql.getValue());
        cmSql.setValue(tmp);
        alert("goSqlChange2");
    }

    function pgmConditionReset(){
        $("#POP_PGMID").val("");
        $("#POP_PGMNM").val("");
        //$("#POP_PJTSEQ").val("");
    }

    function getAuth(){
        window.open("http://" + window.location.hostname + ":8040/d.s/cg_pgminfo_getauth.php?PJTSEQ=" + $("#F_PJTSEQ").val() + "&PGMSEQ=" + $("#F_PGMSEQ").val());
    }


    function addSqlHint(){
        //alert($("#selSqlHint option:selected").val());
        rid = mygridSql.getSelectedId();
        if(rid == null)return;
        insertText($("#selSqlHint option:selected").val());
    }

    function insertText(data) {
        //var cm = $(".CodeMirror")[0].CodeMirror;
        var doc = cmSql.getDoc();
        var cursor = doc.getCursor(); // gets the line number in the cursor position
        var line = doc.getLine(cursor.line); // get the line contents
        var pos = {
            line: cursor.line
        };
        if (line.length === 0) {
            // check if the line is empty
            // add the data
            doc.replaceRange(data, pos);
        } else {
            // add a new line and the data
            //doc.replaceRange("\n" + data, pos);
            doc.replaceRange(data, pos);
        }   
    }




//Inherit에 뿌려줄 GRP목록 가져오기(FNC선택시, GRP선택시)
function setGridGrp(tGrptype, tCombo, tPjtseq, tPgmseq, tGrpseq, tFncseq){
	alog("   setGridSql----------------------start");
	//alog("		tPcd = " + tPcd);
	
	//alert(tCombo);

	if(!tCombo)return;

	//불러오기
	$.ajax({
		type : "GET",
		url : "/common/cg_code_json.php",
		data : {PCD : "GETGRPLIST", PJTSEQ : tPjtseq, PGMSEQ : tPgmseq, GRPSEQ : tGrpseq , FNCSEQ : tFncseq},
		dataType: "json",
		async: true,
		success: function(data){
			alog("   setGridGrp(async:false) json return----------------------");
			//alog("   json data : " + JSON.stringify(data.RTN_DATA));
			//alog("   json RTN_CD : " + data.RTN_CD);
			//alog("   json ERR_CD : " + data.ERR_CD);
			//alog("   json RTN_MSG length : " + data.RTN_MSG.length);

			//그리드에 데이터 반영
			if(data.RTN_CD == "200"){
				if(tGrptype == "GRID"){
					if(!data.RTN_DATA)return;
					//alog("	코드수 : " + data.RTN_DATA.rows.length);
					
					tCombo.clear(); //비우기
					tCombo.put("","");

					for(var i=0;i<data.RTN_DATA.rows.length;i++){
						//alog(data.RTN_DATA.rows[i].data[1] + "=" + data.RTN_DATA.rows[i].data[2]);

						tCombo.put(data.RTN_DATA.rows[i][0],data.RTN_DATA.rows[i][1]);
					}
				}else{
					alog("	그룹 타입이 없습니다");
				}

			}else{
				alert("서버 조회중 에러가 발생했습니다.\nRTN_CD : " + data.RTN_CD + "\nERR_CD : " + data.ERR_CD + "\nRTN_MSG :" + data.RTN_MSG);
			}
		},
		error: function(error){
			alert("Error:" + error);
		}
	});

	//alog("   setGridCombo----------------------end");

}



//SQL목록 가져오기
function setGridSql(tGrptype, tCombo, tPjtseq, tPgmseq, tSvcseq){
	alog("   setGridSql----------------------start");
	//alog("		tPcd = " + tPcd);
	
	//alert(tCombo);

	if(!tCombo)return;

	//불러오기
	$.ajax({
		type : "GET",
		url : "/common/cg_code_json.php",
		data : {PCD:"GETSVCSQLLIST", PJTSEQ : tPjtseq, PGMSEQ : tPgmseq, SVCSEQ : tSvcseq},
		dataType: "json",
		async: false,
		success: function(data){
			//alog("   getCodeJson json return----------------------");
			//alog("   json data : " + JSON.stringify(data.RTN_DATA));
			//alog("   json RTN_CD : " + data.RTN_CD);
			//alog("   json ERR_CD : " + data.ERR_CD);
			//alog("   json RTN_MSG length : " + data.RTN_MSG.length);

			//그리드에 데이터 반영
			if(data.RTN_CD == "200"){
				if(tGrptype == "GRID"){

                    tCombo.clear(); //비우기
                    tCombo.put("","");
                    
					if(!data.RTN_DATA)return;
					//alog("	코드수 : " + data.RTN_DATA.rows.length);

					for(var i=0;i<data.RTN_DATA.rows.length;i++){
						//alog(data.RTN_DATA.rows[i].data[1] + "=" + data.RTN_DATA.rows[i].data[2]);

						tCombo.put(data.RTN_DATA.rows[i][0],data.RTN_DATA.rows[i][1]);
					}
				}else{
					alog("	그룹 타입이 없습니다");
				}

			}else{
				alert("서버 조회중 에러가 발생했습니다.\nRTN_CD : " + data.RTN_CD + "\nERR_CD : " + data.ERR_CD + "\nRTN_MSG :" + data.RTN_MSG);
			}
		},
		error: function(error){
			alert("Error:" + error);
		}
	});

	//alog("   setGridCombo----------------------end");

}


