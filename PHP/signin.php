<?php
  session_start();

  include('connect.php');

  $userid = $_POST['userid'];
  $pwd = $_POST['pwd'];

  //The query will check if there are any passwords for userid, and will get the latest one
  $sqlselectlatestpwd = "select * from Passwords where userid=? order by updatetime desc limit 1";
  include($_SERVER['DOCUMENT_ROOT'] . '/PHP/' . $accesstype . '/signin.php');
?>
