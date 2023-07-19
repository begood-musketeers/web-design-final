<?php
$site_name .= " - new post";
$page_description = "Create a post on XSN";

include_once("controller/new_post.php");
?>

<form id="new_post_form" action="" method="POST" enctype="multipart/form-data" class="gradient-a flex-center" style="height:100%;width:100%">
  <div id="post-form" class="card shadow" style="width:100%;max-width:400px">
    <h1 class="text-center">new post</h1><br><br>

    <input type="text" id="title" name="title" placeholder="title" style="width:calc(100% - 20px)" value="<?= (isset($title) ? $title : "") ?>" />
    <br><br>
    <textarea id="description" name="description" placeholder="description" style="width:calc(100% - 20px)"><?= (isset($description) ? $description : "") ?></textarea>
    <br><br>
    <input type="text" id="location" name="location" placeholder="location" style="width:calc(100% - 20px)" value="<?= (isset($location) ? $location : "") ?>" />
    <br><br>
    <input type="hidden" name="request" value="new_post" />

    <div id="images">
      <image-add onclick="add_image_field()">
        <span class="material-icons">add</span>
      </image-add>
    </div>

    <?php if (isset($error)) { ?>
      <div role="alert" id="error" style="padding:20px;background:#ff000033;margin-bottom:20px">
        <?= $error ?>
      </div>
    <?php } ?>

    <button class="btn background-a text-white text-center pointer" type="submit" style="width:100%;display:block;font-size:17px">share</button>
  </div>
</form>

<?php include("view/partial_navbar.php"); ?>
