<?php

function _configException($function, $message, $suggestion) {
  // HTML body of the error message
  $exception_body = "
    <div style='padding:10px;color:white;background:black'>
      <h4>_config Exception</h4>
      <p>$message</p>
      <div class='font-weight-bold'><bold>Offender</bold></div>
      <p>$function()</p>
      <div class='font-weight-bold'><bold>Suggestion</bold></div>
      <div>$suggestion</div>
    </div>
  ";

  // Act according to the execution_mode
  if ($GLOBALS['execution_mode']=='oblivious') {
    echo $exception_body;
  } else if ($GLOBALS['execution_mode']=='strict') {
    die($exception_body);
  }
}

function import($path) {
  if (file_exists($path)) {
    if ($GLOBALS['use_resource_stacking']==TRUE) {
      if (strpos($path, '.js') !== false) {
          echo "<script>" . file_get_contents($path) . "</script>";
      } else if (strpos($path, '.css') !== false) {
          echo "<style>" . file_get_contents($path) . "</style>";
      } else if (strpos($path, '.php') !== false) {
          include($path);
      } else if (strpos($path, '.png') !== false || strpos($path, '.jpg') !== false || strpos($path, '.jpeg') !== false || strpos($path, '.gif') !== false) {
          echo '<link rel="prefetch" href="' . $path . '" />';
      } else if (strpos($path, '.mp3') !== false || strpos($path, '.wav') !== false) {
          echo '<audio src="' . $path . '" preload="auto"></audio>';
      }
    } else {
      if (strpos($path, '.js') !== false) {
          echo '<script src="' . $path . '?v=' . $GLOBALS['project_version'] . '"></script>';
      } else if (strpos($path, '.css') !== false) {
          echo '<link rel="stylesheet" type="text/css" href="' . $path . '?v=' . $GLOBALS['project_version'] . '">';
      } else if (strpos($path, '.php') !== false) {
          include($path);
      } else if (strpos($path, '.png') !== false || strpos($path, '.jpg') !== false || strpos($path, '.jpeg') !== false || strpos($path, '.gif') !== false) {
          echo '<link rel="prefetch" href="' . $path . '" />';
      } else if (strpos($path, '.mp3') !== false || strpos($path, '.wav') !== false) {
          echo '<audio src="' . $path . '" preload="auto"></audio>';
      }
    }
  } else {
    _configException("import", "Given path does not exist, is '$path' a local resource?", "Make sure '$path' is local, or disable \$resource_stacking in settings.php.");
  }
}

function sanitise($input) {
  if (!empty($input)) {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
  } else {
    return $input;
  }
}

function timeago($date) {
  $timestamp = strtotime($date);	
  
  $strTime = array("s", "m", "h", "d", "m", "y");
  $length = array("60","60","24","30","12","10");

  $currentTime = time();
  if($currentTime >= $timestamp) {
   $diff     = time()- $timestamp;
   for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
   $diff = $diff / $length[$i];
   }

   $diff = round($diff);
   return $diff . $strTime[$i];
  }
}
