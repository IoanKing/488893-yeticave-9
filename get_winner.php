<?php
  $update_winners_sql = '';
  $update_winners_data = [];
  
  $winners = db_fetch_data($DB, $query_template['get_winner']);
  if (gettype($winners) !== "array") {
    render_error_db($winners, $title, $user_name);
  }
  
  if (!empty($winners)) {
    mysqli_begin_transaction($DB);
    
    foreach ($winners as $value) {
      $update_winners_sql .= $query_template['set_winner'] . '; ';
      $update_winners_data[] = $value['user'];
      $update_winners_data[] = $value['id'];
  
      $user_email = db_fetch_data(
        $DB, $query_template['get_user_email'], [$value['user']]
      );
      if (gettype($user_email) !== "array") {
        render_error_db($user_email, $title, $user_name);
      }
  
      $lot_id = $value['id'];
      $lot_name = $winners[0]['title'];
      $email = $user_email[0]['email'];
      $email_body = include_template(
        'email.php', [
          'site_adress' => $site_adress,
          'user_name' => $user_name,
          'lot_id' => $lot_id,
          'lot_name' => $lot_name,
        ]
      );
  
      send_mail($email, $email_body);
    }
  
    $update_winners = db_update_data(
      $DB, $update_winners_sql, $update_winners_data
    );
  
    if ($update_winners) {
      mysqli_commit($DB);
    } else {
      mysqli_rollback($DB);
    }
  }
  
