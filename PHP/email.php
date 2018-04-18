<?php
  $headers = "MIME-Version: 1.0" ."\r\n" .
             "Content-Type: text/html; charset=iso-8859-1" . "\r\n" .
             "From: admin@yourcompany.com" . "\r\n" .
             "Reply-To: admin@yourcompany.com" . "\r\n" .
             "X-Mailer: PHP/" . phpversion();
  $to = $email;
  $subject = "Database Sample - ";


  if ($emailtype == 'reset') {
    $resettoken = '';
    for ($i = 0; $i < 60; $i++) {
      $resettoken .= $key[random_int(0, mb_strlen($key, '8bit') - 1)];
    }

    $sqlupdatetoken = "update Users set token='$resettoken' where userid='$userid'";
    $datelimit = date("Y-m-d H:i:s");
    $sqlupdateresettime = "update Users set resettime='$datelimit' where userid='$userid'";
    include($_SERVER['DOCUMENT_ROOT'] . '/PHP/' . $accesstype . '/settoken.php');

    $link = 'http://yoursite.com/change.php?token=' . $resettoken;

    $subject .= "Password change";

    $message = 'DATABASE SAMPLE' .
               '<br><br>' .
               '<div>You have received this email because you requested a password token. To reset your password, please click here:</div>' .
               '<br><br>' .
               "<a href='$link'>$link</a>" .
               '<br><br>' .
               '<div>This token will expire in ' . ($recoverytimelimit / 60) . ' minutes, so please click it soon.';

    @mail($to, $subject, $message, $headers);
  }
?>
