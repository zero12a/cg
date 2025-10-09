<?php
header("Content-Type: text/html; charset=UTF-8");
header("Cache-Control:no-cache");
header("Pragma:no-cache");

	//로그인 검사
    require_once("./include/incUtil.php");
    require_once("./include/incUser.php");
    require_once("./incConfig.php");

    require_once("./include/incLoginCheck.php");//로그인 검사

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>MENU</title>

	<meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!--jquery / json-->
	<script src="./lib/jquery-1.11.1.min.js"></script>
	<script src="./lib/json2.min.js"></script>

	<!--dhmltx-->
    <script src="./lib/dhtmlxSuite/codebase/dhtmlx461_beautify.js" type="text/javascript" charset="utf-8"></script>

    <!--공통-->
    <script src="./rst/common.js" type="text/javascript" charset="utf-8"></script>


    <link rel="stylesheet" href="./lib/dhtmlxSuite/codebase/dhtmlx.css" type="text/css" charset="utf-8">
    <style>

		html,body {margin:0;padding:0;height: 100%}

		div#layoutObj {
			position: relative;
			background-color:yellowgreen;
			margin-top: 0px;
			margin-left: 0px;
			width: 100%;
			height: 100%;
		}
    </style>



    <script>
    var myTabbar;
	var myLayout;
	var myTree;
	var tnum = 0;

    function initBody(){
		alog("initBody-----------------------------------start");

		//레이아웃
		myLayout = new dhtmlXLayoutObject({
			parent: "layoutObj",
			pattern: "2U"
		});

		//myLayout.cells("a").hideHeader();
		myLayout.cells("a").setWidth(200);
		myLayout.cells("a").setText("Menu");
		myLayout.cells("b").hideHeader();

		//빈탭바 붙이기
		alog(111);
		myTabbar = myLayout.cells("b").attachTabbar();
		alog(122);

        myTabbar.setSkin('dhx_skyblue');
        myTabbar.enableAutoReSize(true);
		myTabbar.enableTabCloseButton(true);


		//트리
		myTree = myLayout.cells("a").attachTree();
		myTree.setImagePath("./lib/dhtmlxSuite/codebase/imgs/dhxtree_skyblue/");
		myTree.loadXML("./menu_data.xml?etc="+new Date().getTime());
		myTree.setOnClickHandler(tonclick);

		alog("initBody-----------------------------------end");
    }

	
	$(window).resize(function() {  
		alog("window resize -------------------start");
		myLayout.setSizes();
		alog("window resize -------------------end");
	}
	); 


    function tonclick(id){
        alog(myTree.getItemText(id));


        //void addTab(mixed id,string text,int width,int position,boolean active,boolean close);

        if(id =="pjtinfo"){
            if(myTabbar.tabs(id)){
                //myTabbar.tabs(id).set_actions(true);
                myTabbar.tabs(id).setActive();
            }else{
                myTabbar.addTab(id, "프로젝트", 100, null, true );
                //myTabbar.tabs(id).attachURL("cg_pjtinfo.php");
                myTabbar.tabs(id).attachURL("rst/test2View.php");
            }

        }
        if(id =="code"){
            if(myTabbar.tabs(id)){
                myTabbar.tabs(id).setActive();
            }else{
                myTabbar.addTab(id, "코드", 80, null, true );
                myTabbar.tabs(id).attachURL("cg_code.php");
            }
        }
        if(id =="objinfo2"){
            if(myTabbar.tabs(id)){
                myTabbar.tabs(id).setActive();
            }else{
                myTabbar.addTab(id, "오브젝트", 100, null, true );
                myTabbar.tabs(id).attachURL("cg_objinfo3.php");
            }
        }

        if(id =="pgminfo"){
            if(myTabbar.tabs(id)){
                myTabbar.tabs(id).setActive();
            }else{
                myTabbar.addTab(id, "프로그램", 100, null, true );
                myTabbar.tabs(id).attachURL("cg_pgminfo.php");
            }
        }
        if(id =="pgminfo2"){
            if(myTabbar.tabs(id)){
                myTabbar.tabs(id).setActive();
            }else{
                myTabbar.addTab(id, "프로그램2", 100, null, true );
                myTabbar.tabs(id).attachURL("cg_pgminfo2.php");
            }
        }

        if(id =="pgminfo3"){
            if(myTabbar.tabs(id)){
                myTabbar.tabs(id).setActive();
            }else{
                myTabbar.addTab(id, "프로그램3", 100, null, true );
                myTabbar.tabs(id).attachURL("cg_pgminfo3.php");
            }
        }


        if(id =="srcinfo"){
            if(myTabbar.tabs(id)){
                myTabbar.tabs(id).setActive();
            }else{
                myTabbar.addTab(id, "소스", 100, null, true );
                myTabbar.tabs(id).attachURL("cg_srcinfo.php");
            }
        }

        if(id =="layout"){
            if(myTabbar.tabs(id)){
                myTabbar.tabs(id).setActive();
            }else{
                myTabbar.addTab(id, "레이아웃", 100, null, true );
                myTabbar.tabs(id).attachURL("cg_layout.php");
            }
        }

        if(id =="tblinfo"){
            if(myTabbar.tabs(id)){
                myTabbar.tabs(id).setActive();
            }else{
                myTabbar.addTab(id, "TBLINFO", 100, null, true);
                myTabbar.tabs(id).attachURL("bc_tblinfo.php");
            }
        }

        if(id =="newtab"){
			tid = "newtab" + tnum;
			myTabbar.addTab(tid, "한글입니다.야호" + tnum, 100, null, true );
			myTabbar.tabs(tid).attachURL("bc_url.php");
			tnum = tnum + 1;
			alog("tnum:" + tnum);
        }
    };
    </script>

</head>

<body onload="initBody();">
<div id="layoutObj" >aa</div>
</body>
</html>