<?php
  require_once(__DIR__.'\init.php');
  
  $title = 'Поиск';
  $adverts = [];
  $pagination = [];
  
  $get = $_GET;
  $search_phrase = esc(trim($get['search']));
  $page = intval($get['page'] ?? 1);
  
  if (!$DB) {
    $errors = mysqli_connect_error();
    render_error_db($errors, $title, $user_name);
  }
  
  $categories = db_fetch_data($DB, $query_template['cathegory']);
  if (gettype($categories) !== "array") {
    render_error_db($categories, $title, $user_name);
  }
  
  $count_adverts = db_fetch_data($DB, $query_template['search_count'], $search_phrase);
  if (gettype($count_adverts) !== "array") {
    render_error_db($count_adverts, $title, $user_name);
  }
  
  $pages_count = intval(ceil($count_adverts[0]['count'] / $limit_per_page));
  
  if ($pages_count > 0) {
    $offset = ($page - 1) * $limit_per_page;
    $pagination = range(1, $pages_count);
  
    $adverts = db_fetch_data(
      $DB, $query_template['search'], [$search_phrase, $limit_per_page, $offset]
    );
    if (gettype($adverts) !== "array") {
      render_error_db($adverts, $title, $user_name);
    }
  }
  
  $content = include_template(
    'search.php', [
      'cathegory' => $categories ?? [],
      'adverts' => $adverts ?? [],
      'search_phrase' => $search_phrase,
      'page' => $page,
      'pagination' => $pagination,
    ]
  );
  
  render_page($categories, $content, $title, $user_name);