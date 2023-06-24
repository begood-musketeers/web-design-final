<?php
include("model/product_db.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {

  if (isset($_POST['request'])) {
    $request = sanitise($_POST['request']);
  } else {
    echo json_encode(['error' => 'No request found']);
    exit();
  }
  
  switch ($request) {
    // CONTROLLER TEST CASE
    case "controllerTest":
      $product_name = sanitise($_POST['product_name']);
      echo "Controller test successful!\n\nCurrent product: $product_name";
      break;
  
    // SQL EXAMPLE CASES
    case "addProduct":
      $product_name = sanitise($_POST['product_name']);
      $product_content = sanitise($_POST['product_content']);
      addProduct($product_name, $product_content);
      break;
    case "updateProduct":
      $id = sanitise($_POST['id']);
      $product_name = sanitise($_POST['product_name']);
      $product_content = sanitise($_POST['product_content']);
      updateProduct($id, $product_name, $product_content);
      break;
    case "deleteProduct":
      $id = sanitise($_POST['id']);
      deleteProduct($id);
      break;
    case "getProduct":
      $id = sanitise($_POST['id']);
      getProduct($id);
      break;
  }

  exit;
}