<?php
include("model/post_db.php");
include("model/like_db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['request'])) {
  $request = sanitise($_POST['request']);
} else {
  $request = "get_post";
}

switch ($request) {
  case 'get_post':
    $post_id = sanitise($_GET['id']);
    $post = PostDB::get($post_id);
    break;
  case 'like':
    $id = sanitise($_POST['id']);
    $type = sanitise($_POST['type']);
    LikeDB::like_object($id, $type);
    $likes = LikeDB::get_likes($id, $type);
    echo $likes;
    exit;
    break;
  case 'unlike':
    $id = sanitise($_POST['id']);
    $type = sanitise($_POST['type']);
    LikeDB::unlike_object($id, $type);
    $likes = LikeDB::get_likes($id, $type);
    echo $likes;
    exit;
    break;
  case 'add_comment':

  default:
    break;
}
