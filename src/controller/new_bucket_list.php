<?php

if(isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];
} else {
    echo "<script> window.location = '?p=404'</script>";
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
    echo "<script> window.location = '?p=404'</script>";
    die();
}

include("model/bucket_list_db.php");

$bucket_list = null;
$bucket_lists = array();

switch ($request) {
    case 'new_bucket_list':
        $title = sanitise($_POST["title"]);
        $bucket_list_id = BucketListDB::create($user_id, $title);
        header("Location: ?p=new_bucket_list&bucket_list_id=$bucket_list_id");
        break;
    case 'add_item':
        $content = sanitise($_POST["content"]);
        $bucket_list_id = sanitise($_POST["bucket_list_id"]);
        BucketListDB::add_item($bucket_list_id, $content);
        break;
    case 'complete_item':
        $item_id = sanitise($_POST["item_id"]);
        echo BucketListDB::complete($item_id);
        break;
    case 'update_item':
        $bucket_list_id = sanitise($_POST["bucket_list_id"]);
        $item_id = sanitise($_POST["item_id"]);
        $content = sanitise($_POST["content"]);
        BucketListDB::update_item($item_id, $content);
        break;
    case "delete_item":
        $bucket_list_id = sanitise($_POST["bucket_list_id"]);
        $item_id = sanitise($_POST["item_id"]);
        BucketListDB::remove_item($item_id);
        break;
}

?>
