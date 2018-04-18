<html>
  <?php
    session_start();
    $title = 'Database sample - reset';
    include($_SERVER['DOCUMENT_ROOT'] . '/PHP/head.php');
  ?>
  <body>
    <div>Database Sample - Reset</div>
    <br>
    <div style='width: 80%; margin: 0px auto; text-align: center;'>
      <div>Enter your information:</div>
      <br><br>
      <div>User ID:</div>
      <input id='ruserid' type='text'>
      <br><br>
      <div>Email:</div>
      <input id='remail' type='text'>
      <br><br>
      <button id='rbtn' type='button' onclick='sendToken();' disabled='disabled'>Request reset token</button>
    </div>
  </body>
</html>
