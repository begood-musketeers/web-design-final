<?php

class EventDB {

  public static function get_latest($amount = 50) {
        $db = SimpleDB::Singleton();
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
      COUNT(DISTINCT comment.id) AS comments,
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

    // for each event, check if given user has liked it
    $user_id = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : -1;
    foreach ($result as $key => $event) {
      $event_id = $event['id'];
      $sql = "
      SELECT COUNT(*) AS liked FROM user_like
      WHERE user_id = $user_id AND object_id = $event_id AND object_type = 'event'
      ";
      $liked = $db->fetch($sql);
      $result[$key]['liked'] = $liked['liked'];
    }

    return $result;
  }

  public static function create($title, $description, $location, $type, $start_date, $end_date) {
        $db = SimpleDB::Singleton();
    $user_id = $_SESSION['user_id'];
    $sql = "
    INSERT INTO event (user_id, type, title, description, location, start_datetime, end_datetime, visible)
    VALUES ($user_id, '$type', '$title', '$description', '$location', '$start_date', '$end_date', 1)
    ";
    $result = $db->query($sql);

    $sql = "
    SELECT id FROM event 
    WHERE user_id = $user_id AND type = '$type' AND title = '$title' AND description = '$description' AND location = '$location'
    ORDER BY id DESC LIMIT 1";
    $new_id = $db->fetch($sql)['id'];

    return json_encode(['state' => 'success', 'event_id' => $new_id]);
  }
  
  public static function add_image($event_id, $file_name) {
    // check if user is owner of event
        $db = SimpleDB::Singleton();
    $user_id = $_SESSION['user_id'];
    $sql = "
    SELECT COUNT(*) AS count FROM event
    WHERE id = $event_id AND user_id = $user_id
    ";
    $result = $db->fetch($sql);

    if ($result['count'] == 0) {
      return json_encode(['state' => 'error', 'message' => 'You are not the owner of this event.']);
    }

        $db = SimpleDB::Singleton();
    $sql = "
    INSERT INTO image (object_id, object_type, file_name)
    VALUES ($event_id, 'event', '$file_name')
    ";
    $result = $db->query($sql);

    return $result;
  }

}
