<?php
  if ($stmt = mysqli_prepare($connect, $sqlchecktoken)) {
    mysqli_stmt_bind_param($stmt, "s", $token);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($res)) {
      //convert the date from the db using strtotime and get current date with idateu
      $datethen = strtotime($row['resettime']);
      $datenow = idate(U);

      if ($datenow - $datethen < $recoverytimelimit) include($_SERVER['DOCUMENT_ROOT'] . '/PHP/changepasswordform.php');
      else echo "This password token has expired. Click <a href='reset.php'>here</a> to request a password token again";
    }
    else echo "The token provided is not valid. Your password will not be changed unless you provide a valid one";
  }
?>
