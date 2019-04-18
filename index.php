<?php
require_once(__DIR__.'\inc\config.php');
require_once(__DIR__.'\inc\function.php');
require_once(__DIR__.'\inc\data.php');

$content = include_template('index.php', [
   'cathegory' => $cathegory,
   'adverts' => $adverts,
]);

$layout = include_template('layout.php', [
    'cathegory' => $cathegory,
    'is_auth' => $is_auth,
    'title_page' => $title_page,
    'user_name' => $user_name,
    'content' => $content,
 ]);

print($layout);
