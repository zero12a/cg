<?php 

    header("Content-Type: text/html; charset=UTF-8");
    header("Cache-Control:no-cache");
    header("Pragma:no-cache");

    $CFG = include_once("../common/include/incConfig.php");
    require_once($CFG["CFG_LIBS_VENDOR"]);

    require_once("../common/include/incUtil.php");
    require_once("../common/include/incDB.php");
    require_once("../common/include/incSec.php");
    //require_once($CFG["CFG_LIBS_PATH_AWS"]);



    $resToken = uniqid();
    $log = getLoggerStdout(
        array(
        "LIST_NM"=>"log_CG"
        , "PGM_ID"=>"PGMINFO"
        , "REQTOKEN" => $reqToken
        , "RESTOKEN" => $resToken
        , "LOG_LEVEL" => Monolog\Logger::DEBUG
        )
    );


    
    //ServerViewTxt("N","N","Y","Y");

    $db["cg"] = getDbConn($CFG["CFG_DB"]["CGCORE"]);

    //그룹ID받기
    $F_GRPID = $_GET['F_GRPID'];
    $F_PJTID = $_GET['F_PJTID'];
    $F_OBJTYPE = $_GET['F_OBJTYPE'];
    $F_DT_TYPE = $_GET['F_DT_TYPE'];
    $F_START_DT = str_replace("-","",$_GET['F_START_DT']); //날짜 타입은 - 제거
    $F_END_DT = str_replace("-","",$_GET['F_END_DT']); //날짜 타입은 - 제거

    //컬럼ROW받기 (REFGRID의 컬럼 정보 받기)
    $G1_OBJTYPE = $_GET['G1_OBJTYPE'];
    $G1_LBLTXT = $_GET['G1_LBLTXT'];
    $G1_OBJTXT = $_GET['G1_OBJTXT'];
    $G1_SRCTXT = $_GET['G1_SRCTXT'];
    $G1_SPTTXT = $_GET['G1_SPTTXT'];
    $G1_INPUT = $_GET['G1_INPUT'];
    $G1_PARAM = $_GET['G1_PARAM'];
    $G1_SRCTYPE = $_GET['G1_SRCTYPE'];

    $G2_OBJDSEQ = $_POST['G2_OBJDSEQ'];



    //그룹ID받기
    $REQ["F_GRPID"] = $_GET['F_GRPID'];
    $REQ["F_PJTID"] = $_POST['F_PJTID'];
    $REQ["F_FILETYPE"] = $_POST['F_FILETYPE'];
    $REQ["F_OBJTYPE"] = $_POST['F_OBJTYPE'];
    $REQ["F_DT_TYPE"] = $_POST['F_DT_TYPE'];
    $REQ["F_START_DT"] = str_replace("-","",$_POST['F_START_DT']); //날짜 타입은 - 제거
    $REQ["F_END_DT"] = str_replace("-","",$_POST['F_END_DT']); //날짜 타입은 - 제거

    //컬럼ROW받기 (REFGRID의 컬럼 정보 받기)
    $REQ["G1_OBJTYPE"] = $_POST['G1_OBJTYPE'];
    $REQ["G1_LBLTXT"] = $_GET['G1_LBLTXT'];
    $REQ["G1_OBJTXT"] = $_GET['G1_OBJTXT'];
    $REQ["G1_SRCTXT"] = $_GET['G1_SRCTXT'];
    $REQ["G1_SPTTXT"] = $_GET['G1_SPTTXT'];
    $REQ["G1_INPUT"] = $_GET['G1_INPUT'];
    $REQ["G1_PARAM"] = $_GET['G1_PARAM'];
    $REQ["G1_SRCTYPE"] = $_GET['G1_SRCTYPE'];

    $REQ["G2_OBJDSEQ"] = $_POST['G2_OBJDSEQ'];
    $REQ["G3_OBJASEQ"] = $_POST['G3_OBJASEQ'];


    //폼뷰
    $REQ["OBJTYPE"]      = $_POST['OBJTYPE'];
    $REQ["STARTTXT"]     = $_POST['STARTTXT'];
    $REQ["LBLSTARTTXT"]  = $_POST['LBLSTARTTXT'];
    $REQ["LBLTXT"]       = $_POST['LBLTXT'];
    $REQ["LBLENDTXT"]    = $_POST['LBLENDTXT'];
    $REQ["OBJSTARTTXT"]  = $_POST['OBJSTARTTXT'];
    $REQ["OBJTXT"]       = $_POST['OBJTXT'];
    $REQ["OBJENDTXT"]    = $_POST['OBJENDTXT'];
    $REQ["ENDTXT"]       = $_POST['ENDTXT'];
    $REQ["USEYN"]        = $_POST['USEYN'];


    $REQ["G1_CRUD_MODE"]    = $_GET['G1_CRUD_MODE'];
    $REQ["G2_CRUD_MODE"]    = $_GET['G2_CRUD_MODE'];
    $REQ["G3_CRUD_MODE"]    = $_GET['G3_CRUD_MODE'];
    $REQ["G4_CRUD_MODE"]    = $_GET['G4_CRUD_MODE'];
    $REQ["G5_CRUD_MODE"]    = $_GET['G5_CRUD_MODE'];
    $REQ["G6_CRUD_MODE"]    = $_GET['G6_CRUD_MODE'];
    $REQ["G7_CRUD_MODE"]    = $_GET['G7_CRUD_MODE'];
    $REQ["G8_CRUD_MODE"]    = $_GET['G8_CRUD_MODE'];

