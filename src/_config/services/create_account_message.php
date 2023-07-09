<?php
// Shows an alert message if the user has not created an account yet

if (!isset($_SESSION["user_id"]) && (!isset($_GET['p']) || ($_GET['p'] != "register" && $_GET['p'] != "login"))) {
  echo "
    <div role='alert' style='padding:20px;background:#ffff0033'>
      It looks like you haven't created an account yet. Please <a href='?p=register' style='color:#0000ff;text-decoration:underline'>create</a> an account or <a href='?p=login' style='color:#0000ff;text-decoration:underline'>login</a> to participate in XSN.
    </div>
  ";
}