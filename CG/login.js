//글로벌 변수 선언
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_SEARCHALL = "loginController?CTLGRP=G1&CTLFNC=SEARCHALL";
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_SAVE = "loginController?CTLGRP=G1&CTLFNC=SAVE";
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_RESET = "loginController?CTLGRP=G1&CTLFNC=RESET";
//입력폼 변수 선언	
var obj_G1_USR_ID; // USR_ID 변수선언
var obj_G1_USR_PWD; // USR_PWD 변수선언
//디테일 변수 초기화	

//폼뷰 컨트롤러 경로
var url_G2_SEARCH = "loginController?CTLGRP=G2&CTLFNC=SEARCH";
//폼뷰 컨트롤러 경로
var url_G2_SAVE = "loginController?CTLGRP=G2&CTLFNC=SAVE";
//폼뷰 컨트롤러 경로
var url_G2_EDIT = "loginController?CTLGRP=G2&CTLFNC=EDIT";
var obj_G2_USR_ID;   // USR_ID 글로벌 변수 선언
var obj_G2_USR_SEQ;   // USE_SEQ 글로벌 변수 선언
var obj_G2_USR_NM;   // USR_NM 글로벌 변수 선언
var obj_G2_USR_PWD;   // USR_PWD 글로벌 변수 선언
//화면 초기화	
function initBody(){
     alog("initBody()-----------------------start");
	
   //dhtmlx 메시지 박스 초기화
   dhtmlx.message.position="bottom";
	G1_INIT();	
		G2_INIT();	
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
	//USR_ID, USR_ID 초기화	
	//USR_PWD, USR_PWD 초기화	
  alog("G1_INIT()-------------------------end");
}

//디테일 초기화	
//조회결과 폼뷰 초기화
function G2_INIT(){
  alog("G2_INIT()-------------------------start");




	//컬럼 초기화
	//USR_ID, USR_ID 초기화	
	//USR_SEQ, USE_SEQ 초기화	
	//USR_NM, USR_NM 초기화	
	//USR_PWD, USR_PWD 초기화	
  alog("G2_INIT()-------------------------end");
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
			lastinputG2 = new HashMap(); //조회결과
		//  호출
	G2_SEARCH(lastinputG2,token);
	alog("G1_SEARCHALL--------------------------end");
}
//검색조건 초기화
function G1_RESET(){
	alog("G1_RESET--------------------------start");
	$('#condition')[0].reset();
}
//입력폼, 저장	
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
//디테일 검색	
function G2_SEARCH(tinput,token){
       alog("(FORMVIEW) G2_SEARCH---------------start");

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
        url : url_G2_SEARCH+"&TOKEN=" + token + "&G2_CRUD_MODE=SEARCH" ,
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
            $("#G2-CTLCUD").val("R");
			//SETVAL  가져와서 세팅
			$("#G2-USR_ID").val(data.RTN_DATA.USR_ID);//USR_ID 변수세팅
			$("#G2-USR_SEQ").val(data.RTN_DATA.USR_SEQ);//USE_SEQ 변수세팅
			$("#G2-USR_NM").val(data.RTN_DATA.USR_NM);//USR_NM 변수세팅
			$("#G2-USR_PWD").val(data.RTN_DATA.USR_PWD);//USR_PWD 변수세팅
        },
        error: function(error){
            alog("Error:");
            alog(error);
        }
    });
    alog("(FORMVIEW) G2_SEARCH---------------end");

}
function G2_EDIT(){
       alog("[FromView] G2_EDIT---------------start");
	if( $("#G2-CTLCUD").val() == "C" ){
		alert("조회 후 수정 가능합니다. 신규 모드에서는 수정할 수 없습니다.")
		return;
	}
	if( $("#G2-CTLCUD").val() == "D" ){
		alert("조회 후 수정 가능합니다. 삭제 모드에서는 수정할 수 없습니다.")
		return;
	}

	$("#G2-CTLCUD").val("U");
       alog("[FromView] G2_EDIT---------------end");
}
//G2_SAVE
//IO_FILE_YN = N	
	//IO_FILE_YN = N	
function G2_SAVE(token){	
	alog("G2_SAVE---------------start");

	if( !( $("#G2-CTLCUD").val() == "C" || $("#G2-CTLCUD").val() == "U") ){
		alert("신규 또는 수정 모드 진입 후 저장할 수 있습니다.")
		return;
	}

	//전송용 데이터 생성하기
	var sendFormData = new FormData($("#formviewG2")[0]);

	//컨디션 데이터 추가하기
	conditionData = new FormData($("#condition")[0]);
    var es, e, pair;
    for (es = conditionData.entries(); !(e = es.next()).done && (pair = e.value);) {
		sendFormData.append(pair[0],pair[1]);
    }

	$.ajax({
		type : "POST",
		url : url_G2_SAVE + "&TOKEN=" + token,
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