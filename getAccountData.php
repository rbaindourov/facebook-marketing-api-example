<?php
// Add to header of your file
require_once __DIR__ . '/vendor/autoload.php';

use FacebookAds\Api;
use FacebookAds\Object\AdUser;
use FacebookAds\Logger\CurlLogger;



session_start();
$cwd = getcwd();

$conf = json_decode( file_get_contents("$cwd/conf/conf.json"),  true  ) ;
$access_token = (isset($_SESSION['facebook_access_token']))? $_SESSION['facebook_access_token'] : $conf['access_token'];
print_r("<PRE>");

Api::init($conf['app_id'], $conf['app_secret'], $_SESSION['facebook_access_token']);

$me = new AdUser('me');
$my_adaccount = $me->getAdAccounts()->current();
print_r($my_adaccount->getData());

print_r("</PRE>");
