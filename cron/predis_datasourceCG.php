<?php
  
//ini_set('default_socket_timeout', 0); //이 옵션 사용시 redis 연결 에러.
 
set_time_limit(0);

//subscribe.php
//require 'Predis/Autoloader.php';



$CFG = require_once(__DIR__ . "/../../common/include/incConfig.php");

//exit;
if(!require_once(__DIR__ . "/../../common/include/incUtil.php"))die("require incUtil fail.");
if(!require_once(__DIR__ . "/../../common/include/incSec.php"))die("require incSec fail.");
if(!require_once(__DIR__ . "/../../common/include/incDB.php"))die("require incDB fail.");

alog("predis_datasourceCG.php__________________________go");

//로딩 안해도 됨 기본적으로 infConfig에서 로딩함.
//if(!require_once($CFG_LIBS_PATH_REDIS))die("require redis fail.");

require_once(__DIR__ . "/../../lib/php/vendor/autoload.php");

echo "###########" . $CFG["REDIS_HOST"] . "\n";

//Predis\Autoloader::register();


$pubsubClient = new Predis\Client(
    array(
        'scheme' => 'tcp',
        'host'   => $CFG["REDIS_HOST"],
        'port'   => $CFG["REDIS_PORT"],
        'timeout' => 0,
        'read_write_timeout' => 0
    )
);    

echo "###########" . $CFG["REDIS_PORT"] . "\n";

// Initialize a new pubsub consumer.
$pubsub = $pubsubClient->pubSubLoop();


// Subscribe to your channels
$pubsub->subscribe('config.DATASOURCE_CG');


// consume messages
// note: this is a blocking call
foreach ($pubsub as $message) {
    switch ($message->kind) {
        case 'subscribe':
            echo "Subscribed to {$message->channel}", PHP_EOL;
            break;
        case 'message':
            if ($message->channel == 'control_channel') {
                if ($message->payload == 'quit_loop') {
                    echo 'Aborting pubsub loop...', PHP_EOL;
                    $pubsub->unsubscribe();
                } else {
                    echo "Received an unrecognized command: {$message->payload}.", PHP_EOL;
                }
            } else {
                echo "Received the following message from {$message->channel}:",
                     PHP_EOL, "  {$message->payload}", PHP_EOL, PHP_EOL;

                
                dataSourceSaveRedisFromDB();

                datasourceReload();
            }
            break;
    }
}
$pubsub->unsubscribe();
unset($pubsub);

$pubsubClient->quit();

echo "########### end\n";


function datasourceReload(){
    global $CFG;
    alog("configReload()...............start");

    $client = new GuzzleHttp\Client();
    $res = $client->request('GET', 'http://localhost/common/include/incConfig.php', [
        'ctl' => 'DATASOURCE'
        ,'reload' => 'YES'
    ]);
    echo $res->getStatusCode();
    // "200"
    echo $res->getHeader('content-type')[0];
    // 'application/json; charset=utf8'
    echo $res->getBody();
}

function dataSourceSaveRedisFromDB(){
    global $CFG;
    alog("configSave()...............start");

    //Get datasource list
    $db = getDbConn($CFG["CFG_DB"]["CGCORE"]);

    $coltype = "";
    $sql = "
    select 
        SVRSEQ
        , SVRID
        , DBHOST as HOST
        , DBPORT as PORT
        , DBNAME as DBNM
        , DBUSRID as ID
        , DBUSRPW as PW
    from CG_SVR where USEYN='Y'";
    
    $stmt = makeStmt($db,$sql,$coltype,$REQ);
    if(!$stmt)JsonMsg("500","300","SQL makeStmt 생성 실패 했습니다.");
    $svrArray = getStmtArray($stmt);
    $stmt->close();
    $db->close();
    if($db)unset($db);

    /*
    아래 구조로 변경하기
    "CFG_DB": {
        "CGCORE": {
            "HOST": "172.17.0.1",
            "PORT": "",
            "DBNM": "",
            "ID": "",
            "PW": ""
        },
        "CGPJT1": {
            "HOST": "172.17.0.1",
            "PORT": "",
            "DBNM": "",
            "ID": "",
            "PW": ""
        }
    }
    */
    $rtnArr = array();
    for($t=0;$t<sizeof($svrArray);$t++){
        $rtnArr[$svrArray[$t]["SVRID"]] = $svrArray[$t];
    }
    $jsonStr = json_encode($rtnArr);


    //Save to redis
    $cfgNm = "DATASOURCE_CG";
    $redisClient = new Predis\Client(
        array(
            'scheme' => 'tcp',
            'host'   => $CFG["REDIS_HOST"],
            'port'   => $CFG["REDIS_PORT"],
            'timeout' => 0
        )
    );   
    if($redisClient->get($cfgNm) != $jsonStr) $jsonStr = $redisClient->set($cfgNm,$jsonStr);
    $redisClient->quit();

    //처음 로딩시 로컬캐시에 보관
    //echo "CONFIG=========================================\n" . $jsonStr . "\n=========================================\n";
    echo $cfgNm . " redis datasource 반영완료 ";
}


?>