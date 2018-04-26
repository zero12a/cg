<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>Test v1.6.3</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!--<link rel="stylesheet" type="text/css" href="../../../codebase/dhtmlx.css"/>-->
	<link rel="stylesheet" type="text/css" href="./lib/dhtmlxSuite/codebase/dhtmlx.css"/>
	<script src="./lib/dhtmlxSuite/codebase/dhtmlx.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	

	<style>
		td {font-size:9pt}
		.even{
	        background-color:#ebebeb;
	    }
	    .uneven{
	        background-color:#dbe7f8;
	    }
	</style>
	
		
	<script>
	
	var mygrid;
	function init(){
		alog("init()---------------------start");
		
        //그리드 초기화
        mygrid = new dhtmlXGridObject('gridbox');
        mygrid.setImagePath("./lib/dhtmlxSuite/codebase/imgs/");
        mygrid.setUserData("","gridTitle","G3 : PJT"); //글로별 변수에 그리드 타이블 넣기
		//헤더초기화
		mygrid.setHeader("useq,id,name,hobby,password,role");
		mygrid.setColumnIds("useq,id,name,hobby,password,role");
		mygrid.setInitWidthsP("10,20,20,10,20,20");
		mygrid.setColTypes("ed,ed,ed,ed,ed,ed");
		mygrid.setColSorting("str,str,str,str,str,str");//렌더링
		mygrid.enablePreRendering(50); //스크롤스무스
		mygrid.enableSmartRendering(true,100); //,버퍼사이즈
		mygrid.enableMultiselect(true);
		mygrid.setEditable(true); //편집모드
		
		mygrid.init();	
		
		mygrid.attachEvent("onScroll", function(sLeft,sTop){
			alog("[EVENT] onScroll------------------------- sLeft : " + sLeft + ", sTop : " + sTop );
		});
		mygrid.attachEvent("onXLS", function(grid_obj){
			alog("[EVENT] onXLS----------------------------");
		});
		mygrid.attachEvent("onXLE", function(grid_obj,count){
			alog("[EVENT] onXLE----------------------------	count : " + count);
		});
		mygrid.attachEvent("onDynXLS", function(start,count){
			alog("[EVENT] onDynXLS-------------------------	start : " + start + ", count " + count);
		});

		alog("init()---------------------end");

	
	}


	function getBulkData(){
		alog("getBulkData() -------------------------------start");

		mygrid.clearAll();
	

		//전송1
		//불러오기
        $.ajax({
            type : "POST",
            url : "grid_test4.txt",
            data : {rowLimit:""},
            dataType: "json",
            async: false,
            success: function(data){           
                alog("   getBulkData() json return----------------------");

               	mygrid.parse(data,"json");
				

            },
            error: function(error){
                alog("	getBulkData() Ajax http 500 error ( " + error + " )");
            }
        });
        
    	alog("getBulkData()-------------------------------end");		
	}

    function alog(tmp){
    	//alert("alog");
    	if(console)console.log(tmp);
    }
	
	
	</script>
</head>

<body onload="init();">
1
<div id="gridbox" style="width:100%;height:200px;background-color:white;"></div>
<div id="pagingArea"></div>
<input type="button" name="" value="load bulk 10000" onclick="getBulkData()">
2
</body>
</html>

