<?php
$site_name .= " - profile";
$page_description = "View your profile";

include_once("controller/user.php");
?>

<?php include_once("view/partial_navbar.php"); ?>

<div>
    Username: <?php echo $user["username"]; ?>
    <!-- TODO: implement profile page -->
</div>
