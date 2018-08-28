<?php
/**
 * Created by PhpStorm.
 * User: zero12a
 * Date: 2014. 7. 13.
 * Time: 오후 12:09
 */

function isFilter($G, $tFilter){
    alog("isFilter()..................................start : " . $tFilter);
    $isAndOper = null;
    if(strpos($tFilter,"&&") > 0){
        $tarr = explode("&&",$tFilter);
        $isAndOper = true;
    }else  if(strpos($tFilter,"||") > 0){
        $tarr = explode("||",$tFilter);
        $isAndOper = false;
    }else{
        $tarr[0] = $tFilter;
        $isAndOper = false;
    }

    $SuccessCnt = 0;
    $FailCnt = 0;
    alog("  필터갯수 : " . sizeof($tarr));
    for($u=0;$u<sizeof($tarr);$u++){
        $tFilter2 = $tarr[$u];
        if(strpos($tFilter2,"!=") > 0){
            list($tname,$tvalue) = explode("!=",$tFilter2);
            $tarr2 = explode(".",$tname);
            if( strtoupper($tvalue) == "NULL" && $G[$tarr2[0]][$tarr2[1]] != ""){
                $SuccessCnt++;
                alog("  [Y] '!=' 필터1 tname = $tname, tvalue = $tvalue, G[" . $tarr2[0] . "][" . $tarr2[1] .  "] = " . $G[$tarr2[0]][$tarr2[1]] );                
            }else if( strtoupper($tvalue) != "NULL" &&  $G[$tarr2[0]][$tarr2[1]] != $tvalue ){
                alog("  [Y] '!=' 필터2 tname = $tname, tvalue = $tvalue, G[" . $tarr2[0] . "][" . $tarr2[1] .  "] = " . $G[$tarr2[0]][$tarr2[1]] );
                $SuccessCnt++;
            }else{
                alog("  [N] '!=' 필터3 tname = $tname, tvalue = $tvalue, G[" . $tarr2[0] . "][" . $tarr2[1] .  "] = " . $G[$tarr2[0]][$tarr2[1]] );
                $FailCnt++;
            }

        }else if(strpos($tFilter2,"=") > 0){
            list($tname,$tvalue) = explode("=",$tFilter2);
            $tarr2 = explode(".",$tname);
            if( strtoupper($tvalue) == "NULL" && $G[$tarr2[0]][$tarr2[1]] == ""){
                $SuccessCnt++;
                alog("  [Y] '=' 필터4 tname = $tname, tvalue = $tvalue, G[" . $tarr2[0] . "][" . $tarr2[1] .  "] = " . $G[$tarr2[0]][$tarr2[1]] );
            }else if( strtoupper($tvalue) != "NULL"  && $G[$tarr2[0]][$tarr2[1]] == $tvalue ){
                alog("  [Y] '=' 필터5 tname = $tname, tvalue = $tvalue, G[" . $tarr2[0] . "][" . $tarr2[1] .  "] = " . $G[$tarr2[0]][$tarr2[1]] );
                $SuccessCnt++;
            }else{
                alog("  [N] '=' 필터6 tname = $tname, tvalue = $tvalue, G[" . $tarr2[0] . "][" . $tarr2[1] .  "] = " . $G[$tarr2[0]][$tarr2[1]] );
                $FailCnt++;
            }                    
        }else{
            alog("  isFilter() 필터 정의가 잘못되었습니다. tFilter2 = " . $tFilter2 );
        }
    }
    if($isAndOper && sizeof($tarr) > 0){
        if($SuccessCnt == sizeof($tarr)){
            alog("  isFilter() And 필터 성공");
            return true;
        }else{
            alog("  isFilter() And 필터 실패");
            return false;
        }
    }else if(!$isAndOper && sizeof($tarr) > 0){
        if($SuccessCnt >= 1){
            alog("  isFilter() Or 필터 성공");
            return true;
        }else{
            alog("  isFilter() Or 필터 실패");
            return false;
        }
    }else{
        alog("  isFilter() 필터 조건이 잘못되었습니다.");
        return false;
    }
}



