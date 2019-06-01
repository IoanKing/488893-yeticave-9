<?php
  require_once(__DIR__.'/init.php');
  
  $title = 'Регистрация';
  $post = [];
  $errors = [];
  
  if (!$DB) {
    $error = mysqli_connect_error();
    render_error_db($error, $title, $user_name);
  }
  
  $categories = db_fetch_data($DB, $query_template['cathegory']);
  if (gettype($categories) !== 'array') {
    render_error_db($categories, $title, $user_name);
  }
  
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post = $_POST;
    $errors = validation_signup($DB, $post);
    $post_name = isset($post['name']) ? esc($post['name']) : '';
    $post_email = isset($post['email']) ? esc($post['email']) : '';
    $post_password = isset($post['password']) ? esc($post['password']) : '';
    $post_message = isset($post['message']) ? esc($post['message']) : '';

    if (empty($errors)) {
      $name = mysqli_real_escape_string($DB, $post_name);
      $email = mysqli_real_escape_string($DB, $post_email);
      $has_password = password_hash($post_password, PASSWORD_DEFAULT);
      $message = mysqli_real_escape_string($DB, $post_message);
      $create_date = date_create('now')->format('Y-m-d');
      
      $arguments = [
        $name,
        $email,
        $has_password,
        '',
        $message,
        $create_date
      ];
      $create_lot = db_insert_data($DB, isset($query_template['sign-up']) ? $query_template['sign-up'] : '', $arguments);

      if (gettype($create_lot) === 'string') {
        render_error_db($create_lot, $title, $user_name);
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
  
  
