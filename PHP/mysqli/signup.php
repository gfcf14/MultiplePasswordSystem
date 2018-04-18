<?php
  if ($stmt = mysqli_prepare($connect, $sqlinsertuser)) {
    mysqli_stmt_bind_param($stmt, "ssssi", $userid, $email, $active, $token, $passfail);
    $res = mysqli_stmt_execute($stmt);

    //Once the User is added, the Password should be added as well
    if ($res) {
      $updatetime = date("Y-m-d H:i:s");

      if ($stmt = mysqli_prepare($connect, $sqlinsertpassword)) {
        mysqli_stmt_bind_param($stmt, "sss", $userid, $pwd, $updatetime);
        $res = mysqli_stmt_execute($stmt);

        if ($res) echo "added";
        else echo mysqli_error($connect);
      }
    }
    else echo mysqli_error($connect);
  }
?>
