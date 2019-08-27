//글로벌 변수 선언	
//버틀 그룹쪽에서 컨틀롤러 호출
var url_C2_sss = "appapiController?CTLGRP=C2&CTLFNC=sss";
//버틀 그룹쪽에서 컨틀롤러 호출
var url_C2_SEARCHALL = "appapiController?CTLGRP=C2&CTLFNC=SEARCHALL";
//버틀 그룹쪽에서 컨틀롤러 호출
var url_C2_SAVE = "appapiController?CTLGRP=C2&CTLFNC=SAVE";
//버틀 그룹쪽에서 컨틀롤러 호출
var url_C2_RESET = "appapiController?CTLGRP=C2&CTLFNC=RESET";
//컨디션1 변수 선언	
var obj_C2_API_SEQ; // SEQ 변수선언
var obj_C2_API_NM; // NM 변수선언
var obj_C2_PGM_ID; // ID 변수선언
var obj_C2_URL; // URL 변수선언
var $btG3 = null; //그리드1
	//컨트롤러 경로 s
	var url_G3_SEARCH = "appapiController?CTLGRP=G3&CTLFNC=SEARCH";
	//컨트롤러 경로 s
	var url_G3_CHKSAVE2 = "appapiController?CTLGRP=G3&CTLFNC=CHKSAVE2";
	//컨트롤러 경로 s
	var url_G3_RELOAD = "appapiController?CTLGRP=G3&CTLFNC=RELOAD";
	//컨트롤러 경로 s
	var url_G3_USER2 = "appapiController?CTLGRP=G3&CTLFNC=USER2";
	//컨트롤러 경로 s
	var url_G3_EXCEL2 = "appapiController?CTLGRP=G3&CTLFNC=EXCEL2";
//디테일 변수 초기화	

