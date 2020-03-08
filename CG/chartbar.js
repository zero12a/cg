//글로벌 변수 선언
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_SEARCHALL = "chartbarController?CTLGRP=G1&CTLFNC=SEARCHALL";
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_SAVE = "chartbarController?CTLGRP=G1&CTLFNC=SAVE";
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_RESET = "chartbarController?CTLGRP=G1&CTLFNC=RESET";
//컨디션 변수 선언	
//컨트롤러 경로
var url_G2_SEARCH = "chartbarController?CTLGRP=G2&CTLFNC=SEARCH";
			//G.GRPID 챠트 데이터
		var chartG2Data = { colids : [], labels : [], datasets: [] };
//컨트롤러 경로
var url_G3_SEARCH = "chartbarController?CTLGRP=G3&CTLFNC=SEARCH";
		//G.GRPID 챠트 데이터
		var chartG3Data = { colids : [], labels : [],	datasets: [] }; //colids는 실제 챠트lib와 영향없음
//그리드 변수 초기화	
//컨트롤러 경로
var url_G4_SEARCH = "chartbarController?CTLGRP=G4&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G4_SAVE = "chartbarController?CTLGRP=G4&CTLFNC=SAVE";
//컨트롤러 경로
var url_G4_RELOAD = "chartbarController?CTLGRP=G4&CTLFNC=RELOAD";
//그리드 객체
var mygridG4,isToggleHiddenColG4,lastinputG4,lastinputG4json,lastrowidG4;
var lastselectG4json;//그리드 변수 초기화	
//컨트롤러 경로
var url_G5_SEARCH = "chartbarController?CTLGRP=G5&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G5_SAVE = "chartbarController?CTLGRP=G5&CTLFNC=SAVE";
//컨트롤러 경로
var url_G5_RELOAD = "chartbarController?CTLGRP=G5&CTLFNC=RELOAD";
//그리드 객체
var mygridG5,isToggleHiddenColG5,lastinputG5,lastinputG5json,lastrowidG5;
var lastselectG5json;//화면 초기화	
function initBody(){
     alog("initBody()-----------------------start");
	
   //dhtmlx 메시지 박스 초기화
   dhtmlx.message.position="bottom";
	G1_INIT();	
	G2_INIT();	
	G3_INIT();	
	G4_INIT();	
	G5_INIT();	
      feather.replace();
	alog("initBody()-----------------------end");
} //initBody()	
//팝업띄우기		
	//팝업창 오픈요청
function goGridPopOpen(tGrpId,tRowId,tColIndex,tValue,tText){
	alog("goGridPopOpen()............. tGrpId = " + tGrpId + ", tRowId = " + tRowId + ", tColIndex = " + tColIndex + ", tValue = " + tValue + ", tText = " + tText);
	
	tColId = mygridG2.getColumnId(tColIndex);
	
	//PGMGRP ,  	
}
function goFormPopOpen(tGrpId, tColId, tColId_Nm){
	alog("goFormviewPopOpen()............. tGrpId = " + tGrpId + ", tColId = " + tColId + ", tColId_Nm = " +tColId_Nm );
	
	tColId_Val = $("#" + tColId).val();
	tColId_Nm_Text = $("#" + tColId_Nm).text();
	//PGMGRP ,  	
}// goFormviewPopOpen
//부모창 리턴용//팝업창에서 받을 내용
function popReturn(tGrpId,tRowId,tColId,tBtnNm,tJsonObj){
	//alert("popReturn");
		//, 

}//popReturn
//그룹별 초기화 함수	
// CONDITIONInit	//컨디션 초기화
function G1_INIT(){
  alog("G1_INIT()-------------------------start	");
	//각 폼 오브젝트들 초기화
  alog("G1_INIT()-------------------------end");
}

