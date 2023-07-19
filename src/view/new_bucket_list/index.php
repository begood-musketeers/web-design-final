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
        echo "<h1 class='text-align'>
        <a href='?p=bucket_list' style='color:#00000033'>
            <span class='material-icons'>arrow_back</span>
        </a>
        $name" . " " . 'Bucketlist' . "</h1><br>";
        foreach ($bucket_list as $key => $item) { ?>
                <div style="display:flex;margin-bottom:10px">
                    <form action="" method="POST">
                        <input type="text" name="content" value="<?php echo $item["content"]; ?>" />

                        <input type="hidden" value="<?php echo $bucket_list_id; ?>" name="bucket_list_id" />
                        <input type="hidden" name="item_id" value="<?php echo $item["id"] ?>" />
                        <input type="hidden" name="request" value="update_item" />
                        <button class="btn background-a text-white text-center pointer" type="submit">update</button>
                    </form>

                    <form action="" method="POST" style="margin-left:10px">
                        <input type="hidden" value="<?php echo $bucket_list_id; ?>" name="bucket_list_id" />
                        <input type="hidden" name="item_id" value="<?php echo $item["id"] ?>" />
                        <input type="hidden" name="request" value="delete_item" />
                        <button class="btn background-c text-white text-center pointer" type="submit">delete</button>
                    </form>
                </div>
        <?php } ?>
        <form action="" method="POST">
            <br><legend>Add new item</legend>
            <input type="hidden" value="<?php echo $bucket_list_id; ?>" name="bucket_list_id" />
            <input type="text" name="content" />
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
            <img src="../../finalteam2/uploads/bucket.jpg" alt="Bucket" style="float:right;" width="150" height="150" />
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
