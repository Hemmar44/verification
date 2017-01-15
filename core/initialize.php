<?php

session_start();
//unset($GLOBALS);
defined("DB_SERVER") ? null : define("DB_SERVER", "127.0.0.1");
defined("DB_USER") ? null :define("DB_USER", "root");
defined("DB_PASS") ? null :define("DB_PASS", "");
defined("DB_NAME") ? null :define("DB_NAME", "family");
defined("DB_CHARSET") ? null :define("DB_CHARSET", "utf8");

$dsn = "mysql:host=".DB_SERVER.";dbname=".DB_NAME.";charset=".DB_CHARSET;

$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

spl_autoload_register(function($class){
    require_once 'classes/'. $class . '.php';
});

function redirect_to($location = NULL) {
    if($location != NULL){
        header("Location: {$location}");
        exit();
    }
}

function errorReporting($errors = array()) {
    if(count($errors) == 1) {
       
        echo "<div> Error occured: <p> {$errors[0]} </p></div>";
        }
        else {
            echo "<div> Errors occured: ";
        foreach ($errors as $error){
            echo "<p> {$error} </p></div>";
            }
            echo "</div>";
        }
}



?>