//챠트 그리드 초기화
function G2_INIT(){
  alog("G2_INIT()-------------------------start");
		//챠트 챠트 초기화
	var ctx = $('#canvasG2')[0].getContext('2d');
	window.myBarG2 = new Chart(ctx, {
		type: 'bar' //일단 선언해 줘야 함                
		,data: chartG2Data
		,options: {
			responsive: true
			,maintainAspectRatio: false			
			,legend: {
				position: 'right',
			}
			,layout : {
				padding: {
                	left: 0,
               	 	right: 0,
               	 	top: 15,
                	bottom: 0
            	}	
			}		}
	});
	$("#canvasG2").on('click', function (e) {
		//alert(e);
		var bars = window.myBarG2.getElementAtEvent(e);
		if (bars.length == 0) return;
		var element = null;
		element = bars[0];
		if (element === null) return;

		var labelElement, dataElement;
		labelElement = chartG2Data.datasets[element._datasetIndex].label;
		colid = chartG2Data.datasets[element._datasetIndex].colid;
		//alert(labelElement);
		firstColLabel = chartG2Data.labels[element._index];
		//alert(firstColLabel);                
		dataElement = chartG2Data.datasets[element._datasetIndex].data[element._index];
		//alert(dataElement);



		//G1_SEARCH(lastinput,uuidv4());
		//챠트 상속
		lastinputG4 = new HashMap();
		lastinputG4.set("G2-" + chartG2Data.colids[0],firstColLabel);
		lastinputG4.set("G2-" + labelElement,dataElement);
			G4_SEARCH(lastinputG4,uuidv4());
	});
}
	//PIE 그리드 초기화
function G3_INIT(){
  alog("G3_INIT()-------------------------start");
		//챠트 PIE 초기화
	var ctx = $('#canvasG3')[0].getContext('2d');
	window.myBarG3 = new Chart(ctx, {
		type: 'pie' //일단 선언해 줘야 함                
		,data: chartG3Data             
		,options: {
			responsive: true
			,maintainAspectRatio: false
			,padding: {
                left: 0,
                right: 0,
                top: 10,
                bottom: 0
            }
			,legend: {
				position: 'right',
			}
		}
	});
	$("#canvasG3").on('click', function (e) {
		//alert(e);
		var bars = window.myBarG3.getElementAtEvent(e);
		if (bars.length == 0) return;
		var element = null;
		element = bars[0];
		if (element === null) return;

		var labelElement, dataElement;
		labelElement = chartG3Data.datasets[element._datasetIndex].label;
		colid = chartG3Data.datasets[element._datasetIndex].colid;
		//alert(labelElement);
		firstColLabel = chartG3Data.labels[element._index];
		//alert(firstColLabel);                
		dataElement = chartG3Data.datasets[element._datasetIndex].data[element._index];
		//alert(dataElement);
		//PIE상속
		lastinputG5 = new HashMap();
		lastinputG5.set("G3-" + chartG3Data.colids[0],firstColLabel);
		lastinputG5.set("G3-" + labelElement,dataElement);
				G5_SEARCH(lastinputG5,uuidv4());

	});}
	//BAR상속 그리드 초기화
