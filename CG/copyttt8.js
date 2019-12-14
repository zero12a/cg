//글로벌 변수 선언
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_SEARCHALL = "copyttt8Controller?CTLGRP=G1&CTLFNC=SEARCHALL";
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_SAVE = "copyttt8Controller?CTLGRP=G1&CTLFNC=SAVE";
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_RESET = "copyttt8Controller?CTLGRP=G1&CTLFNC=RESET";
//1 변수 선언	
var obj_G1_MYRADIO; // 나의라디오 변수선언
var obj_G1_ADD_DT; // ADD 변수선언
var obj_G1_MYCHECK; // 체크 변수선언
var obj_G1_PNM; // PNM 변수선언
//그리드 변수 초기화	
//컨트롤러 경로
var url_G2_SEARCH = "copyttt8Controller?CTLGRP=G2&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G2_SAVE = "copyttt8Controller?CTLGRP=G2&CTLFNC=SAVE";
//컨트롤러 경로
var url_G2_ROWDELETE = "copyttt8Controller?CTLGRP=G2&CTLFNC=ROWDELETE";
//컨트롤러 경로
var url_G2_ROWADD = "copyttt8Controller?CTLGRP=G2&CTLFNC=ROWADD";
//컨트롤러 경로
var url_G2_RELOAD = "copyttt8Controller?CTLGRP=G2&CTLFNC=RELOAD";
//컨트롤러 경로
var url_G2_HIDDENCOL = "copyttt8Controller?CTLGRP=G2&CTLFNC=HIDDENCOL";
//컨트롤러 경로
var url_G2_CHKSAVE = "copyttt8Controller?CTLGRP=G2&CTLFNC=CHKSAVE";
//컨트롤러 경로
var url_G2_edit = "copyttt8Controller?CTLGRP=G2&CTLFNC=edit";
//그리드 객체
var mygridG2,isToggleHiddenColG2,lastinputG2,lastinputG2json,lastrowidG2;
var lastselectG2json;//그리드 변수 초기화	
//컨트롤러 경로
var url_G3_SEARCH = "copyttt8Controller?CTLGRP=G3&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G3_SAVE = "copyttt8Controller?CTLGRP=G3&CTLFNC=SAVE";
//컨트롤러 경로
var url_G3_ROWDELETE = "copyttt8Controller?CTLGRP=G3&CTLFNC=ROWDELETE";
//컨트롤러 경로
var url_G3_ROWBULKADD = "copyttt8Controller?CTLGRP=G3&CTLFNC=ROWBULKADD";
//컨트롤러 경로
var url_G3_ROWADD = "copyttt8Controller?CTLGRP=G3&CTLFNC=ROWADD";
//컨트롤러 경로
var url_G3_RELOAD = "copyttt8Controller?CTLGRP=G3&CTLFNC=RELOAD";
//컨트롤러 경로
var url_G3_HIDDENCOL = "copyttt8Controller?CTLGRP=G3&CTLFNC=HIDDENCOL";
//컨트롤러 경로
var url_G3_EXCEL = "copyttt8Controller?CTLGRP=G3&CTLFNC=EXCEL";
//컨트롤러 경로
var url_G3_CHKSAVE = "copyttt8Controller?CTLGRP=G3&CTLFNC=CHKSAVE";
//그리드 객체
var mygridG3,isToggleHiddenColG3,lastinputG3,lastinputG3json,lastrowidG3;
var lastselectG3json;//디테일 변수 초기화	

//폼뷰 컨트롤러 경로
var url_G4_USERDEF = "copyttt8Controller?CTLGRP=G4&CTLFNC=USERDEF";
//폼뷰 컨트롤러 경로
var url_G4_SEARCH = "copyttt8Controller?CTLGRP=G4&CTLFNC=SEARCH";
//폼뷰 컨트롤러 경로
var url_G4_RELOAD = "copyttt8Controller?CTLGRP=G4&CTLFNC=RELOAD";
//폼뷰 컨트롤러 경로
var url_G4_NEW = "copyttt8Controller?CTLGRP=G4&CTLFNC=NEW";
//폼뷰 컨트롤러 경로
var url_G4_MODIFY = "copyttt8Controller?CTLGRP=G4&CTLFNC=MODIFY";
//폼뷰 컨트롤러 경로
var url_G4_DELETE = "copyttt8Controller?CTLGRP=G4&CTLFNC=DELETE";
//폼뷰 컨트롤러 경로
var url_G4_save = "copyttt8Controller?CTLGRP=G4&CTLFNC=save";
var obj_G4_MYCHECK;   // 체크 글로벌 변수 선언
var obj_G4_ADD_DT;   // ADD 글로벌 변수 선언
var obj_G4_MYRADIO;   // 나의라디오 글로벌 변수 선언
var obj_G4_HIDDENLINK;   // 히든링크 글로벌 변수 선언
var obj_G4_PCD;   // PCD 글로벌 변수 선언
var obj_G4_IMG;   // 이미지뷰어 글로벌 변수 선언
var obj_G4_TFILE;   // 파일 글로벌 변수 선언
//화면 초기화	
function initBody(){
     alog("initBody()-----------------------start");
	
   //dhtmlx 메시지 박스 초기화
   dhtmlx.message.position="bottom";
	G1_INIT();	
		G2_INIT();	
		G3_INIT();	
		G4_INIT();	
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
setCodeRadio("CONDITION", "G1-MYRADIO", "BRGRP");

setCodeCheck("CONDITION", "G1-MYCHECK", "BRGRP","");

	//각 폼 오브젝트들 초기화
	//ADD_DT, ADD 초기화	
	//MYRADIO, 나의라디오 초기화	
	//G1-MYCHECK check 초기화 할게 있나.
	//PNM, PNM 초기화	
  alog("G1_INIT()-------------------------end");
}

	//마스터 그리드 초기화
