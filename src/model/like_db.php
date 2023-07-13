<?php

class LikeDB {

  public static function get_likes($id, $type) {
    $db = new SimpleDB('xsn');
    $sql = "
    SELECT COUNT(*) AS likes
    FROM user_like
    WHERE object_id = $id AND object_type = '$type'
    ";
    $result = $db->fetch($sql);

    return $result['likes'];
  }

  public static function like_object($id, $type) {
    $db = new SimpleDB('xsn');
    $user_id = $_SESSION['user_id'];
    $sql = "
    INSERT INTO user_like (user_id, object_id, object_type)
    VALUES ($user_id, $id, '$type')
    ";
    $result = $db->query($sql);
  }

  public static function unlike_object($id, $type) {
    $db = new SimpleDB('xsn');
    $user_id = $_SESSION['user_id'];
    $sql = "
    DELETE FROM user_like
    WHERE user_id = $user_id AND object_id = $id AND object_type = '$type'
    ";
    $result = $db->query($sql);
  }
}