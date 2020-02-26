//글로벌 변수 선언
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_SEARCHALL = "monologController?CTLGRP=G1&CTLFNC=SEARCHALL";
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_RESET = "monologController?CTLGRP=G1&CTLFNC=RESET";
// 변수 선언	
var obj_G1_ADDDT; // ADDDT 변수선언
var obj_G1_LISTNM; // LIST 변수선언
var obj_G1_LOGLEVEL; // LEVEL 변수선언
var obj_G1_LOGMSG; // MSG 변수선언
var obj_G1_CHANNEL; // PGMID 변수선언
//그리드 변수 초기화	
//컨트롤러 경로
var url_G2_SEARCH = "monologController?CTLGRP=G2&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G2_EXCEL = "monologController?CTLGRP=G2&CTLFNC=EXCEL";
//그리드 객체
var mygridG2,isToggleHiddenColG2,lastinputG2,lastinputG2json,lastrowidG2;
var lastselectG2json;//디테일 변수 초기화	

//폼뷰 컨트롤러 경로
var url_G3_SAVE = "monologController?CTLGRP=G3&CTLFNC=SAVE";
//폼뷰 컨트롤러 경로
var url_G3_NEW = "monologController?CTLGRP=G3&CTLFNC=NEW";
//폼뷰 컨트롤러 경로
var url_G3_SEARCH = "monologController?CTLGRP=G3&CTLFNC=SEARCH";
//폼뷰 컨트롤러 경로
var url_G3_RELOAD = "monologController?CTLGRP=G3&CTLFNC=RELOAD";
var obj_G3_LOGSEQ;   // SEQ 글로벌 변수 선언
var obj_G3_LOGMSG;   // MSG 글로벌 변수 선언
var obj_G3_LOGWE;   // LOGWE 글로벌 변수 선언
	var codeMirrorFontSizeG3Logmsg = 11; // MSG

//MSG
function changeCodemirrorFontSizeG3Logmsg(sizeCmd){
	alog("changeCodemirrorFontSizeG3Logmsg..........start " + sizeCmd);

	if(sizeCmd == "+"){
		codeMirrorFontSizeG3Logmsg  = codeMirrorFontSizeG3Logmsg  + 2;
	}else{
		codeMirrorFontSizeG3Logmsg  = codeMirrorFontSizeG3Logmsg  - 2;
	}

	$(".CodeMirror").css('font-size',codeMirrorFontSizeG3Logmsg  + "px");

	obj_G3_LOGMSG .refresh();
	alog("changeCodemirrorFontSizeG3Logmsg..........end");   
}
//{G.GRPID-LOGWE initval
//화면 초기화	
function initBody(){
     alog("initBody()-----------------------start");
	
   //dhtmlx 메시지 박스 초기화
   dhtmlx.message.position="bottom";
	G1_INIT();	
		G2_INIT();	
		G3_INIT();	
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
$("#G1-ADDDT").val(moment().format("YYYYMMDD"));




	//각 폼 오브젝트들 초기화
	//달력 ADDDT, ADDDT
	$( "#G1-ADDDT" ).datepicker(dateFormatJson);
	//LISTNM, LIST 초기화	
	//LOGLEVEL, LEVEL 초기화	
	//LOGMSG, MSG 초기화	
	//CHANNEL, PGMID 초기화	
  alog("G1_INIT()-------------------------end");
}

	//로그 그리드 초기화
