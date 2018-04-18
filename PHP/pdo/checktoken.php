<?php
  $stmt = $pdo->prepare($sqlchecktoken);
  $stmt->execute(array($token));

  if ($row = $stmt->fetch()) {
    //convert the date from the db using strtotime and get current date with idateu
    $datethen = strtotime($row['resettime']);
    $datenow = idate(U);

    if ($datenow - $datethen < $recoverytimelimit) include($_SERVER['DOCUMENT_ROOT'] . '/PHP/changepasswordform.php');
    else echo "This password token has expired. Click <a href='reset.php'>here</a> to request a password token again";
  }
  else echo "The token provided is not valid. Your password will not be changed unless you provide a valid one";
?>
