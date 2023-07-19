<?php
function if_active($potential_pages) {
  global $page;
  
  foreach ($potential_pages as $potential_page) {
    if ($page == $potential_page) {
      echo "active";
      return;
    }
  }
}

if (isset($_SESSION['loggedin'])) {

// get user notification count
include_once("model/notification_db.php");
$notification_count = NotificationDB::get_notification_count($_SESSION['user_id']);
?>

<nav class="main-nav">
    <a class="nav-icon <?php if_active(["timeline"]); ?>" href="?">
        <i class="material-icons">home</i>
    </a>
    <a class="nav-icon" href="?p=bucket_list">
        <i class="material-icons">checklist</i>
    </a>
    <a class="nav-icon <?php if_active(["create", "new_post", "new_event"]); ?>" href="?p=create">
        <i class="material-icons">add</i>
    </a>
    <a class="nav-icon <?php if_active(["notifications"]); ?>" href="?p=notifications">
        <i class="material-icons">notifications</i> <?php if ($notification_count > 0) { ?><span class="badge"><?= $notification_count; ?></span><?php } ?>
    </a>
    <a class="nav-icon <?php if_active(["profile"]); ?>" href="?p=profile">
        <i class="material-icons">person</i>
    </a>
    <a class="nav-icon" href="?p=logout">
        <i class="material-icons">logout</i>
    </a>
</nav>

<?php
}
?>
