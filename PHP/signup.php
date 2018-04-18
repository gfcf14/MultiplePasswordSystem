<?php
  session_start();

  include('connect.php');

  $userid = $_POST['userid'];
  $email = $_POST['email'];
  $pwd = $_POST['pwd'];
  //The password is hashed as per PHP's latest Bcrypt algorithm, to avoid storing as plain text
  //To test, you could comment out this line
  $pwd = password_hash($pwd, PASSWORD_BCRYPT);
  $active = '';
  $token = 'none';
  $passfail = 0;

  //this loop generates a sort of random hash to avoid faking a key
  for ($i = 0; $i < 60; $i++) {
    $active .= $key[random_int(0, mb_strlen($key, '8bit') - 1)];
  }

  $sqlinsertuser = "insert into Users (userid, email, active, token, passfail) values (?,?,?,?,?)";
  $sqlinsertpassword = "insert into Passwords (userid, pwd, updatetime) values (?,?,?)";
  include($_SERVER['DOCUMENT_ROOT'] . '/PHP/' . $accesstype . '/signup.php');
?>
