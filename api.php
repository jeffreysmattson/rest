<?php
namespace Main;

require 'vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Setup\MyAPI;
use Exception;

// create a log channel
$log = new Logger('api');
$log->pushHandler(new StreamHandler('../apiLog.txt', Logger::DEBUG));

// Requests from the same server don't have a HTTP_ORIGIN header
if (!array_key_exists('HTTP_ORIGIN', $_SERVER)) {
    $_SERVER['HTTP_ORIGIN'] = $_SERVER['SERVER_NAME'];
}
try {
    if(empty($_REQUEST['request'])){
        $log->info(
            'Attempt to connect to the API without a request parameter.',
            array(
                'Origin'        => $_SERVER['HTTP_ORIGIN'],
                'User Agent'    => $_SERVER['HTTP_USER_AGENT'],
                'Remote Address'=> $_SERVER['REMOTE_ADDR']
            )
        );
        die();
    }
    $API = new MyAPI($_REQUEST['request'], $_SERVER['HTTP_ORIGIN']);
    echo $API->processAPI();
} catch (Exception $e) {
    echo json_encode(array('error' => $e->getMessage()));
}
