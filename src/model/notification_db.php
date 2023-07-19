<?php

class NotificationDB {
    public static function create_notification($user_id, $object_id, $object_type, $type) {
        $db = SimpleDB::Singleton();
        $db->query_prepared("INSERT INTO notification ('user_id', 'object_id', 'object_type', 'type') VALUES ($user_id, $object_id, ?, ?)", "ss", $object_type, $type);
    }

    public static function remove_notification($user_id, $notification_id) {
        $db = SimpleDB::Singleton();
        $db->query("DELETE FROM notification WHERE id=$notification_id AND user_id=$user_id");
    }

    public static function get_notifications($user_id) {
        $db = SimpleDB::Singleton();
        return $db->fetch_multiple("
        SELECT notification.id, user.username, notification.created_datetime, notification.type, notification.object_id, notification.object_type
        FROM notification
        JOIN user ON user.id=notification.user_id
        WHERE user_id=$user_id
        ");
    }
}

?>
