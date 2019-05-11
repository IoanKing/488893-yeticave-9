<?php
  require_once(__DIR__.'\inc\config.php');
  require_once(__DIR__.'\inc\function.php');
  require_once(__DIR__.'\inc\db.php');
  
  session_start();
  
  $DB = init_connection($DB_config['host'], $DB_config['user'], $DB_config['password'], $DB_config['DB']);
  $post = [];
  $files = [];
  $error = [];
  $title = 'Добавление лота';
  
  if (isset($_SESSION['user'])) {
    $user_name = $_SESSION['user']['name'];
  }
  
  if (!$DB) {
    $error = mysqli_connect_error();
    render_error_db($error, $title, $user_name);
  }
  
  $categories = db_fetch_data($DB, $query_template['cathegory']);
  if (gettype($categories) !== "array") {
    render_error_db($categories, $title, $user_name);
  }
  
  if (empty($user_name)) {
    $content = include_template(
      '403.php', [
        'cathegory' => $categories ?? [],
      ]
    );
    render_page($categories, $content, $title, $user_name);
  }
  
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post = $_POST;
    $files = $_FILES['file'];
    $error = validation_add_lot($post, $files);
  
    $createdate = date_create('now')->format('Y-m-d');
  
    if (!in_array(true, $error)) {
      $mimetype = mime_content_type($files['tmp_name']);
      $filename = uniqid() . get_file_type($mimetype);
      $createdate = date_create('now')->format('Y-m-d');
      
      $arguments = [
        $post['lot-name'],
        $post['message'],
        $filename,
        $post['lot-rate'],
        $post['lot-step'],
        1,
        $post['category'],
        $createdate,
        $post["lot-date"]
      ];
      $create_lot = db_insert_data($DB, $query_template['create_lot'], $arguments);
      
      if (gettype($create_lot) === "string") {
        render_error_db($categories, $title, $user_name);
      }
      uploaded_file($files, $filename);
      header("Location: lot.php?id=" . $create_lot);
    }
  }
  
  $content = include_template(
    'add.php', [
      'cathegory' => $categories ?? [],
      'post' => $post,
      'error' => $error,
    ]
  );
  
  render_page($categories, $content, $title, $user_name);
  
  