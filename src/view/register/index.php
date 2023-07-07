<?php
$site_name .= " - register";
$page_description = "Sign up for XSN";

include_once("controller/auth.php");
?>

<div class="gradient-a flex-center" style="height:100%;width:100%">
  <div class="card shadow" style="width:100%;max-width:800px">
    <h1>Create an account</h1><br>
    <form action="controller" method="post">
      <input type="text" id="username" name="username" placeholder="username"><br><br>
      <input type="password" id="password" name="password" placeholder="password" style="margin-right:10px">
      <input type="password" id="password_confirm" name="password_confirm" placeholder="password confirm"><br><br>
      <input type="email" id="email" name="email" placeholder="@email"><br><br>

      <hr><br>

      <select id="security_question_id" name="security_question_id">
        <option disabled selected value> -- Security Question -- </option>
        <option value="1">What is your mother's maiden name?</option>
        <option value="2">What is your favorite color?</option>
        <option value="3">What is your favorite food?</option>
        <option value="4">What is your favorite movie?</option>
        <option value="5">What is your favorite book?</option>
      </select><br><br>
      <input type="text" id="security_question_answer" name="security_question_answer" placeholder="security answer"><br><br>
      <div role="alert" id="error" style="display:none;padding:20px;background:#ff000033;margin-bottom:15px"></div><br>
      <span class="btn background-a text-white pointer" onclick="register()">Complete sign up</span><br><br>
    </form>
  </div>
</div>