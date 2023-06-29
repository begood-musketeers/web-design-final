<?php
function if_active($page, $sub_page = null) {
  global $page_name, $sub_page_name;
  if ($page == $page_name && $sub_page == $sub_page_name) {
    echo "active";
  }
}
?>

<nav class="main-nav">
    <a class="nav-icon <?php if_active(""); ?>" href="?">
        <i class="material-icons">home</i>
    </a>
    <a class="nav-icon <?php if_active("search"); ?>" href="?p=search">
        <i class="material-icons">search</i>
    </a>
    <a class="nav-icon <?php if_active("add"); ?>" href="?p=new_post">
        <i class="material-icons">add</i>
    </a>
    <a class="nav-icon <?php if_active("notifications"); ?>" href="?p=notifications">
        <i class="material-icons">notifications</i>
    </a>
    <a class="nav-icon <?php if_active("profile"); ?>" href="?p=profile">
        <i class="material-icons">person</i>
    </a>
</nav>