function G2_INIT(){
  alog("G2_INIT()-------------------------start");

        //그리드 초기화
        mygridG2 = new dhtmlXGridObject('gridG2');
        mygridG2.setDateFormat("%Y%m%d");
        mygridG2.setImagePath(CFG_URL_LIBS_ROOT + "lib/dhtmlxSuite/codebase/imgs/"); //DHTMLX IMG
		mygridG2.setUserData("","gridTitle","G2 : 로그"); //글로별 변수에 그리드 타이블 넣기
		//헤더초기화
        mygridG2.setHeader("SEQ,URL,SESSION,REQTOKEN,RESTOKEN,ID,USERSEQ,LIST,LEVEL,DT,MSG,PGMID,ADDDT");
		mygridG2.setColumnIds("LOGSEQ,URL,SESSIONID,REQTOKEN,RESTOKEN,USERID,USERSEQ,LISTNM,LOGLEVEL,LOGDT,LOGMSG,CHANNEL,ADDDT");
		mygridG2.setInitWidths("70,60,50,50,50,50,50,50,40,120,150,120,100");
		mygridG2.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,txttxt,ro,ro");
	//가로 정렬	
		mygridG2.setColAlign("left,left,left,left,left,left,left,left,left,left,left,left,left");
		mygridG2.setColSorting("int,str,str,str,str,str,int,str,str,str,str,str,str");		//렌더링	
		mygridG2.enableSmartRendering(false);
		mygridG2.enableMultiselect(true);
		//mygridG2.setColValidators("G2_LOGSEQ,G2_URL,G2_SESSIONID,G2_REQTOKEN,G2_RESTOKEN,G2_USERID,G2_USERSEQ,G2_LISTNM,G2_LOGLEVEL,G2_LOGDT,G2_LOGMSG,G2_CHANNEL,G2_ADDDT");
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
		 // IO : SEQ초기화	
		 // IO : URL초기화	
		 // IO : SESSION초기화	
		 // IO : REQTOKEN초기화	
		 // IO : RESTOKEN초기화	
		 // IO : ID초기화	
		 // IO : USERSEQ초기화	
		 // IO : LIST초기화	
		 // IO : LEVEL초기화	
		 // IO : DT초기화	
		 // IO : MSG초기화	
		 // IO : PGMID초기화	
		 // IO : ADDDT초기화	
	//onCheck
		mygridG2.attachEvent("onCheck",function(rowId, cellInd, state){
			//onCheck is void return event
			alog(rowId + " is onCheck.");
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
		//A124
			lastinputG3json = jQuery.parseJSON('{ "__NAME":"lastinputG3json"' +
				', "G2-LOGSEQ" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("LOGSEQ")).getValue()) + '"' +
			'}');
		lastinputG3 = new HashMap(); // 상세
		lastinputG3.set("G2-LOGSEQ", mygridG2.cells(rowID,mygridG2.getColIndexById("LOGSEQ")).getValue().replace(/&amp;/g, "&")); // 
			G3_SEARCH(lastinputG3,uuidv4()); //자식그룹 호출 : 상세
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
		//1
		mygridG2.attachEvent("onRowSelect",function(rowID,celInd){
			alog("mygridG2. - onRowSelect ----------start");
			alog("   rowID = " + rowID);
			alog("   celInd = " + celInd);

2

			alog("mygridG2. - onRowSelect ----------end");
		});
        alog("G2_INIT()-------------------------end");
     }
//디테일 초기화	
//상세 폼뷰 초기화
function G3_INIT(){
  alog("G3_INIT()-------------------------start");



	//컬럼 초기화
	//LOGSEQ, SEQ 초기화			//코드 미러 초기화
        obj_G3_LOGMSG = CodeMirror.fromTextArea(document.getElementById('codeMirror_G3-LOGMSG'), {
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
			hintOptions: {tables: {
			  users: {name: null, score: null, birthDate: null},
			  countries: {name: null, population: null, size: null}
			}}
        });
		obj_G3_LOGMSG .setSize("400px","px");
    $('#G3-LOGWE').summernote({
        placeholder: 'Input LOGWE',
        tabsize: 2,
		width: 400,
        height: 200,
		dialogsInBody: true,
        callbacks: {
          onImageUpload: function(files, editor, welEditable) {
            for (var i = files.length - 1; i >= 0; i--) {
              sendFileSummernote(files[i], this);
            }
          }
        }
      });
  alog("G3_INIT()-------------------------end");
}
//D146 그룹별 기능 함수 출력		
//검색조건 초기화
function G1_RESET(){
	alog("G1_RESET--------------------------start");
	$('#condition')[0].reset();
}
// CONDITIONSearch	
function G1_SEARCHALL(token){
	alog("G1_SEARCHALL--------------------------start");
	//입력값검증
	//폼의 모든값 구하기
	var ConAllData = $( "#condition" ).serialize();
	alog("ConAllData:" + ConAllData);
	//json : G1
			lastinputG2 = new HashMap(); //로그
		//  호출
	G2_SEARCH(lastinputG2,token);
	alog("G1_SEARCHALL--------------------------end");
}








    //그리드 조회(로그)	
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
					msgNotice("[로그] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[로그] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[로그] Ajax http 500 error ( " + error + " )",3);
                alog("[로그] Ajax http 500 error ( " + data.RTN_MSG + " )");
            }
        });
        alog("G2_SEARCH()------------end");
    }

