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
    exit;
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
  
      if (!empty($user)) {
        if (password_verify($post['password'], $user['password'])) {
          $_SESSION['user'] = $user;
        } else {
          $errors['password'] = 'Неверный пароль';
        }
      } else {
        $errors['email'] = 'Пользователь не найден';
      }
    }
    
    return $errors;
  }