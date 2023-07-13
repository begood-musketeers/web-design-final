<?php

class LikeDB {

  public static function get_likes($id, $type) {
        $db = SimpleDB::Singleton();
    $sql = "
    SELECT
      COUNT(DISTINCT user_like.user_id) AS likes
    FROM $type
      LEFT JOIN user_like ON user_like.object_id = $type.id
    WHERE $type.id = $id
    ";
    $result = $db->fetch($sql);

    return $result['likes'];
  }

  public static function like_object($id, $type) {
        $db = SimpleDB::Singleton();
    $user_id = $_SESSION['user_id'];
    $sql = "
    INSERT INTO user_like (user_id, object_id, object_type)
    VALUES ($user_id, $id, '$type')
    ";
    $result = $db->query($sql);
  }

  public static function unlike_object($id, $type) {
        $db = SimpleDB::Singleton();
    $user_id = $_SESSION['user_id'];
    $sql = "
    DELETE FROM user_like
    WHERE user_id = $user_id AND object_id = $id AND object_type = '$type'
    ";
    $result = $db->query($sql);
  }
}