var obj_F4_CAL_valid = jQuery.parseJSON( '{ "F4_CAL": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":40,  "DATATYPE":"STRING"} }' );   // 달력 밸리데이션 선언
var obj_F4_API_SEQ_valid = jQuery.parseJSON( '{ "F4_API_SEQ": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":10,  "DATATYPE":"STRING"} }' );   // SEQ 밸리데이션 선언
var obj_F4_API_NM_valid = jQuery.parseJSON( '{ "F4_API_NM": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":50,  "DATATYPE":"STRING"} }' );   // NM 밸리데이션 선언
var obj_F4_PGM_ID_valid = jQuery.parseJSON( '{ "F4_PGM_ID": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":50,  "DATATYPE":"STRING"} }' );   // ID 밸리데이션 선언
var obj_F4_URL_valid = jQuery.parseJSON( '{ "F4_URL": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":50,  "DATATYPE":"STRING"} }' );   // URL 밸리데이션 선언
var obj_F4_REQ_ENCTYPE_valid = jQuery.parseJSON( '{ "F4_REQ_ENCTYPE": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":55,  "DATATYPE":"STRING"} }' );   // REQENCTYPE 밸리데이션 선언
var obj_F4_REQ_DATATYPE_valid = jQuery.parseJSON( '{ "F4_REQ_DATATYPE": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":50,  "DATATYPE":"STRING"} }' );   // REQDATATYPE 밸리데이션 선언
var obj_F4_REQ_BODY_valid = jQuery.parseJSON( '{ "F4_REQ_BODY": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":50,  "DATATYPE":"STRING"} }' );   // REQBODY 밸리데이션 선언
var obj_F4_RES_BODY_valid = jQuery.parseJSON( '{ "F4_RES_BODY": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":50,  "DATATYPE":"STRING"} }' );   // RESBODY 밸리데이션 선언
var obj_F4_MYFILESVRNM_valid = jQuery.parseJSON( '{ "F4_MYFILESVRNM": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":40,  "DATATYPE":"STRING"} }' );   // MYFILESVRNM 밸리데이션 선언
var obj_F4_MYFILE_valid = jQuery.parseJSON( '{ "F4_MYFILE": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":40,  "DATATYPE":"STRING"} }' );   // MYFILE 밸리데이션 선언
var obj_F4_MYFILE_VIEWER_valid = jQuery.parseJSON( '{ "F4_MYFILE_VIEWER": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":100,  "DATATYPE":"STRING"} }' );   // 이미지뷰어 밸리데이션 선언
var obj_F4_ADD_DT_valid = jQuery.parseJSON( '{ "F4_ADD_DT": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":14,  "DATATYPE":"STRING"} }' );   // ADD 밸리데이션 선언
var obj_F4_MOD_DT_valid = jQuery.parseJSON( '{ "F4_MOD_DT": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":14,  "DATATYPE":"STRING"} }' );   // MOD 밸리데이션 선언
//폼뷰 컨트롤러 경로
var url_F4_SEARCH = "appapiController?CTLGRP=F4&CTLFNC=SEARCH";
//폼뷰 컨트롤러 경로
var url_F4_SAVE = "appapiController?CTLGRP=F4&CTLFNC=SAVE";
//폼뷰 컨트롤러 경로
var url_F4_RELOAD = "appapiController?CTLGRP=F4&CTLFNC=RELOAD";
//폼뷰 컨트롤러 경로
var url_F4_NEW = "appapiController?CTLGRP=F4&CTLFNC=NEW";
//폼뷰 컨트롤러 경로
var url_F4_DELETE = "appapiController?CTLGRP=F4&CTLFNC=DELETE";
//폼뷰 컨트롤러 경로
var url_F4_MOD = "appapiController?CTLGRP=F4&CTLFNC=MOD";
var obj_F4_CAL;   // 달력 글로벌 변수 선언
var obj_F4_API_SEQ;   // SEQ 글로벌 변수 선언
var obj_F4_API_NM;   // NM 글로벌 변수 선언
var obj_F4_PGM_ID;   // ID 글로벌 변수 선언
var obj_F4_URL;   // URL 글로벌 변수 선언
var obj_F4_REQ_ENCTYPE;   // REQENCTYPE 글로벌 변수 선언
var obj_F4_REQ_DATATYPE;   // REQDATATYPE 글로벌 변수 선언
var obj_F4_REQ_BODY;   // REQBODY 글로벌 변수 선언
var obj_F4_RES_BODY;   // RESBODY 글로벌 변수 선언
var obj_F4_MYFILESVRNM;   // MYFILESVRNM 글로벌 변수 선언
var obj_F4_MYFILE;   // MYFILE 글로벌 변수 선언
var obj_F4_MYFILE_VIEWER;   // 이미지뷰어 글로벌 변수 선언
var obj_F4_ADD_DT;   // ADD 글로벌 변수 선언
var obj_F4_MOD_DT;   // MOD 글로벌 변수 선언
//화면 초기화	
function initBody(){
     alog("initBody()-----------------------start");
	
   //dhtmlx 메시지 박스 초기화
   dhtmlx.message.position="bottom";
	C2_INIT();	
		G3_INIT();	
		F4_INIT();	
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
function C2_INIT(){
  alog("C2_INIT()-------------------------start	");




	//각 폼 오브젝트들 초기화
	//API_SEQ, SEQ 초기화	
	//API_NM, NM 초기화	
	//PGM_ID, ID 초기화	
	//URL, URL 초기화	
  alog("C2_INIT()-------------------------end");
}

//그리드1 그리드 초기화
function G3_INIT(){
	alog("G3_INIT()-------------------------start");
	$btG3 = $('#btG3').bootstrapTable({
		columns:[
			{
				field: 'ROWID',
				title: 'ROWID',
				checkbox: false,
				visible: false,
				sortable: false,
				align: 'center',
				valign: 'middle',
			}
			,{
			field: 'ROWCHK',
			title: 'ROWCHK',
			checkbox: true,
			align: 'center',
			valign: 'middle'
			}
			,{
			field: 'API_SEQ',
			title: 'SEQ',
			sortable: true,
			align: 'left',
			valign: 'middle'
			}
			,{
			field: 'API_NM',
			title: 'NM',
			sortable: true,
			align: 'left',
			valign: 'middle'
			}
			,{
			field: 'PGM_ID',
			title: 'ID',
			sortable: true,
			align: 'right',
			valign: 'middle'
			}
			,{
			field: 'LINK',
			title: 'LINK',
			sortable: true,
			align: 'left',
			formatter:'bt4TableLinkFormatter',
			valign: 'middle'
			}
			,{
			field: 'MULTILINK',
			title: 'MULTILINK',
			sortable: true,
			align: 'center',
			formatter:'bt4TableMultiLinkFormatter',
			valign: 'middle'
			}
			,{
			field: 'ADD_DT',
			title: 'ADD',
			sortable: true,
			align: 'center',
			valign: 'middle'
			}
			,{
			field: 'MOD_DT',
			title: 'MOD',
			sortable: true,
			align: 'center',
			valign: 'middle'
			}
]
	});
	$btG3.on('click-row.bs.table', function (e, row, $element) {
		//    alert(row.myid);
		//alert(JSON.stringify(row))

		lastinputF4 = new HashMap(); // 폼뷰1
		lastinputF4.set("G3-API_SEQ", row.API_SEQ); // 
		F4_SEARCH(lastinputF4,uuidv4()); //자식그룹 호출 : 폼뷰1
		//    //alog(field);
		});
}
//디테일 초기화	
//폼뷰1 폼뷰 초기화
function F4_INIT(){
  alog("F4_INIT()-------------------------start");





setCodeCombo("FORMVIEW",$("#F4-REQ_ENCTYPE"),"FORMENCTYPE");
setCodeCombo("FORMVIEW",$("#F4-REQ_DATATYPE"),"REQDATATYPE");







	//컬럼 초기화
	//API_SEQ, SEQ 초기화	
	//달력 CAL, 달력
	$( "#F4-CAL" ).datepicker(dateFormatJson);
	//API_NM, NM 초기화	
	//PGM_ID, ID 초기화	
	//URL, URL 초기화	
	//MYFILESVRNM, MYFILESVRNM 초기화	
	$("#F4-MYFILESVRNM").attr("readonly",true);
	//MYFILE, MYFILE 초기화	
	//MYFILE_VIEWER, 이미지뷰어 초기화	
	//ADD_DT, ADD 초기화		//MOD_DT, MOD 초기화	  alog("F4_INIT()-------------------------end");
}
//D146 그룹별 기능 함수 출력		
//컨디션1, 저장	
function C2_SAVE(){
 alog("C2_SAVE-------------------start");
	//FormData parameter에 담아줌	
	var formData = new FormData();	//C2 getparams	
//폼뷰 F4는 params 객체에 직접 입력	
	var formview_data = $("#formviewF4").serializeArray();
    $.each(formview_data,function(i,nmval){
        formData.append(nmval.name,nmval.value);
	});
	if($("#F4_MYFILE").val() != ""){
		formData.append("F4-MYFILE",$("input[name=F4-MYFILE]")[0].files[0]);
	}
//var params = { CTL : "C2_SAVE"	, F4-CAL : , F4-API_SEQ : , F4-API_NM : , F4-PGM_ID : , F4-URL : , F4-REQ_ENCTYPE : , F4-REQ_DATATYPE : , F4-REQ_BODY : , F4-RES_BODY : , F4-MYFILESVRNM : , F4-MYFILE : , F4-MYFILE_VIEWER : , F4-ADD_DT : , F4-MOD_DT : };
	$.ajax({	
		type : "POST",
		url : url_C2_SAVE  ,
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
			msgError("[C2] Ajax http 500 error ( " + error + " )");
			alog("[C2] Ajax http 500 error ( " + error + " )");
		}
	});
	alog("C2_SAVE-------------------end");	
}
//사용자정의함수 : 테스트
function C2_sss(token){
	alog("C2_sss-----------------start");
alert("hi condition");

	alog("C2_sss-----------------end");
}
//검색조건 초기화
function C2_RESET(){
	alog("C2_RESET--------------------------start");
	$('#condition')[0].reset();
}
// CONDITIONSearch	
function C2_SEARCHALL(token){
	alog("C2_SEARCHALL--------------------------start");
	//입력값검증
	//폼의 모든값 구하기
	var ConAllData = $( "#condition" ).serialize();
	alog("ConAllData:" + ConAllData);
	//json : C2
			lastinputG3 = new HashMap(); //그리드1
		//  호출
	G3_SEARCH(lastinputG3,token);
	alog("C2_SEARCHALL--------------------------end");
}
//그리드 조회(그리드1)	
function G3_SEARCH(tinput,token){
	alog("G3_SEARCH()------------start");
	$("#spanG3Cnt").text("");
	//post 만들기
	sendFormData = new FormData($("#condition")[0]);
	if(typeof tinput != "undefined"){
		var tKeys = tinput.keys();
		for(i=0;i<tKeys.length;i++) {
			sendFormData.append(tKeys[i],tinput.get(tKeys[i]));
			//console.log(tKeys[i]+ '='+ tinput.get(tKeys[i])); 
		}
	}
	$btG3.bootstrapTable('showLoading');

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

			$btG3.bootstrapTable('hideLoading');

			//그리드에 데이터 반영
			if(data.RTN_CD == "200"){
				var row_cnt = 0;
				if(data.RTN_DATA){
					row_cnt = data.RTN_DATA.rows.length;
					$("#spanG3Cnt").text(row_cnt);
					$btG3.bootstrapTable('removeAll'); //모두 지우기
					$btG3.bootstrapTable('load', data.RTN_DATA.rows);

					}else{
						$("#spanG3Cnt").text("-");
					}
					msgNotice("[그리드1] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[그리드1] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[그리드1] Ajax http 500 error ( " + error + " )",3);
                alog("[그리드1] Ajax http 500 error ( " + data.RTN_MSG + " )");
            }
        });
		alog("G3_SEARCH()------------end");
}

