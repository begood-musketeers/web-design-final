<?php
include ("model/user_db.php");

if (isset($_GET["u"])) {
    $id = UserDB::find_user_id($_GET["u"]);
    if ($id == null) {
        header("Location: ?");
        die();
    } else {
        $id = $id[0]["id"];
    }
} else if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) {
    $id = $_SESSION["user_id"];
} else {
    header("Location: ?");
    die();
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $request = "profile";
} else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $request = $_POST["request"];
}

switch($request) {
    case "picture":
        $upload_root = realpath(dirname(__FILE__) . "/../finalteam2/uploads");
        $img = $_FILES["profile_picture"];
        $img_name = "pp_$id.png";
        $upload_path = $upload_root . "/$img_name";
        if(move_uploaded_file($img["tmp_name"], $upload_path)) {
            UserDB::set_picture($id, $img_name);
        } else {
            echo "Error uploading picture";
        }

    default:
        $user = UserDB::get_user($id);
        $user_objects = UserDB::get_latest_objects($id, 10);
}

?>
