<?php
include_once("controller/event.php");

$comments = $event[1];
$likes = $event[2];
$images = $event[4];
$liked = $event[3];
$taking_part = $event[5];
$participants = $event[6];
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
      <img src="uploads/' . $image['file_name'] . '" style="max-width:100%;max-height:100%">
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

// taking part
if (isset($_SESSION['loggedin'])) {
  if ($taking_part == 1) {
    $join_colour = 'background-b';
  } else {
    $join_colour = 'background-a';
  }
} else {
  $join_colour = 'background-b';
}
?>

<br><br>

<div class="info">
  <!-- user info -->
  <a class="card info-profile" href="?p=profile&u=<?= $event['username']; ?>">
    <img src="uploads/<?= $event['user_picture']; ?>" height="50" width="50" class="info-pfp">
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

  <hr>

  <div class="card">
    <span class="material-icons" style="font-size:18px;transform:translateY(3px)">event</span>
    <?php if (date("F j, Y", strtotime($event['start_datetime'])) == date("F j, Y", strtotime($event['end_datetime']))) { ?>
      Takes place on <under><?= date("F j, Y", strtotime($event['start_datetime'])); ?></under>
    <?php } else { ?>
      Takes place from <under><?= date("F j, Y", strtotime($event['start_datetime'])); ?></under> to <under><?= date("F j, Y", strtotime($event['end_datetime'])); ?></under>
    <?php } ?>
    <br><br>
    <span class="material-icons" style="font-size:18px;transform:translateY(3px)">location_on</span>
    Location: <a class="url" href="<?= $event['location']; ?>" target="_blank"><?= substr($event['location'], 0, 54); ?>...</a>

    <?php if (isset($_SESSION['loggedin'])) { ?>
      <br><br>
      <form action="" method="post">
        <input type="hidden" name="request" value="join_event">
        <input type="hidden" name="id" value="<?= $event['id']; ?>">
        <button type="submit" class="btn <?= $join_colour ?> text-white text-center pointer" style="display:block;font-size:medium">
          <?php if ($taking_part == 1) { ?>
            <span class="material-icons" style="font-size:18px;transform:translateY(3px)">check</span>
            Taking part
          <?php } else { ?>
            <span class="material-icons" style="font-size:18px;transform:translateY(3px)">add</span>
            Join event
          <?php } ?>
        </button>
      </form>
    <?php } ?>
  </div>

  <hr>

  <!-- show participants as list with icon:username -->
  <?php if (count($participants) > 0) { ?>
    <div class="card">
      <div class="info-description">
        <span class="material-icons" style="font-size:18px;transform:translateY(3px)">people</span>
        Participants:<br><br>
        <?php foreach ($participants as $participant) { ?>
          <a class="info-profile" href="?p=profile&u=<?= $participant['username']; ?>" style="margin-bottom:5px">
            <img src="uploads/<?= $participant['user_picture']; ?>" height="30" width="30" class="info-pfp">
            <?= $participant['username']; ?>
          </a>
        <?php } ?>
      </div>
    </div>
  <?php } ?>

  <?php if (count($participants) == 0) { ?>
    <div class="card">
      <span class="material-icons" style="font-size:18px;transform:translateY(3px)">sentiment_dissatisfied</span>
      No participants yet
    </div>
  <?php } ?>

  <hr><br><br>

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
            <img src="uploads/<?= $comment['user_picture']; ?>" height="35" width="35" class="info-pfp">
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