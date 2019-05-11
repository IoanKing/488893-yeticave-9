<?php
require_once(__DIR__.'\inc\config.php');
require_once(__DIR__.'\inc\db.php');
require_once(__DIR__.'\inc\function.php');

session_start();

$content = '';
$user_name = '';
$title = 'Главная страница';

if (isset($_SESSION['user'])) {
  $user_name = $_SESSION['user']['name'];
}

$DB = init_connection($DB_config['host'], $DB_config['user'], $DB_config['password'], $DB_config['DB']);

if (!$DB) {
  $error = mysqli_connect_error();
  render_error_db($error, $title, $user_name);
}

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
