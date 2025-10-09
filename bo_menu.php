<?php
header("Content-Type: text/html; charset=UTF-8");
header("Cache-Control:no-cache");
header("Pragma:no-cache");

$CFG = include_once("../common/include/incConfig.php");

require_once("../common/include/incUtil.php");
require_once("../common/include/incUser.php");

//로그인 검사
require_once("../common/include//incLoginCheck.php");//로그인 검사

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>C.G</title>

	<meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!--jquery / json-->
	<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/jquery/jquery-1.12.4.min.js"></script>
	<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/json2.min.js"></script>

	<!--dhmltx-->
    <link rel="stylesheet" href="<?=$CFG["CFG_URL_LIBS_ROOT"]?>/lib/dhtmlxSuite/codebase/dhtmlx.css" type="text/css" charset="utf-8">	
    <script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/dhtmlxSuite/codebase/dhtmlx.js" type="text/javascript" charset="utf-8"></script>

	<!--공통-->
	<script>
		var CFG_URL_LIBS_ROOT = "<?=$CFG["CFG_URL_LIBS_ROOT"]?>";
	</script>
    <script src="/common/common.js" type="text/javascript" charset="utf-8"></script>

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
	var accessToken = "<?=getAccessToken()?>";

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

        //myTabbar.setSkin('dhx_skyblue');
        myTabbar.enableAutoReSize(true);
		myTabbar.enableTabCloseButton(true);


		//트리
		myTree = myLayout.cells("a").attachTree();
		myTree.setImagePath("<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/dhtmlxSuite/codebase/imgs/dhxtree_skyblue/");
		myTree.loadXML("../c.g/menu_data.php?etc="+new Date().getTime());
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

        mnu_nm = myTree.getItemText(id);
        mnu_seq = id.split("^")[0];
        url = id.split("^")[1];
         
        if(myTabbar.tabs(mnu_seq)){
            //myTabbar.tabs(id).set_actions(true);
            myTabbar.tabs(mnu_seq).setActive();
        }else if(id.split("^").length > 1){
			//alert("url go 1");
            myTabbar.addTab(mnu_seq, mnu_nm, null, null, true );
			//myTabbar.tabs(id).attachURL("cg_pjtinfo.php");
			
			targetUrl = url + "?access_token=" + accessToken;
			//alert(targetUrl);

            myTabbar.tabs(mnu_seq).attachURL(targetUrl);
			//alert("url go 2");			
        }

        
    };
    </script>

</head>

<body onload="initBody();">
<div id="layoutObj" >aa</div>
</body>
</html>