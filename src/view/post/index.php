<?php
include_once("controller/post.php");

$comments = $post[1];
$likes = $post[2];
$images = $post[4];
$liked = $post[3];
$post = $post[0];

$site_name .= " - " . $post['title'];
$page_description = $post['description'];


// IMAGES ========================================
$images_html = '';
$image_int = 0;
foreach ($images as $image) {
  $checked = ($image_int == 0) ? 'checked="checked"' : '';
  $show_bullets = (count($images) == 1) ? 'style="display:none"' : '';

  $images_html .= '
    <input type="radio" name="p-' . $post['id'] . 'post" id="p-' . $post['id'] . '-item-' . $image_int . '" class="slideshow--bullet" ' . $checked . ' ' . $show_bullets . ' />
    <div class="slideshow--item big">
      <img src="uploads/' . $image['file_name'] . '" style="max-width:100%;max-height:100%">
    </div>
  ';
  $image_int++;
}

// likes and comments counts
if (isset($_SESSION['loggedin'])) {
  if ($liked == 1) {
    $like_tag = 'onclick="unlike(' . $post['id'] . ',\'post\')" class="pointer liked"';
  } else {
    $like_tag = 'onclick="like(' . $post['id'] . ',\'post\')" class="pointer"';
  }
} else {
  $like_tag = 'onclick="login()" class="pointer"';
}
?>

<br><br>

<div class="info">
  <!-- user info -->
  <a class="card info-profile" href="?p=profile&u=<?= $post['username']; ?>">
    <img src="uploads/<?= $post['user_picture']; ?>" height="50" width="50" class="info-pfp">
    <?= $post['username']; ?> • <?= timeago($post['created_datetime']); ?>
  </a>

  <!-- images -->
  <div class="flex-center">
    <div class="slideshow big" data-transition="fade">
      <?= $images_html; ?>
    </div>
  </div>

  <!-- like and comment counts -->
  <item-stats style="margin-left:8px">
    <item-stat <?= $like_tag ?>>
      <span class="material-icons">favorite</span>
      <span id="l-<?= $post['id']; ?>post"><?= count($likes); ?></span>
    </item-stat>
    <item-stat>
      <span class="material-icons">comment</span> <?= count($comments); ?>
    </item-stat>

    <?php if (isset($_SESSION['loggedin']) && $_SESSION['user_id'] == $post['user_id']) { ?>
      <item-stat style="margin-left:auto">
        <form action="" method="post">
          <input type="hidden" name="request" value="remove_post">
          <input type="hidden" name="id" value="<?= $post['id']; ?>">
          <button type="submit" class="pointer" style="background:none">
            <span class="material-icons">delete</span>
          </button>
        </form>
      </item-stat>
    <?php } ?>
  </item-stats>

  <!-- general post info -->
  <div class="card" style="padding-top:0px">
    <div>
      <?= $post['title']; ?>
    </div>
    <div>
      <pre>
        <?= $post['description']; ?>
      </pre>
    </div>
  </div>

  <!-- comment input and submit -->
  <?php if (isset($_SESSION['loggedin'])) { ?>
    <div class="card" style="padding-top:0px">
      <div class="info-description">
        <form class="flex-center" action="" method="post">
          <input type="hidden" name="request" value="add_comment">
          <input type="hidden" name="id" value="<?= $post['id']; ?>">
          <input type="text" name="comment" placeholder="Comment" class="input" style="width:100%;margin-right:10px">
          <button type="submit" class="btn background-a text-white pointer" style="height:41px">
            <span class="material-icons" style="font-size:21px">send</span>
          </button>
        </form>
      </div>
    </div>
  <?php } ?>

  <!-- comments -->
  <?php foreach ($comments as $comment) { ?>
    <div class="card" style="padding-top:0px">
      <div>
        <a class="comment" href="?p=profile&u=<?= $comment['username']; ?>">
          <span class="comment-user">
            <img src="/uploads/<?= $comment['user_picture']; ?>" height="35" width="35" class="info-pfp">
            <?= $comment['username']; ?> • <?= timeago($comment['created_datetime']); ?>
          </span>
        </a>
      </div>
        <span class="comment-content">
          <?= $comment['content']; ?>
          <?php if (isset($_SESSION['loggedin']) && $_SESSION['user_id'] == $comment['user_id']) { ?>
            <form action="" method="post">
              <input type="hidden" name="request" value="remove_comment">
              <input type="hidden" name="id" value="<?= $post['id']; ?>">
              <input type="hidden" name="comment_id" value="<?= $comment['id']; ?>">
              <span class="material-icons pointer" onclick="this.parentElement.submit()">delete</span>
            </form>
          <?php } ?>
        </span>
    </div>
  <?php } ?>
</div>

<br><br><br><br><br><br>

<?php include_once("view/partial_navbar.php"); ?>
