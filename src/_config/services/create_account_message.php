<?php
// Shows an alert message if the user has not created an account yet

if (!isset($_SESSION["user_id"])) {
    echo "
      <div role='alert' style='padding:20px;background:#ffff0033'>
        It looks like you haven't created an account yet. Please <a href='?p=register'>create</a> an account to participate in XSN.
      </div>
    ";
}