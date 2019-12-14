//글로벌 변수 선언
//버틀 그룹쪽에서 컨틀롤러 호출
var url_C1_SEARCHALL = "validmngController?CTLGRP=C1&CTLFNC=SEARCHALL";
//버틀 그룹쪽에서 컨틀롤러 호출
var url_C1_SAVE = "validmngController?CTLGRP=C1&CTLFNC=SAVE";
//버틀 그룹쪽에서 컨틀롤러 호출
var url_C1_RESET = "validmngController?CTLGRP=C1&CTLFNC=RESET";
//조회조건 변수 선언	
var obj_C1_PJTSEQ; // PJTSEQ 변수선언
//그리드 변수 초기화	
//컨트롤러 경로
var url_G2_SEARCH = "validmngController?CTLGRP=G2&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G2_SAVE = "validmngController?CTLGRP=G2&CTLFNC=SAVE";
//컨트롤러 경로
var url_G2_ROWDELETE = "validmngController?CTLGRP=G2&CTLFNC=ROWDELETE";
//컨트롤러 경로
var url_G2_ROWADD = "validmngController?CTLGRP=G2&CTLFNC=ROWADD";
//컨트롤러 경로
var url_G2_RELOAD = "validmngController?CTLGRP=G2&CTLFNC=RELOAD";
//그리드 객체
var mygridG2,isToggleHiddenColG2,lastinputG2,lastinputG2json,lastrowidG2;
var lastselectG2json;//디테일 변수 초기화	

