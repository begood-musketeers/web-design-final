<?php
$site_name .= " - login";
$page_description = "Login to XSN";

include_once("controller/auth.php");
?>

<div class="gradient-a flex-center" style="height:100%;width:100%">
  <div class="card shadow" style="width:100%;max-width:800px;margin:20px">
    <div class="part-left">
      <h1>Sign in</h1><br>
      <small>To an existing account</small><br><br>
      <form method="post" action="">
        <input type="hidden" name="request" value="login">
        <input type="text" id="username" name="username" placeholder="username" value="<?= isset($_POST['username']) ? $_POST['username'] : '' ?>">
        <br><br>
        <input type="password" id="password" name="password" placeholder="password" value="<?= isset($_POST['password']) ? $_POST['password'] : '' ?>">
        <br><br>
        <?php if (isset($result)) { ?>
          <div role="alert" id="error" style="padding:20px;background:#ff000033;margin-bottom:15px;margin-right:20px;">
            <?php if (isset($result)) { echo $result['message']; } ?>
          </div>
        <?php } ?>
        <button class="btn background-a text-white pointer">Sign In</button>
      </form>
    </div>
    <div class="part-right">
      <h1>Create</h1><br>
      <small>A new free account</small><br><br>
      <p>It's free to join and easy to use. Continue on to create your XSN account.</p><br><br>
      <a class="btn background-b text-white pointer" href="?p=register">Create Account</a><br><br>
    </div>
  </div>
</div>