<?php
    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true) {
        header("Location: /?p=login");
        die();
    }
?>
<?php
$site_name .= " - profile";
$page_description = "View your profile";

include_once("controller/user.php");
?>
<?php include_once("view/partial_navbar.php"); ?>
<div class="container">
    <div class="rectangle">
        <img src="https://avatars.cloudflare.steamstatic.com/3709c6cc1e650f51bc7c8bc4cf873da82a736a22_full.jpg" alt="Avatar" class="Avatar">
        <p><?php echo $user["username"];?> <br> <span>Zwolle, the Netherlands<span></p>
        
    </div>
    <div class="flex-container">
        <div class="flex-item bigger-box">
           <div class="content">
            <!-- load all posts with user id -->
           </div>
        
        </div>
        <div class="flex-item smaller-box"><p>Friends</p></div>
    </div>
</div>

 <script>
    function resizeRectangle() {
    const rectangle = document.querySelector('.rectangle');
    const windowWidth = window.innerWidth;
    if (windowWidth <= 976) {
        rectangle.style.width = '100%';
    } else {
        rectangle.style.width = '976px';
    }
}
    window.addEventListener('resize', resizeRectangle);
    // Call the function on page load to set the initial size
    resizeRectangle();
</script> 
<script>
    function resizeContainer() {
    const rectangle = document.querySelector('.container');
    const windowWidth = window.innerWidth;
    if (windowWidth <= 1018) {
        rectangle.style.width = '100%';
    } else {
        rectangle.style.width = '1018px';
    }
}
    window.addEventListener('resize', resizeContainer);
    // Call the function on page load to set the initial size
    resizeContainer();
</script>


