<?php

abstract class ObjectType {
    const POST = "post";
    const EVENT = "event";
    const RECOMMENDATION = "recommendation";
    const BUCKET_LIST = "bucket_list";
}

class CommentDB {
    public static function get_comments_for($user_id, $object_id, $object_type) {
        $db = SimpleDB::Singleton();
        return $db->query("SELECT * from comment WHERE user_id=$user_id AND object_id=$object_id AND object_type=$object_type");
    }

    public static function add_comment($user_id, $object_id, $object_type, $content) {
        $db = SimpleDB::Singleton();

        // find the object owner
        $sql = "
        SELECT user_id
        FROM $object_type
        WHERE id = ?
        ";
        $user_result = $db->fetch_prepared($sql, "i", $object_id);

        // notify the object owner
        $sql = "
        INSERT INTO notification (user_id, acting_user_id, object_id, object_type, type)
        VALUES (?, ?, ?, ?, ?)
        ";
        $result = $db->query_prepared($sql, "iiiss", $user_result[0]['user_id'], $user_id, $object_id, $object_type, "comment");

        // insert comment
        return $db->query_prepared("INSERT INTO comment (`user_id`, `object_id`, `object_type`, `content`) VALUES (?, ?, ?, ?)", "iiss", $user_id, $object_id, $object_type, $content);
    }

    public static function remove_comment($user_id, $comment_id) {
        $db = SimpleDB::Singleton();
        return $db->query_prepared("DELETE FROM comment WHERE id = ? AND user_id = ?", "ii", $comment_id, $user_id);
    }
}

?>