//load from S3
if($REQ["F_GRPID"] == "8" && $REQ["G8_CRUD_MODE"] == "SAVE"){

    echo 111;
    
    try {
            
        $client = S3Client::factory(
            array(
            'credentials' => array('key' => $CFG["CFG_AWS_AID"],'secret' => $CFG["CFG_AWS_KEY"]),
            'region' => 'ap-northeast-2',
            'version' => 'latest'
            )
        );
        echo 222;
    }catch (S3Exception $e) {
        echo $e->getMessage() . "\n";
    }catch (AwsException $e) {
        echo $e->getMessage() . "\n";
    }
    
    try{
        $result = $client->getObject(array(
            'Bucket'     => "code-gen-mdm",
            'Key'        => "objinfo_list.json",
            'SaveAs' => "./md/objinfo_list_load.json"
        ));
    
        echo 333;
    }catch (S3Exception $e) {
        echo $e->getMessage() . "\n";
    }catch (AwsException $e) {
        echo $e->getMessage() . "\n";
    }

    //list파일 열어서 전송
    $tArray = json_decode(file_get_contents('./md/objinfo_list_load.json'),true);
    for($i=0;$i<sizeof($tArray) ;$i++){
        $tCols = $tArray[$i];

        //아래 검증 통과사 S3에서 개별 파일 내려받기
        //검증1 내꺼LOADHASH하고 S3목록의HASH하고 달라진경우 개별 파일 다운받기
        $REQ["OBJTYPE"] = $tCols["OBJTYPE"];    
        $coltype = "s";
        $sql = " select LOADHASH from CG_OBJINFO where OBJTYPE = #{OBJTYPE} and DELYN='N' and USEYN='Y'  ";

        $stmt = makeStmt($db["cg"],$sql,$coltype,$REQ);
        if(!$stmt)ServerMsg("500","300","[objinfo]SQL makeStmt 실패 했습니다." . $db->errno . " -> " . $db->error);
        if(!$stmt->execute())ServerMsg("500","100","[objinfo]stmt 실행 실패" . $stmt->errno . " -> " . $stmt->error);
        $result = $stmt->get_result();
        $stmt->close();
        //echo "<BR>" . $REQ["OBJTYPE"] . " 바뀐거 없어서 LOAD 패스.( DB=" . $tcolsDB["LOADHASH"] . " , FILE=" . $tCols["OBJINFOD"] . " )";
           
        if($tcolsDB = $result->fetch_array(MYSQLI_ASSOC) ){
            if($tcolsDB["LOADHASH"] == $tCols["OBJINFOD"]){
                echo "<BR>" . $REQ["OBJTYPE"] . " 바뀐거 없어서 LOAD 패스.( DB=" . $tcolsDB["LOADHASH"] . " , S3_FILE=" . $tCols["OBJINFOD"] . " )";
                continue;
            }
        }

        try{
            //S3에서 내려받기
            $fileNm = "objinfo_" . $tCols["OBJTYPE"]. ".json";
            $fileLocalNm = "objinfo_" . $tCols["OBJTYPE"]. "_load.json";            
            $result = $client->getObject(array(
                'Bucket'     => "code-gen-mdm",
                'Key'        => $fileNm,
                'SaveAs' => "./md/" . $fileLocalNm          
            ));
        
            echo "<br>" . $i . " " . $fileNm;

            //기존 데이터 지우고( objinfoB -> objinfoA -> objinfoD )
            $coltype = "s";
            $sql = "delete from CG_OBJINFOB where OBJTYPE = #{OBJTYPE}";

            $stmt = makeStmt($db["cg"],$sql,$coltype,$REQ);
            if(!$stmt)ServerMsg("500","300","[objinfo]SQL makeStmt 실패 했습니다." . $db->errno . " -> " . $db->error);
            if(!$stmt->execute())ServerMsg("500","100","[objinfo]stmt 실행 실패" . $stmt->errno . " -> " . $stmt->error);
            $stmt->close();


            $coltype = "s";
            $sql = "delete from CG_OBJINFOA where OBJTYPE = #{OBJTYPE}";

            $stmt = makeStmt($db["cg"],$sql,$coltype,$REQ);
            if(!$stmt)ServerMsg("500","300","[objinfo]SQL makeStmt 실패 했습니다." . $db->errno . " -> " . $db->error);
            if(!$stmt->execute())ServerMsg("500","100","[objinfo]stmt 실행 실패" . $stmt->errno . " -> " . $stmt->error);
            $stmt->close();


            $coltype = "s";
            $sql = "delete from CG_OBJINFOD where OBJTYPE = #{OBJTYPE}";

            $stmt = makeStmt($db["cg"],$sql,$coltype,$REQ);
            if(!$stmt)ServerMsg("500","300","[objinfo]SQL makeStmt 실패 했습니다." . $db->errno . " -> " . $db->error);
            if(!$stmt->execute())ServerMsg("500","100","[objinfo]stmt 실행 실패" . $stmt->errno . " -> " . $stmt->error);
            $stmt->close();



            //내려받은  데이터 넣기 ( objinfoD -> objinfoA -> objinfo B)
            $tArrayD = json_decode(file_get_contents('./md/' . $fileLocalNm),true);

            for($d=0;$d<sizeof($tArrayD);$d++){

                $REQD = $tArrayD[$d];

                //var_dump($REQD);
                //exit;

                $coltype = "sssis sssss sssss ss";
                $sql = "
                    insert into CG_OBJINFOD (
                                        OBJTYPE,FILETYPE,OBJVAL,OBJDORD,OBJVALTYPE
                                        ,UILANG,OBJVALNM,OBJDESC,SRCTXT,SPTTXT
                                        ,INPUT,PARAM,SRCTYPE,FILTER,DEBUGYN
                                        ,ADDDT,MODDT
                    ) values (
                                        #{OBJTYPE},#{FILETYPE},#{OBJVAL},#{OBJDORD},#{OBJVALTYPE}
                                        ,#{UILANG},#{OBJVALNM},#{OBJDESC},#{SRCTXT},#{SPTTXT}
                                        ,#{INPUT},#{PARAM},#{SRCTYPE},#{FILTER},#{DEBUGYN}
                                        ,#{ADDDT},#{MODDT}
                    )
                ";
    
                $stmt = makeStmt($db["cg"],$sql,$coltype,$REQD);
                if(!$stmt)ServerMsg("500","300","[objinfo d]SQL makeStmt 실패 했습니다." . $db["cg"]->errno . " -> " . $db["cg"]->error);
                if(!$stmt->execute())ServerMsg("500","100","[objinfo d]stmt 실행 실패" . $stmt->errno . " -> " . $stmt->error);
                $LAST_OBJDSEQ = $db["cg"]->insert_id;
                echo "<br>-" . $db["cg"]->insert_id;
                $stmt->close();


                for($a=0;$a<sizeof($REQD["OBJINFOA"]);$a++){
                    $REQA = $REQD["OBJINFOA"][$a];

                    $REQA["OBJDSEQ"] = $LAST_OBJDSEQ;

                    //var_dump($REQA);
                    //exit;

                    $coltype = "siiss sssss s ss";
                    $sql = "
                        insert into CG_OBJINFOA (
                            OBJTYPE,OBJDSEQ,OBJAORD,OBJDESC,SRCTXT
                            ,SPTTXT,INPUT,PARAM,SRCTYPE,FILTER
                            ,DEBUGYN
                            ,ADDDT,MODDT
                        ) values (
                            #{OBJTYPE},#{OBJDSEQ},#{OBJAORD},#{OBJDESC},#{SRCTXT}
                            ,#{SPTTXT},#{INPUT},#{PARAM},#{SRCTYPE},#{FILTER}
                            ,#{DEBUGYN}
                            ,#{ADDDT},#{MODDT}
                        )
                        ";
        
                    $stmt = makeStmt($db["cg"],$sql,$coltype,$REQA);
                    if(!$stmt)ServerMsg("500","300","[objinfo A]SQL makeStmt 실패 했습니다." . $db["cg"]->errno . " -> " . $db["cg"]->error);
                    if(!$stmt->execute())ServerMsg("500","100","[objinfo A]stmt 실행 실패" . $stmt->errno . " -> " . $stmt->error);
                    $LAST_OBJASEQ = $db["cg"]->insert_id;
                    echo "<br>--" . $db["cg"]->insert_id;                    
                    $stmt->close();


                    for($b=0;$b<sizeof($REQA["OBJINFOB"]);$b++){
                        $REQB = $REQA["OBJINFOB"][$b];
                        $REQB["OBJASEQ"] = $LAST_OBJASEQ;
    
                        echo "<br>OBJBORD = " . $REQB["OBJBORD"];
                        $coltype = "siiss sssss s ss";
                        $sql = "
                            insert into CG_OBJINFOB (
                                OBJTYPE,OBJASEQ,OBJBORD,OBJDESC,SRCTXT
                                ,SPTTXT,INPUT,PARAM,SRCTYPE,FILTER
                                ,DEBUGYN
                                ,ADDDT,MODDT
                            ) values (
                                #{OBJTYPE},#{OBJASEQ},#{OBJBORD},#{OBJDESC},#{SRCTXT}
                                ,#{SPTTXT},#{INPUT},#{PARAM},#{SRCTYPE},#{FILTER}
                                ,#{DEBUGYN}
                                ,#{ADDDT},#{MODDT}
                            )
                            ";

                        $stmt = makeStmt($db["cg"],$sql,$coltype,$REQB);
                        if(!$stmt)ServerMsg("500","300","[objinfo B]SQL makeStmt 실패 했습니다." . $db["cg"]->errno . " -> " . $db["cg"]->error);
                        if(!$stmt->execute())ServerMsg("500","100","[objinfo B]stmt 실행 실패" . $stmt->errno . " -> " . $stmt->error);
                        $REQ["OBJBSEQ"] = $db["cg"]->insert_id;
                        echo "<br>---" . $db["cg"]->insert_id;                             
                        $stmt->close();
                    }    
                    
                }




            }            


            //DB에 업데이트     
            $REQ["LOADHASH"] = $tCols["OBJINFOD"];
            $coltype = "ss";
            $sql = "
                    update CG_OBJINFO set
                        LOADHASH = #{LOADHASH}
                        ,LOADDT =  date_format(sysdate(),'%Y%m%d%H%i%s')
                    where OBJTYPE = #{OBJTYPE} and DELYN='N' and USEYN='Y'
                    ";

            $stmt = makeStmt($db["cg"],$sql,$coltype,$REQ);
            if(!$stmt)ServerMsg("500","300","[objinfo]SQL makeStmt 실패 했습니다." . $db->errno . " -> " . $db->error);
            if(!$stmt->execute())ServerMsg("500","100","[objinfo]stmt 실행 실패" . $stmt->errno . " -> " . $stmt->error);
            $stmt->close();

        }catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }catch (AwsException $e) {
            echo $e->getMessage() . "\n";
        }

    }


    $db["cg"]->close();
}


