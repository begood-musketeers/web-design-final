<?php
// ini overwrites
ini_set("display_errors", true);

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
$database_model = 'production';
$database_credentials = array(
  'local' => array('db', 'root', 'password'),
  'production' => array('172.21.82.208', 'finalteam2', 'fcRYcXkfSS')
);