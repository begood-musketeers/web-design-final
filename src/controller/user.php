<?php
include ("model/user_db.php");

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) {
    $id = $_SESSION["user_id"];
} else {
    http_response_code(403);
    echo json_encode(["error" => "not logged in"]);
    die();
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $request = "profile";
} else if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    $request = "delete";
}

switch($request) {
    case "profile":
        http_response_code(200);
        $user = UserDB::get_user($id);
        break;
}

?>
