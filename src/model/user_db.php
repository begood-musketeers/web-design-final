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
}

?>
