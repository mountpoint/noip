<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

$config = require_once 'config.php';

require_once dirname(__DIR__) . '/vendor/autoload.php';

require_once 'lib/IP.php';
require_once 'lib/NoIP.php';
require_once 'lib/Storage.php';

$storage = new Storage();
$storage
    ->setScheme($config['scheme'])
    ->setHostname($config['hostname'])
    ->setUsername($config['username'])
    ->setPassword($config['password'])
    ->setEmail($config['email'])
    ->setIP(IP::getExternalIP($config['ipUrl']))
;

$noip = new NoIP($storage);
$noip
    ->broadcast()
    ->printResponseStatus()
;
