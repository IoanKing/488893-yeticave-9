<?php
require_once(__DIR__.'\inc\config.php');
require_once(__DIR__.'\inc\function.php');
require_once(__DIR__.'\inc\db.php');

$content = '';

$DB = init_connection($DB_config['host'], $DB_config['user'], $DB_config['password'], $DB_config['DB']);

if (!$DB) {
  $error = mysqli_connect_error();
  render_error_db($error, $is_auth, $title, $user_name);
}

$categories = db_fetch_data($DB, $query_template['cathegory']);
if (gettype($categories) !== "array") {
  render_error_db($categories, $is_auth, $title, $user_name);
}

$adverts = db_fetch_data($DB, $query_template['lot']);
if (gettype($adverts) !== "array") {
  render_error_db($adverts, $is_auth, $title, $user_name);
}

$content = include_template(
  'index.php', [
    'cathegory' => $categories ?? '',
    'adverts' => $adverts ?? '',
  ]
);

render_page($categories, $content, $is_auth, $title, $user_name);
