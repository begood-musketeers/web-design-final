<?php

class PostDB {

  public static function get_latest($amount = 50) {
    $db = new SimpleDB('xsn');
    $sql = "
    SELECT
      post.id,
      post.user_id,
      user.username,
      post.type,
      post.title,
      post.description,
      post.location,
      post.created_datetime,
      COUNT(DISTINCT user_like.user_id) AS likes,
      COUNT(DISTINCT comment.user_id) AS comments,
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
    $db = new SimpleDB('xsn');
    $sql = "
    SELECT post.id, post.user_id, user.username, post.type, post.title, post.description, post.location, post.created_datetime FROM post
    JOIN user ON user.id = post.user_id
    WHERE visible = 1
    ORDER BY post.id DESC
    ";
    $post = $db->fetch($sql);

    // get comments
    $sql = "
    SELECT * FROM comment
    JOIN user ON user.id = comment.user_id
    WHERE comment.object_id = 1 AND comment.object_type = 'post'
    ORDER BY comment.created_datetime DESC
    ";
    $comments = $db->fetch_multiple($sql);

    // get likes
    $sql = "
    SELECT * FROM user_like
    JOIN user ON user.id = user_like.user_id
    WHERE user_like.object_id = 1 AND user_like.object_type = 'post'
    ";
    $likes = $db->fetch_multiple($sql);

    // get images
    $sql = "
    SELECT file_name FROM image
    WHERE object_id = 1 AND object_type = 'post'
    ";
    $images = $db->fetch_multiple($sql);

    // check if user has liked post
    $user_id = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : -1;
    $sql = "
    SELECT COUNT(*) AS liked FROM user_like
    WHERE user_id = $user_id AND object_id = 1 AND object_type = 'post'
    ";
    $liked = $db->fetch($sql)['liked'];

    return [$post, $comments, $likes, $liked, $images];
  }

  public static function create($title, $description, $location) {
    $db = new SimpleDB('xsn');
    $user_id = $_SESSION['user_id'];
    $sql = "
    INSERT INTO post (user_id, type, title, description, location, visible)
    VALUES ($user_id, 'post', '$title', '$description', '$location', 1)
    ";
    $result = $db->query($sql);

    $sql = "
    SELECT id FROM post 
    WHERE user_id = $user_id AND type = 'post' AND title = '$title' AND description = '$description' AND location = '$location'
    ORDER BY id DESC LIMIT 1";
    $new_id = $db->fetch($sql)['id'];

    return json_encode(['state' => 'success', 'post_id' => $new_id]);
  }

  public static function add_image($post_id, $file_name) {
    // check if user is owner of post
    $db = new SimpleDB('xsn');
    $user_id = $_SESSION['user_id'];
    $sql = "
    SELECT COUNT(*) AS count FROM post
    WHERE id = $post_id AND user_id = $user_id
    ";
    $result = $db->fetch($sql);

    if ($result['count'] == 0) {
      return json_encode(['state' => 'error', 'message' => 'You are not the owner of this post.']);
    }

    $db = new SimpleDB('xsn');
    $sql = "
    INSERT INTO image (object_id, object_type, file_name)
    VALUES ($post_id, 'post', '$file_name')
    ";
    $result = $db->query($sql);

    return $result;
  }

  public static function delete($post_id) {
    $db = new SimpleDB('xsn');
    $sql = "DELETE FROM post WHERE id = $post_id";
    $result = $db->query($sql);

    // delete all comments
    $sql = "DELETE FROM comment WHERE object_id = $post_id AND object_type = 'post'";
    $result = $db->query($sql);

    // delete all likes
    $sql = "DELETE FROM user_like WHERE object_id = $post_id AND object_type = 'post'";
    $result = $db->query($sql);

    return $result;
  }

}