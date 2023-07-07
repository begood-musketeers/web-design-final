<?php
$site_name .= " - register";
$page_description = "Sign up for XSN";

include_once("controller/auth.php");
?>

<div class="flex-center" style="height:100%;width:100%">
  <div class="card shadow" style="width:100%;max-width:800px">
    <h1>Create an account</h1><br>
    <form action="controller" method="post">
      <label for="username">Username</label><br>
      <input type="text" id="username" name="username"><br><br>
      <label for="password">Password</label><br>
      <input type="password" id="password" name="password"><br><br>
      <label for="password_confirm">Confirm Password</label><br>
      <input type="password" id="password_confirm" name="password_confirm"><br><br>
      <label for="email">Email</label><br>
      <input type="email" id="email" name="email"><br><br>

      <hr><br>

      <label for="security_question_id">Security Question</label><br>
      <select id="security_question_id" name="security_question_id">
        <option value="1">What is your mother's maiden name?</option>
        <option value="2">What is your favorite color?</option>
        <option value="3">What is your favorite food?</option>
        <option value="4">What is your favorite movie?</option>
        <option value="5">What is your favorite book?</option>
      </select><br><br>
      <label for="security_question_answer">Security Answer</label><br>
      <input type="text" id="security_question_answer" name="security_question_answer"><br><br>
      <div role="alert" id="error" style="display:none;padding:20px;background:#ff000033"></div><br>
      <span onclick="register()" class="btn btn-secondary mt-3">Complete sign up</span>
    </form>
  </div>
</div>