<?php
/**
 * Форматирует ставку под формат вывода на карточке товара и возвращает подготовленую строку.
 *
 * @param float $number - Число - текущая ставка аукциона по товару.
 * @return string       - Итогова строка с текстом ставки.
 */
function amount_format(float $number): string {
    $rounded_number = ceil($number);
    if ($rounded_number <= 1000) {
        return $rounded_number;
    }
    return number_format($rounded_number, 0, '', ' ');
};

/**
 * Защита от XSS атак. Проверка и удаление специсимволов для строки.
 *
 * @param string $str - Обрабатываемая строка.
 * @return string     - Обработанная строка.
 */
function esc(string $str): string {
	$text = htmlspecialchars($str);
	return $text;
}

/**
 * Подключает шаблон, передает туда данные и возвращает итоговый HTML контент
 *
 * @param string $name  - Путь к файлу шаблона относительно папки templates
 * @param array $data   - Ассоциативный массив с данными для шаблона
 * @return string       - Итоговый HTML
 */
function include_template(string $name, array $data = []): string {
  $name = 'templates/' . $name;
  $result = '';

  if (!is_readable($name)) {
      return $result;
  }

  ob_start();
  extract($data);
  require $name;

  $result = ob_get_clean();

  return $result;
}

/**
 * Получить количество секунд до полуночи следующего дня.
 *
 * @param \DateTime $date   - Дата.
 * @return \DateInterval - Оставщееся время до полуночи.
 */
function get_time_to_tomorow($date) {
  $curr_date = DateTime::createFromFormat('Y-m-d H:i:s', $date);
  $nex_day = date_create();
  $diff = date_diff($nex_day, $curr_date);
  return $diff;
}

/**
 * Получает оставшиеся время до полуночи и приводит его в читабельный формат H:I
 *
 * @param \DateTime $date   - Дата.
 * @return string - Строка с оставшимся временем до полуночи.
 */
function get_timer_format($date) {
  $time_count = get_time_to_tomorow($date);
  $minutes = date_interval_format($time_count, '%I');
  $hours = date_interval_format($time_count, '%H');
  $days = date_interval_format($time_count, '%a');
  return strval($hours + $days*24).":".strval($minutes);
};

/**
 * Получает оставшиеся время до полуночи и формирует класс finishing если время до полуночи менее часа.
 *
 * @param \DateTime $date   - Дата.
 * @return string - Наименование класса.
 */
function get_class_finishing($date) {
  $time_count = get_time_to_tomorow($date);
  $hours = date_interval_format($time_count, '%H');
  if (($hours) < 1) {
    return 'timer--finishing';
  }
  return '';
};

/**
 * Формирует страницу отдаваемую пользователю.
 *
 * @param array $categories   - массив с категориями.
 * @param string $content     - основной контент страницы.
 * @param bool $is_auth       - признак авторизации пользователя.
 * @param string $title       - название страницы.
 * @param string $user_name   - имя  текущего пользователя.
 */
function render_page($categories, $content, $is_auth, $title, $user_name) {
  $layout = include_template('layout.php', [
    'cathegory' => $categories,
    'content' => $content,
    'is_auth' => $is_auth,
    'title' => $title,
    'user_name' => $user_name,
  ]);
  
  print($layout);
  die();
};

/**
 * Формирует страницу с ошибкой и прекращает выполнения сценария.
 *
 * @param string $error_text   - ошибка.
 * @param bool $is_auth        - признак авторизации пользователя.
 * @param string $title        - название страницы.
 * @param string $user_name    - имя  текущего пользователя.
 */
function render_error_db($error_text, $is_auth, $title, $user_name) {
  $content = include_template('error.php', ['error' => $error_text]);
  render_page([], $content, $is_auth, $title, $user_name);
  die();
};
