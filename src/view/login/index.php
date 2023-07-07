<?php
$site_name .= " - login";
$page_description = "Login to XSN";

include_once("controller/auth.php");
?>

<div class="flex-center" style="height:100%;width:100%">
  <div class="card shadow" style="width:100%;max-width:800px">
    <div style="width:50%;height:100%;float:left">
      <h1>Sign in</h1>
      <small>To an existing account</small><br><br>

      <label for="username">Username</label><br>
      <input type="text" id="username" name="username"><br><br>

      <label for="password">Password</label><br>
      <input type="password" id="password" name="password"><br><br>

      <div role="alert" id="error" style="display:none;padding:20px;background:#ff000033"></div><br>
      <span onclick="login()">Sign In</span>
    </div>
    <div style="width:50%;height:100%;float:right">
      <h1>Create</h1>
      <small>A new free account</small><br><br>
      <p>It's free to join and easy to use. Continue on to create your XSN account.</p><br>
      <a href="?p=register">Create Account</a>
    </div>
  </div>
</div>