//엑셀다운		
function G2_EXCEL(){	
	alog("G2_EXCEL-----------------start");
	var myForm = document.excelDownForm;
	var url = "/common/cg_phpexcel.php";
	window.open("" ,"popForm",
		  "toolbar=no, width=540, height=467, directories=no, status=no,    scrollorbars=no, resizable=no");
	myForm.action =url;
	myForm.method="post";
	myForm.target="popForm";

	mygridG2.setSerializationLevel(true,false,false,false,false,true);
	var myXmlString = mygridG2.serialize();        //컨디션 데이터 모두 말기
	$("#DATA_HEADERS").val("LOGSEQ,URL,SESSIONID,REQTOKEN,RESTOKEN,USERID,USERSEQ,LISTNM,LOGLEVEL,LOGDT,LOGMSG,CHANNEL,ADDDT");
	$("#DATA_WIDTHS").val("70,60,50,50,50,50,50,50,40,120,150,120,100");
	$("#DATA_ROWS").val(myXmlString);
	myForm.submit();
}
//G3_SAVE
//IO_FILE_YN = N	
	//IO_FILE_YN = N	
function G3_SAVE(token){	
	alog("G3_SAVE---------------start");

	if( !( $("#G3-CTLCUD").val() == "C" || $("#G3-CTLCUD").val() == "U") ){
		alert("신규 또는 수정 모드 진입 후 저장할 수 있습니다.")
		return;
	}

	//전송용 데이터 생성하기
	var sendFormData = new FormData($("#formviewG3")[0]);

	sendFormData.append("G3-LOGMSG",obj_G3_LOGMSG.getValue()); //MSG
	sendFormData.append("G3-LOGWE",$('#G3-LOGWE').summernote('code')); //LOGWE	//컨디션 데이터 추가하기
	conditionData = new FormData($("#condition")[0]);
    var es, e, pair;
    for (es = conditionData.entries(); !(e = es.next()).done && (pair = e.value);) {
		sendFormData.append(pair[0],pair[1]);
    }

	$.ajax({
		type : "POST",
		url : url_G3_SAVE + "&TOKEN=" + token,
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
}//새로고침	
function G3_RELOAD(token){
	alog("G3_RELOAD-----------------start");
	G3_SEARCH(lastinputG3,token);
}//디테일 검색	
function G3_SEARCH(tinput,token){
       alog("(FORMVIEW) G3_SEARCH---------------start");

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
        url : url_G3_SEARCH+"&TOKEN=" + token + "&G3_CRUD_MODE=SEARCH" ,
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
            $("#G3-CTLCUD").val("R");
			//SETVAL  가져와서 세팅
			$("#G3-LOGSEQ").text(data.RTN_DATA.LOGSEQ);//SEQ 변수세팅
		obj_G3_LOGMSG.setValue(data.RTN_DATA.LOGMSG); //MSG 
	//$('#summernote').summernote('editor.insertText', data.RTN_DATA.LOGWE);
	$('#G3-LOGWE').summernote('reset'); //기존 데이터 지우기
	if(data.RTN_DATA.LOGWE.indexOf('</p>') < 0 ){
		 $('#G3-LOGWE').summernote('pasteHTML', "<p>" + data.RTN_DATA.LOGWE + "</p>"); //html컨텐츠 아니면 좌우로 <p></p>감싸기
	}else{
		$('#G3-LOGWE').summernote('pasteHTML', data.RTN_DATA.LOGWE); //html컨텐츠 아니면 좌우로 <p></p>감싸기
	}
        },
        error: function(error){
            alog("Error:");
            alog(error);
        }
    });
    alog("(FORMVIEW) G3_SEARCH---------------end");

}
//	
function G3_NEW(){
       alog("[FromView] G3_NEW---------------start");
	$("#G3-CTLCUD").val("C");
	//PMGIO 로직
	$("#G3-LOGSEQ").text("");//SEQ 신규초기화
	obj_G3_LOGMSG.setValue(""); // MSG값 비우기
	$('#G3-LOGWE').summernote('reset'); //기존 데이터 지우기
       alog("DETAILNew30---------------end");
}
