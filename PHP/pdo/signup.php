<?php
  $stmt = $pdo->prepare($sqlinsertuser);
  $res = $stmt->execute(array($userid, $email, $active, $token, $passfail));

  //Once the User is added, the Password should be added as well
  if ($res) {
    $updatetime = date("Y-m-d H:i:s");
    $stmt = $pdo->prepare($sqlinsertpassword);
    $res = $stmt->execute(array($userid, $pwd, $updatetime));

    if ($res) echo "added";
    else echo mysqli_error($connect);
  }
  else echo $res;
?>
