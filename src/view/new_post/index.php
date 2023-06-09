<?php
$site_name .= " - new post";
$page_description = "Create a post on XSN";

include_once("controller/new_post.php");
?>

<div class="gradient-a flex-center" style="height:100%;width:100%">
  <div id="post-form" class="card shadow" style="width:100%;max-width:400px">
    <h1 class="text-center">new post</h1><br><br>

    <input type="text" id="title" name="title" placeholder="title" style="width:calc(100% - 20px)"><br><br>
    <textarea id="description" name="description" placeholder="description" style="width:calc(100% - 20px)"></textarea><br><br>
    <input type="text" id="location" name="location" placeholder="location" style="width:calc(100% - 20px)"><br><br>

    <iframe id="image_upload_target" name="image_upload_target" style="display:none"></iframe>

    <div id="images">
      <image-add onclick="add_image_field()">
        <span class="material-icons">add</span>
      </image-add>
    </div>

    <div role="alert" id="error" style="display:none;padding:20px;background:#ff000033;margin-bottom:20px"></div>

    <span class="btn background-a text-white text-center pointer" onclick="share()" style="width:calc(100% - 20px);display:block">share</span>
  </div>

  <div id="loader" class="spinner" style="display:none"></div>
</div>

<?php include_once("view/partial_navbar.php"); ?>