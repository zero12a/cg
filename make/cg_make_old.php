<?php
/**
 * Created by PhpStorm.
 * User: zero12a
 * Date: 2014. 6. 29.
 * Time: 오후 9:32
 */

header("Content-Type: text/html; charset=UTF-8");

//설정 함수 읽기
if(!include_once './incConfig.php')	        echo "include fail(1)";
if(!include_once './include/incDB.php')			echo "include fail(2)";
if(!include_once './include/incUtil.php')		echo "include fail(3)";
if(!include_once './include/incSec.php')		echo "include fail(4)";

if(!include_once './cg_make_db_old.php')		echo "include fail(4)";
?>
    <html>
    <head><style>
            body {margin:0;padding:0}
            div,input {font-size: 11px;}

            #F_START_DT, #F_END_DT {
                border: 1px solid #909090;
            }


            .BODY_BOX {100%;background-color:yellowgreen;padding:10px 10px 10px 10px;}

            .CON_LINE {position: relative;width:100%;height:22px;line-height;122px;overflow:visible;}
            .CON_OBJGRP {position: relative;float:left;background-color: #eeeeee;height:22px;line-height:22px;vertical-align:middle ;overflow:visible;}
            .CON_LABEL {position: relative;float:left;background-color: #eeeeee;height:22px;line-height:22px;vertical-align:middle ;padding-left:5px;}
            .CON_OBJECT {position: relative;float:left;background-color: #eeeeee;height:22px;line-height:22px;vertical-align:middle ;}
            .CON_LINEPADDING {position: relative;height:10px;overflow:auto;}


            .GRID_LABELGRP {position:relative;width:100%;height:22px;z-index:20;}
            .GRID_LABEL {position:relative;float:left;width:60%;height:22px;line-height:22px;vertical-align:middle;z-index:30;}
            .GRID_LABELBTN {position: relative;float:left;width:40%;height:22px;line-height:22px;vertical-align:middle;text-align:right;z-index:30;}
            .GRID_OBJECT {position: relative;width:100%;padding:0 0 0 0;z-index:20;}

        </style></head>
    <body>
    <table width=100% border=1><?

//SeverView();

//db 오픈
//$db = db_open();
$db = db_m_open();

//전체 리플레서 정보
$G = null;

$F_PJTID = "CG";
$F_PGMID = $_GET["pgmid"];
$RstCnt = 0;
$NowFileType = "";

//pgm 정보 읽기
$obj = array2obj(getInput("OBJINFO","",$G));

$P = getInput("PGMINFO","");
if($P == null)Msg("프로그램 정보가 없습니다.");
//echo "<br>P : ";
var_dump($P);
echo "프로젝트명 : " . $P["PJTNM"];
$G = setG($G,"PGMINFO",$P);  //G################################


//기존 생성 정보 삭제
$T_SQL = sprintf("delete from CG_RST where PJTID = '%s' and PGMID = '%s' "
    , $F_PJTID
    , $F_PGMID
);

$result = $db->query($T_SQL) or ServerMsg("500","120", "[" . $db->error . "] " . $db->error) ;
//echo "<br>G : ";
//var_dump($G);


//src 불러오기
$T_SQL = sprintf("select SRCSEQ,SRCTXT,SRCORD,INPUT,PARAM,SRCTYPE,FILETYPE from CG_SRCINFO   where PJTID = '%s'  order by FILETYPE, SRCORD ASC"
    , $F_PJTID
    );

$result = $db->query($T_SQL) or ServerMsg("500","120", "[" . $db->error . "] " . $db->error) ;

while($line =  $result->fetch_assoc()  ){

    $InputM = null;
    $InputD = null;
    $InputA = null;
    $NowFileType = $line["FILETYPE"];

    //INPUT 정보가져오기
    //echo "<br>11111111";
    if($line["INPUT"] != "") $InputM = getInput($line["INPUT"],$line["PARAM"],$G);

    //자신 먼저 출력
    if($line["SRCTYPE"] == "R"){

        //치환
        MakeRst($line,"R",setG($G,$line["INPUT"],$InputM));

        //D자식있는지 검사하기
        $SrcD = getSrcD($line);

        //자식이 있으면
        //echo "<br> D자식수 : " . sizeof($SrcD);
        if(sizeof($SrcD) > 0){

            goSrcD($SrcD,setG($G,$line["INPUT"],$InputM));
        }

    }
    if($line["SRCTYPE"] == "L"){
        //echo "<br>22222222";

        //D자식있는지 검사하기
        $SrcD = getSrcD($line);

        //D자식이 없으면 input 배열로 자기 자신 loop
        //echo "<br> is array : " . is_array($SrcD);
        if( sizeof($SrcD) == 0 ){
            //echo "<br>33333333a";
            for($i=0;$i<sizeof($InputM);$i++){
                $input = $InputM[$i];
                //글로별 변수 세팅
                //setG($line["INPUT"],$input);

                //치환
                MakeRst($line,"R",setG($G,$line["INPUT"],$input));
            }
        }else{
            //echo "<br>33333333b";

            //자식D가 있으면

            //나부터 출력
            MakeRst($line,"R",setG($G,$line["INPUT"],$InputM));

            //D자식 그룹루프 출력
            for($i=0;$i<sizeof($InputM);$i++){
                $input = $InputM[$i];
                goSrcD($SrcD,setG($G,$line["INPUT"],$input));
            }
        }
    }
    if($line["SRCTYPE"] == "C"){
        if($line["INPUT"] == "BODY"){
            makeBody($G);
        }
    }
}
$result->close();



saveFile();


function saveFile(){
    global $F_PJTID,$F_PGMID,$db,$CFG_ROOT_DIR;
    $tpath = $CFG_ROOT_DIR . "rst/";



    $F_FILETYPE = "HTML";
    $tname = $F_PGMID . ".php";
    $filename = $tpath . $tname;



    if (!$handle = fopen($filename, 'w+')) {
        echo "Cannot open file ($filename)";
        exit;
    }


    //src 불러오기
    $T_SQL = sprintf("
        select *
        from CG_RST   where PJTID = '%s' and PGMID = '%s' and FILETYPE = '%s'
        order by SRCORD ASC"
        , $F_PJTID
        , $F_PGMID
        , $F_FILETYPE
    );
    //echo $T_SQL;
    $result = $db->query($T_SQL) or ServerMsg("500","120", "[" . $db->error . "] " . $db->error) ;

    while($line =  $result->fetch_assoc()  ){
        //echo HtmlEncode($line["SRCTXT"]);
        // Write $somecontent to our opened file.
        if (fwrite($handle, $line["SRCTXT"]) === FALSE) {
            echo "Cannot write to file ($filename)";
            exit;
        }
    }
    $result->close();

    echo "<BR>Success, wrote ($somecontent) to file ($filename)";

    fclose($handle);
    chmod($filename,0766);



    $F_FILETYPE = "PHP";
    $tname = $F_PGMID . "_crud.php";
    $filename = $tpath . $tname;


    // Let's make sure the file exists and is writable first.

    if (!$handle = fopen($filename, 'w+')) {
        echo "Cannot open file ($filename)";
        exit;
    }

    //src 불러오기
    $T_SQL = sprintf("
        select *
        from CG_RST   where PJTID = '%s' and PGMID = '%s' and FILETYPE = '%s'
        order by SRCORD ASC"
        , $F_PJTID
        , $F_PGMID
        , $F_FILETYPE
    );
    //echo $T_SQL;
    $result = $db->query($T_SQL) or ServerMsg("500","120", "[" . $db->error . "] " . $db->error) ;

    while($line =  $result->fetch_assoc()  ){
        //echo HtmlEncode($line["SRCTXT"]);
        // Write $somecontent to our opened file.
        if (fwrite($handle, $line["SRCTXT"]) === FALSE) {
            echo "Cannot write to file ($filename)";
            exit;
        }
    }
    $result->close();

    echo "<BR>Success, wrote ($somecontent) to file ($filename)";

    fclose($handle);
    chmod($filename,0766);

}

function makeBody($G){
    $body="";

    //PGMINFOD 기준으로 컨디션 생성
    $PgminfoD = getInput("PGMINFOD",$param="",$G);

    //개행 태그 불러오기
    $Brgrp = array2hash(getInput("CODED","PCD=BRGRP",""));

    for($k=0;$k<sizeof($PgminfoD);$k++){
        $pgm = $PgminfoD[$k];

        //$io = $Ioinfo[$k];
        if($k ==0){
            $Body .= R($Brgrp["LINESTART"],setG($G,"PGMINFOD",$pgm));
        }
        if( $k>0 && $PgminfoD[$k-1]["BRYN"] =="Y" ){
            $Body .= R($Brgrp["LINEEND"],setG($G,"PGMINFOD",$pgm));
            $Body .= R($Brgrp["LINEPADDING"],setG($G,"PGMINFOD",$pgm));
            $Body .= R($Brgrp["LINESTART"],setG($G,"PGMINFOD",$pgm));
        }

        $Body .= R($Brgrp["OBJGRPSTART"],setG($G,"PGMINFOD",$pgm));

        //echo "<br>grptype : " . $pgm["GRPTYPE"];
        //echo "<br> : " . $io["COLNM"];
        if($pgm["GRPTYPE"] == "CONDITION"){
            $Body .= R($Brgrp["CONDITIONSTART"],setG($G,"PGMINFOD",$pgm));
            $Body .= getCondition(setG($G,"PGMINFOD",$pgm));
            $Body .= R($Brgrp["CONDITIONEND"],setG($G,"PGMINFOD",$pgm));
        }else if($pgm["GRPTYPE"] == "DETAIL"){
                $Body .= R($Brgrp["DETAILSTART"],setG($G,"PGMINFOD",$pgm));
                $Body .= getDetail(setG($G,"PGMINFOD",$pgm));
                $Body .= R($Brgrp["DETAILEND"],setG($G,"PGMINFOD",$pgm));
        }else if($pgm["GRPTYPE"] == "GRID"){

            $Body .= getGrid($pgm,setG($G,"PGMINFOD",$pgm));
        }

        $Body .= R($Brgrp["OBJGRPEND"],setG($G,"PGMINFOD",$pgm));
    }
    if($k>0) $Body .= R($Brgrp["LINEEND"],setG($G,"PGMINFOD",$pgm));

    //var_dump($Ioinfo);
    //var_dump($Brcol);
    //var_dump($obj);
    //오브젝트 정보 불러오기

    //echo "<br>sizeof : " .sizeof($Ioinfo) ;
    //exit;

    //echo "<hr>";
    //echo HtmlEncode($Body);
    //echo "<hr>";

    //echo $Body;
    $NowFileType = "HTML";
    saveRst($Body);
}


function getGrid($pgm,$G){
    global $Brcol,$Brgrp,$obj;
    $Body = "";

    //IO정보 불러오기
    $Ioinfo = getInput("IOINFO",$param="",$G);


    for($k=0;$k<sizeof($Ioinfo);$k++){
        //if($k>10)break;
        //if($k>0 && ($k+$Ioinfo["COLCNT"]) % $Ioinfo["COLCNT"] == 0){}
    }

    $G = setG($G,"PGMINFOD",$pgm);

    //echo "<table>";
    //echo "<tr>";
    //echo "<td>".HtmlEncode($obj["GRID"]["COLLBLTXT"]);
    //echo "<td>".HtmlEncode(R($obj["GRID"]["COLLBLTXT"],$G));
    //echo "<td>".HtmlEncode($obj["GRID"]["COLOBJTXT"]);
    //echo "<td>".HtmlEncode(R($obj["GRID"]["COLOBJTXT"],$G));
    //echo "</tr></table>";
    $Body .= R($obj["GRID"]["COLLBLTXT"],$G);
    $Body .= R($obj["GRID"]["COLOBJTXT"],$G);

    return $Body;
}

function getCondition($G){
    global $Brcol,$Brgrp,$obj;
    $Body = "";

    //IO정보 불러오기
    $Ioinfo = getInput("IOINFO.CONDITION",$param="",$G);

    $Brcol = array2hash(getInput("CODED","PCD=BRCOL",""));


    $Body .= "\t". $Brcol["LINESTART"] ."\n";
    for($k=0;$k<sizeof($Ioinfo);$k++){
        $io = $Ioinfo[$k];
        if( $k>0 && $Ioinfo[$k-1]["BRYN"] =="Y" ){
            $Body .= $Brcol["LINEEND"]."\n";
            $Body .= $Brcol["LINEPADDING"]."\n";
            $Body .= $Brcol["LINESTART"]."\n";
        }

        $Body .= "\t\t". $Brcol["OBJGRPSTART"];
        //echo "<br>objtype : " . $io["OBJTYPE"];
        //echo "<br> : " . $io["COLNM"];
        $Body .= "\t\t\t". R($obj[$io["OBJTYPE"]]["COLLBLTXT"],setG($G,"IOINFO",$io))."\n";
        $Body .= "\t\t\t". R($obj[$io["OBJTYPE"]]["COLOBJTXT"],setG($G,"IOINFO",$io))."\n";
        $Body .= "\t\t". $Brcol["OBJGRPEND"]."\n";

        //if($k>10)break;
        //if($k>0 && ($k+$Ioinfo["COLCNT"]) % $Ioinfo["COLCNT"] == 0){}
    }
    $Body .= "\t". $Brcol["LINEEND"]."\n";

    return $Body;
}


function getDetail($G){
    global $Brcol,$Brgrp,$obj;
    $Body = "";

    //IO정보 불러오기
    $Ioinfo = getInput("IOINFO",$param="",$G);

    $Brcol = array2hash(getInput("CODED","PCD=BRCOL",""));


    $Body .= "\t". $Brcol["LINESTART"] ."\n";
    for($k=0;$k<sizeof($Ioinfo);$k++){
        $io = $Ioinfo[$k];
        if( $k>0 && $Ioinfo[$k-1]["BRYN"] =="Y" ){
            $Body .= $Brcol["LINEEND"]."\n";
            $Body .= $Brcol["LINEPADDING"]."\n";
            $Body .= $Brcol["LINESTART"]."\n";
        }

        $Body .= "\t\t". $Brcol["OBJGRPSTART"];
        //echo "<br>objtype : " . $io["OBJTYPE"];
        //echo "<br> : " . $io["COLNM"];
        $Body .= "\t\t\t". R($obj[$io["OBJTYPE"]]["COLLBLTXT"],setG($G,"IOINFO",$io))."\n";
        $Body .= "\t\t\t". R($obj[$io["OBJTYPE"]]["COLOBJTXT"],setG($G,"IOINFO",$io))."\n";
        $Body .= "\t\t". $Brcol["OBJGRPEND"]."\n";

        //if($k>10)break;
        //if($k>0 && ($k+$Ioinfo["COLCNT"]) % $Ioinfo["COLCNT"] == 0){}
    }
    $Body .= "\t". $Brcol["LINEEND"]."\n";

    return $Body;
}


function array2obj($array){
    $T=null;
    for($i=0;$i<sizeof($array);$i++){
        $T[$array[$i]["COLTYPE"]]["COLLBLTXT"] = $array[$i]["COLLBLTXT"];
        $T[$array[$i]["COLTYPE"]]["COLOBJTXT"] = $array[$i]["COLOBJTXT"];
    }
    return $T;
}

function goSrcD($SrcD,$G){
    //echo "<br>--goSrcD----------------------------------------------------";
    //echo "<br>goSrcD : " . sizeof($SrcD);
    //D자식이 있으면 자식을 loop

    for($i=0;$i<sizeof($SrcD);$i++){
        //echo "<br>D 루프 : " . $i;
        //INPUT 정보가져오기
        $lineD = $SrcD[$i];
        //echo "[[[";
        // var_dump($lineD);
        //echo "[[[";
        //echo "<br>D SRCTYPE : " . $lineD["SRCTYPE"];
        $InputD = null;
        if($lineD["INPUT"] != "") $InputD = getInput($lineD["INPUT"],$lineD["PARAM"],$G);


        //바로 해쉬맵이면
        //echo "<BR> InputD ".$lineD["INPUT"]." size of : " . sizeof($InputD);

        //자신 먼저 출력
        if($lineD["SRCTYPE"] == "R"){

            //치환
            MakeRst($lineD,"R",setG($G,$lineD["INPUT"],$InputD));

            //A자식있는지 검사하기
            $SrcA = getSrcA($lineD);
            if( sizeof($SrcA) > 0 ){
                goSrcA($SrcA,setG($G,$lineD["INPUT"],$InputD));
            }
        }
        if($lineD["SRCTYPE"] == "L"){
            //A자식있는지 검사하기
            $SrcA = getSrcA($lineD);

            //A자식이 없으면 inputD 배열로 자기 자신 loop
            if( sizeof($SrcA) == 0 ){


                for($j=0;$j<sizeof($InputD);$j++){
                    $input = $InputD[$j];
                    //echo "<br>inpputD $j : " . $input["GRPID"];
                    //var_dump($input);

                    //SPLIT TXT 처리 (SPTTXT)
                    $lineDTmp = $lineD;
                    $lineDTmp["SRCTXT"] = ($j+1 == sizeof($InputD))? $lineDTmp["SRCTXT"] : $lineDTmp["SRCTXT"].$lineDTmp["SPTTXT"];

                    //치환
                    MakeRst($lineDTmp,"R",setG($G,$lineD["INPUT"],$input));
                }


            }else{
                //자식A가 있으면

                //D부터 출력
                MakeRst($lineD,"R",setG($G,$lineD["INPUT"],$InputM));

                //A로 이동
                for($j=0;$j<sizeof($InputD);$j++){
                    $input = $InputD[$j];
                    goSrcA($SrcA,setG($G,$lineD["INPUT"],$input));
                }
            }

        }


    }
}

function goSrcA($SrcA,$G){
    //echo "<br>--goSrcA----------------------------------------------------";

    //A자식이 있으면 자식을 loop
    for($j=0;$j<sizeof($SrcA);$j++){
        //INPUT 정보가져오기
        $lineA = $SrcA[$j];
        $InputA = null;
        if($lineA["INPUT"] != "") $InputA = getInput($lineA["INPUT"],$lineA["PARAM"],$G);

        //echo "<font color=blue>[[[";
        //var_dump($lineA);
        //echo "]]]";
        //echo "<br>A INPUT : " . $lineA["INPUT"];
        //echo "<br>A SRCTYPE : " . $lineA["SRCTYPE"];
        //echo "<br>A sizeof inputA : " . sizeof($InputA);
        //if($lineA["INPUT"] == "IOINFO")exit;
        //echo "</font>";

        //자신 먼저 출력
        if($lineA["SRCTYPE"] == "R"){

            //치환
            MakeRst($lineA,"R",setG($G,$lineA["INPUT"],$InputA));
        }
        if($lineA["SRCTYPE"] == "L"){

            //2차원 배열이면 루프 GO
            //echo "<br>바로 input 배열";
            for($i=0;$i<sizeof($InputA);$i++){
                $input = $InputA[$i];

                //SPLIT TXT 처리 (SPTTXT)
                $lineATmp = $lineA;
                $lineATmp["SRCTXT"] = ($i+1 == sizeof($InputA))? $lineATmp["SRCTXT"] : $lineATmp["SRCTXT"].$lineATmp["SPTTXT"];

                //치환
                MakeRst($lineATmp,"R",setG($G,$lineA["INPUT"],$input));
            }
        }
    }
}


function setG($G, $input, $tarray){
    $SetArray = null;
    //Global $G;
    // {GS.GE}
    $GS = "";

    if($input == "PGMINFOD"){
       $GS = "G";
    }
    if($input == "PGMINFOD.REF" || $input == "CONDITION.REF"){
       $GS = "GF";
    }
    if($input == "PGMINFO"){
        $GS = "P";
    }
    if($input == "SQLINFO"){
        $GS = "S";
    }
    if($input == "IOINFO" || $input == "IOINFO.CONDITION"){
        $GS = "I";
    }
    if($input == "IOINFO.REF"){
        $GS = "IF";
    }


    //echo "sieof : " . sizeof($tarray);
    if($tarray != null && !is_assoc($tarray)){
        //해쉬맵 아님
        //echo "해쉬맵 아님 ";
        $SetArray = $tarray[0];
    }else{
        //해쉬맵
        //echo "해수맵";
        $SetArray = $tarray;

    }// echo "<font color=red>해쉬맵 아님</font>";

    if($GS == "GF" && 1==2){
        echo "<font color=red><br> G $GS ADD : " ;
        var_dump($tarray);
        echo "</font>";
    }
    $G[$GS] = $SetArray;

    return $G;
}








function makeRst($line,$type,$G){
    Global $db,$F_PJTID,$F_PGMID;
    $rsttxt = "";
    //로그인 처리
    if($type == "R"){

        $rsttxt = R($line["SRCTXT"],$G);

        echo "<tr>";
        echo "<td style='width:5%;word-wrap:break-word;font-size:10pt;'>" . $line["SRCORD"] ."-" . $line["SRCDORD"] ."-" . $line["SRCAORD"] . "</td>";
        echo "<td style='width:45%;word-wrap:break-word;font-size:10pt;'><pre>" . HtmlEncode( $line["SRCTXT"] ) . "</pre></td>";
        echo "<td style='width:50%;word-wrap:break-word;font-size:10pt;'><pre>" . HtmlEncode( $rsttxt ) . "</pre></td>";
        echo "</tr>";
    }
    if($type == "L"){

        echo "<tr>";
        echo "<td>" . $line["SRCORD"] ."-" . $line["SRCDORD"] ."-" . $line["SRCAORD"] . "</td>";
        echo "<td><pre>" . HtmlEncode( $line["SRCTXT"] ) . "</pre></td>";
        echo "<td><pre>" . HtmlEncode( L($line["SRCTXT"],$line2) ) . "</pre></td>";
        echo "</tr>";
    }

    saveRst($rsttxt);
}


function saveRst($rsttxt){
    Global $db,$F_PJTID,$F_PGMID,$RstCnt,$NowFileType;
    $RtnVal=null;
    $RstCnt = $RstCnt + 1;
    //echo "<br>RstCnt : " . $RstCnt;
    $T_SQL = sprintf("
        insert into CG_RST (PJTID,PGMID,FILETYPE,SRCORD,SRCTXT,ADDDT) values (
            '%s', '%s', '%s', %d, '%s', %s
        )
        "
        , $F_PJTID
        , $F_PGMID
        , $NowFileType
        , $RstCnt
        , mysql_real_escape_string($rsttxt)
        , "date_format(sysdate(),'%Y%m%d%H%i%s')"
    );
    //echo "<br> rsstxt : " . $rsttxt;
    //echo "<br> saveRst :  " . $T_SQL;
    $db->query($T_SQL) or ServerMsg("500","saveRst-100", "[" . $db->errno . "] " . $db->error) ;

    //$line2 = null;
    //$RtnVal = mysqli_fetch_all($result2,MYSQLI_ASSOC);

    //$result2->close();

    return $RtnVal;
}


?>
</table></body></html>
<?
//리플레이스 처리
function R($org,$G){
    //Global $G;
    $MatLimit = 100;
    $MatCnt = 0;
    $RtnVal = $org;
    //echo "<font color=blue>G <pre>";
    //var_dump($G);
    $RtnVal = str_replace("{SELF}","{G.GRPID}_{I.COLID}",$RtnVal);

    while(ereg("{([PGFSI]+)\.([a-zA-Z0-9]+)([-+]*)([0-9]*)}",$RtnVal,$mat)){
        echo "<br>org : " . HtmlEncode($org);
        echo "<br>매칭0 : " . $mat[0];
        echo "<br>매칭1 : " . $mat[1];
        echo "<br>매칭2 : " . $mat[2];
        echo "<br>매칭3 : " . $mat[3];
        echo "<br>매칭4 : " . $mat[4];
        $sval = "{". $mat[1] .".". $mat[2] .  $mat[3] .  $mat[4] . "}";

        //echo "<br>sval : " . $sval;

        //echo "<br>org : " . $org;
        if($mat[3] !="" && is_numeric($mat[4])){
            $tval = num_math($G[$mat[1]][$mat[2]],$mat[3],$mat[4]); //수식 계산 replace
        }else{
            $tval = $G[$mat[1]][$mat[2]]; //일반 replace
        }
        echo "<br>치환 (tval) : " . $tval;
        $RtnVal = str_replace($sval,$tval,$RtnVal);

        //치환된 fninit등에 {SELF}가 있을 수 있으므로 다시 치환
        $RtnVal = str_replace("{SELF}","{G.GRPID}_{I.COLID}",$RtnVal);

        //echo "<br>RtnVal : " . $RtnVal;

        $MatCnt++;
        if($MatCnt >= $MatLimit)break;
    }
    //echo "</pre></font>";

return $RtnVal;
}

function num_math($asis,$oper,$val){
    echo "<br>num_math 1: " . $asis;

    $RtnVal = "";
    if(eregi("([0-9]+)(px|%)",$asis,$mat)){
        if($oper == "-"){
           $RtnVal = intval($mat[1]) - $val;
           $RtnVal .= $mat[2];
        }else if($oper == "+")    {
            $RtnVal = intval($mat[1]) + $val;
            $RtnVal .= $mat[2];
        }else{
            $RtnVal = $asis;
        }
    }else{

        $RtnVal = $asis;
    }
    echo "<br>num_math 2: " . $RtnVal;
    return $RtnVal;
}

//리플레이스 루프
function L($org,$tarray){
    $RtnVal = "";
    $AddVal = "";
    $RVal = R($org);
    //echo "<br>RVal : " . $RVal;
    //echo "<br> is array : " . is_array($tarray);
    if(is_array($tarray)){
        //echo "<br> is length : " . sizeof($tarray);
        for($i=0;$i<sizeof($tarray);$i++){
            $LL = $tarray[$i];
            $AddVal = $RVal;
            while(ereg("{G\.([a-zA-Z0-9]+)}",$AddVal,$mat)){
                //echo "<br>매칭 : " . $LL[$mat[1]];
                $sval = "{G.". $mat[1] . "}";
                $tval = $LL[$mat[1]];
                //echo "<br> sval : " . $sval;
                //echo "<br> tval : " . $tval;
                $AddVal = str_replace($sval,$tval,$AddVal);
            }
            while(ereg("{I\.([a-zA-Z0-9]+)}",$AddVal,$mat)){
                //echo "<br>매칭 : " . $LL[$mat[1]];
                $sval = "{I.". $mat[1] . "}";
                $tval = $LL[$mat[1]];
                //echo "<br> sval : " . $sval;
                //echo "<br> tval : " . $tval;
                $AddVal = str_replace($sval,$tval,$AddVal);
            }

            $RtnVal .= $AddVal;
        }
    }
    return $RtnVal;
}





db_close3($db); //db 닫기

//멋집니다. ㅎㅎㅎㅎ

?>