function goJsD($SrcD,$G,$FILETYPE){
	//rlog("goJsD-------------------------------------------------------start");
	//rlog("	FILETYPE : " . $FILETYPE);
	//rlog("	GRPID : " . $G["G"]["GPRID"]);
    //rlog("	goSrcD sizeof : " . sizeof($SrcD));
    //D자식이 있으면 자식을 loop

	//1차원 배열 처리
	//if(is_assoc($SrcD))$SrcD[0] = $SrcD;
	
    for($i=0;$i<sizeof($SrcD);$i++){
        //echo "<br>D 루프 : " . $i;
        //INPUT 정보가져오기
        $lineD = $SrcD[$i];

		if($lineD["SRCTYPE"] == ""){
            //echo "<hr><pre>";
            //print_r($lineD);
            //echo "</pre><hr>";
            rlog("goJsD().SRCTYPE = " . $lineD["OBJDSEQ"] . " is not SRCTYPE");
        }

		//mlog("	loop (" . $i . "/" . sizeof($SrcD) . ", " . $lineD["OBJTYPE"] . "_" . $lineD["OBJVAL"] . ") : [" . $lineA["SRCTYPE"] . "]" . $lineD["OBJDSEQ"] . " - " .  $lineD["OBJDESC"] );

        $InputD = null;
        if($lineD["INPUT"] != "") {
			$InputD = getInput($lineD["INPUT"],$FILETYPE,$lineD["PARAM"],$G);
			//mlog("	InputD sizeof : " . sizeof($InputD));
		}

        //필터 처리 (필터는 루트L 하위 그리드에서 정의만 가능)
        //mlog("FILTER D : " . $lineD["FILTER"] . ", . : " . strpos($lineD["FILTER"],"."));
        $tFilter = $lineD["FILTER"];
		if($tFilter != "" && strpos($tFilter,".") > 0){
            if(!isFilter($G,$tFilter))continue; //필터 조건에 실패 한경우 아래 로직 없이 통과
        }


        //바로 해쉬맵이면
        //echo "<BR> InputD ".$lineD["INPUT"]." size of : " . sizeof($InputD);

        //자신 먼저 출력
        if($lineD["SRCTYPE"] == "R"){

            //치환
            MakeRst($lineD,"D",setG($G,$lineD["INPUT"],$InputD));

            //A자식있는지 검사하기
            $SrcA = getJsA($lineD);
            if( sizeof($SrcA) > 0 )goJsA($SrcA,$G,$FILETYPE);

        }else if($lineD["SRCTYPE"] == "L"){
            //A자식있는지 검사하기
            $SrcA = getJsA($lineD);

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
                    MakeRst($lineDTmp,"D",setG($G,$lineD["INPUT"],$input));
                }


            }else{
                //자식A가 있으면

                //D부터 출력
                MakeRst($lineD,"D",setG($G,$lineD["INPUT"],$InputM));

                //A로 이동
				$input = null;
                for($j=0;$j<sizeof($InputD);$j++){
                    $input = $InputD[$j];
                    goJsA($SrcA,setG($G,$lineD["INPUT"],$input),$FILETYPE);
                }
            }

        }else if($lineD["SRCTYPE"] == "C"){
			//다시 오브젝트를 부르는 경루 재귀함수(자기자신 함수 호출)
			//mlog("재귀함수1 inputD sizeof : ". sizeof($InputD));


			//D부터 출력
            MakeRst($lineD,"D",$G);


			//D로 이동
			$input = null;
			for($c=0;$c<sizeof($InputD);$c++){
				$inputG = $InputD[$c];
				$input[0] = $InputD[$c];
			
				goJsD($input,setG($G,$lineD["INPUT"],$inputG),$FILETYPE);
			}
        }

    }
}


function goJsA($SrcA,$G,$FILETYPE){
	//mlog("goJsA-------------------------------------------------------start");
	//mlog("	FILETYPE : " . $FILETYPE);
	//mlog("	GRPID : " . $G["G"]["GPRID"]);
    //mlog("	goSrcA sizeof : " . sizeof($SrcA)) ;



    //A자식이 있으면 자식을 loop
    for($i=0;$i<sizeof($SrcA);$i++){
        //echo "<br>A 루프 : " . $i;

        //INPUT 정보가져오기
        $lineA = $SrcA[$i];

		//blog("OBJASEQ:". $lineA["OBJASEQ"]);
		if($lineA["SRCTYPE"] == ""){
            //echo "<hr><pre>";
            //print_r($lineA);
            //echo "</pre><hr>";
            rlog("goJsA().SRCTYPE = " . $lineA["OBJASEQ"] . " is not SRCTYPE");
        }

		//mlog("	loop (" . $i . "/" . sizeof($SrcA) . ", " . $lineA["OBJTYPE"] . ") : [" . $lineA["SRCTYPE"] . "]" . $lineA["OBJASEQ"] . " - " .  $lineA["OBJDESC"] );

        $InputA = null;

        if($lineA["INPUT"] != "") {
			$InputA = getInput($lineA["INPUT"],"",$lineA["PARAM"],$G);
			//mlog("	InputA sizeof : " . sizeof($InputA));
		}

        //필터 처리 (필터는 루트L 하위 그리드에서 정의만 가능)
        //mlog("FILTER A : " . $lineA["FILTER"] . ", . : " . strpos($lineA["FILTER"],"."));
        $tFilter = $lineA["FILTER"];
		if($tFilter != "" && strpos($tFilter,".") > 0){
            if(!isFilter($G,$tFilter))continue; //필터 조건에 실패 한경우 아래 로직 없이 통과
		}


        //자신 먼저 출력
        if($lineA["SRCTYPE"] == "R"){

            //치환
            MakeRst($lineA,"A",$G);

            //B자식있는지 검사하기
            $SrcB = getJsB($lineA);
            if( sizeof($SrcB) > 0 ) goJsB($SrcB,$G,$FILETYPE);


        }else if($lineA["SRCTYPE"] == "L"){
            //B자식있는지 검사하기
            $SrcB = getJsB($lineA);
			//mlog("	자식 sizeof : " . sizeof($SrcB));


            //A자식이 없으면 inputA 배열로 자기 자신 loop
            if( sizeof($SrcB) == 0 ){

				//2차원 배열이면 루프 GO
				for($j=0;$j<sizeof($InputA);$j++){
					$input = $InputA[$j];

					//SPLIT TXT 처리 (SPTTXT)
					$lineATmp = $lineA;
					$lineATmp["SRCTXT"] = ($j+1 == sizeof($InputA))? $lineATmp["SRCTXT"] : $lineATmp["SRCTXT"].$lineATmp["SPTTXT"];



					//치환
					//echo "<br> input : ";
					//var_dump($input);
					MakeRst($lineATmp,"A",setG($G,$lineA["INPUT"],$input));
				}

            }else{
                //자식A가 있으면


                //D부터 출력
                MakeRst($lineA,"A",$G);

                //B로 이동
				$input = null;
                for($j=0;$j<sizeof($InputA);$j++){
                    $input = $InputA[$j];

                    goJsB($SrcB,setG($G,$lineA["INPUT"],$input),$FILETYPE);
                }
            }



        }else if($lineA["SRCTYPE"] == "C"){


			//다시 오브젝트를 부르는 경루 재귀함수(자기자신 함수 호출)
			//mlog("재귀함수2 inputA sizeof : ". sizeof($InputA));

            //본인 먼저 출력
            MakeRst($lineA,"A",$G);

			//D로 이동
			$input = null;
			for($j=0;$j<sizeof($InputA);$j++){
				$inputG = $InputA[$j];
				$input[0] = $InputA[$j];
				
				goJsD($input,setG($G,$lineA["INPUT"],$inputG),$FILETYPE);
			}
        }

    }



	//mlog("goJsA-------------------------------------------------------end");
}





