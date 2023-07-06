<?php
// Service to negate cpu usage during a request spam.
// Set $rate_limit equal to the max-amount of request you want to allow per second.

// Example:
// $rate_limit = 4;

// Any request that exceeds this limit will be "ignored" by serving a blank document.

$rate_limit = 4;
$marker = date("s");

if (isset($_SESSION['rate-limit-stamp'])) {
  if ($_SESSION['rate-limit-stamp']!=$marker) {
    $_SESSION['rate-limit-stamp'] = $marker;
    $_SESSION['rate-limit-count'] = 1;
  } else {
    $_SESSION['rate-limit-count'] = $_SESSION['rate-limit-count'] + 1;
  }
} else {
  $_SESSION['rate-limit-stamp'] = $marker;
  $_SESSION['rate-limit-count'] = 1;
}

if ($_SESSION['rate-limit-count']>$rate_limit) {exit;}
