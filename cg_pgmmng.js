    


    //정적 변수 선언
    var makeSyncFileLineSum;
	var popSelectLayout; //레이아웃용
    var myCalendar;
    var lastCondition;
    var mygridPgm,addstatusynPgm,lastinputPgm,lastinputPgmjson,lastrowidPgm;


    var mygridPgm_url = "cg_pgmmng_crud.php?CTLGRP=PGM&"; //팝업윈도우 프로그램 검색
    var validmsg = jQuery.parseJSON('{"REQUARED":"[0]는 반드시 입력바랍니다.", "MIN":"this는 [0]이상 입력바랍니다."}');

	var isLayoutLoaded = false;
	var myWins;

    var lastSelectGrpRowId; //마지막 선택한 그리드 프로퍼티 row

    
    function Make(pgmtype) {
        window.open( "http://" + window.location.hostname  + ":8060/m.k/cg_make.php?access_token=" + oauthToken + "&pjtseq=" + $("#F_PJTSEQ").val() + "&pgmseq=" + $("#F_PGMSEQ").val()+ "&pgmtype=" + pgmtype ) ;
    }

    //비동기 예시
    //https://gist.github.com/irazasyed/5382444
    async function httpAsync(token,requestQueue){
        alog("httpAsync()..........start");

        var loopCnt = 0;
        var nowQueueCnt = 0; //동시 실행
        var reqCnt = 0;
        var maxQueueSize = $("#maxQueue option:selected").val();
        alog("  maxQueueSize = " + maxQueueSize);
        
        //return;
        while(reqCnt<requestQueue.length){
            loopCnt++;
            alog("loopCnt = "  + loopCnt);

            if(nowQueueCnt >= maxQueueSize){
                alog("  sleep 1000");
                await waiting(1000);
                continue;
            }

            pjtSeq = requestQueue[reqCnt][0];
            pgmSeq = requestQueue[reqCnt][1];
            pgmType = requestQueue[reqCnt][2];

            nowQueueCnt++;
            alog("  nowQuqueCnt (before http request) = " + nowQueueCnt);
            $.ajax({
                type : "GET",
                url : "http://" + window.location.hostname  + ":8060/m.k/cg_make.php?async=Y&access_token=" + oauthToken + "&TOKEN=" + token + "&pjtseq=" + pjtSeq + "&pgmseq=" + pgmSeq + "&pgmtype=" + pgmType,
                dataType : "jsonp",
                async: true,
                xhrFields: {
                    withCredentials: true
                 },
                success: function(data){
                    alog(" Return : " + data.RTN_CD + " / " + data.RTN_MSG);

                    if(data.RTN_CD == "200"){
                        old = mygridPgm.cells(data.ERR_CD, mygridPgm.getColIndexById("STATUS")).getValue();
                        mygridPgm.cells(data.ERR_CD, mygridPgm.getColIndexById("STATUS")).setValue(old + "■");
                        msgNotice(data.RTN_MSG,10);
                    }else{
                        msgError("에러 발생  ( " + data.RTN_MSG + " )");
                    }
                    
                    nowQueueCnt--;
                    alog("  nowQueueCnt (after success return) = " + nowQueueCnt);                    
                },
                error: function(error){
                    msgError("MakeAsync() Ajax http 500 error ( " + error + " )");
                    nowQueueCnt--;
                    alog("  nowQueueCnt (after error return) = " + nowQueueCnt);                       
                }
            });    
            reqCnt++;
            alog("  reqCnt/Queue.length = " + reqCnt + "/" + requestQueue.length);            
        }

        alog("httpAsync()..........end");
    }

    function waiting(ms){
        return new Promise(resolve => setTimeout(resolve,ms));
    }

    function makeChkAsync(token){

        //alert(mygridPgm.getCheckedRows(0));
        var chkStr = mygridPgm.getCheckedRows(0);
        var chkArr = chkStr.split(",");

        var types = ["HTML","HTMLJS","SVRCTL","SVRSVC","SVRDAO"];
        var requestQueue = new Array();
        for ( var k in chkArr ) {
            for(i=0;i<types.length;i++){
                mygridPgm.cells(chkArr[k], mygridPgm.getColIndexById("STATUS")).setValue("");
                var tempArr = [
                    mygridPgm.cells(chkArr[k], mygridPgm.getColIndexById("PJTSEQ")).getValue()
                    ,mygridPgm.cells(chkArr[k], mygridPgm.getColIndexById("PGMSEQ")).getValue()
                    ,types[i]
                    ];
                requestQueue[requestQueue.length] = tempArr;
            }
        }

        for(b=0;b<requestQueue.length;b++){
            alog(b + " PJTSEQ = " + requestQueue[b][0] +  ", PGMSEQ = " + requestQueue[b][1] +  ", TYPE = " + requestQueue[b][2]);
        }
        //return;
        httpAsync(token,requestQueue);
    }

    

    function Run() {
        if($("#F_PGMURL").val() == ""){
            alert("조회조건에 URL을 입력해 주세요.")
        }else{
            //window.open("./rst/" + $("#F_PGMURL").val() );//단일 프로젝트일때
            window.open("./" + $("#F_PJTID").val() + "/" + $("#F_PGMURL").val() );//멀티 프로젝트일때
        }
        
    }
    function SourceView() {
        window.open("cg_viewtab.php?pgmseq=" + $("#F_PGMSEQ").val() + "&pjtseq=" + $("#F_PJTSEQ").val());
    }


    
    function pgmConditionReset(){
        $("#POP_PJTSEQ").val("");
        $("#POP_PGMID").val("");
        $("#POP_PGMNM").val("");
        //$("#POP_PJTSEQ").val("");
    }

    //그리드 조회 (pgm)
    function gridSearchPgm(tinput){
        alog("gridSearchPgm()------------start");

        //그리드 초기화
        mygridPgm.clearAll();

        //불러오기
        $.ajax({
            type : "POST",
            url : mygridPgm_url+"&CTLFNC=SEARCH&" + tinput ,
            data : {POP_PJTSEQ : $("#POP_PJTSEQ").val(),POP_PGMID : $("#POP_PGMID").val(),POP_PGMNM : $("#POP_PGMNM").val(),},
            dataType: "json",
            async: true,
            success: function(data){
                alog("   gridSearchPgm json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){

					var row_cnt = 0;
					if(data.RTN_DATA){
                        row_cnt = data.RTN_DATA.rows.length;
                        $("#spanPgmCnt").text(row_cnt);

						mygridPgm.parse(data.RTN_DATA,"json");
						
					}
					msgNotice("[PGM] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("PGM] 서버 조회중 에러가 발생했습니다.\nRTN_CD : " + data.RTN_CD + "\nERR_CD : " + data.ERR_CD + "\nRTN_MSG :" + data.RTN_MSG,3);
                }


            },
            error: function(error){
				msgError("[PGM] Ajax http 500 error ( " + error + " )",3);
                alog("[PGM] Ajax http 500 error ( " + error + " )");
            }
        });

        alog("gridSearchPgm()------------end");
    }

	//프로그램 검색
	function pgmSearch(inputNm){
		//alert( "#F_PGMNM for .change() called." );
		//alert($("#F_PGMNM").val());
        $("#POP_PJTSEQ").val($("#F_PJTSEQ").val());
        $("#POP_PGMID").val($("#F_PGMID").val());
		$("#POP_PGMNM").val($("#F_PGMNM").val());
		$("#divPgm").css("display","");
		if(myWins && myWins.window("pgmwindow")){
			//alert("show");
			myWins.window("pgmwindow").show();
		}else{
			//alert("new");
            myWins = new dhtmlXWindows();
  
			myWins.createWindow({
				id:"pgmwindow",
				left:20,
				top:30,
				width:680,
                height:470,
                caption:"프로그램 검색"
            });
            //myWins.window("pgmwindow").hideHeader();

			myWins.window("pgmwindow").attachEvent("onClose", function(win){
				//alert(1);
				myWins.window("pgmwindow").hide();
				return false;
			});
			myWins.window("pgmwindow").attachObject("divPgm");
		}

		$("#btnPgmSearch2").click();

	}


    //화면 초기화
    function initBody(){

		//dhtmlx 메시지 박스 초기화
		dhtmlx.message.position="bottom"

        //메시지 박스2
        toastr.options.closeButton = true;
        toastr.options.positionClass = 'toast-bottom-right';

        //그리드 초기화(PGM)
        mygridPgm = new dhtmlXGridObject('gridPgm');
		mygridPgm.setUserData("","gridTitle","pgm : pgm list"); //글로별 변수에 그리드 타이블 넣기
        mygridPgm.setImagePath(CFG_URL_LIBS_ROOT + "lib/dhtmlxSuite/codebase/imgs/");
        mygridPgm.setHeader("#master_checkbox,PJTSEQ,PJTID,PGMSEQ,STATUS,PGMID,PGMNM,URL,권한받기,PGMTYPE,VERDT,차수,MAKEDT,ADDDT,MODDT");
        mygridPgm.setColumnIds("CHK,PJTSEQ,PJTID,PGMSEQ,STATUS,PGMID,PGMNM,VIEWURL,GETAUTH,PGMTYPE,VERDT,DEGREE,MAKEDT,ADDDT,MODDT");
        mygridPgm.setInitWidths("50,50,50,70,60,70,*,100,60,60,50,40,50,70,70")
        mygridPgm.setColTypes("ch,ro,ro,ro,ro,ro,ro,link,link,ro,ro,ro,ro,ro,ro");
		mygridPgm.setColSorting("str,int,str,int,str,str,str,str,str,str,str,int,str,str,str");

		mygridPgm.enableSmartRendering(false);
        mygridPgm.enableMultiselect(true);

        //mygridPgm.splitAt(5);//'freezes' 0 columns // ROW선택 이벤트
        mygridPgm.init();

        //mygridPgm.setColumnHidden(0,true); //PJTSEQ
        //mygridPgm.setColumnHidden(1,true); //PGMSEQ

        mygridPgm.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){

            RowEditStatus = mygridPgm.getUserData(rId,"!nativeeditor_status");
            if(stage == 2
                && RowEditStatus != "inserted"
                && RowEditStatus != "deleted"
                && nValue != oValue
                ){
                if(RowEditStatus == "") {
                    mygridPgm.setUserData(rId,"!nativeeditor_status","updated");
                    mygridPgm.setRowTextBold(rId);
                }
                mygridPGM.cells(rId,cInd).cell.wasChanged = true;
            }
            return true;

        });


		alog("initBody-----------------------------end");

    }//initBody();
