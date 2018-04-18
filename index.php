<html>
  <?php
    session_start();
    $title = 'Database sample';
    include($_SERVER['DOCUMENT_ROOT'] . '/PHP/head.php');
  ?>
  <body>
    <div>Database Sample</div>
    <br>
    <?php
      if ($_SESSION['userid']) include($_SERVER['DOCUMENT_ROOT'] . '/PHP/loggedin.php');
      else include($_SERVER['DOCUMENT_ROOT'] . '/PHP/notloggedin.php');
    ?>
  </body>
</html>