function G2_INIT(){
  alog("G2_INIT()-------------------------start");

        //그리드 초기화
        mygridG2 = new dhtmlXGridObject('gridG2');
        mygridG2.setDateFormat("%Y%m%d");
        mygridG2.setImagePath("lib/dhtmlxSuite/codebase/imgs/"); //DHTMLX IMG
		mygridG2.setUserData("","gridTitle","G2 : 마스터"); //글로별 변수에 그리드 타이블 넣기
		//헤더초기화
        mygridG2.setHeader("#master_checkbox,PCD,PNM,PCDDESC,ORD,UITOOL,사용,삭제YN,ADDDT,MODDT");
		mygridG2.setColumnIds("CHK,PCD,PNM,PCDDESC,ORD,UITOOL,USEYN,DELYN,ADDDT,MODDT");
		mygridG2.setInitWidths("30,60,60,60,30,30,50,40,80,80");
		mygridG2.setColTypes("ch,ed,ed,ed,ed,ed,ed,ed,ed,ed");
	//가로 정렬	
		mygridG2.setColAlign("left,left,left,left,left,left,left,left,left,left");
		mygridG2.setColSorting("int,str,str,str,int,str,str,str,str,str");		//렌더링	
		mygridG2.enableSmartRendering(false);
		mygridG2.enableMultiselect(true);
		//mygridG2.setColValidators("G2_CHK,G2_PCD,G2_PNM,G2_PCDDESC,G2_ORD,G2_UITOOL,G2_USEYN,G2_DELYN,G2_ADDDT,G2_MODDT");
		mygridG2.splitAt(0);//'freezes' 0 columns 
		mygridG2.init();

		mygridG2.attachEvent("onDhxCalendarCreated", function(myCal){ myCal.loadUserLanguage( "kr" ); });
		//블럭선택 및 복사
		mygridG2.enableBlockSelection(true);
		mygridG2.attachEvent("onKeyPress",function(code,ctrl,shift){
			alog("onKeyPress.......code=" + code + ", ctrl=" + ctrl + ", shift=" + shift);

			//셀편집모드 아닐때만 블록처리
			if(!mygridG2.editor){
				mygridG2.setCSVDelimiter("	");
				if(code==67&&ctrl){
					mygridG2.copyBlockToClipboard();

					var top_row_idx = mygridG2.getSelectedBlock().LeftTopRow;
					var bottom_row_idx = mygridG2.getSelectedBlock().RightBottomRow;
					var copyRowCnt = bottom_row_idx-top_row_idx+1;
					msgNotice( copyRowCnt + "개의 행이 클립보드에 복사되었습니다.",2);

				}
				if(code==86&&ctrl){
					mygridG2.pasteBlockFromClipboard();

					//row상태 변경
					var top_row_idx = mygridG2.getSelectedBlock().LeftTopRow;
					var bottom_row_idx = mygridG2.getSelectedBlock().RightBottomRow;
					for(j=top_row_idx;j<=bottom_row_idx;j++){
						var rowID = mygridG2.getRowId(j);
						RowEditStatus = mygridG2.getUserData(rowID,"!nativeeditor_status");
						if(RowEditStatus == ""){
							mygridG2.setUserData(rowID,"!nativeeditor_status","updated");
							mygridG2.setRowTextBold(rowID);
						}
					}
				}
				return true;
			}else{
				return false;
			}
		});
		 // IO : CHK초기화	
		 // IO : PCD초기화	
		 // IO : PNM초기화	
		 // IO : PCDDESC초기화	
		 // IO : ORD초기화	
		 // IO : UITOOL초기화	
		 // IO : 사용초기화	
		 // IO : 삭제YN초기화	
		 // IO : ADDDT초기화	
		 // IO : MODDT초기화	
	//onCheck
		mygridG2.attachEvent("onCheck",function(rowId, cellInd, state){
			//onCheck is void return event
			alog(rowId + " is onCheck.");
			//ROW 마스터 체크 박스는 변경이면 실제 row 안함
			if(  mygridG2.getColumnId(cellInd) == "ROWCHK" ){
					mygridG2.cells(rowId,cellInd).cell.wasChanged = false;	
			}	
			//일반 체크 박스는 변경이면 실제 row 변경
			if( 1 == 2 
				){
				RowEditStatus = mygridG2.getUserData(rowId,"!nativeeditor_status");
				if(RowEditStatus == ""){
					mygridG2.setUserData(rowId,"!nativeeditor_status","updated");
					mygridG2.setRowTextBold(rowId);
					mygridG2.cells(rowId,cellInd).cell.wasChanged = true;	
				}
			}
						
		});	
		// ROW선택 이벤트
		mygridG2.attachEvent("onRowSelect",function(rowID,celInd){
			RowEditStatus = mygridG2.getUserData(rowID,"!nativeeditor_status");
			if(RowEditStatus == "inserted"){return false;}
			//GRIDRowSelect20(rowID,celInd);
            //편집모드 일때는 하위 새로고침 안하게 하기
            if($("#G2-edit_EDIT_MODE") && $("#G2-edit_EDIT_MODE").is(":checked"))return false;
			//팝업오프너 호출
			//CD[필수], NM 정보가 있는 경우 팝업 오프너에게 값 전달
			popG2json = jQuery.parseJSON('{ "__NAME":"lastinputG3json"' +
			'}');

			if(popG2json && popG2json.CD){
				goOpenerReturn(popG2json);
				return;
			}
			//LAST SELECT ROW
			//lastselectG2json = jQuery.parseJSON('{ "__NAME":"lastinputG2json"' +
			//', "CHK" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("CHK")).getValue()) + '"' +
			//', "PCD" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("PCD")).getValue()) + '"' +
			//', "PNM" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("PNM")).getValue()) + '"' +
			//', "PCDDESC" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("PCDDESC")).getValue()) + '"' +
			//', "ORD" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("ORD")).getValue()) + '"' +
			//', "UITOOL" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("UITOOL")).getValue()) + '"' +
			//', "USEYN" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("USEYN")).getValue()) + '"' +
			//', "DELYN" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("DELYN")).getValue()) + '"' +
			//', "ADDDT" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("ADDDT")).getValue()) + '"' +
			//', "MODDT" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("MODDT")).getValue()) + '"' +
			//'}');
		//A124
			lastinputG3json = jQuery.parseJSON('{ "__NAME":"lastinputG3json"' +
				', "G2-PCD" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("PCD")).getValue()) + '"' +
			'}');
		lastinputG3 = new HashMap(); // 상세
		lastinputG3.set("G2-PCD", mygridG2.cells(rowID,mygridG2.getColIndexById("PCD")).getValue().replace(/&amp;/g, "&")); // 
			lastinputG4json = jQuery.parseJSON('{ "__NAME":"lastinputG4json"' +
				', "G2-PCD" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("PCD")).getValue()) + '"' +
			'}');
		lastinputG4 = new HashMap(); // 상세폼
		lastinputG4.set("G2-PCD", mygridG2.cells(rowID,mygridG2.getColIndexById("PCD")).getValue().replace(/&amp;/g, "&")); // 
			G3_SEARCH(lastinputG3,uuidv4()); //자식그룹 호출 : 상세
			G4_SEARCH(lastinputG4,uuidv4()); //자식그룹 호출 : 상세폼
		});
		mygridG2.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){

            alog("mygridG2  onEditCell ------------------start");
            alog("       stage : " + stage);
            alog("       rId : " + rId);
            alog("       cInd : " + cInd);
            alog("       nValue : " + nValue);
            alog("       oValue : " + oValue);

            RowEditStatus = mygridG2.getUserData(rId,"!nativeeditor_status");
            if(stage == 2
                && RowEditStatus != "inserted"
                && RowEditStatus != "deleted"
                && nValue != oValue
                ){
                if(RowEditStatus == "") {
                    mygridG2.setUserData(rId,"!nativeeditor_status","updated");
                    mygridG2.setRowTextBold(rId);
                }
                mygridG2.cells(rId,cInd).cell.wasChanged = true;
            }
            return true;

		});
        alog("G2_INIT()-------------------------end");
     }
	//상세 그리드 초기화
