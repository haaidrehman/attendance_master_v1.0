<?php

// helper to implement hashed password
// To check a password b/w 6 to 12 characters which contain at least one numeric digit, one uppercase and one lowercase letter.
function hash_password($pass = ''){ 
   $hash = 0; 
   if(empty($pass)){
      $hash = 'empty';
   }
   else if(preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/', $pass)){
      $hash = password_hash($pass, PASSWORD_BCRYPT); 
   }
   return $hash;
}

?>