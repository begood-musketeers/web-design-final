<?php
$site_name .= " - register";
$page_description = "Sign up for XSN";

include_once("controller/auth.php");
?>

<div class="w-100" style="display:flex;justify-content:center;align-items:center;height:calc(100% - 68px)">
  <div class="card" style="width:100%;max-width:800px">
    <div class="card-body">
      <div class="row">
        <div class="col-12">
          <h5 class="card-title mb-0">Create an account</h5>
          <form class="mt-4" action="controller" method="post">
            <div class="form-group">
              <div class="textfield-box">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username">
              </div>
            </div>
            <div class="form-group">
              <div class="textfield-box">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password">
              </div>
            </div>
            <div class="form-group">
              <div class="textfield-box">
                <label for="password_confirm">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirm" name="password_confirm">
              </div>
            </div>
            <div class="form-group mb-4">
              <div class="textfield-box">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email">
              </div>
            </div>
            <hr>
            <div class="form-group mt-4">
              <div class="textfield-box">
                <label for="security_question_id">Security Question</label>
                <select class="form-control" id="security_question_id" name="security_question_id">
                  <option value="1">What is your mother's maiden name?</option>
                  <option value="2">What is your favorite color?</option>
                  <option value="3">What is your favorite food?</option>
                  <option value="4">What is your favorite movie?</option>
                  <option value="5">What is your favorite book?</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <div class="textfield-box">
                <label for="security_question_answer">Security Answer</label>
                <input type="text" class="form-control" id="security_question_answer" name="security_question_answer">
              </div>
            </div>

            <div class="alert alert-danger mb-0" role="alert" id="error" style="display:none"></div>
            <span onclick="register()" class="btn btn-secondary mt-3">Complete sign up</span>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>