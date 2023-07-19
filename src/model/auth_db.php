<?php

class AuthDB {
  public static function register($username, $password, $password_confirm, $email, $security_question_id, $security_question_answer) {
    $db = SimpleDB::Singleton();
  
    if (strlen($username) < 3) {
      return ["state" => "error", "message" => "Username must be at least 3 characters long"];
    }

    if (strlen($password) < 8) {
      return ["state" => "error", "message" => "Password must be at least 8 characters long"];
    }

    if (strlen($email) < 3) {
      return ["state" => "error", "message" => "Email must be at least 3 characters long"];
    }

    if ($security_question_id < 1 || $security_question_id > 5) {
      return ["state" => "error", "message" => "Security question is invalid"];
    }

    if (strlen($security_question_answer) < 3) {
      return ["state" => "error", "message" => "Security answer must be at least 3 characters long"];
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return ["state" => "error", "message" => "Email is invalid"];
    }

    if (!preg_match('/^[a-zA-Z0-9]+$/', $username)) {
      return ["state" => "error", "message" => "Username must be alphanumeric"];
    }

    

    // check if username is taken
    $sql = "SELECT count(*) FROM user WHERE username = '$username'";
    $result = $db->fetch($sql);
    if ($result['count(*)'] == 1) {
      return ["state" => "error", "message" => "Username is taken"];
    }
  
    // check if email is taken
    $sql = "SELECT count(*) FROM user WHERE email = '$email'";
    $result = $db->fetch($sql);
    if ($result['count(*)'] == 1) {
      return ["state" => "error", "message" => "Email is taken"];
    }
  
    // check if passwords match
    if ($password != $password_confirm) {
      return ["state" => "error", "message" => "Passwords do not match"];
    }
  
    // create user
    $password = password_hash($password, PASSWORD_DEFAULT);
  
    $sql = "INSERT INTO user (username, password, email, security_question_id, security_question_answer, role) VALUES ('$username', '$password', '$email', '$security_question_id', '$security_question_answer', 'student')";
    $db->query($sql);
  
    $sql = "SELECT count(*) FROM user WHERE username = '$username'";
    $result = $db->fetch($sql);
  
    if ($result['count(*)'] == 1) {
      return ["state" => "success"];
    } else {
      return ["state" => "error", "message" => "Unknown error"];
    }
  }
  
  public static function login($username, $password) {
        $db = SimpleDB::Singleton();
  
    $sql = "SELECT * FROM user WHERE username = '$username'";
    $result = $db->fetch($sql);
  
    if (isset($result) && password_verify($password, $result['password'])) {
      $_SESSION['user_id'] = $result['id'];
      $_SESSION['loggedin'] = true;
      return ["state" => "success"];
    } else {
      return ["state" => "error", "message" => "Incorrect username or password"];
    }
  }
}
