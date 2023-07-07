<?php

class LikeDB {

  public static function get_likes($id, $type) {
    $db = new SimpleDB('xsn');
    $sql = "
    SELECT
      COUNT(DISTINCT user_like.user_id) AS likes
    FROM $type
      LEFT JOIN user_like ON user_like.object_id = $type.id
    WHERE $type.id = $id
    ";
    $result = $db->fetch_single($sql);

    return $result['likes'];
  }

  public static function like_object($id, $type) {
    $db = new SimpleDB('xsn');
    $sql = "
    INSERT INTO user_like (user_id, object_id, object_type)
    VALUES (:user_id, :object_id, :object_type)
    ";
    $params = array(
      ':user_id' => $_SESSION['user_id'],
      ':object_id' => $id,
      ':object_type' => $type
    );
    $result = $db->query($sql, $params);

    return $result;
  }

  public static function unlike_object($id, $type) {
    $db = new SimpleDB('xsn');
    $sql = "
    DELETE FROM user_like
    WHERE user_id = :user_id
    AND object_id = :object_id
    AND object_type = :object_type
    ";
    $params = array(
      ':user_id' => $_SESSION['user_id'],
      ':object_id' => $id,
      ':object_type' => $type
    );
    $result = $db->query($sql, $params);

    return $result;
  }
}