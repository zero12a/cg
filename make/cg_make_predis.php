<?php
  
ini_set('default_socket_timeout', 0);
 
set_time_limit(0);

//subscribe.php
//require 'Predis/Autoloader.php';

require_once(__DIR__ . "/../include/incUtil.php");
require_once(__DIR__ . "/../include/incSec.php");
require_once(__DIR__ . "/../include/incDB.php");
require_once(__DIR__ . "/../incConfig.php");

if(!include_once './cg_make_db.php')		echo "include fail(6)";
if(!include_once './cg_make_file.php')		echo "include fail(7)";
if(!include_once './cg_make_body.php')		echo "include fail(8)";
if(!include_once './cg_make_js.php')		echo "include fail(9)";
if(!include_once './cg_make_func.php')		echo "include fail(10)";

require_once("../../r.d/lib/predis-1.1/autoload.php");

Predis\Autoloader::register();

echo "\nredis go<hr>";

$objDbInfo = getDbSvrInfo("DATING");


$logCnt = 0;
//$redisSvr = "tcp://172.17.0.1:1234?read_write_timeout=0";
$clientPubSub = new Predis\Client($CFG_AUTH_REDIS . "?read_write_timeout=0");
$clientMakeQ = new Predis\Client($CFG_AUTH_REDIS . "?read_write_timeout=0");



$pubsub = $clientPubSub->pubSubLoop();
// Subscribe to your channels
$pubsub->subscribe('PUBSUB_MAKE_QUEUE');

foreach ($pubsub as $message) {
    switch ($message->kind) {
        case 'subscribe':
            echo "\n[subscribe] Subscribed to {$message->channel}" . PHP_EOL;
            break;
        case 'message':
            echo "\n[message] message->channel : " . $message->channel . PHP_EOL;
            echo "\n[message] message->payload : " . $message->payload  . PHP_EOL ;      
            
            $db = db_obj_open($objDbInfo);

            //수시 큐의 로그를 DB에 저장
            while($value = $clientMakeQ->lpop( 'make_queue' )){
                
                echo "\n[make_queue] " . ($logCnt++) . " " . $value ;
                //logUsrAuth($value);
            }

            $db->close();
            if($db)unset($db);

            break;
        default :
            echo "\n[default]" . PHP_EOL;
            break;
    }
} 

?>