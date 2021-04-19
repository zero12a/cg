
    //프로퍼티 그리드 커스텀 타입
    var theCustomTypes = {
        icon: {
            html: function(elemId, name, value, meta) { // custom renderer for type (required)
                return '<i class="fa fa-' + value + '"></i>';
            },
            valueFn: function() {return 'Icon field value';}
        },
        textarea: {
            html: function(elemId, name, value, meta) {
                var html = '<div name="' + elemId + '" id="aceEditorObj" rows=6 style="overflow-x: auto; width:100%">';
                if (value instanceof Array) {
                    html += value.join("\n");
                }
                html += '</div>';
                return html;
            },
            makeValueFn: function(elemId, name, value, meta) {
                return function() {
                    return $('#' + elemId).val().split('\n');
                }
            }
        }
    };


    //('" + tGrpId + "','" + rowId + "','" + colIndex + "','" +  tValue + "','" + tText + "')
    function goGridPopOpen(tGrpId,rowId,colIndex,tValue,tText,tObject){
        alog("goGridPopOpen() tGrpId=" + tGrpId + ", rowId=" + rowId + ", colIndex=" + colIndex + ", tValue=" + tValue + ", tText=" + tText);
        
        lastSelectPgRowId = rowId;

        var groupNm = tText + "(" + tValue + ")";
        
        //오브젝트 정보 얻기
        var x = window.dhx4.absLeft(tObject);
		var y = window.dhx4.absTop(tObject);
		//var w = tObject.offsetWidth;
        //var h = tObject.offsetHeight;
        alog("tObject x=" + x + ", y=" + y);
        
        //일단 다 숨기기 시작
        $("#divPgGrpGrid").css("display","none");
        $("#divPgGrpChart").css("display","none");
        $("#divPgFncUserdefJS").css("display","none");
        
        if(tGrpId =="FNC"){
            //$("#divPgFncUserdefJS").css("display","");

            //mygridGrp.cells(rowId,mygridGrp.getColIndexById("GRPTYPE")).getValue() 
            var fncCd = mygridFnc.cells(rowId,mygridFnc.getColIndexById("FNCCD")).getValue();
            alog("fncCd=" + fncCd);
            if(fncCd == "USERDEF"){

                var userDefJs = mygridFnc.cells(rowId,mygridFnc.getColIndexById("USERDEFJS")).getValue();
                //userDefJs = userDefJs + " my script";
                cmFnc.setValue(userDefJs);
                cmFnc.refresh();//이거 안하면 코드미러 깨짐.

                grpPropertyGrid("divPgFncUserdefJS","(FNC) 그리드",x,y,500,365);

            }else{
                msgError(fncCd + "의 프로퍼티 레이어가 정의되지 않았습니다.",3);
            }
        }else if(tGrpId == "IO"){
            var objType = mygridIo.cells(rowId,mygridIo.getColIndexById("OBJTYPE")).getValue();
            //alert(objType);

            if(objType == "CODEMIRROR" || objType == "SIGNPAD" || objType == "WEJODIT"){
                //버튼컨트롤 프로퍼티

                var btnHiddenYn = mygridIo.cells(rowId,mygridIo.getColIndexById("BTNHIDDENYN")).getValue()

                //IoBtn
                var setObj = {
                    BTNHIDDENYN: btnHiddenYn
                };

                var metaObj = {
                    BTNHIDDENYN: {group: 'Iobtn', name : '버튼 감추기 여부',  type: 'options', options: [
                        {text:'- 선택 -', value: ''}
                        ,{text:'Y', value: 'Y'}
                        ,{text:'N', value: 'N'}
                    ]}
                };

                // Lets create the grid for it
                $('#divPgIoBtn').jqPropertyGrid(setObj, {meta: metaObj, callback: pgIoBtnChange});

                grpPropertyGrid("divPgIoBtn","(IO) 버튼컨트롤있는 오브젝트",x,y,300,200);

            }else if(objType == "CODESEARCH" || objType == "BUTTON" ){
                //팝업 프로퍼티
                var txtPopup = mygridIo.cells(rowId,mygridIo.getColIndexById("POPUP")).getValue()

                tCombo = mygridIo.getCombo(mygridIo.getColIndexById("POPUP"));
                alog(tCombo);

                pgCombo = [];
                pgCombo[0] = {text:'- 선택 -', value: ''};
                for(i=0;i<tCombo.keys.length;i++){
                    pgCombo[i+1] = {
                        text: tCombo.values[i], value: tCombo.keys[i]
                    };
                }
                alog(pgCombo);

                //IoBtn
                var setObj = {
                    POPUP: txtPopup
                };

                var metaObj = {
                    POPUP: {group: 'PopUp', name : '팝업 프로그램',  type: 'options', options: pgCombo}
                };

                // Lets create the grid for it
                $('#divPgIoPopup').jqPropertyGrid(setObj, {meta: metaObj, callback: pgIoPopupChange});

                grpPropertyGrid("divPgIoPopup","(IO) 코드서치 팝업",x,y,300,200);
            }else{
                alert("IO그리드에 해당 프로퍼티가 없습니다.");
            }


        }else if(tGrpId =="GRP"){
            //mygridGrp.cells(rowId,mygridGrp.getColIndexById("GRPTYPE")).getValue() 
            var grpType = mygridGrp.cells(rowId,mygridGrp.getColIndexById("GRPTYPE")).getValue();
            alog("grpType=" + grpType);
            if(grpType == "GRID" || grpType == "GRIDWIX"){
                var freezeCnt = mygridGrp.cells(rowId,mygridGrp.getColIndexById("FREEZECNT")).getValue();
                var colSizeType = mygridGrp.cells(rowId,mygridGrp.getColIndexById("COLSIZETYPE")).getValue();

                var setObj = {
                    FREEZECNT: freezeCnt
                    ,COLSIZETYPE: colSizeType
                };
        
                //그리드만 있는거 COLSIZETYPE
                //챠트BAR만 있는거 LEGENDALIGN, 스택여부
                //챠트PIE만 있는거 LEGENDALIGN
                //챠트BAR2Y만 있는거 LEGENDALIGN

                var metaObj = {
                    FREEZECNT: {group :groupNm , name : '좌측 고정 컬럼(숫자)',  type: 'text'}
                    ,COLSIZETYPE: {group : groupNm, name : '컬럼 가로 사이즈 타입',  type: 'options', options: [
                        {text:'- 선택 -', value: ''}
                        ,{text:'px', value: 'X'}
                        ,{text:'%', value: 'P'}
                    ]}
                };

        
                // Lets create the grid for it
                $('#divPgGrpGrid').jqPropertyGrid(setObj, {meta: metaObj, callback: pgGrpGridChange});

                grpPropertyGrid("divPgGrpGrid","(GRP) 그리드",x,y,300,200);


            }else if(grpType == "FORMVIEW" || grpType == "CONDITION"){
                var formMethod = mygridGrp.cells(rowId,mygridGrp.getColIndexById("METHOD")).getValue();

                var setObj = {
                    METHOD: formMethod
                };
        
                //그리드만 있는거 COLSIZETYPE
                //챠트BAR만 있는거 LEGENDALIGN, 스택여부
                //챠트PIE만 있는거 LEGENDALIGN
                //챠트BAR2Y만 있는거 LEGENDALIGN

                var metaObj = {
                    METHOD: {group : groupNm, name : '폼 Method',  type: 'options', options: [
                        {text:'- 선택 -', value: ''}
                        ,{text:'POST', value: 'POST'}
                        ,{text:'GET', value: 'GET'}
                    ]}
                };

        
                // Lets create the grid for it
                $('#divPgGrpFormview').jqPropertyGrid(setObj, {meta: metaObj, callback: pgGrpFormviewChange});

                grpPropertyGrid("divPgGrpFormview","(GRP) 폼뷰",x,y,300,200);


            }else if(grpType == "CHARTBAR" || grpType == "CHARTPIE" || grpType == "CHARTBAR2Y"){
                
                var legendAlign = mygridGrp.cells(rowId,mygridGrp.getColIndexById("LEGENDALIGN")).getValue();
                var stacked = mygridGrp.cells(rowId,mygridGrp.getColIndexById("STACKED")).getValue();

                // Now create another grid
                var setObj2 = {
                    LEGENDALIGN: legendAlign,
                    STACKED: yn2boolen(stacked),
                };

                // This is the metadata object that describes the target object properties (optional)

                var metaObj2 = {
                    LEGENDALIGN: {group: groupNm, name : '범례 위치',  type: 'options', options: [
                        {text:'- 선택 -', value: ''}
                        ,{text:'TOP', value: 'TOP'}
                        ,{text:'LEFT', value: 'LEFT'}
                        ,{text:'RIGHT', value: 'RIGHT'}
                        ,{text:'BOTTOM', value: 'BOTTOM'}
                    ]},
                    STACKED: {group: groupNm, name : '스택으로 쌓기', type: 'boolean'}
                };
                $('#divPgGrpChart').jqPropertyGrid(setObj2, {meta: metaObj2, callback: pgGrpChartChange});
                grpPropertyGrid("divPgChart","(GRP) 챠트",x,y,300,200);
            }else{
                msgError(grpType + "의 프로퍼티 레이어가 정의되지 않았습니다.",3);
            }
            

        }
    }

    function pgIoPopupChange(grid, name, value) {
        alog("pgIoPopupChange() grid=" + grid + ", name=" + name + ", value=" + value);

        //오브젝트 모든 정보 가져와서 행의 값 변경하기
        var objJson = $('#divPgIoPopup').jqPropertyGrid('get');
        alog("  POPUP=" + objJson.POPUP);
        mygridIo.cells(lastSelectPgRowId,mygridIo.getColIndexById("POPUP")).setValue(objJson.POPUP);

        if(mygridIo.getUserData(lastSelectPgRowId,"!nativeeditor_status") == ""){
            mygridIo.setUserData(lastSelectPgRowId,"!nativeeditor_status","updated");
            mygridIo.setRowTextBold(lastSelectPgRowId);
            mygridIo.cells(lastSelectPgRowId,mygridIo.getColIndexById("POPUP")).cell.wasChanged = true;	
        }
    }


    function pgIoBtnChange(grid, name, value) {
        alog("pgIoBtnChange() grid=" + grid + ", name=" + name + ", value=" + value);

        //오브젝트 모든 정보 가져와서 행의 값 변경하기
        var objJson = $('#divPgIoBtn').jqPropertyGrid('get');
        alog("  BTNHIDDENYN=" + objJson.BTNHIDDENYN);
        mygridIo.cells(lastSelectPgRowId,mygridIo.getColIndexById("BTNHIDDENYN")).setValue(objJson.BTNHIDDENYN);

        if(mygridIo.getUserData(lastSelectPgRowId,"!nativeeditor_status") == ""){
            mygridIo.setUserData(lastSelectPgRowId,"!nativeeditor_status","updated");
            mygridIo.setRowTextBold(lastSelectPgRowId);
            mygridIo.cells(lastSelectPgRowId,mygridIo.getColIndexById("BTNHIDDENYN")).cell.wasChanged = true;	
        }
    }


    function pgFncChange(grid, name, value) {
        // handle callback
        alert("pgFncChange");
        alog("pgFncChange() grid=" + grid + ", name=" + name + ", value=" + value);

        //오브젝트 모든 정보 가져와서 행의 값 변경하기
        var objJson = $('#divPgFncUserdefJS').jqPropertyGrid('get');
        alog("  USERDEFJS=" + objJson.USERDEFJS);
        alog("  FREEZECNT=" + objJson.FREEZECNT);
        mygridFnc.cells(lastSelectPgRowId,mygridFnc.getColIndexById("USERDEFJS")).setValue(objJson.USERDEFJS);

        if(mygridFnc.getUserData(lastSelectPgRowId,"!nativeeditor_status") == ""){
            mygridFnc.setUserData(lastSelectPgRowId,"!nativeeditor_status","updated");
            mygridFnc.setRowTextBold(lastSelectPgRowId);
            mygridFnc.cells(lastSelectPgRowId,mygridFnc.getColIndexById("USERDEFJS")).cell.wasChanged = true;	
        }
    }

    function pgGrpFormviewChange(grid, name, value) {
        // handle callback
        alog("pgGrpFormviewChange() grid=" + grid + ", name=" + name + ", value=" + value);

        //오브젝트 모든 정보 가져와서 행의 값 변경하기
        var objJson = $('#divPgGrpFormview').jqPropertyGrid('get');
        mygridGrp.cells(lastSelectPgRowId,mygridGrp.getColIndexById("METHOD")).setValue(objJson.METHOD);

        if(mygridGrp.getUserData(lastSelectPgRowId,"!nativeeditor_status") == ""){
            mygridGrp.setUserData(lastSelectPgRowId,"!nativeeditor_status","updated");
            mygridGrp.setRowTextBold(lastSelectPgRowId);
            mygridGrp.cells(lastSelectPgRowId,mygridGrp.getColIndexById("METHOD")).cell.wasChanged = true;	
        }
    }


    function pgGrpGridChange(grid, name, value) {
        // handle callback
        alog("pgGrpGridChange() grid=" + grid + ", name=" + name + ", value=" + value);

        //오브젝트 모든 정보 가져와서 행의 값 변경하기
        var objJson = $('#divPgGrpGrid').jqPropertyGrid('get');
        mygridGrp.cells(lastSelectPgRowId,mygridGrp.getColIndexById("FREEZECNT")).setValue(objJson.FREEZECNT);
        mygridGrp.cells(lastSelectPgRowId,mygridGrp.getColIndexById("COLSIZETYPE")).setValue(objJson.COLSIZETYPE);

        if(mygridGrp.getUserData(lastSelectPgRowId,"!nativeeditor_status") == ""){
            mygridGrp.setUserData(lastSelectPgRowId,"!nativeeditor_status","updated");
            mygridGrp.setRowTextBold(lastSelectPgRowId);
            mygridGrp.cells(lastSelectPgRowId,mygridGrp.getColIndexById("FREEZECNT")).cell.wasChanged = true;	
            mygridGrp.cells(lastSelectPgRowId,mygridGrp.getColIndexById("COLSIZETYPE")).cell.wasChanged = true;	
        }
    }

    function pgGrpChartChange(grid, name, value) {
        // handle callback
        alog("pgGrpChartChange() grid=" + grid + ", name=" + name + ", value=" + value);

        //오브젝트 모든 정보 가져와서 행의 값 변경하기
        var objJson = $('#divPgGrpChart').jqPropertyGrid('get');
        mygridGrp.cells(lastSelectPgRowId,mygridGrp.getColIndexById("LEGENDALIGN")).setValue(objJson.LEGENDALIGN);
        mygridGrp.cells(lastSelectPgRowId,mygridGrp.getColIndexById("STACKED")).setValue(boolen2yn(objJson.STACKED));  
        
        if(mygridGrp.getUserData(lastSelectPgRowId,"!nativeeditor_status") == ""){
            mygridGrp.setUserData(lastSelectPgRowId,"!nativeeditor_status","updated");
            mygridGrp.setRowTextBold(lastSelectPgRowId);
            mygridGrp.cells(lastSelectPgRowId,mygridGrp.getColIndexById("LEGENDALIGN")).cell.wasChanged = true;	
            mygridGrp.cells(lastSelectPgRowId,mygridGrp.getColIndexById("STACKED")).cell.wasChanged = true;	
        }        
    }


    
    
    //프로퍼티 팝업띄우기
    function grpPropertyGrid(tDivNm,tWindowTitle,x,y,tmpWidth,tmpHeight){
        //alert( "#F_PGMNM for .change() called." );
        //alert($("#F_PGMNM").val());

        //$("#" + tDivNm).css("display","");
        if(myWins && myWins.window("grpPropertyWindow")){
            myWins.window("grpPropertyWindow").close();
        }
        

        //alert("new");
        myWins = new dhtmlXWindows();

        myWins.createWindow({
            id:"grpPropertyWindow",
            left:x,
            top:y,
            width:tmpWidth,
            height:tmpHeight,
            caption:tWindowTitle
        });
        //myWins.window("pgmwindow").hideHeader();

        myWins.window("grpPropertyWindow").attachEvent("onClose", function(win){
            //alert(1);
            myWins.window("grpPropertyWindow").detachObject(tDivNm); //윈도우 객체 안에서 분리해서 윈도우 밖으로 div를 반환한다.
            //myWins.window("grpPropertyWindow").close();
            return true;
        });
        myWins.window("grpPropertyWindow").attachObject(tDivNm); //div 오브젝트 자체가 윈도우 안으로 이동해서 기존 div객체는 윈도우 안에서 움직임


    }