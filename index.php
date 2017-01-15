<?php
require_once 'core/initialize.php';
//session_start();
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
       Session::set($user);
       Session::setNews("You have succesfully logged in");
       Session::setMessage("You have succesfully logged in and i will show you this forever");
       //Session::flash();
       redirect_to("main.php");
    }
            
    
/*
if($login->selectOr("users",[
    "nick" => $_POST["auth"],
    "email" => $_POST["auth"]
])){
    print_r($login->selectOr("users",[
    "nick" => $_POST["auth"],
    "email" => $_POST["auth"]
]));
}
else {
    echo "nic nie znaleziono";
}
 * *
 */
}

?>

<form action="" method="post">
    <div class="field">
        <label for="auth">Nick or Email</label>
        <input type="text" name="auth" id="auth" value=""/>
    </div>
    <div class="field">
        <label for="password">Choose a password</label>
        <input type="password" name="password" id="password"/>
    </div>
    
    <input type="submit" value="Register" name="submit"/>
</form>


<?php

