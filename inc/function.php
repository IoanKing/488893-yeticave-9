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
   * Получить количество секунд до/после указанного дня.
   *
   * @param \DateTime $date - Дата.
   * @return \DateInterval  - Оставщееся время до полуночи.
   */
  function get_time_to($date) {
    $nex_day = date_create();
    $curr_date = DateTime::createFromFormat('Y-m-d H:i:s', $date);
    return date_diff($curr_date, $nex_day);
  }
  
  /**
   * Получает оставшиеся время до полуночи и приводит его в читабельный формат H:I
   *
   * @param \DateTime $date   - Дата.
   * @return string - Строка с оставшимся временем до полуночи.
   */
  function get_timer_lelt($date, $is_full = false) {
    $main_text = '00:00';
    $additionl_text = '';
    
    $time_count = get_time_to($date);
    $sign = date_interval_format($time_count, '%r');
    $minutes = (!empty($sign)) ? date_interval_format($time_count, '%I') : 0;
    $hours = (!empty($sign)) ? date_interval_format($time_count, '%H') : 0;
    $days = (!empty($sign)) ? date_interval_format($time_count, '%a') : 0;
    $seconds = (!empty($sign)) ? date_interval_format($time_count, '%S') : 0;
    
    if (!empty($sign)) {
      $main_text = strval($hours + $days*24) . ":" . strval($minutes);
      $additionl_text = ($is_full) ? ':' . strval($seconds) : '';
    }
    
    return $main_text . $additionl_text;
  };
  
  /**
   * Формирует статус завершения ставок по лоту.
   *
   * @param $end_date   - дата окончания торгов.
   * @param $winner_id  - идентификатор победителя.
   * @param $user_id    - идентификатор пользователя.
   *
   * @return string     - Статус торгов. Если срок торгов не вышел - возвращает время до окончания торгов.
   */
  function get_timer_rate($date, $winner_id, $user_id) {
    $result = '';
    $time_left = get_timer_lelt($date, true);
    if ($time_left !== '00:00') {
      $result = $time_left;
    } else {
      $result = 'Торги окончены';
    }
    
    if ($winner_id === $user_id) {
      $result = 'Ставка выиграла';
    }
    
    return $result;
  }
  
  /**
   * Определяет имя класса для записи "Мои ставки".
   *
   * @param $end_date   - дата окончания торгов.
   * @param $winner_id  - идентификатор победителя.
   * @param $user_id    - идентификатор пользователя.
   *
   * @return string     - имя класса.
   */
  function get_bets_class($end_date, $winner_id, $user_id) {
    $time_count = get_time_to($end_date);
    $sign = date_interval_format($time_count, '%r');
    $result = '';
    
    if (empty($sign)) {
      $result = 'rates__item--end';
    }
    
    if ($winner_id === $user_id) {
      $result = 'rates__item--win';
    }
    
    return $result;
  }
  
  /**
   * Определяет имя класса для таймера нас странице "Мои ставки".
   *
   * @param $end_date   - дата окончания торгов.
   * @param $winner_id  - идентификатор победителя.
   * @param $user_id    - идентификатор пользователя.
   *
   * @return string     - имя класса.
   */
  function get_timer_class($end_date, $winner_id, $user_id) {
    $time_count = get_time_to($end_date);
    $sign = date_interval_format($time_count, '%r');
    $result = '';
    
    if (!empty($sign)) {
      $hours = date_interval_format($time_count, '%H');
      $days = date_interval_format($time_count, '%a');
      if (($hours + $days*24) < 1) {
        $result = 'timer--finishing';
      }
    } else {
      $result = 'timer--end';
    }
      
    if ($winner_id === $user_id) {
      $result = 'timer--win';
    }
    
    return $result;
  }
  
  /**
   * Получает прошедшее время и приводит его в читабельный формат.
   *
   * @param \DateTime $date   - Дата.
   * @return string - Строка с оставшимся временем до полуночи.
   */
  function get_timer_past($date) {
    $timer = [];
    $result = '';
    $time_count = get_time_to($date);
    $sign = date_interval_format($time_count, '%r');
    
    if (empty($sign)) {
      $timer['years'] = date_interval_format($time_count, '%y');
      $timer['month'] = date_interval_format($time_count, '%m');
      $timer['days'] = date_interval_format($time_count, '%d');
      $timer['hours'] = date_interval_format($time_count, '%h');
      $timer['minutes'] = date_interval_format($time_count, '%i');
    
      if (intval($timer['years']) > 0) {
        $result = strval($timer['years']) . ' ' . get_noun_plural_form(
          intval($timer['years']),
          "год",
          "года",
          "лет"
        );
      } else if (intval($timer['month']) > 0) {
        $result = strval($timer['month']) . ' ' . get_noun_plural_form(
          intval($timer['month']),
          "месяц",
          "месяца",
          "месяцев"
        );
      } else if (intval($timer['days']) > 0) {
        $result = strval($timer['days']) . ' ' . get_noun_plural_form(
          intval($timer['days']),
          "день",
          "дня",
          "дней"
        );
      } else if (intval($timer['hours']) > 0) {
        $result = strval($timer['hours']) . ' ' . get_noun_plural_form(
          intval($timer['hours']),
          "час",
          "часа",
          "часов"
        );
      } else {
        $result = strval($timer['minutes']) . ' ' . get_noun_plural_form(
          intval($timer['minutes']),
          "минуту",
          "минуты",
          "минут"
        );
      }
    }
    
    return $result;
  }
  
  /**
   * Получает оставшиеся время до полуночи и формирует класс finishing если время до полуночи менее часа.
   *
   * @param \DateTime $date   - Дата.
   * @return string - Наименование класса.
   */
  function get_class_finishing($date) {
    $time_count = get_time_to($date);
    $hours = date_interval_format($time_count, '%H');
    $days = date_interval_format($time_count, '%a');
    if (($hours + $days*24) < 1) {
      return 'timer--finishing';
    }
    return '';
  };
  
  /**
   * Формирует страницу отдаваемую пользователю.
   *
   * @param array $categories   - массив с категориями.
   * @param string $content     - основной контент страницы.
   * @param string $title       - название страницы.
   * @param string $user_name   - имя  текущего пользователя.
   */
  function render_page($categories, $content, $title, $user_name) {
    $layout = include_template('layout.php', [
      'cathegory' => $categories,
      'content' => $content,
      'title' => $title,
      'user_name' => $user_name,
    ]);
    
    print($layout);
    exit;
  };
  
  /**
   * Формирует страницу с ошибкой и прекращает выполнения сценария.
   *
   * @param string $error_text   - ошибка.
   * @param string $title        - название страницы.validation_add_lot
   * @param string $user_name    - имя  текущего пользователя.
   */
  function render_error_db($error_text, $title, $user_name) {
    $content = include_template('error.php', ['error' => $error_text]);
    render_page([], $content, $title, $user_name);
  };
  
  /**
   * Проверяет переданную дату на соответствие формату "ГГГГ-ММ-ДД"
   *
   * Примеры использования:
   * is_date_valid("2019-01-01"); // true
   * is_date_valid("2016-02-29"); // true
   * is_date_valid("2019-04-31"); // false
   * is_date_valid("10.10.2010"); // false
   * is_date_valid("10/10/2010"); // false
   *
   * @param string $date Дата в виде строки
   *
   * @return bool true при совпадении с форматом "ГГГГ-ММ-ДД", иначе false
   */
  function is_date_valid(string $date) : bool {
    $format_to_check = "Y-m-d";
    $dateTimeObj = date_create_from_format($format_to_check, $date);
    
    return $dateTimeObj !== false && array_sum(date_get_last_errors()) === 0;
  }
  
  /**
   * Проверяет корректность формата загружаемых изображений.
   *
   * @param array $file - Массив в данными файла.
   * @param string $key - наименование параметра.
   *
   * @return boolean
   */
  function is_file_valid(array $file) {
    if (isset($file['name']) && !empty($file['name'])) {
      $file_type = mime_content_type($file['tmp_name']);
      if ($file_type == "image/png" || $file_type == "image/jpeg" || $file_type == "image/jpg") {
        return true;
      }
    }
    return false;
  }
  
  /**
   * Загружает файл на сервер.
   *
   * @param array  $file      - данные файла.
   * @param string $filename  - новое имя файла.
   */
  function uploaded_file(array $file, string $filename) {
    if (isset($file['name'])) {
      $tmp_name = $file['tmp_name'];
      move_uploaded_file($tmp_name, 'uploads/' . $filename);
    }
  }
  
  /**
   * Получение расширения сохраняемого файла в зависимости от mime типа.
   *
   * @param string $mimetype - mime тип.
   *
   * @return string mixed - расширение файла.
   */
  function get_file_type(string $mimetype) : string {
    $types = [
      'image/png' => '.png',
      'image/jpeg' => '.jpg',
      'image/jpg' => '.jpg',
    ];
    return $types[$mimetype];
  }
  
  /**
   * Валидация данных отправляемых с формы.
   *
   * @param array $post - данные формы
   * @param array $file - данные файла
   *
   * @return array -
   */
  function validation_add_lot(array $post, array $file) : array {
    $required = ['lot-name', 'category', 'message', 'file', 'lot-rate', 'lot-step', 'lot-date'];
    
    foreach ($required as $key) {
      switch ($key) {
        case 'lot-rate':
          $errors[$key] = empty($post[$key]) || !is_numeric($post[$key]) || $post[$key] <= 0;
          break;
        case 'lot-step':
          $errors[$key] = empty($post[$key]) || !is_numeric($post[$key]) || $post[$key] <= 0;
          break;
        case 'lot-date':
          $errors[$key] = empty($post[$key]) || !is_date_valid($post['lot-date']);
          break;
        case 'file':
          $errors[$key] = !is_file_valid($file);
          break;
        default:
          $errors[$key] = empty($post[$key]);
          break;
      }
    }
    
    return $errors;
  }
  
  /**
   * Валидация формы регистрации пользователя.
   *
   * @param       $DB   - данные подчклюения к БД.
   * @param array $post - данные регистрации пользователя.
   *
   * @return array - массив с ошибками. При остусвтии ошибок возвращает пустой массив.
   */
  function validation_signup_lot($DB, array $post) : array {
    $errors = [];
  
    if (!empty($post['email'])) {
      if (filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
        $sql = 'SELECT id '
          . 'FROM users '
          . 'WHERE email = ? ';
        $check_email = db_fetch_data($DB, $sql, $post['email']);
    
        if (!empty($check_email)) {
          $errors['email'] = 'Пользователь с данным email уже зарегистрирован.';
        }
      } else {
        $errors['email'] = 'Введите корректный email.';
      }
    } else {
      $errors['email'] = 'Введите email пользователя.';
    }
  
    if (empty($post['name'])) {
      $errors['name'] = 'Пользователь с данным email уже зарегистрирован.';
    }
  
    if (empty($post['password'])) {
      $errors['password'] = 'Введите пароль.';
    }
  
    if (empty($post['message'])) {
      $errors['message'] = 'Введите контактные сведения.';
    }
    
    return $errors;
  }
  
  /**
   * Проверка авторизации пользователя.
   * Старт сессии пользователя при осутствии ошибок.
   *
   * @param       $DB   - данные подчклюения к БД.
   * @param array $post - данные авторизации.
   *
   * @return array - массив ошибок. При остусвтии ошибок возвращает пустой массив.
   */
  function start_session($DB, array $post) : array {
    $required = ['email', 'password'];
    $errors = [];
    foreach ($required as $field) {
      if (empty($post[$field])) {
        $errors[$field] = 'Это поле надо заполнить';
      }
    }
  
    if (empty($errors)) {
      $email = mysqli_real_escape_string($DB, $post['email']);
      $sql = 'SELECT * '
        . 'FROM users '
        . 'WHERE email = ?';
  
      $user = db_fetch_data($DB, $sql, $email);
  
      if (!empty($user[0])) {
        if (password_verify($post['password'], $user[0]['password'])) {
          $_SESSION['user'] = $user[0];
        } else {
          $errors['password'] = 'Неверный пароль';
        }
      } else {
        $errors['email'] = 'Пользователь не найден';
      }
    }
    
    return $errors;
  }
  
  /**
   * Проверяет форму добавления ставки.
   *
   * @param array $post     - Новая ставка.
   * @param array $lot      - данные лота.
   *
   * @return array - массив ошибок. При остусвтии ошибок возвращает пустой массив.
   */
  function validation_add_staf($post, array $lot) {
    $errors = [];
    $new_staf = $post['cost'];
    $current_rate = $lot['price'] + $lot['staf_step'];
    
    if (empty($new_staf)) {
      $errors['staf'] = '1';
    } else if (!is_numeric($new_staf)) {
      $errors['staf'] = '2';
    } else if ($new_staf < $current_rate) {
      $errors['staf'] = '3';
    }

    return $errors;
  }
  
  /**
   * Возвращает корректную форму множественного числа
   * Ограничения: только для целых чисел
   *
   * Пример использования:
   * $remaining_minutes = 5;
   * echo "Я поставил таймер на {$remaining_minutes} " .
   *     get_noun_plural_form(
   *         $remaining_minutes,
   *         "минута",
   *         "минуты",
   *         "минут"
   *     );
   * Результат: "Я поставил таймер на 5 минут"
   *
   * @param int $number Число, по которому вычисляем форму множественного числа
   * @param string $one Форма единственного числа: яблоко, час, минута
   * @param string $two Форма множественного числа для 2, 3, 4: яблока, часа, минуты
   * @param string $many Форма множественного числа для остальных чисел
   *
   * @return string Рассчитанная форма множественнго числа
   */
  function get_noun_plural_form (int $number, string $one, string $two, string $many): string
  {
    $number = (int) $number;
    $mod10 = $number % 10;
    $mod100 = $number % 100;
    
    switch (true) {
    case ($mod100 >= 11 && $mod100 <= 20):
      return $many;
    
    case ($mod10 > 5):
      return $many;
    
    case ($mod10 === 1):
      return $one;
    
    case ($mod10 >= 2 && $mod10 <= 4):
      return $two;
    
    default:
      return $many;
    }
  }