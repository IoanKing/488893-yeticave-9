<?php
    require_once(__DIR__ . '\init.php');
    
    $title = 'Категории';
    $adverts = [];
    $pagination = [];
    
    $get = $_GET;
    $cathegory_id = isset($get['id']) ? intval($get['id']) : null;
    $cathegory_name = '';
    $page = isset($get['page']) ? intval($get['page'] ?? 1) : 1;
    
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
    
    $cath_name = db_fetch_data(
        $DB,
        isset($query_template['cathegory_name_by_id'])
        ? $query_template['cathegory_name_by_id'] : '',
        $cathegory_id
    );
    if (gettype($cath_name) !== "array") {
        render_error_db($cath_name, $title, $user_name);
    }
    
    $cathegory_name = isset($cath_name[0]['name']) ? $cath_name[0]['name'] : '';
    
    $count_adverts = db_fetch_data(
        $DB,
        isset($query_template['lot_by_cathegory_count'])
        ? $query_template['lot_by_cathegory_count'] : '',
        $cathegory_id
    );
    if (gettype($count_adverts) !== "array") {
        render_error_db($count_adverts, $title, $user_name);
    }
    
    if (isset($count_adverts[0]['count'])) {
        $pages_count = intval(ceil($count_adverts[0]['count']
          / $limit_per_page));
        
        if ($count_adverts[0]['count'] > 0) {
            $offset = ($page - 1) * $limit_per_page;
            $pagination = range(1, $pages_count);
            
            $adverts = db_fetch_data(
                $DB,
                isset($query_template['lot_by_cathegory'])
                ? $query_template['lot_by_cathegory'] : '',
                [$cathegory_id, $limit_per_page, $offset]
            );
            if (gettype($adverts) !== "array") {
                render_error_db($adverts, $title, $user_name);
            }
        }
    }
    
    $nav_list = include_template('nav-list.php', [
      'cathegory' => $categories,
      'cathegory_id' => isset($cathegory_id) ? $cathegory_id : null,
    ]);
    
    $content = include_template(
        'cathegory.php',
        [
        'adverts' => $adverts ?? [],
        'page' => $page,
        'cathegory_name' => $cathegory_name ?? '',
        'cathegory_id' => $cathegory_id ?? '',
        'pagination' => $pagination,
        'nav_list' => $nav_list,
      ]
    );
    
    render_page($content, $title, $user_name, $nav_list);
