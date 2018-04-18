<?php
  if ($stmt = mysqli_prepare($connect, $sqlselectlatestpwd)) {
    mysqli_stmt_bind_param($stmt, "s", $userid);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);

    //if the row is not populated, then the userid doesn't exist
    if (!$row = mysqli_fetch_assoc($res)) echo "fail";
    else {
      $hashedpwd = $row['pwd'];

      //password_verify hashes the given password and compares
      if (password_verify($pwd, $hashedpwd)) {
        //if PHP detects a previous hashing algorithm used, then ALL the passwords should be updated without changing datetime
        if (password_needs_rehash($hashedpwd, PASSWORD_BCRYPT)) {
          //If the program gets this far, then $userid is a single parameter; no need for a prepared statement
          $res = mysqli_query($connect, "select * from Passwords where userid='$userid'");

          //for each row belonging to userid (each of the old passwords remembered), the password is extracted, rehashed, and updated
          while ($hashrow = mysqli_fetch_assoc($res)) {
            $oldhashpwd = $hashrow['pwd'];
            $newhashpwd = password_hash($oldhashpwd, PASSWORD_BCRYPT);
            mysqli_query($connect, "update Passwords set pwd='$newhashpwd' where userid='$userid'");
          }
        }

        //populate $_SESSION
        $_SESSION['userid'] = $row['userid'];
        $_SESSION['email'] = $row['email'];

        echo "pass";
      }
      else echo "fail";
    }
  }
?>
