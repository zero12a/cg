
    //화면 초기화
    function initBody(){

		//dhtmlx 메시지 박스 초기화
		dhtmlx.message.position="bottom"

        //메시지 박스2
        toastr.options.closeButton = true;
        toastr.options.positionClass = 'toast-bottom-right';

        //컨디션 초기화
        //$("#F_PJTID").val("CG");
        //$("#F_PGMID").val("TEST3");
        $("#F_PJTSEQ").val("3");
        $("#F_PGMSEQ").val("20");

        //조건 폼에 ONCHANGE이벤트 붙이기
        $( "#btnCopyPgm" ).click(function( event ) {
            pgmCopy();
        });

        //조건 폼에 ONCHANGE이벤트 붙이기
        $( "#btnDelPgm" ).click(function( event ) {
            delPgm();
        });
        
		//조건 폼에 ONCHANGE이벤트 붙이기
		$( "#btnPgmSearch1" ).click(function( event ) {
			pgmSearch("F_PGMSEQ");
		});

		//조건 폼에 ONCHANGE이벤트 붙이기
		$( "#F_PGMID" ).keyup(function( event ) {
		  if ( event.which == 13 ) {
			pgmSearch("F_PGMID");
		  }
		});


		//조건 폼에 ONCHANGE이벤트 붙이기
		$( "#F_PGMNM" ).keyup(function( event ) {
		  if ( event.which == 13 ) {
			pgmSearch("F_PGMNM");
		  }
		});

        //날짜 박스 초기
        alog("initBody()---------start")
        
        myCalendar = new dhtmlXCalendarObject([{input:"F_START_DT",
            button:"F_START_DT_ICON"},{input:"F_END_DT",
            button:"F_END_DT_ICON"}]);


                
        //코드 미러 초기화
        cmSql = CodeMirror.fromTextArea(document.getElementById('codemSql'), {
            mode: "text/x-sql",
            styleActiveLine: true,
            indentWithTabs: true,
            smartIndent: true,
            lineWrapping: true,
            lineNumbers: true,
            matchBrackets : true,
            tabSize: 4,
            indentUnit: 4,
            indentWithTabs: true,
            extraKeys: {"Ctrl-Space": "autocomplete"},
            readOnly: true,
			hintOptions: {tables: {
			  users: {name: null, score: null, birthDate: null},
			  countries: {name: null, population: null, size: null}
			}}
        });
        cmSql.setSize("100%","321px");
        
        cmSql.on("change", function(cmSql, change) {
            alog("cmSql change -------------------------------start");
            alog("    cmSql.getValue :  (" + cmSql.getValue() + ")");
            alog("    change.origin : (" + change.origin + ")");
            alog("    change.from : (" + change.to + ")");
            alog("    change.text : (" + change.text + ")");
            alog("    change.removed : (" + change.removed + ")");
            alog("    change.to : (" + change.to + ")");

            //바인드 정보로 리턴하기
            if(change.origin != "setValue"){

                alog("    mygridSql SQLTXT 변경 상태 업데이트. ");
                rid = mygridSql.getSelectedId();
                cidx = mygridSql.getColIndexById("SQLTXT");
                alog("        " + rid + "," + cidx);
                mygridSql.cells(rid,cidx).setValue(cmSql.getValue());
                mygridSql.cells(rid,cidx).cell.wasChanged = true;
	            RowEditStatus = mygridSql.getUserData(rid,"!nativeeditor_status");
				if( RowEditStatus != "inserted" && RowEditStatus != "deleted"){
					mygridSql.setUserData(rid,"!nativeeditor_status","updated");
					mygridSql.setRowTextBold(rid);
				}	
            }

        });
        cmSql.on("focus", function() {
            alog("cmSql focus -------------------------------start");
            rid = mygridSql.getSelectedId();

            alog("       rid : " + rid);

            if(rid == null){
                cmSql.setOption("readOnly",true);
            }else{
                cmSql.setOption("readOnly",false);
            }
        });

        cmSql.on("blur", function() {
            alog("cmSql blur -------------------------------start");
        });



        cmFnc = CodeMirror.fromTextArea(document.getElementById('codemFnc'), {
            mode: "javascript",
            styleActiveLine: true,
            indentWithTabs: true,
            smartIndent: true,
            lineNumbers: true,
            matchBrackets : true,
            tabSize: 4,
            indentUnit: 4,
            indentWithTabs: true,
            extraKeys: {"Ctrl-Space": "autocomplete"},
            readOnly: false,
			hintOptions: {tables: {
			  users: {name: null, score: null, birthDate: null},
			  countries: {name: null, population: null, size: null}
			}}
        });        
        cmFnc.on("change", function(cmFnc, change) {
            alog("cmFnc change -------------------------------start");
            alog("    cmFnc.getValue :  (" + cmFnc.getValue() + ")");
            alog("    change.origin : (" + change.origin + ")");
            alog("    change.from : (" + change.to + ")");
            alog("    change.text : (" + change.text + ")");
            alog("    change.removed : (" + change.removed + ")");
            alog("    change.to : (" + change.to + ")");

            //바인드 정보로 리턴하기
            if(change.origin != "setValue"){

                alog("    mygridFnc USERDEFJS 변경 상태 업데이트. ");
                //rid = mygridFnc.getSelectedId();
                rid = lastSelectPgRowId;

                cidx = mygridFnc.getColIndexById("USERDEFJS");
                alog("        " + rid + "," + cidx);
                mygridFnc.cells(rid,cidx).setValue(cmFnc.getValue());
                mygridFnc.cells(rid,cidx).cell.wasChanged = true;
	            RowEditStatus = mygridFnc.getUserData(rid,"!nativeeditor_status");
				if( RowEditStatus != "inserted" && RowEditStatus != "deleted"){
					mygridFnc.setUserData(rid,"!nativeeditor_status","updated");
					mygridFnc.setRowTextBold(rid);
				}	
            }

        });


        //그리드 초기화(PGM)
        mygridPgm = new dhtmlXGridObject('gridPgm');
		mygridPgm.setUserData("","gridTitle","pgm : pgm list"); //글로별 변수에 그리드 타이블 넣기
        mygridPgm.setImagePath(gridImagePath);
        mygridPgm.setHeader("PJTSEQ,PJTID,PGMSEQ,PGMID,PGMNM,URL,PGMTYPE,VERDT,차수,ADDDT,MODDT");
        mygridPgm.setColumnIds("PJTSEQ,PJTID,PGMSEQ,PGMID,PGMNM,VIEWURL,PGMTYPE,VERDT,DEGREE,ADDDT,MODDT");
        mygridPgm.setInitWidths("40,40,40,60,*,100,60,50,40,70,70")
        mygridPgm.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
		mygridPgm.setColSorting("int,str,int,str,str,str,str,str,int,str,str");

		mygridPgm.enableSmartRendering(false);
        mygridPgm.enableMultiselect(true);

        //mygridPgm.splitAt(5);//'freezes' 0 columns // ROW선택 이벤트
        mygridPgm.init();

        mygridPgm.setColumnHidden(0,true); //PJTSEQ
        //mygridPgm.setColumnHidden(1,true); //PGMSEQ

        

        //mygridPgm.attachEvent("onRowDblClicked",function(rowID,celInd){
        mygridPgm.attachEvent("onRowSelect",function(rowID,celInd){

            alog("mygridPgm - onRowDblClicked ----------start");
            alog("   rowID = " + rowID);
            alog("   celInd = " + celInd);
			


			$("#F_PJTID").val(q(mygridPgm.cells(rowID,mygridPgm.getColIndexById("PJTID")).getValue()));
			$("#F_PGMSEQ").val(q(mygridPgm.cells(rowID,mygridPgm.getColIndexById("PGMSEQ")).getValue()));
			$("#F_PGMID").val(q(mygridPgm.cells(rowID,mygridPgm.getColIndexById("PGMID")).getValue()));
			$("#F_PGMNM").val(q(mygridPgm.cells(rowID,mygridPgm.getColIndexById("PGMNM")).getValue()));
            $("#F_PGMURL").val(q(mygridPgm.cells(rowID,mygridPgm.getColIndexById("VIEWURL")).getValue()));
            $("#F_PGMTYPE").val(q(mygridPgm.cells(rowID,mygridPgm.getColIndexById("PGMTYPE")).getValue()));

            //프로그램이 팝업타입이면 IO에서 POPUP컬럼보이게 처리
            if($("#F_PGMTYPE").val() != "POPUP"){
                mygridIo.setColumnHidden(mygridIo.getColIndexById("POPUP"),true);  
            }else{
                mygridIo.setColumnHidden(mygridIo.getColIndexById("POPUP"),false);  
            }

			if(myWins && myWins.window("pgmwindow"))myWins.window("pgmwindow").hide();
			
			return true;
        });
        mygridPgm.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){

            RowEditStatus = mygridPgm.getUserData(rId,"!nativeeditor_status");
            if(stage == 2
                && RowEditStatus != "inserted"
                && RowEditStatus != "deleted"
                && nValue != oValue
                ){
                if(RowEditStatus == "") {
                    mygridPgm.setUserData(rId,"!nativeeditor_status","updated");
                    mygridPgm.setRowTextBold(rId);
                }
                mygridPGM.cells(rId,cInd).cell.wasChanged = true;
            }
            return true;

        });



        //그리드 초기화(Group)(grp)
        mygridGrp = new dhtmlXGridObject('grid1');
		mygridGrp.setUserData("","gridTitle","grid1 : group list"); //글로별 변수에 그리드 타이블 넣기
        mygridGrp.setImagePath(gridImagePath);
        mygridGrp.setHeader("PJTSEQ,PGMSEQ,GRPSEQ,PGRPID,GRPID,GRPTYPE,GRPNM,ORD,FREEZECNT,REFGRPID,VBOX,GRPWIDTH,GRPHEIGHT,COLSIZETYPE,LEGENDALIGN,STACKED,PPT,METHOD,KEYCOLID,SEQYN,SPLITDIRECTION,SPLITGUTTERSIZE,SPLITMINSIZE,ADDDT,MODDT");
        mygridGrp.setColumnIds("PJTSEQ,PGMSEQ,GRPSEQ,PGRPID,GRPID,GRPTYPE,GRPNM,GRPORD,FREEZECNT,REFGRPID,VBOX,GRPWIDTH,GRPHEIGHT,COLSIZETYPE,LEGENDALIGN,STACKED,PROPERTY,METHOD,KEYCOLID,SEQYN,SPLITDIRECTION,SPLITGUTTERSIZE,SPLITMINSIZE,ADDDT,MODDT");
        mygridGrp.setInitWidths("50,50,40,40,40,40,50,30,30,40,30,40,40,30,30,30,25,30,30,20,50,20,30,50,50");
        mygridGrp.setColTypes("ed,ed,ro,ed,ed,coro,ed,ed,ed,ed,coro,ed,ed,coro,coro,ed,codesearch,ed,ed,ed,ed,ed,ed,ro,ro");
		mygridGrp.setColSorting("int,int,int,int,str,str,int,int,int,int,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str");

		mygridGrp.enableSmartRendering(false);
        mygridGrp.enableMultiselect(true);

        //GRPTYPE 콤보
        //apiCodeCombo("Grp","GRPTYPE",{"PCD":"GRPTYPE"},"");

	    setCodeCombo("GRID",mygridGrp.getCombo(mygridGrp.getColIndexById("GRPTYPE")),"GRPTYPE");
        setCodeCombo("GRID",mygridGrp.getCombo(mygridGrp.getColIndexById("COLSIZETYPE")),"COLSIZETYPE");
        setCodeCombo("GRID",mygridGrp.getCombo(mygridGrp.getColIndexById("VBOX")),"VBOX");        
        setCodeCombo("GRID",mygridGrp.getCombo(mygridGrp.getColIndexById("LEGENDALIGN")),"LEGENDALIGN");        
        
        mygridGrp.splitAt(5);//'freezes' 0 columns // ROW선택 이벤트
        mygridGrp.init();

        //숨기기
        viewGrp();

        mygridGrp.attachEvent("onRowSelect",function(rowID,celInd){
            alog("mygridGrp - onRowSelect ----------start");
            alog("   rowID = " + rowID);
            alog("   celInd = " + celInd);


            //편집모드 일때는 하위 새로고침 안하게 하기
            if($("#GRP_EDIT_MODE").is(":checked"))return false;


            //상태가 편집모드이면 선택시 반응 없음
            RowEditStatus = mygridGrp.getUserData(rowID,"!nativeeditor_status");
            if(RowEditStatus == "inserted" || RowEditStatus == "deleted" || RowEditStatus == "updated"){return false;}
            
            lastrowid1 = rowID;

            //해당행의 grptype의 LAYOUT이면 반응 없음
            var grptype = mygridGrp.cells(lastrowid1,mygridGrp.getColIndexById("GRPTYPE")).getValue();

            if(grptype == "LAYOUT")return false;



            //선택된 ROW의 모든컬럼 추출하기
            var RowAllData;
            RowAllData = getRowsColid(mygridGrp,rowID,"G1");
            alog("   RowAllData = " + RowAllData);

            var ConAllData = $( "#condition1" ).serialize();
            alog("   ConAllData = " + ConAllData);

            //마지막 선송 정보 저장
            lastinput6 = RowAllData + "&" + ConAllData;
            lastinput5 = RowAllData + "&" + ConAllData;
			lastinput4 = RowAllData + "&" + ConAllData;
            lastinputEvt = RowAllData + "&" + ConAllData;

            //KEY컬럼만 자식에게 전달
            lastinput6json = jQuery.parseJSON('{ "__NAME":"lastinput6json"' +
                ', "PJTSEQ" : "' + q(mygridGrp.cells(lastrowid1,mygridGrp.getColIndexById("PJTSEQ")).getValue()) + '"' +
                ', "PGMSEQ" : "' + q(mygridGrp.cells(lastrowid1,mygridGrp.getColIndexById("PGMSEQ")).getValue()) + '"' +
                ', "GRPSEQ" : "' + q(mygridGrp.cells(lastrowid1,mygridGrp.getColIndexById("GRPSEQ")).getValue()) + '"' +
                ', "GRPTYPE" : "' + q(mygridGrp.cells(lastrowid1,mygridGrp.getColIndexById("GRPTYPE")  ).getValue()) + '"' +              
                '}');

            lastinput5json = jQuery.parseJSON('{ "__NAME":"lastinput5json"' +
                ', "PJTSEQ" : "' + q(mygridGrp.cells(lastrowid1,mygridGrp.getColIndexById("PJTSEQ")).getValue()) + '"' +
                ', "PGMSEQ" : "' + q(mygridGrp.cells(lastrowid1,mygridGrp.getColIndexById("PGMSEQ")).getValue()) + '"' +
                ', "GRPSEQ" : "' + q(mygridGrp.cells(lastrowid1,mygridGrp.getColIndexById("GRPSEQ")).getValue()) + '"' +
                ', "GRPTYPE" : "' + q(mygridGrp.cells(lastrowid1,mygridGrp.getColIndexById("GRPTYPE")  ).getValue()) + '"' +                  
                '}');

            lastinput4json = jQuery.parseJSON('{ "__NAME":"lastinput4json"' +
            ', "PJTSEQ" : "' + q(mygridGrp.cells(lastrowid1,mygridGrp.getColIndexById("PJTSEQ")).getValue()) + '"' +
            ', "PGMSEQ" : "' + q(mygridGrp.cells(lastrowid1,mygridGrp.getColIndexById("PGMSEQ")).getValue()) + '"' +
            ', "GRPSEQ" : "' + q(mygridGrp.cells(lastrowid1,mygridGrp.getColIndexById("GRPSEQ")).getValue()) + '"' +
            ', "GRPTYPE" : "' + q(mygridGrp.cells(lastrowid1,mygridGrp.getColIndexById("GRPTYPE")  ).getValue()) + '"' +   
            '}');

            lastinputEvtjson = jQuery.parseJSON('{ "__NAME":"lastinputEvtjson"' +
            ', "PJTSEQ" : "' + q(mygridGrp.cells(lastrowid1,mygridGrp.getColIndexById("PJTSEQ")).getValue()) + '"' +
            ', "PGMSEQ" : "' + q(mygridGrp.cells(lastrowid1,mygridGrp.getColIndexById("PGMSEQ")).getValue()) + '"' +
            ', "GRPSEQ" : "' + q(mygridGrp.cells(lastrowid1,mygridGrp.getColIndexById("GRPSEQ")).getValue()) + '"' +
            ', "GRPTYPE" : "' + q(mygridGrp.cells(lastrowid1,mygridGrp.getColIndexById("GRPTYPE")  ).getValue()) + '"' +   
            '}');

                

            //IO컬럼의 OBJTYPE 다시 불러오기

            alog(grptype);
            switch(grptype) {
                case "CONDITION":
                    //(FNC) FNCTYPE 다시 불러오기
                    setCodeCombo("GRID",mygridFnc.getCombo(mygridFnc.getColIndexById("FNCCD")),"FNCCONDITION");
                    
                    //(IO) OBJTYPE 다시 불러오기
                    setCodeCombo("GRID",mygridIo.getCombo(mygridIo.getColIndexById("OBJTYPE")),"CTCONDITION");

                    //BRYN, LBLHIDDEN, LBLWIDTH 숨기기
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("DATATYPE"),false);   
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("FORMAT"),false);                    
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("BRYN"),false);
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("LBLHIDDENYN"),false);
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("LBLWIDTH"),false);  
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("LBLALIGN"),false);            
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("OBJHEIGHT"),false);       
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("EDITYN"),false);    
                    

                    mygridIo.setColumnHidden(mygridIo.getColIndexById("VALIDSEQ"),false); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("DATASIZE"),false); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("OBJWIDTH"),false); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("OBJALIGN"),false);                     
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("KEYYN"),false); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("SEQYN"),false);   
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("HIDDENYN"),false); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("FNINIT"),false);   
                    
                    //그리드 전용 컬럼 숨기기  
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("FOOTERNM"),true); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("FOOTERMATH"),true);   

                    //스타일 전용 컬럼(BIVEIW 사용중)
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("LBLSTYLE"),false); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("OBJSTYLE"),false); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("OBJ2STYLE"),false); 
                    
                    //BIVIEW 전용 컬럼
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("ICONNM"),true); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("ICONSTYLE"),true); 

                    break;
                case "GRID":
                    //(FNC) FNCTYPE 다시 불러오기
                    setCodeCombo("GRID",mygridFnc.getCombo(mygridFnc.getColIndexById("FNCCD")),"FNCGRID");

                    //(IO) OBJTYPE 다시 불러오기
                    setCodeCombo("GRID",mygridIo.getCombo(mygridIo.getColIndexById("OBJTYPE")),"CTGRID");

                    //필터 불러오기
                    setCodeCombo("GRID",mygridIo.getCombo(mygridIo.getColIndexById("FILTER")),"FILTER");
                    
                    //BRYN, LBLHIDDEN, LBLWIDTH 숨기기
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("DATATYPE"),false); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("FORMAT"),false);                       
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("BRYN"),true);
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("LBLHIDDENYN"),true);
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("LBLWIDTH"),true);
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("LBLALIGN"),true);                    
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("OBJHEIGHT"),true);
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("EDITYN"),true);


                    mygridIo.setColumnHidden(mygridIo.getColIndexById("VALIDSEQ"),false); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("DATASIZE"),false); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("OBJWIDTH"),false); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("OBJALIGN"),false);                     
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("KEYYN"),false); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("SEQYN"),false);   
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("HIDDENYN"),false); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("FNINIT"),false);   

                    //그리드 전용 컬럼 숨기기  
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("FOOTERNM"),false); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("FOOTERMATH"),false);   
                    
                    //스타일 전용 컬럼(BIVEIW 사용중)
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("LBLSTYLE"),true); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("OBJSTYLE"),true); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("OBJ2STYLE"),true); 
                    
                    //BIVIEW 전용 컬럼
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("ICONNM"),true); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("ICONSTYLE"),true); 

                    break;
                case "GRIDBT":
                    //(FNC) FNCTYPE 다시 불러오기
                    setCodeCombo("GRID",mygridFnc.getCombo(mygridFnc.getColIndexById("FNCCD")),"FNCGRIDBT");

                    //(IO) OBJTYPE 다시 불러오기
                    setCodeCombo("GRID",mygridIo.getCombo(mygridIo.getColIndexById("OBJTYPE")),"CTGRIDBT");

                    //BRYN, LBLHIDDEN, LBLWIDTH 숨기기
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("DATATYPE"),false); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("FORMAT"),false);                       
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("BRYN"),true);
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("LBLHIDDENYN"),true);
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("LBLWIDTH"),true);
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("LBLALIGN"),true);                    
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("OBJHEIGHT"),true);
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("EDITYN"),true);


                    mygridIo.setColumnHidden(mygridIo.getColIndexById("VALIDSEQ"),false); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("DATASIZE"),false); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("OBJWIDTH"),false); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("OBJALIGN"),false);                     
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("KEYYN"),false); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("SEQYN"),false);   
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("HIDDENYN"),false); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("FNINIT"),false);   

                    //그리드 전용 컬럼 숨기기  
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("FOOTERNM"),false); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("FOOTERMATH"),false);   
                    
                    //스타일 전용 컬럼(BIVEIW 사용중)
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("LBLSTYLE"),true); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("OBJSTYLE"),true); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("OBJ2STYLE"),true); 
                    
                    //BIVIEW 전용 컬럼
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("ICONNM"),true); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("ICONSTYLE"),true); 

                    break;     
                
                
                case "GRIDJQX":
                    //(FNC) FNCTYPE 다시 불러오기
                    setCodeCombo("GRID",mygridFnc.getCombo(mygridFnc.getColIndexById("FNCCD")),"FNCGRIDJQX");

                    //(IO) OBJTYPE 다시 불러오기
                    setCodeCombo("GRID",mygridIo.getCombo(mygridIo.getColIndexById("OBJTYPE")),"CTGRIDJQX");

                    //필터 불러오기
                    setCodeCombo("GRID",mygridIo.getCombo(mygridIo.getColIndexById("FILTER")),"FILTERGRIDJQX");


                    //BRYN, LBLHIDDEN, LBLWIDTH 숨기기
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("DATATYPE"),false); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("FORMAT"),false);                       
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("BRYN"),true);
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("LBLHIDDENYN"),true);
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("LBLWIDTH"),true);
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("LBLALIGN"),true);                    
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("OBJHEIGHT"),true);
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("EDITYN"),true);


                    mygridIo.setColumnHidden(mygridIo.getColIndexById("VALIDSEQ"),false); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("DATASIZE"),false); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("OBJWIDTH"),false); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("OBJALIGN"),false);                     
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("KEYYN"),false); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("SEQYN"),false);   
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("HIDDENYN"),false); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("FNINIT"),false);   

                    //그리드 전용 컬럼 숨기기  
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("FOOTERNM"),false); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("FOOTERMATH"),false);   
                    
                    //스타일 전용 컬럼(BIVEIW 사용중)
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("LBLSTYLE"),true); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("OBJSTYLE"),true); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("OBJ2STYLE"),true); 
                    
                    //BIVIEW 전용 컬럼
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("ICONNM"),true); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("ICONSTYLE"),true); 

                    break;

                case "GRIDWIX":
                    //alert(1);
                        //(FNC) FNCTYPE 다시 불러오기
                        setCodeCombo("GRID",mygridFnc.getCombo(mygridFnc.getColIndexById("FNCCD")),"FNCGRIDWIX");
    
                        //(IO) OBJTYPE 다시 불러오기
                        setCodeCombo("GRID",mygridIo.getCombo(mygridIo.getColIndexById("OBJTYPE")),"CTGRIDWIX");
    
                        //필터 불러오기
                        setCodeCombo("GRID",mygridIo.getCombo(mygridIo.getColIndexById("FILTER")),"FILTERGRIDWIX");
    
    
                        //BRYN, LBLHIDDEN, LBLWIDTH 숨기기
                        mygridIo.setColumnHidden(mygridIo.getColIndexById("DATATYPE"),false); 
                        mygridIo.setColumnHidden(mygridIo.getColIndexById("FORMAT"),false);                       
                        mygridIo.setColumnHidden(mygridIo.getColIndexById("BRYN"),true);
                        mygridIo.setColumnHidden(mygridIo.getColIndexById("LBLHIDDENYN"),true);
                        mygridIo.setColumnHidden(mygridIo.getColIndexById("LBLWIDTH"),true);
                        mygridIo.setColumnHidden(mygridIo.getColIndexById("LBLALIGN"),true);                    
                        mygridIo.setColumnHidden(mygridIo.getColIndexById("OBJHEIGHT"),true);
                        mygridIo.setColumnHidden(mygridIo.getColIndexById("EDITYN"),true);
    
    
                        mygridIo.setColumnHidden(mygridIo.getColIndexById("VALIDSEQ"),false); 
                        mygridIo.setColumnHidden(mygridIo.getColIndexById("DATASIZE"),false); 
                        mygridIo.setColumnHidden(mygridIo.getColIndexById("OBJWIDTH"),false); 
                        mygridIo.setColumnHidden(mygridIo.getColIndexById("OBJALIGN"),false);                     
                        mygridIo.setColumnHidden(mygridIo.getColIndexById("KEYYN"),false); 
                        mygridIo.setColumnHidden(mygridIo.getColIndexById("SEQYN"),false);   
                        mygridIo.setColumnHidden(mygridIo.getColIndexById("HIDDENYN"),false); 
                        mygridIo.setColumnHidden(mygridIo.getColIndexById("FNINIT"),false);   
    
                        //그리드 전용 컬럼 숨기기  
                        mygridIo.setColumnHidden(mygridIo.getColIndexById("FOOTERNM"),false); 
                        mygridIo.setColumnHidden(mygridIo.getColIndexById("FOOTERMATH"),false);   
                        
                        //스타일 전용 컬럼(BIVEIW 사용중)
                        mygridIo.setColumnHidden(mygridIo.getColIndexById("LBLSTYLE"),true); 
                        mygridIo.setColumnHidden(mygridIo.getColIndexById("OBJSTYLE"),true); 
                        mygridIo.setColumnHidden(mygridIo.getColIndexById("OBJ2STYLE"),true); 
                        
                        //BIVIEW 전용 컬럼
                        mygridIo.setColumnHidden(mygridIo.getColIndexById("ICONNM"),true); 
                        mygridIo.setColumnHidden(mygridIo.getColIndexById("ICONSTYLE"),true); 
    
                        break;
    
                case "FORMVIEW":
                    //(FNC) FNCTYPE 다시 불러오기
                    setCodeCombo("GRID",mygridFnc.getCombo(mygridFnc.getColIndexById("FNCCD")),"FNCFORMVIEW");

                    //(IO) OBJTYPE 다시 불러오기
                    setCodeCombo("GRID",mygridIo.getCombo(mygridIo.getColIndexById("OBJTYPE")),"CTFORMVIEW");

                    //BRYN, LBLHIDDEN, LBLWIDTH 숨기기
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("DATATYPE"),false);      
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("FORMAT"),false);                  
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("BRYN"),false);
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("LBLHIDDENYN"),false);
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("LBLWIDTH"),false);   
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("LBLALIGN"),false);   
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("OBJHEIGHT"),false);    
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("EDITYN"),false);    


                    mygridIo.setColumnHidden(mygridIo.getColIndexById("VALIDSEQ"),false); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("DATASIZE"),false); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("OBJWIDTH"),false); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("OBJALIGN"),false);                     
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("KEYYN"),false); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("SEQYN"),false);   
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("HIDDENYN"),false); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("FNINIT"),false);    

                    //그리드 전용 컬럼 숨기기  
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("FOOTERNM"),true); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("FOOTERMATH"),true);   
                    
                    //스타일 전용 컬럼(BIVEIW 사용중)
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("LBLSTYLE"),false); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("OBJSTYLE"),false); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("OBJ2STYLE"),false); 
                    
                    //BIVIEW 전용 컬럼
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("ICONNM"),true); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("ICONSTYLE"),true); 

                    break;
                case "CHARTBAR":
                    //(FNC) FNCTYPE 다시 불러오기
                    setCodeCombo("GRID",mygridFnc.getCombo(mygridFnc.getColIndexById("FNCCD")),"FNCCHARTBAR");

                    //(IO) OBJTYPE 다시 불러오기
                    setCodeCombo("GRID",mygridIo.getCombo(mygridIo.getColIndexById("OBJTYPE")),"CTCHARTBAR");         
                

                    //BRYN, LBLHIDDEN, LBLWIDTH 숨기기
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("DATATYPE"),true);  
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("FORMAT"),true);                      
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("BRYN"),true);
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("LBLHIDDENYN"),true);
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("LBLWIDTH"),true);   
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("LBLALIGN"),false);   
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("OBJHEIGHT"),true);    
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("EDITYN"),true);   

                    

                    mygridIo.setColumnHidden(mygridIo.getColIndexById("VALIDSEQ"),true); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("DATASIZE"),true);  
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("OBJWIDTH"),true); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("OBJALIGN"),true);                     
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("KEYYN"),true); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("SEQYN"),true);   
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("HIDDENYN"),true); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("FNINIT"),true);    

                    //그리드 전용 컬럼 숨기기  
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("FOOTERNM"),true); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("FOOTERMATH"),true);   

                    //스타일 전용 컬럼(BIVEIW 사용중)
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("LBLSTYLE"),true); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("OBJSTYLE"),true); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("OBJ2STYLE"),true); 
                    
                    //BIVIEW 전용 컬럼
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("ICONNM"),true); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("ICONSTYLE"),true); 
                    
                    break;

                case "CHARTPIE":
                    //(FNC) FNCTYPE 다시 불러오기
                    setCodeCombo("GRID",mygridFnc.getCombo(mygridFnc.getColIndexById("FNCCD")),"FNCCHARTPIE");

                    //(IO) OBJTYPE 다시 불러오기
                    setCodeCombo("GRID",mygridIo.getCombo(mygridIo.getColIndexById("OBJTYPE")),"CTCHARTPIE");    
                             
                    //BRYN, LBLHIDDEN, LBLWIDTH 숨기기
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("DATATYPE"),true);      
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("FORMAT"),true);                  
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("BRYN"),true);
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("LBLHIDDENYN"),true);
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("LBLWIDTH"),true);   
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("LBLALIGN"),false);   
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("OBJHEIGHT"),true);    
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("EDITYN"),true);   

                    mygridIo.setColumnHidden(mygridIo.getColIndexById("POPUP"),true);   
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("VALIDSEQ"),true); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("DATASIZE"),true);  
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("OBJWIDTH"),true); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("OBJALIGN"),true);                      
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("KEYYN"),true); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("SEQYN"),true);   
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("HIDDENYN"),true); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("FNINIT"),true);    

                    //그리드 전용 컬럼 숨기기  
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("FOOTERNM"),true); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("FOOTERMATH"),true);   
                    
                    //스타일 전용 컬럼(BIVEIW 사용중)
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("LBLSTYLE"),true); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("OBJSTYLE"),true); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("OBJ2STYLE"),true); 
                    
                    //BIVIEW 전용 컬럼
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("ICONNM"),true); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("ICONSTYLE"),true); 

                    break;
                                   
                    
                case "CHARTBAR2Y":
                    //(FNC) FNCTYPE 다시 불러오기
                    setCodeCombo("GRID",mygridFnc.getCombo(mygridFnc.getColIndexById("FNCCD")),"FNCCHARTBAR");

                    //(IO) OBJTYPE 다시 불러오기
                    setCodeCombo("GRID",mygridIo.getCombo(mygridIo.getColIndexById("OBJTYPE")),"CTCHARTBAR");         
                

                    //BRYN, LBLHIDDEN, LBLWIDTH 숨기기
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("DATATYPE"),true);    
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("FORMAT"),true);                    
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("BRYN"),true);
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("LBLHIDDENYN"),true);
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("LBLWIDTH"),true);   
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("LBLALIGN"),false);   //Y축 좌/우 설정 필요
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("OBJHEIGHT"),true);    
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("EDITYN"),true);   

                    
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("POPUP"),true);   
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("VALIDSEQ"),true); //데이터 입력은 없으나 하위그룹 상속때문에 필요 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("DATASIZE"),true); //데이터 입력은 없으나 하위그룹 상속때문에 필요 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("OBJWIDTH"),true); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("OBJALIGN"),true);                     
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("KEYYN"),true); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("SEQYN"),true);   
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("HIDDENYN"),true); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("FNINIT"),true);    

                    //그리드 전용 컬럼 숨기기  
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("FOOTERNM"),true); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("FOOTERMATH"),true);    

                    //스타일 전용 컬럼(BIVEIW 사용중)
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("LBLSTYLE"),true); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("OBJSTYLE"),true); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("OBJ2STYLE"),true); 
                    
                    //BIVIEW 전용 컬럼
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("ICONNM"),true); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("ICONSTYLE"),true); 

                    break;
                case "BIVIEW":
                    //(FNC) FNCTYPE 다시 불러오기
                    setCodeCombo("GRID",mygridFnc.getCombo(mygridFnc.getColIndexById("FNCCD")),"FNCBIVIEW");

                    //(IO) OBJTYPE 다시 불러오기
                    setCodeCombo("GRID",mygridIo.getCombo(mygridIo.getColIndexById("OBJTYPE")),"CTBIVIEW");

                    //BRYN, LBLHIDDEN, LBLWIDTH 숨기기
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("DATATYPE"),true);
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("FORMAT"),true);    

                    mygridIo.setColumnHidden(mygridIo.getColIndexById("BRYN"),true);
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("LBLHIDDENYN"),true);
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("LBLWIDTH"),true);   
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("LBLALIGN"),true);   
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("OBJHEIGHT"),true);    
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("EDITYN"),true);    

                    mygridIo.setColumnHidden(mygridIo.getColIndexById("POPUP"),true);   
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("VALIDSEQ"),true); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("DATASIZE"),true); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("OBJWIDTH"),true); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("OBJALIGN"),true);                     
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("KEYYN"),true); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("SEQYN"),true);   
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("HIDDENYN"),true); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("FNINIT"),false);    

                    //그리드 전용 컬럼 숨기기  
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("FOOTERNM"),true); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("FOOTERMATH"),true);   

                    //스타일 전용 컬럼(BIVEIW 사용중)
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("LBLSTYLE"),false); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("OBJSTYLE"),false); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("OBJ2STYLE"),false); 
                    
                    //BIVIEW 전용 컬럼
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("ICONNM"),false); 
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("ICONSTYLE"),false); 

                    break;
                default:
                    alog("IO의 OBJTYPE 생성을 위한 GRPTYPE이 아닙니다.(" + grptype + ")");
                    break;
            } 
            

            //그리드 2번 조회(Fnc)
            gridSearchFnc(lastinput5);

            //그리드 4번 조회(Io)
            gridSearchIo(lastinput4);

            //그리드 6번 조회(Inherrit)
            setGridGrp("GRID",mygridInherit.getCombo(mygridInherit.getColIndexById("CHILDGRPID")),$("#F_PJTSEQ").val(),$("#F_PGMSEQ").val(),lastinput6json.GRPSEQ,'');
            gridSearch6(lastinput6);

            //그리드 evt번 조회(Evt)
            setCodeCombo("GRID",mygridEvt.getCombo(mygridEvt.getColIndexById("EVTCD")),"EVT" + grptype);     
            gridSearchEvt(lastinputEvt);


            alog("mygridGrp - onRowSelect ----------end");
        });
        mygridGrp.attachEvent("onBeforeSorting", function(ind,type,direction){
            //any custom logic here
            return !addstatusyn1;
        });


        mygridGrp.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){

            //alog("mygridGrp  onEditCell ------------------start");
            //alog("       stage : " + stage);
            //alog("       rId : " + rId);
            //alog("       cInd : " + cInd);
            //alog("       nValue : " + nValue);
            //alog("       oValue : " + oValue);

            RowEditStatus = mygridGrp.getUserData(rId,"!nativeeditor_status");
            if(stage == 2
                && RowEditStatus != "inserted"
                && RowEditStatus != "deleted"
                && nValue != oValue
                ){
                if(RowEditStatus == "") {
                    mygridGrp.setUserData(rId,"!nativeeditor_status","updated");
                    mygridGrp.setRowTextBold(rId);
                }
                mygridGrp.cells(rId,cInd).cell.wasChanged = true;
            }
            return true;

        });




        //2번째 그리드 초기화(sql)
        mygridSql = new dhtmlXGridObject('grid2');
		mygridSql.setUserData("","gridTitle","grid2 : sql list"); //글로별 변수에 그리드 타이블 넣기
        mygridSql.setImagePath(gridImagePath);
        mygridSql.setHeader("PJTSEQ,PGMSEQ,SQLSEQ,SQLID,SQLNM,SVRSEQ,SVRIDPARAM,CRUD,RTN_TYPE,SQLORD,PSQLID,SQLTXT,ADDDT,MODDT");
        mygridSql.setColumnIds("PJTSEQ,PGMSEQ,SQLSEQ,SQLID,SQLNM,SVRSEQ,SVRIDPARAM,CRUD,RTN_TYPE,SQLORD,PSQLSEQ,SQLTXT,ADDDT,MODDT");
        //mygridSql.attachHeader("#connector_text_filter,#connector_text_filter,#connector_text_filter,#connector_text_filter")
        mygridSql.setInitWidths("50,50,50,50,50,40,40,50,50,50,50,50,50,50")
        mygridSql.setColTypes("ro,ed,ro,ed,ed,coro,ed,coro,coro,ed,coro,txt,ro,ro");
        mygridSql.setColAlign("left,left,left,left,left,left,left,left,,left,left,left,left,left,left")
		mygridSql.setColSorting("str,str,int,str,str,str,str,str,str,int,str,str,str,str");

        //mygridSql.setColumnHidden(0,true);
        //mygridSql.isColumnHidden(0);//PJTID숨기기

        mygridSql.enableSmartRendering(false);
        mygridSql.enableMultiselect(true);
        mygridSql.splitAt(5);//'freezes' 0 columns // ROW선택 이벤트


        mygridSql.init();
        
        //GRPTYPE 콤보
        setCodeCombo("GRID",mygridSql.getCombo(mygridSql.getColIndexById("SVRSEQ")),"SVRSEQ");
        //setCodeCombo("GRID",mygridSql.getCombo(mygridSql.getColIndexById("SVRSEQ")),"DATASOURCE");
        
		setCodeCombo("GRID",mygridSql.getCombo(mygridSql.getColIndexById("CRUD")),"CRUD");
        setCodeCombo("GRID",mygridSql.getCombo(mygridSql.getColIndexById("RTN_TYPE")),"RTN_TYPE");     
        //setCodeCombo("GRID",mygridSql.getCombo(mygridSql.getColIndexById("PSQLSEQ")),"PSQLSEQ");        

        mygridSql.setColumnHidden(0,true); //PJTSEQ
        mygridSql.setColumnHidden(1,true); //PGMSEQ
        mygridSql.setColumnHidden(2,true); //SQLSEQ


        mygridSql.attachEvent("onRowSelect",function(rowID,celInd){
            alog("mygridSql - onRowSelect ----------start");
            //alog("   rowID = " + rowID);
            //alog("   celInd = " + celInd);

            lastrowid2 = rowID;


            var RowAllData = getRowsColid(mygridSql,rowID,"G2");
            //alog("   RowAllData = " + RowAllData);

            var ConAllData = $( "#condition1" ).serialize();
            //alog("   ConAllData = " + ConAllData);

            //마지막 선송 정보 저장
            lastinput3 = ConAllData + "&" + RowAllData;


			//KEY컬럼만 자식에게 전달
            lastinput3json = jQuery.parseJSON('{ "__NAME":"lastinput3json"' +
                ', "PJTSEQ" : "' + q(mygridSql.cells(lastrowid2,0).getValue()) + '"' +
                ', "PGMSEQ" : "' + q(mygridSql.cells(lastrowid2,1).getValue()) + '"' +
                ', "SQLSEQ" : "' + q(mygridSql.cells(lastrowid2,2).getValue()) + '"' +
                '}');


            //세팅하기
            //alert(mygridSql.cells(rowID,celInd).getValue());
            cidx = mygridSql.getColIndexById("SQLTXT");
            alog("   cidx = " + cidx);

			//alert(mygridSql.cells(rowID,cidx-1).getValue());
            cmSql.setValue(mygridSql.cells(rowID,cidx).getValue());

            //행추가 시에는 하위 컬럼 정보 조회 하지 않음.
            RowEditStatus = mygridSql.getUserData(rowID,"!nativeeditor_status");

            //그리드 3번 조회
            if(RowEditStatus != "inserted" && RowEditStatus != "updated")gridSearch3(lastinput3);

            alog("mygridSql - onRowSelect ----------end");
        });

        mygridSql.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){

            //alog("mygridSql  onEditCell ------------------start");
            //alog("       stage : " + stage);
            //alog("       rId : " + rId);
            //alog("       cInd : " + cInd);
            //alog("       nValue : " + nValue);
            //alog("       oValue : " + oValue);

            RowEditStatus = mygridSql.getUserData(rId,"!nativeeditor_status");
            //alog("       RowEditStatus : " + RowEditStatus);            
            if(stage == 2
                && RowEditStatus != "inserted"
                && RowEditStatus != "deleted"
                && nValue != oValue
                ){
                if(RowEditStatus == "") {
                    mygridSql.setUserData(rId,"!nativeeditor_status","updated");
                    mygridSql.setRowTextBold(rId);
                }
                mygridSql.cells(rId,cInd).cell.wasChanged = true;
            }

            //CRUD변경시 자동으로 RTN_TYPE맞춰 주기
            RowEditStatus = mygridSql.getUserData(rId,"!nativeeditor_status");
            if(stage == 2 
                && (RowEditStatus == "inserted" || RowEditStatus == "updated")
                && cInd == mygridSql.getColIndexById("CRUD")){
                crudVal = mygridSql.cells(rId,cInd).getValue();
                //alog("       crudVal : " + crudVal);

                if(crudVal == "C" || crudVal == "U" || crudVal == "D"){
                    mygridSql.cells(rId,mygridSql.getColIndexById("RTN_TYPE")).setValue("RTN_INT");//INT리턴
                }
            }
                        
            return true;

        });

        //mygridSql.loadXML("cg_pjtinfo_crud3.php");




        //5번째 그리드 초기화 (fnc)
        mygridFnc = new dhtmlXGridObject('grid5');
		mygridFnc.setUserData("","gridTitle","grid5 : fnc list"); //글로별 변수에 그리드 타이블 넣기
        mygridFnc.setImagePath(gridImagePath);
        mygridFnc.setHeader("PJTSEQ,PGMSEQ,GRPSEQ,FNCSEQ,USE,FNCID,FNCCD,FNCNM,FNCTYPE,ORD,PPT,UESRDEFJS,ADDDT,MODDT");
        mygridFnc.setColumnIds("PJTSEQ,PGMSEQ,GRPSEQ,FNCSEQ,USEYN,FNCID,FNCCD,FNCNM,FNCTYPE,FNCORD,PROPERTY,USERDEFJS,ADDDT,MODDT");
        mygridFnc.setInitWidths("50,50,50,35,30,50,50,50,30,50,25,50,50,50");
        mygridFnc.setColTypes("ed,ed,ed,ro,ch,ed,coro,ed,ed,ed,codesearch,txttxt,ro,ro");
        mygridFnc.setColAlign("left,left,left,left,center,left,left,left,left,left,left,left,left,left");
		mygridFnc.setColSorting("int,int,int,int,na,str,str,str,str,int,str,str,str,str");

        //mygridSql.isColumnHidden(0);//PJTID숨기기

        mygridFnc.enableSmartRendering(false);
        mygridFnc.enableMultiselect(true);

		//GRPTYPE 콤보
		setCodeCombo("GRID",mygridFnc.getCombo(mygridFnc.getColIndexById("FNCCD")),"FNC");

        mygridFnc.splitAt(5);//'freezes' 0 columns // ROW선택 이벤트
        mygridFnc.init();

        mygridFnc.setColumnHidden(0,true); //PJTSEQ
		mygridFnc.setColumnHidden(1,true); //PGMSEQ
        mygridFnc.setColumnHidden(2,true); //GRPSEQ
        mygridFnc.setColumnHidden(3,true); //FNCSEQ
        mygridFnc.setColumnHidden(mygridFnc.getColIndexById("USERDEFJS"),true); //USERDEFJS

		mygridFnc.attachEvent("onCheck", function(rId,cInd,state){
			// your code here
            alog("mygridFnc - onCheck ----------start");
            alog("   rId = " + rId);
            alog("   cInd= " + cInd);
            alog("   state = " + state);

			mygridFnc.cells(rId,cInd).cell.wasChanged=true;//변경 상태 업데이트
			mygridFnc.setRowTextBold(rId);//변경 상태 업데이트
			mygridFnc.setUserData(rId,"!nativeeditor_status","updated");//변경 상태 업데이트

		});



        mygridFnc.attachEvent("onRowSelect",function(rowID,celInd){
            alog("mygridFnc - onRowSelect ----------start");
            alog("   rowID = " + rowID);
            alog("   celInd = " + celInd);


            lastrowid5 = rowID;

            //상태가 편집모드이면 선택시 반응 없음
            RowEditStatus = mygridFnc.getUserData(rowID,"!nativeeditor_status");
            if(RowEditStatus == "inserted" || RowEditStatus == "deleted" || RowEditStatus == "updated"){return false;}
            
            //선택된 ROW의 모든컬럼 추출하기
            var RowAllData;
            RowAllData = getRowsColid(mygridFnc,rowID,"G5");
            alog("   RowAllData = " + RowAllData);



            var ConAllData = $( "#condition1" ).serialize();
            alog("   ConAllData = " + ConAllData);

            //(SVC) 마지막 전송 정보 저장
            lastinput9 = RowAllData + "&" + ConAllData;

            //(PARAM) 마지막 전송 정보 저장
            lastinputParam = RowAllData + "&" + ConAllData;

			//(SVC) KEY컬럼만 자식에게 전달
            lastinput9json = jQuery.parseJSON('{ "__NAME":"lastinput9json"' +
                ', "PJTSEQ" : "' + q(mygridFnc.cells(lastrowid5,0).getValue()) + '"' +
                ', "PGMSEQ" : "' + q(mygridFnc.cells(lastrowid5,1).getValue()) + '"' +
                ', "GRPSEQ" : "' + q(mygridFnc.cells(lastrowid5,2).getValue()) + '"' +
                ', "FNCSEQ" : "' + q(mygridFnc.cells(lastrowid5,3).getValue()) + '"' +
                '}');


			//(PARAM) KEY컬럼만 자식에게 전달
            lastinputParamjson = jQuery.parseJSON('{ "__NAME":"lastinputParamjson"' +
                ', "PJTSEQ" : "' + q(mygridFnc.cells(lastrowid5,0).getValue()) + '"' +
                ', "PGMSEQ" : "' + q(mygridFnc.cells(lastrowid5,1).getValue()) + '"' +
                ', "GRPSEQ" : "' + q(mygridFnc.cells(lastrowid5,2).getValue()) + '"' +
                ', "FNCSEQ" : "' + q(mygridFnc.cells(lastrowid5,3).getValue()) + '"' +
                '}');


            //(SVC의 SVCGRPSEQ컬럼) 콤보세팅
            setGridGrp("GRID",mygridSvc.getCombo(mygridSvc.getColIndexById("SVCGRPID")),$("#F_PJTSEQ").val(),$("#F_PGMSEQ").val(),null,lastinput9json.FNCSEQ);
            
            //(SVC) 그리드 조회
            gridSearch9(lastinput9);



            alog("mygridFnc - onRowSelect ----------end");
        });
        mygridFnc.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){

            //alog("mygridFnc  onEditCell ------------------start");
            //alog("       stage : " + stage);
            //alog("       rId : " + rId);
            //alog("       cInd : " + cInd);
            //alog("       nValue : " + nValue);
            //alog("       oValue : " + oValue);

            RowEditStatus = mygridFnc.getUserData(rId,"!nativeeditor_status");
            if(stage == 2
                && RowEditStatus != "inserted"
                && RowEditStatus != "deleted"
                && nValue != oValue
                ){
                if(RowEditStatus == "") {
                    mygridFnc.setUserData(rId,"!nativeeditor_status","updated");
                    mygridFnc.setRowTextBold(rId);
                }
                mygridFnc.cells(rId,cInd).cell.wasChanged = true;
            }
            return true;

        });
        //mygridSql.loadXML("cg_pjtinfo_crud3.php");




        //5번째 그리드 초기화 (evt)
        mygridEvt = new dhtmlXGridObject('gridEvt');
		mygridEvt.setUserData("","gridTitle","gridEvt : evt list"); //글로별 변수에 그리드 타이블 넣기
        mygridEvt.setImagePath(gridImagePath);
        mygridEvt.setHeader("PJTSEQ,PGMSEQ,GRPSEQ,EVTSEQ,USE,CD,NM,SRC,ORD,ADDDT,MODDT");
        mygridEvt.setColumnIds("PJTSEQ,PGMSEQ,GRPSEQ,EVTSEQ,USEYN,EVTCD,EVTNM,EVTSRC,EVTORD,ADDDT,MODDT");
        mygridEvt.setInitWidths("50,50,50,50,25,40,40,30,50,50");
        mygridEvt.setColTypes("ed,ed,ed,ed,ch,coro,ed,txttxt,ed,ro,ro");
        mygridEvt.setColAlign("left,left,left,left,center,left,left,left,left,left,left");
		mygridEvt.setColSorting("int,int,int,int,na,str,str,str,int,str,str");

        //mygridSql.isColumnHidden(0);//PJTID숨기기

        mygridEvt.enableSmartRendering(true);
        mygridEvt.enableMultiselect(true);

		//GRPTYPE 콤보
		//setCodeCombo("GRID",mygridEvt.getCombo(mygridFnc.getColIndexById("FNCCD")),"FNC");

        mygridEvt.splitAt(5);//'freezes' 0 columns // ROW선택 이벤트
        mygridEvt.init();
        //mygridEvt.setAwaitedRowHeight(25);

        mygridEvt.setColumnHidden(0,true); //PJTSEQ
		mygridEvt.setColumnHidden(1,true); //PGMSEQ
        mygridEvt.setColumnHidden(2,true); //GRPSEQ
        mygridEvt.setColumnHidden(3,true); //FNCSEQ
        //mygridEvt.setColumnHidden(mygridEvt.getColIndexById("USERDEFJS"),true); //USERDEFJS

		mygridEvt.attachEvent("onCheck", function(rId,cInd,state){
			// your code here
            alog("mygridEvt - onCheck ----------start");
            alog("   rId = " + rId);
            alog("   cInd= " + cInd);
            alog("   state = " + state);

			mygridEvt.cells(rId,cInd).cell.wasChanged=true;//변경 상태 업데이트
			mygridEvt.setRowTextBold(rId);//변경 상태 업데이트
			mygridEvt.setUserData(rId,"!nativeeditor_status","updated");//변경 상태 업데이트

		});



        mygridEvt.attachEvent("onRowSelect",function(rowID,celInd){
            alog("mygridEvt - onRowSelect ----------start1");
            alog("   rowID = " + rowID);
            alog("   celInd = " + celInd);

            alog("mygridEvt - onRowSelect ----------end1");
        });


        mygridEvt.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){

            alog("mygridEvt  onEditCell ------------------start");
            alog("       stage : " + stage);
            alog("       rId : " + rId);
            alog("       cInd : " + cInd);
            alog("       nValue : " + nValue);
            alog("       oValue : " + oValue);

            //cd값이 변경된 경우 해당 cd의 파라미터 힌트정보(coded desc)가져와서 SRC가 비워져 있으면 넣기
            if( stage == 2
                && RowEditStatus == "inserted" 
                && mygridEvt.cells(rId,mygridEvt.getColIndexById("EVTSRC")).getValue() == ""
                ){
                
                //서버에서 DD가져오기
				$.ajax({
					type : "POST",
					url : "/common/cg_code_json.php?PCD=EVT" + lastinputEvtjson.GRPTYPE + "&CD=" + nValue,
					data : { aa :  11 },
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
                                //alert(data.RTN_DATA.CDDESC);
                                mygridEvt.cells(rId,mygridEvt.getColIndexById("EVTSRC")).setValue(data.RTN_DATA.CDDESC);
                            }
                        }
                    }
                });

            }

            RowEditStatus = mygridEvt.getUserData(rId,"!nativeeditor_status");
            if(stage == 2
                && RowEditStatus != "inserted"
                && RowEditStatus != "deleted"
                && nValue != oValue
                ){
                if(RowEditStatus == "") {
                    mygridEvt.setUserData(rId,"!nativeeditor_status","updated");
                    mygridEvt.setRowTextBold(rId);
                }
                mygridEvt.cells(rId,cInd).cell.wasChanged = true;
            }
            return true;

        });
        //mygridSql.loadXML("cg_pjtinfo_crud3.php");



        //6번째 그리드 초기화 (inherit)
        mygridInherit = new dhtmlXGridObject('grid6');
		mygridInherit.setUserData("","gridTitle","grid6 : inherrit list"); //글로별 변수에 그리드 타이블 넣기
        mygridInherit.setImagePath(gridImagePath);
        mygridInherit.setHeader("INHERITSEQ,PJTSEQ,PGMSEQ,GRPSEQ,COLID,CHILDGRPID,ADDDT,MODDT");
        mygridInherit.setColumnIds("INHERITSEQ,PJTSEQ,PGMSEQ,GRPSEQ,COLID,CHILDGRPID,ADDDT,MODDT");
        mygridInherit.setInitWidths("50,50,50,50,50,50,50,50");
        mygridInherit.setColTypes("ro,ed,ed,ed,coro,coro,ro,ro");
        mygridInherit.setColAlign("left,left,left,left,left,left,left,left");
		mygridInherit.setColSorting("int,str,str,str,str,str,str,str");

        //mygridSql.isColumnHidden(0);//PJTID숨기기

        mygridInherit.enableSmartRendering(false);
        mygridInherit.enableMultiselect(true);

        mygridInherit.init();

        mygridInherit.setColumnHidden(0,true); //INHERITSEQ
		mygridInherit.setColumnHidden(1,true); //PJTSEQ
        mygridInherit.setColumnHidden(2,true); //PGMSEQ
        mygridInherit.setColumnHidden(3,true); //GRPSEQ

        mygridInherit.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){

            //alog("mygridInherit  onEditCell ------------------start");
            //alog("       stage : " + stage);
            //alog("       rId : " + rId);
            //alog("       cInd : " + cInd);
            //alog("       nValue : " + nValue);
            //alog("       oValue : " + oValue);

            RowEditStatus = mygridInherit.getUserData(rId,"!nativeeditor_status");
            if(stage == 2
                && RowEditStatus != "inserted"
                && RowEditStatus != "deleted"
                && nValue != oValue
                ){
                if(RowEditStatus == "") {
                    mygridInherit.setUserData(rId,"!nativeeditor_status","updated");
                    mygridInherit.setRowTextBold(rId);
                }
                mygridInherit.cells(rId,cInd).cell.wasChanged = true;
            }
            return true;

        });
        //mygridSql.loadXML("cg_pjtinfo_crud3.php");



        //6번째 그리드 초기화 (sqlR)
        mygridSqlR = new dhtmlXGridObject('grid7');
		mygridSqlR.setUserData("","gridTitle","gridSQLR : fnc list"); //글로별 변수에 그리드 타이블 넣기
        mygridSqlR.setImagePath(gridImagePath);
        mygridSqlR.setHeader("SEQ,PJTSEQ,PGMSEQ,SVCSEQ,SQLID,ORD,ADDDT,MODDT");
        mygridSqlR.setColumnIds("SQLRSEQ,PJTSEQ,PGMSEQ,SVCSEQ,SQLSEQ,ORD,ADDDT,MODDT");
        mygridSqlR.setInitWidths("50,50,50,50,50,50,50,50");
        mygridSqlR.setColTypes("ed,ed,ed,ed,coro,ed,ro,ro");
        mygridSqlR.setColAlign("left,left,left,left,left,left,left,left");
        //mygridSql.isColumnHidden(0);//PJTID숨기기
		mygridSqlR.setColSorting("int,str,str,str,str,int,str,str");

        mygridSqlR.enableSmartRendering(false);
        mygridSqlR.enableMultiselect(true);

        mygridSqlR.init();

        mygridSqlR.setColumnHidden(0,true); //SQLRSEQ
		mygridSqlR.setColumnHidden(1,true); //pjtseq
        mygridSqlR.setColumnHidden(2,true); //pgmseq
        mygridSqlR.setColumnHidden(3,true); //SVCSEQ



        mygridSqlR.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){

            //alog("mygridSqlR  onEditCell ------------------start");
            //alog("       stage : " + stage);
            //alog("       rId : " + rId);
            //alog("       cInd : " + cInd);
            //alog("       nValue : " + nValue);
            //alog("       oValue : " + oValue);

            RowEditStatus = mygridSqlR.getUserData(rId,"!nativeeditor_status");
            if(stage == 2
                && RowEditStatus != "inserted"
                && RowEditStatus != "deleted"
                && nValue != oValue
                ){
                if(RowEditStatus == "") {
                    mygridSqlR.setUserData(rId,"!nativeeditor_status","updated");
                    mygridSqlR.setRowTextBold(rId);
                }
                mygridSqlR.cells(rId,cInd).cell.wasChanged = true;
            }
            return true;

        });
        //mygridSql.loadXML("cg_pjtinfo_crud3.php");



        //3번째 그리드 초기화(col)
        alog("mygridCol........init.......start");        
        mygridCol = new dhtmlXGridObject('grid3');
		mygridCol.setUserData("","gridTitle","grid3 : sql column list"); //글로별 변수에 그리드 타이블 넣기
        mygridCol.setImagePath(gridImagePath);
        mygridCol.setHeader("COLSEQ,PJTSEQ,PGMSEQ,SQLSEQ,DDCOLID,COLID,DD_DATATYPE,SQLGBN,필수YN,ORD,ADDDT,MODDT");
        mygridCol.setColumnIds("COLSEQ,PJTSEQ,PGMSEQ,SQLSEQ,DDCOLID,COLID,DATATYPE,SQLGBN,REQUIREYN,ORD,ADDDT,MODDT");
        //mygridSql.attachHeader("#connector_text_filter,#connector_text_filter,#connector_text_filter,#connector_text_filter")
        mygridCol.setInitWidths("50,50,50,50,50,50,50,50,50,50,50,60");
        mygridCol.setColTypes("ro,ed,ed,ro,ed,ed,ed,coro,ed,ed,ro,ro");
        mygridCol.setColAlign("left,left,left,left,left,left,left,left,left,left,left,left");
		mygridCol.setColSorting("int,int,int,int,str,str,str,str,str,int,str,str");

        mygridCol.enableSmartRendering(false);
        mygridCol.enableMultiselect(true);
        mygridCol.splitAt(6);//'freezes' 0 columns // ROW선택 이벤트        
        
        mygridCol.init();
        isView3=false;
        viewGrid3();//컬럼 숨기기
		//GRPTYPE 콤보
		setCodeCombo("GRID",mygridCol.getCombo(mygridCol.getColIndexById("SQLGBN")),"SQLGBN");


        mygridCol.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){

            //alog("mygridCol  onEditCell ------------------start");
            //alog("       stage : " + stage);
            //alog("       rId : " + rId);
            //alog("       cInd : " + cInd);
            //alog("       nValue : " + nValue);
            //alog("       oValue : " + oValue);

            RowEditStatus = mygridCol.getUserData(rId,"!nativeeditor_status");
            if(stage == 2
                && RowEditStatus != "inserted"
                && RowEditStatus != "deleted"
                && nValue != oValue
                ){
                if(RowEditStatus == "") {
                    mygridCol.setUserData(rId,"!nativeeditor_status","updated");
                    mygridCol.setRowTextBold(rId);
                }
                mygridCol.cells(rId,cInd).cell.wasChanged = true;
            }
            return true;

        });
        //mygridSql.loadXML("cg_pjtinfo_crud3.php");


        //4번째 그리드 초기화(io)
        alog("mygridIo........init.......start");
        mygridIo = new dhtmlXGridObject('grid4');
		mygridIo.setUserData("","gridTitle","grid3 : io list"); //글로별 변수에 그리드 타이블 넣기
        mygridIo.setImagePath(gridImagePath);
        mygridIo.setHeader("PJTSEQ,PGMSEQ,GRPSEQ,IOSEQ,DDSEQ,COLID,ORD,COLNM,DATATYPE,VALIDSEQ,DATASIZE,OBJTYPE,PPT,POP,BRYN,LBLHIDDENYN,LBLWIDTH,LBLALIGN,OBJWIDTH,OBJHEIGHT,OBJALIGN,KEYYN,SEQYN,HIDDENYN,EDITYN,FNINIT,FNCHANGE,FORMAT,FOOTERNM,FOOTERMATH,ICONNM,ICONSTYLE,LBLSTYLE,OBJSTYLE,OBJ2STYLE,PLACEHOLDER,BTNHIDDENYN,FILTER,STOREID,ADDDT,MODDT"); //29

        mygridIo.setColumnIds("PJTSEQ,PGMSEQ,GRPSEQ,IOSEQ,DDSEQ,COLID,COLORD,COLNM,DATATYPE,VALIDSEQ,DATASIZE,OBJTYPE,PROPERTY,POPUP,BRYN,LBLHIDDENYN,LBLWIDTH,LBLALIGN,OBJWIDTH,OBJHEIGHT,OBJALIGN,KEYYN,SEQYN,HIDDENYN,EDITYN,FNINIT,FNCHANGE,FORMAT,FOOTERNM,FOOTERMATH,ICONNM,ICONSTYLE,LBLSTYLE,OBJSTYLE,OBJ2STYLE,PLACEHOLDER,BTNHIDDENYN,FILTER,STOREID,ADDDT,MODDT"); //29

        //mygridSql.attachHeader("#connector_text_filter,#connector_text_filter,#connector_text_filter,#connector_text_filter")
        mygridIo.setInitWidths("50,50,50,50,50,50,30,50,50,50,30,50,25,50,50,50,50,50,50,50,50,50,50,50,50,50,50,50,50,50,50,50,50,50,50,50,50,50,50"); //29
        mygridIo.setColTypes("ed,ed,ed,ro,ro,ed,ed,ed,coro,coro,ed,coro,codesearch,coro,coro,coro,ed,coro,ed,ed,coro,coro,coro,coro,coro,txttxt,txttxt,coro,ed,coro,ed,ed,ed,ed,ed,ed,coro,coro,coro,ro,ro"); //29
        mygridIo.setColAlign("left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left");//29
		mygridIo.setColSorting("str,str,str,str,str,str,int,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str");//29

        mygridIo.enableSmartRendering(true);
        mygridIo.enableMultiselect(true);
        mygridIo.splitAt(6);//'freezes' 0 columns // ROW선택 이벤트
		mygridIo.init();

        mygridIo.setColumnHidden(0,true); //PJTSEQ
        mygridIo.setColumnHidden(1,true); //PGMSEQ
        mygridIo.setColumnHidden(2,true); //GRPSEQ
        mygridIo.setColumnHidden(3,true); //IOSEQ
        mygridIo.setColumnHidden(4,true); //DDSEQ

        //프로그램타입이 팝업이 아닐때 팝업 숨기기
        if($("#F_PGMTYPE").val() != "POPUP"){
            mygridIo.setColumnHidden(mygridIo.getColIndexById("POPUP"),true);   
        }
        mygridIo.setColumnHidden(mygridIo.getColIndexById("BTNHIDDENYN"),true); 

		//GRPTYPE 콤보
		setCodeCombo("GRID",mygridIo.getCombo(mygridIo.getColIndexById("DATATYPE")),"DATATYPE");
		setCodeCombo("GRID",mygridIo.getCombo(mygridIo.getColIndexById("OBJTYPE")),"CTGRID");
        setCodeCombo("GRID",mygridIo.getCombo(mygridIo.getColIndexById("COLFORMAT")),"COLFORMAT");
        setCodeCombo("GRID",mygridIo.getCombo(mygridIo.getColIndexById("LBLALIGN")),"OBJALIGN");
		setCodeCombo("GRID",mygridIo.getCombo(mygridIo.getColIndexById("OBJALIGN")),"OBJALIGN");
        setCodeCombo("GRID",mygridIo.getCombo(mygridIo.getColIndexById("VALIDSEQ")),"VALIDSEQ");
        setCodeCombo("GRID",mygridIo.getCombo(mygridIo.getColIndexById("FOOTERMATH")),"GRIDFOOTER");
        setCodeCombo("GRID",mygridIo.getCombo(mygridIo.getColIndexById("FORMAT")),"OBJFORMAT");
        setCodeCombo("GRID",mygridIo.getCombo(mygridIo.getColIndexById("STOREID")),"FILESTORE");

        //YN 콤보 채우기
        setCodeYN("GRID",mygridIo.getCombo(mygridIo.getColIndexById("BRYN")));
        setCodeYN("GRID",mygridIo.getCombo(mygridIo.getColIndexById("LBLHIDDENYN")));
        setCodeYN("GRID",mygridIo.getCombo(mygridIo.getColIndexById("KEYYN")));
        setCodeYN("GRID",mygridIo.getCombo(mygridIo.getColIndexById("SEQYN")));
        setCodeYN("GRID",mygridIo.getCombo(mygridIo.getColIndexById("HIDDENYN")));
        setCodeYN("GRID",mygridIo.getCombo(mygridIo.getColIndexById("EDITYN")));
        setCodeYN("GRID",mygridIo.getCombo(mygridIo.getColIndexById("BTNHIDDENYN")));

        mygridIo.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){

            //alog("mygridIo  onEditCell ------------------start");
            //alog("       stage : " + stage);
            //alog("       rId : " + rId);
            //alog("       cInd : " + cInd);
            //alog("       COLID : " + mygridIo.getColumnId(cInd));
            //alog("       nValue : " + nValue);
            //alog("       oValue : " + oValue);
			

            RowEditStatus = mygridIo.getUserData(rId,"!nativeeditor_status");
            alog("       RowEditStatus : " + RowEditStatus);

            if(stage == 2
                && RowEditStatus != "inserted"
                && RowEditStatus != "deleted"
                && nValue != oValue
                ){
                

                if(jsonFormValid(eval("obj_G4_valid."+mygridIo.getColumnId(cInd)), "OBJTYPE", "오브젝트타임", nValue)){
                    if(RowEditStatus == "") {
                        mygridIo.setUserData(rId,"!nativeeditor_status","updated");
                        mygridIo.setRowTextBold(rId);
                    }
                    mygridIo.cells(rId,cInd).wasChanged = true;

                }else{
                    return false;
                }
            }





            //컬럼이름이나 컬럼ID로 DD 검색하기 ( cInd == COLID 컬러ID, cInd == COLNM 컬럼명 )
            t_colid =  mygridIo.cells(rId,mygridIo.getColIndexById("COLID")).getValue();

            if(stage == 2 && cInd == mygridIo.getColIndexById("OBJTYPE") &&  t_colid != ""){
                //dd obj불러오기
                t_objtype = mygridIo.cells(rId,mygridIo.getColIndexById("OBJTYPE")).getValue();
                
				//서버에서 DD가져오기
				$.ajax({
					type : "POST",
					url : mygridDd_url+"&CTLFNC=OBJ_SEARCH&" + lastinput5 + "&G1_GRPTYPE=" + lastinput4json.GRPTYPE,
					data : { searchcolid :  t_colid, searchobjtype :  t_objtype, searchgrptype : lastinput4json.GRPTYPE},
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
									//alog( "   i : " + i);
                                    mygridIo.cells(rId,mygridIo.getColIndexById("LBLALIGN")).setValue(data.RTN_DATA.rows[i].data[0]);//DDSEQ
                                    mygridIo.cells(rId,mygridIo.getColIndexById("LBLWIDTH")).setValue(data.RTN_DATA.rows[i].data[1]);//DDSEQ
                                    mygridIo.cells(rId,mygridIo.getColIndexById("OBJALIGN")).setValue(data.RTN_DATA.rows[i].data[2]);//DDSEQ
                                    mygridIo.cells(rId,mygridIo.getColIndexById("OBJHEIGHT")).setValue(data.RTN_DATA.rows[i].data[3]);//DDSEQ
                                    mygridIo.cells(rId,mygridIo.getColIndexById("OBJWIDTH")).setValue(data.RTN_DATA.rows[i].data[4]);//DDSEQ
                                    mygridIo.cells(rId,mygridIo.getColIndexById("FNINIT")).setValue(data.RTN_DATA.rows[i].data[5]);//DDSEQ
                                }
                            }
                            msgNotice("DDOBJ를 조회해서 업데이트 했습니다." + data.RTN_DATA.rows.length + "건",3);
						}else{
							msgError("[DD] 서버 저장중 에러가 발생했습니다.\nRTN_CD : " + data.RTN_CD + "\nERR_CD : " + data.ERR_CD + "\nRTN_MSG :" + data.RTN_MSG,3);
						}


					},
					error: function(error){
						msgError("[DD] Ajax http 500 error ( " + error + " )",3);
						alog("[DD] Ajax http 500 error ( " + error + " )");
					}
                });
                



            }else if(stage == 2 && cInd == mygridIo.getColIndexById("COLID") ){
            //컬럼이름이나 컬럼ID로 DD 검색하기 ( cInd == COLID 컬러ID, cInd == COLNM 컬럼명 )    
				alog("몇번째 컬럼이 변경됨 : " + cInd);

				var ConAllData = $( "#condition1" ).serialize();
				alog("   ConAllData = " + ConAllData);

				//마지막 선송 정보 저장
				lastinput5 =  ConAllData;



				//서버에서 DD가져오기
				$.ajax({
					type : "POST",
					url : mygridDd_url+"&CTLFNC=SEARCH&" + lastinput5 + "&G1_GRPTYPE=" + lastinput4json.GRPTYPE,
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
									//alog( "   i : " + i);

									//내 행 업데이트
                                    //  PJTSEQ,PGMSEQ,GRPSEQ,IOSEQ,DDSEQ
                                    //,COLID,COLORD,COLNM,DATATYPE,VALIDSEQ
                                    //,DATASIZE,OBJTYPE,BRYN,LBLHIDDENYN,LBLWIDTH
                                    //,OBJWIDTH,OBJHEIGHT,OBJALIGN,KEYYN,SEQYN
                                    //,HIDDENYN,EDITYN,FNINIT,ADDDT,MODDT
                                    //alert("COLID:" + mygridIo.getColIndexById("COLID"));
                                    
                                    //alog(121);

                                    mygridIo.cells(rId,mygridIo.getColIndexById("DDSEQ")).setValue(data.RTN_DATA.rows[i].data[1]);//DDSEQ

                                    mygridIo.cells(rId,mygridIo.getColIndexById("COLID")).setValue(data.RTN_DATA.rows[i].data[2]);//COLID
                                    
                                    //alog(122);
									//alert("COLNM:" + mygridIo.getColIndexById("COLNM"));
									mygridIo.cells(rId,mygridIo.getColIndexById("COLNM")).setValue(data.RTN_DATA.rows[i].data[3]);//COLNM

									//alert("DATATYPE:" + mygridIo.getColIndexById("DATATYPE"));
									mygridIo.cells(rId,mygridIo.getColIndexById("DATATYPE")).setValue(data.RTN_DATA.rows[i].data[4]);//DATATYPE

                                    ///alog(123);
									//alert("DATASIZE:" + mygridIo.getColIndexById("DATASIZE"));
									mygridIo.cells(rId,mygridIo.getColIndexById("DATASIZE")).setValue(data.RTN_DATA.rows[i].data[5]);//DATASIZE
                                    //alog(1231);
                                    //alert("OBJTYPE:" + mygridIo.getColIndexById("OBJTYPE"));
                                    //alog(" RTN_DATA 6 = " + data.RTN_DATA.rows[i].data[6]);
                                    //alog(" mygridIo OBJTYPE = " + mygridIo.getColIndexById("OBJTYPE"));
                                    mygridIo.cells(rId,mygridIo.getColIndexById("OBJTYPE")).setValue(data.RTN_DATA.rows[i].data[6]);//OBJTYPE
                                    mygridIo.cells(rId,mygridIo.getColIndexById("POPUP")).setValue(data.RTN_DATA.rows[i].data[7]);//POPUP
									//alog(1232);
									//alert("LBLWIDTH:" + mygridIo.getColIndexById("LBLWIDTH"));
									//mygridIo.cells(rId,mygridIo.getColIndexById("LBLWIDTH")).setValue(data.RTN_DATA.rows[i].data[8]);//LBLWIDTH
                                    //alog(1233);

									//alert("OBJWIDTH:" + mygridIo.getColIndexById("OBJWIDTH"));
									//mygridIo.cells(rId,mygridIo.getColIndexById("OBJWIDTH")).setValue(data.RTN_DATA.rows[i].data[10]);//OBJWIDTH
                                    //alog(1234);
									//alert("OBJHEIGHT:" + mygridIo.getColIndexById("OBJHEIGHT"));
									//mygridIo.cells(rId,mygridIo.getColIndexById("OBJHEIGHT")).setValue(data.RTN_DATA.rows[i].data[11]);//OBJHEIGHT
                                    //alog(1235);
									mygridIo.cells(rId,mygridIo.getColIndexById("VALIDSEQ")).setValue(data.RTN_DATA.rows[i].data[12]);//VALIDSEQ

                                    //정렬
                                    //mygridIo.cells(rId,mygridIo.getColIndexById("LBLALIGN")).setValue(data.RTN_DATA.rows[i].data[13]);
                                    //mygridIo.cells(rId,mygridIo.getColIndexById("OBJALIGN")).setValue(data.RTN_DATA.rows[i].data[14]);
                                    //alog(124);

									//기타 기본값
                                    mygridIo.cells(rId,mygridIo.getColIndexById("COLORD")).setValue("10");

									mygridIo.cells(rId,mygridIo.getColIndexById("LBLHIDDENYN")).setValue("N");
									mygridIo.cells(rId,mygridIo.getColIndexById("BRYN")).setValue("N");
									mygridIo.cells(rId,mygridIo.getColIndexById("KEYYN")).setValue("N");
                                    mygridIo.cells(rId,mygridIo.getColIndexById("SEQYN")).setValue("N");
                                    mygridIo.cells(rId,mygridIo.getColIndexById("HIDDENYN")).setValue("N");
                                    mygridIo.cells(rId,mygridIo.getColIndexById("EDITYN")).setValue("Y");
                                
                                    //alog(125);
										
								}
                            }
                            
                            msgNotice("DD를 조회해서 업데이트 했습니다." + data.RTN_DATA.rows.length + "건",3);

						}else{
							msgError("[DD] 서버 저장중 에러가 발생했습니다.\nRTN_CD : " + data.RTN_CD + "\nERR_CD : " + data.ERR_CD + "\nRTN_MSG :" + data.RTN_MSG,3);
						}


					},
					error: function(error){
						msgError("[DD] Ajax http 500 error ( " + error + " )",3);
						alog("[DD] Ajax http 500 error ( " + error + " )");
					}
				});

			}



			alog("6666");
            return true;

        });






		//9번째 그리드 초기화(SVC)
		alog("grid9-----------------------------start");
		mygridSvc = new dhtmlXGridObject('grid9');
		mygridSvc.setUserData("","gridTitle","grid9 : sql column list"); //글로별 변수에 그리드 타이블 넣기
		mygridSvc.setImagePath(gridImagePath);
		mygridSvc.setHeader("SVCSEQ,PJTSEQ,PGMSEQ,GRPSEQ,FNCSEQ,ORD,SVCGRPID,ADDDT,MODDT");
		mygridSvc.setColumnIds("SVCSEQ,PJTSEQ,PGMSEQ,GRPSEQ,FNCSEQ,ORD,SVCGRPID,ADDDT,MODDT");
		mygridSvc.setInitWidths("50,50,50,50,50,50,50,50,50");
		mygridSvc.setColTypes("ro,ed,ed,ed,ed,ed,coro,ro,ro");
		mygridSvc.setColAlign("left,left,left,left,left,left,left,left,left");
		mygridSvc.setColSorting("int,str,str,str,str,int,str,str,str");


		mygridSvc.enableSmartRendering(false);
		mygridSvc.enableMultiselect(true);
		mygridSvc.init();

		mygridSvc.setColumnHidden(0,true); //SVCSEQ
		mygridSvc.setColumnHidden(1,true); //PJTSEQ
		mygridSvc.setColumnHidden(2,true); //PGMSEQ
		mygridSvc.setColumnHidden(3,true); //GRPSEQ
		mygridSvc.setColumnHidden(4,true); //FNCSEQ

		mygridSvc.attachEvent("onRowSelect",function(rowID,celInd){
            alog("mygridSvc - onRowSelect ----------start");
            alog("   rowID = " + rowID);
            alog("   celInd = " + celInd);

            //상태가 편집모드이면 선택시 반응 없음
            RowEditStatus = mygridSvc.getUserData(rowID,"!nativeeditor_status");
            if(RowEditStatus == "inserted" || RowEditStatus == "deleted" || RowEditStatus == "updated"){return false;}
            

            lastrowid5 = rowID;

            //선택된 ROW의 모든컬럼 추출하기
            var RowAllData;
            RowAllData = getRowsColid(mygridSvc,rowID,"G9");
            alog("   RowAllData = " + RowAllData);



            var ConAllData = $( "#condition1" ).serialize();
            alog("   ConAllData = " + ConAllData);

            //(SQLR) 마지막 전송 정보 저장
            lastinput7 = RowAllData + "&" + ConAllData;


			//(SQLR) KEY컬럼만 자식에게 전달
            lastinput7json = jQuery.parseJSON('{ "__NAME":"lastinput7json"' +
                ', "SVCSEQ" : "' + q(mygridSvc.cells(lastrowid5,0).getValue()) + '"' +
                ', "PJTSEQ" : "' + q(mygridSvc.cells(lastrowid5,1).getValue()) + '"' +
                ', "PGMSEQ" : "' + q(mygridSvc.cells(lastrowid5,2).getValue()) + '"' +
                ', "GRPSEQ" : "' + q(mygridSvc.cells(lastrowid5,3).getValue()) + '"' +
                ', "FNCSEQ" : "' + q(mygridSvc.cells(lastrowid5,4).getValue()) + '"' +
                '}');


            //(SQR의 SQL컬럼) 콤보세팅
            setGridSql("GRID",mygridSqlR.getCombo(mygridSqlR.getColIndexById("SQLSEQ")),$("#F_PJTSEQ").val(),$("#F_PGMSEQ").val(),mygridSvc.cells(lastrowid5,0).getValue());
            
            //(SQLR) 그리드 조회
            gridSearch7(lastinput7);



        

            alog("mygridSvc - onRowSelect ----------end");
        });

		mygridSvc.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){

			//alog("mygridSvc  onEditCell ------------------start");
			//alog("       stage : " + stage);
			//alog("       rId : " + rId);
			//alog("       cInd : " + cInd);
			//alog("       nValue : " + nValue);
			//alog("       oValue : " + oValue);

			RowEditStatus = mygridSvc.getUserData(rId,"!nativeeditor_status");
			if(stage == 2
				&& RowEditStatus != "inserted"
				&& RowEditStatus != "deleted"
				&& nValue != oValue
				){
				if(RowEditStatus == "") {
					mygridSvc.setUserData(rId,"!nativeeditor_status","updated");
					mygridSvc.setRowTextBold(rId);
				}
				mygridSvc.cells(rId,cInd).cell.wasChanged = true;
			}
			return true;

		});


        //Grp에 따른 프로퍼티 그리드 초기화
        //propertyGridInit();

        //grpPropertyGrid();
        
		alog("initBody-----------------------------end");

    }//initBody();