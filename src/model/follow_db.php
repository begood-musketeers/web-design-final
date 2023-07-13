<?php

class FollowDB {
    public static function get_followers($user_id) {
        $db = SimpleDB::Singleton();
        $result = $db->fetch("SELECT follower_id FROM follow WHERE user_id=$user_id");
        return $result;
    }

    public static function follow_user($user_id, $follower_id) {
        $db = SimpleDB::Singleton();
        $db->query("INSERT INTO follow ('user_id', 'follower_id') VALUES ($user_id, $follower_id)");
    }

    public static function unfollow_user($user_id, $follower_id) {
        $db = SimpleDB::Singleton();
        $db->query("DELETE FROM follow WHERE user_id=$user_id AND follower_id=$follower_id");
    }
}

?>
