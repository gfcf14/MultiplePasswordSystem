<?php
  //The key determines the available random characters to use for an artificial hash
  $key = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

  //assigns the total number of passwords that can be remembered
  $passwordtotal = 3;

  //assigns the access type, either mySQLi or PDO. To test each, simply change the value
  $accesstype = 'pdo';

  //assigns the maximum login tries before locking the account
  $maxtries = 3;

  //assigns the time limit for a recovery token, in seconds
  $recoverytimelimit = 300;

  //query to create the Users table:
    //userid would be the user's id
    //email is the user's email
    //active is used to see if user has verified their email
    //token is used to change password upon request
    //passfail counts the number of unsuccessful login attempts
    //locktime marks the time at which the account is locked
    //resettime marks the time at which the token was issued
  $sqluserstable = "create table Users( userid varchar(17) not null PRIMARY KEY,
                                              email varchar(100) not null,
                                              active varchar(60) not null,
                                              token varchar(60) not null,
                                              passfail int(10),
                                              locktime datetime,
                                              resettime datetime)";

  //query to create the Passwords table:
    //id just marks a number for passwords entered
    //userid is the correspoding driver's license/state id
    //pwd is the password
    //updatetime is the time at which the pwd was created/updated
  $sqlpasswordstable = "create table Passwords( id int(10) not null PRIMARY KEY AUTO_INCREMENT,
                                                userid varchar(17) not null,
                                                pwd varchar(60) not null,
                                                updatetime datetime not null)";
?>
