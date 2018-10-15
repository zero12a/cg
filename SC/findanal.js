//글로벌 변수 선언	
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_SEARCHALL = "findanalController?CTLGRP=G1&CTLFNC=SEARCHALL";// 변수 선언	
var obj_G1_EX_TEAM_NM_valid = jQuery.parseJSON( '{ "G1_EX_TEAM_NM": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":100,  "DATATYPE":"STRING"} }' );  //그래프 제외 팀명  밸리데이션
var obj_G1_EX_TEAM_NM; // 그래프 제외 팀명 변수선언//컨트롤러 경로
var url_G2_SEARCH = "findanalController?CTLGRP=G2&CTLFNC=SEARCH";
			//G.GRPID 챠트 데이터
		var chartG2Data = { labels : [], datasets: [] };
//그리드 변수 초기화	
//컨트롤러 경로
var url_G3_SEARCH = "findanalController?CTLGRP=G3&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G3_RELOAD = "findanalController?CTLGRP=G3&CTLFNC=RELOAD";
//그리드 객체
var mygridG3,isToggleHiddenColG3,lastinputG3,lastinputG3json,lastrowidG3;
var lastselectG3json;//그리드 변수 초기화	
//컨트롤러 경로
var url_G4_SEARCH = "findanalController?CTLGRP=G4&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G4_RELOAD = "findanalController?CTLGRP=G4&CTLFNC=RELOAD";
//컨트롤러 경로
var url_G4_VIEWHIDDEN = "findanalController?CTLGRP=G4&CTLFNC=VIEWHIDDEN";
//그리드 객체
var mygridG4,isToggleHiddenColG4,lastinputG4,lastinputG4json,lastrowidG4;
var lastselectG4json;//그리드 변수 초기화	
//컨트롤러 경로
var url_G5_SEARCH = "findanalController?CTLGRP=G5&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G5_RELOAD = "findanalController?CTLGRP=G5&CTLFNC=RELOAD";
//컨트롤러 경로
var url_G5_HIDDENCOL = "findanalController?CTLGRP=G5&CTLFNC=HIDDENCOL";
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
	//EX_TEAM_NM, 그래프 제외 팀명 초기화	
  alog("G1_INIT()-------------------------end");
}

//팀별 현황 (보안취약점 갯수) 그리드 초기화
function G2_INIT(){
  alog("G2_INIT()-------------------------start");
		//챠트 팀별 현황 (보안취약점 갯수) 초기화
	var ctx = $('#canvasG2')[0].getContext('2d');
	window.myBarG2 = new Chart(ctx, {
		type: 'bar', //일단 선언해 줘야 함                
		data: chartG2Data,                
		options: {
			layout: {
					padding: {
						left: 0,
						right: 0,
						top: 10,
						bottom: 0
					}
			},
			responsive: true,
			maintainAspectRatio: false,  				
			legend: {
				position: 'right',
			},
			scales:{
				yAxes:[
					{type:'linear', display:true, position:'left', id:'y-left'}
					,{type:'linear', display:true, position:'right', id:'y-right',gridLines:{ drawOnChartArea:false}}
				]
			}
		}
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

		lastG2input = colid + "=" + firstColLabel;
		//G1_SEARCH(lastinput,uuidv4());
	});
}
	//팀별 현황 (보안취약점 갯수) 그리드 초기화
