<?php

class UserDB {
    public static function get_user($id) {
        $db = SimpleDB::Singleton();
        $result = $db->fetch("SELECT * FROM user WHERE id=$id");
        
        return $result;
    }

    public static function get_users() {
        $db = SimpleDB::Singleton();
        $result = $db->query("SELECT * FROM user");
        return $result;
    }

    public static function delete_user($id) {
        $db = SimpleDB::Singleton();
        $db->query_prepared("DELETE FROM user WHERE id=?", "i", $id);
    }
    
    public static function find_user_id($username) {
        $db = SimpleDB::Singleton();
        return $db->query_prepared("SELECT id FROM user WHERE username=? OR email=? LIMIT 1", "ss", $username, $username);
    }
}

?>