function goJsB($SrcB,$G,$FILETYPE){
	//mlog("goJsB-------------------------------------------------------start");
	//mlog("	FILETYPE : " . $FILETYPE);
	//mlog("	GRPID : " . $G["G.GPRID"]);
    //mlog("	goSrcB sizeof : " . sizeof($SrcB)) ;

    //A자식이 있으면 자식을 loop
    for($i=0;$i<sizeof($SrcB);$i++){
        //echo "<br>B 루프 : " . $i;

        //INPUT 정보가져오기
        $lineB = $SrcB[$i];
		if($lineB["SRCTYPE"] == ""){
            //echo "<hr><pre>";
            //print_r($lineB);
            //echo "</pre><hr>";
            rlog("goJsB().SRCTYPE = " . $lineB["OBJBSEQ"] . " is not SRCTYPE");
        }

		//mlog("	loop (" . $i . "/" . sizeof($SrcB) . ", " . $lineB["OBJTYPE"] . ") : [" . $lineA["SRCTYPE"] . "]" . $lineB["OBJBSEQ"] . " - " .  $lineB["OBJDESC"] );

        $InputB = null;

        if($lineB["INPUT"] != "") {
			$InputB = getInput($lineB["INPUT"],"",$lineB["PARAM"],$G);
			//mlog("	lineB sizeof : " . sizeof($lineB));
		}


        //필터 처리 (필터는 루트L 하위 그리드에서 정의만 가능)
        //mlog("FILTER B : " . $lineB["FILTER"] . ", . : " . strpos($lineB["FILTER"],"."));
        $tFilter = $lineB["FILTER"];
		if($tFilter != "" && strpos($tFilter,".") > 0){
            if(!isFilter($G,$tFilter))continue; //필터 조건에 실패 한경우 아래 로직 없이 통과
        }


        //자신 먼저 출력
        if($lineB["SRCTYPE"] == "R"){

            //치환
            MakeRst($lineB,"B",$G);
        }else if($lineB["SRCTYPE"] == "L"){

            //2차원 배열이면 루프 GO
            //echo "<br>바로 input 배열";
            for($j=0;$j<sizeof($InputB);$j++){
                $input = $InputB[$j];

                //SPLIT TXT 처리 (SPTTXT)
                $lineBTmp = $lineB;
                $lineBTmp["SRCTXT"] = ($j+1 == sizeof($InputB))? $lineBTmp["SRCTXT"] : $lineBTmp["SRCTXT"].$lineBTmp["SPTTXT"];

                //치환
                //echo "<br> input : ";
                //var_dump($input);
                MakeRst($lineBTmp,"B",setG($G,$lineB["INPUT"],$input));
            }
        }else if($lineB["SRCTYPE"] == "C"){
			//다시 오브젝트를 부르는 경루 재귀함수(자기자신 함수 호출)
			//mlog("재귀함수3 InputB sizeof : ". sizeof($InputB));

            //본인 먼저 출력
            MakeRst($lineB,"B",$G);

			//D로 이동
			$input = null;
			for($j=0;$j<sizeof($InputB);$j++){
				$inputG = $InputB[$j];
				$input[0] = $InputB[$j];
				
				goJsD($input,setG($G,$lineB["INPUT"],$inputG),$FILETYPE);
			}
        }
    }
	//mlog("goJsB-------------------------------------------------------end");
}

?>