function G4_INIT(){
  alog("G4_INIT()-------------------------start");

	//그리드 초기화
	mygridG4 = new dhtmlXGridObject('gridG4');
	mygridG4.setDateFormat("%Y%m%d");
	mygridG4.setImagePath(CFG_URL_LIBS_ROOT + "lib/dhtmlxSuite/codebase/imgs/"); //DHTMLX IMG
	mygridG4.setUserData("","gridTitle","G4 : BAR상속"); //글로별 변수에 그리드 타이블 넣기
	//헤더초기화
	mygridG4.setHeader("LOGIN_DT,LOGIN_CNT,LOGIN_CNT2");
	mygridG4.setColumnIds("LOGIN_DT,LOGIN_CNT,LOGIN_CNT2");
	mygridG4.setInitWidths("100,100,100");
	mygridG4.setColTypes("ro,ro,ro");
	//가로 정렬	
	mygridG4.setColAlign("left,left,left");
	mygridG4.setColSorting("str,int,int");	//렌더링	
	mygridG4.enableSmartRendering(false);
	mygridG4.enableMultiselect(true);
	//mygridG4.setColValidators("G4_LOGIN_DT,G4_LOGIN_CNT,G4_LOGIN_CNT2");
	mygridG4.splitAt(0);//'freezes' 0 columns 
	mygridG4.init();

	mygridG4.attachEvent("onDhxCalendarCreated", function(myCal){ myCal.loadUserLanguage( "kr" ); });
		//블럭선택 및 복사
		mygridG4.enableBlockSelection(true);
		mygridG4.attachEvent("onKeyPress",function(code,ctrl,shift){
			alog("onKeyPress.......code=" + code + ", ctrl=" + ctrl + ", shift=" + shift);

			//셀편집모드 아닐때만 블록처리
			if(!mygridG4.editor){
				mygridG4.setCSVDelimiter("	");
				if(code==67&&ctrl){
					mygridG4.copyBlockToClipboard();

					var top_row_idx = mygridG4.getSelectedBlock().LeftTopRow;
					var bottom_row_idx = mygridG4.getSelectedBlock().RightBottomRow;
					var copyRowCnt = bottom_row_idx-top_row_idx+1;
					msgNotice( copyRowCnt + "개의 행이 클립보드에 복사되었습니다.",2);

				}
				if(code==86&&ctrl){
					mygridG4.pasteBlockFromClipboard();

					//row상태 변경
					var top_row_idx = mygridG4.getSelectedBlock().LeftTopRow;
					var bottom_row_idx = mygridG4.getSelectedBlock().RightBottomRow;
					for(j=top_row_idx;j<=bottom_row_idx;j++){
						var rowID = mygridG4.getRowId(j);
						RowEditStatus = mygridG4.getUserData(rowID,"!nativeeditor_status");
						if(RowEditStatus == ""){
							mygridG4.setUserData(rowID,"!nativeeditor_status","updated");
							mygridG4.setRowTextBold(rowID);
						}
					}
				}
				return true;
			}else{
				return false;
			}
		});
		 // IO : LOGIN_DT초기화	
		 // IO : LOGIN_CNT초기화	
		 // IO : LOGIN_CNT2초기화	
	//onCheck
		mygridG4.attachEvent("onCheck",function(rowId, cellInd, state){
			alog("mygridG4  onCheck ------------------start");
			alog("	rowId=" + rowId + ", cellInd=" + cellInd + ", state=" + state);

			RowEditStatus = mygridG4.getUserData(rowId,"!nativeeditor_status");
			alog("	RowEditStatus=" + RowEditStatus);
			//[일반 체크] 박스는 변경이면 실제 row 변경
			if( 1 == 2 
				){
				if(RowEditStatus == ""){
					mygridG4.setUserData(rowId,"!nativeeditor_status","updated");
					mygridG4.setRowTextBold(rowId);
					mygridG4.cells(rowId,cellInd).cell.wasChanged = true;	
				}
			}
						
		});	
		// ROW선택 이벤트
		mygridG4.attachEvent("onRowSelect",function(rowID,celInd){
			RowEditStatus = mygridG4.getUserData(rowID,"!nativeeditor_status");
			if(RowEditStatus == "inserted"){return false;}
			//GRIDRowSelect40(rowID,celInd);
			//팝업오프너 호출
			//CD[필수], NM 정보가 있는 경우 팝업 오프너에게 값 전달
			popG4json = jQuery.parseJSON('{ "__NAME":"lastinputG3json"' +
			'}');

			if(popG4json && popG4json.CD){
				goOpenerReturn(popG4json);
				return;
			}
		//A124
		});
	//onEditCell 이벤트
	mygridG4.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){
		alog("mygridG4  onEditCell ------------------start");
		alog("	stage : " + stage + ", rId : " + rId + ", cInd : " + cInd + ", nValue : " + nValue + ", oValue : " + oValue);

		RowEditStatus = mygridG4.getUserData(rId,"!nativeeditor_status");
		alog("	RowEditStatus = " + RowEditStatus);

		//체크박스 아닌 일반 컬럼
            if(stage == 2
                && RowEditStatus != "inserted"
                && RowEditStatus != "deleted"
                && nValue != oValue
                ){
                if(RowEditStatus == "") {
                    mygridG4.setUserData(rId,"!nativeeditor_status","updated");
                    mygridG4.setRowTextBold(rId);
                }
                mygridG4.cells(rId,cInd).cell.wasChanged = true;
            }

            return true;
	});
	alog("G4_INIT()-------------------------end");
}
	//PIE상속 그리드 초기화
