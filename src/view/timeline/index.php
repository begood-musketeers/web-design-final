<?php
$site_name .= " - home";
$page_description = "XSN, where students unite";

include_once("controller/timeline.php");
?>


<timeline>
  <posts>
    <?php

    foreach ($content as $item) {

      if (isset($item['start_datetime'])) {
        // it's an event

        echo "event";
      } else {
        // it's a post

        echo "post";
      }

    }

    ?>
  </posts>
</timeline>


<?php include_once("view/partial_navbar.php"); ?>