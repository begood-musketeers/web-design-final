<?php
    include_once("controller/new_bucket_list.php");
?>

<?php
if (isset($bucket_list_id)) {
    $bucket_list = BucketListDB::get_bucket_list($bucket_list_id);
    $name = BucketListDB::get_bucket_list_name($bucket_list_id);
?>
    <h1><?php echo $name; ?></h1>
<?php
    foreach($bucket_list as $key => $item) {
?>
    <form action="" method="POST">
        <legend>Edit item<legend>
        <input type="hidden" value=<?php echo $bucket_list_id; ?> name="bucket_list_id" />
        <input type="hidden" name="item_id" value=<?php echo $item["id"] ?> />
        <input type="text" name="content" value="<?php echo $item["content"]; ?>" />
        <input type="checkbox" name="completed" <?php echo $item["completed"] ? "checked" : "" ?> />
        <input type="hidden" name="request" value="update_item" />
        <button type="submit">submit</button>
</form>
<?php
    }
?>

<form action="" method="POST">
    <legend>Add new item</legend>
    <input type="hidden" value=<?php echo $bucket_list_id; ?> name="bucket_list_id" />
    <input type="text" name="content" />
    <input type="checkbox" name="completed" />
    <input type="hidden" name="request" value="add_item" />
    <button type="submit">submit</button>
</form>

<?php
} else {
?>

<form action="" method="POST">
    <input type="text" name="title" placeholder="bucket list title" />
    <input type="hidden" name="request" value="new_bucket_list" />
    <button type="submit">submit</button>
</form>

<?php
}
?>

