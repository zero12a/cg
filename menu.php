<?php
header("Content-Type: text/html; charset=UTF-8");
header("Cache-Control:no-cache");
header("Pragma:no-cache");

	//로그인 검사
    require_once("./include/incUtil.php");
    require_once("./include/incUser.php");
    require_once("./incConfig.php");

    require_once("./include/incLoginCheck.php");//로그인 검사

?><!--conf-->

<!--conf
<sample in_favorites="false">
              <product version="1.5" edition="pro"/>
                     <modifications>
                            <modified date="070101"/>
                     </modifications>
               </sample>
 --> 
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>MENU</title>


    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <script src="./lib/dhtmlxSuite/codebase/dhtmlx.js" type="text/javascript" charset="utf-8"></script>
    <script src="./lib/dhtmlxConnector/samples/dhtmlx/dhtmlxdataprocessor.js" type="text/javascript" charset="utf-8"></script>
    <script src="./lib/dhtmlxConnector/codebase/connector.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="./lib/dhtmlxSuite/codebase/dhtmlx.css" type="text/css" charset="utf-8">
    <style>

        body {margin:0;padding:0}
    </style>

    <script>
    var myTabbar;
    function initBody(){
        tree=new dhtmlXTreeObject("treeboxbox_tree","100%","100%",0);

        tree.setSkin('dhx_skyblue');
        tree.setImagePath("./lib/dhtmlxSuite/codebase/imgs/dhxtree_skyblue/");
        tree.enableTreeLines(false);
        tree.loadXML("./menu_data.xml");
        tree.setOnClickHandler(tonclick);


        myTabbar = new dhtmlXTabBar({
                    parent: "my_tabbar",
                    close_button: true
                }
        );
        myTabbar.setSkin('dhx_skyblue');
        myTabbar.enableAutoReSize(true);



    }

    function tonclick(id){
        console.log(tree.getItemText(id));


        //void addTab(mixed id,string text,int width,int position,boolean active,boolean close);

        if(id =="pjtinfo"){
            if(myTabbar.tabs(id)){
                //myTabbar.tabs(id).set_actions(true);
                myTabbar.tabs(id).setActive();
            }else{
                myTabbar.addTab(id, "프로젝트", 100, null, true);
                myTabbar.tabs(id).attachURL("cg_pjtinfo.php");
            }

        }
        if(id =="code"){
            if(myTabbar.tabs(id)){
                myTabbar.tabs(id).setActive();
            }else{
                myTabbar.addTab(id, "코드", 80, null, true);
                myTabbar.tabs(id).attachURL("cg_code.php");
            }
        }
        if(id =="objinfo"){
            if(myTabbar.tabs(id)){
                myTabbar.tabs(id).setActive();
            }else{
                myTabbar.addTab(id, "오브젝트", 100, null, true);
                myTabbar.tabs(id).attachURL("cg_objinfo.php");
            }
        }

        if(id =="pgminfo"){
            if(myTabbar.tabs(id)){
                myTabbar.tabs(id).setActive();
            }else{
                myTabbar.addTab(id, "프로그램", 100, null, true);
                myTabbar.tabs(id).attachURL("cg_pgminfo.php");
            }
        }
        if(id =="pgminfo2"){
            if(myTabbar.tabs(id)){
                myTabbar.tabs(id).setActive();
            }else{
                myTabbar.addTab(id, "프로그램2", 100, null, true);
                myTabbar.tabs(id).attachURL("cg_pgminfo2.php");
            }
        }


        if(id =="srcinfo"){
            if(myTabbar.tabs(id)){
                myTabbar.tabs(id).setActive();
            }else{
                myTabbar.addTab(id, "소스", 100, null, true);
                myTabbar.tabs(id).attachURL("cg_srcinfo.php");
            }
        }

        if(id =="layout"){
            if(myTabbar.tabs(id)){
                myTabbar.tabs(id).setActive();
            }else{
                myTabbar.addTab(id, "레이아웃", 100, null, true);
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

        if(id =="url"){
            if(myTabbar.tabs(id)){
                myTabbar.tabs(id).setActive();
            }else{
                myTabbar.addTab(id, "URL", 100, null, true);
                myTabbar.tabs(id).attachURL("bc_url.php");
            }
        }
    };
    </script>

</head>

<body onload="initBody();">

<div style="width:100%;height:100%;background-color: #d3d3d3;">
<div id="treeboxbox_tree" style="position:relative;float:left;width:12%; height:100%;background-color:#f5f5f5;"></div>
<div id="my_tabbar" style="position:relative;float:left;width:88%; height:100%;"></div>
</div>


</body>
</html>