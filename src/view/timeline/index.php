<?php
$site_name .= " - home";
$page_description = "XSN, where students unite";

include_once("controller/timeline.php");
?>


<timeline>
  <posts>
    <?php

    foreach ($content as $item) {

      $images = explode(',', $item['image_file_names']);
      $images_html = '';
      $image_int = 0;
      foreach ($images as $image) {
        $checked = ($image_int == 0) ? 'checked="checked"' : '';
        $images_html .= '
          <input type="radio" name="p-' . $item['id'] . '' . $item['type'] . '" id="p-' . $item['id'] . '-item-' . $image_int . '" class="slideshow--bullet" ' . $checked . ' />
          <div class="slideshow--item">
            <img src="assets/uploads/' . $image . '" style="max-width:100%;max-height:100%">
          </div>
        ';
        $image_int++;
      }

      echo '
      <item>
        <a href="?p=profile&u=' . $item['username'] . '">
          <item-title>
            <img src="assets/pfp/' . $item['username'] . '" height="50" width="50" class="item-pfp">
            ' . $item['username'] . ' • ' . timeago($item['created_datetime']) . '
          </item-title>
        </a>

        <div class="flex-center">
          <div class="slideshow" data-transition="fade">

            ' . $images_html . '

          </div>
        </div>

        <div>
          <item-stats>
            <item-stat><span class="material-icons">favorite</span> ' . $item['likes'] . '</item-stat>
            <item-stat><span class="material-icons">comment</span> ' . $item['comments'] . '</item-stat>
          </item-stats>

          <item-description>
            <p>' . $item['title'] . '</p>
            <p>' . $item['description'] . '</p>
          </item-description>
        </div>

      </item>
      ';

    }

    ?>

    <br><br><br><br><br><br><br>
  </posts>
</timeline>


<?php include_once("view/partial_navbar.php"); ?>