<?php
$site_name .= " - home";
$page_description = "This is my _config index!";
?>

<div style="padding:10px">
    <h1>Hello World</h1>

    <hr class="my-4">

    <h5>Click here to view the $page / $sub_page example</h5>
    <a href="?p=product&s=foo">Product: foo</a><br>
    <a href="?p=product&s=foo">Product: bar</a>
</div>

<?php include_once("view/partial_navbar.php"); ?>