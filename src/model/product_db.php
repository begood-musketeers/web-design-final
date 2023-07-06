<?php

function addProduct($note_name, $note_content) {
  $db = new SimpleDB('example_db');
  $sql = "INSERT INTO products (note_name, note_content) VALUES (?, ?)";
  $db->query($sql, [$note_name, $note_content]);
}

function updateProduct($id, $note_name, $note_content) {
  $db = new SimpleDB('example_db');
  $sql = "UPDATE products SET note_name = '$note_name', note_content = '$note_content' WHERE id = '$id'";
  $db->query($sql);
}

function deleteProduct($id) {
  $db = new SimpleDB('example_db');
  $sql = "DELETE FROM products WHERE id = '$id'";
  $db->query($sql);
}

function getProduct($id) {
  $db = new SimpleDB('example_db');
  $sql = "SELECT note_name, note_content FROM products WHERE id = '$id'";
  $result = $db->fetch($sql);

  if (!$result) {
    echo json_encode(['error' => 'No product found']);
  } else {
    $note_name = $result['note_name'];
    $note_content = $result['note_content'];
    echo json_encode(['note_name' => $note_name, 'note_content' => $note_content]);
  }
}

function getProducts() {
  $db = new SimpleDB('example_db');
  $sql = "SELECT id, note_name, note_content FROM products";
  $result = $db->fetch_multiple($sql);

  if (!$result) {
    echo json_encode(['error' => 'No products found']);
  } else {
    echo json_encode($result);
  }
}