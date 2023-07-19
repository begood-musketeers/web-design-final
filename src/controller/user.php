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
        $upload_root = dirname(__FILE__) . "/../uploads";
        echo $upload_root;
        $img = $_FILES["profile_picture"];
        $img_name = "$upload_root/pp_$id.png";
        if(move_uploaded_file($img["tmp_name"], $img_name)) {
        } else {
            echo "Error uploading picture";
        }
        break;
}

?>