function G3_INIT(){
  alog("G3_INIT()-------------------------start");

        //그리드 초기화
        mygridG3 = new dhtmlXGridObject('gridG3');
        mygridG3.setDateFormat("%Y%m%d");
        mygridG3.setImagePath("../lib/dhtmlxSuite/codebase/imgs/"); //DHTMLX IMG
		mygridG3.setUserData("","gridTitle","G3 : 팀별 현황 (보안취약점 갯수)"); //글로별 변수에 그리드 타이블 넣기
		//헤더초기화
        mygridG3.setHeader("UUID_SEQ,TEAM_NM,위험 상,위험 중,위험 하,취약점갯수");
		mygridG3.setColumnIds("UUID_SEQ,TEAM_NM,PRIORITY_1,PRIORITY_2,PRIORITY_3,VUL_CNT");
		mygridG3.setInitWidths("60,100,60,60,60,60");
		mygridG3.setColTypes("ro,ro,ron,ron,ron,ron");
	//가로 정렬	
		mygridG3.setColAlign("left,left,right,right,right,right");
		mygridG3.setColSorting("int,str,int,int,int,int");		//렌더링	
		mygridG3.enableSmartRendering(false);
		mygridG3.enableMultiselect(true);
		//mygridG3.setColValidators("G3_UUID_SEQ,G3_TEAM_NM,G3_PRIORITY_1,G3_PRIORITY_2,G3_PRIORITY_3,G3_VUL_CNT");
		mygridG3.splitAt(0);//'freezes' 0 columns 
		mygridG3.init();
		mygridG3.setNumberFormat("0,000",mygridG3.getColIndexById("PRIORITY_1")); // 위험 상
		mygridG3.setNumberFormat("0,000",mygridG3.getColIndexById("PRIORITY_2")); // 위험 중
		mygridG3.setNumberFormat("0,000",mygridG3.getColIndexById("PRIORITY_3")); // 위험 하
		mygridG3.setNumberFormat("0,000",mygridG3.getColIndexById("VUL_CNT")); // 취약점갯수
		//블럭선택 및 복사
		mygridG3.enableBlockSelection(true);
		mygridG3.attachEvent("onKeyPress",function(code,ctrl,shift){
			alog("onKeyPress.......code=" + code + ", ctrl=" + ctrl + ", shift=" + shift);

			//셀편집모드 아닐때만 블록처리
			if(!mygridG3.editor){
				mygridG3.setCSVDelimiter("	");
				if(code==67&&ctrl){
					mygridG3.copyBlockToClipboard();

					var top_row_idx = mygridG3.getSelectedBlock().LeftTopRow;
					var bottom_row_idx = mygridG3.getSelectedBlock().RightBottomRow;
					var copyRowCnt = bottom_row_idx-top_row_idx+1;
					msgNotice( copyRowCnt + "개의 행이 클립보드에 복사되었습니다.",2);

				}
				if(code==86&&ctrl){
					mygridG3.pasteBlockFromClipboard();

					//row상태 변경
					var top_row_idx = mygridG3.getSelectedBlock().LeftTopRow;
					var bottom_row_idx = mygridG3.getSelectedBlock().RightBottomRow;
					for(j=top_row_idx;j<=bottom_row_idx;j++){
						var rowID = mygridG3.getRowId(j);
						RowEditStatus = mygridG3.getUserData(rowID,"!nativeeditor_status");
						if(RowEditStatus == ""){
							mygridG3.setUserData(rowID,"!nativeeditor_status","updated");
							mygridG3.setRowTextBold(rowID);
						}
					}
				}
				return true;
			}else{
				return false;
			}
		});
		 // IO : UUID_SEQ초기화	
		 // IO : TEAM_NM초기화	
		 // IO : 위험 상초기화	
		 // IO : 위험 중초기화	
		 // IO : 위험 하초기화	
		 // IO : 취약점갯수초기화	
	//onCheck
		mygridG3.attachEvent("onCheck",function(rowId, cellInd, state){
			//onCheck is void return event
			alog(rowId + " is onCheck.");
			//일반 체크 박스는 변경이면 실제 row 변경
			if( 1 == 2 
				){
				RowEditStatus = mygridG3.getUserData(rowId,"!nativeeditor_status");
				if(RowEditStatus == ""){
					mygridG3.setUserData(rowId,"!nativeeditor_status","updated");
					mygridG3.setRowTextBold(rowId);
					mygridG3.cells(rowId,cellInd).cell.wasChanged = true;	
				}
			}
						
		});	
		// ROW선택 이벤트
		mygridG3.attachEvent("onRowSelect",function(rowID,celInd){
			RowEditStatus = mygridG3.getUserData(rowID,"!nativeeditor_status");
			if(RowEditStatus == "inserted"){return false;}
			//GRIDRowSelect30(rowID,celInd);
			//팝업오프너 호출
			//CD[필수], NM 정보가 있는 경우 팝업 오프너에게 값 전달
			popG3json = jQuery.parseJSON('{ "__NAME":"lastinputG3json"' +
			'}');

			if(popG3json && popG3json.CD){
				goOpenerReturn(popG3json);
				return;
			}
			//LAST SELECT ROW
			//lastselectG3json = jQuery.parseJSON('{ "__NAME":"lastinputG3json"' +
			//', "UUID_SEQ" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("UUID_SEQ")).getValue()) + '"' +
			//', "TEAM_NM" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("TEAM_NM")).getValue()) + '"' +
			//', "PRIORITY_1" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("PRIORITY_1")).getValue()) + '"' +
			//', "PRIORITY_2" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("PRIORITY_2")).getValue()) + '"' +
			//', "PRIORITY_3" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("PRIORITY_3")).getValue()) + '"' +
			//', "VUL_CNT" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("VUL_CNT")).getValue()) + '"' +
			//'}');
		//A124
			lastinputG4json = jQuery.parseJSON('{ "__NAME":"lastinputG4json"' +
				', "G3-TEAM_NM" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("TEAM_NM")).getValue()) + '"' +
			'}');
		lastinputG4 = new FormData(); // 시스템별 현황
		lastinputG4.append("G3-TEAM_NM", mygridG3.cells(rowID,mygridG3.getColIndexById("TEAM_NM")).getValue().replace(/&amp;/g, "&")); // 
		G4_SEARCH(lastinputG4,uuidv4()); //자식그룹 호출 : 시스템별 현황
		});
		mygridG3.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){

            alog("mygridG3  onEditCell ------------------start");
            alog("       stage : " + stage);
            alog("       rId : " + rId);
            alog("       cInd : " + cInd);
            alog("       nValue : " + nValue);
            alog("       oValue : " + oValue);

            RowEditStatus = mygridG3.getUserData(rId,"!nativeeditor_status");
            if(stage == 2
                && RowEditStatus != "inserted"
                && RowEditStatus != "deleted"
                && nValue != oValue
                ){
                if(RowEditStatus == "") {
                    mygridG3.setUserData(rId,"!nativeeditor_status","updated");
                    mygridG3.setRowTextBold(rId);
                }
                mygridG3.cells(rId,cInd).cell.wasChanged = true;
            }
            return true;

		});
		mygridG3.setColumnHidden(mygridG3.getColIndexById("UUID_SEQ"),true); //UUID_SEQ
        alog("G3_INIT()-------------------------end");
     }
	//시스템별 현황 그리드 초기화
