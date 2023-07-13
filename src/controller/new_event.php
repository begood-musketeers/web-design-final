<?php
include("model/event_db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['request'])) {
  $request = sanitise($_POST['request']);
} else {
  $request = "";
}

switch ($request) {
  case 'new_event':
    $title = sanitise($_POST['title']);
    $description = sanitise($_POST['description']);
    $start_date = sanitise($_POST['start_date']);
    $end_date = sanitise($_POST['end_date']);
    $type = sanitise($_POST['type']);
    $location = (isset($_POST['location']) && $_POST['location'] != "") ? sanitise($_POST['location']) : null;
    echo EventDB::create($title, $description, $location, $type, $start_date, $end_date);
    exit;
    break;
  case 'add_image':
    $event_id = sanitise($_POST['event_id']);
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
        $file_destination = 'assets/uploads/' . $file_name_new;
        if (move_uploaded_file($file_tmp, $file_destination)) {

          EventDB::add_image($event_id, $file_name_new);

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
