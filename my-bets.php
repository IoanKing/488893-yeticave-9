<?php
    require_once(__DIR__ . '/init.php');
    
    $title = 'Мои ставки';
    
    if (!$DB) {
        $errors = mysqli_connect_error();
        render_error_db($errors, $title, $user_name);
    }
    
    $categories = db_fetch_data(
        $DB,
        isset($query_template['cathegory']) ? $query_template['cathegory'] : ''
    );
    if (gettype($categories) !== "array") {
        render_error_db($categories, $title, $user_name);
    }
    
    if (empty($user_name)) {
        $content = include_template(
            '403.php',
            [
            'cathegory' => $categories ?? [],
          ]
        );
        render_page($categories, $content, $title, $user_name);
    }
    
    $user_rates = db_fetch_data(
        $DB,
        isset($query_template['my_bets']) ? $query_template['my_bets'] : '',
        $user_id
    );
    if (gettype($categories) !== 'array') {
        render_error_db($user_rates, $title, $user_name);
    }
    
    $nav_list = include_template('nav-list.php', [
      'cathegory' => $categories,
      'cathegory_id' => isset($cathegory_id) ? $cathegory_id : null,
    ]);
    
    $content = include_template(
        'my-bets.php',
        [
        'user_rates' => $user_rates ?? [],
        'user_id' => $user_id,
        'nav_list' => $nav_list,
      ]
    );
    
    render_page($content, $title, $user_name, $nav_list);
