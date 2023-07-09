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
      LEFT JOIN user_like ON user_like.object_id = event.id AND user_like.object_type = 'event'
      LEFT JOIN comment ON comment.object_id = event.id AND comment.object_type = 'event'
      LEFT JOIN image ON image.object_id = event.id AND image.object_type = 'event'
    WHERE event.visible = 1 
    GROUP BY event.id
    ORDER BY event.id DESC
    LIMIT $amount
    ";
    $result = $db->fetch_multiple($sql);

    // for each post, check if given user has liked it
    $user_id = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : -1;
    foreach ($result as $key => $post) {
      $post_id = $post['id'];
      $sql = "
      SELECT COUNT(*) AS liked FROM user_like
      WHERE user_id = $user_id AND object_id = $post_id AND object_type = 'event'
      ";
      $liked = $db->fetch($sql);
      $result[$key]['liked'] = $liked['liked'];
    }

    return $result;
  }

}