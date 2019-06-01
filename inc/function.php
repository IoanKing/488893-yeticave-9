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
  function esc($str): string {
    $text = '';
    if (!empty($str)) {
      $text = htmlspecialchars($str);
    }
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
  function get_timer_lelt($date, $is_short = false) : string {
    $main_text = 'Торги завершены';
    
    $time_count = get_time_to($date);
    $sign = date_interval_format($time_count, '%r');
    $minutes = (!empty($sign)) ? date_interval_format($time_count, '%I') : 0;
    $hours = (!empty($sign)) ? date_interval_format($time_count, '%H') : 0;
    $days = (!empty($sign)) ? date_interval_format($time_count, '%a') : 0;
    $seconds = (!empty($sign)) ? date_interval_format($time_count, '%S') : 0;
    
    $count_day = ($days === 0) ? '00' : ($days < 10) ? '0' . $days : $days;
    $count_hours_left = $hours + $days*24;
    
    if (!empty($sign)) {
      if ($is_short) {
        $main_text = strval($count_hours_left) . ":" . strval($minutes);
      } else {
        $main_text = $count_day . ":" . strval($hours) . ':'
          . strval($minutes);
      }
    }
    
    return $main_text;
  };
  
  /**
   * Получает оставшиеся время до полуночи и формирует класс finishing если время до полуночи менее часа.
   *
   * @param \DateTime $date   - Дата.
   * @return string - Наименование класса.
   */
  function get_class_finishing($date) {
    if (isset($date)) {
      $time_count = get_time_to($date);
      $hours = date_interval_format($time_count, '%H');
      $days = date_interval_format($time_count, '%a');
  
      $count_hours_left = $hours + $days*24;
      
      if ($count_hours_left < 24) {
        return 'timer--finishing';
      }
    }
    return '';
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
  
      $count_hours_left = $hours + $days*24;
      
      if ($count_hours_left < 24) {
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
      $timer['days'] = date_interval_format($time_count, '%a');
      $timer['hours'] = date_interval_format($time_count, '%h');
      $timer['minutes'] = date_interval_format($time_count, '%i');
    
      if (intval($timer['days']) > 0) {
        $result = date_format( date_create($date), "d.m.y в H:i");
      } else if (intval($timer['hours']) > 0) {
        $result = strval($timer['hours']) . ' ' . get_noun_plural_form(
          intval($timer['hours']),
          "час назад",
          "часа назад",
          "часов назад"
        );
      } else {
        $result = strval($timer['minutes']) . ' ' . get_noun_plural_form(
          intval($timer['minutes']),
          "минуту назад",
          "минуты назад",
          "минут назад"
        );
      }
    }
    
    return $result;
  }
  
  /**
   * Получает количество ставок и приводит его в читабельный формат.
   *
   * @param number $count   - Количество ставок.
   * @return string         - Строка с количествоv ставок.
   */
  function get_staf_count($count) : string {
    if (empty($count)) {
      $result = 'Стартовая цена';
    } else {
      switch ($count) {
        case $count === 1:
          $result = '1 ставка';
          break;
        case $count%10 > 1 && $count%10 < 5:
          $result = $count . ' ставки';
          break;
      default:
        $result = $count . ' ставок';
        break;
      }
    }
    return $result;
  }
  
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
   * @param string $title        - название страницы.
   * @param string $user_name    - имя  текущего пользователя.
   */
  function render_error_db($error_text, $title, $user_name) {
    $content = include_template('error.php', ['content' => $error_text]);
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
   * @return array - массив с ошибками.
   */
  function validation_add_lot($post, $file) : array {
    $required = ['lot-name', 'category', 'message', 'file', 'lot-rate', 'lot-step', 'lot-date'];
    
    foreach ($required as $key) {
      switch ($key) {
        case 'lot-name':
          if (empty($post[$key])) {
            $errors[$key] = 'Введите наименование лота.';
          } else if (strlen($post[$key]) > 255) {
            $errors[$key] = 'Длина наименования лота не должна превышать 255 символов!';
          }
          break;
        case 'category':
          if (empty($post[$key])) {
            $errors[$key] = 'Выберите категорию.';
          }
          break;
        case 'message':
          if (empty($post[$key])) {
            $errors[$key] = 'Введите описание лота.';
          } else if (strlen($post[$key]) > 1200) {
            $errors[$key] = 'Длина описания лота не должна превышать 1200 символов!';
          }
          break;
        case 'lot-rate':
          if (empty($post[$key])) {
            $errors[$key] = 'Введите Начальную цену.';
          } else if (!is_numeric($post[$key])) {
            $errors[$key] = 'Цена должна быть числом!';
          }
          break;
        case 'lot-step':
          if (empty($post[$key])) {
            $errors[$key] = 'Введите Шаг ставки.';
          } else if (!is_numeric($post[$key])) {
            $errors[$key] = 'Шаг ставки должен быть числом!';
          }
          break;
        case 'lot-date':
          if (empty($post[$key])) {
            $errors[$key] = 'Выберите дату.';
          } else if (!is_date_valid($post[$key])) {
            $errors[$key] = 'Дата должна быть в формате ГГГГ-ММ-ДД';
          } else if (strtotime($post[$key]) <= strtotime(date("Y-m-d"))) {
            $errors[$key] = 'Указанная дата больше текущей даты, хотя бы на один день.';
          }
          break;
        case 'file':
          if (gettype($file) !== 'NULL') {
            $errors[$key] = (!is_file_valid($file)) ? 'Выберите файл в формате jpg, jpeg, png' : '';
          } else {
            $errors[$key] = 'Выберите файл.';
          }
          break;
        default:
          $errors[$key] = 'Ошибка. Неопределенное поле.';
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
  function validation_signup($DB, array $post) : array {
    $errors = [];
    
    if (isset($post['email']) && !empty($post['email'])) {
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
  
    if (!isset($post['name']) || empty($post['name'])) {
      $errors['name'] = 'Введите имя пользователя.';
    } else if (strlen($post['name']) > 128) {
      $errors['name'] = 'Имя пользователя не должно превышать 128 символов.';
    }
  
    if (!isset($post['password']) || empty($post['password'])) {
      $errors['password'] = 'Введите пароль.';
    } else if (strlen($post['password']) > 64) {
      $errors['password'] = 'Пароль не должен превышать 64 символа.';
    }
  
    if (!isset($post['message']) || empty($post['message'])) {
      $errors['message'] = 'Введите контактные сведения.';
    } else if (strlen($post['password']) > 560) {
      $errors['message'] = 'Контасткные сведения не должны превышать 560 символов.';
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
          $errors['sign_up'] = 'Вы ввели неверный email/пароль';
        }
      } else {
        $errors['sign_up'] = 'Вы ввели неверный email/пароль';
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
  
  /**
   * Отправка сообщения на email.
   *
   * @param $email - адрес получателя.
   * @param $body  - тело письма.
   */
  function send_mail($email, $body) {
    $transport = new Swift_SmtpTransport('phpdemo.ru', 25);
    $transport->setUserName('keks@phpdemo.ru');
    $transport->setPassword('htmlacademy');
  
    $message = new Swift_Message("Ваша ставка победила");
    $message->setTo($email);
    $message->setBody($body, 'text/html');
    $message->setFrom('keks@phpdemo.ru', 'phpdemo');
  
    $mailer = new Swift_Mailer($transport);
    $logger = new Swift_Plugins_Loggers_ArrayLogger();
    $mailer->registerPlugin(new Swift_Plugins_LoggerPlugin($logger));
    $mailer->send($message);
  };