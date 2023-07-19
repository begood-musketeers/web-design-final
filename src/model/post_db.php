<?php

class PostDB {

  public static function get_latest($amount = 50) {
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
    WHERE post.visible = 1
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

  public static function get($id) {
        $db = SimpleDB::Singleton();
    $sql = "
    SELECT post.id, post.user_id, user.username, post.type, post.title, post.description, post.location, post.created_datetime, user.picture as user_picture FROM post
    JOIN user ON user.id = post.user_id
    WHERE visible = 1 AND post.id = $id
    ORDER BY post.id DESC
    ";
    $post = $db->fetch($sql);

    // get comments
    $sql = "
    SELECT comment.id, username, user_id, created_datetime, content, user.picture as user_picture FROM comment
    JOIN user ON user.id = comment.user_id
    WHERE comment.object_id = $id AND comment.object_type = 'post'
    ORDER BY comment.created_datetime DESC
    ";
    $comments = $db->fetch_multiple($sql);

    // get likes
    $sql = "
    SELECT * FROM user_like
    JOIN user ON user.id = user_like.user_id
    WHERE user_like.object_id = $id AND user_like.object_type = 'post'
    ";
    $likes = $db->fetch_multiple($sql);

    // get images
    $sql = "
    SELECT file_name FROM image
    WHERE object_id = $id AND object_type = 'post'
    ";
    $images = $db->fetch_multiple($sql);

    // check if user has liked post
    $user_id = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : -1;
    $sql = "
    SELECT COUNT(*) AS liked FROM user_like
    WHERE user_id = $user_id AND object_id = $id AND object_type = 'post'
    ";
    $liked = $db->fetch($sql)['liked'];

    return [$post, $comments, $likes, $liked, $images];
  }

  public static function create($user_id, $title, $description, $location) {
    $db = SimpleDB::Singleton();
    $sql = "
    INSERT INTO post (`user_id`, `type`, `title`, `description`, `location`, `visible`)
    VALUES (?, 'post',?,?,?, 1)
    ";
    return $db->query_prepared($sql, "isss", $user_id, $title, $description, $location);
  }

  public static function add_image($post_id, $file_name) {

    $db = SimpleDB::Singleton();
    $sql = "
    INSERT INTO image (object_id, object_type, file_name)
    VALUES ($post_id, 'post', '$file_name')
    ";
    $result = $db->query($sql);

    return $result;
  }

  public static function delete($user_id, $post_id) {
    $db = SimpleDB::Singleton();

    // check if user is owner of post
    $sql = "
    SELECT COUNT(*) AS count FROM post
    WHERE id = $post_id AND user_id = $user_id
    ";
    $result = $db->fetch($sql);

    if ($result['count'] == 0) {
      return json_encode(['state' => 'error', 'message' => 'You are not the owner of this post.']);
    }

    $sql = "DELETE FROM post WHERE id = $post_id";
    $result = $db->query($sql);

    // delete all comments
    $sql = "DELETE FROM comment WHERE object_id = $post_id AND object_type = 'post'";
    $result = $db->query($sql);

    // delete all likes
    $sql = "DELETE FROM user_like WHERE object_id = $post_id AND object_type = 'post'";
    $result = $db->query($sql);

    // delete all images
    $sql = "DELETE FROM image WHERE object_id = $post_id AND object_type = 'post'";
    $result = $db->query($sql);

    return $result;
  }

}
