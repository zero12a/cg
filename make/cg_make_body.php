<?php
/**
 * Created by PhpStorm.
 * User: zero12a
 * Date: 2014. 7. 12.
 * Time: 오후 3:26
 */


function makeBody($G){
    mlog("makebody -----------------------------start");
    $body="";

    //PGMGRP 기준으로 컨디션 생성
    $PGMGRP = getInput("PGMGRP.OBJ",$param="",$G);


    mlog("	PGMGRP sizeof : " . sizeof($PGMGRP));
    for($k=0;$k<sizeof($PGMGRP);$k++){
		mlog("	PGMGRP : " . $k);
        $pgm = $PGMGRP[$k];

		$OBJINFOD = getInput("OBJINFOD","FILETYPE=HTMLBODY",setG($G,"PGMGRP",$pgm));

		mlog("	OBJINFOD sizeof : " . sizeof($OBJINFOD));
		if( sizeof($OBJINFOD) > 0 ){
			goJsD($OBJINFOD,setG($G,"PGMGRP",$pgm));
		}

    }
	exit;
    $NowFileType = "HTML";
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

    $Body .= "\n\t\t\t\t\t\t". R($pgm["OBJTXT"],    setG($G,"PGMGRP",$pgm));

	mlog("Body : " . $Body);

    return $Body;
}


function getBtn($G){
	mlog("getBtn-------------------------------------------------------start");
    global $Brcol,$Brgrp,$obj;
    $Body = "";

    //FNC BUTTON정보 불러오기
    $fncs = getInput("PGMFNC.OBJ",$param="",$G);

    $Brcol = array2hash(getInput("CODED","PCD=BRCOL",""));


    $Body .= "\t". $Brcol["LINESTART"] ."\n";
    mlog("	fncInfo sizeof : " . sizeof($fncs));
    for($k=0;$k<sizeof($fncs);$k++){
        $fnc = $fncs[$k];


        $Body .= "\n\t\t\t\t". R($fnc["STARTTXT"],setG($G,"PGMFNC",$fnc));
        $Body .= "\n\t\t\t\t\t". R($fnc["LBLSTARTTXT"],setG($G,"PGMFNC",$fnc));
        $Body .= "\n\t\t\t\t\t\t". R($fnc["LBLTXT"],setG($G,"PGMFNC",$fnc));
        $Body .= "\n\t\t\t\t\t". R($fnc["LBLENDTXT"],setG($G,"PGMFNC",$fnc));
        $Body .= "\n\t\t\t\t\t". R($fnc["OBJSTARTTXT"],setG($G,"PGMFNC",$fnc));
        $Body .= "\n\t\t\t\t\t\t". R($fnc["OBJTXT"],setG($G,"PGMFNC",$fnc));
        $Body .= "\n\t\t\t\t\t". R($fnc["OBJENDTXT"],setG($G,"PGMFNC",$fnc));
        $Body .= "\n\t\t\t\t". R($fnc["ENDTXT"],setG($G,"PGMFNC",$fnc));

    }
    $Body .= "\t". $Brcol["LINEEND"]."\n";

	mlog("Body : " . $Body);
    //echo "<br> <font color=red>getCondition : " . HtmlEncode($Body);
    //echo "</font>";

    return $Body;
}



