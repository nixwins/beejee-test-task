<?php

namespace App\Helper;

class Auth{
    
    public static function verify($pass, $password_hash){
           
        if(password_verify($pass, $password_hash)){
               return true;
        }
      
        return false;
    }
    
  
}