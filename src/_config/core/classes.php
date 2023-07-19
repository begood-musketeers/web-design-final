<?php

class SimpleDB {
  protected $link;

  function __construct($db_name) {
    global $database_model;
    global $database_credentials;

    $this->link = new mysqli(
      $database_credentials[$database_model][0],
      $database_credentials[$database_model][1],
      $database_credentials[$database_model][2],
      $db_name
    );
  }

  static $_singleton;
    
  public static function Singleton() {
    if(SimpleDB::$_singleton == null)
        SimpleDB::$_singleton = new SimpleDB('xsn');
    return SimpleDB::$_singleton;
  }

  function query($sql) {
    mysqli_query($this->link, $sql);
  }

  function query_prepared($sql, $types, ...$args) {
    $stmt = $this->link->prepare($sql);
    $stmt->bind_param($types, ...$args);

    if(!$stmt->execute()) {
        return null;
    }

    return mysqli_insert_id($this->link);
  }

  function fetch_prepared($sql, $types, ...$args) {
    $stmt = $this->link->prepare($sql);
    $stmt->bind_param($types, ...$args);

    if(!$stmt->execute()) {
        return null;
    }

    $results = $stmt->get_result();
    return $results->fetch_all(MYSQLI_ASSOC);
  }

  function fetch_prepared_multiple($sql, $types, ...$args) {
    $stmt = $this->link->prepare($sql);
    $stmt->bind_param($types, ...$args);
    $stmt->execute();
    $query_results = $stmt->get_result();
    $results = $query_results->fetch_all(MYSQLI_ASSOC);
    return $results;
  }

  function fetch($sql) {
    $result = FALSE;
    $result = mysqli_fetch_assoc(mysqli_query($this->link, $sql));
    return $result;
  }

  function fetch_multiple($sql) {
    $result = mysqli_query($this->link, $sql);
    $array = Array();
    for($i = 0; $array[$i] = mysqli_fetch_assoc($result); $i++) ;
    array_pop($array);
    return $array;
  }
}
