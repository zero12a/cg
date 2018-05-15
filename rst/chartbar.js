//글로벌 변수 선언	
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_SEARCHALL = "chartbarController.php?CTLGRP=G1&CTLFNC=SEARCHALL";//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_SAVE = "chartbarController.php?CTLGRP=G1&CTLFNC=SAVE";//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_RESET = "chartbarController.php?CTLGRP=G1&CTLFNC=RESET";//컨디션 변수 선언	
//컨트롤러 경로
var url_G2_SEARCH = "chartbarController.php?CTLGRP=G2&CTLFNC=SEARCH";
			//G.GRPID 챠트 데이터
		var chartG2Data = { labels : [],	datasets: [] };
//화면 초기화	
function initBody(){
     alog("initBody()-----------------------start");
	
   //dhtmlx 메시지 박스 초기화
   dhtmlx.message.position="bottom";
	G1_INIT();	
		G2_INIT();	
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
                type: 'bar', //일단 선언해 줘야 함                
				data: chartG2Data,                
				options: {
					responsive: true,
					legend: {
						position: 'top',
					}
				}
            });
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
	lastinputG2 = ConAllData ;
	//json : G1
            lastinputG2json = jQuery.parseJSON('{ "__NAME":"lastinputG2json"' +'}');
	//  호출
	G2_SEARCH(lastinputG2,token);
	alog("G1_SEARCHALL--------------------------end");
}
    //그리드 조회(챠트)	
    function G2_SEARCH(tinput,token){
        alog("G2_SEARCH()------------start");

        //불러오기
        $.ajax({
            type : "POST",
            url : url_G2_SEARCH+"&TOKEN=" + token + " &G2_CRUD_MODE=read&" + tinput ,
            data : tinput,
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
                type : 'bar',                
				label: 'LOGIN_CNT',
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
