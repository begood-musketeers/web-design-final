<?php
$site_name .= " - notifications";
$page_description = "XSN notifications";

include_once("controller/notifications.php");
?>

<body class="gradient-a">
<h1 class="text-center" style="padding:20px 0px">Notifications</h1>
<?php foreach ($notifications as $notification) { ?>
  <?php
  if ($notification["type"] == "like") {
    $notification["type"] = "liked your post";
  } else if ($notification["type"] == "comment") {
    $notification["type"] = "commented on your post";
  } else if ($notification["type"] == "follow") {
    $notification["type"] = "followed you";
  } else if ($notification["type"] == "event") {
    $notification["type"] = "created an event";
  }

  if ($notification["type"] == "liked your post") {
    $icon = "favorite";
    $color = "red";
  } else if ($notification["type"] == "commented on your post") {
    $icon = "comment";
    $color = "blue";
  } else if ($notification["type"] == "followed you") {
    $icon = "person_add";
    $color = "green";
  } else if ($notification["type"] == "created an event") {
    $icon = "event";
    $color = "purple";
  }
  ?>

  <div class="card notification shadow">
    <span class="material-icons notification-icon" style="color:<?= $color; ?>"><?= $icon; ?></span>
    <?= $notification["username"]; ?> <?= $notification["type"]; ?> <?= timeago($notification["created_datetime"]); ?> ago

    <form method="post" action="">
      <input type="hidden" name="request" value="read_notification">
      <input type="hidden" name="notification_id" value="<?= $notification["id"]; ?>">
      <button type="submit" class="btn" style="margin-top:20px">Mark as read</button>
    </form>
  </div>
<?php } ?>

<?php if (count($notifications) == 0) { ?>
  <div class="card notification shadow">
    No notifications yet <span class="material-icons notification-icon" style="color:grey">notifications</span>
  </div>
<?php } ?>

<br><br><br><br><br><br>
</body>

<?php include_once("view/partial_navbar.php"); ?>