//deployToS3
if($REQ["F_GRPID"] == "7" && $REQ["G7_CRUD_MODE"] == "SAVE"){

    echo 111;
    
    try {
            
        $client = S3Client::factory(
            array(
            'credentials' => array('key' => $CFG["CFG_AWS_AID"],'secret' => $CFG["CFG_AWS_KEY"]),
            'region' => 'ap-northeast-2',
            'version' => 'latest'
            )
        );
        echo 222;
    }catch (S3Exception $e) {
        echo $e->getMessage() . "\n";
    }catch (AwsException $e) {
        echo $e->getMessage() . "\n";
    }
    
    try{
        $result = $client->putObject(array(
            'Bucket'     => "code-gen-mdm",
            'SourceFile' => "./md/objinfo_list.json",
            'Key'        => "objinfo_list.json"
        ));
    
        echo 333;
    }catch (S3Exception $e) {
        echo $e->getMessage() . "\n";
    }catch (AwsException $e) {
        echo $e->getMessage() . "\n";
    }

    //list파일 열어서 전송
    $tArray = json_decode(file_get_contents('./md/objinfo_list.json'),true);
    for($i=0;$i<sizeof($tArray);$i++){
        $tCols = $tArray[$i];

        try{
            //S3에 전송
            $fileNm = "objinfo_" . $tCols["OBJTYPE"]. ".json";
            $result = $client->putObject(array(
                'Bucket'     => "code-gen-mdm",
                'SourceFile' => "./md/" . $fileNm ,
                'Key'        => $fileNm
            ));
        
            echo "<br>" . $i . " " . $fileNm;

            //DB에 업데이트
            $REQ["OBJTYPE"] = $tCols["OBJTYPE"];            
            $REQ["DEPLOYHASH"] = $tCols["OBJINFOD"];
            $coltype = "ss";
            $sql = "
                    update CG_OBJINFO set
                        DEPLOYHASH = #{DEPLOYHASH}
                        ,DEPLOYDT =  date_format(sysdate(),'%Y%m%d%H%i%s')
                    where OBJTYPE = #{OBJTYPE} and DELYN='N' and USEYN='Y'
                    ";

            $stmt = makeStmt($db["cg"],$sql,$coltype,$REQ);
            if(!$stmt)ServerMsg("500","300","[objinfo]SQL makeStmt 실패 했습니다." . $db->errno . " -> " . $db->error);
            if(!$stmt->execute())ServerMsg("500","100","[objinfo]stmt 실행 실패" . $stmt->errno . " -> " . $stmt->error);
            $stmt->close();

        }catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }catch (AwsException $e) {
            echo $e->getMessage() . "\n";
        }

    }


    $db["cg"]->close();
}