function G5_INIT(){
  alog("G5_INIT()-------------------------start");

	//그리드 초기화
	mygridG5 = new dhtmlXGridObject('gridG5');
	mygridG5.setDateFormat("%Y%m%d");
	mygridG5.setImagePath(CFG_URL_LIBS_ROOT + "lib/dhtmlxSuite/codebase/imgs/"); //DHTMLX IMG
	mygridG5.setUserData("","gridTitle","G5 : PIE상속"); //글로별 변수에 그리드 타이블 넣기
	//헤더초기화
	mygridG5.setHeader("LOGIN_DT,LOGIN_CNT,LOGIN_CNT2");
	mygridG5.setColumnIds("LOGIN_DT,LOGIN_CNT,LOGIN_CNT2");
	mygridG5.setInitWidths("100,100,100");
	mygridG5.setColTypes("ro,ro,ro");
	//가로 정렬	
	mygridG5.setColAlign("left,left,left");
	mygridG5.setColSorting("str,int,int");	//렌더링	
	mygridG5.enableSmartRendering(false);
	mygridG5.enableMultiselect(true);
	//mygridG5.setColValidators("G5_LOGIN_DT,G5_LOGIN_CNT,G5_LOGIN_CNT2");
	mygridG5.splitAt(0);//'freezes' 0 columns 
	mygridG5.init();

	mygridG5.attachEvent("onDhxCalendarCreated", function(myCal){ myCal.loadUserLanguage( "kr" ); });
		//블럭선택 및 복사
		mygridG5.enableBlockSelection(true);
		mygridG5.attachEvent("onKeyPress",function(code,ctrl,shift){
			alog("onKeyPress.......code=" + code + ", ctrl=" + ctrl + ", shift=" + shift);

			//셀편집모드 아닐때만 블록처리
			if(!mygridG5.editor){
				mygridG5.setCSVDelimiter("	");
				if(code==67&&ctrl){
					mygridG5.copyBlockToClipboard();

					var top_row_idx = mygridG5.getSelectedBlock().LeftTopRow;
					var bottom_row_idx = mygridG5.getSelectedBlock().RightBottomRow;
					var copyRowCnt = bottom_row_idx-top_row_idx+1;
					msgNotice( copyRowCnt + "개의 행이 클립보드에 복사되었습니다.",2);

				}
				if(code==86&&ctrl){
					mygridG5.pasteBlockFromClipboard();

					//row상태 변경
					var top_row_idx = mygridG5.getSelectedBlock().LeftTopRow;
					var bottom_row_idx = mygridG5.getSelectedBlock().RightBottomRow;
					for(j=top_row_idx;j<=bottom_row_idx;j++){
						var rowID = mygridG5.getRowId(j);
						RowEditStatus = mygridG5.getUserData(rowID,"!nativeeditor_status");
						if(RowEditStatus == ""){
							mygridG5.setUserData(rowID,"!nativeeditor_status","updated");
							mygridG5.setRowTextBold(rowID);
						}
					}
				}
				return true;
			}else{
				return false;
			}
		});
		 // IO : LOGIN_DT초기화	
		 // IO : LOGIN_CNT초기화	
		 // IO : LOGIN_CNT2초기화	
	//onCheck
		mygridG5.attachEvent("onCheck",function(rowId, cellInd, state){
			alog("mygridG5  onCheck ------------------start");
			alog("	rowId=" + rowId + ", cellInd=" + cellInd + ", state=" + state);

			RowEditStatus = mygridG5.getUserData(rowId,"!nativeeditor_status");
			alog("	RowEditStatus=" + RowEditStatus);
			//[일반 체크] 박스는 변경이면 실제 row 변경
			if( 1 == 2 
				){
				if(RowEditStatus == ""){
					mygridG5.setUserData(rowId,"!nativeeditor_status","updated");
					mygridG5.setRowTextBold(rowId);
					mygridG5.cells(rowId,cellInd).cell.wasChanged = true;	
				}
			}
						
		});	
		// ROW선택 이벤트
		mygridG5.attachEvent("onRowSelect",function(rowID,celInd){
			RowEditStatus = mygridG5.getUserData(rowID,"!nativeeditor_status");
			if(RowEditStatus == "inserted"){return false;}
			//GRIDRowSelect50(rowID,celInd);
			//팝업오프너 호출
			//CD[필수], NM 정보가 있는 경우 팝업 오프너에게 값 전달
			popG5json = jQuery.parseJSON('{ "__NAME":"lastinputG3json"' +
			'}');

			if(popG5json && popG5json.CD){
				goOpenerReturn(popG5json);
				return;
			}
		//A124
		});
	//onEditCell 이벤트
	mygridG5.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){
		alog("mygridG5  onEditCell ------------------start");
		alog("	stage : " + stage + ", rId : " + rId + ", cInd : " + cInd + ", nValue : " + nValue + ", oValue : " + oValue);

		RowEditStatus = mygridG5.getUserData(rId,"!nativeeditor_status");
		alog("	RowEditStatus = " + RowEditStatus);

		//체크박스 아닌 일반 컬럼
            if(stage == 2
                && RowEditStatus != "inserted"
                && RowEditStatus != "deleted"
                && nValue != oValue
                ){
                if(RowEditStatus == "") {
                    mygridG5.setUserData(rId,"!nativeeditor_status","updated");
                    mygridG5.setRowTextBold(rId);
                }
                mygridG5.cells(rId,cInd).cell.wasChanged = true;
            }

            return true;
	});
	alog("G5_INIT()-------------------------end");
}
//D146 그룹별 기능 함수 출력		
//검색조건 초기화
function G1_RESET(){
	alog("G1_RESET--------------------------start");
	$('#condition')[0].reset();
}
//컨디션, 저장	
function G1_SAVE(){
 alog("G1_SAVE-------------------start");
	//FormData parameter에 담아줌	
	var formData = new FormData();	//G1 getparams	
//var params = { CTL : "G1_SAVE"};
	$.ajax({	
		type : "POST",
		url : url_G1_SAVE  ,
		data : formData,
		processData: false,
		contentType: false,
		async: false,
		success: function(tdata){
			alog("   json return----------------------");
			alog("   json data : " + tdata);
			data = jQuery.parseJSON(tdata);
			alog("   json RTN_CD : " + data.RTN_CD);
			alog("   json ERR_CD : " + data.ERR_CD);
			//alog("   json RTN_MSG length : " + data.RTN_MSG.length);

			//그리드에 데이터 반영
			saveToGroup(data);

		},
		error: function(error){
			msgError("[G1] Ajax http 500 error ( " + error + " )");
			alog("[G1] Ajax http 500 error ( " + error + " )");
		}
	});
	alog("G1_SAVE-------------------end");	
}
// CONDITIONSearch	
function G1_SEARCHALL(token){
	alog("G1_SEARCHALL--------------------------start");
	//입력값검증
	//폼의 모든값 구하기
	var ConAllData = $( "#condition" ).serialize();
	alog("ConAllData:" + ConAllData);
	//json : G1
			lastinputG2 = new HashMap(); //챠트
				lastinputG3 = new HashMap(); //PIE
		//  호출
	G2_SEARCH(lastinputG2,token);
	//  호출
	G3_SEARCH(lastinputG3,token);
	alog("G1_SEARCHALL--------------------------end");
}
    //그리드 조회(챠트)	
    function G2_SEARCH(tinput,token){
        alog("G2_SEARCH()------------start");

        //post 만들기
		sendFormData = new FormData($("#condition")[0]);
		if(typeof tinput != "undefined"){
			var tKeys = tinput.keys();
			for(i=0;i<tKeys.length;i++) {
				sendFormData.append(tKeys[i],tinput.get(tKeys[i]));
				//console.log(tKeys[i]+ '='+ tinput.get(tKeys[i])); 
			}
		}


        //불러오기
        $.ajax({
            type : "POST",
            url : url_G2_SEARCH+"&TOKEN=" + token ,
            data : sendFormData,
			processData: false,
			contentType: false,
            dataType: "json",
            async: true,
            success: function(resData){
                alog("   gridSearch6 json return----------------------");
                alog("   json data : " + resData);
                alog("   json RTN_CD : " + resData.RTN_CD);
                alog("   json ERR_CD : " + resData.ERR_CD);
                //alog("   json RTN_MSG length : " + resData.RTN_MSG.length);

                //그리드에 데이터 반영
                if(resData.RTN_CD == "200"){
					var row_cnt = 0;
					if(resData.RTN_DATA){
						row_cnt = resData.RTN_DATA.rows.length;
						$("#spanG2Cnt").text(row_cnt);




          	var colorNames = Object.keys(window.chartColors);     

			//데이터 초기화
			chartG2Data.datasets = [];

			//첫 컬럼의 모든 rows는 챠트 라벨
            var newLabels = [];
            var nowCol = 0;
            for(i=0;i<resData.RTN_DATA.rows.length;i++){
                newLabels.push(resData.RTN_DATA.rows[i].data[nowCol]);
            }
            chartG2Data.labels = newLabels;
				//컬럼ID목록 저장해 두기
				newColids = [];
				newColids.push("LOGIN_DT"); // LOGIN_DT
					newColids.push("LOGIN_CNT"); // LOGIN_CNT
					newColids.push("LOGIN_CNT2"); // LOGIN_CNT2
					chartG2Data.colids = newColids; // 챠트
            //두번째 컬럼부터 
            nowCol++;
            var dsColor = window.chartColors[colorNames[nowCol-1]];                 
            var newDataset = {
                type : 'bar',                
				label: 'LOGIN_CNT',
				colid : 'LOGIN_CNT',
				backgroundColor: color(dsColor).alpha(0.5).rgbString(),
				borderColor: dsColor,
				borderWidth: 1,
				data: []
            };
            for(i=0;i<resData.RTN_DATA.rows.length;i++){
                newDataset.data.push(resData.RTN_DATA.rows[i].data[nowCol]);
            }      
            chartG2Data.datasets.push(newDataset);
            //두번째 컬럼부터 
            nowCol++;
            var dsColor = window.chartColors[colorNames[nowCol-1]];                 
            var newDataset = {
                type : 'line',                
				label: 'LOGIN_CNT2',
				colid : 'LOGIN_CNT2',
				backgroundColor: color(dsColor).alpha(0.5).rgbString(),
				borderColor: dsColor,
				borderWidth: 1,
				data: []
            };
            for(i=0;i<resData.RTN_DATA.rows.length;i++){
                newDataset.data.push(resData.RTN_DATA.rows[i].data[nowCol]);
            }      
            chartG2Data.datasets.push(newDataset);
			window.myBarG2.update();     //업데이트
						
					}
					msgNotice("[챠트] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[챠트] 서버 조회중 에러가 발생했습니다.RTN_CD : " + resData.RTN_CD + "ERR_CD : " + resData.ERR_CD + "RTN_MSG :" + resData.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[챠트] Ajax http 500 error ( " + error + " )",3);
                alog("[챠트] Ajax http 500 error ( " + error + " )");
            }
        });

        alog("gridSearchG2()------------end");
    }
    //그리드 조회(PIE)	
    function G3_SEARCH(tinput,token){
        alog("G3_SEARCH()------------start");

        //post 만들기
		sendFormData = new FormData($("#condition")[0]);
		if(typeof tinput != "undefined"){
			var tKeys = tinput.keys();
			for(i=0;i<tKeys.length;i++) {
				sendFormData.append(tKeys[i],tinput.get(tKeys[i]));
				//console.log(tKeys[i]+ '='+ tinput.get(tKeys[i])); 
			}
		}


        //불러오기
        $.ajax({
            type : "POST",
            url : url_G3_SEARCH+"&TOKEN=" + token  ,
            data : sendFormData,
			processData: false,
			contentType: false,
            dataType: "json",
            async: true,
            success: function(resData){
                alog("   gridSearch6 json return----------------------");
                alog("   json data : " + resData);
                alog("   json RTN_CD : " + resData.RTN_CD);
                alog("   json ERR_CD : " + resData.ERR_CD);
                //alog("   json RTN_MSG length : " + resData.RTN_MSG.length);

                //그리드에 데이터 반영
                if(resData.RTN_CD == "200"){
					var row_cnt = 0;
					if(resData.RTN_DATA){
						row_cnt = resData.RTN_DATA.rows.length;
						$("#spanG3Cnt").text(row_cnt);




				var colorNames = Object.keys(window.chartColors);     

				//데이터 초기화
				chartG3Data.datasets = [];

				//첫 컬럼의 모든 row는 차트 라벨
				var newLabels = [];
				var newColors = [];
				var nowCol = 0;
				for(i=0;i<resData.RTN_DATA.rows.length;i++){
					newColors.push(window.chartColors[colorNames[i]]);														 
					newLabels.push(resData.RTN_DATA.rows[i].data[nowCol]);
				}
				chartG3Data.labels = newLabels;
				//컬럼ID목록 저장해 두기
				newColids = [];
				newColids.push("LOGIN_DT");
				newColids.push("LOGIN_CNT");
				chartG3Data.colids = newColids;
				//두번째 컬럼부터 
				nowCol++;
				var dsColor = window.chartColors[colorNames[nowCol-1]];                 
				var newDataset = {     
					label: 'LOGIN_CNT',
					colid: 'LOGIN_CNT',
					backgroundColor: newColors,
					data: []
				};
				for(i=0;i<resData.RTN_DATA.rows.length;i++){
					newDataset.data.push(resData.RTN_DATA.rows[i].data[nowCol]);
				}      
				chartG3Data.datasets.push(newDataset);
				window.myBarG3.update();     //업데이트
						
					}
					msgNotice("[PIE] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[PIE] 서버 조회중 에러가 발생했습니다.RTN_CD : " + resData.RTN_CD + "ERR_CD : " + resData.ERR_CD + "RTN_MSG :" + resData.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[PIE] Ajax http 500 error ( " + error + " )",3);
                alog("[PIE] Ajax http 500 error ( " + error + " )");
            }
        });

        alog("gridSearchG3()------------end");
    }
//새로고침	
function G4_RELOAD(token){
  alog("G4_RELOAD-----------------start");
  G4_SEARCH(lastinputG4,token);
}
	function G4_SAVE(token){
	alog("G4_SAVE()------------start");
	tgrid = mygridG4;

	tgrid.setSerializationLevel(true,false,false,false,true,true);
	var myXmlString = tgrid.serialize();
        //post 만들기
		sendFormData = new FormData($("#condition")[0]);
		//for(var pair of lastinputG4.entries()) {
		//	sendFormData.append(pair[0],pair[1]);
   		//	//console.log(pair[0]+ ', '+ pair[1]); 
		//}

		if(typeof lastinputG4 != "undefined"){
			var tKeys = lastinputG4.keys();
			for(i=0;i<tKeys.length;i++) {
				sendFormData.append(tKeys[i],lastinputG4.get(tKeys[i]));
				//console.log(tKeys[i]+ '='+ lastinputG4.get(tKeys[i])); 
			}
		}
	sendFormData.append("G4-XML" , myXmlString);
	$.ajax({
		type : "POST",
		url : url_G4_SAVE + "&TOKEN=" + token,
		data : sendFormData,
		processData: false,
		contentType: false,
		dataType: "json",
		async: false,
		success: function(data){
			alog("   json return----------------------");
			alog("   json data : " + data);
			alog("   json RTN_CD : " + data.RTN_CD);
			alog("   json ERR_CD : " + data.ERR_CD);
			//alog("   json RTN_MSG length : " + data.RTN_MSG.length);

			//그리드에 데이터 반영
			saveToGroup(data);

		},
		error: function(error){
			msgError("Ajax http 500 error ( " + error + " )");
			alog("Ajax http 500 error ( " + error + " )");
		}
	});
	
	alog("G4_SAVE()------------end");
}








    //그리드 조회(BAR상속)	
    function G4_SEARCH(tinput,token){
        alog("G4_SEARCH()------------start");

		var tGrid = mygridG4;

        //그리드 초기화
        tGrid.clearAll();
        //post 만들기
		sendFormData = new FormData($("#condition")[0]);
		if(typeof tinput != "undefined"){
			var tKeys = tinput.keys();
			for(i=0;i<tKeys.length;i++) {
				sendFormData.append(tKeys[i],tinput.get(tKeys[i]));
				//console.log(tKeys[i]+ '='+ tinput.get(tKeys[i])); 
			}
		}

        //불러오기
        $.ajax({
            type : "POST",
            url : url_G4_SEARCH+"&TOKEN=" + token + " &G4_CRUD_MODE=read" ,
            data : sendFormData,
			processData: false,
			contentType: false,
            dataType: "json",
            async: true,
            success: function(data){
                alog("   gridG4 json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
					var row_cnt = 0;
					if(data.RTN_DATA){
						row_cnt = data.RTN_DATA.rows.length;
						$("#spanG4Cnt").text(row_cnt);
						tGrid.parse(data.RTN_DATA,function(){
							//푸터 합계 처리	

						},"json");
						
					}else{
						$("#spanG4Cnt").text("-");
					}
					msgNotice("[BAR상속] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[BAR상속] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[BAR상속] Ajax http 500 error ( " + error + " )",3);
                alog("[BAR상속] Ajax http 500 error ( " + data.RTN_MSG + " )");
            }
        });
        alog("G4_SEARCH()------------end");
    }

//새로고침	
function G5_RELOAD(token){
  alog("G5_RELOAD-----------------start");
  G5_SEARCH(lastinputG5,token);
}
	function G5_SAVE(token){
	alog("G5_SAVE()------------start");
	tgrid = mygridG5;

	tgrid.setSerializationLevel(true,false,false,false,true,true);
	var myXmlString = tgrid.serialize();
        //post 만들기
		sendFormData = new FormData($("#condition")[0]);
		//for(var pair of lastinputG5.entries()) {
		//	sendFormData.append(pair[0],pair[1]);
   		//	//console.log(pair[0]+ ', '+ pair[1]); 
		//}

		if(typeof lastinputG5 != "undefined"){
			var tKeys = lastinputG5.keys();
			for(i=0;i<tKeys.length;i++) {
				sendFormData.append(tKeys[i],lastinputG5.get(tKeys[i]));
				//console.log(tKeys[i]+ '='+ lastinputG5.get(tKeys[i])); 
			}
		}
	sendFormData.append("G5-XML" , myXmlString);
	$.ajax({
		type : "POST",
		url : url_G5_SAVE + "&TOKEN=" + token,
		data : sendFormData,
		processData: false,
		contentType: false,
		dataType: "json",
		async: false,
		success: function(data){
			alog("   json return----------------------");
			alog("   json data : " + data);
			alog("   json RTN_CD : " + data.RTN_CD);
			alog("   json ERR_CD : " + data.ERR_CD);
			//alog("   json RTN_MSG length : " + data.RTN_MSG.length);

			//그리드에 데이터 반영
			saveToGroup(data);

		},
		error: function(error){
			msgError("Ajax http 500 error ( " + error + " )");
			alog("Ajax http 500 error ( " + error + " )");
		}
	});
	
	alog("G5_SAVE()------------end");
}








    //그리드 조회(PIE상속)	
    function G5_SEARCH(tinput,token){
        alog("G5_SEARCH()------------start");

		var tGrid = mygridG5;

        //그리드 초기화
        tGrid.clearAll();
        //post 만들기
		sendFormData = new FormData($("#condition")[0]);
		if(typeof tinput != "undefined"){
			var tKeys = tinput.keys();
			for(i=0;i<tKeys.length;i++) {
				sendFormData.append(tKeys[i],tinput.get(tKeys[i]));
				//console.log(tKeys[i]+ '='+ tinput.get(tKeys[i])); 
			}
		}

        //불러오기
        $.ajax({
            type : "POST",
            url : url_G5_SEARCH+"&TOKEN=" + token + " &G5_CRUD_MODE=read" ,
            data : sendFormData,
			processData: false,
			contentType: false,
            dataType: "json",
            async: true,
            success: function(data){
                alog("   gridG5 json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
					var row_cnt = 0;
					if(data.RTN_DATA){
						row_cnt = data.RTN_DATA.rows.length;
						$("#spanG5Cnt").text(row_cnt);
						tGrid.parse(data.RTN_DATA,function(){
							//푸터 합계 처리	

						},"json");
						
					}else{
						$("#spanG5Cnt").text("-");
					}
					msgNotice("[PIE상속] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[PIE상속] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[PIE상속] Ajax http 500 error ( " + error + " )",3);
                alog("[PIE상속] Ajax http 500 error ( " + data.RTN_MSG + " )");
            }
        });
        alog("G5_SEARCH()------------end");
    }

