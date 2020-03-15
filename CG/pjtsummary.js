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
//컨트롤러 경로
var url_G6_SEARCH = "pjtsummaryController?CTLGRP=G6&CTLFNC=SEARCH";
			//G.GRPID 챠트 데이터
		var chartG6Data = { colids : [], labels : [], datasets: [] };
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
	G6_INIT();	
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
		
		$("#G2-VAL1-VALUE").text("-");//프로그램갯수 변수세팅
	//BIVIEW 1 클릭 이벤트
	$( "#DIV-G2-CLICK" ).click(function() {
		alog("#DIV-G2-CLICK.click()...........................start");

alert("OKOK G2")

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
		
		$("#G3-VAL1-VALUE").text("-");//VAL1 변수세팅
	//BIVIEW 2 클릭 이벤트
	$( "#DIV-G3-CLICK" ).click(function() {
		alog("#DIV-G3-CLICK.click()...........................start");

alert("OKOK G3")

		alog("#DIV-G3-CLICK.click()...........................end");
	});
  alog("G3_INIT()-------------------------end");
}
//3 BI뷰 초기화
function G4_INIT(){
  alog("G4_INIT()-------------------------start");
}
//3 BI뷰 초기화
function G4_INIT(){
  alog("G4_INIT()-------------------------start");
		
			$("#G4-VAL1-VALUE1").text("-");//설정값 및 DD NEW
			$("#G4-VAL1-VALUE2").text("-");//설정값 및 DD NEW
	//BIVIEW 3 클릭 이벤트
	$( "#DIV-G4-CLICK" ).click(function() {
		alog("#DIV-G4-CLICK.click()...........................start");

alert("OKOK G4")

		alog("#DIV-G4-CLICK.click()...........................end");
	});
  alog("G4_INIT()-------------------------end");
}
//4 BI뷰 초기화
function G5_INIT(){
  alog("G5_INIT()-------------------------start");
}
//4 BI뷰 초기화
function G5_INIT(){
  alog("G5_INIT()-------------------------start");
		
			$("#G5-VAL1-VALUE1").text("-");//VAL1 NEW
			$("#G5-VAL1-VALUE2").text("-");//VAL1 NEW
	//BIVIEW 4 클릭 이벤트
	$( "#DIV-G5-CLICK" ).click(function() {
		alog("#DIV-G5-CLICK.click()...........................start");

alert("OKOK G5")

		alog("#DIV-G5-CLICK.click()...........................end");
	});
  alog("G5_INIT()-------------------------end");
}
//6 그리드 초기화
function G6_INIT(){
  alog("G6_INIT()-------------------------start");
		//챠트 6 초기화
	var ctx = $('#canvasG6')[0].getContext('2d');
	window.myBarG6 = new Chart(ctx, {
		type: 'bar' //일단 선언해 줘야 함                
		,data: chartG6Data
		,options: {
			responsive: true
			,maintainAspectRatio: false			
			,legend: {
				position: '',
			}
			,layout : {
				padding: {
                	left: 0,
               	 	right: 0,
               	 	top: 15,
                	bottom: 0
            	}	
			}		}
	});
	//챠트영역 전체를 아무데나 클릭
	$("#canvasG6").on('click', function (e) {
		alog("#canvasG6.click................start");

alert("그룹영역 클릭");


		alog("#canvasG6.click................end");
	});
	//bar,line 오브젝트를 직접 클릭
	$("#canvasG6").on('click', function (e) {
		alog("#canvasG6.click................start");
		//alert(e);
		var bars = window.myBarG6.getElementAtEvent(e);
		if (bars.length == 0) return;
		var element = null;
		element = bars[0];
		if (element === null) return;

		var labelElement, dataElement, colid, firstColLabel;
		labelElement = chartG6Data.datasets[element._datasetIndex].label;
		colid = chartG6Data.datasets[element._datasetIndex].colid;
		//alert(labelElement);
		firstColLabel = chartG6Data.labels[element._index];
		//alert(firstColLabel);                
		dataElement = chartG6Data.datasets[element._datasetIndex].data[element._index];
		//alert(dataElement);

alert("오브젝트 영역 클릭");


		alog("#canvasG6.click................end");
	});
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
				lastinputG6 = new HashMap(); //6
		//  호출
	G2_SEARCH(lastinputG2,token);
	//  호출
	G3_SEARCH(lastinputG3,token);
	//  호출
	G4_SEARCH(lastinputG4,token);
	//  호출
	G5_SEARCH(lastinputG5,token);
	//  호출
	G6_SEARCH(lastinputG6,token);
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
				$("#G2-VAL1-VALUE").text(data.RTN_DATA.VAL1);//프로그램갯수 세팅
			}else{
				alert("프로그램갯수 값이 없습니다.");
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
			if(data.RTN_DATA.VAL1){
				$("#G3-VAL1-VALUE").text(data.RTN_DATA.VAL1);//VAL1 세팅
			}else{
				alert("VAL1 값이 없습니다.");
			}
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
		var tArr = data.RTN_DATA.VAL1.split("^");
		if(tArr){
			if(tArr.length == 2){
				$("#G4-VAL1-VALUE1").text(tArr[0]);//설정값 및 DD 변수세팅
				$("#G4-VAL1-VALUE2").text(tArr[1]);//설정값 및 DD 변수세팅
			}else{
				alog("VAL1의 멀티값(" + tArr.length + ")이 잘못되었습니다.");
			}
		}else{
			alert("VAL1 컬럼이 없습니다.");
		}
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
		var tArr = data.RTN_DATA.VAL1.split("^");
		if(tArr){
			if(tArr.length == 2){
				$("#G5-VAL1-VALUE1").text(tArr[0]);//VAL1 변수세팅
				$("#G5-VAL1-VALUE2").text(tArr[1]);//VAL1 변수세팅
			}else{
				alog("VAL1의 멀티값(" + tArr.length + ")이 잘못되었습니다.");
			}
		}else{
			alert("VAL1 컬럼이 없습니다.");
		}
        },
        error: function(error){
            alog("Error:");
            alog(error);
        }
    });
    alog("(BIVIEW) G5_SEARCH---------------end");

}
    //그리드 조회(6)	
    function G6_SEARCH(tinput,token){
        alog("G6_SEARCH()------------start");

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
            url : url_G6_SEARCH+"&TOKEN=" + token ,
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
						$("#spanG6Cnt").text(row_cnt);




          	var colorNames = Object.keys(window.chartColors);     

			//데이터 초기화
			chartG6Data.datasets = [];

			//첫 컬럼의 모든 rows는 챠트 라벨
            var newLabels = [];
            var nowCol = 0;
            for(i=0;i<resData.RTN_DATA.rows.length;i++){
                newLabels.push(resData.RTN_DATA.rows[i].data[nowCol]);
            }
            chartG6Data.labels = newLabels;
				//컬럼ID목록 저장해 두기
				newColids = [];
				newColids.push("LABEL"); // 라벨
					newColids.push("VAL1"); // VAL1
					newColids.push("VAL2"); // VAL2
					chartG6Data.colids = newColids; // 6
            //두번째 컬럼부터 
            nowCol++;
            var dsColor = window.chartColors[colorNames[nowCol-1]];                 
            var newDataset = {
                type : 'bar',                
				label: 'VAL1',
				colid : 'VAL1',
				backgroundColor: color(dsColor).alpha(0.5).rgbString(),
				borderColor: dsColor,
				borderWidth: 1,
				data: []
            };
            for(i=0;i<resData.RTN_DATA.rows.length;i++){
                newDataset.data.push(resData.RTN_DATA.rows[i].data[nowCol]);
            }      
            chartG6Data.datasets.push(newDataset);
            //두번째 컬럼부터 
            nowCol++;
            var dsColor = window.chartColors[colorNames[nowCol-1]];                 
            var newDataset = {
                type : 'line',                
				label: 'VAL2',
				colid : 'VAL2',
				backgroundColor: color(dsColor).alpha(0.5).rgbString(),
				borderColor: dsColor,
				borderWidth: 1,
				data: []
            };
            for(i=0;i<resData.RTN_DATA.rows.length;i++){
                newDataset.data.push(resData.RTN_DATA.rows[i].data[nowCol]);
            }      
            chartG6Data.datasets.push(newDataset);
			window.myBarG6.update();     //업데이트
						
					}
					msgNotice("[6] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[6] 서버 조회중 에러가 발생했습니다.RTN_CD : " + resData.RTN_CD + "ERR_CD : " + resData.ERR_CD + "RTN_MSG :" + resData.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[6] Ajax http 500 error ( " + error + " )",3);
                alog("[6] Ajax http 500 error ( " + error + " )");
            }
        });

        alog("gridSearchG6()------------end");
    }
