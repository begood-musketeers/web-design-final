<?php

class PostDB {

  public static function get_posts() {
    $db = new SimpleDB('xsn');
    $sql = "SELECT id, user_id, type, title, description, location, created_datetime, visible FROM post ORDER BY id DESC";
    $result = $db->fetch_multiple($sql);

    return $result;
  }

}