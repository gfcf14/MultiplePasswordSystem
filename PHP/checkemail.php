<?php
  $email = $_POST['email'];

  if (isset($_POST['app'])) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) echo 'valid';
    else echo 'notvalid';
  }
?>