function G4_INIT(){
  alog("G4_INIT()-------------------------start");

        //그리드 초기화
        mygridG4 = new dhtmlXGridObject('gridG4');
        mygridG4.setDateFormat("%Y%m%d");
        mygridG4.setImagePath("../lib/dhtmlxSuite/codebase/imgs/"); //DHTMLX IMG
		mygridG4.setUserData("","gridTitle","G4 : 시스템별 현황"); //글로별 변수에 그리드 타이블 넣기
		//헤더초기화
        mygridG4.setHeader("UUID_SEQ,TEAM_NM,SYS_NM,SUBSYS_NM,취약점갯수");
		mygridG4.setColumnIds("UUID_SEQ,TEAM_NM,SYS_NM,SUBSYS_NM,VUL_CNT");
		mygridG4.setInitWidths("60,60,120,60,60");
		mygridG4.setColTypes("ro,ro,ro,ro,ron");
	//가로 정렬	
		mygridG4.setColAlign("left,left,left,left,left");
		mygridG4.setColSorting("int,str,str,str,int");		//렌더링	
		mygridG4.enableSmartRendering(false);
		mygridG4.enableMultiselect(true);
		//mygridG4.setColValidators("G4_UUID_SEQ,G4_TEAM_NM,G4_SYS_NM,G4_SUBSYS_NM,G4_VUL_CNT");
		mygridG4.splitAt(0);//'freezes' 0 columns 
		mygridG4.init();
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
		 // IO : UUID_SEQ초기화	
		 // IO : TEAM_NM초기화	
		 // IO : SYS_NM초기화	
		 // IO : SUBSYS_NM초기화	
		 // IO : 취약점갯수초기화	
	//onCheck
		mygridG4.attachEvent("onCheck",function(rowId, cellInd, state){
			//onCheck is void return event
			alog(rowId + " is onCheck.");
			//일반 체크 박스는 변경이면 실제 row 변경
			if( 1 == 2 
				){
				RowEditStatus = mygridG4.getUserData(rowId,"!nativeeditor_status");
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
			//LAST SELECT ROW
			//lastselectG4json = jQuery.parseJSON('{ "__NAME":"lastinputG4json"' +
			//', "UUID_SEQ" : "' + q(mygridG4.cells(rowID,mygridG4.getColIndexById("UUID_SEQ")).getValue()) + '"' +
			//', "TEAM_NM" : "' + q(mygridG4.cells(rowID,mygridG4.getColIndexById("TEAM_NM")).getValue()) + '"' +
			//', "SYS_NM" : "' + q(mygridG4.cells(rowID,mygridG4.getColIndexById("SYS_NM")).getValue()) + '"' +
			//', "SUBSYS_NM" : "' + q(mygridG4.cells(rowID,mygridG4.getColIndexById("SUBSYS_NM")).getValue()) + '"' +
			//', "VUL_CNT" : "' + q(mygridG4.cells(rowID,mygridG4.getColIndexById("VUL_CNT")).getValue()) + '"' +
			//'}');
		//A124
			lastinputG5json = jQuery.parseJSON('{ "__NAME":"lastinputG5json"' +
				', "G4-SUBSYS_NM" : "' + q(mygridG4.cells(rowID,mygridG4.getColIndexById("SUBSYS_NM")).getValue()) + '"' +
			', "G4-SYS_NM" : "' + q(mygridG4.cells(rowID,mygridG4.getColIndexById("SYS_NM")).getValue()) + '"' +
			', "G4-TEAM_NM" : "' + q(mygridG4.cells(rowID,mygridG4.getColIndexById("TEAM_NM")).getValue()) + '"' +
			'}');
		lastinputG5 = new FormData(); // 취약점별 현황
		lastinputG5.append("G4-SUBSYS_NM", mygridG4.cells(rowID,mygridG4.getColIndexById("SUBSYS_NM")).getValue().replace(/&amp;/g, "&")); // 
		lastinputG5.append("G4-SYS_NM", mygridG4.cells(rowID,mygridG4.getColIndexById("SYS_NM")).getValue().replace(/&amp;/g, "&")); // 
		lastinputG5.append("G4-TEAM_NM", mygridG4.cells(rowID,mygridG4.getColIndexById("TEAM_NM")).getValue().replace(/&amp;/g, "&")); // 
		G5_SEARCH(lastinputG5,uuidv4()); //자식그룹 호출 : 취약점별 현황
		});
		mygridG4.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){

            alog("mygridG4  onEditCell ------------------start");
            alog("       stage : " + stage);
            alog("       rId : " + rId);
            alog("       cInd : " + cInd);
            alog("       nValue : " + nValue);
            alog("       oValue : " + oValue);

            RowEditStatus = mygridG4.getUserData(rId,"!nativeeditor_status");
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
		mygridG4.setColumnHidden(mygridG4.getColIndexById("UUID_SEQ"),true); //UUID_SEQ
		mygridG4.setColumnHidden(mygridG4.getColIndexById("TEAM_NM"),true); //TEAM_NM
        alog("G4_INIT()-------------------------end");
     }
	//취약점별 현황 그리드 초기화
function G5_INIT(){
  alog("G5_INIT()-------------------------start");

        //그리드 초기화
        mygridG5 = new dhtmlXGridObject('gridG5');
        mygridG5.setDateFormat("%Y%m%d");
        mygridG5.setImagePath("../lib/dhtmlxSuite/codebase/imgs/"); //DHTMLX IMG
		mygridG5.setUserData("","gridTitle","G5 : 취약점별 현황"); //글로별 변수에 그리드 타이블 넣기
		//헤더초기화
        mygridG5.setHeader("UUID_SEQ,TEAM_NM,SYS_NM,SUBSYS_NM,RUESET,취약점갯수");
		mygridG5.setColumnIds("UUID_SEQ,TEAM_NM,SYS_NM,SUBSYS_NM,RULESET,VUL_CNT");
		mygridG5.setInitWidths("60,60,120,60,180,60");
		mygridG5.setColTypes("ro,ro,ro,ro,ro,ro");
	//가로 정렬	
		mygridG5.setColAlign("left,left,left,left,left,left");
		mygridG5.setColSorting("int,str,str,str,str,int");		//렌더링	
		mygridG5.enableSmartRendering(false);
		mygridG5.enableMultiselect(true);
		//mygridG5.setColValidators("G5_UUID_SEQ,G5_TEAM_NM,G5_SYS_NM,G5_SUBSYS_NM,G5_RULESET,G5_VUL_CNT");
		mygridG5.splitAt(0);//'freezes' 0 columns 
		mygridG5.init();
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
		 // IO : UUID_SEQ초기화	
		 // IO : TEAM_NM초기화	
		 // IO : SYS_NM초기화	
		 // IO : SUBSYS_NM초기화	
		 // IO : RUESET초기화	
		 // IO : 취약점갯수초기화	
	//onCheck
		mygridG5.attachEvent("onCheck",function(rowId, cellInd, state){
			//onCheck is void return event
			alog(rowId + " is onCheck.");
			//일반 체크 박스는 변경이면 실제 row 변경
			if( 1 == 2 
				){
				RowEditStatus = mygridG5.getUserData(rowId,"!nativeeditor_status");
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
			//LAST SELECT ROW
			//lastselectG5json = jQuery.parseJSON('{ "__NAME":"lastinputG5json"' +
			//', "UUID_SEQ" : "' + q(mygridG5.cells(rowID,mygridG5.getColIndexById("UUID_SEQ")).getValue()) + '"' +
			//', "TEAM_NM" : "' + q(mygridG5.cells(rowID,mygridG5.getColIndexById("TEAM_NM")).getValue()) + '"' +
			//', "SYS_NM" : "' + q(mygridG5.cells(rowID,mygridG5.getColIndexById("SYS_NM")).getValue()) + '"' +
			//', "SUBSYS_NM" : "' + q(mygridG5.cells(rowID,mygridG5.getColIndexById("SUBSYS_NM")).getValue()) + '"' +
			//', "RULESET" : "' + q(mygridG5.cells(rowID,mygridG5.getColIndexById("RULESET")).getValue()) + '"' +
			//', "VUL_CNT" : "' + q(mygridG5.cells(rowID,mygridG5.getColIndexById("VUL_CNT")).getValue()) + '"' +
			//'}');
		//A124
		});
		mygridG5.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){

            alog("mygridG5  onEditCell ------------------start");
            alog("       stage : " + stage);
            alog("       rId : " + rId);
            alog("       cInd : " + cInd);
            alog("       nValue : " + nValue);
            alog("       oValue : " + oValue);

            RowEditStatus = mygridG5.getUserData(rId,"!nativeeditor_status");
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
		mygridG5.setColumnHidden(mygridG5.getColIndexById("UUID_SEQ"),true); //UUID_SEQ
		mygridG5.setColumnHidden(mygridG5.getColIndexById("TEAM_NM"),true); //TEAM_NM
		mygridG5.setColumnHidden(mygridG5.getColIndexById("SYS_NM"),true); //SYS_NM
		mygridG5.setColumnHidden(mygridG5.getColIndexById("SUBSYS_NM"),true); //SUBSYS_NM
        alog("G5_INIT()-------------------------end");
     }
//D146 그룹별 기능 함수 출력		
// CONDITIONSearch	
function G1_SEARCHALL(token){
	alog("G1_SEARCHALL--------------------------start");
	//입력값검증
	//폼의 모든값 구하기
	var ConAllData = $( "#condition" ).serialize();
	alog("ConAllData:" + ConAllData);
	lastinputG2 = new FormData(); //팀별 현황 (보안취약점 갯수)
	lastinputG3 = new FormData(); //팀별 현황 (보안취약점 갯수)
	//json : G1
            lastinputG2json = jQuery.parseJSON('{ "__NAME":"lastinputG2json"' +'}');
            lastinputG3json = jQuery.parseJSON('{ "__NAME":"lastinputG3json"' +'}');
	//  호출
	G2_SEARCH(lastinputG2,token);
	//  호출
	G3_SEARCH(lastinputG3,token);
	alog("G1_SEARCHALL--------------------------end");
}
    //그리드 조회(팀별 현황 (보안취약점 갯수))	
    function G2_SEARCH(tinput,token){
        alog("G2_SEARCH()------------start");

        //post 만들기
		sendFormData = new FormData($("#condition")[0]);
		for(var pair of tinput.entries()) {
			sendFormData.append(pair[0],pair[1]);
   			//console.log(pair[0]+ ', '+ pair[1]); 
		}

        //불러오기
        $.ajax({
            type : "POST",
            url : url_G2_SEARCH+"&TOKEN=" + token + " &G2_CRUD_MODE=read" ,
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

		//첫 컬럼은 라벨
            var newLabels = [];
            var nowCol = 0;
            for(i=0;i<resData.RTN_DATA.rows.length;i++){
                newLabels.push(resData.RTN_DATA.rows[i].data[nowCol]);
            }
            chartG2Data.labels = newLabels;
														             //두번째 컬럼부터 
            nowCol++;
            var dsColor = window.chartColors[colorNames[nowCol-1]];                 
            var newDataset = {
                type : 'line',                
				label: '유형수',
				colid : 'TYPE_CNT',
				backgroundColor: color(dsColor).alpha(0.5).rgbString(),
				borderColor: dsColor,
				borderWidth: 1,
				data: [],
				yAxisID: 'y-left'
            };
            for(i=0;i<resData.RTN_DATA.rows.length;i++){
                newDataset.data.push(resData.RTN_DATA.rows[i].data[nowCol]);
            }      
            chartG2Data.datasets.push(newDataset);
														 
            //두번째 컬럼부터 
            nowCol++;
            var dsColor = window.chartColors[colorNames[nowCol-1]];                 
            var newDataset = {
                type : 'bar',                
				label: '취약점갯수',
				colid : 'VUL_CNT',
				backgroundColor: color(dsColor).alpha(0.5).rgbString(),
				borderColor: dsColor,
				borderWidth: 1,
				data: [],
				yAxisID: 'y-right'
            };
            for(i=0;i<resData.RTN_DATA.rows.length;i++){
                newDataset.data.push(resData.RTN_DATA.rows[i].data[nowCol]);
            }      
            chartG2Data.datasets.push(newDataset);
														 
			window.myBarG2.update();     //업데이트
						
					}
					msgNotice("[팀별 현황 (보안취약점 갯수)] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[팀별 현황 (보안취약점 갯수)] 서버 조회중 에러가 발생했습니다.RTN_CD : " + resData.RTN_CD + "ERR_CD : " + resData.ERR_CD + "RTN_MSG :" + resData.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[팀별 현황 (보안취약점 갯수)] Ajax http 500 error ( " + error + " )",3);
                alog("[팀별 현황 (보안취약점 갯수)] Ajax http 500 error ( " + error + " )");
            }
        });

        alog("gridSearchG2()------------end");
    }








    //그리드 조회(팀별 현황 (보안취약점 갯수))	
    function G3_SEARCH(tinput,token){
        alog("G3_SEARCH()------------start");

		var tGrid = mygridG3;

        //그리드 초기화
        tGrid.clearAll();        //post 만들기
		sendFormData = new FormData($("#condition")[0]);
		for(var pair of tinput.entries()) {
			sendFormData.append(pair[0],pair[1]);
   			//console.log(pair[0]+ ', '+ pair[1]); 
		}
        //불러오기
        $.ajax({
            type : "POST",
            url : url_G3_SEARCH+"&TOKEN=" + token + " &G3_CRUD_MODE=read" ,
            data : sendFormData,
			processData: false,
			contentType: false,
            dataType: "json",
            async: true,
            success: function(data){
                alog("   gridG3 json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
					var row_cnt = 0;
					if(data.RTN_DATA){
						row_cnt = data.RTN_DATA.rows.length;
						$("#spanG3Cnt").text(row_cnt);						tGrid.parse(data.RTN_DATA,function(){
							//푸터 합계 처리	

						},"json");
						
					}
					msgNotice("[팀별 현황 (보안취약점 갯수)] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[팀별 현황 (보안취약점 갯수)] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[팀별 현황 (보안취약점 갯수)] Ajax http 500 error ( " + error + " )",3);
                alog("[팀별 현황 (보안취약점 갯수)] Ajax http 500 error ( " + error + " )");
            }
        });
        alog("G3_SEARCH()------------end");
    }

//새로고침	
function G3_RELOAD(token){
  alog("G3_RELOAD-----------------start");
  G3_SEARCH(lastinputG3,token);
}








    //그리드 조회(시스템별 현황)	
    function G4_SEARCH(tinput,token){
        alog("G4_SEARCH()------------start");

		var tGrid = mygridG4;

        //그리드 초기화
        tGrid.clearAll();        //post 만들기
		sendFormData = new FormData($("#condition")[0]);
		for(var pair of tinput.entries()) {
			sendFormData.append(pair[0],pair[1]);
   			//console.log(pair[0]+ ', '+ pair[1]); 
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
						$("#spanG4Cnt").text(row_cnt);						tGrid.parse(data.RTN_DATA,function(){
							//푸터 합계 처리	

						},"json");
						
					}
					msgNotice("[시스템별 현황] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[시스템별 현황] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[시스템별 현황] Ajax http 500 error ( " + error + " )",3);
                alog("[시스템별 현황] Ajax http 500 error ( " + error + " )");
            }
        });
        alog("G4_SEARCH()------------end");
    }

    function G4_VIEWHIDDEN(){
		alog("G4_VIEWHIDDEN()..................start");
        if(isToggleHiddenColG4){
            isToggleHiddenColG4 = false;            mygridG4.setColumnHidden(mygridG4.getColIndexById("UUID_SEQ"),true); //UUID_SEQ
            mygridG4.setColumnHidden(mygridG4.getColIndexById("TEAM_NM"),true); //TEAM_NM
     }else{
            isToggleHiddenColG4 = true;
            mygridG4.setColumnHidden(mygridG4.getColIndexById("UUID_SEQ"),false); //UUID_SEQ
            mygridG4.setColumnHidden(mygridG4.getColIndexById("TEAM_NM"),false); //TEAM_NM
        }
		alog("G4_VIEWHIDDEN()..................end");
    }