function G3_INIT(){
  alog("G3_INIT()-------------------------start");

        //그리드 초기화
        mygridG3 = new dhtmlXGridObject('gridG3');
        mygridG3.setDateFormat("%Y%m%d");
        mygridG3.setImagePath("lib/dhtmlxSuite/codebase/imgs/"); //DHTMLX IMG
		mygridG3.setUserData("","gridTitle","G3 : 상세"); //글로별 변수에 그리드 타이블 넣기
		//헤더초기화
        mygridG3.setHeader("CD,NM,CDDESC,PCD,ORD,CDVAL,CDVAL2,CDMIN,CDMAX,데이터타입,EDITYN,FORMATYN,사용,삭제YN,ADDDT,MODDT");
		mygridG3.setColumnIds("CD,NM,CDDESC,PCD,ORD,CDVAL,CDVAL2,CDMIN,CDMAX,DATATYPE,EDITYN,FORMATYN,USEYN,DELYN,ADDDT,MODDT");
		mygridG3.setInitWidths("60,60,60,60,60,60,60,60,60,200,60,60,50,40,80,80");
		mygridG3.setColTypes("ed,ed,txttxt,ed,ed,txttxt,txttxt,ed,ed,ed,ed,ed,ed,ed,ed,ed");
	//가로 정렬	
		mygridG3.setColAlign("left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left");
		mygridG3.setColSorting("str,str,str,str,int,str,str,str,str,str,str,str,str,str,str,str");		//렌더링	
		mygridG3.enableSmartRendering(false);
		mygridG3.enableMultiselect(true);
		//mygridG3.setColValidators("G3_CD,G3_NM,G3_CDDESC,G3_PCD,G3_ORD,G3_CDVAL,G3_CDVAL2,G3_CDMIN,G3_CDMAX,G3_DATATYPE,G3_EDITYN,G3_FORMATYN,G3_USEYN,G3_DELYN,G3_ADDDT,G3_MODDT");
		mygridG3.splitAt(0);//'freezes' 0 columns 
		mygridG3.init();

		mygridG3.attachEvent("onDhxCalendarCreated", function(myCal){ myCal.loadUserLanguage( "kr" ); });
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
		 // IO : CD초기화	
		 // IO : NM초기화	
		 // IO : CDDESC초기화	
		 // IO : PCD초기화	
		 // IO : ORD초기화	
		 // IO : CDVAL초기화	
		 // IO : CDVAL2초기화	
		 // IO : CDMIN초기화	
		 // IO : CDMAX초기화	
		 // IO : 데이터타입초기화	
		 // IO : EDITYN초기화	
		 // IO : FORMATYN초기화	
		 // IO : 사용초기화	
		 // IO : 삭제YN초기화	
		 // IO : ADDDT초기화	
		 // IO : MODDT초기화	
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
			//', "CD" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("CD")).getValue()) + '"' +
			//', "NM" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("NM")).getValue()) + '"' +
			//', "CDDESC" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("CDDESC")).getValue()) + '"' +
			//', "PCD" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("PCD")).getValue()) + '"' +
			//', "ORD" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("ORD")).getValue()) + '"' +
			//', "CDVAL" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("CDVAL")).getValue()) + '"' +
			//', "CDVAL2" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("CDVAL2")).getValue()) + '"' +
			//', "CDMIN" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("CDMIN")).getValue()) + '"' +
			//', "CDMAX" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("CDMAX")).getValue()) + '"' +
			//', "DATATYPE" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("DATATYPE")).getValue()) + '"' +
			//', "EDITYN" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("EDITYN")).getValue()) + '"' +
			//', "FORMATYN" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("FORMATYN")).getValue()) + '"' +
			//', "USEYN" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("USEYN")).getValue()) + '"' +
			//', "DELYN" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("DELYN")).getValue()) + '"' +
			//', "ADDDT" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("ADDDT")).getValue()) + '"' +
			//', "MODDT" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("MODDT")).getValue()) + '"' +
			//'}');
		//A124
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
        alog("G3_INIT()-------------------------end");
     }
