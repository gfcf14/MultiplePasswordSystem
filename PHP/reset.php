<?php
  $userid = $_POST['userid'];
  $email = $_POST['email'];

  include('connect.php');

  $sqlresetuser = "select * from Users where userid=?";
  include($_SERVER['DOCUMENT_ROOT'] . '/PHP/' . $accesstype . '/reset.php');
?>
