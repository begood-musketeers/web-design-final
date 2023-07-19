<?php
$site_name .= " - new bucket list";
$page_description = "Create a bucket list on XSN";

include_once("controller/bucket_list.php");

?>

<?php
if (is_array($bucket_lists) && count($bucket_lists) > 0) {
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
        <form action="" method="POST">
            <input type="hidden" name="request" value="delete_bucket_list" />
            <input type="hidden" name="bucket_list_id" value="<?php echo $id; ?>" />
            <button type="submit">delete</button>
        </form>
    </li>
<?php
    }
}
?>
</ul>
