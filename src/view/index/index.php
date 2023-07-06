<?php
$site_name .= " - home";
$page_description = "XSN, where students unite";
?>

<?php
include_once("controller/post.php");

foreach ($posts as $post) {
  echo $post['title'];
}
?>

<?php include_once("view/partial_navbar.php"); ?>