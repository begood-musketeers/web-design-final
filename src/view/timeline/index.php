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
            <img src="/uploads/' . $image . '" style="max-width:100%;max-height:100%">
          </div>
        ';
        $image_int++;
      }

      // check if user has liked this post
      if (isset($_SESSION['loggedin'])) {
        if ($item['liked'] == 1) {
          $like_tag = 'onclick="unlike(' . $item['id'] . ',\'' . $type . '\')" class="pointer liked"';
        } else {
          $like_tag = 'onclick="like(' . $item['id'] . ',\'' . $type . '\')" class="pointer"';
        }
      } else {
        $like_tag = 'onclick="login()" class="pointer"';
      }

      // if type is event add an icon
      if ($type == 'event') {
        $type_icon = '<span class="material-icons item-type-icon">event</span>';
      } else {
        $type_icon = '';
      }

      echo '
      <item>
        ' . $type_icon . '
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
            <item-stat ' . $like_tag . '>
              <span class="material-icons">favorite</span>
              <span id="l-' . $item['id'] . '' . $type . '">' . $item['likes'] . '</span>
            </item-stat>
            <a href="?p=' . $type . '&id=' . $item['id'] . '">
              <item-stat>
                  <span class="material-icons">comment</span> ' . $item['comments'] . '
                </item-stat>
            </a>
          </item-stats>

          <a href="?p=' . $type . '&id=' . $item['id'] . '">
            <item-description>
              <p>' . $item['title'] . '</p>
              <p>' . substr($item['description'], 0, 100) . '...</p>
            </item-description>
          </a>
        </div>

      </item>
      ';

    }

    ?>

    <div style="opacity:0;height:200px;width:100%;">end of the feed</div>
  </posts>
</timeline>


<?php include_once("view/partial_navbar.php"); ?>
