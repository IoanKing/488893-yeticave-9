<?php

/**
 * Форматирует ставку под формат вывода на карточке товара и возвращает подготовленую строку.
 * @param float $number Число - текущая ставка аукциона по товару.
 * @return string Итогова строка с текстом ставки.
 */
function formattingAmount(float $number): string {
    $rounded_number = ceil($number);
    if ($rounded_number <= 1000) {
        return $rounded_number.' ₽';
    }
    return number_format($rounded_number, 0, '', ' ').' ₽';
};

/**
 * Защита от XSS атак. Проверка и удаление специсимволов для строки.
 * @param string $str Обрабатываемая строка.
 * @return string Обработанная строка.
 */
function esc(string $str): string {
	$text = htmlspecialchars($str);
	return $text;
}

/**
 * Подключает шаблон, передает туда данные и возвращает итоговый HTML контент
 * @param string $name Путь к файлу шаблона относительно папки templates
 * @param array $data Ассоциативный массив с данными для шаблона
 * @return string Итоговый HTML
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
