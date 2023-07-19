<?php

include ("model/notification_db.php");

if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];
} else {
    echo "<script> window.location = '/?p=404'</script>";
    die();
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["notification_id"])) {
    $action = "read_notification";
} else if ($_SERVER["REQUEST_METHOD"] == "GET"){
    $action = "get_notifications";
} else {
    echo "<script> window.location = '/?p=404'</script>";
    die();
}

switch($action) {
    case "read_notification":
        $notif_id = sanitise($_POST["notification_id"]);
        NotificationDB::remove_notification($notif_id);
        $notifications = NotificationDB::get_notifications($user_id);
        break;
    case "get_notifications":
        $notifications = NotificationDB::get_notifications($user_id);
        break;
}
?>
