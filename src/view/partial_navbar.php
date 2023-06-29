<?php
function if_active($potential_page) {
  global $page;
  if ($page == $potential_page) {
    echo "active";
  }
}
?>

<nav class="main-nav">
    <a class="nav-icon <?php if_active("index"); ?>" href="?">
        <i class="material-icons">home</i>
    </a>
    <a class="nav-icon <?php if_active("search"); ?>" href="?p=search">
        <i class="material-icons">search</i>
    </a>
    <a class="nav-icon <?php if_active("new_post"); ?>" href="?p=new_post">
        <i class="material-icons">add</i>
    </a>
    <a class="nav-icon <?php if_active("notifications"); ?>" href="?p=notifications">
        <i class="material-icons">notifications</i>
    </a>
    <a class="nav-icon <?php if_active("profile"); ?>" href="?p=profile">
        <i class="material-icons">person</i>
    </a>
</nav>