<?php
include("model/event_db.php");

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

function upload_file($event_id, $image) {
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
              EventDB::add_image($event_id, $file_name_new);

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
  case 'new_event':
    $title = sanitise($_POST['title']);
    $description = sanitise($_POST['description']);
    $start_date = sanitise($_POST['start_date']);
    $end_date = sanitise($_POST['end_date']);
    $type = sanitise($_POST['type']);
    $location = (isset($_POST['location']) && $_POST['location'] != "") ? sanitise($_POST['location']) : "";

    if(empty($title)) {$error = "Title cannot be empty."; break;}
    if(empty($description)) {$error = "Description cannot be empty."; break;}
    if(strlen($title) > 256) {$error = "Title cannot be longer than 100 characters."; break;}
    if(strlen($description) > 1024) {$error = "Description cannot be longer than 1000 characters."; break;}
    if (!in_array($type, ["sports", "cinema", "hangout", "games", "amusement park"])) {$error = "Invalid type."; break;}
    if (strtotime($start_date) > strtotime($end_date)) {$error = "Start date cannot be after end date."; break;}
    if (empty($start_date)) {$error = "Start date cannot be empty."; break;}
    if (empty($end_date)) {$error = "End date cannot be empty."; break;}
    if (count($_FILES) == 0) {$error = "Please upload at least one image."; break;}

    $event_id = EventDB::create($user_id, $title, $description, $location, $type, $start_date, $end_date);
    foreach($_FILES as $file) {
      upload_file($event_id, $file);
    }
    header("Location: /?p=event&id=$event_id");
    break;
  default:
    break;
}
