<?php
date_default_timezone_set("Europe/Moscow");
setlocale(LC_ALL, "ru_RU");

$is_auth = rand(0, 1);
$title = "YetiCave";
$user_name = "Иван Суслов";

$DB_config = [
  "host" => "localhost",
  "user" => "root",
  "password" => "",
  "DB" => "yaticave_488893",
];