//새로고침	
function G4_RELOAD(token){
  alog("G4_RELOAD-----------------start");
  G4_SEARCH(lastinputG4,token);
}
//새로고침	
function G5_RELOAD(token){
  alog("G5_RELOAD-----------------start");
  G5_SEARCH(lastinputG5,token);
}
    function G5_HIDDENCOL(){
		alog("G5_HIDDENCOL()..................start");
        if(isToggleHiddenColG5){
            isToggleHiddenColG5 = false;            mygridG5.setColumnHidden(mygridG5.getColIndexById("UUID_SEQ"),true); //UUID_SEQ
            mygridG5.setColumnHidden(mygridG5.getColIndexById("TEAM_NM"),true); //TEAM_NM
            mygridG5.setColumnHidden(mygridG5.getColIndexById("SYS_NM"),true); //SYS_NM
            mygridG5.setColumnHidden(mygridG5.getColIndexById("SUBSYS_NM"),true); //SUBSYS_NM
     }else{
            isToggleHiddenColG5 = true;
            mygridG5.setColumnHidden(mygridG5.getColIndexById("UUID_SEQ"),false); //UUID_SEQ
            mygridG5.setColumnHidden(mygridG5.getColIndexById("TEAM_NM"),false); //TEAM_NM
            mygridG5.setColumnHidden(mygridG5.getColIndexById("SYS_NM"),false); //SYS_NM
            mygridG5.setColumnHidden(mygridG5.getColIndexById("SUBSYS_NM"),false); //SUBSYS_NM
        }
		alog("G5_HIDDENCOL()..................end");
    }








    //그리드 조회(취약점별 현황)	
    function G5_SEARCH(tinput,token){
        alog("G5_SEARCH()------------start");

		var tGrid = mygridG5;

        //그리드 초기화
        tGrid.clearAll();        //post 만들기
		sendFormData = new FormData($("#condition")[0]);
		for(var pair of tinput.entries()) {
			sendFormData.append(pair[0],pair[1]);
   			//console.log(pair[0]+ ', '+ pair[1]); 
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
						$("#spanG5Cnt").text(row_cnt);						tGrid.parse(data.RTN_DATA,function(){
							//푸터 합계 처리	

						},"json");
						
					}
					msgNotice("[취약점별 현황] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[취약점별 현황] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[취약점별 현황] Ajax http 500 error ( " + error + " )",3);
                alog("[취약점별 현황] Ajax http 500 error ( " + error + " )");
            }
        });
        alog("G5_SEARCH()------------end");
    }

