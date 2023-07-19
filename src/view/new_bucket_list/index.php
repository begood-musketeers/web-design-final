<?php
include_once("controller/new_bucket_list.php");
?>
<body>
<?php
if (isset($bucket_list_id)) {
    $bucket_list = BucketListDB::get_bucket_list($bucket_list_id);
    $name = BucketListDB::get_bucket_list_name($bucket_list_id);
?>
<div class="gradient-a flex-center" style="height:100%;width:100%">
    <div id="new_bucket_list-form" class="card shadow" style="width:100%;max-width:400px">
        <?php
        echo "<h1 class='text-align'>$name" . " " . 'Bucketlist' . "</h1><br>";
        foreach ($bucket_list as $key => $item) {
            ?>
            <form action="" method="POST">
                <br><legend>Edit item</legend>
                <input type="hidden" value="<?php echo $bucket_list_id; ?>" name="bucket_list_id" />
                <input type="hidden" name="item_id" value="<?php echo $item["id"] ?>" />
                <input type="text" name="content" value="<?php echo $item["content"]; ?>" />
                <input class="checkbox" type="checkbox" name="completed" <?php echo $item["completed"] ? "checked" : "" ?> />
                <input type="hidden" name="request" value="update_item" />
                <button class="btn background-a text-white text-center pointer" type="submit">complete</button>
            </form>
            <form action="" method="POST">
                <input type="hidden" name="request" value="delete_item" />
                <input type="hidden" name="item_id" value="<?php echo $item["id"] ?>" />
                <button class="btn background-c text-white text-center pointer" type="submit">delete</button> <br>
            </form>
            <?php
        }
        ?>
        <form action="" method="POST">
            <br><legend>Add new item</legend>
            <input type="hidden" value="<?php echo $bucket_list_id; ?>" name="bucket_list_id" />
            <input type="text" name="content" />
            <input type="checkbox" name="completed" />
            <input type="hidden" name="request" value="add_item" />
            <button class="btn background-a text-white text-center pointer" type="submit">add</button>
        </form>
    </div>
</div>
<?php
} else {
?>
    <form action="" method="POST" class="gradient-a flex-center" style="height:100%;width:100%">
        <div id="new_bucket_list-form" class="card shadow" style="width:100%;max-width:400px">
            <img src="../../uploads/bucket.jpg" alt="Bucket" style="float:right;" width="150" height="150" />
            <h1 class="text-align">New bucket list</h1><br>
            <input class="input-field" type="text" name="title" placeholder="bucket list title" />
            <input type="hidden" name="request" value="new_bucket_list" />
            <button class="btn background-a text-white text-center pointer" style="margin-top:10px;" type="submit">submit</button>
        </div>
    </form>
<?php
}
?>
</body>
<?php include_once("view/partial_navbar.php"); ?>
