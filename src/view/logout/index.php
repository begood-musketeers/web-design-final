<?php
// Unset all of the session variables
$_SESSION = array();

// Destroy the session.
session_destroy();

// Redirect to login page
echo '<script>window.location.href="?p=login"</script>';
exit;