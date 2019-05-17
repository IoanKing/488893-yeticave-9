<?php
  require_once(__DIR__.'\inc\config.php');
  require_once(__DIR__.'\inc\function.php');
  require_once(__DIR__.'\inc\db.php');
  
  require_once(__DIR__.'\vendor\autoload.php');
  
  session_start();
  
  $post = [];
  $errors = [];
  $content = '';
  $user_name = '';
  $user_id = '';
  
  if (isset($_SESSION['user'])) {
    $user_name = $_SESSION['user']['name'];
    $user_id = $_SESSION['user']['id'];
  }
  
  $DB = init_connection($DB_config['host'], $DB_config['user'], $DB_config['password'], $DB_config['DB']);