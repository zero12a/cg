<?php
/**
 * Created by PhpStorm.
 * User: zero12a
 * Date: 2014. 7. 12.
 * Time: 오후 3:27
 */
function makeRst($line,$type,$G){
	//mlog("makeRst---------------------------------------start");

    Global $db,$F_PJTSEQ,$F_PGMSEQ, $ENV;
    $rsttxt = "";

	$ENV["MAKE_RST_NOW"]++;
	if($ENV["MAKE_RST_NOW"]>=$ENV["MAKE_RST_MAX"]){rlog("MAKE_RST_MAX를 초과했습니다.");exit;}

    //로그인 처리

	$rsttxt = R($line["SRCTXT"],$G);
    
    if($ENV["MAKE_DEBUG"]){
        echo "<tr>";
        echo "<td>" . $type . "</td>";
        echo "<td>" . $line["OBJTYPE"] . "</td>";
        echo "<td>" . $line["OBJVAL"] . "</td>";
        echo "<td>" . $line["INPUT"] . "</td>";
        echo "<td>" . $line["SRCTYPE"] . "</td>";
        echo "<td>" . $line["FILTER"] . "</td>";
        echo "<td>D" . $line["OBJDSEQ"] . "</td>";
        echo "<td>A" . $line["OBJASEQ"] . "</td>";
        echo "<td>B" . $line["OBJBSEQ"] . "</td>";
        echo "<td style='width:45%;word-wrap:break-word;font-size:10pt;'><pre>" . HtmlEncode( $line["SRCTXT"] ) . "</pre></td>";
        echo "<td style='width:50%;word-wrap:break-word;font-size:10pt;'><pre>" . HtmlEncode( $rsttxt ) . "</pre></td>";
        if($line["DEBUGYN"] != "N"){
            echo "<td><textarea onclick='alert(this.value)' style='width:30px;height:30px;'>" . $line["DEBUGYN"] . "\n";
            print_r($G[$line["DEBUGYN"]]);
            echo "</textarea></td>";
        }else{
            echo "<td>" . $line["DEBUGYN"] . "</td>";
        }
        echo "</tr>";
    }

	

    saveRst($rsttxt);
	//mlog("makeRst---------------------------------------end");
}

