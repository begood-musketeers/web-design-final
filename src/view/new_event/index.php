<?php
$site_name .= " - new event";
$page_description = "Create an event on XSN";

include_once("controller/new_event.php");
?>

<form action="" method="post" enctype="multipart/form-data" id="new_event_form" class="gradient-a flex-center" style="height:100%;width:100%">
  <div id="event-form" class="card shadow" style="width:100%;max-width:400px">
    <h1 class="text-center">new event</h1><br><br>

    <input type="hidden" name="request" value="new_event" />
    <input type="text" id="title" name="title" placeholder="title" style="width:calc(100% - 20px)" value="<?= (isset($title) ? $title : "") ?>" />
    <br><br>
    <textarea id="description" name="description" placeholder="description" style="width:calc(100% - 20px)"><?= (isset($description) ? $description : "") ?></textarea>
    <br><br>
    <input type="text" id="location" name="location" placeholder="location" style="width:calc(100% - 20px)" value="<?= (isset($location) ? $location : "") ?>" />
    <br><br>

    <select id="type" name="type" style="width:100%">
      <option selected value=""> -- Event Type -- </option>
      <option value="sports">Sports</option>
      <option value="cinema">Cinema</option>
      <option value="hangout">Hangout</option>
      <option value="games">Games</option>
      <option value="amusement park">Amusement Park</option>
    </select><br><br>

    <input type="date" id="start_date" name="start_date" placeholder="start date" style="width:calc(100% - 20px)" value="<?= (isset($start_date) ? $start_date : "") ?>">
    <br><br>
    <input type="date" id="end_date" name="end_date" placeholder="end date" style="width:calc(100% - 20px)" value="<?= (isset($end_date) ? $end_date : "") ?>">
    <br><br>

    <div id="images">
      <image-add onclick="add_image_field()">
        <span class="material-icons">add</span>
      </image-add>
    </div>

    <?php if (isset($error)) { ?>
      <div role="alert" id="error" style="padding:20px;background:#ff000033;margin-bottom:20px">
        <?= $error ?>
      </div>
    <?php } ?>

    <button class="btn background-a text-white text-center pointer" type="submit" style="width:100%;display:block;font-size:17px">share</button>
  </div>
</form>

<?php include_once("view/partial_navbar.php"); ?>
