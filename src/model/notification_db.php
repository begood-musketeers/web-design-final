<?php

class NotificationDB {
    public static function create_notification($user_id, $object_id, $object_type, $type) {
        $db = SimpleDB::Singleton();
        $db->query_prepared("INSERT INTO notification ('user_id', 'object_id', 'object_type', 'type') VALUES ($user_id, $object_id, ?, ?)", "ss", $object_type, $type);
    }

    public static function remove_notification($notification_id) {
        $db = SimpleDB::Singleton();
        $db->query("DELETE FROM notification WHERE id=$notification_id");
    }

    public static function get_notifications($user_id) {
        $db = SimpleDB::Singleton();
        return $db->fetch("SELECT * FROM notification WHERE user_id=$user_id");
    }
}

?>
