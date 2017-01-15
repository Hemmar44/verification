<?php

require_once 'core/initialize.php';
require_once 'Database.php';

class Login extends Database {
        
   private $_errors = [];
   private $_user = array();
   private $_logged = false;
   //private $_pass = false;
   

   public function checkNickAndEmail($tableName, $auth, $fields = array()) {
           
       $auth = $this->filter($auth, FILTER_SANITIZE_STRING);
       
       if($this->_user = $this->selectOr($tableName, $fields)){
           $this->getUser();
            }
       else if(empty($auth)){
           $this->addError("Fill nick") ;
            }
        
    
    }
    
    public function checkPassword($password){
        $password = $this->filter($password, FILTER_SANITIZE_STRING);
        if(!empty($this->getUser())){
            
        if(!password_verify($password, $this->getUser()[0]["password"])){
               $this->addError("Wrong password");
            }
        else {
            return $this->loggedIn();
            }
        }
        else {
            $this->addError("User not found") ;
        }
    }
    
    public function getUser() {
        return $this->_user;
    }
    
    public function loggedIn() {
        return $this->_logged = true;
    }


    public function errors() {
      
           return $this->_errors;
       
   }
   
   public function addError($error){
       $this->_errors[] = $error;
   }
       
       
}
   
    


