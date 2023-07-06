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
?>

<nav class="main-nav">
    <a class="nav-icon <?php if_active(["timeline"]); ?>" href="?">
        <i class="material-icons">home</i>
    </a>
    <a class="nav-icon <?php if_active(["search"]); ?>" href="?p=search">
        <i class="material-icons">search</i>
    </a>
    <a class="nav-icon <?php if_active(["create"]); ?>" href="?p=create">
        <i class="material-icons">add</i>
    </a>
    <a class="nav-icon <?php if_active(["notifications"]); ?>" href="?p=notifications">
        <i class="material-icons">notifications</i>
    </a>
    <a class="nav-icon <?php if_active(["profile"]); ?>" href="?p=profile">
        <i class="material-icons">person</i>
    </a>
</nav>