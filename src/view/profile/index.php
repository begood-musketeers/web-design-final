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

<body class="gradient-a">
    <div style="padding-top:30px">
        <div class="card shadow" style="width:100%;max-width:620px;margin:0 auto">
            <img src='/uploads/<?= $user["picture"] ?>' alt='' class='Avatar' height="100" width="100" />
            <?php echo $user["username"];?>

            <?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true && $_SESSION["user_id"] == $user["id"]) { ?>
                <br><br>

                <details>
                    <summary><span class="material-icons">settings</span> Settings</summary>
                    <br>
                    <p>Change your profile picture:</p>
                    <form method='POST' action='' enctype='multipart/form-data'>
                        <input type='hidden' name='request' value='picture' />
                        <input type='file' name='profile_picture' />
                        <button class="btn" type='submit'>submit</button>
                    </form>
                </details>

            <?php } ?>

        </div>
    </div>

    <div style="padding-top:30px">
        <div class="card shadow" style="width:100%;max-width:620px;margin:0 auto">
            <h2>Latest posts</h2>
            <?php foreach ($user_objects['posts'] as $post) { ?>
                <p>- <a class="url" href="?p=post&id=<?= $post['id']?>"><?= $post['title']?></a></p>
            <?php } ?>
            <?php if (count($user_objects['posts']) == 0) { ?>
                <p>No posts yet</p>
            <?php } ?>
        </div>
    </div>

    <div style="padding-top:30px">
        <div class="card shadow" style="width:100%;max-width:620px;margin:0 auto">
            <h2>Latest events</h2>
            <?php foreach ($user_objects['events'] as $event) { ?>
                <p>- <a class="url" href="?p=event&id=<?= $event['id']?>"><?= $event['title']?></a></p>
            <?php } ?>
            <?php if (count($user_objects['events']) == 0) { ?>
                <p>No events yet</p>
            <?php } ?>
        </div>
    </div>

</body>

<?php include_once("view/partial_navbar.php"); ?>