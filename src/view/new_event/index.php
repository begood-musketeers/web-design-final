<?php
$site_name .= " - new event";
$page_description = "Create an event on XSN";

include_once("controller/new_event.php");
?>

<div class="gradient-a flex-center" style="height:100%;width:100%">
  <div id="event-form" class="card shadow" style="width:100%;max-width:400px">
    <h1 class="text-center">new event</h1><br><br>

    <input type="text" id="title" name="title" placeholder="title" style="width:calc(100% - 20px)"><br><br>
    <textarea id="description" name="description" placeholder="description" style="width:calc(100% - 20px)"></textarea><br><br>
    <input type="text" id="location" name="location" placeholder="location" style="width:calc(100% - 20px)"><br><br>

    <select id="type" name="type" style="width:100%">
      <option disabled selected value> -- Event Type -- </option>
      <option value="sports">Sports</option>
      <option value="cinema">Cinema</option>
      <option value="hangout">Hangout</option>
      <option value="games">Games</option>
      <option value="amusement park">Amusement Park</option>
    </select><br><br>

    <input type="date" id="start_date" name="start_date" placeholder="start date" style="width:calc(100% - 20px)"><br><br>
    <input type="date" id="end_date" name="end_date" placeholder="end date" style="width:calc(100% - 20px)"><br><br>

    <iframe id="image_upload_target" name="image_upload_target" style="display:none"></iframe>

    <div id="images">
      <image-add onclick="add_image_field()">
        <span class="material-icons">add</span>
      </image-add>
    </div>

    <div role="alert" id="error" style="display:none;padding:20px;background:#ff000033;margin-bottom:20px"></div>

    <span class="btn background-a text-white text-center pointer" onclick="share()" style="width:calc(100% - 20px);display:block">share</span>
  </div>

  <div id="loader" class="spinner" style="display:none"></div>
</div>

<?php include_once("view/partial_navbar.php"); ?>