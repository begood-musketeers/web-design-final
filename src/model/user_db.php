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
    
    public static function find_user_id($username) {
        $db = SimpleDB::Singleton();
        return $db->fetch_prepared("SELECT id FROM user WHERE username=? OR email=? LIMIT 1", "ss", $username, $username);
    }

    public static function set_picture($user_id, $path) {
        $db = SimpleDB::Singleton();
        $db->query_prepared("UPDATE user SET picture = ? WHERE id = ?;", "si", $path, $user_id);
    }

    public static function get_latest_posts($user_id, $amount = 50) {
        $db = SimpleDB::Singleton();
    $sql = "
    SELECT
      post.id,
      post.user_id,
      user.username,
      user.picture AS user_picture,
      post.type,
      post.title,
      post.description,
      post.location,
      post.created_datetime,
      COUNT(DISTINCT user_like.user_id) AS likes,
      COUNT(DISTINCT comment.id) AS comments,
      GROUP_CONCAT(DISTINCT image.file_name) AS image_file_names
    FROM post
      JOIN user ON user.id = post.user_id
      LEFT JOIN user_like ON user_like.object_id = post.id AND user_like.object_type = 'post'
      LEFT JOIN comment ON comment.object_id = post.id AND comment.object_type = 'post'
      LEFT JOIN image ON image.object_id = post.id AND image.object_type = 'post'
    WHERE post.visible = 1 AND post.user_id = $user_id
    GROUP BY post.id
    ORDER BY post.id DESC
    LIMIT $amount
    ";
    $result = $db->fetch_multiple($sql);

    // for each post, check if given user has liked it
    $user_id = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : -1;
    foreach ($result as $key => $post) {
      $post_id = $post['id'];
      $sql = "
      SELECT COUNT(*) AS liked FROM user_like
      WHERE user_id = $user_id AND object_id = $post_id AND object_type = 'post'
      ";
      $liked = $db->fetch($sql);
      $result[$key]['liked'] = $liked['liked'];
    }

    return $result;
  }

  public static function get_latest_events($user_id, $amount = 50) {
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
    GROUP_CONCAT(DISTINCT image.file_name) AS image_file_names
    FROM event
    JOIN user ON user.id = event.user_id
    LEFT JOIN user_like ON user_like.object_id = event.id AND user_like.object_type = 'event'
    LEFT JOIN comment ON comment.object_id = event.id AND comment.object_type = 'event'
    LEFT JOIN image ON image.object_id = event.id AND image.object_type = 'event'
    WHERE event.visible = 1 AND event.user_id = $user_id
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

  public static function get_latest_objects($user_id, $amount = 50) {
    $posts = self::get_latest_posts($user_id, intval($amount / 2));
    $events = self::get_latest_events($user_id, intval($amount / 2));

    return [
      'posts' => $posts,
      'events' => $events
    ];
  }
}

?>
