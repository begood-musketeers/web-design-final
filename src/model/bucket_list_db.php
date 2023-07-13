<?php

class BucketListDB {
    public static function create($user_id, $title) {
        $db = new SimpleDB('xsn');
        $db->query_prepared("INSERT INTO bucket_list ('user_id', 'title') VALUES ($user_id, ?)", "s", $title);
    }

    public static function add_item($bucket_list_id, $content, $completed) {
        $db = new SimpleDB('xsn');
        $db->query_prepared("INSERT INTO bucket_list_item ('bucket_list_id', 'content', 'completed') VALUES ($bucket_list_id, ?, ?)", "si", $content, $completed);
    }

    public static function remove_item($item_id) {
        $db = new SimpleDB('xsn');
        $db->query("DELETE FROM bucket_list_item WHERE id=$item_id");
    }

    public static function set_completed($item_id, $completed) {
        $db = new SimpleDB('xsn');
        $db->query_prepared("UPDATE bucket_list_item SET completed=? WHERE id=$item_id", "i", $completed);
    }

    public static function complete($item_id) {
        BucketListDB::set_completed($item_id, true);
    }
}

?>
