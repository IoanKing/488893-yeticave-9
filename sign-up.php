<?php
  require_once(__DIR__.'\inc\config.php');
  require_once(__DIR__.'\inc\function.php');
  require_once(__DIR__.'\inc\db.php');
  
  $DB = init_connection($DB_config['host'], $DB_config['user'], $DB_config['password'], $DB_config['DB']);
  $path = __DIR__."\sign-up.php";
  $post = [];
  $error = [];
  
  if (!$DB) {
    $error = mysqli_connect_error();
    render_error_db($error, $is_auth, $title, $user_name);
  }
  
  $categories = db_fetch_data($DB, $query_template['cathegory']);
  if (gettype($categories) !== 'array') {
    render_error_db($categories, $is_auth, $title, $user_name);
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
        render_error_db($categories, $is_auth, $title, $user_name);
      }

      header('Location: index.php');
    }
  }
  
  $content = include_template(
    'sign-up.php', [
      'cathegory' => $categories ?? [],
      'path' => $path,
      'post' => $post,
      'error' => $errors,
    ]
  );
  
  render_page($categories, $content, $is_auth, $title, $user_name);
  
  