//makeLocalFile
if($REQ["F_GRPID"] == "6" && $REQ["G6_CRUD_MODE"] == "SAVE"){

    //OBJINFO
    $coltype = "";
    //alog("        coltype : " . $coltype);
    $sql = "
            select 
                *
            from 
                CG_OBJINFO
            where DELYN = 'N' and USEYN='Y'
            ";

    $stmt = makeStmt($db["cg"],$sql,$coltype,$REQ);
    if(!$stmt)JsonMsg("500","300","SQL makeStmt 실패 했습니다." . $db->errno . " -> " . $db->error);
    if(!$stmt->execute())JsonMsg("500","100","stmt 실행 실패" . $db->stmt . " -> " . $db->stmt);
    $resultI = $stmt->get_result();
    $stmt->close();$stmt=null;

    $rowsI = array();
    echo "<table border=1><th>OBJSEQ</th><th>objdseq</th><th>objaseq</th><th>objbseq</th></tr>";
    while($colsI = $resultI->fetch_array(MYSQLI_ASSOC))
    {
        echo "<tr><td>" . $colsI["OBJSEQ"] . "</td><td></td><td></td><td></td></tr>";

        //OBJINFOD
        $REQ["OBJTYPE"] = $colsI["OBJTYPE"];

        $coltype = "s";
        alog("        coltype : " . $coltype);
        $sql = "
                select 
                    *
                from 
                    CG_OBJINFOD
                where OBJTYPE = #{OBJTYPE}
                order by OBJDORD asc, OBJDSEQ asc
                ";

        $stmt = makeStmt($db["cg"],$sql,$coltype,$REQ);
        if(!$stmt)JsonMsg("500","300","[objinfoD]SQL makeStmt 실패 했습니다." . $db->errno . " -> " . $db->error);
        if(!$stmt->execute())JsonMsg("500","100","[objinfoD]stmt 실행 실패" . $db->stmt . " -> " . $db->stmt);
        $resultD = $stmt->get_result();
        $stmt->close();$stmt=null;

        $rowsD = array();
        while($colsD = $resultD->fetch_array(MYSQLI_ASSOC)){
            //echo "<tr><td></td><td>" . $colsD["OBJDSEQ"] . "</td><td></td><td></td></tr>";

            //OBJINFOA
            $REQ["OBJDSEQ"] = $colsD["OBJDSEQ"];
            $colsD["OBJDSEQ"] = "";

            $coltype = "i";
            $sql = "
                    select 
                        *
                    from 
                        CG_OBJINFOA
                    where OBJDSEQ = #{OBJDSEQ}
                    order by OBJAORD asc, OBJASEQ asc 
                    ";

            $stmt = makeStmt($db["cg"],$sql,$coltype,$REQ);
            if(!$stmt)JsonMsg("500","300","[objinfoA]SQL makeStmt 실패 했습니다." . $db->errno . " -> " . $db->error);
            if(!$stmt->execute())JsonMsg("500","100","[objinfoA]stmt 실행 실패" . $db->stmt . " -> " . $db->stmt);
            $resultA = $stmt->get_result();
            $stmt->close();$stmt=null;

            $rowsA = array();
            while($colsA = $resultA->fetch_array(MYSQLI_ASSOC)){
                //echo "<tr><td></td><td></td><td>" . $colsA["OBJASEQ"] . "</td><td></td></tr>";

                //OBJINFOB
                $REQ["OBJASEQ"] = $colsA["OBJASEQ"];
                $colsA["OBJDSEQ"] = "";
                $colsA["OBJASEQ"] = "";

                $coltype = "i";
                $sql = "
                        select 
                            *
                        from 
                            CG_OBJINFOB
                        where OBJASEQ = #{OBJASEQ}
                        order by OBJBORD asc, OBJBSEQ asc
                        ";

                $stmt = makeStmt($db["cg"],$sql,$coltype,$REQ);
                if(!$stmt)JsonMsg("500","300","[objinfoB]SQL makeStmt 실패 했습니다." . $db->errno . " -> " . $db->error);
                if(!$stmt->execute())JsonMsg("500","100","[objinfoB]stmt 실행 실패" . $db->stmt . " -> " . $db->stmt);
                $resultB = $stmt->get_result();
                $stmt->close();$stmt=null;

                $rowsB = array();
                while($colsB = $resultB->fetch_array(MYSQLI_ASSOC)){
                    $colsB["OBJASEQ"] = "";
                    $colsB["OBJBSEQ"] = "";
                    array_push($rowsB,$colsB);
                }
                $colsA["OBJINFOB"] = $rowsB;

                array_push($rowsA,$colsA);
            }

            $colsD["OBJINFOA"] = $rowsA;

            array_push($rowsD,$colsD);
        }
        
        $colsI["OBJINFOD"] = $rowsD;

        array_push($rowsI,$colsI);
    }
    echo "</table><pre>";

    closeDb($db["cg"]);


    //echo json_encode($rowsI);

    //목록/해쉬값 만들기
    $fileList = array();
    for($i=0;$i < sizeof($rowsI);$i++){
        $colsI = $rowsI[$i];

        $jsonStr = json_encode($colsI["OBJINFOD"]);

        $myfile = fopen("./md/objinfo_" . $colsI["OBJTYPE"] . ".json", "w") or die("Unable to open file!");
        fwrite($myfile, $jsonStr);
        fclose($myfile);

        $colsI["OBJINFOD"] = hash("sha256", $jsonStr);
        array_push($fileList,$colsI);
    }
    $jsonStr = json_encode($fileList);
    $myfile = fopen("./md/objinfo_list.json", "w") or die("Unable to open file!");
    fwrite($myfile, $jsonStr);
    fclose($myfile);

    echo "<BR>로컬에 파일생성 완료";
}





