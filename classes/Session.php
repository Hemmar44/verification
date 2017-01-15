<?php

require_once 'core/initialize.php';

class Session {
    private static $_message;
    private static $_news;
    
    //method that checks if _SESSION is not empty if its not,  set it to array equal an argument, else
    //it set _SESSION to array equal an argument;
    public static function set($user = array()) {
        if(!empty($_SESSION)) {
            session_unset();
            $_SESSION = $user;
        }
        else {
            $_SESSION = $user;
        }
    }
    
    //sets $_SESSION news to argument value (news is just for displaying it one time and vanish).
    public static function setNews($news) {
            $_SESSION["news"] = $news;
            //unset($_SESSION["message"]);
        }
   
    //sets $_SESSION message to argument value (message is suppose to stay on the screen),
    public static function setMessage($message) {
            $_SESSION["message"] = $message;
            //unset($_SESSION["message"]);
        }
        
    //it shows the news if it's set and destroy it just after.
    public static function flashNews() {
            if(isset($_SESSION["news"])){
                echo self::$_message = $_SESSION["news"];
                unset($_SESSION["news"]);
            }
            else{
                return false;
            }
    }
    //it shows the message if it's set.
    public static function showMessage() {
            if(isset($_SESSION["message"])){
               echo self::$_message = $_SESSION["message"];
            }
            else{
                return false;
            }
    }

}
?>