<?php
include("model/post_db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['request'])) {
  $request = sanitise($_POST['request']);
} else {
  $request = 'get_posts';
}

switch ($request) {
  case 'get_posts':
    $posts = PostDB::get_posts();
    break;

  default:
    break;
}
