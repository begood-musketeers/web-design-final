<?php

class EventDB {

  public static function get_latest($amount = 50) {
        $db = SimpleDB::Singleton();
    $sql = "
    SELECT
      event.id,
      event.user_id,
      user.username,
      user.picture as user_picture,
      event.type,
      event.title,
      event.description,
      event.location,
      event.created_datetime,
      event.start_datetime,
      user.picture AS user_picture,
      COUNT(DISTINCT user_like.user_id) AS likes,
      COUNT(DISTINCT comment.id) AS comments,
      COUNT(DISTINCT event_participant.user_id) AS participants,
      GROUP_CONCAT(DISTINCT image.file_name) AS image_file_names
    FROM event
      JOIN user ON user.id = event.user_id
      LEFT JOIN user_like ON user_like.object_id = event.id AND user_like.object_type = 'event'
      LEFT JOIN comment ON comment.object_id = event.id AND comment.object_type = 'event'
      LEFT JOIN image ON image.object_id = event.id AND image.object_type = 'event'
      LEFT JOIN event_participant ON event_participant.event_id = event.id
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

  public static function get($id) {
    $db = SimpleDB::Singleton();
    $sql = "
    SELECT event.id, event.user_id, user.username, event.type, event.title, event.description, event.location, event.created_datetime, event.start_datetime, event.end_datetime, user.picture as user_picture FROM event
    JOIN user ON user.id = event.user_id
    WHERE visible = 1 AND event.id = $id
    ORDER BY event.id DESC
    ";
    $event = $db->fetch($sql);

    // get comments
    $sql = "
    SELECT comment.id, username, user_id, created_datetime, content, user.picture as user_picture FROM comment
    JOIN user ON user.id = comment.user_id
    WHERE comment.object_id = $id AND comment.object_type = 'event'
    ORDER BY comment.created_datetime DESC
    ";
    $comments = $db->fetch_multiple($sql);

    // get likes
    $sql = "
    SELECT * FROM user_like
    JOIN user ON user.id = user_like.user_id
    WHERE user_like.object_id = $id AND user_like.object_type = 'event'
    ";
    $likes = $db->fetch_multiple($sql);

    // get images
    $sql = "
    SELECT file_name FROM image
    WHERE object_id = $id AND object_type = 'event'
    ";
    $images = $db->fetch_multiple($sql);

    // check if user has liked event
    $user_id = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : -1;
    $sql = "
    SELECT COUNT(*) AS liked FROM user_like
    WHERE user_id = $user_id AND object_id = $id AND object_type = 'event'
    ";
    $liked = $db->fetch($sql)['liked'];

    // check if user is taking part in event
    $sql = "
    SELECT COUNT(*) AS taking_part FROM event_participant
    WHERE user_id = $user_id AND event_id = $id
    ";
    $taking_part = $db->fetch($sql)['taking_part'];

    // get all participants
    $sql = "
    SELECT user_id, username, user.picture as user_picture FROM event_participant
    JOIN user ON user.id = event_participant.user_id
    WHERE event_id = $id
    ";
    $participants = $db->fetch_multiple($sql);

    return [$event, $comments, $likes, $liked, $images, $taking_part, $participants];
  }

  public static function create($user_id, $title, $description, $location, $type, $start_date, $end_date) {
    $db = SimpleDB::Singleton();
    $sql = "
    INSERT INTO event (`user_id`, `title`, `description`, `type`, `location`, `start_datetime`, `end_datetime`, `visible`)
    VALUES (?, ?, ?, ?, ?, ?, ?, 1)
    ";
    return $db->query_prepared($sql, "issssss", $user_id, $title, $description, $type, $location, $start_date, $end_date);
  }
  
  public static function add_image($event_id, $file_name) {
    $db = SimpleDB::Singleton();
    $sql = "
    INSERT INTO image (object_id, object_type, file_name)
    VALUES ($event_id, 'event', '$file_name')
    ";
    echo $sql;
    $result = $db->query($sql);

    return $result;
  }

  public static function delete($user_id, $event_id) {
    $db = SimpleDB::Singleton();

    // check if user is owner of event
    $sql = "
    SELECT COUNT(*) AS count FROM event
    WHERE id = $event_id AND user_id = $user_id
    ";
    $result = $db->fetch($sql);

    if ($result['count'] == 0) {
      return json_encode(['state' => 'error', 'message' => 'You are not the owner of this event.']);
    }

    $sql = "DELETE FROM event WHERE id = $event_id";
    $result = $db->query($sql);

    // delete all comments
    $sql = "DELETE FROM comment WHERE object_id = $event_id AND object_type = 'event'";
    $result = $db->query($sql);

    // delete all likes
    $sql = "DELETE FROM user_like WHERE object_id = $event_id AND object_type = 'event'";
    $result = $db->query($sql);

    // delete all images
    $sql = "DELETE FROM image WHERE object_id = $event_id AND object_type = 'event'";
    $result = $db->query($sql);

    // delete all participants
    $sql = "DELETE FROM event_participant WHERE event_id = $event_id";
    $result = $db->query($sql);

    return $result;
  }

  public static function join_event($user_id, $event_id) {
    $db = SimpleDB::Singleton();

    // check if user is already participant
    $sql = "
    SELECT COUNT(*) AS count FROM event_participant
    WHERE event_id = $event_id AND user_id = $user_id
    ";
    $result = $db->fetch($sql);

    if ($result['count'] > 0) {
      $sql = "
      DELETE FROM event_participant
      WHERE event_id = $event_id AND user_id = $user_id
      ";
      $result = $db->query($sql);
    } else {
      $db->query_prepared("INSERT INTO event_participant (event_id, user_id) VALUES (?, ?)", "ii", $event_id, $user_id);

      // send notification to event owner
      $sql = "
      SELECT user_id FROM event
      WHERE id = $event_id
      ";
      $event_owner_id = $db->fetch($sql)['user_id'];

      // user_id 	acting_user_id 	object_id 	object_type 	type 	created_datetime 	
      $sql = "
      INSERT INTO notification (user_id, acting_user_id, object_id, object_type, type)
      VALUES (?, ?, ?, 'event', 'event_join')
      ";
      $db->query_prepared($sql, "iii", $event_owner_id, $user_id, $event_id);
    }

  }

}
