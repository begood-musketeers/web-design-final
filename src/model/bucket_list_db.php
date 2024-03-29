<?php

class BucketListDB {

    public static function get_bucket_lists($user_id) {
        $db = SimpleDB::Singleton();
        $query = "SELECT id,title FROM `bucket_list` WHERE user_id = ?;";
        return $db->fetch_prepared_multiple($query, "i", $user_id);
    }

    public static function remove_bucket_list($bucket_list_id) {
        $db = SimpleDB::Singleton();
        $query = "DELETE FROM bucket_list WHERE id=?";
        $db->query_prepared($query, "i", $bucket_list_id);
    }

    public static function get_bucket_list($bucket_list_id) {
        $db = SimpleDB::Singleton();
        $query = "SELECT bucket_list.title, bucket_list_item.id, bucket_list_item.content FROM `bucket_list` INNER JOIN bucket_list_item ON bucket_list_item.bucket_list_id = bucket_list.id WHERE bucket_list.id = ?;";
        return $db->fetch_prepared_multiple($query, "i", $bucket_list_id);
    }

    public static function get_bucket_list_name($bucket_list_id) {
        $db = SimpleDB::Singleton();
        $query = "SELECT title FROM bucket_list WHERE id = ?";
        return $db->fetch_prepared($query, "i", $bucket_list_id)[0]["title"];
    }

    public static function create($user_id, $title) {
        $db = SimpleDB::Singleton();
        $result = $db->query_prepared("INSERT INTO bucket_list (`user_id`, `title`) VALUES ($user_id, ?)", "s", $title);
        return $result;
    }

    public static function add_item($bucket_list_id, $content) {
        $db = SimpleDB::Singleton();
        return $db->query_prepared("INSERT INTO bucket_list_item (`bucket_list_id`, `content`) VALUES ($bucket_list_id, ?)", "s", $content);
    }

    public static function remove_item($item_id) {
        $db = SimpleDB::Singleton();
        $db->query("DELETE FROM bucket_list_item WHERE id=$item_id");
    }

    public static function update_item($item_id, $content) {
        $db = SimpleDB::Singleton();
        $db->query_prepared("UPDATE bucket_list_item SET content=? WHERE id=?", "si", $content, $item_id);
    }
}

?>
