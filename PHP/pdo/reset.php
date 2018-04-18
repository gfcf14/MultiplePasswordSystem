<?php
  $stmt = $pdo->prepare($sqlresetuser);
  $stmt->execute(array($userid));

  if (!$row = $stmt->fetch()) echo "fail";
  else {
    if ($email == $row['email']) {
      $emailtype = 'reset';
      include($_SERVER['DOCUMENT_ROOT'] . '/PHP/email.php');
      echo ($recoverytimelimit / 60);
    }
    else echo "fail";
  }
?>
