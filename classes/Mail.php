<?php

require_once 'core/initialize.php';

class Mail {
   
    public static function send($to, $subject, $message, $headers) {
        if(mail($to, $subject, $message, $headers)) {
            echo "Check your email to activate your account";
        }
        else {
            die("Something was wrong, email couldn't been sent, please try again later");
        }
    }
    
    public static function receive() {
        
    }

}
?>