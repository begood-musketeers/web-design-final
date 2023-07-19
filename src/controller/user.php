<?php
include ("model/user_db.php");

if (isset($_GET["u"])) {
    $id = UserDB::find_user_id($_GET["u"]);
    echo "id: " . json_encode($id);
} else if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) {
    $id = $_SESSION["user_id"];
} else {
    http_response_code(403);
    echo json_encode(["error" => "not logged in"]);
    die();
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $request = "profile";
} else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $request = $_POST["request"];
}

switch($request) {
    case "profile":
        http_response_code(200);
        $user = UserDB::get_user($id);
        break;
    case "picture":
        $upload_root = realpath(dirname(__FILE__) . "/../uploads");
        $img = $_FILES["profile_picture"];
        $img_name = "pp_$id.png";
        $upload_path = $upload_root . "/$img_name";
        if(move_uploaded_file($img["tmp_name"], $upload_path)) {
            UserDB::set_picture($id, $img_name);
        } else {
            echo "Error uploading picture";
        }
        $user = UserDB::get_user($id);
        break;
}

?>
