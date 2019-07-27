//글로벌 변수 선언	
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G2_SEARCHALL = "errmngController?CTLGRP=G2&CTLFNC=SEARCHALL";// 변수 선언	
//그리드 변수 초기화	
//컨트롤러 경로
var url_G3_USERDEF = "errmngController?CTLGRP=G3&CTLFNC=USERDEF";
//컨트롤러 경로
var url_G3_SEARCH = "errmngController?CTLGRP=G3&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G3_SAVE = "errmngController?CTLGRP=G3&CTLFNC=SAVE";
//컨트롤러 경로
var url_G3_ROWDELETE = "errmngController?CTLGRP=G3&CTLFNC=ROWDELETE";
//컨트롤러 경로
var url_G3_ROWADD = "errmngController?CTLGRP=G3&CTLFNC=ROWADD";
//컨트롤러 경로
var url_G3_RELOAD = "errmngController?CTLGRP=G3&CTLFNC=RELOAD";
//컨트롤러 경로
var url_G3_EXCEL = "errmngController?CTLGRP=G3&CTLFNC=EXCEL";
//그리드 객체
var mygridG3,isToggleHiddenColG3,lastinputG3,lastinputG3json,lastrowidG3;
var lastselectG3json;//디테일 변수 초기화	

var obj_G4_SESSIONID_valid = jQuery.parseJSON( '{ "G4_SESSIONID": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":30,  "DATATYPE":"STRING"} }' );   // SESSIONID 밸리데이션 선언
var obj_G4_ERRCD_valid = jQuery.parseJSON( '{ "G4_ERRCD": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":20,  "DATATYPE":"STRING"} }' );   // ERRCD 밸리데이션 선언
var obj_G4_ERRFILE_valid = jQuery.parseJSON( '{ "G4_ERRFILE": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":100,  "DATATYPE":"STRING"} }' );   // 에러파일 밸리데이션 선언
//폼뷰 컨트롤러 경로
var url_G4_SEARCH = "errmngController?CTLGRP=G4&CTLFNC=SEARCH";
//폼뷰 컨트롤러 경로
var url_G4_SAVE = "errmngController?CTLGRP=G4&CTLFNC=SAVE";
//폼뷰 컨트롤러 경로
var url_G4_RELOAD = "errmngController?CTLGRP=G4&CTLFNC=RELOAD";
//폼뷰 컨트롤러 경로
var url_G4_NEW = "errmngController?CTLGRP=G4&CTLFNC=NEW";
//폼뷰 컨트롤러 경로
var url_G4_DELETE = "errmngController?CTLGRP=G4&CTLFNC=DELETE";
var obj_G4_SESSIONID;   // SESSIONID 글로벌 변수 선언
var obj_G4_ERRCD;   // ERRCD 글로벌 변수 선언
var obj_G4_ERRFILE;   // 에러파일 글로벌 변수 선언
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
//버튼 초기화	
function G1_INIT(){
 //비어있음
  alog("G1_INIT()-------------------------start	");
	
}
// CONDITIONInit	//컨디션 초기화
function G2_INIT(){
  alog("G2_INIT()-------------------------start	");
	//각 폼 오브젝트들 초기화
  alog("G2_INIT()-------------------------end");
}

	//에러 그리드 초기화