//그리드1
function G3_CHKSAVE2(token){
	alog("G3_CHKSAVE2()------------start");

	var jsonSelectedRows = $btG3.bootstrapTable('getSelections');
	var strSelectedRowsIds = "";

	for(i=0;i<jsonSelectedRows.length;i++){
		if(i>0) strSelectedRowsIds += ",";


		strSelectedRowsIds += jsonSelectedRows[i].API_SEQ;
	}
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
	sendFormData.append("G3-CHK",strSelectedRowsIds);

	$.ajax({
		type : "POST",
		url : url_G3_CHKSAVE2 + "&TOKEN=" + token ,
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
			if(data && data.RTN_CD == "200"){
				msgNotice("[그리드1] 정상 처리되었습니다.");
			}else{
				msgError("처리 결과 실패했습니다. ( " + data.ERR_CD + ":" + data.RTN_MSG + " )",3);
			}

		},
		error: function(error){
			msgError("Ajax http 500 error ( " + error + " )");
			alog("Ajax http 500 error ( " + error + " )");
		}
	});
	
	alog("G3_CHKSAVE2()------------end");
}
//사용자정의함수 : UU
function G3_USER2(token){
	alog("G3_USER2-----------------start");
alert('감사합니다.');

	alog("G3_USER2-----------------end");
}
//새로고침	
function G3_RELOAD(token){
  alog("G3_RELOAD-----------------start");
  G3_SEARCH(lastinputG3,token);
}
//그리드1 엑셀 내려받기
function G3_EXCEL2(){
	alog("G3_EXCEL2()-------------------------start");

	$btG3.tableExport({type:'excel'});

	alog("G3_EXCEL2()------------end");
}
//FORMVIEW DELETE
function F4_DELETE(){	
	alog("F4_DELETE---------------start");

	//조회했는지 확인하기
	if( $("#F4-CTLCUD").val() != "R" ){
		alert("조회된 것만 삭제 가능합니다.");
		return;
	}
	//확인
	if(!confirm("정말로 삭제하시겠습니까?")){
		return;
	}
	
	//삭제처리 명령어
	$("#F4-CTLCUD").val("D");

	//폼객체를 불러와서
	var form1 = $("#formviewF4")[0];

	//FormData parameter에 담아줌
	var formData = new FormData(form1);

	$.ajax({
		type : "POST",
		url : url_F4_DELETE,
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
//디테일 검색	
function F4_SEARCH(tinput,token){
       alog("(FORMVIEW) F4_SEARCH---------------start");

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
        url : url_F4_SEARCH+"&TOKEN=" + token + "&F4_CRUD_MODE=SEARCH" ,
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
            $("#F4-CTLCUD").val("R");
			//SETVAL  가져와서 세팅
			$("#F4-API_SEQ").val(data.RTN_DATA.API_SEQ);//SEQ 변수세팅
	$("#F4-CAL").val(data.RTN_DATA.CAL);//달력 오브젝트 값 세팅
			$("#F4-API_NM").val(data.RTN_DATA.API_NM);//NM 변수세팅
			$("#F4-PGM_ID").val(data.RTN_DATA.PGM_ID);//ID 변수세팅
			$("#F4-URL").val(data.RTN_DATA.URL);//URL 변수세팅
			$("#F4-REQ_ENCTYPE").val(data.RTN_DATA.REQ_ENCTYPE);//REQENCTYPE 변수세팅
			$("#F4-REQ_DATATYPE").val(data.RTN_DATA.REQ_DATATYPE);//REQDATATYPE 변수세팅
		$("#F4-REQ_BODY").val(data.RTN_DATA.REQ_BODY);//REQBODY 오브젝트 값세팅
		$("#F4-RES_BODY").val(data.RTN_DATA.RES_BODY);//RESBODY 오브젝트 값세팅
			$("#F4-MYFILESVRNM").val(data.RTN_DATA.MYFILESVRNM);//MYFILESVRNM 변수세팅
		if(data.RTN_DATA.MYFILE){
			var tarr = data.RTN_DATA.MYFILE.split("^");//CD^NM
			if(tarr.length == 2){
				var fileNm = tarr[1] ;
				if(fileNm != ""){
					$("#F4-MYFILE-LINK").attr("href",tarr[0]);//MYFILE 링크세팅
					$("#F4-MYFILE-NM").text(fileNm);//MYFILE 파일이름세팅
					$("#DIV-F4-MYFILE").css("display", ""); //영역보이기
				}else{
					alog("MYFILE MYFILE 파일 이름이 없습니다.");
				}
			}else{
				alert("F4-MYFILE 값이 멀티값이 아닙니다.");
			}
		}else{
			$("#F4-MYFILE").val("");//값 비우기
			$("#F4-MYFILE-LINK").attr("href","");//MYFILE 링크세팅
			$("#F4-MYFILE-NM").text("");//MYFILE 파일이름세팅

			$("#DIV-F4-MYFILE").css("display", "none"); //영역숨기기
			alog("F4-MYFILE 값이 없습니다..");
		}
			//IMAGE VIEWER ( format : thumb_url:real_url,thumb_url:real_url )
			$("#F4-MYFILE_VIEWER-HOLDER").html(""); //기존값 비우기
			if(data.RTN_DATA.MYFILE_VIEWER){
				var tArray1 = data.RTN_DATA.MYFILE_VIEWER.split(",");
				if(data.RTN_DATA.MYFILE_VIEWER && tArray1.length > 0){
					for(var t=0;t<tArray1.length;t++){
						var tArray2 = tArray1[t].split("^");//0 thumb, 1 real
						$("#F4-MYFILE_VIEWER-HOLDER").append("<span><a href='" + tArray2[0] + "' target='_blank'><img class='FORMVIEW_IMGVIEWER_IMG' src='" + tArray2[1] + "' height='90px'></a></span>"); 						
					}
				}
			}
			$("#F4-ADD_DT").text(data.RTN_DATA.ADD_DT);//ADD 변수세팅
			$("#F4-MOD_DT").text(data.RTN_DATA.MOD_DT);//MOD 변수세팅
        },
        error: function(error){
            alog("Error:");
            alog(error);
        }
    });
    alog("(FORMVIEW) F4_SEARCH---------------end");

}
//새로고침	
function F4_RELOAD(token){
	alog("F4_RELOAD-----------------start");
	F4_SEARCH(lastinputF4,token);
}//F4_SAVE
	//IO_FILE_YN = Y	
