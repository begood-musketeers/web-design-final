<?php

if (!isset($_SESSION['loggedin'])) {

  if (isset($_GET['p'])) {
    $pages_that_require_login = [
      'create',
      'new_post',
      'notifications',
      'profile',
      'search',
    ];

    if (in_array($_GET['p'], $pages_that_require_login)) {
      header("Location: ?p=login");
      exit;
    }
  }
}