function G3_INIT(){
  alog("G3_INIT()-------------------------start");

        //그리드 초기화
        mygridG3 = new dhtmlXGridObject('gridG3');
        mygridG3.setDateFormat("%Y%m%d");
        mygridG3.setImagePath("../lib/dhtmlxSuite/codebase/imgs/"); //DHTMLX IMG
		mygridG3.setUserData("","gridTitle","G3 : 에러"); //글로별 변수에 그리드 타이블 넣기
		//헤더초기화
        mygridG3.setHeader("SEQ,SESSION,REQID,NO,CD,STR,FILE,LINE,CONTEXT,ADD,MOD");
		mygridG3.setColumnIds("ERRLOGSEQ,SESSIONID,REQID,ERRNO,ERRCD,ERRSTR,ERRFILE,ERRLINE,ERRCONTEXT,ADDDT,MODDT");
		mygridG3.setInitWidths("40,60,40,30,50,100,80,40,80,60,60");
		mygridG3.setColTypes("ed,ed,ed,ed,ed,ed,ed,ed,ed,ed,ed");
	//가로 정렬	
		mygridG3.setColAlign(",,,,,,,,,,");
		mygridG3.setColSorting("int,str,str,str,str,str,str,str,str,str,str");		//렌더링	
		mygridG3.enableSmartRendering(false);
		mygridG3.enableMultiselect(true);
		//mygridG3.setColValidators("G3_ERRLOGSEQ,G3_SESSIONID,G3_REQID,G3_ERRNO,G3_ERRCD,G3_ERRSTR,G3_ERRFILE,G3_ERRLINE,G3_ERRCONTEXT,G3_ADDDT,G3_MODDT");
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
		 // IO : SEQ초기화	
		 // IO : SESSION초기화	
		 // IO : REQID초기화	
		 // IO : NO초기화	
		 // IO : CD초기화	
		 // IO : STR초기화	
		 // IO : FILE초기화	
		 // IO : LINE초기화	
		 // IO : CONTEXT초기화	
		 // IO : ADD초기화	
		 // IO : MOD초기화	
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
			//GRIDRowSelect20(rowID,celInd);
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
			//', "ERRLOGSEQ" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("ERRLOGSEQ")).getValue()) + '"' +
			//', "SESSIONID" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("SESSIONID")).getValue()) + '"' +
			//', "REQID" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("REQID")).getValue()) + '"' +
			//', "ERRNO" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("ERRNO")).getValue()) + '"' +
			//', "ERRCD" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("ERRCD")).getValue()) + '"' +
			//', "ERRSTR" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("ERRSTR")).getValue()) + '"' +
			//', "ERRFILE" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("ERRFILE")).getValue()) + '"' +
			//', "ERRLINE" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("ERRLINE")).getValue()) + '"' +
			//', "ERRCONTEXT" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("ERRCONTEXT")).getValue()) + '"' +
			//', "ADDDT" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("ADDDT")).getValue()) + '"' +
			//', "MODDT" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("MODDT")).getValue()) + '"' +
			//'}');
		//A124
			lastinputG4json = jQuery.parseJSON('{ "__NAME":"lastinputG4json"' +
				', "G3-ERRLOGSEQ" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("ERRLOGSEQ")).getValue()) + '"' +
			'}');
		lastinputG4 = new HashMap(); // 
		lastinputG4.set("G3-ERRLOGSEQ", mygridG3.cells(rowID,mygridG3.getColIndexById("ERRLOGSEQ")).getValue().replace(/&amp;/g, "&")); // 
			G4_SEARCH(lastinputG4,uuidv4()); //자식그룹 호출 : 
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
// 폼뷰 초기화
function G4_INIT(){
  alog("G4_INIT()-------------------------start");

setCodeCombo("FORMVIEW",$("#G4_ERRCD"),"PHPERRTYPE");

	//컬럼 초기화
	//SESSIONID, SESSIONID 초기화	
  alog("G4_INIT()-------------------------end");
}
//D146 그룹별 기능 함수 출력		
//조회 	
function G1_BTNCLICK(){
	   alog("G1_BTNCLICK()--------------------------start");
   SEARCHALL();
   alog("G1_BTNCLICK()--------------------------end");
}
	// CONDITIONSearch	
function G2_SEARCHALL(token){
	alog("G2_SEARCHALL--------------------------start");
	//입력값검증
	//폼의 모든값 구하기
	var ConAllData = $( "#condition" ).serialize();
	alog("ConAllData:" + ConAllData);
	//json : G2
			lastinputG3 = new HashMap(); //에러
		//  호출
	G3_SEARCH(lastinputG3,token);
	alog("G2_SEARCHALL--------------------------end");
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
	$("#DATA_HEADERS").val("ERRLOGSEQ,SESSIONID,REQID,ERRNO,ERRCD,ERRSTR,ERRFILE,ERRLINE,ERRCONTEXT,ADDDT,MODDT");
	$("#DATA_WIDTHS").val("40,60,40,30,50,100,80,40,80,60,60");
	$("#DATA_ROWS").val(myXmlString);
	myForm.submit();
}
//행추가3 (에러)	
//그리드 행추가 : 에러
	function G3_ROWADD(){
		if( !(lastinputG3)){
			msgError("조회 후에 행추가 가능합니다. 또는 상속값이 없습니다.",3);
		}else{
			var tCols = ["","","","","","","","","","",""];//초기값
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
//새로고침	
function G3_RELOAD(token){
  alog("G3_RELOAD-----------------start");
  G3_SEARCH(lastinputG3,token);
}








    //그리드 조회(에러)	
    function G3_SEARCH(tinput,token){
        alog("G3_SEARCH()------------start");

		var tGrid = mygridG3;

        //그리드 초기화
        tGrid.clearAll();        //post 만들기
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
						
					}else{
						$("#spanG3Cnt").text("-");
					}
					msgNotice("[에러] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[에러] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[에러] Ajax http 500 error ( " + error + " )",3);
                alog("[에러] Ajax http 500 error ( " + data.RTN_MSG + " )");
            }
        });
        alog("G3_SEARCH()------------end");
    }