function setG($G, $input, $tarray){
    $SetArray = null;
    //Global $G;
    // {GS.GE}
    $GS = "";

	//input 및 배열 유효성 검사
	if($input == "" || $tarray == null || sizeof($tarray) ==0 || !is_assoc($tarray) )return $G;


    if($input == "PGMGRP" || $input == "PGMGRP.OBJD" ){
       $GS = "G";
	}else if( $input == "PGMGRP.FNC.OBJD"){
       $GS =  array("G","F");
    }else if( $input == "PGMFNC" || $input == "PGMFNC.OBJD"){
       $GS = "F";
	}else if( $input == "PGMFNC.DIRECT" ){
		$GS = array("G","F");
    }else if($input == "PGMGRP.REF" || $input == "CONDITION.REF" || $input == "PGMGRP.CHILD"){
       $GS = "GR";
    }else if($input == "PGMINFO" || $input == "IMPORTCSS" || $input == "IMPORTJS" || $input == "HEADSTYLE"){
        $GS = "P";
    }else if($input == "PGMPARAM"){
        $GS = "A";
    }else if($input == "PJTCFG"){
        $GS = "C";
    }else if($input == "PGMSQL" || $input == "PGMSQLD" || $input == "PGMSQLR" || $input == "PGMSQL.SVC" || $input == "PGMSQL.USEDSVR"
         || $input == "PGMSQLD.HINT"){
        $GS = "S";
    }else if($input == "PGMSVC.OBJD" || $input == "PGMSVC.OBJD.JS" || $input == "PGMSVC.LIST" ){
		//PGMSVC.OBJD는 SVC서비스 하위 SQLID갯수 만큼 ROW 반환
		//PGMSVC.LIST는 FNC에 물려있는 SVC리스트만 반환
        $GS = "V";
    }else if($input == "PGMIO" || $input == "PGMIO.CONDITION" || $input == "PGMIO.OBJ" ||  $input == "PGMIO.CHILD" 
            ||  $input == "PGMIO.PARENT" ||  $input == "PGMIO.ADDROWS" || $input == "PGMIO.KEYCOL" || $input == "PGMIO.KEYCOL.SVC"
            || $input == "PGMIO.SVC" || $input == "PGMIO.OBJ.SVC" || $input == "PGMIO.SEQYN" 
			){
        $GS = "I";
    }else if($input == "PGMIO.REF"){
        $GS = "IR";
    }else{
		$GS = $input;
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
	if(is_array($GS)){
		foreach($GS as $GG) {
			$G[$GG] = $SetArray;
		}	
	}else{
	    $G[$GS] = $SetArray;
	}
	//mlog("★ setG1 " . $GS . " GRPID = " . $G["G"]["GRPID"]);
	//mlog("★ setG2 " . $GS . " FNCID = " . $G["G"]["FNCID"]);
	//mlog("★ setG3 " . $GS . " SQLID = " . $G["S"]["SQLID"]);
	//mlog("★ setG4 " . $GS . " COLID = " . $G["I"]["COLID"]);

    return $G;
}







function array2obj($array){
    $T=null;
    for($i=0;$i<sizeof($array);$i++){
        $T[$array[$i]["OBJTYPE"]]["LBLTXT"] = $array[$i]["LBLTXT"];
        $T[$array[$i]["OBJTYPE"]]["OBJTXT"] = $array[$i]["OBJTXT"];
    }
    return $T;
}


function num_math($asis,$oper,$val){
    //alog("★★★★★★★ num_math()........asis : " . $asis . ", oper : " . $oper  . ", val : " . $val);
    //echo "<br>num_math 1: " . $asis;
    //echo "<br>num_math oper: " . $oper;
    //echo "<br>num_math val: " . $val;

    $RtnVal = "";
    if(preg_match("/^([0-9]+)(|px|PX|%)$/",$asis,$mat)){
        //alog("  mat0 : " . $mat[0]);
        //alog("  mat1 : " . $mat[1]);
        //alog("  mat2 : " . $mat[2]);
        //alog("  mat3 : " . $mat[3]);

        
    //if(eregi("([0-9]+)",$asis,$mat)){
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
    //alog("★★★★★★★   RtnVal : " . $RtnVal);
    //echo "<br>num_math 2: " . $RtnVal;
    return $RtnVal;
}



//리플레이스 처리
function R($org,$G){
    //Global $G;
    $MatLimit = 100;
    $MatCnt = 0;
    $RtnVal = $org;
    //echo "<font color=blue>G <pre>";
    //var_dump($G);
    $RtnVal = str_replace("{SELF}","{G.GRPID}_{I.COLID}",$RtnVal);

    while(preg_match("/{([APGFSIRVC]+)\.([a-zA-Z0-9_]+)([-+#@]*)([0-9a-zA-Z:]*)}/",$RtnVal,$mat)){
        //echo "<br>org : " . HtmlEncode($org);
        //echo "<br>매칭0 : " . $mat[0];
        //alog("	GGGG : " . $G["P"]["PGMID"]);
        //alog("	매칭1 : " . $mat[1]);
        //alog("	매칭2 : " . $mat[2]);
        //alog("	매칭3 : " . $mat[3]);
        //alog("	매칭4 : " . $mat[4]);
        $sval = "{". $mat[1] .".". $mat[2] .  $mat[3] .  $mat[4] . "}";

        //echo "<br>sval : " . $sval;

        //echo "<br>org : " . $org;
		//alog(" 치환 (sval) : " . $sval );
		$tval = "";
        if($mat[3] != ""){
			//if( ($mat[3] == "-" || $mat[3] == "+"  ) && is_numeric($mat[4]) ) { 
			if( $mat[3] == "-" || $mat[3] == "+"  ) { 
				$tval = num_math($G[$mat[1]][$mat[2]],$mat[3],$mat[4]); //수식 계산 replace
			}else if($mat[3] == "#"){ //문자 처리
				switch ($mat[4]){
					case "C" : //CAMEL표기법
						$tval = ucwords(strtolower($G[$mat[1]][$mat[2]]));
						break;
					case "U" : //대문자
						$tval = strtoupper($G[$mat[1]][$mat[2]]);
						break;
					case "L" : //소문자
						$tval = strtolower($G[$mat[1]][$mat[2]]);
						break;
					default:
						rlog("R : # 이후 명령어 없음");
						break;
				}
			}else if($mat[3] == "@"){//디펄트 표기법 
				list($type,$addval) = split(":",$mat[4]);
				switch ($type){
					case "NUM" : //숫자일 경우
						if( is_numeric( $G[$mat[1]][$mat[2]] ) ){
							$tval = $G[$mat[1]][$mat[2]] . $addval;
						}else{
							$tval = $G[$mat[1]][$mat[2]];
						}
						break;
					default:
						rlog("R : @ 이후 명령어 없음");
						break;
				}
			}else{
				rlog("R : 수식없음(" . $mat[3] . ")");
			}
        }else{
            $tval = $G[$mat[1]][$mat[2]]; //일반 replace
        }
        //alog(" 치환 (tval) : " . $tval );
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
            while(preg_match("/{G\.([a-zA-Z0-9]+)}/",$AddVal,$mat)){
                //echo "<br>매칭 : " . $LL[$mat[1]];
                $sval = "{G.". $mat[1] . "}";
                $tval = $LL[$mat[1]];
                //echo "<br> sval : " . $sval;
                //echo "<br> tval : " . $tval;
                $AddVal = str_replace($sval,$tval,$AddVal);
            }
            while(preg_match("/{I\.([a-zA-Z0-9]+)}/",$AddVal,$mat)){
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
?>
