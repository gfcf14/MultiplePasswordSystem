<?php
  $connect = mysqli_connect($host_name, $user_name, $password, $database);
  $db_selected = mysqli_select_db($connect, $database);

  if ($db_selected) {
    $table = 'Users';
    $tableExists = mysqli_query($connect, "select * from $table");
    if (!$tableExists) include('createusers.php');

    $table = 'Passwords';
    $tableExists = mysqli_query($connect, "select * from $table");
    if (!$tableExists) include('createpasswords.php');
  }
?>