//사용자정의함수 : 사용자정의
function G3_USERDEF(token){
	alog("G3_USERDEF-----------------start");

	alog("G3_USERDEF-----------------end");
}
    function G3_ROWDELETE(){	
        alog("G3_ROWDELETE()------------start");
        delRow(mygridG3);
        alog("G3_ROWDELETE()------------start");
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
//G4_SAVE
//IO_FILE_YN = N	
	//IO_FILE_YN = N	
function G4_SAVE(token){	
	alog("G4_SAVE---------------start");

	if( !( $("#G4-CTLCUD").val() == "C" || $("#G4-CTLCUD").val() == "U") ){
		alert("신규 또는 수정 모드 진입 후 저장할 수 있습니다.")
		return;
	}

	//전송용 데이터 생성하기
	var sendFormData = new FormData($("#formviewG4")[0]);

	//컨디션 데이터 추가하기
	conditionData = new FormData($("#condition")[0]);
    var es, e, pair;
    for (es = conditionData.entries(); !(e = es.next()).done && (pair = e.value);) {
		sendFormData.append(pair[0],pair[1]);
    }

	$.ajax({
		type : "POST",
		url : url_G4_SAVE + "&TOKEN=" + token,
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
}//	
function G4_NEW(){
       alog("[FromView] G4_NEW---------------start");
	$("#G4-CTLCUD").val("C");
	//PMGIO 로직
	$("#G4-SESSIONID").val("");//SESSIONID 신규초기화	
	$("#G4-ERRFILE").val("");//에러파일 신규초기화
       alog("DETAILNew30---------------end");
}
//새로고침	
function G4_RELOAD(token){
	alog("G4_RELOAD-----------------start");
	G4_SEARCH(lastinputG4,token);
}//디테일 검색	
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
			$("#G4-SESSIONID").val(data.RTN_DATA.SESSIONID);//SESSIONID 변수세팅
			$("#G4-ERRCD").val(data.RTN_DATA.ERRCD);//ERRCD 변수세팅
		$("#G4-ERRFILE").val(data.RTN_DATA.ERRFILE);//에러파일 오브젝트 값세팅
        },
        error: function(error){
            alog("Error:");
            alog(error);
        }
    });
    alog("(FORMVIEW) G4_SEARCH---------------end");

}