if($REQ["F_GRPID"] == "1" && $REQ["G1_CRUD_MODE"] == "read"){

    $to_coltype = "s";

    //V_GRPNM : 팀별 현황 (보안취약점 갯수)
    $GRID["SQL"]["R"]["FNCTYPE"] = "R";
    $GRID["SQL"]["R"]["SQLTXT"] = "
        select
            OBJTYPE as OLD_OBJTYPE,OBJTYPE,a.USEYN,a.DEPLOYDT,a.LOADDT,a.ADDDT,a.MODDT
        from CG_OBJINFO a
        where a.DELYN='N' 
        ";
    $GRID["SQL"]["R"]["BINDTYPE"] = $to_coltype;
    $GRID["SQL"]["R"]["SVRID"] = "cg";
    $GRID["COLCRYPT"] = array();//xml컬럼 자동으로 cdata 붙이기.

    $rtnVal = makeGridSearchJson($GRID,$db);

    //처리 결과 리턴
    $rtnVal->RTN_CD = "200";
    $rtnVal->ERR_CD = "200";
    echo json_encode($rtnVal);
    
    closeDb($db["cg"]);

}else if($REQ["F_GRPID"] == "1"){
    alog("---------------GRP G1 ---------------------START");
    alog("        G1_CRUD_MODE : " .$G1_CRUD_MODE);
    alog("        xmldata : " .$_POST["xmldata"]);


    $GRID["XML"] = getXml2Array($_POST["xmldata"]);//

    $GRID["COLORD"] = "OLD_OBJTYPE,OBJTYPE,USEYN,DEPLOYDT,LOADDT,ADDDT,MODDT"; //그리드 컬럼순서(Hidden컬럼포함)

    $GRID["COLCRYPT"] = array();
    $GRID["KEYCOLID"] = "OBJTYPE";  //KEY컬럼 COLID, 0
    $GRID["SEQYN"] = "N";  //시퀀스 컬럼 유무

    $GRID["SQL"]["C"]["SQLTXT"] = "
                insert into CG_OBJINFO (
                    OBJTYPE,USEYN
                    ,ADDDT
                ) values (
                    #{OBJTYPE},#{USEYN}
                    ,date_format(sysdate(),'%Y%m%d%H%i%s')
                )
    ";
    $GRID["SQL"]["C"]["BINDTYPE"] = "ss";
    $GRID["SQL"]["C"]["SVRID"] = "cg";

    $GRID["SQL"]["D"]["SQLTXT"] = "update   CG_OBJINFO set DELYN='Y' where OBJTYPE = #{OBJTYPE} ";
    $GRID["SQL"]["D"]["BINDTYPE"] = "s";
    $GRID["SQL"]["D"]["SVRID"] = "cg";

    $GRID["SQL"]["U"]["SQLTXT"] = "
                update CG_OBJINFO set
                    OBJTYPE = #{OBJTYPE}, USEYN = #{USEYN}
                    , MODDT =date_format(sysdate(),'%Y%m%d%H%i%s')
                where OBJTYPE = #{OLD_OBJTYPE}
    ";
    $GRID["SQL"]["U"]["BINDTYPE"] = "ss s";
    $GRID["SQL"]["U"]["SVRID"] = "cg";


    $rtnVal = makeGridSaveJson($GRID,$db);

    $rtnVal->RTN_CD = "200";
    $rtnVal->ERR_CD = "200";
    echo json_encode($rtnVal);

    closeDb($db["cg"]);
}







