<?php
//PGMID : AUTHMNG
//PGMNM : D 권한관리
header("Content-Type: text/html; charset=UTF-8"); //HTML

require_once("../include/incUtil.php");
require_once("../include/incRequest.php");
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>	
<title>D 권한관리</title>
<meta http-equiv="Context-Type" context="text/html;charset=UTF-8" />
<!--CSS/JS 불러오기-->
<script src="../lib/jquery-1.11.1.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY CORE-->
<script src="../lib/jquery-ui-1.11.1.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY UI-->
<script src="../lib/json2.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY JSON-->
<script src="../lib/dhtmlxSuite/codebase/dhtmlx.js" type="text/javascript" charset="UTF-8"></script> <!--DHTMLX CORE-->
<script src="../common/common.js" type="text/javascript" charset="UTF-8"></script> <!--DHTMLX EXT-->
<link rel="stylesheet" href="../lib/dhtmlxSuite/codebase/dhtmlx.css" type="text/css" charset="UTF-8"><!--DHTMLX CORE-->
<link rel="stylesheet" href="../lib/jquery-ui-1.8.18.css" type="text/css" charset="UTF-8"><!--JQUERY UI-->
<script src="authmng.js?<?=getRndVal(10)?>"></script>
<link href="../common/common.css" rel="stylesheet" type="text/css" />
<script>
    var grpId = "<?=reqPostString("GRPID",20)?>";
    var rowId = "<?=reqPostString("ROWID",30)?>";
    var colId = "<?=reqPostString("COLID",30)?>";
    var btnNm = "<?=reqPostString("BTNNM",30)?>";
    function bodyInit(){
        
        if(opener) {
            //상속받기
            jsonObj = opener.popInit(grpId,rowId,colId);//상속받아 오기
        
            //(컨디션)상속 받은값 세팅
            alert("bodyInit().......AUTH_SEQ = "  + jsonObj.AUTH_SEQ);
            //alert("AUTH_SEQ2 = "  + jsonObj.AUTH_SEQ2);
        }else{
            alert("오프너[부모창]가 없습니다.");
        }
    }

    function goReturn(){
        if(opener){
            //(그리드)리턴보낼 값 말기
            jsonObj = jQuery.parseJSON('{ "__NAME":"popInit"' +
            ', "CD" : "' + q("333333") + '"' +
            ', "NM" : "' + q("444444") + '"' +
            '}');

            opener.popReturn(grpId,rowId,colId,btnNm,jsonObj);//돌려주기
        }else{
            alert("오프너[부모창]가 없습니다.");
        }
    }
</script>
</head>
<body onload="bodyInit();">

<input type="button" name="BTN_G2_SAVE" value="goReturn" onclick="goReturn();">

BTNSEQ <input type=text value="<?=getFilter(reqPostString("BTNSEQ",30),"","")?>">

</body>
</html>
