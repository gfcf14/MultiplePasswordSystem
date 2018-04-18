<?php
  $stmt = $pdo->prepare($sqlgetbytoken);
  $stmt->execute(array($token));

  if ($row = $stmt->fetch()) {
    $userid = $row['userid'];

    $pwdres = $pdo->query("select * from Passwords where userid='$userid'");
    $pwds = $pwdres->rowCount();

    $pwdmatch = false;
    while ($storedpwdrow = $pwdres->fetch()) {
      if (password_verify($newpwd, $storedpwdrow['pwd'])) {
        $pwdmatch = true;
        break;
      }
    }

    if (!$pwdmatch) {
      //To test how passwords change, you could comment out the line below
      $newpwd = password_hash($newpwd, PASSWORD_BCRYPT);
      $updatedtime = date("Y-m-d H:i:s");

      //if the total count of the passwords is equal to the password total to be remembered, the oldest one must be overwritten
      if ($pwds == $passwordtotal) {
        $oldestpwdres = $pdo->query("select * from Passwords where userid='$userid' order by updatetime asc limit 1");
        $pwdrow = $oldestpwdres->fetch();
        $oldpwd = $pwdrow['pwd'];

        $pdo->query("update Passwords set pwd='$newpwd', updatetime='$updatedtime' where userid='$userid' and pwd='$oldpwd'");
      }
      else $pdo->query("insert into Passwords (userid, pwd, updatetime) values ('$userid','$newpwd','$updatedtime')");

      $pdo->query("update Users set token='none', passfail=0, locktime=NULL, resettime=NULL where userid='$userid'");
      echo 'changed';
    }
    else echo 'same';
  }
?>
