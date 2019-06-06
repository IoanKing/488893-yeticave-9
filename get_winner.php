<?php
    $update_winners_sql = '';
    $update_winners_user = '';
    $update_winners_id = '';
    $lot_name = '';
    $update_results = true;
    
    $winners = db_fetch_data(
        $DB,
        isset($query_template['get_winner']) ? $query_template['get_winner']
        : ''
    );
    if (gettype($winners) !== "array") {
        render_error_db($winners, $title, $user_name);
    }
    
    if (!empty($winners)) {
        mysqli_begin_transaction($DB);
        
        $update_winners_sql = isset($query_template['set_winner'])
          ? $query_template['set_winner'] : '';
        
        foreach ($winners as $value) {
            $update_winners_user = isset($value['user']) ? $value['user']
              : '';
            $update_winners_id = isset($value['id']) ? $value['id'] : '';
            
            $user_email = db_fetch_data(
                $DB,
                isset($query_template['get_user_email'])
                ? $query_template['get_user_email'] : '',
                [isset($value['user']) ? $value['user'] : '']
            );
            if (gettype($user_email) !== "array") {
                render_error_db($user_email, $title, $user_name);
            }
            
            $lot_id = isset($value['id']) ? $value['id'] : '';
            $lot_name = isset($value['title']) ? $value['title'] : '';
            $email = isset($user_email[0]['email']) ? $user_email[0]['email']
              : '';
            $email_body = include_template(
                'email.php',
                [
                'site_adress' => $site_adress,
                'user_name' => $user_name,
                'lot_id' => $lot_id,
                'lot_name' => $lot_name,
              ]
            );
            
            send_mail($email, $email_body);
            
            $update_winners = db_update_data(
                $DB,
                $update_winners_sql,
                [$update_winners_user, $update_winners_id]
            );
            
            if (!empty($update_winners)) {
                $update_results = false;
            }
        }
        
        if ($update_results) {
            mysqli_commit($DB);
        } else {
            mysqli_rollback($DB);
        }
    }
