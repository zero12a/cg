//글로벌 변수 선언
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_SEARCHALL = "dbdeployController?CTLGRP=G1&CTLFNC=SEARCHALL";
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_RESET = "dbdeployController?CTLGRP=G1&CTLFNC=RESET";
// 변수 선언	
var obj_G1_DB; // DB 변수선언
//그리드 변수 초기화	
//컨트롤러 경로
var url_G2_SQLCREATE = "dbdeployController?CTLGRP=G2&CTLFNC=SQLCREATE";
//컨트롤러 경로
var url_G2_SEARCH = "dbdeployController?CTLGRP=G2&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G2_RELOAD = "dbdeployController?CTLGRP=G2&CTLFNC=RELOAD";
//컨트롤러 경로
var url_G2_EXCEL = "dbdeployController?CTLGRP=G2&CTLFNC=EXCEL";
//그리드 객체
var mygridG2,isToggleHiddenColG2,lastinputG2,lastinputG2json,lastrowidG2;
var lastselectG2json;//디테일 변수 초기화	

//폼뷰 컨트롤러 경로
var url_G3_SEARCH = "dbdeployController?CTLGRP=G3&CTLFNC=SEARCH";
//폼뷰 컨트롤러 경로
var url_G3_RELOAD = "dbdeployController?CTLGRP=G3&CTLFNC=RELOAD";
var obj_G3_TABLE_SCHEMA;   // DB 글로벌 변수 선언
var obj_G3_TABLE_NAME;   // TABLE 글로벌 변수 선언
var obj_G3_ENGINE;   // ENGINE 글로벌 변수 선언
var obj_G3_TABLE_ROWS;   // ROWS 글로벌 변수 선언
var obj_G3_AUTO_INCREMENT;   // AI 글로벌 변수 선언
var obj_G3_CREATE_TIME;   // CREATE 글로벌 변수 선언
var obj_G3_UPDATE_TIME;   // UPDATE 글로벌 변수 선언
var obj_G3_TABLE_COLLATION;   // COLLATION 글로벌 변수 선언
var obj_G3_TABLE_COMMENT;   // COMMENT 글로벌 변수 선언
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

	//각 폼 오브젝트들 초기화
	//DB, DB 초기화	
  alog("G1_INIT()-------------------------end");
}

	//테이블목록 그리드 초기화
