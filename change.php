<html>
  <?php
    session_start();
    $title = 'Database sample - change';
    include($_SERVER['DOCUMENT_ROOT'] . '/PHP/head.php');
  ?>
  <body>
    <div>Database Sample - Change Password</div>
    <br>
    <div id='errmsg' style='opacity: 0; background: #ff0000; color: #ffffff; width: 100%; line-height: 25px;'>&nbsp;</div>
    <div style='width: 80%; margin: 0px auto; text-align: center;'>
      <?php
        if (isset($_GET['token'])) {
            include($_SERVER['DOCUMENT_ROOT'] . '/PHP/connect.php');

            $token = $_GET['token'];
            $sqlchecktoken = "select * from Users where token=?";
            include($_SERVER['DOCUMENT_ROOT'] . '/PHP/' . $accesstype . '/checktoken.php');
        }
        else "You must click on the link provided on your email to change your password. Click <a href='reset.php'>here</a> if you need to request a password token again";
      ?>
    </div>
  </body>
</html>
