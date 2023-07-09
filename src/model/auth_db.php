<?php

class AuthDB {
  public static function register($username, $password, $password_confirm, $email, $security_question_id, $security_question_answer) {
    $db = new SimpleDB('xsn');
  
    // check if username is taken
    $sql = "SELECT count(*) FROM user WHERE username = '$username'";
    $result = $db->fetch($sql);
    if ($result['count(*)'] == 1) {
      return JSON_encode(["state" => "error", "message" => "Username is taken"]);
    }
  
    // check if email is taken
    $sql = "SELECT count(*) FROM user WHERE email = '$email'";
    $result = $db->fetch($sql);
    if ($result['count(*)'] == 1) {
      return JSON_encode(["state" => "error", "message" => "Email is taken"]);
    }
  
    // check if passwords match
    if ($password != $password_confirm) {
      return JSON_encode(["state" => "error", "message" => "Passwords do not match"]);
    }
  
    // create user
    $password = password_hash($password, PASSWORD_DEFAULT);
  
    $sql = "INSERT INTO user (username, password, email, security_question_id, security_question_answer, role) VALUES ('$username', '$password', '$email', '$security_question_id', '$security_question_answer', 'student')";
    $db->query($sql);
  
    $sql = "SELECT count(*) FROM user WHERE username = '$username'";
    $result = $db->fetch($sql);
  
    if ($result['count(*)'] == 1) {
      return JSON_encode(["state" => "success"]);
    } else {
      return JSON_encode(["state" => "error", "message" => "Unknown error"]);
    }
  }
  
  public static function login($username, $password) {
    $db = new SimpleDB('xsn');
  
    $sql = "SELECT * FROM user WHERE username = '$username'";
    $result = $db->fetch($sql);
  
    if (isset($result) && password_verify($password, $result['password'])) {
      $_SESSION['user_id'] = $result['id'];
      $_SESSION['loggedin'] = true;
      return JSON_encode(["state" => "success"]);
    } else {
      return JSON_encode(["state" => "error", "message" => "Incorrect username or password"]);
    }
  }
}