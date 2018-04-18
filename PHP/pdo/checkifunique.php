<?php
  $stmt = $pdo->prepare($sqlcheckunique);
  $stmt->execute(array($val));

  if (!$stmt->fetch()) echo "pass";
  else echo "used";
?>
