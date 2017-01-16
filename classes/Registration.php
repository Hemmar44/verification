<?php

require_once 'core/initialize.php';
require_once 'Database.php';

class Registration extends Database {
        
   private $_errors = [];
   //private $_pass = false;
   public $min = 4;
   public $max = 20;
   
   
   public function checkNick($nick) {
       if(!empty($nick)) {
           
       $sanitized = $this->filter($nick, FILTER_SANITIZE_STRING);
       if(strlen($sanitized)<$this->min || strlen($sanitized)>$this->max) {
           $this->addError("Nick must be longer than {$this->min} and shorter than {$this->max} characters");
       }
       
       if(!ctype_alnum($sanitized)) {
           $this->addError("Only alphanumeric characters");
       }
       //var_dump($sanitized);
      
       if(in_array($sanitized, $this->selectColumn("users","nick"))) {
           $this->addError("Nick already exists");
       }
       
       return $sanitized;
       }
   
    else {
         $this->addError("Fill nick");
    }
    
   }
   
    public function checkEmail($email) {
        if(!empty($email)) {
        $email = $this->filter($email, FILTER_SANITIZE_EMAIL);
        
        if(!$this->filter($email, FILTER_VALIDATE_EMAIL)){
            $this->addError("This is not a proper e-mail addres");
        }
        
        if(in_array($email, $this->selectColumn("users","email"))) {
           $this->addError("Email already exists");
       }
       
       return $email;
        
       }
        
        else {
         $this->addError("Fill email");
        }
    }
    
    public function checkPassword($password, $password_again) {
        $password = $this->filter($password, FILTER_SANITIZE_STRING);
        $password_again = $this->filter($password_again, FILTER_SANITIZE_STRING);
        if(!empty($password) && !empty($password_again)){
            
           if(strlen($password)<$this->min || strlen($password)>$this->max) {
           $this->addError("Password must be longer than {$this->min} and shorter than {$this->max} characters");
           }
           
           if(strcmp($password, $password_again) !== 0){
               $this->addError("Passwords aren't equal");
           }
        
        return password_hash($password,PASSWORD_DEFAULT);
        }

        else {
         $this->addError("Fill both passwords");
        }
    }
    
    public function checkTerms($array = array(),$terms){
        if(!array_key_exists($terms,$array)) {
            $this->addError("You need to accept terms and conditions");
        }
    }

   public function errors() {
      
           return $this->_errors;
       
   }
   
   public function addError($error){
       $this->_errors[] = $error;
   }
   
   
   

}


?>