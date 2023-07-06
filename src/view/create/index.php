<?php
$site_name .= " - new post";
$page_description = "Post on XSN";
?>

<div class="flex-center" style="height:fit-content;width:100%">

  <div style="width:80%;max-width:400px">
    <h1 class="text-center" style="padding:40px 0 20px 0">Create</h1>

    <create-option>
      <create-option-left>
        <h2>new post</h2>
      </create-option-left>
      <create-option-right>
        <a href="?p=new_post&t=0">
          <create-option-block>
            <span class="material-icons">signpost</span>
          </create-option-block>
        </a>
      </create-option-right>
    </create-option>

    <create-option>
      <create-option-left>
        <h2>new event</h2>
      </create-option-left>
      <create-option-right>
        <a href="?p=new_event">
          <create-option-block>
            <span class="material-icons">event</span>
          </create-option-block>
        </a>
      </create-option-right>
    </create-option>

    <create-option>
      <create-option-left>
        <h2>new recommendation</h2>
      </create-option-left>
      <create-option-right>
        <a href="?p=new_post&t=1">
          <create-option-block>
            <span class="material-icons">place</span>
          </create-option-block>
        </a>
      </create-option-right>
    </create-option>

    <create-option>
      <create-option-left>
        <h2>new bucket list</h2>
      </create-option-left>
      <create-option-right>
        <a href="?p=new_bucket_list">
          <create-option-block>
            <span class="material-icons">fact_check</span>
          </create-option-block>
        </a>
      </create-option-right>
    </create-option>

  </div>
</div>

<?php include_once("view/partial_navbar.php"); ?>