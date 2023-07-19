<?php
$site_name .= " - new bucket list";
$page_description = "Create a bucket list on XSN";

include_once("controller/new_bucket_list.php");

?>

<?php
if ($bucket_list != null) {
    die("missing bucket list");
?>

    <h1><?php echo $bucket_list[0]["title"]; ?></h1>

<ul>
<?php
foreach($bucket_list as $key => $bucket_list) {
?>

<li>
<input type="checkbox" <?php echo $value["completed"] ? "checked" : ""; ?> />
<strong><?php echo $value["content"]; ?></strong>
</li>

<?php
}
} else if (count($bucket_lists) > 0) {
    foreach($bucket_lists as $bucket_list) {
        $id = $bucket_list["id"];
        $title = $bucket_list["title"];
?>
    <li>
        <h3><?php echo $title; ?></h3>
        <form action="" method="GET">
            <input type="hidden" name="p" value="new_bucket_list" />
            <input type="hidden" name="bucket_list_id" value="<?php echo $id; ?>" />
            <button type="submit">modify</button>
        </form>
    </li>
<?php
    }
}
?>
</ul>