if($REQ["F_GRPID"] == "2" && $REQ["G2_CRUD_MODE"] == "read"){
    alog("---------------GRP G2 ---------------------START");
    alog("        G2_CRUD_MODE : " .$REQ["G2_CRUD_MODE"]);	
	$add_sql = "";
    $to_coltype = "s";
    if($REQ["F_FILETYPE"] != "") {
        $add_sql = " and FILETYPE = #{F_FILETYPE} ";
        $to_coltype .= "s";
    }
    //V_GRPNM : 팀별 현황 (보안취약점 갯수)
    $GRID["SQL"]["R"]["FNCTYPE"] = "R";
    $GRID["SQL"]["R"]["SQLTXT"] = "
            select
                OBJDSEQ,OBJTYPE,FILETYPE,OBJVAL,OBJDORD,OBJVALTYPE,UILANG,OBJVALNM,OBJDESC,SRCTXT,SPTTXT,INPUT,PARAM,SRCTYPE,FILTER,a.ADDDT,a.MODDT,DEBUGYN
            from 
            CG_OBJINFOD a 		  
            where OBJTYPE = #{G1_OBJTYPE} $add_sql
            order by OBJDORD asc
        ";
    $GRID["SQL"]["R"]["BINDTYPE"] = $to_coltype;
    $GRID["SQL"]["R"]["SVRID"] = "cg";
    $GRID["COLCRYPT"] = array();//xml컬럼 자동으로 cdata 붙이기.

    $rtnVal = makeGridSearchJson($GRID,$db);

    //처리 결과 리턴
    $rtnVal->RTN_CD = "200";
    $rtnVal->ERR_CD = "200";
    echo json_encode($rtnVal);
    
    closeDb($db["cg"]);

}else if($REQ["F_GRPID"] == "2"){
    alog("---------------GRP G2 ---------------------START");
    alog("        G2_CRUD_MODE : " .$REQ["G2_CRUD_MODE"]);
    alog("        xmldata : " .$_POST["xmldata"]);

    $GRID["XML"] = getXml2Array($_POST["xmldata"]);//

    $GRID["COLORD"] = "OBJDSEQ,OBJTYPE,FILETYPE,OBJVAL,OBJDORD,OBJVALTYPE,UILANG,OBJVALNM,OBJDESC,SRCTXT,SPTTXT,INPUT,PARAM,SRCTYPE,FILTER,ADDDT,MODDT,DEBUGYN"; //그리드 컬럼순서(Hidden컬럼포함)

    $GRID["COLCRYPT"] = array();
    $GRID["KEYCOLID"] = "OBJDSEQ";  //KEY컬럼 COLID, 0
    $GRID["SEQYN"] = "Y";  //시퀀스 컬럼 유무

    $GRID["SQL"]["C"]["SQLTXT"] = "
               insert into CG_OBJINFOD (
                                    OBJTYPE,FILETYPE,OBJVAL,OBJDORD,OBJVALTYPE
                                    ,UILANG,OBJVALNM,OBJDESC,SRCTXT,SPTTXT
                                    ,INPUT,PARAM,SRCTYPE,FILTER,DEBUGYN
                                    ,ADDDT
               ) values (
                                    #{OBJTYPE},#{FILETYPE},#{OBJVAL},#{OBJDORD},#{OBJVALTYPE}
                                    ,#{UILANG},#{OBJVALNM},#{OBJDESC},#{SRCTXT},#{SPTTXT}
                                    ,#{INPUT},#{PARAM},#{SRCTYPE},#{FILTER},#{DEBUGYN}
                                    ,date_format(sysdate(),'%Y%m%d%H%i%s')
               )
    ";
    $GRID["SQL"]["C"]["BINDTYPE"] = "sssis sssss sssss";
    $GRID["SQL"]["C"]["SVRID"] = "cg";

    $GRID["SQL"]["D"]["SQLTXT"] = " delete from CG_OBJINFOD where  OBJTYPE = #{OBJTYPE} and OBJDSEQ = #{OBJDSEQ} ";
    $GRID["SQL"]["D"]["BINDTYPE"] = "si";
    $GRID["SQL"]["D"]["SVRID"] = "cg";

    $GRID["SQL"]["U"]["SQLTXT"] = "
               update CG_OBJINFOD set
                    OBJTYPE = #{OBJTYPE}, FILETYPE = #{FILETYPE}, OBJVAL = #{OBJVAL}, OBJVALNM = #{OBJVALNM}, OBJDORD = #{OBJDORD}
					, OBJVALTYPE = #{OBJVALTYPE}, UILANG = #{UILANG},  OBJDESC = #{OBJDESC}, SRCTXT = #{SRCTXT}, SPTTXT = #{SPTTXT}
					, INPUT = #{INPUT}, PARAM = #{PARAM}, SRCTYPE = #{SRCTYPE}, FILTER = #{FILTER}, DEBUGYN = #{DEBUGYN}
                    ,MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
                where OBJDSEQ = #{OBJDSEQ}
    ";
    $GRID["SQL"]["U"]["BINDTYPE"] = "ssssi sssss sssss i";
    $GRID["SQL"]["U"]["SVRID"] = "cg";


    
    $rtnVal = makeGridSaveJson($GRID,$db);

    $rtnVal->RTN_CD = "200";
    $rtnVal->ERR_CD = "200";
    echo json_encode($rtnVal);

	closeDb($db["cg"]);
}







