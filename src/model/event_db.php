<?php

class EventDB {

  public static function get_latest($amount = 50) {
    $db = new SimpleDB('xsn');
    $sql = "
    SELECT
      event.id,
      event.user_id,
      user.username,
      event.type,
      event.title,
      event.description,
      event.location,
      event.created_datetime,
      event.start_datetime,
      COUNT(DISTINCT user_like.user_id) AS likes,
      COUNT(DISTINCT comment.user_id) AS comments,
      GROUP_CONCAT(DISTINCT image.file_name) AS image_file_names
    FROM event
      JOIN user ON user.id = event.user_id
      LEFT JOIN user_like ON user_like.object_id = event.id
      LEFT JOIN comment ON comment.object_id = event.id
      LEFT JOIN image ON image.object_id = event.id AND image.object_type = 'event'
    WHERE event.visible = 1
    GROUP BY event.id
    ORDER BY event.id DESC
    LIMIT $amount
    ";
    $result = $db->fetch_multiple($sql);

    return $result;
  }

}