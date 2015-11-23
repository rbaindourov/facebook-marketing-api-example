<?php
require_once __DIR__ . '/vendor/autoload.php';

use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use FacebookAds\Api;
use FacebookAds\Object\AdUser;

// Init PHP Sessions
session_start();
date_default_timezone_set('America/Los_Angeles');
$conf = json_decode( file_get_contents('conf/conf.json'),  true  ) ;

$fb = new Facebook( $conf );

$helper = $fb->getRedirectLoginHelper();

if (!isset($_SESSION['facebook_access_token'])) {
  $_SESSION['facebook_access_token'] = null;
}

if (!$_SESSION['facebook_access_token']) {
  $helper = $fb->getRedirectLoginHelper();
  try {
    $_SESSION['facebook_access_token'] = (string) $helper->getAccessToken();
  } catch(FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
  } catch(FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
  }
}

if ($_SESSION['facebook_access_token']) {
  echo '<a href="' . $conf['URL'].'getAccountData.php' . '">Get Account Data</a><br/>';
  echo '<a href="' . $conf['URL'].'getLeadData.php' . '">Get Lead Data</a>';

  

} else {
  $permissions = ['ads_management', 'manage_pages'];
  $loginUrl = $helper->getLoginUrl($conf['URL'].'getAccessToken.php', $permissions );
  echo '<a href="' . $loginUrl . '">Log in with Facebook</a>';
}
