<?php
    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true) {
        header("Location: /?p=login");
        die();
    }
?>
<?php
$site_name .= " - profile";
$page_description = "View your profile";

include_once("controller/user.php");
?>

<?php include_once("view/partial_navbar.php"); ?>

<div>
    Username: <?php echo $user["username"]; ?>
<img src="/uploads/<?php echo $user["picture"]; ?>" />
    <form method="POST" action="" enctype="multipart/form-data">
        <input type="hidden" name="request" value="picture"/>
        <input type="file" name="profile_picture" />
        <button type="submit">submit</button>
    </form>
</div>