function F4_SAVE(token){	
	alog("F4_SAVE---------------start");

	if( !( $("#F4-CTLCUD").val() == "C" || $("#F4-CTLCUD").val() == "U") ){
		alert("신규 또는 수정 모드 진입 후 저장할 수 있습니다.")
		return;
	}

	//전송 데이터 객체 만들기
	var sendFormData = new FormData($("#formviewF4")[0]);

	//컨디션 데이터 추가하기
	conditionData = new FormData($("#condition")[0]);
    var es, e, pair;
    for (es = conditionData.entries(); !(e = es.next()).done && (pair = e.value);) {
		sendFormData.append(pair[0],pair[1]);
    }

	$.ajax({
		type : "POST",
		url : url_F4_SAVE + "&TOKEN=" + token,
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
function F4_MOD(){
       alog("[FromView] F4_MOD---------------start");
	if( $("#F4-CTLCUD").val() == "C" ){
		alert("조회 후 수정 가능합니다. 신규 모드에서는 수정할 수 없습니다.")
		return;
	}
	if( $("#F4-CTLCUD").val() == "D" ){
		alert("조회 후 수정 가능합니다. 삭제 모드에서는 수정할 수 없습니다.")
		return;
	}

	$("#F4-CTLCUD").val("U");
       alog("[FromView] F4_MOD---------------end");
}
//	
function F4_NEW(){
       alog("[FromView] F4_NEW---------------start");
	$("#F4-CTLCUD").val("C");
	//PMGIO 로직
	$("#F4-API_SEQ").val("");//SEQ 신규초기화	
	$("#F4-API_NM").val("");//NM 신규초기화	
	$("#F4-PGM_ID").val("");//ID 신규초기화	
	$("#F4-URL").val("");//URL 신규초기화	
	$("#F4-REQ_BODY").val("");//REQBODY 신규초기화
	$("#F4-RES_BODY").val("");//RESBODY 신규초기화
	$("#F4-MYFILESVRNM").val("");//MYFILESVRNM 신규초기화	
				$("#F4-MYFILE-LINK").attr("href","");//MYFILE NEW
				$("#F4-MYFILE-NM").text("");//MYFILE NEW
	$("#F4-MYFILE_VIEWER").html("");
	$("#F4-ADD_DT").text("");//ADD 신규초기화		$("#F4-MOD_DT").text("");//MOD 신규초기화	       alog("DETAILNew30---------------end");
}
