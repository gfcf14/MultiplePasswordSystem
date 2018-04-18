<?php
  if ($stmt = mysqli_prepare($connect, $sqlresetuser)) {
    mysqli_stmt_bind_param($stmt, "s", $userid);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);

    //if the row is not populated, then the userid doesn't exist
    if (!$row = mysqli_fetch_assoc($res)) echo "fail";
    else {
      if ($email == $row['email']) {
        $emailtype = 'reset';
        include($_SERVER['DOCUMENT_ROOT'] . '/PHP/email.php');
        echo ($recoverytimelimit / 60);
      }
      else echo "fail";
    }
  }
?>