//디테일 초기화	
//상세폼 폼뷰 초기화
function G4_INIT(){
  alog("G4_INIT()-------------------------start");
setCodeCheck("FORMVIEW", "G4-MYCHECK", "BRGRP","");

setCodeRadio("FORMVIEW", "G4-MYRADIO", "BRGRP","LINEEND");




	//컬럼 초기화
	//G4-MYCHECK check 초기화 할게 있나.
	//ADD_DT, ADD 초기화	
	//MYRADIO, 나의라디오 초기화	
	//HIDDENLINK, 히든링크 초기화	
	//PCD, PCD 초기화	
	//IMG, 이미지뷰어 초기화	
	//TFILE, 파일 초기화	
  alog("G4_INIT()-------------------------end");
}
//D146 그룹별 기능 함수 출력		
// CONDITIONSearch	
function G1_SEARCHALL(token){
	alog("G1_SEARCHALL--------------------------start");
	//입력값검증
	//폼의 모든값 구하기
	var ConAllData = $( "#condition" ).serialize();
	alog("ConAllData:" + ConAllData);
	//json : G1
			lastinputG2 = new HashMap(); //마스터
				lastinputG2.set("G1-MYRADIO", $('input[name="G1-MYRADIO"]:checked').val());
	//  호출
	G2_SEARCH(lastinputG2,token);
	alog("G1_SEARCHALL--------------------------end");
}
//검색조건 초기화
function G1_RESET(){
	alog("G1_RESET--------------------------start");
	$('#condition')[0].reset();
}
//1, 저장	
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








    //그리드 조회(마스터)	
    function G2_SEARCH(tinput,token){
        alog("G2_SEARCH()------------start");

		var tGrid = mygridG2;

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
	sendFormData.append("G1-MYRADIO",$('input[name="G1-MYRADIO"]:checked').val());//radio 선택값 가져오기.
		var tmpCheckVal = "";
		$('input:checkbox[name="G1-MYCHECK"]').each(function() {
			if(this.checked){//checked 처리된 항목의 값
			if(tmpCheckVal !="") tmpCheckVal +=",";
				tmpCheckVal += this.value;
			}
		});

		sendFormData.append("G1-MYCHECK",tmpCheckVal);//checkbox 선택값 가져오기.

        //불러오기
        $.ajax({
            type : "POST",
            url : url_G2_SEARCH+"&TOKEN=" + token + " &G2_CRUD_MODE=read" ,
            data : sendFormData,
			processData: false,
			contentType: false,
            dataType: "json",
            async: true,
            success: function(data){
                alog("   gridG2 json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
					var row_cnt = 0;
					if(data.RTN_DATA){
						row_cnt = data.RTN_DATA.rows.length;
						$("#spanG2Cnt").text(row_cnt);
						tGrid.parse(data.RTN_DATA,function(){
							//푸터 합계 처리	

						},"json");
						
					}else{
						$("#spanG2Cnt").text("-");
					}
					msgNotice("[마스터] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[마스터] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[마스터] Ajax http 500 error ( " + error + " )",3);
                alog("[마스터] Ajax http 500 error ( " + data.RTN_MSG + " )");
            }
        });
        alog("G2_SEARCH()------------end");
    }

function G2_CHKSAVE(token){
	alog("G2_CHKSAVE()------------start");
	tgrid = mygridG2;

	//체크된 ROW의 ID 배열로 불러오기
	var arrRows =  tgrid.getCheckedRows(0); //0번째 CHK 컬럼
	//alert(arrRows.length);

        //전송용 post 만들기
		sendFormData = new FormData($("#condition")[0]);

		if(typeof lastinputG2 != "undefined"){
			var tKeys = lastinputG2.keys();
			for(i=0;i<tKeys.length;i++) {
				sendFormData.append(tKeys[i],lastinputG2.get(tKeys[i]));
				//console.log(tKeys[i]+ '='+ lastinputG2.get(tKeys[i])); 
			}
		}
	//CHK 배열 합치기
	sendFormData.append("G2-CHK",arrRows);
	$.ajax({
		type : "POST",
		url : url_G2_CHKSAVE + "&TOKEN=" + token,
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
	
	alog("G2_CHKSAVE()------------end");
}
//행추가3 (마스터)	
//그리드 행추가 : 마스터
	function G2_ROWADD(){
		if( !(lastinputG2)|| lastinputG2.get("G2-MYRADIO") == ""){
			msgError("조회 후에 행추가 가능합니다. 또는 상속값이 없습니다.",3);
		}else{
			var tCols = ["","","","","","","","","",""];//초기값
			addRow(mygridG2,tCols);
		}
	}    function G2_HIDDENCOL(){
		alog("G2_HIDDENCOL()..................start");
        if(isToggleHiddenColG2){
            isToggleHiddenColG2 = false;     }else{
            isToggleHiddenColG2 = true;
        }
		alog("G2_HIDDENCOL()..................end");
    }
    function G2_ROWDELETE(){	
        alog("G2_ROWDELETE()------------start");
        delRow(mygridG2);
        alog("G2_ROWDELETE()------------start");
    }
	function G2_SAVE(token){
	alog("G2_SAVE()------------start");
	tgrid = mygridG2;

	tgrid.setSerializationLevel(true,false,false,false,true,false);
	var myXmlString = tgrid.serialize();
        //post 만들기
		sendFormData = new FormData($("#condition")[0]);
		//for(var pair of lastinputG2.entries()) {
		//	sendFormData.append(pair[0],pair[1]);
   		//	//console.log(pair[0]+ ', '+ pair[1]); 
		//}

		if(typeof lastinputG2 != "undefined"){
			var tKeys = lastinputG2.keys();
			for(i=0;i<tKeys.length;i++) {
				sendFormData.append(tKeys[i],lastinputG2.get(tKeys[i]));
				//console.log(tKeys[i]+ '='+ lastinputG2.get(tKeys[i])); 
			}
		}
	sendFormData.append("G2-XML" , myXmlString);
	$.ajax({
		type : "POST",
		url : url_G2_SAVE + "&TOKEN=" + token,
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
	
	alog("G2_SAVE()------------end");
}
//새로고침	
function G2_RELOAD(token){
  alog("G2_RELOAD-----------------start");
  G2_SEARCH(lastinputG2,token);
}
//그리드 행추가 : 상세
	function G3_ROWBULKADD(){
		if( !(lastinputG3json)|| !(lastinputG3json.PCD) ){
			msgError("조회 후에 행추가 가능합니다",3);
		}else{
			var tCols = ["","","",lastinputG3.get("G2-PCD"),"","","","","","","","","","","",""];//초기값

	var rowcnt = prompt("Please enter row's count", "input number");
	if($.isNumeric(rowcnt)){
		for(k=0;k<rowcnt;k++){
			addRow(mygridG3,tCols);  
		}
	}
			}
	}








    //그리드 조회(상세)	
    function G3_SEARCH(tinput,token){
        alog("G3_SEARCH()------------start");

		var tGrid = mygridG3;

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
	sendFormData.append("G1-MYRADIO",$('input[name="G1-MYRADIO"]:checked').val());//radio 선택값 가져오기.
		var tmpCheckVal = "";
		$('input:checkbox[name="G1-MYCHECK"]').each(function() {
			if(this.checked){//checked 처리된 항목의 값
			if(tmpCheckVal !="") tmpCheckVal +=",";
				tmpCheckVal += this.value;
			}
		});

		sendFormData.append("G1-MYCHECK",tmpCheckVal);//checkbox 선택값 가져오기.

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
						$("#spanG3Cnt").text(row_cnt);
						tGrid.parse(data.RTN_DATA,function(){
							//푸터 합계 처리	

						},"json");
						
					}else{
						$("#spanG3Cnt").text("-");
					}
					msgNotice("[상세] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[상세] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[상세] Ajax http 500 error ( " + error + " )",3);
                alog("[상세] Ajax http 500 error ( " + data.RTN_MSG + " )");
            }
        });
        alog("G3_SEARCH()------------end");
    }

    function G3_HIDDENCOL(){
		alog("G3_HIDDENCOL()..................start");
        if(isToggleHiddenColG3){
            isToggleHiddenColG3 = false;     }else{
            isToggleHiddenColG3 = true;
        }
		alog("G3_HIDDENCOL()..................end");
    }
    function G3_ROWDELETE(){	
        alog("G3_ROWDELETE()------------start");
        delRow(mygridG3);
        alog("G3_ROWDELETE()------------start");
    }
function G3_CHKSAVE(token){
	alog("G3_CHKSAVE()------------start");
	tgrid = mygridG3;

	//체크된 ROW의 ID 배열로 불러오기
	var arrRows =  tgrid.getCheckedRows(0); //0번째 CHK 컬럼
	//alert(arrRows.length);

        //전송용 post 만들기
		sendFormData = new FormData($("#condition")[0]);

		if(typeof lastinputG3 != "undefined"){
			var tKeys = lastinputG3.keys();
			for(i=0;i<tKeys.length;i++) {
				sendFormData.append(tKeys[i],lastinputG3.get(tKeys[i]));
				//console.log(tKeys[i]+ '='+ lastinputG3.get(tKeys[i])); 
			}
		}
	//CHK 배열 합치기
	sendFormData.append("G3-CHK",arrRows);
	$.ajax({
		type : "POST",
		url : url_G3_CHKSAVE + "&TOKEN=" + token,
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
	
	alog("G3_CHKSAVE()------------end");
}
//새로고침	
function G3_RELOAD(token){
  alog("G3_RELOAD-----------------start");
  G3_SEARCH(lastinputG3,token);
}
//행추가3 (상세)	
//그리드 행추가 : 상세
	function G3_ROWADD(){
		if( !(lastinputG3)|| lastinputG3.get("G3-PCD") == ""){
			msgError("조회 후에 행추가 가능합니다. 또는 상속값이 없습니다.",3);
		}else{
			var tCols = ["","","",lastinputG3.get("G2-PCD"),"","","","","","","","","","","",""];//초기값
			addRow(mygridG3,tCols);
		}
	}	function G3_SAVE(token){
	alog("G3_SAVE()------------start");
	tgrid = mygridG3;

	tgrid.setSerializationLevel(true,false,false,false,true,false);
	var myXmlString = tgrid.serialize();
        //post 만들기
		sendFormData = new FormData($("#condition")[0]);
		//for(var pair of lastinputG3.entries()) {
		//	sendFormData.append(pair[0],pair[1]);
   		//	//console.log(pair[0]+ ', '+ pair[1]); 
		//}

		if(typeof lastinputG3 != "undefined"){
			var tKeys = lastinputG3.keys();
			for(i=0;i<tKeys.length;i++) {
				sendFormData.append(tKeys[i],lastinputG3.get(tKeys[i]));
				//console.log(tKeys[i]+ '='+ lastinputG3.get(tKeys[i])); 
			}
		}
	sendFormData.append("G3-XML" , myXmlString);
	$.ajax({
		type : "POST",
		url : url_G3_SAVE + "&TOKEN=" + token,
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
	
	alog("G3_SAVE()------------end");
}
//엑셀다운		
function G3_EXCEL(){	
	alog("G3_EXCEL-----------------start");
	var myForm = document.excelDownForm;
	var url = "/c.g/cg_phpexcel.php";
	window.open("" ,"popForm",
		  "toolbar=no, width=540, height=467, directories=no, status=no,    scrollorbars=no, resizable=no");
	myForm.action =url;
	myForm.method="post";
	myForm.target="popForm";

	mygridG3.setSerializationLevel(true,false,false,false,false,false);
	var myXmlString = mygridG3.serialize();        //컨디션 데이터 모두 말기
	$("#DATA_HEADERS").val("CD,NM,CDDESC,PCD,ORD,CDVAL,CDVAL2,CDMIN,CDMAX,DATATYPE,EDITYN,FORMATYN,USEYN,DELYN,ADDDT,MODDT");
	$("#DATA_WIDTHS").val("60,60,60,60,60,60,60,60,60,200,60,60,50,40,80,80");
	$("#DATA_ROWS").val(myXmlString);
	myForm.submit();
}
//사용자정의함수 : 사용자정의
function G4_USERDEF(token){
	alog("G4_USERDEF-----------------start");

	alog("G4_USERDEF-----------------end");
}
//	
function G4_NEW(){
       alog("[FromView] G4_NEW---------------start");
	$("#G4-CTLCUD").val("C");
	//PMGIO 로직
	//G4-MYCHECK  NEW 신규일때 할게 있나?	$("#G4-ADD_DT").val("");//ADD 신규초기화	
	$("#G4-MYRADIO").val("");//나의라디오 신규초기화	
			$("#G4-HIDDENLINK-LINK").attr("href","");//히든링크 신규
			$("#G4-HIDDENLINK-NM").text("");//히든링크 신규
			$("#DIV_G4-HIDDENLINK").css("display", "none");

	$("#G4-PCD").val("");//PCD 신규초기화	
	$("#G4-IMG").html("");
				$("#G4-TFILE-LINK").attr("href","");//파일 NEW
				$("#G4-TFILE-NM").text("");//파일 NEW
       alog("DETAILNew40---------------end");
}
//G4_save
	//IO_FILE_YN = Y	
function G4_save(token){	
	alog("G4_save---------------start");

	if( !( $("#G4-CTLCUD").val() == "C" || $("#G4-CTLCUD").val() == "U") ){
		alert("신규 또는 수정 모드 진입 후 저장할 수 있습니다.")
		return;
	}

	//전송 데이터 객체 만들기
	var sendFormData = new FormData($("#formviewG4")[0]);

	//컨디션 데이터 추가하기
	conditionData = new FormData($("#condition")[0]);
    var es, e, pair;
    for (es = conditionData.entries(); !(e = es.next()).done && (pair = e.value);) {
		sendFormData.append(pair[0],pair[1]);
    }

	$.ajax({
		type : "POST",
		url : url_G4_save + "&TOKEN=" + token,
		data : sendFormData,
		processData: false,
		contentType: false,
		success: function(tdata){
			alog(tdata);
			data = jQuery.parseJSON(tdata);
			//alert(data);
			if(data && data.RTN_CD == "200"){
				msgNotice("정상적으로 저장되었습니다.",1);
			}else{
				msgError("오류가 발생했습니다("+ data.ERR_CD + ")." + data.RTN_MSG,3);
			}
		},
		error: function(error){
			alog("Error:");
			alog(error);
		}
	});
}
//FORMVIEW DELETE
function G4_DELETE(){	
	alog("G4_DELETE---------------start");

	//조회했는지 확인하기
	if( $("#G4-CTLCUD").val() != "R" ){
		alert("조회된 것만 삭제 가능합니다.");
		return;
	}
	//확인
	if(!confirm("정말로 삭제하시겠습니까?")){
		return;
	}
	
	//삭제처리 명령어
	$("#G4-CTLCUD").val("D");

	//폼객체를 불러와서
	var form1 = $("#formviewG4")[0];

	//FormData parameter에 담아줌
	var formData = new FormData(form1);

	$.ajax({
		type : "POST",
		url : url_G4_DELETE,
		data : formData,
		processData: false,
		contentType: false,
		success: function(tdata){
			alog(tdata);
			data = jQuery.parseJSON(tdata);
			//alert(data);
			if(data && data.RTN_CD == "200"){
				msgNotice("정상적으로 삭제되었습니다.",1);
			}else{
				msgError("오류가 발생했습니다("+ data.ERR_CD + ")." + data.RTN_MSG,3);
			}
		},
		error: function(error){
			alog("Error:");
			alog(error);
		}
	});
}
//새로고침	
function G4_RELOAD(token){
	alog("G4_RELOAD-----------------start");
	G4_SEARCH(lastinputG4,token);
}function G4_MODIFY(){
       alog("[FromView] G4_MODIFY---------------start");
	if( $("#G4-CTLCUD").val() == "C" ){
		alert("조회 후 수정 가능합니다. 신규 모드에서는 수정할 수 없습니다.")
		return;
	}
	if( $("#G4-CTLCUD").val() == "D" ){
		alert("조회 후 수정 가능합니다. 삭제 모드에서는 수정할 수 없습니다.")
		return;
	}

	$("#G4-CTLCUD").val("U");
       alog("[FromView] G4_MODIFY---------------end");
}
//디테일 검색	
function G4_SEARCH(tinput,token){
       alog("(FORMVIEW) G4_SEARCH---------------start");

	//post 만들기
	sendFormData = new FormData($("#condition")[0]);
	if(typeof tinput != "undefined"){
		var tKeys = tinput.keys();
		for(i=0;i<tKeys.length;i++) {
			sendFormData.append(tKeys[i],tinput.get(tKeys[i]));
			//console.log(tKeys[i]+ '='+ tinput.get(tKeys[i])); 
		}
	}

    $.ajax({
        type : "POST",
        url : url_G4_SEARCH+"&TOKEN=" + token + "&G4_CRUD_MODE=SEARCH" ,
        data : sendFormData,
		processData: false,
		contentType: false,
        dataType: "json",
        success: function(data){
            alog(data);

			if(data && data.RTN_CD == "200"){
				if(data.RTN_DATA){
					msgNotice("정상적으로 조회되었습니다.",1);
				}else{
					msgNotice("정상적으로 조회되었으나 데이터가 없습니다.",2);
					return;
				}
			}else{
				msgError("오류가 발생했습니다("+ data.ERR_CD + ")." + data.RTN_MSG,3);
				return;
			}

            //모드 변경하기
            $("#G4-CTLCUD").val("R");
			//SETVAL  가져와서 세팅
            var tmpResVal =  data.RTN_DATA.MYCHECK;
            var tmpResArray = tmpResVal.split(",");
			$("input:checkbox[name='G4-MYCHECK']").prop("checked",false);//전체 언체크
            for(i=0;i<tmpResArray.length;i++){
                $("input:checkbox[name='G4-MYCHECK'][value='" + tmpResArray[i] + "']").prop("checked",true);
            }
			$("#G4-ADD_DT").val(data.RTN_DATA.ADD_DT);//ADD 변수세팅
			$('input:radio[name="G4-MYRADIO"][value=' + data.RTN_DATA.MYRADIO + ']').click();
		var tArr = data.RTN_DATA.HIDDENLINK.split("^");
		if(tArr){
			if(tArr.length == 2){
				if(tArr[1] != ""){
					$("#DIV_G4-HIDDENLINK").css("display", ""); //영역보이게
					$("#G4-HIDDENLINK-LINK").attr("href",tArr[0]);//히든링크 변수세팅
					$("#G4-HIDDENLINK-NM").text(tArr[1]);//히든링크 변수세팅
				}else{
					$("#DIV_G4-HIDDENLINK").css("display", "none"); //영역숨기기
				}
			}else{
				alog("HIDDENLINK의 멀티값(" + tArr.length + ")이 잘못되었습니다.");
			}
		}else{
			alert("HIDDENLINK 컬럼이 없습니다.");
		}
			$("#G4-PCD").val(data.RTN_DATA.PCD);//PCD 변수세팅
			//IMAGE VIEWER ( format : thumb_url:real_url,thumb_url:real_url )
			$("#G4-IMG-HOLDER").html(""); //기존값 비우기
			if(data.RTN_DATA.IMG){
				var tArray1 = data.RTN_DATA.IMG.split(",");
				if(data.RTN_DATA.IMG && tArray1.length > 0){
					for(var t=0;t<tArray1.length;t++){
						var tArray2 = tArray1[t].split("^");//0 thumb, 1 real
						$("#G4-IMG-HOLDER").append("<span><a href='" + tArray2[0] + "' target='_blank'><img class='FORMVIEW_IMGVIEWER_IMG' src='" + tArray2[1] + "' height='50px'></a></span>"); 						
					}
				}
			}
		if(data.RTN_DATA.TFILE){
			var tarr = data.RTN_DATA.TFILE.split("^");//CD^NM
			if(tarr.length == 2){
				var fileNm = tarr[1] ;
				if(fileNm != ""){
					$("#G4-TFILE-LINK").attr("href",tarr[0]);//파일 링크세팅
					$("#G4-TFILE-NM").text(fileNm);//파일 파일이름세팅
					$("#DIV-G4-TFILE").css("display", ""); //영역보이기
				}else{
					alog("TFILE 파일 파일 이름이 없습니다.");
				}
			}else{
				alert("G4-TFILE 값이 멀티값이 아닙니다.");
			}
		}else{
			$("#G4-TFILE").val("");//값 비우기
			$("#G4-TFILE-LINK").attr("href","");//파일 링크세팅
			$("#G4-TFILE-NM").text("");//파일 파일이름세팅

			$("#DIV-G4-TFILE").css("display", "none"); //영역숨기기
			alog("G4-TFILE 값이 없습니다..");
		}
        },
        error: function(error){
            alog("Error:");
            alog(error);
        }
    });
    alog("(FORMVIEW) G4_SEARCH---------------end");

}
