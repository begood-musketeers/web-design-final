<?php
include("model/post_db.php");
include("model/event_db.php");
include("model/like_db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['request'])) {
  $request = sanitise($_POST['request']);
} else {
  $request = 'get_posts';
}

switch ($request) {
  case 'get_posts':
    $posts = PostDB::get_latest(50);
    $events = EventDB::get_latest(50);

    $content = array_merge($posts, $events);
    // sort by created_datetime
    usort($content, function($a, $b) {
      return $b['created_datetime'] <=> $a['created_datetime'];
    });
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

  default:
    break;
}