//폼뷰 컨트롤러 경로
var url_F3_NEW = "validmngController?CTLGRP=F3&CTLFNC=NEW";
//폼뷰 컨트롤러 경로
var url_F3_MODIFY = "validmngController?CTLGRP=F3&CTLFNC=MODIFY";
//폼뷰 컨트롤러 경로
var url_F3_DELETE = "validmngController?CTLGRP=F3&CTLFNC=DELETE";
//폼뷰 컨트롤러 경로
var url_F3_SEARCH = "validmngController?CTLGRP=F3&CTLFNC=SEARCH";
//폼뷰 컨트롤러 경로
var url_F3_SAVE = "validmngController?CTLGRP=F3&CTLFNC=SAVE";
//폼뷰 컨트롤러 경로
var url_F3_RELOAD = "validmngController?CTLGRP=F3&CTLFNC=RELOAD";
//화면 초기화	
function initBody(){
     alog("initBody()-----------------------start");
	
   //dhtmlx 메시지 박스 초기화
   dhtmlx.message.position="bottom";
	C1_INIT();	
		G2_INIT();	
		F3_INIT();	
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
function C1_INIT(){
  alog("C1_INIT()-------------------------start	");

	//각 폼 오브젝트들 초기화
	//PJTSEQ, PJTSEQ 초기화	
  alog("C1_INIT()-------------------------end");
}

	//목록 그리드 초기화
function G2_INIT(){
  alog("G2_INIT()-------------------------start");

        //그리드 초기화
        mygridG2 = new dhtmlXGridObject('gridG2');
        mygridG2.setDateFormat("%Y%m%d");
        mygridG2.setImagePath("lib/dhtmlxSuite/codebase/imgs/"); //DHTMLX IMG
		mygridG2.setUserData("","gridTitle","G2 : 목록"); //글로별 변수에 그리드 타이블 넣기
		//헤더초기화
        mygridG2.setHeader("#master_checkbox,VALIDSEQ,PJTSEQ,데이터타입,VALIDID,VALIDNM,VALIDORD,VALIDTYPE,INVALIDMSG,MATSTR,ADDDT,수정일");
		mygridG2.setColumnIds("ROWCHK,VALIDSEQ,PJTSEQ,DATATYPE,VALIDID,VALIDNM,VALIDORD,VALIDTYPE,INVALIDMSG,MATSTR,ADDDT,MODDT");
		mygridG2.setInitWidths("40,60,60,60,60,60,60,60,80,120,60,60");
		mygridG2.setColTypes("ch,ro,ed,co,ed,ed,ed,coro,ed,ed,ed,ed");
	//가로 정렬	
		mygridG2.setColAlign("center,left,left,left,left,left,left,left,left,left,left,left");
		mygridG2.setColSorting("int,int,int,str,str,str,str,str,str,str,str,str");		//렌더링	
		mygridG2.enableSmartRendering(false);
		mygridG2.enableMultiselect(true);
		//mygridG2.setColValidators("G2_ROWCHK,G2_VALIDSEQ,G2_PJTSEQ,G2_DATATYPE,G2_VALIDID,G2_VALIDNM,G2_VALIDORD,G2_VALIDTYPE,G2_INVALIDMSG,G2_MATSTR,G2_ADDDT,G2_MODDT");
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
		 // IO : ROWCHK초기화	
		 // IO : VALIDSEQ초기화	
		 // IO : PJTSEQ초기화	
		setCodeCombo("GRID",mygridG2.getCombo(mygridG2.getColIndexById("DATATYPE")),"DATATYPE"); // IO : 데이터타입초기화	
		 // IO : VALIDID초기화	
		 // IO : VALIDNM초기화	
		 // IO : VALIDORD초기화	
		setCodeCombo("GRID",mygridG2.getCombo(mygridG2.getColIndexById("VALIDTYPE")),"VALIDTYPE"); // IO : VALIDTYPE초기화	
		 // IO : INVALIDMSG초기화	
		 // IO : MATSTR초기화	
		 // IO : ADDDT초기화	
		 // IO : 수정일초기화	
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
			//', "ROWCHK" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("ROWCHK")).getValue()) + '"' +
			//', "VALIDSEQ" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("VALIDSEQ")).getValue()) + '"' +
			//', "PJTSEQ" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("PJTSEQ")).getValue()) + '"' +
			//', "DATATYPE" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("DATATYPE")).getValue()) + '"' +
			//', "VALIDID" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("VALIDID")).getValue()) + '"' +
			//', "VALIDNM" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("VALIDNM")).getValue()) + '"' +
			//', "VALIDORD" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("VALIDORD")).getValue()) + '"' +
			//', "VALIDTYPE" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("VALIDTYPE")).getValue()) + '"' +
			//', "INVALIDMSG" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("INVALIDMSG")).getValue()) + '"' +
			//', "MATSTR" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("MATSTR")).getValue()) + '"' +
			//', "ADDDT" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("ADDDT")).getValue()) + '"' +
			//', "MODDT" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("MODDT")).getValue()) + '"' +
			//'}');
		//A124
			lastinputF3json = jQuery.parseJSON('{ "__NAME":"lastinputF3json"' +
				', "G2-VALIDSEQ" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("VALIDSEQ")).getValue()) + '"' +
			'}');
		lastinputF3 = new HashMap(); // 상세
		lastinputF3.set("G2-VALIDSEQ", mygridG2.cells(rowID,mygridG2.getColIndexById("VALIDSEQ")).getValue().replace(/&amp;/g, "&")); // 
			F3_SEARCH(lastinputF3,uuidv4()); //자식그룹 호출 : 상세
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
		mygridG2.setColumnHidden(mygridG2.getColIndexById("VALIDSEQ"),true); //VALIDSEQ
        alog("G2_INIT()-------------------------end");
     }
//디테일 초기화	
//상세 폼뷰 초기화
function F3_INIT(){
  alog("F3_INIT()-------------------------start");
	//컬럼 초기화
  alog("F3_INIT()-------------------------end");
}
//D146 그룹별 기능 함수 출력		
//조회조건, 저장	
function C1_SAVE(){
 alog("C1_SAVE-------------------start");
	//FormData parameter에 담아줌	
	var formData = new FormData();	//C1 getparams	
	//그리드G2 가져오기	
    mygridG2.setSerializationLevel(true,false,false,false,true,false);
    var paramsG2 = mygridG2.serialize();
	formData.append("G2-XML",paramsG2);
//var params = { CTL : "C1_SAVE", G2_XML : paramsG2	};
	$.ajax({	
		type : "POST",
		url : url_C1_SAVE  ,
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
			msgError("[C1] Ajax http 500 error ( " + error + " )");
			alog("[C1] Ajax http 500 error ( " + error + " )");
		}
	});
	alog("C1_SAVE-------------------end");	
}
// CONDITIONSearch	
function C1_SEARCHALL(token){
	alog("C1_SEARCHALL--------------------------start");
	//입력값검증
	//폼의 모든값 구하기
	var ConAllData = $( "#condition" ).serialize();
	alog("ConAllData:" + ConAllData);
	//json : C1
			lastinputG2 = new HashMap(); //목록
		//  호출
	G2_SEARCH(lastinputG2,token);
	alog("C1_SEARCHALL--------------------------end");
}
//검색조건 초기화
function C1_RESET(){
	alog("C1_RESET--------------------------start");
	$('#condition')[0].reset();
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








    //그리드 조회(목록)	
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
					msgNotice("[목록] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[목록] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[목록] Ajax http 500 error ( " + error + " )",3);
                alog("[목록] Ajax http 500 error ( " + data.RTN_MSG + " )");
            }
        });
        alog("G2_SEARCH()------------end");
    }

