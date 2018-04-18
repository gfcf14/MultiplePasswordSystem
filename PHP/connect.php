<?php
  $host_name = '*****';
  $database = '*****';
  $user_name = '*****';
  $password = '*****';

  //Since all PHP files dealing with the database use this file, "global" variables could be defined here
  include('globals.php');
  include($_SERVER['DOCUMENT_ROOT'] . '/PHP/' . $accesstype . '/connect.php');
?>
