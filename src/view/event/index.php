<?php
include_once("controller/event.php");

$comments = $event[1];
$likes = $event[2];
$images = $event[4];
$liked = $event[3];
$event = $event[0];

$site_name .= " - " . $event['title'];
$page_description = $event['description'];


// IMAGES ========================================
$images_html = '';
$image_int = 0;
foreach ($images as $image) {
  $checked = ($image_int == 0) ? 'checked="checked"' : '';
  $show_bullets = (count($images) == 1) ? 'style="display:none"' : '';

  $images_html .= '
    <input type="radio" name="p-' . $event['id'] . 'event" id="p-' . $event['id'] . '-item-' . $image_int . '" class="slideshow--bullet" ' . $checked . ' ' . $show_bullets . ' />
    <div class="slideshow--item big">
      <img src="assets/uploads/' . $image['file_name'] . '" style="max-width:100%;max-height:100%">
    </div>
  ';
  $image_int++;
}

// likes and comments counts
if (isset($_SESSION['loggedin'])) {
  if ($liked == 1) {
    $like_tag = 'onclick="unlike(' . $event['id'] . ',\'event\')" class="pointer liked"';
  } else {
    $like_tag = 'onclick="like(' . $event['id'] . ',\'event\')" class="pointer"';
  }
} else {
  $like_tag = 'onclick="login()" class="pointer"';
}
?>

<br><br>

<div class="info">
  <!-- user info -->
  <a class="card info-profile" href="?p=profile&u=<?= $event['username']; ?>">
    <img src="assets/pfp/<?= $event['username']; ?>" height="50" width="50" class="info-pfp">
    <?= $event['username']; ?> • <?= timeago($event['created_datetime']); ?>
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
      <span id="l-<?= $event['id']; ?>event"><?= count($likes); ?></span>
    </item-stat>
    <item-stat>
      <span class="material-icons">comment</span> <?= count($comments); ?>
    </item-stat>

    <?php if (isset($_SESSION['loggedin']) && $_SESSION['user_id'] == $event['user_id']) { ?>
      <item-stat style="margin-left:auto">
        <form action="" method="post">
          <input type="hidden" name="request" value="remove_event">
          <input type="hidden" name="id" value="<?= $event['id']; ?>">
          <button type="submit" class="pointer" style="background:none">
            <span class="material-icons">delete</span>
          </button>
        </form>
      </item-stat>
    <?php } ?>
  </item-stats>

  <hr>
  <div class="card">
      aoigen
  </div>
  <hr>

  <!-- general event info -->
  <div class="card">
    <div>
      <?= $event['title']; ?>
    </div>
    <div>
      <pre>
        <?= $event['description']; ?>
      </pre>
    </div>
  </div>

  <!-- comment input and submit -->
  <?php if (isset($_SESSION['loggedin'])) { ?>
    <div class="card" style="padding-top:0px">
      <div class="info-description">
        <form class="flex-center" action="" method="post">
          <input type="hidden" name="request" value="add_comment">
          <input type="hidden" name="id" value="<?= $event['id']; ?>">
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
            <img src="assets/pfp/<?= $comment['username']; ?>" height="35" width="35" class="info-pfp">
            <?= $comment['username']; ?> • <?= timeago($comment['created_datetime']); ?>
          </span>
        </a>
      </div>
        <span class="comment-content">
          <?= $comment['content']; ?>
          <?php if (isset($_SESSION['loggedin']) && $_SESSION['user_id'] == $comment['user_id']) { ?>
            <form action="" method="post">
              <input type="hidden" name="request" value="remove_comment">
              <input type="hidden" name="id" value="<?= $event['id']; ?>">
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