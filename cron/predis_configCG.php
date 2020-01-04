<?php
  
//ini_set('default_socket_timeout', 0); //이 옵션 사용시 redis 연결 에러.
 
set_time_limit(0);

//subscribe.php
//require 'Predis/Autoloader.php';

echo "redis go<hr>\n";

$CFG = require_once(__DIR__ . "/../../common/include/incConfig.php");

//exit;
if(!require_once(__DIR__ . "/../../common/include/incUtil.php"))die("require incUtil fail.");
if(!require_once(__DIR__ . "/../../common/include/incSec.php"))die("require incSec fail.");
if(!require_once(__DIR__ . "/../../common/include/incDB.php"))die("require incDB fail.");

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
    global $CFG;
    alog("configReload()...............start");

    $client = new GuzzleHttp\Client();
    $res = $client->request('GET', 'http://localhost/common/include/incConfig.php', [
        'reload' => 'YES'
    ]);
    echo $res->getStatusCode();
    // "200"
    echo $res->getHeader('content-type')[0];
    // 'application/json; charset=utf8'
    echo $res->getBody();
}

function configSave(){
    global $CFG;
    alog("configSave()...............start");

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
    $jsonStr = $redisClient->get($cfgNm);
    $redisClient->quit();

    $tmpArray = json_decode($jsonStr,true);

    if(json_last_error() != JSON_ERROR_NONE){
        //$redisClient->quit();
        alog("JSON 문법 에러 발생 : " . json_last_error_msg());
        return;
    }

    //처음 로딩시 로컬캐시에 보관
    apcu_store($cfgNm, $jsonStr);	
    echo "CONFIG=========================================\n" . $jsonStr . "\n=========================================\n";
    echo $cfgNm . " apcu 컨피그 반영완료 ";
}


?>