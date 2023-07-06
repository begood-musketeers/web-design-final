<?php
// App settings
$project_version = 1;
$execution_mode = 'strict'; // quiet - oblivious - strict
$use_resource_stacking = TRUE;
$use_forced_https = FALSE;

// Meta Settings
$site_name = "XSN";
$site_url = "";
$site_icon = "assets/favicon.png";
$site_color = "#e3e3e3";
$page_description = "";

// Database settings
$database_model = 'local';
$database_credentials = array(
  'local' => array('localhost', 'root', ''),
  'production' => array('localhost', 'root', '')
);