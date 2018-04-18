<?php
if ($stmt = mysqli_prepare($connect, $sqlgetbytoken)) {
  mysqli_stmt_bind_param($stmt, "s", $token);
  mysqli_stmt_execute($stmt);
  $res = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($res)) {
    $userid = $row['userid'];

    $pwdres = mysqli_query($connect, "select * from Passwords where userid='$userid'");
    $pwds = mysqli_num_rows($pwdres);

    $pwdmatch = false;
    while ($storedpwdrow = mysqli_fetch_assoc($pwdres)) {
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
        $oldestpwdres = mysqli_query($connect, "select * from Passwords where userid='$userid' order by updatetime asc limit 1");
        $pwdrow = mysqli_fetch_assoc($oldestpwdres);
        $oldpwd = $pwdrow['pwd'];

        mysqli_query($connect, "update Passwords set pwd='$newpwd', updatetime='$updatedtime' where userid='$userid' and pwd='$oldpwd'");
      }
      else mysqli_query($connect, "insert into Passwords (userid, pwd, updatetime) values ('$userid','$newpwd','$updatedtime')");

      mysqli_query($connect, "update Users set token='none', passfail=0, locktime=NULL, resettime=NULL where userid='$userid'");
      echo 'changed';
    }
    else echo 'same';
  }
}
?>
