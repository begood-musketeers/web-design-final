<?php
include("controller/product.php");

$site_name .= " - products";
$page_description = "All my _config demo products!";
?>

<body>
    <div style="padding:10px">
        <h1><?= $sub_page ?></h1>

        <button type="submit" class="btn btn-primary" onclick="controllerTest()">Get product data</button>
        <br><br>

        <a href="foo">Product: foo</a><br>
        <a href="bar">Product: bar</a><br><br>
        
        <a href="../">Return</a>
    </div>
</div>

<script>
function controllerTest() {
    var xhttp = new XMLHttpRequest()
    xhttp.open("POST", "", true)
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
    xhttp.send("request=controllerTest&product_name=<?= $sub_page ?>")
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            alert(this.responseText)
        }
    }
}
</script>