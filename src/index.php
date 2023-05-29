<!DOCTYPE html>
<html>
<body>
<?php
$db_host = "db";
$db_username = "root";
$db_password = "password";

$conn = mysqli_connect($db_host, $db_username, $db_password);

if(!$conn) {
    echo "failed";
    die("Connection failed: ". mysqli_connect_error());
}

echo "Successfully connected to database !<br/>";

?>
</body>
</html>
