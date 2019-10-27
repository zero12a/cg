<?php

include "incCofig.php";
require '/data/www/lib/php/aws/aws-autoloader.php';

use Aws\S3\S3Client;
use Aws\Common\Exception\MultipartUploadException;
use Aws\S3\Model\MultipartUpload\UploadBuilder;
echo 111;

$client = S3Client::factory(
    array(
    'credentials' => array('key' => $CFG_AWS_AID,'secret' => $CFG_AWS_KEY),
    'region' => 'ap-northeast-2',
    'version' => 'latest'
    )
);
echo 222;
$result = $client->putObject(array(
        'Bucket'     => "code-gen-mdm",
        'SourceFile' => "test.html",
        'Key'        => "test2.html"
));

echo 333;

echo $result;
?>