function getCondition($G){
	mlog("getCondition-------------------------------------------------------start");
    global $Brcol,$Brgrp,$obj;
    $Body = "";

    //IO정보 불러오기
    $Ioinfo = getInput("PGMIO.OBJ",$param="",$G);

    $Brcol = array2hash(getInput("CODED","PCD=BRCOL",""));


    $Body .= "\t". $Brcol["LINESTART"] ."\n";
    mlog("	ioinfo sizeof : " . sizeof($Ioinfo));
    for($k=0;$k<sizeof($Ioinfo);$k++){
        $io = $Ioinfo[$k];

        if( $k>0 && $Ioinfo[$k-1]["BRYN"] =="Y" ){
            $Body .= $Brcol["LINEEND"]."\n";
            $Body .= $Brcol["LINEPADDING"]."\n";
            $Body .= $Brcol["LINESTART"]."\n";
        }

        $Body .= "\n\t\t\t\t". R($io["STARTTXT"],setG($G,"PGMIO",$io));
        $Body .= "\n\t\t\t\t\t". R($io["LBLSTARTTXT"],setG($G,"PGMIO",$io));
        $Body .= "\n\t\t\t\t\t\t". R($io["LBLTXT"],setG($G,"PGMIO",$io));
        $Body .= "\n\t\t\t\t\t". R($io["LBLENDTXT"],setG($G,"PGMIO",$io));
        $Body .= "\n\t\t\t\t\t". R($io["OBJSTARTTXT"],setG($G,"PGMIO",$io));
        $Body .= "\n\t\t\t\t\t\t". R($io["OBJTXT"],setG($G,"PGMIO",$io));
        $Body .= "\n\t\t\t\t\t". R($io["OBJENDTXT"],setG($G,"PGMIO",$io));
        $Body .= "\n\t\t\t\t". R($io["ENDTXT"],setG($G,"PGMIO",$io));

        //if($k>10)break;
        //if($k>0 && ($k+$Ioinfo["COLCNT"]) % $Ioinfo["COLCNT"] == 0){}
    }
    $Body .= "\t". $Brcol["LINEEND"]."\n";

	mlog("Body : " . $Body);

    //echo "<br> <font color=red>getCondition : " . HtmlEncode($Body);
    //echo "</font>";

    return $Body;
}



function getFormview($G){
	mlog("getFormview-------------------------------------------------------start");

    global $Brcol,$Brgrp,$obj;
    $Body = "";

    //IO정보 불러오기
    $Ioinfo = getInput("IOINFO.OBJ",$param="",$G);

    $Brcol = array2hash(getInput("CODED","PCD=BRCOL",""));


    $Body .= "\t". $Brcol["LINESTART"] ."\n";
    for($k=0;$k<sizeof($Ioinfo);$k++){
        $io = $Ioinfo[$k];
        if( $k>0 && $Ioinfo[$k-1]["BRYN"] =="Y" ){
            $Body .= $Brcol["LINEEND"]."\n";
            $Body .= $Brcol["LINEPADDING"]."\n";
            $Body .= $Brcol["LINESTART"]."\n";
        }
        $Body .= "\n\t\t\t\t". R($io["STARTTXT"],setG($G,"PGMIO",$io));
        $Body .= "\n\t\t\t\t\t". R($io["LBLSTARTTXT"],setG($G,"PGMIO",$io));
        $Body .= "\n\t\t\t\t\t\t". R($io["LBLTXT"],setG($G,"PGMIO",$io));
        $Body .= "\n\t\t\t\t\t". R($io["LBLENDTXT"],setG($G,"PGMIO",$io));
        $Body .= "\n\t\t\t\t\t". R($io["OBJSTARTTXT"],setG($G,"PGMIO",$io));
        $Body .= "\n\t\t\t\t\t\t". R($io["OBJTXT"],setG($G,"PGMIO",$io));
        $Body .= "\n\t\t\t\t\t". R($io["OBJENDTXT"],setG($G,"PGMIO",$io));
        $Body .= "\n\t\t\t\t". R($io["ENDTXT"],setG($G,"PGMIO",$io));

        //if($k>10)break;
        //if($k>0 && ($k+$Ioinfo["COLCNT"]) % $Ioinfo["COLCNT"] == 0){}
    }
    $Body .= "\t". $Brcol["LINEEND"]."\n";

	mlog("Body : " . $Body);

    //echo "<br> <font color=red>getCondition : " . HtmlEncode($Body);
    //echo "</font>";

    return $Body;
}


?>