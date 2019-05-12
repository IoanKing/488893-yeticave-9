<?php
  require_once(__DIR__.'\inc\config.php');
  require_once(__DIR__.'\inc\function.php');
  require_once(__DIR__.'\inc\db.php');
  
  session_start();
  
  $DB = init_connection($DB_config['host'], $DB_config['user'], $DB_config['password'], $DB_config['DB']);
  $title = 'Просмотр лота';
  $user_name = '';
  
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
  
  $id = intval($_GET['id']);
  
  if (empty($id)) {
    $content = include_template(
      '404.php', [
        'cathegory' => $categories ?? []
      ]
    );
    render_page($categories, $content, $title, $user_name);
  }
  
  $lot = db_fetch_data($DB, $query_template['lot_full'], $id);
  
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
  
  $rates = db_fetch_data($DB, $query_template['staf_history'], $id);
  
  if (gettype($rates) !== "array" && !empty($rates)) {
    render_error_db($rates, $title, $user_name);
  }
  
  $staf_history = include_template(
    'staf-history.php', [
      'rates' => $rates ?? [],
    ]
  );
  
  $content = include_template(
    'lot.php', [
      'cathegory' => $categories ?? [],
      'lot' => $lot ?? [],
      'staf_history' => $staf_history,
      'user_name' => $user_name,
    ]
  );
  
  render_page($categories, $content, $title, $user_name);