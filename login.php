<?php
  require_once(__DIR__.'\inc\config.php');
  require_once(__DIR__.'\inc\function.php');
  require_once(__DIR__.'\inc\db.php');
  
  session_start();
  
  $DB = init_connection($DB_config['host'], $DB_config['user'], $DB_config['password'], $DB_config['DB']);
  $post = [];
  $errors = [];
  $user_name = '';
  $title = 'Авторизация';
  
  if (!$DB) {
    $errors = mysqli_connect_error();
    render_error_db($errors, $title, $user_name);
  }
  
  $categories = db_fetch_data($DB, $query_template['cathegory']);
  if (gettype($categories) !== 'array') {
    render_error_db($categories, $title, $user_name);
  }
  
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post = $_POST;
    $errors = start_session($DB, $post);
    
    if (empty($errors)) {
      header('Location: index.php');
      exit();
    }
  }
  
  $content = include_template(
    'login.php', [
      'cathegory' => $categories ?? [],
      'post' => $post,
      'error' => $errors,
    ]
  );
  
  render_page($categories, $content, $title, $user_name);