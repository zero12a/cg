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

alog("predis_configCG.php__________________________go");

alog("SERVER.HOSTNAME =" . $_SERVER["HOSTNAME"]);
alog("SERVER.SCRIPT_NAME =" . $_SERVER["SCRIPT_NAME"]); 

$REQ["HOST_NM"] = $_SERVER["HOSTNAME"];

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
$pubsub->subscribe('config.CONFIG_CG');


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

                $REQ = getConfig($REQ);
                configReload();
            }
            break;
    }
}
$pubsub->unsubscribe();
unset($pubsub);

$pubsubClient->quit();

echo "########### end\n";

$db->close();

if($db)unset($db);

function configReload(){
    global $CFG,$REQ,$_SERVER;
    alog("configReload()...............start");

    $client = new GuzzleHttp\Client();
    $res = $client->request('GET', 'http://localhost/common/include/incConfig.php?reload=YES', [
        'tt' => 'ttt'
    ]);
    alog("res->getStatusCode : " . $res->getStatusCode());
    // "200"
    alog("res->getHeader content-type: " . $res->getHeader('content-type')[0]);
    // 'application/json; charset=utf8'
    alog("res->getBody : " . $res->getBody());

    //처리 결과 DB에 저장
    $REQ["RESULT_MSG"] = $res->getBody();
    if($res->getBody() == "RELOAD_OK"){
        $REQ["RESULT_YN"] = "Y";
    }else{
        $REQ["RESULT_YN"] = "N";
    }

    //공통관련 db연결가져오기
    $db = getDbConn($CFG["CFG_DB"]["OS"]);

    //db에 처리결과 저장하기

    $coltype = "sssss";
    $sql = "insert into CMN_CFG_HISTORY (
            ACT_PGMID,OLD_CFG,NEW_CFG,RESULT_YN,RESULT_MSG
            ,HOST_NM,ADD_DT
        ) values (
            'CONFIG',#{OLD_CFG},#{NEW_CFG},#{RESULT_YN},#{RESULT_MSG}
            ,#{HOST_NM}
            ,date_format(sysdate(),'%Y%m%d%H%i%s')
        )
        ";
    $stmt = makeStmt($db,$sql,$coltype,$REQ);
    if(!$stmt)alog("500/300/SQL makeStmt create fail 실패");
    if(!$stmt->execute())alog("500/100/stmt execute fail 실패" . $db->errno . " -> " . $db->error);

    $stmt->close();
    $db->close();
    if($db)unset($db);    
}

function getConfig($REQ){
    global $CFG;
    alog("getConfig()...............start");

    $redisClient = new Predis\Client(
        array(
            'scheme' => 'tcp',
            'host'   => $CFG["REDIS_HOST"],
            'port'   => $CFG["REDIS_PORT"],
            'timeout' => 0
        )
    );    
    

    $cfgNm = "CONFIG_CG";

    //json
    $jsonStrNew = $redisClient->get($cfgNm);
    $jsonStrOld = $redisClient->get($cfgNm . "." . date("Ymd", time()));

    $redisClient->quit();

    $REQ["OLD_CFG"] = $jsonStrOld;
    $REQ["NEW_CFG"] = $jsonStrNew;
    return $REQ;
}


?>