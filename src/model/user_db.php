<?php

class UserDB {
    public static function get_user($id) {
        $db = new SimpleDB('xsn');
        $result = $db->fetch("SELECT * FROM user WHERE id=$id");
        
        return $result;
    }

    public static function get_users() {
        $db = new SimpleDB('xsn');
        $result = $db->query("SELECT * FROM user");
        return $result;
    }

    public static function delete_user($id) {
        $db = new SimpleDB('xsn');
        $db->query_prepared("DELETE FROM user WHERE id=?", "i", $id);
    }
}

?>
