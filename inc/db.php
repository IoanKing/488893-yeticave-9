<?php
  
  $query_template = [
    'cathegory' => 'SELECT id, name, code '
      .'FROM cathegory ',
    'lot' => 'SELECT l.id, title, description, picture, start_price, staf_step, c.name AS cathegory, end_date '
      .'FROM lots AS l '
      .'JOIN cathegory AS c ON l.category_id = c.id '
      .'WHERE end_date > NOW() OR end_date IS NULL '
      .'ORDER BY create_date DESC ',
    'lot_full' => 'SELECT l.id, title, start_price, picture, IFNULL(MAX(s1.amount), start_price) AS price, staf_step, c.name AS cathegory, end_date, description '
      .'FROM lots AS l '
      .'JOIN cathegory AS c ON l.category_id = c.id '
      .'LEFT JOIN user_staf s1 ON s1.lot_id = l.id '
      .'WHERE l.id = ? '
      .'GROUP BY id, title, start_price, staf_step, picture, c.name, end_date, description '
      .'ORDER BY create_date DESC ',
    'lot_by_id' => 'SELECT title, description, picture, start_price, staf_step, c.name AS cathegory '
      .'FROM lots AS l '
      .'JOIN cathegory AS c ON l.category_id = c.id '
      .'WHERE l.id = ? ',
    'staf_history' => 'SELECT u.name, amount, staf_date '
      .'FROM lots AS l '
      .'JOIN user_staf s ON l.id = s.lot_id '
      .'JOIN users u ON s.user_id = u.id '
      .'WHERE l.id = ? '
      .'ORDER BY staf_date DESC '
      .'LIMIT 10 ',
    'create_lot' => 'INSERT '
      .'INTO lots '
      .'(title, description, picture, start_price, staf_step, user_id, category_id, create_date, end_date) VALUES '
      .'(?, ?, ?, ?, ?, ?, ?, ?, ?) '
  ];
  
  /**
   * Выполнение подключения к БД.
   *
   * @param string $host_name     - Имя хоста
   * @param string $user_name     - Имя пользователя
   * @param string $pass          - Пароль
   * @param string $database_name - Имя БД
   *
   * @return false|mysqli
   */
  function init_connection(string $host_name, string $user_name, string $pass, string $database_name) {
    $connect = mysqli_connect($host_name, $user_name, $pass, $database_name);
    mysqli_set_charset($connect, "utf8");
    return $connect;
  }
  
  /**
   * Создает подготовленное выражение на основе готового SQL запроса и переданных данных
   *
   * @param mysqli $link   - Ресурс соединения
   * @param string $sql    - SQL запрос с плейсхолдерами вместо значений
   * @param array $data    - Данные для вставки на место плейсхолдеров
   *
   * @return false|mysqli_stmt - Подготовленное выражение
   */
  function db_get_prepare_stmt($link, $sql, $data = []) {
    $stmt = mysqli_prepare($link, $sql);
    
    if ($stmt === false) {
      return $stmt;
    }
    
    if ($data) {
      $types = "";
      $stmt_data = [];
      
      foreach ($data as $value) {
        $type = "s";
        
        if (is_int($value)) {
          $type = "i";
        }
        else if (is_string($value)) {
          $type = "s";
        }
        else if (is_double($value)) {
          $type = "d";
        }
        
        if ($type) {
          $types .= $type;
          $stmt_data[] = $value;
        }
      }
      
      $values = array_merge([$stmt, $types], $stmt_data);
      
      $func = "mysqli_stmt_bind_param";
      $func(...$values);
    }
    
    return $stmt;
  }
  
  /**
   * Подготовка и выполнение запроса к БД - получение записей.
   *
   * @param mysqli $link   - Ресурс соединения
   * @param string $sql    - SQL запрос с плейсхолдерами вместо значений
   * @param array $data    - Данные для вставки на место плейсхолдеров
   *
   * @return array|string
   */
  function db_fetch_data($link, $sql, $data = []) {
    $result = [];
    
    if (is_string($data) || is_int($data)) {
      $data = [$data];
    }
  
    $stmt = db_get_prepare_stmt($link, $sql, $data);
    
    if (!$stmt) {
      return "Не удалось сформировать подготовленное выражение для запроса к БД. ";
    }
    
    if ($stmt->errno > 0) {
      return "Не удалось связать подготовленное выражение с параметрами: " . $stmt->error;
    };
    
    $res = mysqli_stmt_execute($stmt);
    
    if (!$res) {
      return mysqli_stmt_error($stmt);
    }
    
    $res = mysqli_stmt_get_result($stmt);
    
    if ($res) {
      $result = mysqli_fetch_all($res, MYSQLI_ASSOC);
    }
    
    return $result;
  }
  
  /**
   * Подготовка и выполнение запроса к БД - добавление записей.
   *
   * @param mysqli $link   - Ресурс соединения
   * @param string $sql    - SQL запрос с плейсхолдерами вместо значений
   * @param array $data    - Данные для вставки на место плейсхолдеров
   *
   * @return false|INT - id записи в БД
   */
  function db_insert_data($link, $sql, $data = []) {
    $stmt = db_get_prepare_stmt($link, $sql, $data);
  
    if (!$stmt) {
      return "Не удалось сформировать подготовленное выражение для запроса к БД. ";
    }
  
    if ($stmt->errno > 0) {
      return "Не удалось связать подготовленное выражение с параметрами: " . $stmt->error;
    };
    
    $result = mysqli_stmt_execute($stmt);
    
    if ($result) {
      $result = mysqli_insert_id($link);
    } else {
      return mysqli_stmt_error($stmt);
    }
    
    return $result;
  }