function G2_INIT(){
  alog("G2_INIT()-------------------------start");

        //그리드 초기화
        mygridG2 = new dhtmlXGridObject('gridG2');
        mygridG2.setDateFormat("%Y%m%d");
        mygridG2.setImagePath(CFG_URL_LIBS_ROOT + "lib/dhtmlxSuite/codebase/imgs/"); //DHTMLX IMG
		mygridG2.setUserData("","gridTitle","G2 : 테이블목록"); //글로별 변수에 그리드 타이블 넣기
		//헤더초기화
        mygridG2.setHeader("#master_checkbox,DB,TABLE,SQLCREATE,RESULT,ENGINE,ROWS,AI,CREATE,UPDATE,COLLATION,COMMENT");
		mygridG2.setColumnIds("CHK,TABLE_SCHEMA,TABLE_NAME,SQLCREATE,RESULT,ENGINE,TABLE_ROWS,AUTO_INCREMENT,CREATE_TIME,UPDATE_TIME,TABLE_COLLATION,TABLE_COMMENT");
		mygridG2.setInitWidths("30,60,100,100,50,60,60,60,60,60,60,60");
		mygridG2.setColTypes("ch,ro,ro,link,ed,ro,ro,ro,ro,ro,ro,ro");
	//가로 정렬	
		mygridG2.setColAlign("left,left,left,left,left,left,right,right,left,left,left,left");
		mygridG2.setColSorting("int,str,str,str,str,str,str,str,int,str,str,str");		//렌더링	
		mygridG2.enableSmartRendering(false);
		mygridG2.enableMultiselect(true);
		//mygridG2.setColValidators("G2_CHK,G2_TABLE_SCHEMA,G2_TABLE_NAME,G2_SQLCREATE,G2_RESULT,G2_ENGINE,G2_TABLE_ROWS,G2_AUTO_INCREMENT,G2_CREATE_TIME,G2_UPDATE_TIME,G2_TABLE_COLLATION,G2_TABLE_COMMENT");
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
		 // IO : DB초기화	
		 // IO : TABLE초기화	
		 // IO : SQLCREATE초기화	
		 // IO : RESULT초기화	
		 // IO : ENGINE초기화	
		 // IO : ROWS초기화	
		 // IO : AI초기화	
		 // IO : CREATE초기화	
		 // IO : UPDATE초기화	
		 // IO : COLLATION초기화	
		 // IO : COMMENT초기화	
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
		//A124
			lastinputG3json = jQuery.parseJSON('{ "__NAME":"lastinputG3json"' +
				', "G2-TABLE_SCHEMA" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("TABLE_SCHEMA")).getValue()) + '"' +
			', "G2-TABLE_NAME" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("TABLE_NAME")).getValue()) + '"' +
			'}');
		lastinputG3 = new HashMap(); // 테이블상세
		lastinputG3.set("G2-TABLE_SCHEMA", mygridG2.cells(rowID,mygridG2.getColIndexById("TABLE_SCHEMA")).getValue().replace(/&amp;/g, "&")); // 
		lastinputG3.set("G2-TABLE_NAME", mygridG2.cells(rowID,mygridG2.getColIndexById("TABLE_NAME")).getValue().replace(/&amp;/g, "&")); // 
			G3_SEARCH(lastinputG3,uuidv4()); //자식그룹 호출 : 테이블상세
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
//디테일 초기화	
//테이블상세 폼뷰 초기화
function G3_INIT(){
  alog("G3_INIT()-------------------------start");









	//컬럼 초기화
	//TABLE_SCHEMA, DB 초기화		//TABLE_NAME, TABLE 초기화		//ENGINE, ENGINE 초기화		//TABLE_ROWS, ROWS 초기화		//AUTO_INCREMENT, AI 초기화		//CREATE_TIME, CREATE 초기화		//UPDATE_TIME, UPDATE 초기화		//TABLE_COLLATION, COLLATION 초기화		//TABLE_COMMENT, COMMENT 초기화	  alog("G3_INIT()-------------------------end");
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
			lastinputG2 = new HashMap(); //테이블목록
		//  호출
	G2_SEARCH(lastinputG2,token);
	alog("G1_SEARCHALL--------------------------end");
}
//엑셀다운		
function G2_EXCEL(){	
	alog("G2_EXCEL-----------------start");
	var myForm = document.excelDownForm;
	var url = "/c.g/cg_phpexcel.php";
	window.open("" ,"popForm",
		  "toolbar=no, width=540, height=467, directories=no, status=no,    scrollorbars=no, resizable=no");
	myForm.action =url;
	myForm.method="post";
	myForm.target="popForm";

	mygridG2.setSerializationLevel(true,false,false,false,false,false);
	var myXmlString = mygridG2.serialize();        //컨디션 데이터 모두 말기
	$("#DATA_HEADERS").val("CHK,TABLE_SCHEMA,TABLE_NAME,SQLCREATE,RESULT,ENGINE,TABLE_ROWS,AUTO_INCREMENT,CREATE_TIME,UPDATE_TIME,TABLE_COLLATION,TABLE_COMMENT");
	$("#DATA_WIDTHS").val("30,60,100,100,50,60,60,60,60,60,60,60");
	$("#DATA_ROWS").val(myXmlString);
	myForm.submit();
}
//새로고침	
function G2_RELOAD(token){
  alog("G2_RELOAD-----------------start");
  G2_SEARCH(lastinputG2,token);
}
//사용자정의함수 : SQL생성
function G2_SQLCREATE(token){
	alog("G2_SQLCREATE-----------------start");
	var checked=mygridG2.getCheckedRows(0);//table 목록
	if(checked ==""){
		return;
	}else{
		//alert(checked);
		var arrTables = checked.split(",");

		var colIndex = mygridG2.getColIndexById("RESULT");

		for(t=0;t<arrTables.length;t++){
			var tableNm = arrTables[t];

			//alert(tableNm);
			//alert("rowid, 컬럼순번:" + tableNm + ", " + colIndex);
			//불러오기
			$.ajax({
				type : "GET",
				url : CFG_CGWEB_URL + "/c.g/cg_cdeploy_db.php?TOKEN=" + token + "&DB=" + $("#G1-DB").val() + "&TABLE=" + tableNm ,
				dataType: "jsonp",
				async: false,
				success: function(data){
					alog("   gridG2 json return----------------------");

					//alog("   json RTN_MSG length : " + data.RTN_MSG.length);

					mygridG2.cells(data.ERR_CD,colIndex).setValue("O");
					//alert("응답오케이:" + tableNm + ", " + colIndex);

				},
				error: function(error){
					msgError("[테이블목록] Ajax http 500 error ( " + error + " )",3);
					//alog("[테이블목록] Ajax http 500 error ( " + data.RTN_MSG + " )");
				}
			});
		}
	}
	alog("G2_SQLCREATE-----------------end");
}








    //그리드 조회(테이블목록)	
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
					msgNotice("[테이블목록] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[테이블목록] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[테이블목록] Ajax http 500 error ( " + error + " )",3);
                alog("[테이블목록] Ajax http 500 error ( " + data.RTN_MSG + " )");
            }
        });
        alog("G2_SEARCH()------------end");
    }

//디테일 검색	
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
			$("#G3-TABLE_SCHEMA").text(data.RTN_DATA.TABLE_SCHEMA);//DB 변수세팅
			$("#G3-TABLE_NAME").text(data.RTN_DATA.TABLE_NAME);//TABLE 변수세팅
			$("#G3-ENGINE").text(data.RTN_DATA.ENGINE);//ENGINE 변수세팅
			$("#G3-TABLE_ROWS").text(data.RTN_DATA.TABLE_ROWS);//ROWS 변수세팅
			$("#G3-AUTO_INCREMENT").text(data.RTN_DATA.AUTO_INCREMENT);//AI 변수세팅
			$("#G3-CREATE_TIME").text(data.RTN_DATA.CREATE_TIME);//CREATE 변수세팅
			$("#G3-UPDATE_TIME").text(data.RTN_DATA.UPDATE_TIME);//UPDATE 변수세팅
			$("#G3-TABLE_COLLATION").text(data.RTN_DATA.TABLE_COLLATION);//COLLATION 변수세팅
			$("#G3-TABLE_COMMENT").text(data.RTN_DATA.TABLE_COMMENT);//COMMENT 변수세팅
        },
        error: function(error){
            alog("Error:");
            alog(error);
        }
    });
    alog("(FORMVIEW) G3_SEARCH---------------end");

}
//새로고침	
function G3_RELOAD(token){
	alog("G3_RELOAD-----------------start");
	G3_SEARCH(lastinputG3,token);
}