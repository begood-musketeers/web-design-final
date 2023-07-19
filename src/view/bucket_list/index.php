<?php
$site_name .= " - new bucket list";
$page_description = "Create a bucket list on XSN";

include_once("controller/bucket_list.php");

?>
<body class="gradient-a">
<h1 class="text-center" style="padding:20px">Bucket lists</h1>
<?php
if (is_array($bucket_lists) && count($bucket_lists) > 0) {
    echo '<div class="card block shadow">'; // Opening the <ul> tag here
    foreach($bucket_lists as $bucket_list) {
        $id = $bucket_list["id"];
        $title = $bucket_list["title"];
?>
            <h2><?php echo $title; ?></h2>
            <form action="" method="GET" style="display:inline">
                <input type="hidden" name="p" value="new_bucket_list" />
                <input type="hidden" name="bucket_list_id" value="<?php echo $id; ?>" />
                <button class="btn background-a text-white text-center pointer" type="submit">modify</button>
            </form>
            <form action="" method="POST" style="display:inline">
                <input type="hidden" name="request" value="delete_bucket_list" />
                <input type="hidden" name="bucket_list_id" value="<?php echo $id; ?>" />
                <button class="btn background-c text-white text-center pointer" type="submit">delete</button>
            </form>
            <br><br>
<?php
    }

    echo '</div>'; // Closing the <ul> tag here
}
?>

<div class='card block shadow'>Create a bucket list <a class='url' href='?p=new_bucket_list'>here</a>.</div>

</div>


</body>
<?php include_once("view/partial_navbar.php"); ?>