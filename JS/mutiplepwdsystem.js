$ (function () {
  //event handler to be called when the user is done filling out the userid
  $('#suuserid').focusout(function() {
    var uid = $('#suuserid').val();

    //a jquery post is used to call the checkuserid.php file
    $.post('/PHP/checkifunique.php', {col: 'userid', val: uid}, function(response) {
      if (response == 'pass') {
        //regex to check if the userid follows the desired format 
        if (/^regex/i.test(uid)) {
          hideError();
          checkComplete('signup');
        }
        else showError('USERID must be in the format of ---');
      }
      else if (response == 'used') showError('USERID is taken');
      else console.log(response);
    });
  });

  //event handler to be called when the user is done filling out the email
  $('#suemail').focusout(function() {
    //a jquery post is used to call the checkuserid.php file
    $.post('/PHP/checkifunique.php', {col: 'email', val: $('#suemail').val()}, function(response) {
      if (response == 'pass') {
        //another jquery post is used to check if the email is in the right format
        $.post('/PHP/checkemail.php', {email: $('#suemail').val()}, function(response) {
          if (response == 'valid') {
            hideError();
            checkComplete('signup');
          }
          else if (response == 'notvalid') showError('EMAIL is not in correct format (example@domain.com)');
          else console.log(response);
        });
      }
      else if (response == 'used') showError('EMAIL is taken');
      else console.log(response);
    });
  });

  //event handler to be called while the user is filling out the password
  $('#supwd').on('keyup', function() {
    if ($('#supwd').val() != '') {
      //regex to check if password meets the requirements
      if (/^regex/g.test($('#supwd').val())) {
        hideError();
        checkComplete('signup');
      }
      else showError('PASSWORD must meet the following requirements: ---');
    }
  });

  //Because the user is only signing in, no effort is intentionally made to check format or password requirements
  $('#siuserid').on('keyup', function() {
    checkComplete('signin');
  });
  $('#sipwd').on('keyup', function() {
    checkComplete('signin');
  });
  $('#ruserid').on('keyup', function() {
    checkComplete('recover');
  });
  $('#remail').on('keyup', function() {
    checkComplete('recover');
  });

  //event handler to be called while the user is filling out their new password
  $('#cpwd1').on('keyup', function() {
    if ($('#cpwd1').val() != '') {
      //regex to check if password meets the requirements
      if (/^regex/g.test($('#cpwd1').val())) {
        hideError();
        checkComplete('change');
      }
      else showError('PASSWORD (field 1) must meet the following requirements: ---');
    }
  });

  $('#cpwd2').on('keyup', function() {
    if ($('#cpwd2').val() != '') {
      //regex to check if password meets the requirements
      if (/^regex/g.test($('#cpwd2').val())) {
        hideError();
        checkComplete('change');
      }
      else showError('PASSWORD (field 2) must meet the following requirements: ---');
    }
  });

});

//showError will make the error div visible if there is an issue with input
function showError(e) {
  $('#regbtn').prop('disabled', true);
  $('#errmsg').css({opacity: 1});
  $('#errmsg').html(e);
}

function hideError() {
  $('#errmsg').css({opacity: 0});
}

//checkComplete is a function for signing up. Since the REGISTER button is disabled, this function checks if
//all data is inputted and if there is an error (by checking the opacity of errmsg). If there is no error and
//all fields are filled, the REGISTER button will be enabled
function checkComplete(type) {
  if (type == 'signup') {
    if ($('#suuserid').val() != '' && $('#suemail').val() != '' && $('#supwd').val() != '') {
      if ($('#errmsg').css('opacity') == 0)  $('#regbtn').prop('disabled', false);
      else $('#regbtn').prop('disabled', true);
    }
    else $('#regbtn').prop('disabled', true);
  }
  else if (type == 'signin') {
    if ($('#siuserid').val() != '' && $('#sipwd').val() != '') $('#signinbtn').prop('disabled', false);
    else $('#signinbtn').prop('disabled', true);
  }
  else if (type == 'recover') {
    if ($('#ruserid').val() != '' && $('#remail').val() != '') $('#rbtn').prop('disabled', false);
    else $('#rbtn').prop('disabled', true);
  }
  else if (type == 'change') {
    if ($('#cpwd1').val() != '' && $('#cpwd2').val() != '') {
      if ($('#cpwd1').val() == $('#cpwd2').val()) {
        hideError();
        $('#cbtn').prop('disabled', false);
      }
      else {
        showError('Password fields must be the same');
        $('#cbtn').prop('disabled', true);
      }
    }
    else $('#cbtn').prop('disabled', true);
  }
}

//showSignUp and showSignIn are meant to display either sign up or sign in options when prompted to
function showSignUp() {
  $('#signindiv').hide();
  $('#signupdiv').show();
}
function showSignIn() {
  $('#signupdiv').hide();
  $('#signindiv').show();
}

//signUp takes care of putting the user's info on the database, once all values are ok
function signUp() {
  //ajax call to the signup.php file
  $.ajax({
      type: "POST",
      url: '/PHP/signup.php',
      data: {userid: $('#suuserid').val(), email: $('#suemail').val(), pwd: $('#supwd').val()},
      success: function(response){
        if (response == 'added') {
          alert('User has been added');
          clearFields('signup');
        }
        else console.log(response);
      }
  });
}

function signIn() {
  //ajax call to the signin.php file
  $.ajax({
      type: "POST",
      url: '/PHP/signin.php',
      data: {userid: $('#siuserid').val(), pwd: $('#sipwd').val()},
      success: function(response){
        if (response == 'pass') {
          alert('You have successfully signed in');
          hideError();
          location.reload();
        }
        else if (response == 'fail') showError('Username or Password incorrect');
        else console.log(response);
      }
  });
}

function signOut() {
  //ajax call to the signout.php file
  $.ajax({
      type: "POST",
      url: '/PHP/signout.php',
      success: function(response){
          location.reload();
      }
  });
}

function clearFields(type) {
  if (type == 'signup') {
    $('#suuserid').val('');
    $('#suemail').val('');
    $('#supwd').val('');

    $('#regbnt').prop('disabled', true);
  }
  else if (type == 'reset') {
    $('#ruserid').val('');
    $('#remail').val('');

    $('#rbtn').prop('disabled', true);
  }
  else if (type == 'change') {
    $('#cpwd1').val('');
    $('#cpwd2').val('');

    $('#cbtn').prop('disabled', true);
  }
}

function sendToken() {
  $.ajax({
      type: "POST",
      url: '/PHP/reset.php',
      data: {userid: $('#ruserid').val(), email: $('#remail').val()},
      success: function(time){
        if (time == 'fail') alert('The information provided does not match our records. Please check your information and try again');
        else {
          alert('A password token has been sent to the email provided. It will expire in ' + time + ' minutes, please click it soon.');
          clearFields('reset');
        }
      }
  });
}

function changePassword() {
  $.ajax({
      type: "POST",
      url: '/PHP/changepassword.php',
      data: {newpwd: $('#cpwd1').val(), token: $('#ptoken').val()},
      success: function(response){
        if (response == 'changed') {
          alert('Your password has been changed.');
          clearFields('change');
        }
        else if (response == 'same') {
          alert('New password must different from the ' + $('#pwdtotal').html() + ' previous passwords');
          clearFields('change');
        }
        else console.log(response);
      }
  });
}
