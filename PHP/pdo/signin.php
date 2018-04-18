<?php
  $stmt = $pdo->prepare($sqlselectlatestpwd);
  $stmt->execute(array($userid));

  if (!$row = $stmt->fetch()) echo "user doesn't exist";
  else {
    $hashedpwd = $row['pwd'];

    //password_verify hashes the given password and compares
    if (password_verify($pwd, $hashedpwd)) {
      //if PHP detects a previous hashing algorithm used, then ALL the passwords should be updated without changing datetime
      if (password_needs_rehash($hashedpwd, PASSWORD_BCRYPT)) {
        //If the program gets this far, then $userid is a single parameter; no need for a prepared statement
        $hasharray = $pdo->query("select * from Passwords where userid='$userid'");

        //for each row belonging to userid (each of the old passwords remembered), the password is extracted, rehashed, and updated
        while ($hashrow = $hasharray->fetch()) {
          $oldhashpwd = $hashrow['pwd'];
          $newhashpwd = password_hash($oldhashpwd, PASSWORD_BCRYPT);
          $pdo->query("update Passwords set pwd='$newhashpwd' where userid='$userid'");
        }
      }

      //populate $_SESSION
      $_SESSION['userid'] = $row['userid'];
      $_SESSION['email'] = $row['email'];

      echo "pass";
    }
    else echo "fail";
  }
?>
