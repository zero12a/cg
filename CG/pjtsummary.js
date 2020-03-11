//글로벌 변수 선언
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_SEARCHALL = "pjtsummaryController?CTLGRP=G1&CTLFNC=SEARCHALL";
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_RESET = "pjtsummaryController?CTLGRP=G1&CTLFNC=RESET";
// 변수 선언	
	//1 글로벌 변수 초기화
//BI뷰 컨트롤러 경로
var url_G2_SEARCH = "pjtsummaryController?CTLGRP=G2&CTLFNC=SEARCH";
	//2 글로벌 변수 초기화
//BI뷰 컨트롤러 경로
var url_G3_SEARCH = "pjtsummaryController?CTLGRP=G3&CTLFNC=SEARCH";
	//3 글로벌 변수 초기화
//BI뷰 컨트롤러 경로
var url_G4_SEARCH = "pjtsummaryController?CTLGRP=G4&CTLFNC=SEARCH";
	//4 글로벌 변수 초기화
//BI뷰 컨트롤러 경로
var url_G5_SEARCH = "pjtsummaryController?CTLGRP=G5&CTLFNC=SEARCH";
//화면 초기화	
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

//1 BI뷰 초기화
function G2_INIT(){
  alog("G2_INIT()-------------------------start");
}
//1 BI뷰 초기화
function G2_INIT(){
  alog("G2_INIT()-------------------------start");
		
		$("#G2-VAL1-VALUE").text("-");//VAL1 변수세팅
	//BIVIEW 1 클릭 이벤트
	$( "#DIV-G2-CLICK" ).click(function() {
		alog("#DIV-G2-CLICK.click()...........................start");

alert("OKOK")

		alog("#DIV-G2-CLICK.click()...........................end");
	});
  alog("G2_INIT()-------------------------end");
}
//2 BI뷰 초기화
function G3_INIT(){
  alog("G3_INIT()-------------------------start");
}
//2 BI뷰 초기화
function G3_INIT(){
  alog("G3_INIT()-------------------------start");
  alog("G3_INIT()-------------------------end");
}
//3 BI뷰 초기화
function G4_INIT(){
  alog("G4_INIT()-------------------------start");
}
//3 BI뷰 초기화
function G4_INIT(){
  alog("G4_INIT()-------------------------start");
  alog("G4_INIT()-------------------------end");
}
//4 BI뷰 초기화
function G5_INIT(){
  alog("G5_INIT()-------------------------start");
}
//4 BI뷰 초기화
function G5_INIT(){
  alog("G5_INIT()-------------------------start");
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
	//json : G1
			lastinputG2 = new HashMap(); //1
				lastinputG3 = new HashMap(); //2
				lastinputG4 = new HashMap(); //3
				lastinputG5 = new HashMap(); //4
		//  호출
	G2_SEARCH(lastinputG2,token);
	//  호출
	G3_SEARCH(lastinputG3,token);
	//  호출
	G4_SEARCH(lastinputG4,token);
	//  호출
	G5_SEARCH(lastinputG5,token);
	alog("G1_SEARCHALL--------------------------end");
}
//검색조건 초기화
function G1_RESET(){
	alog("G1_RESET--------------------------start");
	$('#condition')[0].reset();
}
function G2_SEARCH(tinput,token){
       alog("(BIVIEW) G2_SEARCH---------------start");

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
					msgNotice("[1] 정상적으로 조회되었습니다.",1);
				}else{
					msgNotice("[1] 정상적으로 조회되었으나 데이터가 없습니다.",2);
					return;
				}
			}else{
				msgError("[1] 오류가 발생했습니다("+ data.ERR_CD + ")." + data.RTN_MSG,3);
				return;
			}
			//SETVAL  가져와서 세팅
			if(data.RTN_DATA.VAL1){
				$("#G2-VAL1-VALUE").text(data.RTN_DATA.VAL1);//VAL1 세팅
			}else{
				alert("VAL1 값이 없습니다.");
			}
        },
        error: function(error){
            alog("Error:");
            alog(error);
        }
    });
    alog("(BIVIEW) G2_SEARCH---------------end");

}
function G3_SEARCH(tinput,token){
       alog("(BIVIEW) G3_SEARCH---------------start");

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
					msgNotice("[2] 정상적으로 조회되었습니다.",1);
				}else{
					msgNotice("[2] 정상적으로 조회되었으나 데이터가 없습니다.",2);
					return;
				}
			}else{
				msgError("[2] 오류가 발생했습니다("+ data.ERR_CD + ")." + data.RTN_MSG,3);
				return;
			}
			//SETVAL  가져와서 세팅
        },
        error: function(error){
            alog("Error:");
            alog(error);
        }
    });
    alog("(BIVIEW) G3_SEARCH---------------end");

}
function G4_SEARCH(tinput,token){
       alog("(BIVIEW) G4_SEARCH---------------start");

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
					msgNotice("[3] 정상적으로 조회되었습니다.",1);
				}else{
					msgNotice("[3] 정상적으로 조회되었으나 데이터가 없습니다.",2);
					return;
				}
			}else{
				msgError("[3] 오류가 발생했습니다("+ data.ERR_CD + ")." + data.RTN_MSG,3);
				return;
			}
			//SETVAL  가져와서 세팅
        },
        error: function(error){
            alog("Error:");
            alog(error);
        }
    });
    alog("(BIVIEW) G4_SEARCH---------------end");

}
function G5_SEARCH(tinput,token){
       alog("(BIVIEW) G5_SEARCH---------------start");

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
        url : url_G5_SEARCH+"&TOKEN=" + token + "&G5_CRUD_MODE=SEARCH" ,
        data : sendFormData,
		processData: false,
		contentType: false,
        dataType: "json",
        success: function(data){
            alog(data);

			if(data && data.RTN_CD == "200"){
				if(data.RTN_DATA){
					msgNotice("[4] 정상적으로 조회되었습니다.",1);
				}else{
					msgNotice("[4] 정상적으로 조회되었으나 데이터가 없습니다.",2);
					return;
				}
			}else{
				msgError("[4] 오류가 발생했습니다("+ data.ERR_CD + ")." + data.RTN_MSG,3);
				return;
			}
			//SETVAL  가져와서 세팅
        },
        error: function(error){
            alog("Error:");
            alog(error);
        }
    });
    alog("(BIVIEW) G5_SEARCH---------------end");

}
