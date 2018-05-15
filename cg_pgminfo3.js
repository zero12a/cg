    function Make(pgmtype) {
        window.open( "./make/cg_make.php?pjtseq=" + $("#F_PJTSEQ").val() + "&pgmseq=" + $("#F_PGMSEQ").val()+ "&pgmtype=" + pgmtype ) ;
    }


    function MakeAsync(token){

        //불러오기
        var types = ["HTML","HTMLJS","SVRCTL","SVRSVC","SVRDAO"];

        //요청 토큰
        var token = uuidv4();

        for(i=0;i<types.length;i++){
            alog("MakeAsync = "  + types[i]);
            pgmtype =  types[i];
            $.ajax({
                type : "GET",
                url : "./make/cg_make.php?TOKEN=" + token + "&pjtseq=" + $("#F_PJTSEQ").val() + "&pgmseq=" + $("#F_PGMSEQ").val()+ "&pgmtype=" + pgmtype,
                dataType : "json",
                async: true,
                success: function(data){
                    alog(" Return : " + data.RTN_CD + " / " + data.RTN_MSG);
                    msgNotice(data.RTN_MSG,10);
                },
                error: function(error){
                    msgError("MakeAsync() Ajax http 500 error ( " + error + " )");
                }
            });    
        }

        msgNotice(types.length + "개 비동기 요청 완료",1);
    }
    function Run() {
        if($("#F_PGMURL").val() == ""){
            alert("조회조건에 URL을 입력해 주세요.")
        }else{
            window.open("./rst/" + $("#F_PGMURL").val() );
        }
        
    }
    function SourceView() {
        window.open("cg_viewtab.php?pgmseq=" + $("#F_PGMSEQ").val());
    }

    function search1(){
        //폼값 밸리데이션
        if( !jsonFormValid(obj_condition_valid.F_PJTID, "F_PJTID", "프로젝트ID", $("#F_PJTID").val()) ){return false;};
        if( !jsonFormValid(obj_condition_valid.F_PGMID, "F_PGMID", "프로그램ID", $("#F_PGMID").val()) ){return false;};


        //폼의 모든값 구하기
        var ConAllData = $( "#condition1" ).serialize();
        alog("ConAllData:" + ConAllData);

        lastCondition = ConAllData;


		lastinput1 = ConAllData;
		lastinput2 = ConAllData;


		//KEY컬럼만 자식에게 전달(grp)
		lastinput1json = jQuery.parseJSON('{ "__NAME":"lastinput1json"' +
			', "PJTSEQ" : "' + q($("#F_PJTSEQ").val()) + '"' +
			', "PGMSEQ" : "' + q($("#F_PGMSEQ").val()) + '"' +
			'}');

		//KEY컬럼만 자식에게 전달(sql)
		lastinput2json = jQuery.parseJSON('{ "__NAME":"lastinput2json"' +
			', "PJTSEQ" : "' + q($("#F_PJTSEQ").val()) + '"' +
			', "PGMSEQ" : "' + q($("#F_PGMSEQ").val()) + '"' +
			'}');

        //그리드 조회
        gridSearch1(ConAllData);

        //그리드 조회
        gridSearch2(ConAllData);


        //코드미러 비우기
        codemirrorInit();
    }

    function codemirrorInit(){
        if(cm){
            cm.setValue("");;
            cm.setOption("readOnly",true);
        }
    }

	//행추가1 (group)
	function addRow1(){
		if( !(lastinput1json) || !(lastinput1json.PJTSEQ) || !(lastinput1json.PGMSEQ) ){
			msgError("조회 후에 행추가 가능합니다",3);
		}else{
			var tCols = [lastinput1json.PJTSEQ,lastinput1json.PGMSEQ];//초기값
			addRow(mygridGrp,tCols);
		}
	}

	//행추가2 (sql)
	function addRow2(){
		if( !(lastinput2json) || !(lastinput2json.PJTSEQ) || !(lastinput2json.PGMSEQ)  ){
			msgError("조회 후에 행추가 가능합니다",3);
		}else{
			var tCols = [lastinput2json.PJTSEQ,lastinput2json.PGMSEQ];//초기값
			addRow(mygridSql,tCols);
		}
	}

	//행추가3 (sql컬럼)
	function addRow3(){
		if( !(lastinput3json) || !(lastinput3json.PJTSEQ) || !(lastinput3json.PGMSEQ)  || !(lastinput3json.SQLSEQ) ){
			msgError("조회 후에 행추가 가능합니다",3);
		}else{
			var tCols = ["",lastinput3json.PJTSEQ,lastinput3json.PGMSEQ,lastinput3json.SQLSEQ];//초기값
			addRow(mygridCol,tCols);
		}
	}

	//행추가4 (io)
	function addRow4(){
		if( !(lastinput4json) || !(lastinput4json.PJTSEQ) || !(lastinput4json.PGMSEQ)  || !(lastinput4json.GRPSEQ)  ){
			msgError("조회 후에 행추가 가능합니다",3);
		}else{
			var tCols = [lastinput4json.PJTSEQ,lastinput4json.PGMSEQ,lastinput4json.GRPSEQ];//초기값
			addRow(mygridIo,tCols);
		}
	}

	//행추가5 (fnc)
	function addRow5(){
		if( !(lastinput5json) || !(lastinput5json.PJTSEQ) || !(lastinput5json.PGMSEQ)  || !(lastinput5json.GRPSEQ)  ){
			msgError("조회 후에 행추가 가능합니다",3);
		}else{
			var tCols = [lastinput5json.PJTSEQ,lastinput5json.PGMSEQ,lastinput5json.GRPSEQ];//초기값
			addRow(mygridFnc,tCols);
		}
	}

	//행추가6 (inherit)
	function addRow6(){
		if( !(lastinput6json) || !(lastinput6json.PJTSEQ) || !(lastinput6json.PGMSEQ)  || !(lastinput6json.GRPSEQ)  ){
			msgError("조회 후에 행추가 가능합니다",3);
		}else{
			var tCols = ["",lastinput6json.PJTSEQ,lastinput6json.PGMSEQ,lastinput6json.GRPSEQ];//초기값
			addRow(mygridInherit,tCols);
		}
	}

	//행추가7 (sqlr)
	function addRow7(){
		if( !(lastinput7json) || !(lastinput7json.PJTSEQ) || !(lastinput7json.PGMSEQ)  || !(lastinput7json.SVCSEQ)  ){
			msgError("조회 후에 행추가 가능합니다",3);
		}else{
			var tCols = [null,lastinput7json.PJTSEQ,lastinput7json.PGMSEQ,lastinput7json.SVCSEQ];//초기값
			addRow(mygridSqlR,tCols);
		}
	}


	//행추가8 (valid)
	function addRow8(){
		if( !(lastinput8json) || !(lastinput8json.PJTSEQ) || !(lastinput8json.PGMSEQ)  || !(lastinput8json.GRPSEQ) || !(lastinput8json.FNCSEQ)  ){
			msgError("조회 후에 행추가 가능합니다",3);
		}else{
			var tCols = [null,lastinput8json.PJTSEQ,lastinput8json.PGMSEQ,lastinput8json.GRPSEQ,lastinput8json.FNCSEQ];//초기값
			addRow(mygrid8,tCols);
		}
	}

	//행추가9 (svc)
	function addRow9(){
		if( !(lastinput9json) || !(lastinput9json.PJTSEQ) || !(lastinput9json.PGMSEQ)  || !(lastinput9json.GRPSEQ) || !(lastinput9json.FNCSEQ)  ){
			msgError("조회 후에 행추가 가능합니다",3);
		}else{
			var tCols = [null,lastinput9json.PJTSEQ,lastinput9json.PGMSEQ,lastinput9json.GRPSEQ,lastinput9json.FNCSEQ];//초기값
			addRow(mygridSvc,tCols);
		}
	}





    //그리드 조회
    function selectLayout(tinput){
        alog("selectLayout()------------start");
		var x = window.dhx4.absLeft(tinput);
		var y = window.dhx4.absTop(tinput);
		var w = tinput.offsetWidth;
		var h = tinput.offsetHeight;

        //$("#div_layout").show();

		if(popSelectLayout){
			popSelectLayout.show(x,y,w,h);
			return;
		}


		if(!isLayoutLoaded){

			//불러오기
			$.ajax({
				type : "POST",
				url : mygridInherit_url+"&G6_CRUD_MODE=read&" + lastCondition ,
				data : {xmldata : ""},
				dataType: "json",
				async: true,
				success: function(data){
					alog("   gridSearch1 json return----------------------");
					alog("   json data : " + data);
					alog("   json RTN_CD : " + data.RTN_CD);
					alog("   json ERR_CD : " + data.ERR_CD);
					//alog("   json RTN_MSG length : " + data.RTN_MSG.length);

					//그리드에 데이터 반영
					if(data.RTN_CD == "200"){
						alog(JSON.stringify(data.RTN_DATA));

						var tmp="";

                        
						for(var i=0;i<data.RTN_DATA.rows.length;i++){
							alog( "   i : " + i);

							//내 행 업데이트
							tmp = tmp + "<a href=\"#\" onclick=\"selectLayoutD('" + data.RTN_DATA.rows[i].data[0] + "')\"><img src=\"./img/" + data.RTN_DATA.rows[i].data[0] +  ".png\" width=50 border=1></a> ";//LAYOUTID

						}
						//내 행 업데이트
						tmp = tmp + "<a href=\"#\" onclick=\"isLayoutLoaded=false;popSelectLayout.hide()\"><img src=\"./img/close.png\" border=0 width=15></a>";//LAYOUTID

						isLayoutLoaded=true;

						//팝업 객체 띄우기
						popSelectLayout = new dhtmlXPopup();
						popSelectLayout.attachHTML(tmp);

						popSelectLayout.show(x,y,w,h);


					}else{
						msgError("서버 조회중 에러가 발생했습니다.\nRTN_CD : " + data.RTN_CD + "\nERR_CD : " + data.ERR_CD + "\nRTN_MSG :" + data.RTN_MSG,3);
					}


				},
				error: function(error){
					msgError("Ajax http 500 error ( " + error + " )");
					alog("Ajax http 500 error ( " + error + " )");
				}
			});
		}else{
			alog("이미지 레이아웃 로딩함");
		}
        alog("selectLayout()------------end");
    }

    //그리드 조회
    function selectLayoutD(tlayoutid){
        alog("selectLayoutD()------------start");
        alog("	tlayoutid : " + tlayoutid);

        $("#div_layout").hide();
		if(tlayoutid=="")return;

        //기존 행이 있는지 검사해서 삭제 여부 묻기
        if(mygridGrp.getRowsNum() > 0 && !confirm("이미 등록된 행이 있습니다. 삭제 후 재등록 하시겠습니까?")){return}

        //조회후에 선택 가능
        if(!lastinput1json || !lastinput1json.PJTSEQ ){
            alert("프로그램 조회 후에 레이아웃 선택가능합니다.");
            return;
        }
        
        mygridGrp.clearAll();

        //불러오기
        $.ajax({
            type : "POST",
            url : mygridInherit_url+"&G6_CRUD_MODE=read2&" + lastCondition ,
            data : {xmldata : "", F_LAYOUTID : tlayoutid},
            dataType: "json",
            async: true,
            success: function(data){
                alog("   gridSearch1 json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
                    alog(JSON.stringify(data.RTN_DATA));

                    var tCols;
                    $("#spanGrpCnt").text(data.RTN_DATA.rows.length);

                    for(var i=0;i<data.RTN_DATA.rows.length;i++){
                        alog( "   i : " + i);

						//GRP : PJTID,PGMID,GRPID,GRPTYPE,GRPNM		,GRPORD,FREEZECNT,COLBRCNT,REFGRPID,VBOX		,GRPWIDTH,GRPHEIGHT,GRPPADDING,ADDDT,MODDT
                        //LAYOUT : GRPID,GRPTYPE,ORD,REFGRPID,VBOX,GRPWIDTH,GRPHEIGHT
                        

                        //GRPID,GRPTYPE,ORD,REFGRPID,VBOX,GRPWIDTH,GRPHEIGHT
						tCols = [
							lastinput1json.PJTSEQ   //1
                            ,lastinput1json.PGMSEQ
                            ,null //GRPSEQ
							,data.RTN_DATA.rows[i].data[0] //GRPID
							,data.RTN_DATA.rows[i].data[1] //GRPTYPE
							,"" //GRPNM
							,data.RTN_DATA.rows[i].data[2] //ORD
							,0 //FREEZECNT
							,data.RTN_DATA.rows[i].data[3] //REFGRPID
							,data.RTN_DATA.rows[i].data[4] //VBOX
							,data.RTN_DATA.rows[i].data[5] //GRPWIDTH
							,data.RTN_DATA.rows[i].data[6] //GRPHEIGHT
							,""
							,""
							];//초기값
						
						addRow(mygridGrp,tCols);


                        //내 행 업데이트
                        //$("#div_layout").append("<a href=\"#\" onclick=\"selectLayoutD('" + data.RTN_DATA.rows[i].data[0] + "')\"><img src=\"./img/" + data.RTN_DATA.rows[i].data[0] +  ".png\" width=100></a>");//LAYOUTID


                    }

                }else{
                    msgError("서버 조회중 에러가 발생했습니다.\nRTN_CD : " + data.RTN_CD + "\nERR_CD : " + data.ERR_CD + "\nRTN_MSG :" + data.RTN_MSG,3);
                }


            },
            error: function(error){
				msgError("Ajax http 500 error ( " + error + " )",3);
                alog("Ajax http 500 error ( " + error + " )");
            }
        });

        alog("selectLayoutD()------------end");
    }




    //FNC 
    function getFncCode(){
        alog("getFncCode()------------start");


        //기존 행이 있는지 검사해서 삭제 여부 묻기
        if(mygridFnc.getRowsNum() > 0 && !confirm("이미 등록된 행이 있습니다. 삭제 후 재등록 하시겠습니까?")){return}

        mygridFnc.clearAll();

		//선택된 행의 GRPTYPE 가져오기
		var tFnc = mygridGrp.cells(lastrowid1,mygridGrp.getColIndexById("GRPTYPE")).getValue();
		
		alog("	tFnc :  " + tFnc);

        //불러오기
        $.ajax({
            type : "POST",
            url : mygrid8_url+"&G8_CRUD_MODE=read&" + lastinput5 + "&G1_PCD=FNC" + tFnc ,
            data : {xmldata : ""},
            dataType: "json",
            async: true,
            success: function(data){
                alog("   getFncCode json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
                    alog(JSON.stringify(data.RTN_DATA));

                    var tCols;

                    $("#spanFncCnt").text(data.RTN_DATA.rows.length);

                    for(var i=0;i<data.RTN_DATA.rows.length;i++){
                        alog( "   i : " + i);

						tCols = [
							lastinput5json.PJTSEQ
							,lastinput5json.PGMSEQ
                            ,lastinput5json.GRPSEQ
                            ,null
							,"Y"
							,data.RTN_DATA.rows[i].data[0]
							,data.RTN_DATA.rows[i].data[0]
							,data.RTN_DATA.rows[i].data[1]
							,data.RTN_DATA.rows[i].data[2]
						];//초기값
						
						addRow(mygridFnc,tCols);

                    }

                }else{
                    msgError("서버 조회중 에러가 발생했습니다.\nRTN_CD : " + data.RTN_CD + "\nERR_CD : " + data.ERR_CD + "\nRTN_MSG :" + data.RTN_MSG,3);
                }


            },
            error: function(error){
				msgError("Ajax http 500 error ( " + error + " )",3);
                alog("Ajax http 500 error ( " + error + " )");
            }
        });

        alog("selectLayoutD()------------end");
    }





    //SQL 
    function getSqlCode(){
        alog("getSqlCode()------------start");
        alog("	lastrowid5 : " + lastrowid5);


		tGrid = mygridSqlR;

        //기존 행이 있는지 검사해서 삭제 여부 묻기
        if(tGrid.getRowsNum() > 0 && !confirm("이미 등록된 행이 있습니다. 삭제 후 재등록 하시겠습니까?")){return}

        tGrid.clearAll();

		//선택된 행의 GRPTYPE 가져오기
		var tCrud = mygridFnc.cells(lastrowid5,mygridFnc.getColIndexById("FNCTYPE")).getValue();
		
		alog("	tCrud :  " + tCrud);

		//alert(tCrud.length);
		//return;

        var tStr = "";
        $("#spanSqlrCnt").text(tCrud.length);

		for(var i=0;i<tCrud.length;i++){
			alog( "   i : " + i);
			tStr = tCrud.substring(i,i+1);
			//SEQ,PJTID,PGMID,GRPID,FNCID,SQLID,ADDDT,MODDT
			tCols = [
				""
				,lastinput7json.PJTSEQ
				,lastinput7json.PGMSEQ
				,lastinput7json.GRPSEQ
				,lastinput7json.FNCSEQ
				,""
			];//초기값
			
			addRow(tGrid,tCols);

		}


        alog("selectLayoutD()------------end");
    }



    //SQL에서 Output컬럼 뽑아내기 
    function getColOutput(){
        alog("getColOutput()------------start");
        alog("	lastrowid4 : " + lastrowid4);


		grpGrid = mygridGrp; //GRP그리드
		sqlGrid = mygridSql; //SQL그리드
		toGrid = mygridIo; //IO그리드


		if(grpGrid.getSelectedRowId() == null){
			alert("(getColOutput)그룹을 먼저 선택해 주세요");
			return;
		}

		if(sqlGrid.getSelectedRowId() == null){
			alert("(getColOutput)컬럼을 추출할 SQL을 선택해 주세요");
			return;
		}

        //기존 행이 있는지 검사해서 삭제 여부 묻기
        if(toGrid.getRowsNum() > 0 && !confirm("(getColOutput)이미 등록된 행이 있습니다. 삭제 후 재등록 하시겠습니까?")){return}

        toGrid.clearAll();

        //불러오기
        $.ajax({
            type : "POST",
            url : mygridGrp1_url+"&G11_CRUD_MODE=read&" + lastinput4 + "&G2_SQLSEQ=" + sqlGrid.getSelectedRowId(),
            data : {xmldata : ""},
            dataType: "json",
            async: true,
            success: function(data){
                alog("   getFncCode json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
                    alog(JSON.stringify(data.RTN_DATA));

                    var tCols;
                    
                    $("#spanIoCnt").text(data.RTN_DATA.rows.length);

                    for(var i=0;i<data.RTN_DATA.rows.length;i++){
                        alog( "   i : " + i);


						//PJTSEQ,PGMSEQ,GRPSEQ,IOSEQ,COLID,COLORD,COLNM,DATATYPE,VALIDSEQ,DATASIZE,OBJTYPE,BRYN,LBLHIDDENYN,LBLWIDTH,OBJWIDTH,OBJHEIGHT,OBJALIGN,KEYYN,SEQYN,HIDDENYN,EDITYN,FNINIT
                        tCols = [
							lastinput4json.PJTSEQ
							,lastinput4json.PGMSEQ
							,lastinput4json.GRPSEQ
                            ,"" //IOSEQ
                            ,data.RTN_DATA.rows[i].data[0] //DDSEQ
							,data.RTN_DATA.rows[i].data[1] //COLID
							,data.RTN_DATA.rows[i].data[2] //COLORD
							,data.RTN_DATA.rows[i].data[3] //COLNM
                            ,data.RTN_DATA.rows[i].data[4] //DATATYPE
							,data.RTN_DATA.rows[i].data[5] //VALIDSEQ                            
							,data.RTN_DATA.rows[i].data[6] //DATASIZE
                            ,data.RTN_DATA.rows[i].data[7] //OBJTYPE
                            ,data.RTN_DATA.rows[i].data[8] //POPUP
							,"N" //BRYN
							,"N" //LBLHIDDENYN
                            ,data.RTN_DATA.rows[i].data[9] //LBLWIDTH
                            ,data.RTN_DATA.rows[i].data[10] //LBLALIGN
							,data.RTN_DATA.rows[i].data[11] //OBJWIDTH
                            ,data.RTN_DATA.rows[i].data[12] //OBJHEIGHT
                            ,data.RTN_DATA.rows[i].data[13] //OBJALIGN
							,"N" //KEYYN
							,"N" //SEQYN
							,"N" //HIDDENYN
							,"Y" //EDITYN
						];//초기값
						
						addRow(toGrid,tCols);

                    }

                }else{
                    msgError("서버 조회중 에러가 발생했습니다.\nRTN_CD : " + data.RTN_CD + "\nERR_CD : " + data.ERR_CD + "\nRTN_MSG :" + data.RTN_MSG,3);
                }


            },
            error: function(error){
				msgError("Ajax http 500 error ( " + error + " )",3);
                alog("Ajax http 500 error ( " + error + " )");
            }
        });


        alog("selectLayoutD()------------end");
    }





    //그리드 조회 (pgm)
    function gridSearchPgm(tinput){
        alog("gridSearchPgm()------------start");

        //그리드 초기화
        mygridPgm.clearAll();

        //불러오기
        $.ajax({
            type : "POST",
            url : mygridPgm_url+"&PGM_CRUD_MODE=read&" + tinput ,
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


    //그리드 조회
    function gridSearch1(tinput){
        alog("gridSearch1()------------start");

        //그리드 초기화
        mygridGrp.clearAll();

        //불러오기
        $.ajax({
            type : "POST",
            url : mygridGrp_url+"&G1_CRUD_MODE=read&" + tinput ,
            data : {xmldata : ""},
            dataType: "json",
            async: true,
            success: function(data){
                alog("   gridSearch1 json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){

					var row_cnt = 0;
					if(data.RTN_DATA){

                        $("#spanGrpCnt").text(data.RTN_DATA.rows.length);     

						mygridGrp.parse(data.RTN_DATA,"json");
						row_cnt = data.RTN_DATA.rows.length;
					}
					msgNotice("[GRP] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("GRP] 서버 조회중 에러가 발생했습니다.\nRTN_CD : " + data.RTN_CD + "\nERR_CD : " + data.ERR_CD + "\nRTN_MSG :" + data.RTN_MSG,3);
                }


            },
            error: function(error){
				msgError("GRP] Ajax http 500 error ( " + error + " )",3);
                alog("GRP] Ajax http 500 error ( " + error + " )");
            }
        });

        alog("gridSearch1()------------end");
    }

    //그리드 조회
    function gridSearch2(tinput){
        alog("gridSearch2()------------start");

        //그리드 초기화
        mygridSql.clearAll();

        //불러오기
        $.ajax({
            type : "POST",
            url : mygridSql_url+"&G2_CRUD_MODE=read&" + tinput ,
            data : {xmldata : ""},
            dataType: "json",
            async: true,
            success: function(data){
                alog("   gridSearch2 json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
					var row_cnt = 0;
					if(data.RTN_DATA){
                        $("#spanSqlCnt").text(data.RTN_DATA.rows.length);

						mygridSql.parse(data.RTN_DATA,"json");
						row_cnt = data.RTN_DATA.rows.length;
					}

					msgNotice("[SQL] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[SQL] 서버 조회중 에러가 발생했습니다.\nRTN_CD : " + data.RTN_CD + "\nERR_CD : " + data.ERR_CD + "\nRTN_MSG :" + data.RTN_MSG,3);
                }


            },
            error: function(error){
				msgError("[SQL] Ajax http 500 error ( " + error + " )",3);
                alog("[SQL] Ajax http 500 error ( " + error + " )");
            }
        });

        alog("gridSearch2()------------end");
    }

    //그리드 조회
    function gridSearch3(tinput){
        alog("gridSearch3()------------start");

        //그리드 초기화
        mygridCol.clearAll();

        //불러오기
        $.ajax({
            type : "POST",
            url : mygridCol_url+"&G3_CRUD_MODE=read&" + tinput ,
            data : {xmldata : ""},
            dataType: "json",
            async: true,
            success: function(data){
                alog("   gridSearch3 json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
					var row_cnt = 0;
					if(data.RTN_DATA){
                        $("#spanColCnt").text(data.RTN_DATA.rows.length);

						mygridCol.parse(data.RTN_DATA,"json");
						row_cnt = data.RTN_DATA.rows.length;
					}
					msgNotice("[SQL COLUMN] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[SQL COLUMN] 서버 조회중 에러가 발생했습니다.\nRTN_CD : " + data.RTN_CD + "\nERR_CD : " + data.ERR_CD + "\nRTN_MSG :" + data.RTN_MSG,3);
                }


            },
            error: function(error){
				msgError("[SQL COLUMN] Ajax http 500 error ( " + error + " )",3);
                alog("[SQL COLUMN] Ajax http 500 error ( " + error + " )");
            }
        });

        alog("gridSearch3()------------end");
    }


	//그리드 다시 조회
	function gridReload4(){
		gridSearch4(lastinput4);
	}

	//그리드 다시 조회
	function gridReload2(){
        gridSearch2(lastinput2);
        
        codemirrorInit();//코드미러 비우기
	}

    //그리드 조회
    function gridSearch4(tinput){
        alog("gridSearch4()------------start");

        //그리드 초기화
        mygridIo.clearAll();

        //불러오기
        $.ajax({
            type : "POST",
            url : mygridIo_url+"&G4_CRUD_MODE=read&" + tinput ,
            data : {xmldata : ""},
            dataType: "json",
            async: true,
            success: function(data){
                alog("   gridSearch4 json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
					var row_cnt = 0;
					if(data.RTN_DATA){
                        $("#spanIoCnt").text(data.RTN_DATA.rows.length);

						mygridIo.parse(data.RTN_DATA,"json");
                        row_cnt = data.RTN_DATA.rows.length;
                        

                        //Inherit Colid콤보 재생성하기
                        tCombo = mygridInherit.getCombo(mygridInherit.getColIndexById("COLID"));
                        tCombo.clear(); //비우기
                        tCombo.put("","");
    
                        for(var i=0;i<data.RTN_DATA.rows.length;i++){
                            alog(data.RTN_DATA.rows[i].data[5] + "=" + data.RTN_DATA.rows[i].data[7]);
    
                            tCombo.put(data.RTN_DATA.rows[i].data[5],data.RTN_DATA.rows[i].data[7]);
                        }
					}
					msgNotice("[IO] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[IO] 서버 조회중 에러가 발생했습니다.\nRTN_CD : " + data.RTN_CD + "\nERR_CD : " + data.ERR_CD + "\nRTN_MSG :" + data.RTN_MSG,3);
                }


            },
            error: function(error){
				msgError("[IO] Ajax http 500 error ( " + error + " )",3);
                alog("[IO] Ajax http 500 error ( " + error + " )");
            }
        });

        alog("gridSearch4()------------end");
    }


    //그리드 조회(FNC)
    function gridSearch5(tinput){
        alog("gridSearch5()------------start");

        //그리드 초기화
        mygridFnc.clearAll();

        //불러오기
        $.ajax({
            type : "POST",
            url : mygridSqlR_url+"&G7_CRUD_MODE=read&" + tinput ,
            data : {xmldata : ""},
            dataType: "json",
            async: true,
            success: function(data){
                alog("   gridSearch5 json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
					var row_cnt = 0;
					if(data.RTN_DATA){
                        $("#spanFncCnt").text(data.RTN_DATA.rows.length);

						mygridFnc.parse(data.RTN_DATA,"json");
						row_cnt = data.RTN_DATA.rows.length;
					}
					msgNotice("[FNC] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[FNC] 서버 조회중 에러가 발생했습니다.\nRTN_CD : " + data.RTN_CD + "\nERR_CD : " + data.ERR_CD + "\nRTN_MSG :" + data.RTN_MSG,3);
                }


            },
            error: function(error){
				msgError("[FNC] Ajax http 500 error ( " + error + " )",3);
                alog("[FNC] Ajax http 500 error ( " + error + " )");
            }
        });

        alog("gridSearch5()------------end");
    }




    //그리드 조회(INHERIT)
    function gridSearch6(tinput){
        alog("gridSearch6()------------start");

		var tGrid = mygridInherit;

        //그리드 초기화
        tGrid.clearAll();

        //불러오기
        $.ajax({
            type : "POST",
            url : mygridSvc_url+"&G9_CRUD_MODE=read&" + tinput ,
            data : {xmldata : ""},
            dataType: "json",
            async: true,
            success: function(data){
                alog("   gridSearch6 json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
					var row_cnt = 0;
					if(data.RTN_DATA){
                        $("#spanInheritCnt").text(data.RTN_DATA.rows.length);

						tGrid.parse(data.RTN_DATA,"json");
						row_cnt = data.RTN_DATA.rows.length;
					}
					msgNotice("[INHERIT] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[INHERIT] 서버 조회중 에러가 발생했습니다.\nRTN_CD : " + data.RTN_CD + "\nERR_CD : " + data.ERR_CD + "\nRTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[INHERIT] Ajax http 500 error ( " + error + " )",3);
                alog("[INHERIT] Ajax http 500 error ( " + error + " )");
            }
        });

        alog("gridSearch6()------------end");
    }





    //그리드 조회(SQLR)
    function gridSearch7(tinput){
        alog("gridSearch7()------------start");

		var tGrid = mygridSqlR;

        //그리드 초기화
        tGrid.clearAll();

        //불러오기
        $.ajax({
            type : "POST",
            url : mygridGrp0_url+"&G10_CRUD_MODE=read&" + tinput ,
            data : {xmldata : ""},
            dataType: "json",
            async: true,
            success: function(data){
                alog("   gridSearch6 json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
					var row_cnt = 0;
					if(data.RTN_DATA){
                        $("#spanSqlrCnt").text(data.RTN_DATA.rows.length);

						tGrid.parse(data.RTN_DATA,"json");
						row_cnt = data.RTN_DATA.rows.length;
					}
					msgNotice("[SQLR] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[SQLR] 서버 조회중 에러가 발생했습니다.\nRTN_CD : " + data.RTN_CD + "\nERR_CD : " + data.ERR_CD + "\nRTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[SQLR] Ajax http 500 error ( " + error + " )",3);
                alog("[SQLR] Ajax http 500 error ( " + error + " )");
            }
        });

        alog("gridSearch7()------------end");
    }

   


    //그리드 조회(SVC)
    function gridSearch9(tinput){
        alog("gridSearch9()------------start");

		var tGrid = mygridSvc;

        //그리드 초기화
        tGrid.clearAll();

        //불러오기
        $.ajax({
            type : "POST",
            url : mygridGrp3_url+"&G13_CRUD_MODE=read&" + tinput ,
            data : {xmldata : ""},
            dataType: "json",
            async: true,
            success: function(data){
                alog("   gridSearch9 json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
					var row_cnt = 0;
					if(data.RTN_DATA){
                        $("#spanSvcCnt").text(data.RTN_DATA.rows.length);

						tGrid.parse(data.RTN_DATA,"json");
						row_cnt = data.RTN_DATA.rows.length;
					}
					msgNotice("[SVC] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[SVC] 서버 조회중 에러가 발생했습니다.\nRTN_CD : " + data.RTN_CD + "\nERR_CD : " + data.ERR_CD + "\nRTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[SVC] Ajax http 500 error ( " + error + " )",3);
                alog("[SVC] Ajax http 500 error ( " + error + " )");
            }
        });

        alog("gridSearch9()------------end");
    }





    function addRow1Layout(tGRPID,tGRPTYPE,tGRPORD,tVBOX,tGRPWIDTH,tGRPHEIGHT){
        alog("addRow1Layout()------------start");
        var id=mygridGrp.uid();
		var tREFGRPID = "";
		if(tGRPORD > 1)tREFGRPID = "GRP" + (tGRPORD-1);
        mygridGrp.addRow(id,["GRP"+tGRPORD,tGRPTYPE,tGRPTYPE+tGRPORD,tGRPORD,0,0,tREFGRPID,tVBOX,tGRPWIDTH,tGRPHEIGHT],0);
        mygridGrp.showRow(id);
        mygridGrp.selectRow(0);
        mygridGrp.cells(id,0).cell.wasChanged = true;
        mygridGrp.setUserData(id,"!nativeeditor_status","inserted");
        mygridGrp.setRowTextBold(id);
        addstatusyn1 = true;
        alog("addRow1Layout()------------end");
    }


    function saveAll(){
        alog("saveAll()------------start");
        save1();
        save2();
        save3();
        save4();
        addstatusyn1 = false;
        addstatusyn2 = false;
        addstatusyn3 = false;
        addstatusyn4 = false;
        alog("saveAll()------------end");
    }

    function view1(){
        if(isView1){
            isView1 = false;
            mygridGrp.setColumnHidden(0,true); //PJTSEQ
            mygridGrp.setColumnHidden(1,true); //PGMSEQ
            mygridGrp.setColumnHidden(2,true); //GRPSEQ
        }else{
            isView1 = true;
            mygridGrp.setColumnHidden(0,false); //PJTSEQ
            mygridGrp.setColumnHidden(1,false); //PGMSEQ
            mygridGrp.setColumnHidden(2,false); //GRPSEQ
        }

    }

    function save1(){
        alog("save1()------------start");
        //serialize user data or not,
        //serialize 'selected' attribute for the rows tags,
        //serialize grid structure info,
        //serialize the 'changed' attribute for the cells tags,
        //include just changed rows to serialization,
        //serialize cell values as CDATA sections
	
		tgrid = mygridGrp;

        tgrid.setSerializationLevel(true,false,false,false,true,false);
        //mygridIo.serialize();
        var myXmlString = tgrid.serialize();

        tgrid.setSerializationLevel(true,false,false,false,false,false);
        //mygridIo.serialize();
        var myXmlString2 = tgrid.serialize();

        //alog("xml : " + myXmlString);

        //컨디션 데이터 모두 말기
        var ConAllData = $( "#condition1" ).serialize();
        alog("   ConAllData = " + ConAllData);

        var xml = myXmlString;
        xml = xml.replace(new RegExp("<row","g"),"\n<row");
        xml = xml.replace(new RegExp("</row","g"),"\n</row");
        xml = xml.replace(new RegExp("<cell","g"),"\n\t<cell");

        var xml2 = myXmlString2;
        xml2 = xml2.replace(new RegExp("<row","g"),"\n<row");
        xml2 = xml2.replace(new RegExp("</row","g"),"\n</row");
        xml2 = xml2.replace(new RegExp("<cell","g"),"\n\t<cell");

       //$("#tt").val(xml);
        //$("#tt2").val(xml2);

        $.ajax({
            type : "POST",
            url : mygridGrp_url+"&G1_CRUD_MODE=SAVE&" + lastinput2 ,
            data : {xmldata : myXmlString},
            dataType: "json",
            async: false,
            success: function(data){
                alog("   json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                saveToGrid(tgrid,data);

            },
            error: function(error){
				msgError("Ajax http 500 error ( " + error + " )");
                alog("Ajax http 500 error ( " + error + " )");
            }
        });

        addstatusyn2 = false;
        alog("save1()------------end");
    }


    function save2(){
        alog("save2()------------start");
        //serialize user data or not,
        //serialize 'selected' attribute for the rows tags,
        //serialize grid structure info,
        //serialize the 'changed' attribute for the cells tags,
        //include just changed rows to serialization,
        //serialize cell values as CDATA sections

        mygridSql.setSerializationLevel(true,false,false,false,true,false);
        //mygridIo.serialize();
        var myXmlString = mygridSql.serialize();

        mygridSql.setSerializationLevel(true,false,false,false,false,false);
        //mygridIo.serialize();
        var myXmlString2 = mygridSql.serialize();

        //alog("xml : " + myXmlString);

        //컨디션 데이터 모두 말기
        var ConAllData = $( "#condition1" ).serialize();
        alog("   ConAllData = " + ConAllData);

        var xml = myXmlString;
        xml = xml.replace(new RegExp("<row","g"),"\n<row");
        xml = xml.replace(new RegExp("</row","g"),"\n</row");
        xml = xml.replace(new RegExp("<cell","g"),"\n\t<cell");

        var xml2 = myXmlString2;
        xml2 = xml2.replace(new RegExp("<row","g"),"\n<row");
        xml2 = xml2.replace(new RegExp("</row","g"),"\n</row");
        xml2 = xml2.replace(new RegExp("<cell","g"),"\n\t<cell");

        //$("#tt").val(xml);
        //$("#tt2").val(xml2);

        $.ajax({
            type : "POST",
            url : mygridSql_url+"&G2_CRUD_MODE=SAVE&" + lastinput2 ,
            data : {xmldata : myXmlString},
            dataType: "json",
            async: false,
            success: function(data){
                alog("   json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                saveToGrid(mygridSql,data);

            },
            error: function(error){
				msgError("Ajax http 500 error ( " + error + " )");
                alog("Ajax http 500 error ( " + error + " )");
            }
        });

        addstatusyn2 = false;
        alog("save2()------------end");
    }


    function save3(){
        alog("save3()------------start");
        //serialize user data or not,
        //serialize 'selected' attribute for the rows tags,
        //serialize grid structure info,
        //serialize the 'changed' attribute for the cells tags,
        //include just changed rows to serialization,
        //serialize cell values as CDATA sections

        mygridCol.setSerializationLevel(true,false,false,false,true,false);
        //mygridIo.serialize();
        var myXmlString = mygridCol.serialize();


        //alog("xml : " + myXmlString);

        //컨디션 데이터 모두 말기
        var ConAllData = $( "#condition1" ).serialize();
        alog("   ConAllData = " + ConAllData);

        var xml = myXmlString;
        xml = xml.replace(new RegExp("<row","g"),"\n<row");
        xml = xml.replace(new RegExp("</row","g"),"\n</row");
        xml = xml.replace(new RegExp("<cell","g"),"\n\t<cell");

        //$("#tt").val(xml);


        $.ajax({
            type : "POST",
            url : mygridCol_url+"&G3_CRUD_MODE=SAVE&" + lastinput3 ,
            data : {xmldata : myXmlString},
            dataType: "json",
            async: false,
            success: function(data){
                alog("   json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                saveToGrid(mygridCol,data);

            },
            error: function(error){
				msgError("Ajax http 500 error ( " + error + " )");
                alog("Ajax http 500 error ( " + error + " )");
            }
        });

        addstatusyn3 = false;
        alog("save3()------------end");
    }



    function view5(){
        if(isView5){
            isView5 = false;
            mygridFnc.setColumnHidden(0,true); //PJTSEQ
            mygridFnc.setColumnHidden(1,true); //PGMSEQ
            mygridFnc.setColumnHidden(2,true); //GRPSEQ
            mygridFnc.setColumnHidden(3,true); //FNCSEQ
        }else{
            isView5 = true;
            mygridFnc.setColumnHidden(0,false); //PJTSEQ
            mygridFnc.setColumnHidden(1,false); //PGMSEQ
            mygridFnc.setColumnHidden(2,false); //GRPSEQ
            mygridFnc.setColumnHidden(3,false); //FNCSEQ
        }
    }

    function save5(){
        alog("save5()------------start");

        mygridFnc.setSerializationLevel(true,false,false,false,true,false);
        var myXmlString = mygridFnc.serialize();

		//컨디션 데이터 모두 말기
        var ConAllData = $( "#condition1" ).serialize();
        alog("   ConAllData = " + ConAllData);

        var xml = myXmlString;
        xml = xml.replace(new RegExp("<row","g"),"\n<row");
        xml = xml.replace(new RegExp("</row","g"),"\n</row");
        xml = xml.replace(new RegExp("<cell","g"),"\n\t<cell");

        //$("#tt").val(xml);

        $.ajax({
            type : "POST",
            url : mygridSqlR_url+"&G7_CRUD_MODE=SAVE&" + lastinput5 ,
            data : {xmldata : myXmlString},
            dataType: "json",
            async: false,
            success: function(data){
                alog("   json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                saveToGrid(mygridFnc,data);
            },
            error: function(error){
				msgError("Ajax http 500 error ( " + error + " )");
                alog("Ajax http 500 error ( " + error + " )");
            }
        });

        addstatusyn3 = false;
        alog("save3()------------end");
    }





    function save6(){
        alog("save6()------------start");

        mygridInherit.setSerializationLevel(true,false,false,false,true,false);
        var myXmlString = mygridInherit.serialize();

		//컨디션 데이터 모두 말기
        var ConAllData = $( "#condition1" ).serialize();
        alog("   ConAllData = " + ConAllData);

        var xml = myXmlString;
        xml = xml.replace(new RegExp("<row","g"),"\n<row");
        xml = xml.replace(new RegExp("</row","g"),"\n</row");
        xml = xml.replace(new RegExp("<cell","g"),"\n\t<cell");

        //$("#tt").val(xml);

        $.ajax({
            type : "POST",
            url : mygridSvc_url+"&G9_CRUD_MODE=SAVE&" + lastinput5 ,
            data : {xmldata : myXmlString},
            dataType: "json",
            async: false,
            success: function(data){
                alog("   json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                saveToGrid(mygridInherit,data);
            },
            error: function(error){
				msgError("[INHERIT SAVE] Ajax http 500 error ( " + error + " )",3);
                alog("Ajax http 500 error ( " + error + " )");
            }
        });

        addstatusyn6 = false;
        alog("save6()------------end");
    }


    function save7(){
        alog("save7()------------start");

        mygridSqlR.setSerializationLevel(true,false,false,false,true,false);
        var myXmlString = mygridSqlR.serialize();

		//컨디션 데이터 모두 말기
        var ConAllData = $( "#condition1" ).serialize();
        alog("   ConAllData = " + ConAllData);

        var xml = myXmlString;
        xml = xml.replace(new RegExp("<row","g"),"\n<row");
        xml = xml.replace(new RegExp("</row","g"),"\n</row");
        xml = xml.replace(new RegExp("<cell","g"),"\n\t<cell");

        //$("#tt").val(xml);

        $.ajax({
            type : "POST",
            url : mygridGrp0_url+"&G10_CRUD_MODE=SAVE&" + lastinput5 ,
            data : {xmldata : myXmlString},
            dataType: "json",
            async: false,
            success: function(data){
                alog("   json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                saveToGrid(mygridSqlR,data);
            },
            error: function(error){
				msgError("[SQLR SAVE] Ajax http 500 error ( " + error + " )",3);
                alog("Ajax http 500 error ( " + error + " )");
            }
        });

        addstatusyn7 = false;
        alog("save7()------------end");
    }


    function save8(){
        alog("save8()------------start");

        mygrid8.setSerializationLevel(true,false,false,false,true,false);
        var myXmlString = mygrid8.serialize();

		//컨디션 데이터 모두 말기
        var ConAllData = $( "#condition1" ).serialize();
        alog("   ConAllData = " + ConAllData);

        var xml = myXmlString;
        xml = xml.replace(new RegExp("<row","g"),"\n<row");
        xml = xml.replace(new RegExp("</row","g"),"\n</row");
        xml = xml.replace(new RegExp("<cell","g"),"\n\t<cell");

        //$("#tt").val(xml);

        $.ajax({
            type : "POST",
            url : mygridGrp2_url+"&G12_CRUD_MODE=SAVE&" + lastinput8 ,
            data : {xmldata : myXmlString},
            dataType: "json",
            async: false,
            success: function(data){
                alog("   json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                saveToGrid(mygridSqlR,data);
            },
            error: function(error){
				msgError("[VALID] Ajax http 500 error ( " + error + " )",3);
                alog("[VALID] Ajax http 500 error ( " + error + " )");
            }
        });

        addstatusyn8 = false;
        alog("save8()------------end");
    }



	//SVC
    function save9(){
        alog("save9()------------start");

        mygridSvc.setSerializationLevel(true,false,false,false,true,false);
        var myXmlString = mygridSvc.serialize();

		//컨디션 데이터 모두 말기
        var ConAllData = $( "#condition1" ).serialize();
        alog("   ConAllData = " + ConAllData);

        var xml = myXmlString;
        xml = xml.replace(new RegExp("<row","g"),"\n<row");
        xml = xml.replace(new RegExp("</row","g"),"\n</row");
        xml = xml.replace(new RegExp("<cell","g"),"\n\t<cell");

       //$("#tt").val(xml);

        $.ajax({
            type : "POST",
            url : mygridGrp3_url+"&G13_CRUD_MODE=SAVE&" + lastinput9 ,
            data : {xmldata : myXmlString},
            dataType: "json",
            async: false,
            success: function(data){
                alog("   json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                saveToGrid(mygridSvc,data);
            },
            error: function(error){
				msgError("[SVC] Ajax http 500 error ( " + error + " )",3);
                alog("[SVC] Ajax http 500 error ( " + error + " )");
            }
        });

        addstatusyn9 = false;
        alog("save9()------------end");
    }


    function view4(){

        if(isView1){
            isView1 = false;
            mygridIo.setColumnHidden(0,true); //PJTSEQ
            mygridIo.setColumnHidden(1,true); //PGMSEQ
            mygridIo.setColumnHidden(2,true); //GRPSEQ
            mygridIo.setColumnHidden(3,true); //IOSEQ
            mygridIo.setColumnHidden(4,true); //DDSEQ
        }else{
            isView1 = true;
            mygridIo.setColumnHidden(0,false); //PJTSEQ
            mygridIo.setColumnHidden(1,false); //PGMSEQ
            mygridIo.setColumnHidden(2,false); //GRPSEQ
            mygridIo.setColumnHidden(3,false); //IOSEQ
            mygridIo.setColumnHidden(4,false); //DDSEQ            
        }

    }

    function save4(){
        alog("save4()------------start");
        //dp4.sendData();


        //serialize user data or not,
        //serialize 'selected' attribute for the rows tags,
        //serialize grid structure info,
        //serialize the 'changed' attribute for the cells tags,
        //include just changed rows to serialization,
        //serialize cell values as CDATA sections

        mygridIo.setSerializationLevel(true,false,false,false,true,false);
        //mygridIo.serialize();
        var myXmlString = mygridIo.serialize();


        //alog("xml : " + myXmlString);

        //컨디션 데이터 모두 말기
        var ConAllData = $( "#condition1" ).serialize();
        alog("   ConAllData = " + ConAllData);

        var xml = myXmlString;
        xml = xml.replace(new RegExp("<row","g"),"\n<row");
        xml = xml.replace(new RegExp("</row","g"),"\n</row");
        xml = xml.replace(new RegExp("<cell","g"),"\n\t<cell");

        //$("#tt").val(xml);


        $.ajax({
            type : "POST",
            url : mygridIo_url+"&G4_CRUD_MODE=save&" + lastinput4 ,
            data : {xmldata : myXmlString},
            dataType: "json",
            async: false,
            success: function(data){
                alog("   json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                saveToGrid(mygridIo,data);

            },
            error: function(error){
				msgError("Ajax http 500 error ( " + error + " )");
                alog("Ajax http 500 error ( " + error + " )");
            }
        });

        addstatusyn4 = false;
        alog("save4()------------end");
    }






    //정적 변수 선언
    var cm;//codemirror
	var popSelectLayout; //레이아웃용
    var myCalendar;
    var lastCondition;
    var mygridGrp,dp1,addstatusyn1,lastinput1,lastinput1json,lastrowid1,isView1;
    var mygridSql,dp2,addstatusyn2,lastinput2,lastinput2json,lastrowid2,isView2;
    var mygridCol,dp3,addstatusyn3,lastinput3,lastinput3json,lastrowid3,isView3;
    var mygridIo,dp4,addstatusyn4,lastinput4,lastinput4json,lastrowid4,isView4;
    var mygridFnc,dp5,addstatusyn5,lastinput5,lastinput5json,lastrowid5,isView5;
    var mygridInherit,dp6,addstatusyn6,lastinput6,lastinput6json,lastrowid6,isView6;
    var mygridSqlR,dp7,addstatusyn7,lastinput7,lastinput7json,lastrowid7,isView7;
    var mygrid8,dp8,addstatusyn8,lastinput8,lastinput8json,lastrowid8,isView8;
    var mygridSvc,dp9,addstatusyn9,lastinput9,lastinput9json,lastrowid9,isView9;
    var mygridPgm,addstatusynPgm,lastinputPgm,lastinputPgmjson,lastrowidPgm;
    var mygridGrp_url = "cg_pgminfo_crud3.php?F_GRPID=1&";
    var mygridSql_url = "cg_pgminfo_crud3.php?F_GRPID=2&";
    var mygridCol_url = "cg_pgminfo_crud3.php?F_GRPID=3&";
    var mygridIo_url = "cg_pgminfo_crud3.php?F_GRPID=4&";
    var mygridFnc_url = "cg_pgminfo_crud3.php?F_GRPID=5&";
    var mygridInherit_url = "cg_pgminfo_crud3.php?F_GRPID=6&";
    var mygridSqlR_url = "cg_pgminfo_crud3.php?F_GRPID=7&";
    var mygrid8_url = "cg_pgminfo_crud3.php?F_GRPID=8&";
    var mygridSvc_url = "cg_pgminfo_crud3.php?F_GRPID=9&";
    var mygridGrp0_url = "cg_pgminfo_crud3.php?F_GRPID=10&";
    var mygridGrp1_url = "cg_pgminfo_crud3.php?F_GRPID=11&"; //IO그리드, COL그리드에서 상속받기
    var mygridGrp2_url = "cg_pgminfo_crud3.php?F_GRPID=12&"; //VALID
    var mygridGrp3_url = "cg_pgminfo_crud3.php?F_GRPID=13&"; //SVC
    var mygridPgm_url = "cg_pgminfo_crud3.php?F_GRPID=PGM&"; //팝업윈도우 프로그램 검색
    var validmsg = jQuery.parseJSON('{"REQUARED":"[0]는 반드시 입력바랍니다.", "MIN":"this는 [0]이상 입력바랍니다."}');

	var isLayoutLoaded = false;
	var myWins;

    //동적 변수 선언
    var obj_condition_valid = jQuery.parseJSON( '{"__NAME":"obj_condition_valid"' +
        ' ,"F_PJTID": {"REQUARED":"N",  "MIN":"0",  "MAX":"ZZZ",  "DATASIZE":10,  "DATATYPE":"STRING"} ' +
        ' ,"F_PGMID": {"REQUARED":"N",  "MIN":"0",  "MAX":"ZZZ",  "DATASIZE":10,  "DATATYPE":"STRING"} ' +
        '}');
    var obj_G4_valid = jQuery.parseJSON( '{"__NAME":"obj_G4_valid"' +
        ' ,"OBJTYPE": {"REQUARED":"N",  "MIN":"0",  "MAX":"ZZZ",  "DATASIZE":10,  "DATATYPE":"STRING"} ' +
        ' ,"F_PGMID": {"REQUARED":"N",  "MIN":"0",  "MAX":"ZZZ",  "DATASIZE":10,  "DATATYPE":"STRING"} ' +
        '}');

	

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


        //컨디션 초기화
        //$("#F_PJTID").val("CG");
        //$("#F_PGMID").val("TEST3");
        $("#F_PJTSEQ").val("3");
        $("#F_PGMSEQ").val("20");

		
		//조건 폼에 ONCHANGE이벤트 붙이기
		$( "#btnPgmSearch1" ).click(function( event ) {
			pgmSearch("F_PGMSEQ");
		});

		//조건 폼에 ONCHANGE이벤트 붙이기
		$( "#F_PGMID" ).keyup(function( event ) {
		  if ( event.which == 13 ) {
			pgmSearch("F_PGMID");
		  }
		});


		//조건 폼에 ONCHANGE이벤트 붙이기
		$( "#F_PGMNM" ).keyup(function( event ) {
		  if ( event.which == 13 ) {
			pgmSearch("F_PGMNM");
		  }
		});

        //날짜 박스 초기
        alog("initBody()---------start")
        myCalendar = new dhtmlXCalendarObject([{input:"F_START_DT",
            button:"F_START_DT_ICON"},{input:"F_END_DT",
            button:"F_END_DT_ICON"}]);

        //코드 미러 초기화
        cm = CodeMirror.fromTextArea(document.getElementById('codem'), {
            mode: "text/x-sql",
            styleActiveLine: true,
            indentWithTabs: true,
            smartIndent: true,
            lineNumbers: true,
            matchBrackets : true,
            tabSize: 4,
            indentUnit: 4,
            indentWithTabs: true,
            extraKeys: {"Ctrl-Space": "autocomplete"},
            readOnly: true,
			hintOptions: {tables: {
			  users: {name: null, score: null, birthDate: null},
			  countries: {name: null, population: null, size: null}
			}}
        });

        cm.on("change", function(cm, change) {
            alog("cm change -------------------------------start");
            alog("    cm.getValue :  (" + cm.getValue() + ")");
            alog("    change.origin : (" + change.origin + ")");
            alog("    change.from : (" + change.to + ")");
            alog("    change.text : (" + change.text + ")");
            alog("    change.removed : (" + change.removed + ")");
            alog("    change.to : (" + change.to + ")");

            //바인드 정보로 리턴하기
            if(change.origin != "setValue"){

                alog("    mygridSql SQLTXT 변경 상태 업데이트. ");
                rid = mygridSql.getSelectedId();
                cidx = mygridSql.getColIndexById("SQLTXT");
                alog("        " + rid + "," + cidx);
                mygridSql.cells(rid,cidx).setValue(cm.getValue());
                mygridSql.cells(rid,cidx).cell.wasChanged = true;
	            RowEditStatus = mygridSql.getUserData(rid,"!nativeeditor_status");
				if( RowEditStatus != "inserted" && RowEditStatus != "deleted"){
					mygridSql.setUserData(rid,"!nativeeditor_status","updated");
					mygridSql.setRowTextBold(rid);
				}	
            }

        });
        cm.on("focus", function() {
            alog("cm focus -------------------------------start");
            rid = mygridSql.getSelectedId();

            alog("       rid : " + rid);

            if(rid == null){
                cm.setOption("readOnly",true);
            }else{
                cm.setOption("readOnly",false);
            }
        });

        cm.on("blur", function() {
            alog("cm blur -------------------------------start");
        });





        //그리드 초기화(PGM)
        mygridPgm = new dhtmlXGridObject('gridPgm');
		mygridPgm.setUserData("","gridTitle","pgm : pgm list"); //글로별 변수에 그리드 타이블 넣기
        mygridPgm.setImagePath("./lib/dhtmlxSuite/codebase/imgs/");
        mygridPgm.setHeader("PJTSEQ,PGMSEQ,PGMID,PGMNM,URL,PGMTYPE,VERDT,차수,ADDDT,MODDT");
        mygridPgm.setColumnIds("PJTSEQ,PGMSEQ,PGMID,PGMNM,VIEWURL,PGMTYPE,VERDT,DEGREE,ADDDT,MODDT");
        mygridPgm.setInitWidths("50,70,70,*,100,60,50,40,70,70")
        mygridPgm.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
		mygridPgm.setColSorting("int,int,str,str,str,str,str,int,str,str");

		mygridPgm.enableSmartRendering(false);
        mygridPgm.enableMultiselect(true);

        //mygridPgm.splitAt(5);//'freezes' 0 columns // ROW선택 이벤트
        mygridPgm.init();

        mygridPgm.setColumnHidden(0,true); //PJTSEQ
        //mygridPgm.setColumnHidden(1,true); //PGMSEQ

        

        mygridPgm.attachEvent("onRowDblClicked",function(rowID,celInd){
            alog("mygridPgm - onRowDblClicked ----------start");
            alog("   rowID = " + rowID);
            alog("   celInd = " + celInd);
			



			$("#F_PGMSEQ").val(q(mygridPgm.cells(rowID,1).getValue()));
			$("#F_PGMID").val(q(mygridPgm.cells(rowID,2).getValue()));
			$("#F_PGMNM").val(q(mygridPgm.cells(rowID,3).getValue()));
            $("#F_PGMURL").val(q(mygridPgm.cells(rowID,4).getValue()));
            $("#F_PGMURL").val(q(mygridPgm.cells(rowID,4).getValue()));

			if(myWins && myWins.window("pgmwindow"))myWins.window("pgmwindow").hide();
			
			return true;
        });
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



        //그리드 초기화(Group)(grp)
        mygridGrp = new dhtmlXGridObject('grid1');
		mygridGrp.setUserData("","gridTitle","grid1 : group list"); //글로별 변수에 그리드 타이블 넣기
        mygridGrp.setImagePath("./lib/dhtmlxSuite/codebase/imgs/");
        mygridGrp.setHeader("PJTSEQ,PGMSEQ,GRPSEQ,GRPID,GRPTYPE,GRPNM,ORD,FREEZECNT,REFGRPID,VBOX,GRPWIDTH,GRPHEIGHT,COLSIZETYPE,ADDDT,MODDT");
        mygridGrp.setColumnIds("PJTSEQ,PGMSEQ,GRPSEQ,GRPID,GRPTYPE,GRPNM,GRPORD,FREEZECNT,REFGRPID,VBOX,GRPWIDTH,GRPHEIGHT,COLSIZETYPE,ADDDT,MODDT");
        mygridGrp.setInitWidths("50,50,40,40,40,50,30,30,40,30,40,40,30,50,50")
        mygridGrp.setColTypes("ed,ed,ro,ed,coro,ed,ed,ed,ed,coro,ed,ed,coro,ro,ro");
		mygridGrp.setColSorting("str,str,str,str,str,int,int,int,int,str,str,str,str,str,str");

		mygridGrp.enableSmartRendering(false);
        mygridGrp.enableMultiselect(true);
		//GRPTYPE 콤보
		setCodeCombo("GRID",mygridGrp.getCombo(mygridGrp.getColIndexById("GRPTYPE")),"GRPTYPE");
        setCodeCombo("GRID",mygridGrp.getCombo(mygridGrp.getColIndexById("COLSIZETYPE")),"COLSIZETYPE");
        setCodeCombo("GRID",mygridGrp.getCombo(mygridGrp.getColIndexById("VBOX")),"VBOX");        
        
        mygridGrp.splitAt(5);//'freezes' 0 columns // ROW선택 이벤트
        mygridGrp.init();

        mygridGrp.setColumnHidden(0,true); //PJTSEQ
        mygridGrp.setColumnHidden(1,true); //PGMSEQ
        mygridGrp.setColumnHidden(2,true); //GRPSEQ

        mygridGrp.attachEvent("onRowSelect",function(rowID,celInd){
            alog("mygridGrp - onRowSelect ----------start");
            alog("   rowID = " + rowID);
            alog("   celInd = " + celInd);

            //편집모드 일때는 하위 새로고침 안하게 하기
            if($("#GRP_EDIT_MODE").is(":checked"))return false;


            //상태가 편집모드이면 선택시 반응 없음
            RowEditStatus = mygridGrp.getUserData(rowID,"!nativeeditor_status");
			if(RowEditStatus == "inserted" || RowEditStatus == "deleted" || RowEditStatus == "updated"){return false;}

            lastrowid1 = rowID;

            //선택된 ROW의 모든컬럼 추출하기
            var RowAllData;
            RowAllData = getRowsColid(mygridGrp,rowID,"G1");
            alog("   RowAllData = " + RowAllData);

            var ConAllData = $( "#condition1" ).serialize();
            alog("   ConAllData = " + ConAllData);

            //마지막 선송 정보 저장
            lastinput6 = RowAllData + "&" + ConAllData;
            lastinput5 = RowAllData + "&" + ConAllData;
			lastinput4 = RowAllData + "&" + ConAllData;


            //KEY컬럼만 자식에게 전달
            lastinput6json = jQuery.parseJSON('{ "__NAME":"lastinput6json"' +
                ', "PJTSEQ" : "' + q(mygridGrp.cells(lastrowid1,0).getValue()) + '"' +
                ', "PGMSEQ" : "' + q(mygridGrp.cells(lastrowid1,1).getValue()) + '"' +
                ', "GRPSEQ" : "' + q(mygridGrp.cells(lastrowid1,2).getValue()) + '"' +
                '}');

            lastinput5json = jQuery.parseJSON('{ "__NAME":"lastinput5json"' +
                ', "PJTSEQ" : "' + q(mygridGrp.cells(lastrowid1,0).getValue()) + '"' +
                ', "PGMSEQ" : "' + q(mygridGrp.cells(lastrowid1,1).getValue()) + '"' +
                ', "GRPSEQ" : "' + q(mygridGrp.cells(lastrowid1,2).getValue()) + '"' +
                '}');

            lastinput4json = jQuery.parseJSON('{ "__NAME":"lastinput4json"' +
                ', "PJTSEQ" : "' + q(mygridGrp.cells(lastrowid1,0).getValue()) + '"' +
                ', "PGMSEQ" : "' + q(mygridGrp.cells(lastrowid1,1).getValue()) + '"' +
                ', "GRPSEQ" : "' + q(mygridGrp.cells(lastrowid1,2).getValue()) + '"' +
                ', "GRPTYPE" : "' + q(mygridGrp.cells(lastrowid1,4).getValue()) + '"' +
                '}');

            //IO컬럼의 OBJTYPE 다시 불러오기
            var grptype = mygridGrp.cells(lastrowid1,4).getValue();
            alog(grptype);
            switch(grptype) {
                case "CONDITION":
                    //(FNC) FNCTYPE 다시 불러오기
                    setCodeCombo("GRID",mygridFnc.getCombo(mygridFnc.getColIndexById("FNCCD")),"FNCCONDITION");
                    
                    //(IO) OBJTYPE 다시 불러오기
                    setCodeCombo("GRID",mygridIo.getCombo(mygridIo.getColIndexById("OBJTYPE")),"CTCONDITION");

                    //BRYN, LBLHIDDEN, LBLWIDTH 숨기기
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("BRYN"),false);
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("LBLHIDDENYN"),false);
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("LBLWIDTH"),false);  
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("LBLALIGN"),false);            
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("OBJHEIGHT"),false);       
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("EDITYN"),false);       
                    break;
                case "GRID":
                    //(FNC) FNCTYPE 다시 불러오기
                    setCodeCombo("GRID",mygridFnc.getCombo(mygridFnc.getColIndexById("FNCCD")),"FNCGRID");

                    //(IO) OBJTYPE 다시 불러오기
                    setCodeCombo("GRID",mygridIo.getCombo(mygridIo.getColIndexById("OBJTYPE")),"CTGRID");

                    //BRYN, LBLHIDDEN, LBLWIDTH 숨기기
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("BRYN"),true);
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("LBLHIDDENYN"),true);
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("LBLWIDTH"),true);
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("LBLALIGN"),true);                    
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("OBJHEIGHT"),true);
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("EDITYN"),true);
                    break;
                case "FORMVIEW":
                    //(FNC) FNCTYPE 다시 불러오기
                    setCodeCombo("GRID",mygridFnc.getCombo(mygridFnc.getColIndexById("FNCCD")),"FNCFORMVIEW");

                    //(IO) OBJTYPE 다시 불러오기
                    setCodeCombo("GRID",mygridIo.getCombo(mygridIo.getColIndexById("OBJTYPE")),"CTFORMVIEW");

                    //BRYN, LBLHIDDEN, LBLWIDTH 숨기기
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("BRYN"),false);
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("LBLHIDDENYN"),false);
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("LBLWIDTH"),false);   
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("LBLALIGN"),false);   
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("OBJHEIGHT"),false);    
                    mygridIo.setColumnHidden(mygridIo.getColIndexById("EDITYN"),false);    
                    break;
                case "CHARTBAR":
                    //(FNC) FNCTYPE 다시 불러오기
                    setCodeCombo("GRID",mygridFnc.getCombo(mygridFnc.getColIndexById("FNCCD")),"FNCCHARTBAR");

                    //(IO) OBJTYPE 다시 불러오기
                    setCodeCombo("GRID",mygridIo.getCombo(mygridIo.getColIndexById("OBJTYPE")),"CTCHARTBAR");                                        
                default:
                    alog("IO의 OBJTYPE 생성을 위한 GRPTYPE이 아닙니다.(" + grptype + ")");
                    break;
            } 
            

            //그리드 2번 조회(Fnc)
            gridSearch5(lastinput5);

            //그리드 4번 조회(Io)
            gridSearch4(lastinput4);

            //그리드 6번 조회(Inherrit)
            setGridGrp("GRID",mygridInherit.getCombo(mygridInherit.getColIndexById("CHILDGRPID")),$("#F_PJTSEQ").val(),$("#F_PGMSEQ").val(),lastinput6json.GRPSEQ,'');
            gridSearch6(lastinput6);


            alog("mygridGrp - onRowSelect ----------end");
        });
        mygridGrp.attachEvent("onBeforeSorting", function(ind,type,direction){
            //any custom logic here
            return !addstatusyn1;
        });


        mygridGrp.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){

            //alog("mygridGrp  onEditCell ------------------start");
            //alog("       stage : " + stage);
            //alog("       rId : " + rId);
            //alog("       cInd : " + cInd);
            //alog("       nValue : " + nValue);
            //alog("       oValue : " + oValue);

            RowEditStatus = mygridGrp.getUserData(rId,"!nativeeditor_status");
            if(stage == 2
                && RowEditStatus != "inserted"
                && RowEditStatus != "deleted"
                && nValue != oValue
                ){
                if(RowEditStatus == "") {
                    mygridGrp.setUserData(rId,"!nativeeditor_status","updated");
                    mygridGrp.setRowTextBold(rId);
                }
                mygridGrp.cells(rId,cInd).cell.wasChanged = true;
            }
            return true;

        });




        //2번째 그리드 초기화(sql)
        mygridSql = new dhtmlXGridObject('grid2');
		mygridSql.setUserData("","gridTitle","grid2 : sql list"); //글로별 변수에 그리드 타이블 넣기
        mygridSql.setImagePath("./lib/dhtmlxSuite/codebase/imgs/");
        mygridSql.setHeader("PJTSEQ,PGMSEQ,SQLSEQ,SQLID,SQLNM,SVRSEQ,CRUD,RTN_TYPE,SQLORD,SQLTXT,ADDDT,MODDT");
        mygridSql.setColumnIds("PJTSEQ,PGMSEQ,SQLSEQ,SQLID,SQLNM,SVRSEQ,CRUD,RTN_TYPE,SQLORD,SQLTXT,ADDDT,MODDT");
        //mygridSql.attachHeader("#connector_text_filter,#connector_text_filter,#connector_text_filter,#connector_text_filter")
        mygridSql.setInitWidths("50,50,50,50,50,40,40,50,50,50,50,50")
        mygridSql.setColTypes("ro,ed,ro,ed,ed,coro,coro,coro,ed,txt,ro,ro");
        mygridSql.setColAlign("left,left,left,left,left,left,left,,left,left,left,left,left")
		mygridSql.setColSorting("str,str,int,str,str,str,str,str,int,str,str,str");

        //mygridSql.setColumnHidden(0,true);
        //mygridSql.isColumnHidden(0);//PJTID숨기기

        mygridSql.enableSmartRendering(false);
        mygridSql.enableMultiselect(true);
        mygridSql.splitAt(5);//'freezes' 0 columns // ROW선택 이벤트


        mygridSql.init();
        
        //GRPTYPE 콤보
		setCodeCombo("GRID",mygridSql.getCombo(mygridSql.getColIndexById("SVRSEQ")),"SVRSEQ");
		setCodeCombo("GRID",mygridSql.getCombo(mygridSql.getColIndexById("CRUD")),"CRUD");
		setCodeCombo("GRID",mygridSql.getCombo(mygridSql.getColIndexById("RTN_TYPE")),"RTN_TYPE");        

        mygridSql.setColumnHidden(0,true); //PJTSEQ
        mygridSql.setColumnHidden(1,true); //PGMSEQ
        mygridSql.setColumnHidden(2,true); //SQLSEQ


        mygridSql.attachEvent("onRowSelect",function(rowID,celInd){
            alog("mygridSql - onRowSelect ----------start");
            alog("   rowID = " + rowID);
            alog("   celInd = " + celInd);

            lastrowid2 = rowID;


            var RowAllData = getRowsColid(mygridSql,rowID,"G2");
            alog("   RowAllData = " + RowAllData);

            var ConAllData = $( "#condition1" ).serialize();
            alog("   ConAllData = " + ConAllData);

            //마지막 선송 정보 저장
            lastinput3 = RowAllData + "&" + ConAllData;


			//KEY컬럼만 자식에게 전달
            lastinput3json = jQuery.parseJSON('{ "__NAME":"lastinput3json"' +
                ', "PJTSEQ" : "' + q(mygridSql.cells(lastrowid2,0).getValue()) + '"' +
                ', "PGMSEQ" : "' + q(mygridSql.cells(lastrowid2,1).getValue()) + '"' +
                ', "SQLSEQ" : "' + q(mygridSql.cells(lastrowid2,2).getValue()) + '"' +
                '}');


            //세팅하기
            //alert(mygridSql.cells(rowID,celInd).getValue());
            cidx = mygridSql.getColIndexById("SQLTXT");
            alog("   cidx = " + cidx);

			//alert(mygridSql.cells(rowID,cidx-1).getValue());
            cm.setValue(mygridSql.cells(rowID,cidx).getValue());

            //그리드 3번 조회
            gridSearch3(lastinput3);

            alog("mygridSql - onRowSelect ----------end");
        });

        mygridSql.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){

            //alog("mygridSql  onEditCell ------------------start");
            //alog("       stage : " + stage);
            //alog("       rId : " + rId);
            //alog("       cInd : " + cInd);
            //alog("       nValue : " + nValue);
            //alog("       oValue : " + oValue);

            RowEditStatus = mygridSql.getUserData(rId,"!nativeeditor_status");
            if(stage == 2
                && RowEditStatus != "inserted"
                && RowEditStatus != "deleted"
                && nValue != oValue
                ){
                if(RowEditStatus == "") {
                    mygridSql.setUserData(rId,"!nativeeditor_status","updated");
                    mygridSql.setRowTextBold(rId);
                }
                mygridSql.cells(rId,cInd).cell.wasChanged = true;
            }
            return true;

        });

        //mygridSql.loadXML("cg_pjtinfo_crud3.php");




        //5번째 그리드 초기화 (fnc)
        mygridFnc = new dhtmlXGridObject('grid5');
		mygridFnc.setUserData("","gridTitle","grid5 : fnc list"); //글로별 변수에 그리드 타이블 넣기
        mygridFnc.setImagePath("./lib/dhtmlxSuite/codebase/imgs/");
        mygridFnc.setHeader("PJTSEQ,PGMSEQ,GRPSEQ,FNCSEQ,USE,FNCID,FNCCD,FNCNM,FNCTYPE,ORD,ADDDT,MODDT");
        mygridFnc.setColumnIds("PJTSEQ,PGMSEQ,GRPSEQ,FNCSEQ,USEYN,FNCID,FNCCD,FNCNM,FNCTYPE,FNCORD,ADDDT,MODDT");
        mygridFnc.setInitWidths("50,50,50,35,30,50,50,50,30,50,30,50,50");
        mygridFnc.setColTypes("ed,ed,ed,ro,ch,ed,coro,ed,ed,ed,ed,ro,ro");
        mygridFnc.setColAlign("left,left,left,left,center,left,left,left,left,left,left,left,left");
		mygridFnc.setColSorting("str,str,str,str,str,str,str,str,str,int,int,str,str");

        //mygridSql.isColumnHidden(0);//PJTID숨기기

        mygridFnc.enableSmartRendering(false);
        mygridFnc.enableMultiselect(true);

		//GRPTYPE 콤보
		setCodeCombo("GRID",mygridFnc.getCombo(mygridFnc.getColIndexById("FNCCD")),"FNC");

        mygridFnc.splitAt(5);//'freezes' 0 columns // ROW선택 이벤트
        mygridFnc.init();

        mygridFnc.setColumnHidden(0,true); //PJTSEQ
		mygridFnc.setColumnHidden(1,true); //PGMSEQ
        mygridFnc.setColumnHidden(2,true); //GRPSEQ
        mygridFnc.setColumnHidden(3,true); //FNCSEQ

		mygridFnc.attachEvent("onCheck", function(rId,cInd,state){
			// your code here
            alog("mygridFnc - onCheck ----------start");
            alog("   rId = " + rId);
            alog("   cInd= " + cInd);
            alog("   state = " + state);

			mygridFnc.cells(rId,cInd).cell.wasChanged=true;//변경 상태 업데이트
			mygridFnc.setRowTextBold(rId);//변경 상태 업데이트
			mygridFnc.setUserData(rId,"!nativeeditor_status","updated");//변경 상태 업데이트

		});



        mygridFnc.attachEvent("onRowSelect",function(rowID,celInd){
            alog("mygridFnc - onRowSelect ----------start");
            alog("   rowID = " + rowID);
            alog("   celInd = " + celInd);


            lastrowid5 = rowID;

            //선택된 ROW의 모든컬럼 추출하기
            var RowAllData;
            RowAllData = getRowsColid(mygridFnc,rowID,"G5");
            alog("   RowAllData = " + RowAllData);



            var ConAllData = $( "#condition1" ).serialize();
            alog("   ConAllData = " + ConAllData);

            //(SVC) 마지막 전송 정보 저장
            lastinput9 = RowAllData + "&" + ConAllData;

            //(PARAM) 마지막 전송 정보 저장
            lastinputParam = RowAllData + "&" + ConAllData;

			//(SVC) KEY컬럼만 자식에게 전달
            lastinput9json = jQuery.parseJSON('{ "__NAME":"lastinput9json"' +
                ', "PJTSEQ" : "' + q(mygridFnc.cells(lastrowid5,0).getValue()) + '"' +
                ', "PGMSEQ" : "' + q(mygridFnc.cells(lastrowid5,1).getValue()) + '"' +
                ', "GRPSEQ" : "' + q(mygridFnc.cells(lastrowid5,2).getValue()) + '"' +
                ', "FNCSEQ" : "' + q(mygridFnc.cells(lastrowid5,3).getValue()) + '"' +
                '}');


			//(PARAM) KEY컬럼만 자식에게 전달
            lastinputParamjson = jQuery.parseJSON('{ "__NAME":"lastinputParamjson"' +
                ', "PJTSEQ" : "' + q(mygridFnc.cells(lastrowid5,0).getValue()) + '"' +
                ', "PGMSEQ" : "' + q(mygridFnc.cells(lastrowid5,1).getValue()) + '"' +
                ', "GRPSEQ" : "' + q(mygridFnc.cells(lastrowid5,2).getValue()) + '"' +
                ', "FNCSEQ" : "' + q(mygridFnc.cells(lastrowid5,3).getValue()) + '"' +
                '}');


            //(SVC의 SVCGRPSEQ컬럼) 콤보세팅
            setGridGrp("GRID",mygridSvc.getCombo(mygridSvc.getColIndexById("SVCGRPID")),$("#F_PJTSEQ").val(),$("#F_PGMSEQ").val(),null,lastinput9json.FNCSEQ);
            
            //(SVC) 그리드 조회
            gridSearch9(lastinput9);

            //(PARAM) 그리드 조회
            gridSearchParam(lastinputParam);


            alog("mygridFnc - onRowSelect ----------end");
        });
        mygridFnc.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){

            //alog("mygridFnc  onEditCell ------------------start");
            //alog("       stage : " + stage);
            //alog("       rId : " + rId);
            //alog("       cInd : " + cInd);
            //alog("       nValue : " + nValue);
            //alog("       oValue : " + oValue);

            RowEditStatus = mygridFnc.getUserData(rId,"!nativeeditor_status");
            if(stage == 2
                && RowEditStatus != "inserted"
                && RowEditStatus != "deleted"
                && nValue != oValue
                ){
                if(RowEditStatus == "") {
                    mygridFnc.setUserData(rId,"!nativeeditor_status","updated");
                    mygridFnc.setRowTextBold(rId);
                }
                mygridFnc.cells(rId,cInd).cell.wasChanged = true;
            }
            return true;

        });
        //mygridSql.loadXML("cg_pjtinfo_crud3.php");


        //6번째 그리드 초기화 (inherit)
        mygridInherit = new dhtmlXGridObject('grid6');
		mygridInherit.setUserData("","gridTitle","grid6 : inherrit list"); //글로별 변수에 그리드 타이블 넣기
        mygridInherit.setImagePath("./lib/dhtmlxSuite/codebase/imgs/");
        mygridInherit.setHeader("INHERITSEQ,PJTSEQ,PGMSEQ,GRPSEQ,COLID,CHILDGRPID,ADDDT,MODDT");
        mygridInherit.setColumnIds("INHERITSEQ,PJTSEQ,PGMSEQ,GRPSEQ,COLID,CHILDGRPID,ADDDT,MODDT");
        mygridInherit.setInitWidths("50,50,50,50,50,50,50,50");
        mygridInherit.setColTypes("ro,ed,ed,ed,coro,coro,ro,ro");
        mygridInherit.setColAlign("left,left,left,left,left,left,left,left");
		mygridInherit.setColSorting("int,str,str,str,str,str,str,str");

        //mygridSql.isColumnHidden(0);//PJTID숨기기

        mygridInherit.enableSmartRendering(false);
        mygridInherit.enableMultiselect(true);

        mygridInherit.init();

        mygridInherit.setColumnHidden(0,true); //INHERITSEQ
		mygridInherit.setColumnHidden(1,true); //PJTSEQ
        mygridInherit.setColumnHidden(2,true); //PGMSEQ
        mygridInherit.setColumnHidden(3,true); //GRPSEQ

        mygridInherit.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){

            //alog("mygridInherit  onEditCell ------------------start");
            //alog("       stage : " + stage);
            //alog("       rId : " + rId);
            //alog("       cInd : " + cInd);
            //alog("       nValue : " + nValue);
            //alog("       oValue : " + oValue);

            RowEditStatus = mygridInherit.getUserData(rId,"!nativeeditor_status");
            if(stage == 2
                && RowEditStatus != "inserted"
                && RowEditStatus != "deleted"
                && nValue != oValue
                ){
                if(RowEditStatus == "") {
                    mygridInherit.setUserData(rId,"!nativeeditor_status","updated");
                    mygridInherit.setRowTextBold(rId);
                }
                mygridInherit.cells(rId,cInd).cell.wasChanged = true;
            }
            return true;

        });
        //mygridSql.loadXML("cg_pjtinfo_crud3.php");



        //6번째 그리드 초기화 (sqlR)
        mygridSqlR = new dhtmlXGridObject('grid7');
		mygridSqlR.setUserData("","gridTitle","gridSQLR : fnc list"); //글로별 변수에 그리드 타이블 넣기
        mygridSqlR.setImagePath("./lib/dhtmlxSuite/codebase/imgs/");
        mygridSqlR.setHeader("SEQ,PJTSEQ,PGMSEQ,SVCSEQ,SQLID,ORD,ADDDT,MODDT");
        mygridSqlR.setColumnIds("SQLRSEQ,PJTSEQ,PGMSEQ,SVCSEQ,SQLID,ORD,ADDDT,MODDT");
        mygridSqlR.setInitWidths("50,50,50,50,50,50,50,50");
        mygridSqlR.setColTypes("ed,ed,ed,ed,coro,ed,ro,ro");
        mygridSqlR.setColAlign("left,left,left,left,left,left,left,left");
        //mygridSql.isColumnHidden(0);//PJTID숨기기
		mygridSqlR.setColSorting("int,str,str,str,str,int,str,str");

        mygridSqlR.enableSmartRendering(false);
        mygridSqlR.enableMultiselect(true);

        mygridSqlR.init();

        mygridSqlR.setColumnHidden(0,true); //SQLRSEQ
		mygridSqlR.setColumnHidden(1,true); //pjtseq
        mygridSqlR.setColumnHidden(2,true); //pgmseq
        mygridSqlR.setColumnHidden(3,true); //SVCSEQ



        mygridSqlR.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){

            //alog("mygridSqlR  onEditCell ------------------start");
            //alog("       stage : " + stage);
            //alog("       rId : " + rId);
            //alog("       cInd : " + cInd);
            //alog("       nValue : " + nValue);
            //alog("       oValue : " + oValue);

            RowEditStatus = mygridSqlR.getUserData(rId,"!nativeeditor_status");
            if(stage == 2
                && RowEditStatus != "inserted"
                && RowEditStatus != "deleted"
                && nValue != oValue
                ){
                if(RowEditStatus == "") {
                    mygridSqlR.setUserData(rId,"!nativeeditor_status","updated");
                    mygridSqlR.setRowTextBold(rId);
                }
                mygridSqlR.cells(rId,cInd).cell.wasChanged = true;
            }
            return true;

        });
        //mygridSql.loadXML("cg_pjtinfo_crud3.php");



        //3번째 그리드 초기화(col)
        alog("mygridCol........init.......start");        
        mygridCol = new dhtmlXGridObject('grid3');
		mygridCol.setUserData("","gridTitle","grid3 : sql column list"); //글로별 변수에 그리드 타이블 넣기
        mygridCol.setImagePath("./lib/dhtmlxSuite/codebase/imgs/");
        mygridCol.setHeader("COLSEQ,PJTSEQ,PGMSEQ,SQLSEQ,DDCOLID,COLID,DD_DATATYPE,SQLGBN,ORD,ADDDT,MODDT");
        mygridCol.setColumnIds("COLSEQ,PJTSEQ,PGMSEQ,SQLSEQ,DDCOLID,COLID,DATATYPE,SQLGBN,ORD,ADDDT,MODDT");
        //mygridSql.attachHeader("#connector_text_filter,#connector_text_filter,#connector_text_filter,#connector_text_filter")
        mygridCol.setInitWidths("50,50,50,50,50,50,50,50,50,50,60");
        mygridCol.setColTypes("ro,ed,ed,ro,ed,ed,ed,coro,ed,ro,ro");
        mygridCol.setColAlign("left,left,left,left,left,left,left,left,left,left,left");
		mygridCol.setColSorting("int,int,int,int,str,str,str,str,int,str,str");

        mygridCol.enableSmartRendering(false);
        mygridCol.enableMultiselect(true);
        mygridCol.splitAt(5);//'freezes' 0 columns // ROW선택 이벤트        
        
        mygridCol.init();
        isView3=false;
        viewGrid3();//컬럼 숨기기
		//GRPTYPE 콤보
		setCodeCombo("GRID",mygridCol.getCombo(mygridCol.getColIndexById("SQLGBN")),"SQLGBN");


        mygridCol.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){

            //alog("mygridCol  onEditCell ------------------start");
            //alog("       stage : " + stage);
            //alog("       rId : " + rId);
            //alog("       cInd : " + cInd);
            //alog("       nValue : " + nValue);
            //alog("       oValue : " + oValue);

            RowEditStatus = mygridCol.getUserData(rId,"!nativeeditor_status");
            if(stage == 2
                && RowEditStatus != "inserted"
                && RowEditStatus != "deleted"
                && nValue != oValue
                ){
                if(RowEditStatus == "") {
                    mygridCol.setUserData(rId,"!nativeeditor_status","updated");
                    mygridCol.setRowTextBold(rId);
                }
                mygridCol.cells(rId,cInd).cell.wasChanged = true;
            }
            return true;

        });
        //mygridSql.loadXML("cg_pjtinfo_crud3.php");


        //4번째 그리드 초기화(io)
        alog("mygridIo........init.......start");
        mygridIo = new dhtmlXGridObject('grid4');
		mygridIo.setUserData("","gridTitle","grid3 : io list"); //글로별 변수에 그리드 타이블 넣기
        mygridIo.setImagePath("./lib/dhtmlxSuite/codebase/imgs/");
        mygridIo.setHeader("PJTSEQ,PGMSEQ,GRPSEQ,IOSEQ,DDSEQ,COLID,ORD,COLNM,DATATYPE,VALIDSEQ,DATASIZE,OBJTYPE,POP,BRYN,LBLHIDDENYN,LBLWIDTH,LBLALIGN,OBJWIDTH,OBJHEIGHT,OBJALIGN,KEYYN,SEQYN,HIDDENYN,EDITYN,FNINIT,ADDDT,MODDT"); //29

        mygridIo.setColumnIds("PJTSEQ,PGMSEQ,GRPSEQ,IOSEQ,DDSEQ,COLID,COLORD,COLNM,DATATYPE,VALIDSEQ,DATASIZE,OBJTYPE,POPUP,BRYN,LBLHIDDENYN,LBLWIDTH,LBLALIGN,OBJWIDTH,OBJHEIGHT,OBJALIGN,KEYYN,SEQYN,HIDDENYN,EDITYN,FNINIT,ADDDT,MODDT"); //29

        //mygridSql.attachHeader("#connector_text_filter,#connector_text_filter,#connector_text_filter,#connector_text_filter")
        mygridIo.setInitWidths("50,50,50,50,50,50,30,50,50,30,50,50,50,50,50,50,50,50,50,50,50,50,50,50,50,50,50"); //29
        mygridIo.setColTypes("ed,ed,ed,ro,ro,ed,ed,ed,coro,coro,ed,coro,ed,coro,coro,ed,coro,ed,ed,coro,coro,coro,coro,coro,txttxt,ro,ro"); //29
        mygridIo.setColAlign("left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left");//29
		mygridIo.setColSorting("str,str,str,str,str,str,int,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str");//29

        mygridIo.enableSmartRendering(true);
        mygridIo.enableMultiselect(true);
        mygridIo.splitAt(6);//'freezes' 0 columns // ROW선택 이벤트
		mygridIo.init();

        mygridIo.setColumnHidden(0,true); //PJTSEQ
        mygridIo.setColumnHidden(1,true); //PGMSEQ
        mygridIo.setColumnHidden(2,true); //GRPSEQ
        mygridIo.setColumnHidden(3,true); //IOSEQ
        mygridIo.setColumnHidden(4,true); //DDSEQ

		//GRPTYPE 콤보
		setCodeCombo("GRID",mygridIo.getCombo(mygridIo.getColIndexById("DATATYPE")),"DATATYPE");
		setCodeCombo("GRID",mygridIo.getCombo(mygridIo.getColIndexById("OBJTYPE")),"CTGRID");
        setCodeCombo("GRID",mygridIo.getCombo(mygridIo.getColIndexById("COLFORMAT")),"COLFORMAT");
        setCodeCombo("GRID",mygridIo.getCombo(mygridIo.getColIndexById("LBLALIGN")),"OBJALIGN");
		setCodeCombo("GRID",mygridIo.getCombo(mygridIo.getColIndexById("OBJALIGN")),"OBJALIGN");
        setCodeCombo("GRID",mygridIo.getCombo(mygridIo.getColIndexById("VALIDSEQ")),"VALIDSEQ");
        
        //YN 콤보 채우기
        setCodeYN("GRID",mygridIo.getCombo(mygridIo.getColIndexById("BRYN")));
        setCodeYN("GRID",mygridIo.getCombo(mygridIo.getColIndexById("LBLHIDDENYN")));
        setCodeYN("GRID",mygridIo.getCombo(mygridIo.getColIndexById("KEYYN")));
        setCodeYN("GRID",mygridIo.getCombo(mygridIo.getColIndexById("SEQYN")));
        setCodeYN("GRID",mygridIo.getCombo(mygridIo.getColIndexById("HIDDENYN")));
        setCodeYN("GRID",mygridIo.getCombo(mygridIo.getColIndexById("EDITYN")));
        

        mygridIo.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){

            //alog("mygridIo  onEditCell ------------------start");
            //alog("       stage : " + stage);
            //alog("       rId : " + rId);
            //alog("       cInd : " + cInd);
            //alog("       COLID : " + mygridIo.getColumnId(cInd));
            //alog("       nValue : " + nValue);
            //alog("       oValue : " + oValue);
			

            RowEditStatus = mygridIo.getUserData(rId,"!nativeeditor_status");
            alog("       RowEditStatus : " + RowEditStatus);

            if(stage == 2
                && RowEditStatus != "inserted"
                && RowEditStatus != "deleted"
                && nValue != oValue
                ){
                

                if(jsonFormValid(eval("obj_G4_valid."+mygridIo.getColumnId(cInd)), "OBJTYPE", "오브젝트타임", nValue)){
                    if(RowEditStatus == "") {
                        mygridIo.setUserData(rId,"!nativeeditor_status","updated");
                        mygridIo.setRowTextBold(rId);
                    }
                    mygridIo.cells(rId,cInd).wasChanged = true;

                }else{
                    return false;
                }
            }





            //컬럼이름이나 컬럼ID로 DD 검색하기 ( cInd == COLID 컬러ID, cInd == COLNM 컬럼명 )
            if(stage == 2 && cInd == mygridIo.getColIndexById("DATATYPE") ){

            }else if(stage == 2 && cInd == mygridIo.getColIndexById("COLID") ){
            //컬럼이름이나 컬럼ID로 DD 검색하기 ( cInd == COLID 컬러ID, cInd == COLNM 컬럼명 )    
				alog("몇번째 컬럼이 변경됨 : " + cInd);

				var ConAllData = $( "#condition1" ).serialize();
				alog("   ConAllData = " + ConAllData);

				//마지막 선송 정보 저장
				lastinput5 =  ConAllData;



				//서버에서 DD가져오기
				$.ajax({
					type : "POST",
					url : mygridFnc_url+"&G5_CRUD_MODE=read&" + lastinput5 + "&G1_GRPTYPE=" + lastinput4json.GRPTYPE,
					data : { searchdd :  nValue },
					dataType: "json",
					success: function(data){
						alog("   json return----------------------");
						alog("   json data : " + data);
						alog("   json RTN_CD : " + data.RTN_CD);
						alog("   json ERR_CD : " + data.ERR_CD);
						alog("   json RTN_MSG : " + data.RTN_MSG);

						//그리드 저장 처리
						if(data.RTN_CD == "200"){
							if(data.RTN_DATA){
								for(var i=0;i<data.RTN_DATA.rows.length;i++){
									//alog( "   i : " + i);

									//내 행 업데이트
                                    //  PJTSEQ,PGMSEQ,GRPSEQ,IOSEQ,DDSEQ
                                    //,COLID,COLORD,COLNM,DATATYPE,VALIDSEQ
                                    //,DATASIZE,OBJTYPE,BRYN,LBLHIDDENYN,LBLWIDTH
                                    //,OBJWIDTH,OBJHEIGHT,OBJALIGN,KEYYN,SEQYN
                                    //,HIDDENYN,EDITYN,FNINIT,ADDDT,MODDT
                                    //alert("COLID:" + mygridIo.getColIndexById("COLID"));
                                    
                                    //alog(121);

                                    mygridIo.cells(rId,mygridIo.getColIndexById("DDSEQ")).setValue(data.RTN_DATA.rows[i].data[1]);//DDSEQ

                                    mygridIo.cells(rId,mygridIo.getColIndexById("COLID")).setValue(data.RTN_DATA.rows[i].data[2]);//COLID
                                    
                                    //alog(122);
									//alert("COLNM:" + mygridIo.getColIndexById("COLNM"));
									mygridIo.cells(rId,mygridIo.getColIndexById("COLNM")).setValue(data.RTN_DATA.rows[i].data[3]);//COLNM

									//alert("DATATYPE:" + mygridIo.getColIndexById("DATATYPE"));
									mygridIo.cells(rId,mygridIo.getColIndexById("DATATYPE")).setValue(data.RTN_DATA.rows[i].data[4]);//DATATYPE

                                    ///alog(123);
									//alert("DATASIZE:" + mygridIo.getColIndexById("DATASIZE"));
									mygridIo.cells(rId,mygridIo.getColIndexById("DATASIZE")).setValue(data.RTN_DATA.rows[i].data[5]);//DATASIZE
                                    //alog(1231);
                                    //alert("OBJTYPE:" + mygridIo.getColIndexById("OBJTYPE"));
                                    //alog(" RTN_DATA 6 = " + data.RTN_DATA.rows[i].data[6]);
                                    //alog(" mygridIo OBJTYPE = " + mygridIo.getColIndexById("OBJTYPE"));
                                    mygridIo.cells(rId,mygridIo.getColIndexById("OBJTYPE")).setValue(data.RTN_DATA.rows[i].data[6]);//OBJTYPE
                                    mygridIo.cells(rId,mygridIo.getColIndexById("POPUP")).setValue(data.RTN_DATA.rows[i].data[7]);//POPUP
									//alog(1232);
									//alert("LBLWIDTH:" + mygridIo.getColIndexById("LBLWIDTH"));
									mygridIo.cells(rId,mygridIo.getColIndexById("LBLWIDTH")).setValue(data.RTN_DATA.rows[i].data[8]);//LBLWIDTH
                                    //alog(1233);

									//alert("OBJWIDTH:" + mygridIo.getColIndexById("OBJWIDTH"));
									mygridIo.cells(rId,mygridIo.getColIndexById("OBJWIDTH")).setValue(data.RTN_DATA.rows[i].data[10]);//OBJWIDTH
                                    //alog(1234);
									//alert("OBJHEIGHT:" + mygridIo.getColIndexById("OBJHEIGHT"));
									mygridIo.cells(rId,mygridIo.getColIndexById("OBJHEIGHT")).setValue(data.RTN_DATA.rows[i].data[11]);//OBJHEIGHT
                                    //alog(1235);
									mygridIo.cells(rId,mygridIo.getColIndexById("VALIDSEQ")).setValue(data.RTN_DATA.rows[i].data[12]);//VALIDSEQ

                                    //정렬
                                    mygridIo.cells(rId,mygridIo.getColIndexById("LBLALIGN")).setValue(data.RTN_DATA.rows[i].data[13]);
                                    mygridIo.cells(rId,mygridIo.getColIndexById("OBJALIGN")).setValue(data.RTN_DATA.rows[i].data[14]);
                                    //alog(124);

									//기타 기본값
                                    mygridIo.cells(rId,mygridIo.getColIndexById("COLORD")).setValue("10");

									mygridIo.cells(rId,mygridIo.getColIndexById("LBLHIDDENYN")).setValue("N");
									mygridIo.cells(rId,mygridIo.getColIndexById("BRYN")).setValue("N");
									mygridIo.cells(rId,mygridIo.getColIndexById("KEYYN")).setValue("N");
                                    mygridIo.cells(rId,mygridIo.getColIndexById("SEQYN")).setValue("N");
                                    mygridIo.cells(rId,mygridIo.getColIndexById("HIDDENYN")).setValue("N");
                                    mygridIo.cells(rId,mygridIo.getColIndexById("EDITYN")).setValue("Y");
                                
                                    //alog(125);
										
								}
							}
						}else{
							msgError("[DD] 서버 저장중 에러가 발생했습니다.\nRTN_CD : " + data.RTN_CD + "\nERR_CD : " + data.ERR_CD + "\nRTN_MSG :" + data.RTN_MSG,3);
						}


					},
					error: function(error){
						msgError("[DD] Ajax http 500 error ( " + error + " )",3);
						alog("[DD] Ajax http 500 error ( " + error + " )");
					}
				});

			}



			alog("6666");
            return true;

        });






		//9번째 그리드 초기화(SVC)
		alog("grid9-----------------------------start");
		mygridSvc = new dhtmlXGridObject('grid9');
		mygridSvc.setUserData("","gridTitle","grid9 : sql column list"); //글로별 변수에 그리드 타이블 넣기
		mygridSvc.setImagePath("./lib/dhtmlxSuite/codebase/imgs/");
		mygridSvc.setHeader("SVCSEQ,PJTSEQ,PGMSEQ,GRPSEQ,FNCSEQ,ORD,SVCGRPID,ADDDT,MODDT");
		mygridSvc.setColumnIds("SVCSEQ,PJTSEQ,PGMSEQ,GRPSEQ,FNCSEQ,ORD,SVCGRPID,ADDDT,MODDT");
		mygridSvc.setInitWidths("50,50,50,50,50,50,50,50,50");
		mygridSvc.setColTypes("ro,ed,ed,ed,ed,ed,coro,ro,ro");
		mygridSvc.setColAlign("left,left,left,left,left,left,left,left,left");
		mygridSvc.setColSorting("int,str,str,str,str,int,str,str,str");


		mygridSvc.enableSmartRendering(false);
		mygridSvc.enableMultiselect(true);
		mygridSvc.init();

		mygridSvc.setColumnHidden(0,true); //SVCSEQ
		mygridSvc.setColumnHidden(1,true); //PJTSEQ
		mygridSvc.setColumnHidden(2,true); //PGMSEQ
		mygridSvc.setColumnHidden(3,true); //GRPSEQ
		mygridSvc.setColumnHidden(4,true); //FNCSEQ

		mygridSvc.attachEvent("onRowSelect",function(rowID,celInd){
            alog("mygridSvc - onRowSelect ----------start");
            alog("   rowID = " + rowID);
            alog("   celInd = " + celInd);


            lastrowid5 = rowID;

            //선택된 ROW의 모든컬럼 추출하기
            var RowAllData;
            RowAllData = getRowsColid(mygridSvc,rowID,"G9");
            alog("   RowAllData = " + RowAllData);



            var ConAllData = $( "#condition1" ).serialize();
            alog("   ConAllData = " + ConAllData);

            //(SQLR) 마지막 전송 정보 저장
            lastinput7 = RowAllData + "&" + ConAllData;


			//(SQLR) KEY컬럼만 자식에게 전달
            lastinput7json = jQuery.parseJSON('{ "__NAME":"lastinput7json"' +
                ', "SVCSEQ" : "' + q(mygridSvc.cells(lastrowid5,0).getValue()) + '"' +
                ', "PJTSEQ" : "' + q(mygridSvc.cells(lastrowid5,1).getValue()) + '"' +
                ', "PGMSEQ" : "' + q(mygridSvc.cells(lastrowid5,2).getValue()) + '"' +
                ', "GRPSEQ" : "' + q(mygridSvc.cells(lastrowid5,3).getValue()) + '"' +
                ', "FNCSEQ" : "' + q(mygridSvc.cells(lastrowid5,4).getValue()) + '"' +
                '}');


            //(SQR의 SQL컬럼) 콤보세팅
            setGridSql("GRID",mygridSqlR.getCombo(mygridSqlR.getColIndexById("SQLID")),$("#F_PJTSEQ").val(),$("#F_PGMSEQ").val(),mygridSvc.cells(lastrowid5,0).getValue());
            
            //(SQLR) 그리드 조회
            gridSearch7(lastinput7);



        

            alog("mygridSvc - onRowSelect ----------end");
        });

		mygridSvc.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){

			//alog("mygridSvc  onEditCell ------------------start");
			//alog("       stage : " + stage);
			//alog("       rId : " + rId);
			//alog("       cInd : " + cInd);
			//alog("       nValue : " + nValue);
			//alog("       oValue : " + oValue);

			RowEditStatus = mygridSvc.getUserData(rId,"!nativeeditor_status");
			if(stage == 2
				&& RowEditStatus != "inserted"
				&& RowEditStatus != "deleted"
				&& nValue != oValue
				){
				if(RowEditStatus == "") {
					mygridSvc.setUserData(rId,"!nativeeditor_status","updated");
					mygridSvc.setRowTextBold(rId);
				}
				mygridSvc.cells(rId,cInd).cell.wasChanged = true;
			}
			return true;

		});




		
		alog("initBody-----------------------------end");

    }//initBody();

    function viewGrid3(){
        if(isView3){
            alog("viewGrid3..........보여줘");
            isView3 = false;
            
            mygridCol.setColumnHidden(mygridCol.getColIndexById("COLSEQ"),false); //COLSEQ
            mygridCol.setColumnHidden(mygridCol.getColIndexById("PJTSEQ"),false); //PJTSEQ
            mygridCol.setColumnHidden(mygridCol.getColIndexById("PGMSEQ"),false); //PGMSEQ
            mygridCol.setColumnHidden(mygridCol.getColIndexById("SQLSEQ"),false); //SQLSEQ
            mygridCol.setColumnHidden(mygridCol.getColIndexById("DDCOLID"),false); //SQLSEQ
        }else{
            alog("viewGrid3..........숨겨");            
            isView3 = true;

            mygridCol.setColumnHidden(mygridCol.getColIndexById("COLSEQ"),true); //COLSEQ
            mygridCol.setColumnHidden(mygridCol.getColIndexById("PJTSEQ"),true); //PJTSEQ
            mygridCol.setColumnHidden(mygridCol.getColIndexById("PGMSEQ"),true); //PGMSEQ
            mygridCol.setColumnHidden(mygridCol.getColIndexById("SQLSEQ"),true); //SQLSEQ
            mygridCol.setColumnHidden(mygridCol.getColIndexById("DDCOLID"),true); //SQLSEQ
        }

    }

    function goSqlSearch(){
		//alert(lastinput3json.SQLSEQ);
		window.open("./rst/sqlsearchView.php","sqlsearch","width=800,height=600,scrollbars=yes");
    }

	function goSqlpreview(){
		//alert(lastinput3json.SQLSEQ);
		window.open("cg_sqlpreview.php?SQLSEQ="+lastinput3json.SQLSEQ,"sqlpreview","width=1024,height=600,scrollbars=yes");
    }
    
    function goSqlChange(tmp){
        alert(cm.getValue());
        cm.setValue(tmp);
        alert("goSqlChange2");
    }

    function pgmConditionReset(){
        $("#POP_PGMID").val("");
        $("#POP_PGMNM").val("");
        //$("#POP_PJTSEQ").val("");
    }

    function getAuth(){
        window.open("cg_pgminfo_getauth.php?PJTSEQ=" + $("#F_PJTSEQ").val() + "&PGMSEQ=" + $("#F_PGMSEQ").val());
    }


    function addSqlHint(){
        //alert($("#selSqlHint option:selected").val());
        rid = mygridSql.getSelectedId();
        if(rid == null)return;
        insertText($("#selSqlHint option:selected").val());
    }

    function insertText(data) {
        //var cm = $(".CodeMirror")[0].CodeMirror;
        var doc = cm.getDoc();
        var cursor = doc.getCursor(); // gets the line number in the cursor position
        var line = doc.getLine(cursor.line); // get the line contents
        var pos = {
            line: cursor.line
        };
        if (line.length === 0) {
            // check if the line is empty
            // add the data
            doc.replaceRange(data, pos);
        } else {
            // add a new line and the data
            //doc.replaceRange("\n" + data, pos);
            doc.replaceRange(data, pos);
        }   
    }