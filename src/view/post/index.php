<?php
include_once("controller/post.php");

$comments = $post[1];
$likes = $post[2];
$images = $post[4];
$liked = $post[3];
$post = $post[0];

$site_name .= " - ";
$page_description = "";


// IMAGES ========================================
$images_html = '';
$image_int = 0;
foreach ($images as $image) {
  $checked = ($image_int == 0) ? 'checked="checked"' : '';
  $show_bullets = (count($images) == 1) ? 'style="display:none"' : '';

  $images_html .= '
    <input type="radio" name="p-' . $post['id'] . 'post" id="p-' . $post['id'] . '-item-' . $image_int . '" class="slideshow--bullet" ' . $checked . ' ' . $show_bullets . ' />
    <div class="slideshow--item big">
      <img src="assets/uploads/' . $image['file_name'] . '" style="max-width:100%;max-height:100%">
    </div>
  ';
  $image_int++;
}

// likes and comments counts
if ($liked == 1) {
  $like_tag = 'onclick="unlike(' . $post['id'] . ',\'post\')" class="pointer liked"';
} else {
  $like_tag = 'onclick="like(' . $post['id'] . ',\'post\')" class="pointer"';
}
?>

<a class="card info-profile" href="?p=profile&u=<?= $post['username']; ?>">
  <img src="assets/pfp/<?= $post['username']; ?>" height="50" width="50" class="info-pfp">
  <?= $post['username']; ?> • <?= timeago($post['created_datetime']); ?>
</a>
<div class="flex-center">
  <div class="slideshow big" data-transition="fade">
    <?= $images_html; ?>
  </div>
</div>

<div class="flex-center">

  <div class="card info">
    <item-stats>
      <item-stat <?= $like_tag ?>>
        <span class="material-icons">favorite</span>
        <span id="l-<?= $post['id']; ?>post"><?= count($likes); ?></span>
      </item-stat>
      <item-stat>
        <span class="material-icons">comment</span> <?= count($comments); ?>
      </item-stat>
    </item-stats>

  </div>
</div>

<?php include_once("view/partial_navbar.php"); ?>