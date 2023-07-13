<?php

class NotificationDB {
    public static function create_notification($user_id, $object_id, $object_type, $type) {
        $db = new SimpleDB('xsn');
        $db->query_prepared("INSERT INTO notification ('user_id', 'object_id', 'object_type', 'type') VALUES ($user_id, $object_id, ?, ?)", "ss", $object_type, $type);
    }

    public static function remove_notification($notification_id) {
        $db = new SimpleDB('xsn');
        $db->query("DELETE FROM notification WHERE id=$notification_id");
    }

    public static function get_notifications($user_id) {
        $db = new SimpleDB('xsn');
        return $db->fetch("SELECT * FROM notification WHERE user_id=$user_id");
    }
}

?>
