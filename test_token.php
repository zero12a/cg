<?php
require_once "../lib/php/vendor/autoload.php";

// Create a client with a base URI
$client = new GuzzleHttp\Client();
// Send a request to https://foo.com/api/test
//     'body' => 'grant_type=password&client_id=demoapp&client_secret=demopass&username=demouser&password=testpass'

$res = $client->request('POST', 'http://172.17.0.1:8081/lockdin/token', [
    'form_params' => [
        'grant_type' => 'password',
        'client_id' => 'demoapp',
        'client_secret' => 'demopass',
        'username' => 'demouser',
        'password' => 'testpass'
    ]
]);

echo "<hr>" . $res->getStatusCode();
// "200"
echo "<hr>" . $res->getHeader('content-type')[0];
// 'application/json; charset=utf8'
echo "<hr>" . $res->getBody();



?>