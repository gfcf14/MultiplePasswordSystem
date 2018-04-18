<?php
  if ($stmt = mysqli_prepare($connect, $sqlcheckunique)) {
    mysqli_stmt_bind_param($stmt, "s", $val);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);

    if (!$row = mysqli_fetch_assoc($res)) echo "pass";
    else echo "used";
  }
?>
