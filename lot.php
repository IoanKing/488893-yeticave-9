<?php
  require_once(__DIR__.'\inc\config.php');
  require_once(__DIR__.'\inc\function.php');
  require_once(__DIR__.'\inc\db.php');
  
  $DB = init_connection($DB_config['host'], $DB_config['user'], $DB_config['password'], $DB_config['DB']);
  
  if (!$DB) {
    $error = mysqli_connect_error();
    render_error_db($error, $is_auth, $title, $user_name);
  }
  
  $categories = db_fetch_data($DB, $query_template['cathegory']);
  if (gettype($categories) !== "array") {
    render_error_db($categories, $is_auth, $title, $user_name);
  }
  
  $id = intval($_GET['id']);
  
  if (empty($id)) {
    $content = include_template(
      '404.php', [
        'cathegory' => $categories ?? []
      ]
    );
    render_page($categories, $content, $is_auth, $title, $user_name);
  }
  
  $lots = db_fetch_data($DB, $query_template['lot_full'], $id);
  if (gettype($lots) !== "array") {
    render_error_db($lots, $is_auth, $title, $user_name);
  }
  
  if (count($lots) === 0) {
    $content = include_template(
      '404.php', [
        'cathegory' => $categories ?? []
      ]
    );
    render_page($categories, $content, $is_auth, $title, $user_name);
  }
  
  $rates = db_fetch_data($DB, $query_template['staf_history'], $id);
  if (gettype($rates) !== "array") {
    render_error_db($rates, $is_auth, $title, $user_name);
  }
  
  $staf_history = include_template(
    'staf-history.php', [
      'rates' => $rates ?? [],
    ]
  );
  
  $content = include_template(
    'lot.php', [
      'cathegory' => $categories ?? [],
      'lots' => $lots[0] ?? [],
      'staf_history' => $staf_history
    ]
  );
  
  render_page($categories, $content, $is_auth, $title, $user_name);