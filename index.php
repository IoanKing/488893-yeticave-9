<?php
  require_once(__DIR__.'/init.php');
  
  $title = 'Главная страница';
  $adverts = [];
  $pagination = [];
  
  $get = $_GET;
  $page = intval($get['page'] ?? 1);
  
  if (!$DB) {
    $errors = mysqli_connect_error();
    render_error_db($errors, $title, $user_name);
  }
  
  require_once(__DIR__.'\get_winner.php');
  
  $categories = db_fetch_data($DB, isset($query_template['cathegory']) ? $query_template['cathegory'] : '');
  if (gettype($categories) !== "array") {
    render_error_db($categories, $title, $user_name);
  }
  
  $count_adverts = db_fetch_data($DB, isset($query_template['lot_count']) ? $query_template['lot_count'] : '');
  if (gettype($count_adverts) !== "array") {
    render_error_db($count_adverts, $title, $user_name);
  }
  
  if (isset($count_adverts[0]['count'])) {
    $pages_count = intval(ceil($count_adverts[0]['count'] / $limit_per_page));
    
    if ($count_adverts[0]['count'] > 0) {
      $offset = ($page - 1) * $limit_per_page;
      $pagination = range(1, $pages_count);
      
      $adverts = db_fetch_data($DB, isset($query_template['lot']) ? $query_template['lot'] : '', [$limit_per_page, $offset]);
      if (gettype($adverts) !== "array") {
        render_error_db($adverts, $title, $user_name);
      }
    }
  }
  
  $content = include_template(
    'index.php', [
      'cathegory' => $categories ?? [],
      'adverts' => $adverts ?? [],
      'page' => $page,
      'pagination' => $pagination,
    ]
  );
  
  render_page($categories, $content, $title, $user_name);
