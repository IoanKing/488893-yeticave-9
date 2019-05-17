<?php
  require_once(__DIR__.'\init.php');
  
  $title = 'Главная страница';
  
  if (!$DB) {
    $errors = mysqli_connect_error();
    render_error_db($errors, $title, $user_name);
  }
  
  require_once(__DIR__.'\get_winner.php');
  
  $categories = db_fetch_data($DB, $query_template['cathegory']);
  if (gettype($categories) !== "array") {
    render_error_db($categories, $title, $user_name);
  }
  
  $adverts = db_fetch_data($DB, $query_template['lot']);
  if (gettype($adverts) !== "array") {
    render_error_db($adverts, $title, $user_name);
  }
  
  $content = include_template(
    'index.php', [
      'cathegory' => $categories ?? [],
      'adverts' => $adverts ?? [],
    ]
  );
  
  render_page($categories, $content, $title, $user_name);