if($REQ["F_GRPID"] == "3" && $REQ["G3_CRUD_MODE"] == "read"){


    $GRID["SQL"]["R"]["FNCTYPE"] = "R";
    $GRID["SQL"]["R"]["SQLTXT"] = "
        select
            OBJASEQ,OBJTYPE,OBJDSEQ,OBJAORD,OBJDESC,SRCTXT,SPTTXT,INPUT,PARAM,SRCTYPE,FILTER,a.ADDDT,a.MODDT,DEBUGYN
        from CG_OBJINFOA a
        where  OBJDSEQ = #{G2_OBJDSEQ}
        order by OBJAORD asc
        ";
    $GRID["SQL"]["R"]["BINDTYPE"] = "i";
    $GRID["SQL"]["R"]["SVRID"] = "cg";
    $GRID["COLCRYPT"] = array();//xml컬럼 자동으로 cdata 붙이기.

    $rtnVal = makeGridSearchJson($GRID,$db);

    //처리 결과 리턴
    $rtnVal->RTN_CD = "200";
    $rtnVal->ERR_CD = "200";
    echo json_encode($rtnVal);
    
    closeDb($db["cg"]);


}else if($REQ["F_GRPID"] == "3"){
    alog("---------------GRP G3 ---------------------START");
    alog("        G3_CRUD_MODE : " .$REQ["G3_CRUD_MODE"]);
    alog("        xmldata : " .$_POST["xmldata"]);

    $GRID["XML"] = getXml2Array($_POST["xmldata"]);//

    $GRID["COLORD"] = "OBJASEQ,OBJTYPE,OBJDSEQ,OBJAORD,OBJDESC,SRCTXT,SPTTXT,INPUT,PARAM,SRCTYPE,FILTER,ADDDT,MODDT,DEBUGYN"; //그리드 컬럼순서(Hidden컬럼포함)

    $GRID["COLCRYPT"] = array();
    $GRID["KEYCOLID"] = "OBJDSEQ";  //KEY컬럼 COLID, 0
    $GRID["SEQYN"] = "Y";  //시퀀스 컬럼 유무

    $GRID["SQL"]["C"]["SQLTXT"] = "
               insert into CG_OBJINFOA (
                                    OBJTYPE,OBJDSEQ,OBJAORD,OBJDESC,SRCTXT
                                    ,SPTTXT,INPUT,PARAM,SRCTYPE,FILTER
                                    ,DEBUGYN
                                    ,ADDDT
               ) values (
                                    #{OBJTYPE},#{OBJDSEQ},#{OBJAORD},#{OBJDESC},#{SRCTXT}
                                    ,#{SPTTXT},#{INPUT},#{PARAM},#{SRCTYPE},#{FILTER}
                                    ,#{DEBUGYN}
                                    ,date_format(sysdate(),'%Y%m%d%H%i%s')
               )
    ";
    $GRID["SQL"]["C"]["BINDTYPE"] = "siiss sssss s";
    $GRID["SQL"]["C"]["SVRID"] = "cg";

    $GRID["SQL"]["D"]["SQLTXT"] = " delete from CG_OBJINFOA where OBJASEQ = #{OBJASEQ} ";
    $GRID["SQL"]["D"]["BINDTYPE"] = "i";
    $GRID["SQL"]["D"]["SVRID"] = "cg";

    $GRID["SQL"]["U"]["SQLTXT"] = "
              update CG_OBJINFOA set
                    OBJTYPE = #{OBJTYPE}, OBJDSEQ = #{OBJDSEQ}, OBJDESC = #{OBJDESC}, OBJAORD = #{OBJAORD}, SRCTXT = #{SRCTXT}
                    , SPTTXT = #{SPTTXT}, INPUT = #{INPUT}, PARAM = #{PARAM}, SRCTYPE = #{SRCTYPE}, FILTER = #{FILTER}
                    , DEBUGYN = #{DEBUGYN}
                    ,MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
                where  OBJASEQ = #{OBJASEQ}
    ";
    $GRID["SQL"]["U"]["BINDTYPE"] = "sisis sssss s i";
    $GRID["SQL"]["U"]["SVRID"] = "cg";



    $rtnVal = makeGridSaveJson($GRID,$db);

    $rtnVal->RTN_CD = "200";
    $rtnVal->ERR_CD = "200";
    echo json_encode($rtnVal);

    closeDb($db["cg"]);

}





