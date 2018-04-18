<?php
  session_start();

  include('connect.php');

  $col = $_POST['col'];
  $val = $_POST['val'];

  if ($col == 'userid' || $col == 'email') {
    $sqlcheckunique = "select * from Users where $col=?";
    include($_SERVER['DOCUMENT_ROOT'] . '/PHP/' . $accesstype . '/checkifunique.php');        
  }
  else echo "SQL injection may have been tried. Value received: {" . $col . "}";
?>
