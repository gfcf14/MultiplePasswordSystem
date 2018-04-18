<div style='width: 100%; padding: 10px 0px; border: 1px solid #cccccc;'>
  <button onclick='showSignUp();'>SIGN UP</button>
  <button onclick='showSignIn();'>SIGN IN</button>
</div>
<div id='errmsg' style='opacity: 0; background: #ff0000; color: #ffffff; width: 100%; line-height: 25px;'>&nbsp;</div>
<div id='signupdiv' style='position: absolute; width: 90%; margin: 0px auto; text-align: left; display: none; border: 1px solid #cccccc;'>
  <div style='width: 90%; margin: 0px auto; padding-bottom: 10px;'>
    <div>Id:</div>
    <input id='suuserid' type='text' placeholder='Enter ID' style='width: 100%; text-transform: uppercase;'>
    <br><br>
    <div>Email:</div>
    <input id='suemail' type='text' placeholder='email@example.com' style='width: 100%;'>
    <br><br>
    <div>Password:</div>
    <input id='supwd' type='password' placeholder='Enter password' style='width: 100%;'>
    <br><br>
    <button id='regbtn' type='button' style='width: 100%;' onclick='signUp();' disabled='disabled'>REGISTER</button>
    <br>
  </div>
</div>
<div id='signindiv' style='position: absolute; width: 90%; margin: 0px auto; text-align: left; display: none; border: 1px solid #cccccc;'>
  <div style='width: 90%; margin: 0px auto; padding-bottom: 10px;'>
    <div>Id:</div>
    <input id='siuserid' type='text' placeholder='Enter ID' style='width: 100%; text-transform: uppercase;'>
    <br><br>
    <div>Password:</div>
    <input id='sipwd' type='password' placeholder='Enter password' style='width: 100%;'>
    <br><br>
    <a href='reset.php'>Click here to reset your password</a>
    <br><br>
    <button id='signinbtn' type='button' style='width: 100%;' onclick='signIn();' disabled='disabled'>SIGN IN</button>
    <br>
  </div>
</div>