//행추가3 (목록)	
//그리드 행추가 : 목록
	function G2_ROWADD(){
		if( !(lastinputG2)){
			msgError("조회 후에 행추가 가능합니다. 또는 상속값이 없습니다.",3);
		}else{
			var tCols = ["","","","","","","","","","","",""];//초기값
			addRow(mygridG2,tCols);
		}
	}    function G2_ROWDELETE(){	
        alog("G2_ROWDELETE()------------start");
        delRow(mygridG2);
        alog("G2_ROWDELETE()------------start");
    }
//FORMVIEW DELETE
function F3_DELETE(){	
	alog("F3_DELETE---------------start");

	//조회했는지 확인하기
	if( $("#F3-CTLCUD").val() != "R" ){
		alert("조회된 것만 삭제 가능합니다.");
		return;
	}
	//확인
	if(!confirm("정말로 삭제하시겠습니까?")){
		return;
	}
	
	//삭제처리 명령어
	$("#F3-CTLCUD").val("D");

	//폼객체를 불러와서
	var form1 = $("#formviewF3")[0];

	//FormData parameter에 담아줌
	var formData = new FormData(form1);

	$.ajax({
		type : "POST",
		url : url_F3_DELETE,
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
function F3_RELOAD(token){
	alog("F3_RELOAD-----------------start");
	F3_SEARCH(lastinputF3,token);
}//F3_SAVE
//IO_FILE_YN = N	
	//IO_FILE_YN = N	
function F3_SAVE(token){	
	alog("F3_SAVE---------------start");

	if( !( $("#F3-CTLCUD").val() == "C" || $("#F3-CTLCUD").val() == "U") ){
		alert("신규 또는 수정 모드 진입 후 저장할 수 있습니다.")
		return;
	}

	//전송용 데이터 생성하기
	var sendFormData = new FormData($("#formviewF3")[0]);

	//컨디션 데이터 추가하기
	conditionData = new FormData($("#condition")[0]);
    var es, e, pair;
    for (es = conditionData.entries(); !(e = es.next()).done && (pair = e.value);) {
		sendFormData.append(pair[0],pair[1]);
    }

	$.ajax({
		type : "POST",
		url : url_F3_SAVE + "&TOKEN=" + token,
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
}function F3_MODIFY(){
       alog("[FromView] F3_MODIFY---------------start");
	if( $("#F3-CTLCUD").val() == "C" ){
		alert("조회 후 수정 가능합니다. 신규 모드에서는 수정할 수 없습니다.")
		return;
	}
	if( $("#F3-CTLCUD").val() == "D" ){
		alert("조회 후 수정 가능합니다. 삭제 모드에서는 수정할 수 없습니다.")
		return;
	}

	$("#F3-CTLCUD").val("U");
       alog("[FromView] F3_MODIFY---------------end");
}
//디테일 검색	
function F3_SEARCH(tinput,token){
       alog("(FORMVIEW) F3_SEARCH---------------start");

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
        url : url_F3_SEARCH+"&TOKEN=" + token + "&F3_CRUD_MODE=SEARCH" ,
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
            $("#F3-CTLCUD").val("R");
			//SETVAL  가져와서 세팅
        },
        error: function(error){
            alog("Error:");
            alog(error);
        }
    });
    alog("(FORMVIEW) F3_SEARCH---------------end");

}
//	
function F3_NEW(){
       alog("[FromView] F3_NEW---------------start");
	$("#F3-CTLCUD").val("C");
	//PMGIO 로직
       alog("DETAILNew30---------------end");
}
