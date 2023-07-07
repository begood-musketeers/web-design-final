<?php
$site_name .= " - login";
$page_description = "Login to XSN";

include_once("controller/auth.php");
?>

<div class="w-100" style="display:flex;justify-content:center;align-items:center;height:calc(100% - 68px)">
  <div class="card" style="width:100%;max-width:800px">
    <div class="card-body">
      <div class="row">
        <div class="col-6" style="border-right:1px solid #e0e0e0">
          <h5 class="card-title mb-0">Sign in</h5>
          <small>To an existing account</small>
          <form class="mt-4" action="login" method="post">
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
            <div class="alert alert-danger mb-0" role="alert" id="error" style="display:none"></div>
            <span class="btn btn-secondary mt-3" onclick="login()">Sign In</span>
          </form>
        </div>
        <div class="col-6">
          <h5 class="card-title mb-0">Create</h5>
          <small>A new free account</small>
          <p class="mt-3">It's free to join and easy to use. Continue on to create your XSN account.</p>
          <a href="?p=register" style="position:absolute;bottom:0" class="btn btn-secondary mt-3">Create Account</a>
        </div>
      </div>
    </div>
</div>