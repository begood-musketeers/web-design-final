<?php
include("model/auth_db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['request'])) {
  $request = sanitise($_POST['request']);
} else {
  $request = 'get_posts';
}

switch ($request) {
  case 'login':
    $username = sanitise($_POST['username']);
    $password = sanitise($_POST['password']);
    $result = AuthDB::login($username, $password);

    if ($result['state'] == 'success') {
      header("Location: ?");
      exit;
    }
    break;

  case 'register':
    $username = sanitise($_POST['username']);
    $password = sanitise($_POST['password']);
    $password_confirm = sanitise($_POST['password_confirm']);
    $email = sanitise($_POST['email']);
    $security_question_id = sanitise($_POST['security_question_id']);
    $security_question_answer = sanitise($_POST['security_question_answer']);
    $result = AuthDB::register($username, $password, $password_confirm, $email, $security_question_id, $security_question_answer);
    
    if ($result['state'] == 'success') {
      header("Location: ?p=login");
      exit;
    }
    break;

  default:
    break;
}
