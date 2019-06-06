<?php
    require_once(__DIR__ . '/init.php');
    
    $title = 'Авторизация';
    
    if (!$DB) {
        $errors = mysqli_connect_error();
        render_error_db($errors, $title, $user_name);
    }
    
    $categories = db_fetch_data($DB, $query_template['cathegory']);
    if (gettype($categories) !== 'array') {
        render_error_db($categories, $title, $user_name);
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $post = $_POST;
        $errors = start_session($DB, $post);
        
        if (empty($errors)) {
            header('Location: index.php');
            exit();
        }
    }
    
    $nav_list = include_template('nav-list.php', [
      'cathegory' => $categories,
      'cathegory_id' => isset($cathegory_id) ? $cathegory_id : null,
    ]);
    
    $content = include_template(
        'login.php',
        [
        'post' => $post,
        'error' => $errors,
        'nav_list' => $nav_list,
      ]
    );
    
    render_page($content, $title, $user_name, $nav_list);
