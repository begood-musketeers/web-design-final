<?php
$site_name .= " - login";
$page_description = "Login to XSN";

include_once("controller/auth.php");
?>

<div class="gradient-a flex-center" style="height:100%;width:100%">
  <div class="card shadow" style="width:100%;max-width:800px">
    <div style="width:50%;height:100%;float:left">
      <h1>Sign in</h1><br>
      <small>To an existing account</small><br><br>

      <input type="text" id="username" name="username" placeholder="username"><br><br>

      <input type="password" id="password" name="password" placeholder="password"><br><br>

      <div role="alert" id="error" style="display:none;padding:20px;background:#ff000033;margin-bottom:10px;margin-right:20px;"></div><br>
      <span class="btn background-a text-white pointer" onclick="login()">Sign In</span><br><br>
    </div>
    <div style="width:50%;height:100%;float:right">
      <h1>Create</h1><br>
      <small>A new free account</small><br><br>
      <p>It's free to join and easy to use. Continue on to create your XSN account.</p><br><br>
      <a class="btn background-b text-white pointer" href="?p=register">Create Account</a>
    </div>
  </div>
</div>