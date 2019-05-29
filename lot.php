<?php
  require_once(__DIR__.'\init.php');
  
  $title = 'Просмотр лота';
  $lot_id = '';
  $min_rate = 0;
  $is_user_add_staf = false;
  $is_date_end = false;
  
  $error_template = [
    '1' => 'Введите ставку лота!',
    '2' => 'Ставка должна быть числом!',
    '3' => 'Ставка меньше минимальной!'
  ];
  
  if (!$DB) {
    $errors = mysqli_connect_error();
    render_error_db($errors, $title, $user_name);
  }
  
  $categories = db_fetch_data($DB, $query_template['cathegory']);
  if (gettype($categories) !== "array") {
    render_error_db($categories, $title, $user_name);
  }
  
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post = $_POST;
    $lot_id = $post['lot_id'];
    $new_rate = $post['cost'];
  
    $lot = db_fetch_data($DB, isset($query_template['lot_full']) ? $query_template['lot_full'] : '', $lot_id);
    if (gettype($lot) !== "array" && !empty($lot)) {
      render_error_db($lot, $title, $user_name);
    }
    
    $errors = validation_add_staf($post, $lot[0]);
  
    if (empty($errors)) {
      $createdate = date_create('now')->format('Y-m-d H:i:s');
      $arguments = [
        $lot_id,
        $user_id,
        $new_rate,
        $createdate,
      ];
      
      $create_lot = db_insert_data($DB, isset($query_template['add_rate']) ? $query_template['add_rate'] : '', $arguments);
      if (gettype($create_lot) === "string") {
        render_error_db($categories, $title, $user_name);
      }
      
      header("Location: lot.php?id=" . $lot_id);
    } else {
      header("Location: lot.php?id=" . $lot_id . "&error=" . $errors['staf']);
    }
  }
  
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $lot_id = intval($_GET['id']);
    $error_code = intval($_GET['error']);
    if (!empty($error_code)) {
      $errors['staf'] = $error_template[$error_code];
    }
  }

  if (empty($lot_id)) {
    $content = include_template(
      '404.php', [
        'cathegory' => $categories ?? []
      ]
    );
    render_page($categories, $content, $title, $user_name);
  }

  $lot = db_fetch_data($DB, isset($query_template['lot_full']) ? $query_template['lot_full'] : '', $lot_id);
  if (gettype($lot) !== "array" && !empty($lot)) {
    render_error_db($lot, $title, $user_name);
  }

  if (empty($lot)) {
    $content = include_template(
      '404.php', [
        'cathegory' => $categories ?? [],
      ]
    );
    render_page($categories, $content, $title, $user_name);
  }
  
  if (isset($lot[0]['price']) && isset($lot[0]['staf_step'])) {
    $min_rate = $lot[0]['price'] + $lot[0]['staf_step'];
  }
  
  $rates = db_fetch_data($DB, isset($query_template['staf_history']) ? $query_template['staf_history'] : '', $lot_id);

  if (gettype($rates) !== "array" && !empty($rates)) {
    render_error_db($rates, $title, $user_name);
  }
  
  $last_user_staf = db_fetch_data($DB, isset($query_template['get_last_user_rate']) ? $query_template['get_last_user_rate'] : '', $lot_id);
  if (gettype($rates) !== "array" && !empty($rates)) {
    render_error_db($last_user_staf, $title, $user_name);
  }
  
  if (isset($lot[0]['id'])) {
    $is_user_add_staf = ($last_user_staf[0]['id'] === $user_id);
  }

  if (isset($lot[0]['end_date'])) {
    $is_date_end = (get_timer_lelt($lot[0]['end_date']) === '00:00') ? true : false;
  }

  $staf_history = include_template(
    'staf-history.php', [
      'rates' => $rates ?? [],
    ]
  );

  $content = include_template(
    'lot.php', [
      'cathegory' => $categories ?? [],
      'lot' => $lot[0] ?? [],
      'staf_history' => $staf_history,
      'user_name' => $user_name,
      'errors' => $errors,
      'min_rate' => $min_rate,
      'is_user_add_staf' => $is_user_add_staf,
      'is_date_end' => $is_date_end
    ]
  );

  render_page($categories, $content, $title, $user_name);
