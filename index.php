<?php
require_once 'core/initialize.php';
//session_start();
Session::flashNews();
$login = new Login;
if($login->submitted()){
    
    //print_r($login->getUser());
    //echo "<br/>";
    $user = $login->checkNickAndEmail("users",$_POST["auth"], [
                "nick" => $_POST["auth"],
                 "email" => $_POST["auth"]
            ]);
    $logged = $login->checkPassword($_POST["password"]);
    
    if(!empty($login->errors())) {
        errorReporting($login->errors());        
    }
    
    else {
       $user = $login->getUser()[0];
       $user["key"] = Session::key($user["nick"], $user["id"]);
       Session::set($user);
       print_r($_SESSION);
       echo "<br/>";
       echo Session::$_key;
       
       Session::setNews("You have succesfully logged in");
       //Session::setMessage("You have succesfully logged in and i will show you this forever");
       //Session::flash();
       redirect_to("main.php");
    }
            
   
}

?>

<form action="" method="post">
    <div class="field">
        <label for="auth">Nick or Email</label>
        <input type="text" name="auth" id="auth" value="<?php if(isset($_POST["auth"])) {echo $_POST["auth"];} ?>"/>
    </div>
    <div class="field">
        <label for="password">Password</label>
        <input type="password" name="password" id="password"/>
    </div>
    
    <input type="submit" value="Sign in" name="submit"/>
</form>

<p><a href="register.php"/>Register</a></p>

<?php

