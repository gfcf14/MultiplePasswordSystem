<div>Password requirements: ---. Password must be different from the <div id='pwdtotal' style='display: inline-block;'><?php echo $passwordtotal; ?></div> previously used passwords</div>
<br><br>
<div>Enter your new Password:</div>
<input id='cpwd1' type='password'>
<br><br>
<div>Enter your new password Again:</div>
<input id='cpwd2' type='password'>
<br><br>
<input id='ptoken' type='hidden' value='<?php echo $token; ?>' />
<button id='cbtn' type='button' onclick='changePassword();' disabled='disabled'>Change Password</button>
