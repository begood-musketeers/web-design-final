<?php

if(isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];
} else {
    echo "<script> window.location = '/?p=404'</script>";
    die();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["request"])) {
    $request = sanitise($_POST["request"]);
} else if ($_SERVER["REQUEST_METHOD"] == "GET"){
    if (isset($_GET["bucket_list_id"])) {
        $bucket_list_id = sanitise($_GET["bucket_list_id"]);
        $request = "get_bucket_list";
    } else {
        $request = "list_bucket_lists";
    }
} else {
    $request = null;
    echo "<script> window.location = '/?p=404'</script>";
    die();
}

include("model/bucket_list_db.php");

$bucket_list = null;
$bucket_lists = array();

switch ($request) {
    case 'new_bucket_list':
        $title = sanitise($_POST["title"]);
        $bucket_list_id = BucketListDB::create($user_id, $title);
        break;
    case 'add_item':
        $content = sanitise($_POST["content"]);
        $bucket_list_id = sanitise($_POST["bucket_list_id"]);
        if (isset($_POST["completed"])) {
            $completed = filter_var($_POST["completed"], FILTER_VALIDATE_BOOLEAN);
        } else {
            $completed = false;
        }
        BucketListDB::add_item($bucket_list_id, $content, $completed);
        break;
    case 'complete_item':
        $item_id = sanitise($_POST["item_id"]);
        echo BucketListDB::complete($item_id);
        break;
    case 'update_item':
        $bucket_list_id = sanitise($_POST["bucket_list_id"]);
        $item_id = sanitise($_POST["item_id"]);
        $content = sanitise($_POST["content"]);
        $completed = filter_var($_POST["completed"], FILTER_VALIDATE_BOOLEAN);
        BucketListDB::update_item($item_id, $content, $completed);
        break;
    case "delete_item":
        $bucket_list_id = sanitise($_POST["bucket_list_id"]);
        $item_id = sanitise($_POST["item_id"]);
        BucketListDB::remove_item($item_id);
        break;
}

?>
