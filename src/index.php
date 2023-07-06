<?php session_start();

// SETTINGS & CORE
include("_config/settings.php");
include("_config/services.php");
include("_config/core/functions.php");
include("_config/core/classes.php");

// COLLECT PARAMETERS
$page = (isset($_GET['p'])) ? $_GET['p'] : "timeline";
$sub_page = (isset($_GET['s'])) ? $_GET['s'] : false;

// SERVE RESOURCES IF $page IS NOT PRESENT IN THE RESOURCE BLACKLIST
$serve_resources = isset($_POST['request']) ? false : true;

if ($serve_resources)
{
  // FORCE HTTPS
  if($use_forced_https) {
    echo '
      <script>
      if (location.protocol !== "https:") {
        location.replace(`https:${location.href.substring(location.protocol.length)}`);
      }
      </script>
    ';
  }

  // OPEN DOCUMENT
  echo '
  <!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="utf-8">
      <meta content="initial-scale=1, shrink-to-fit=no, width=device-width" name="viewport">
      <!-- _config 3.8 -->
  ';

  // INCLUDE PRELOAD
  include("_config/resource-preload.php");
}

// SERVE VIEW
if (isset($page) & file_exists("view/" . $page . "/index.php"))
{
  include("view/" . $page . "/index.php");
}
else if (isset($page) & file_exists("view/" . $page . "/index.html"))
{
  include("view/" . $page . "/index.html");
}
else
{
  include("view/404/index.php");
}

if ($serve_resources)
{
  // INCLUDE AFTERLOAD
  echo "<project-scripts>";
  include("_config/resource-afterload.php");
  echo "</project-scripts>";

  // SERVE META MATERIAL
  echo '
    <link rel="icon" type="image/png" href="assets/favicon.png"/>
    <link rel="apple-touch-icon" href="assets/icon.png">
    <title>' . $site_name . '</title>
    <meta property="og:title" content="' . $site_name . '" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="' . "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" . '" />
    <meta property="og:image" content="' . $site_icon . '" />
    <meta property="og:description" content="' . $page_description . '" />
    <meta name="theme-color" content="' . $site_color . '">
    <meta name="twitter:card" content="summary_large_image">
  ';
}
?>