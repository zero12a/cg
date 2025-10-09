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
			url : CFG_CGWEB_URL + "/c.g/cg_cdeploy_db.php?CTL=MAKELOCALFILE&TOKEN=" + token + "&DB=" + $("#G1-DB").val() + "&TABLE=" + tableNm ,
			dataType: "jsonp",
			privateTableNm : tableNm,
			async: false,
			success: function(data){
				alog("   gridG2 json return----------------------");

				//alog("   json RTN_MSG length : " + data.RTN_MSG.length);

				mygridG2.cells(this.privateTableNm,colIndex).setValue("O");
				//alert("응답오케이:" + tableNm + ", " + colIndex);

			},
			error: function(error){
				msgError("[테이블목록] Ajax http 500 error ( " + error + " )",3);
				//alog("[테이블목록] Ajax http 500 error ( " + data.RTN_MSG + " )");
			}
		});
	}
}



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
			url : CFG_CGWEB_URL + "/c.g/cg_cdeploy_db.php?CTL=LOADFROMGITHUB&TOKEN=" + token + "&TARGET_DB=" + $("#G1-TARGET_DB").val()  + "&DB=" + $("#G1-DB").val() + "&TABLE=" + tableNm ,
			dataType: "jsonp",
			privateTableNm : tableNm,
			async: false,
			success: function(data){
				alog("   gridG2 json return----------------------");

				//alog("   json RTN_MSG length : " + data.RTN_MSG.length);
				if(data.RTN_CD =="200"){
					mygridG2.cells(this.privateTableNm,colIndex).setValue("O");
				}else{
					msgError(data.RTN_MSG + "(" + data.ERR_CD + ")",3);
				}

				//alert("응답오케이:" + tableNm + ", " + colIndex);

			},
			error: function(error){
				msgError("[테이블목록] Ajax http 500 error ( " + error + " )",3);
				//alog("[테이블목록] Ajax http 500 error ( " + data.RTN_MSG + " )");
			}
		});
	}
}



$.ajax({
	type : "GET",
	url : "CFG_MAKE_URL + ""/common/cg_cdeploy_pubsub.php?PUBSUB=config.DATASOURCE_CG&MSG=1" ,
	dataType: "jsonp",
	privateTableNm : tableNm,
	async: false,
	success: function(data){
		alog("   gridG2 json return----------------------");

		//alog("   json RTN_MSG length : " + data.RTN_MSG.length);
		if(data.RTN_CD =="200"){
			msgNotice(data.RTN_MSG);
		}else{
			msgError(data.RTN_MSG + "(" + data.ERR_CD + ")",3);
		}

		//alert("응답오케이:" + tableNm + ", " + colIndex);

	},
	error: function(error){
		msgError("[PUBSUB] Ajax http 500 error ( " + error + " )",3);
		//alog("[테이블목록] Ajax http 500 error ( " + data.RTN_MSG + " )");
	}
});