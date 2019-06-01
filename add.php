<?php
  require_once(__DIR__.'\init.php');
  
  $title = 'Добавление лота';
  
  if (!$DB) {
    $errors = mysqli_connect_error();
    render_error_db($errors, $title, $user_name);
  }
  
  $categories = db_fetch_data($DB, isset($query_template['cathegory']) ? $query_template['cathegory'] : '');
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
  
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post = $_POST;
    $files = isset($_FILES['file']) ? $_FILES['file'] : NULL;
    $errors = validation_add_lot($post, $files);
  
    $check_cathegory = db_fetch_data(
      $DB,
      isset($query_template['cathegory_name_by_id']) ? $query_template['cathegory_name_by_id'] : '',
      isset($post['category']) ? $post['category'] : ''
    );
    if (gettype($check_cathegory) !== "array") {
      render_error_db($check_cathegory, $title, $user_name);
    }
    
    if (empty($check_cathegory)) {
      $errors['category'] = 'Данной категории не существует!';
    }
    
    $createdate = date_create('now')->format('Y-m-d');
  
    if (!in_array(true, $errors) && isset($files)) {
      $mimetype = mime_content_type($files['tmp_name']);
      $filename = uniqid() . get_file_type($mimetype);
      $createdate = date_create('now')->format('Y-m-d');
      
      $arguments = [
        isset($post['lot-name']) ? esc($post['lot-name']) : '',
        isset($post['message']) ? esc($post['message']) : '',
        $filename,
        isset($post['lot-rate']) ? esc($post['lot-rate']) : '',
        isset($post['lot-step']) ? esc($post['lot-step']) : '',
        1,
        isset($post['category']) ? esc($post['category']) : '',
        $createdate,
        isset($post['lot-date']) ? esc($post['lot-date']) : ''
      ];
      $create_lot = db_insert_data($DB, isset($query_template['create_lot']) ? $query_template['create_lot'] : '', $arguments);
      
      if (gettype($create_lot) === "string") {
        render_error_db($create_lot, $title, $user_name);
      }
      
      uploaded_file($files, $filename);
      header("Location: lot.php?id=" . $create_lot);
    }
  }
  
  $content = include_template(
    'add.php', [
      'cathegory' => $categories ?? [],
      'post' => $post ?? [],
      'errors' => $errors ?? [],
    ]
  );
  
  render_page($categories, $content, $title, $user_name);
  
  