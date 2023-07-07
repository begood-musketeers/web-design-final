<?php
$site_name .= " - home";
$page_description = "XSN, where students unite";

include_once("controller/timeline.php");
?>


<timeline>
  <posts>
    <?php

    foreach ($content as $item) {
      $type = (isset($item['start_datetime'])) ? 'event' : 'post';

      $images = explode(',', $item['image_file_names']);
      $images_html = '';
      $image_int = 0;
      $image_count = count($images);
      foreach ($images as $image) {
        $checked = ($image_int == 0) ? 'checked="checked"' : '';
        $show_bullets = ($image_count == 1) ? 'style="display:none"' : '';

        $images_html .= '
          <input type="radio" name="p-' . $item['id'] . '' . $type . '" id="p-' . $item['id'] . '-item-' . $image_int . '" class="slideshow--bullet" ' . $checked . ' ' . $show_bullets . ' />
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
            <item-stat onclick="like(' . $item['id'] . ',\'' . $type . '\')">
              <span class="material-icons">favorite</span>
              <span id="l-' . $item['id'] . '' . $type . '">' . $item['likes'] . '</span>
            </item-stat>
            <item-stat>
              <span class="material-icons">comment</span> ' . $item['comments'] . '
            </item-stat>
          </item-stats>

          <item-description>
            <p>' . $item['title'] . '</p>
            <br>
            <p>' . substr($item['description'], 0, 100) . '...</p>
          </item-description>
        </div>

      </item>
      ';

    }

    ?>

    <div style="opacity:0;height:200px;width:100%;">end of the feed</div>
  </posts>
</timeline>


<?php include_once("view/partial_navbar.php"); ?>