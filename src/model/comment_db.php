<?php

abstract class ObjectType {
    const POST = "post";
    const RECOMMENDATION = "recommendation";
    const BUCKET_LIST = "bucket_list";
}

class CommentDB {
    public static function get_comments_for($user_id, $object_id, $object_type) {
        $db = new SimpleDB('xsn');
        return $db->query("SELECT * from comment WHERE user_id=$user_id AND object_id=$object_id AND object_type=$object_type");
    }

    public static function add_comment($user_id, $object_type, $content) {
        $db = new SimpleDB('xsn');
        return $db->query_prepared("INSERT INTO comment ('user_id', 'object_type', 'content') VALUES ($user_id, $object_type, ?)", "s", $content);
    }

    public static function remove_comment($comment_id) {
        $db = new SimpleDB('xsn');
        $db->query("DELETE FROM comment WHERE id=$comment_id");
    }
}

?>
