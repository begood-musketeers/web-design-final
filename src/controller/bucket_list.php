<?php
include ("model/bucket_list_db.php");

if(isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];
} else {
    echo "<script> window.location = '/?p=404'</script>";
    die();
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['request'])) {
  $request = sanitise($_POST['request']);
} else if ($_SERVER["REQUEST_METHOD"] == "GET"){
    $request = "list_bucket_lists";
} else {
  echo "<script>window.location.href = '?p=404';</script>";
  exit;
}

switch($request) {
    case "delete_bucket_list":
        $id = sanitise($_POST["bucket_list_id"]);
        BucketListDB::remove_bucket_list($id);
        break;
    case 'list_bucket_lists':
        $bucket_lists = BucketListDB::get_bucket_lists($user_id);
        break;
    default:
        break;
}
