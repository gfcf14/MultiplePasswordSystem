<?php
  $pdo = new PDO("mysql:host=$host_name; dbname=$database", $user_name, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $table = 'Users';
  try {
    $sql = $pdo->prepare("select * from $table");
    $sql->execute();
  } catch (Exception $e) {
    include('createusers.php');
  }

  $table = 'Passwords';
  try {
    $sql = $pdo->prepare("select * from $table");
    $sql->execute();
  } catch (Exception $e) {
    include('createpasswords.php');
  }
?>
