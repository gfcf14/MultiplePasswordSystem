<?php
  include('connect.php');

  $newpwd = $_POST['newpwd'];
  $token = $_POST['token'];

  $sqlgetbytoken = "select * from Licenses where token=?";
  include($_SERVER['DOCUMENT_ROOT'] . '/PHP/' . $accesstype . '/changepassword.php');
?>