if($REQ["F_GRPID"] == "5" && $REQ["G5_CRUD_MODE"] == "read"){
    alog("---------------GRP G5 ---------------------START");

    $GRID["SQL"]["R"]["FNCTYPE"] = "R";
    $GRID["SQL"]["R"]["SQLTXT"] = "
        select
            OBJBSEQ,OBJTYPE,OBJASEQ,OBJBORD,OBJDESC,SRCTXT,SPTTXT,INPUT,PARAM,SRCTYPE,FILTER,a.ADDDT,a.MODDT,DEBUGYN
        from CG_OBJINFOB a
        where  OBJASEQ = #{G3_OBJASEQ}
        order by OBJBORD asc
        ";
    $GRID["SQL"]["R"]["BINDTYPE"] = "i";
    $GRID["SQL"]["R"]["SVRID"] = "cg";
    $GRID["COLCRYPT"] = array();//xml컬럼 자동으로 cdata 붙이기.

    $rtnVal = makeGridSearchJson($GRID,$db);

    //처리 결과 리턴
    $rtnVal->RTN_CD = "200";
    $rtnVal->ERR_CD = "200";
    echo json_encode($rtnVal);
    
    closeDb($db["cg"]);


}else if($REQ["F_GRPID"] == "5"){
    alog("---------------GRP G5 ---------------------START");
    alog("        G5_CRUD_MODE : " .$REQ["G5_CRUD_MODE"]);
    alog("        xmldata : " .$_POST["xmldata"]);

    $GRID["XML"] = getXml2Array($_POST["xmldata"]);//

    $GRID["COLORD"] = "OBJBSEQ,OBJTYPE,OBJASEQ,OBJBORD,OBJDESC,SRCTXT,SPTTXT,INPUT,PARAM,SRCTYPE,FILTER,ADDDT,MODDT,DEBUGYN"; //그리드 컬럼순서(Hidden컬럼포함)

    $GRID["COLCRYPT"] = array();
    $GRID["KEYCOLID"] = "OBJBSEQ";  //KEY컬럼 COLID, 0
    $GRID["SEQYN"] = "Y";  //시퀀스 컬럼 유무


    $GRID["SQL"]["C"]["SQLTXT"] = "
               insert into CG_OBJINFOB (
                                    OBJTYPE,OBJASEQ,OBJBORD,OBJDESC,SRCTXT
                                    ,SPTTXT,INPUT,PARAM,SRCTYPE,FILTER
                                    ,DEBUGYN
                                    ,ADDDT
               ) values (
                                    #{OBJTYPE},#{OBJASEQ},#{OBJBORD},#{OBJDESC},#{SRCTXT}
                                    ,#{SPTTXT},#{INPUT},#{PARAM},#{SRCTYPE},#{FILTER}
                                    ,#{DEBUGYN}
                                    ,date_format(sysdate(),'%Y%m%d%H%i%s')
               )
    ";
    $GRID["SQL"]["C"]["BINDTYPE"] = "siiss sssss s";
    $GRID["SQL"]["C"]["SVRID"] = "cg";

    $GRID["SQL"]["D"]["SQLTXT"] = " delete from CG_OBJINFOB where  OBJBSEQ = #{OBJBSEQ} ";
    $GRID["SQL"]["D"]["BINDTYPE"] = "i";
    $GRID["SQL"]["D"]["SVRID"] = "cg";

    $GRID["SQL"]["U"]["SQLTXT"] = "
              update CG_OBJINFOB set
                    OBJTYPE = #{OBJTYPE}, OBJDESC = #{OBJDESC}, OBJBORD = #{OBJBORD}, SRCTXT = #{SRCTXT}, SPTTXT = #{SPTTXT}
					, INPUT = #{INPUT}, PARAM = #{PARAM}, SRCTYPE = #{SRCTYPE}, FILTER = #{FILTER}, DEBUGYN = #{DEBUGYN}
                    ,MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
                where OBJBSEQ = #{OBJBSEQ}
    ";
    $GRID["SQL"]["U"]["BINDTYPE"] = "ssiss sssss i";
    $GRID["SQL"]["U"]["SVRID"] = "cg";

    $rtnVal = makeGridSaveJson($GRID,$db);

    $rtnVal->RTN_CD = "200";
    $rtnVal->ERR_CD = "200";
    echo json_encode($rtnVal);

    closeDb($db["cg"]);

}



?>