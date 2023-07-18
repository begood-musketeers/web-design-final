<?php
include("model/post_db.php");
include("model/like_db.php");
include("model/comment_db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['request'])) {
  $request = sanitise($_POST['request']);
} else if (isset($_GET['id']) && !empty($_GET['id'])) {
  $request = "get_post";
} else {
  echo "<script>window.location.href = '?p=404';</script>";
  exit;
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
    $id = sanitise($_POST['id']);
    $comment = sanitise($_POST['comment']);
    $user_id = $_SESSION['user_id'];

    CommentDB::add_comment($user_id, $id, ObjectType::POST, $comment);
    header("Location: ?p=post&id=$id");
    exit;
    break;
  case 'remove_comment':
    $id = sanitise($_POST['id']);
    $comment_id = sanitise($_POST['comment_id']);
    $user_id = $_SESSION['user_id'];
    CommentDB::remove_comment($user_id, $comment_id);
    header("Location: ?p=post&id=$id");
    exit;
    break;

  default:
    break;
}
