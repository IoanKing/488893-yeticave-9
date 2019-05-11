<?php
  require_once(__DIR__.'\inc\config.php');
  require_once(__DIR__.'\inc\function.php');
  require_once(__DIR__.'\inc\db.php');
  
  session_start();
  
  $DB = init_connection($DB_config['host'], $DB_config['user'], $DB_config['password'], $DB_config['DB']);
  $post = [];
  $error = [];
  $user_name = '';
  $title = 'Регистрация';
  
  if (!$DB) {
    $error = mysqli_connect_error();
    render_error_db($error, $title, $user_name);
  }
  
  $categories = db_fetch_data($DB, $query_template['cathegory']);
  if (gettype($categories) !== 'array') {
    render_error_db($categories, $title, $user_name);
  }
  
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post = $_POST;
    $errors = validation_signup_lot($DB, $post);
    
    $name = mysqli_real_escape_string($DB, $post['name']);
    $email = mysqli_real_escape_string($DB, $post['email']);
    $has_password = password_hash($post['password'], PASSWORD_DEFAULT);
    $message = mysqli_real_escape_string($DB, $post['message']);
    $create_date = date_create('now')->format('Y-m-d');

    if (empty($errors)) {
      $arguments = [
        $name,
        $email,
        $has_password,
        '',
        $message,
        $create_date
      ];
      $create_lot = db_insert_data($DB, $query_template['sign-up'], $arguments);

      if (gettype($create_lot) === 'string') {
        render_error_db($categories, $title, $user_name);
      }

      header('Location: login.php');
    }
  }
  
  $content = include_template(
    'sign-up.php', [
      'cathegory' => $categories ?? [],
      'post' => $post,
      'error' => $errors,
    ]
  );
  
  render_page($categories, $content, $title, $user_name);
  
  
