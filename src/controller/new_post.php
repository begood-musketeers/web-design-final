<?php
include("model/post_db.php");

if (!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"]) {
    header("Location: /?p=404");
    die();
}

$user_id = $_SESSION["user_id"];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['request'])) {
  $request = sanitise($_POST['request']);
} else {
  $request = "";
}

function upload_file($post_id, $image) {
    $file_name = $image['name'];
    $file_size = $image['size'];
    $file_tmp = $image['tmp_name'];
    $file_ext = explode('.', $file_name);
    $file_ext = strtolower(end($file_ext));

    $upload_root = realpath(dirname(__FILE__) . "/../uploads");

    $allowed = array('jpg', 'jpeg', 'png', 'gif');
    if (in_array($file_ext, $allowed)) {
      if ($file_size <= 2097152) {
        $file_name_new = uniqid('', true) . '.' . $file_ext;
        $file_destination = $upload_root . "/$file_name_new";
        if (move_uploaded_file($file_tmp, $file_destination)) {
            echo "uploaded to $file_destination";
              PostDB::add_image($post_id, $file_name_new);

        } else {
          return json_encode(["error" => "Error uploading file."]);
        }
      } else {
        return json_encode(["error" => "File size too large."]);
      }
    } else {
      return json_encode(["error" => "Invalid file type."]);
    }
}

switch ($request) {
  case 'new_post':
    $title = sanitise($_POST['title']);
    $description = sanitise($_POST['description']);
    $location = (isset($_POST['location']) && $_POST['location'] != "") ? sanitise($_POST['location']) : null;
    if(empty($title) || empty($description) || empty($location)) {
        break;
    }
    $post_id = PostDB::create($user_id, $title, $description, $location);
    foreach($_FILES as $file) {
        upload_file($post_id, $file);
    }
    break;
  case 'add_image':
    $post_id = sanitise($_POST['post_id']);
    $image = $_FILES['image'];

    $file_name = $image['name'];
    $file_size = $image['size'];
    $file_tmp = $image['tmp_name'];
    $file_ext = explode('.', $file_name);
    $file_ext = strtolower(end($file_ext));

    $allowed = array('jpg', 'jpeg', 'png', 'gif');
    if (in_array($file_ext, $allowed)) {
      if ($file_size <= 2097152) {
        $file_name_new = uniqid('', true) . '.' . $file_ext;
        $file_destination = '/uploads/' . $file_name_new;
        if (move_uploaded_file($file_tmp, $file_destination)) {

          PostDB::add_image($post_id, $file_name_new);

        } else {
          echo json_encode(["error" => "Error uploading file."]);
        }
      } else {
        echo json_encode(["error" => "File size too large."]);
      }
    } else {
      echo json_encode(["error" => "Invalid file type."]);
    }

    exit;

  default:
    break;
}
