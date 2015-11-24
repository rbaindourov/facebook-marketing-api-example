<?php
// Add to header of your file
require_once __DIR__ . '/vendor/autoload.php';


use FacebookAds\Api;
use FacebookAds\Object\AdUser;
use FacebookAds\Object\Page;


function processFieldData(&$pg_lead, $data){
  foreach( $data as $data_set ){
    $pg_lead[$data_set['name']] = pg_escape_string( $data_set['values'][0] );
  }
  if( isset( $pg_lead['full_name'] ) ){
      $names = explode(' ', $pg_lead['full_name'] );
      $pg_lead['first_name'] = array_shift( $names );
      $pg_lead['last_name'] = implode(' ', $names );
  }
}

session_start();

$cwd = getcwd();
$conf = json_decode( file_get_contents("$cwd/conf/conf.json"),  true  ) ;
$pg = pg_connect ( $conf['pg_connect'] );

$access_token = (isset($_SESSION['facebook_access_token']))? $_SESSION['facebook_access_token'] : $conf['access_token'];
Api::init($conf['app_id'], $conf['app_secret'], $_SESSION['facebook_access_token']);
$page = new Page($conf['page_id']);
$leadgen_forms = $page->getLeadgenForms();
echo('<pre>');
foreach( $leadgen_forms as $value){
  $form_leads = $value->getLeads();
  foreach( $form_leads as $lead ){
    $pg_lead = array(
      'id' => pg_escape_string( $lead->id ),
      'created_time' => pg_escape_string( $lead->created_time )
    );
    processFieldData($pg_lead, $lead->field_data);
    echo( json_encode( $pg_lead )."\n" );
  }
}
echo('</pre>');
