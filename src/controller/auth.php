<?php
include("model/auth_db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['request'])) {
  $request = sanitise($_POST['request']);
} else {
  $request = 'get_posts';
}

switch ($request) {
  case 'login':
    $username = $_POST['username'];
    $password = $_POST['password'];
    echo AuthDB::login($username, $password);
    exit;
    break;

  case 'register':
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    $email = $_POST['email'];
    $security_question_id = $_POST['security_question_id'];
    $security_question_answer = $_POST['security_question_answer'];
    echo AuthDB::register($username, $password, $password_confirm, $email, $security_question_id, $security_question_answer);
    exit;
    break;

  default:
    break;
}
